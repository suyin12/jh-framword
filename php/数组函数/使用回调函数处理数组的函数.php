<?php
/**
 * Auth: sjh
 * Date: 2018/1/26 11:23
 */

$arr1 = array('Linux','Mysql','Apache','PHP','nginx');
$arr2 = array('linux','mysql','apache','php');

$arr3 = array_map('func',$arr1,$arr2);

function func($value1,$value2){
    var_dump($value1);
    if(strtoupper($value1) == strtoupper($value2)){
        return 'same';
    }

    return 'difference';
}

echo '<pre>';
print_r($arr3);