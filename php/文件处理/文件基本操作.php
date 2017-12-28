<?php
//$handle = fopen(__DIR__.'/test.txt','r');
//$handle = fopen(__DIR__.'/test.txt','r+');
//$handle = fopen(__DIR__.'/test.txt','w');
$handle = fopen(__DIR__.'/test.txt','w+');
//$handle = fopen(__DIR__.'/test2.txt','x');
//$handle = fopen(__DIR__.'/test2.txt','x+');
//$handle = fopen(__DIR__.'/111.jpg','wb');
//$handle = fopen("http://baidu.com",'r');
//$handle = fopen("ftp://baidu.com/test.txt",'w');
fclose($handle);