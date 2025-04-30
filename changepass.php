<?php

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/changepass.tpl" );
    $tpl->prepare();

    include 'inc/globals.php';
    
    $user = user::getInstance();
    if($user->login)
    {
        if(isset( $_POST['action']) && $_POST['action'] == 'changepass')
        {
            if(!isset($_POST['cp_oldpw']))
                $msg->error('Please enter your password');
            elseif(!isset($_POST['cp_pw1']) || !isset($_POST['cp_pw2']))
                $msg->error('Please enter both new password fields');
            elseif(!strbtwn($_POST['cp_pw1'], 5, 30))
                $msg->error('Your new password has to be between 5 and 30 characters long');
            elseif($_POST['cp_pw1'] != $_POST['cp_pw2'])
                $msg->error('your new passwords dont match');         
            elseif( !isset( $_POST['cp_scode']) )
                $msg->error('You forgot to enter a security code');
            elseif( !ctype_digit($_POST['cp_scode']) )
                $msg->error('Your security code can only contain numbers');
            elseif(!$user->isSecurityCode($_POST['cp_scode']))
                $msg->error('Your security code doesn\'t match the username');
            elseif(!$user->isPassword($_POST['cp_oldpw'])) 
                $msg->error('Your old password is not correct');
            else
            {
                if($user->setPassword($_POST['cp_pw1']))
                {
                    if(SendMail::PasswordChangedEmail($user->name, $user->email, $_POST['cp_pw1']))
                        $msg->success('Your password is changed.<br />We have sent a confirmation email to your email address containing the new login details.');
                    else
                        $msg->success('Your password is changed.<br />Because of a system error a confirmation email could not be sent to your email address.');
                }
                else
                    $msg->error('Database error.<br />If u see this message please contact a Administrator');
            }            
        }
        else
            $tpl->newBlock('changepassform');
    }
    else
        $msg->error('Error', 'You need to be logged in on this website to be able to use this feature.<br />Please scroll to the top of the page to <a href="javascript:window.scrollTo(0, 0);">log in</a> or create a <a href="register.php" class="menuitem">new account</a>.');
    
    
    $tpl->printToScreen();
    
    