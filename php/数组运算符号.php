<?php
$a = array('a'=>'Linux','b'=>'Apache');
$b = array('a'=>'PHP','b'=>'Mysql','c'=>'web');


echo '原数组----';echo '<br >';
print_r($a);echo '<br >';
print_r($b);echo '<br ><br ><br >';


$c = $a + $b;
echo '与array_merge()不同的是,遇到相同的键名后面的数组不会覆盖前面的,$a数组在前,$b数组在后----';
print_r($c);echo '<br ><br ><br >';
$d = $b + $a;
echo '与array_merge()不同的是,遇到相同的键名后面的数组不会覆盖前面的,$b数组在前,$a数组在后----';
print_r($d);echo '<br ><br ><br >';


echo '还可以使用比较运算符号哦--';
$e = array('PHP','Mysql');
$f = array(1=>'Mysql',0=>'PHP');
var_dump($e == $f);
var_dump($e === $f);
var_dump($e != $f);
var_dump($e <> $f);
var_dump($e !== $f);
echo '<br ><br ><br >';
echo '删除数组元素unset()并不会导致下标重新索引,删除数组元素还有出队array_shift(),出栈array_pop()';echo '<br>';
echo '原数组----';
print_r($b);echo '<br>';
unset($b['b']);
echo 'unset后数组----';
print_r($b);echo '<br ><br ><br >';

echo '数组下标问题';
$arr = ARRAY('1.4'=>'a','3'=>'b',4=>'3','08'=>'5',1.8=>9,'bar'=>'var');
print_r($arr);
var_dump($arr);echo '<br ><br ><br >';

define('bar','11111111');
$bar = "11111111";
echo '裸字符串效率会低8倍以上----';
echo "$arr[bar]";echo '<br ><br ><br >';

//echo "<pre>";
//var_dump($_ENV);


