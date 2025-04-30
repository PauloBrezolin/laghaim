<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/functions/bossresult.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        $query = sprintf("SELECT c.a_index, c.a_name, c.a_level, c.a_race, b.a_attack_point, b.a_roomin_time, b.a_insert_time, u.a_2p4p_user_code
                          FROM %s.t_last_boss_result b, %s.t_characters c, %s.t_users u
                          WHERE c.a_index = b.a_char_index
                          AND u.a_index = c.a_user_index
                          ORDER BY a_insert_time DESC, a_attack_point DESC", 
                Config::DB_CHAR,
                Config::DB_CHAR,
                Config::DB_USER);
        $dbh = $db->query($query);
        
        $inserttime = '';
        while($r = $dbh->fetch())
        {
            $tpl->newBlock('list');
            if($inserttime != $r['a_insert_time'])
            {
                $tpl->newBlock('row');
                $tpl->assign('date', $r['a_insert_time']);
                $inserttime = $r['a_insert_time'];
            }
            
            $tpl->assign('name', $r['a_name']);
            $tpl->assign('url', 'user.php?uid='. $r['a_2p4p_user_code'] .'&cid='. $r['a_index']);
            $tpl->assign('level', $r['a_level']);
            $tpl->assign('race', cj($r['a_race']));
            $tpl->assign('point', $r['a_attack_point']);
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

