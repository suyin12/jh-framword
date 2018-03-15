<?php
/**
 * Auth: sjh
 * Date: 2018/3/14 10:18
 */

function filter($fun){
    for($i=0;$i<100;$i++){
        if($fun($i)){
            continue;
        }
        echo $i.'---';
    }
}

function one($num){
    return 3 != $num%10;
}

function two($num){
    return $num != strrev($num);
}

filter('one');
echo '<br>';
filter('two');