<?php
/**
 *
 * User: suyin
 * Date: 2017/7/4 14:16
 *
 */

/**
 * 使用递归实现无限创建文件夹,
 * 还是花费点时间理解了一下
 *
*/
function Directory($dir){

    if(is_dir($dir) || @mkdir($dir,0777)){

        echo $dir."创建成功<br>";

        }else{
        Directory(dirname($dir));
        if(@mkdir($dir,0777)){
            echo $dir."创建123132<br>";
        }
    }
}
