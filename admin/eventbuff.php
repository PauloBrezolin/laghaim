<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/functions/eventbuff.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        $query = sprintf("SELECT * FROM %s.t_gm_buff_v2 ORDER BY a_zone", Config::DB_CHAR);
        $dbh = $db->query($query);
        while($r = $dbh->fetch())
        {
            $tpl->newBlock('list');
            $tpl->assign('world', GetZoneName($r['a_zone']));
            $tpl->assign('date', $r['a_date']);
            
            ($r['a_drop'] == 0) ? $tpl->assign('drop', '-') : $tpl->assign('drop', 'X');
            ($r['a_att'] == 0)  ? $tpl->assign('att', '-')  : $tpl->assign('att', 'X');
            ($r['a_def'] == 0)  ? $tpl->assign('def', '-')  : $tpl->assign('def', 'X');
            ($r['a_hp'] == 0)   ? $tpl->assign('hp', '-')   : $tpl->assign('hp', 'X');
            ($r['a_exp'] == 0)  ? $tpl->assign('exp', '-')  : $tpl->assign('exp', 'X');
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

