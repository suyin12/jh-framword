// JavaScript Document

function prqq() 
{ 
var L=document.getElementById("lefttree"); // 变量：L代表 id="lefttree" 的标记 
var R=document.getElementById("mainBody"); // 变量：R代表 id="mainBody" 的标记
var C=document.getElementById("centertree");//变量：C代表 id="centertree"的标记
if (L.className=="left") // 判断：如果 id="left" 的class值 等于left的话，将执行下面{}里面的内容 
    { 
        L.className="left1"; // 给 id="lefttree" 的标记 加上class：left1 
        R.className="right1"; // id="mainBody" 的标记 加上class：right1 
		C.className="lrnone1" //给id="centertree"的标记加上class:lrnone1
    } 
else // 判断：如果 id="left" 的class值 不等于left的话，将执行下面{}里面的内容 
    { 
        L.className="left"; // 给 id="lefttree" 的标记 加上class：left 
        R.className="right"; // 给 id="mainBody" 的标记 加上class：right
		C.className="lrnone" //给id="centertree"的标记加上class:lrnone
    } 
} 
