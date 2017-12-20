<?php
$str = '    lamp   ';
echo '原字符串'.strlen($str).'<br>';
echo '去掉左边空白'.strlen(ltrim($str)).'<br>';
echo '去掉右边空白'.strlen(rtrim($str)).'<br>';
echo '去掉两边空白'.strlen(trim($str)).'<br><br><br>';

$str2 = '123 Lamp ..';
echo '含数字字符串'.$str2.'<br>';
echo '去掉左边数字'.ltrim($str2,'0..9').'<br>';
echo "去掉右边..".rtrim($str2,'.').'<br>';
echo '去掉两边数字大小写字母.'.trim($str2,'a..z A..Z .').'<br><br><br>';


$str3 = 'lamp';
echo '字符串填充函数'.'<br>';
echo str_pad($str3,10).'<br>';
echo str_pad($str3,10,'-=',STR_PAD_LEFT).'<br>';
echo str_pad($str3,6,'_',STR_PAD_BOTH).'<br>';
echo str_pad($str3,6,'___________',STR_PAD_RIGHT).'<br>';

