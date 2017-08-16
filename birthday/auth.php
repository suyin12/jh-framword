<?php
/**
 *
 * User: suyin
 * Date: 2017/8/11 10:04
 *
 */
//这个判断的意思应该是禁止访问本权限文件,__FILE__和$_SERVER['SCRIPT_FILENAME']返回的是文件的绝对路径,SCRIPT_FILENAME指向当前执行脚本的绝对路径；__FILE__指向当前文件的绝对路径；也就是写在哪个文件里就是哪里。
if (realpath ( __FILE__ ) == realpath ( $_SERVER ['SCRIPT_FILENAME'] )) {
    exit ( '禁止访问' );
}

if (empty($_SESSION['user'])||@$_SESSION['expire']<time()){
    header('location:' . HTTP_PATH . 'jh-framwork/birthday/login.php' ); //@ redirect
}