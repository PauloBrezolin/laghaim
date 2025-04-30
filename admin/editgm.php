<?php

    session_start();
    $bn = basename(__FILE__); 
    
    
    require_once 'inc/templatepower.php';

    
    
    $tpl = new TemplatePower('tpl/pages/settings/editgm.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 

    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    
    
    if($admin->login)
    {
        
        
        if($admin->Permission(RIGHT_EDITGMS))
        {          
        
            if(isset($_GET['gm']) && ctype_digit($_GET['gm']))
            {
                $query = sprintf("SELECT * FROM %s.t_admininfo WHERE a_index = :gmid", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':gmid', $_GET['gm'], PDO::PARAM_INT);
                $dbh->execute();

                $r = $dbh->fetch();

                if($r != null)
                {
                    $tpl->newBlock('editgm');
                    $tpl->assign('gmid', $r['a_index']);
                    $tpl->assign('username', $r['a_username']);
                    $tpl->assign('displayname', $r['a_displayname']);

                    if($r['a_enable'] == 1)
                        $tpl->assign('enable', 'checked');

                    $role = $r['a_role'];

                    $query = sprintf("SELECT a_index, a_name FROM %s.t_roles", Config::DB_WEB);
                    $dbh = $db->prepare($query);
                    $dbh->execute();

                    $result = $dbh->fetchAll();
                    foreach($result as $r)
                    {

                        $tpl->newBlock('rolelist2');
                        $tpl->assign('id', $r['a_index']);
                        $tpl->assign('name', $r['a_name']);

                        if($r['a_index'] == $role)
                            $tpl->assign('selected', 'selected="selected"');
                    }


                }


            }
            else
            {
                $tpl->newBlock('newgm');

                $query = sprintf("SELECT a_index, a_name FROM %s.t_roles", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->execute();

                $result = $dbh->fetchAll();
                foreach($result as $r)
                {
                    $tpl->newBlock('rolelist');
                    $tpl->assign('id', $r['a_index']);
                    $tpl->assign('name', $r['a_name']);
                }            
            }
        }

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

