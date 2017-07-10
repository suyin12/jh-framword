<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
require_once '../header/recruitmentHeader.php';
if(!defined('ALLOW'))exit();
?>

<body text="#000000" link="#000000" vlink="#000000" alink="#000000" topmargin="0" leftmargin="2" marginwidth="0" marginheight="0">
<script type="text/javascript">

function checkData()
{
	if(document.insertform.name.value.length==0){
	     alert("姓名不能为空!");
	     document.insertform.name.focus();
	     return false;
	    }
 	if(document.insertform.yixiang.value.length==0){
	     alert("求职意向不能为空!");
	     document.insertform.yixiang.focus();
	     return false;
	    }
		if(document.insertform.dianhua.value.length==0){
	     alert("联系电话不能为空!");
	     document.insertform.dianhua.focus();
	     return false;
	    }

	  

}
</script>

<?php 
include_once ("../settings1.inc");
//	ini_set(error_reporting,E_ALL);
?>
<div id="headindex">
	 您现在的位置是:简历浏览-><a href="insertQuickWork.php">添加求职简历</a>
	 </div>
<div style="margin-left:100px;">
<form name="insertform" method="post" action="" >
<table>
<tr><td>姓名:</td><td><input type="text" name="name" /></td></tr>
<tr><td>身份证:</td><td><input type="text" name="shenfenzheng" /></td></tr>
<tr><td>年龄:</td><td><input type="text" name="nianling" /></td></tr>
<tr><td>性别:</td><td>
<select name="sex">
<option value="">请选择</option>
<option value="1">男</option>
<option value="0">女</option>
</select>
<tr><td>学历:</td><td>
<select name="xueli">
<option value="">请选择</option>
<option value="1">高中</option>
<option value="2">中专</option>
<option value="3">中技</option>
<option value="4">大专</option>
<option value="5">本科</option>
<option value="6">研究生</option>
<option value="7">硕士</option>
<option value="8">博士</option>
<option value="9">初中</option>
</select>
</td></tr>
<tr><td>所学专业:</td><td><input type="text" name="zhuanye" /></td></tr>
<tr><td>求职意向:</td><td><input type="text" name="yixiang" /></td></tr>
<tr>
<td>求职区域:</td>
<td>
<select name="quyu">
<option value="不限">不限</option>
<option value="福田区">福田区</option>
<option value="罗湖区">罗湖区</option>
<option value="南山区">南山区</option>
<option value="宝安区">宝安区</option>
<option value="龙岗区">龙岗区</option>
<option value="盐田区">盐田区</option>
</select>
</td>
</tr>
<tr><td>联系电话:</td><td><input type="text" name="dianhua" /></td></tr>
<tr><td>备注:</td><td><textarea name="comments" rows="6" cols="40"></textarea></td></tr>
</table>
<br><br>
<input type="submit" name="insert" value="提交" onClick="return checkData();"/>
</form>
</div>
<?php 

    $indexIDSql="select max(IndexID) from cmsware_publish_147";
	$indexIDRet=mysql_query($indexIDSql);
	$indexIDRow=mysql_fetch_array($indexIDRet);
	$indexID=$indexIDRow['max(IndexID)']+1;
	$PublishDate=time();
$today=time();
if(isset($_POST['insert']))
{
	
	
    $insertSql="insert into cmsware_publish_147 set IndexID='$indexID',comeFrom='本地',name='$_POST[name]',sex='$_POST[sex]',
               nianling='$_POST[nianling]',zhuanye='$_POST[zhuanye]',
              shenfenzheng='$_POST[shenfenzheng]',xueli='$_POST[xueli]',yixiang='$_POST[yixiang]',PublishDate='$PublishDate',
              quyu='$_POST[quyu]',dianhua='$_POST[dianhua]',comments='$_POST[comments]',ytongzhi='1',buhege='0',yluyong='0'"; 
  $insertRet=mysql_query($insertSql);
  if(mysql_affected_rows()>0)
  {
       echo '<script language=javascript>window.alert(\'操作成功\')</script>';
	   echo "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
        } 
    
}
?>
</body>
</html>
</div>
</body>
</html>