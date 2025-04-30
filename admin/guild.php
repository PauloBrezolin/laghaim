<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/guild.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    loadRecentUsers();
    require_once 'class/class_guild.php';
    
    if($admin->login)
    {
    
        $guild = new Guild();
        if(isset($_GET['gid']) && ctype_digit($_GET['gid']))
        {
            
            if($guild->isGuild($_GET['gid']))
            {
            

              
            }
            else
                $msg->error('No user found with this id');
        }
        else
            $msg->error('No user id given');           

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>


