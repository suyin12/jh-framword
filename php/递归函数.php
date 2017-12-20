<?php
/**
 * Date: 2017/12/13 17:02
 */
function test($n){
    echo $n."&nbsp;&nbsp;";
    function test(){
        echo $n."&nbsp;&nbsp;";
        echo $m."&nbsp;&nbsp;";
    }
    echo $m."&nbsp;&nbsp;";
}