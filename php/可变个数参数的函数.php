<?php
/**
 * Date: 2017/12/13 15:55
 */
function moreArgs(){
    $args = func_get_args();
    for($i=0;$i<count($args);$i++){
        echo "第{$i}个参数为".$args[$i]."<br />";
    }
}
moreArgs('one','two',1,2);

function moreArgs2(){
    for($i=0;$i<func_num_args();$i++){
        echo "第{$i}个参数为".func_get_arg($i)."<br />";
    }
}
moreArgs2('three','four',3,4);