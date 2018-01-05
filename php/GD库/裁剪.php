<?php

$filename = __DIR__.'/fengjing.jpg';
function cut($filename,$x,$y,$width,$height){
    $back = imagecreatefromjpeg($filename);

    $cutimg = imagecreatetruecolor($width,$height);

    imagecopyresampled($cutimg,$back,0,0,$x,$y,$width,$height,$width,$height);

    imagejpeg($cutimg,__DIR__.'/fengjing裁剪.jpg');

    imagedestroy($cutimg);
    imagedestroy($back);
}

cut($filename,50,50,200,200);