<?php
//创建画布
$img=imagecreatetruecolor(300,200);
//创建颜色
$red=imagecolorallocate($img,255,0,0);
$white=imagecolorallocate($img,255,255,0);
$white2 = imagecolorallocate($img,255,255,255);


//填充画布
imagefill($img, 0, 0, $white2);
//画图形
// imagefilledellipse($img,150,100,300,200,$white);
for($i=100;$i<=110;$i++){
    imagefilledarc($img,150,$i,60,30,-160,40,$white,IMG_ARC_NOFILL);

}
header('content-type:image/jpeg');
//输出图案
imagejpeg($img);
?>