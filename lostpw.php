<?php
    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/lostpw.tpl" );


    $tpl->prepare();

    require_once 'inc/globals.php';
    
    $user = user::getInstance();
    
    if($user == null)
        $user = new user ();
    
    if(!$user->login)
    {        
        if(isset( $_GET['q']))
        {
            if( $_GET['q'] == 'lost')
            {
                if(isset($_POST['action']) && $_POST['action'] == 'sendmail')
                {
                    if(!$db = db::getConnection())
                        $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                    elseif( !isset( $_POST['req_uname']))
                        $msg->error('Please enter a username');
                    elseif(!strbtwn($_POST['req_uname'], 3, 15))
                        $msg->error('Username have to be between 3 and 15 characters long');
                    elseif(!ctype_alnum($_POST['req_uname']))
                        $msg->error('Username can only contain numbers and letters');
                    elseif( !isset( $_POST['req_scode']) )
                        $msg->error('You forgot to enter a security code');
                    elseif( !ctype_digit($_POST['req_scode']) )
                        $msg->error('Your security code can only contain numbers');
                    else
                    {
                        $ret = $user->getUserFromName($_POST['req_uname']);
                        if($ret == ERROR_NO_DATABASE)
                            $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                        else if($ret == ERROR_WRONG_LOGIN)
                            $msg->error('This username has not been found in our system.<br />If you really can not remember your username, please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a><br />To support your case its best to give as much information as you know about the account.');
                        else if( !$user->isSecurityCode($_POST['req_scode']))
                            $msg->error('Your security code does not match the username<br />If you really can not remember your security code, please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a><br />To support your case its best to give as much information as you know about the account.');
                        else 
                        {
                            $ret = $user->requestPassword();
                            switch($ret)
                            {
                                case ERROR_NO_DATABASE:
                                    $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                                    break;
                                case ERROR_NO_SENDMAIL:
                                    $msg->error('A email could not be sent, please try again later<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                                    break;
                                case ERROR_SUCCESS:
                                    $msg->success('A email with instructions has been sent to your email address <i>' . htmlspecialchars($user->email) . '</i>.<br />Please find this email and follow the instructions inside the email to recover your password.<br />Usually this email is received directly but it could take a few minutes.<br />If you did not receive a email at all please use the "Contact Us" feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                                    break;
                            }
                        }
                    }
                }
                else
                {
                    $tpl->newBlock('lostpwform');
                }

            }
            elseif( $_GET['q'] == 'code')
            {
                if(isset($_POST['action']) && $_POST['action'] == 'changepw')
                {
                    if(!$db = db::getConnection())
                        $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                    elseif( !isset( $_POST['cpw_uname']))
                        $msg->error('Please enter a username');
                    elseif(!strbtwn($_POST['cpw_uname'], 3, 15))
                        $msg->error('username has to be between 3 and 15 characters long');
                    elseif(!ctype_alnum($_POST['cpw_uname']))
                        $msg->error('Username can only contain numbers and letters');                    
                    elseif( !isset($_POST['cpw_mcode']))
                        $msg->error('You forgot to enter your mail code');
                    elseif( !ctype_alnum($_POST['cpw_mcode']) || strlen($_POST['cpw_mcode']) != 12)
                        $msg->error('Mailcode is not in the right format');
                    elseif( !isset( $_POST['cpw_pw1']) || !isset( $_POST['cpw_pw2']))
                        $msg->error('Make sure to enter both password fields');
                    elseif(!strbtwn($_POST['cpw_pw1'], 5, 30))
                        $msg->error('Password has to be between 5 and 30 characters long');
                    elseif( $_POST['cpw_pw1'] != $_POST['cpw_pw2'])
                        $msg->error('The passwords u entered dont match');
                    elseif( !isset( $_POST['cpw_scode']) )
                        $msg->error('You forgot to enter a security code');
                    else
                    {
                        $ret = $user->getUserFromName($_POST['cpw_uname']);
                        if($ret == ERROR_NO_DATABASE)
                            $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                        else if($ret == ERROR_WRONG_LOGIN)
                            $msg->error('This username has not been found in our system.<br />If you really can not remember your username, please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a><br />To support your case its best to give as much information as you know about the account.');
                        else if( !$user->isSecurityCode($_POST['cpw_scode']))
                            $msg->error('Your security code does not match the username<br />If you really can not remember your security code, please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a><br />To support your case its best to give as much information as you know about the account.');
                        else 
                        {
                            $ret = $user->setPasswordFromCode($_POST['cpw_mcode'], $_POST['cpw_pw1']);
                            switch($ret)
                            {
                                case ERROR_NO_DATABASE:
                                    $msg->error('No database connection is available at this moment, please try again in a few minutes.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                                    break;
                                case ERROR_NO_USER:
                                    $msg->error('No user data could be retrieved from the database, please try again later.<br />If this problem persists please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                                    break;
                                case ERROR_WRONG_CODE:
                                    $msg->error('This code could not be found in our database.<br />If you are sure that the code you used is corredt, please use the Contact Us feature or send a email to <a href="mailto:support@genericname.lc">support@genericname.lc</a>');
                                    break;
                                case ERROR_SUCCESS:
                                    $msg->success('Your password was succesfully changed.<br />Welcome back!');
                                    break;
                                
                            }
                        }
                    }
                }
                else
                {
                    $tpl->newBlock('entercodeform');
                    
                    if(isset($_GET['code']) && ctype_alnum($_GET['code']))
                        $tpl->assign('code', $_GET['code']);
                }                
            }
            else
                $tpl->newBlock('lostpwform');
        }
        else        
            $tpl->newBlock('lostpwform');
    }
    else
        $tpl->newBlock('needlogout');
    
    
    $tpl->printToScreen();
?>
