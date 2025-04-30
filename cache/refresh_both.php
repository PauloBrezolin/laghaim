<?php

    $conf['db']['server'] = '127.0.0.1';
    $conf['db']['user'] = 'lh01forum';
    $conf['db']['pass'] = 'y3y6a3yna';
    $conf['db']['dbase'] = 'zadmin_lhgn01forum';
    $conf['db']['dsn'] = sprintf("mysql:host=%s;dbname=%s", $conf['db']['server'], $conf['db']['dbase']);
    $data = "";

    $path = '/var/zpanel/hostdata/zadmin/public_html/lhgenericname01_lc/';
    
    try 
    {
        $db = new PDO($conf['db']['dsn'], $conf['db']['user'], $conf['db']['pass']);
    } 
    catch(PDOException $e)
    {
        die('Cannot connect db');
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
        fwrite($fh, "\n?>");
    }
    
    function Refresh_News()
    {
        global $db, $data;
        
        $i = 0;

        $dbh = $db->prepare
        ("
            SELECT
                t.tid,
                t.title,
                t.start_date,
                t.starter_name,
                t.forum_id,
                p.post

            FROM
                ipbtopics t,
                ipbposts p

            WHERE (forum_id = 3 OR forum_id = 4)

            AND
                tdelete_time = 0

            AND
                p.pid = t.topic_firstpost

            ORDER BY
                tid DESC

            LIMIT 5	
        ");

        if($dbh->execute())
        {
            $result = $dbh->fetchAll();
            foreach($result as $row)
            {
                    echo $row['title'] . '<br />';
                    AddLine(sprintf('$announcement[%d][\'title\'] = \'%s\';', $i, addslashes($row['title'])));
                    AddLine(sprintf('$announcement[%d][\'message\'] = \'%s\';', $i, addslashes($row['post'])));
		    AddLine(sprintf('$announcement[%d][\'starter\'] = \'%s\';', $i, addslashes($row['starter_name'])));
                    AddLine(sprintf('$announcement[%d][\'url\'] = \'http://forum.lhgenericname01.lc/index.php?/topic/%d-\';', $i, addslashes($row['tid'])));
                    AddLine(sprintf('$announcement[%d][\'type\'] = %d;', $i, $row['forum_id']));
                    AddLine(sprintf('$announcement[%d][\'date\'] = \'%s\';', $i, $row['start_date']));

                    $i++;
            }
        }
        else
            print_r($dbh->errorInfo());
    }    
    
    Refresh_News();
    WriteFile($path . 'cache/announcements.php');
    
?>
