<?php
/**
 * Auth: sjh
 * Date: 2018/3/14 10:44
 */
function callback($callback){
    $callback();
}


callback(function() use (&$var){
    echo '闭包函数测试'.$var;
});$var = '字符串';