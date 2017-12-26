<?php
echo '字符串处理:';echo '<br>';
echo 'substr(),{$str}复杂字符串法,$str{下标},{$obj->test}00';echo '<br>';
echo '输出函数echo(),printf(),die(),sprintf()';echo '<br>';echo '<br>';echo '<br>';
echo '格式化字符串:';echo '<br>';
echo 'ltrim(),rtrim(),trim(),strlen(),str_pad(),strtolower(),strtoupper(),ucfirst(),Ucwords(),nl2br()
htmlentities(),htmlspecialchars(),Stripslashes(),addcslashes(),strip_tags(),number_format(),strrev(),md5()
';echo '<br>';echo '<br>';echo '<br>';echo '<br>';

echo '比较函数';echo '<br>';
echo 'strcmp(),strcasecmp(),strnatcmp()';echo '<br>';echo '<br>';

echo '字符串处理函数';echo '<br>';
echo 'strstr()应该与strrchr()对应哦,strpos(),strrpos(),substr()';echo '<br>';echo '<br>';echo '<br>';
$str = 'this is test!,test,test';echo '<br>';
echo strstr($str,'test');echo '<br>';
echo strstr($str,'test',true);echo '<br>';
echo '胡汉三又回来了'.strstr($str,'test',true).strstr($str,'test');echo '<br>';echo '<br>';echo '<br>';
echo stristr('This is a TEST!','test');echo '<br>';
echo 'strpos()对应的stripos()忽略大小写用来查找字符串第一次出现的位置';echo '<br>';
echo strpos('this is a test , this is a test','test');echo '<br>';echo '<br>';
echo 'strrpos()对应的strripos()忽略大小写用来查找字符串最后一次出现的位置';echo '<br>';
echo strrpos('this is a test , this is a test','test');echo '<br>';

$url = 'www.baidu.com/index.php';

echo '获取文件名部分'.substr($url,strrpos($url,'/')+1);echo '<br>';
echo '获取文件扩展名'.substr($url,strrpos($url,'.')+1);echo '<br>';echo '<br>';echo '<br>';

echo 'strrchr()查找一个字符串在另一个字符串中最后出现的位置,返回直到末尾部分字符串';echo '<br>';
echo '获取文件扩展名'.substr(strrchr($url,'.'),1);echo '<br>';