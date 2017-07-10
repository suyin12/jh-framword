<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
//require_once '../header/leaderheader.php';
 require ('../settings1.inc');
 
if(!defined('ALLOW'))exit();
?>
<body onLoad="inSel()">
<div class="fl">
<a href="/publish/oa/home/process.php" target="_self">网站信息发布统计</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/publish/oa/home/process_z.php" target="_self">网站外部注册信息统计</a></div>
	<form method="post" action="process.php">
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
	发布人(可选)：
    
	<select name="selcolumn" class = "selAll">
    <option value="">请选择</option>
<?php
// require ('../settings1.inc');
//require ("../../ConnDB.php");		
//$link=new ConnDB;
//
//
//$result = mysql_query("SELECT uName FROM cmsware_user'");
//while($row=mysql_fetch_array($result)) {
//$uName=$row[uName];

$sql = "SELECT uName FROM cmsware_user";
$result=mysql_query($sql);
while($row=@mysql_fetch_array($result)){
 $uName =$row[uName];
	
	?>
		
		<option value="<?php echo $uName; ?>"><?php echo $uName; ?></option>
	
     <? }?>   
 

<!-- 		<option value="admin">admin</option>
		<option value="钟木灵">钟木灵</option>
		<option value="铁东远">铁东远</option>
		<option value="陈健恒">陈健恒</option>
		<option value="冯小娟">冯小娟</option>
		<option value="汪慧研">汪慧研</option>
		<option value="罗平超">罗平超</option>
		<option value="zhangdi">zhangdi</option>   -->
	</select>
 
	<input type="submit" value="提交" > 
   
	<br /></div>
	<br />
	 <?php 
	 
	 	//	require_once '../header/companyHeader.php';
			//if(!defined('ALLOW'))exit();
		 	//require_once "../settings.inc";
		 	$selYear = $_POST["selYear"];
			$selMothon = $_POST["selMothon"];
			$selcolumn = $_POST["selcolumn"];
			$selLastYear = $selYear;
			$time1 = $selYear."-".($selMothon-1)."-"."21";
			$time2 = $selYear."-".$selMothon."-"."20";
			$time1 = date("Ymd",strtotime($time1));
			$time2 = date("Ymd",strtotime($time2));


			//require_once "../settings1.inc";
			$selYear = $_POST["selYear"];
			$selMothon = $_POST["selMothon"];
			$selcolumn = $_POST["selcolumn"];	
			if ($selYear != ""){
//内容模型1表查询				
				$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				
					echo "<table border='1' cellspacing='0' cellpadding='0'  width = '600' bordercolor='#000000' bordercolordark='#FFFFFF' bgcolor='#FFFFFF' >"; 
					echo "<tr><td align='center'>用户</td><td align='center'>栏目</td><td align='center'>发布数量</td></tr>";
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
				echo "<br /><br />";
				echo "<div  align='center'><h3>".$selYear."年".$selMothon."月".$selcolumn."发布信息</h3></div>";
				
					$q1 = "SELECT sum(number) FROM v_sum where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q1 = $q1." and uname = '".$selcolumn."' order by time";
						
					}







//内容模型101表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_101";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}

					$q12 = "SELECT sum(number) FROM v_sum_101 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q12 = $q12." and uname = '".$selcolumn."' order by time";
						
					}

//内容模型102表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_102";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}

					$q15 = "SELECT sum(number) FROM v_sum_102 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q15 = $q15." and uname = '".$selcolumn."' order by time";
						
					}

//内容模型103表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_103";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
					$q13 = "SELECT sum(number) FROM v_sum_103 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q13 = $q13." and uname = '".$selcolumn."' order by time";
						
					}
//内容模型105表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_105";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
					$q14 = "SELECT sum(number) FROM v_sum_105 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q14 = $q14." and uname = '".$selcolumn."' order by time";
						
					}
//内容模型148表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_148";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
					$q16 = "SELECT sum(number) FROM v_sum_148 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q16 = $q16." and uname = '".$selcolumn."' order by time";
						
					}
//内容模型141表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_141";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
					$q17 = "SELECT sum(number) FROM v_sum_141 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q17 = $q17." and uname = '".$selcolumn."' order by time";
						
					}
//内容模型6表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_6";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
					$q18 = "SELECT sum(number) FROM v_sum_6 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q18 = $q18." and uname = '".$selcolumn."' order by time";
						
					}
//内容模型5表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_5";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
					$q19 = "SELECT sum(number) FROM v_sum_5 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q19 = $q19." and uname = '".$selcolumn."' order by time";
						
					}

//内容模型124表查询
$qvName = "select uname,uinfo,Name,DATE_FORMAT(time,'%Y-%m-%d'),count(*) as number from v_name_124";
				$qvName = $qvName." where DATE_FORMAT(time,'%Y%m%d')  between '" .$time1."' and '".$time2."'";
				if( $selcolumn != "")
				{
					$qvName = $qvName." and uname = '".$selcolumn."'";
				}
				$qvName= $qvName." group by uname,Name order by time DESC";
				$rs = mysql_query($qvName); 
				$bool = true;
				while($row = @mysql_fetch_row($rs)) {
					$bool = false;
					if ($row[1]=="") { $row999=$row[0];} else { $row999=$row[1]; }
					echo "<tr><td align='center'>$row999</td><td align='center'>$row[2]</td><td align='center'>$row[4]</td></tr>"; 
				}
					$q110 = "SELECT sum(number) FROM v_sum_124 where time between '" .$time1."' and '".$time2."'";
					if( $selcolumn != "")
					{
						
						$q110 = $q110." and uname = '".$selcolumn."' order by time";
						
					}



//内容模型1的统计查询
					$rs1 = mysql_query($q1); 
					$row1 = @mysql_fetch_row($rs1);
//内容模型101的统计查询					
					$rs2 = mysql_query($q12); 
					$row2 = @mysql_fetch_row($rs2);
//内容模型103的统计查询					
					$rs3 = mysql_query($q13); 
					$row3 = @mysql_fetch_row($rs3);
//内容模型105的统计查询
					$rs4 = mysql_query($q14); 
					$row4 = @mysql_fetch_row($rs4);
//内容模型102的统计查询
					$rs5 = mysql_query($q15); 
					$row5 = @mysql_fetch_row($rs5);	
//内容模型148的统计查询
					$rs6 = mysql_query($q16); 
					$row6 = @mysql_fetch_row($rs6);						
//内容模型141的统计查询
					$rs7 = mysql_query($q17); 
					$row7 = @mysql_fetch_row($rs7);	
//内容模型6的统计查询
					$rs8 = mysql_query($q18); 
					$row8 = @mysql_fetch_row($rs8);	
//内容模型5的统计查询
					$rs9 = mysql_query($q19); 
					$row9 = @mysql_fetch_row($rs9);
//内容模型124的统计查询
					$rs10 = mysql_query($q110); 
					$row10 = @mysql_fetch_row($rs10);
echo "<tr><td colspan='2' align='center'>统计</td><td>".($row1[0]+$row2[0]+$row3[0]+$row4[0]+$row5[0]+$row6[0]+$row7[0]+$row8[0]+$row9[0]+$row10[0]+0)."</td></tr>";
										echo "</table>";
					echo "<table><tr><td>";
					

					echo "</td></tr></table>";
					echo "</div>";
				
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
</div>
</body>
</html>