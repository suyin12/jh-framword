<?php
$url = __DIR__;
$fileName = __FILE__;


echo $url;echo '<br>';
echo $fileName;echo '<br>';
echo 'basename()返回文件部分,前提是一个文件的全路径比如__FILE__';echo '<br>';
echo basename($url);echo '<br>';
echo basename($fileName);echo '<br>';


echo 'dirname()与basename()相反,去掉文件名返回目录名,前提是一个文件的全路径比如__FILE__';echo '<br>';
echo dirname($url);echo '<br>';
echo dirname($fileName);echo '<br>';

echo 'pathinfo()返回的是一个数组,包含目录部分,文件名,以及扩展名';
$arr = pathinfo($url);echo '<br>';
echo '<pre>';
print_r($arr);echo '<br>';
$arr = pathinfo($fileName);echo '<br>';
echo '<pre>';
print_r($arr);echo '<br>';
echo '扩展名----'.$arr['extension'];echo '<br>';
echo '目录名----'.$arr['dirname'];echo '<br>';
echo '文件名包含扩展名----'.$arr['basename'];echo '<br>';
echo '文件名不含扩展名----'.$arr['filename'];echo '<br>';