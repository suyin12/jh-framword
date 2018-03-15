<?php
/**
 * Date: 2018/1/17 10:54
 */
$str = '1234567890';

$pattern = "/(\d{3})(\d{3})(\d{4})/";

echo preg_replace($pattern,"\${1}-\${2}-\${3}",$str);