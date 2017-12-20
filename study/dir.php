<?php
/**
 * Date: 2017/11/8 11:33
 */

//$dir = __DIR__;
//
//if($dh = opendir($dir)){
//    while(($file = readdir($dh)) != false){
//        echo 'filename------------'.$file.'<br>';
//    }
//    closedir($dh);
//}

//echo getcwd();echo "<br>";
//
//chdir("log");
//
//echo getcwd();echo "<br>";
//
//echo __DIR__;echo "<br>";
//echo __FILE__;echo "<br>";
//
//$extenion = explode('.',__FILE__);
////print_r($extenion);
//
//$exteninon2 = pathinfo(__FILE__);
//print_r($exteninon2);
//print_r($exteninon2['extension']);
//
//if(is_uploaded_file('log.txt')){
//    echo 'post 上传';
//}else{
//    echo '非 post 上传';
//}

$file = __DIR__;
//echo $file;exit;
function myScandir($dir){
    $files = scandir($dir);
    if($files != '..'&&$files != '.'){
        foreach($files as $val){
            if(is_dir($dir."/".$val)){
                $ret[$val] = myScandir($dir."/".$val);
            }else{
                $ret[] = $val;
            }
        }
    }

    return $ret;
}
myScandir($file);