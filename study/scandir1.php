<?php
/**
 *
 * User: suyin
 * Date: 2017/7/4 15:06
 *
 */


function my_scandir($dir){
    $files = array();
    $file = scandir($dir);
    foreach($file as $key => $val){
        if($val != '..' && $val != '.'){
            if(is_dir($dir."/".$val) && chmod($dir."/".$val,0777)){
                $files[$val] = my_scandir($dir."/".$val);
            }else{
                $files[] = $val;
//                chmod($val,0777);

            }
        }
    }
    return $files;

}
echo "<pre>";
var_dump(my_scandir('../../piwik'));