<?php
/**
 *
 * User: suyin
 * Date: 2017/7/21 9:30
 *
 */

$expire = strtotime(date('Ymd'));//每天24点时间戳

//var_dump(date('Y-m-d H:i:s',$expire+ 86400));

//setcookie('IndependentIp','ip',$time);

//if(!isset($_COOKIE['IndependentIp'])){
//
    setcookie('IndependentIp','192.168.0.1',($expire+ 86400)-time());//一天一个访客的ip存入cookie
//}
//
//if(isset($_COOKIE['IndependentIp'])){
 //.....
//}

//var_dump(($expire+ 86400)-time());exit;
var_dump($_SERVER);

?>
