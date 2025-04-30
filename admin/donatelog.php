<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/user/donatelog.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl');    
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    require_once 'class/class_user.php';
    
    if($admin->login)
    {
        if($admin->Permission(RIGHT_VIEWDONATIONS))
        {
    
            $user = new User();
            if(isset($_GET['uid']) && ctype_digit($_GET['uid']))
            {

                if($user->isUser($_GET['uid']))
                {
                    
                    if(isset($_POST['action']) && $_POST['action'] == 'addcash' && $admin->Can(RIGHT_ADDCASH))
                    {
                        $user->AddCash($user->id, $_POST['cash'], $_POST['reason']);
                    }
                    
                    

                    $query = sprintf("SELECT * FROM %s.t_donate_log WHERE a_user_index = :uid", Config::DB_WEB);
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':uid', $user->id, PDO::PARAM_INT);

                    if($dbh->execute())
                    {

                        $tpl->newBlock('donatelog');

                        $result = $dbh->fetchAll();

                        $cash = 0;
                        $dollar = 0;
                        foreach($result as $r)
                        {

                            $tpl->newBlock('list');

                            $tpl->assign('date', date('l, d F Y - H:i:s' , $r['a_timestamp']));

                            if(intval($r['a_points']) > 0)
                                $tpl->assign('points', AddDots($r['a_points']));
                            else
                                $tpl->assign('points', '<span style="color:red; font-weight:bold">'. AddDots($r['a_points']) . '</span>');

                            $tpl->assign('gm', $r['a_gm']);
                            $tpl->assign('ref', $r['a_ref']); 
                            $tpl->assign('reason', $r['a_reason']);

                            $value = 0;
                            if($r['a_gm'] == 'BETAGAMECARD')
                                $value = $r['a_points'] / 4000;
                            
                            $tpl->assign('value', $value);
                            
                            $cash += $r['a_points'];
                            $dollar += $value;


                        }
                        
                        $tpl->assignGlobal('total_cash', AddDots($cash));
                        $tpl->assignGlobal('total_dollar', AddDots($dollar));

                        if($admin->Can(RIGHT_ADDCASH))
                            $tpl->newBlock('addform');
                        
                    }
                    else
                        $msg->error('Error!');

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


