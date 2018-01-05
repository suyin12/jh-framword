<?php
$image = imagecreatetruecolor(500,500);

$red = imagecolorallocate($image,255,0,0);

$white = imagecolorallocate($image,255,255,255);

imagefill($image,0,0,$white);

for($i=100;$i<=150;$i++){
    imagesetpixel($image,$i,100,$red);
}
//线条
imageline($image,0,0,100,100,$red);
//矩形
imagerectangle($image,100,120,170,170,$red);
//填充矩形
imagefilledrectangle($image,120,190,190,240,$red);

//正六边形
$arr = [80,250,100,250,110,273,100,296,80,296,70,273];
imagepolygon($image,$arr,6,$red);


//圆形
imagearc($image,100,400,100,100,0,360,$red);

//椭圆
//imagefilledarc($image,100,400,100,100,0,360,$red);

header('Content-type:image/jpeg');

imagejpeg($image);

imagedestroy($image);