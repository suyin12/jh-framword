<?php
$image = imagecreatetruecolor(500,500);

$red = imagecolorallocate($image,255,0,0);
imagesetpixel($image,200,100,$red);
//imagefill($image,10,10,$red);
//imageline($image,200,100,250,150,$red);

//imagefilledrectangle($image,100,50,190,140,$red);

$arr = [50,50,70,50,20,100,110,110,140,140];
imagefilledpolygon($image,$arr,5,$red);

imagefilledellipse($image,200,100,100,50,$red);

header('Content-type:image/png');
imagepng($image);

//echo imagesx($image);echo '<br>';
//echo imagesy($image);echo '<br>';
imagedestroy($image);
//
//echo imagesy($image);