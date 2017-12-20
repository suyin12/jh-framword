<?php
/**
 * Date: 2017/12/13 17:13
 */
//$func = function($param){
//    echo "匿名函数和闭包函数".$param;
//};
//
//$func('www.baidu.com');

function callback($callback){
    $callback();
}


callback(function() use ($var){
   echo "匿名函数和闭包函数".$var ;
   $var = 20;
});
$var = '字符串';
echo $var;