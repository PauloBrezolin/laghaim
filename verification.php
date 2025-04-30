<?php 
//Start the session so we can store what the security code actually is
session_start();

//Send a generated image to the browser 
create_image(); 
exit(); 

function create_image() 
{ 
    
    $left = rand(50, 90);
    $right = rand(1, 9);
    $plusmin = rand(1, 1000);
    
    $answer = 0;
    $text = '';
    if($plusmin % 2 == 0)
    {
        $answer = $left + $right;
        $text = $left . ' + ' . $right . ' = ';
    }
    else
    {
        $answer = $left - $right;
        $text = $left . ' - ' . $right . ' = ';
    }
    
    $_SESSION["security_answer"] = $answer;

    $image = ImageCreate(100, 20);  

    $white = ImageColorAllocate($image, 255, 255, 255); 
    $black = ImageColorAllocate($image, 0, 0, 0); 

    ImageFill($image, 0, 0, $white); 
    ImageString($image, 3, 1, 3, $text, $black); 
 
    header("Content-Type: image/jpeg"); 
    ImageJpeg($image); 
    ImageDestroy($image); 
} 
?>