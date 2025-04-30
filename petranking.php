<?php
    header ("Content-type: text/html; charset=UTF-8");

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/petranking.tpl" );

    $tpl->prepare();
    
    include 'inc/globals.php';
    require_once 'cache/rank.php';
    
    $races = array('Bulkan', 'Kailipton', 'Aidia', 'Human', 'Hibrider', 'Perom');
    $petclass = ['Labiyong', 'Feragon', 'Feragon', 'Drake'];
    $rankLimit = 25;
    
    for($i=0; $i<$rankLimit; $i++) {
        $tpl->newBlock('list');
        $tpl->assign('position', $i+1);
        $tpl->assign('charname', $cRankPet[$i]['charname']);
        $tpl->assign('charrace', $races[$cRankPet[$i]['race']]);
        $tpl->assign('charlevel', $cRankPet[$i]['charlevel']);
        $tpl->assign('petclass', $petclass[$cRankPet[$i]['class']]);
        $tpl->assign('petname', $cRankPet[$i]['petname']);
        $tpl->assign('petlevel', $cRankPet[$i]['level']);
    }

    $tpl->assignGlobal('rankupdate', TimeDif(time(), $lastupdate + (60*60*2)));
    
    $tpl->printToScreen();
	
?>


