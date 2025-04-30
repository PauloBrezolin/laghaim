<?php

    session_start();
    $bn = basename(__FILE__); 
    
    
    require_once 'inc/templatepower.php';

    
    
    $tpl = new TemplatePower('tpl/pages/guild/guildstorage.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_guild.php';
    require_once 'data/itemnames.php';
    require_once 'data/sealdata2.php';
    require_once 'data/rareoption.php';
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $guild = new Guild();

            if($guild->isGuild($_GET['gid']))
            {
                
                if(isset($_GET['action']) && $_GET['action'] == 'delitem' && $admin->Can(RIGHT_DELETEINVENTORY))
                {
                    $log->DeleteGuildItem($guild->id, $_GET['slot']);
                    $guild->delItem($_GET['slot']);                       
                }                
                
                
                $query = sprintf("SELECT g.a_plus, g.a_count, i.a_name, g.a_item_vnum, g.a_ext_flag, g.a_serial, g.a_slot FROM %s.t_guild_stash g, %s.t_item i WHERE g.a_guild_index = :gid AND g.a_item_vnum > 0 AND i.a_index = g.a_item_vnum", Config::DB_CHAR, Config::DB_DATA);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':gid', $guild->id, PDO::PARAM_INT);
                
                if($dbh->execute())
                {
                    $tpl->newBlock('guildstorage');
                    $result = $dbh->fetchAll();
                    
                    foreach($result as $r)
                    {
                        $tpl->newBlock('list');
                        
                        $id = $r['a_item_vnum'];
                        
                        $tpl->assign('id', $id);
                        $tpl->assign('icon', 'data/icons/' . $id . '.jpg');
                        $tpl->assign('name', $r['a_name']);
                        $tpl->assign('plus', $r['a_plus']);
                        $tpl->assign('amount', AddDots($r['a_count']));
                        $tpl->assign('serial', $r['a_serial']);
                        
                        $ext = explode(' ', trim($r['a_ext_flag']));
                        if(count($ext) > 1)
                        {
                            $tpl->assign('dura1', $ext[0]);
                            $tpl->assign('dura2', $ext[1]);
                            $tpl->assign('settime', $ext[2]);
                            $tpl->assign('timestamp', $ext[3]);
                            $tpl->assign('paytype', $ext[4]);
                        }
                        
                        if($admin->Can(RIGHT_DELETEINVENTORY))
                            $tpl->assign('delete', 'guildstorage.php?gid='.$guild->id.'&action=delitem&slot=' . $r['a_slot']);
                        
                    }
                }
                else
                    $msg->error('Database error');
                
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
  
