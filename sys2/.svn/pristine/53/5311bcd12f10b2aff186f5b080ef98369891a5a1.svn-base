<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
@session_start();
	
	if($_SESSION['Cqyyh']!=13)
	{
	echo "无权访问";
	}
	else{
	
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
<?php /*?>		<link href="../css/main.css" rel="stylesheet" /><?php */?>
		
		
     <script language=javascript>

     //分页控制
    // window.onload = function(){
 	//	page = new Page(2,'displayTable','displaybody');
 	//	page2 = new Page(2,'displayTable2','displaybody2');
 	//	};
		$(function() {
				$("table.displayTable")
					.tablesorter({widthFixed: true})
					.tablesorterPager({container: $("#pager")});
			});
			$(function() {
				$("table.displayTable2")
					.tablesorter({widthFixed: true})
					.tablesorterPager({container: $("#pager2")});
			});
// 	 window.onload = function(){
// 		page2 = new Page(2,'displayTable2','displaybody2'); 
// 		 		};
 		
 		
 		//删除确定
		function   checkselect(form)  
		  {  
		  var   selected=false;  
		  var   len=form.checkbox.length;  
		  if   (len>0)  
		  {  
		    for(i=0;i<len;i++)  
		      if(form.checkbox[i].checked)  
		          {  
		            selected=true;  
		          }  
		  }  
		  else  
		  {  
		      if(form.checkbox.checked)  
		      selected=true;  
		  }  
		   
		  if(!selected)  
		  {  
			  if(!alert("请选择要操作的行")){return false;};
		  }  
		  else  
		  {  
			  if(!confirm("确定吗???")){return false;}
		  }  
		  }   ;
		  
		  function   checkselect2(form)  
		  {  
		  var   selected=false;  
		  var   len=form.checkbox2.length;  
		  if   (len>0)  
		  {  
		    for(i=0;i<len;i++)  
		      if(form.checkbox2[i].checked)  
		          {  
		            selected=true;  
		          }  
		  }  
		  else  
		  {  
		      if(form.checkbox2.checked)  
		      selected=true;  
		  }  
		   
		  if(!selected)  
		  {  
			  if(!alert("请选择要操作的行")){return false;};
		  }  
		  else  
		  {  
			  if(!confirm("确定吗???")){return false;}
		  }  
		  }  ; 
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
	<option value="field24" <?php if($_POST[db_field]=="field24") echo "SELECTED";?>>社保号</option>
	</select>
	
	 <input name="searchTxt" type="text" value="<?php echo $_POST[searchTxt];?>"/>
	<input name="search" value="查询" type="submit"/>
	
	</div>

		<?php		
		require("../settings.inc");
		 $sql="select a.*,b.field6,b.field7,b.field24 from declareInjury a,workerInfo b where a.IDNumber=b.field7";
		$sql2="select a.*,b.field6,b.field7,b.field24 from bussiness a,workerInfo b where a.IDNumber=b.field7";
		$ret=mysql_query($sql);
		$aff=mysql_affected_rows();
		//echo "aff=".$aff;
		$ret2=mysql_query($sql2);
		$aff2=mysql_affected_rows();
		//echo "<BR>aff2=".$aff2;
	 if(isset($_POST['search'])){
	    
	     if($aff){
		 	$searchsql="select a.*,b.field6,b.field7,b.field24 from declareInjury a,workerInfo b where a.IDNumber=b.field7 and b.$_POST[db_field] like '%$_POST[searchTxt]%' order by ID ASC";  
		    $strsql="select a.*,b.field6,b.field7,b.field24 from declareInjury a,workerInfo b where a.IDNumber=b.field7 order by ID ASC";  
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
         if($aff2){
		 	$searchsql2="select a.*,b.field6,b.field7,b.field24 from bussiness a,workerInfo b where a.IDNumber=b.field7 and b.$_POST[db_field] like '%$_POST[searchTxt]%' order by ID ASC";  
		    $strsql2="select a.*,b.field6,b.field7,b.field24 from bussiness a,workerInfo b where a.IDNumber=b.field7 order by ID ASC";  
		    if($_POST[db_field]!="")
		    {
			    $result2=mysql_db_query($db_name, $searchsql2, $db_con);			     
             }
		    else
		    {
		    $result2=mysql_db_query($db_name, $strsql2, $db_con);
		   
		    } 
		    $count=mysql_num_rows($result2);
	       }
	 }
	if($result)
	{
		?>
<div>		
<p>社会保险申报记录如下:</p>
<table class="displayTable" width="100%" border="0" cellspacing="1"  bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA">
<th>√</th>
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
<tbody id="displaybody">

<?php 
while($row=mysql_fetch_array($result))
{
?>
<tr bgcolor="#ffffff">
<td><input name="checkbox[]" type="checkbox" id="checkbox" value="<? echo $row['ID']; ?>"></td>
<td><?php echo $row['field6']; ?></td>
<td><?php echo $row['field7']; ?></td>
<td><?php echo $row['field24']; ?></td>
<td><?php echo $row['InjuryType']; ?></td>
<td><?php echo $row['Type2']; ?></td>
<td><?php echo $row['Schedule']; ?></td>
<td><?php echo $row['declareDate']; ?></td>
<td><?php echo $row['Content']; ?></td>
<td class="edit"><a href='declarePersonalManage.php<? echo "?"; ?>IDNumber=<?php echo $row['field7'];?>'>申报/进度更新</a></td>
</tr>
<?php 
}
?>

</tbody>
</table>

		<div id="foot">
		<div class="button">
		<a href="#" onClick="$('input[@type=checkbox]').attr('checked', 'checked')">全选</a>
		<a href="#" onClick="$('input[@type=checkbox]').removeAttr('checked')">全不选 </a>
		<input name="Delete" type="submit" Id="Delete" value="删除" onClick="javascript:return checkselect(form1)" />		
	  </div>
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
</div>
<?php 
	}
	
	
	
	    $checkbox= $_POST[checkbox];	
		if(isset($_POST['Delete'])){
				
		for($i=0;$i<count($checkbox);$i++){
		$del_id = $checkbox[$i];
		$sql = "DELETE FROM declareInjury WHERE ID='$del_id'";
		$result1 = mysql_query($sql);
		}
		$ttt=mysql_affected_rows();
	   if($ttt!=0){
				echo '<script language=javascript>window.alert(\'删除成功!!\')</script>';
	   }
//       echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
//				}
//				echo '<script language=javascript>window.alert(\'删除失败!!\')</script>';
		} 
		
?>

<?php 
if($result2)
	{
		?>
	<div>	
	<form name="form2" method="post" action="">
<p>商业保险申报记录如下:</p>
<table class="displayTable2" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA">
<th>√</th>
<th>姓名</th>
<th>身份证号码</th>
<th>保险类型</th>
<th>申报进度</th>
<th>申报时间</th>
<th>申报备注</th>
<th>操作</th>
</tr>
</thead>
<tbody id='displaybody2'>

<?php 
while($row2=mysql_fetch_array($result2))
{
?>
<tr bgcolor="#ffffff">
<td><input name="checkbox2[]" type="checkbox" id="checkbox2" value="<? echo $row2['ID']; ?>"></td>
<td><?php echo $row2['field6']; ?></td>
<td><?php echo $row2['field7']; ?></td>
<td><?php echo $row2['InjuryType']; ?></td>
<td><?php echo $row2['Schedule']; ?></td>
<td><?php echo $row2['declareDate']; ?></td>
<td><?php echo $row2['Content']; ?></td>
<td class="edit"><a href='declarePersonalManage.php<? echo "?"; ?>IDNumber=<?php echo $row2['field7'];?>'>申报/进度更新</a></td>
</tr>
<?php 
}
?>

</tbody>
</table>

		<div id="foot">
		<div class="button">
		<a href="#" onClick="$('input[@type=checkbox]').attr('checked', 'checked')">全选</a>
		<a href="#" onClick="$('input[@type=checkbox]').removeAttr('checked')">全不选 </a>
		<input name="Delete2" type="submit" Id="Delete2" value="删除" onClick="javascript:return checkselect2(form2)" />		
	  </div>
<div id="pager2" class="pager2" style="margin-top:5px;float:right">
	<form>
		<img src="../css/images/first.png" class="first"/>
		<img src="../css/images/prev.png" class="prev"/>
		<input type="text" class="pagedisplay" style="width:45px;background:transparent;border:0;text-align:center" />
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
<?php 
	}
	    $checkbox2= $_POST[checkbox2];	
		if(isset($_POST['Delete2'])){
		for($k=0;$k<count($checkbox2);$k++){
		$del_id2 = $checkbox2[$k];
		$deletesql2 = "DELETE FROM bussiness WHERE ID='$del_id2'";
		$deleteresult2 = mysql_query($deletesql2);
		}
		$deletett2t=mysql_affected_rows();
	   if($deletettt2!=0){
				echo '<script language=javascript>window.alert(\'删除成功!!\')</script>';
	   }
//       echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
//				}
//				echo '<script language=javascript>window.alert(\'删除失败!!\')</script>';
		} 
		
?>
</form>
</form>
</div>
<script type="text/javascript" src="./js/page.js"></script>
		</body>
	    </html>
	   <?
	   }
	   ?>
	   </div>
       </body>
       </html>