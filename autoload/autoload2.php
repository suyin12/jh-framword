<?php
/**
 *
 * User: suyin
 * Date: 2017/10/10 10:35
 *
 */
class test{
    public static function loadPrint($class){
        $file = $class.'.class.php';
        if(is_file($file)){
            require_once($file);
        }
    }
}


spl_autoload_register('test::loadprint');

$obj = new TestPrint();
$obj->doPrint();