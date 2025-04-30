<?php

    session_start();
    $bn = basename(__FILE__); 
    
    
    require_once 'inc/templatepower.php';

    
    
    $tpl = new TemplatePower('tpl/pages/guild/guildinfo.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_guild.php';
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $guild = new Guild();

            if($guild->isGuild($_GET['gid']))
            {
                $query = sprintf("SELECT * FROM %s.t_guild_2007 WHERE a_index = :gid", Config::DB_CHAR);
                $dbh = $db->prepare($query);
                
                $dbh->bindParam(':gid', $guild->id, PDO::PARAM_INT);
                
                if($dbh->execute())
                {
                    $r = $dbh->fetch();
                    
                    $tpl->newBlock('guildinfo');
                    $tpl->assign('id', $r['a_index']);
                    $tpl->assign('name', $r['a_name']);
                    $tpl->assign('level', $r['a_level']);
                    $tpl->assign('enable', $r['a_enable']);
                    $tpl->assign('createdate', $r['a_date']);
                    $tpl->assign('balance', AddDots($r['a_points']));
                    $tpl->assign('leader', $r['a_master']);
                    $tpl->assign('grade1', $r['a_grade1']);
                    $tpl->assign('grade2', $r['a_grade2']);
                    $tpl->assign('grade3', $r['a_grade3']);
                    $tpl->assign('grade4', $r['a_grade4']);
                    $tpl->assign('grade5', $r['a_grade5']);
                    $tpl->assign('grade6', $r['a_grade6']);
                    $tpl->assign('grade7', $r['a_grade7']);
                    $tpl->assign('grade8', $r['a_grade8']);
                    $tpl->assign('notice', $r['a_notice']);
                    
                }
                else
                    $msg->error('Database Error');
                
            }
            else
                $msg->error('No Guild found with this id');
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>
  
