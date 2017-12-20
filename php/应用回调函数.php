<?php
/**
 * Date: 2017/12/13 16:20
 */
//通过变量函数声明自己的回调函数
function filter($func){
    for($i=1;$i<100;$i++){
        if(call_user_func_array($func,array($i)))
            continue;

        echo $i."&nbsp;&nbsp;";
    }
}

function one($i){
    return $i%10 != 3;
}

function two($i){
    return $i != strrev($i);
}

filter('one');
//filter('two');
//用得比较多的,还是用call_user_func_array去调用
//call_user_func_array('one',[1]);