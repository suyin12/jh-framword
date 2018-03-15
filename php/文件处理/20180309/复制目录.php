<?php
/**
 * Auth: sjh
 * Date: 2018/3/10 17:02
 */

function copyDir($fromDir,$toDir){
    if(!file_exists($fromDir) && !is_dir($fromDir)){
        die('原目录不存在或该文件不是目录');
    }
    if(!file_exists($$toDir)){
        mkdir($toDir,0777,true);
    }
    $fromDir_handle = opendir($fromDir);
    while($file = readdir($fromDir_handle)){
        if($file != '.' && $file != '..'){
            $fromFile = $fromDir.DIRECTORY_SEPARATOR.$file;
            $toFile = $toDir.DIRECTORY_SEPARATOR.$file;
            if(is_dir($fromDir)){
                copyDir($fromDir);
            }
            if(is_file($fromFile)){
                copy($fromFile,$toFile);
            }
        }

    }

    closedir($fromDir_handle);

}