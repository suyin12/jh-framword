<?php
$var = '字符串';
function callback($callback){
    $callback();
}

//callback(function(){
//    echo '匿名函数<br>';
//});

$func = function($param){
    echo $param;
};

//$func('匿名函数2');

callback(function() use ($var){
    echo '闭包函数引用参数---'.$var;
});