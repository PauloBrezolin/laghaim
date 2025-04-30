<?php

    session_start();

    include_once( "class/class_template.php" );
    $tpl = new TemplatePower( "tpl/index.tpl" );

    $tpl->prepare();
    
    include 'inc/globals.php';
    
    include 'cache/announcements.php';
    include 'cache/rank.php';
    include 'cache/online.php';
    
    
    $user = user::getInstance();
    
    if(isset($_GET['do']))
    {
        if($_GET['do'] == 'logout')
            $user->logout();
    }
    
    if(isset($_POST['action']))
    {
        if(isset($_POST['log_uname']) && strlen($_POST['log_uname']) > 0 && isset($_POST['log_pw']) && strlen($_POST['log_pw']) > 0)
        {
            $ret = $user->doLogin($_POST['log_uname'], $_POST['log_pw'], $_POST['log_code']);
            switch($ret)
            {
                case ERROR_NO_DATABASE:
                    echo '<script type="text/javascript">alert(\'No database connection is available at this moment, please try again later\');</script>';
                    break;
                case ERROR_WRONG_LOGIN:
                    echo '<script type="text/javascript">alert(\'The username and password you entered is not correct\');</script>';
                    break;
                case ERROR_WRONG_CODE:
                    echo '<script type="text/javascript">alert(\'The answer to the math question was not correct.\');</script>';
                    break;                
            }
        }
    }
    
    if($user->login)
    {
        $user->updateCash();
        $tpl->newBlock('userbox');
        $tpl->assign('username', $user->name);
        $tpl->assign('cash', AddDots($user->cash));
    }
    else
        $tpl->newBlock('loginbuttons');
    
    
    
    for($i=0; $i<count($announcement); $i++)
    {
        $tpl->newBlock('announcements');
        $tpl->assign('content', stripslashes($announcement[$i]['message']));
        $tpl->assign('poster', $announcement[$i]['starter']);
        $tpl->assign('date', date('l, d F - H:i', $announcement[$i]['date']));
        
        if($announcement[$i]['type'] == 3)
            $tpl->assign('title', '[Announcement] ' . $announcement[$i]['title']);
        else
            $tpl->assign('title', '[News] ' . $announcement[$i]['title']);
        
        if($i == 0)
            $tpl->assign('open', 'id="open"');
    }
    
    for($i=0; $i<count($cRank2); $i++)
    {
        $tpl->newBlock('rank');
        
        if($i == 0) $tpl->assign('num', '<img src="tpl/images/crown.png">');
        else $tpl->assign('num', $i + 1);
        
        $tpl->assign('name', $cRank2[$i]['name']);
        $tpl->assign('level', $cRank2[$i]['level']);
    }
    
    $tpl->assignGlobal('accounts', AddDots($cOnline[0]));
    $tpl->assignGlobal('chars', AddDots($cOnline[1]));    
    $tpl->assignGlobal('online', AddDots($cOnline[2]));      

    
    if($db = db::getConnection())
    {
        $dbh = $db->prepare(sprintf("SELECT a_world_num, a_guild_name, a_appoint_date, a_battle_date FROM %s.t_lord", Config::DB_CHAR));
        $dbh->execute();
        while($r = $dbh->fetch())
        {
            
            $date = 'Not set';
            if($r['a_appoint_date'] != 'none')
            {
                $tvar = explode('/', $r['a_appoint_date']);
                $dvar = explode(' ', $r['a_battle_date']);
                
                $time = mktime($dvar[1], 0, 0, $tvar[1], $tvar[2], date('Y'));
                $date = date('D M d H:i', $time);
            }
            
            
            if($r['a_world_num'] == 3)
            {
                $tpl->assignGlobal('shilon_guild', addslashes(utf8_encode($r['a_guild_name'])));
                $tpl->assignGlobal('shilon_time', $date);                
            }
            
            else if($r['a_world_num'] == 7)
            {
               $tpl->assignGlobal('whitehorn_guild', addslashes(utf8_encode($r['a_guild_name'])));
               $tpl->assignGlobal('whitehorn_time', $date);                  
            }
            
        }
        

        
        $query = sprintf("SELECT FROM_UNIXTIME(a_start) as a_start FROM %s.t_mobius_event LIMIT 1", Config::DB_CHAR);
                 //  echo "Consulta gerada: " . $query . "<br>"; // Debug: Exibe a consulta gerada

        $dbh = $db->query($query);
        if ($dbh === false) {
                 // $errorInfo = $db->errorInfo();
            die("Erro na consulta: " . implode(", ", $errorInfo));
        } else {
                //echo "Consulta bem-sucedida!<br>"; // Debug: Confirma a execução bem-sucedida da consulta
        }

        if ($r = $dbh->fetch()) {
                 //var_dump($r); // Debug: Exibe o resultado da consulta
            $tpl->assignGlobal('mobius', date('D M d H:i', strtotime($r['a_start'])));
        } else {
            echo "Nenhum resultado encontrado.";
        }

        
    }
    else
    {
        include 'cache/war.php';
        $tpl->assignGlobal('shilon_guild', $cWar[3]['name']);
        $tpl->assignGlobal('shilon_time', $cWar[3]['date']);
        $tpl->assignGlobal('whitehorn_guild', $cWar[7]['name']);
        $tpl->assignGlobal('whitehorn_time', $cWar[7]['date']);        
    }
    

    
    
    
    if(isset($_GET['do']))
    {
        $url = '';
        if($_GET['do'] == 'validate' && isset($_GET['code']) && strlen($_GET['code']) == 128)
            $url = 'register.php?code=' . filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING);
        
        if($_GET['do'] == 'validate_changemail' && isset($_GET['code']) && strlen($_GET['code']) == 128)
            $url = 'changeemail.php?code=' . filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING);   
        
        if($_GET['do'] == 'tickets')
            $url = 'tickets.php?t=new';
        
        if($_GET['do'] == 'request_pass' && isset($_GET['code']) && strlen($_GET['code']) == 12)
            $url = 'lostpw.php?q=code&code='. filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING);
        
        if($_GET['do'] == 'rules')
            $url = 'rules.php';
        
        if($_GET['do'] == 'tos')
            $url = 'tos.php';
        
        if(strlen($url) > 0)
        {
            $page = "
                <script>
                    $.get('". $url ."',{},function(response)
                    {
                        $('#main_content').hide();
                        $('#main_content').html(response);
                        $('#main_content').fadeIn(300);

                    });            
                </script>
            ";

            $tpl->assignGlobal('page', $page);            
        }
    }

    $tpl->assignGlobal('servertime', date('Y, m, d, H, i, s'));
    
    $tpl->printToScreen();
    
?>

