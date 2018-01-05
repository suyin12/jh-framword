<?php
function rotate($filename,$degrees,$newFilename){
    $image = imagecreatefromjpeg($filename);

    $rotate = imagerotate($image,$degrees,0);

    imagejpeg($rotate,$newFilename);

    imagedestroy($image);
}

$filename = __DIR__.'/fengjing.jpg';
$degrees = 45;
$newFilename = __DIR__.'/旋转.jpg';
rotate($filename,$degrees,$newFilename);