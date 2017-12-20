<?php
$arr = array(1,3,23,54,32,11,4,5);
//按值大小排序,忽略键名
sort($arr);
echo '按值大小排序,忽略键名';echo "<br>";
print_r($arr);echo "<br>";

rsort($arr);
print_r($arr);echo "<br><br><br><br><br><br>";

//按键大小排序
$arr2 = array(1=>'Mysql',23=>'Apache',5=>'PHP',8=>'Linux');
echo '按键大小排序';echo "<br>";
ksort($arr2);
print_r($arr2);echo "<br>";

krsort($arr2);
print_r($arr2);echo "<br><br><br><br><br><br>";

//按值大小排序,不忽略键名
asort($arr2);
echo '按值大小排序,不忽略键名';echo "<br>";
print_r($arr2);echo "<br>";

arsort($arr2);
print_r($arr2);echo "<br>";
echo '忽略键名';echo "<br>";
rsort($arr2);
print_r($arr2);echo "<br><br><br><br><br><br>";

//自然排序法
echo '自然排序法';echo "<br>";
$arr3 = array('file1.txt','file11.txt','File2.txt','FILE12.txt','file.txt');
natsort($arr3);
print_r($arr3);echo "<br>";
echo '忽略大小写的自然排序法';echo "<br>";
natcasesort($arr3);
print_r($arr3);echo "<br>";

$test = array_shift($arr3);
print_r($arr3);echo "<br>";
