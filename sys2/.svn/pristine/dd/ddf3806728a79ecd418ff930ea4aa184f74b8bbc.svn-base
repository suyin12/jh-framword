<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
require_once '../header/companyHeader.php';
if(!defined('ALLOW'))exit();
 unset($_SESSION['changeArray']);
require_once '../settings.inc';
 $managerSql="select * from cwps_user where SubGroupIDs=',14,'";
 $managerRet=mysql_query($managerSql);
?>
<body>
<div id="headindex">
	 您现在的位置是:员工信息管理-><a href="changeDetail.php">员工入/离职概况</a>
</div>
 <script language="JavaScript">
 function sel(){
	    var URL=location.pathname;
//	    alert(URL);
	    var v=document.getElementById('manager').value;
        if(v==''){
            window.location=URL;
            }
        else{
        URL=URL+'?managerID='+v;
        window.location=URL;
        }
//        alert(URL);
        
 }
 $(document).ready(function() {
	   var sWidth = Math.max(document.body.scrollWidth, document.documentElement.clientWidth)*0.95;
	   var sHeight = Math.max(document.body.scrollHeight, document.documentElement.clientHeight)*0.95;
	    $('iframe').css({width: sWidth, height: sHeight});
	    });     
 </script>
 <br>
 <br>
<form method="post" action="">
<div id="searchCondition">
<input type="text" name="year" style="width:40px;" value="<?php if(isset($_POST['year'])) echo $_POST['year'];else  echo date('Y'); ?>" />年
<input type="text" name="month" style="width:30px;" value="<?php if(isset($_POST['month'])) echo $_POST['month'];else  echo date('m'); ?>" />月
&nbsp;&nbsp;隶属于:<select name="manager" id="manager" onchange=sel(this.value)>
	<option value="" selected>所有员工</option>
	<?php 
	while (($managerRow=@mysql_fetch_array($managerRet))==true)
	{
	?>
	<option value="<?php echo $managerRow['UserID'];?>"<?php if($_GET['managerID']==$managerRow['UserID']) echo "SELECTED";?>><?php echo $managerRow['UserName'];?></option>
	<?php 
	}
	?>
	</select>
	<?php 
	
	if(isset($_GET['managerID']))
	{
	    $companySql="select field3 from workerInfo";
	    $companySql.=" where sessionID='$_GET[managerID]'";
	    $companySql.=" group by field3";
	}
	
	$companyRet=mysql_query($companySql);
	?>
	&nbsp;&nbsp;
	<select name="company">
	<option value="" selected>请选择单位</option>
	<?php 
	while (($companyRow=@mysql_fetch_array($companyRet))==true)
	{
	?>
	<option value="<?php echo $companyRow['field3'];?>" <?php if($_POST['company']==$companyRow['field3']) echo "SELECTED";?>><?php echo $companyRow['field3'];?></option>
	<?php 
	}
	?>
	</select>
	<select name="type">
	<option value="">在职状态</option>
	<option value="在职" <?php if($_POST['type']=="在职") echo "selected";?>>在职</option>
	<option value="离职" <?php if($_POST['type']=="离职") echo "selected";?>>离职</option>
	</select>
	&nbsp;&nbsp;<input type="submit" name="sub" value="提交">
		</div>
	</form>	

	<?php 
	if(isset($_POST['sub']))
	{
	    $time=$_POST['year']."-".$_POST['month'];
	    if($_POST['manager']=="")
	    {
	       $sql="select * from workerInfo
	               where (field29 like '%$time%' or field30 like '%$time%')
	                and field3 like '%$_POST[company]%' and field2 like '%$_POST[type]%'";
	    }
	    else {
	       $sql="select * from workerInfo
	               where (field29 like '%$time%' or field30 like '%$time%') and sessionID like '$_POST[manager]'
	                and field3 like '%$_POST[company]%' and field2 like '%$_POST[type]%'";
	        
	    }
	    $changeArray=array($sql,$_POST['manager'],$_POST['type']);
	   
	    $_SESSION['changeArray']=$changeArray;
//	    print_r($changeArray);
	}
	
	?>
	
	<div >
	<iframe src="changeBody.php" scrolling="no"  frameborder=0></iframe>
	</div>
</body>	
</div>
</body>
</html>	