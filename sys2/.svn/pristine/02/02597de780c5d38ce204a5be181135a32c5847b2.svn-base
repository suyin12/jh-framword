<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
  
<?php
include_once '../settings.inc';
$searchsql="select a.applyDate,b.field6,b.field7,b.field0,b.field3,b.field4,b.field5,b.field32,b.field28 from contractApply a,workerInfo b where a.IDNumber=b.field7";
$result=mysql_query($searchsql);
?>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="../skin/pale_blue_skin/Js/jquery.js"></script>
		<script type="text/javascript" src="../skin/pale_blue_skin/Js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../skin/pale_blue_skin/Js/jquery.tablesorter.pager.js"></script>
		<link href="../skin/pale_blue_skin/css/fixedKHJL.css" rel="stylesheet" />
 <script language=javascript>
     //分页控制,排序控制
				//window.onload = function(){
				//page = new Page(15,'displayTable','displaybody'); };
		$(function() {
				$("table")
					.tablesorter({widthFixed: true})
					.tablesorterPager({container: $("#pager")});
			});
</script>
<style>
body {
font: normal 12px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
color: #4f6b72;
}
p{color:bule;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
table{font-size:12px;}
td.edit{
background-color: #99CCCC;

color:#000000;
}
a:link {
	color: #3366CC;
}
a:visited {
	color: #3366CC;
}
a:hover {
	color: #3366CC;
}
a:active {
	color: #3366CC;
}
</style>
</head>
<body text="#000000" link="#000000" vlink="#000000" alink="#000000" topmargin="0" leftmargin="2" marginwidth="0" marginheight="0">
<div id="headindex">
您现在的位置是:员工信息管理-><a href="applyManage.php">员工申请续签信息</a>
</div>
<p>提示:不完全信息板块,目前只提供员工续签的申请记录.当然,如果需要的话,还可以添加相应的信息管理功能,包括处理续签等!!</p>
	<table id="displayTable" width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
		<thead>
		<tr bgcolor="#CAE8EA">
		<td><strong>申请日期</strong></td>
		<td><strong>申请人</strong></td>
		<td><strong>身份证编号</strong></td>
		<td><strong>档案编号</strong></td>
		<td><strong>单位名称</strong></td>
		<td><strong>部门名称</strong></td>
		<td><strong>岗位</strong></td>
		<td><strong>合同终止日期</strong></td>
		</tr>
		</thead>
		<tbody id="displaybody">
		<?php
		if($result){
		while($rows=mysql_fetch_array($result)){
		   
		?>
		
		<tr bgcolor="#ffffff">
		<td ><? echo $rows['applyDate']; ?></td>
		<td class="edit" ><a href='workerInfo.php<? echo "?"; ?>IDNumber=<?php echo $rows['field7'];?>'><? echo $rows['field6']; ?></a></td>
		<td ><? echo $rows['field7']; ?></td>
		<td ><? echo $rows['field0']; ?></td>
		<td ><? echo $rows['field3']; ?></td>
		<td ><? echo $rows['field4']; ?></td>
		<td ><? echo $rows['field5']; ?></td>
		<td ><? echo $rows['field32']; ?></td>	
		</tr>
		<?php
		}
		}
		?>
		</tbody>
		</table>
<div id="pager" class="pager" style="margin-top:5px;float:right">
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
</body>
</html>
</div>
</body>
</html>