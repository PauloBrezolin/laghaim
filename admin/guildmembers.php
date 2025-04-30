<?php

    session_start();
    $bn = basename(__FILE__); 
    
    
    require_once 'inc/templatepower.php';

    
    
    $tpl = new TemplatePower('tpl/pages/guild/guildmembers.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_guild.php';
    
    $guildPos = array('Guild Leader', 'Guild Advisor', 'Member', '3', '4', '5', '6', '7', '8');
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $guild = new Guild();

            if($guild->isGuild($_GET['gid']))
            {
                $query = sprintf
                ("
                    SELECT
                        c.a_index,
                        g.ugame_user_code as a_user_index,
                        c.a_name,
                        c.a_level,
                        c.a_race,
                        c.a_sex,
                        c.a_enable,
                        m.a_jointype,
                        FROM_UNIXTIME(m.a_jointime) as a_jointime

                    FROM
                        %s.t_guild_member m
                        LEFT JOIN %s.t_characters c on m.a_index = c.a_index
                        LEFT JOIN %s.bg_user_game g on g.ugame_index = c.a_user_index

                    WHERE
                        m.a_guildindex = :gid
                        
                    ORDER BY a_jointype, a_name
                        
                ", Config::DB_CHAR, Config::DB_CHAR, Config::DB_USER);
                
                $dbh = $db->prepare($query);
                
                $dbh->bindParam(':gid', $guild->id, PDO::PARAM_INT);
                
                if($dbh->execute())
                {
                    $tpl->newBlock('guildmember');
                    
                    $result = $dbh->fetchAll();
                    
                    foreach($result as $r)
                    {
                        $tpl->newBlock('list');
                        
                        if($r['a_enable'] == 1)
                            $tpl->assign('name', $r['a_name']);
                        else
                            $tpl->assign('name', '<strike>' . $r['a_name'] . '</strike>');
                        
                        $tpl->assign('url', 'user.php?uid='. $r['a_user_index'] .'&cid='. $r['a_index']);
                        $tpl->assign('level', $r['a_level']);
                        $tpl->assign('class', cj($r['a_race'], $r['a_sex']));
                        $tpl->assign('position', $guildPos[$r['a_jointype']]);
                        $tpl->assign('regdate', $r['a_jointime']);
                    }
                }
                else
                    print_r($dbh->errorInfo());
                
                
                
                
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
 
