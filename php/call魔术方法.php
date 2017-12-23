<?php
class Test{
    function __call($functionName,$args){
        echo '方法'.$functionName.'(参数:';
        print_r($args);
        echo ")不存在<br>\n";
    }
}
$test = new Test;
$test->say('粟建晖','男');