<?php
/**
 * Date: 2017/12/13 15:48
 */

function test(&$arg){
    $arg = 200;
}
$var = 100;
test($var);
echo $var;