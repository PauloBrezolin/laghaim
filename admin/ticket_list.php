<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/tickets/ticket_list.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_ticket.php';
    
    $types = array
    (
        'Waiting User Reply',
        'New Tickets',
        'Waiting GM Reply',
        'Closed Tickets'
    );
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_BANUNBAN))
        {
            $type = -1;
            $needadmin = false;            

            if(isset($_GET['type']) && ctype_digit($_GET['type']))
            {
                $type = $_GET['type'];
                $tpl->assignGlobal('ticketsname', $types[$type]);
            }
            else if(isset($_GET['admin']))
            {
                $needadmin = true;
                $tpl->assignGlobal('ticketsname', 'Tickets for Administrator');
            }
            else
                $tpl->assignGlobal('ticketsname', 'All recent tickets');
            
            
            $tickets = new Tickets();
            $tlist = $tickets->getTicketList($type, $needadmin);
            
            foreach($tlist as $ticket)
            {
                $tpl->newBlock('list');
                $tpl->assign('create', date('Y-m-d H:i:s', $ticket->create_date));
                $tpl->assign('tid', $ticket->id);
                $tpl->assign('lastpost', $ticket->lastpost);
                $tpl->assign('lastpost_user', $ticket->lastpost_user);
                $tpl->assign('username', $ticket->username);
                $tpl->assign('charname', $ticket->charname);
                $tpl->assign('email', $ticket->email);
                $tpl->assign('state', $ticket->state);
                $tpl->assign('title', $ticket->type);
                $tpl->assign('url', 'ticket_view.php?tid='.$ticket->id);
                $tpl->assign('replys', $ticket->replys);

                if($ticket->state == TICKET_TYPE_CLOSED)
                    $tpl->assign('icon', 'tpl/img/ticket_closed.png');
                elseif($ticket->state == TICKET_TYPE_WAITUSER)
                    $tpl->assign('icon', 'tpl/img/ticket_normal.gif');                        
                else
                    $tpl->assign('icon', 'tpl/img/ticket_new.png');

                if($ticket->needadmin)
                    $tpl->assign('admin', '<span style="color:red; font-weight:bold; font-size:10px;">[ADMIN]</span> ');
            }
        }

		$tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    


