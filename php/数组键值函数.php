<?php
$arr = array(1,2,3,'A','b','c','6',1,2);
print_r(array_values($arr));echo '<br>';
print_r(array_keys($arr));echo '<br>';echo '<br>';echo '<br>';

echo '自己看错,第三个参数是判断类型是否也要相等,并不是不区分大小写,笨蛋:';echo '<br>';
var_dump(in_array(1,$arr,true));echo '<br>';
var_dump(in_array('1',$arr));echo '<br>';
var_dump(in_array('1',$arr,true));echo '<br>';
var_dump(in_array('a',$arr));echo '<br>';
var_dump(in_array('a',$arr,true));echo '<br>';
var_dump(in_array('A',$arr));echo '<br>';echo '<br>';echo '<br>';

echo 'array_search()与in_array()差不多,不过返回的是下标:';echo '<br>';
var_dump(array_search(1,$arr));echo '<br>';
var_dump(array_search('1',$arr));echo '<br>';
var_dump(array_search('1',$arr,true));echo '<br>';
var_dump(array_search('a',$arr));echo '<br>';
var_dump(array_search('a',$arr,true));echo '<br>';
var_dump(array_search('A',$arr));echo '<br>';echo '<br>';echo '<br>';

echo 'array_key_exists()检测键名或索引是否存在于数组:';echo '<br>';
var_dump(array_key_exists(1,$arr));echo '<br>';
var_dump(array_key_exists(2,$arr));echo '<br>';
var_dump(array_key_exists(3,$arr));echo '<br>';
var_dump(array_key_exists(10,$arr));echo '<br>';
var_dump(array_key_exists('1',$arr));echo '<br>';
var_dump(array_key_exists('6',$arr));echo '<br>';echo '<br>';echo '<br>';

echo 'array_flip()翻转数组与字符串翻转函数strrev()类似:';echo '<br>';
print_r(array_flip($arr));echo '<br>';echo '<br>';echo '<br>';

echo 'array_reverse()函数翻转数组的顺序:';echo '<br>';
print_r(array_reverse($arr));echo '<br>';echo '<br>';echo '<br>';


$arr2 = array(
    array(1,2,3),
    array(4,5,6)
);
echo 'count()数组统计函数,注意的是第二个参数,为1时可以统计多维数组的长度:';echo '<br>';
echo count($arr2,1);echo '<br>';echo '<br>';echo '<br>';

echo 'array_count_values()统计数组所有值出现的次数:';echo '<br>';
print_r(array_count_values($arr));echo '<br>';echo '<br>';echo '<br>';

echo 'array_unique()删除数组重复的值,返回新数组:';echo '<br>';
print_r(array_unique($arr));echo '<br>';echo '<br>';echo '<br>';

echo 'array_filter()用回调函数过滤数组中的值,如果处理的数组是关联数组,则键名保持不变:';echo '<br>';
print_r(array_filter($arr,'myFunc'));echo '<br>';echo '<br>';echo '<br>';
function myFunc($var){
    if(is_numeric($var) and $var % 2 == 0){
        return true;
    }
}

echo 'array_walk()引用传递第一个参数,第二个参数为回调函数接收两个参数1位value,2位key:';echo '<br>';
//ini_set('display_errors','off');
@array_walk($arr,'myFunc2','hey man');echo '<br>';echo '<br>';echo '<br>';
function myFunc2($value,$key,$p){
    echo $key.'=>'.$value.'=>'.$p;echo '<br>';
}

echo 'array_map()比array_walk()更灵活,传入的数组长度应该一样,否则短的将会被用NULL类型代替:';echo '<br>';
print_r($arr);echo '<br>';
$arr3 = array(2,3,1,'A','b','c','6',1,2);
print_r(array_map('myFunc3',$arr));echo '<br>';
function myFunc3($var){
    if($var === 2){
        return 3;
    }
    return $var;
}
print_r(array_map('myFunc4',$arr,$arr3));echo '<br>';echo '<br>';echo '<br>';
function myFunc4($var,$var2){
    if($var == $var2){
        return 'same';
    }
}
$arr4 = array(2,54,23,4,7,6);
//sort($arr3);
//arsort($arr4);
echo '写一下数组排序函数吧,sort(),rsort(),asort(),arsort(),ksort(),krsort(),usort(),uksort(),uasort(),array_multisort(),natsort(),natcasesort()';
print_r($arr4);echo '<br>';echo '<br>';echo '<br>';

echo 'array_slice(),第一个参数规定必须传入数组,第二个参数为起始位置,第三个参数为取出长度,第四个参数在非字符串键时设为true可以返回原键名.';echo '<br>';
print_r(array_slice($arr4,2,3));echo '<br>';echo '<br>';
echo 'array_splice()与array_slice()类似,不过array_splice()是删除或替换数组中的元素';echo '<br>';
//array_splice($arr4,2);
//array_splice($arr4,1,-1);
//array_splice($arr4,0,5,'web');
array_splice($arr4,2,3,array('a','b','c'));
print_r($arr4);echo '<br>';echo '<br>';echo '<br>';

echo 'array_combine()第一个参数数组作为键名,第二个参数数组作为value,如果两个数组有一个为空或者长度不一返回false';echo '<br>';
$arr5 = array(1,2,3);
$arr6 = array('a','b','c');
$arr7 = array();
$arr8 = array('a','b','c','d');
print_r(array_combine($arr5,$arr6));echo '<br>';
print_r(array_combine($arr5,$arr8));echo '<br>';echo '<br>';echo '<br>';

echo 'array_merge()数组合并函数,合并多个数组,如果多个数组键名相同,则最后一个键值将覆盖前面的';echo '<br>';
print_r(array_merge($arr5,$arr6));echo '<br>';
print_r(array_merge($arr6));echo '<br>';echo '<br>';echo '<br>';echo '<br>';

echo 'array_intersect()取两个数组的交集';echo '<br>';
print_r(array_intersect($arr6,$arr8));echo '<br>';
echo 'array_diff()取两个数组的差集,意思是去第一个数组中在第二个数组没有的元素';echo '<br>';
print_r(array_diff($arr8,$arr6));echo '<br>';echo '<br>';echo '<br>';

echo '数组入栈array_push(),出栈array_pop(),入队array_push,出队array_shift()';echo '<br>';
print_r($arr6);echo '<br>';
echo array_shift($arr6);echo '<br>';
print_r($arr6);echo '<br>';echo '<br>';echo '<br>';echo '<br>';

echo '其他有用的数组函数array_rand()有两个参数,第一个参数为要操作数组,第二个参数为取出键的个数,默认为1,非1非0非负的情况返回键名数组,shuffle()
重新洗牌,成功返回true,失败返回false,array_sum(),range()';echo '<br>';
print_r(array_rand($arr8));echo '<br>';
print_r(array_rand($arr8,2));echo '<br>';
print_r($arr8);echo '<br>';
var_dump(shuffle($arr8));
print_r($arr8);echo '<br>';
$arr9 = range(1,100,2);
print_r($arr9);echo '<br>';
var_dump(array_sum($arr9));



