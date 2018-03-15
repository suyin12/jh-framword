<?php
/**
 * Auth: sjh
 * Date: 2018/3/14 11:28
 */
$a = 10;
$b = 20;

function sum(){
    global $a,$b;
    return $b = $a + $b;
}
sum();
echo $b;

function sum2(){
    $GLOBALS['a'] = $GLOBALS['a']+$GLOBALS['b'];
}
sum2();
echo '<br>';
echo $a;