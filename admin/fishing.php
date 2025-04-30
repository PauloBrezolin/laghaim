<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/fishing.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    
    $fishes = array(
        'Pyramisa',
	'Mandarin',
	'Anchovy',
	'Mangdungeo',
	'Trout',
	'Snakehead',
	'Cutlass',
	'Flounder',
	'Shark',
	'Whale'    
    );
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_VIEWLASTLOGIN))
        {
    
            $user = new User();
            if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
            {

                if($user->isUser($_GET['uid']))
                {
                    
                    $query = sprintf("SELECT a_fish_index, a_fish_count, a_fish_rating FROM %s.t_fish WHERE a_user_index = :uid ORDER BY a_fish_index", Config::DB_CHAR);
                    $dbh = $db->prepare($query);
                    $dbh->bindParam(':uid', $user->gid);
                    $dbh->execute();
                    while($r = $dbh->fetch())
                    {
                        $tpl->newBlock('fishlist');
                        $tpl->assign('fish', $fishes[$r['a_fish_index']]);
                        $tpl->assign('num', $r['a_fish_count']);
                        $tpl->assign('rate', $r['a_fish_rating']);
                    }
                    
                    
                }
                else
                   $msg->error('No user found with this id');                
            }
            else
                $msg->error('No user id given');
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

