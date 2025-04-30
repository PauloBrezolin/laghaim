<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/userlog.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_ISADMIN))
        {
    
            $user = new User();
            if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
            {

                if($user->isUser($_GET['uid']))
                {

                    $query = sprintf
                    ("
                        SELECT
                            a.a_displayname,
                            a.a_enable,
                            l.a_ip,
                            l.a_host,
                            l.a_date,
                            l.a_type,
                            l.a_action

                        FROM
                            %s.t_log l
                            LEFT JOIN %s.t_admininfo a ON l.a_admin = a.a_index

                        WHERE
                            l.a_user_idx = :uid
        
                    ", Config::DB_WEB,
                       Config::DB_WEB);
                    
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':uid', $user->id, PDO::PARAM_INT);

                    if($dbh->execute())
                    {

                        $tpl->newBlock('gmlog');

                        $result = $dbh->fetchAll();

                        foreach($result as $r)
                        {
                            $tpl->newBlock('list');
                            $tpl->assign('gm', $r['a_displayname']);
                            $tpl->assign('ip', $r['a_ip']);
                            $tpl->assign('host', $r['a_host']);
                            $tpl->assign('date', $r['a_date']);
                            $tpl->assign('type', $r['a_type']);
                            $tpl->assign('action', $r['a_action']);
                        }
                    }
                    else
                        $msg->error('Database Error!');
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

