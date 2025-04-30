<?php

    session_start();
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/search/search_item.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    
    $ser = array();
    $c = 0;
    $dupes = 0;
    $found = 0;
    
    $ds = array();
    
    function checkSerial($parts)
    {
        global $ser;
        global $dupes;
        global $found;
        global $ds;
        
        $ret = '';
        
        if(!is_array($parts))
            $parts = explode(' ', trim($parts));
        
        foreach($parts as $serial)
        {
            if(strlen($serial) < 4)
                continue;           
            
            $found++;            
            if(isset($ser[$serial]))
            {
                $dupes++;
                $ret .= '<span style="font-weight:bold; color:red; font-size:13px;">' . $serial . '</span> ';
                $ds[] = $serial;
            }
            else
            {
                $ret .= ' ' . $serial;
                $ser[$serial] = 1;
            }
            
        }
        
        return trim($ret);
    }
    
  
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_SEARCHCHAR))
        {
            $id = 0;
            if(isset($_POST['id']) && ctype_digit($_POST['id']))
            {
                $id = $_POST['id'];
                $tpl->assignGlobal('id', $id);
            }
            
            $num = 0;
            if(isset($_POST['amount']) && ctype_digit($_POST['amount']))
            {
                $num = $_POST['amount'];
                $tpl->assignGlobal('num', $num);
            }
            
            if(isset($_POST['action']) && $_POST['action'] == 'searchitem' && $id > 0 && $num > 0)
            {
                $found = 0;
                for($i=0; $i<10; $i++)
                {
                    $query = sprintf
                    ("
                        SELECT g.ugame_user_code, c.a_index, c.a_name, i.a_plus_point, i.a_serial1 
                        FROM %s.t_inven0%d i, %s.t_characters c, %s.bg_user_game g 
                        WHERE i.a_item_idx = :id 
                        AND c.a_index = i.a_char_idx 
                        AND g.ugame_index = c.a_user_index
                        ORDER BY i.a_char_idx"
                            
                    , Config::DB_CHAR, 
                      $i, 
                      Config::DB_CHAR, 
                      Config::DB_USER);
                    
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':id', $id, PDO::PARAM_INT);
                    $dbh->execute();
                    
                    $result = $dbh->fetchAll();
                    
                    
                    foreach($result as $r)
                    {
                        $serials = explode(' ', $r['a_serial1']);
                        if(count($serials) < $num)
                            continue;
                        
                        $tpl->newBlock('inventory_list');
                        $tpl->assign('name', $r['a_name']);
                        $tpl->assign('url', 'user.php?uid='. $r['ugame_user_code'] . '&cid=' . $r['a_index']);
                        $tpl->assign('plus', $r['a_plus_point']);
                        $tpl->assign('amount', count($serials));
                        $tpl->assign('serials', checkSerial($r['a_serial1']));
                    }
                    
                }
                
                
                for($i=0; $i<10; $i++)
                {
                    $query = sprintf
                    ("
                        SELECT 
                            u.a_2p4p_user_code, 
                            u.a_2p4p_user_id, 
                            s.a_plus, 
                            s.a_count, 
                            s.a_serial 
                        FROM 
                            %s.t_stash0%d s, 
                            %s.t_users u 
                            
                        WHERE s.a_item_vnum = :id 
                        AND s.a_count >= :num 
                        AND u.a_index = s.a_user_index
                        ORDER BY s.a_user_index"
                        
                            
                    , Config::DB_CHAR, $i, Config::DB_USER);
                    
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':id', $id, PDO::PARAM_INT);
                    $dbh->bindParam(':num', $num, PDO::PARAM_INT);
                    $dbh->execute();
                    
                    $result = $dbh->fetchAll();
                    
                    $prevuser = -1;
                    $amount = 0;
                    foreach($result as $r)
                    {
                        if($prevuser != $r['a_2p4p_user_code'])
                        {
                            $tpl->newBlock('warehouse_list');
                            $tpl->assign('name', $r['a_2p4p_user_id']);
                            $tpl->assign('url', 'user.php?uid='. $r['a_2p4p_user_code']);
                            $amount = 0;
                            
                        }
                        
                        $tpl->newBlock('warehouse_items');
                        $tpl->assign('serials', checkSerial($r['a_serial']));  
                        
                        $amount += $r['a_count'];
                        $tpl->assign('warehouse_list.amount', $amount);
                        $prevuser = $r['a_2p4p_user_code'];
                    }                    
                }
                
                
                $query = sprintf("SELECT g.a_index, g.a_name, s.a_plus, s.a_count, s.a_serial FROM %s.t_guild_stash s, %s.t_guild_2007 g WHERE s.a_item_vnum = :id AND a_count > :num AND g.a_index = s.a_guild_index", Config::DB_CHAR, Config::DB_CHAR);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':id', $id, PDO::PARAM_INT);
                $dbh->bindParam(':num', $num, PDO::PARAM_INT);
                $dbh->execute();

                $result = $dbh->fetchAll();

                foreach($result as $r)
                {
                    $tpl->newBlock('guild_list');
                    $tpl->assign('name', $r['a_name']);
                    $tpl->assign('url', 'guild.php?gid='. $r['a_index']);
                    $tpl->assign('plus', $r['a_plus']);
                    $tpl->assign('amount', $r['a_count']);
                    $tpl->assign('serials', checkSerial($r['a_serial']));   
                }    
                
                
                $query = sprintf("SELECT g.ugame_user_code , c.a_index, c.a_name, s.a_index as shopindex, i.a_plus_point, i.a_count, i.a_serial1, i.a_serial2, i.a_serial3, i.a_serial4, i.a_serial5 FROM %s.t_usershopitem i, %s.t_usershop s, %s.t_characters c, %s.bg_user_game g WHERE i.a_item_idx = :id AND i.a_count >= :num AND s.a_index = i.a_shop_idx AND c.a_index = s.a_char_idx AND g.ugame_index = c.a_user_index", Config::DB_CHAR, Config::DB_CHAR, Config::DB_CHAR, Config::DB_USER);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':id', $id, PDO::PARAM_INT);
                $dbh->bindParam(':num', $num, PDO::PARAM_INT);
                $dbh->execute();

                $result = $dbh->fetchAll();

                foreach($result as $r)
                {
                    $tpl->newBlock('shop_list');
                    $tpl->assign('name', $r['a_name']);
                    $tpl->assign('url', 'user.php?uid='. $r['ugame_user_code'] . '&cid=' . $r['a_index']);
                    $tpl->assign('plus', $r['a_plus_point']);
                    $tpl->assign('amount', $r['a_count']);
                    $tpl->assign('serials', checkSerial($r['a_serial1']) . ' - ' . checkSerial($r['a_serial2']) . ' - ' . checkSerial($r['a_serial3']) . ' - ' . checkSerial($r['a_serial4']) . ' - ' . checkSerial($r['a_serial5']));
                    
                    $found++;
                }  
                
                
                
                for($i=0; $i<10; $i++)
                {
                    $query = sprintf
                    ("
                        SELECT g.ugame_user_code, c.a_index, c.a_name, i.a_plus_point, i.a_serial1 
                        FROM %s.t_event_wear0%d i, %s.t_characters c, %s.bg_user_game g 
                        WHERE i.a_item_idx = :id 
                        AND c.a_index = i.a_char_idx 
                        AND g.ugame_index = c.a_user_index"
                            
                    , Config::DB_CHAR, 
                      $i, 
                      Config::DB_CHAR, 
                      Config::DB_USER);
                    
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':id', $id, PDO::PARAM_INT);
                    $dbh->execute();
                    
                    $result = $dbh->fetchAll();
                    
                    
                    foreach($result as $r)
                    {
                        $serials = explode(' ', $r['a_serial1']);
                        if(count($serials) < $num)
                            continue;
                        
                        
                        
                        
                        $tpl->newBlock('event_list');
                        $tpl->assign('name', $r['a_name']);
                        $tpl->assign('url', 'user.php?uid='. $r['ugame_user_code'] . '&cid=' . $r['a_index']);
                        $tpl->assign('plus', $r['a_plus_point']);
                        $tpl->assign('amount', count($serials));
                        $tpl->assign('serials', checkSerial($r['a_serial1']));
                    }
                    
                }                
                
                
                $tpl->assignGlobal('found', $found);
                $tpl->assignGlobal('dupes', $dupes);
            }
            
                
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

