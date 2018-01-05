<?php
$src = __DIR__.'/fengjing.jpg';
//$resource = imagecreatefromjpeg($src);
//var_dump($resource);
//
//list($h,$w,$type,$attr) = getimagesize($src);
//$ret = getimagesize($src);
//echo '<pre>';
//print_r($ret);

function image($filename,$string){
    list($height,$width,$type) = getimagesize($filename);

    $types = array(1=>'gif',2=>'jpeg',3=>'png');

    $createfrom = 'imagecreatefrom'.$types[$type];

    $image = $createfrom($filename);

    $x = ($width)/2;

    $y = ($height)/2;

    $red = imagecolorallocate($image,255,0,0);

    imagestring($image,12,$x,$y,$string,$red);

    $output = 'image'.$types[$type];

//    header('Content-type:image/jpeg');

    $output($image,$filename);

    imagedestroy($image);
}

image($src,'jpeg');