<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/*
新增/调入 :  1
停交:  0
其他修改:  2
* */
require_once '../header/societyHeader.php';
if(!defined('ALLOW'))exit();
require_once '../settings.inc';;
?>
<body>
<div id="mainBody">
<!--<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="../js/jqModal.js"></script>
<script type="text/javascript" src="../js/jqModal.litejva8.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.litejava8.css" />
<script type="text/javascript">
$(document).ready(function(){
$('#display a').each(

		function(i){
	$('#display a').eq(i).click(function(){
//	$('#display iframe').remove();
	var actionUrl=$(this).next(0).attr('id')+".php?display=all";
	$("#displayFrame").attr("src",actionUrl);
//	var sHeight=$(this).next(0).append('<iframe class="cp" src='+actionUrl+' frameborder="0" scrolling="yes"></iframe>');
//	alert(sHeight);

	$("#displayFrame").each(function(i){
		var contentHeight=this.contentDocument?this.contentDocument.body.scrollHeight:this.Document.body.offsetHeight;
//		alert(contentHeight);
		$(this).css({width:'100%',height:contentHeight+100+"px",display:'block'});
		});
	
	   });
	   }
);


$('.sub').click(function(){ 
	
	var type='post';
    var url='sqlTable.php';
    var data=$(this).attr("name")+"=1";
    subPost(type,url,data);
    var name=$(this).attr("name");
    
    if(name!='clear_small'){
    $(this).css({display:'none'});
    $('.disSub').css({display:'inline-block'});
    }
    
   });

function subPost(t,u,d)
{
$.ajax({
	   type:t,
	   url: u,
	   data: d,
	   datatype:'html',
	   success:function(html){
         $('#output').html(html);
         
	   }
	    });
}


$('.disSub').click(function(){

$('.sub').css({display:"inline-block"});
	
}
);

});



</script>
<div>
<form id='clearForm' >
<div class="btnList">
<ul>
<li>
<a class='disSub' href="#" style="display:none"><img src="../css/images/OA/so_di_1.gif" /></a>
</li>
<li>
<a name="clear" class='sub' href="#"><img src="../css/images/OA/so_ch_5.gif" /></a>
</li>

</ul>
</div>

<!--<div class='clear_small'>-->
<!--<a name="clear_small" class='sub' href="#">清空操作数据,无需再次导入数据表</a>-->
<!--</div>-->


<div id="insert">
<!--<ul>-->
<!--<li>-->
<!--<a class="thickbox" title="导入正常在册人员名单" href="../Parser/societyManage/xls2mysql/index.php/?table=society1tmp&width=100%&amp;height=80%">-->
<!--①:导入正常在册人员名</a>-->
<!--</li>-->
<!--</ul>-->
<ul>
<li>
<a class="thickbox" title="导入未转换的申报表" href="../Parser/societyManage/xls2mysql/index.php/?table=soConvertSBB&width=100%&amp;height=80%">
导入未转换的申报表</a>
</li>
</ul>
<ul>
<li>
<a class="thickbox" title="导入已审核表" href="../Parser/societyManage/xls2mysql/index.php/?table=society3tmp&width=100%&amp;height=80%">
导入已审核表</a>
</li>
</ul>
</div>

<div class="btnList">
<ul>
<li>
<a class='sub' name="intoSo2" href="#"><img src="../css/images/OA/so_ch_0.gif" /></a>
</li>
<li>
<a name="convert" class='sub' href="#"><img src="../css/images/OA/so_ch_1.gif" /></a>
</li>
<li>
<a name="insert" class='sub' href="#"><img src="../css/images/OA/so_ch_2.gif" /></a>
</li>
</ul>
</div>

<div id="output"></div>

<div style="" id="modalWindow" class="jqmWindow jqmID1">
        <div id="jqmTitle">
            <button class="jqmClose">
                                    关闭 X
            </button>
            <span id="jqmTitleText"></span>
        </div>
        <iframe id="jqmContent" src=""></iframe>
    </div>
 </form>   
 </div>
   
    <div id="display">
    <br></br>
    <ul>
    <a href="#" id="cpSub"><img src="../css/images/OA/so_re_1.gif" /> </a>
    <div id="checkPerson">
    </div>
    </ul>
    <ul>
     <a href="#" ><img src="../css/images/OA/so_re_2.gif" />  </a>
    <div id="checkRisk">
    </div>
    </ul>
     <iframe id="displayFrame"  class="cp" frameborder="0" scrolling="auto" style="display:none"></iframe>
    </div>
  </div>  
</body>

</div>
</body>
</html>