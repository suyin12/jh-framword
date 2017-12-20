<?php
/**
 *
 * User: suyin
 * Date: 2017/10/10 10:24
 *
 */

function __autoload($class){
    $file = $class.'.class.php';
    if(is_file($file)){
        require_once($file);
    }
}

$obj = new TestPrint();
$obj->doPrint();