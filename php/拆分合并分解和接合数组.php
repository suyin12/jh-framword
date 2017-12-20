<?php
/**
 * Date: 2017/12/14 16:10
 */
//array_slice()
$arr = array("name"=>"粟建晖","sex"=>"男","age"=>"18","address"=>"广东深圳","student"=>"海南");

$arrNew = array_slice($arr,1,3);
echo '原数组:';print_r($arr);echo '<br><br>';
echo '新数组:';
print_r($arrNew);echo '<br><br>';

echo '从后面开始取:';
print_r(array_slice($arr,-2,1));echo '<br><br><br><br>';

$arr2 = array("粟建晖","男","18","广东深圳","海南");
echo '原数组:';print_r($arr2);echo '<br>';
echo '新数组不保留键名:';
print_r(array_slice($arr2,1,2));echo '<br>';
echo '新数组保留键名:';
print_r(array_slice($arr2,1,2,true));echo '<br><br><br><br><br><br>';

//array_splice()
$arr3 = array("粟建晖","男","18","广东深圳","海南");
echo '原数组:';print_r($arr3);echo '<br>';
echo '从第3个元素到结尾都被删除:';
array_splice($arr3,2);
print_r($arr3);echo '<br><br><br><br>';

$arr4 = array("粟建晖","男","18","广东深圳","海南");
echo '原数组:';print_r($arr4);echo '<br>';
echo '从第二个元素到结尾倒数第一的元素都被删除:';
array_splice($arr4,1,-1);
print_r($arr4);echo '<br><br><br><br>';

$arr5 = array("粟建晖","男","18","广东深圳","海南");
echo '原数组:';print_r($arr5);echo '<br>';
echo '从第二个元素到的元素将被第四个参数替换';
array_splice($arr5,1,count($arr5),'web');
print_r($arr5);echo '<br><br><br><br>';

$arr6 = array("粟建晖","男","18","广东深圳","海南");
echo '原数组:';print_r($arr6);echo '<br>';
echo '最后一个元素被第四个参数替换掉';
array_splice($arr6,-1,1,array('祖籍','学习地'));
print_r($arr6);echo '<br><br><br><br>';

//array_combine()
$arr7 = array('a','b','c','d');
$arr8 = array(1,2,3,4);
echo '合并两个数组<br>';
echo '数组1----';print_r($arr7);echo '<br>';
echo '数组2----';print_r($arr8);echo '<br>';
echo '合并后数组第一个数组作为键,第二个数组作为值----';print_r(array_combine($arr7,$arr8));echo '<br><br><br><br>';

//array_merge()
echo '组合两个数组<br>';
echo '数组1----';print_r($arr7);echo '<br>';
echo '数组2----';print_r($arr8);echo '<br>';
echo '合并后数组----';print_r(array_merge($arr7,$arr8));echo '<br><br><br><br>';

$arr9 = array('PHP','Linux','Mysql','Ngnix');
$arr10 = array('ASP','Linux','Mysql','Apache');
//array_intersect()
echo '取两个数组的交集<br>';
echo '数组1----';print_r($arr9);echo '<br>';
echo '数组2----';print_r($arr10);echo '<br>';
echo '数组交集----';print_r(array_intersect($arr9,$arr10));echo '<br><br><br><br>';

//array_intersect()
echo '取两个数组的差集<br>';
echo '数组1----';print_r($arr9);echo '<br>';
echo '数组2----';print_r($arr10);echo '<br>';
echo '数组差集----';print_r(array_diff($arr9,$arr10));echo '<br><br><br><br>';