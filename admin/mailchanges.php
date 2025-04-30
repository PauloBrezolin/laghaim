<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/mailchanges.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_VIEWEMAILCHANGES))
        {
    
            $user = new User();
            if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
            {

                if($user->isUser($_GET['uid']))
                {
                    $query = sprintf("SELECT * FROM %s.t_mailchange WHERE a_user_index = :uid ORDER BY a_time DESC", Config::DB_WEB);
                    $dbh = $db->prepare($query);
                    
                    $dbh->bindParam(':uid', $user->id, PDO::PARAM_INT);
                    
                    if($dbh->execute())
                    {
                        $tpl->newBlock('mailchanges');
                        $result = $dbh->fetchAll();
                        
                        foreach($result as $r)
                        {
                            $tpl->newBlock('list');
                            $tpl->assign('date', $r['a_time']);
                            $tpl->assign('ip', $r['a_ip']);
                            $tpl->assign('hostname', @gethostbyaddr($r['a_ip']));
                            $tpl->assign('newmail', $r['a_newmail']);
                        }
                            
                    }
                    else
                        $msg->error('Database Error');
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
    
?>

