<?php

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/tmp_valiant.tpl" );
    $tpl->prepare();

    include 'inc/globals.php';
    
    include 'data/itemnames.php';
    include 'data/rewards.php';

    /**
     * 
     * @param int $uid
     * @param int $cid
     * @param stReward $reward
     */
    function addItem($uid, $cid, $reward)
    {
        $db = db::getConnection();
    
        $query = sprintf
        ("
            INSERT INTO %s.t_present 
            (
                a_date, 
                a_user_index, 
                a_char_index, 
                a_vnum, 
                a_count, 
                a_plus, 
                a_flag1, 
                a_flag_ext, 
                a_event_name
            ) 
            VALUES
            (
                NOW(), 
                :uid, 
                :cid, 
                :id, 
                :num, 
                :plus, 
                :flag1, 
                :ext, 
                'VALIANT Event'
            );
            
        ", Config::DB_CHAR);
        
        $dbh = $db->prepare($query);
        $dbh->bindParam(':id', $reward->id, PDO::PARAM_INT);
        $dbh->bindParam(':num', $reward->amount, PDO::PARAM_INT);
        $dbh->bindParam(':plus', $reward->plus, PDO::PARAM_INT);
        $dbh->bindParam(':flag1', $reward->flag, PDO::PARAM_INT);
        $ext = $reward->dura . ' ' . $reward->dura;
        $dbh->bindParam(':ext', $ext, PDO::PARAM_STR);
        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);
        $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);                    

        return $dbh->execute();        
    }
    
    $user = user::getInstance();
    if($user->login)
    {
        if(!$db = db::getConnection())
            $msg->error('error', 'There is no database connection available at this moment, please try again later.');
        else
        {
            $query = sprintf("
                SELECT f.a_index, f.a_user_idx, f.a_char_idx, f.a_char_name, f.a_char_level, f.a_char_race 
                FROM %s.t_users u, %s.t_characters c, %s.t_levelevent_valiant f
                WHERE u.a_2p4p_user_code = :uid
                AND c.a_user_index = u.a_index
                AND f.a_char_idx = c.a_index
                AND f.a_taken = 0
                ORDER BY a_index",
            Config::DB_AUTH, 
            Config::DB_CHAR, 
            Config::DB_WEB
            );
            
            $dbh = $db->prepare($query);
            $dbh->bindParam(':uid', $user->id, PDO::PARAM_INT);
            $dbh->execute();
            
            if($dbh->rowCount() >= 1)
            {
                while($r = $dbh->fetch())
                {
                    if(isset($_POST['action']) && $_POST['action'] == 'sendreward' && isset($_POST['cid']) && $_POST['cid'] == $r['a_char_idx'])
                    {
                        for($i=0; $i<count($weapons); $i++)
                        {
                            if($weapons[$i]->race == $r['a_char_race'] && $r['a_char_level'] >= $weapons[$i]->minlevel && $r['a_char_level'] <= $weapons[$i]->maxlevel)
                            {
                                if($weapons[$i]->id == $_POST['chosenopt'])
                                    addItem($r['a_user_idx'], $r['a_char_idx'], $weapons[$i]);
                                    
                            }
                        }
                        
                        for($i=0; $i<count($shields); $i++)
                        {
                            if($shields[$i]->race == $r['a_char_race'] && $r['a_char_level'] >= $shields[$i]->minlevel && $r['a_char_level'] <= $shields[$i]->maxlevel)
                            {
                                if($shields[$i]->id == $_POST['chosenopt2'])
                                    addItem($r['a_user_idx'], $r['a_char_idx'], $shields[$i]);
                                    
                            }
                        }                        

                        for($i=0; $i<count($other); $i++)
                        {
                            if(($other[$i]->race == $r['a_char_race'] || $other[$i]->race == -1) && $r['a_char_level'] >= $other[$i]->minlevel && $r['a_char_level'] <= $other[$i]->maxlevel)
                                addItem($r['a_user_idx'], $r['a_char_idx'], $other[$i]);
                        }
                        
                        $query = sprintf("UPDATE %s.t_levelevent_valiant SET a_taken = 1 WHERE a_index = :idx", Config::DB_WEB);
                        $dbh = $db->prepare($query);
                        $dbh->bindParam(':idx', $r['a_index']);
                        $dbh->execute();
                        
                        $msg->success("The items are added to your E-Trader");
                        
                        
                    }
                    else
                    {
                        $tpl->newBlock('choosereward');
                        $tpl->assign('username', $user->name);
                        $tpl->assign('race', cj($r['a_char_race']));
                        $tpl->assign('charname', $r['a_char_name']);
                        $tpl->assign('cid', $r['a_char_idx']);

                        $first = true;
                        for($i=0; $i<count($weapons); $i++)
                        {
                            if($weapons[$i]->race == $r['a_char_race'] && $r['a_char_level'] >= $weapons[$i]->minlevel && $r['a_char_level'] <= $weapons[$i]->maxlevel)
                            {
                                $tpl->newBlock('opt_list');
                                $tpl->assign('val', $weapons[$i]->id);
                                $tpl->assign('name', $itemname[$weapons[$i]->id]);
                                $tpl->assign('plus', '+' . $weapons[$i]->plus);
                                if($first)
                                {
                                    $tpl->assign('opt', 'checked="checked"');
                                    $first = false;
                                }
                            }
                        }
                        
                        $first = true;
                        for($i=0; $i<count($shields); $i++)
                        {
                            if($shields[$i]->race == $r['a_char_race'] && $r['a_char_level'] >= $shields[$i]->minlevel && $r['a_char_level'] <= $shields[$i]->maxlevel)
                            {
                                $tpl->newBlock('opt2_list');
                                $tpl->assign('val', $shields[$i]->id);
                                $tpl->assign('name', $itemname[$shields[$i]->id]);
                                $tpl->assign('plus', '+' . $shields[$i]->plus);
                                if($first)
                                {
                                    $tpl->assign('opt', 'checked="checked"');
                                    $first = false;
                                }
                            }
                        }                        

                        for($i=0; $i<count($other); $i++)
                        {
                            if(($other[$i]->race == $r['a_char_race'] || $other[$i]->race == -1) && $r['a_char_level'] >= $other[$i]->minlevel && $r['a_char_level'] <= $other[$i]->maxlevel)
                            {
                                $tpl->newBlock('normal_list');
                                $tpl->assign('val', $other[$i]->id);
                                $tpl->assign('name', $itemname[$other[$i]->id]);
                                $tpl->assign('amount', $other[$i]->amount);

                                if($other[$i]->plus > 0)
                                    $tpl->assign('plus', '+' . $other[$i]->plus);

                            }
                        }
                    }
                }
            }
            else
                $msg->success('', 'Sorry, none of your characters are able to receive a event reward.<br />If you were in the Top10 you will receive your reward automatic.<br />You will also see this if you already received your rewards.');
            
            
            
            
        
        
        
        
        
        
        
        
        
        
        
        
        }
    }
    else
        $msg->error('Error', 'You need to be logged in on this website to be able to use this feature.<br />Please scroll to the top of the page to <a href="javascript:window.scrollTo(0, 0);">log in</a> or create a <a href="register.php" class="menuitem">new account</a>.');
    
    
    $tpl->printToScreen();
    
    