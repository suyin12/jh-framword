<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
 require_once '../header/managerHeader.php';
    if(!defined('ALLOW'))exit();
include_once ("../settings.inc");
	?>
<body>

<script language='JavaScript'>

function checkData()
{
	if(document.insertform.db_table.value.length==0){
	     alert("请选择月份!");
	     document.insertform.db_table.focus();
	     return false;
	    }
		if(document.insertform.field1.value.length==0){
	     alert("单位名称不能为空!");
	     document.insertform.field1.focus();
	     return false;
	    }
	if(document.insertform.field2.value.length==0){
	     alert("部门名称不能为空!");
	     document.insertform.field2.focus();
	     return false;
	    }
	  
	
		if(document.insertform.field3.value.length==0) {
			alert("姓名不能为空!");
			document.insertform.field3.focus();
			return false;
		}
		
		if(document.insertform.field4.value.length==0) {
			alert("工资账号不能为空");
			document.insertform.field4.focus();
			return false;
		}
		if(document.insertform.field5.value.length==0) {
			alert("应发工资不能为空");
			document.insertform.field5.focus();
			return false;
		}
	//	if(document.insertform.field6.value.length==0) {
//			alert("");
//			document.insertform.field6.focus();
//			return false;
//		}
//		if(document.insertform.field7.value.length==0) {
//			alert("文本框不能为空");
//			document.insertform.field7.focus();
//			return false;
//		}
//		if(document.insertform.field7.value.length==0) {
//			alert("文本框不能为空");
//			document.insertform.field7.focus();
//			return false;
//		}
	//	if(document.insertform.field8.value.length==0) {
//			alert("扣款合计不能为空");
//			document.insertform.field8.focus();
//			return false;
//		}
		
		if(document.insertform.field11.value==0) {
			alert("实发金额不能为空");
           document.insertform.field11.focus();
			return false;
		} 

}
</script>
<body>

<div id="headindex">
您现在的位置是:工资管理-><a href="singleInsert.php">单条添加</a>
</div>


	 
<form action="" method="post" name="insertform" width="780px">
<div>
<div style=" float:right; margin-bottom:20px; margin-right:200px;">
  提示:1.选择要添加的月份&nbsp;&nbsp;&nbsp;&nbsp;2.用鼠标左击选择表中要更新的项
  </div>
<div id="searchCondition">
请选择月份:<select name="db_table" >
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
  </div>  
  </div>
<table id="insertTable"  width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666" >
<thead>
		<tr bgcolor="#CAE8EA">
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
		<th ><strong>房屋水电</strong></th>
		
		<th><strong>其他</strong></th>
		<th><strong>扣款合计</strong></th>
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

<!--<td><input name="sessionID" value="" /></td>-->

</tr>
</table>
<div>
  <div align="center">
    <input name="submit" type="submit" id="submit" value="添加" style=" width:100px; margin-top:50px; " onClick="return checkData()" />
  </div>
</div>
</form>

</body>
</html>

<?php




if($_POST[db_table]!="")
   {
       $salaryNO=trim($_POST[field4]);
	   //echo "dfadfa=".$salaryNO."=";
    $insertsql="insert into $_POST[db_table] set field0='$_POST[field0]',field1='$_POST[field1]',field2='$_POST[field2]',
                                                 field3='$_POST[field3]',field4=$salaryNO,field5='$_POST[field5]',
                                                 field6='$_POST[field6]',field7='$_POST[field7]',field8='$_POST[field8]',
                                                 field9='$_POST[field9]',field10='$_POST[field10]',field11='$_POST[field11]',
												 field12='$_POST[field12]',sessionID='$_SESSION[UserID]'";
           $ret=mysql_db_query($db_name, $insertsql, $db_con);  
		  $title=trim($_POST[db_table],"yue")."月份工资条";
		$today =date('Ymd');
	    $messageSql="insert into message set sender='鑫锦程公司',
		                                     receiver=(select field7 from workerinfo where field28='$salaryNO'),
		                                     title='$title',
											 sendTime=$today,
											 stauts=0,
											 sessionID='$_SESSION[UserID]'";
		 $ret1=mysql_query($messageSql);
		      if($ret&&$ret1){
            echo "<p align=center style='font-size:15px; color:red'>成功添加到表".$_POST[db_table]."</p>";}
			else{
			    if($ret&&!$ret1){
			echo "<p align=center style='font-size:15px; color:red'>成功添加到表".$_POST[db_table]."</p>";
			    }
//			  echo "<p align=center style='font-size:15px; color:red'>添加数据错误(提示:1.添加的此人已存在 2.工资账号重复 3.开通工资条短消息通知出错)</p>";}
			   else{
			   echo "<p align=center style='font-size:15px; color:red'>添加数据错误(提示:1.添加的此人已存在 2.工资账号重复 3.开通工资条短消息通知出错)</p>";
			   }
			    }
			    }
	
   ?>
 </div>
</body>
</html>