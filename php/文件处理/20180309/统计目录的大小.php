<?php
/**
 * Auth: sjh
 * Date: 2018/3/10 16:24
 */
$dir = __DIR__;
function dirSize($dir){
    if(!is_dir($dir)){
        die('该文件不是目录');
    }

    $dirSize = 0;
    $dir_handle = opendir($dir);

    while($file = readdir($dir_handle)){
        if($file != '.' && $file != '..'){
            $file = $dir.DIRECTORY_SEPARATOR.$file;
            if(is_dir($file)){
                $dirSize += dirSize($file);
            }elseif(is_file($file)){
                $dirSize += filesize($file);
            }
        }
    }
    closedir($dir_handle);

    return $dirSize;
}
echo round(dirSize($dir)/pow(1024,1),2).'KB';
