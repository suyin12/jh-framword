
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
<script>
	$(function(){

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
<div>
<?php 

if($_GET['display']=='all')
{
?>
<!--<div class="accordion">-->
<!---->
<!--<p>一.正常在册名单与已审核表的核对结果:</p>-->
<!--<h3>不确定人员</h3>-->
<!--<iframe src="body.php?type=1_5" frameboder=0 width=100%  height='300px' scrolling="auto"></iframe>-->
<!--<h3>新增人员</h3>-->
<!--<iframe src="body.php?type=1_1" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>-->
<!--<h3>停保人员</h3>-->
<!--<iframe src="body.php?type=1_0" frameboder=0 width=100% height='300px'  scrolling="auto"></iframe>-->
<!--<h3>其他修改</h3>-->
<!--<iframe src="body.php?type=1_2" frameboder=0 width=100% height='300px' class="autoHeight" scrolling="auto" ></iframe>-->
<!--<h3>错误信息提示</h3>-->
<!--<iframe  src="body.php?type=1_6" frameboder=0 width=100%  height='300px' scrolling="auto"></iframe>-->
<!--</div>-->

<div class="accordion">
<p>二.申报表与已审核表的核对结果:</p>
<h3>不确定人员</h3>
<iframe src="body.php?type=2_5" width=100% height='300px'  frameboder=0  ></iframe>
<h3>新增人员</h3>
<iframe src="body.php?type=2_1" width=100% height='300px' frameboder=0 ></iframe>
<h3>停保人员</h3>
<iframe src="body.php?type=2_0" width=100% height='300px' frameboder=0 ></iframe>
<h3>其他修改</h3>
<iframe src="body.php?type=2_2" width=100% height='300px' frameboder=0 ></iframe>
<h3>错误信息提示</h3>
<iframe  src="body.php?type=2_6" width=100% height='300px' frameboder=0 ></iframe>
</div>
</div>


<!--<div class="accordion">-->
<!--<p>三.申报表与正常在册名单的核对结果:</p>-->
<!--<h3>不确定人员</h3>-->
<!--<iframe src="body.php?type=3_5"  width=100% height='300px' frameboder=0 ></iframe>-->
<!--<h3>新增人员</h3>-->
<!--<iframe src="body.php?type=3_1" width=100% height='300px' frameboder=0 ></iframe>-->
<!--<h3>停保人员</h3>-->
<!--<iframe src="body.php?type=3_0"  width=100% height='300px' frameboder=0 ></iframe>-->
<!--<h3>其他修改</h3>-->
<!--<iframe src="body.php?type=3_2" width=100% height='300px' frameboder=0 ></iframe>-->
<!--<h3>错误信息提示</h3>-->
<!--<iframe src="body.php?type=3_6" width=100% height='300px' frameboder=0  ></iframe>-->
<!--</div>-->
<?php 
}

if($_GET['display']=='general')
{
?>
<div class="accordion">
<p>三.当月在册名单与上月正常在册名单的核对结果:</p>
<h3>在申报表中出现多条信息的人员名单</h3>
<iframe src="body.php?type=4_5"  width=100% height='300px' frameboder=0 ></iframe>
<h3>新增人员</h3>
<iframe src="body.php?type=4_1" width=100% height='300px' frameboder=0 ></iframe>
<h3>停保人员</h3>
<iframe src="body.php?type=4_0"  width=100% height='300px' frameboder=0 ></iframe>
<h3>其他修改</h3>
<iframe src="body.php?type=4_2" width=100% height='300px' frameboder=0 ></iframe>
<h3>错误信息提示</h3>
<iframe src="body.php?type=4_6" width=100% height='300px' frameboder=0  ></iframe>
</div>
<?php 
}
?>
</div>
</div>
</body>
