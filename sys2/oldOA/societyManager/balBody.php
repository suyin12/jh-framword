
<?php

/*
 *    1_1:欠款人员
 *    1_2:挂账人员
 *    1_3:付款错误
 * 
 *   关于函数 unitBal 和 personalBal 中的 最后一个参数 
 *    1 表示挂账
 *    2 表示欠款
 *   函数contentRet($r1,$r2,$r3,$r4,$r5)参数对应分别为:单位,个人,残障金,失业金,缴交基数
* */
require_once '../settings.inc';
//$userID=$_SESSION[UserID];
//$userID='2';
$tablename="空表";
$table=$_GET['table'];
$month=$_GET['month'];
$preMonth=$month-1;
$i=$_GET['type'];
$sessionID=$_GET['manager'];
if(!$sessionID)
{
    $sessionID="%";
}
//$sessionID="2";//这里要删除掉
//$i='1_6';
switch($i)
{
    //工资明细与社保明细审核
    case '1_1':$tablename="缺少工资费用明细人员名单";$sql="select x.* from so_bal_2 x,(select a.field1,a.sessionID from bal2_concat a left join bal1_concat b ON a.field1 = b.field4 and a.month = b.month  WHERE a.month='$month' and b.field4 is null) y where x.field1=y.field1 and x.month='$month' and y.sessionID like '$sessionID'";break;
    case '1_2':$tablename="未能缴交社保人员名单";$sql="select x.* from so_bal_1 x,(select a.* from bal1_concat a left join bal2_concat b ON a.field4 = b.field1 and a.month = b.month WHERE a.month = '$month' and b.field1 is null) y where x.field4=y.field4 and x.month='$month' and x.sessionID like '$sessionID'";break;
    case '1_3':$tablename="费用缴交错误人员明细";$sql="select * from error_bal_person where month='$month";break;
//    for($i=3;$i<=12;$i++){ $sql.="y.field$i as SB$i ,"; }$sql.=" y.field13 as SB13 from so_bal_1 x,so_bal_2 y,error_bal t where x.field4=t.field1 and y.field1=t.field1 and x.month=y.month and x.month='$month' and  x.sessionID like '$sessionID'" ;break;
    //前程无忧资金往来备忘录与社保明细审核
    case '2_1':$tablename="缺少费用明细人员名单";$sql="SELECT x.month, x.field2 AS name, x.field1 AS SBNO, x.peopleID AS peopleID, x.field4 AS f1,x.field7 AS f7,y.field5 AS f5,x.field16 AS f16,x.field17 AS f17, y.field4 AS t1,x.field9 as h1 FROM (SELECT a.month, a.field2, a.field1, a.field4,a.field7,a.field9,b.field16,b.field17,a.sessionID, a.peopleID FROM so_bal_2 a LEFT JOIN so_bal_3 b ON a.peopleID = b.field2 AND a.month = b.month AND a.sessionID = b.sessionID WHERE a.month = '$month' AND a.sessionID = '$sessionID' AND b.field2 IS NULL )x LEFT JOIN so_bal_5 AS y ON x.peopleID = y.field2 AND x.month = y.month AND x.sessionID = y.sessionID union all SELECT x.month, x.field3 AS name,x.field1 AS SBNO, x.field2 AS peopleID, y.field4 AS f1, y.field7 AS f7,x.field5 AS f5, 0 as f16,0 as f17,x.field4 AS t1,0 as h1 FROM so_bal_5 x LEFT JOIN so_bal_2 y ON x.field2 = y.peopleID AND x.month = y.month AND x.sessionID = y.sessionID WHERE x.month = '$month' AND x.sessionID = '$sessionID' AND y.peopleID IS NULL";break;
    case '2_2':$tablename="未能缴交社保人员名单";$sql="select x.month,x.field0 as unitName,x.field1 as name,x.field2 as peopleID ,(x.field3+x.field4+x.field10+x.field11) as f2,(x.field7+x.field8) as t2 ,(x.field5+x.field9+x.field12) as h2,x.field16 as f16,x.field17 as f17,y.field7 AS f7,x.field15 as zFID from so_bal_3 x left join so_bal_2 y on x.field2=y.peopleID and x.month=y.month and x.sessionID=y.sessionID where x.month='$month' and x.sessionID='$sessionID' and  y.peopleID is null ";break;
    case '2_3':$tablename="费用缴交明细"; $sql="select x.month,x.unitName,x.SBNO,x.peopleID,x.name,x.f1,x.f2,x.h1,x.h2,y.field4 as t1 ,x.t2 ,x.m1,x.f7,y.field5 AS f5,x.zFID from (select a.month as month, b.field0 as unitName,a.field1 as SBNO,a.peopleID as peopleID,a.field2 as name,a.field4 as f1,(b.field3+b.field4+b.field10+b.field11) as f2,(b.field7+b.field8) as t2,a.field9 as h1,(b.field5+b.field9+b.field12) as h2,a.sessionID as sessionID,(b.field16+b.field17) as m1,a.field7 AS f7,b.field15 as zFID from so_bal_2 a,so_bal_3 b where a.month='$month' and a.sessionID='$sessionID' and b.month='$month'and b.sessionID='$sessionID' and a.peopleID=b.field2 ) x left join so_bal_5 y on x.peopleID=y.field2 and x.month=y.month and x.sessionID= y.sessionID" ;break;
    case '2_4':$tablename = "公积金不匹配人员名单";$sql="select x.month,x.field1,x.field2,x.field3,x.field4,x.field5,x.field6,x.field7,x.field8,x.field9,x.peopleID from so_bal_6 x left join so_bal_2 y on (x.peopleID=y.peopleID and x.month=y.month and x.sessionID=y.sessionID ) where y.peopleID is null and x.month='$month' and x.sessionID like '$sessionID'";break;
}



?>
<style>

html{ overflow-x:hidden;}
</style>
<link rel="stylesheet" type="text/css" media="screen"	href="../css/main.css" />
<form action="../phpToExcel/fieldMain.php" method="post">
<a href="balBody.php?type=<?php echo $i;?>&manage=<?php echo $sessionID?>&table=<?php echo $table;?>&month=<?php echo $month;?>" target="_blank">在打开的新窗口中查看</a>
<input type="submit" value="保存为EXCEL">
<input type="hidden"  name="sql"  value="<?php echo $sql;?>">
<input type="hidden"  name="tableName" value="<?php echo $tablename;?>"/>
<input type="hidden"  name="formName" value="<?php echo $i;?>"/>
<input type="hidden"  name="formMonth" value="<?php echo $month;?>"/>
</form>

<?php 

require_once '../pagenationURL.calss.php';
//echo $sql;
	$mypage = new Pagination();//使用分页类
	$mypage->page=$_GET['page'];//设置当前页
	$mypage->pagesize=10;//每页多少条记录
	$mypage->count=@mysql_num_rows(mysql_query($sql));//获取并设置数据库总记录数
	//echo "共有".$mypage->GetPages()."页记录<br/>";//输出有多少页
	$r_sql = $sql.$mypage->get_limit();//分页条件查询
	$ret = mysql_query($r_sql);
	if($_GET['table']=='so_bal_1')
{
    if($i=="1_2")
    {
?>
<table id="displayTable" width="98%" >
<thead align="center">
	<tr bgcolor="#CAE8EA" style="text-align:center;">
	<th rowspan="2">平帐月份</th>
	<th rowspan="2">费用月份</th>
    <th rowspan="2">单位名称</th>
    <th rowspan="2">姓名</th>
    <th rowspan="2">电脑号</th>
    
    <th rowspan="2">是否深户</th>
    <th rowspan="2">缴交基数</th>
   <th colspan="2">社保合计</th>
  </tr>
  <tr bgcolor="#CAE8EA" style="text-align:center;">
    <th>单位</th>
    <th>个人</th>
  </tr>
</thead>
<tbody>
<?php 


while ($row=@mysql_fetch_array($ret))
{
?>
<tr>
<td><?php echo $row['month']?></td>
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
<td><?php echo $row['field11']?></td>
<td><?php echo $row['field12']?></td>
<td><?php echo $row['field13']?></td>
<td><?php echo $row['field14']?></td>
<td><?php echo $row['field15']?></td>
<td><?php echo $row['field16']?></td>
<td><?php echo $row['field17']?></td>
<td><?php echo $row['field18']?></td>
<td><?php echo $row['field19']?></td>
<td><?php echo $row['field20']?></td>
<td><?php echo $row['field21']?></td>
<td><?php echo $row['field22']?></td>
</tr>
<?php 
}
?>
</tbody>
</table>
<?php 
}
if($i=="2_2")
{
?> 
<table id="displayTable" width="98%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
   <th rowspan="2">平帐月份</th>
   <th rowspan="2">单位名称</th>
   <th rowspan="2">姓名</th>
   <th rowspan="2">电脑号</th>
   <th rowspan="2">身份证</th>
   <th rowspan="2">应缴合计(社保明细)</th>
   <th rowspan="2">实收合计(备忘录的应收)</th>
   <th rowspan="2">差额</th>
   <th rowspan="2">应缴补缴(社保明细)</th>
   <th rowspan="2">实收补缴(备忘录的补缴)</th>
   <th rowspan="2">补缴差额</th>
   <th rowspan="2">应缴公积金(缴存明细)</th>
   <th rowspan="2">实收公积金(备忘录)</th>
   <th rowspan="2">公积金差额差额</th>
    <th rowspan="2">应收管理费</th>
     <th rowspan="2">实收管理费</th>
   <th rowspan="2">资金帐套</th>
</thead>
<tbody>
<?php 

while ($row=@mysql_fetch_array($ret))
{
?>
<tr bgcolor="#ffffff">
<td><?php echo $row['month'];?></td>
<td><?php echo $row['unitName'];?></td>
<td><?php echo $row['name'];?></td>
<td></td>
<td><?php echo $row['peopleID'];?></td>
<td></td>
<td><?php echo $row['f2'];?></td>
<td></td>
<td></td>
<td><?php echo $row['t2'];?></td>
<td></td>
<td></td>
<td><?php echo $row['h2'];?></td>
<td></td>
<td><?php echo $row['f7'];?></td>
<td><?php echo ($row['f16']+$row['f17']);?></td>

<td><?php echo $row['zFID'];?></td>
</tr>
<?php 
}
?>
</tbody>
</table>
<?php     
}
}
if($_GET['table']=='so_bal_2')
{
?>
<table id="displayTable" width="98%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr>
<th rowspan="2">平帐月份</th>
   <th rowspan="2">单位名称</th>
   <th rowspan="2">姓名</th>
   <th rowspan="2">电脑号</th>
   <th rowspan="2">身份证</th>
   <th rowspan="2">应缴合计(社保明细)</th>
		
   <th rowspan="2">实收合计(备忘录的应收)</th>

   <th rowspan="2">差额</th>
   <th rowspan="2">应缴补缴(社保明细)</th>
   <th rowspan="2">实收补缴(备忘录的补缴)</th>
   <th rowspan="2">补缴差额</th>
   <th rowspan="2">应缴公积金(缴存明细)</th>
   <th rowspan="2">实收公积金(备忘录)</th>
   <th rowspan="2">公积金差额差额</th>
   <th rowspan="2">应收管理费</th>
   <th rowspan="2">实收管理费</th>
   <th rowspan="2">资金帐套</th>
   
   </tr>
  </thead>
  <tbody>
<?php 
while ($row=@mysql_fetch_array($ret))
{
	
?>
<tr bgcolor="#ffffff">
<td><?php echo $row['month'];?></td>
<td></td>
<td><?php echo $row['name'];?></td>
<td><?php echo $row['SBNO'];?></td>
<td><?php echo $row['peopleID'];?></td>
<td><?php echo $row['f1'];?></td>

<td></td>
<td></td>
<td><?php echo $row['t1'];?></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><?php echo ($row['f7']+$row['f5']);?></td>
<td><?php echo ($row['f16']+$row['f17']);?></td>
<td></td>

</tr>
<?php 
}
?>
</tbody>
</table>
<?php 
}
if($_GET['table'] =="so_bal_6"){
?>
<table id="displayTable" width="98%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr>
<th >平帐月份</th>
 <th>不知道</th>
		<th>申报日期</th>
		<th>单位账号</th>
		<th>个人账号</th>
		<th>基数</th>
		<th>单位比例</th>
		<th>个人比例</th>
		<th>金额</th>	
		<th>缴存月份</th>
		<th>身份证号</th>
	
		
   </tr>
  </thead>
  <tbody>
<?php 
while ($row=@mysql_fetch_assoc($ret))
{	
	echo "<tr bgcolor='#ffffff'>";
	foreach ($row as $val){
		echo "<td>".$val."</td>";
	}
		echo "</tr>";
}
?>
</tbody>
</table>
<?php 	
}
if($_GET['table']=="error_bal")
{
    
    //   $r1->单位欠款/挂账,$r2->个人欠款/挂账,$r3->残障金,$r4->失业金
    function contentRet($r_1,$r_2,$r_3,$r_4,$r_5)
    {
        if($r_1>0){$content.="单位挂账/";} else{ if($r_1<0){ $content.="单位欠款/";} }
        if($r_2>0){$content.="个人挂账/";} else{ if($r_2<0){ $content.="个人欠款/";} }
       // 残障金再行处理 if($r3)
//       if($r_4>0){$content.="失业金挂账/";} else{ if($r_4<0){ $content.="失业金欠款/";} } 
       if($r_5!=0){$content.="缴交基数有误/";}
       return $content;
    }
?>
<!--  提示:<span>①负数表示欠款;<br/> ②残障金/失业金这两项表示的是费用表与社保明细表的相关项的差额,已经核算在内,即:0表示无欠款会挂账情况,正数则表示需要处理成挂账(A或者B)的部分,负数表示欠款;<br/>③欠款(负数),该项如果涉及到失业金的欠款,则该项的金额数为总欠款,不累加失业金[ 总欠款=欠款(负数)],如果出现残障金欠款则     总欠款=残障金欠款+欠款(负数)</span>-->
<table id="displayTable" width="98%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA" style="text-align:center;">
    <th rowspan="2">平帐月份</th>
<!--    <th rowspan="2">费用月份</th>-->
    <th rowspan="2">单位名称</th>
     <th rowspan="2">姓名</th>
     <th rowspan="2">电脑号</th>
     <?php if($i=="2_3"){
         ?>
   <th rowspan="2">身份证</th>
   <th rowspan="2">应缴合计(社保明细)</th>
   <th rowspan="2">实收合计(备忘录的应收)</th>
   <th rowspan="2">差额</th>
   <th rowspan="2">应缴补缴(社保明细)</th>
   <th rowspan="2">实收补缴(备忘录的补缴)</th>
   <th rowspan="2">补缴差额</th>
   <th rowspan="2">应缴公积金(缴存明细)</th>
   <th rowspan="2">实收公积金(备忘录)</th>
   <th rowspan="2">公积金差额差额</th>
   <th rowspan="2">应收管理费</th>
   <th rowspan="2">实收管理费</th>
   <th rowspan="2">资金帐套</th>
    <?php 
     }
     else 
     {
    ?>
<!--    <th rowspan="2">电脑号</th>-->
    <th rowspan="2">挂帐A(不包括残障金,其他等)</th>
    <?php 
     }
    ?>
   </thead>
  <tbody>
 <?php 
while ($row=@mysql_fetch_array($ret))
{
?>

<tr bgcolor="#ffffff" style="text-align:center;">
<td><?php echo $row['month'];?></td>
<td><?php echo $row['unitName'];?></td>
<td><?php echo $row['name'];?></td>
<td><?php echo $row['SBNO'];?></td>
<td><?php echo $row['peopleID'];?></td>
<td><?php echo $row['f1']?></td>
<td><?php echo $row['f2']?></td>
<td><?php echo bcsub($row['f2'],$row['f1'],2);?></td>
<td><?php echo $row['t1'];?></td>
<td><?php echo $row['t2'];?></td>
<td><?php echo bcsub($row['t2'],$row['t1'],2);?></td>
<td><?php echo $row['h1'];?></td>
<td><?php echo $row['h2'];?></td>
<td><?php echo bcsub($row['h2'],$row['h1'],2);?></td>
<td><?php echo ($row['f7']+$row['f5']);?></td>
<td><?php echo $row['m1'];?></td>
<td><?php echo $row['zFID'];?></td>
</tr>

<?php 
}
?>
 </tbody>
 </table>
<?php 

}
$mypage->page_list($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&');
?>
