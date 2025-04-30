<?php

    require_once 'config/config.php';
    
    class Pingback
    {
        var $db;        
        var $uid;
        var $uname;
        var $addLP = 0;
        var $ref;
        
        function isValidInput($key, $value, $uid, $ref)
        {
            if(strlen($key) != 32)
                return false;
            
            if(!ctype_digit($value))
                return false;
            
            if(!ctype_digit($uid))
                return false;
            
            $check = md5(sprintf('e7e9a327584c8eefc775a330c4acf8_%d_%d_%s', $uid, $value, $ref));
            
            if($check != $key)
                return false;
            
            return true;
            
        }
        
        function ConnectDb($host, $user, $pass)
        {
            $dsn = sprintf("mysql:host=%s", $host);
            
            try
            {
                $this->db = new PDO($dsn, $user, $pass);
                return true;
            }
            catch ( PDOException $e )
            {
                return false;
            }               
            
        }
        
        function getUserData($uid)
        {
            $query = sprintf
            ("
                SELECT 
                    user_code, 
                    user_id 
                FROM 
                    %s.bg_user
                WHERE
                    user_code = :uid"
                    
            , Config::DB_AUTH);
            
            $dbh = $this->db->prepare($query);
            $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            $this->uid = $r['user_code'];
            $this->uname = $r['user_id'];
            
            return true;
           
        }
        
        function setCard($value)
        {
            switch($value)
            {
                case 5:
                    $this->addLP = 20000;
                    break;
                case 10:
                    $this->addLP = 40000;
                    break;
                case 25:
                    $this->addLP = 100000;
                    break;
                case 50:
                    $this->addLP = 200000;
                    break;
                case 75:
                    $this->addLP = 300000;
                    break;
                case 100:
                    $this->addLP = 400000;
                    break;
                default:
                    return false;
            }
            
            return true;
            
        }
        
        function isValidReference($reference)
        {
            // Check if the reference already exists
            $query = sprintf("SELECT count(*) FROM %s.t_donate_log WHERE a_ref = :ref", Config::DB_WEB);
            $dbh = $this->db->prepare($query);
            $dbh->bindParam(':ref', $reference);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            if($r[0] == 0)
            {
                $this->ref = $reference;
                return true;
            }
            
            return false;
        }
        
        function checkExistAlready()
        {
            $query = sprintf("SELECT count(*) FROM %s.TBL_LaghaimPointUser WHERE lpu_user_idx = :uid", Config::DB_EVENT);
            $dbh = $this->db->prepare($query);
            $dbh->bindParam(':uid', $this->uid);
            
            if(!$dbh->execute())
                return false;
            
            if(!$r = $dbh->fetch())
                return false;
            
            if($r[0] != 0)
                return true;
            
            return false;
        }
        
        function insertCash()
        {
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
            
            $dbh = $this->db->prepare($query);
            $dbh->bindParam(':uid', $this->uid);
            $dbh->bindParam(':uname', $this->uname);
            $dbh->bindParam(':points', $this->addLP);
            
            if(!$dbh->execute())
                return false;
            
            return true;                    

        }
        
        function updateCash()
        {
            $query = sprintf
            ("
                UPDATE %s.TBL_LaghaimPointUser
                SET 
                    lpu_user_lag_point = lpu_user_lag_point + :points,
                    lpu_update_date = NOW()
                WHERE lpu_user_idx = :uid"
                    
            , Config::DB_EVENT);
            
            $dbh = $this->db->prepare($query);
            $dbh->bindParam(':uid', $this->uid);
            $dbh->bindParam(':points', $this->addLP);
            
            if(!$dbh->execute())
                return false;
            
            return true;              
        }
        
        function AddPoints()
        {
            if($this->checkExistAlready())
                return $this->updateCash();
            else
                return $this->insertCash();
        }
        
        function AddLog()
        {
            $query = sprintf
            ("
                INSERT INTO neogeo_web.t_donate_log 
                (
                    a_user_index, 
                    a_timestamp, 
                    a_points, 
                    a_gm, 
                    a_ref
                ) 
                VALUES
                (
                    :uid, 
                    UNIX_TIMESTAMP(), 
                    :points, 
                    'BETAGAMECARD', 
                    :ref
                )"
            
            , Config::DB_WEB);
            
            $dbh = $this->db->prepare($query);
            $dbh->bindParam(':uid', $this->uid, PDO::PARAM_INT);
            $dbh->bindParam(':points', $this->addLP, PDO::PARAM_INT);
            $dbh->bindParam(':ref', $this->ref);
            $dbh->execute();            
        }
		
		function AddBonus($percentage)
		{
			$val = ($percentage / 100) * $this->addLP;
			$val = ceil($val);

			$this->addLP = $val;
			$this->AddPoints();
		}
		
        function AddBonusLog()
        {
            $query = sprintf
            ("
                INSERT INTO neogeo_web.t_donate_log 
                (
                    a_user_index, 
                    a_timestamp, 
                    a_points, 
                    a_gm, 
                    a_ref,
					a_reason
                ) 
                VALUES
                (
                    :uid, 
                    UNIX_TIMESTAMP(), 
                    :points, 
                    'BETAGAMECARD', 
                    :ref,
					'Bonus points'
                )"
            
            , Config::DB_WEB);
            
            $dbh = $this->db->prepare($query);
            $dbh->bindParam(':uid', $this->uid, PDO::PARAM_INT);
            $dbh->bindParam(':points', $this->addLP, PDO::PARAM_INT);
            $dbh->bindParam(':ref', $this->ref);
            $dbh->execute();            
        }		
        
    }
    
    
    

            
    $pb = new Pingback();

    if(!$pb->isValidInput($_GET['key'], $_GET['value'], $_GET['uid'], $_GET['ref']))
        die('Access denied');           

    if(!$pb->ConnectDb(Config::DBCON_URL, Config::DBCON_USER, Config::DBCON_PASS))
        die('Database Connection Error');

    if(!$pb->getUserData($_GET['uid']))
        die('Coult not retrieve user data');

    if(!$pb->setCard($_GET['value']))
        die('Unknown card type ' . $_GET['value']);

    if(!$pb->isValidReference($_GET['ref']))
        die('Card reference is invalid, maybe this card is already used.');

    if(!$pb->AddPoints())
        die('There was a error adding the point to your account');
	
    $pb->AddLog();
	
$nowtime = time();
	if($nowtime <= 1483311599)
	{
	    $pb->AddBonus(25);
      	    $pb->AddBonusLog();
	}
	
    die('okok');
    
?>