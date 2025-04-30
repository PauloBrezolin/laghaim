<?php

    session_start();
    
    require_once 'inc/templatepower.php';

    
    $tpl = new TemplatePower('tpl/pages/search/playercount.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';    
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_VIEWONLINEPLAYERS))
        {
            
        }


        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>
