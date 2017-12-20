<?php
$str1 = 'Admin';
$str2 = 'lampBrother';

if(strcasecmp($str1,'admin') == 0){
    echo '用户名相等';echo '<br>';
}

if(strcasecmp(strtolower($str1),strtolower('admin')) == 0){
    echo '用户名相等';echo '<br>';
}

switch(strcmp($str2,'lampbrother')){
    case 0:
        echo '相等';break;
    case 1:
        echo '字符串1比字符串2大';break;
    case -1:
        echo '字符串1比字符串2小';break;
}