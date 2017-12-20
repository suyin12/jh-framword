<?php
/**
 * Date: 2017/12/14 15:36
 */
$arr = array("name"=>"粟建晖","sex"=>"男","age"=>"18","address"=>"广东深圳","student"=>"海南");
array_push($arr,'祖籍');
print_r($arr);echo '<br>';
echo '入栈----';
array_push($arr,'三亚','天涯海角','海棠湾');
print_r($arr);echo '<br><br><br><br>';
echo '出栈----';
print_r(array_pop($arr));echo '<br><br><br><br>';
echo '出队----';
print_r(array_shift($arr));echo '<br><br><br><br>';
echo '与array_push对应---';
array_unshift($arr,'粟建晖','hello');
print_r($arr);echo '<br><br><br><br><br><br><br><br>';

$key = array_rand($arr);
echo '返回数组随机键名----'.$arr[$key].'<br><br><br><br>';
$key2 = array_rand($arr,3);

echo '返回数组随机键名数组----'.$arr[$key2[0]].'<br>';
echo '返回数组随机键名数组----'.$arr[$key2[1]].'<br>';
echo '返回数组随机键名数组----'.$arr[$key2[2]].'<br>';