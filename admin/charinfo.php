<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/character/charinfo.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    
    if($admin->login)
    {
        
        $user = new User();
        $char = new Character();

        if($char->isChar($_GET['cid']) && $user->isCUser($char->uid))
        {

            $query = sprintf("SELECT * FROM %s.t_characters WHERE a_index = :cid", Config::DB_CHAR);
            $dbh = $db->prepare($query);

            $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);
            $dbh->execute();

            $r = $dbh->fetch();
            
            $tpl->newBlock('charinfo');
            
            if($admin->Can(RIGHT_EDITCHARNAME)) $tpl->assign('editname', '<a href="javascript:getForm('. $char->id .', \'chName\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITLEVEL)) $tpl->assign('editlevel', '<a href="javascript:getForm('. $char->id .', \'chLevel\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITSTATS)) $tpl->assign('editstr', '<a href="javascript:getForm('. $char->id .', \'chStr\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITSTATS)) $tpl->assign('editdex', '<a href="javascript:getForm('. $char->id .', \'chDex\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITSTATS)) $tpl->assign('editint', '<a href="javascript:getForm('. $char->id .', \'chInt\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITSTATS)) $tpl->assign('editcon', '<a href="javascript:getForm('. $char->id .', \'chCon\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITEXP)) $tpl->assign('editexp', '<a href="javascript:getForm('. $char->id .', \'chExp\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITREP)) $tpl->assign('editfame', '<a href="javascript:getForm('. $char->id .', \'chFame\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITGMLEVEL)) $tpl->assign('editgmlevel', '<a href="javascript:getForm('. $char->id .', \'chAdmin\', 30, 30);"><img src="tpl/img/edit.png" />');
            if($admin->Can(RIGHT_EDITCHARNAME)) $tpl->assign('editenable', '<a href="javascript:getForm('. $char->id .', \'chEnable\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITSTATS)) $tpl->assign('editcharisma', '<a href="javascript:getForm('. $char->id .', \'chCharisma\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITGOLD)) $tpl->assign('editmoney', '<a href="javascript:getForm('. $char->id .', \'chMoney\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITSTATS)) $tpl->assign('editstamina', '<a href="javascript:getForm('. $char->id .', \'chStamina\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            if($admin->Can(RIGHT_EDITSTATS)) $tpl->assign('editepower', '<a href="javascript:getForm('. $char->id .', \'chEPower\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
            
            $tpl->assign('id', $r['a_index']);
            $tpl->assign('firstname', $r['a_name']);
            $tpl->assign('level', $r['a_level']);
            $tpl->assign('cj', cj($r['a_race'], $r['a_sex']));
            $tpl->assign('str', AddDots($r['a_strength']));
            $tpl->assign('dex', AddDots($r['a_dexterity']));
            $tpl->assign('int', AddDots($r['a_intelligence']));
            $tpl->assign('con', AddDots($r['a_constitution']));
            $tpl->assign('exp', AddDots($r['a_exp']));
            $tpl->assign('fame', AddDots($r['a_fame']));
            $tpl->assign('enable', $r['a_enable']);
            $tpl->assign('charisma', $r['a_charisma']);
            $tpl->assign('money', $r['a_money']);
            
            $tpl->assign('stamina', $r['a_max_stamina']);
            $tpl->assign('epower', $r['a_max_epower']);
            
            
            $tpl->assign('hp_now', AddDots($r['a_max_vitality']));
            $tpl->assign('hp_max', AddDots($r['a_vitality']));
            $tpl->assign('mp_now', AddDots($r['a_max_mana']));
            $tpl->assign('mp_max', AddDots($r['a_mana']));
            $tpl->assign('ep_now', AddDots($r['a_max_epower']));
            $tpl->assign('ep_max', AddDots($r['a_epower']));
            
            
            if($admin->Can(RIGHT_ISADMIN) || $admin->Can(RIGHT_ISHGM))
            {
                $tpl->newBlock('adminonly');
                $tpl->assign('admin', $r['a_admin']);
                
                if($admin->Can(RIGHT_EDITGMLEVEL)) 
                    $tpl->assign('editgmlevel', '<a href="javascript:getForm('. $char->id .', \'chAdmin\', 30, 30);"><img src="tpl/img/edit.png" />');
           }
           
            $query = sprintf("SELECT * FROM %s.t_char_name_change_log WHERE a_char_index = :cid", Config::DB_CHAR);
            $dbh = $db->prepare($query);
            $dbh->bindParam(':cid', $char->id, PDO::PARAM_INT);
            
            if($dbh->execute())
            {
                $result = $dbh->fetchAll();
                
                $names = '';
                foreach($result as $r)
                {
                    $names .= $r['a_old_name'] . ', ';
                }
                
                $tpl->assign('allnames', $names);
                
            }           
            

        }
        else
            $msg->error('No character found with this id');

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>
  
