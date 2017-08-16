<?php
/**
 *
 * User: suyin
 * Date: 2017/7/10 17:02
 *
 */
session_start();
$counter = intval(file_get_contents("../counter.dat"));
if(!$_SESSION['#']){
    $_SESSION['#'] = true;
    $counter++;
    $fp = fopen('counter.dat','w');
    fwrite($fp,$counter);
    fclose($fp);
}
echo $counter;