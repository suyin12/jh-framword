<?php
$file = 'log.txt';
//fopen($file,'w+');

//var_dump(mkdir($file));

//var_dump(touch($file));//touch()不能创建文件夹
//返回路径中文件名部分,第一个必须参数为路径,第二个参数指定文件扩展名
//echo basename($file,'.txt');

//var_dump(chgrp($file,'admin'));
//
//var_dump(chmod($file,'0755'));
//
//var_dump(chown($file,'charles'));

//echo filesize($file);

//clearstatcache();

//echo filesize($file);
//
//var_dump(copy($file,'newLog.txt'));
//
//echo dirname($file);

//echo disk_free_space("C:");
//echo disk_free_space(__DIR__);echo "<br>";
//
//echo disk_total_space(__DIR__);
//echo "------------------<br>";
//var_dump(touch($file));
//$context = fopen($file,'r');
//
//echo fgetc($context);
//echo fgets($context);
//$file2 = 'scandir1.php';
//$context2 = fopen($file,'r');

//echo fgetss($context2);

//print_r(file($file));

//fclose($context);
//echo $context;

//feof();
//echo __DIR__;
//var_dump(unlink($file));

//var_dump(file_exists($file));

//var_dump(file_get_contents($file));
//clearstatcache();
//echo filegroup($file);

//echo filesize($file);

//$context = fopen($file,'r');

//echo fwrite($context,"abcdefghijklmn");
//echo filesize($file);
//echo fread($context,filesize($file));
//
//$file3 = 'e.exe';


//if(is_file($file3)){
//    echo "可执行文件";
//}else{
//    echo "非可执行文件";
//}
$file4 = 'log2.txt';

//print_r(pathinfo($file4));

echo rename($file4,'log.txt');