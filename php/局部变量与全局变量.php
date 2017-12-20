<?php
/**
 * Date: 2017/12/13 15:03
 */
$one = 100;
$two = 200;

function add(){
    $one = $GLOBALS['one'];
    $two = $GLOBALS['two'];
    echo $one+$two;
}

add();