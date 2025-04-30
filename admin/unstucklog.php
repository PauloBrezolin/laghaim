<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    
    $tpl = new TemplatePower('tpl/pages/user/unstucklog.tpl');
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    
    if($admin->login)
    {
        $user = new User();
        if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
        {

            if($user->isUser($_GET['uid']))
            {

                $query = sprintf("SELECT a_ip, a_time FROM %s.t_unstuck_log WHERE a_user_index = :uid", Config::DB_WEB);
                $dbh = $db->prepare($query);

                $dbh->bindParam(':uid', $user->id, PDO::PARAM_STR);

                if($dbh->execute())
                {
                    $result = $dbh->fetchAll();

                    foreach($result as $r)
                    {
                        $tpl->newBlock('list');
                        $tpl->assign('date', $r['a_time']);
                        $tpl->assign('ip', $r['a_ip']);
                    }
                }

            }
            else
               $msg->error('No user found with this id');                
        }
        else
            $msg->error('No user id given');

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

