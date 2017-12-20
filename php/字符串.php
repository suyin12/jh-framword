<?php
echo substr('123456',2,4);echo '<br />';
echo substr(123456,2,4);echo '<br />';
//echo hello;

$str = 'lamp';
echo $str.'<br>';
echo $str{0};
echo $str{1};
echo $str{2};
echo $str{3}.'<br>';
echo $str{0}.$str{1}.'<br>';

//取出字符串最后一个字符
echo '取出字符串最后一个字符-------------'.$str{strlen($str)-1}.'<br>';
$str{strlen($str)-1} = 'e';
echo '修改字符串中最后一个字符----------'.$str.'<br>';
$str{1} = 'nginx';
echo '用一个字符串去修改另一个字符串中的第二个字符'.$str.'<br><br><br><br>';


//双引号中的变量解析
$lamp = array('os'=>'linux','webserver'=>'apache','db'=>'mysql','language'=>'php');
echo '索引数组下标不能使用单引号'."os is $lamp[os]".'<br>';
echo '索引数组下标使用单引号必须要用花括号'."os is {$lamp['os']}".'<br>';
echo '索引数组下标不使用单引号而用花括号的情况会把下标当做常量,常量不存在当做字符串,效率低,尽量避免这种写法'."os is {$lamp[os]}".'<br><br><br>';

echo '双引号也可以解析对象中的成员'."This square is $square->width meters broad".'<br>';
echo '不能解析的对象中的成员'."This square is $square->width00 meters broad".'<br>';
echo '不能解析可以使用花括号解决'."This square is {$square->width}00 meters broad".'<br><br><br><br>';

//常用的字符串输出函数
echo "echo()是语言结构,不需要使用括号".'<br>';
echo'安保处','这样错误';
print('print()有返回值成功返回1,失败返回0,效率没有echo高').'<br>';
echo 'die()函数参数如果是字符串会在函数退出前输出,如果是一个整数,这个值会被用作退出状态从0-254,退出状态255由php保留,如果是0则成功地终止程序'.'<br>';
print('printf()用于格式化输出字符串<br>');
$str = 'LAMP';
$number = 15;
echo '将字符串参数$str在第一个%处输出,按%s字符串输出,整型$number按%u输出:<br>';
printf('%s book.page number %X<br>',$str,$number);echo '<br>';
echo '将整型按浮点数输出,保留3位小数:<br>';
printf('%0.3f',$number);echo '<br><br><br>';
echo '定义一个格式并在其中使用占位符<br>';

$format = "The books %2\$s contains %1\$d%% pages;
            That`s a nice %2\$s full of %1\$d%% pages.<br>";
printf($format,$number,$str);echo '<br><br><br>';

