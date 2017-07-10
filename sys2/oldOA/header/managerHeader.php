<?php 
/*
客户经理头文件
* */
@session_start();
//$_SESSION[UserID]="747";
//$_SESSION['SubGroupIDs']=',14,';
	if($_SESSION['Cqyyh']!=13||$_SESSION['SubGroupIDs']!=',14,')
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为客户经理专属,欲修改相关信息请与客户经理联系</p>";
	}
	else{
	    define('ALLOW',true);
	   	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
</head>