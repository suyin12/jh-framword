<?php 
/*
领导层头文件
* */
@session_start();
	if($_SESSION['Cqyyh']!=13||$_SESSION['SubGroupIDs']!=',17,')
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为领导层所属</p>";
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