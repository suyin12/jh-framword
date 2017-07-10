<?php require_once "../companyHeader.php"; ?>
<style>
*html #weather { float:right; margin:-50px 10px 0 0; height:50px;}
*+html #weather { float:right; margin:-50px 10px 0 0; height:50px;}
</style>
  <div id="right" name="right">
<?php 	
   
    if(!defined('ALLOW'))exit();
	include_once ("../settings.inc");
	
    $managerSql="select * from cwps_user where SubGroupIDs=',14,'";
    $managerRet=mysql_query($managerSql);
	?>
		<body>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
		
     <script language=javascript>
     //分页控制,排序控制
				//window.onload = function(){
				//page = new Page(15,'displayTable','displaybody'); };; 
		$(function() {
				//$("table")
					//.tablesorter({widthFixed: true})
					
			$("table").tablesorter({widthFixed: true,widgets: ['zebra'],headers: { 
                7: { 
                    sorter:'digit' 
                },
				8: { 
                    sorter:'digit'
                },
				9: { 
                    sorter:'digit'
                },
				10: { 
                    sorter:'digit' 
                },
				11: { 
                    sorter:'digit' 
                },
				12: { 
                    sorter:'digit' 
                },
				13: { 
                    sorter:'digit' 
                },
				14: { 
                    sorter:'digit' 
                }
				}})
					.tablesorterPager({container: $("#pager")});
				
			});

 		//查询条件控制
		function checkData()
		{   
			//if(document.form1.db_table.value.length==0){
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
		}
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
		  }   
		</script>
		


	
	<div id="headindex">
	 您现在的位置是:工资管理-><a href="fixed.php">工资的查询及更新</a>
	 </div>
				
		
	<form name="form1" method="post" action="">	
	<div id="searchCondition">
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
	&nbsp;&nbsp;
	选择查询方式:	
	<select name="db_field">
	<option value="" SELECTED>--请选择--</option>
	<option value="field4" <?php if($_POST[db_field]=="field4") echo "SELECTED";?>>工资账号</option>
	<option value="field1" <?php if($_POST[db_field]=="field1") echo "SELECTED";?>>单位名称</option>
	<option value="field2" <?php if($_POST[db_field]=="field2") echo "SELECTED";?>>部门名称</option>
	<option value="field3" <?php if($_POST[db_field]=="field3") echo "SELECTED";?>>姓名</option>
	</select>
	
	 <input name="searchtxt" type="text" value="<?php echo $_POST[searchtxt];?>"/>
	<input name="search" value="查询" type="submit" onClick="return checkData()" />
	
	</div>

		<?php
				
	 
	    if($_POST[db_table]!="")
	     { 
			$searchTXT=trim($_POST[searchtxt]);
			if($_POST[manager]!="")
			{
			    $searchsql="select * from $_POST[db_table] where $_POST[db_field] like '%$searchTXT%' and SessionID='$_POST[manager]' order by ID desc";  
			if(mysql_query("create TEMPORARY table  salaryTempTab as 
		                    select count(ID),sum(field5),sum(field11),cast( avg( field5 + 0.0 ) as decimal ( 10 , 2 ) ),cast( avg( field11 + 0.0 ) as decimal ( 10 , 2 ) )
		                    from $_POST[db_table] where $_POST[db_field] like '%$_POST[searchtxt]%' and SessionID='$_POST[manager]'"))
		           { $TempleTabSql="select * from salaryTempTab";
				     $TempleTabRet=mysql_query($TempleTabSql);
		   		     $TempleTabRow=mysql_fetch_array($TempleTabRet);
				     //echo "总条数=".$TempleTabRow['count(ID)'];
		           }
			}
			else{
		 	$searchsql="select * from $_POST[db_table] where $_POST[db_field] like '%$searchTXT%'  order by ID desc";  
			 if(mysql_query("create TEMPORARY table  salaryTempTab as 
		                    select count(ID),sum(field5),sum(field11),cast( avg( field5 + 0.0 ) as decimal ( 10 , 2 ) ),cast( avg( field11 + 0.0 ) as decimal ( 10 , 2 ) )
		                    from $_POST[db_table] where $_POST[db_field] like '%$_POST[searchtxt]%'"))
		           { $TempleTabSql="select * from salaryTempTab";
				     $TempleTabRet=mysql_query($TempleTabSql);
		   		     $TempleTabRow=mysql_fetch_array($TempleTabRet);
				     //echo "总条数=".$TempleTabRow['count(ID)'];
		           }
	        }
		    $strsql="select * from $_POST[db_table] order by ID desc";  
		    if($_POST[db_field]!="")
		    {
			    $result=mysql_db_query($db_name, $searchsql, $db_con);	
				 $count=mysql_num_rows($result);
            } 
		   
			
	    }
	
		?>
		
	
		<table class="tablesorter"  width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		<thead>
		<tr bgcolor="#CAE8EA">
		<th rowspan="2">√</th>
<!--		<th rowspan="2"><strong>编号</strong></th>-->
		<th rowspan="2"><strong>工资年月</strong></th>
		<th rowspan="2"><strong>单位名称</strong></th>
		<th rowspan="2"><strong>部门名称</strong></th>
		<th rowspan="2"><strong>姓名</strong></th>
		<th rowspan="2" ><strong>工资账号</strong></th>
		<th rowspan="2"><strong>应发工资</strong></th>
		<th rowspan="2"><strong>扣个税</strong></th>
		<th rowspan="2"><strong>扣保险</strong></th>
		<th rowspan="2"><strong>房屋水电</strong></th>
		
		<th rowspan="2"><strong>其他</strong></th>
		<th rowspan="2"><strong>扣款合计</strong></th>
		<th rowspan="2"><strong>实发金额</strong></th>	
		<th rowspan="2"><strong>备注</strong></th>
		<th rowspan="2">操作</th>		
		</tr>
		<tr>
		
		</tr>
		</thead>
		<tbody id="displaybody">
		<?php
		if($result){
		while($rows=mysql_fetch_array($result)){
		   
		?>
		
		<tr bgcolor="#FFFFFF">
		<td align="center" ><input id="checkbox" name="checkbox[]" type="checkbox"  value="<? echo $rows['ID']; ?>"></td>
		
<!--		<td ><? echo $rows['ID']; ?></td>-->
		<td ><? echo $rows['field0']; ?></td>
		<td ><? echo $rows['field1']; ?></td>
		<td ><? echo $rows['field2']; ?></td>
		<td class="edit"><a href='../workerManager/workerInfo.php<? echo "?"; ?>sessionID=<?php echo $rows['sessionID'];?>&salaryNo=<?php echo $rows['field4'];?>&workerName=<?php echo $rows['field3'];?>' target="_blank"><? echo $rows['field3']; ?></a></td>
		<td ><? echo $rows['field4']; ?></td>
		<td ><? echo $rows['field5']; ?></td>
		<td ><? echo $rows['field6']; ?></td>
		<td ><? echo $rows['field7']; ?></td>
	    <td ><? echo $rows['field8']; ?></td>
		<td ><? echo $rows['field9']; ?></td>
		<td><? echo $rows['field10']; ?></td>
		<td><? echo $rows['field11']; ?></td>
		<td><? echo $rows['field12']; ?></td>
				
        <td class="edit"><a href='edit.php<?echo "?"; ?>tableId=<?php echo $_POST[db_table];?>&editId=<?php echo $rows['ID'];?>&sessionID=<?php echo $rows['sessionID'];?>' target="_blank">编辑</a></td>
		
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
	<?php
	    $checkbox= $_POST[checkbox];	
		if(isset($_POST['Delete'])){
				
		for($i=0;$i<count($checkbox);$i++){
		$del_id = $checkbox[$i];
		$sql = "DELETE FROM $_POST[db_table] WHERE ID='$del_id' AND sessionID='$_SESSION[UserID]'";
		$result1 = mysql_query($sql);
		}
		$ttt=mysql_affected_rows();
	   if($ttt!=0){
		     echo '<script language=javascript>window.alert(\'删除成功!(若是多选,那么您没操作权限的数据不会被删除!!)\')</script>';
				echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
				//echo "<p align='center' style='font-size:15px; color:red'></p>";;
				}
				else{echo "<p align='center' style='font-size:15px; color:red'>删除失败!(您是否有权限??欲删除数据请联系该员工隶属的客户经理.)</p>";}
		 }
		mysql_close();
		?>

	</form>
</div>

<? if($TempleTabRow['count(ID)']>0){?>
<div style="margin-top:10px;">
<table width=100%>
<tr>
<td><? echo "当前查找到的总记录数为:<span style='color:red'>".$TempleTabRow['count(ID)']."</span>人";?></td>
<td><? echo "应发工资总计为:<span style='color:red'>".$TempleTabRow['sum(field5)']."</span>元"?></td>
<td><? echo "实发金额总计为:<span style='color:red'>".$TempleTabRow['sum(field11)']."</span>元"?></td>
</tr>
<tr>
<td><? echo "月平均应发工资为:<span style='color:red'>".$TempleTabRow['cast( avg( field5 + 0.0 ) as decimal ( 10 , 2 ) )']."</span>元"?></td>
<td><? echo "月平均实发金额为:<span style='color:red'>".$TempleTabRow['cast( avg( field11 + 0.0 ) as decimal ( 10 , 2 ) )']."</span>元"?></td>
</tr>
</table>
</div>
<?
}
?>


	</body>
	    </html>
</div>
</body>
</html>