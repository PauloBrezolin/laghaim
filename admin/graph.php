<?php 

  require_once 'inc/globals.php';
  
  if(isset($_GET['days']) && ctype_digit($_GET['days']))
  {
    $datestring = date("Y-m-d", (time() - 60*60*24* $_GET['days']));
    $datestring2 = date("l, d F Y", (time() - 60*60*24* $_GET['days']));
  }
  else
  {
      $datestring = date("Y-m-d");
      $datestring2 = date("l, d F Y");
  }
  
  $dbh = $db->prepare(sprintf("SELECT a_date, sum(a_count) as sum FROM %s.t_connect_count WHERE a_date like '".$datestring."%:00:00' GROUP BY a_date", Config::DB_USER));
  $dbh->execute();
  
  $result = $dbh->fetchAll();
  
  $i = 0;
  foreach($result as $r)
  {
      $values[$i++] = $r['sum'];
  }
  
    $maxplayer = 1050;
  $width = 640;
  $height = $maxplayer / 2;
  

  $im        = imagecreate($width,$height);
  $gray      = imagecolorallocate ($im,0x7f,0x7f,0x7f);
  $lightgray      = imagecolorallocate ($im,0xe0,0xe0,0xe0);
  $slightgray      = imagecolorallocate ($im,0xf0,0xf0,0xf0);
  $white     = imagecolorallocate ($im,0xff,0xff,0xff); 
  $red        = imagecolorallocate($im, 0xff,0x00,0x00);
  $green        = imagecolorallocate($im, 0x00,0x66,0x00);
  
  imagefilledrectangle($im,0,0,$width,$height,$white);
  
  $ly = 0;
  for($i=0; $i<($maxplayer/50); $i++)
  {
      $ly = (30+($i*20));
    imageline($im, 35, $ly, $width, $ly, $lightgray);
    imagestring($im, 2, 5, (23+($i*20)), ($maxplayer - $i*50), $gray);
  }
  
  
  
  imageline($im, 35, $ly+20, $width, $ly+20, $gray);
  imageline($im, 35, 30, 35, $ly+20, $gray);  
  
  $ly += 20;
  
  
  $oldx = 25;
  $oldy = 0;
  
  $max = 1000;
  $maxhour = 0;
  $players = 0;
  
  for($i=0; $i<count($values); $i++)
  {
      
      $one = (($ly - 20) / $maxplayer) * $values[$i];    
      
      $y = $ly - $one;
      $x = $oldx + 24;
      
      if($y < $max)
      {
          $max = $y;
          $maxhour = $i;
          $players = $values[$i];
          
    }
      
     imageline($im, $x, 30, $x, (29 + (($maxplayer/50) * 20)), $slightgray);
     imagestring($im, 2, $x, $ly+5, $i . 'h', $gray);      
      
      if($oldx == 25 && $oldy == 0)
      {
        $oldx = $x;
        $oldy = $y;
      }
      
      
      imageline($im, $oldx, $oldy, $x, $y, $red);
      
      $oldx = $x;
      $oldy = $y;
  }
  
  //imageline($im, 25 + ($maxhour * 24), $max, 25 + ($maxhour * 27), $max, $green);
  imagestring($im, 3, 25 + ($maxhour * 25), $max - 15, $players, $green);
  
  imagestring($im, 4, 50, 10, "LHGenericName01 : " . $datestring2, $gray);

   // set the correct png headers 
   header ("Content-type: image/png"); 
  // spit the image out the other end 
  imagepng($im); 
   
?>