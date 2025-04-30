<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/search/ipban.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_IPBAN))
        {
            

            $tpl->newBlock('banform');

            if(isset($_POST['action']) && $_POST['action'] == 'ipban')
            {
                $query = sprintf("INSERT INTO %s.t_block_ip(a_ip, a_story, a_gm, a_date) VALUES(:ip, :reason, :gm, NOW());", Config::DB_USER);
                $dbh = $db->prepare($query);

                $dbh->bindParam(':ip', $_POST['ip'], PDO::PARAM_STR, 50);
                $dbh->bindParam(':reason', $_POST['reason'], PDO::PARAM_STR, 255);
                $dbh->bindParam(':gm', $admin->name, PDO::PARAM_STR, 255);

                if(!$dbh->execute())
                    $msg->error("Error adding ipban to database");
            }

            if(isset($_GET['del']) && ctype_digit($_GET['del']) && $admin->Can(RIGHT_IPUNBAN))
            {
                $query = sprintf("DELETE FROM %s.t_block_ip WHERE a_ip = :ip", Config::DB_DB);
                $dbh = $db->prepare($query);

                $dbh->bindParam(':id', $_GET['del'], PDO::PARAM_INT);

                $dbh->execute();
            }
                
            
            
            $query = sprintf("SELECT * FROM %s.t_block_ip ORDER BY a_date DESC", Config::DB_USER);
            $dbh = $db->prepare($query);
            if($dbh->execute())
            {
                $tpl->newBlock('ipblock');
                
                $result = $dbh->fetchAll();
                
                foreach($result as $r)
                {

                    $tpl->newBlock('list');
                    $tpl->assign('ip', $r['a_ip']);
                    $tpl->assign('reason', $r['a_story']);
                    $tpl->assign('date', $r['a_date']);
                    $tpl->assign('gm', $r['a_gm']);
                    
                    if($admin->Can(RIGHT_IPUNBAN))
                        $tpl->assign('delete', '<a href="ipban.php?del=' . $r['a_ip'] . '" class="menulink"><img src="tpl/img/delete.png" /></a>');
                }
            }
            
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

