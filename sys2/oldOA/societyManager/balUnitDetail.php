<?php
/*

* 差点做错了....差点把欠款,挂账做了合计....犯错了
* */
require_once '../settings.inc';
$month=$_POST['month'];
$sessionID=$_POST['manager'];
if(!$sessionID)
{
    $sessionID="%";
}
$i=$_POST['fromUrl'];
switch($i)
{
    case "bal":$sql="SELECT month,field1,field2,sum(r1) as r1,sum(r2) as r2, sum(r3) as r3,sum(r4) as r4,sum(r5) as r5,sessionID,SBNO FROM `error_bal_person` where month='$month' and sessionID like '$sessionID' group by unitName";break;
    case "51job":$sql="SELECT month,name,unitName,sum(r1) as r1,sum(r2) as r2,sessionID FROM `error_bal_person_2` where month='$month' and sessionID like '$sessionID' group by unitName";
                 $sql="select x.* from so_bal_3 x,(select a.* from bal3_concat a left join bal2_concat_2 b ON a.field2= b.peopleID and a.month = b.month WHERE a.month = '$month' and b.peopleID is null) y where x.field2=y.field2 and( x.field3<>0 or x.field4<>0) and x.month='$month' and x.sessionID like '$sessionID'";break;
}
//echo $sql;
$ret = mysql_query($sql);
function unitName($name)
{
    $unitNameSql="select companyName from companyName where companyID like '$name'";
    $unitNameRet=mysql_query($unitNameSql);
    $unitNameRow=@mysql_fetch_array($unitNameRet);
    $N=$unitNameRow['companyName'];
    return $N;
}


function content($unitName,$fromUrl,$mon)
{
    switch($fromUrl)
    {
        case "bal": $contentSql="select name,r1,r2,r3,r4,r5 from error_bal_person where unitName='$unitName' and month='$mon'";break;
        case "51job":  $contentSql="select name,r1,r2 from error_bal_person_2 where unitName='$unitName' and month='$mon'";break;
    }
//    echo $contentSql;
    $contentRet=mysql_query($contentSql);
    
    while ($contentRow=@mysql_fetch_array($contentRet))
    {
        if($contentRow['r1']>0){ $content.=$contentRow['name']." 单位挂账: ".$contentRow['r1']." 元<br/>";}
        if($contentRow['r1']<0){ $content.=$contentRow['name']." 单位欠款: <span style='color:red'>".$contentRow['r1']." 元</span><br/>";} 
        if($contentRow['r2']>0){ $content.=$contentRow['name']." 个人挂账: ".$contentRow['r2']." 元<br/>";}
        if($contentRow['r2']<0){ $content.=$contentRow['name']." 个人欠款: <span style='color:red'>".$contentRow['r2']." 元</span><br/>";} 
//        if($contentRow['r4']!=0){$content.="缴交基数错误<br/>";}
        if($contentRow['r5']!=0){$content.=$contentRow['name']." 缴交基数错误<br/>";}
    }
    return $content;
}


?>
<p>已确定的单位挂账/欠款概况</p>
<table id="displayTable" width="98%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA" style="text-align:center;">
    <th rowspan="2">平帐月份</th>
    <th rowspan="2">费用月份</th>
    <th rowspan="2">单位名称</th>
<!--    <th rowspan="2">应缴保险费</th>-->
<!--    <th rowspan="2">实缴保险费</th>-->
<?php 
if($i=="51job")
{
?>
 <th colspan="2">挂帐</th>
    <th colspan="2">欠款(负数)</th>
<?php 
}
else 

{
?>
    <th colspan="2">挂帐A(不包含挂账B,如残障金等)</th>
    <th colspan="2">欠款(负数)</th>
    <?php 
}
    ?>
<!--    <th rowspan="2">残障金</th>-->
<!--    <th rowspan="2">失业金</th>-->
    <th rowspan="2">备注</th>
  </tr>
  <tr bgcolor="#CAE8EA" style="text-align:center;">
    <th>单位</th>
    <th>个人</th>
    <th>单位</th>
    <th>个人</th>
  </tr>
  </thead>
  <tbody>
  <?php while ($row=@mysql_fetch_array($ret))
  {
  ?>
  <tr bgcolor="#ffffff">
  <td><?php echo $row['month'];?></td>
  <td><?php echo $row['field1'];?></td>
  <td><?php echo $row['unitName'];?></td>
<!--  <td><?php if(unitName($row['field2'])){ echo unitName($row['field2']);}else {echo $row['field2'];}?></td>-->
  <td><?php if($row['r1']>0) {echo $row['r1'];} else echo "0.00";?></td>
  <td><?php if($row['r2']>0) {echo $row['r2'];} else echo "0.00";?></td>
  <td><?php if($row['r1']<0) {echo $row['r1'];} else echo "0.00";?></td>
  <td><?php if($row['r2']<0) {echo $row['r2'];} else echo "0.00";?></td>
<!--  <td><?php echo $row['r4'];?></td>-->
  <td><?php echo content($row['unitName'],$i,$month);?></td>
  </tr>
  <?php 
  }
  ?>
  
  </tbody>
  
  </table>
  
<p>部分未确定单位或社保账号的挂账概况</p>
<table id="displayTable" width="98%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<thead align="center">
<tr bgcolor="#CAE8EA" style="text-align:center;">
    <th rowspan="2">平帐月份</th>
    <th rowspan="2">费用月份</th>
    <th rowspan="2">单位名称</th>
    <th colspan="2">挂帐</th>
    <th colspan="2">欠款(负数)</th>
  <th rowspan="2">备注</th>
  </tr>
  <tr bgcolor="#CAE8EA" style="text-align:center;">
    <th>单位</th>
    <th>个人</th>
    <th>单位</th>
    <th>个人</th>
  </tr>
  </thead>
  <tbody>
  <?php 
  if($i=="51bal")
  {
  ?>
  <?php 
  }
  ?>
  </tbody>
  </table>
  
  <p>部分未确定单位或社保账号的欠款概况</p>