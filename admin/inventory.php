<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';
    require_once 'data/itemnames.php';
    require_once 'data/rareoption.php';
    require_once 'data/sealdata2.php';
    
    $tpl = new TemplatePower('tpl/pages/character/inventory.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');  
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    require_once 'class/class_inventory.php';
    require_once 'data/itemnames.php';
    
    $popnum = 1;

    $paytype = array('None', '', '', '', 'Laim', 'BP', 'Cash', 'LP');
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $user = new User();
            $char = new Character();
            $inven = new Inventory();

            if($char->isChar($_GET['cid']) && $user->isCUser($char->uid))
            {
                $first = substr($char->id, -1);
                
                if(isset($_GET['action']) && $_GET['action'] == 'edititem' && isset($_GET['slot']) && isset($_GET['wearing']))
                {
                    $query = sprintf("SELECT * FROM %s.t_inven0%d WHERE a_char_idx = :cid AND a_wearing = :wearing AND a_slot = :slot", Config::DB_CHAR, $first);
                    if($_GET['type'] == 'event')
                        $query = sprintf("SELECT * FROM %s.t_event_wear0%d WHERE a_char_idx = :cid AND a_wearing = :wearing AND a_slot = :slot", Config::DB_CHAR, $first);
                    
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);
                    $dbh->bindParam(':wearing', $_GET['wearing']);
                    $dbh->bindParam(':slot', $_GET['slot']);
                    $dbh->execute();
                    
                    $r = $dbh->fetch();
                    if($r != null)
                    {
                        $tpl->newBlock('edititem');
                        $id = $r['a_item_idx'];

                        $tpl->assign('id', $id);
                        $tpl->assign('type', $_GET['type']);                        
                        $tpl->assign('name', $item[$id]['name']);
                        $tpl->assign('plus', $r['a_plus_point']);
                        $tpl->assign('flag', $r['a_flag']);
                        $tpl->assign('flag2', $r['a_flag2']);
                        
                        $ext = explode(' ', trim($r['a_ext_flag']));
                        if(count($ext) > 1)
                        {
                            $tpl->assign('dura1', $ext[0]);
                            $tpl->assign('dura2', $ext[1]);
                            $tpl->assign('settime', $ext[2]);
                            $tpl->assign('timestamp', $ext[3]);
                            $tpl->assign('paytype', $ext[4]);
                        }
                        
                        $tpl->assign('slot', $_GET['slot']);
                        $tpl->assign('wearing', $_GET['wearing']);
                    }
                    else
                        $msg->error('Item not found');                   
                }
                else
                {
                    
                    if(isset($_GET['action']) && $_GET['action'] == 'delitem' && $admin->Can(RIGHT_DELETEINVENTORY))
                    {
                        $log->DeleteItem($char, $_GET['slot']);
                        $inven->Delete($char->id, $_GET['slot'], $_GET['wearing'], $_GET['type']);                          
                    }
                    
                    if(isset($_POST['action']) && $_POST['action'] == 'saveitem' && $admin->Can(RIGHT_DELETEINVENTORY))
                    {
                        
                        $ext = '';
                        
                        if(isset($_POST['dura1']) && strlen($_POST['dura1']) > 0 && is_numeric($_POST['dura1']))
                        {
                            $ext .= $_POST['dura1'];
                            
                            if(isset($_POST['dura2']) && strlen($_POST['dura2']) > 0 && is_numeric($_POST['dura2']))
                            {
                                $ext .= ' ' . $_POST['dura2'];
                                
                                if(isset($_POST['settime']) && strlen($_POST['settime']) > 0 && is_numeric($_POST['settime']))
                                {
                                    $ext .= ' ' . $_POST['settime'];
                                    
                                    if(isset($_POST['timestamp']) && strlen($_POST['timestamp']) > 0 && is_numeric($_POST['timestamp']))
                                    {
                                        $ext .= ' ' . $_POST['timestamp'];
                                        
                                        if(isset($_POST['paytype']) && strlen($_POST['paytype']) > 0 && is_numeric($_POST['paytype']))
                                        {
                                            $ext .= ' ' . $_POST['paytype'];
                                        }
                                        else $ext .= ' 0';
                                    }
                                    else $ext .= ' 0';
                                }
                                else $ext .= ' 0';
                            }
                            else $ext .= ' 0';
                        }
                        else $ext = '0';
                        
                        
                        if($_POST['type'] == 'event')
                            $database = 't_event_wear0' . $first;
                        else
                            $database = 't_inven0' . $first;
                        
                        $query = sprintf
                        ("
                            UPDATE %s.%s 
                            SET
                                a_plus_point = :plus,
                                a_flag = :flag,
                                a_flag2 = :flag2,
                                a_ext_flag = :ext
                             WHERE a_char_idx = :cid 
                             AND a_wearing = :wearing 
                             AND a_slot = :slot"
                        , Config::DB_CHAR,
                          $database);
                        
                        $dbh = $db->prepare($query);
                        $dbh->bindParam(':plus', $_POST['plus']);
                        $dbh->bindParam(':flag', $_POST['flag']);
                        $dbh->bindParam(':flag2', $_POST['flag2']);
                        $dbh->bindParam(':ext', $ext);
                        $dbh->bindParam(':cid', $char->id);
                        $dbh->bindParam(':wearing', $_POST['wearing']);
                        $dbh->bindParam(':slot', $_POST['slot']);
                        
                        $dbh->execute();
                        
                    }
                    
                    
                
                    $tpl->newBlock('inventory');
                    
                    $first = substr($char->id, -1);
                    
                    $query = sprintf("SELECT inv.*, i.a_name, i.a_type_idx, i.a_shape_idx FROM %s.t_inven0%d inv, %s.t_item i WHERE a_char_idx = :cid AND inv.a_item_idx = i.a_index", Config::DB_CHAR, $first, Config::DB_DATA);

                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);

                    if($dbh->execute())
                    {

                        $result = $dbh->fetchAll();
                        foreach($result as $r)
                        {

                            $id = $r['a_item_idx'];

                            $tpl->newBlock('items');
                            $tpl->assign('id', $id);
                            $tpl->assign('icon', 'data/icons/' . $id . '.jpg');
                            //$tpl->assign('icon', $item[$id]['icon']);
                            $tpl->assign('name', $r['a_name']);
                            $tpl->assign('num', count(explode(' ', $r['a_serial1'])));
                            $tpl->assign('plus', $r['a_plus_point']);
                            $tpl->assign('serial', $r['a_serial1']);
                            $tpl->assign('popnum', 'pop' . $popnum++);
                            
                            $ext = explode(' ', trim($r['a_ext_flag']));
                            if(count($ext) > 1)
                            {
                                $tpl->assign('dura1', $ext[0]);
                                $tpl->assign('dura2', $ext[1]);
                                $tpl->assign('settime', $ext[2]);
                                $tpl->assign('timestamp', $ext[3]);
                                $tpl->assign('paytype', $paytype[$ext[4]]);
                            }
                            
                            $tpl->assign('ext', $r['a_ext_flag']);
                            $tpl->assign('flag', $r['a_flag'] & 0xffffffff);
                            $tpl->assign('flag2', $r['a_flag2'] & 0xffffffff);
                            
                            
                            if($r['a_plus_point'] > 0)
                                $tpl->assign('mplus', '+' . $r['a_plus_point']);
                            
                            $wearing = $r['a_wearing'];
                            if($wearing < 100)
                                $tpl->assign('wearing', 'Wearing');
                            elseif($wearing < 200)
                            {
                                if($wearing == 103)
                                    $tpl->assign('wearing', 'Trade');
                                else
                                    $tpl->assign('wearing', 'Inven' . ($wearing - 99));
                            }
                            elseif($wearing < 220)
                                $tpl->assign('wearing', 'QuickSlot'. ($wearing - 199));
                            else
                                $tpl->assign('wearing', 'Extra');

                            if($admin->Can(RIGHT_DELETEINVENTORY))
                            {
                                $tpl->assign('delete', '<a href="inventory.php?cid='. $char->id .'&action=delitem&slot='.$r['a_slot'].'&wearing='.$r['a_wearing'].'&type=inven" class="menulink"><img src="tpl/img/delete.png" /></a>');
                                $tpl->assign('edit', '<a href="inventory.php?cid='. $char->id .'&action=edititem&slot='.$r['a_slot'].'&wearing='.$r['a_wearing'].'&type=inven" class="menulink"><img src="tpl/img/edit.png" /></a>');
                            }
                            
                            if($r['a_flag'] != 0 || $r['a_flag2'] != 0)
                            {
                                $descr = $inven->GetDescr($id, $r['a_flag'], $r['a_flag2'], $r['a_type_idx'], $r['a_shape_idx']);
                                if(count($descr) > 0)
                                {
                                    $tpl->newBlock('options');
                                    for($i=0; $i<count($descr); $i++)
                                    {
                                        $tpl->newBlock('optlist');
                                        $tpl->assign('line', $descr[$i]);
                                    }
                                }
                            }
                            

                        }
                    }
                    else
                        $msg->error('Error!'); 
                    
                    
                    
                    $query = sprintf("SELECT inv.*, i.a_name FROM %s.t_event_wear0%d inv, %s.t_item i WHERE a_char_idx = :cid AND inv.a_item_idx = i.a_index", Config::DB_CHAR, $first, Config::DB_DATA);

                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);

                    if($dbh->execute())
                    {

                        $result = $dbh->fetchAll();
                        foreach($result as $r)
                        {

                            $id = $r['a_item_idx'];

                            $tpl->newBlock('items2');
                            $tpl->assign('id', $id);
                            $tpl->assign('icon', 'data/icons/' . $id . '.jpg');
                            //$tpl->assign('icon', $item[$id]['icon']);
                            $tpl->assign('name', $r['a_name']);
                            $tpl->assign('num', count(explode(' ', $r['a_serial1'])));
                            $tpl->assign('plus', $r['a_plus_point']);
                            $tpl->assign('serial', $r['a_serial1']);
                            
                            $wearing = $r['a_wearing'];
                            if($wearing < 100)
                                $tpl->assign('wearing', 'Wearing');
                            elseif($wearing < 200)
                            {
                                if($wearing == 103)
                                    $tpl->assign('wearing', 'Trade');
                                else
                                    $tpl->assign('wearing', 'Inven' . ($wearing - 99));
                            }
                            elseif($wearing < 220)
                                $tpl->assign('wearing', 'QuickSlot'. ($wearing - 199));
                            else
                                $tpl->assign('wearing', 'Extra');

                            if($admin->Can(RIGHT_DELETEINVENTORY))
                            {
                                $tpl->assign('delete', '<a href="inventory.php?cid='. $char->id .'&action=delitem&slot='.$r['a_slot'].'&wearing='.$r['a_wearing'].'&type=event" class="menulink"><img src="tpl/img/delete.png" /></a>');
                                $tpl->assign('edit', '<a href="inventory.php?cid='. $char->id .'&action=edititem&slot='.$r['a_slot'].'&wearing='.$r['a_wearing'].'&type=event" class="menulink"><img src="tpl/img/edit.png" /></a>');
                            }

                            
                            $ext = explode(' ', trim($r['a_ext_flag']));
                            if(count($ext) > 1)
                            {
                                $tpl->assign('dura1', $ext[0]);
                                $tpl->assign('dura2', $ext[1]);
                                $tpl->assign('settime', $ext[2]);
                                $tpl->assign('timestamp', $ext[3]);
                                $tpl->assign('paytype', $paytype[$ext[4]]);
                            }
                            
                            $tpl->assign('ext', $r['a_ext_flag']);
                            $tpl->assign('flag', $r['a_flag'] & 0xffffffff);
                            $tpl->assign('flag2', $r['a_flag2'] & 0xffffffff);
                            
                            
                            if($r['a_plus_point'] > 0)
                                $tpl->assign('mplus', '+' . $r['a_plus_point']);                            
                            
                            $tpl->assign('popnum', 'pop' . $popnum++);
                            if($r['a_flag2'] != 0)
                            {
                                $descr = $inven->GetSpecialDescr($r['a_flag2']);
                                if(count($descr) > 0)
                                {
                                    $tpl->newBlock('options2');
                                    for($i=0; $i<count($descr); $i++)
                                    {
                                        $tpl->newBlock('optlist2');
                                        $tpl->assign('line', $descr[$i]);
                                    }
                                }
                            }                            

                        }
                    }
                    else
                        $msg->error('Error!'); 
                    
                }
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
  

