<?php

session_start();

require_once 'inc/templatepower.php';
$tpl = new TemplatePower('tpl/pages/user/userinfo.tpl');

$tpl->prepare();

require_once 'inc/globals.php';

if ($admin->login)
{

    if (isset($_GET['uid']) && ctype_digit($_GET['uid']))
    {


        $query = sprintf
                ("
                SELECT 
                    b.user_code,
                    b.user_id,
                    b.regdate,
                    b.email,
                    b.regmail,
                    b.regip,
                    b.pin,
                    b.passwd,
                    u.a_enable,
                    u.a_connect

                FROM 
                    %s.bg_user b 

                LEFT JOIN 
                    %s.t_users u 

                ON 
                    u.a_2p4p_user_code = b.user_code 

                WHERE
                    b.user_code = :uid"
                , Config::DB_USER, Config::DB_USER
        );

        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $_GET['uid'], PDO::PARAM_INT);

        if (!$dbh->execute())
            $msg->error(print_r($dbh->errorInfo()));
        else
        {
            $r = $dbh->fetch();
            if ($r == null)
                echo 'No user found with this id';
            else
            {
                $uid = $r['user_code'];


                if (isset($_GET['action']) && $_GET['action'] == 'kick')
                {
                    $query = sprintf("INSERT INTO %s.t_unstuck (a_idname) VALUES(:uname)", Config::DB_USER);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':uname', $r['user_id'], PDO::PARAM_STR);
                    $dbh->execute();
                }


                if ($r['a_enable'] == 2)
                    $tpl->assignGlobal('banned', '<span class="bantext"><br />This user is currently banned</span>');

                $tpl->newBlock('userinfo');
                $tpl->assign('userid', $r['user_code']);
                $tpl->assignGlobal('username', $r['user_id']);
                $tpl->assign('email', $r['email']);
                $tpl->assign('regdate', $r['regdate']);

                if ($r['a_connect'] == '-1')
                {
                    $tpl->assign('status', 'Offline');
                    $tpl->assignGlobal('onlinedot', '<img src="tpl/img/offline.png" title="User is offline" />');  
                }
                else
                {
                    $tpl->assign('status', 'Online at '. GetZoneName($r['a_connect']));
                    $tpl->assignGlobal('onlinedot', '<img src="tpl/img/online.png" title="User is currently Online!" />');
                }
                

                $admin->Value('regip', $r['regip'], RIGHT_VIEWUSERIP);
                $admin->Value('scode', $r['pin'], RIGHT_VIEWUSERSECCODE);
                $admin->Value('password', '***', RIGHT_EDITUSERPASSWORD);
                $admin->Value('regmail', $r['regmail'], RIGHT_VIEWEMAILCHANGES);

                if ($admin->Can(RIGHT_EDITUSERNAME))
                    $tpl->assign('username_edit', '<a href="javascript:getForm(' . $uid . ', \'usrName\', 30, 30);"><img src="tpl/img/edit.png" /></a>');
                if ($admin->Can(RIGHT_EDITUSERPASSWORD))
                    $tpl->assign('password_edit', '<a href="javascript:getForm(' . $uid . ', \'usrPw\');"><img src="tpl/img/edit.png" /></a>');
                if ($admin->Can(RIGHT_EDITUSEREMAIL))
                    $tpl->assign('email_edit', '<a href="javascript:getForm(' . $uid . ', \'usrEmail\', 35, 100);"><img src="tpl/img/edit.png" /></a>');
                if ($admin->Can(RIGHT_EDITUSERBDAY))
                    $tpl->assign('birthday_edit', '<a href="javascript:getForm(' . $uid . ', \'usrBday\');"><img src="tpl/img/edit.png" /></a>');
                if ($admin->Can(RIGHT_EDITUSERSECCODE))
                    $tpl->assign('scode_edit', '<a href="javascript:getForm(' . $uid . ', \'usrSecCode\', 8, 8);"><img src="tpl/img/edit.png" /></a>');
                if ($admin->Can(RIGHT_EDITUSERSECCODE))
                    $tpl->assign('otp_edit', '<a href="javascript:getForm(' . $uid . ', \'usrOTP\', 8, 8);"><img src="tpl/img/edit.png" /></a>');
                if ($admin->Can(RIGHT_VIEWUSERSECCODE))
                    $tpl->assign('sendmail', '<a href="sendcode.php?uid=' . $uid . '" class="menulink" title="Send Security Code and Birthday"><img src="tpl/img/icon_send_email.gif" /></a>');


                $query = sprintf("SELECT count(*) FROM %s.t_unstuck WHERE a_idname = :uname", Config::DB_USER);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':uname', $r['user_id'], PDO::PARAM_STR);
                $dbh->execute();
                $result = $dbh->fetch();

                if ($result[0] == 1)
                    $tpl->assign('kickuser', 'User added to kicklist');
                else
                    $tpl->assign('kickuser', '<a href="userinfo.php?uid=' . $r['user_code'] . '&action=kick" class="menulink">Kick from game</a>');

                
                if($admin->Can(RIGHT_VIEWUSERCASH))
                {
                    $cash = 0;
                    $query = sprintf("SELECT lpu_user_lag_point FROM %s.TBL_LaghaimPointUser WHERE lpu_user_idx = :uid", Config::DB_EVENT);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':uid', $uid);
                    if($dbh->execute())
                    {
                        $result = $dbh->fetch();
                        if($result != null)
                            $cash = $result[0];
                    }
                    
                    $tpl->newBlock('showcash');
                    $tpl->assign('cash', $cash);
                }

                if ($admin->Can(RIGHT_VIEWUSERCHARACTERS))
                {
                    $query = sprintf("SELECT * FROM %s.t_characters WHERE a_user_index = (SELECT g.ugame_index FROM %s.bg_user_game g WHERE g.ugame_user_code = :uid) ORDER BY a_enable DESC, a_slot", Config::DB_CHAR, Config::DB_USER);
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':uid', $r['user_code'], PDO::PARAM_INT);

                    if ($dbh->execute())
                    {
                        $tpl->newBlock('charlist');

                        $result = $dbh->fetchAll();
                        foreach ($result as $r)
                        {
                            $tpl->newBlock('list');
                            $tpl->assign('id', $r['a_index']);

                            if ($r['a_enable'] == 1)
                                $tpl->assign('name', $r['a_name']);
                            else
                                $tpl->assign('name', '<strike>' . $r['a_name'] . '</strike>');

                            $tpl->assign('level', $r['a_level']);
                            $tpl->assign('job', cj($r['a_race'], $r['a_sex']));
                            $tpl->assign('create', $r['a_create_date']);
                            $tpl->assign('lastuse', $r['a_datestamp']);
                            $tpl->assign('slot', $r['a_slot']);

                            $tpl->assign('url', 'charinfo.php?cid=' . $r['a_index']);
                        }
                    }
                }
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
