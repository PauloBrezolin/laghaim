<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/functions/datalist.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        
        
        $db2 = new PDO('mysql:host=localhost;dbname=kor_ndev_neogeo_data', 'root', 'wjsdur2011');                               
        
        
        if(isset($_GET['type']))
        {
            if($_GET['type'] == 'item')
            {
                $page = 1;
                if(isset($_GET['page']) && ctype_digit($_GET['page']))
                   $page = $_GET['page'];

                $from = ($page - 1) * 250;

                $itemtype = array('WEAR','ARMOR','WEAPON','ETC','PET','SUB');
                $itemshape = array(
                    array('BODY', 'LEGS', 'NUM'),
                    array('HELMET','ARMOR','PANTS','CLOAK','SHOES','SHIELD','NECKLACE','RING','BRACELET'),
                    array('SWORD','AXE','STAFF','RING','GUN','NOTHING','NOTHING','HAMMER','DUALSWORD','SPEAR'),
                    array('GEM_STONE','PART','POWER','GEM','GIFT','QUICK','ETC','GEMCHIP','MAGICSTONE','WARP',	'BUFF',	'QUEST','PET','PREMINUM','SKILL','RESOURCE','EFFECT','USING','SCROLL','SUMMON','SHELL',	'CHARGE','MOBSUMMON','CUBE','RECIPE','MATERIAL','SUMMONNPC'),
                    array('HORN','HEAD','BODY','WINGS','LEGS','TAIL'),
                    array('SLAYER', 'CHAKRAM','WAND', 'SCROLL', 'BOOK',	'SUMMON','COMPONENT','COLLECT','S_EQUIP','L_EQUIP','SHELL','ETC','BLASTER','D_STONE',)
                );
        
                $dbh = $db2->query("SELECT count(*) FROM t_item");
                $r = $dbh->fetch();
                $itemnum = $r[0];
                
                
                $tpl->newBlock('item');
                $query = sprintf("SELECT a_index, a_name, a_type_idx, a_shape_idx, a_min_level, a_max_use FROM t_item WHERE a_enable = 1 ORDER BY a_index LIMIT %d, 250", $from);
                $dbh = $db2->prepare($query);
                $dbh->bindParam(':from', $from);
                $dbh->execute();
                
                while($r = $dbh->fetch())
                {
                    $tpl->newBlock('itemlist');
                    $tpl->assign('id', $r['a_index']);
                    $tpl->assign('icon', 'data/icons/'. $r['a_index'] .'.jpg');
                    $tpl->assign('name', $r['a_name']);
                    $tpl->assign('type', $itemtype[$r['a_type_idx']]);
                    $tpl->assign('shape', $itemshape[$r['a_type_idx']][$r['a_shape_idx']]);
                    $tpl->assign('minlevel', $r['a_min_level']);
                    $tpl->assign('maxlevel', $r['a_max_use']);
                }
                
                
                $pages = ceil($itemnum / 250);
                for($i=1; $i<$pages; $i++)
                {
                    $tpl->newBlock('pagination');
                    if($page == $i)
                        $tpl->assign('page', '<b>' . $i . '</b> ');
                    else
                        $tpl->assign('page', '<a href="datalist.php?type=item&page='. $i . '" class="menulink">' . $i . '</a> ');
                }
            }
            
            
            
            
            
            if($_GET['type'] == 'npc')
            {
                $tpl->newBlock('npc');
                $dbh = $db2->prepare("SELECT a_index, a_name, a_level, a_item_0, a_item_1,a_item_2,a_item_3,a_item_4,a_item_5,a_item_6,a_item_7,a_item_8,a_item_9  FROM t_npc WHERE a_enable = 1 ORDER BY a_index ");
                $dbh->bindParam(':from', $from);
                $dbh->execute();
                
                while($r = $dbh->fetch())
                {
                    $tpl->newBlock('npclist');
                    $tpl->assign('id', $r['a_index']);
                    $tpl->assign('name', $r['a_name']);
                    $tpl->assign('level', $r['a_level']);
                    
                    $items = array();
                    for($i=0; $i<10; $i++)
                        if($r['a_item_'.$i] > 0)
                            $items[] = $r['a_item_'.$i];
                        
                    if(count($items) > 0)
                        $tpl->assign('items', implode(', ', $items));
                }
            }
            
            
            
            
            if($_GET['type'] == 'quest')
            {
                $tpl->newBlock('quest');
                
                $dbh = $db2->query("SELECT a_index, a_name, a_string0, a_min_level, a_max_level FROM %s.t_quest WHERE a_enable = 1 ORDER BY a_index");
                while($r = $dbh->fetch())
                {
                    $tpl->newBlock('questlist');
                    $tpl->assign('id', $r['a_index']);
                    $tpl->assign('name', $r['a_name']);
                    $tpl->assign('string0', $r['a_string0']);
                    $tpl->assign('minlevel', $r['a_min_level']);
                    $tpl->assign('maxlevel', $r['a_max_level']);
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
