<?php

    session_start();

    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/search/search_worker.tpl');

    $tpl->prepare();

    require_once 'inc/globals.php';
    require_once 'class/class_search.php';

    if ($admin->login)
    {
        if (isset($_POST['action']))
        {
            if (!isset($_POST['value']))
                $msg->error('Please enter something to search');
            else if (strlen($_POST['value']) <= 2)
                $msg->error('U have to enter atleast 3 characters');
            else
            {
                $search = new Search($_POST['value']);

                if ($_POST['action'] == 'username' && $admin->Can(RIGHT_SEARCHUSER))
                    $search->findUsername();
                else if ($_POST['action'] == 'charname' && $admin->Can(RIGHT_SEARCHCHAR))
                    $search->findCharname();
                else if ($_POST['action'] == 'email' && $admin->Can(RIGHT_SEARCHEMAIL))
                    $search->findEmail();
                else if ($_POST['action'] == 'namechange' && $admin->Can(RIGHT_SEARCHNAMECHANGE))
                    $search->findNamechange();
                else if ($_POST['action'] == 'ip' && $admin->Can(RIGHT_SEARCHIP))
                    $search->findIP();
                else if ($_POST['action'] == 'mac' && $admin->Can(RIGHT_SEARCHIP))
                    $search->findMac();
                else if ($_POST['action'] == 'guild' && $admin->Can(RIGHT_SEARCHGUILD))
                    $search->findGuild();
                else if ($_POST['action'] == 'item' && $admin->Can(RIGHT_SEARCHIP))
                    $search->findItem();
                
                $tpl->assignGlobal('found', $search->results);
            }
        }

	$tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }