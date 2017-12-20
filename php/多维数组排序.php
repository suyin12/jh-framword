<?php
/**
 * Date: 2017/12/14 16:17
 */
$arr = array(
    1 => array('name'=>'样','age'=>'18','id'=>3),
    2 => array('name'=>'个','age'=>'20','id'=>2),
    3 => array('name'=>'额','age'=>'23','id'=>4),
    4 => array('name'=>'去','age'=>'18','id'=>1)
);

foreach($arr as $value){
    $id[] = $value['id'];
    $age[] = $value['age'];
}
echo '多维数组排序前<br>';
echo "<pre>";
print_r($arr);echo '<br><br><br>';
echo "<pre>";
echo '多维数组排序后<br>';
array_multisort($id,$age,$arr);
print_r($arr);echo '<br>';