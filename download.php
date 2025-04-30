<?php

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/download.tpl" );
    $tpl->prepare();

    include 'inc/globals.php';
    
    $user = user::getInstance();
    if($user->login)
    {
        $tpl->newBlock('download');
    }
    else
        $msg->error('Error', 'You need to be logged in on this website to be able to use this feature.<br />Please scroll to the top of the page to <a href="javascript:window.scrollTo(0, 0);">log in</a> or create a <a href="register.php" class="menuitem">new account</a>.');
    
    
    $tpl->printToScreen();
    
    