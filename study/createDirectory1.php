<?php
/**
 *
 * User: suyin
 * Date: 2017/7/4 14:35
 *
 */

/**
 *
 * 异常精辟之无限创建文件夹
 *
 *
 * 现在来解释一下整个函数：先介绍一下PHP中逻辑运算符的优先级顺序：&& > || > and > or，即符号型>字母型，AND型>OR型，所以函数体可以看成：
 * is_dir ( $dir )  or  (Directory(dirname( $dir ))  and   mkdir ( $dir , 0777));
 * 先判断目标目录是否存在，若存在，依or的短路特性，后面的整体被短路，跳过执行；若目标目录不存在，则执行后面的函数体：
 * Directory(dirname( $dir ))  and   mkdir ( $dir , 0777)
 * 我考虑了一下先进行递归的用意：先执行递归，意在确认其父目录(dirname($dir))都已经创建完毕，使后面的mkdir()函数不会创建子目录时找不到父目录发出警告。
 * 进入递归深处后，确认最深处的根目录存在后，从根目录向下依次创建目录。
 *
*/
function  Directory( $dir ){
    return   is_dir ( $dir )  or  Directory(dirname( $dir ))  and   mkdir ( $dir , 0777);
}