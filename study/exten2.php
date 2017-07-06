<?php
/**
 *
 * User: suyin
 * Date: 2017/7/5 11:12
 *
 */
function getFlieType($file){
    $exten = substr(strchr($file,'.'),1);
    return $exten;
}
$testFile = "ddsfasfs.php";
echo getFlieType($testFile);