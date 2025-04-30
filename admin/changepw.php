<?php

    session_start();
    $bn = basename(__FILE__); 
    
    
    require_once 'inc/templatepower.php';

    
    
    $tpl = new TemplatePower('tpl/pages/settings/changepw.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    
    
    if($admin->login)
    {
        if(isset($_POST['action']) && $_POST['action'] == 'changepw')
        {
            if(!isset($_POST['newpw1']) || strlen($_POST['newpw1']) < 5 || strlen($_POST['newpw1']) > 16)
            {
                $msg->error('New password must be between 5 and 16 long');
                $tpl->newBlock('cpwform');
            }
            elseif($_POST['newpw1'] != $_POST['newpw2'])
            {
                $msg->error('New passwords are not the same');
                $tpl->newBlock('cpwform');
            }
            else
            {
                
                $query = sprintf("SELECT count(*) FROM %s.t_admininfo WHERE a_index = :adminid AND a_password = md5(:oldpw)", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':adminid', $admin->id);
                $dbh->bindParam(':oldpw', $_POST['oldpw']);
                $dbh->execute();
                
                $result = $dbh->fetch();
                
                if($result[0] == 0)
                {
                    $msg->error('Old Password incorrect');
                    $tpl->newBlock('cpwform');
                }
                else
                {
                    $query = sprintf("UPDATE %s.t_admininfo SET a_password = md5(:newpw) WHERE a_index = :adminid", Config::DB_WEB);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':adminid', $admin->id);
                    $dbh->bindParam(':newpw', $_POST['newpw1']);                    
                    
                    if($dbh->execute())
                    {
                        $msg->error('Password is changed');
                        $log->ChangePass($_POST['oldpw'], $_POST['newpw']);
                    }
                    else
                    {
                        $msg->error('something wrong');
                    }
                    
                }
                
            }
        }
        else
        {
             $tpl->newBlock('cpwform');
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

