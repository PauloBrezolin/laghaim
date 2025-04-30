<?php

    require_once 'inc/globals.php';

    if($admin->login)
    {
        
        function EditCharValue($column, $newval, $cid)
        {
            
            global $db, $s, $log;
            
            $error = true;
            
            $newval = str_replace('.', '', $newval);
            $newval = str_replace(',', '', $newval);
            
            $query = sprintf("SELECT %s FROM %s.t_characters WHERE a_index = :id", $column, Config::DB_CHAR);
            $dbh = $db->prepare($query);

            $dbh->bindParam(':id', $cid, PDO::PARAM_INT);      
            
            if($dbh->execute())
            {
                
                $r = $dbh->fetch();
                if($r != null)
                {
                    $oldval = $r[$column];
                    
                    $log->EditChar($cid, $column, $oldval, $newval);
                    
                    $query = sprintf("UPDATE %s.t_characters SET %s = :val WHERE a_index = :id", Config::DB_CHAR, $column);
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':val', $newval);
                    $dbh->bindParam(':id', $cid, PDO::PARAM_INT);

                    if($dbh->execute())
                    {
                        
                        if(ctype_digit($newval))
                            return AddDots($newval);
                        else
                            return $newval;
                    }
                    else
                    {
                        if(ctype_digit($oldval))
                            return AddDots($oldval);                        
                        else
                            return $oldval;                        
                    }                        
                }
            }
            
            return 'Error';            
        }
        
        function EditClassJob($job, $job2, $cid)
        {

            global $db, $s, $log;
            
            $query = sprintf("SELECT a_job, a_job2 FROM %s.t_characters WHERE a_index = :id", Config::DB_CHAR);
            $dbh = $db->prepare($query);

            $dbh->bindParam(':id', $cid, PDO::PARAM_INT);

            if($dbh->execute())
            {
                $r = $dbh->fetch();
                if($r != null)
                {
                    $oldjob = $r['a_job'];
                    $oldjob2 = $r['a_job2'];
                    
                    $query = sprintf("UPDATE %s.t_characters SET a_job = :job, a_job2 = :job2 WHERE a_index = :id", Config::DB_CHAR);
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':id', $cid, PDO::PARAM_INT);
                    $dbh->bindParam(':job', $job, PDO::PARAM_INT);
                    $dbh->bindParam(':job2', $job2, PDO::PARAM_INT);

                    if($dbh->execute())
                    {
                        
                        $log->EditJob($cid, $oldjob, $oldjob2, $job, $job2);
                        
                        return cj($job, $job2);
                    }
                    else
                        return cj($oldjob, $oldjob2);
                    
                }
            }
            
            return 'Error';

        }



        function EditUserValue($column, $newval, $uid)
        {
            global $db, $s, $log;
            
            $query = sprintf("SELECT %s FROM %s.bg_user WHERE user_code = :id", $column, Config::DB_USER);
            $dbh = $db->prepare($query);

            $dbh->bindParam(':id', $uid, PDO::PARAM_INT);
            if($dbh->execute())
            {
                $r = $dbh->fetch();
                if($r != null)
                {
                    $oldval = $r[$column];
                    
                    $log->EditUser($uid, $column, $oldval, $newval);
                    
                    if($column == 'passwd')
                        $query = sprintf("UPDATE %s.bg_user SET passwd = password(:val), old_passwd = old_password(:val) WHERE user_code = :id", Config::DB_USER, $column);
                    else
                        $query = sprintf("UPDATE %s.bg_user SET %s = :val WHERE user_code = :id", Config::DB_USER, $column);
                    
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':val', $newval);
                    $dbh->bindParam(':id', $uid, PDO::PARAM_INT);

                    if($dbh->execute())
                        return $newval;
                    else
                        return $oldval;
                }
            }
            
            return 'Error';            

        }

        function EditUsername($newname, $uid)
        {
            global $db, $s;
            $success = true;

            if(ctype_alnum($newname))
            {

                $query = sprintf("SELECT count(*) FROM %s.bg_user WHERE user_id = :uname", Config::DB_USER);
                $dbh = $db->prepare($query);

                $dbh->bindParam(':uname', $newname, PDO::PARAM_STR);

                if($dbh->execute())
                {
                    $r = $dbh->fetch();
                    if( $s[0] == 0)
                    {
                        $query = sprintf("UPDATE %s.t_users SET a_idname = :uname, a_2p4p_user_id = :uname WHERE a_2p4p_user_code = :uid", Config::DB_USER);
                        $dbh = $db->prepare($query);

                        $dbh->bindParam(':uname', $newname, PDO::PARAM_STR);
                        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

                        if($dbh->execute())
                        {

                            $query = sprintf("UPDATE %s.bg_user SET user_id = :uname WHERE user_code = :uid", Config::DB_USER);
                            $dbh = $db->prepare($query);

                            $dbh->bindParam(':uname', $newname, PDO::PARAM_STR);
                            $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

                            if(!$dbh->execute())
                                $success = false;
                        }
                        else
                            $success = false;                   
                    }
                    else
                        $success = false;
                }
                else
                    $success = false;
            }
            else 
                $success = false;       


            if($success == true)
                return $newname;
            else
            {
                $query = sprintf("SELECT user_id FROM %s.bg_user WHERE user_code = :uid", Config::DB_USER);
                $dbh = $db->prepare($query);

                $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);
                if($dbh->execute())
                {
                    $r = $dbh->fetch();
                    return $r[0];
                }
                else
                    return 'Something wend wrong, please contact the Administrator';
            }


        }        
        
        
        if(isset($_POST['edituserdata']))
        {
            if(ctype_digit($_POST['edituserdata']))
            {
                $uid = $_POST['edituserdata'];

                if(isset($_POST['usrName']) && $admin->Can(RIGHT_EDITUSERNAME))
                {
                    echo EditUsername($_POST['usrName'], $uid);
                }

                if(isset($_POST['usrPw']) && $admin->Can(RIGHT_EDITUSERPASSWORD))
                {
                    EditUserValue('passwd', $_POST['usrPw'], $uid);
                    echo '***';
                }

                if(isset($_POST['usrEmail']) && $admin->Can(RIGHT_EDITUSEREMAIL))
                {
                    echo EditUserValue('email', $_POST['usrEmail'], $uid);
                }

                if(isset($_POST['usrSecCode']) && $admin->Can(RIGHT_EDITUSERSECCODE))
                {
                    echo EditUserValue('pin', $_POST['usrSecCode'], $uid);
                }


            }

            else 
                echo 'ERROR';

        }

        if(isset($_POST['editcharrdata']))
        {
            if(ctype_digit($_POST['editcharrdata']))
            {
                $cid = $_POST['editcharrdata'];

                if(isset($_POST['chName'])  && $admin->Can(RIGHT_EDITCHARNAME))
                {
                    echo EditCharValue ( 'a_name', $_POST['chName'], $cid );
                }

                if(isset($_POST['chLevel']) && $admin->Can(RIGHT_EDITLEVEL))
                {
                    echo EditCharValue ( 'a_level', $_POST['chLevel'], $cid );
                }

                if(isset($_POST['chStr']) && $admin->Can(RIGHT_EDITSTATS))
                {
                    echo EditCharValue ( 'a_strength', $_POST['chStr'], $cid );
                }

                if(isset($_POST['chDex']) && $admin->Can(RIGHT_EDITSTATS))
                {
                    echo EditCharValue ( 'a_dexterity', $_POST['chDex'], $cid );
                }

                if(isset($_POST['chInt']) && $admin->Can(RIGHT_EDITSTATS))
                {
                    echo EditCharValue ( 'a_intelligence', $_POST['chInt'], $cid );
                }

                if(isset($_POST['chCon']) && $admin->Can(RIGHT_EDITSTATS))
                {
                    echo EditCharValue ( 'a_constitution', $_POST['chCon'], $cid );
                }

                if(isset($_POST['chExp']) && $admin->Can(RIGHT_EDITEXP))
                {
                    echo EditCharValue ( 'a_exp', $_POST['chExp'], $cid );
                }

                if(isset($_POST['chFame']) && $admin->Can(RIGHT_EDITREP))
                {
                    echo EditCharValue ( 'a_fame', $_POST['chFame'], $cid );
                }

                if(isset($_POST['chAdmin']) && $admin->Can(RIGHT_EDITGMLEVEL))            
                {
                    echo EditCharValue ( 'a_admin', $_POST['chAdmin'], $cid );
                }
                
                if(isset($_POST['chEnable']) && $admin->Can(RIGHT_EDITCHARNAME))
                {
                    echo EditCharValue('a_enable', $_POST['chEnable'], $cid);
                }
                
                if(isset($_POST['chCharisma']) && $admin->Can(RIGHT_EDITSTATS))
                {
                    echo EditCharValue('a_charisma', $_POST['chCharisma'], $cid);
                }
                
                if(isset($_POST['chMoney']) && $admin->Can(RIGHT_EDITGOLD))
                {
                    echo EditCharValue('a_money', $_POST['chMoney'], $cid);
                }

                if(isset($_POST['chStamina']) && $admin->Can(RIGHT_EDITSTATS))
                {
                    echo EditCharValue('a_max_stamina', $_POST['chStamina'], $cid);
                }

                if(isset($_POST['chEPower']) && $admin->Can(RIGHT_EDITSTATS))
                {
                    echo EditCharValue('a_max_epower', $_POST['chEPower'], $cid);
                }

                
                if(isset($_POST['chJob']) && $admin->Can(RIGHT_EDITCLASS))
                {
                    $var = explode(':', $_POST['chJob']);
                    echo EditClassJob($var[0], $var[1], $cid);
                }


            }
        }


    
    
    
    
    
    // If not logged in jump to login.php
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
    

?>
