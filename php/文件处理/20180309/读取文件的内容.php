<?php
/**
 * Auth: sjh
 * Date: 2018/3/12 10:11
 */
$file = __DIR__.'/data.txt';
$handle = fopen($file,'r+') or die($file.'文件打开失败');
$contents = fread($handle,filesize($file));
fclose($handle);
//echo str_replace("\r\n",'',$contents);echo '<br>';
//echo file_get_contents($file);


$resource = __DIR__.'/zhishu.jpg';
$handle = fopen($resource,'rb') or die('文件打开失败!');
$contents = '';
while(!feof($handle)){
    $contents .= fread($handle,'1000');
}
fclose($handle);
//header("content-type:image/png");
//echo $contents;
//echo file_get_contents($file);

//$file = __DIR__.'/data.txt';
//$handle = fopen($file,'r+') or die($file.'文件打开失败');
//while(false !== ($char = fgetc($handle))){
//    echo $char."<br>";
//}

$file = __DIR__.'/data.txt';
//echo '<pre>';
//print_r(file($file));
echo '立即输出到缓存区,不需要fopen(),也不需要echo'."<br>";
readfile($file);

