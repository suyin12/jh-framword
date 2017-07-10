<?php
/*
 * 人员核对 0->停保     1->新增   2->修改   5->不确定    6->错误提示
 * 
 * 险种核对 1->正确信息      5->不确定    6->错误提示    
* */
require_once '../settings.inc';
$userID=$_SESSION['exp_user']['mID'];
//$userID='1';
$tablename="空表";
$i=$_GET['type'];
//$i='1_6';
switch($i)
{
    //正常在册与已审核人员审核
    case '1_0':$tablename="在册与审核停保人数信息";$sql="select c.* from society1 a right join society3 c on a.field2=c.field2 where c.sessionID='$userID' and c.field10='0' and a.field2 is null";break;
    case '1_1':$tablename="在册与审核新增人数信息";$sql="select c.* from society1 a right join society3 c on a.field2=c.field2 where c.sessionID='$userID' and c.field10='1' and a.field2 is not null";break;
    case '1_2':$tablename="在册与审核修改人数信息";$sql="select c.* from society1 a right join society3 c on a.field2=c.field2 where c.sessionID='$userID' and c.field10='2' and a.field2 is not null";break;
    case '1_5':$tablename="在册与审核不确定人数信息";$sql="";break;
    case '1_6':$tablename="在册与审核人数错误信息";$sql="SELECT c.* FROM society1 a RIGHT JOIN society3 c ON a.field2 = c.field2 WHERE c.sessionID='$userID' and ((c.field10='1' or c.field10='2')  AND a.field2 IS NULL)or(c.field10='0' and a.field2 is not null)";break;
    //已审核与申报表人员审核
    case '2_0':$tablename="审核表与申报表停保人数信息";$sql="select b.* from society2 b inner join society3 c on b.field2=c.field2 where c.sessionID='$userID' and c.field10='0' and b.field10=c.field10";break;
    case '2_1':$tablename="审核表与申报表新增人数信息";$sql="select b.* from society2 b inner join society3 c on b.field2=c.field2 where c.sessionID='$userID' and c.field10='1' and b.field10=c.field10";break;
    case '2_2':$tablename="审核表与申报表修改人数信息";$sql="select b.* from society2 b inner join society3 c on b.field2=c.field2 where c.sessionID='$userID' and c.field10='2' and b.field10=c.field10";break;
    case '2_5':$tablename="审核表与申报表不确定人数信息";;break;
    case '2_6':$tablename="审核表与申报表人数错误信息";$sql="select * from error_s2_s3 where sessionID='$userID'";break;
    //正常在册与申报表人员审核 
    case '3_0':$tablename="在册与申报表停保人数信息";$sql="select b.* from society1 a right join society2 b on a.field2=b.field2 where b.sessionID='$userID' and b.field10='0' and a.field2 is  null";break;
    case '3_1':$tablename="在册与申报表新增人数信息";$sql="select b.* from society1 a right join society2 b on a.field2=b.field2 where b.sessionID='$userID' and b.field10='1' and a.field2 is not null";break;
    case '3_2':$tablename="在册与申报表修改人数信息";$sql="select b.* from society1 a right join society2 b on a.field2=b.field2 where b.sessionID='$userID' and b.field10='2' and a.field2 is not null";break;
    case '3_5':$tablename="在册与申报表不确定人数信息";break;
    case '3_6':$tablename="在册与申报表人数错误信息";$sql="SELECT b.* FROM society1 a RIGHT JOIN society2 b ON a.field2 = b.field2 WHERE b.sessionID='$userID' and ((b.field10='1' or b.field10='2')  AND a.field2 IS NULL)or(b.field10='0' and a.field2 is not null)";break;
    //下面是 上月正常在册与当月正常在册
    case '4_0':$tablename="当月与上月在册停保人数信息";$sql="select * from society2 where sessionID='$userID' and field10='0'";break;
    case '4_1':$tablename="当月与上月在册新增人数信息";$sql="select * from society2 where sessionID='$userID' and field10='1'";break;
    case '4_2':$tablename="当月与上月在册表其他修改信息";$sql="select * from society2 where sessionID='$userID' and field10='2'";break;
    case '4_5':$tablename="申报表中重复人数信息";$sql="select a.* from society2tmp a,(select field2 c from society2tmp where sessionID='$userID' group by field2 having count(field2)>1) b where a.field2=b.c and a.sessionID='$userID' order by a.ID ";break;
    case '4_6':$tablename="当月与上月在册表人数错误信息";$sql="select * from error_s1_s3 where sessionID='$userID'";break;
   // case '4_6':$tablename="当月与上月在册表人数错误信息";$sql= "SELECT * FROM error_s1_s3 x LEFT JOIN ( SELECT a.field2 FROM society2tmp a, (SELECT MAX( ID ) c FROM 
// society2tmp GROUP BY field2 HAVING count( field2 ) >1 AND sum( field10 ) =1 )b WHERE a.ID = b.c AND a.sessionID='$userID')y ON x.field2 = y.field2 WHERE y.field2 IS NULL and
 // x.sessionID='$userID'";break;//注意要加上修改人的名单field10="2"的错误,这句很乱下午继续研究
    
    //正常在册与已审核表险种核对
    case '5_1':$tablename="在册与审核险种正确信息";$sql="SELECT x .* FROM society2 x LEFT JOIN ( SELECT a.field2 FROM so2_risk_concat a LEFT JOIN so1_risk_concat b ON a.field2 = b.field2 WHERE a.sessionID = '$userID' AND a.compareStr = b.compareStr AND b.field2 IS NOT NULL )y ON x.field2 = y.field2 where x.sessionID = '$userID' and y.field2 is not null";break;
    case '5_5':$tablename="在册与审核险种不确定信息";$sql="SELECT x .* FROM society2 x LEFT JOIN ( SELECT a.field2 FROM so2_risk_concat a LEFT JOIN so1_risk_concat b ON a.field2 = b.field2 WHERE a.sessionID = '$userID' AND  b.field2 IS  NULL )y ON x.field2 = y.field2 where x.sessionID = '$userID' and y.field2 is not null";break;
    case '5_6':$tablename="在册与审核险种错误信息";$sql="SELECT x .* FROM society2 x LEFT JOIN ( SELECT a.field2 FROM so2_risk_concat a LEFT JOIN so1_risk_concat b ON a.field2 = b.field2 WHERE a.sessionID = '$userID' AND a.compareStr <>b.compareStr AND b.field2 IS NOT NULL )y ON x.field2 = y.field2 where x.sessionID = '$userID' and y.field2 is not null";break;
    
    //申报表与已审核表险种核对
    case '6_1':$tablename="申报表与审核险种正确信息";$sql="SELECT x .* FROM society2 x LEFT JOIN ( SELECT a.field2 FROM so2_risk_concat a LEFT JOIN so3_risk_concat b ON a.field2 = b.field2 WHERE a.sessionID = '$userID' AND a.compareStr = b.compareStr AND b.field2 IS NOT NULL )y ON x.field2 = y.field2 where x.sessionID = '$userID' and y.field2 is not null";break;
    case '6_5':$tablename="申报表与审核险种不确定信息";$sql="SELECT x .* FROM society2 x LEFT JOIN ( SELECT a.field2 FROM so2_risk_concat a LEFT JOIN so3_risk_concat b ON a.field2 = b.field2 WHERE a.sessionID = '$userID' AND  b.field2 IS  NULL )y ON x.field2 = y.field2 where x.sessionID = '$userID' and y.field2 is not null";break;
    case '6_6':$tablename="申报表与审核险种错误信息";$sql="SELECT x .* FROM society2 x LEFT JOIN ( SELECT a.field2 FROM so2_risk_concat a LEFT JOIN so3_risk_concat b ON a.field2 = b.field2 WHERE a.sessionID = '$userID' AND a.compareStr <>b.compareStr AND b.field2 IS NOT NULL )y ON x.field2 = y.field2 where x.sessionID = '$userID' and y.field2 is not null";break;
    
    //    default:exit();
}
echo $sql;
?>

<body>
<style>
html{ overflow-x:hidden;}
</style>
<div id="mainBody">
<form action="../phpToExcel/main.php" method="post">
<a href="body.php?type=<?php echo $i;?>" target="_blank">在打开的新窗口中查看</a>
<input type="submit" value="保存为EXCEL">
<input type="hidden"  name="sql"  value="<?php echo $sql;?>">
<input type="hidden"  name="tableName" value="<?php echo $tablename;?>"/>
</form>

<?php 
require_once '../pagenationURL.calss.php';
	$mypage = new Pagination();//使用分页类
	$mypage->page=$_GET['page'];//设置当前页
	$mypage->pagesize=10;//每页多少条记录
	$mypage->count=@mysql_num_rows(mysql_query($sql));//获取并设置数据库总记录数
	//echo "共有".$mypage->GetPages()."页记录<br/>";//输出有多少页
	$r_sql = $sql.$mypage->get_limit();//分页条件查询
	$ret = mysql_query($r_sql);
?>

<table id="displayTable" width="95%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA">
<th>姓名</th>
<th>电脑号</th>
<th>身份证号码</th>
<th>户口</th>
<th>工资</th>
<th>养老</th>
<th>医疗</th>
<th>工伤</th>
<th>失业</th>
<th>住房</th>
<th>备注</th>
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
$mypage->page_list($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&');
?>
</div>
</body>
