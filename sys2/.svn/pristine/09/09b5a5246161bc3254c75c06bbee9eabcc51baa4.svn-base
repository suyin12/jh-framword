
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
<!--<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>-->
<script>
	$(function(){

//		$('iframe').load(function()
//			    {
//			        this.style.height =
//			        this.contentWindow.document.body.offsetHeight + 'px';
//			        alert('this.style.height');
//			    }
//			);
//					

//		$('iframe').each(function(i){
//			
//			var contentHeight=this.contentDocument?this.contentDocument.body.scrollHeight:this.Document.body.offsetHeight;
////			var contentHeight=$(this).height();
////			alert(contentHeight);
//			var contentHeight=contentHeight+50+'px';
//			$(this).css({width:'100%',height:contentHeight});
//			});
		
		 $(".accordion iframe").hide();
			$(".accordion h3").click(function(){
				$(this).next("iframe").slideToggle("slow")
				.siblings("iframe:visible").slideUp("slow");
				
				
				
				$(this).toggleClass("active");
				$(this).siblings("h3").removeClass("active");
			});
			
			 $(".accordion h3").each(function(i){
				 var a=0;
				 if($("iframe").eq(i).contents().find('.count').text())
					 a=$("iframe").eq(i).contents().find('.count').text();
				 else
					 a=0;
				 $(".accordion h3").eq(i).append(
						 "<span style='color:red'>(共"+a+"条)</span>");
				 });
			

			 	});
</script>
<div id="mainBody">
<?php 
if($_GET['display']=='all')
{
?>
<!--
<div class="accordion">

<p>一.正常在册名单与已审核表的核对结果:</p>
<h3>不确定人员</h3>
<iframe src="body.php?type=5_5" frameboder=0 width=100%  height='300px' scrolling="auto"></iframe>
<h3>核对正确的人员信息</h3>
<iframe src="body.php?type=5_1" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>
<h3>错误信息提示</h3>
<iframe  src="body.php?type=5_6" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>
</div>
-->
<div class="accordion">
<p>二.申报表与已审核表的核对结果:</p>
<h3>不确定人员</h3>
<iframe src="body.php?type=6_5" width=100% height='300px' frameboder=0 ></iframe>
<h3>核对正确的人员信息</h3>
<iframe src="body.php?type=6_1" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>
<h3>错误信息提示</h3>
<iframe  src="body.php?type=6_6" width=100% height='300px' frameboder=0 ></iframe>
</div>
<?php 
}
if($_GET['display']=='general')
{
?>
<div class="accordion">
<p>一.正常在册名单与已审核表的核对结果:</p>
<h3>不确定人员</h3>
<iframe src="body.php?type=1_5" frameboder=0 width=100%  height='300px' scrolling="auto"></iframe>
<h3>核对正确的人员信息</h3>
<iframe src="body.php?type=5_1" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>
<h3>错误信息提示</h3>
<iframe  src="body.php?type=1_6" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>
</div>

<div class="accordion">
<p>二.申报表与已审核表的核对结果:</p>
<h3>不确定人员</h3>
<iframe src="body.php?type=2_5" width=100% frameboder=0 height='300px' ></iframe>
<h3>核对正确的人员信息</h3>
<iframe src="body.php?type=1_1" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>
<h3>错误信息提示</h3>
<iframe  src="body.php?type=2_6" width=100% height='300px' frameboder=0 ></iframe>
</div>
<?php 
}
?>
</div>



</body>
