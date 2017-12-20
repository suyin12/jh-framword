<?php
$str = 'lamp is a education';
echo '原字符串'.$str;echo '<br>';
echo '全部字符转换成大写'.strtoupper($str);echo '<br>';
echo '全部字符转换成小写'.strtolower(strtoupper($str));echo '<br>';
echo '字符串首字母转化为大写'.ucfirst($str);echo '<br>';
echo '单词首字母转化为大写'.ucwords($str);echo '<br>';