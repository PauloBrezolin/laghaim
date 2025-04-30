<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/settings/gmlog.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_ISADMIN))
        {

            if(isset($_GET['aid']) && ctype_digit($_GET['aid']))
            {
                
                
                $query = sprintf("SELECT * FROM %s.t_admininfo WHERE a_index = :aid", Config::DB_WEB);
                $dbh = $db->prepare($query);
                
                $dbh->bindParam(':aid', $_GET['aid'], PDO::PARAM_INT);
                
                $dbh->execute();
                
                $r = $dbh->fetch();
                if($r != null)
                {
                    $gmname = $r['a_displayname'];
                    $tpl->assignGlobal('gm', $gmname);
                
                    
                    $query = sprintf
                    ("
                        SELECT
                            l.a_user_idx,
                            u.user_id as a_user_name,
                            l.a_char_idx,
                            c.a_name as a_char_name,
                            l.a_ip,
                            l.a_host,
                            l.a_date,
                            l.a_type,
                            l.a_action

                          FROM
                              %s.t_log l
                              LEFT JOIN %s.bg_user u ON u.user_code = l.a_user_idx
                              LEFT JOIN %s.t_characters c ON c.a_index = l.a_char_idx

                          WHERE
                              l.a_admin = :admin
                              
                        ORDER BY l.a_index DESC

                    ", Config::DB_WEB, Config::DB_USER, Config::DB_CHAR);

                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':admin', $_GET['aid'], PDO::PARAM_INT);

                    if($dbh->execute())
                    {

                        $tpl->newBlock('gmlog');

                        $result = $dbh->fetchAll();

                        foreach($result as $r)
                        {
                            $tpl->newBlock('list');
                            $tpl->assign('user', '<a href="user.php?uid='.$r['a_user_idx'].'">'.$r['a_user_name'].'</a>');
                            $tpl->assign('char', $r['a_char_name']);
                            $tpl->assign('ip', $r['a_ip']);
                            $tpl->assign('host', $r['a_host']);
                            $tpl->assign('date', $r['a_date']);
                            $tpl->assign('type', $r['a_type']);
                            $tpl->assign('action', $r['a_action']);
                        }
                    }
                    else
                        $msg->error('Database Error!');
                    
                    
                    
                    
                    $tpl->newBlock('oldlog');
                    $query = sprintf("SELECT * FROM %s.t_adminactionlog WHERE a_gm = :gm ORDER BY a_time DESC", Config::DB_WEB);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':gm', $gmname, PDO::PARAM_STR);

                    if(!$dbh->execute())
                        print_r($dbh->errorInfo());

                    $result = $dbh->fetchAll();

                    foreach($result as $row)
                    {
                        $tpl->newBlock('logrow');
                        $tpl->assign('ip', $row['a_ip']);
                        $tpl->assign('host', $row['a_hostname']);
                        $tpl->assign('date', date('l, d F Y - H:i:s' , $row['a_time']));
                        $tpl->assign('action', nl2br($row['a_action']));
                    }                    
                    
                    
                    $tpl->newBlock('banlog');
                    $query = sprintf
                    ("
                        SELECT
                            l.a_user_index,
                            u.user_id,
                            from_unixtime(l.a_timestamp) as a_date,
                            a_reason,
                            a_action,
                            a_bantime,
                            a_gmreason
                        FROM
                            %s.t_banlist l,
                            %s.bg_user u

                        WHERE
                            l.a_admin_name = :gm

                        AND
                            u.user_code = l.a_user_index
                            
                    ", Config::DB_WEB, Config::DB_USER);
                    
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':gm', $gmname, PDO::PARAM_STR);
                    
                    $dbh->execute();
                    
                    $result = $dbh->fetchAll();
                    foreach($result as $r)
                    {
                        $tpl->newBlock('banlist');
                        $tpl->assign('user', '<a href="user.php?uid='.$r['a_user_index'].'">'.$r['user_id'].'</a>');
                        $tpl->assign('date', $r['a_date']);
                        $tpl->assign('reason', $r['a_reason']);
                        $tpl->assign('gmreason', $r['a_gmreason']);
                        $tpl->assign('bantime', $r['a_bantime']);
                        
                        
                        if($r['a_action'] == 'BAN')
                        {
                            $tpl->assign('action', '<span style="color:red; font-weight:bold;">'. $r['a_action'] . '</span>');
                            $tpl->assign('bgcolor', '#F1E4E4');
                        }
                        else
                        {
                            $tpl->assign('action', '<span style="color:green; font-weight:bold;">' . $r['a_action'] . '</span>');
                            $tpl->assign('bgcolor', '#E7F1E4');
                        }                        
                        
                        
                    }
                    
                    

                }
                else
                    $msg->error('No GM Known with this id');
            }

        }

        $tpl->printToScreen();
        
        echo '<br /><br /><br /><a href="gmlog.php?aid=' . $_GET['aid'] . '" class="menulink">Refresh</a>';
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

