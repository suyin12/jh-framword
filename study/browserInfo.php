<?php
/**
 *
 * User: suyin
 * Date: 2017/8/5 11:10
 *
 */

$u =  strtolower($_SERVER["HTTP_USER_AGENT"]);
//是否pc端
function IsPc(){
    global $u;
    $Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod","iphone os",
        "rv:1.2.3.4","ucweb",
        "windows ce","windows mobile"];
    $flag = true;
    for ($v = 0; $v < count($Agents); $v++) {
        if (stripos($u,$Agents[$v])) {
            $flag = false;
            break;
        }
    }
    return $flag;
};
//浏览器名称
function browserInfo()
{
    global $u;
    $ie = "/MSIE [\d.]+;/i";
    $ff = "/firefox\/[\d.]+/i";
    $chrome = "/chrome\/[\d.]+/i" ;
    $saf = "/safari\/[\d.]+/i" ;
    $sougou = "/SE.[\d.\w]+/i";
    $qq = "/QQBrowser\/[\d.]+/i";
    $uc = "/U[\w]+\/[\d.]+/i";
    $op = "/Op[\w]+\/[\d.]+/i";
//IE
    if(stripos($u,"MSIE"))
    {//Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/7.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET4.0C; .NET4.0E)
        preg_match_all($ie,$u,$arr);
        $arr[1] = "IE浏览器";
        return $arr;
    }
//firefox
    else if(stripos($u,"Firefox"))
    {
        preg_match_all($ff,$u,$arr);
        $arr[1] = "火狐浏览器";
        return $arr;
    }
//Safari
    else if(stripos($u,"Safari") && !stripos($u,"Chrome"))
    {
        preg_match_all($saf,$u,$arr);
        $arr[1] = "Safari浏览器";
        return $arr;
    }
//搜狗
    else if(stripos($u,"SE")  && stripos($u,"MetaSr") )
    {
        preg_match_all($sougou,$u,$arr);
        $arr[1] = "搜狗浏览器";
        return $arr;
    }
//qq
    else if(stripos($u,"QQBrowser"))
    {//Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.3226.400 QQBrowser/9.6.11681.400
        preg_match_all($qq,$u,$arr);
        $arr[1] = "QQ浏览器";
        return $arr;
    }
//uc
    else if(stripos($u,"UCWEB") || stripos($u,"UCBrowser") ||stripos($u,"UBrowser") )
    {
        preg_match_all($uc,$u,$arr);
        $arr[1] = "UC浏览器";
        return $arr;
    }
//欧朋
    else if(stripos($u,"OPR") || stripos($u,"OperaMini") )
    {//Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 OPR/46.0.2597.46
        preg_match_all($op,$u,$arr);
        $arr[1] = "欧朋浏览器";
        return $arr;
    }
//Chrome
    else if(stripos($u,"Chrome"))
    {//Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36
        preg_match_all($chrome,$u,$arr);
        $arr[1] = "谷歌浏览器";
        return $arr;
    }else{
        return "其他";
    }

}
//浏览器版本号
function browserVersion(){
    $sub = browserInfo();
    return preg_replace("/[^0-9.X]/i"," ",$sub[0]);
}
//屏幕分辨率

//是否在微信端打开
function isWeiXin(){
    global $u;
    if(stripos($u,"MicroMessenger")) {
        return true;
    } else {
        return false;
    }
};
//移动设备类型
function mobileType(){
    global $u;
    if (stripos($u,"Android")) {
        //安卓手机
        $sysType = "安卓";
    } else if (stripos($u,"iPhone")) {
        //苹果手机
        $sysType = "苹果";
    } else if (stripos($u,"Windows Phone")) {
        //winphone手机
        $sysType = "winphone手机";
    }else if(stripos($u,"iPad")){
        $sysType = "iPad";
    }else {
        $sysType = "其他";
    }
    return $sysType;
}
//操作系统
function getOS(){
    $os='';
    global $u;
    if (preg_match('/win/i',$u)&&strpos($u, '95')){
        $os='Windows 95';
    }elseif(preg_match('/win 9x/i',$u)&&strpos($u, '4.90')){
        $os='Windows ME';
    }elseif(preg_match('/win/i',$u)&&preg_match('/98/i',$u)){
        $os='Windows 98';
    }elseif(preg_match('/win/i',$u)&&preg_match('/nt 5.0/i',$u)){
        $os='Windows 2000';
    }elseif(preg_match('/win/i',$u)&&preg_match('/nt 6.0/i',$u)){
        $os='Windows Vista';
    }elseif(preg_match('/win/i',$u)&&preg_match('/nt 6.1/i',$u)){
        $os='Windows 7';
    }elseif(preg_match('/win/i',$u)&&preg_match('/nt 5.1/i',$u)){
        $os='Windows XP';
    }elseif(preg_match('/win/i',$u)&&preg_match('/nt/i',$u)){
        $os='Windows NT';
    }elseif(preg_match('/win/i',$u)&&preg_match('/32/i',$u)){
        $os='Windows 32';
    }elseif(preg_match('/linux/i',$u)){
        $os='Linux';
    }elseif(preg_match('/unix/i',$u)){
        $os='Unix';
    }else if(preg_match('/sun/i',$u)&&preg_match('/os/i',$u)){
        $os='SunOS';
    }elseif(preg_match('/ibm/i',$u)&&preg_match('/os/i',$u)){
        $os='IBM OS/2';
    }elseif(preg_match('/Mac/i',$u)&&preg_match('/PC/i',$u)){
        $os='Macintosh';
    }elseif(preg_match('/PowerPC/i',$u)){
        $os='PowerPC';
    }elseif(preg_match('/AIX/i',$u)){
        $os='AIX';
    }elseif(preg_match('/HPUX/i',$u)){
        $os='HPUX';
    }elseif(preg_match('/NetBSD/i',$u)){
        $os='NetBSD';
    }elseif(preg_match('/BSD/i',$u)){
        $os='BSD';
    }elseif(preg_match('/OSF1/i',$u)){
        $os='OSF1';
    }elseif(preg_match('/IRIX/i',$u)){
        $os='IRIX';
    }elseif(preg_match('/FreeBSD/i',$u)){
        $os='FreeBSD';
    }elseif($os==''){
        $os='Unknown';
    }
    return $os;
}

//数据对象
function dataObject(){
    $info = [];
    $info['sysType']= mobileType();
    $info['isWeiXin'] = isWeiXin();
    $info['browserVersion'] = ltrim(browserVersion()[0]);
    $info['browserInfo'] = browserInfo()[1];
    $info['IsPc'] = IsPc();
    $info['time'] =  time();
    $info['osType'] = getOS();
    $info['debug'] = 1;
//echo "<pre>";
//    var_dump($info);
}

var_dump($u);exit;

dataObject();






