<?php
require_once '../settings.inc';
$manager=$_SESSION['exp_user']['mID'];
$month=$_POST['month'];
?>
<body>
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
				 if($("iframe").eq(i).contents().find('#count').val())
				 {
					 a=$("iframe").eq(i).contents().find('#count').val();
				 }
				 else
				 {
					 a=0;
				 }
//				 $(".accordion h3").eq(i).append("<span style='color:red'>(共"+a+"条)</span>");
				 });
			

			 	});
</script>
<?php if($_POST['fromUrl']=="bal"){?>
<div class="accordion">

<p>工资/社保缴交费用明细核对错误结果:</p>
<h3>缺少工资费用明细人员名单(未缴交社保,但有公积金费用):</h3>
<iframe src="balBody.php?type=1_4&manager=<?php echo $manager?>&table=so_bal_6&month=<?php echo $month;?>" frameboder=0 width=100% height='400px' scrolling="auto"></iframe>
<h3>缺少工资费用明细人员名单(已缴交社保,但无法确定所属单位):</h3>
<iframe src="balBody.php?type=1_1&manager=<?php echo $manager?>&table=so_bal_2&month=<?php echo $month;?>" frameboder=0 width=100% height='400px' scrolling="auto"></iframe>
<h3>未能缴交社保人员名单(有工资费用明细,但无法确定所属的社保账号):</h3>
<iframe src="balBody.php?type=1_2&manager=<?php echo $manager?>&table=so_bal_1&month=<?php echo $month;?>" frameboder=0 width=100% height='400px'  scrolling="auto"></iframe>
<h3>费用缴交错误人员信息:</h3>
<iframe src="balBody.php?type=1_3&manager=<?php echo $manager?>&table=error_bal&month=<?php echo $month;?>" frameboder=0 width=100% height='400px'  scrolling="auto"></iframe>
</div>
<?php 
}
if($_POST['fromUrl']=="51job")
{
?>
<div class="accordion">

<p>工资/社保缴交费用明细核对错误结果:</p>
<h3>公积金人员不匹配名单(未缴交社保,但有公积金费用):</h3>
<iframe src="balBody.php?type=2_4&manager=<?php echo $manager?>&table=so_bal_6&month=<?php echo $month;?>" frameboder=0 width=100% height='400px' scrolling="auto"></iframe>
<h3>缺少工资费用明细人员名单(已缴交社保,但无法确定所属单位):</h3>
<iframe src="balBody.php?type=2_1&manager=<?php echo $manager?>&table=so_bal_2&month=<?php echo $month;?>" frameboder=0 width=100% height='400px' scrolling="auto"></iframe>
<h3>未能缴交社保人员名单(有工资费用明细,但无法确定所属的社保账号):</h3>
<iframe src="balBody.php?type=2_2&manager=<?php echo $manager?>&table=so_bal_1&month=<?php echo $month;?>" frameboder=0 width=100% height='400px'  scrolling="auto"></iframe>
<h3>费用缴交错误人员信息:</h3>
<iframe src="balBody.php?type=2_3&manager=<?php echo $manager?>&table=error_bal&month=<?php echo $month;?>" frameboder=0 width=100% height='400px'  scrolling="auto"></iframe>
</div>
<?php 
}
?>
</body>