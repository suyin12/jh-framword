<?php
set_time_limit(0);
$file = fopen("https://www.csmall.com/",'r') or die('打开失败');

while(!feof($file)){
    $contents = fgets($file);
    if(preg_match('/<title>(.*)<\/title>/',$contents,$out)){
        $title = $out[1];
        break;
    }
}
fclose($file);
echo $title;echo '<br>';


$file2 = fopen("ftp://user:password@ftp.lampbrother.net/path/to/file",'w');
$str = 'php';
fwrite($file2,$str);
fclose($file2);







