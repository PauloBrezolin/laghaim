<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/search/onlineplayers.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_VIEWONLINEPLAYERS))
        {
            
            // Total players online every hour
            $query = sprintf("SELECT * FROM %s.t_onlinecount ORDER BY a_timestamp DESC LIMIT 48", Config::DB_WEB);
            $dbh = $db->query($query);
            
            $chart_dates = array();
            $chart_total = array();
            
            while($r = $dbh->fetch())
            {
                $chart_dates[] = date('H:i', $r['a_timestamp']);
                $chart_total[] = intval($r['a_total']);
            }
            
            $tpl->newBlock('chart');
            $tpl->assign('date_json', json_encode($chart_dates));
            $tpl->assign('total_json', json_encode($chart_total));
           
            
            $stats_jobs_names = array('Bulkan', 'Kailipton', 'Aidia', 'Human', 'Hibrider', 'Perom');
            $stats_jobs = array(0,0,0,0,0,0);
            
            
            $total = 0;
            $chan1 = 0;
            $chan2 = 0;
            
            $tpl->newBlock('channel1');
            $query = sprintf
            ("
                SELECT
                    u.a_2p4p_user_code,
                    u.a_2p4p_user_id,
                    u.a_connect,
                    u.a_sub_num,
                    c.a_name,
                    c.a_index,
                    c.a_level,
                    c.a_race,
                    c.a_datestamp						

                FROM
                    %s.t_users u,
                    %s.t_characters c

                WHERE
                    a_connect != -1
                    
                AND c.a_user_index = u.a_index
                
                AND u.a_sub_num = 660

                ORDER BY 
                    a_connect,
                    a_2p4p_user_code,
                    c.a_datestamp DESC

            ", Config::DB_USER,
               Config::DB_CHAR);

            $dbh = $db->query($query);
            
            $curZone = -1;
            $lastuser = -1;
            
            while($r = $dbh->fetch())
            {
                
                if($lastuser == $r['a_2p4p_user_code'])
                    continue;
                
                $lastuser = $r['a_2p4p_user_code'];                
                
                if($r['a_connect'] != $curZone)
                {
                    $tpl->newBlock('zone');
                    $tpl->assign('zone', GetZoneName($r['a_connect']));
                    $curZone = $r['a_connect'];
                }

                $tpl->newBlock('char');
                
                $tpl->assign('channel', 'Ch' . (($r['a_sub_num'] % 2) + 1));
                
                $tpl->assign('id', $r['a_index']);
                $tpl->assign('name', $r['a_name']);
                $tpl->assign('level', $r['a_level']);
                $tpl->assign('class', cj($r['a_race'], 0));
                $tpl->assign('url', 'user.php?uid='.$r['a_2p4p_user_code'].'&cid=' . $r['a_index']);
                
                $stats_jobs[$r['a_race']]++;
                        
                if(strstr($r['a_name'], '['))
                    $tpl->assign('color', ' background-color:#fed1d1; ');
                
                $total++;
                $chan1++;

            }
            
            
            
            $tpl->newBlock('channel2');
            $query = sprintf
            ("
                SELECT
                    u.a_2p4p_user_code,
                    u.a_2p4p_user_id,
                    u.a_connect,
                    u.a_sub_num,
                    c.a_name,
                    c.a_index,
                    c.a_level,
                    c.a_race,
                    c.a_datestamp						

                FROM
                    %s.t_users u,
                    %s.t_characters c

                WHERE
                    a_connect != -1
                    
                AND c.a_user_index = u.a_index
                
                AND u.a_sub_num = 661

                ORDER BY 
                    a_connect,
                    a_2p4p_user_code,
                    c.a_datestamp DESC

            ", Config::DB_USER,
               Config::DB_CHAR);

            $dbh = $db->query($query);
            
            $curZone = -1;
            $lastuser = -1;
            
            while($r = $dbh->fetch())
            {
                
                if($lastuser == $r['a_2p4p_user_code'])
                    continue;
                
                $lastuser = $r['a_2p4p_user_code'];                
                
                if($r['a_connect'] != $curZone)
                {
                    $tpl->newBlock('zone2');
                    $tpl->assign('zone', GetZoneName($r['a_connect']));
                    $curZone = $r['a_connect'];
                }

                $tpl->newBlock('char2');
                
                $tpl->assign('channel', 'Ch' . (($r['a_sub_num'] % 2) + 1));
                
                $tpl->assign('id', $r['a_index']);
                $tpl->assign('name', $r['a_name']);
                $tpl->assign('level', $r['a_level']);
                $tpl->assign('class', cj($r['a_race'], 0));
                $tpl->assign('url', 'user.php?uid='.$r['a_2p4p_user_code'].'&cid=' . $r['a_index']);
                
                $stats_jobs[$r['a_race']]++;
                
                if(strstr($r['a_name'], '['))
                    $tpl->assign('color', ' background-color:#fed1d1; ');
                
                $total++;
                $chan2++;

            }
            
            
            $tpl->assignGlobal('total', $total);
            $tpl->assignGlobal('chan1', $chan1);
            $tpl->assignGlobal('chan2', $chan2);

        }


        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>
