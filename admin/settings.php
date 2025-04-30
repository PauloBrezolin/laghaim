<?php

    session_start();
    
    require_once 'inc/templatepower.php';
    $tpl = new TemplatePower('tpl/pages/settings.tpl');
    
    $tpl->prepare();
    
    require_once 'inc/globals.php';
    loadRecentUsers();
    
    if($admin->login)
    {
        if(isset($_POST['action']))
        {
            if($_POST['action'] == 'newrole' && $admin->Can(RIGHT_EDITGMS))
            {
                $right = '';
                for($i = 0; $i<200; $i++)
                {
                    if(isset($_POST['c' . $i]) && $_POST['c' . $i] == 'yes')
                        $right .= '1';
                    else
                        $right .= '0';
                }
                    
                if(isset($_POST['rolename']) && strlen($_POST['rolename']) > 3)
                {
                    $query = sprintf("INSERT INTO %s.t_roles (a_name, a_rights, a_color) VALUES(:name, :rights, :color)", Config::DB_WEB);
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':name', $_POST['rolename'], PDO::PARAM_STR);
                    $dbh->bindParam(':rights', $right, PDO::PARAM_STR);
                    
                    if($_POST['rolecolor'] == '')
                        $dbh->bindParam(':color', '000000');
                    else
                        $dbh->bindParam(':color', $_POST['rolecolor']);
                         

                    if(!$dbh->execute())
                        echo 'Error creating role';
                }
                        
            }
            
            if($_POST['action'] == 'editrole' && $admin->Can(RIGHT_EDITGMS))
            {
                $right = '';
                for($i = 0; $i<200; $i++)
                {
                    if(isset($_POST['c' . $i]) && $_POST['c' . $i] == 'yes')
                        $right .= '1';
                    else
                        $right .= '0';
                }
                    
                if(isset($_POST['rolename']) && strlen($_POST['rolename']) > 3)
                {
                    $query = sprintf("UPDATE %s.t_roles SET a_name = :name, a_rights = :rights, a_color = :color WHERE a_index = :roleid", Config::DB_WEB);
                    $dbh = $db->prepare($query);

                    $dbh->bindParam(':name', $_POST['rolename'], PDO::PARAM_STR);
                    $dbh->bindParam(':rights', $right, PDO::PARAM_STR);
                    $dbh->bindParam(':roleid', $_POST['roleid'], PDO::PARAM_INT);
                    
                    if($_POST['rolecolor'] == '')
                        $dbh->bindParam(':color', '000000');
                    else
                        $dbh->bindParam(':color', $_POST['rolecolor']);                    

                    if(!$dbh->execute())
                        echo 'Error updating role';
                }
                        
            }   
            
            
            if($_POST['action'] == 'editgm' && $admin->Can(RIGHT_EDITGMS))
            {
                if(isset($_POST['enable']) && $_POST['enable'] == 'yes')
                    $enable = 1;
                else
                    $enable = 0;
                
                if(isset($_POST['password']) && strlen($_POST['password']) > 0)
                {
                    $password = md5($_POST['password']);
                    
                    $query = sprintf("UPDATE %s.t_admininfo SET a_username = :username, a_password = :password, a_displayname = :displayname, a_role = :role, a_enable = :enable WHERE a_index = :gmid", Config::DB_WEB);
                    $dbh = $db->prepare($query);
                    
                    $dbh->bindParam(':username', $_POST['username']);
                    $dbh->bindParam(':password', $password);
                    $dbh->bindParam(':displayname', $_POST['displayname']);
                    $dbh->bindParam(':role', $_POST['role']);
                    $dbh->bindParam(':enable', $enable);
                    $dbh->bindParam(':gmid', $_POST['gmid']);
                    
                    if(!$dbh->execute())
                        echo 'Error updating GM';
                            
                }
                else
                {
                    $query = sprintf("UPDATE %s.t_admininfo SET a_username = :username, a_displayname = :displayname, a_role = :role, a_enable = :enable WHERE a_index = :gmid", Config::DB_WEB);
                    $dbh = $db->prepare($query);
                    
                    $dbh->bindParam(':username', $_POST['username']);
                    $dbh->bindParam(':displayname', $_POST['displayname']);
                    $dbh->bindParam(':role', $_POST['role']);
                    $dbh->bindParam(':enable', $enable);
                    $dbh->bindParam(':gmid', $_POST['gmid']);
                    
                    if(!$dbh->execute())
                        echo 'Error updating GM';                    
                }
            }
            
            if($_POST['action'] == 'newgm' && $admin->Can(RIGHT_EDITGMS))
            {
                
                if(isset($_POST['enable']) && $_POST['enable'] == 'yes')
                    $enable = 1;
                else
                    $enable = 0;                
                
                $password = md5($_POST['password']);

                $query = sprintf("INSERT INTO %s.t_admininfo (a_username, a_password, a_displayname, a_role, a_enable) VALUES(:username, :password, :displayname, :role, :enable)", Config::DB_WEB);
                $dbh = $db->prepare($query);

                $dbh->bindParam(':username', $_POST['username']);
                $dbh->bindParam(':password', $password);
                $dbh->bindParam(':displayname', $_POST['displayname']);
                $dbh->bindParam(':role', $_POST['role']);
                $dbh->bindParam(':enable', $enable);


                if(!$dbh->execute())
                    echo 'Error updating GM';
                
            }

        }


        if($admin->Can(RIGHT_EDITGMS))
        {
            $tpl->newBlock('showgms');

            $query = sprintf("SELECT a.a_index, a.a_enable, a.a_displayname, r.a_color FROM %s.t_admininfo a LEFT JOIN %s.t_roles r ON r.a_index = a.a_role ORDER BY a.a_enable DESC, a.a_displayname", Config::DB_WEB, Config::DB_WEB);
            $dbh = $db->prepare($query);
            $dbh->execute();

            $result = $dbh->fetchAll();
            foreach($result as $r)
            {
                $tpl->newBlock('gmlist');
                $tpl->assign('url', 'editgm.php?gm=' . $r['a_index']);

                if($r['a_enable'] == 1)
                {

                    if($r['a_color'] != '')
                        $tpl->assign('name', '<span style="color:#'. $r['a_color'] .'">'. $r['a_displayname'] . '</span>');
                    else
                        $tpl->assign('name', $r['a_displayname']);
                }

                else
                    $tpl->assign('name', '<strike>'. $r['a_displayname'] . '</strike>');
            }
        }


        if($admin->Can(RIGHT_EDITGMS))
        {
            $tpl->newBlock('showroles');

                $query = sprintf("SELECT a_index, a_name, a_color FROM %s.t_roles", Config::DB_WEB);
                $dbh = $db->prepare($query);
                $dbh->execute();

                $result = $dbh->fetchAll();
                foreach($result as $r)
                {
                    $tpl->newBlock('rolelist');
                    $tpl->assign('url', 'roles.php?role=' . $r['a_index']);

                    if($r['a_color'] != '')
                        $tpl->assign('name', '<span style="color:#'. $r['a_color'] .'">'. $r['a_name'] . '</span>');
                    else
                        $tpl->assign('name', $r['a_name']);

                }
        }
        
        if($admin->Can(RIGHT_ISGM) || $admin->Can(RIGHT_ISHGM) || $admin->Can(RIGHT_ISADMIN))
        {
            $tpl->newBlock('dropsettings');
        }


        $tpl->printToScreen();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0; url=login.php">';
    }    
    
?>

