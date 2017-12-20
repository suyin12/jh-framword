<?php
$arr = array('file1.txt','file22.txt','file2.txt','file11.txt');

function mySort(&$arr,$select=false){
    $tmp = '';
    for($i=0;$i<count($arr);$i++){
        for($j=$i;$j<(count($arr)-1);$j++){
            if($select){
                //字典排序法
                if(strcmp($arr[$j],$arr[$j+1]) > 0){
                    $tmp = $arr[$j+1];
                    $arr[$j+1] = $arr[$j];
                    $arr[$j] = $tmp;
                }
            }else{
                //自然法排序
                if(strnatcmp($arr[$j],$arr[$j+1]) > 0){
                    $tmp = $arr[$j+1];
                    $arr[$j+1] = $arr[$j];
                    $arr[$j] = $tmp;
                }
            }
        }

    }
    return $arr;
}
print_r(mySort($arr,false));
print_r(mySort($arr,true));