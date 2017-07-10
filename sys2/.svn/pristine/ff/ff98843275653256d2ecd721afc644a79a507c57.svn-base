<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {font: normal 12px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
p{font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
table{font-size:12px;}

.fieldContent
{
	background-color: #ffffff;
	border-right: 1px solid #000000 ;
	border-bottom: 1px solid #000000 ;
	padding: 1px;
	padding-left: 3px;
	text-align:center;
	height:30px;
}
</style>
</head>
<body>
<br><br>
<p style="font-size:22px;text-align:center;">深圳市鑫锦程人力资源管理有限公司派遣员工工资明细单</p><br><br>
<form name="form1" method="post" action="">	
<table width="100%">
<tr><td><p style="font-size:15px"><?php  echo " 单位名称:".$_POST[companyName];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo "姓名:".$_POST[workerName];?></p></td><td style="text-align:right"><p><?php echo "打印日期:".date('Y-m-d');?></p></td></tr>

</table>
		<table width="100%"  border="0" cellpadding="2" cellspacing="0" bgcolor="#cccccc" style="border-top:1px solid #000000;border-left:1px solid #000000;">
		<thead>
		<tr>
		<th class="fieldContent" rowspan="2"><strong>工资年月</strong></th>
		<th class="fieldContent" rowspan="2"><strong>应发工资</strong></th>
		<th class="fieldContent" colspan="5" class="nobg"><strong>扣&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;款</strong></th>
		<th class="fieldContent" rowspan="2"><strong>实发金额</strong></th>	
		<th class="fieldContent" rowspan="2"><strong>备注</strong></th>
		</tr>
		<tr class="fieldName">
		<th class="fieldContent"><strong>扣个税</strong></th>
		<th class="fieldContent"><strong>扣保险</strong></th>
		<th class="fieldContent"><strong>房屋水电</strong></th>
		
		<th class="fieldContent"><strong>其他</strong></th>
		<th class="fieldContent"><strong>扣款合计</strong></th>
		</tr>
		</thead>
		<tbody id="displaybody">
<?php 
       require_once '../settings.inc';
       $checkbox= $_POST[checkbox];	
		if(isset($_POST['print'])){
				
		for($i=0;$i<count($checkbox);$i++){
	    $printKey = $checkbox[$i];
	    list($IDNumber,$Month)=explode(",",$printKey);
	    $sql="select * from workerSalary where IDNumber='$IDNumber' and field0='$Month'";
	    $ret=mysql_query($sql);
	    $row=mysql_fetch_array($ret);
	    ?>
	   <tr >
		<td class="fieldContent"><? echo $row['field0']; ?></td>
		<td class="fieldContent"><? echo $row['field5']; ?></td>
		<td class="fieldContent"><? echo $row['field6']; ?></td>
		<td class="fieldContent"><? echo $row['field7']; ?></td>
	    <td class="fieldContent"><? echo $row['field8']; ?></td>
		<td class="fieldContent"><? echo $row['field9']; ?></td>
		<td class="fieldContent"><? echo $row['field10']; ?></td>
		<td class="fieldContent"><? echo $row['field11']; ?></td>
		<td class="fieldContent"><? echo $row['field12']; ?>&nbsp;</td>
		</tr>
<?php 
	     	}
		}
?>
</tbody>
</table>

</body>
</html>
</div>
</body>
</html>