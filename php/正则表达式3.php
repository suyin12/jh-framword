<?php
$pattern = '/<[\/\!]*?[^<>]*?>/is';
$text = '<b>粗体</b><i>斜体</i><font size="7" color="red">红警7号</font><u>下划线</u>';
echo preg_replace($pattern,'',$text,2);echo '<br>';
echo '去掉标签不行,还要再来一个翻转'.strrev(strip_tags($text,'<font>'));
echo 'preg_replace()最常用的还是包含反向引用,用\n的形式依次引用正则表达式中的模式单元';echo '<br>';echo '<br>';


$str2 = '春节放假时间02/15/2018至02/21/2018';
$pattern2 = '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/';
echo preg_replace($pattern2,"\\3-\\1-\\2",$str2);echo '<br>';
echo preg_replace($pattern2,"\${3}-\${1}-\${2}",$str2);



echo 'preg_replace()特有的模式修正符e';echo '<br>';
$pattern3 = '/(<\/?)(\w+)([^>]*>)/e';
echo preg_replace($pattern3,"'\\1'.strtoupper('\\2').'\\3'",$text);echo '<br>';echo '<br>';


echo 'str_replace()比preg_replace()效率要高一些,str_ireplace()不区分大小写';echo '<br>';
$str3 = 'a b c d A';
echo str_replace('a','apache',$str3);echo '<br>';
echo str_ireplace('a','apache',$str3);echo '<br>';


echo '字符串分割preg_split()';echo '<br>';
print_r(preg_split('/[\s,]/','php is,脚本语言'));echo '<br>';
print_r(explode(' ','php is,脚本语言'));echo '<br>';
$arr = array('a','b','c','d');
echo implode('++',$arr);echo '<br>';echo '<br>';




