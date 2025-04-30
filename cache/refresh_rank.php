<?php

    $path = '/var/zpanel/hostdata/zadmin/public_html/lhgenericname01_lc/';
    //$path = '../';
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
        
        for($race = 0; $race < 6; $race++)
        {
            $query = sprintf
            ("
                SELECT 
                    c.a_name, 
                    c.a_level
                FROM 
                    %s.t_characters c,
                    %s.t_users u
                WHERE c.a_admin = 0 
                AND u.a_index = c.a_user_index
                AND u.a_enable = 1
                AND a_race = :race
                ORDER BY 
                    a_level DESC, 
                    a_exp DESC
                LIMIT 500"
                    
            , Config::DB_CHAR,
              Config::DB_USER);
            
            $dbh = $db->prepare($query);
            $dbh->bindParam(':race', $race, PDO::PARAM_INT);
            if(!$dbh->execute())
                print_r($dbh->errorInfo());

            $result = $dbh->fetchAll();

            $i=0;
            foreach($result as $r)
            {
                AddLine(sprintf('$cRank[%d][%d][\'name\'] = \'%s\';', $race, $i, addslashes(utf8_encode($r['a_name']))));
                AddLine(sprintf('$cRank[%d][%d][\'level\'] = %d;', $race, $i, $r['a_level']));
                $i++;
            }
        }
    }
    
    function Refresh_Ranking2()
    {
        global $db, $data;
        

        $query = sprintf
        ("
            SELECT 
                c.a_name, 
                c.a_level
            FROM 
                %s.t_characters c,
                %s.t_users u
            WHERE c.a_admin = 0 
            AND u.a_index = c.a_user_index
            AND u.a_enable = 1
            ORDER BY 
                a_level DESC, 
                a_exp DESC
            LIMIT 10"

        , Config::DB_CHAR,
          Config::DB_USER);

        $dbh = $db->prepare($query);

        if(!$dbh->execute())
            print_r($dbh->errorInfo());

        $result = $dbh->fetchAll();

        $i=0;
        foreach($result as $r)
        {
            AddLine(sprintf('$cRank2[%d][\'name\'] = \'%s\';', $i, addslashes(utf8_encode($r['a_name']))));
            AddLine(sprintf('$cRank2[%d][\'level\'] = %d;', $i, $r['a_level']));
            $i++;
        }

    }    
    
    function Refresh_RankingPet()
    {
        global $db, $data;
        

        $query = sprintf
        ("
            SELECT
                c.a_name as a_charname,
                c.a_race,
                c.a_level as a_charlevel,
                p.a_name as a_petname,
                p.a_class,
                p.a_level,
                (
                    CASE 
                        WHEN p.a_class = 0 THEN 0
                        WHEN p.a_class = 1 THEN 1
                        WHEN p.a_class = 2 THEN 1
                        WHEN p.a_class = 3 THEN 2
                    END
                ) as sorting                
            FROM 
                %s.t_pets p,
                %s.t_characters c,
                %s.t_users u
            WHERE c.a_index = p.a_char_idx	
            AND u.a_index = c.a_user_index
            AND u.a_enable = 1
            ORDER BY 
                sorting DESC, 
                p.a_level DESC,
                p.a_exp DESC

            LIMIT 100"

        , Config::DB_CHAR,
          Config::DB_CHAR,
          Config::DB_USER);

        $dbh = $db->prepare($query);

        if(!$dbh->execute())
            print_r($dbh->errorInfo());

        $result = $dbh->fetchAll();

        $i=0;
        foreach($result as $r)
        {
            AddLine(sprintf('$cRankPet[%d][\'charname\'] = \'%s\';', $i, addslashes(utf8_encode($r['a_charname']))));
            AddLine(sprintf('$cRankPet[%d][\'race\'] = %d;', $i, $r['a_race']));
            AddLine(sprintf('$cRankPet[%d][\'charlevel\'] = %d;', $i, $r['a_charlevel']));
            AddLine(sprintf('$cRankPet[%d][\'petname\'] = \'%s\';', $i, addslashes(utf8_encode($r['a_petname']))));
            AddLine(sprintf('$cRankPet[%d][\'class\'] = %d;', $i, $r['a_class']));
            AddLine(sprintf('$cRankPet[%d][\'level\'] = %d;', $i, $r['a_level']));
            $i++;
        }

    }      
    
 
    
    Refresh_Ranking();
    Refresh_Ranking2();
    Refresh_RankingPet();
    
    WriteFile($path . 'cache/rank.php');
    
    echo 'Done updating Rank';
    
?>
