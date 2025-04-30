<?php

    session_start();

    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/login.tpl');

    $tpl->prepare();

    require_once 'inc/globals.php';
    
    if(isset($_POST['action']) && $_POST['action'] == 'login')
    {
        if(!isset($_POST['username']))
            $msg->error('Please enter a valid username');
        else if(strlen($_POST['username']) < 3 || strlen($_POST['username']) > 61)
            $msg->error('Please enter a valid username');
        else if(!isset($_POST['password']))
            $msg->error('Please enter a valid password');
        else if(strlen($_POST['password']) < 3 || strlen($_POST['password']) > 61)
            $msg->error('Please enter a valid password');
        else
        {
            if(!$admin->doLogin($_POST['username'], $_POST['password'], isset($_POST['keeplogin'])))
            //var_dump($admin);
                $msg->error('The password you entered is not correct');
                

            else
           
                header('location: index.php');
        }
    }
    else
    {
        
        $tpl->newBlock('loginform');
        $tpl->assign('ip', $_SERVER['REMOTE_ADDR']);
        $tpl->assign('host', gethostbyaddr($_SERVER['REMOTE_ADDR']));
    }

    $tpl->printToScreen();