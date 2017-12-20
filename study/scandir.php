<?php
/**
 * Date: 2017/11/8 11:13
 */

//$arr = scandir(__DIR__);
//echo __DIR__;echo "<br>";
//echo __FILE__;
//echo "<pre>";
//print_r($arr);
//exit;

function getScandir($dir){
    $arr = scandir($dir);
    $files = [];
    foreach($arr as $key => $value){
        if(($value != '.'&&$value != '..')&&is_dir($dir."/".$value)&&chmod($dir."/".$value,'0777')){
            $files[$value] = getScandir($dir."/".$value);
        }else{
            $files[] = $value;
        }
    }

    return $files;

}

$ret = getScandir(__DIR__);
echo "<pre>";
print_r($ret);
