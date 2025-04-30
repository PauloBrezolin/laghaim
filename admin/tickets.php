<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/tickets.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_ticket.php';
    
    loadRecentUsers();
    
    if($admin->login)
    {
        
        $tickets = new Tickets();
        $tickets->getTicketCount();
        
        $tpl->gotoBlock('_ROOT');
        $tpl->assign('newcount', $tickets->num[TICKET_TYPE_NEW]);
        $tpl->assign('waitcount', $tickets->num[TICKET_TYPE_WAITGM]);
        $tpl->assign('opencount', $tickets->num[TICKET_TYPE_WAITUSER]);
        $tpl->assign('closedcount', $tickets->num[TICKET_TYPE_CLOSED]);
        
        
        if($admin->Can(RIGHT_ISADMIN))
        {
            $tpl->newBlock('adminattention');
            $tpl->assign('admincount', $tickets->getAdminTicketCount());
        }
        
	$tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    


