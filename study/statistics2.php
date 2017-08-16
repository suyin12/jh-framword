<?php
/**
 *
 * User: suyin
 * Date: 2017/7/10 11:17
 *
 */

//$data = file_get_contents("php://input");
//echo "<pre>";
//var_dump(json_decode($data,true));
echo $_SERVER['HTTP_REFERER'];echo"<br />";
echo "<pre>";
var_dump($_SERVER);
