<?php

    session_start();
    
    if(!isset($_SESSION['check']))
        $_SESSION['check'] = 0;
    
    $_SESSION['check'] = $_SESSION['check'] + 1;
    if($_SESSION['check'] > 50)
        die('error');     

    include 'inc/globals.php';
    

    if(!$db = db::getConnection())
            die(1);

     

    if( isset( $_GET['check'] ) && isset( $_GET['username'] ) && $_GET['check'] == 'userexist' && strlen( $_GET['username'] ) > 0 )
    {

        $query = sprintf("SELECT count(*) FROM %s.bg_user WHERE user_id = :user_id", CONFIG::DB_AUTH);
        $dbh = $db->prepare( $query );
        $dbh->execute( array( ":user_id" => $_GET['username'] ) );

        $result = $dbh->fetch();

        if( $result[0] == 0 ) die('0');
        else die('1');

    }


    if( isset( $_GET['check'] ) && $_GET['check'] == 'regflood')
    {

        $ip = $_SERVER['REMOTE_ADDR'];

        $query = sprintf("SELECT UNIX_TIMESTAMP(max(regdate)) FROM %s.bg_user WHERE regip = :ip", $s->auth);
        $dbh = $db->prepare( $query );

        $dbh->execute( array( ":ip" => $ip ) );

        $result = $dbh->fetch();

        if( $result == null)
            die('0');
        else
        {
            
            $time = $result[0];
            if( (time() - $time) < (60*5) )
                    die('1');
            else
                    die('0');
        }

    }

 
?>
