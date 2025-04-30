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
    
    function Refresh_Ranking()
    {
        global $db, $data;        
        
        $dbh = $db->prepare(sprintf("SELECT count(user_code) FROM %s.bg_user", Config::DB_AUTH));
        $dbh->execute();
        $r = $dbh->fetch();    
        AddLine(sprintf('$cOnline[0] = %d;', $r[0]));
        
        $dbh = $db->prepare(sprintf("SELECT count(a_index) FROM %s.t_characters", Config::DB_CHAR));
        $dbh->execute();
        $r = $dbh->fetch();    
        AddLine(sprintf('$cOnline[1] = %d;', $r[0]));



        $dbh = $db->prepare(sprintf("SELECT count(*) FROM %s.t_users WHERE a_connect != -1", Config::DB_USER));
        $dbh->execute();
        $r = $dbh->fetch();    
        AddLine(sprintf('$cOnline[2] = %d;', $r[0]));
		

        $dbh = $db->prepare(sprintf("SELECT a_sub_num, COUNT(*) FROM %s.t_users WHERE a_connect != -1 GROUP BY a_sub_num", Config::DB_USER));
        $dbh->execute();
		
		$i = 3;
        while($r = $dbh->fetch())
		{
			AddLine(sprintf('$cOnline[%d] = %d;',$i++, $r[1]));
		}
		
		
		
    }
    
  
 
    
    Refresh_Ranking();

    
    WriteFile($path . 'cache/online.php');
    
    echo 'Done updating onlines';
    
?>
