<?php
/**
 *
 * User: suyin
 * Date: 2017/7/10 15:28
 *
 */
#获取文件扩展名
function getFileExtension($filepath){
    return pathinfo($filepath,PATHINFO_EXTENSION);
}
#获取真实ip地址,即使是代理服务器
function getRealIpAddr()
{
    if (!empty($_SERVER ['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER ['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER ['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
        $ip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER ['REMOTE_ADDR'];
    }
    return $ip;
}
#返回当前时间年份,时间格式为时间戳:2016-9-19
function getYear($time="",$type=""){
    if($time==""){
        $time = time();
    }
    if($type==1){
        return $year = date("y",$time);//返回格式16
    }else{
        return $year = date("Y",$time);//返回格式2016
    }
}
#返回当前时间月份,时间格式为时间戳:2016-9-19
function getMonth($time="",$type=""){
    if($time==""){
        $time = time();
    }
    switch($type){
        case 1:
            $month = date("n",$time);//返回格式9
            break;
        case 2:
            $month = date("m",$time);//返回格式09
            break;
        case 3:
            $month = date("M",$time);//返回格式Sep
            break;
        case 4:
            $month = date("M",$time);//返回格式Septempber
            break;
        default:
            $month = date("n",$time);
    }
    return $month;
}
#返回当前时间天数,时间格式为时间戳:2016-9-19
function getDay($time="",$type=""){
    if($time==""){
        $time = time();
    }
    if($type==1){
        $day = date("d",$time);//返回格式19
    }else{
        $day = date("j",$time);//返回格式19
    }
    return $day;
}
#返回当前时间小时,时间格式为时间戳:2016-9-19 16:57:00 1:20:00
function getHour($time="",$type=""){
    if($time==""){
        $time = time();
    }
    switch($type){
        case 1:
            $hour = date("H",$time);//返回格式16 1
            break;
        case 2:
            $hour = date("h",$time);//返回格式04 01
            break;
        case 3:
            $hour = date("G",$time);//返回格式16 1
            break;
        case 4:
            $hour = date("g",$time);//返回格式4 1
            break;
        default:
            $hour = date("H",$time);
    }
    return $hour;
}
#返回当前时间分钟数,时间格式为时间戳:2016-9-19 16:57:00
function getMinute($time=""){
    if($time==""){
        $time = time();
    }
    $minute = date("i",$time);//返回格式57
    return $minute;
}
#返回当前时间秒数,时间格式为时间戳:2016-9-19 16:57:01
function getSecond($time=""){
    if($time==""){
        $time = time();
    }
    $second = date("s",$time);//返回格式01
    return $second;
}
#比较两个时间的大小,时间格式为时间戳:2016-9-19 16:57:01
function compare($time1,$time2){
    $time1=strtotime($time1);
    $time2=strtotime($time2);
    if($time1>$time2){
        return 1;
    }else{
        return -1;
    }
}
#比较两个时间的差值
function diffdate($time1="",$time2=""){
    if($time1==""){
        $time1 = date("Y-m-d H:i:s",time());
    }
    if($time2==""){
        $time1 = date("Y-m-d H:i:s",time());
    }
    $date1 = strtotime($time1);
    $date2 = strtotime($time2);

    if($date1>=$date2){
        $diffDate = $date1-$date2;
    }else{
        $diffDate = $date2-$date1;
    }
    $day = floor(($diffDate%86400));
    $hour = floor((($diffDate%86400)%3600));
    $minute = floor(($diffDate%3600)%60);
    $second = floor($diffDate%60);

    return "相差".$day."天".$hour."小时".$minute."分".$second."秒";
}
#返回某年某月某日
function buildDate($time="",$type=""){
    if($type==1){
        $longDate = getYear($time)."年".getMonth($time)."月".getDay($time)."日";
    }else{
        $longDate = getYear($time)."年".getMonth($time)."月".getDay($time)."日".getHour()."时".getMinute($time)."分";
    }
    return $longDate;
}
#返回中文大写日期
function changDate($time=""){
    if($time==""){
        $time = date("Ymd",time());
    }else{
        $time = date("Ymd",strtotime($time));
    }
    for($i=0;$i<strlen($time);$i++){
        $timeArr[] = substr($time,$i,1);
    }
    $numArr = array('零','一','贰','叁','肆','伍','陆','柒','捌','玖');
    foreach($timeArr as $key => $value){
        foreach($numArr as $k => $v){
            if($value==$k){
                $comArr[] = $v;
            }
        }
    }
    $comArr = implode("",$comArr);
    $comArr = substr_replace($comArr,"年",12,0);
    $comArr = substr_replace($comArr,"月",21,0);
    $comArr = substr_replace($comArr,"日",30,0);
    return $comArr;
}
#防止sql注入
function injectChk($sql_str) {
    $check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
    if ($check) {
        echo('非法字符串');
        exit();
    } else {
        return $sql_str;
    }
}
#php加密解密
function encryptDecrypt($key, $string, $decrypt){
    if($decrypt){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12");
        return $decrypted;
    }else{
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }
}
#获取当前页面URL
function curPageURL() {
    $pageURL = 'http';
    if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}