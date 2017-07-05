<?php
/**
 *
 * User: suyin
 * Date: 2017/7/5 11:12
 *
 */
function getFileType($file){
   $exten =  substr($file,strrpos($file,".")+1);
    return $exten;
}
$testFile = "ddsfasfs.php";
echo getFileType($testFile);