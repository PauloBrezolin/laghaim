<?php

    session_start();
    
    include 'inc/globals.php';

    if(!$db = db::getConnection())
        die('0');
    
    /*
    if(isset($_GET['action']))
    {
        if($_GET['action'] == 'unstuck')
        {
            $user = user::getInstance();
            if($user->login)
            {
                if($user->addUnstuck())
                    die('1');
            }
            
        }
    }
	*/
    
    die('0');
    
    

