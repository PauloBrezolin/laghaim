<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/functions/droplist.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_DOGIVEITEM))
        {
            if(isset($_POST['action']))
            {
                if($_POST['action'] == 'additem')
                {
                    
                }
                
                else if($_POST['action'] == 'delitem')
                {
                    /*
                    if(isset($_GET['id']) && ctype_digit($_GET['id']))
                    {
                        $dbh = $db->prepare(sprintf("DELETE FROM %s.t_generic_drop WHERE a_index = :id", Config::DB_DATA));
                        $dbh->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                        $dbh->execute();
                        
                        $msg->error('Don\'t forget to reload the droplist ingame with command \\\\gm_genericdropinit');
                    }
                     * 
                     */
                }
            }
        }        
        
        
        $query = sprintf
        ("
            SELECT 
                d.a_index as a_dropidx,
                d.a_npc_index,
                n.a_name as a_npc_name,
                d.a_itemindex,
                i.a_name as a_itemname,
                d.a_itemcount,
                d.a_itemrate,
                d.a_itemplus,
                d.a_item_addflag

            FROM 
                %s.t_generic_drop d,
                %s.t_npc n,
                %s.t_item i

            WHERE
                n.a_index = d.a_npc_index

            AND
                i.a_index = d.a_itemindex"
                
        , Config::DB_DATA, Config::DB_DATA, Config::DB_DATA);
        
        $dbh = $db->prepare($query);
        $dbh->execute();
        
        while($r = $dbh->fetch())
        {
            $tpl->newBlock('list');
            $tpl->assign('npc_idx', $r['a_npc_index']);
            $tpl->assign('npc_name', $r['a_npc_name']);
            $tpl->assign('item_idx', $r['a_itemindex']);
            $tpl->assign('item_name', $r['a_itemname']);
            $tpl->assign('item_num', $r['a_itemcount']);
            $tpl->assign('item_rate', $r['a_itemrate']);
            $tpl->assign('item_plus', $r['a_itemplus']);
            $tpl->assign('item_addflag', $r['a_item_addflag']);
            
            if($admin->Can(RIGHT_DOGIVEITEM))
                $tpl->assign('delete', '<a href="droplist.php?action=delitem&id=' . $r['a_dropidx'] . '" class="menulink"><img src="tpl/img/delete.png" /></a>');            
        }
        

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>
