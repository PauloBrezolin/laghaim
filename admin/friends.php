<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/character/friends.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    require_once 'data/itemnames.php';
    
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $user = new User();
            $char = new Character();

            if($char->isChar($_GET['cid']) && $user->isCUser($char->uid))
            {

                $query = sprintf
                ("
                    SELECT 
                        c.a_index,
                        c.a_name,
                        c.a_level,
                        c.a_race,
                        u.a_2p4p_user_code,
                        u.a_connect
                    FROM 
                        %s.t_friend f,
                        %s.t_characters c,
                        %s.t_users u

                    WHERE a_char_idx = :cid
                    AND c.a_index = f.a_fchar_idx
                    AND u.a_index = c.a_user_index
                        
                ", Config::DB_CHAR, 
                   Config::DB_CHAR, 
                   Config::DB_USER);
                
                $dbh = $db->prepare($query);
                $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);

                $dbh->execute();
                while($r = $dbh->fetch())
                {
                    $tpl->newBlock('list');
                    $tpl->assign('name', $r['a_name']);
                    $tpl->assign('url', 'user.php?uid='. $r['a_2p4p_user_code'] . '&cid=' . $r['a_index']);
                    $tpl->assign('level', $r['a_level']);
                    $tpl->assign('race', cj($r['a_race']));
                    
                    $tpl->assign('status', 'tpl/img/offline.png');
                    if($r['a_connect'] != -1)
                        $tpl->assign('status', 'tpl/img/online.png');                   
                }
                
            }
            else
                $msg->error('No Character found with this id');
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

