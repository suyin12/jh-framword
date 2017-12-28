<?php
//echo mktime();
//echo time();

//echo date('Y-m-d H:i:s',mktime(0,0,0,9,15,2012));echo '<br>';
//echo date('Y-m-d H:i:s',mktime(0,0,0,13,15,2012));echo '<br>';

$y = 1992;
$m = 12;
$d = 30;

$brithday = mktime(0,0,0,$m,$d,$y);
$now = time();
$ret = $now - $brithday;
echo floor($ret/(24*60*60*365));echo '<br>';
echo $ret;
echo '<pre>';
print_r(getdate());echo '<br>';

echo date('a-A-d-D-F-g-G-h-H-i-I-j-l-L-m-M-O-r-s-S-t-T-U-w-W-Y-z-Z');
