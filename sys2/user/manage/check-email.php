<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

<?php 

require_once  '../../config.php';
$js_email=$_GET["js_email"];

//$username=trim($_GET['username']);
$query = "select * from user where Email= '$js_email'";//链接表
$result = mysql_query($query);//执行结果
$num=mysql_affected_rows();//行数
//echo "rowNum=".$num;

	if($num >0)
		{
		   // echo "dfasfa=".$js_name;
			echo "<img src='../../css/images/check_error.gif' width='15px' height='15px' />User was existed";
	     }
	else{
	    echo "<img src='../../css/images/check_right.gif' width='15px' height='15px' />";
		
	    }
	


?>

</body>
</html>
