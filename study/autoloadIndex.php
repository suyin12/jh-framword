<?php
/**
 *
 * User: suyin
 * Date: 2017/7/7 16:45
 *
 */
function __autoload($class){
    $file = $class.".class.php";
    if(is_file($file)){
        require_once($file);
    }
}
$printit = new autoload();
$printit->doPrint();