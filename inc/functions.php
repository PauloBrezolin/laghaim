<?php

    function validEmail($email)
    {
        $isValid = true;
        $atIndex = strrpos($email, "@");
        if (is_bool($atIndex) && !$atIndex)
            $isValid = false;
        else
        {
            $domain = substr($email, $atIndex + 1);
            $local = substr($email, 0, $atIndex);
            $localLen = strlen($local);
            $domainLen = strlen($domain);
            if ($localLen < 1 || $localLen > 64)
                $isValid = false;
            else if ($domainLen < 1 || $domainLen > 255)
                $isValid = false;
            else if ($local[0] == '.' || $local[$localLen - 1] == '.')
                $isValid = false;
            else if (preg_match('/\\.\\./', $local))
                $isValid = false;
            else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
                $isValid = false;
            else if (preg_match('/\\.\\./', $domain))
                $isValid = false;
            else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local)))
                if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local)))
                    $isValid = false;
        }
        return $isValid;
    }

    function cj($r)
    {
        $races = array('Bulkan', 'Kailipton', 'Aidia', 'Human', 'Hibrider', 'Perom');
        return $races[$r];
    }

    function SendMail($to, $subject, $message)
    {

        $headers = "From: noreply@genericname.lc\r\n";
        $headers .= "Reply-To: noreply@genericname.lc\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $result = mail($to, $subject, $message, $headers);

        return $result;
    }

    function isUserExist($username)
    {
        if(!$db = db::getConnection())
            return ERROR_NO_DATABASE;

        $query = sprintf("SELECT count(*) FROM %s.bg_user WHERE user_id = :user_id", Config::DB_AUTH);
        $dbh = $db->prepare($query);
        $dbh->execute(array(":user_id" => $username));

        $result = $dbh->fetch();

        if ($result[0] == 0)
            return false;
        else
            return true;;
    }

    function isRegFlood()
    {
        if(!$db = db::getConnection())
            return ERROR_NO_DATABASE;

        $query = sprintf("SELECT max(regdate) FROM %s.bg_user WHERE regip = :ip", Config::DB_AUTH);
        $dbh = $db->prepare($query);

        $dbh->execute(array(":ip" => $_SERVER['REMOTE_ADDR']));

        $result = $dbh->fetch();

        if ($result == null)
            return false;
        else
        {

            $time = $result[0];
            if ((time() - $time) < (60 * 5))
                return true;
            else
                return false;
        }
    }
    
    function isNameAvailable($name, $cid)
    {
        if(!$db = db::getConnection())
            return false;

        $query = sprintf("SELECT count(*) FROM %s.t_characters WHERE (a_nick like :nick OR a_name like :nick) AND a_index != :cid", Config::DB_DB);
        $dbh = $db->prepare($query);

        $dbh->bindParam(':nick', $nick, PDO::PARAM_STR, 20);
        $dbh->bindParam(':cid', $cid, PDO::PARAM_INT);

        if(!$dbh->execute())
            return false;
        
        if(!$r = $dbh->fetch())
            return false;

        if($r[0] == 0)
            return true;
        else
            return false;
    }

    function GetRankName($faction, $points, $pos)
    {
        if ($faction == 1)
        {
            if ($points >= 0 && $points <= 524999999)
                return 'Squire';
            else if ($points >= 525000000 && $points <= 944999999)
                return 'Knight';
            else if ($points >= 945000000 && $points <= 1280999999)
                return 'Gentor';
            else if ($points >= 1281000000 && $points <= 1553999999)
                return 'Honorise';
            else if ($points >= 1554000000 && $points <= 1763999999)
                return 'Barone';
            else if ($points >= 1764000000 && $points <= 1910999999)
                return 'Visconte';
            else if ($points >= 1911000000 && $points <= 2015999999)
                return 'Conte';
            else if ($points >= 2016000000 && $points <= 2078999999)
                return 'Marquise';
            else
            {
                if ($pos == 1)
                    return 'Principe';
                else
                    return 'Duka';
            }
        }
        else if ($faction == 2)
        {
            if ($points >= 0 && $points <= 734999999)
                return 'Neophyte';
            else if ($points >= 735000000 && $points <= 1259999999)
                return 'Zelator';
            else if ($points >= 1260000000 && $points <= 1679999999)
                return 'Theoricus';
            else if ($points >= 1680000000 && $points <= 1889999999)
                return 'Philosophus';
            else if ($points >= 1890000000 && $points <= 2078999999)
                return 'Adeptus';
            else
            {
                if ($pos == 1)
                    return 'Ipsissimus';
                else
                    return 'Magus';
            }
        }
    }

    function GetTime($need)
    {
        $minutes = ceil($need / 25) * 5;

        if ($minutes > 60)
        {
            $hours = floor($minutes / 60);
            $minutes = $minutes % 60;

            if ($hours > 24)
            {
                $days = floor($hours / 24);
                $hours = $hours % 24;

                if ($days > 7)
                {
                    $weeks = floor($days / 7);
                    $days = $days % 7;

                    if ($weeks > 52)
                    {
                        $years = floor($weeks / 52);
                        $weeks = $weeks % 52;

                        return $years . ' year, ' . $weeks . ' weeks, ' . $days . ' days, ' . $hours . ' hours and ' . $minutes . ' minutes';
                    }
                    else
                        return $weeks . ' weeks, ' . $days . ' days, ' . $hours . ' hours and ' . $minutes . ' minutes';
                }
                else
                    return $days . ' days, ' . $hours . ' hours and ' . $minutes . ' minutes';
            }
            else
                return $hours . ' hours and ' . $minutes . ' minutes';
        }
        else
            return $minutes . ' minutes';
    }
    
    function AddDots($val)
    {
        return number_format($val, 0, ',', '.');
    }      
    
    function strbtwn($string, $min, $max)
    {
        return (strlen($string) >= $min && strlen($string) <= $max);
    }
    
    function TimeDif($datefrom, $dateto, $useseconds = true)
    {
        $dif = $dateto - $datefrom;

        $weeks = 0;
        $days = 0;
        $hours = 0;
        $minutes = 0;
        $seconds = 0;


        if ($dif > (60 * 60 * 24 * 7))
        {
            $weeks = floor($dif / (60 * 60 * 24 * 7));
            $dif -= ($weeks * (60 * 60 * 24 * 7) );
        }


        if ($dif > (60 * 60 * 24))
        {
            $days = floor($dif / (60 * 60 * 24));
            $dif -= ($days * (60 * 60 * 24) );
        }



        if ($dif > (60 * 60))
        {
            $hours = floor($dif / (60 * 60));
            $dif -= ($hours * (60 * 60) );
        }



        if ($dif > 60)
        {
            $minutes = floor($dif / 60);
            $dif -= ($minutes * 60 );
        }



        if ($dif > 0)
        {
            $seconds = $dif;
        }


        $ago = '';

        if ($weeks != 0)
            $ago .= $weeks . ' weeks, ';
        if ($days != 0)
            $ago .= $days . ' days, ';
        if ($hours != 0)
            $ago .= $hours . ' hours, ';
        
        if($useseconds)
        {
            if ($minutes != 0)
                $ago .= $minutes . ' minutes ';
            if ($seconds != 0)
                $ago .= 'and ' . $seconds . ' seconds ';
        }
        else
        {
            if ($minutes != 0)
                $ago .= 'and ' . $minutes . ' minutes ';
        }

        return $ago;
    }    

?>