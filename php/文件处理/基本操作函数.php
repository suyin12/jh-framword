<?php
$fileName = __DIR__.'/data.txt';
$fileNew = __DIR__.'/data_副本.txt';
$fileRename = __DIR__.'/data重命名.txt';
//if(copy($fileName,$fileNew)){
//    echo '复制成功!';
//}else{
//    echo '复制失败!';
//}
//
//if(unlink($fileNew)){
//    echo '删除成功';
//}

//if(rename($fileRename,$fileName)){
//    echo '重命名成功!';
//}

$fp = fopen($fileName,'r+') or die('打开失败!');

if(ftruncate($fp,100)){
    echo '截断成功!';
}