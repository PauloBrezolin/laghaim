<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/index.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    loadRecentUsers();
    
    if($admin->login)
    {
        
        $i = 0;
        if($admin->Can(RIGHT_SEARCHUSER)) $searchMenu[] = 'search.php?type=username:User Name';
        if($admin->Can(RIGHT_SEARCHCHAR)) $searchMenu[] = 'search.php?type=charname:Character Name';
        if($admin->Can(RIGHT_SEARCHNAMECHANGE)) $searchMenu[] = 'search.php?type=namechange:Name Changes';
        if($admin->Can(RIGHT_SEARCHGUILD)) $searchMenu[] = 'search.php?type=guild:Guild Name';
        if($admin->Can(RIGHT_SEARCHEMAIL)) $searchMenu[] = 'search.php?type=email:E-mail';
        if($admin->Can(RIGHT_SEARCHIP)) $searchMenu[] = 'search.php?type=ip:IP Address';
        if($admin->Can(RIGHT_SEARCHCHAR)) $searchMenu[] = 'search_item.php:Search Item';
        if($admin->Can(RIGHT_IPBAN)) $searchMenu[] = 'ipban.php:IP Banning';
        if($admin->Can(RIGHT_IPBAN)) $searchMenu[] = 'logfind.php:LogFiles';
        
        foreach($searchMenu as $menu)
        {
            $vars = explode(':', $menu);
            $tpl->newBlock('searchmenu');
            $tpl->assign('url', $vars[0]);
            $tpl->assign('name', $vars[1]);
        }

        $tpl->newBlock('statistics');
        $tpl->assign('banlist', '<li><a href="banlist.php?p=A" class="menulink">Ban List</a></li>');
        $tpl->assign('usershop', '<li><a href="usershop.php" class="menulink">Shop List</a></li>');
        
        if($admin->Can(RIGHT_VIEWTOP100DONATOR))
            $tpl->assign('donatetop100', '<li><a href="donatetop100.php" class="menulink">Top 100 donators</a></li>');
        
        if($admin->Can(RIGHT_VIEWONLINEPLAYERS))
        {
            $tpl->assign('onlineplayers', '<li><a href="onlineplayers.php" class="menulink">Online Players</a></li>');   
            $tpl->assign('playergraph', '<li><a href="playercount.php" class="menulink">Online Player History</a></li>');   
        }

        if($admin->Can(RIGHT_ISADMIN) || $admin->Can(RIGHT_ISHGM))
            $tpl->assign('stafflist', '<li><a href="stafflist.php" class="menulink">Staff List</a></li>');
        
        if($admin->Can(RIGHT_ISADMIN))
            $tpl->assign('donations', '<li><a href="donations.php" class="menulink">Donations</a></li>');
        
        if($admin->Can(RIGHT_VIEWINVENTORY))
            $tpl->assign('p2list', '<li><a href="p2list.php" class="menulink">P2 Pet Checklist</a></li>');
        

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

