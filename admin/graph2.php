<?php

    require_once 'inc/globals.php';

    if ( isset($_GET['days']) && ctype_digit($_GET['days']) )
    {
        $dateFrom = date("Y-m-d", (time() - 60 * 60 * 24 * ($_GET['days'] + 1)));
        $dateTo = date("Y-m-d", (time() - 60 * 60 * 24 * $_GET['days']));
        $datestring2 = date("l, d F Y", (time() - 60 * 60 * 24 * $_GET['days']));
    }
    else
    {
        $dateFrom = date("Y-m-d", (time() - (60 * 60 * 24)));
        $dateTo = date("Y-m-d");
        $datestring2 = date("l, d F Y");
    }
    
    $dbh = $db->prepare(sprintf("SELECT a_date, sum(a_count) as sum FROM neogeo_db.t_connect_count WHERE a_date >= '%s 00:00:00' AND a_date < '%s 00:00:00' GROUP BY a_date", $dateFrom, $dateTo));
    $dbh->execute();

    $result = $dbh->fetchAll();

    $i = 0;
    $max = 0;
    $min = 10000;
    foreach ( $result as $r )
    {
        $values[$i++] = $r['sum'];
        if($r['sum'] > $max)
            $max = $r['sum'];
        
        if($min > $r['sum'])
            $min = $r['sum'];
    }

    $maxplayer = ($max + 100) - (($max + 100) % 50);
    $width = (count($values) * 5) + 50;
    $height = $maxplayer / 2;

    $im = imagecreate($width, $height);
    $gray = imagecolorallocate($im, 0x7f, 0x7f, 0x7f);
    $lightgray = imagecolorallocate($im, 0xe0, 0xe0, 0xe0);
    $slightgray = imagecolorallocate($im, 0xf0, 0xf0, 0xf0);
    $white = imagecolorallocate($im, 0xff, 0xff, 0xff);
    $red = imagecolorallocate($im, 0xff, 0x00, 0x00);
    $green = imagecolorallocate($im, 0x00, 0x66, 0x00);

    imagefilledrectangle($im, 0, 0, $width, $height, $white);

    $ly = 0;
    for ( $i = 0; $i < ($maxplayer / 50); $i++ )
    {
        $ly = (30 + ($i * 20));
        imageline($im, 35, $ly, $width, $ly, $lightgray);
        imagestring($im, 2, 5, (23 + ($i * 20)), ($maxplayer - $i * 50), $gray);
    }

    imageline($im, 35, $ly + 20, $width, $ly + 20, $gray);
    imageline($im, 35, 30, 35, $ly + 20, $gray);
    imagestring($im, 4, 50, 10, "LHGenericName01 : " . $datestring2 . '  (Min/Max Players: ' . $min . '/' . $max . ' )', $gray);

    $ly += 25;



    $oldx = 30;
    $oldy = 0;

    $maxhour = 0;
    $players = 0;

    $hour = 0;
    $minute = 0;
    for ( $i = 0; $i < count($values); $i++ )
    {
        $one = (($ly - 30) / $maxplayer) * $values[$i];

        $y = $ly - $one;
        $x = $oldx + 5;

        if ( $oldx == 30 && $oldy == 0 )
        {
            $oldx = $x;
            $oldy = $y;
        }

        imageline($im, $oldx, $oldy, $x, $y, $red);
        
        if($minute == 0)
            imagestring($im, 2, $x, $ly+5, $hour . 'h', $gray);   
        
        $minute++;
        if($minute == 6)
        {
            $minute = 0;
            $hour++;
        }

        $oldx = $x;
        $oldy = $y;
    }



    header("Content-type: image/png");
    imagepng($im);
?>