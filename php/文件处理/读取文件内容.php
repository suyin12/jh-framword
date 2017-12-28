<?php
echo 'EOF是一种标准,来判断是否到达文件的末尾,在php中使用feof($handle)判断,指针是否位于文件末尾,如果是则返回true';echo '<br>';
$fileName1 = 'data.txt';
$handle1 = fopen(__DIR__.'/'.$fileName1,'r') or die('打开文件'.$fileName1.'失败!');
$contents1 = fread($handle1,100);
fclose($handle1);
echo $contents1;echo '<br>';echo '<br>';echo '<br>';


$fileName2 = '111.jpg';
$handle2 = fopen(__DIR__.'/'.$fileName2,'rb') or die('打开文件'.$fileName2.'失败!');
$contents2 = '';
while(!feof($handle2)){
    $contents2 .= fread($handle2,1024);
}
fclose($handle2);
//echo $contents2;echo '<br>';echo '<br>';echo '<br>';


$handle3 = fopen(__DIR__.'/'.$fileName1,'r') or die('打开文件'.$fileName1.'失败!');
$contents3 = fread($handle3,filesize(__DIR__.'/'.$fileName1));
fclose($handle3);
echo $contents3;echo '<br>';echo '<br>';echo '<br>';


echo 'file_get_contents()性能比上面的方式要快';echo '<br>';
echo file_get_contents(__DIR__.'/'.$fileName1);echo '<br>';
echo file_get_contents(__DIR__.'/'.$fileName2);
