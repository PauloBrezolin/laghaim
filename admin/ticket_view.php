<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/tickets/ticket_view.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_ticket.php';
    require_once 'library/HTMLPurifier.auto.php';
    
    $hp_config = HTMLPurifier_Config::createDefault();
    $hp_config->set('HTML.Allowed', 'p,b,a[href],i,br,span[style],div[style],ol,ul,li,img[src]');
    
    $purifyer = new HTMLPurifier($hp_config);   
    
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_BANUNBAN))
        {
            $tickets = new Tickets();
            
            if(isset($_GET['tid']) && ctype_digit($_GET['tid']))
            {
                
                if(isset($_GET['action']))
                {
                    if($_GET['action'] == 'close')
                        if($tickets->haveReplies($_GET['tid']))
                            $tickets->UpdateStatus ($_GET['tid'], TICKET_TYPE_CLOSED);
                        else
                            echo 'Please don\'t close a ticket without reply<br />';
                        
                    else if($_GET['action'] == 'open')
                        $tickets->UpdateStatus ($_GET['tid'], TICKET_TYPE_WAITGM);
                    else if($_GET['action'] == 'flagadmin')
                        $tickets->FlagAdmin($_GET['tid'], 1);     
                    else if($_GET['action'] == 'unflagadmin')
                        $tickets->FlagAdmin($_GET['tid'], 0);     
                    else if($_GET['action'] == 'addreply')
                    {
                        $tickets->AddReply($_GET['tid'], $_POST['msg']);
                        $tickets->SendReplyMail($_GET['tid'], $_POST['msg']);
                        $tickets->UpdateStatus($_GET['tid'], TICKET_TYPE_WAITUSER);
                    }
                    else if($_GET['action'] == 'move')
                        $tickets->Move($_GET['tid'], $_POST['cat']);
                }
                
                
                $ticket = $tickets->GetTicket($_GET['tid']);
                if($ticket instanceof stTicket)
                {
                    $admin->TicketStatus($ticket->id, GTS_READING);
                    $tickets->GetGMWorking($ticket->id);
                    
                    $tpl->newBlock('viewticket');
                    $tpl->assignGlobal('tid', $ticket->id);
                    $tpl->assign('lastpost', $ticket->lastpost);
                    $tpl->assign('username', $ticket->username);
                    $tpl->assign('charactername', $ticket->charname);
                    $tpl->assign('email', $ticket->email);
                    $tpl->assign('state', $ticket->state);
                    $tpl->assign('created', TimeAgo( $ticket->create_date , time()));
                    $tpl->assign('type', $ticket->type);
                    $tpl->assign('message', $purifyer->purify(nl2br($ticket->message)));
                    $tpl->assign('ip', $ticket->ip);
                    $tpl->assign('date', date('Y-m-d H:i:s', $ticket->create_date));
                    
                    $ruid = ResolveUser($ticket->username);
                    if($ruid > 0)
                        $tpl->assign('resolve', '[ <a href="user.php?uid='.$ruid.'" target="_blank">Go to user panel </a> ]');
                        
                    if($ticket->state != TICKET_TYPE_CLOSED)
                    {
                        $tpl->newBlock('addreply');
                        $tpl->assign('closeurl', 'ticket_view.php?tid=' . $ticket->id . '&action=close');
                        $tpl->assign('action', 'ticket_view.php?tid=' . $ticket->id . '&action=addreply');
                        $tpl->assign('action_move', 'ticket_view.php?tid=' . $ticket->id . '&action=move');
                        
                        if(!$ticket->needadmin)
                            $tpl->assign('requestadmin', ' | <a href="ticket_view.php?tid=' . $ticket->id . '&action=flagadmin" class="menulink">Request Administrator Attention</a>');
                        else
                            $tpl->assign('requestadmin', ' | <a href="ticket_view.php?tid=' . $ticket->id . '&action=unflagadmin" class="menulink">Remove Admin Attention</a>');
                    }
                    else
                    {
                        $tpl->newBlock('open');
                        $tpl->assign('openurl', 'ticket_view.php?tid=' . $ticket->id . '&action=open');
                    }
                    
                    
                    if($ticket->replys > 0)
                    {
                        $replys = $tickets->GetReplys($ticket->id);
                        
                        foreach($replys as $reply)
                        {
                            $tpl->newBlock('reply');
                            $tpl->assign('msg', $purifyer->purify(nl2br($reply->message)));
                            $tpl->assign('date', date('l, d F Y - H:i:s' , $reply->date));
                            $tpl->assign('user', $reply->user);

                            if($reply->user == 'Player')
                            {
                                $tpl->assign('color', '#a7947c');
                                $tpl->assign('ct', '#d8e0e7');
                                $tpl->assign('cp', '#eff2f5');
                            }
                            else
                            {
                                $tpl->assign('color', '#a7947c');
                                $tpl->assign('ct', '#dfdfdf');
                                $tpl->assign('cp', '#f2f2f2');
                            }

                            if($admin->Can(RIGHT_SEARCHIP) && $reply->user == 'Player')
                                $tpl->assign('ip', '[' . $ticket->ip . ']');
                            else
                                $tpl->assign('ip', '');
                        }
                    }
                    
                    
                    $mytickets = $tickets->GetRelated($ticket);
                    if(count($mytickets) > 0)
                    {
                        $tpl->newBlock('related');
                        
                        /* @var $mytickets stTicket */
                        foreach($mytickets as $cur)
                        {
                            $tpl->newBlock('relticket');
                            $tpl->assign('create', date('Y-m-d H:i:s', $cur->create_date));
                            $tpl->assign('tid', $cur->id);
                            $tpl->assign('lastpost', $cur->lastpost);
                            $tpl->assign('username', $cur->username);
                            $tpl->assign('email', $cur->email);
                            $tpl->assign('state', $cur->state);
                            $tpl->assign('title', $cur->type);
                            $tpl->assign('url', 'ticket_view.php?tid=' . $cur->id);
                            $tpl->assign('replys', $cur->replys);

                            if($cur->state == TICKET_TYPE_CLOSED)
                                $tpl->assign('icon', 'tpl/img/ticket_closed.png');
                            elseif($cur->state == TICKET_TYPE_WAITUSER)
                                $tpl->assign('icon', 'tpl/img/ticket_normal.gif');                        
                            else
                                $tpl->assign('icon', 'tpl/img/ticket_new.png');                            
                        }
                    }                    


                }
                else
                    $msg->error('No ticket found with this id');
            }
               
           
        }

	$tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    


