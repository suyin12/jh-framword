<?php
/**
 *
 * User: suyin
 * Date: 2017/9/7 12:46
 *
 */

function insertionSort($arr){
    $tmp = '';
    for($i = 1; $i<count($arr); $i++){
        for($j = 0; $j<count($arr)-$i; $i++){
            if($arr[$j]>$arr[$i]){
                $tmp = $arr[$j];
                for($n = count($arr);$n>0;$n--){

                }
                $arr[$i+1] = $tmp;
            }
        }


    }
}

function insertSort($arr) {
    $len = count($arr);
    for($i = 1; $i < $len; $i++) {
        if($arr[$i-1] > $arr[$i]) {
            for($j = $i - 1;$j >= 0; $j-- ) {
                $tmp = $arr[$j+1];
                if($tmp < $arr[$j]) {
                    $arr[$j+1] = $arr[$j];
                    $arr[$j] = $tmp;
                }else{
                    break;
                }
            }
        }
    }
    return $arr;
}