<?php
$pre = '/[a-zA-Z]+:\/\/[^\s]*/';

$str = "https://www.baidu.com";

$str2 = "https://www.baidu.com/s?wd=preg_match%20php&rsv_spt=1&rsv_iqid=0xc4be806b000007a7&issp=1&f=3&rsv_bp=0&rsv_idx=2&ie=utf-8&tn=baiduhome_pg&rsv_enter=1&rsv_sug3=3&rsv_sug1=1&rsv_sug7=100&rsv_t=8e1d7B8dnJtZr9bmt95gkeCM0Mv0K18uq%2By0AXw9hqM%2B19qjQqfh0hlD5hYjXZw9vu7D&rsv_sug2=1&prefixsug=preg_match&rsp=0&inputT=2881&rsv_sug4=158394";

$ret1 = preg_match_all($pre,$str2,$ret);

$str3 = "/+-/";
$pre3 = "/.*/";
$ret2 = preg_match_all($pre3,$str3,$ret);


var_dump($ret1);