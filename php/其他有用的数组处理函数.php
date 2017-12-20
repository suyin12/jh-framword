<?php
//array_rand();
$arr = array("name"=>"粟建晖","sex"=>"男","age"=>"18","address"=>"广东深圳","student"=>"海南");

$key = array_rand($arr,3);

echo $arr[$key[0]];echo '<br>';
echo $arr[$key[1]];echo '<br>';
echo $arr[$key[2]];echo '<br><br><br>';

//shuffle
echo '原数组----';
print_r($arr);echo '<br>';
shuffle($arr);
echo '打乱后数组----';
print_r($arr);echo '<br><br><br>';

//array_sum()
echo '数组求和----';
$arr1 = array('1','3',6.6,'a','1b');
var_dump(array_sum($arr1));echo '<br><br><br>';

//range();
echo '创建并返回一个数值数组----';
print_r(range(0,50,5));echo '<br>';
echo '创建并返回一个字母数组----';
print_r(range('a','z'));