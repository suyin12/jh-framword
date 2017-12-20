<?php
/**
 * Date: 2017/11/8 9:10
 */

$arr = [
    ['data'=>1,'time'=>'00:50:10'],
    ['data'=>2,'time'=>'23:50:10'],
    ['data'=>3,'time'=>'20:40:10']
];
echo "<pre>";
print_r($arr);
foreach($arr as $value){
    $new[] = $value['time'];
}
echo "<pre>";

array_multisort($new,SORT_DESC,$arr);
print_r($arr);