<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/resetid.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_VIEWLASTLOGIN))
        {
    
            $user = new User();
            if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
            {
                if($user->isUser($_GET['uid']))
                {

                    if(isset($_POST['action']) && $_POST['action'] == 'reset')
                    {
                        if(!validEmail($_POST['email']))
                            $msg->error('This is not a valid email address');
                        else
                        {
                            
                            $query = sprintf("SELECT user_id, pin FROM %s.bg_user WHERE user_code = :uid", Config::DB_USER);
                            $dbh = $db->prepare($query);
                            $dbh->bindParam('uid', $user->id, PDO::PARAM_INT);
                            $dbh->execute();

                            $r = $dbh->fetch();
                            if($r != null)
                            {
                                $subject = $_POST['subject'];
                                $email = $_POST['email'];
                                $content = $_POST['content'];
                                $username = $r['user_id'];
                                $scode = $r['pin'];
                                $password = randomPassword();
                                
                                $content = str_replace('{username}', $username, $content);
                                $content = str_replace('{password}', $password, $content);
                                $content = str_replace('{securitycode}', $scode, $content);
                                
                                if($user->ChangePassword($password))
                                {
                                    if(SendMail($email, $subject, $content))
                                        $msg->error('Email has been sent to the player!');
                                }

                            }                            
                            
                        }
                    }
                    else
                    {
                        $query = sprintf("SELECT email, regmail FROM %s.bg_user WHERE user_code = :uid", Config::DB_USER);
                        $dbh = $db->prepare($query);
                        $dbh->bindParam('uid', $user->id, PDO::PARAM_INT);
                        $dbh->execute();

                        $r = $dbh->fetch();
                        if($r != null)
                        {
                            $tpl->newBlock('mailform');
                            $tpl->assign('regmail', $r['regmail']);
                            $tpl->assign('curmail', $r['email']);
                        }
                    }

                }
                else
                   $msg->error('No user found with this id');                
            }
            else
                $msg->error('No user id given');
        }

	$tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    


