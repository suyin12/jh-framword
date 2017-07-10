<?php 
$tableName=$_POST['tableName'];
$month2=$_POST['month2'];
$manager=$_POST['manager'];
$currentPage=$_POST['currentPage'];
$sessionID=$_GET['manager'];
?>

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.mypagination.js"></script>

<script type="text/javascript">
$(document).ready( function(){
//选择项
$("form select").change(
		function(){
			if($(".tableName").val()==0)
			{
				alert('请选择要查看的费用明细表');
			}
			if($(this).attr('name')=="manager"&& $(".month2").val()==0)
			{
				alert("请选择月份");
			}
			if($(".tableName").val()!=0&&$(".month2").val()!=0)
			{
		    $("input[name=currentPage]").val(1);
			$("#balDataForm").submit();
			}
			if($(".tableName").val()=="so_bal_2")
			{
				$(".manager").attr("disabled",true);
				
			}
			else
			{
				$(".manager").attr("disabled",false);
				}
		});

//分页
$("input[name=currentPage]").change(
		function(){
		$("#balDataForm").submit();
		}
		);

$('.pageBtn').click(function(){
	$("input[name=currentPage]").val($(this).attr("title"));
	$("#balDataForm").submit();
});

});


</script>






<div id="dataTable">

<form action="" id="balDataForm" method="post">
<div>
<p>管理工资/社保费用明细表:</p>

工资/社保费用明细表:<select class="tableName" name="tableName">
<option value="">---请选择---</option>
<option value="so_bal_1" <?php if($_POST['tableName']=="so_bal_1") echo "SELECTED";?>>工资费用明细表</option>
<option value="so_bal_2" <?php if($_POST['tableName']=="so_bal_2") echo "SELECTED";?>>社保费用明细表</option>
</select>

月份:<select class="month2" name="month2">
<option value="" selected>--请选择--</option>
<?php for($i=1;$i<=12;$i++){
if($i<10){$k="0".$i;}else {$k=$i;}
    ?>
<option value="<?php echo $todayY.$k;?>" <?php if($_POST['month2']==$todayY.$k) echo "SELECTED";?>><?php echo $todayY."年".$k."月" ?></option>
<?php }?>
</select>
<?php if($tableName!="so_bal_2")
{
?>
客户经理:<select class="manager" name="manager">
	<option value="" <?php if($_POST['manager']=="") echo "SELECTED";?>>--请选择--</option>
	<?php 
	$managerSql="select * from cwps_user where SubGroupIDs=',14,'";
    $managerRet=mysql_query($managerSql);
	while ($managerRow=@mysql_fetch_array($managerRet))
	{
	?>
	<option value="<?php echo $managerRow['UserID'];?>"<?php if($_POST['manager']==$managerRow['UserID']) echo "SELECTED";?>><?php echo $managerRow['UserName'];?></option>
	<?php 
	}
	?>
	</select>
<?php 
}
else 
{
    $manager="";
}
?>
</div>




<?php
if($manager!="")
{
$sql="select * from $tableName where month='$month2' and sessionID='$manager'";
}
else 
{
    //这部分暂时还是已导入的费用明细表的电脑号为准,不已花名册的信息为准
  $sql="select * from $tableName where month='$month2'";  
}
require_once '../pagenation.js.php';
$mypage = new Pagination();//使用分页类
 $mypage->page=$currentPage;//设置当前页
$mypage->pagesize=20;//每页多少条记录
$mypage->count=@mysql_num_rows(mysql_query($sql));//获取并设置数据库总记录数
//echo "共有".$mypage->GetPages()."页记录<br/>";//输出有多少页
$r_sql = $sql.$mypage->get_limit();//分页条件查询
$ret = mysql_query($r_sql);
if($_POST['tableName']=='so_bal_1')
{
?>
<table id="displayTable" width="95%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
	<tr bgcolor="#CAE8EA" style="text-align:center;">
    <td rowspan="2">批次</td>
    <td rowspan="2">月份</td>
    <td rowspan="2">单位名称</td>
    <td rowspan="2">姓名</td>
    <td rowspan="2">电脑号</td>
    <td rowspan="2">是否深户</td>
    <td rowspan="2">缴交基数</td>
    <td colspan="2">养老保险</td>
    <td colspan="2">医疗保险</td>
    <td rowspan="2">工伤保险</td>
    <td rowspan="2">失业保险</td>
    <td rowspan="2">生育保险</td>
    <td rowspan="2">住房公积金</td>
    <td colspan="2">社保合计</td>
    <td rowspan="2">残障金</td>
    <td colspan="2">收回单位欠款</td>
    <td colspan="2">挂帐</td>
    <td rowspan="2">冲减挂帐</td>
  </tr>
  <tr bgcolor="#CAE8EA" style="text-align:center;">
    <td>单位</td>
    <td>个人</td>
    <td>单位</td>
    <td>个人</td>
    <td>单位社保</td>
    <td>个人社保</td>
    <td>单位</td>
    <td>个人</td>
    <td>单位</td>
    <td>个人</td>
  </tr>
</thead>
<tbody>
<?php 
while ($row=@mysql_fetch_array($ret))
{
?>
<tr bgcolor="#ffffff">
<td><?php echo $row['field0']?></td>
<td><?php echo $row['field1']?></td>
<td><?php echo $row['field2']?></td>
<td><?php echo $row['field3']?></td>
<td><?php echo $row['field4']?></td>
<td><?php echo $row['field5']?></td>
<td><?php echo $row['field6']?></td>
<td><?php echo $row['field7']?></td>
<td><?php echo $row['field8']?></td>
<td><?php echo $row['field9']?></td>
<td><?php echo $row['field10']?></td>
</tr>
<?php 
}
?>
</tbody>
</table>
<?php 
}
if($_POST['tableName']=='so_bal_2')
{
?>
<table id="displayTable" width="95%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
	<tr bgcolor="#CAE8EA" style="text-align:center;">
    <td rowspan="2">个人编号</td>
    <td rowspan="2">姓名</td>
    <td rowspan="2">工资</td>
    <td rowspan="2">应收合计</td>
    <td height="25" colspan="2">应收金额</td>
    <td colspan="2">养老保险</td>
    <td>住房公积金</td>
    <td colspan="2">医疗保险</td>
    <td>工伤保险</td>
    <td>失业保险</td>
    <td>生育保险</td>
  </tr>
  <tr bgcolor="#CAE8EA" style="text-align:center;">
    <td height="27">个人合计</td>
    <td>单位合计</td>
    <td>个人交</td>
    <td>单位交</td>
    <td>单位交</td>
    <td>个人交</td>
    <td>单位交</td>
    <td>单位交</td>
    <td>单位交</td>
    <td>单位交</td>
  </tr>
  </thead>
  <tbody>
<?php 
while ($row=@mysql_fetch_array($ret))
{
?>
<tr bgcolor="#ffffff">
<td><?php echo $row['field0']?></td>
<td><?php echo $row['field1']?></td>
<td><?php echo $row['field2']?></td>
<td><?php echo $row['field3']?></td>
<td><?php echo $row['field4']?></td>
<td><?php echo $row['field5']?></td>
<td><?php echo $row['field6']?></td>
<td><?php echo $row['field7']?></td>
<td><?php echo $row['field8']?></td>
<td><?php echo $row['field9']?></td>
<td><?php echo $row['field10']?></td>
</tr>
<?php 
}
?>
</tbody>
</table>
<?php 
}
$mypage->page_list();
?>
</form>
</div>
</body>
</html>