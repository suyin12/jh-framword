
<?php
require_once '../header/companyHeader.php';
if(!defined('ALLOW'))exit();
require_once '../settings1.inc';
list($userName,$searchSql,$status)=$_SESSION['quickWorkArray'];
//print_r($_SESSION['quickWorkArray']);
require_once '../pagenation.class.php';
$mypage = new Pagination();//使用分页类
$mypage->page=$_GET['page'];//设置当前页
$mypage->pagesize=10;//每页多少条记录
$mypage->count=@mysql_num_rows(mysql_query($searchSql));//获取并设置数据库总记录数
$sql =$searchSql.$mypage->get_limit();//分页条件查询
$result = mysql_query($sql);
?>
<br />
<script language=javascript>

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

//post 到不同页面
	  	function choiceAction()
	  	{ 
	  		var   selected=false;  
			  var   len=searchForm.checkbox.length;  
			  if   (len>0)  
			  {  
			    for(i=0;i<len;i++)  
			      if(searchForm.checkbox[i].checked)  
			          {  
			            selected=true;  
			          }  
			  }  
			  else  
			  {  
			      if(searchForm.checkbox.checked)  
			      selected=true;  
			  }  
			   
			  if(!selected)  
			  {  
				  if(!alert("请选择要操作的行")){return false;};
			  }  
			  else  
			  {  
				 document.searchForm.action='updateQuickWork.php';  
				 document.searchForm.target='_blank';
		  		 document.searchForm.submit(); 
			  }  
	  		 	 
		};
		</script>
<div style="width:98%">
<form action="" method="post" name="searchForm" id="searchForm" >
<table id="displayTable" width="100%" border="0" cellspacing="1"
	cellpadding="2" bgcolor="#666666">
	<tr bgcolor="#CAE8EA">
		<th height="30">
		<div align="center">√</div>
		</th>
		<th height="30">
		<div align="center">来源</div>
		</th>
		<th height="30">
		<div align="center">姓 名</div>
		</th>
		<th height="30">
		<div align="center">性别</div>
		</th>
		<th height="30">
		<div align="center">身份证号码</div>
		</th>
		<th height="30">
		<div align="center">年 龄</div>
		</th>
		<th height="30">
		<div align="center">联系电话</div>
		</th>
		<th height="30">
		<div align="center">学 历</div>
		</th>
		<th height="30">
		<div align="center">所学专业</div>
		</th>
		<th height="30">
		<div align="center">求职意向</div>
		</th>
		<th height="30">
		<div align="center">求职区域</div>
		</th>
		<th height="30">
		<div align="center">注册日期</div>
		</th>
	<th height="30">
		<div align="center">过期日期</div>
		</th>
	<th height="30">
		<div align="center">处理人员</div>
		</th>
	<th height="30">
		<div align="center">备注</div>
		</th>
  </tr>
	<tbody id="displaybody">
     <?php  
     $i = 1;
		while(($row=@mysql_fetch_array($result))==true){
		   
		$IndexID=$row['IndexID'];
		$name=$row['name'];
		$sex=$row[sex];
		$PublishDate=date('y-m-d',$row['PublishDate']);
		$shenfenzheng=$row['shenfenzheng'];
		$dianhua=$row['dianhua'];
		$xueli=$row['xueli'];
		$zhuanye=$row['zhuanye'];
		$zhuanye2=$row['zhuanye2'];
		$yixiang=$row['yixiang'];
		$yixiang2=$row['yixiang2'];
		$quyu=$row['quyu'];
		$ytongzhi=$row['ytongzhi'];
		$yluyong=$row['yluyong'];
		$buhege=$row['buhege'];
?>
  <tr>
			<td bgcolor="#F2F2F2"><input name="checkbox[]" type="checkbox"
				id="checkbox" value="<? echo $row['IndexID']; ?>"></td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<?echo $row['comeFrom'];?></td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<?echo $name;?></td>
			<td height="30" bgcolor="#F2F2F2">
			<div align="center"><? if ($sex==1) { echo "男";} else {echo "女";}?></div>
			</td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<? echo $shenfenzheng;?></td>
			<td height="30" bgcolor="#F2F2F2">
			<div align="center">
    <? $changdu= mb_strlen($shenfenzheng, 'GBK'); 
     $showtime=date("Y");
     $asa=substr($shenfenzheng,6,4);
     $asb="19".substr($shenfenzheng,6,2);
    if ($changdu==18||$changdu==17)  {echo $nl=$showtime- $asa;} elseif ($changdu==15){echo $nl=$showtime- $asb;} else {echo "X";}
?>
    
    </div>
			</td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<?echo $dianhua;?></td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<?
    if ($xueli==1) {echo "高中";}
    if ($xueli==2) {echo "中专";}
    if ($xueli==3) {echo "中技";}
    if ($xueli==4) {echo "大专";}
    if ($xueli==5) {echo "本科";}
    if ($xueli==6) {echo "研究生";}
    if ($xueli==7) {echo "硕士";}
    if ($xueli==8) {echo "博士";}
    if ($xueli==9) {echo "初中";}
    ?>    </td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<? if ($zhuanye=="") {echo $zhuanye2;} else {echo $zhuanye;}?></td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<? if ($yixiang=="0") {echo $yixiang2;} else {echo $yixiang;}?></td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<? echo $quyu;?></td>
			<td height="30" bgcolor="#F2F2F2">&nbsp;<? echo $PublishDate;?></td>
    <td height="40" bgcolor="#F2F2F2">&nbsp;<?  if($row['staleDated']) echo date("y-m-d",$row['staleDated']);?></td>
    <td height="30" bgcolor="#F2F2F2">&nbsp;<? echo $row['userName'];?></td>
    <td height="30" bgcolor="#F2F2F2">&nbsp;<? echo $row['comments'];?></td>
  </tr>
    <?
  $i++;
}

?> 
 </tbody>


</table>
<div id="foot">
<div class="button"><a href="#"	onClick="$('input[type=checkbox]').attr('checked', 'checked')">全选</a>
<a href="#" onClick="$('input[type=checkbox]').removeAttr('checked')">全不选
</a>
  <?php 
  $s=$status;
  switch ($s)
  {
      case '0':echo '<input type="submit" name="choice" value="提取" onclick="javascript:return checkselect(searchForm)" />';break;
      case '2':echo '<input type="submit" name="choice" value="提取" onclick="javascript:return checkselect(searchForm)" />';break;
      case '3':echo '<input type="submit" name="shangG" value="上岗" onclick="javascript:return checkselect(searchForm)" />';
               echo '<input type="submit" name="chubei" value="储备" onclick="javascript:return checkselect(searchForm)" />';
      break;
      case '4':echo '<input type="submit" name="FSHG"   value="复试合格" onclick="javascript:return checkselect(searchForm)" />';
               echo '<input type="button" name="FSBHG"  value="复试不合格" onclick="javascript:choiceAction();" />';
               echo '<input type="submit" name="chubei" value="储备" onclick="javascript:return checkselect(searchForm)" />';
      break;
               
  }
  ?>
	  </div>

<div class="index">
<?php 
$mypage->page_list($_SERVER['PHP_SELF']);//输出分页按扭
?>
</div>
</div>
</form>
</div>
<?php 
        $today=time();
        $checkbox=$_POST['checkbox'];
       $CKLen=count($checkbox);
		for($i=0;$i<$CKLen;$i++){
		$del_id = $checkbox[$i];
	 
   if(isset($_POST['choice']))
   {
      
    echo  $updatesql="update cmsware_publish_147 set ytongzhi='4',buhege='0',yluyong='0',staleDated='',userName='$userName' where IndexID='$del_id'";
   }
   if(isset($_POST['chubei']))
   {
        $staleDated=time()+90*24*60*60;
      $updatesql="update cmsware_publish_147 set ytongzhi='2',userName=' ',staleDated='$staleDated' where IndexID='$del_id'";
   }
   if(isset($_POST['shangG']))
   {
       $updatesql="update cmsware_publish_147 set yluyong='0',ytongzhi='5',buhege='0',userName='$userName',staleDated='' where IndexID='$del_id'";
   }
		if(isset($_POST['FSHG']))
   {
       $updatesql="update cmsware_publish_147 set yluyong='0',ytongzhi='3',buhege='0',userName='$userName',staleDated='' where IndexID='$del_id'";
   }
  
     $result1=mysql_query($updatesql);
     
		}
		
   if($result1){
				 echo '<script language=javascript>window.alert(\'操作成功\')</script>';
				 echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
				}
				
?>	
