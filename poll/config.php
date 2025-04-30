<?php

    class Config
    {
        const DBCON_URL = '5.196.77.123';
        const DBCON_USER = 'adminpanel';
        const DBCON_PASS = 'a';

        const DB_DATA = 'kor_ndev_neogeo_data';
        const DB_CHAR = 'kor_ndev_neogeo_char';
        const DB_USER = 'kor_ndev_neogeo_user';
        const DB_EVENT = 'kor_ndev_neogeo_event';
        const DB_WEB = 'neogeo_web';

        const SESSION_NAME = 'lhgn01new';
        const SALT = 'DFSADF@#r12rq4fdsaaf!@!@#%DSA}{<';

        const TICKET_DBCON_URL = 'genericname.lc';
        const TICKET_DBCON_USER = 'ticket';
        const TICKET_DBCON_PASS = 'a';
        const TICKET_DBCON_DB = 'zadmin_lhgn01web';            
    }
    
    function err($text)
    {
        echo $text;
        die;
    }
    
    try
    {
        $db = new PDO('mysql:host=' . Config::DBCON_URL, Config::DBCON_USER, Config::DBCON_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
    catch(PDOException $e)
    {
        err('A database connection could not be established at this moment, please try again later');
    }
    
    
    function sendMail($to, $subject, $message )
    {

        $headers = "From: noreply@LHGenericName01.lc\r\n";
        $headers .= "Reply-To: noreply@LHGenericName01.lc\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $result = mail($to, $subject, $message, $headers);

        return $result;

    }
    
    function checkExistAlready($uid)
    {
        global $db;
        $query = sprintf("SELECT count(*) FROM %s.TBL_LaghaimPointUser WHERE lpu_user_idx = :uid", Config::DB_EVENT);
        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $uid);

        if(!$dbh->execute())
            return false;

        if(!$r = $dbh->fetch())
            return false;

        if($r[0] != 0)
            return true;

        return false;
    }

    function insertCash($uid, $uname, $points)
    {
        global $db;
        
        $query = sprintf
        ("
            INSERT INTO %s.TBL_LaghaimPointUser
            (
                lpu_user_idx,
                lpu_user_idname,
                lpu_user_lag_point,
                lpu_update_date
            )
            VALUES
            (
                :uid,
                :uname,
                :points,
                NOW()
            )"

        , Config::DB_EVENT);

        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $uid);
        $dbh->bindParam(':uname', $uname);
        $dbh->bindParam(':points', $points);

        if(!$dbh->execute())
            return false;

        return true;                    

    }

    function updateCash($uid, $points)
    {
        global $db;
        
        $query = sprintf
        ("
            UPDATE %s.TBL_LaghaimPointUser
            SET 
                lpu_user_lag_point = lpu_user_lag_point + :points,
                lpu_update_date = NOW()
            WHERE lpu_user_idx = :uid"

        , Config::DB_EVENT);

        $dbh = $db->prepare($query);
        $dbh->bindParam(':uid', $uid);
        $dbh->bindParam(':points', $points);

        if(!$dbh->execute())
            return false;

        return true;              
    }

    function AddPoints($uid, $uname, $points)
    {
        if(checkExistAlready($uid))
            return updateCash($uid, $points);
        else
            return insertCash($uid, $uname, $points);
    }    