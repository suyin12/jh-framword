<?php
/**
 * Auth: sjh
 * Date: 2018/3/12 11:49
 */
$file = __DIR__.'/data.txt';
$fp = fopen($file,'r') or die("文件打开失败!");

echo '文件指针当前位置:'.ftell($fp);echo '<br>';
echo '读取100个字节后:'.fread($fp,10);echo '<br>';
echo '现在文件指针位置:'.ftell($fp);echo '<br>';

echo '将文件指针移动到指定位置:';
fseek($fp,100,SEEK_CUR);
echo '现在文件指针位置:'.ftell($fp);echo '<br>';
echo fread($fp,10);echo '<br>';

fseek($fp,-10,SEEK_END);
echo '现在文件指针位置:'.ftell($fp);echo '<br>';
echo fread($fp,10);echo '<br>';

echo '移动文件指针到开头'.rewind($fp);echo '<br>';
echo '现在文件指针位置:'.ftell($fp);echo '<br>';

fclose($fp);