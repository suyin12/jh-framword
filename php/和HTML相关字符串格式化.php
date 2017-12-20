<?php
echo nl2br("遇到\\n\n在它之前插入<br>");

$str = "<B>WebServer:</B>& 'linux' & 'apache'";
echo '原字符串'.$str;echo "<br>\n";
echo '处理字符串不处理单引号'.htmlspecialchars($str,ENT_COMPAT);echo "<br>\n";
echo '处理字符串包括单引号'.htmlspecialchars($str,ENT_QUOTES);echo "<br>\n";
echo '处理字符串不处理引号'.htmlspecialchars($str,ENT_NOQUOTES);echo "<br><br><br>\n";

$str2 = "一个 'quote' 是 <b>bold</b>";
echo htmlentities($str2);echo "<br><br><br>\n";

$str3 = "<font color='red' size='7'>Linux</font><i>Apache</i><u>MySQL</u><b>PHP</b>";
echo '字符串的原型----'.$str3;echo "<br>\n";
echo '删除所有html标签----'. strip_tags($str3);echo "<br>\n";
echo '不删除font标签----'.strip_tags($str3,"<font>");echo "<br>\n";
echo '删除font标签----'.strip_tags($str3,"<i><u><b>");echo "<br><br><br>\n";

echo '字符串翻转函数'.strrev($str3);echo "<br><br><br>\n";


echo '数字格式化number_format()';echo "<br>\n";
$num = 123456789;
echo number_format($num);echo "<br>\n";
echo number_format($num,2);echo "<br>\n";
echo number_format($num,2,',','.');echo "<br>\n";

//$fileResource = fopen('each.php','r+');
//$fileResource = readfile('each.php');

$fileResource = md5_file('each.php');
echo $fileResource;