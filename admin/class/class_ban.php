<?php

    class BanUnban
    {

        function Ban($uid, $reason, $gmreason, $gm, $days, $email, $givereason)
        {
            global $db, $s;

            $bantime = time() + ($days * (60*60*24));

            $query = sprintf
            ("
                UPDATE 
                    %s.t_users 

                SET 
                    a_enable = 2,
                    a_bantime = :bantime

                WHERE 
                    a_2p4p_user_code = :uid

            " , Config::DB_USER );

            $dbh = $db->prepare( $query );
            $dbh->bindParam(':bantime', $bantime);
            $dbh->bindParam(':uid', $uid);
            
            $dbh->execute();


            $btime = "";
            $days = intval($days);
            switch( $days )
            {
                case 1:     $btime = "1 Day";       break;
                case 2:     $btime = "2 Days";      break;
                case 3:     $btime = "3 Days";      break;
                case 7:     $btime = "1 Week";      break;
                case 14:    $btime = "2 Weeks";     break;
                case 30:    $btime = "1 Month";     break;
                default:    $btime = "Permanent";   break;
            }



            $query = sprintf
            ("
                INSERT INTO 
                    %s.t_banlist 
                    (
                        a_user_index, 
                        a_timestamp, 
                        a_reason, 
                        a_admin_name, 
                        a_action,
                        a_bantime,
                        a_gmreason
                    ) 

                VALUES 
                (
                    :uid,
                    :timestamp,
                    :reason,
                    :gmname,
                    'BAN',
                    :btime,
                    :gmreason
                )

            ", Config::DB_WEB );

            $dbh = $db->prepare( $query );
            
            $dbh->bindParam(':uid', $uid);
            $dbh->bindParam(':timestamp', time());
            $dbh->bindParam(':reason', $reason);
            $dbh->bindParam(':gmname', $gm);
            $dbh->bindParam(':btime', $btime);
            $dbh->bindParam(':gmreason', $gmreason);
            
            $dbh->execute();


            if( $email == "yes" )
            {
                Email_Banned($uid, $btime, $reason, $givereason);
                
            }

        }
		
		
        function UnBan($uid, $reason, $gmreason, $gm, $email)
        {
            global $db, $s;

            $query = sprintf
            ("
                UPDATE 
                    %s.t_users 

                SET 
                    a_enable = 1,
                    a_bantime = 0

                WHERE 
                    a_2p4p_user_code = :uid

            " , Config::DB_USER );

            $dbh = $db->prepare( $query );
            $dbh->bindParam(':uid', $uid);
            
            if(!$dbh->execute())
                print_r($dbh->errorInfo());

            $query = sprintf
            ("
                INSERT INTO 
                    %s.t_banlist 
                    (
                        a_user_index, 
                        a_timestamp, 
                        a_reason, 
                        a_admin_name, 
                        a_action,
                        a_bantime,
                        a_gmreason
                    ) 

                VALUES 
                (
                    :uid,
                    :timestamp,
                    :reason,
                    :gmname,
                    'UNBAN',
                    :btime,
                    :gmreason
                )

            ", Config::DB_WEB );

            $dbh = $db->prepare( $query );
            
            $dbh->bindParam(':uid', $uid);
            $dbh->bindParam(':timestamp', time());
            $dbh->bindParam(':reason', $reason);
            $dbh->bindParam(':gmname', $gm);
            $dbh->bindParam(':btime', $btime);
            $dbh->bindParam(':gmreason', $gmreason);
            
            if(!$dbh->execute())
                print_r($dbh->errorInfo());



            if( $email == "yes" )
                    Email_Unbanned($uid);

        }

        function GetLastBanGM($uid)
        {
            global $db, $s;
            
            $query = sprintf("SELECT a_admin_name, a_action FROM %s.t_banlist WHERE a_user_index = :uid ORDER BY a_index DESC LIMIT 1", Config::DB_WEB);
            $dbh = $db->prepare($query);
            
            $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);
            
            $dbh->execute();
            
            $result = $dbh->fetch();
            
            if($result != null)
            {
                if($result['a_action'] == 'BAN')
                    return $result['a_admin_name'];
                else
                    return '';
            }
            else return '';            
            
        }
        
        
        function CanBeUnbannedByMe($uid)
        {
            global $admin;
            $last = $this->GetLastBanGM($uid);
            
            if($admin->Can(RIGHT_ISADMIN))
                return true;
            
            if($last == 'Administrator' || $last == '[ADM]CookieZ')
            {
                if($admin->Can(RIGHT_UNBANADMINBAN))
                    return true;
                else
                    return false;
            }
            
            
            if($last == $admin->name)
                return true;
            elseif($last != $admin->name && $admin->Can(RIGHT_UNBANOTHERBAN))
                return true;
            else
                return false;
                
            
            
            
        }
        
    }

?>
