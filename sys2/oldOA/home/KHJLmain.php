<?php 
require_once '../header/companyHeader.php';
if(!defined('ALLOW'))exit();
?>

<body>

<script type="text/javascript">
$(document).ready(function(){
	
	$(".accordion h3:first").addClass("active");
	$(".accordion table:not(:first)").hide();

	$(".accordion h3").click(function(){
		$(this).next("table").slideToggle("slow")
		.siblings("table:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	});

	 $(".accordion h3").each(function(i){$(".accordion h3").eq(i).append("<span style='color:red'>(共"+$("tbody:eq("+i+") tr").length+"条)</span>");});
});
</script>
<?php
require_once ("../settings.inc");	
 $sessionID=$_SESSION['UserID'];	
//$sessionID='747';	


$judgeSql="select * from cwps_user where UserID='$sessionID'";
$judgeRet=mysql_query($judgeSql);
$judgeRow=mysql_fetch_array($judgeRet);
$subGroupID=trim($judgeRow['SubGroupIDs'],',');
	if($_SESSION['Cqyyh']==13&&$subGroupID==14)
	{	
         
	    $IDErrorArray="";
		$companySql="select  field3,count(field3) from workerInfo where field2='在职' and sessionID='$sessionID' group by field3 ";
		$companyRet=mysql_query($companySql);
	
		
?>
<div class="mainBody">
<div>
<span>您目前分管的单位有:</span>
<?
$workerNum=0;
 while(($companyRow=mysql_fetch_array($companyRet))==true)
{
    if($companyRow[field3]!=null){
?>
<form style="float:left" action="fixedWorker.php"  target='_self' name="TTT" id="TTT" method="post"> 
<input   type="hidden"   name="search"   value="<? echo "查询"; ?>" />
<input   type="hidden"   name="db_field"   value="<? echo "field3"; ?>" />
<input   type="hidden"   name="searchtxt"   value="<? echo $companyRow[field3];?>" />  
<input type="submit"  value="<? echo $companyRow['field3']."(".$companyRow['count(field3)'].")"; ?>">
</form>
 <?
 $workerNum=$workerNum+$companyRow['count(field3)'];
}
}
 ?>
 <?php echo "(共<span style='color:red'>".$workerNum."</span>人)";?>
 </div>
 <div class="accordion">
 <h3>员工生日提醒</h3>
 <table width=100%    border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
 <thead>
 <tr bgcolor="#CAE8EA">
 <th>单位名称</th>
 <th>部门名称</th>
 <th>岗位</th>
 <th>姓名</th>
 <th>身份证号码</th>
 <th>年龄</th>
 <th>固定电话</th>
 <th>移动电话</th>
 </tr>
 </thead>
 <tbody>
 <?php 
		$today=date("md");
		$birthdaySql="select * from workerInfo where field2='在职'";
		$birthdayRet=mysql_query($birthdaySql);
		while(($birthdayRow=mysql_fetch_array($birthdayRet))==true){
	    $shenfenzheng=trim($birthdayRow[field7]);
		$changdu=strlen($shenfenzheng);
		$showtime=date("Y");
        
        
	    if ($changdu==18||$changdu==17)  
		{
		$asa=substr($shenfenzheng,6,4);
	    $age=$showtime- $asa;
		$birthday=substr($shenfenzheng,10,4);
		$ring=strcmp($today,$birthday);
		}
		elseif 
		($changdu==15)
		{ 
		$asb="19".substr($shenfenzheng,6,2);
		$age=$showtime- $asb;
		$birthday=substr($shenfenzheng,8,4);
		$ring=strcmp($today,$birthday);
		}
		else {
		    $IDErrorArray[]=$birthdayRow;
//		    $IDErrorArray[]=array($birthdayRow[field6],$birthdayRow[field7],$birthdayRow[field3]);
//		echo "<p style='color:red'>身份证号码位数错误信息提示:姓名:".$birthdayRow[field6]."&nbsp&nbsp身份证号码:".$birthdayRow[field7]."&nbsp&nbsp单位:".$birthdayRow[field3]."</p>";
		}
		
		
		if($ring==0)
		{
		    $birthdayNum++;
			
 ?>
	<tr bgcolor="#ffffff">
	<td><? echo $birthdayRow['field3'];?></td>
	<td><? echo $birthdayRow['field4'];?></td>
	<td><? echo $birthdayRow['field5'];?></td>
	<td class="edit"><a href='workerInfo.php<? echo "?"; ?>sessionID=<?php echo $birthdayRow['sessionID'];?>&IDNumber=<?php echo $birthdayRow['field7'];?>'><? echo $birthdayRow['field6']; ?></a></td>
	<td><? echo $birthdayRow['field7'];?></td>
	<td><? echo $age;?></td>
	<td><? echo $birthdayRow['field16'];?></td>
	<td><? echo $birthdayRow['field17'];?></td>
	</tr>
<?php
		}
		}
?> 
</tbody>
</table>
		
		 
		 <h3>合同到期提醒</h3>
		 <table width=100% class="tablesorter"   border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		 <thead>
		 <tr bgcolor="#CAE8EA">
		<th>合同编号</th>
		<th>单位名称</th>
		<th>部门名称</th>
		<th>姓名</th>
		<th>合同初始日期</th>
		<th>合同终止日期</th>
		<th>续签合同开始日期</th>
		<th>续签合同终止日期</th>
		<th>固定电话</th>
		<th>移动电话</th>
		 </tr>
		 </thead>
		 <tbody>
		 <?php 
		 $today=date('Ymd');
		 $contractRingDay=$today+100;
		 $contractRingSql="select * from workerInfo where (field32>$today and field32<$contractRingDay and field34=0 
		           or(field34>$today and field34<$contractRingDay and field32<>0 ) 
		           or field32=0 )and sessionID='$sessionID'";
         $contractRingResult=mysql_query($contractRingSql);
		 while (($contractRingRow=@mysql_fetch_array($contractRingResult))==true)
		 {
		 ?>
		 
		 <tr bgcolor="#ffffff">
		<td><? echo $contractRingRow['field0'];?></td>
		<td><? echo $contractRingRow['field3'];?></td>
		<td><? echo $contractRingRow['field4'];?></td>
		<td class="edit"><a href='workerInfo.php<? echo "?"; ?>sessionID=<?php echo $contractRingRow['sessionID'];?>&IDNumber=<?php echo $contractRingRow['field7'];?>'><? echo $contractRingRow['field6']; ?></a></td>
		<td><? echo $contractRingRow['field31'];?></td>
		<td><? echo $contractRingRow['field32'];?></td>
		<td><? echo $contractRingRow['field33'];?></td>
		<td><? echo $contractRingRow['field34'];?></td>
		<td><? echo $contractRingRow['field16'];?></td>
        <td><? echo $contractRingRow['field17'];?></td>
		 </tr>
		 <?php 
	     }
		 ?>
		 </tbody>
		 </table>
		 
		 
		 <h3>身份证位数错误提醒</h3>
		<table width=100% class="tablesorter"   border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		<thead>
		<tr bgcolor="#CAE8EA">
		<th>姓名</th>
		<th>身份证号码</th>
		<th>单位名称</th>
		<th>部门名称</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		if($IDErrorArray!=""){
		foreach ($IDErrorArray as $birRow) {
//			print_r($birRow);
		?>
		 <tr bgcolor="#ffffff">
		<td class="edit"><a href='workerInfo.php<? echo "?"; ?>sessionID=<?php echo $birRow['sessionID'];?>&IDNumber=<?php echo $birRow['field7'];?>'><? echo $birRow['field6']; ?></a></td>
		<td><?php echo $birRow['field7'] ?></td>
		<td><?php echo $birRow['field3'] ?></td>
		<td><?php echo $birRow['field4'] ?></td></tr>
		<?php 
		}
		}
		?>
		</tbody>
		 </table>
		 
		 <h3>花名册人员缺失提醒</h3>
		 <table width=100% class="tablesorter"   border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		 <thead>
		<tr bgcolor="#CAE8EA">
		<th>工资年月</th>
		<th>姓名</th>
		<th>单位名称</th>
		<th>部门名称</th>
		<th>备注</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		$undermannedSql="select * from undermannedView  where sessionID='$sessionID' group by field4";
		$undermannedRet=mysql_query($undermannedSql);
//		$undermannedRow=@mysql_fetch_array($undermannedRet)
//		print_r($undermannedRow);
//		echo "dfasdf=",mysql_num_rows($undermannedRet);
		while(($undermannedRow=@mysql_fetch_array($undermannedRet))==true)
		{
//		    print_r($undermannedRow);
		?>
		<tr bgcolor="#ffffff">
		<td><?php echo $undermannedRow['field0'] ?></td>
		<td class="edit"><a href='workerInfo.php<? echo "?"; ?>sessionID=<?php echo $undermannedRow['sessionID'];?>&salaryNo=<?php echo $undermannedRow['field4'];?>&workerName=<?php echo $undermannedRow['field3'];?>'><? echo $undermannedRow['field3']; ?></a></td>
		<td><?php echo $undermannedRow['field1'] ?></td>
		<td><?php echo $undermannedRow['field2'] ?></td>
		<td><?php echo $undermannedRow['field12'] ?></td>
		</tr>
		<?php 
		}
		?>
		</tbody>
		 </table>
		 </div>
 

       
<?php 

	}
	if($_SESSION['Cqyyh']==13&&$subGroupID==17)
	{

		$workerTotalSql="select field7 from workerInfo where field2='在职' ";
		$workerTotalRet=mysql_query($workerTotalSql);
		$workerTotal=mysql_num_rows($workerTotalRet);
		echo "<p style='text-align:center;'>当前派遣员工共<span style='color:red;'>".$workerTotal."</span>人(领导层登陆可见)</p>";
		$managerSql="select UserID,UserName from cwps_user where SubGroupIDs=',14,'";
		$managerRet=mysql_query($managerSql);
 ?>
	 <table align="center" class="tablesorter"   border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<tr style="text-align:center" bgcolor="#CAE8EA"><td>客户经理</td><td>分管单位</td></tr>
<?php 
while (($managerRow=mysql_fetch_array($managerRet))==true)
{
 ?>
 <tr bgcolor="#ffffff">  
 <td><?php echo $managerRow[UserName];?></td> 
 <td>
<?php 
	$sql="select  field3,count(field3) from workerInfo where field2='在职' and sessionID='$managerRow[UserID]' group by field3 ";
	$ret=mysql_query($sql);
	while(($row=mysql_fetch_array($ret))==true)
	{
?>
<?php if($row[field3]) { echo $row[field3]."(<span style='color:red;'>".$row[count(field3)]."</span>)&nbsp;&nbsp;";}?>

<?php 
}
?>
</td>
</tr>
<?php 
}
?>
</table>
<?
	}
?>
</div>

 </body>
