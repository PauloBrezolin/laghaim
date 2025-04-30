<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    require_once 'class/class_char.php';
    loadRecentUsers();
    
    if($admin->login)
    {
    
        $user = new User();
        if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
        {
            
            if($user->isUser($_GET['uid']))
            {
                
                if(isset($_GET['cid']))
                    $tpl->assignGlobal('redirurl', 'charinfo.php?cid=' . $_GET['cid']);
                else
                    $tpl->assignGlobal('redirurl', 'userinfo.php?uid=' . $user->id);

                $admin->ShowMenu('m_userinfo', 'View Userinfo', false , sprintf("userinfo.php?uid=%d", $user->id));
                $admin->ShowMenu('m_lastlogin', 'Last Logins', RIGHT_VIEWLASTLOGIN , sprintf("lastlogins.php?uid=%d", $user->id));
                $admin->ShowMenu('m_emailchanges', 'Email Changes ('. getMailChangeCount($user->id) .')', RIGHT_VIEWEMAILCHANGES , sprintf("mailchanges.php?uid=%d", $user->id));
                $admin->ShowMenu('m_notes', 'Notes ('. getNoteCount($user->id) .')', RIGHT_VIEWNOTES , sprintf("notes.php?uid=%d", $user->id));
                $admin->ShowMenu('m_donations', 'Donations ('. getDonateCount($user->id) .')', RIGHT_VIEWDONATIONS , sprintf("donatelog.php?uid=%d", $user->id));
                $admin->ShowMenu('m_bans', 'Ban History ('. getBanCount($user->id) .')', false, sprintf("banhistory.php?uid=%d", $user->id));
                $admin->ShowMenu('m_logs', 'GM Action Log ('. getActionCount($user->id) .')', RIGHT_ISADMIN, sprintf("userlog.php?uid=%d", $user->id));
                $admin->ShowMenu('m_unstuck', 'Unstuck Log ('. getUnstuckCount($user->id) .')', false, sprintf("unstucklog.php?uid=%d", $user->id));
                $admin->ShowMenu('m_reset', 'Password Reset', false, sprintf("resetid.php?uid=%d", $user->id));                 
                $admin->ShowMenu('m_fish', 'Fishing', false, sprintf("fishing.php?uid=%d", $user->id));                 

                $query = sprintf("SELECT a_index, a_name as a_nick, a_enable, a_level FROM %s.t_characters WHERE a_user_index = :uid ORDER BY a_enable DESC, a_level DESC", Config::DB_CHAR);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':uid', $user->gid, PDO::PARAM_INT);

                if($dbh->execute())
                {
                    $result = $dbh->fetchAll();
                    
                    foreach($result as $row)
                    {
                        $tpl->newBlock('charlist');

                        if($row['a_enable'] == 1)
                            $tpl->assign('name', $row['a_nick'] . ' (Lv' . $row['a_level'] . ')');
                        else
                            $tpl->assign('name', '<strike><i>' . $row['a_nick'] . '(' . $row['a_level'] . ')</i></strike>');

                        $tpl->assign('url', 'charinfo.php?uid=' . $user->id . '&cid=' . $row['a_index']);

                        $nick[$row['a_index']] = $row['a_nick'];

                    }
                }
                else
                    $msg->error('Database Error');
            }
            else
                $msg->error('No user found with this id');
        }
        else
        {
            if(isset($_GET['cid']) && ctype_digit($_GET['cid']))
            {
                $char = new Character();
                $uid = $char->GetUser($_GET['cid']);
                if($uid === false)
                    $msg->error('Cant find a character with this id');
                else
                    echo '<meta http-equiv="refresh" content="0; url=user.php?uid='. $uid .'&cid='. $_GET['cid'] .'>';
            }
            else
                $msg->error('No user id given');           
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>


