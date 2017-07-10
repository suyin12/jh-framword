<?php 
/*
社保专员头文件
* */
@session_start();
//$_SESSION['Cqyyh']='13';
//$_SESSION['RoleID']='31';
//$_SESSION['UserID']='13';
//echo $_SESSION['Cqyyh'].",".$_SESSION['RoleID'];
  $_SESSION['SubGroupIDs']=',15,';
	if($_SESSION['SubGroupIDs']!=',15,')
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>该功能为社保专员专属,欲修改相关信息请与社保专员联系</p>";
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