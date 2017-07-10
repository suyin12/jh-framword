<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
@session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
include_once ("../settings.inc");
$judgeSql="select * from cwps_user where UserID='$_SESSION[UserID]'";
$judgeRet=mysql_query($judgeSql);
$judgeRow=@mysql_fetch_array($judgeRet);
$subGroupID=trim($judgeRow['SubGroupIDs'],',');
	if($_SESSION['Cqyyh']!=13||$subGroupID!=14)
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为客户经理专属,欲更改其数据请联系客户经理</p>";
	}
	else{
	
	?>

<link href="../css/main.css" type="text/css" rel="stylesheet" />
</head>

<body text="#000000" link="#000000" vlink="#000000" alink="#000000" topmargin="0" leftmargin="2" marginwidth="0" marginheight="0">

<script language='JavaScript'>

function checkData()
{
      	
			if(document.insertform.field1.value.length==0){
	     alert("用工形式称不能为空!");
	     document.insertform.field1.focus();
	     return false;
	    }
			if(document.insertform.field2.value.length==0){
	     alert("在职状态不能为空!");
	     document.insertform.field2.focus();
	     return false;
	    }
		
		if(document.insertform.field3.value.length==0){
	     alert("单位名称不能为空!");
	     document.insertform.field3.focus();
	     return false;
	    }
	
	
		if(document.insertform.field6.value.length==0) {
			alert("姓名不能为空!");
			document.insertform.field6.focus();
			return false;
		}
		if(document.insertform.field7.value.length==0) {
			alert("身份证编号不能为空!");
			document.insertform.field7.focus();
			return false;
		}
}
</script>
<div>
<div id="headindex">
	 您现在的位置是:员工信息管理-><a href="singleInsertWorker.php">单条添加</a>
</div>
<div align="center" >
  提示:用鼠标左击选择表中要更新的项
  </div>  
<div>
<form action="" method="post" name="insertform">

<table id="insertTable"  width="4000" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666" >
<thead>
<tr bgcolor="#CAE8EA">
		<th ><strong>档案编号</strong></th>
		<th ><strong>用工形式</strong></th>
		<th ><strong>在职状态</strong></th>
		<th ><strong>单位名称</strong></th>
		<th ><strong>部门名称</strong></th>
		<th ><strong>岗位</strong></th>
		<th ><strong>员工姓名</strong></th>
		<th ><strong>身份证编号</strong></th>
		<th ><strong>性别</strong></th>
		<th ><strong>民族</strong></th>
		<th ><strong>政治面貌</strong></th>
		<th ><strong>婚姻状况</strong></th>
		<th ><strong>籍贯</strong></th>
		<th ><strong>户籍类型</strong></th>
		<th ><strong>户口所在地</strong></th>
		<th ><strong>身份证地址</strong></th>
		<th ><strong>固定电话</strong></th>
		<th ><strong>移动电话</strong></th>
		<th ><strong>联系人</strong></th>
		<th ><strong>与联系人关系</strong></th>
		<th ><strong>联系人电话</strong></th>
		<th ><strong>文化程度</strong></th>
		<th ><strong>毕业学校</strong></th>
		<th ><strong>专业</strong></th>
		<th ><strong>社保电脑编号</strong></th>
		<th ><strong>社保投保年月</strong></th>
		<th ><strong>首次发放工资</strong></th>
		<th ><strong>发放工资开户银行</strong></th>
		<th ><strong>发放工资银行账号</strong></th>
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
		
<tr bgcolor="#ffffff">
<td><input type="text" name="field0" /></td>
<td><input type="text" name="field1" /></td>
<td><input type="text" name="field2" /></td>
<td><input type="text" name="field3"  /></td>
<td><input type="text" name="field4" /></td>
<td><input type="text" name="field5"  /></td>
<td><input type="text" name="field6" /></td>
<td><input type="text" name="field7" /></td>
<td><input type="text" name="field8"  /></td>
<td><input type="text" name="field9"  /></td>
<td><input type="text" name="field10" /></td>
<td><input type="text" name="field11" /></td>
<td><input type="text" name="field12"  /></td>
<td><input type="text" name="field13"  /></td>
<td><input type="text" name="field14" /></td>
<td><input type="text" name="field15" /></td>
<td><input type="text" name="field16" /></td>
<td><input type="text" name="field17"  /></td>
<td><input type="text" name="field18" /></td>
<td><input type="text" name="field19"  /></td>
<td><input type="text" name="field20" /></td>
<td><input type="text" name="field21" /></td>
<td><input type="text" name="field22"  /></td>
<td><input type="text" name="field23"  /></td>
<td><input type="text" name="field24" /></td>
<td><input type="text" name="field25" /></td>
<td><input type="text" name="field26"  /></td>
<td><input type="text" name="field27"  /></td>
<td><input type="text" name="field28" /></td>
<td><input type="text" name="field29" /></td>
<td><input type="text" name="field30" /></td>
<td><input type="text" name="field31"  /></td>
<td><input type="text" name="field32" /></td>
<td><input type="text" name="field33"  /></td>
<td><input type="text" name="field34" /></td>
<td><input type="text" name="field35" /></td>
<td><input type="text" name="field36"  /></td>

<!--<td><input name="sessionID" value="" /></td>-->

</tr>
</table>
<div>
  <div align="center">
    <input name="submit" type="submit" id="submit" value="添加" style=" width:100px; margin-top:50px; " onClick="return checkData()" />
  </div>
</div>
</form>
</div>
</div>
</body>
</html>

<?php


       if(isset($_POST['submit'])){
		   $IDNumber=trim($_POST[field7]);
		   $salaryNO=trim($_POST[field28]);
		 $insertsql="insert into workerInfo set  field0='$_POST[field0]',field1='$_POST[field1]',field2='$_POST[field2]',
                                                 field3='$_POST[field3]',field4='$_POST[field4]',field5='$_POST[field5]',
                                                 field6='$_POST[field6]',field7='$IDNumber',field8='$_POST[field8]',
                                                 field9='$_POST[field9]',field10='$_POST[field10]',field11='$_POST[field11]',
												 field12='$_POST[field12]',field13='$_POST[field13]',field14='$_POST[field14]',field15='$_POST[field15]',field16='$_POST[field16]',
                                                 field17='$_POST[field17]',field18='$_POST[field18]',field19='$_POST[field19]',
                                                 field20='$_POST[field20]',field21='$_POST[field21]',field22='$_POST[field22]',
                                                 field23='$_POST[field23]',field24='$_POST[field24]',field25='$_POST[field25]',
												 field26='$_POST[field26]',field27='$_POST[field27]',field28='$salaryNO',field29='$_POST[field29]',field30='$_POST[field30]',
                                                 field31='$_POST[field31]',field32='$_POST[field32]',field33='$_POST[field33]',
                                                 field34='$_POST[field34]',field35='$_POST[field35]',field36='$_POST[field36]',sessionID='$_SESSION[UserID]'";
           $ret=mysql_query( $insertsql);  
		      if($ret){
            echo "<p align=center style='font-size:15px; color:red'>成功添加到表workInfo</p>";}
			else{
			  echo "<p align=center style='font-size:15px; color:red'>添加数据错误(提示:1.添加的此人已存在 2.工资账号重复3.身份证号码重复)</p>";}
			}
	}
   ?>
</div>
</body>
</html> 