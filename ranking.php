<?php
    header ("Content-type: text/html; charset=UTF-8");

    session_start();

    include_once( "class/class_template.php" );

    $tpl = new TemplatePower( "tpl/ranking.tpl" );

    $tpl->prepare();
    
    include 'inc/globals.php';
    require_once 'cache/rank.php';
    
    $races = array('Bulkan', 'Kailipton', 'Aidia', 'Human', 'Hibrider', 'Perom');
    
    if(isset($_GET['race']) && ctype_digit($_GET['race']) && $_GET['race'] >= 0 && $_GET['race'] <= 5)
    {
        $tpl->newBlock('racerank');
        $race = $_GET['race'];
        $tpl->newBlock('race2');
        $tpl->assign('racename', $races[$race]);

        for($pos = 0; $pos < count($cRank[$race]); $pos++)
        {
            $tpl->newBlock('char2');
            if($pos + 1 > 3)
            {
                $tpl->assign('pos', $pos + 1);
                $tpl->assign('name', $cRank[$race][$pos]['name']);
                $tpl->assign('level', $cRank[$race][$pos]['level']);
            }
            else
            {
                $tpl->assign('pos', '<img src="tpl/images/place'. ($pos + 1) .'.png" />');
                $tpl->assign('name', '<span style="font-weight:bold;">' . $cRank[$race][$pos]['name'] . '</span>');
                $tpl->assign('level', '<span style="font-weight:bold;">' . $cRank[$race][$pos]['level'] . '</span>');
            }
        }        
    }
    else
    {

        $tpl->newBlock('ranking');

        $o = 0;
        for($race = 0; $race < 6; $race++)
        {
            if($o++ == 0)
                $tpl->newBlock('col');

            if($o == 2)
                $o = 0;

            $tpl->newBlock('race');
            $tpl->assign('racename', $races[$race]);
            $tpl->assign('racerankurl', 'ranking.php?race='. $race);
            for($pos = 0; $pos < 25; $pos++)
            {
                $tpl->newBlock('char');
                if($pos + 1 > 3)
                {
                    $tpl->assign('pos', $pos + 1);
                    $tpl->assign('name', $cRank[$race][$pos]['name']);
                    $tpl->assign('level', $cRank[$race][$pos]['level']);
                }
                else
                {
                    $tpl->assign('pos', '<img src="tpl/images/place'. ($pos + 1) .'.png" />');
                    $tpl->assign('name', '<span style="font-weight:bold;">' . $cRank[$race][$pos]['name'] . '</span>');
                    $tpl->assign('level', '<span style="font-weight:bold;">' . $cRank[$race][$pos]['level'] . '</span>');
                }
            }
        }
    }

    $tpl->assignGlobal('rankupdate', TimeDif(time(), $lastupdate + (60*60*2)));

    $tpl->printToScreen();
	
?>


