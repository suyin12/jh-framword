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
function trunX($filename,$newFilename){
    $back = imagecreatefromjpeg($filename);

    $width = imagesx($back);
    $height = imagesy($back);

    $new = imagecreatetruecolor($width,$height);

    for($y=0;$y<$height;$y++){
        imagecopy($new,$back,0,$height-$y-1,0,$y,$width,1);
    }

    imagejpeg($new,$newFilename);

    imagedestroy($back);
    imagedestroy($new);

}
ini_set('memory_limit','512M');
$filename = __DIR__.'/zbl.jpg';
$newFilename = __DIR__.'/X轴翻转zbl.jpg';
trunX($filename,$newFilename);