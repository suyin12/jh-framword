<?php
/**
 * Auth: sjh
 * Date: 2018/1/26 14:15
 */

$arr1 = array('a'=>'Linux','b'=>'Mysql','c'=>'Apache','d'=>'PHP','f'=>'nginx');

print_r(array_slice($arr1,1,5,false));echo '<br>';

print_r($arr1);echo '<br>';
shuffle($arr1);
print_r($arr1);echo '<br>';