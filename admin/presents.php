<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/character/presents.tpl');
    
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

                $query = sprintf
                ("
                    SELECT 
                        p.a_enable,
                        p.a_date,
                        p.a_org_count,
                        p.a_plus,
                        p.a_event_name,
                        p.a_vnum,
                        p.a_flag1,
                        p.a_flag2,
                        p.a_flag_ext,
                        i.a_name
	
                    FROM 
                        %s.t_present p,
                        %s.t_item i
	
                    WHERE 
                        p.a_char_index = :cid
                    
                    AND
                        i.a_index = p.a_vnum
                        
                    ORDER BY
                        p.a_date DESC
                        
                ", Config::DB_CHAR,
                   Config::DB_DATA);
                
                $dbh = $db->prepare($query);

                $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);

                if($dbh->execute())
                {
                    $tpl->newBlock('p1list');
                    $result = $dbh->fetchAll();
                    foreach($result as $r)
                    {
                        $tpl->newBlock('list1');
                        $tpl->assign('enable', $r['a_enable']);
                        $tpl->assign('date', $r['a_date']);
                        $tpl->assign('count', $r['a_org_count']);
                        $tpl->assign('plus', $r['a_plus']);
                        $tpl->assign('event', $r['a_event_name']);
                        $tpl->assign('id', $r['a_vnum']);
                        $tpl->assign('name', $r['a_name']);
                        $tpl->assign('flag1', $r['a_flag1']);
                        $tpl->assign('flag2', $r['a_flag2']);
                        $tpl->assign('ext', $r['a_flag_ext']);
                    }
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

