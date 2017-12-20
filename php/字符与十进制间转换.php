<?php
$str = '粟建晖';

$len = strlen($str);
echo '字符串长度--'.$len.'<br>';
$ret = array();
for($i=0;$i<$len;$i++){
    if(ord($str{$i})>127){
        $ret[] = ord($str[$i]).' '.ord($str[++$i]).' '.ord($str[++$i]);
    }
}
echo '<pre>';
var_dump($ret);

foreach($ret as $value){
    $arr = explode(' ',$value);
    $ret2[] = chr($arr[0]).chr($arr[1]).chr($arr[2]);
}
echo '<pre>';
echo $ret2[0].$ret2[1].$ret2[2];
