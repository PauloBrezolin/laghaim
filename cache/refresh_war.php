<?php

    $path = '/var/zpanel/hostdata/zadmin/public_html/lhgenericname01_lc/';
    require_once $path . 'config/config.php';
    
    $data = "";
    $conf['db']['dsn'] = sprintf("mysql:host=%s;dbname=" . Config::DB_CHAR, Config::DBCON_URL );

    try 
    {
        $db = new PDO($conf['db']['dsn'], Config::DBCON_USER, Config::DBCON_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } 
    catch(PDOException $e)
    {
            die('Cannot connect database');
    }    
   
    function AddLine($text)
    {
        global $data;
        $data .= $text . "\r\n";
    }

    function WriteFile($fileName)
    {
        global $data;
        
        $fh = fopen($fileName, 'w');

        if($fh == null)
            return;

        fwrite($fh, "<?php\n\n" );
        fwrite($fh, $data);
        fwrite($fh, '$lastupdate = ' . time() . ';');
        fwrite($fh, "\n?>");
    }
    
    function Refresh_War()
    {
        global $db, $data;        
        
        $dbh = $db->prepare(sprintf("SELECT a_world_num, a_guild_name, a_appoint_date, a_battle_date FROM %s.t_lord", Config::DB_CHAR));
        $dbh->execute();
        while($r = $dbh->fetch())
        {
            AddLine(sprintf('$cWar[%d][\'name\'] = \'%s\';', $r['a_world_num'], addslashes(utf8_encode($r['a_guild_name']))));
            
            
            $date = 'Not set';
            if($r['a_appoint_date'] != 'none')
            {
                $tvar = explode('/', $r['a_appoint_date']);
                $dvar = explode(' ', $r['a_battle_date']);
                
                $time = mktime($dvar[1], 0, 0, $tvar[1], $tvar[2], $rtvar[0]);
                $date = date('D M d H:i', $time);
            }

            AddLine(sprintf('$cWar[%d][\'date\'] = \'%s\';', $r['a_world_num'], $date));

        }
            
    }
    
  
 
    
    Refresh_War();

    
    WriteFile($path . 'cache/war.php');
    
    echo 'Done updating war';
    
?>
