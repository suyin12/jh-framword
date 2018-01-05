<?php
$image = imagecreatetruecolor(500,40);

$white = imagecolorallocate($image,255,255,255);
$grey = imagecolorallocate($image,128,128,128);
$black = imagecolorallocate($image,0,0,0);

imagefilledrectangle($image,0,0,399,29,$white);

$text = iconv('GB2312','UTF-8//IGNORE','支付宝来了');
$text = '支付宝来了';
$font = 'test.ttc';

imagettftext($image,12,0,12,21,$grey,$font,$text);

header('Content-type:image/png');

imagepng($image);

imagedestroy($image);