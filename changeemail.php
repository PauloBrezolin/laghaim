<?php

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/changeemail.tpl" );
    $tpl->prepare();

    include 'inc/globals.php';
    
    $user = user::getInstance();
    
    if(isset($_GET['code']) && strlen($_GET['code']) == 128)
    {
        $ret = $user->setEmailFromCode($_GET['code']);

        switch($ret)
        {
            case ERROR_NO_DATABASE:
                $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                break;
            case ERROR_WRONG_VALIDATION_CODE:
                $msg->error('A invalid code was entered. If you clicked the link on your email without changing anything then something wend wrong.<br />Please use the "Contact Us" feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                break;
            case ERROR_SUCCESS:
                $msg->success('Your E-mail address is succesfully changed.');
        }          
    }
    else
    {    
    
        if($user->login)
        {
            if(isset( $_POST['action']) && $_POST['action'] == 'changeemail')
            {
                if(!isset($_POST['cm_oldemail']))
                    $msg->error('');
                elseif(!validEmail($_POST['cm_oldemail']))
                    $msg->error('');
                elseif(!isset($_POST['cm_email1']) || !isset($_POST['cm_email2']))
                    $msg->error('');
                elseif(!validEmail($_POST['cm_email1']))
                    $msg->error('');
                elseif(!isset( $_POST['cm_scode']) )
                    $msg->error('You forgot to enter a security code');
                 elseif(!$user->isSecurityCode($_POST['cm_scode']))
                    $msg->error('Your security code doesn\'t match the username');
                elseif(!$user->isEmail($_POST['cm_oldemail']))
                    $msg->error('Your old email address is not correct');
                else
                {
                    if($user->setEmailForValidation($_POST['cm_email1']))
                        $msg->success('Your e-mail address is almost changed.<br />A e-mail has been sent to your address, please find this email and read the instructions inside to finish the e-mail address change.');
                    else
                        $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                }
            }
            else
                $tpl->newBlock('changeemail');

        }
        else
            $msg->error('Error', 'You need to be logged in on this website to be able to use this feature.<br />Please scroll to the top of the page to <a href="javascript:window.scrollTo(0, 0);">log in</a> or create a <a href="register.php" class="menuitem">new account</a>.');
    }
    
    $tpl->printToScreen();
    
    