
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
<title>员工统计</title>
</head>
<body onLoad="inSel()">
	<form method="post" action="process.php">
	<br /><br />
	<div align="center">
	请选择年份：<select name ="selYear" style="background-color:#E6F3FF;height:21px;width:110px;">
		<option value="2007">2007</option>
		<option value="2008">2008</option>
		<option value="2009">2009</option>
		<option value="2010">2010</option>
	</select>
	请选月份：<select name ="selMothon" style="background-color:#E6F3FF;height:21px;width:110px;">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
	</select>
	发布人(可选)：
	<select name="selcolumn" style="background-color:#E6F3FF;height:21px;width:110px;">
		<option value="">请选择</option>
		<option value="admin">admin</option>
		<option value="5201314997">钟木灵</option>
		<option value="lingchenq">铁东远</option>
		<option value="zhangdi">zhangdi</option>
		<option value="dumchen2030">陈健恒</option>
		<option value="fxj924">冯小娟</option>
		<option value="wanghuiyan">汪慧研</option>
		<option value="wanghuiyan">汪慧研</option>
		<option value="lpc2008y">罗平超</option>
	</select>
	<input type="submit" value="提交" onClick="a()"> 
	<br /></div>
	<br />
	 <?php 
		 	require_once "../settings.inc";
		 	$selYear = $_POST["selYear"];
			$selMothon = $_POST["selMothon"];
			$selcolumn = $_POST["selcolumn"];
			$selLastYear = $selYear;
			$time1 = $selYear."-".($selMothon-1)."-"."21";
			$time2 = $selYear."-".$selMothon."-"."20";
			$time1 = date("Ymd",strtotime($time1));
			$time2 = date("Ymd",strtotime($time2));
			if ($selYear != ""){
			$qUser = "SELECT CASE GroupID
					WHEN CAST( 6 AS UNSIGNED ) THEN '企业' WHEN 7 THEN '个人'
					END AS GroupID, DATE_FORMAT( FROM_UNIXTIME(RegisterDate),'%Y') AS time, count(*) FROM cwps_user
					WHERE DATE_FORMAT(FROM_UNIXTIME(RegisterDate),'%Y%m%d' ) 
					BETWEEN '".$time1."' AND '".$time2."'
					AND (GroupID =6 OR GroupID =7)
					GROUP BY GroupID";
			$rsUser= mysql_query($qUser); 
			echo "<div align='center'>";
			echo "<table border='1' cellspacing='0' cellpadding='0'  width = '600' bordercolor='#000000' bordercolordark='#FFFFFF' bgcolor='#FFFFFF' >";
			echo "<tr><td align='center'>用户</td><td align='center'>注册数量</td></tr>";
			$bool = true;
			while($row = mysql_fetch_array($rsUser)){
				$bool = false;
				echo "<tr><td align='center'>$row[0]</td><td align='center'>$row[2]</td></tr>";
			}
			if($bool){echo "<tr><td align='center' colspan='4' style='color:red'>null</td></tr>"; }
			
		}

			require_once "../settings1.inc";
			$selYear = $_POST["selYear"];
			$selMothon = $_POST["selMothon"];
			$selcolumn = $_POST["selcolumn"];	
			if ($selYear != ""){
				echo "<div  align='center'><h3>".$selYear."年".$selMothon."月注册信息</h3></div>";
				$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uinfo,Name,DATE_FORMAT(time,'%Y%m%d')  order by time DESC";
				$rs = mysql_query($qvName); 
				
					echo "<table border='1' cellspacing='0' cellpadding='0'  width = '600' bordercolor='#000000' bordercolordark='#FFFFFF' bgcolor='#FFFFFF' >"; 
					echo "<tr><td align='center'>用户</td><td align='center'>栏目</td><td align='center'>时间</td><td align='center'>发布数量</td></tr>";
				$bool = true;
				while($row = mysql_fetch_row($rs)) {
					$bool = false;
					echo "<tr><td align='center'>$row[1]</td><td align='center'>$row[2]</td><td align='center'>$row[3]</td><td align='center'>$row[4]</td></tr>"; 
				}
				echo "<div  align='center'><h3>".$selYear."年".$selMothon."月发布信息</h3></div>";
				if($bool){echo "<tr><td align='center' colspan='4' style='color:red'>null</td></tr>"; }
					$q1 = "SELECT sum(number) FROM v_sum where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						$q1 = $q1." and uName = '".$selcolumn."' order by time";
					}
	
					$rs1 = mysql_query($q1); 
					$row1 = mysql_fetch_row($rs1);
					echo "<tr><td colspan='3' align='center'>统计</td><td>".($row1[0]+0)."</td></tr>";
					echo "</table></div>"; 
				
			}
		 ?>
		 
		<br /><br />
	</form>
</body>
</html>
<script type="text/javascript">
	function inSel()
	{
		document.getElementById("selYear").value= <?php echo $_POST['selYear']; ?>;
		document.getElementById("selMothon").value= <?php echo $_POST['selMothon']; ?>;
	}
</script>