<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
//require_once '../header/leaderheader.php';
// require ('../settings1.inc');
 
//if(!defined('ALLOW'))exit();
?>
<body onLoad="inSel()">
<div class="fl">
<a href="/publish/oa/home/process.php" target="_self">网站信息发布统计</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/publish/oa/home/process_z.php" target="_self">网站外部注册信息统计</a></div>
	<form method="post" action="process_z.php">
	<br /><br />
	<div align="center">
	请选择年份：<select name ="selYear" class = "selAll">
		<?php 
			for($j=-1;$j<2;$j++){
				echo " <option value='".(date('Y')+$j)."'>".(date('Y')+$j)."</option>";
			}
		?>
	</select>
	请选月份：<select name ="selMothon" class = "selAll">
		<?php 
			for($i=1;$i<=12;$i++)
			{
				echo "<option value='$i'>$i</option>";
			}
		?>
	</select>
	
	<input type="submit" value="提交" > 
   
	<br /></div>
	<br />
	 <?php 
	 
	 		//require_once '../header/companyHeader.php';
			//if(!defined('ALLOW'))exit();
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
				echo "<div  align='center'><h3>".$selYear."年".$selMothon."月注册信息</h3></div>";
			$qUser = "SELECT CASE GroupID
					WHEN CAST( 6 AS UNSIGNED ) THEN '企业' WHEN 7 THEN '个人'
					END AS GroupID, DATE_FORMAT( FROM_UNIXTIME(RegisterDate),'%Y') AS time, count(*) FROM cwps_user
					WHERE DATE_FORMAT(FROM_UNIXTIME(RegisterDate),'%Y%m%d' ) 
					BETWEEN '".$time1."' AND '".$time2."'
					AND (GroupID =6 OR GroupID =7)
					GROUP BY GroupID";
			$rsUser= mysql_query($qUser); 
			echo "<div align='center'>";
			echo "<table border='1' cellspacing='0' cellpadding='0' width = '600' bordercolor='#000000' bordercolordark='#FFFFFF' bgcolor='#FFFFFF' >";
			echo "<tr><td align='center'>用户</td><td align='center'>注册数量</td></tr>";
			$bool = true;
			while($row = @mysql_fetch_array($rsUser)){
				$bool = false;
				echo "<tr><td align='center'>$row[0]</td><td align='center'>$row[2]</td></tr>";
			}
			if($bool){echo "<tr><td align='center' colspan='4' style='color:red'>null</td></tr>"; }
			echo "<br /><br />";
		}



				
		
		 ?>
		 
		
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
</div>
</body>
</html>