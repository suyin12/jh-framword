<?php
$fileName = 'data.txt';
$handle = fopen(__DIR__.'/'.$fileName,'r') or die('文件打开失败!');

echo '当前位置'.ftell($handle);echo '<br>';
echo '读取10个字节长度'.fread($handle,10);echo '<br>';
echo '当前位置'.ftell($handle);echo '<br>';

//从当前位置向后移动100个字节后
fseek($handle,100,SEEK_CUR);
echo '当前位置'.ftell($handle);echo '<br>';
echo fread($handle,10);echo '<br>';

//将文件指针移动到末尾倒数第10个字节的位置
fseek($handle,-10,SEEK_END);
echo '当前位置'.ftell($handle);echo '<br>';
echo fread($handle,10);echo '<br>';

//将文件指针移动到开头
rewind($handle);echo '<br>';
echo '当前位置'.ftell($handle);echo '<br>';

//关闭文件资源
fclose($handle);