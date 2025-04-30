<?php

    define('ITYPE_WEAR', 0);
    define('ITYPE_ARMOR', 1);
    define('ITYPE_WEAPON', 2);
    define('ITYPE_ETC', 3);
    define('ITYPE_PET', 4);
    define('ITYPE_SUB', 5); //¼­ºê¾ÆÀÌÅÛÅ¸ÀÔ
    define('ITYPE_NUM', 6);

    define('IWEAR_BODY', 0);
    define('IWEAR_LEGS', 1);
    define('IWEAR_NUM', 2);

    define('IARMOR_HELMET', 0);
    define('IARMOR_ARMOR', 1);
    define('IARMOR_PANTS', 2);
    define('IARMOR_CLOAK', 3);
    define('IARMOR_SHOES', 4);
    define('IARMOR_SHIELD', 5);
    define('IARMOR_NECKLACE', 6);
    define('IARMOR_RING', 7);
    define('IARMOR_BRACELET', 8);
    define('IARMOR_NUM', 9);
    define('IWEAPON_SWORD', 0);
    define('IWEAPON_AXE', 1);
    define('IWEAPON_STAFF', 2);
    define('IWEAPON_RING', 3);
    define('IWEAPON_GUN', 4);
    define('IWEAPON_HAMMER', 7);
    define('IWEAPON_DUALSWORD', 8);  //2005_newRaceÈ®Àå
    define('IWEAPON_SPEAR', 9);
    define('IWEAPON_NUM', 10);

    define('IETC_GEM_STONE', 0);    // º¸¼®¿ø¼®
    define('IETC_PART', 1);    // 
    define('IETC_POWER', 2);    // È¸º¹Á¦
    define('IETC_GEM', 3);    // º¸¼®
    define('IETC_GIFT', 4);    // º¸¼®
    define('IETC_QUICK', 5);
    define('IETC_ETC', 6);
    define('IETC_GEMCHIP', 7);
    define('IETC_MAGICSTONE', 8);
    define('IETC_WARP', 9);  // Á¸ÀÌµ¿ ÀåÄ¡
    define('IETC_BUFF', 10);  // »ó½Â ¾ÆÀÌÅÛ
    define('IETC_QUEST', 11);  // Äù½ºÆ®
    define('IETC_PET', 12);  // Æê°ü·Ã ¾ÆÀÌÅÛ
    define('IETC_PREMINUM', 13); // º¯°æ±Ç
    define('IETC_SKILL', 14);  // skill º¯°æ
    define('IETC_RESOURCE', 15); // --
    define('IETC_EFFECT', 16);  // --
    define('IETC_USING', 17);  // ÆøÁ× . »óÁ¡Áõ¼­ . Ã¢°í È®ÀåÆÑ
    define('IETC_SCROLL', 18);  //Ã¥¿¡ ´ã°ÜÀÖ´Â ½ºÅ©·Ñ
    define('IETC_SUMMON', 19);  // ¼ÒÈ¯¼® »ç¿ë
    define('IETC_SHELL', 20);  // Æ÷Åº . ¹Ì»çÀÏ Á¾·ù
    define('IETC_CHARGE', 21);  // ¼ýµ¹ . ¾áÀÇ ÈÆÀå
    define('IECT_MOBSUMMON', 22);
    define('IETC_CUBE', 23);
    define('IETC_RECIPE', 24);
    define('IETC_MATERIAL', 25);
    define('IETC_SUMMONNPC', 26);
    define('IETC_NUM', 27);
    define('IPET_HORN', 0); //¾Ö¿Ïµ¿¹° ºÎÀ§
    define('IPET_HEAD', 1);
    define('IPET_BODY', 2);
    define('IPET_WINGS', 3);
    define('IPET_LEGS', 4);
    define('IPET_TAIL', 5);
    define('IPET_NUM', 6);

    define('ISUB_SLAYER', 0); // ºÒÄ­½½·¹ÀÌ¾î
    define('ISUB_CHAKRAM', 1); // ºÒÄ­ Â÷Å©¶÷
    define('ISUB_WAND', 2); // ÃæÀü¿Ïµå
    define('ISUB_SCROLL', 3); // ½ºÅ©·Ñ
    define('ISUB_BOOK', 4); // ½ºÆçºÏ
    define('ISUB_SUMMON', 5); // ¼ÒÈ¯¼®
    define('ISUB_COMPONENT', 6); // ÈÞ¸Õ ºÎÇ°
    define('ISUB_COLLECT', 7); // ÈÞ¸Õ Ã¤Áý±â
    define('ISUB_S_EQUIP', 8); // ¼ÒÇüÀåºñ
    define('ISUB_L_EQUIP', 9); // ´ëÇüÀåºñ
    define('ISUB_SHELL', 10); // ÅºÈ¯
    define('ISUB_ETC', 11); // ±×¿Ü ±âÅ¸
    define('ISUB_BLASTER', 12); // ±×¿Ü ±âÅ¸
    define('ISUB_D_STONE', 13);
    define('ISUB_PANEL', 14);
    define('ISUB_NUM', 15);


    define('ITEM_NORMAL', 0);
    define('ITEM_SPECIAL', 1);
    define('ITEM_GIGA', 2);
    define('ITEM_GEM_VMIN', 215);
    define('ITEM_GEM_VMAX', 228);
    define('IOPTION_MAX', 5);
    define('RESIST_ELEC', 0);
    define('RESIST_FIRE', 1);
    define('RESIST_STONE', 2);
    define('RESIST_ICE', 3);
    define('RESIST_ALL', 4);
    define('IF_WEAPON_START', 0);
    define('IF_DAMAGE', 0);
    define('IF_WEAPON_SPEED', 1);
    define('IF_CAST_SPEED', 2);
    define('IF_WEAPON_END', 3);
    define('IF_ARMOR_START', 100);
    define('IF_DEFENSE', 100);
    define('IF_DAMAGE_REDUCTION', 101);
    define('IF_STR', 102);
    define('IF_DEX', 103);
    define('IF_INT', 104);
    define('IF_CON', 105);
    define('IF_CHA', 106);
    define('IF_MOVE_SPEED', 107);
    define('IF_ARMOR_END', 108);
    define('IF_ACCSRY_START', 200);
    define('IF_VITAL2MANA', 200);
    define('IF_VITAL2STAMINA', 201);
    define('IF_VITAL_STOLEN', 202);
    define('IF_MAGIC_DAMAGE', 203);
    define('IF_MAGIC_DAMAGE_REDUCTION', 204);
    define('IF_RESIST_FIRE', 205);
    define('IF_RESIST_STONE', 206);
    define('IF_RESIST_LIGHTNING', 207);
    define('IF_RESIST_POISON', 208);
    define('IF_RESIST_ALL', 209);
    define('IF_ACCSRY_END', 210);
    define('IF_ARMOR_ACCSRY_START', 300);
    define('IF_VITAL', 300);
    define('IF_MANA', 301);
    define('IF_STAMINA', 302);
    define('IF_EPOWER', 303);
    define('IF_ARMOR_ACCSRY_END', 304);
    define('IF_ALL_START', 2000);
    define('IF_SKILL_LEVEL', 2000);
    define('IF_FIND_SPECIAL_ITEM', 2001);
    define('IF_FIND_GIGA_ITEM', 2002);
    define('IF_MORE_GOLD', 2003);
    define('IF_REDUCE_REQUIREMENTS', 2004);
    define('IF_REDUCE_EPOWER_USEUP', 2005);
    define('IF_ALL_END', 2006);
    define('IATT_NO_DROP', (1 << 0));
    define('IATT_NO_SELL', (1 << 1));
    define('IATT_CONFIRM_SELL', (1 << 2));
    define('IATT_NO_EXCHANGE', (1 << 3));
    define('IATT_NO_GEM', (1 << 5));
    define('IATT_NO_STASH', (1 << 6));
    define('IATT_SAME_PRICE', (1 << 7));
    define('IATT_SUB_WEAPON', (1 << 8));
    define('IATT_SUB_QUICK', (1 << 9));
    define('IATT_SUB_PASSPLUS', (1 << 10));
    define('IATT_NOT_SAVE', (1 << 11));
    define('IATT_LOG', (1 << 12));
    define('IATT_MAX_LEVEL', (1 << 13));
    define('IATT_CAN_CONV', (1 << 14));
    define('IATT_CAN_REFINE', (1 << 15));
    define('IATT_CANT_GSTASH', (1 << 16));
    define('IATT_NO_QUICT_DELETE', (1 << 17));
    define('IATT_EVENT_WEAR', (1 << 18));
    define('IATT_LIGHT_OFF', (1 << 19));
    define('IATT_PCBANG', (1 << 20));
    define('IATT_NO_UPGRADE_ENDUR', (1 << 21));
    define('IATT_DISABLE_NORMAL', (1 << 22));
    define('IF_DAMAGE_MIN', 0x00000003);
    define('IF_DAMAGE_MAX', 0x0000000c);
    define('IF_DAMAGE_ALL', 0x00000030);
    define('IF_DAMAGE_PER', 0x000000c0);
    define('IF_OPEN_WOUNDS', 0x00000300);
    define('IF_CRUSH_BLOW', 0x00000c00);
    define('IF_ATTACK_SPEED', 0x00001000);
    define('IF_DEX_DECREASE', 0x00006000);
    define('IF_DEX_NEEDLESS', 0x00008000);
    define('IF_STR_DECREASE', 0x00030000);
    define('IF_STR_NEEDLESS', 0x00040000);
    define('IF_LEV_DECREASE', 0x00180000);
    define('IF_LEV_NEEDLESS', 0x00200000);
    define('IF_EXTRA_OPTION', 0x00c00000);
    define('IF_MISS_DECREASE', 0x03000000);
    define('IF_DEF_ME', 0x00000003);
    define('IF_DEF_MAGIC', 0x0000000c);
    define('IF_DEF_ALL', 0x00000030);
    define('IF_DEF_PERCENT', 0x000000c0);
    define('IF_CHA_INCREASE', 0x00000007);
    define('IF_CON_INCREASE', 0x00000038);
    define('IF_DEX_INCREASE', 0x000001c0);
    define('IF_STR_INCREASE', 0x00000e00);
    define('IF_INT_INCREASE', 0x00007000);
    define('IF_HP_INCREASE', 0x00000007);
    define('IF_MP_INCREASE', 0x00000038);
    define('IF_SP_INCREASE', 0x000001c0);
    define('IF_EP_INCREASE', 0x00000e00);
    define('IF_CHA_INCREASE_NECK', 0x00007000);
    define('IF_CON_INCREASE_NECK', 0x00038000);
    define('IF_DEX_INCREASE_NECK', 0x001C0000);
    define('IF_STR_INCREASE_NECK', 0x00E00000);
    define('IF_INT_INCREASE_NECK', 0x07000000);
    define('IF_BLOCK_INCREASE_NECK', 0x38000000);
    define('IF_LAIM_INCREASE', 0x00000003); // ¶óÀÓ È¹µæ·® Áõ°¡ 
    define('IF_EXP_INCREASE', 0x0000000c); // °æÇèÄ¡ È¹µæ·® Áõ°¡
    define('IF_ITEM_INCREASE', 0x00000070); // ¾ÆÀÌÅÛ µå¶øÈ®·ü Áõ°¡ , ÇöÀç »ç¿ëÇÏÁö ¾ÊÀ½
    define('IF_FREE_POINT', 0x00000080); // °æÇèÄ¡ ÀçºÐ¹è, ÇöÀç »ç¿ëÇÏÁö ¾ÊÀ½ 
    define('IF_INCREASE_HP', 0x00000300); // ÀüÃ¼ HPÀÇ 3%, ÀüÃ¼ HPÀÇ 5%, ÀüÃ¼ HPÀÇ 7%
    define('IF_INCREASE_MP', 0x00000C00); // ÀüÃ¼ MPÀÇ 3%, ÀüÃ¼ MPÀÇ 5%, ÀüÃ¼ MPÀÇ 7%
    define('IF_INCREASE_EP', 0x00003000); // ÀüÃ¼ EPÀÇ 3%, ÀüÃ¼ EPÀÇ 5%, ÀüÃ¼ EPÀÇ 7%
    define('IF_INCREASE_ST', 0x0000C000); // ÀüÃ¼ STÀÇ 3%, ÀüÃ¼ STÀÇ 5%, ÀüÃ¼ STÀÇ 7%
    define('IF_DAMAGE_RT', 0x00030000); // µ¥¹ÌÁö 50%¹Ý»ç È®·ü10%, µ¥¹ÌÁö 50%¹Ý»ç È®·ü15%, µ¥¹ÌÁö 50%¹Ý»ç È®·ü20%
    define('IF_DAMAGE_OP', 0x000C0000); // µ¥¹ÌÁö Èí¼ö 5%, µ¥¹ÌÁö Èí¼ö 10%, µ¥¹ÌÁö Èí¼ö 15%
    define('IF_RESIST_MG', 0x00300000); // »óÅÂÀÌ»ó ¼Ó¼º ÀúÇ× 10%, »óÅÂÀÌ»ó ¼Ó¼º ÀúÇ× 20%, »óÅÂÀÌ»ó ¼Ó¼º ÀúÇ× 30%
    define('IF_ADD_STURN', 0x00C00000); // ¸÷ ½ºÅÏ È®·ü 10%(È¥µ·), ¸÷ ½ºÅÏ È®·ü 15%(È¥µ·), ¸÷ ½ºÅÏ È®·ü 20%(È¥µ·)
    define('IF_MAG_DEF_ADD', 0x01000000); // ÀüÃ¼ ¸¶¹ý ¹æ¾î 10% »ó½Â
    define('IF_INCRESE_RECOVER', 0x02000000); // È¸º¹·Â Áõ°¡ 10%
    define('IF_EXT_OPTION', 0x70000000); // pcdosa1(050714)-¾ÆÀÌÅÛÀÇ Ãß°¡ ¿É¼Ç( ÁöºÒ °ü¸®, BP/Laim )
    define('IF_RND_DEFANCE', 0x0000001F); // pcdosa1(051020)-¹æ¾îµµ »ó½Â
    define('IF_RND_DAMAGE', 0x0000001F); // pcdosa1(051117)-°ø°Ý·Â »ó½Â
    define('IF_RND_LEVEL', 0x000003E0); // pcdosa1(051117)-·£´ý ·¹º§
    define('IF_INCRESE_HP_ARMOR', 0x00001C00); // »ý¸í·Â »ó½Â		20	50	100	150	200	300	500
    define('IF_INCRESE_MP_ARMOR', 0x0000E000); // ¸¶¹ý·Â »ó½Â		20	50	100	150	200	300	500
    define('IF_INCRESE_EP_ARMOR', 0x00070000); // Àü±â·Â »ó½Â		20	50	100	150	200	300	500
    define('IF_INCRESE_ST_ARMOR', 0x00380000); // ½ºÅ×¹Ì³Ê »ó½Â	20	50	100	150	200	300	500
    define('IF_INCREASE_RCVR_ARMOR', 0x01C00000); // È¸º¹·Â Áõ°¡ »ó½Â	2%	5%	10%	15%	20%	30%	50%
    define('BR_IDX_RT', 0);
    define('BR_IDX_OP', 1);
    define('BR_IDX_MG', 2);
    define('BR_IDX_STURN', 3);
    define('BR_IDX_ADD', 4);
    define('BR_IDX_RECOVER', 5);
    define('IF_QUEST_COUNTER', 0x8000);
    define('IF_QUEST_CRITICAL', 0x10000);
    define('IF_QUEST_ELE_REST', 0x20000);
    define('IF_QUEST_FIRE_REST', 0x40000);
    define('IF_QUEST_STONE_REST', 0x80000);
    define('IF_QUEST_COLD_REST', 0x100000);
    define('IF_QUEST_ALL_REST', 0x200000);
    define('IF_QUEST_TIME', 0xC00000);
    define('IF_QUEST_POTION', 0x3000000);
    define('IF_QUEST_ABSERV', 0x4000000); //( °í´ë¹ÝÁö Ãß°¡ ¿É¼Ç));
    define('IF_QUEST_MISS', 0x8000000); //( °í´ë¹ÝÁö Ãß°¡ ¿É¼Ç)
    define('DURA_WEAPON_MIN', 5000);
    define('DURA_WEAPON_MAX', 9999);
    define('DURA_ARMOR_MIN', 3000);
    define('DURA_ARMOR_MAX', 6000);
    define('ENCHANT_MAX_WEAPON', 11); //ÃÖ´ë ¿É¼Ç¼ö - ¹«±â
    define('ENCHANT_MAX_COUNT_WEAPON', 27); //ÃÖ´ë °æ¿ì¼ö - ¹«±â
    define('ENCHANT_MAX_ARMOR', 8); //ÃÖ´ë ¿É¼Ç¼ö - ¹æ¾î±¸
    define('ENCHANT_MAX_COUNT_ARMOR', 20); //ÃÖ´ë °æ¿ì¼ö - ¹æ¾î±¸

    function IS_RING($vnum)
    {
        if ($vnum == 922 || $vnum == 1032 || ($vnum >= 933 && $vnum <= 935))
            return true;
        return false;
    }

    function IS_SHINY_RING($vnum)
    {
        if (($vnum >= 2493 && $vnum <= 2496) || $vnum == 2489 || $vnum == 2500 || $vnum == 2501 || $vnum == 2753 || $vnum == 2754)
            return true;
        return false;
    }

    function IS_EVENT_NECKLACE($vnum)
    {
        return $vnum == 1504;
    }

    class Inventory
    {

        function Update($cid, $row, $col, $post)
        {
            global $db, $s;

            $first = substr($cid, -1);

            if (ctype_digit($row) && ctype_digit($col))
            {

                $query = sprintf
                        ("
                UPDATE 
                    %s.t_inven0%d 

                SET
                    a_item_idx%d = :id,
                    a_plus%d = :plus,
                    a_wear_pos%d = :wearing,
                    a_flag%d = :flag,
                    a_serial%d = :serial,
                    a_count%d = :amount,
                    a_used%d = :used,
                    a_used%d_2 = :used2,
                    a_item%d_option0 = :opt0,
                    a_item%d_option1 = :opt1,
                    a_item%d_option2 = :opt2,
                    a_item%d_option3 = :opt3,
                    a_item%d_option4 = :opt4,
                    a_item_%d_origin_var0 = :orig0,
                    a_item_%d_origin_var1 = :orig1,
                    a_item_%d_origin_var2 = :orig2,
                    a_item_%d_origin_var3 = :orig3,
                    a_item_%d_origin_var4 = :orig4,
                    a_item_%d_origin_var5 = :orig5,
                    a_socket%d = :socket

                WHERE
                    a_char_idx = :cid

                AND
                    a_row_idx = :row

                AND
                    a_tab_idx = 0
            ", Config::DB_CHAR, $first, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col, $col);

                $dbh = $db->prepare($query);

                $dbh->bindParam(':id', $post['id'], PDO::PARAM_INT);
                $dbh->bindParam(':plus', $post['plus'], PDO::PARAM_INT);
                $dbh->bindParam(':wearing', $post['wearing'], PDO::PARAM_INT);
                $dbh->bindParam(':flag', $post['flag'], PDO::PARAM_INT);
                $dbh->bindParam(':serial', $post['serial'], PDO::PARAM_STR);
                $dbh->bindParam(':amount', $post['amount'], PDO::PARAM_INT);
                $dbh->bindParam(':used', $post['used'], PDO::PARAM_INT);
                $dbh->bindParam(':used2', $post['used2'], PDO::PARAM_INT);
                $dbh->bindParam(':opt0', $post['opt0'], PDO::PARAM_INT);
                $dbh->bindParam(':opt1', $post['opt1'], PDO::PARAM_INT);
                $dbh->bindParam(':opt2', $post['opt2'], PDO::PARAM_INT);
                $dbh->bindParam(':opt3', $post['opt3'], PDO::PARAM_INT);
                $dbh->bindParam(':opt4', $post['opt4'], PDO::PARAM_INT);
                $dbh->bindParam(':orig0', $post['orig0'], PDO::PARAM_INT);
                $dbh->bindParam(':orig1', $post['orig1'], PDO::PARAM_INT);
                $dbh->bindParam(':orig2', $post['orig2'], PDO::PARAM_INT);
                $dbh->bindParam(':orig3', $post['orig3'], PDO::PARAM_INT);
                $dbh->bindParam(':orig4', $post['orig4'], PDO::PARAM_INT);
                $dbh->bindParam(':orig5', $post['orig5'], PDO::PARAM_INT);
                $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);
                $dbh->bindParam(':row', $row, PDO::PARAM_INT);
                $dbh->bindParam(':socket', $post['socket'], PDO::PARAM_STR);

                $dbh->execute();
            }
        }

        function Delete($cid, $slot, $wearing, $type)
        {
            global $db, $s;

            $first = substr($cid, -1);

            if ($type == 'inven')
                $query = sprintf("DELETE FROM %s.t_inven0%d WHERE a_char_idx = :cid AND a_slot = :slot AND a_wearing = :wearing", Config::DB_CHAR, $first);
            elseif ($type == 'event')
                $query = sprintf("DELETE FROM %s.t_event_wear0%d WHERE a_char_idx = :cid AND a_slot = :slot AND a_wearing = :wearing", Config::DB_CHAR, $first);
            else
                return;

            $dbh = $db->prepare($query);

            $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);
            $dbh->bindParam(':slot', $slot, PDO::PARAM_STR);
            $dbh->bindParam(':wearing', $wearing, PDO::PARAM_INT);

            $dbh->execute();
        }

        function GetDescr($id, $sCode, $sCode2, $type, $shape)
        {

            $rt = array();

            $UpStat = array(1, 2, 3, 5, 8, 12, 18);
            $UpChar = array(2, 3, 5, 8, 12, 18, 27);

            $UpNeck = array(10, 30, 50, 100, 150, 300, 500);
            $UpNeck_Cha = array(4, 10, 20, 30, 40, 60, 100);
            $UpNeck_Con = array(2, 5, 10, 15, 20, 30, 50);
            $UpNeck_Dex = array(2, 5, 10, 15, 20, 30, 50);
            $UpNeck_Str = array(2, 5, 10, 15, 20, 30, 50);
            $UpNeck_Int = array(2, 5, 10, 15, 20, 30, 50);
            $UpNeck_Block = array(1, 2, 3, 4, 5, 10, 20);
            $UpMoney = array(2, 5, 10);
            $UpExp = array(5, 10, 20);
            $decValue = array(3, 10, 25);
            $UpMinDam = array(1, 2, 5);
            $UpMaxDam = array(1, 2, 5);
            $UpAllDam = array(1, 2, 5);
            $UpPerDam = array(2, 5, 10);
            $UpExtra = array(4, 10, 20);

            $sValue = 0;

            if ($type == ITYPE_ARMOR)
            {
                if ($shape == IARMOR_RING)
                {
                    if (($sCode & IF_CHA_INCREASE) != 0)  //Åë¼Ö »ó½Â ¾ÆÀÌÅÛ
                    {
                        $sValue = $sCode & IF_CHA_INCREASE;

                        $rt[] = 'Charisma: +' . $UpChar[$sValue - 1];                        
                    }
                    if (($sCode & IF_CON_INCREASE) != 0)
                    {
                        $sValue = ($sCode & IF_CON_INCREASE) >> 3;
                        $rt[] = 'Constitution: +' . $UpStat[$sValue - 1];
                        //$rt[] = 'Vital: +' . $UpStat[$sValue - 1] * 2;
                        //$rt[] = 'Stamina: +' . $UpStat[$sValue - 1];
                    }
                    if (($sCode & IF_DEX_INCREASE) != 0)
                    {
                        $sValue = ($sCode & IF_DEX_INCREASE) >> 6;
                        $rt[] = 'Dexterity: +' . $UpStat[$sValue - 1];
                        //$rt[] = 'EPower: +' . $UpStat[$sValue - 1] * 2;
                    }
                    if (($sCode & IF_STR_INCREASE) != 0)
                    {
                        $sValue = ($sCode & IF_STR_INCREASE) >> 9;
                        $rt[] = 'Strength: +' . $UpStat[$sValue - 1];
                        //$rt[] = 'Vital: +' . $UpStat[$sValue - 1];
                        //$rt[] = 'Stamina: +' . $UpStat[$sValue - 1] * 2;
                    }
                    if (($sCode & IF_INT_INCREASE) != 0)
                    {
                        $sValue = ($sCode & IF_INT_INCREASE) >> 12;
                        $rt[] = 'Intelligence: +' . $UpStat[$sValue - 1];
                        //$rt[] = 'Mana: +' . $UpStat[$sValue - 1] * 2;
                    }

                    if (IS_RING($id) || IS_SHINY_RING($id))
                    {
                        if (($sCode & IF_QUEST_COUNTER) != 0)
                            $rt[] = 'Counter: +5';
                        if (($sCode & IF_QUEST_CRITICAL) != 0)
                            $rt[] = 'Critical: +5';
                        if (($sCode & IF_QUEST_ELE_REST) != 0)
                            $rt[] = 'Ele Rest: +5';
                        if (($sCode & IF_QUEST_FIRE_REST) != 0)
                            $rt[] = 'Fire Resist: +5';
                        if (($sCode & IF_QUEST_STONE_REST) != 0)
                            $rt[] = 'Stone Resist: +5';
                        if (($sCode & IF_QUEST_COLD_REST) != 0)
                            $rt[] = 'Cold Resist: +5';
                        if (($sCode & IF_QUEST_ALL_REST) != 0)
                            $rt[] = 'All Resist: +5';
                        if (($sCode & IF_QUEST_ABSERV) != 0)
                            $rt[] = 'Damage Absortion: +5';
                        if (($sCode & IF_QUEST_MISS) != 0)
                            $rt[] = 'Miss: +5';
                        if (($sCode & IF_QUEST_TIME) != 0)
                        {
                            $sValue = ($sCode & IF_QUEST_TIME) >> 22;
                            $rt[] = 'Skill duration: ' . (20 * $sValue);
                        }
                        if (($sCode & IF_QUEST_POTION) != 0)
                        {
                            $sValue = ($sCode & IF_QUEST_POTION) >> 24;
                            $rt[] = 'Potion: ' . (10 * $sValue);
                        }
                    }

                    return $rt;
                }
                else if ($shape == IARMOR_NECKLACE)
                {
                    if (($sCode & IF_HP_INCREASE) != 0)
                    {
                        $sValue = $sCode & IF_HP_INCREASE;
                        if (IS_EVENT_NECKLACE($id) && $sValue == 5)
                            $rt[] = 'Vital: +200';
                        else
                            $rt[] = 'Vital: +' . $UpNeck[$sValue - 1];
                    }
                    if (($sCode & IF_MP_INCREASE) != 0)
                    {
                        $sValue = ($sCode & IF_MP_INCREASE) >> 3;

                        if (IS_EVENT_NECKLACE($id) && $sValue == 5)
                            $rt[] = 'Mana: +200';
                        else
                            $rt[] = 'Mana: +' . $UpNeck[$sValue - 1];
                    }
                    if (($sCode & IF_SP_INCREASE) != 0)  //½ºÅ×¹Ì³Ê »ó½Â ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_SP_INCREASE) >> 6;
                        if (IS_EVENT_NECKLACE($id) && $sValue == 5)
                            $rt[] = 'Stamina: +5';
                        else
                            $rt[] = 'Stamina: +' . $UpNeck[$sValue - 1];
                    }
                    if (($sCode & IF_EP_INCREASE) != 0)  //Àü±â·Â »ó½Â ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_EP_INCREASE) >> 9;
                        if (IS_EVENT_NECKLACE($id) && $sValue == 5)
                            $rt[] = 'EPower: +5';
                        else
                            $rt[] = 'EPower: +' . $UpNeck[$sValue - 1];
                    }
                    if (($sCode & IF_CHA_INCREASE_NECK) != 0)  //Åë¼Ö »ó½Â ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_CHA_INCREASE_NECK) >> 12;
                        $rt[] = 'Charisma: +' . $UpNeck_Cha[$sValue - 1];
                    }
                    if (($sCode & IF_CON_INCREASE_NECK) != 0)
                    {
                        $sValue = ($sCode & IF_CON_INCREASE_NECK) >> 15;
                        $rt[] = 'Constitution: +' . $UpNeck_Con[$sValue - 1];
                        //$rt[] = 'Vital: +' . $UpNeck_Con[$sValue - 1] * 2;
                        //$rt[] = 'Stamina: +' . $UpNeck_Con[$sValue - 1];
                    }
                    if (($sCode & IF_DEX_INCREASE_NECK) != 0)
                    {
                        $sValue = ($sCode & IF_DEX_INCREASE_NECK) >> 18;
                        $rt[] = 'Dexterit: +' . $UpNeck_Dex[$sValue - 1];
                        //$rt[] = 'EPower: +' . $UpNeck_Dex[$sValue - 1] * 2;
                    }
                    if (($sCode & IF_STR_INCREASE_NECK) != 0)
                    {
                        $sValue = ($sCode & IF_STR_INCREASE_NECK) >> 21;
                        $rt[] = 'Strength: +' . $UpNeck_Str[$sValue - 1];
                        //$rt[] = 'Vital: +' . $UpNeck_Str[$sValue - 1];
                        //$rt[] = 'Stamina: +' . $UpNeck_Str[$sValue - 1] * 2;
                    }
                    if (($sCode & IF_INT_INCREASE_NECK) != 0)
                    {
                        $sValue = ($sCode & IF_INT_INCREASE_NECK) >> 24;
                        $rt[] = 'Intelligenxe: +' . $UpNeck_Int[$sValue - 1];
                        //$rt[] = 'Mana: +' . $UpNeck_Int[$sValue - 1] * 2;
                    }
                    if (($sCode & IF_BLOCK_INCREASE_NECK) != 0)  //ÁöÇý »ó½Â ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_BLOCK_INCREASE_NECK) >> 27;
                        $rt[] = 'Block: +' . $UpNeck_Block[$sValue - 1];
                    }

                    return $rt;
                }
                else if ($shape == IARMOR_BRACELET) // ÆÈÂî ¾ÆÀÌÅÛ
                {

                    $UpStatPecent = array(3, 5, 7, 10, 15, 20, 30);

                    if (($sValue = $sCode & IF_LAIM_INCREASE) != 0)  //µ· Áõ°¡ ¾ÆÀÌÅÛ
                    {
                        $rt[] = 'Laim: +' . $UpMoney[$sValue - 1] . '%';
                    }

                    if (($sValue = $sCode & IF_EXP_INCREASE) != 0)  //°æÇèÄ¡ Áõ°¡ ¾ÆÀÌÅÛ
                    {
                        $sValue >>= 2;
                        $rt[] = 'Exp: +' . $UpExp[$sValue - 1] . '%';
                    }
                    if (($sCode & IF_INCREASE_HP) != 0)   //HP Áõ°¡ ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_INCREASE_HP) >> 8;
                        $rt[] = 'Vital: +' . $UpStatPecent[$sValue - 1] . '%';
                    }
                    if (($sCode & IF_INCREASE_MP) != 0)  //MP Áõ°¡ ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_INCREASE_MP) >> 10;
                        $rt[] = 'Magic Power: +' . $UpStatPecent[$sValue - 1] . '%';
                    }
                    if (($sCode & IF_INCREASE_EP) != 0)  //EP Áõ°¡ ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_INCREASE_EP) >> 12;
                        $rt[] = 'EPower: +' . $UpStatPecent[$sValue - 1] . '%';
                    }
                    if (($sCode & IF_INCREASE_ST) != 0)  //ST Áõ°¡ ¾ÆÀÌÅÛ
                    {
                        $sValue = ($sCode & IF_INCREASE_ST) >> 14;
                        $rt[] = 'Stamina: +' . $UpStatPecent[$sValue - 1] . '%';
                    }
                    if (($sCode & IF_DAMAGE_RT) != 0)  // µ¥¹ÌÁö ¹Ý»ç
                    {
                        $sValue = ($sCode & IF_DAMAGE_RT) >> 16;
                        $rt[] = 'BR_IDX_RT: +' . (10 + (5 * ($sValue - 1))) . '%';
                    }
                    if (($sCode & IF_DAMAGE_OP) != 0)  // µ¥¹ÌÁö Èí¼ö
                    {
                        $sValue = ($sCode & IF_DAMAGE_OP) >> 18;
                        $rt[] = 'Damage Absorption: +' . (5 * $sValue) . '%';
                    }
                    if (($sCode & IF_RESIST_MG) != 0)  //»óÅÂÀÌ»ó ¼Ó¼º ÀúÇ×
                    {
                        $sValue = ($sCode & IF_RESIST_MG) >> 20;
                        $rt[] = 'Magic Resist: +' . (10 * $sValue) . '%';
                    }
                    if (($sCode & IF_ADD_STURN) != 0)  // ¸÷½ºÅÏ È®·ü
                    {
                        $sValue = ($sCode & IF_ADD_STURN) >> 22;
                        $rt[] = 'Add Stun: +' . (10 + (5 * ($sValue - 1))) . '%';
                    }
                    if (($sCode & IF_MAG_DEF_ADD) != 0)  // ÀüÃ¼ ¸¶¹ý ¹æ¾î 10% »ó½Â
                    {
                        $rt[] = 'Magic Defense: +' . 10 . '%';
                    }
                    if (($sCode & IF_INCRESE_RECOVER) != 0)  // È¸º¹·Â Áõ°¡ 10%
                    {
                        $rt[] = 'Increase Recover: +' . 10 . '%';
                    }

                    return $rt;
                }
                
                $UpStat = array(20, 50, 100, 150, 200, 300, 500);
                $UpPercent = array(2, 4, 6, 8, 10, 30, 50);

                if (($sValue = $sCode2 & IF_INCRESE_HP_ARMOR) != 0)  // »ý¸í·Â »ó½Â - 20,50,100,150,200,300,500
                {
                    $sValue >>= 10;
                    $rt[] = 'Vital: +' . $UpStat[$sValue - 1];
                }

                if (($sValue = $sCode2 & IF_INCRESE_MP_ARMOR) != 0)  // ¸¶¹ý·Â »ó½Â - 20,50,100,150,200,300,500
                {
                    $sValue >>= 13;
                    $rt[] = 'Mana: +' . $UpStat[$sValue - 1];
                }

                if (($sValue = $sCode2 & IF_INCRESE_EP_ARMOR) != 0)  // Àü±â·Â »ó½Â - 20,50,100,150,200,300,500
                {
                    $sValue >>= 16;
                    $rt[] = 'EPower: +' . $UpStat[$sValue - 1];
                }

                if (($sValue = $sCode2 & IF_INCRESE_ST_ARMOR) != 0)  // ½ºÅ×¹Ì³Ê »ó½Â - 20,50,100,150,200,300,500
                {
                    $sValue >>= 19;
                    $rt[] = 'Stamina: +' . $UpStat[$sValue - 1];
                }

                if (($sValue = $sCode2 & IF_INCREASE_RCVR_ARMOR) != 0) // È¸º¹·Â Áõ°¡ »ó½Â - 2%,5%,10%,15%,20%,30%,50%
                {
                    $sValue >>= 22;
                    $rt[] = 'RCVR Armor: +' . $UpPercent[$sValue - 1] . '%';
                }
            }



            if ($type == ITYPE_WEAPON)   // ¹«±â·ù
            {
                if (($sCode & IF_ATTACK_SPEED) != 0)  //½ºÇÇµå ¾÷ ¾ÆÀÌÅÛ
                {
                    $rt[] = 'Attack Speed: -1';
                }

                if ($shape != IWEAPON_RING)   //Àü±â·ÂÀ» »ç¿ëÇÏ´Â ¹«±âÀÏ°æ¿ì
                {
                    if (($sCode & IF_DEX_NEEDLESS) != 0)  //±â¹Î Á¦ÇÑ¾øÀ½ ¾ÆÀÌÅÛ
                    {
                        $rt[] = 'Need Dexterity: 0';
                    }
                    else if (($sValue = $sCode & IF_DEX_DECREASE) != 0)  //±â¹ÎÁ¦ °¨¼Ò ¾ÆÀÌÅÛ
                    {
                        $sValue >>= 13;
                        $rt[] = 'Decrease Dex Req: +' . $decValue[$sValue - 1];
                    }
                }
                else if (m_ShapeIdx == IWEAPON_STAFF)
                {
                    if (($sCode & IF_DEX_NEEDLESS) != 0)  //ÁöÇý Á¦ÇÑ¾øÀ½ ¾ÆÀÌÅÛ
                    {
                        $rt[] = 'Need Intelligence: 0';
                    }
                    else
                    if (($sValue = $sCode & IF_DEX_DECREASE) != 0)  //ÁöÇý ¾øÀ½ ¾ÆÀÌÅÛ
                    {
                        $sValue >>= 13;
                        $rt[] = 'Decrease Int Req: +' . $decValue[$sValue - 1];
                    }
                }

                if (($sValue = $sCode & IF_DAMAGE_PER) != 0)  //ÀüÃ¼ÆÛ¼¾Æ® ¾÷ ¾ÆÀÌÅÛ
                {
                    $sValue >>= 6;
                    $rt[] = 'Damage Increase +' . $UpPerDam[$sValue - 1];
                }
                if (($sValue = $sCode & IF_DAMAGE_MIN) != 0)  //ÃÖ¼Òµ¥¹ÌÁö ¾÷ ¾ÆÀÌÅÛ
                {
                    $rt[] = 'Increase Min Damage: +' . $UpMinDam[$sValue - 1];
                }
                if (($sValue = $sCode & IF_DAMAGE_MAX) != 0)  //ÃÖ´ëµ¥¹ÌÁö ¾÷ ¾ÆÀÌÅÛ
                {
                    $sValue >>= 2;
                    $rt[] = 'Increase Max Damage: +' . $UpMaxDam[$sValue - 1];
                }
                if (($sValue = $sCode & IF_DAMAGE_ALL) != 0)  //ÀüÃ¼µ¥¹ÌÁö ¾÷ ¾ÆÀÌÅÛ
                {
                    $sValue >>= 4;
                    $rt[] = 'Damage Increase: +' . $UpAllDam[$sValue - 1];
                }
                if (($sValue = $sCode & IF_EXTRA_OPTION) != 0)  //Ãß°¡¿É¼Ç µ¥¹ÌÁö ¾÷ ¾ÆÀÌÅÛ
                {
                    $sValue >>= 22;
                    $rt[] = 'Damage Increase: +' . $UpExtra[$sValue - 1];
                }
            }

            if ($type == ITYPE_WEAPON || $type == ITYPE_ARMOR)
            {
                if (($sCode & IF_STR_NEEDLESS) != 0)
                {
                    $rt[] = 'Weight: 0';
                }
                else if (($sValue = $sCode & IF_STR_DECREASE) != 0)   //ÈûÁ¦ °¨¼Ò ¾ÆÀÌÅÛ
                {
                    $sValue >>= 16;
                    $rt[] = 'Decrease Weight: ' . $decValue[$sValue - 1];
                }

                if (($sCode & IF_LEV_NEEDLESS) != 0)  //·¾Á¦ Á¦ÇÑ¾øÀ½ ¾ÆÀÌÅÛ
                {
                    $rt[] = 'Min Level: 0';
                }
                elseif (($sValue = $sCode & IF_LEV_DECREASE) != 0)  //·¾Á¦ °¨¼Ò ¾ÆÀÌÅÛ
                {
                    $sValue >>= 19;
                    $rt[] = 'Min Level: ' . $sValue;
                }
            }
            
            
            if ($type == ITYPE_ETC && $shape == IETC_POWER)
            {
                $rt[] = 'Stack left: ' . $sCode;
            }

            return $rt;
        }

        function GetSpecialDescr($sCode2)
        {
            $rt = array();

            $UpStat = array(20, 50, 100, 150, 200, 300, 500);
            $UpPercent = array(2, 4, 6, 8, 10, 30, 50);

            $sValue = 0;


            if (($sValue = $sCode2 & IF_INCRESE_HP_ARMOR) != 0)  // »ý¸í·Â »ó½Â - 20,50,100,150,200,300,500
            {
                $sValue >>= 10;
                $rt[] = 'Vital: +' . $UpStat[$sValue - 1];
            }

            if (($sValue = $sCode2 & IF_INCRESE_MP_ARMOR) != 0)  // ¸¶¹ý·Â »ó½Â - 20,50,100,150,200,300,500
            {
                $sValue >>= 13;
                $rt[] = 'Mana: +' . $UpStat[$sValue - 1];
            }

            if (($sValue = $sCode2 & IF_INCRESE_EP_ARMOR) != 0)  // Àü±â·Â »ó½Â - 20,50,100,150,200,300,500
            {
                $sValue >>= 16;
                $rt[] = 'EPower: +' . $UpStat[$sValue - 1];
            }

            if (($sValue = $sCode2 & IF_INCRESE_ST_ARMOR) != 0)  // ½ºÅ×¹Ì³Ê »ó½Â - 20,50,100,150,200,300,500
            {
                $sValue >>= 19;
                $rt[] = 'Stamina: +' . $UpStat[$sValue - 1];
            }

            if (($sValue = $sCode2 & IF_INCREASE_RCVR_ARMOR) != 0) // È¸º¹·Â Áõ°¡ »ó½Â - 2%,5%,10%,15%,20%,30%,50%
            {
                $sValue >>= 22;
                $rt[] = 'Armor Recover: +' . $UpPercent[$sValue - 1];
            }

            return $rt;
        }

    }

?>
