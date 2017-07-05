<?php
/**
 *
 * User: suyin
 * Date: 2017/7/5 11:12
 *
 */
function getFlieType($file){


    return $exten = pathinfo($file,PATHINFO_EXTENSION);
}
$testFile = "dsaf/ddsfasfs.php";
var_dump(getFlieType($testFile));