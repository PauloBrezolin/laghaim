<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/lastlogins.tpl');
    
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

                    if(isset($_GET['limit']) && ctype_digit($_GET['limit'])) 
                        $limit = intval($_GET['limit']);
                    else 
                        $limit = 10;                

                    $query = sprintf("SELECT a_date, a_ip FROM %s.t_connect_log WHERE a_idname = :uname ORDER BY a_date DESC LIMIT :limit", Config::DB_USER);
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':uname', $user->name, PDO::PARAM_STR);
                    $dbh->bindParam(':limit', $limit, PDO::PARAM_INT);
                    
                    $dbh->execute();

                    $tpl->newBlock('lastlogins');

                    $result = $dbh->fetchAll();

                    $i = 0;
                    foreach($result as $r)
                    {
                        $tpl->newBlock('list');
                        $tpl->assign('date', $r['a_date']);
                        $tpl->assign('ip', $r['a_ip']);
                        $tpl->assign('id', 'ip_' . $i++);
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
    
?>

