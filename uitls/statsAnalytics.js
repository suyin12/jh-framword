/**
 * Created by suyin on 2017/7/18.
 */
function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function() {
            oldonload();
            func();
        }
    }
}
u = navigator.userAgent;
np = navigator.platform;
var reg = {};
reg.ie = /MSIE [\d.]+;/gi;
reg.ff = /firefox\/[\d.]+/gi;
reg.chrome = /chrome\/[\d.]+/gi ;
reg.saf = /safari\/[\d.]+/gi ;
reg.sougou = /SE.[\d.\w]+/gi;
reg.qq = /QQBrowser\/[\d.]+/gi;
reg.uc = /U[\w]+\/[\d.]+/gi;
reg.op = /Op[\w]+\/[\d.]+/gi;
//是否pc端
var IsPc =  function(){
    var Agents = ["Android", "iPhone",
        "SymbianOS", "Windows Phone",
        "iPad", "iPod","iphone os",
        "rv:1.2.3.4","ucweb",
        "windows ce","windows mobile"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (u.toLowerCase().indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
};
//浏览器名称
function browserInfo()
{
//IE
        if(u.indexOf("MSIE") > 0)
        {//Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/7.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET4.0C; .NET4.0E)
            return "12";
        }
//firefox
        else if(u.indexOf("Firefox") > 0)
        {
            return u.match(reg.ff) ;
        }
//Safari
        else if(u.indexOf("Safari") > 0 && u.indexOf("Chrome") < 0)
        {
            return u.match(reg.saf) ;
        }
//搜狗
        else if(u.indexOf("SE") > 0  && u.indexOf("MetaSr") > 0)
        {
            return u.match(reg.sougou);
        }
//qq
        else if(u.indexOf("QQBrowser") > 0)
        {//Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.104 Safari/537.36 Core/1.53.3226.400 QQBrowser/9.6.11681.400
            return u.match(reg.qq) ;
        }
//uc
        else if(u.indexOf("UCWEB") > 0  || u.indexOf("UCBrowser") > 0 ||u.indexOf("UBrowser") > 0 )
        {
            return u.match(reg.uc);
        }
//欧朋
       else if(u.indexOf("OPR") > 0 || u.indexOf("OperaMini") > 0)
       {//Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 OPR/46.0.2597.46
            return u.match(reg.op);
       }
//Chrome
       else if(u.indexOf("Chrome") > 0)
       {//Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36
            return u.match(reg.chrome) ;
       }else{
            return "其他";
       }

}
//浏览器版本号
function browserVersion(){
    return (browserInfo()+"").replace(/[^0-9.X]/ig,"");
}
//屏幕分辨率
function screenResolution(){
    if(IsPc){//pc
        return window.screen.width + "*" + window.screen.height;
    }else{//移动设备
        var head =  document.getElementsByTagName("head")[0];
        var meta = document.createElement("meta");
        meta.setAttribute("name","viewport");//貌似要追加<meta name="" content="">,等测试过再说
        meta.setAttribute("content","width=device-width, initial-scale=1, maximum-scale=1");
        head.appendChild(meta);
        return document.documentElement.clientWidth + "*" + document.documentElement.clientHeight;
    }

}
//是否在微信端打开
function isWeiXin(){
    if(u.indexOf("MicroMessenger") > -1) {
        return true;
    } else {
        return false;
    }
};
//移动设备类型
function mobileType(){
    var sysType = "";
    if (u.indexOf("Android") > -1) {
        //安卓手机
        sysType = "安卓";
    } else if (u.indexOf("iPhone") > -1) {
        //苹果手机
        sysType = "苹果";
    } else if (u.indexOf("Windows Phone") > -1) {
        //winphone手机
        sysType = "winphone手机";
    }else if(u.indexOf("iPad") > -1){
        sysType = "iPad";
    }else {
        sysType = "其他";
    }
    return sysType;
}
//操作系统
function osType() {
    var isWin = (np == "Win32") || (np == "Windows");
    var isMac = (np == "Mac68K") || (np == "MacPPC") || (np == "Macintosh") || (np == "MacIntel");
    if (isMac)
        return "Mac";
    var isUnix = (np == "X11") && !isWin && !isMac;
    if (isUnix)
        return "Unix";
    var isLinux = (String(navigator.platform).indexOf("Linux") > -1);
    if (isLinux)
        return "Linux";
    if (isWin) {
        var isWin2K = u.indexOf("Windows NT 5.0") > -1 || u.indexOf("Windows 2000") > -1;
        if (isWin2K)
            return "Win2000";
        var isWinXP = u.indexOf("Windows NT 5.1") > -1 || u.indexOf("Windows XP") > -1;
        if (isWinXP)
            return "WinXP";
        var isWin2003 = u.indexOf("Windows NT 5.2") > -1 || u.indexOf("Windows 2003") > -1;
        if (isWin2003)
            return "Win2003";
        var isWinVista = u.indexOf("Windows NT 6.0") > -1 || u.indexOf("Windows Vista") > -1;
        if (isWinVista)
            return "WinVista";
        var isWin7 = u.indexOf("Windows NT 6.1") > -1 || u.indexOf("Windows 7") > -1;
        if (isWin7)
            return "Win7";
        var isWin8 = u.indexOf("Windows NT 6.2") > -1 || u.indexOf("Windows 8") > -1;
        if (isWin8)
            return "Win8";
        var isWin81 = u.indexOf("Windows NT 6.3") > -1 || u.indexOf("Windows 8.1") > -1;
        if (isWin81)
            return "Win8.1";
        var isWin10 = u.indexOf("Windows NT 10.0") > -1 || u.indexOf("Windows 10.0") > -1;
        if (isWin10)
            return "Win10";
    }
    return "其他";
}

//cookieID
function cookieID(){
    var cookieID,n=0,days=180,exp = new Date();
    exp.setTime(exp.getTime()+days*24*60*60*1000);
    if(String(document.cookie).indexOf("cookieID") < -1){
         cookieID = new Date().getTime();
        while(n<10){
            cookieID += String(Math.round(Math.random()*10));
            n++;
        }

        document.cookie="cookieID="+cookieID+";expires="+exp.toGMTString();
    }

    return ((String(document.cookie.match(/cookieID=[\d]{23}/gi))).split("="))[1];
}
//数据对象
function dataObject(){
    var info = {};
    info.screenResolution = screenResolution();
    info.sysType = mobileType();
    info.isWeiXin = isWeiXin();
    info.browserVersion = browserVersion();
    info.browserInfo = browserInfo();
    info.IsPc = IsPc();
    info.time =  Date.parse(new Date());
    info.osType = osType();
    info.cookieID = cookieID();
    info.debug = 1;

    return JSON.stringify(info);
}

var request = dataObject();
var xmlHttpReq = null;

function ajax(){
    if(window.ActiveXObject){
        var versions = ['Microsoft.XMLHTTP',
            'MSXML.XMLHTTP',
            'Msxml2.XMLHTTP.7.0',
            'Msxml2.XMLHTTP.6.0',
            'Msxml2.XMLHTTP.5.0',
            'Msxml2.XMLHTTP.4.0',
            'MSXML2.XMLHTTP.3.0',
            'MSXML2.XMLHTTP'];//各种IE浏览器创建Ajax对象时传递的参数
        for(var i=0; i<versions.length; i++){
            try{
                xmlHttpReq = new ActiveXObject(versions[i]);//各个IE浏览器版本的参数不同
                if(xmlHttpReq){
                    return xmlHttpReq;
                }
            }catch(e){
                xmlHttpReq = false;
            }
        }
        return xmlHttpReq;
    } else if(window.XMLHttpRequest){
        xmlHttpReq = new XMLHttpRequest();//实例化一个xmlHttpRequest
    }
    //如果实例化成功,就调用open()方法,就开始准备向服务器发送请求
    if(xmlHttpReq != null){
        xmlHttpReq.open("post","../uitls/statsClient.php",true);
        xmlHttpReq.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf8;");
        xmlHttpReq.send(request);
        xmlHttpReq.onreadystatechange = doResult;//设置回调函数
    }
}
function doResult(){
    if ((xmlHttpReq.readyState == 4) && (xmlHttpReq.status == 200)) {
        document.write(xmlHttpReq.responseText);
    }
}
addLoadEvent(ajax());



