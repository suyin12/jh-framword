<?php
/**
 * Auth: sjh
 * Date: 2018/3/12 9:50
 */

$file = __DIR__.'/data.txt';

$file_handle = fopen($file,'a');
$n = 0;
while($n < 10){
    fputs($file_handle,'第'.$n."行\r\n");//fputs是fwrite函数的别名
    $n++;
}
fputs($file_handle,'写入结束!');
fclose($file_handle);

$file = __DIR__.'/data2.txt';

$data = "总共10行数据:\r\n";
$m = 0;
while($m<10){
    $data .= '第'.$m."行测试数据\r\n";
    $m++;
}
file_put_contents($file,$data);
