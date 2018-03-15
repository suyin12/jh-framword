/**
 * Created by suyin on 2018/2/1.
 */
function countBodyChildren(){
    var body_element = document.getElementsByTagName('body')[0];
    // alert(body_element.childNodes.length);
    var p = document.getElementById('one');
    // alert(p.childNodes[0].nodeValue);
    // alert(p.firstChild.nodeValue);
    setTimeout('func()',5000);
}
function func(){
    alert(11111111);
}
window.onload = countBodyChildren;