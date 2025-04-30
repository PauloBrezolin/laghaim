<?php

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/register.tpl" );
    $tpl->prepare();

    include 'inc/globals.php';
    include 'class/class_registration.php';    
    
    
    // Registration form posted
    if(isset( $_POST['action']) && $_POST['action'] == 'register')
    {
        if( !isset( $_POST['reg_uname']) )
            $msg->error('U must enter a username');
        elseif( strlen($_POST['reg_uname']) < 5 || strlen($_POST['reg_uname']) > 15)
            $msg->error('Username must be between 5 and 15 long');
        elseif( !ctype_alnum($_POST['reg_uname']) )
            $msg->error('Username can only contain letters and numbers');
        elseif( !isset( $_POST['reg_pw1']) )
            $msg->error('U have to enter a password');
        elseif( !isset( $_POST['reg_pw2']) )
            $msg->error('U have to enter your password again');
        elseif( strlen($_POST['reg_pw1']) < 5 || strlen($_POST['reg_pw1']) > 30)
            $msg->error('Your password needs to be between 5 and 30 long');
        elseif( $_POST['reg_pw1'] != $_POST['reg_pw2'] )
            $msg->error('Your passwords dont match');
        elseif( !validEmail($_POST['reg_email']) )
            $msg->error('the email address u entered is invalid');
        elseif( !isset( $_POST['reg_scode']) )
            $msg->error('You forgot to enter a security code');
        elseif( !ctype_digit($_POST['reg_scode']) )
            $msg->error('Your security code can only contain numbers');
        elseif( strlen($_POST['reg_scode'] ) != 4 )
            $msg->error('Your security pincode needs to be exactley 4 numbers long, now its ' . strlen($_POST['reg_scode']));
        elseif( isUserExist($_POST['reg_uname']))
            $msg->error('This username already exists');
        elseif( isRegFlood())
            $msg->error('U can only register 1 account every 10 minutes');
        else        
        {
            $registration = new registration();
            $ret = $registration->registerForValidation($_POST['reg_uname'], $_POST['reg_pw1'], $_POST['reg_email'], $_POST['reg_scode']);
            switch($ret)
            {
                case ERROR_NO_DATABASE:
                    $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:laghaimfusion@gmail.com">laghaimfusion@gmail.com</a>');
                    break;
                case ERROR_NO_SENDMAIL:
                    $msg->error('A email could not be sent.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:laghaimfusion@gmail.com">laghaimfusion@gmail.com</a>');
                    break;
                case ERROR_SUCCESS:
                    $msg->success('A activation email has been sent to your email address <i>' . htmlspecialchars($_POST['reg_email']) . '</i>.<br />Please find this email and follow the instructions inside the email to activate your account.<br />Usually this email is received directly but it could take a few minutes.<br />If you did not receive a email at all please use the "Contact Us" feature or send a email to <a href="mailto:laghaimfusion@gmail.com">laghaimfusion@gmail.com</a>');
            }
        }
    }
    
    
    // Validation code entered
    else if(isset($_GET['code']))
    {
        if(strlen($_GET['code']) == 128 && ctype_alnum($_GET['code']))
        {
            $registration = new registration();
            $ret = $registration->ValidateFromCode($_GET['code']);
            
            switch($ret)
            {
                case ERROR_NO_DATABASE:
                    $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:laghaimfusion@gmail.com">laghaimfusion@gmail.com</a>');
                    break;
                case ERROR_NO_SENDMAIL:
                    $msg->success('Your LHFusion game account is ready to be used!<br />We want to remind you again that it is not possible to request or change your security code later on<br /><br /><h3 style="margin-bottom:3px;">Account Details</h3><b>Username: </b>'. $registration->username .'<br /><b>Password: </b>'.$registration->password.'<br /><b>Security Code: </b>'.$registration->securitycode.'<br /><br />You can now login to the website and download our game client.<br />Changing your password or email can be done in your Control Panel.<br />We want to thank you for choosing LHFusion and wish you a lot of fun!.');
                    break;
                case ERROR_WRONG_VALIDATION_CODE:
                    $msg->error('A invalid code was entered. If you clicked the link on your email without changing anything then something wend wrong.<br />Please use the "Contact Us" feature or send a email to <a href="mailto:laghaimfusion@gmail.com">laghaimfusion@gmail.com</a>');
                    break;
                case ERROR_SUCCESS:
                    $msg->success('Your LHFusion game account is ready to be used!<br />A email has been sent to your e-mail address with the username and password you chosen as a reminder.<br />Please store this email on a safe place, we want to remind you again that it is not possible to request or change your security code later on<br /><br /><h3 style="margin-bottom:3px;">Account Details</h3><b>Username: </b>'. $registration->username .'<br /><b>Password: </b>'.$registration->password.'<br /><b>Security Code: </b>'.$registration->securitycode.'<br /><br />You can now login to the website and download our game client.<br />Changing your password or email can be done in your Control Panel.<br />We want to thank you for choosing LHFusion and wish you a lot of fun!.');
            }
            
        }
        else
            $msg->error('A invalid code was entered. If you clicked the link on your email without changing anything then something wend wrong.<br />Please use the "Contact Us" feature or send a email to <a href="mailto:laghaimfusion@gmail.com">laghaimfusion@gmail.com</a>');
    }
    
    
    // Terms of Service accepted, now show the registration form
    else if(isset( $_POST['tos']) && $_POST['tos'] == 'accept')
    {
            $tpl->newBlock('regform');
    }
    
    
    // First visit, show the Terms of Service
    else
    {
            $tpl->newBlock('tos');
    }
    
    
    
    $tpl->printToScreen();
    
    