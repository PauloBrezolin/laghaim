<?php

    function GetZoneName($zoneid)
    {
        $zone = array
            (
            '0 - Dekardi',
            '1 - Dekaren',
            '2 - Dekadun',
            '3 - Shilon',
            '4 - Laglamia',
            '5 - Sea Roost',
            '6 - Pharos',
            '7 - White Horn',
            '8 - Great White Horn',
            '9 - Genus Laboratory',
            '10 - Matrix',
            '11 - Guild Ranking Competition zone',
            '12 - Occupation Battle Dmitron',
            '13 - Turan',
            '14 - Balkariya',
            '15 - Barsha',
            '16 - Queiz',
            '17 - Beargrid',
            '18 - Marboden',
            '19 - Mobius',
            '20 - Forlorn Ruin S1',
            '21 - Jupiter',
            '22 - Forlorn Ruin S2',
            '23 - Forlorn Ruin S3',
            '24 - Forlorn Ruin S4',
            '25 - Atlant',
            '26 - Acheron',
            '27 - Nixie Lake',
            '28 - Scotch Canyon',
            '29 - Kalima',
            '30 - Lost Dekaren',
            '31 - Maraudon',
            '32 - Netherill Keep',
            '33 - Easter',
            '34 - Halloween',
            '35 - Christmas'
        );

        return $zone[$zoneid];
    }

    function GetIPDetails($ip)
    {
        /*
          global $db, $s;

          $dbh = $db->prepare(sprintf("SELECT ctry, country FROM %s.t_geo WHERE ip_from < INET_ATON(:ip) AND ip_to > INET_ATON(:ip);", Config::DB_WEB));
          $dbh->bindParam(':ip', $ip);
          $dbh->execute();
          $result = $dbh->fetch();
          return $result;
         * 
         */

        return '';
    }

    function getCurrentURL()
    {
        $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        $currentURL .= $_SERVER["SERVER_NAME"];

        if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
        {
            $currentURL .= ":" . $_SERVER["SERVER_PORT"];
        }

        $currentURL .= $_SERVER["REQUEST_URI"];
        return $currentURL;
    }

    function validEmail($email)
    {
        $isValid = true;
        $atIndex = strrpos($email, "@");
        if (is_bool($atIndex) && !$atIndex)
        {
            $isValid = false;
        }
        else
        {
            $domain = substr($email, $atIndex + 1);
            $local = substr($email, 0, $atIndex);
            $localLen = strlen($local);
            $domainLen = strlen($domain);
            if ($localLen < 1 || $localLen > 64)
            {
                // local part length exceeded
                $isValid = false;
            }
            else if ($domainLen < 1 || $domainLen > 255)
            {
                // domain part length exceeded
                $isValid = false;
            }
            else if ($local[0] == '.' || $local[$localLen - 1] == '.')
            {
                // local part starts or ends with '.'
                $isValid = false;
            }
            else if (preg_match('/\\.\\./', $local))
            {
                // local part has two consecutive dots
                $isValid = false;
            }
            else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
            {
                // character not valid in domain part
                $isValid = false;
            }
            else if (preg_match('/\\.\\./', $domain))
            {
                // domain part has two consecutive dots
                $isValid = false;
            }
            else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local)))
            {
                // character not valid in local part unless 
                // local part is quoted
                if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local)))
                {
                    $isValid = false;
                }
            }
        }
        return $isValid;
    }

    function get_real_ip()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
            return $_SERVER["HTTP_CF_CONNECTING_IP"];
        else
            return $_SERVER["REMOTE_ADDR"];
    }

    function GetHash($value)
    {
        global $cfg;

        $val1 = hash('sha512', $cfg['salt'][0] . $value . $cfg['salt'][0], false);
        $val2 = hash('sha256', $cfg['salt'][1] . $val1 . $cfg['salt'][1], false);
        $val3 = hash('sha1', $cfg['salt'][2] . $val2 . $cfg['salt'][2], false);

        return $val3;
    }

    function cj($r, $s = 0)
    {
        $races = array('Bulkan', 'Kailipton', 'Aidia', 'Human', 'Hibrider', 'Perom');
        $sex = array('Male', 'Female');

        return $races[$r];
        //return $sex[$s] . ' ' . $races[$r];
    }

    function Email_Banned($uid, $days, $reason, $givereason)
    {
        global $db, $s;

        $query = sprintf("SELECT user_id, email FROM %s.bg_user WHERE user_code = :uid", Config::DB_USER);
        $dbh = $db->prepare($query);
        $dbh->execute(array(':uid' => $uid));

        $row = $dbh->fetch();

        $email = $row[1];
        $uname = $row[0];

        $subject = 'LHGenericName01 Account Banned';

        $headers = "From: noreply@LHGenericName01.lc\r\n";
        $headers .= "Reply-To: noreply@LHGenericName01.lc\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mreason = "";
        if ($givereason == "yes")
            $mreason = sprintf("<p><b>Ban Reason:</b><br />%s</p>", $reason);

        $message = sprintf
                ("
			<html>
				<body>
					<h1>Account Banned</h1>
					<p>This E-mail is to notify you that your account with username %s has been banned<br>The length of the ban is : %s<p>
                    %s
					<p>Regards,<br>LCGenericName02 Team</p>
				</body>
			</html>
			
		", $uname, $days, $mreason);

        $result = mail($email, $subject, $message, $headers);

        return $result;
    }

    function Email_Unbanned($uid)
    {
        global $db, $s;

        $query = sprintf("SELECT user_id, email FROM %s.bg_user WHERE user_code = :uid", Config::DB_AUTH);
        $dbh = $db->prepare($query);
        $dbh->execute(array(':uid' => $uid));

        $row = $dbh->fetch();

        $email = $row[1];
        $uname = $row[0];

        $subject = 'LHGenericName01 Account UnBanned';

        $headers = "From: noreply@LHGenericName01.lc\r\n";
        $headers .= "Reply-To: noreply@LHGenericName01.lc\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


        $message = sprintf
                ("
			<html>
				<body>
					<h1>Account Un-Banned</h1>
					<p>This E-mail is to notify you that your account with username %s has been unbanned<br>You are welcome to come back and play<p>
					<p>Regards,<br>LHGenericName01 Team</p>
				</body>
			</html>
			
		", $uname);

        $result = mail($email, $subject, $message, $headers);
    }

    function SendMail($to, $subject, $message)
    {

        $headers = "From: noreply@LHGenericName01.lc\r\n";
        $headers .= "Reply-To: noreply@LHGenericName01.lc\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $result = mail($to, $subject, $message, $headers);

        return $result;
    }

    function TimeAgo($datefrom, $dateto)
    {
        $dif = $dateto - $datefrom;
        
        $times = array(
            'years' => (60*60*24*365),
            'months' => (60*60*24*30),
            'weeks' => (60*60*24*7),
            'days' => (60*60*24),
            'hours' => (60*60),
            'minutes' => 60,
            'seconds' => 1
        );

        $text = '';
        foreach($times as $key => $value)
        {
            if($dif > $value)
            {
                if(strlen($text) > 0)
                    $text .= ', ';
                
                $text .= floor($dif / $value) . ' ' . $key;
                $dif = $dif % $value;
            }
        }
        
        $text .= ' ago';
            
        return $text;
    }
    
    function TimeText($dif)
    {
        $times = array(
            'years' => (60*60*24*365),
            'months' => (60*60*24*30),
            'weeks' => (60*60*24*7),
            'days' => (60*60*24),
            'hours' => (60*60),
            'minutes' => 60,
            'seconds' => 1
        );

        $text = '';
        foreach($times as $key => $value)
        {
            if($dif > $value)
            {
                if(strlen($text) > 0)
                    $text .= ', ';
                
                $num = floor($dif / $value);
                
                if($num == 1)
                    $key = rtrim($key, 's');                
                
                $text .= $num . ' ' . $key;
                $dif = $dif % $value;
            }
        }
        
        return $text;
    }    

    function GetInput($name, $value, $right, $size = 30)
    {
        global $admin;
        if ($admin->can($right))
            return sprintf("<input type=\"text\" name=\"%s\" value=\"%s\" size=\"%d\" />", $name, $value, $size);
        else
            return $value;
    }

    function GetForm($name, $value, $right, $action, $size = 40)
    {
        global $admin;
        if ($admin->can($right))
            return sprintf
                    ('
                    <form method="post">
                            <input type="text" name="%s" value="%s" size="%d" maxlength="60" /> 
                            <input type="submit" value="Change" />
                            <input type="hidden" name="action" value="%s" />
                    </form>
                    
                ', $name, $value, $size, $action);
        else
            return $value;
    }

    function UserMenuItem($url, $name, $right)
    {
        global $admin, $tpl;
        if ($admin->can($right))
        {
            $tpl->newBlock('userextramenu');
            $tpl->assign('url', $url);
            $tpl->assign('name', $name);
        }
    }

    function CharMenuItem($url, $name, $right = 0)
    {
        global $admin, $tpl;
        if ($admin->can($right) || $right == 0)
        {
            $tpl->newBlock('charextramenu');
            $tpl->assign('url', $url);
            $tpl->assign('name', $name);
        }
    }

    function AddDots($val)
    {
        return number_format($val, 0, ',', '.');
    }

    function GetCharName($cid)
    {
        global $db, $s;
        $query = sprintf("SELECT a_nick FROM %s.t_characters WHERE a_index = :cid", Config::DB_CHAR);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);
        $dbh->execute();

        $result = $dbh->fetch();

        return $result[0];
    }

    function GetAllCharInfo($cid)
    {
        global $db, $s;
        $query = sprintf("SELECT * FROM %s.t_characters WHERE a_index = :cid", Config::DB_CHAR);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);
        if (!$dbh->execute())
            print_r($dbh->errorInfo());

        $array = $dbh->fetchAll();
        return $array;
    }

    function CompareChar($old, $new)
    {
        global $db, $s;



        $query = sprintf('SHOW columns FROM %s.t_characters', Config::DB_CHAR);
        $dbh = $db->prepare($query);
        $dbh->execute();

        $result = $dbh->fetchAll();

        $log = "";

        foreach ($result as $row)
        {
            $var = $row[0];



            if ($old[0][$var] != $new[0][$var])
                $log .= '<br />' . $var . ' from ' . $old[0][$var] . ' to ' . $new[0][$var];
        }

        return $log;
    }

    function getDonateCount($uid)
    {
        global $db, $s;

        $query = sprintf("SELECT count(*) FROM %s.t_donate_log WHERE a_user_index = :uid", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if (!$dbh->execute())
            return 0;

        $result = $dbh->fetch();

        return $result[0];
    }

    function getNoteCount($uid)
    {
        global $db, $s;

        $query = sprintf("SELECT count(*) FROM %s.t_usernote WHERE a_user_index = :uid", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if (!$dbh->execute())
            return 0;

        $result = $dbh->fetch();

        return $result[0];
    }

    function getBanCount($uid)
    {
        global $db, $s;

        $query = sprintf("SELECT count(*) FROM %s.t_banlist WHERE a_user_index = :uid AND a_action = 'BAN'", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if (!$dbh->execute())
            return 0;

        $result = $dbh->fetch();

        return $result[0];
    }

    function getActionCount($uid)
    {
        global $db, $s;

        $query = sprintf("SELECT count(*) FROM %s.t_log WHERE a_user_idx = :uid", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if (!$dbh->execute())
            return 0;

        $result = $dbh->fetch();

        return $result[0];
    }

    function getUnstuckCount($uid)
    {
        global $db, $s;

        $query = sprintf("SELECT count(*) FROM %s.t_unstuck_log WHERE a_user_index = :uid", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if (!$dbh->execute())
            return 0;

        $result = $dbh->fetch();

        return $result[0];
    }

    function getHistoryCount($uid)
    {
        return 0;
        /*
          global $db, $s;

          $query = sprintf("SELECT count(*) FROM %s.t_bill_log WHERE a_user_code = :uid", Config::DB_DB);
          $dbh = $db->prepare($query);

          $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

          if(!$dbh->execute())
          return 0;

          $result = $dbh->fetch();

          return $result[0];
         * 
         */
    }

    function getMailChangeCount($uid)
    {
        global $db, $s;

        $query = sprintf("SELECT count(*) FROM %s.t_mailchange WHERE a_user_index = :uid", Config::DB_WEB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if (!$dbh->execute())
            return 0;

        $result = $dbh->fetch();

        return $result[0];
    }

    function isValidChar(&$cid, &$uid)
    {
        global $tpl, $s, $msg, $db;

        if (isset($_GET['cid']) && ctype_digit($_GET['cid']))
        {
            $query = sprintf
                    ("
                SELECT c.a_index, c.a_nick, c.a_user_index, b.user_id              
                FROM %s.t_characters c, %s.bg_user b
                WHERE a_index = :cid
                AND c.a_user_index = b.user_code
             ", Config::DB_CHAR, Config::DB_USER
            );

            $dbh = $db->prepare($query);

            $dbh->bindParam(':cid', $_GET['cid'], PDO::PARAM_INT);

            if (!$dbh->execute())
            {
                $msg->error(print_r($dbh->errorInfo()));
                return false;
            }
            else
            {
                $r = $dbh->fetch();
                if ($r == null)
                {
                    $msg->error('No char found with this id');
                    return false;
                }
                else
                {
                    $cid = $r['a_index'];
                    $uid = $r['a_user_index'];

                    $tpl->assignGlobal('charname', $r['a_nick']);
                    $tpl->assignGlobal('username', $r['user_id']);
                    $tpl->assignGlobal('charid', $r['a_index']);

                    return true;
                }
            }
        }
        else
        {
            $msg->error('No character selected');
            return false;
        }
    }

    function isBanned($uid)
    {

        global $db, $s;

        $query = sprintf("SELECT a_enable FROM %s.t_users WHERE a_2p4p_user_code = :uid", Config::DB_USER);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if ($dbh->execute())
        {
            $r = $dbh->fetch();
            if ($r != null)
            {
                if ($r[0] != 1)
                    return true;
                else
                    return false;
            }
            else
                return false;
        }
        else
            return false;
    }

    function GetUserId($cid)
    {
        global $db, $s;

        $query = sprintf("SELECT a_user_index FROM %s.t_characters WHERE a_index = :cid", Config::DB_CHAR);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);
        if ($dbh->execute())
        {
            $r = $dbh->fetch();
            if ($r != null)
                return $r['a_user_index'];
        }

        return -1;
    }

    function DBGetFromInt($query, $value)
    {
        global $db;
        $dbh = $db->prepare($query);
        $dbh->bindParam(':value', $value, PDO::PARAM_INT);

        if ($dbh->execute())
        {
            $r = $dbh->fetch();
            if ($r != null)
                return $r[0];
        }

        return false;
    }

    function GetFreeWarehouseSpot($uid)
    {
        global $db, $s;

        $last = substr($uid, -1);
        $query = sprintf("SELECT a_slot FROM %s.t_stash0%d WHERE a_user_index = :uid AND a_item_vnum = -1 AND a_slot > 0 ORDER BY a_slot LIMIT 1", Config::DB_CHAR, $last);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $uid, PDO::PARAM_INT);

        if ($dbh->execute())
        {
            $r = $dbh->fetch();
            if ($r != null)
                return $r[0];
        }

        return -1;
    }

    /*
      function GetIPDetails($ip)
      {
      $details = json_decode(file_get_contents("http://freegeoip.net/json/{$ip}"));
      return $details;
      }
     */

    function ResolveUser($username)
    {
        global $s, $db;

        $query = sprintf("SELECT user_code FROM %s.bg_user WHERE user_id = :username", Config::DB_USER);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':username', $username, PDO::PARAM_STR);
        if ($dbh->execute())
        {
            $r = $dbh->fetch();
            if ($r != null)
                return $r[0];
        }

        return -1;
    }

    function ResolveUserFromChar($charname)
    {
        global $s, $db;

        $query = sprintf("SELECT g.ugame_user_code FROM %s.t_characters c, %s.bg_user_game g WHERE c.a_name = :charname AND c.a_user_index = g.ugame_index", Config::DB_CHAR, Config::DB_USER);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':charname', $charname, PDO::PARAM_STR);
        if ($dbh->execute())
        {
            $r = $dbh->fetch();
            if ($r != null)
                return $r[0];
        }

        return -1;
    }

    function loadRecentUsers()
    {
        global $tpl;
        if (isset($_SESSION['lastuser']) && strlen($_SESSION['lastuser']) > 0)
        {
            $tpl->newBlock('lastusers');
            $lastusers = json_decode($_SESSION['lastuser']);

            foreach ($lastusers as $lu)
            {
                $tpl->newBlock('lastuserslist');
                $var = explode(':', $lu);
                $tpl->assign('url', 'user.php?uid=' . $var[0]);
                $tpl->assign('name', $var[1]);
            }
        }
    }

    function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = ' ';
        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, strlen($alphabet) - 1);
            $pass[$i] = $alphabet[$n];
        }
        return $pass;
    }

?>