<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/character/pets.tpl');
    
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

                $query = sprintf
                ("
                    SELECT 
                        a_index, 
                        a_enable, 
                        a_level, 
                        a_name
	
                    FROM 
                        %s.t_pets p
	
                    WHERE 
                        a_char_idx = :cid
                    
                    AND
                        a_level > 0
                        
                ", Config::DB_CHAR);
                
                $dbh = $db->prepare($query);

                $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);

                if($dbh->execute())
                {
                    $tpl->newBlock('p1list');
                    $result = $dbh->fetchAll();
                    foreach($result as $r)
                    {
                        $tpl->newBlock('list1');
                        $tpl->assign('name', $r['a_name']);
                        $tpl->assign('level', $r['a_level']);
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

