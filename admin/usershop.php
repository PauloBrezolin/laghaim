<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/character/usershop.tpl');
    
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
            if(isset($_GET['shop']) && ctype_digit($_GET['shop']))
            {
                $query = sprintf
                ("
                    SELECT
                        s.a_index,
                        s.a_world,
                        s.a_type,
                        s.a_subtype,
                        s.a_pos_x,
                        s.a_pos_z,
                        s.a_gold,
                        s.a_silver,
                        s.a_bronze,
                        s.a_laim,
                        c.a_index as cid,
                        c.a_name,
                        g.ugame_user_code

                    FROM
                        %s.t_usershop s,
                        %s.t_characters c,
                        %s.bg_user_game g
                        
                    WHERE
                        s.a_index = :sid

                    AND
                        c.a_index = s.a_char_idx

                    AND
                        g.ugame_index = c.a_user_index
                ", Config::DB_CHAR,
                   Config::DB_CHAR,
                   Config::DB_USER);

                $dbh = $db->prepare($query);
                $dbh->bindParam(':sid', $_GET['shop']);
                        
                if(!$dbh->execute())
                    print_r($dbh->errorInfo());

                $r = $dbh->fetch();
                if($r != null)
                {
                    $tpl->newBlock('usershop');
                    $tpl->assign('world', GetZoneName($r['a_world']));
                    $tpl->assign('posx', $r['a_pos_x'] / 10);
                    $tpl->assign('posz', $r['a_pos_z'] / 10);
                    $tpl->assign('gold', $r['a_gold']);
                    $tpl->assign('silver', $r['a_silver']);
                    $tpl->assign('bronze', $r['a_bronze']);
                    $tpl->assign('laim', AddDots($r['a_laim']));
                    $tpl->assign('charname', $r['a_name']);
                    $tpl->assign('shopurl', 'usershop.php?shop='.$r['a_index']);
                    $tpl->assign('charurl', 'user.php?uid='. $r['ugame_user_code']);
                    
                    $query = sprintf("SELECT s.a_item_idx, i.a_name_tha, s.a_count, s.a_plus_point, s.a_flag1, s.a_flag2, s.a_gold, s.a_silver, s.a_bronze, s.a_price, s.a_serial1, s.a_serial2, s.a_serial3, s.a_serial4, s.a_serial5  FROM %s.t_usershopitem s, %s.t_item i WHERE a_shop_idx = :sid AND i.a_index = s.a_item_idx", Config::DB_DB, Config::DB_DATA);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':sid', $_GET['shop']);

                    if(!$dbh->execute())
                        print_r($dbh->errorInfo());
                    
                    $result = $dbh->fetchAll();
                    foreach($result as $r)
                    {
                        $tpl->newBlock('itemlist');
                        $tpl->assign('id', $r['a_item_idx']);
                        $tpl->assign('name', $r['a_name_tha']);
                        $tpl->assign('count', $r['a_count']);
                        $tpl->assign('plus', $r['a_plus_point']);
                        $tpl->assign('flag1', $r['a_flag1']);
                        $tpl->assign('flag2', $r['a_flag2']);
                        $tpl->assign('gold', $r['a_gold']);
                        $tpl->assign('silver', $r['a_silver']);
                        $tpl->assign('bronze', $r['a_bronze']);
                        $tpl->assign('price', AddDots($r['a_price']));
                        $tpl->assign('serial1', $r['a_serial1']);
                        $tpl->assign('serial2', $r['a_serial2']);
                        $tpl->assign('serial3', $r['a_serial3']);
                        $tpl->assign('serial4', $r['a_serial4']);
                        $tpl->assign('serial5', $r['a_serial5']);
                    }
                    
                    
                    
                    
                }
                else
                    $msg->error('No shop found with this id');
                    
            }
            else
            {
                $tpl->newBlock('shoplist');
                $query = sprintf
                ("
                    SELECT
                        s.a_index,
                        s.a_world,
                        s.a_type,
                        s.a_subtype,
                        s.a_pos_x,
                        s.a_pos_z,
                        s.a_gold,
                        s.a_silver,
                        s.a_bronze,
                        s.a_laim,
                        c.a_index as cid,
                        c.a_name,
                        g.ugame_user_code,
                        (SELECT SUM(a_count) FROM %s.t_usershopitem WHERE a_shop_idx = s.a_index) as itemnum


                    FROM
                        %s.t_usershop s,
                        %s.t_characters c,
                        %s.bg_user_game g

                    WHERE
                        c.a_index = s.a_char_idx

                    AND
                        g.ugame_index = c.a_user_index    

                    ORDER BY 
                        s.a_world

                ", Config::DB_DB,
                   Config::DB_DB,
                   Config::DB_DB,
                   Config::DB_DB);

                $dbh = $db->prepare($query);
                if(!$dbh->execute())
                    print_r($dbh->errorInfo());

                $result = $dbh->fetchAll();

                foreach($result as $r)
                {
                    $tpl->newBlock('list');
                    $tpl->assign('world', GetZoneName($r['a_world']));
                    $tpl->assign('posx', $r['a_pos_x'] / 10);
                    $tpl->assign('posz', $r['a_pos_z'] / 10);
                    $tpl->assign('gold', $r['a_gold']);
                    $tpl->assign('silver', $r['a_silver']);
                    $tpl->assign('bronze', $r['a_bronze']);
                    $tpl->assign('laim', AddDots($r['a_laim']));
                    $tpl->assign('charname', $r['a_name']);
                    $tpl->assign('shopurl', 'usershop.php?shop='.$r['a_index']);
                    $tpl->assign('charurl', 'user.php?uid='. $r['ugame_user_code']);
                    $tpl->assign('items', $r['itemnum']);
                }
            }

        }
        
        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

