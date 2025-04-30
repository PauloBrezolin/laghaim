<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/character/guilds.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $user = new User();
            $char = new Character();

            if($char->isChar($_GET['cid']) && $user->isCUser($char->uid))
            {

                $guildPos = array('Guild Leader', 'Guild Advisor', 'Member');

                $query = sprintf
                ("
                    SELECT 
                        m.a_jointype as a_pos,
                        m.a_jointime as a_regdate,
                        m.a_guildindex,
                        g.a_name,
                        g.a_enable


                    FROM 
                        %s.t_guild_member m 

                    LEFT JOIN %s.t_guild_2007 g ON g.a_index = m.a_guildindex

                    WHERE m.a_index = :cid

                    ORDER BY g.a_enable DESC

                ", Config::DB_CHAR, Config::DB_CHAR);

                $dbh = $db->prepare($query);
                $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);

                if($dbh->execute())
                {
                    $tpl->newBlock('guildlist');

                    $result = $dbh->fetchAll();

                    foreach($result as $r)
                    {
                        $tpl->newBlock('list');
                        $tpl->assign('id', $r['a_guildindex']);
                        
                        if($r['a_enable'] == 1)
                            $tpl->assign('name', $r['a_name']);
                        else
                            $tpl->assign('name', '<strike>' . $r['a_name'] . '</strike>');
                        
                        $tpl->assign('regdate', $r['a_regdate']);
                        $tpl->assign('url', 'guild.php?gid='. $r['a_guildindex']);
                        $tpl->assign('pos', $guildPos[$r['a_pos']]);

                    }
                }
                else
                    $msg->error('Database Error' . print_r($dbh->errorInfo()));
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
  
