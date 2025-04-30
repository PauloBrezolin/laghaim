<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/banhistory.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    require_once 'class/class_ban.php';
    
    if($admin->login)
    {
    
        $user = new User();
        if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
        {

            if($user->isUser($_GET['uid']))
            {

                $ban = new BanUnban();
                
                if(isset($_POST['action']))
                {
                    if($_POST['action'] == 'ban' && $admin->Can(RIGHT_BANUNBAN))
                        $ban->Ban($user->id, $_POST['msg'], $_POST['msg2'], $admin->name, $_POST['time'], $_POST['sendmail'], $_POST['sendreason']);
                    
                    if($_POST['action'] == 'unban' && $admin->Can(RIGHT_BANUNBAN))
                    {
                        $last = $ban->GetLastBanGM($user->id);
                        
                        if($ban->CanBeUnbannedByMe($user->id))
                            $ban->UnBan($user->id, $_POST['msg'], $_POST['msg2'], $admin->name, $_POST['sendmail']);
                        else
                            $msg->error('U don\'t have permission to unban a ban from '. $last);
                    }
                }
                
                
                $query = sprintf("SELECT * FROM %s.t_banlist WHERE a_user_index = :uid ORDER BY a_index DESC", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':uid', $user->id, PDO::PARAM_INT);

                if($dbh->execute())
                {
                    $tpl->newBlock('banlist');

                    $result = $dbh->fetchAll();

                    foreach($result as $r)
                    {
                        
                        $tpl->newBlock('showlist');
                        
                        if($r['a_admin_name'] == 'Auto System')
                            $tpl->newBlock('auto');
                        else
                            $tpl->newBlock('list');
                        
                        $tpl->assign('date', date('l, d F Y - H:i:s' , $r['a_timestamp']));
                        $tpl->assign('reason', nl2br($r['a_reason']));
                        $tpl->assign('gmreason', nl2br($r['a_gmreason']));
                        $tpl->assign('bantime', $r['a_bantime']);
                        $tpl->assign('gm', $r['a_admin_name']);

                        if($r['a_action'] == 'BAN')
                        {
                            $tpl->assign('action', '<span style="color:red; font-weight:bold;">'. $r['a_action'] . '</span>');
                            $tpl->assign('bgcolor', '#F1E4E4');
                        }
                        else
                        {
                            $tpl->assign('action', '<span style="color:green; font-weight:bold;">' . $r['a_action'] . '</span>');
                            $tpl->assign('bgcolor', '#E7F1E4');
                        }
                        
                    }
                }
                else
                    $msg->error('Database Error');
                
                
                if($admin->Can(RIGHT_BANUNBAN))
                {
                    $tpl->newBlock('setban');
                    $tpl->assign('gm', $admin->name);
                    $tpl->assign('date', date('l, d F Y - H:i:s' , time()));
                    
                    if($user->enable == 1)
                    {
                        $tpl->assign('action', '<span style="color:red; font-weight:bold;">BAN</span>');
                        $tpl->assign('act', 'ban');
                        $tpl->assign('bgcolor', '#F1E4E4');
                    }
                    else
                    {
                        $tpl->assign('action', '<span style="color:green; font-weight:bold;">UNBAN</span>');
                        $tpl->assign('act', 'unban');
                        $tpl->assign('bgcolor', '#E7F1E4');
                    }
                    
                }
                
                
            }
            else
                $msg->error('No user found with this id');
        }
        else
            $msg->error('No user id given');      
        

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>


