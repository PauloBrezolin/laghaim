<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/functions/banlist.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    $pagelist = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');
    
    $p = '';
    if(isset($_GET['p']) && ctype_alnum($_GET['p']) && strlen($_GET['p']) == 1)
        $p = $_GET['p'];    
    
    if($admin->login)
    {
        
        $tpl->newBlock('pagelist');     
        foreach($pagelist as $page)
        {
            $tpl->newBlock('page');
            if($page == $p)
            {
                $tpl->assign('info', 'style="background-color:#3E79A5;"');
                $tpl->assign('p', '<b><a href="banlist.php?p='.$page.'" class="menulink">'. $page .'</a></b> ');
            }
            else
            {
               $tpl->assign('info', '');
                $tpl->assign('p', '<a href="banlist.php?p='.$page.'" class="menulink">'. $page .'</a> ');                
            }
        }
        
        $query = sprintf
        ("
            SELECT 
                    u.a_2p4p_user_id,
                    u.a_2p4p_user_code,
                    (SELECT concat(a_reason, '|', a_admin_name, '|', FROM_UNIXTIME(a_timestamp), '|', a_bantime, '|', a_gmreason) FROM %s.t_banlist l WHERE l.a_user_index = u.a_2p4p_user_code ORDER BY a_index DESC LIMIT 1) as a_reason
            FROM 
                    %s.t_users u

            WHERE
                    u.a_enable = 2

            AND
               LEFT(u.a_2p4p_user_id, 1) = :start 
               
            ORDER BY
                u.a_2p4p_user_id

         ", Config::DB_WEB, Config::DB_USER);
        
        $dbh = $db->prepare($query);
        
        
        $p = strtolower($p);
        $dbh->bindParam(':start', $p, PDO::PARAM_STR, 1);
        
        if(!$dbh->execute())
            print_r($dbh->errorInfo());
        
        $result = $dbh->fetchAll();
        
        $i = 0;
        foreach($result as $r)
        {
            $bv = explode('|', $r['a_reason']);
            $reason = $bv[0];
            $gmname = $bv[1];
            $date = $bv[2];
            $bantime = $bv[3];
            
            if(count($bv) == 5)
                $gmreason = $bv[4];
            
            $tpl->newBlock('list');
            $tpl->assign('username', $r['a_2p4p_user_id']);
            $tpl->assign('date', $date);
            $tpl->assign('gm', $gmname);
            $tpl->assign('bantime', $bantime . '&nbsp;');
            $tpl->assign('reason', $reason);
            $tpl->assign('gmreason', $gmreason);
            $tpl->assign('num', $i++);
            
        }
        
        
        
        
        

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

