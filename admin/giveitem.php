<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';
    require_once 'data/itemnames.php';
    
    $tpl = new TemplatePower('tpl/pages/character/giveitem.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWGIVEITEM))
        {        
            
            $user = new User();
            $char = new Character();

            if($char->isChar($_GET['cid']) && $user->isCUser($char->uid))
            {
                if(isset($_POST['action']) && $_POST['action'] == 'additem')
                {

                    $query = sprintf("INSERT INTO %s.t_present (a_date, a_user_index, a_char_index, a_vnum, a_count, a_plus, a_flag1, a_flag2, a_flag_ext, a_event_name) VALUES(NOW(), :uid, :cid, :id, :num, :plus, :flag1, :flag2, :ext, 'AdminPanel');", Config::DB_CHAR);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
                    $dbh->bindParam(':num', $_POST['num'], PDO::PARAM_INT);
                    $dbh->bindParam(':plus', $_POST['plus'], PDO::PARAM_INT);
                    $dbh->bindParam(':uid', $char->uid, PDO::PARAM_INT);
                    $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);
                    $dbh->bindParam(':flag1', $_POST['flag1'], PDO::PARAM_INT);
                    $dbh->bindParam(':flag2', $_POST['flag2'], PDO::PARAM_INT);
                    
                    $ext = $_POST['endu1'] . ' ' . $_POST['endu2'] . ' ' . $_POST['settime'];
                    $dbh->bindParam(':ext', $ext, PDO::PARAM_STR);

                    if($dbh->execute())
                    {
                        $query = sprintf
                        ("
                            INSERT INTO 
                                %s.t_giveitemlog
                                (
                                    a_user_idx,
                                    a_item_idx,
                                    a_plus,
                                    a_count,
                                    a_time,
                                    a_ip,
                                    a_reason,
                                    a_gm
                                )
                            VALUES
                            (
                                :uid,
                                :item_id,
                                :item_plus,
                                :item_count,
                                UNIX_TIMESTAMP(),
                                :ip,
                                :reason,
                                :gm
                            );

                        ", Config::DB_WEB);

                        $dbh = $db->prepare($query);
                        $dbh->bindParam(':uid', $char->uid, PDO::PARAM_INT);
                        $dbh->bindParam(':item_id', $_POST['id'], PDO::PARAM_INT);
                        $dbh->bindParam(':item_plus', $_POST['plus'], PDO::PARAM_INT);
                        $dbh->bindParam(':item_count', $_POST['num'], PDO::PARAM_INT);
                        $dbh->bindParam(':ip', get_real_ip(), PDO::PARAM_INT);
                        $dbh->bindParam(':reason', $_POST['reason'], PDO::PARAM_INT);
                        $dbh->bindParam(':gm', $admin->name, PDO::PARAM_INT);

                        if(!$dbh->execute())
                            print_r($dbh->errorInfo());
                    }
                        
                    
                }
                
                
                $query = sprintf("SELECT * FROM %s.t_giveitemlog WHERE a_user_idx = :uid", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':uid', $char->uid, PDO::PARAM_INT);
                $dbh->execute();
                
                $result = $dbh->fetchAll();
                
                foreach($result as $r)
                {
                    $tpl->newBlock('items');
                    $tpl->assign('date', date('l, d F Y - H:i:s' , $r['a_time']));
                    $tpl->assign('id', $r['a_item_idx']);
                    $tpl->assign('name', $item[$r['a_item_idx']]['name']);
                    $tpl->assign('plus', $r['a_plus']);
                    $tpl->assign('count', $r['a_count']);
                    $tpl->assign('gm', $r['a_gm']);
                    $tpl->assign('reason', htmlspecialchars($r['a_reason']));                            
                }
                
                
                
                $tpl->newBlock('giveitem');
                
                
                
                
            }
            else
                $msg->error('No Character found with this id');
        }
        
        $tpl->printToScreen();
    }
    else
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    
    


?>    
