<?php

/**
 * Description of identifyCode
 *
 * @author sToNe email:shi35dong@gmail.com
 * identifying code in $_SESSION['icode'].
 */
require_once '../../setting.php';
header("Content-type :image/gif"); //把文件的返回类型设为image/gif格式，这个格式可以输出图片
$codelen = 4; //设置你要让用户输入字符的个数，一般为4，过长用户体验不好。
$charset = "ABCDEFGHKLMNPRSTUVWYZ23456789";//我们可以尽量把一些难以辨认的字符去掉，比如阿拉伯数字0和字母o，这也是提高用户体验的一种方法。
$code ="";
for ($i = 0; $i < $codelen; $i++) {//用for循环得到4个随机的字符,在这里用到了mt_rand,这个函数比rand的效率要高的多，建议大家用这个
    $code .=$charset{mt_rand(0,28)};
}
session_start();
$_SESSION['iCode'] = $code; //下篇关于session验证的文章将会用到
$width = 80;
$height = 28;
$im = imagecreatetruecolor($width, $height); //用imagecreatetruecolor()函数来建立一个新的图片，里面的两个数值分别是宽度和高度，这是制作验证码的第一步
$bg = imagecolorallocate($im, 170,170,170); //图片背景的颜色，这里是第二步
$textcolor = imagecolorallocate($im, 0,159,204 ); //文字的颜色
imagefill($im, 0, 0, $bg); //给图片填充背景色
//好了上面的铺垫任务做的差不多了，现在关键就是让字符显示在图片上，这里有两种方法我们一一介绍。
$font =  sysPath."user/login/AHGBold.ttf"; //如果你有字体的话 就填上字体的相对路径，如果没有就留空。下面的两个用法我会一一讲解。

if ($font) {
    for ($num = 0; $num < 4; $num++) {
//        imagettftext($im, 20, 0, 11, 21, $textcolor, $font, $code[$num]);
        imagettftext($im, mt_rand(12, 16), 0, 5 + 15 * $num, 20 + mt_rand(2, 5), $textcolor, $font, $code[$num]); //这里是第三步
    }
} else {
    for ($num = 0; $num < 4; $num++) {
        imagestring($im, 5, 10 + 15 * $num, 10 + mt_rand(0, 5), $code[$num], $textcolor);
    }
}
header("Content-type: image/jpeg");
imagejpeg($im);
imagedestroy($im);
?>