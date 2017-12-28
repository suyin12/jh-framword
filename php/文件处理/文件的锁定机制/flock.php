<?php
$fileName = __DIR__.'/'.'data.txt';

$fp = fopen($fileName,'a') or die('文件打开失败!');
var_dump(flock($fp,LOCK_EX));
var_dump(flock($fp,LOCK_EX));
var_dump(flock($fp,LOCK_EX));
