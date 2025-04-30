<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/functions/stafflist.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        
        $query = sprintf
        ("
            SELECT
                c.a_index,
                c.a_name, 
                c.a_datestamp as a_end_date, 
                c.a_admin,
                u.a_connect
            FROM
        	%s.t_characters c,
                %s.t_users u

            WHERE c.a_admin > 0
            AND c.a_enable = 1                
            AND u.a_index = c.a_user_index                          
            AND u.a_enable = 1
            AND u.a_index != 1
            ORDER BY 
                c.a_admin DESC, 
                c.a_name        
                
        ", Config::DB_CHAR, Config::DB_USER);
        
        $dbh = $db->prepare($query);
        $dbh->execute();
        
        $result = $dbh->fetchAll();
        
        $lastlevel = 10;
        
        foreach($result as $row)
        {
            $tpl->newBlock('names');
            
            $lastlevel = $row['a_admin'];
            
            
            $tpl->assign('name', $row['a_name']);
            $tpl->assign('rawdate', $row['a_end_date'] );
            
            
            if($row['a_connect'] == -1)
                $tpl->assign('date', TimeAgo( strtotime( $row['a_end_date']), time()) );                
            else
                $tpl->assign('date', 'Online right now in world ' . GetZoneName($row['a_connect']));
            
            
            $admlvl = $row['a_admin'];
	    if($admlvl > 0)
            {
                $rank = 'GameMaster';
                $namecol = '#D4FA89';
            }
            else
            {
                $rank = 'GameSage';
                $namecol = '#89FAE5';
            }
            
            $tpl->assign('rank', $rank);
            $tpl->assign('namecol', '#000000');
            
            $betw = time() - strtotime( $row['a_end_date']);
            
            $threeday = 60*60*24*3;
            $oneweek = 60*60*24*7;
            
            if($betw < $threeday)
                $col = '#007700';
            else
            {
                if($betw > $oneweek)
                    $col = '#ff0000';
                else
                    $col = 'orange';
            }
            
            $tpl->assign('color', $col);
            
            
        }        
        
        

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

