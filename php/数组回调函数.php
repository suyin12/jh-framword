<?php
//使用回调函数处理的数组函数
function func($num){
    if($num%2 == 0)
        return true;
}
$arr = array(0,1,2,3,4,5,6,7,8,9);
//array_filter(),两个参数,数组和回调函数
$newArr = array_filter($arr,'func');

print_r($newArr);echo "<br>";

//array_walk(),3个参数,1必须传入的数组,2回调函数,3可选的第三个参数
function func2($value,$key){
    echo $key . '=>' . $value."<br>";
}

array_walk($arr,'func2',"==>");
//开启错误提示并且设置报告级别
ini_set('display_errors','on');
error_reporting(E_ALL);
//3个参数的情况
function func3($value,$key,$p){
    echo $key . $p . $value."<br>";
}

array_walk($arr,'func3',"==>");

//引用传递的情况
function func4(&$value,$key){
    $value = 'web'."<br>";
}
var_dump(array_walk($arr,'func4'));echo "<br />";
print_r($arr);echo "<br>";

//array_map()相对于array_walk()更灵活
function func5($var){
    if($var == 'Mysql')
        return 'Oracle';
    return $var;
}

$arr1 = array('Linux','Apache','Mysql','PHP');
$arr1New = array_map('func5',$arr1);
print_r($arr1New);echo "<br>";

//两个数组参数
function func6($var,$var2){
    if($var === $var2)
        return 'same';
    return 'different';
}
$arr2 = array('Linux','Apache','mysql','PHP');
$arr2New = array_map('func6',$arr1,$arr2);
print_r($arr2New);echo "<br>";

//当自定义函数定义为null的情况下
print_r(array_map(null,$arr1,$arr2));
