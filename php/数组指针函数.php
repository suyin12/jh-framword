<?php
$arr = array(1,2,3,'a','b','c');

echo key($arr).'=>'.current($arr);echo '<br>';
next($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
prev($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
next($arr);
next($arr);
next($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
reset($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
end($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
reset($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
prev($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
end($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
next($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
next($arr);
echo key($arr).'=>'.current($arr);echo '<br>';
$arr[] = 'd';
$arr[] = 'e';

