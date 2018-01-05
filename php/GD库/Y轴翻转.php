<?php
/***
 * dst_im	目标图像
 * src_im	被拷贝的源图像
 * dst_x	目标图像开始 x 坐标
 * dst_y	目标图像开始 y 坐标，x,y同为 0 则从左上角开始
 * src_x	拷贝图像开始 x 坐标
 * src_y	拷贝图像开始 y 坐标，x,y同为 0 则从左上角开始拷贝
 * src_w	（从 src_x 开始）拷贝的宽度
 * src_h	（从 src_y 开始）拷贝的高度
 *
*/
function trunY($filename,$filename2,$newFilename){
    $back = imagecreatefromjpeg($filename);
    $back2 = imagecreatefromjpeg($filename2);

    $width = imagesx($back);
    $height = imagesy($back);

    $width2 = imagesx($back2);
    $height2 = imagesy($back2);

    $new = imagecreatetruecolor($width,$height);


    for($x=250,$y=250;$x<(($width+500)/2);$x++,$y++){
        imagecopy($new,$back,$width-$x-1,0,$x,0,1,$height);
        imagecopy($new,$back2,$y,0,$width-$y-1,0,1,$height2);
    }

    imagejpeg($new,$newFilename);

    imagedestroy($back);
    imagedestroy($new);
}
ini_set('memory_limit','512M');
$filename = __DIR__.'/zbl.jpg';
$filename2 = __DIR__.'/Y轴翻转zbl.jpg';
$newFilename = __DIR__.'/Y轴翻转zbl4.jpg';
trunY($filename,$filename2,$newFilename);