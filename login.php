<?php

    session_start();

    include_once( "class/class_template.php" );
    $tpl = new TemplatePower( "tpl/login.tpl" );

    $tpl->prepare();
    $tpl->printToScreen();
    
?>

