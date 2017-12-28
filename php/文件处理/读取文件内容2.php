<?php
$fileName = 'data.txt';
$handle = fopen(__DIR__.'/'.$fileName,'r') or die('文件打开失败!');
echo 'fgets()每次读取一行字符';echo '<br>';
while(!feof($handle)){
    $contents = fgets($handle,4096);
    echo $contents;echo '<br>';
}
fclose($handle);
echo '<br>';echo '<br>';
echo 'fgetc()每次读取一个字符';echo '<br>';

$handle2 = fopen(__DIR__.'/'.$fileName,'r') or die('文件打开失败!');

while(false !== ($char = fgetc($handle2))){
//    echo $char;echo '<br>';
}
fclose($handle2);

echo '<br>';echo '<br>';echo '<br>';
echo 'file()与fiel_get_contents()类似不过file()把文件内容读取到数组中,以行分隔,换行符仍在每个元素的末尾';echo '<br>';
echo '<pre>';
print_r(file(__DIR__.'/'.$fileName));
echo '<br>';echo '<br>';echo '<br>';


echo 'readfile()读取整个文件,立即输出到缓冲区,并返回读取的字节数';echo '<br>';
readfile(__DIR__.'/'.$fileName);