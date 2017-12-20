/**
 * Created by suyin on 2017/11/24.
 */
function a(whichpic){
//        window.location.href = "http://baidu.com";
    var whichpic = whichpic.getAttribute("href");
    var a = document.getElementsByTagName('a');
    a.setAttribute('style','position:relative;left:20px;top:30px');
}