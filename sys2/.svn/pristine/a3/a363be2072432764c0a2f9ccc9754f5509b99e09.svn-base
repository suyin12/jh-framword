<?php
/*
*     2010-2-21   
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
@session_start();

include_once ("../settings.inc");
$wInfoSql = "select * from cwps_user where groupID like '13'";
    $wInfoRet = mysql_query($wInfoSql);
    while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
        $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
    }
	if($wInfoArr[$_SESSION['UserName']]['RoleID']!="40")exit("无权访问");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/main.css">
 </head>
 <body>
<?php
if ($_GET['actionPer']) {
    $month = $_GET['month'];
    $type = $_GET['type'];
    $actionPer = urldecode($_GET['actionPer']);
    //员工或管理层评议表
    switch ($type){
        case "m":
            $existsSql ="select a.* from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.actionPer like '$actionPer' and b.subGroupIDs  like ',17,' and b.userName is not null";
		    $existsRet = mysql_query($existsSql);
		    ?>
	<table width="1150px" class="gradeTable" border="0" cellspacing="1" bgcolor="#666666">
	<div class="fix" >
	<thead bgcolor="#ffffff">
	  <tr>
	    <th width="50px" rowspan="2" align="center" valign="middle" >姓名</th>
	    <th colspan="4" align="center" valign="middle">管理能力(每项12.5分,共50分)	</th>
	    <th colspan="2" align="center" valign="middle">工作态度（每项12.5分,共25分）</th>
	    <th colspan="2" align="center" valign="middle">工作业绩（每项12.5分,共25分）</th>
	    <th rowspan="2" align="center" valign="middle">总评分</th>
	    <th rowspan="2" align="center" valign="middle">意见或建议</th>
	  </tr>
	  <tr class="maxNumRow">
	    <th align="center" valign="middle">能够积极学习并运用熟练的专业知识、机智灵活、有效、得当地处理业务（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">顾全大局、勇于承担责任、积极改进工作作风及方法（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">能较好地沟通协调客户、部门及同事的关系，具较强业务处理能力（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">积极培养、挖掘员工潜力、激发工作热情，部门管理到位，妥善舒解员工情绪（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">能够以身作则、自觉遵守各项规章制度，起到带头模范作用（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">工作积极主动、计划性强、执行力高，持之以恒，勇于克服困难（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">工作量饱和，具良好敬业精神，愿意主动承担工作量（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">工作效率高、不延误拖拉，完成质量高，无错漏 (<span class="maxNum">12.5</span>分）</th>
	  </tr>
	</thead>
	<tbody bgcolor="#ffffff">
     <?php
     $i=0;
    if(@mysql_num_rows($existsRet)>0)
        $ret = $existsRet;   
     while ($row = mysql_fetch_array($ret)) {
         if($row['gradeStr']){
             $gradeStr = explode(",",$row['gradeStr']);        
         }else{
             $gradeStr =NULL;
         }
     ?>
     <tr>
		<td>
		<input type="hidden" name="userName[]" value="<?php echo $row['userName']; ?>">
		<?php
        echo $row['userName'];
        ?>
		</td>
		<td><?php echo $gradeStr[0]?> </td>
		<td><?php echo $gradeStr[1]?> </td>
		<td><?php echo $gradeStr[2]?> </td>
		<td><?php echo $gradeStr[3]?> </td>
		<td><?php echo $gradeStr[4]?> </td>
		<td><?php echo $gradeStr[5]?> </td>
		<td><?php echo $gradeStr[6]?> </td>
		<td><?php echo $gradeStr[7]?> </td>
		<td><?php echo number_format($row['total'],2,".","");?> </td>
	</tr>
     <?php
     $i++;
    }
    ?>
	</tbody>
</table>
		     
           <?php 
            break;
        case "w":
            $existsSql ="select a.* from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.actionPer like '$actionPer' and b.subGroupIDs not like ',17,' and b.userName is not null";
		    $existsRet = mysql_query($existsSql);
		    ?>
		   <table  width="1150px"  class="gradeTable" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr>
			<th rowspan="2" width="50px" align="center" valign="bottom" >姓名</th>
			<th colspan="4" align="center" valign="bottom">工作态度（55分）</th>
			<th colspan="3" align="center" valign="bottom">工作业绩（45分）</th>
			<th rowspan="2" align="center" valign="bottom">总评分</th>
			
		</tr>
		<tr class="maxNumRow">
			<th align="center" valign="bottom">工作努力创新,主动提高业务能力及个人素质<br />
			（<span class="maxNum">10</span>分)</th>
			<th align="center" valign="bottom">严格遵守工作纪律及各项规章制度<br />
			（<span class="maxNum">15</span>分)</th>
			<th align="center" valign="bottom">能够积极主动沟通，协调、配合客户、上级、同事按时完成工作<br />
			（<span class="maxNum">15</span>分）</th>
			<th align="center" valign="bottom">工作责任感强，勇于承担责任并积极改进<br />
			（<span class="maxNum">15</span>分 </th>
			<th align="center" valign="bottom">工作量饱和，具良好敬业精神，愿意主动承担工作量<br />
			（<span class="maxNum">15</span>分）</th>
			<th align="center" valign="bottom">工作效率高，能积极有效地完成工作，不延误、拖拉<br />
			（<span class="maxNum">15</span>分）</th>
			<th align="center" valign="bottom">工作完成正确、清晰,质量高，无错漏 <br />
			（<span class="maxNum">15</span>分）</th>
		</tr>
	</thead>

	<tbody bgcolor="#ffffff">
     <?php
     $i=0;
    if(@mysql_num_rows($existsRet)>0)
        $ret = $existsRet;   
     while ($row = mysql_fetch_array($ret)) {
         if($row['gradeStr']){
             $gradeStr = explode(",",$row['gradeStr']);             
         }else{
             $gradeStr =NULL;
         }
     ?>
     <tr>
		<td>
		<input type="hidden" name="userName[]" value="<?php echo $row['userName']; ?>">
		<?php
        echo $row['userName'];
        ?>
		</td>
		<td><?php echo $gradeStr[0]?> </td>
		<td><?php echo $gradeStr[1]?> </td>
		<td><?php echo $gradeStr[2]?> </td>
		<td><?php echo $gradeStr[3]?> </td>
		<td><?php echo $gradeStr[4]?> </td>
		<td><?php echo $gradeStr[5]?> </td>
		<td><?php echo $gradeStr[6]?> </td>
		<td><?php echo number_format($row['total'],2,".",""); ?> </td>
		
	</tr>
	
     <?php
     $i++;
    }
    ?>
	</tbody>
</table>
		    <?php
            break;
    }
    ?>
   
<?php    
} elseif($_GET['userName']) {
  $month = $_GET['month'];
  $userName = urldecode($_GET['userName']);
  $sql = "select a.* from grade_number a,grade_filter b where a.month like '$month' and a.userName like '$userName' and a.actionPer=b.userName order by b.id ";
  $ret = mysql_query($sql);
   echo ' <table width="1150px" border="0" cellspacing="1" bgcolor="#666666">
	         <thead bgcolor="#ffffff">
	            <th>被评分人</th>
	            <th>评分人</th>
	            <th>得分</th>
	         </thead>
	         <tbody bgcolor="#ffffff"> ';
  while ($row = mysql_fetch_assoc($ret)){
     echo "<tr>
           <td>".$row['userName']."</td>
           <td>".$row['actionPer']."</td>
           <td>".number_format($row['total'],2,".","")."</td>
           </tr>";
  }
  echo "</tbody></table>";
}
?>