<?php
function watermark($filename,$water){
    list($bW,$bH) = getimagesize($filename);
    list($wW,$wH) = getimagesize($water);

//    echo $wW;echo '<br>';echo $wH;
    $posX = rand(0,($bW-$wW));
    $posY = rand(0,($bH-$wH));

    $back = imagecreatefromjpeg($filename);
    $water = imagecreatefromgif($water);

    imagecopy($back,$water,$posX,$posY,0,0,$wW,$wH);

    imagejpeg($back,__DIR__.'/water2.jpg');

    imagedestroy($back);
    imagedestroy($water);


}

$filename = __DIR__.'/water.jpg';
$water = __DIR__.'/timg.gif';
watermark($filename,$water);