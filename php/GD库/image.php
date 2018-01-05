<?php
//$image = imagecreatetruecolor(100,100);
$image = imagecreatetruecolor(500,500);
$white = imagecolorallocate($image,0xFF,0xFF,0xFF);
$gray = imagecolorallocate($image,0xC0,0xC0,0xC0);
$darkgray = imagecolorallocate($image,0x90,0x90,0x90);
$navy = imagecolorallocate($image,0x00,0x00,0x80);
$darknavy = imagecolorallocate($image,0x00,0x00,0x50);
$red = imagecolorallocate($image,0xFF,0x00,0x50);
$darkred = imagecolorallocate($image,0x90,0x00,0x50);

imagefill($image,0,0,$white);

for($i = 200; $i>190; $i--){
    imagefilledarc($image,200,$i,200,150,-160,40,$darknavy,IMG_ARC_PIE);
    imagefilledarc($image,200,$i,200,150,40,75,$darkgray,IMG_ARC_PIE);
    imagefilledarc($image,200,$i,200,150,75,200,$darkred,IMG_ARC_PIE);
}

imagefilledarc($image,200,190,200,150,-160,40,$navy,IMG_ARC_PIE);
imagefilledarc($image,200,190,200,150,40,75,$gray,IMG_ARC_PIE);
imagefilledarc($image,200,190,200,150,75,200,$red,IMG_ARC_PIE);

imageString($image,5,140,210,'34.72%',$white);
imageString($image,5,200,150,'55.56%',$white);
imageString($image,5,220,230,'8.33%',$white);

header('Content-type:image/png');

imagepng($image);
imagedestroy($image);
echo '填充背景色imagefill()';

