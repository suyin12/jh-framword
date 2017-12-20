<?php
/**
 *
 * User: suyin
 * Date: 2017/7/5 11:12
 *
 */
function getFlieType(&$file){
    return end(explode('.',$file));
}
$testFile = "ddsfasfs.php";
echo getFlieType($testFile);