<?php
//array_values()
$arr = array("a"=>"Linux","b"=>"Apache","c"=>"Mysql","d"=>"PHP");

print_r(array_values($arr));echo "<br>";
print_r($arr);echo "<br>";

//array_keys(array input [,mixed search_value[,bool strict]]);
$arr2 = array(10,"10",20,30);
print_r(array_keys($arr2));echo "<br>";
var_dump(array_keys($arr2,"10",false));echo "<br>";
var_dump(array_keys($arr2,"10",true));echo "<br>";

//bool in_array(mixed needle array haystack [,bool strict])
$arr3 = array("Mac","NT","Irix","Linux");

if(in_array("Mac",$arr3)){
    echo "got Mac";echo "<br>";
}
if(in_array('mac',$arr3,false)){
    echo 'got mac';echo "<br>";
}

$arr4 = array('1.12',12.3,1.13);

if(in_array('12.3',$arr4,true)){
    echo "12.3找到";echo "<br>";
}
if(in_array(12.3,$arr4,true)){
    echo "12.3找到";echo "<br>";
}

//string array_search(mixed needle array haystack [,bool strict])
var_dump(array_search("PHP",$arr));echo "<br>";

$arr5 = array('1'=>'10','2'=>10);
echo array_search(10,$arr5,true);echo "<br>";

//array_key_exists()与isset
$arr6 = array('first'=>1,'second'=>4);
if(array_key_exists('first',$arr6)){
    echo 'first存在';echo "<br>";
}
$arr7 = array('first'=>null,'second'=>4);
var_dump(isset($arr7['first']));echo "<br>";
var_dump(array_key_exists('first',$arr7));echo "<br>";
//array_flip();
print_r(array_flip($arr6));echo "<br>";
$arr8 = array(1=>'a',2=>'b',3=>'a');
print_r(array_flip($arr8));echo "<br />";

//array_reverse()
print_r(array_reverse($arr8,true));echo "<br />";

//count()
echo count('1235');echo "<br />";
$a = array();
echo count($a);echo "<br />";
echo count(1234);echo "<br>";
$arr9 = array(
    'lamp'=>array(1,2,3,4),
    'lnmp'=>array(5,6,7,8)
);
echo 'count()第二个参数可以为0或1,为1递归统计元素个数'.count($arr9,1);echo "<br />";

//array_count_values()
$arr10 = array(1,'php',1,'php','mysql');
print_r(array_count_values($arr10));echo "<br />";

//array_unique()
print_r(array_unique($arr10));echo "<br />";