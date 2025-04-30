<?php

class User
{
    
    var $name = '';
    var $id = 0;
    var $enable = 1;
    var $online = false;
    var $hidden = false;
    var $gid = 0;
    
    
    function isCUser($cuid)
    {
        global $db, $s;
        
        $query = sprintf("SELECT ugame_user_code FROM %s.bg_user_game WHERE ugame_index = :cuid", Config::DB_USER);
        
        $dbh = $db->prepare($query);

        $dbh->bindParam(':cuid', $cuid, PDO::PARAM_INT);

        if(!$dbh->execute())
            $msg->error('Database Error');
        else
        {
            $r = $dbh->fetch();
            if($r != null)
                return $this->isUser($r[0]);
        }
        
        return false;        
    }
    
    function isUser($uid)
    {
        global $db, $s, $tpl, $admin, $msg;
        
        $query = sprintf
        ("
            SELECT 
                b.user_id, 
                b.user_code, 
                u.a_enable,
                u.a_connect as a_zone_num,
                g.ugame_index as game_id
                
            FROM 
                %s.bg_user b 
            
            LEFT JOIN %s.t_users u ON u.a_2p4p_user_code = b.user_code 
            LEFT JOIN %s.bg_user_game g ON g.ugame_user_code = b.user_code
                    
            WHERE 
                b.user_code = :uid
                
        ", Config::DB_USER, 
           Config::DB_USER,
           Config::DB_USER);
        
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if(!$dbh->execute())
        {
            $msg->error('Database Error');
            return false;
        }
        else
        {
            
            $r = $dbh->fetch();
            if($r != null)
            {
                $tpl->assignGlobal('username', $r['user_id']);
                $tpl->assignGlobal('uid', $r['user_code']);

                if($r['a_enable'] == 2)
                    $tpl->assignGlobal('banned', '<span class="bantext"><br />This user is currently banned</span>');            
                
                $this->id = $r['user_code'];
                $this->name = $r['user_id'];
                $this->enable = $r['a_enable'];
                $this->online = ($r['a_zone_num'] != -1);
                $this->hidden = false;
                $this->gid = $r['game_id'];
                
                if($this->online)
                    $tpl->assignGlobal('onlinedot', '<img src="tpl/img/online.png" title="User is currently Online!" />');
                else
                    $tpl->assignGlobal('onlinedot', '<img src="tpl/img/offline.png" title="User is offline" />');
                
                $this->SetLastUser();
                
                if($this->hidden && !$admin->Can(RIGHT_ISADMIN) && !$admin->Can(RIGHT_ISHGM))
                {
                    $msg->error('This user is protected and can only be viewed by HGM or Admin');
                    return false;
                }
                else
                    return true;
                
            }
            else
            {
                return false;               
            }
            
        }
        
    }
    
    function AddCash($uid, $amount, $reason)
    {
        global $db, $s, $admin;
        
        if($this->checkExistAlready())
            $this->updateCash($amount);
        else
            $this->insertCash($amount);
        
        $query = sprintf("INSERT INTO %s.t_donate_log (a_user_index, a_timestamp, a_points, a_gm, a_reason) VALUES(:uid, :time, :points, :gm, :reason)", Config::DB_WEB);
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);
        $dbh->bindParam(':time', time(), PDO::PARAM_INT);
        $dbh->bindParam(':points', $amount, PDO::PARAM_INT);
        $dbh->bindParam(':gm', $admin->name, PDO::PARAM_STR);
        $dbh->bindParam(':reason', $reason, PDO::PARAM_STR, 100);
        
        $dbh->execute();
        
    }
    
    function checkExistAlready()
    {
        global $db, $s;
        $query = sprintf("SELECT count(*) FROM %s.TBL_LaghaimPointUser WHERE lpu_user_idx = :uid", Config::DB_EVENT);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $this->id);

        if(!$dbh->execute())
            return false;

        if(!$r = $dbh->fetch())
            return false;

        if($r[0] != 0)
            return true;

        return false;
    }    
    
    function insertCash($amount)
    {
        global $db, $s;
        $query = sprintf
        ("
            INSERT INTO %s.TBL_LaghaimPointUser
            (
                lpu_user_idx,
                lpu_user_idname,
                lpu_user_lag_point,
                lpu_update_date
            )
            VALUES
            (
                :uid,
                :uname,
                :points,
                NOW()
            )"

        , Config::DB_EVENT);

        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $this->id);
        $dbh->bindParam(':uname', $this->name);
        $dbh->bindParam(':points', $amount);

        if(!$dbh->execute())
            return false;

        return true;                    

    }

    function updateCash($amount)
    {
        global $db, $s;
        $query = sprintf
        ("
            UPDATE %s.TBL_LaghaimPointUser
            SET 
                lpu_user_lag_point = lpu_user_lag_point + :points,
                lpu_update_date = NOW()
            WHERE lpu_user_idx = :uid"

        , Config::DB_EVENT);

        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $this->id);
        $dbh->bindParam(':points', $amount);

        if(!$dbh->execute())
        {
            print_r($dbh->errorInfo());
            return false;
        }

        return true;              
    }    
    
    function ChangePassword($pass)
    {
        if(!$db = db::getConnection())
            return false;

        $query = sprintf("UPDATE %s.bg_user SET passwd = PASSWORD(:pass), old_passwd = OLD_PASSWORD(:pass) WHERE user_code = :uid", Config::DB_USER);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':pass', $pass, PDO::PARAM_STR);
        $dbh->bindParam(':uid', $this->id, PDO::PARAM_INT);

        return $dbh->execute();
    }
    
    function SetLastUser()
    {
        $arr = array();
        if(isset($_SESSION['lastuser']))
        {
            $arr = json_decode($_SESSION['lastuser']);
            
            foreach($arr as $a)
                if($a == $this->id . ':' . $this->name)
                    return;
        }
        
        
        $arr[] = $this->id . ':' . $this->name;
        
        $_SESSION['lastuser'] = json_encode($arr);        
    }    
}

?>
