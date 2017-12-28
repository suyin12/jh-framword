<?php
function dirDel($dir){
    //判断目录是否存在
    if(file_exists($dir)){
        if($handle = opendir($dir)){
            while($file = readdir($handle)){
                if($file != '.'&&$file != '..'){
                    if(is_dir($dir.'/'.$file))
                        dirDel($dir.'/'.$file);
                    if(is_file($dir.'/'.$file)){
                        unlink($dir.'/'.$file);
                    }
                }

            }

            closedir($handle);
            rmdir($dir);
        }
    }

}

$dir = 'A';
//echo $dir;
//mkdir($dir,0755);
//mkdir($dir,0755,true);
//dirDel($dir);
