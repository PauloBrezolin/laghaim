<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/search/donations.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_ISADMIN))
        {
            $donateChartLabel = array();    
            $donateChartData = array();
            
            $query = sprintf("SELECT UNIX_TIMESTAMP(DATE(FROM_UNIXTIME(a_timestamp))) as date, SUM(a_points) FROM %s.t_donate_log WHERE a_points > 0 AND (a_gm = 'Paymentwall' OR a_gm = 'BETAGAMECARD') GROUP BY DATE(FROM_UNIXTIME(a_timestamp)) ORDER BY date DESC LIMIT 31 ", Config::DB_WEB);
            $dbh = $db->query($query);

            while($r = $dbh->fetch())
            {
                $donateChartLabel[] = date('D j M', $r[0]);
                $donateChartData[] = round($r[1] / 4000, 0);
            }
            
            $tpl->assignGlobal('chartlabel', json_encode(array_reverse($donateChartLabel)));
            $tpl->assignGlobal('chartdata', json_encode(array_reverse($donateChartData)));   
            
        }
        
        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    

