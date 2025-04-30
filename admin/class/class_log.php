<?php

class Log
{
    
    function DeleteItem($char, $slot)
    {
        
        global $db, $s;
        
        $l = substr($char->id, -1);
        
        $query = sprintf
        ("
            SELECT
                v.a_item_idx,
                i.a_name_tha as a_name,
                v.a_plus_point as a_plus,
                v.a_serial1 as a_serial

            FROM
                %s.t_inven0%d v
                LEFT JOIN %s.t_item i ON i.a_index = v.a_item_idx	

            WHERE
                a_char_idx = :char

            AND
                a_slot = :slot
                
         ", Config::DB_CHAR, $l, Config::DB_DATA);
        
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':char', $char->id, PDO::PARAM_INT);
        $dbh->bindParam(':slot', $slot, PDO::PARAM_STR);
        
        if($dbh->execute())
        {
            $r = $dbh->fetch();
            
            $type = 'DELETE INVENTORY ITEM';
            
            $serials = explode(' ', $r['a_serial']);
            
            $action = sprintf("Id[%d] Name[%s] Amount[%s] Plus[%d] Serial[%s]",
                    $r['a_item_idx'],
                    $r['a_name'],
                    AddDots(count($serials)),
                    $r['a_plus'],
                    $r['a_serial']);
            
            $this->Add($char->uid, $char->id, $type, $action);
        }
        
        
    }
    
    function DeleteGuildItem($gid, $slot)
    {
        
        global $db, $s;
        
        $query = sprintf
        ("
            SELECT 
                g.a_plus, 
                g.a_count, 
                i.a_name, 
                g.a_item_vnum, 
                g.a_serial 
            FROM
                %s.t_guild_stash g, 
                %s.t_item i 
            WHERE 
                g.a_guild_index = :gid 
            AND
                g.a_slot = :slot
            AND 
                g.a_item_vnum > 0 
            AND 
                i.a_index = g.a_item_vnum"
                
        , Config::DB_CHAR, 
          Config::DB_DATA);
        
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':gid', $gid, PDO::PARAM_INT);
        $dbh->bindParam(':slot', $slot, PDO::PARAM_INT);
        
        if($dbh->execute())
        {
            $r = $dbh->fetch();
            
            $type = 'DELETE GUILD ITEM';
            
            $serials = explode(' ', $r['a_serial']);
            
            $action = sprintf("Id[%d] Name[%s] Amount[%d] Plus[%d] Serial[%s]",
                    $r['a_item_vnum'],
                    $r['a_name'],
                    $r['a_count'],
                    $r['a_plus'],
                    $r['a_serial']);
            
            $this->Add($gid, $slot, $type, $action);
        }
        
        
    }    
    
    function EditItem($char, $row, $col, $step)
    {
        global $db, $s;
        
        $l = substr($char->id, -1);
        
        $query = sprintf
        ("
            SELECT
                v.a_item_idx%d as a_item_idx,
                i.a_name_usa as a_name,
                v.a_count%d as a_count,
                v.a_plus%d as a_plus,
                v.a_serial%d as a_serial,
                v.a_item%d_option0 as a_opt0,
                v.a_item%d_option1 as a_opt1,
                v.a_item%d_option2 as a_opt2,
                v.a_item%d_option3 as a_opt3,
                v.a_item%d_option4 as a_opt4,
                v.a_socket%d as a_socket

            FROM
                %s.t_inven0%d v
                LEFT JOIN %s.t_item i  ON i.a_index = v.a_item_idx%d	

            WHERE
                a_char_idx = :char

            AND
                a_row_idx = :row
                
         ", $col, $col, $col, $col, $col, $col, $col, $col, $col, $col,
            Config::DB_CHAR, $l,
            Config::DB_DATA, $col);
        
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':char', $char->id, PDO::PARAM_INT);
        $dbh->bindParam(':row', $row, PDO::PARAM_INT);
        
        if($dbh->execute())
        {
            $r = $dbh->fetch();
            
            if($step == 1)
                $type = 'EDIT INVENTORY ITEM FROM';
            else
                $type = 'EDIT INVENTORY ITEM TO';
            
            $action = sprintf("Row[%d] Col[%d] Id[%d] Name[%s] Amount[%s] Plus[%d] Serial[%s] Option[%d:%d:%d:%d:%d] Socket[%s]",
                    $row,
                    $col,
                    $r['a_item_idx'],
                    $r['a_name'],
                    AddDots($r['a_count']),
                    $r['a_plus'],
                    $r['a_serial'],
                    $r['a_opt0'], $r['a_opt1'], $r['a_opt2'], $r['a_opt3'], $r['a_opt4'], 
                    $r['a_socket']);
            
            $this->Add($char->uid, $char->id, $type, $action);
        }        
    }
    
    
    function EditChar($cid, $column, $oldval, $newval)
    {
        $uid = GetUserId($cid);
        
        $action = sprintf('Column[%s] From[%s] To[%s]', $column, $oldval, $newval);
        
        $this->Add($uid, $cid, 'EDIT CHARACTER', $action);
    }
    
    function EditUser($uid, $column, $oldval, $newval)
    {
                
        $action = sprintf('Column[%s] From[%s] To[%s]', $column, $oldval, $newval);
        
        $this->Add($uid, -1, 'EDIT USER', $action);
    }    
    
    function EditJob($cid, $oldjob, $oldjob2, $job, $job2)
    {
        $uid = GetUserId($cid);
        
        $action = sprintf('From[%s] To[%s]', cj($oldjob, $oldjob2), cj($job, $job2));
        
        $this->Add($uid, $cid, 'EDIT JOB', $action);        
    }
    
    function EditAffinity($cid, $aid, $points)
    {
        global $s;
        $uid = GetUserId($cid);
        $name = DBGetFromInt(sprintf("SELECT a_name FROM %s.t_affinity WHERE a_index = :value", Config::DB_DATA), $aid);
        $action = sprintf("Name[%s] Points[%s]", $name, AddDots($points));
        
        $this->Add($uid, $cid, 'EDIT AFFINITY', $action);  
        
    }
    
    function ChangePass($oldpw, $newpw)
    {
        $action = sprintf('From[%s] To[%s]', $oldpw, $newpw);
        $this->Add(-1, -1, 'EDIT ADMINPANEL PASSWORD', $action);
    }
    
    function Add($user, $char, $type, $action)
    {
        global $s, $db, $admin;
        
        $ip = get_real_ip();
        $host = @gethostbyaddr($ip) . ' ';
        
        
        $query = sprintf
        ("
            INSERT INTO
                %s.t_log
                (
                    a_admin,
                    a_ip,
                    a_host,
                    a_user_idx,
                    a_char_idx,
                    a_type,
                    a_action
                )
            
            VALUES
            (
                :admin,
                :ip,
                :host,
                :user,
                :char,
                :type,
                :action
            );
                
        ", Config::DB_WEB);
        
        $dbh = $db->prepare($query);
        
        $dbh->bindParam(':admin', $admin->id, PDO::PARAM_INT);
        $dbh->bindParam(':ip', $ip, PDO::PARAM_STR);
        $dbh->bindParam(':host', $host, PDO::PARAM_STR);
        $dbh->bindParam(':user', $user, PDO::PARAM_INT);
        $dbh->bindParam(':char', $char, PDO::PARAM_INT);
        $dbh->bindParam(':type', $type, PDO::PARAM_STR);
        $dbh->bindParam(':action', $action, PDO::PARAM_STR);
        
        $dbh->execute();
        
    }
}

?>
