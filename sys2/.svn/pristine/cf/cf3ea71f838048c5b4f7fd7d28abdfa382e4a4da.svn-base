<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
require_once '../header/recruitmentHeader.php';
if(!defined('ALLOW'))exit();
$userName=$_SESSION['UserName'];
//$userName="陈建恒";
include_once ("../settings1.inc");
$staleDateDay=time();
$autoSql="select IndexID,staleDated from cmsware_publish_147 where ytongzhi='2'";
$autoRet=mysql_query($autoSql);
while(($autoRow=mysql_fetch_array($autoRet))==TRUE){
    if($staleDateDay>$autoRow['staleDated']&&$autoRow['staleDated']>'0')
    {
        date("Y-m-d",$autoRow['staleDated']);
         $staleDatedSql="update cmsware_publish_147 set ytongzhi='0',buhege='1',yluyong='0' where IndexID='$autoRow[IndexID]' ";
        mysql_query($staleDatedSql);
    }

}
?>

<body>
		<script type="text/javascript" src="../js/page.js"></script>
		
     <script language=javascript>
     //分页控制
     window.onload = function(){
 		page = new Page(10,'displayTable','displaybody'); };

 		//查询条件控制
		function checkData()
		{
			if(document.searchForm.elements["status"].value==0&&document.searchForm.elements["status2"].value==0&&document.searchForm.elements["searchTxt"].value!=0){
			     alert("请选择筛选条件!");
			     document.searchForm.elements["status"].focus();
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
	 您现在的位置是:简历浏览-><a href="quickWork.php">快速求职简历</a>
	 </div>
<table width="90%" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>未通知人数：&nbsp;
    <?
  
    $TRecord1 = mysql_query("SELECT * FROM  cmsware_publish_147 where ytongzhi=0 and yluyong=0 and buhege=0");
    $RecordCount1 = mysql_num_rows($TRecord1);
    echo "<span style='color:red'>$RecordCount1</span>";
    ?>    </td>
    <td>已通知人数：&nbsp;
    <?
        $TRecord2 = mysql_query("SELECT * FROM  cmsware_publish_147 where ytongzhi=1");
    $RecordCount2 = mysql_num_rows($TRecord2);
    echo  "<span style='color:red'>$RecordCount2</span>";
    ?>    </td><!--
    <td>已录用人数：&nbsp;
   <?
//    $TRecord3 = mysql_query("SELECT * FROM  cmsware_publish_147 where  yluyong=1");
//    $RecordCount3 = mysql_num_rows($TRecord3);
//    echo  "<span style='color:red'>$RecordCount3</span>";
    ?>    </td>
    --><td>储备人数：&nbsp;
   <?
    $TRecord6 = mysql_query("SELECT * FROM  cmsware_publish_147 where  ytongzhi=2 and yluyong=0 and buhege=0");
    $RecordCount6 = mysql_num_rows($TRecord6);
    echo  "<span style='color:red'>$RecordCount6</span>";
    ?>    </td>
    <td>不合格人数：&nbsp;
   <?
    $TRecord4 = mysql_query("SELECT * FROM  cmsware_publish_147 where  buhege=1");
    $RecordCount4 = mysql_num_rows($TRecord4);
    echo  "<span style='color:red'>$RecordCount4</span>";
    ?> </td>
	<td>当天投递人数：&nbsp;
   <?
    $t=time();
    $today=mktime(date("m",$t),date("d",$t),date("Y",$t)); 
    //echo $today;
    $TRecord5 = mysql_query("SELECT * FROM  cmsware_publish_147 where  PublishDate='$today'");
    $RecordCount5 = mysql_num_rows($TRecord5);
    echo "<span style='color:red'>$RecordCount5</span>";
    ?> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<form  name="searchForm" id="searchForm" action="" method="post">
<div align="center">
简历状态:
<select name="status">
<option value="">--所有简历--</option>
<option value="0" <?php if($_POST[status]=="0") echo "selected";?>>未通知</option>
<option value="ytongzhi" <?php if($_POST[status]=="ytongzhi") echo "selected";?>>已通知</option>
<option value="buhege" <?php if($_POST[status]=="buhege") echo "selected";?>>不合格</option>
<option value="2" <?php if($_POST[status]=="2") echo "selected";?>>储备</option>
</select>
筛选条件:
<select name="status2">
<option value="0">--请选择--</option>
<option value="name" <?php if($_POST[status2]=="name") echo "selected";?>>姓名</option>
<option value="xueli" <?php if($_POST[status2]=="xueli") echo "selected";?>>学历</option>
<option value="sex" <?php if($_POST[status2]=="sex") echo "selected";?>>性别</option>
<option value="yixiang" <?php if($_POST[status2]=="yixiang") echo "selected";?>>求职意向</option>
<option value="quyu" <?php if($_POST[status2]=="quyu") echo "selected";?>>求职区域</option>
</select>
<input name="searchTxt" type="text" value="<?php echo $_POST[searchTxt];?>"/>
<input name="search" type="submit" onClick="return checkData()"  />

</div>

<?php
if(isset($_POST['search'])){
    $status=$_POST['status'];
    
    $status2=$_POST['status2'];
    $searchTxt=$_POST['searchTxt'];
   if($_POST['status2']=="xueli"){
      $j=trim($_POST['searchTxt']); 
       switch($j)
       {
           case "高中": $searchTxt=1;break;
           case "中专": $searchTxt=2;break;
           case "中技": $searchTxt=3;break;
           case "大专": $searchTxt=4;break;
           case "本科": $searchTxt=5;break;
           case "研究生": $searchTxt=6;break;
           case "硕士": $searchTxt=7;break;
           case "博士": $searchTxt=8;break;
           case "初中": $searchTxt=9;break;
       }
   }
   if($_POST['status2']=="sex"){
      $j=trim($_POST['searchTxt']); 
       switch($j)
       {
           case "男": $searchTxt=1;break;
           case "女": $searchTxt=0;break;
       }
   }
   if($_POST['status']!="")
   {
       if($status=="0"||$status=="2")
       {
          $searchSql="SELECT * FROM  cmsware_publish_147 where ytongzhi='$status'  and $status2 like '%$searchTxt%' and yluyong='0' ";
           
       }
       else{
          
        $searchSql="SELECT * FROM  cmsware_publish_147 where $status='1' and $status2 like '%$searchTxt%'";
        }
   } 
   else{
       $searchSql="SELECT * FROM  cmsware_publish_147 where $status2 like '%$searchTxt%'";
   }
}

$result=mysql_query($searchSql);
//echo "dfasf=".mysql_num_rows($result);
 if($result){
?>
	<br/><br/>
<table id="displayTable"width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
  <tr bgcolor="#CAE8EA">
    <th  height="30" ><div align="center" class="STYLE1">√</div></th>
     <th  height="30" ><div align="center" class="STYLE1">来源</div></th>
    <th  height="30" ><div align="center" class="STYLE1">姓 名</div></th>
    <th height="30" ><div align="center" class="STYLE1">姓 别</div></th>
    <th  height="30" ><div align="center" class="STYLE1">身份证号码</div></th>
    <th  height="30" ><div align="center" class="STYLE1">年 龄</div></th>
    <th  height="30" ><div align="center" class="STYLE1">联系电话</div></th>
    <th  height="30" ><div align="center" class="STYLE1">学 历</div></th>
    <th  height="30" ><div align="center" class="STYLE1">所学专业</div></th>
    <th height="30" ><div align="center" class="STYLE1">求职意向</div></th>
    <th  height="30" ><div align="center" class="STYLE1">求职区域</div></th>
	<th  height="30" ><div align="center" class="STYLE1">注册日期</div></th>
	<?php if($_POST[status]=="2"){?>
	<th  height="30" ><div align="center" class="STYLE1">过期日期</div></th>
	<th  height="30" ><div align="center" class="STYLE1">处理人员</div></th>
	<th  height="30" ><div align="center" class="STYLE1">备注</div></th>
	<?php }?>
  </tr>
  <tbody id="displaybody">
     <?  $i = 1;
//mysql_select_db("sq_user")or die("cannot select DB");
while(($row=mysql_fetch_array($result))==true) {
   
$IndexID=$row[IndexID];
$name=$row[name];
$sex=$row[sex];
//$string = time(); 
//$PublishDate=strftime("%Y-%m-%d", time($row[PublishDate])) ; 
$PublishDate=date('y-m-d',$row[PublishDate]);
$shenfenzheng=$row[shenfenzheng];
//echo "大法师法=".$nianling=$row[nianling];
$dianhua=$row[dianhua];
$xueli=$row[xueli];
$zhuanye=$row[zhuanye];
$zhuanye2=$row[zhuanye2];
$yixiang=$row[yixiang];
$yixiang2=$row[yixiang2];
$quyu=$row[quyu];
$ytongzhi=$row[ytongzhi];
$yluyong=$row[yluyong];
$buhege=$row[buhege];
$userName=$row[userName];
//$managerSql="select UserName from cwps_user where UserID='$sessionID'";
//$managerRet=mysql_query($managerSql);
//$managerRow=mysql_fetch_array($managerRet);
?>
  <tr>
    <td bgcolor="#F2F2F2"><input name="checkbox[]" type="checkbox" id="checkbox" value="<? echo $row['IndexID']; ?>"></td>
    <td height="30" bgcolor="#F2F2F2">&nbsp;<?echo $row['comeFrom'];?></td>
    <td height="30" bgcolor="#F2F2F2">&nbsp;<?echo $name;?></td>
    <td height="30" bgcolor="#F2F2F2"><div align="center"><? if ($sex==1) { echo "男";} else {echo "女";}?></div></td>
    <td height="30" bgcolor="#F2F2F2">&nbsp;<? echo $shenfenzheng;?></td>
    <td height="30" bgcolor="#F2F2F2"><div align="center">
    <? 
    if($shenfenzheng!=""){
     $changdu= mb_strlen($shenfenzheng, 'GBK'); 
     $showtime=date("Y");
     $asa=substr($shenfenzheng,6,4);
     $asb="19".substr($shenfenzheng,6,2);
    if ($changdu==18||$changdu==17)  {echo $nl=$showtime- $asa;} elseif ($changdu==15){echo $nl=$showtime- $asb;} else {echo "X";}
    }
    else{
        echo $row['nianling'];
    }
?>
    
    </div></td>
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
    <td height="40" bgcolor="#F2F2F2">&nbsp;<? if ($zhuanye=="") {echo $zhuanye2;} else {echo $zhuanye;}?></td>
    <td height="40" bgcolor="#F2F2F2">&nbsp;<? if ($yixiang=="0") {echo $yixiang2;} else {echo $yixiang;}?></td>
    <td height="40" bgcolor="#F2F2F2">&nbsp;<? echo $quyu;?></td>
    <td height="40" bgcolor="#F2F2F2">&nbsp;<? echo $PublishDate;?></td>
    <?php if($_POST[status]=="2"){?>
     <td height="40" bgcolor="#F2F2F2">&nbsp;<?  if($row['staleDated']) echo date("y-m-d",$row['staleDated']);?></td>
    <td height="40" bgcolor="#F2F2F2">&nbsp;<? echo $row['userName'];?></td>
    <td height="40" bgcolor="#F2F2F2">&nbsp;<? echo $row['comments'];?></td>
    <?php }?>
  </tr>
    <?
  $i++;
}

?> 
 </tbody> 
  
 
</table>
<div id="foot">
		<div class="button">
		
  <a href="#" onClick="$('input[type=checkbox]').attr('checked', 'checked')">全选</a>
  <a href="#" onClick="$('input[type=checkbox]').removeAttr('checked')">全不选 </a>
  <?php 
  switch ($_POST['status']) {
  	case "0":echo '<input type="submit" name="tongzhi" value="通知" onclick="javascript:return checkselect(searchForm)" />
                   <input type="submit" name="buhege" value="不合格" onclick="javascript:return checkselect(searchForm) " />
                   <input type="submit" name="chubei" value="储备" onclick="javascript:return checkselect(searchForm)" />'
  	;
  	break;
  	
  	case "2":echo '<input type="submit" name="tongzhi" value="通知" onclick="javascript:return checkselect(searchForm)" />
                   <input type="submit" name="buhege" value="不合格" onclick="javascript:return checkselect(searchForm) " />
                   <input type="submit" name="chubei" value="延期" onclick="javascript:return checkselect(searchForm)" />'
  	;
  	break;
  	
  	case "buhege":echo '<input type="submit" name="tongzhi" value="通知" onclick="javascript:return checkselect(searchForm)" />
                   <input type="submit" name="chubei" value="储备" onclick="javascript:return checkselect(searchForm)" />'
  	;
  	break;
  	case "ytongzhi":echo '<input type="submit" name="buhege" value="不合格" onclick="javascript:return checkselect(searchForm) " />
                   <input type="submit" name="chubei" value="储备" onclick="javascript:return checkselect(searchForm)" />'
  	;
  	break;
  }
  
  ?>
	  </div>

<div id="pager" class="pager" style="margin-top:5px;float:right">
<a href="#" onClick="page.firstPage();">首页</a>
<a href="#" onClick="page.prePage();">上一页</a>
<a href="#" onClick="page.nextPage();">下一页</a>
<a href="#" onClick="page.lastPage();">尾页</a>
</div>
</div>




    <?
 } 
 ?>
</form>
<?php 
        mysql_select_db("sq_cnhrmo")or die("cannot select DB");
        $checkbox= $_POST[checkbox];	
		for($i=0;$i<count($checkbox);$i++){
		$del_id = $checkbox[$i];
		
   if(isset($_POST['tongzhi']))
   {
      
      $updatesql="update cmsware_publish_147 set ytongzhi='1',buhege='0',yluyong='0',userName='',staleDated='' where IndexID='$del_id'";
   }
   if(isset($_POST['buhege']))
   {
       $updatesql="update cmsware_publish_147 set buhege='1',ytongzhi='0',yluyong='0' where IndexID='$del_id'";
   }
//   if(isset($_POST['luyong']))
//   {
//       $updatesql="update cmsware_publish_147 set yluyong='1',ytongzhi='0',buhege='0', sessionID='$userName' where IndexID='$del_id'";
//   }
   if(isset($_POST['chubei']))
   {
       $staleDated=time()+90*24*60*60;
      $updatesql="update cmsware_publish_147 set yluyong='0',ytongzhi='2',buhege='0',staleDated='$staleDated' where IndexID='$del_id'";
   }
     $result1=mysql_query($updatesql);
		}
   if($result1){
				 echo '<script language=javascript>window.alert(\'操作成功\')</script>';
				echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
				}
?>
	</body>
	</html>
</div>
</body>
</html>