<?php

    session_start();

    include_once( "class/class_template.php" );
    $tpl = new TemplatePower("tpl/tickets.tpl");

    $tpl->prepare();

    include 'inc/globals.php';
    require_once 'class/class_tickets.php';

    require_once 'library/HTMLPurifier.auto.php';

    $hp_config = HTMLPurifier_Config::createDefault();
    $hp_config->set('HTML.Allowed', 'p,b,a[href],i,br,span[style],div[style],ol,ul,li,img[src]');

    $purifyer = new HTMLPurifier($hp_config);

    $tickets = new Tickets();
    $user = user::getInstance();

    if (isset($_GET['logout']) && $_GET['logout'] == 'true')
        $_SESSION['ticket'] = '';
    
    if(!$tickets->isDbConnect())
        $msg->error('Currently there is no database connection available.<br />Please try again later');
    else
    {
        if (isset($_GET['t']))
        {
            if ($_GET['t'] == 'new')
            {
                $shownew = true;
                if (isset($_POST['action']) && $_POST['action'] == 'postnew')
                {
                    if (!isset($_POST['email']))
                        $msg->error('You need to enter a email address');
                    elseif (!validEmail($_POST['email']))
                        $msg->error('You need to enter a valid email address');
                    elseif (!isset($_POST['title']))
                        $msg->error('You need to enter a title');
                    elseif (strlen($_POST['title']) < 3 || strlen($_POST['title']) > 200)
                        $msg->error('The title need to be atleast 3 characters long and smaller then 200');
                    elseif (strlen($_POST['msg']) < 3 || strlen($_POST['msg']) > 2000000)
                        $msg->error('The message needs to be atleast 3 characters long');
                    else
                    {
                        if ($tickets->Create($_POST['email'], $_POST['title'], $_POST['msg'], $_POST['code'], $_POST['username'], $_POST['charname']))
                        {
                            $msg->success('Your ticket is added to the database.<br />When your ticket gets answered you will receive a notification on your email address.');
                            $shownew = false;
                        }
                        else
                            $msg->error('Error creating ticket, please contact the Administrator');
                    }
                }

                if ($shownew)
                {
                    $tpl->newBlock('newticket');

                    if ($user->login)
                    {
                        $tpl->assign('email', $user->email);
                        $tpl->assign('username', $user->name);
                    }
                }
            }
            else if ($_GET['t'] == 'view')
            {

                if (isset($_POST['action']) && $_POST['action'] == 'loginticket')
                {
                    if (isset($_POST['email']))
                    {
                        if ($tickets->TicketCount($_POST['email'], $_POST['code']))
                            $_SESSION['ticket'] = $_POST['email'] . ':' . @$_POST['code'];
                        else
                            $msg->error('No ticket found with this email and code combination');
                    }
                }

                if (isset($_SESSION['ticket']) && strlen($_SESSION['ticket']) > 0)
                {
                    $vars = explode(':', $_SESSION['ticket']);
                    if (count($vars) != 2)
                        $msg->error('Something wend wrong here');
                    else
                    {

                        if (isset($_GET['close']) && ctype_digit($_GET['close']))
                            $tickets->SetState($_GET['id'], $vars[0], $vars[1], TICKET_TYPE_CLOSED);

                        if (isset($_GET['i']) && ctype_digit($_GET['i']))
                        {

                            $ticket = $tickets->GetTicket($_GET['i'], $vars[0], $vars[1]);
                            if ($ticket instanceof stTicket)
                            {
                                $tpl->assignGlobal('url_close', 'tickets.php?t=view&close=' . $ticket->id);
                                $tpl->assignGlobal('url_back', 'tickets.php?t=view');
                                $tpl->assignGlobal('url_new', 'tickets.php?t=new');

                                if (isset($_POST['action']) && $_POST['action'] == 'addreply' && isset($_POST['msg']) && strlen($_POST['msg']) > 1)
                                {
                                    $tickets->AddReply($ticket->id, $_POST['msg']);
                                    $tickets->UpdateStatus($ticket->id, TICKET_TYPE_WAITGM);
                                }

                                $tpl->newBlock('myticket');
                                $tpl->assign('title', $ticket->type);
                                $tpl->assign('id', $ticket->id);
                                $tpl->assign('username', (strlen($ticket->username) > 0 ? $ticket->username : '<i>No username specified</i>'));
                                $tpl->assign('charname', (strlen($ticket->charname) > 0 ? $ticket->charname : '<i>No character name specified</i>'));
                                $tpl->assign('msg', $purifyer->purify(nl2br($ticket->message)));

                                if ($ticket->state != TICKET_TYPE_CLOSED)
                                {
                                    $tpl->newBlock('newreply');
                                    $tpl->assign('action', 'tickets.php?t=view&i=' . $ticket->id);
                                }

                                if ($ticket->replys > 0)
                                {
                                    $replys = $tickets->GetReplys($ticket->id);

                                    foreach ($replys as $reply)
                                    {
                                        $tpl->newBlock('reply');
                                        $tpl->assign('msg', $purifyer->purify(nl2br($reply->message)));
                                        $tpl->assign('date', date('l, d F Y - H:i:s', $reply->date));

                                        switch ($reply->user)
                                        {
                                            case 'Administrator':
                                                $tpl->assign('user', 'Administrator');
                                                break;
                                            case 'Player':
                                                $tpl->assign('user', 'You');
                                                break;
                                            default:
                                                $tpl->assign('user', 'Staff');
                                                break;
                                        }
                                    }
                                }
                            }
                            else
                                $msg->error('No ticket found with this id, email and code combination');
                        }
                        else
                        {
                            $ticketList = $tickets->getTicketList($vars[0], $vars[1]);

                            if (count($ticketList) > 0)
                            {
                                $tpl->newBlock('viewtickets');
                                foreach ($ticketList as $cur)
                                {
                                    $tpl->newBlock('ticketlist');
                                    $tpl->assign('id', $cur->id);
                                    $tpl->assign('url', 'tickets.php?t=view&i=' . $cur->id);
                                    $tpl->assign('title', htmlspecialchars($cur->type));
                                    $tpl->assign('replys', $cur->replys);
                                    $tpl->assign('icon', $cur->getIcon());
                                }
                            }
                        }
                    }
                }
                else
                {
                    $tpl->newBlock('loginticket');
                }
            }
        }
        else
        {
            $tpl->newBlock('base');
        }
    }

    $tpl->printToScreen();
?>