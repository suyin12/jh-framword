/**
 * Created by Administrator on 2017/7/12.
 */
function ajax(){
    var xmlHttpReq = null;
    if(window.ActiveXObject){
        xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }else if(window.XMLHttpRequest){
        xmlHttpReq = new XMLHttpRequest();
    }

    if(xmlHttpReq != null){
        xmlHttpReq.open("get","url",true);//true异步,false同步
        xmlHttpReq.send();
        xmlHttpReq.onreadystatechange = doRequest;//设置回调
    }

    function doRequest(){
        if(xmlHttpReq.status == 200 && xmlHttpReq.readyState == 4){
            alert(xmlHttpReq.responseText);
        }
    }
}
