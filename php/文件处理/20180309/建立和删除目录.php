<?php
/**
 * Auth: sjh
 * Date: 2018/3/10 16:36
 */
$dir = __DIR__;
$testDir = $dir.'/A/B/C/D';
dirDel($testDir);
function dirDel($dir){
    if(file_exists($dir)){
        if(!is_dir($dir)){
            die('该文件不是目录');
        }
        $dir_handle = opendir($dir);
        while($file = readdir($dir_handle)){
            $file = $dir.DIRECTORY_SEPARATOR.$file;
            if($file != '.' && $file != '..'){
                if(is_dir($file)){
                    dirDel($file);
                }
                if(is_file($file)){
                    unlink($file);
                }
            }
        }
        closedir($dir_handle);

    }
    rmdir($dir);
}


//echo $dir.'/A/B/C/D';
//var_dump(mkdir($dir.'/A/B/C/D',0777,true));