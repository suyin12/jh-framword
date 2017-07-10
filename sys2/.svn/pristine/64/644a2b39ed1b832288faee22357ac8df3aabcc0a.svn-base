<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
 require_once '../header/managerHeader.php';
    if(!defined('ALLOW'))exit(); 
	include_once '../settings.inc';
	if (!$db_con) { echo("ERROR: " . mysql_error() . "\n");	}
	
	$db_table=$_GET[tableId];
	$editID=$_GET[editId];
	$sessionID=$_GET[sessionID];
	//echo "dafdsaf=".$sessionID;
	if($sessionID!=$_SESSION[UserID])
	{
	  echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为客户经理专属,欲更改其数据请联系客户经理</p>";
	}
	else
	{
?>
<link href="../css/main.css" type="text/css" rel="stylesheet" />
</HEAD>

<body>
<div id="headindex">
您现在的位置是:工资管理->信息更新</a>
</div>
<p align="center" >提示:用鼠标左击选择表中要更新的项<p>
<?
	# processed when form is submitted back onto itself
	if (isset($_POST[submit])) {
         $salaryNO=trim($_POST[field4]);
		# setup SQL statement
		$SQL = "UPDATE $_POST[db_table] SET  ";
		$SQL = $SQL . "field0 = '$_POST[field0]', ";
		$SQL = $SQL . "field1 = '$_POST[field1]', ";
		$SQL = $SQL . "field2 = '$_POST[field2]', ";
		$SQL = $SQL . "field3 = '$_POST[field3]', ";
		$SQL = $SQL . "field4 = '$salaryNO', ";
		$SQL = $SQL . "field5 = '$_POST[field5]', ";
		$SQL = $SQL . "field6 = '$_POST[field6]', ";
		$SQL = $SQL . "field7 = '$_POST[field7]', ";
		$SQL = $SQL . "field8 = '$_POST[field8]', ";
		$SQL = $SQL . "field9 = '$_POST[field9]', ";
		$SQL = $SQL . "field10 = '$_POST[field10]', ";
		$SQL = $SQL . "field11 = '$_POST[field11]', ";
		$SQL = $SQL . "field12 = '$_POST[field12]' ";
		
//		$SQL = $SQL . "sessionId = '$date', ";		

		$SQL = $SQL . " WHERE ID = '$_POST[ID]' AND sessionID='$_SESSION[UserID]'";

		# execute SQL statement
		$result = mysql_query($SQL);

		# check for errors
		if (!$result) { echo("ERROR: " . mysql_error() . "\n$SQL\n");	}
		else echo "<meta http-equiv=\"refresh\" content=\"0;URL=success.php\">";

//		echo ("<P><B> Link Updated</B></P>\n");

	}
	else { # display edit form (not post method)

		# setup SQL statement to retrieve link
		# that we want to edit
		$SQL = " SELECT * FROM $db_table ";
		$SQL = $SQL . " WHERE ID = $editID AND sessionID='$_SESSION[UserID]' ";

		# execute SQL statement
		$ret = mysql_query($SQL);
		//
		if(!$ret[0]){echo "";}
		# retrieve values
		$row = mysql_fetch_array($ret);	
		        $ID=$row['ID'];	
		     $date=$row["field0"];
		   $company=$row["field1"];
		$department=$row["field2"];
		      $name=$row['field3'];
		  $salaryNo=$row["field4"];
		    $salary=$row["field5"];
		       $tax=$row["field6"];
		    $safety=$row["field7"];
			  $rent=$row["field8"];
			$member=$row["field9"];
		     $other=$row["field10"];
		   $fineAll=$row["field11"];
		 $realMoney=$row["field12"];
		    
		 


?>

<FORM NAME="editForm" ACTION="" METHOD="POST" >
<table id="insertTable"   width="780px" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead>
		<tr>
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
		<tr>
		<th><strong>扣个税</strong></th>
		<th><strong>扣保险</strong></th>
		<th ><strong>房屋水电</strong></th>
		
		<th><strong>其他</strong></th>
		<th><strong>扣款合计</strong></th>
		</tr>
		</thead>  
<tr>
<td><input type="text" name="field0" VALUE="<?php echo("$date"); ?>"/></td>
<td><input type="text" name="field1" VALUE="<?php echo("$company"); ?>"/></td>
<td><input type="text" name="field2" VALUE="<?php echo("$department"); ?>"/></td>
<td><input type="text" name="field3" VALUE="<?php echo("$name"); ?>" /></td>
<td><input type="text" name="field4" VALUE="<?php echo("$salaryNo"); ?>" /></td>
<td><input type="text" name="field5" VALUE="<?php echo("$salary"); ?>"/></td>
<td><input type="text" name="field6" VALUE="<?php echo("$tax"); ?>" /></td>
<td><input type="text" name="field7" VALUE="<?php echo("$safety"); ?>" /></td>
<td><input type="text" name="field8" VALUE="<?php echo("$rent"); ?>"/></td>
<td><input type="text" name="field9" VALUE="<?php echo("$member"); ?>"/></td>
<td><input type="text" name="field10" VALUE="<?php echo("$other"); ?>"  /></td>
<td><input type="text" name="field11" VALUE="<?php echo("$fineAll"); ?>" /></td>
<td><input type="text" name="field12"  VALUE="<?php echo("$realMoney"); ?>"/></td>


<!--<td><input name="sessionID" value="" /></td>-->

</tr>
</table>
<input type="hidden" name="ID" value="<?php echo("$ID")?>" />
<input type="hidden" name="db_table" value="<?php echo("$db_table")?>" />
<div align="center">
<INPUT TYPE="submit" name="submit" VALUE="更新" onClick="if(!confirm('确定更新吗?')) { return false;}" style=" width:100px; margin-top:50px; ">
</div>
</FORM>


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