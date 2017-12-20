<?php
/**
 * Date: 2017/12/14 16:10
 */
//usort(),uasort(),uksort();

$arr = array('Linux','OS','Apache','Mysql','PHP');

function func($var1,$var2){
    if(strlen($var1) == strlen($var2))
        return 0;
    return strlen($var1)>strlen($var2)?1:0;
}
echo '用户自定义规则数组排序';echo "<br>";
usort($arr,'func');
print_r($arr);