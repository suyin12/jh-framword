<?php
$pattern = "/(https?|ftps?):\/\/(www)\.([^\.\/]+)\.(net|com|org)(\/[\w-\.\/\?\%\&\=]*)?/i";

$url = "网址为http://www.lampbrother.net/index.php的位置是兄弟连,
    网址为http://www.baidu.com/index.php的位置是百度,
    网址为http://www.google.com/index.php的位置是谷歌";

$bool = preg_match($pattern,$url,$matches);

var_dump($bool);

echo '<pre>';
print_r($matches);echo '<br>';echo '<br>';
echo 'preg_match_all()函数:';echo '<br>';
preg_match_all($pattern,$url,$matches2,PREG_SET_ORDER);
foreach($matches2 as $value){
    echo '<pre>';
    print_r($value);
}
echo '<br>';echo '<br>';


$arr = array('Linux RedHat9.0','Apache2.2.9','MySQL5.0.51','PHP5.2.6','LAMP','100');
echo 'preg_grep()函数:';echo '<br>';
$newArr = preg_grep('/^[a-zA-Z\s]+[\d\.]+$/',$arr);

echo '<pre>';
print_r($newArr);

echo '<br>';echo '<br>';
echo 'strstr()函数:';echo '<br>';
echo strstr('this is a test!','test');echo '<br>';
echo strstr('this is a test!',115);echo '<br>';
echo 'strpos()查找字符串最先出现的位置:';
echo strpos('this is a test!','test');echo '<br>';
echo substr('this is a test!',10,2);echo '<br>';
echo 'strrpos()查找字符串最后出现的位置:';
echo strrpos('this is a test!','test');