<?php

    session_start();

    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/func.tpl');

    $tpl->prepare();

    require_once 'inc/globals.php';
    loadRecentUsers();

    if ($admin->login)
    {



        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }


