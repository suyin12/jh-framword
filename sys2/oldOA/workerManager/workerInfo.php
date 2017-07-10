<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
@session_start();
$IDNumber=$_GET[IDNumber];
$salaryNo=$_GET[salaryNo];
//$salaryNo="605840115220337784";
if($_SESSION['Cqyyh']!=13)
{
echo "您无权访问";
}
else
{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function check_Data()
{   
if(document.form1.elements["db_table"].value.length==0){
	     alert("请选择月份!");
	     document.form1.elements["db_table"].focus();
	     return false;
	    }
    if(document.form1.elements["db_table"].value.length!=0&&document.form1.elements["db_field"].value.length==0)
    {
    	 alert("请选择查询条件!");
	     document.form1.elements["searchtxt"].focus();
	     return false;
	    }
};
function check_Data2()
{
     if(document.form1.elements["db_field"].value.length==0)
    {
    	 alert("请选择查询条件!");
	     document.form1.elements["searchtxt"].focus();
	     return false;
	    }
}
function checkData()
{
	if(document.dimissionForm.elements["reason"].value.length==0){
	     alert("请选择离职原因");
	     document.dimissionForm.elements["reason"].focus();
	     return false;
	    }
	if(document.dimissionForm.dimissionDate.value==0){
	     alert("离职日期不能为空!");
	     document.dimissionForm.dimissionDate.focus();
	     return false;
	    }
};
function doOutput()
{
	    var checkObj=document.salaryForm.elements["checkbox"];
        var checkLen = checkObj.length;
        var checked = false;

        for (var i = 0; i < checkLen; i++)
        {
            if (checkObj[i].checked == true)
            { 
                checked = true;
                break;
            }
        }
        if(!checked){
        if(!alert("请选择要打印的月份")){return false;};
        }
};
</script>
<script type="text/javascript" src="../js/jquery.js"></script>
<style type="text/css">
body {
font: normal 12px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
color: #4f6b72;
}
p{color:bule;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
table{font-size:12px;}
.th{background: #CAE8EA;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
.td{background:#ffffff;text-align:center;}

</style>

</head>
<body>
<?php
include_once '../settings.inc';
if($salaryNo!=null&&$IDNumber==null)
{ 
$sql="select * from workerInfo where field28='$salaryNo'";
$result=mysql_query($sql);
$tt=mysql_affected_rows();
$row=mysql_fetch_array($result);
$IDNumber=$row[field7];
}
else
{
$sql="select * from workerInfo where field7='$IDNumber'";
$result=mysql_query($sql);
$tt=mysql_affected_rows();
$row=mysql_fetch_array($result);
}
if($tt>0){
$salarySql="select * from workerSalary  where IDNumber='$IDNumber'";
$ret=mysql_query($salarySql);

$judgeSql1="select * from cwps_user where UserName='$row[field7]'";
$judgeSql2="select * from cwps_user where UserName='$row[field7]' and Status<>1";
mysql_query($judgeSql1);
$judgeTt1=mysql_affected_rows();
mysql_query($judgeSql2);
$judgeTt2=mysql_affected_rows();
?>


<div>

<div>
<div style="float:right;">
<a href='editWorker.php<? echo "?"; ?>editId=<?php echo $row['ID'];?>&sessionID=<?php echo $row['sessionID'];?>' target="_blank">更改员工信息</a>
<?php 
if($judgeTt1==0&&$row[field7]>0){
?>
<form action="" method="post">
<input type="submit" value="开通账号" name="Insert">
<?php 
	    	
		if(isset($_POST['Insert'])){
	    $insert_id=$row['field7'];
		$insertsql1= "insert into  cwps_user   SET   GroupID=8,Username='$insert_id',password='E10ADC3949BA59ABBE56E057F20F883E',status=1";
		$insertsql2= "insert into  cwps_user_extra   SET   UserID=LAST_INSERT_ID(),Cqyyh=8";		
		$insertRet = mysql_query($insertsql1);
		$insertTt1=mysql_affected_rows();
		if($insertTt1>0){
		        mysql_query($insertsql2);  
		        $insertTt2=mysql_affected_rows();  
		
		}
		
	   if($insertTt2>0){
				echo '<script language=javascript>window.alert(\'开通成功!!\')</script>';
				echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
	               }
		} 
   
	?>
</form>
<?php
 }
 if($judgeTt2>0&&$row[field7]>0){
 ?>
 <form action="" method="post">
<input type="submit" value="激活账号" name="Update">
<?php 
	    	
		if(isset($_POST['Update'])){		
		$update_id = $row[field7];
		$updatesql= "Update cwps_user set status=1 WHERE UserName='$update_id'";
		$updateRet = mysql_query($updatesql);
		$updateTt=mysql_affected_rows();
		}	
	   if($updateTt>0){
				echo '<script language=javascript>window.alert(\'激活成功!!\')</script>';
				 echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
	   }
	?>
</form>
<?php
 }
?>
</div>

<div >
<form action="" method="post" name="searchRadioForm" >
<span><input type="radio" name="searchRadio"  value="1" <?php if($_POST[searchRadio]==1) echo "checked"; ?> onClick="this.form.submit()"/>
查询工资信息</span>
<span><input type="radio" name="searchRadio"  value="2" <?php if($_POST[searchRadio]==2) echo "checked"; ?> onClick="this.form.submit()"/>
查询员工信息</span>
</form>

<?php
$managerSql="select * from cwps_user where SubGroupIDs=',14,'";
    $managerRet=mysql_query($managerSql);
if($_POST[searchRadio]==1){?>
<form name="form1" method="post" action="../salaryManager/fixed.php">	
<div id="searchCondition">
	隶属于:<select name="manager">
	<option value="" selected>所有员工</option>
	<?php 
	while (($managerRow=@mysql_fetch_array($managerRet))==true)
	{
	?>
	<option value="<?php echo $managerRow['UserID'];?>"<?php if($_POST[manager]==$managerRow['UserID']) echo "SELECTED";?>><?php echo $managerRow['UserName'];?></option>
	<?php 
	}
	?>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;
	请选择月份:	<select name="db_table" >
	<option value="" SELECTED>--请选择--</option>
	<option value="yue1" <?php if($_POST[db_table]=="yue1") echo "SELECTED";?>>1月</option>
	<option value="yue2" <?php if($_POST[db_table]=="yue2") echo "SELECTED";?>>2月</option>
	<option value="yue3" <?php if($_POST[db_table]=="yue3") echo "SELECTED";?>>3月</option>
	<option value="yue4" <?php if($_POST[db_table]=="yue4") echo "SELECTED";?>>4月</option>
	<option value="yue5" <?php if($_POST[db_table]=="yue5") echo "SELECTED";?>>5月</option>
	<option value="yue6" <?php if($_POST[db_table]=="yue6") echo "SELECTED";?>>6月</option>
	<option value="yue7" <?php if($_POST[db_table]=="yue7") echo "SELECTED";?>>7月</option>
	<option value="yue8" <?php if($_POST[db_table]=="yue8") echo "SELECTED";?>>8月</option>
	<option value="yue9" <?php if($_POST[db_table]=="yue9") echo "SELECTED";?>>9月</option>
	<option value="yue10"<?php if($_POST[db_table]=="yue10") echo "SELECTED";?>>10月</option>
	<option value="yue11"<?php if($_POST[db_table]=="yue11") echo "SELECTED";?>>11月</option>
	<option value="yue12"<?php if($_POST[db_table]=="yue12") echo "SELECTED";?>>12月</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	选择查询方式:	
	<select name="db_field">
	<option value="" SELECTED>--请选择--</option>
	<option value="field4" <?php if($_POST[db_field]=="field4") echo "SELECTED";?>>工资账号</option>
	<option value="field1" <?php if($_POST[db_field]=="field1") echo "SELECTED";?>>单位名称</option>
	<option value="field2" <?php if($_POST[db_field]=="field2") echo "SELECTED";?>>部门名称</option>
	<option value="field3" <?php if($_POST[db_field]=="field3") echo "SELECTED";?>>姓名</option>
	</select>
	
	 <input name="searchtxt" type="text" value="<?php echo $_POST[searchtxt];?>"/>
	<input name="search" value="查询" type="submit" onClick="return check_Data()"; />
	</div>
	</form>
<?php
 }
if($_POST[searchRadio]==2){
?>
<form name="form1" method="post" action="fixedWorker.php">	
	
	隶属于:<select name="manager">
	<option value="" selected>所有员工</option>
	<?php 
	while ($managerRow=@mysql_fetch_array($managerRet))
	{
	?>
	<option value="<?php echo $managerRow['UserID'];?>"<?php if($_POST[manager]==$managerRow['UserID']) echo "SELECTED";?>><?php echo $managerRow['UserName'];?></option>
	<?php 
	}
	?>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;
	选择查询方式:	
	<select name="db_field">
	<option value="" SELECTED>--请选择--</option>
	<option value="field6" <?php if($_POST[db_field]=="field6") echo "SELECTED";?>>姓名</option>
	<option value="field7" <?php if($_POST[db_field]=="field7") echo "SELECTED";?>>身份证编号</option>	
	<option value="field28" <?php if($_POST[db_field]=="field28") echo "SELECTED";?>>工资账号</option>
	<option value="field3" <?php if($_POST[db_field]=="field3") echo "SELECTED";?>>单位名称</option>
	<option value="field4" <?php if($_POST[db_field]=="field4") echo "SELECTED";?>>部门名称</option>
	<option value="field2" <?php if($_POST[db_field]=="field2") echo "SELECTED";?>>在职状态</option>
	<option value="field1" <?php if($_POST[db_field]=="field1") echo "SELECTED";?>>用工形式</option>
	<option value="field0" <?php if($_POST[db_field]=="field0") echo "SELECTED";?>>档案编号</option>				
	</select>
	
	 <input name="searchtxt" type="text" value="<?php echo $_POST[searchtxt];?>" />
	<input name="search" value="查询" type="submit" onClick="return check_Data2()" />
	</form>
<?php 
}
?>
</div>
<br>
<p>"<?php echo $row['field6']; ?>"先生/女士的基本信息:</p>
<table width="100%" id="wokerBasicTable" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666" width="100%" >
  <tr>
    <td class="th" width="62" >姓名</td>
    <td class="td" width="70"><?php echo $row['field6']; ?></td>
    <td class="th" width="39">性别</td>
    <td class="td" width="35"><?php echo $row['field8']; ?></td>
    <td class="th" width="54">民族</td>
    <td class="td" width="50"><?php echo $row['field9']; ?></td>
    <td class="th" width="62">籍贯</td>
    <td class="td" width="50"><?php echo $row['field12']; ?></td>
    <td class="th" width="72">户口所在地</td>
    <td class="td" colspan="3"><?php echo $row['field14']; ?></td>
    <td class="th" width="82">户籍类型</td>
    <td class="td" ><?php echo $row['field13']; ?></td>
    <td class="th" >婚姻状况</td>
    <td class="td" width="46"><?php echo $row['field11']; ?></td>
  </tr>
  <tr>
    <td class="th" >固定电话</td>
    <td class="td" colspan="3"><?php echo $row['field16']; ?></td>
    <td class="th" >移动电话</td>
    <td class="td" colspan="3"><?php echo $row['field17']; ?></td>
    <td class="th">身份证地址</td>
    <td class="td" colspan="3"><?php echo $row['field15']; ?></td>
    <td class="th">身份证编号</td>
    <td class="td" colspan="5"><?php echo $row['field7']; ?></td>
  </tr>
  <tr>
  <td class="th">毕业学校</td>
  <td class="td"><?php echo $row['field22']; ?></td>
  <td class="th">专业</td>
  <td class="td"><?php echo $row['field23']; ?></td>
  <td class="th" >文化程度</td>
  <td class="td"><?php echo $row['field21']; ?></td>
   <td class="th">政治面貌</td>
  <td class="td"><?php echo $row['field10']; ?></td>
  <td class="th">联系人</td>
  <td class="td" width="64"><?php echo $row['field18']; ?></td>
  <td class="th" width="99">与联系人关系</td>
  <td class="td" width="48"><?php echo $row['field19']; ?></td>
  <td class="th">联系人电话</td>
  <td class="td" colspan="3"><?php echo $row['field20']; ?></td>
  </tr>
</table>
</div>
<div>
<p>社保相关信息:</p>
       <table id="wokerTaxTable" border="0" cellspacing="1" cellpadding="2"  bgcolor="#666666" width="100%" >
		<thead>
		<tr bgcolor="#CAE8EA">
		<th ><strong>社保电脑编号</strong></th>
		<th ><strong>社保投保年月</strong></th>
		<th ><strong>首次发放工资</strong></th>
		<th ><strong>发放工资开户银行</strong></th>
		<th ><strong>发放工资银行账号</strong></th>
		</tr>
		</thead>
		<tbody>
		<tr  bgcolor="#ffffff">
		<td><?php echo $row['field24']; ?></td>
		<td><?php echo $row['field25']; ?></td>
		<td><?php echo $row['field26']; ?></td>
		<td><?php echo $row['field27']; ?></td>
		<td><?php echo $row['field28']; ?></td>
		</tr>
		</tbody>
		</table>
		</div>
<div>
          <p>合同相关信息:</p>
        <table id="wokerConnectTable" border="0" cellspacing="1" cellpadding="2"  bgcolor="#666666" width="100%" >
		<thead>
		<tr bgcolor="#CAE8EA">
		<th ><strong>档案编号</strong></th>
		<th ><strong>用工形式</strong></th>
		<th ><strong>在职状态</strong></th>
		<th ><strong>单位名称</strong></th>
		<th ><strong>部门名称</strong></th>
		<th ><strong>岗位</strong></th>
		<th ><strong>入职日期</strong></th>
		<th ><strong>离职日期</strong></th>			
		<th ><strong>合同初始日期</strong></th>
		<th ><strong>合同终止日期</strong></th>
		<th ><strong>续签合同开始日期</strong></th>
		<th ><strong>续签合同终止日期</strong></th>
		<th ><strong>续签合同编号</strong></th>
		<th ><strong>备注</strong></th>
		</tr>
		</thead>
		<tbody>
		<tr  bgcolor="#ffffff">
		<td><?php echo $row['field0']; ?></td>
		<td><?php echo $row['field1']; ?></td>
		<td><?php echo $row['field2']; ?></td>
		<td><?php echo $row['field3']; ?></td>
		<td><?php echo $row['field4']; ?></td>
		<td><?php echo $row['field5']; ?></td>
		<td><?php echo $row['field29']; ?></td>
		<td><?php echo $row['field30']; ?></td>
		<td><?php echo $row['field31']; ?></td>
		<td><?php echo $row['field32']; ?></td>
		<td><?php echo $row['field33']; ?></td>
		<td><?php echo $row['field34']; ?></td>
		<td><?php echo $row['field35']; ?></td>
		<td><?php echo $row['field36']; ?></td>
		</tr>
		</tbody>	
		</table>
		</div>
<div>
<div>
<p>离职处理:</p>
<form id="dimissionForm" name="dimissionForm" action="" method="post">
离职原因:
<select name="reason">
<option value="">--请选择--</option>
<option value="主动辞职" <?php if($_POST[reason]=="主动辞职") echo "SELECTED";?>>主动辞职</option>
<option value="解除合同" <?php if($_POST[reason]=="解除合同") echo "SELECTED";?>>解除合同</option>
<option value="合同到期" <?php if($_POST[reason]=="合同到期") echo "SELECTED";?>>合同到期</option>
</select>
离职日期:
<input type="text" name="dimissionDate" style="width:70px;" />
<input type="submit" name="dimission"  value="离职" onClick="return checkData();" />

<?php 
if(isset($_POST['dimission']))
{
    $reason=$_POST['reason'];
    $dimissionDate=$_POST['dimissionDate'];
    $updateSql="update workerInfo set field2='离职',field30='$dimissionDate',field36='$reason' where field7='$row[field7]'";
    $updateRet=mysql_query($updateSql);
     $tt=mysql_affected_rows();
     if($tt>0){
         echo '<script language=javascript>window.alert(\'离职办理成功!!\')</script>';
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">"; 
     } 
    
}
?>
</form>
</div>
<table width="100%">
<tr><td><p>工资明细:</p></td><td style="text-align:right"><!--  <a href=printSalary.php<?echo "?"; ?>salaryNo=<?php echo $salaryNo;?>&workerName=<?php echo urlencode($row['field6']);?>&companyName=<?php echo urlencode($row['field3']);?> target='_blank'>打印工资单</a>-->
</td></tr>
</table>

<form name="salaryForm" method="post" action="printSalary.php" target="_blank">	

		<table id="displayTable" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666" width="100%" >
		<thead>
		<tr bgcolor="#CAE8EA">
		<th rowspan="2">√</th>
		<th rowspan="2"><strong>工资年月</strong></th>
		<th rowspan="2"><strong>单位名称</strong></th>
		<th rowspan="2"><strong>部门名称</strong></th>
		<th rowspan="2"><strong>姓名</strong></th>
		<th rowspan="2" ><strong>工资账号</strong></th>
		<th rowspan="2"><strong>应发工资</strong></th>
		<th colspan="5" class="nobg"><strong>扣&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;款</strong></th>
		<th rowspan="2"><strong>实发金额</strong></th>	
		<th rowspan="2"><strong>备注</strong></th>
		</tr>
		<tr bgcolor="#CAE8EA">
		<th><strong>扣个税</strong></th>
		<th><strong>扣保险</strong></th>
		<th><strong>房屋水电</strong></th>
		
		<th><strong>其他</strong></th>
		<th><strong>扣款合计</strong></th>
		</tr>
		</thead>
		<tbody id="displaybody">
		<?php
		if($ret){
		while(($rows=mysql_fetch_array($ret))==true)
		{		   
		?>
		
		<tr bgcolor="ffffff">
		<td align="center" bgcolor="#FFFFFF"><input id="checkbox" name="checkbox[]" type="checkbox"  value="<? echo $rows['IDNumber'].",".$rows['field0']; ?>"></td>
		<td ><? echo $rows['field0']; ?></td>
		<td ><input type="hidden" name="companyName"  value="<? echo $rows['field1']; ?>"/><? echo $rows['field1']; ?></td>
		<td ><? echo $rows['field2']; ?></td>
		<td ><input type="hidden" name="workerName" value="<? echo $rows['field3']; ?>" /><? echo $rows['field3']; ?></td>
		<td ><? echo $rows['field4']; ?></td>
		<td ><? echo $rows['field5']; ?></td>
		<td ><? echo $rows['field6']; ?></td>
		<td ><? echo $rows['field7']; ?></td>
	    <td ><? echo $rows['field8']; ?></td>
		<td ><? echo $rows['field9']; ?></td>
		<td><? echo $rows['field10']; ?></td>
		<td><? echo $rows['field11']; ?></td>
		<td><? echo $rows['field12']; ?></td>
		
		
		</tr>
		<?php
		}	
		}
		?>
		</tbody>
		</table>
		<div id="foot">
		<div class="button">
		<a href="#" onClick="$('input[type=checkbox]').attr('checked', 'checked')">全选</a>
		<a href="#" onClick="$('input[type=checkbox]').removeAttr('checked')">全不选 </a>		
		<input type="submit" name="print" value="打印"  /> 
		
	    </div>
	    </div>
	    </form>
</div>
<div>
<?php 
    $totalSql="select count(*),sum(field5),sum(field11),cast( avg( field5 + 0.0 ) as decimal ( 10 , 2 ) ),cast( avg( field11 + 0.0 ) as decimal ( 10 , 2 ) ) from workersalary where IDNumber='$IDNumber'" ;
    $totalRet=mysql_query($totalSql);
	if($totalRet)
    $totalRow=mysql_fetch_array($totalRet);
?>
<p align="center">月数:<?php echo $totalRow['count(*)']; ?>个月
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;应发工资合计: <?php echo $totalRow['sum(field5)']; ?>元&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
实发金额合计: <?php echo $totalRow['sum(field11)']; ?>元
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月平均应发工资:<?php echo $totalRow['cast( avg( field5 + 0.0 ) as decimal ( 10 , 2 ) )']; ?>元
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月平均实发金额:<?php echo $totalRow['cast( avg( field11 + 0.0 ) as decimal ( 10 , 2 ) )']; ?>元</p>
</div>
</div>
<?
}
else
{echo "<P style='color:bule;font: bold 25px Verdana, Arial, Helvetica, sans-serif;margin-top:200px;text-align:center;'>花名册中未存在该员工信息,请及时添加</p>" ;}
?>

</body>
</html>
<?
}
?>
</div>
</body>
</html>