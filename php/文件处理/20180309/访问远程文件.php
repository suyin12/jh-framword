<?php
/**
 * Auth: sjh
 * Date: 2018/3/12 11:30
 */

$file = fopen("http://www.itxdl.cn//","r") or die("打开远程文件失败!");

while(!feof($file)){
    $line = fgets($file,1024);
    if(preg_match("/<title>(.*)<\/title>/",$line,$out)){
        $title = $out;
        break;
    }
}
fclose($file);
print_r($title);