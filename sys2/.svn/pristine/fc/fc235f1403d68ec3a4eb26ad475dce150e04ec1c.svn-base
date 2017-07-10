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
	include_once '../settings.inc';
	if (!$db_con) { echo("ERROR: " . mysql_error() . "\n");	}
	$editID=$_GET[editId];
	$sessionID=$_GET[sessionID];
	if($sessionID!=$_SESSION[UserID])
	{
	  echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为客户经理专属,欲更改其数据请联系客户经理</p>";
	}
	else
	{
?>

   <link href="../css/main.css" type="text/css" rel="stylesheet" />
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
<div id="headindex" style="margin-top:-20px;">
您现在的位置是:员工信息管理->信息更新</a>
</div>
<p align="center" >提示:用鼠标左击选择表中要更新的项<p>
<?
	# processed when form is submitted back onto itself
	if (isset($_POST[submit])) 
	{            $IDNumber=trim($_POST[field7]);
		   $salaryNO=trim($_POST[field28]);
              $updateSQL="update workerInfo set  field0='$_POST[field0]',field1='$_POST[field1]',field2='$_POST[field2]',
                                                 field3='$_POST[field3]',field4='$_POST[field4]',field5='$_POST[field5]',
                                                 field6='$_POST[field6]',field7='$IDNumber',field8='$_POST[field8]',
                                                 field9='$_POST[field9]',field10='$_POST[field10]',field11='$_POST[field11]',
												 field12='$_POST[field12]',field13='$_POST[field13]',field14='$_POST[field14]',field15='$_POST[field15]',field16='$_POST[field16]',
                                                 field17='$_POST[field17]',field18='$_POST[field18]',field19='$_POST[field19]',
                                                 field20='$_POST[field20]',field21='$_POST[field21]',field22='$_POST[field22]',
                                                 field23='$_POST[field23]',field24='$_POST[field24]',field25='$_POST[field25]',
												 field26='$_POST[field26]',field27='$_POST[field27]',field28='$salaryNO',field29='$_POST[field29]',field30='$_POST[field30]',
                                                 field31='$_POST[field31]',field32='$_POST[field32]',field33='$_POST[field33]',
                                                 field34='$_POST[field34]',field35='$_POST[field35]',field36='$_POST[field36]'
												 where ID='$_POST[ID]' AND sessionID='$_SESSION[UserID]'";
		# execute SQL statement
	   $result = mysql_query($updateSQL);
       $ttt=mysql_affected_rows();
		# check for errors
		if (!$result) 
		{ 
		 echo "<p align=center style='font-size:15px; color:red'>更新数据错误(提示:1.工资账号与他人重复2.身份证号码与他人重复3.其他情况)</p>";
		echo("ERROR: " . mysql_error() . "\n$updateSQL\n");	
		}
		else{
		if ($ttt!=0) {
		 echo "<p align=center style='font-size:15px; color:red'>成功更新到表workInfo</p>";
		              }
			else{ echo "<p align=center style='font-size:15px; color:red'>更新数据错误(提示:1.工资账号与他人重复2.身份证号码与他人重复3.未进行任何数据修改 4.其他情况)</p>";}
			}
	}
	else { 
		$SQL = "SELECT * FROM workerInfo WHERE ID = $editID AND sessionID='$_SESSION[UserID]' ";
		# execute SQL statement
		$ret = mysql_query($SQL);
		//
		if(!$ret){echo "出错啦!!";}
		# retrieve values
		$row = mysql_fetch_array($ret);
		
?>
<table id="insertTable">
<tr><td>
<FORM NAME="editForm" ACTION="" METHOD="POST" >
<table width="100%" id="wokerBasicTable" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666" width="100%" >
 <tr bgcolor="#CAE8EA">
    <td class="th" width="62" >姓名</td>
    <td class="td" width="70"><input type="text" name="field6" value="<? echo $row['field6']; ?>"  /></td>
    <td class="th" width="39">性别</td>
    <td class="td" width="35"><input type="text" name="field8" value="<? echo $row['field8']; ?>"  /></td>
    <td class="th" width="54">民族</td>
    <td class="td" width="50"><input type="text" name="field9" value="<? echo $row['field9']; ?>"  /></td>
    <td class="th" width="62">籍贯</td>
    <td class="td" width="50"><input type="text" name="field12" value="<? echo $row['field12']; ?>"  /></td>
    <td class="th" width="72">户口所在地</td>
    <td class="td" colspan="3"><input type="text" name="field14" value="<? echo $row['field14']; ?>"  /></td>
    <td class="th" width="82">户籍类型</td>
    <td class="td" ><input type="text" name="field13" value="<? echo $row['field13']; ?>"  /></td>
    <td class="th" >婚姻状况</td>
    <td class="td" width="46"><input type="text" name="field11" value="<? echo $row['field11']; ?>"  /></td>
  </tr>
  <tr bgcolor="#CAE8EA">
    <td class="th" >固定电话</td>
    <td class="td" colspan="3"><input type="text" name="field16" value="<? echo $row['field16']; ?>"  /></td>
    <td class="th" >移动电话</td>
    <td class="td" colspan="3"><input type="text" name="field17" value="<? echo $row['field17']; ?>"  /></td>
    <td class="th">身份证地址</td>
    <td class="td" colspan="3"><input type="text" name="field15" value="<? echo $row['field15']; ?>"  /></td>
    <td class="th">身份证编号</td>
    <td class="td" colspan="5"><input type="text" name="field7" value="<? echo $row['field7']; ?>"  /></td>
  </tr>
  <tr bgcolor="#CAE8EA">
  <td class="th">毕业学校</td>
  <td class="td"><input type="text" name="field22" value="<? echo $row['field22']; ?>"  /></td>
  <td class="th">专业</td>
  <td class="td"><input type="text" name="field23" value="<? echo $row['field23']; ?>"  /></td>
  <td class="th" >文化程度</td>
  <td class="td"><input type="text" name="field21" value="<? echo $row['field21']; ?>"  /></td>
   <td class="th">政治面貌</td>
  <td class="td"><input type="text" name="field10" value="<? echo $row['field10']; ?>"  /></td>
  <td class="th">联系人</td>
  <td class="td" width="64"><input type="text" name="field18" value="<? echo $row['field18']; ?>"  /></td>
  <td class="th" width="99">与联系人关系</td>
  <td class="td" width="48"><input type="text" name="field19" value="<? echo $row['field19']; ?>"  /></td>
  <td class="th">联系人电话</td>
  <td class="td" colspan="3"><input type="text" name="field20" value="<? echo $row['field20']; ?>"  /></td>
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
		<td><input type="text" name="field24" value="<? echo $row['field24']; ?>" /></td>
<td><input type="text" name="field25" value="<? echo $row['field25']; ?>" /></td>
<td><input type="text" name="field26" value="<? echo $row['field26']; ?>" /></td>
<td><input type="text" name="field27" value="<? echo $row['field27']; ?>" /></td>
<td width="150"><input type="text" name="field28" value="<? echo $row['field28']; ?>" /></td>
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
		<td><input type="text" name="field0" value="<? echo $row['field0']; ?>" /></td>
		<td><input type="text" name="field1" value="<? echo $row['field1']; ?>" /></td>
		<td><input type="text" name="field2" value="<? echo $row['field2']; ?>" /></td>
		<td><input type="text" name="field3" value="<? echo $row['field3']; ?>"  /></td>
		<td><input type="text" name="field4" value="<? echo $row['field4']; ?>"  /></td>
		<td><input type="text" name="field5" value="<? echo $row['field5']; ?>"  /></td>
		<td><input type="text" name="field29" value="<? echo $row['field29']; ?>" /></td>
		<td><input type="text" name="field30" value="<? echo $row['field30']; ?>" /></td>
		<td><input type="text" name="field31" value="<? echo $row['field31']; ?>" /></td>
		<td><input type="text" name="field32" value="<? echo $row['field32']; ?>" /></td>
		<td><input type="text" name="field33" value="<? echo $row['field33']; ?>" /></td>
		<td><input type="text" name="field34" value="<? echo $row['field34']; ?>"/></td>
		<td><input type="text" name="field35" value="<? echo $row['field35']; ?>"/></td>
		<td><input type="text" name="field36" value="<? echo $row['field36']; ?>" /></td>
		</tr>
		</tbody>	
		</table>
<input type="hidden" name="ID" value="<?php echo $row['ID']?>" />
<div align="center">
<INPUT TYPE="submit" name="submit" VALUE="更新" onClick="if(!confirm('确定更新吗?')) { return false;}" style=" width:100px; margin-top:50px; ">
</div>
</FORM>
</td>
</tr>
</table>
<?php
}

mysql_close($db_con);
?>
</body>
</HTML>
<?
}
?>
</div>
</body>
</html>