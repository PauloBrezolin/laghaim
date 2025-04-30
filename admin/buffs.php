<?php

    session_start();
    $bn = basename(__FILE__); 
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/character/buffs.tpl');
    
    $tpl->assignInclude('charmenu', 'tpl/pages/character/charmenu.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    require_once 'data/itemnames.php';
    
    $potionType = [
	'POTION_UPDAM',	// °ø°Ý·Â »ó½Â
	'POTION_UPDEF',		// ¹æ¾î·Â »ó½Â
	'POTION_UPDEF_MAGIC',	// pcdosa1(051129)-ÅÂ±¹ ¿äÃ», ¸¶¹ý,¹æ¾î·Â »ó½Â
	'POTION_EXP',			// °æÇèÄ¡
	'POTION_MONEY',		// ¶óÀÓ
	'POTION_DYOR',		//ulyssesme-20061010 ÀÏº»½Å±Ô¾ÆÀÌÅÛ : ÆÄ¸êÀÇ´Ë Äù½ºÆ®·Î ¾òÀ»¼ö ÀÖ´Â Æ÷ÀÎÆ®°¡ 50% »ó½Â
	'POTION_PARTY',		//ulyssesme-20061010 ÀÏº»½Å±Ô¾ÆÀÌÅÛ : ÆÄÆ¼ÀÎ¿ø¼ö¿¡ µû¸¥ »ý¸í·Â,¸¶³ª,½ºÅ×¹Ì³ª, Àü±â·Â »ó½Â
	'POTION_VITAL',		// ÃÖ´ë »ý¸í·Â »ó½Â
	'POTION_MANA',		// ÃÖ´ë ¸¶³ª »ó½Â
	'POTION_STAMINA',		// ÃÖ´ë ½ºÅ×¹Ì³Ê »ó½Â
	'POTION_ENERGE',		// ÃÖ´ë Àü±â·Â »ó½Â
	'POTION_CRITICAL',	// Å©¸®Æ¼ÄÃ »ó½Â
	'POTION_STAMINADOWN_MOB',	// ¸ó½ºÅÍ Ã¼·ÂÇÏ¶ô
	'POTION_DAM_DOWN', //prozone addbuff
	'POTION_MOVE',//prozone addbuff
	'POTION_INSTANTDAM',
	'POTION_EVENT_NUM'
    ];
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_VIEWINVENTORY))
        {        
            
            $user = new User();
            $char = new Character();

            if($char->isChar($_GET['cid']) && $user->isCUser($char->uid))
            {
                $query = sprintf("SELECT * FROM %s.t_potion_status WHERE a_char_index = :cid", Config::DB_CHAR);
                $dbh = $db->prepare($query);
                $dbh->bindValue(':cid', $char->id, PDO::PARAM_INT);
                $dbh->execute();
                
                while($r = $dbh->fetch())
                {
                    $tpl->newBlock('list');
                    $tpl->assign('id', $r['a_potion_vnum']);
                    $tpl->assign('name', $item[$r['a_potion_vnum']]['name']);
                    $tpl->assign('type', $potionType[$r['a_potion_type']]);
                    $tpl->assign('rate', $r['a_potion_rate']);
                    $tpl->assign('time', TimeText($r['a_remain_time']));
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

