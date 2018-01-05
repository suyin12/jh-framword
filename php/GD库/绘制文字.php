<?php
$image = imagecreate(500,500);

$white = imagecolorallocate($image,255,255,255);
$black = imagecolorallocate($image,0,0,0);

imagefill($image,0,0,$white);

$str = 'LAMPBorther';

imageString($image,5,108,100,$str,$black);
imageStringup($image,5,145,155,$str,$black);

for($i=0,$j=strlen($str);$i<strlen($str);$i++,$j--){
    imagechar($image,5,50*($i+1),10*($i+2),$str{$i},$black);
    imagecharup($image,5,50*($i+1),10*($j+2),$str{$i},$black);
}


header('Content-type:image/png');

imagepng($image);

imagedestroy($image);