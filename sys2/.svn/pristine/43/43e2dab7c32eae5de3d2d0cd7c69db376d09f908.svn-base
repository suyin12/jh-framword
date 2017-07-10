<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/*
 * ytongzhi=
  0 -> 未通知
  1 -> 已通知
  2 -> 储备,复试不合格
  3 -> 复试合格
  4 -> 待处理人员
  5 -> 上岗 
  
  ytongzhi=0,yluyong=1,buhege=0 ->已录用
* */
session_start();
	if($_SESSION['Cqyyh']!=13)
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>非本公司员工无权访问</p>";
	}
	else{
$userName=$_SESSION['UserName'];
//$userName='汪慧研';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--		<link href="../skin/pale_blue_skin/css/fixedKHJL.css" rel="stylesheet" />-->
<link href="./js/fixedTable.css" rel="stylesheet" />
<style>
body {
	font: normal 12px auto "Trebuchet MS", Verdana, Arial, Helvetica,
		sans-serif;
	color: #4f6b72;
}

p {
	color: bule;
	font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
}

table {
	font-size: 12px;
}

td.edit {
	background-color: #99CCCC;
	color: #000000;
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
<body>
<p>操作成功后刷新页面,可见结果</p>
<?php 
//ini_set('error_reporting', E_ALL);

require_once '../settings1.inc';
$today=time();
$num=0;
$checkbox = $_POST['checkbox'];
$CKLen = count($checkbox);
?>
<form name="searchForm" id="searchForm" action="" method="post" enctype="multipart/form-data">
<table id="displayTable" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
	<tr bgcolor="#CAE8EA">
		<th>姓名</th>
		<th>身份证</th>
		<th>求职意向</th>
		<th>求职区域</th>
		<th>备注</th>
	</tr>
<?php

for ($i = 0; $i < $CKLen; $i ++) {
    $del_id = $checkbox[$i];
    $searchSql = "SELECT * FROM  cmsware_publish_147 where IndexID='$del_id'";
    $searchRet = mysql_query($searchSql);
    $searchRow = @mysql_fetch_array($searchRet);
    ?>

<tr bgcolor="#f2f2f2">
		<td><?php echo $searchRow['name']?><input type="hidden"  name=checkbox[] value="<?php echo $checkbox[$i];?>"/></td>
		<td><?php echo $searchRow['shenfenzheng']?></td>
		<td><?php  if ($searchRow['yixiang']=="0") {echo $searchRow['yixiang2'];} else {echo $searchRow['yixiang'];} ?></td>
		<td><?php echo $searchRow['quyu']?></td>
		<td><textarea name="<?php echo "comment_".$searchRow['IndexID']; ?>" rows="4"><?php echo $searchRow['comments']?></textarea></td>
</tr>

<?php 
if(isset($_POST['ffff']))
    {
       $commentName="comment_".$searchRow['IndexID'];
       $comment=$_POST[$commentName];
        $staleDated=time()+90*24*60*60;
       $detailSql="update cmsware_publish_147 set ytongzhi='2',comments='$comment',userName='$userName',staleDated='$staleDated' where IndexID='$searchRow[IndexID]'";
       $detailRet=mysql_query($detailSql);
       if(mysql_affected_rows()>0)
       {
           ++$num;
       }
    }
}
if($num>0)
{
     echo '<script language=javascript>window.alert(\'操作成功\')</script>';
}
?>

</table>

<input type="submit" name="ffff" value="提交" />
</form>
<?php
  
	}

?>
</body>
</html>
</div>
</body>
</html>