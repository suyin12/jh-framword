/**
 * Created by Administrator on 2017/7/11.
 */
var xmlHttpReq = null;
function ajax(param){
    if(window.ActiveXObject){
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }else if(window.XMLHttpRequest){
        xmlHttpReq = new XMLHttpRequest();//实例化一个xmlHttpRequest
    }
    //如果实例化成功,就调用open()方法,就开始准备向服务器发送请求
    if(xmlHttpReq != null){
        xmlHttpReq.open("get","./admin/login.php?"+param,true);
        xmlHttpReq.send();
        xmlHttpReq.onreadystatechange = doResult;//设置回调函数
    }
}
function doResult(){
    if ((xmlHttpReq.readyState == 4) && (xmlHttpReq.status == 200)) {
        document.write(xmlHttpReq.responseText);
    }
}
