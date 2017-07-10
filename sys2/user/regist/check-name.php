<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<title>Untitled</title>

</head>

<body>

<?php
//	header('Content-Type:text/html;charset=GB2312');
//echo "loading...";
//sleep(1); 
require_once  '../../config.php';
$js_name=$_GET["js_name"];

//$username=trim($_GET['username']);
$query = "select * from user where UserName= '$js_name'";//链接表
$result = mysql_query($query);//执行结果
$num=mysql_affected_rows();//行数
//echo "rowNum=".$num;
$len=strlen($js_name);
	if($num >0||$len<4)
		{
		   // echo "dfasfa=".$js_name;
			echo "<img src='../../css/images/check_error.gif' width='15px' height='15px' />User was existed or UserName must more than 4 character";
	     }
	else{
	    
	    echo "<img src='../../css/images/check_right.gif' width='15px' height='15px' />";
		
	    }
	


?>



</body>
</html>