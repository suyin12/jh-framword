<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
include_once ("../settings.inc");
$judgeSql="select * from cwps_user where UserID='$_SESSION[UserID]'";
$judgeRet=mysql_query($judgeSql);
$judgeRow=mysql_fetch_array($judgeRet);
//$subGroupID=trim($judgeRow['SubGroupIDs'],',');
$roleID=$judgeRow['RoleID'];
	if($_SESSION['Cqyyh']!=13||$roleID!=31)
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为社保专员专属,欲申报社会保险/商业保险请联系社保专员</p>";
	}
	else{
$IDNumber=$_GET[IDNumber];
$sql="select a.*,b.field6,b.field7,b.field24 from declareInjury a,workerInfo b where a.IDNumber='$IDNumber' AND b.field7='$IDNumber'";
$sql2="select a.*,b.field6,b.field7,b.field24 from bussiness a,workerInfo b where a.IDNumber='$IDNumber' AND b.field7='$IDNumber'";
$result=mysql_query($sql);
$aff=mysql_affected_rows();

$result2=mysql_query($sql2);
$aff2=mysql_affected_rows();

$row=mysql_fetch_array($result);
$row2=mysql_fetch_array($result2);

?>
   
   <style type="text/css">
       body {
font: normal 12px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
color: #4f6b72;
}
p{color:bule;font: bold 15px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
table{font-size:12px;}
   </style>
   <script type="text/javascript">
   </script>
</head>
<body>
<div style="float: right;font-size:20px"><a href='declareManage.php'>返回申报管理界面</a></div>
<p>社会保险申报及更新</p>
<form id="form1" name="form1" action="" method="post">
<select name='sel1' class="sub">
       <option value="交通事故" <?php if($_POST[sel1]=="交通事故") echo "SELECTED";?>>交通事故</option>
       <option value="意外事故" <?php if($_POST[sel1]=="意外事故") echo "SELECTED";?>>意外事故</option>
</select> 
申报进度:
<select name='sel2' class="sub">
       <option value="工伤认定申请资料" <?php if($_POST[sel2]=="工伤认定申请资料") echo "SELECTED";?>>工伤认定申请资料</option>
       <option value="网上申报" <?php if($_POST[sel2]=="网上申报") echo "SELECTED";?>>网上申报</option>
       <option value="窗口受理" <?php if($_POST[sel2]=="窗口受理") echo "SELECTED";?>>窗口受理</option>
       <option value="资料审核" <?php if($_POST[sel2]=="资料审核") echo "SELECTED";?>>资料审核</option>
       <option value="认定书下达" <?php if($_POST[sel2]=="认定书下达") echo "SELECTED";?>>认定书下达</option>
       <option value="治疗结束，办理费用报销" <?php if($_POST[sel2]=="治疗结束，办理费用报销") echo "SELECTED";?>>治疗结束，办理费用报销</option>
       <option value="结案" <?php if($_POST[sel2]=="结案") echo "SELECTED";?>>结案</option>
</select>
备注:
<input type="text" name="Content1" value=""/>
<input type="submit"  id="submit1" name="submit1" value="申报/更新" onClick="if(!confirm('确定申报/更新吗??')){return false;}"/>
</form>
<?php 

if($aff!=0){
       if(isset($_POST['submit1'])){
   $updatesql="update declareInjury set  InjuryType='社会保险',Type2='$_POST[sel1]',
                                         Schedule='$_POST[sel2]',Content='$_POST[Content1]'
                                   where IDNumber='$IDNumber'";
    $ret=mysql_query($updatesql);
    $affect=mysql_affected_rows();
    if($affect)
    {
      echo '<script language=javascript>window.alert(\'社会保险申报进度更新成功\')</script>';    
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";    
    }
    }
}
else {
if(isset($_POST['submit1']))
{
    $today =date('Ymd');
    $insertsql="insert into declareInjury set IDNumber='$IDNumber',InjuryType='社会保险',
                                              Type2='$_POST[sel1]',Schedule='$_POST[sel2]',
                                              Content='$_POST[Content1]',declareDate='$today'";
    mysql_query($insertsql);
    $affect=mysql_affected_rows();
    if($affect=!0)
    {
        
       echo '<script language=javascript>window.alert(\' 社会保险申报成功!!\')</script>';
       echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";   
    }
    
}
}
?>
<div>
<form action="" method="post">
<table id="displayTable" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA">
<th>姓名</th>
<th>身份证号码</th>
<th>社保号</th>
<th>保险类型</th>
<th>事故类型</th>
<th>申报进度</th>
<th>申报时间</th>
<th>申报备注</th>
<th>操作</th>
</tr>
</thead>
<?php 
if($aff){
?>
<tbody>
<tr bgcolor="#ffffff">
<td><?php echo $row['field6']; ?></td>
<td><?php echo $row['field7']; ?></td>
<td><?php echo $row['field24']; ?></td>
<td><?php echo $row['InjuryType']; ?></td>
<td><?php echo $row['Type2']; ?></td>
<td><?php echo $row['Schedule']; ?></td>
<td><?php echo $row['declareDate']; ?></td>
<td><?php echo $row['Content']; ?></td>
<td><input type='submit' value='删除' name='delete1' id='delete1'/></td>
</tr>
</tbody>
<?php 
}
?>
</table>
</form>
</div>
<p style="margin-top:100px; ">商业保险申报及更新</p>
<form id="form2" name="form2" action="" method="post">
申报进度:
<select name='sel3' class="sub">
       <option value="事故登记" <?php if($_POST[sel3]=="事故登记") echo "SELECTED";?>>事故登记</option>
       <option value="治疗期结束，递交相关申报资料" <?php if($_POST[sel3]=="治疗期结束，递交相关申报资料") echo "SELECTED";?>>治疗期结束，递交相关申报资料</option>
       <option value="审批通过，保险公司赔付相关费用" <?php if($_POST[sel3]=="审批通过，保险公司赔付相关费用") echo "SELECTED";?>>审批通过，保险公司赔付相关费用</option>
       <option value="结案" <?php if($_POST[sel3]=="结案") echo "SELECTED";?>>结案</option>
</select>
备注:
<input type="text" name="Content2" value=""/>
<input type="submit"  id="submit1" name="submit2" value="申报/更新" onClick="if(!confirm('确定申报/更新吗??')){return false;}"/>
</form>
<?php 
if($aff2){
       if(isset($_POST['submit2'])){
   $updatesql="update bussiness set  InjuryType='商业保险',Schedule='$_POST[sel3]',Content='$_POST[Content2]'
                                   where IDNumber='$IDNumber'";
    $ret=mysql_query($updatesql);
    $affect2=mysql_affected_rows();
    if($affect2)
    {
      echo '<script language=javascript>window.alert(\'商业保险申报进度更新成功\')</script>';    
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";    
    }
    }
}
else {
if(isset($_POST['submit2']))
{
    $today =date('Ymd');
    $insertsql="insert into bussiness set IDNumber='$IDNumber',InjuryType='商业保险',
                                              Schedule='$_POST[sel3]',
                                              Content='$_POST[Content]',declareDate='$today'";
    mysql_query($insertsql);
    $affect2=mysql_affected_rows();
    if($affect2=!0)
    {
        
       echo '<script language=javascript>window.alert(\'商业保险申报成功!!\')</script>';
       echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";   
    }
    
}
}
?>
<div>
<form action="" method="post">
<table id="displayTable" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA">
<th>姓名</th>
<th>身份证号码</th>
<th>保险类型</th>
<th>申报进度</th>
<th>申报时间</th>
<th>申报备注</th>
<th>操作</th>
</tr>
</thead>
<?php 
if($aff2){
?>
<tbody>
<tr bgcolor="#ffffff">
<td><?php echo $row2['field6']; ?></td>
<td><?php echo $row2['field7']; ?></td>
<td><?php echo $row2['InjuryType']; ?></td>
<td><?php echo $row2['Schedule']; ?></td>
<td><?php echo $row2['declareDate']; ?></td>
<td><?php echo $row2['Content']; ?></td>
<td><input type='submit' value='删除' name='delete2' id='delete2' /></td>
</tr>
</tbody>
<?php 
}
?>
</table>
</form>
</div>
<?php 
 if(isset($_POST['delete1'])){
   $deletesql="delete from declareInjury where IDNumber='$IDNumber'";
    $deleteret=mysql_query($deletesql);
    $deleteaffect1=mysql_affected_rows();
    if($deleteaffect1)
    {
      echo '<script language=javascript>window.alert(\'社会保险申报记录删除成功\')</script>';    
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";    
    }
    }
    
    if(isset($_POST['delete2'])){
   $deletesql2="delete from bussiness where IDNumber='$IDNumber'";
    $deleteret2=mysql_query($deletesql2);
    $deleteaffect2=mysql_affected_rows();
    if($deleteaffect2)
    {
      echo '<script language=javascript>window.alert(\'商业保险申报记录删除成功\')</script>';    
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";    
    }
    }
?>
</body>
</html>
<?
}
?>
</div>
</body>
</html>