<?php
/**
 * Auth: sjh
 * Date: 2018/3/14 14:10
 */

$arr = ['id'=>12241020,'name'=>'建晖','familyName'=>'粟','sex'=>'男','mobile'=>'null','real'=>'建晖'];
$arrNew = ['id'=>12241020,'name'=>'建晖','familyName'=>'粟','sex'=>'男','mobile'=>'null','real'=>'建晖','address'=>'广东深圳'];

$arr1 = array_reverse($arr);
print_r($arr1);echo '<br>';
$arr2 = array_flip($arr);
print_r($arr2);echo '<br>';
print_r(array_values($arr));echo '<br>';
print_r(array_keys($arr));echo '<br>';
print_r(array_keys($arr,'建晖'));echo '<br>';
var_dump(in_array('12241020',$arr,true));echo '<br>';
var_dump(array_search(12241020,$arr,true));echo '<br>';
var_dump(array_key_exists('mobile',$arr));echo '<br>';
var_dump(isset($arr['mobile']));echo '<br>';//isset()与array_key_exists()的区别是当值为NULL时,array_key_exists()为真,isset()为假.
var_dump(count($arr));echo '<br>';
var_dump(array_count_values($arr));echo '<br>';
var_dump(array_unique($arr));echo '<br>';//会保留第一值的下标

print_r(array_filter($arr,'testFilter'));echo '<br>';
function testFilter($val){
    if(is_int($val)){
        return false;
    }
    return true;
}

array_walk($arr,'fun1','three');
function fun1($val,$key,$three){
    echo "the $key is $val and has $three";echo '<br>';
}

print_r(array_map('fun2',$arr,$arrNew));echo '<br>';
function fun2($v1,$v2){
    if($v1 == $v2){
        return 'same';
    }
    return 'different';
}
print_r(array_map(null,$arr,$arrNew));echo '<br>';echo '<br>';echo '<br>';
print_r($arr);echo '<br>';echo '<br>';echo '<br>';
print_r(array_slice($arr,1,2));echo '<br>';
print_r(array_slice($arr,1,-1));echo '<br>';
print_r(array_slice($arr,-2,1));echo '<br>';echo '<br>';echo '<br>';echo '<br>';
print_r($arr);echo '<br>';
print_r(array_splice($arr,1));echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';
$arr = ['id'=>12241020,'name'=>'建晖','familyName'=>'粟','sex'=>'男','mobile'=>'null','real'=>'建晖'];
print_r(array_combine($arr,$arr));echo '<br>';
print_r(array_merge($arr,$arrNew));echo '<br>';
print_r(array_diff($arrNew,$arr));echo '<br>';
echo array_pop($arrNew);echo '<br>';
echo array_shift($arr);echo '<br>';