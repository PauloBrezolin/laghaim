<?php

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/tos.tpl" );
    $tpl->prepare();

    $tpl->printToScreen();
    
    