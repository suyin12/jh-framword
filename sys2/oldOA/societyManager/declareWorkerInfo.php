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
$judgeRow=mysql_fetch_array($judgeRet);
//$subGroupID=trim($judgeRow['SubGroupIDs'],',');
$roleID=$judgeRow['RoleID'];
	if($_SESSION['Cqyyh']!=13||$roleID!=31)
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为社保专员专属,欲申报社会保险/商业保险请联系社保专员</p>";
	}
	else{
	
	?>
		<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
<!--	<link href="../css/main.css" rel="stylesheet" />-->
		
     <script language=javascript>

     //分页控制
     // window.onload = function(){
 		//page = new Page(15,'displayTable','displaybody'); };
 		
		$(function() {
			$("table")
				.tablesorter({widthFixed: true})
				.tablesorterPager({container: $("#pager")});
		});
	

 		//查询条件控制
		function checkData()
		{
		    if(document.form1.db_field.value.length==0)
		    {
		    	alert("请选择查询条件!");
			     document.form1.searchtxt.focus();
			     return false;
			    }
		}
		</script>
	 <style type="text/css">
body {
font: normal 12px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
color: #4f6b72;
}
p{color:bule;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
table{font-size:12px;}
</style>
</head>
		
	<body text="#000000" link="#000000" vlink="#000000" alink="#000000" topmargin="0" leftmargin="2" marginwidth="0" marginheight="0">

	
	<div id="headindex">
	 您现在的位置是:社保/商保申请><a href="fixedWorker.php">员工信息的查询及申报</a>
	 </div>
				
		
	<form name="form1" method="post" action="">	
	<div id="searchCondition">
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
	
	 <input name="searchtxt" type="text" value="<?php echo $_POST[searchtxt];?>"/>
	<input name="search" value="查询" type="submit" onClick="return checkData()" />
	
	</div>

		<?php		
//		require("../settings.inc");
	 if(isset($_POST['search'])){
		 	$searchsql="select * from workerInfo where $_POST[db_field] like '%$_POST[searchtxt]%' order by ID ASC";  
		    $strsql="select * from workerInfo order by ID ASC";  
		    if($_POST[db_field]!="")
		    {
			    $result=mysql_db_query($db_name, $searchsql, $db_con);			     
             }
		    else
		    {
		    $result=mysql_db_query($db_name, $strsql, $db_con);
		   
		    } 
		    $count=mysql_num_rows($result);
	  }
	
		?>
		

		<table id="displayTable" width="4000" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		<thead>
		<tr bgcolor="#CAE8EA">
		<th ><strong>编号</strong></th>
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
		<th>操作</th>		
		</tr>
		</thead>
		<tbody id="displaybody">
		<?php
		if($result){
		while($rows=mysql_fetch_array($result)){
		   
		?>
		
		<tr bgcolor=#ffffff>
		<td ><? echo $rows['ID']; ?></td>
		<td ><? echo $rows['field0']; ?></td>
		<td ><? echo $rows['field1']; ?></td>
		<td ><? echo $rows['field2']; ?></td>
		<td ><? echo $rows['field3']; ?></td>
		<td ><? echo $rows['field4']; ?></td>
		<td ><? echo $rows['field5']; ?></td>
		<td class="edit"><a href='declarePersonalManage.php<? echo "?"; ?>sessionID=<?php echo $rows['sessionID'];?>&IDNumber=<?php echo $rows['field7'];?>'><? echo $rows['field6']; ?></a></td>
		<td ><? echo $rows['field7']; ?></td>
	    <td ><? echo $rows['field8']; ?></td>
		<td ><? echo $rows['field9']; ?></td>
		<td><? echo $rows['field10']; ?></td>
		<td><? echo $rows['field11']; ?></td>
		<td><? echo $rows['field12']; ?></td>
		<td><? echo $rows['field13']; ?></td>
		<td ><? echo $rows['field14']; ?></td>
	    <td ><? echo $rows['field15']; ?></td>
		<td ><? echo $rows['field16']; ?></td>
		<td><? echo $rows['field17']; ?></td>
		<td><? echo $rows['field18']; ?></td>
		<td><? echo $rows['field19']; ?></td>
		<td><? echo $rows['field20']; ?></td>
		<td ><? echo $rows['field21']; ?></td>
	    <td ><? echo $rows['field22']; ?></td>
		<td ><? echo $rows['field23']; ?></td>
		<td><? echo $rows['field24']; ?></td>
		<td><? echo $rows['field25']; ?></td>
		<td><? echo $rows['field26']; ?></td>
		<td><? echo $rows['field27']; ?></td>
		<td ><? echo $rows['field28']; ?></td>
	    <td ><? echo $rows['field29']; ?></td>
		<td ><? echo $rows['field30']; ?></td>
		<td><? echo $rows['field31']; ?></td>
		<td><? echo $rows['field32']; ?></td>
		<td><? echo $rows['field33']; ?></td>
		<td><? echo $rows['field34']; ?></td>	
		<td><? echo $rows['field35']; ?></td>
		<td><? echo $rows['field36']; ?></td>	
		<td class="edit"><a href='declarePersonalManage.php<? echo "?"; ?>sessionID=<?php echo $rows['sessionID'];?>&IDNumber=<?php echo $rows['field7'];?>'>申报/进度更新</a></td>
		
		</tr>
		<?php
		}
		}
		?>
		</tbody>
		</table>
		<div id="foot">
	 	</form>
		
	<div id="pager" class="pager" style="margin-top:3px;float:right">
	<form>
		<img src="../css/images/first.png" class="first"/>
		<img src="../css/images/prev.png" class="prev"/>
		<input type="text" class="pagedisplay" style="width:45px;background:transparent;border:0;text-align:center"/>
		<img src="../css/images/next.png" class="next"/>
		<img src="../css/images/last.png" class="last"/>
		<select class="pagesize">
			<option   value="5">5</option>
			<option  value="10">10</option>
			<option selected="selected" value="15">15</option>
			<option  value="20">20</option>
		</select>
	</form>
</div>
</div>
		</body>
	    </html>
	   <?
   }
	   ?>
	   </div>
       </body>
       </html>