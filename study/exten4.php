<?php
/**
 *
 * User: suyin
 * Date: 2017/7/5 11:12
 *
 */
function getFlieType($file){

    $exten = pathinfo($file);
    return $exten;
}
$testFile = "dsaf/ddsfasfs.php";
var_dump(getFlieType($testFile));