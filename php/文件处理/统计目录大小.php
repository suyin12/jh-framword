<?php
echo 'filesize()可以统计文件大小';echo '<br>';
echo 'disk_free_space()和disk_total_space()统计磁盘大小';echo '<br>';
echo disk_free_space('d:');echo '<br>';
echo disk_total_space('D:');echo '<br>';

function dirSize($dir){
    if(is_dir($dir)){
        $d = dir($dir);
    }
    $size = 0;
    while($file = $d->read()){
        if($file != '.' && $file != '..'){
            if(is_dir($dir.'/'.$file)){
                $size += dirSize($dir.'/'.$file);
            }
            if(is_file($dir.'/'.$file)){
                $size += filesize($dir.'/'.$file);
            }
        }

    }
//    closedir($d);
    return $size;
}

$dir = __DIR__;

$ret = dirSize($dir);
echo $dir.'----目录大小为----'.$ret;