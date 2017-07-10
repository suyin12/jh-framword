<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/*
 * ytongzhi=
  0 -> 未通知
  1 -> 已通知
  2 -> 储备,复试不合格
  3 -> 复试合格
  4 -> 待处理人员
  5 -> 上岗 
  
  ytongzhi=0,yluyong=1,buhege=0 ->已录用
* */
require_once '../header/recruitmentHeader.php';
if(!defined('ALLOW'))exit();
?>
<body>

<script language=javascript>
     
//		 $(document).ready(function() {
//			   var sWidth = Math.max(document.body.scrollWidth, document.documentElement.clientWidth);
//			   var sHeight = Math.max(document.body.scrollHeight, document.documentElement.clientHeight)+100;
//			    $('iframe').css({width: sWidth, height: sHeight});
//			    });
		 $(document).ready(function() {
			   var sWidth = Math.max(document.body.scrollWidth, document.body.clientWidth);
			   var sHeight = Math.max(document.body.scrollHeight, document.body.clientHeight)+100;
			    $('iframe').css({width: sWidth, height: sHeight});
			    });
		</script>


<?php 

 require_once '../settings.inc';
 $managerSql="select * from cwps_user where SubGroupIDs=',14,'";
 $managerRet=mysql_query($managerSql);
	   
//	ini_set(error_reporting,E_ALL);
?>


<div id="headindex">
	 您现在的位置是:简历浏览-><a href="assiantQuickWorker.php">简历辅助管理</a>
</div>
 <br/><br/> 
<form name="searchForm" id="searchForm" action="" method="post">
<div align="center">
<div>		

简历状态: <select name="status">
	<option value="0">---公共库---</option>
	<option value="4" <?php if($_POST['status']=="4") echo "selected";?>>待处理人员</option>
	<option value="3" <?php if($_POST['status']=="3") echo "selected";?>>复试合格</option>
	<option value="2" <?php if($_POST['status']=="2") echo "selected";?>>储备</option>
	<option value="5" <?php if($_POST['status']=="5") echo "selected";?>>上岗</option>
</select> 
筛选条件:  <select name="status2">
	<option value="0">--请选择--</option>
	<option value="name"
		<?php if($_POST['status2']=="xueli") echo "selected";?>>姓名</option>
	<option value="xueli"
		<?php if($_POST['status2']=="xueli") echo "selected";?>>学历</option>
	<option value="sex"
		<?php if($_POST['status2']=="sex") echo "selected";?>>性别</option>
	<option value="yixiang"
		<?php if($_POST['status2']=="yixiang") echo "selected";?>>求职意向</option>
	<option value="quyu"
		<?php if($_POST['status2']=="quyu") echo "selected";?>>求职区域</option>
</select> <input name="searchTxt" type="text"	value="<?php echo $_POST['searchTxt'];?>" /> 
	<input name="search"	type="submit"  />
	</div>
	<br>
	<div>
         选择辅助管理的客户经理:  <select name="manager">
	<option value="" selected>---请选择---</option>
	<?php 
	while (($managerRow=@mysql_fetch_array($managerRet))==true)
	{
	?>
	<option value="<?php echo $managerRow['UserName'];?>"<?php if($_POST['manager']==$managerRow['UserName']) echo "SELECTED";?>><?php echo $managerRow['UserName'];?></option>
	<?php 
	}
	?>
	</select>
	</div>
	</div>
</form>
<?php 
 include_once ("../settings1.inc");
if(isset($_POST['search'])){
    $status=$_POST['status'];
    
    $status2=$_POST['status2'];
    $searchTxt=$_POST['searchTxt'];
   if($_POST['status2']=="xueli"){
      $j=trim($_POST['searchTxt']); 
       switch($j)
       {
           case "高中": $searchTxt=1;break;
           case "中专": $searchTxt=2;break;
           case "中技": $searchTxt=3;break;
           case "大专": $searchTxt=4;break;
           case "本科": $searchTxt=5;break;
           case "研究生": $searchTxt=6;break;
           case "硕士": $searchTxt=7;break;
           case "博士": $searchTxt=8;break;
           case "初中": $searchTxt=9;break;
       }
   }
   if($_POST['status2']=="sex"){
      $j=trim($_POST['searchTxt']); 
       switch($j)
       {
           case "男": $searchTxt=1;break;
           case "女": $searchTxt=0;break;
       }
   }
 
   if(isset($_SESSION['searchSql']))
          unset($_SESSION['searchSql']);
   if($_POST['status']!="0")
   {
       if($_POST['status']=="2"){
       $searchSql="SELECT * FROM  cmsware_publish_147 where ytongzhi='$status'  and $status2 like '%$searchTxt%'";
       $_SESSION['searchSql']=$searchSql;
          }
    else{   
       $searchSql="SELECT * FROM  cmsware_publish_147 where ytongzhi='$status' and $status2 like '%$searchTxt%'";
       $_SESSION['searchSql']=$searchSql;
       }
        
   } 
   else{
       $searchSql="SELECT * FROM  cmsware_publish_147 where (ytongzhi='2' or ytongzhi='1') and $status2 like '%$searchTxt%'";
       $_SESSION['searchSql']=$searchSql;
   }
}
$userName=$_POST['manager'];
$quickWorkerArray=array($userName,$searchSql,$_POST['status']);
unset($_SESSION['quickWorkArray']);
$_SESSION['quickWorkArray']=$quickWorkerArray;
//print_r($_SESSION['quickWorkArray']);
?>
<iframe src="quickWorkBody.php" scrolling=no frameborder=0 ></iframe>
	</body>
	</html>
</div>
</body>
</html>