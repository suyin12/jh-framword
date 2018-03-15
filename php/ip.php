<?php
/**
 * Auth: sjh
 * Date: 2018/3/13 15:11
 */

//echo $_SERVER['REMOTE_ADDR'];
//echo getenv('REMOTE_ADDR');
//echo gethostbyname('www.csmall.com');
$name = '粟建晖';
$str = <<<ETO
"test \r\n$name
ETO;

var_dump($str);