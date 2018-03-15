<?php
/**
 * Auth: sjh
 * Date: 2018/1/26 13:49
 */


$test = [
    ['id'=>2,'name'=>'a'],
    ['id'=>1,'name'=>'b'],
    ['id'=>4,'name'=>'d'],
    ['id'=>3,'name'=>'c'],
];

foreach($test as $value){
    $id[] = $value['id'];
    $name[] = $value['name'];
}


array_multisort($test,SORT_ASC,SORT_REGULAR,$name);
echo '<pre>';
print_r($test);