<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/character/shop.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    require_once 'data/itemnames.php';
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $user = new User();
            $char = new Character();
            
            if($char->isChar($_GET['cid']) && $user->isCUser($char->uid))
            {
                if(isset($_GET['action']))
                {
                    if($_GET['action'] == 'deleteall')
                    {
                        $query = sprintf("SELECT a_index FROM %s.t_usershop WHERE a_char_idx = :cid", Config::DB_CHAR);
                        $dbh = $db->prepare($query);
                        $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);
                        $dbh->execute();

                        while($r = $dbh->fetch())
                        {
                            $query = sprintf("DELETE FROM %s.t_usershopitem WHERE a_shop_idx = :sid", Config::DB_CHAR);
                            $dbh = $db->prepare($query);
                            $dbh->bindParam(':sid', $r['a_index'], PDO::PARAM_INT);
                            $dbh->execute();                       
                        }

                        $query = sprintf("DELETE FROM %s.t_usershop WHERE a_char_idx = :cid", Config::DB_CHAR);
                        $dbh = $db->prepare($query);
                        $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);
                        $dbh->execute();                    
                    }

                    if($_GET['action'] == 'delitem' && ctype_digit($_GET['id']))
                    {
                        $query = sprintf("DELETE FROM %s.t_usershopitem WHERE a_index = :id", Config::DB_CHAR);
                        $dbh = $db->prepare($query);
                        $dbh->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                        $dbh->execute();                       
                    }
                }                
                
                $query = sprintf("SELECT * FROM %s.t_usershop WHERE a_char_idx = :cid", Config::DB_CHAR);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);
                $dbh->execute();
                $r = $dbh->fetch();
                if($r != null)
                {
                    
                    
                    $tpl->newBlock('shop');
                    $tpl->assign('id', $r['a_index']);
                    $tpl->assign('type', $r['a_type']);
                    $tpl->assign('subtype', $r['a_subtype']);
                    $tpl->assign('title', $r['a_title']);
                    $tpl->assign('world', GetZoneName($r['a_world']));
                    $tpl->assign('coord', $r['a_pos_x'] . ', ' . $r['a_pos_z']);
                    $tpl->assign('gold', $r['a_gold']);
                    $tpl->assign('silver', $r['a_silver']);
                    $tpl->assign('bronze', $r['a_bronze']);
                    $tpl->assign('laim', $r['a_laim']);
                    
                    switch($r['a_enable'])
                    {
                        case -2:
                            $tpl->assign('enable', 'Disabled');
                            break;
                        case -1:
                            $tpl->assign('enable', 'Items remaining');
                            break;
                        case 0:
                            $tpl->assign('enable', 'Enable');
                            break;
                        case 1:
                            $tpl->assign('enable', 'Open');
                            break;
                        case 2:
                            $tpl->assign('enable', 'Ready');
                            break;
                    }
                    
                    $query = sprintf("SELECT s.*, i.a_name FROM %s.t_usershopitem s, %s.t_item i WHERE s.a_shop_idx = :sid AND i.a_index = s.a_item_idx", Config::DB_CHAR, Config::DB_DATA);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':sid', $r['a_index'], PDO::PARAM_INT);
                    $dbh->execute();
                    while($r = $dbh->fetch())
                    {
                        $tpl->newBlock('items');
                        $tpl->assign('icon', 'data/icons/' . $r['a_item_idx'] . '.jpg');
                        $tpl->assign('id', $r['a_item_idx']);
                        $tpl->assign('name', $r['a_name']);
                        $tpl->assign('plus', $r['a_plus_point']);
                        $tpl->assign('gold', $r['a_gold']);
                        $tpl->assign('silver', $r['a_silver']);
                        $tpl->assign('bronze', $r['a_bronze']);
                        $tpl->assign('laim', $r['a_price']);                        
                        $tpl->assign('amount', $r['a_count']);
                        
                        $serial = $r['a_serial1'];
                        if(strlen($r['a_serial2']) > 0) $serial .= ' ' . $r['a_serial2'];
                        if(strlen($r['a_serial3']) > 0) $serial .= ' ' . $r['a_serial3'];
                        if(strlen($r['a_serial4']) > 0) $serial .= ' ' . $r['a_serial4'];
                        if(strlen($r['a_serial5']) > 0) $serial .= ' ' . $r['a_serial5'];
                        
                        $tpl->assign('serial', $serial);
                        $tpl->assign('deleteitem', 'shop.php?cid='. $char->id . '&action=delitem&id='. $r['a_index']);
                    }
                    
                }
                else
                    $msg->error('This character has no shop opened currently');
                
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

