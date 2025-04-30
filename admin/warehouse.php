<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';
    require_once 'data/itemnames.php';
    
    $tpl = new TemplatePower('tpl/pages/character/warehouse.tpl');
    
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
                
                $first = substr($char->uid, -1);
                if(isset($_GET['action']) && $_GET['action'] == 'edititem' && isset($_GET['slot']) && ctype_digit($_GET['slot']))
                {
                    $query = sprintf("SELECT * FROM %s.t_stash0%d WHERE a_user_index = :uid AND a_slot = :slot", Config::DB_CHAR, $first);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':uid', $char->uid, PDO::PARAM_INT);                    
                    $dbh->bindValue(':slot', $_GET['slot'], PDO::PARAM_INT);
                    $dbh->execute();
                    $r = $dbh->fetch();
                    if($r)
                    {
                        $tpl->newBlock('edititem');
                        $id = $r['a_item_vnum'];

                        $tpl->assign('id', $id);
                        $tpl->assign('name', $item[$id]['name']);
                        $tpl->assign('plus', $r['a_plus']);
                        $tpl->assign('flag', $r['a_addflag']);
                        $tpl->assign('flag2', $r['a_addflag2']);
                        $tpl->assign('amount', $r['a_count']);
                        
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
                    }
                }
                else
                {
                
                    if(isset($_GET['action']))
                    {
                        if($_GET['action'] == 'delitem')
                        {
                            $query = sprintf
                            ("
                                UPDATE %s.t_stash0%d 
                                SET 
                                    a_item_vnum = 0, 
                                    a_plus = 0, 
                                    a_addflag = 0, 
                                    a_addflag2 = 0, 
                                    a_ext_flag = '0 0 0 0 0', 
                                    a_count = 0, 
                                    a_serial = '' 
                                WHERE a_user_index = :uid 
                                AND a_slot = :slot

                            ", Config::DB_CHAR, 
                               $first);

                            $dbh = $db->prepare($query);
                            $dbh->bindParam(':uid', $char->uid, PDO::PARAM_INT);
                            $dbh->bindParam(':slot', $_GET['slot'], PDO::PARAM_INT);
                            $dbh->execute();

                            $log->Add($user->id, $char->id, 'DELETE WAREHOUSE', 'ITEM DELETED ON SLOT' . $_GET['slot']);                        
                        }
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
                        
                        
                        $database = 't_stash0' . $first;
                        
                        $query = sprintf
                        ("
                            UPDATE %s.%s 
                            SET
                                a_plus = :plus,
                                a_addflag = :flag,
                                a_addflag2 = :flag2,
                                a_ext_flag = :ext,
                                a_count = :amount
                             WHERE a_user_index = :uid 
                             AND a_slot = :slot"
                        , Config::DB_CHAR,
                          $database);
                        
                        $dbh = $db->prepare($query);
                        $dbh->bindParam(':plus', $_POST['plus']);
                        $dbh->bindParam(':flag', $_POST['flag']);
                        $dbh->bindParam(':flag2', $_POST['flag2']);
                        $dbh->bindParam(':ext', $ext);
                        $dbh->bindParam(':amount', $_POST['amount']);
                        $dbh->bindParam(':uid', $char->uid);
                        $dbh->bindParam(':slot', $_POST['slot']);
                        
                        $dbh->execute();
                        
                    }                    

                    $tpl->newBlock('inventory');


                    $query = sprintf("SELECT * FROM %s.t_stash0%d WHERE a_user_index = :uid", Config::DB_CHAR, $first);

                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':uid', $char->uid, PDO::PARAM_INT);

                    if($dbh->execute())
                    {

                        $result = $dbh->fetchAll();
                        foreach($result as $r)
                        {
                            if($r['a_item_vnum'] > 0)
                            {
                                $tpl->newBlock('items');
                                $tpl->assign('id', $r['a_item_vnum']);
                                $tpl->assign('icon', 'data/icons/' . $r['a_item_vnum'] . '.jpg');
                                $tpl->assign('num', AddDots($r['a_count']));
                                $tpl->assign('name', $item[$r['a_item_vnum']]['name']);
                                $tpl->assign('plus', $r['a_plus']);

                                $tpl->assign('serial', $r['a_serial']);

                                if($admin->Can(RIGHT_DELETEINVENTORY))
                                {
                                    $tpl->assign('delete', '<a href="warehouse.php?cid='. $char->id .'&uid='. $r['a_user_index'] . '&slot=' . $r['a_slot'] .'&action=delitem" class="menulink"><img src="tpl/img/delete.png" /></a>');
                                    $tpl->assign('edit', '<a href="warehouse.php?cid='. $char->id .'&uid='. $r['a_user_index'] . '&slot=' . $r['a_slot'] .'&action=edititem" class="menulink"><img src="tpl/img/edit.png" /></a>');
                                }


                            }
                        }
                    }
                    else
                        $msg->error('Error!' . print_r($dbh->errorInfo()));
                }
            }
            else
                $msg->error('No Character found with this id');
        }
        
        $tpl->printToScreen();
    }
    else
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    
    


?>    
