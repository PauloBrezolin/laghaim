<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/search/search.tpl');
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    function Show($text, $itemsearch = false)
    {
        global $tpl;
        $tpl->newBlock('showpage');
        $tpl->assign('searchtype_text', $text);
        $tpl->assign('form_action', $_GET['type']);        
    }
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        if(isset($_GET['type']))
        {
            if($admin->Can(RIGHT_SEARCHUSER) && $_GET['type'] == 'username')
                Show('Username');
            
            else if($admin->Can(RIGHT_SEARCHCHAR) && $_GET['type'] == 'charname')
                Show('Character Name');
            
            else if($admin->Can(RIGHT_SEARCHNAMECHANGE) && $_GET['type'] == 'namechange')
                Show('Name Change');
            
            else if($admin->Can(RIGHT_SEARCHGUILD) && $_GET['type'] == 'guild')
                Show('Guild Name');
            
            else if($admin->Can(RIGHT_SEARCHEMAIL) && $_GET['type'] == 'email')
                Show('E-mail Address');
            
            else if($admin->Can(RIGHT_SEARCHIP) && $_GET['type'] == 'ip')
                Show('IP Address');
            
            else if($admin->Can(RIGHT_SEARCHIP) && $_GET['type'] == 'mac')
                Show('Mac Address');
            
            else
                $tpl->newBlock('noperm');
        }

	$tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    


