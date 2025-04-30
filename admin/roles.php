<?php

    session_start();
    $bn = basename(__FILE__); 
    
    
    require_once 'inc/templatepower.php';

    
    
    $tpl = new TemplatePower('tpl/pages/settings/roles.tpl');
    
    $tpl->assignInclude('noperm', 'tpl/pages/noperm.tpl'); 
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    
    
    if($admin->login)
    {
        
        if($admin->Permission(RIGHT_EDITROLE))
        {  
             
            if(isset($_GET['role']) && ctype_digit($_GET['role']))
            {
                $query = sprintf("SELECT * FROM %s.t_roles WHERE a_index = :role", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->bindParam(':role', $_GET['role'], PDO::PARAM_INT);

                $dbh->execute();
                $r = $dbh->fetch();

                if($r != null)
                {
                    $tpl->newBlock('editrole');
                    $tpl->assign('roleid', $r['a_index']);
                    $tpl->assign('rolename', $r['a_name']);
                    $tpl->assign('rolecolor', $r['a_color']);

                    $rights = $r['a_rights'];
                    for($i=0; $i<200; $i++)
                    {
                        if($rights[$i] == '1')
                            $tpl->assign('c' . $i, 'checked');
                    }
                }

            }
            else
                $tpl->newBlock('newrole');
        }
      

        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

