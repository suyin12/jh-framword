<?php 
session_start();
if(!empty($_SESSION['exp_user']))
{
  header("Location:../login/index.php");  
    
}
else {
?>

<html>
<head>
	<title>register</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="../../css/mainTable.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/ajaxreg.js"></script>
	<script type="text/javascript" src="../../js/condition.js"></script>

</head>

<body>
<div id="bodyGroud">
<?php include "../../config.php" ?>
<?php

	if(!isset($_POST[B2]))	
{
?>
<div id="largeForm">
 <form enctype = 'multipart/form-data' method = 'POST' action = 'register.php' name = 'tx1'	onsubmit = 'return validateform(this.form)'>
	
	<table class="registTable" align="center">	
	<tr>
	<td>userName:</td>		
	<td><input type='text' name='userName' id='js_name' onBlur='CallServer_name()'></td>
	<td><div class='MSG' id='name_check'></div></td>
	</tr>
			
	<tr>	
	<td> Email:</td>	
	<td><input type='text' name='email' id='js_email' onBlur='CallServer_email()'></td>
	<td><div class='MSG' id='email_check'></div></td>
	</div>
	</tr>
			
	<tr>
	<td>password:</td>	
	<td><input type='password' name='password' id='userpwd' onBlur='checkpass()'></td>
	<td><div class='MSG' id='password2'></div></td>
	</tr>				
	
			
	<tr>
	<td>confirm password:</td>
	<td><input type='password' name='repassword' id='reuserpwd' onBlur='checkpass1()'></td>
	<td><div class='MSG' id='password3'></div></td>
		</tr>				
	<tr>
	<td>Address:</td>
	<td><input type='text' name='address' id='address' onBlur='checkAddress()'></td>
	<td><div class='MSG' id='addressMsg'></div></td>
	</tr>		
	<tr>
	<td>phone:</td>
	<td><input type='text' name='phone' id='phone'></td>
	</tr>
			
	<tr>
	<td>company:</td>
	<td><input type='text' name='company' id='company'></td>
	</tr>
	</table>		
	<div align="center" >
	<p style='font:bold 14px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;'>please describe something about your company or yourself:</p></tr>
	<textarea name="description" rows="8" cols="40"></textarea>
	</div>
								
	<div align="center">
	 <input type='submit' name='B2' value='register' />
	 </div>
			

  </form>
  </div>
<?php 

}
else{	
	 $password=md5($_POST[password]);
	 $userName=$_POST[userName];
	 $email=$_POST[email];
	 $address=$_POST[address];
	 $company=$_POST[company];
	 $phone=$_POST[phone];
	 $registerDate=time();
	 $Description=$_POST[description];
	 $registSql="insert into user set GroupID='2', UserName='$userName',Email='$email',Password='$password',
	             address='$address',company='$company',phone='$phone',RegisterDate='$registerDate',Description='$Description'";
	 $registRet=mysql_query($registSql);
	 $tt=mysql_affected_rows();
	 if($tt>0){
	     $url="../login/index.php";//跳转到登陆地址
	 echo "<br/>";
	 
	 echo "<div align='center'  style='font-size:20px;margin-top:200px;'>";
	 echo "success!!Thanks for Registering! it will jump  to <a href='$url'>login</a> after 5 seconds ;";
	 ?>
	 <meta http-equiv="refresh" content="5;url=<?php echo $url;?>" />  
	 <?php 
//	 sleep(3);
//	 echo "<script>window.location='$url'</script>";
//	 header("Location: http://localhost/test/excel+php/14_BookSystem/user/login/index.php");
//	 echo "<META HTTP-EQUIV='REFRESH' CONTENT=5; URL=$url >";
	 echo "</div>";
 		}
 		else 
 	{ 
 	  echo "<br/>";
	 echo "<div align='center' style='font-size:20px;margin-top:200px;'>";
	 echo "failed!make sure your userName or Email,it was existed;<a href='Javascript:history.back(-1)'>back</a>";
	
	 echo "</div>";  
 	}
}
	?>
</body>
</html>
<?php 
}
?>