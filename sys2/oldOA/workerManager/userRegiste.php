<?php require_once "../companyHeader.php"; ?>
<style>
*html #weather { float:right; margin:-50px 10px 0 0; height:50px;}
*+html #weather { float:right; margin:-50px 10px 0 0; height:50px;}
</style>
  <div id="right" name="right">
<?php 
require_once '../header/companyHeader.php';
if(!defined('ALLOW'))exit();
include_once ("../settings.inc");
	?>
		<script src="../js/page.js" type="text/javascript"></script>
     <script language=javascript>

     //分页控制,排序控制
        //window.onload = function(){
 		//page = new Page(15,'displayTable','displaybody'); };
     window.onload = function(){
    	 		page = new Page(100,'displayTable','displaybody');
    	 		page2 = new Page(100,'displayTable2','displaybody2');};
		//$(function() {
//			$("table.displayTable")
//				.tablesorter({widthFixed: true})
//				.tablesorterPager({container: $("#pager")});
		//});
//		$(function() {
//			$("table.displayTable2")
//				.tablesorter({widthFixed: true})
//				.tablesorterPager({container: $("#pager2")});
//		});
 		//查询条件控制
		function checkData()
		{
		    if(document.form1.db_field.value.length==0&&document.form1.searchtxt.value!=0)
		    {
		    	alert("请选择查询条件!");
			     document.form1.searchtxt.focus();
			     return false;
			    }
		}
		   //激活确定
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
		  }   
		
		</script>
		
<body text="#000000" link="#000000" vlink="#000000" alink="#000000" topmargin="0" leftmargin="2" marginwidth="0" marginheight="0">

	
	<div id="headindex">
	 您现在的位置是:员工信息管理-><a href="userRegiste.php">员工账号开通/激活</a>
	 </div>
				
		
	<form name="form1" method="post" action="">	
	

		<?php		
	 $searchsql="SELECT * FROM workerinfo a left join cwps_user b on a.field7=b.UserName where b.UserName is null";
     $searchsql2="select * from workerInfo a left join cwps_user b on a.field7=b.UserName where b.Status<>'1'";
	 $result=mysql_query($searchsql);
	 $t1=mysql_affected_rows();
	 $result2=mysql_query($searchsql2);
	 $t2=mysql_affected_rows();
	 if($t1>0){
		?>
		<p>开通账号:</p>
		<table class="displayTable" id="displayTable" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		<thead>
		<tr bgcolor="#CAE8EA">
		<th >√</th>
<!--		<th ><strong>编号</strong></th>-->
<!--		<th ><strong>档案编号</strong></th>-->
		<th ><strong>用工形式</strong></th>
		<th ><strong>在职状态</strong></th>
		<th ><strong>单位名称</strong></th>
		<th ><strong>部门名称</strong></th>
		<th ><strong>岗位</strong></th>
		<th ><strong>员工姓名</strong></th>
		<th ><strong>身份证编号</strong></th>
		<th ><strong>性别</strong></th>
<!--		<th ><strong>民族</strong></th>-->
<!--		<th ><strong>政治面貌</strong></th>-->
<!--		<th ><strong>婚姻状况</strong></th>-->
<!--		<th ><strong>籍贯</strong></th>-->
<!--		<th ><strong>户籍类型</strong></th>-->
<!--		<th ><strong>户口所在地</strong></th>-->
<!--		<th ><strong>身份证地址</strong></th>-->
<!--		<th ><strong>固定电话</strong></th>-->
<!--		<th ><strong>移动电话</strong></th>-->
<!--		<th ><strong>联系人</strong></th>-->
<!--		<th ><strong>与联系人关系</strong></th>-->
<!--		<th ><strong>联系人电话</strong></th>-->
<!--		<th ><strong>文化程度</strong></th>-->
<!--		<th ><strong>毕业学校</strong></th>-->
<!--		<th ><strong>专业</strong></th>-->
<!--		<th ><strong>社保电脑编号</strong></th>-->
<!--		<th ><strong>社保投保年月</strong></th>-->
<!--		<th ><strong>首次发放工资</strong></th>-->
<!--		<th ><strong>发放工资开户银行</strong></th>-->
<!--		<th ><strong>发放工资银行账号</strong></th>-->
<!--		<th ><strong>入职日期</strong></th>-->
<!--		<th ><strong>离职日期</strong></th>			-->
<!--		<th ><strong>合同初始日期</strong></th>-->
<!--		<th ><strong>合同终止日期</strong></th>-->
<!--		<th ><strong>续签合同开始日期</strong></th>-->
<!--		<th ><strong>续签合同终止日期</strong></th>-->
<!--		<th ><strong>续签合同编号</strong></th>-->
<!--		<th ><strong>备注</strong></th>-->
<!--		<th>操作</th>		-->
		</tr>
		</thead>
		<tbody id="displaybody">
		<?php
		
		while($rows=mysql_fetch_array($result)){
		   
		?>
		
		<tr  bgcolor="#FFFFFF">
		<td align="center"><input id="checkbox" name="checkbox[]" type="checkbox"  value="<? echo $rows['field7']; ?>"></td>
		
		<td ><? echo $rows['ID']; ?></td>
		<!--<td ><? echo $rows['field0']; ?></td>
		<td ><? echo $rows['field1']; ?></td>
		-->
		<td ><? echo $rows['field2']; ?></td>
		<td ><? echo $rows['field3']; ?></td>
		<td ><? echo $rows['field4']; ?></td>
		<td ><? echo $rows['field5']; ?></td>
		<td class="edit"><a href='workerInfo.php<? echo "?"; ?>sessionID=<?php echo $rows['sessionID'];?>&IDNumber=<?php echo $rows['field7'];?>'><? echo $rows['field6']; ?></a></td>
		<td ><? echo $rows['field7']; ?></td>
	    <td ><? echo $rows['field8']; ?></td>
		<!--<td ><? echo $rows['field9']; ?></td>
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
        <td class="edit"><a href='editWorker.php<? echo "?"; ?>editId=<?php echo $rows['ID'];?>&sessionID=<?php echo $rows['sessionID'];?>'>编辑</a></td>
		
		--></tr>
		<?php
		}
		?>
		</tbody>
		</table>
			<div id="foot">
		<div class="button">
		<a href="#" onClick="$('input[type=checkbox]').attr('checked', 'checked')">全选</a>
		<a href="#" onClick="$('input[type=checkbox]').removeAttr('checked')">全不选 </a>
		<input name="Insert" type="submit" Id="Insert" value="开通账号" onClick="javascript:return checkselect(form1)" />		
	  </div>
<div style="float:right;margin-top:15px;">
<a href="#" onClick="page.firstPage();">首页</a>
<a href="#" onClick="page.prePage();">上一页</a>
<a href="#" onClick="page.nextPage();">下一页</a>
<a href="#" onClick="page.lastPage();">尾页</a>
</div>
</div>
</form>
<?php 
	}
	    $checkbox= $_POST[checkbox];	
		if(isset($_POST['Insert'])){
				
		for($i=0;$i<count($checkbox);$i++){
		$insert_id = $checkbox[$i];
		$insertsql1= "insert into  cwps_user   SET   GroupID=8,Username='$insert_id',password='e10adc3949ba59abbe56e057f20f883e',status=1";
		$insertsql2= "insert into  cwps_user_extra   SET   UserID=LAST_INSERT_ID(),Cqyyh=8";		
		$insertRet = mysql_query($insertsql1);
		$insertTt1=mysql_affected_rows();
		if($insertTt1>0){
		        mysql_query($insertsql2);  
		        $insertTt2=mysql_affected_rows();  
		}
		}
		
	   if($insertTt2>0){
				echo '<script language=javascript>window.alert(\'开通成功!!\')</script>';
				echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
	               }
		} 
	   
		if($t2>0){
		?>
		<p>激活账号:</p>
		<form name="form2" method="post" action="">
		<table class="displayTable2" id="displayTable2" width="4000" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		<thead>
		<tr bgcolor="#CAE8EA">
		<th >√</th>
		<th><strong>编号</strong></th>
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
		<tbody id="displaybody2">
		<?php
		
		while($row=mysql_fetch_array($result2)){
		   
		?>
		
		<tr  bgcolor="#FFFFFF">
		<td align="center"><input id="checkbox2" name="checkbox2[]" type="checkbox"  value="<? echo $row['field7']; ?>"></td>
		
		<td ><? echo $row['ID']; ?></td>
		<td ><? echo $row['field0']; ?></td>
		<td ><? echo $row['field1']; ?></td>
		<td ><? echo $row['field2']; ?></td>
		<td ><? echo $row['field3']; ?></td>
		<td ><? echo $row['field4']; ?></td>
		<td ><? echo $row['field5']; ?></td>
		<td class="edit"><a href='workerInfo.php<? echo "?"; ?>sessionID=<?php echo $row['sessionID'];?>&salaryNo=<?php echo $row['field28'];?>'><? echo $row['field6']; ?></a></td>
		<td ><? echo $row['field7']; ?></td>
	    <td ><? echo $row['field8']; ?></td>
		<td ><? echo $row['field9']; ?></td>
		<td><? echo $row['field10']; ?></td>
		<td><? echo $row['field11']; ?></td>
		<td><? echo $row['field12']; ?></td>
		<td><? echo $row['field13']; ?></td>
		<td ><? echo $row['field14']; ?></td>
	    <td ><? echo $row['field15']; ?></td>
		<td ><? echo $row['field16']; ?></td>
		<td><? echo $row['field17']; ?></td>
		<td><? echo $row['field18']; ?></td>
		<td><? echo $row['field19']; ?></td>
		<td><? echo $row['field20']; ?></td>
		<td ><? echo $row['field21']; ?></td>
	    <td ><? echo $row['field22']; ?></td>
		<td ><? echo $row['field23']; ?></td>
		<td><? echo $row['field24']; ?></td>
		<td><? echo $row['field25']; ?></td>
		<td><? echo $row['field26']; ?></td>
		<td><? echo $row['field27']; ?></td>
		<td ><? echo $row['field28']; ?></td>
	    <td ><? echo $row['field29']; ?></td>
		<td ><? echo $row['field30']; ?></td>
		<td><? echo $row['field31']; ?></td>
		<td><? echo $row['field32']; ?></td>
		<td><? echo $row['field33']; ?></td>
		<td><? echo $row['field34']; ?></td>	
		<td><? echo $row['field35']; ?></td>
		<td><? echo $row['field36']; ?></td>	
        <td class="edit"><a href='editWorker.php<? echo "?"; ?>editId=<?php echo $row['ID'];?>&sessionID=<?php echo $row['sessionID'];?>'>编辑</a></td>
		
		</tr>
		<?php
		}
		
		?>
		</tbody>
		</table>

		<div id="foot">
		<div class="button">
		<a href="#" onClick="$('input[type=checkbox]').attr('checked', 'checked')">全选</a>
		<a href="#" onClick="$('input[type=checkbox]').removeAttr('checked')">全不选 </a>
		<input name="Update" type="submit" Id="Update" value="激活账号" onClick="javascript:return checkselect2(form2)" />		
	  </div>
<div style="float:right;margin-top:-5px;">
<a href="#" onClick="page2.firstPage();">首页</a>
<a href="#" onClick="page2.prePage();">上一页</a>
<a href="#" onClick="page2.nextPage();">下一页</a>
<a href="#" onClick="page2.lastPage();">尾页</a>
</div>
</div>
<?php 
	}
	    $checkbox2= $_POST[checkbox2];	
	   // echo "dafdafa=".$checkbox2;
		if(isset($_POST['Update'])){
		for($k=0;$k<count($checkbox2);$k++){
		$update_id = $checkbox2[$k];
		//echo "dafdafa=".$update_id;
		$updatesql= "Update cwps_user set status=1 WHERE UserName='$update_id'";
		$updateRet = mysql_query($updatesql);
		
		}	
		$updateTt=mysql_affected_rows();	
	   if($updateTt>0){
				echo '<script language=javascript>window.alert(\'激活成功!!\')</script>';
				 echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
	   }
      
//				}
//				echo '<script language=javascript>window.alert(\'删除失败!!\')</script>';
		} 
		
?>
</form>
		</body>
	    </html>
	   <?
//	   }
	   ?>
</div>
</body>
</html>