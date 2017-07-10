<?

$url=$_SERVER['SERVER_NAME']."/orderSystem/user/login/index.php";//这个更改地址
include "../../config.php"; // database connection details stored here
?>
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Forgot Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>

<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080"
	alink="#ff0000">
<?
$email = mysql_real_escape_string($_POST[email]);
$userName=mysql_real_escape_string($_POST[userName]);
$status = "OK";
$msg = "";
//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
if (! stristr($email, "@") or ! stristr($email, ".")) {
    $msg = "Your email address is not correct<BR>";
    $status = "NOTOK";
}
echo "<br><br>";
if ($status == "OK") {
    $query = "SELECT Email,UserID,Password FROM user WHERE Email = '$email' and UserName='$userName'";
    $st = mysql_query($query);
    $recs = mysql_num_rows($st);
    $row = mysql_fetch_object($st);
    $em = $row->Email; // email is stored to a variable
    if ($recs == 0) {
        echo "<center><font face='Verdana' size='2' color=red><b>No Password</b><br> Sorry Your UserName or Email  is not correct . You can <a href='../regist/register.php'>regist</a> a new one";
        echo "<br><br><input type='button' value='Retry' onClick='history.go(-1)'>";
        exit();
    }
        require_once '../../mail/gmailConfig.php';
        
		$mail->Subject    = "reset your password";
		$mail->Body       = "Hi,<br>your new password is :350583<br/><a href='$url'>you can login with this link</a>";                      //这里要更改域名链接
		$mail->WordWrap   = 50; // set word wrap
		$mail->AddAddress($em, "$em");
		$mail->IsHTML(true); // send as HTML
		
		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		   echo "<center><font face='Verdana' size='2' color=red >$msg <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";
		} else {
		    $passwordSql="update user set Password='9d00bdf5e46efe66901871a8b2dd825a' where UserID='$row->UserID'";
		    $passwordRet=mysql_query($passwordSql);
		    if(mysql_affected_rows()==1)
		    {
		      echo "<center><font face='Verdana' size='2' color=red >Your password is posted to your emil address . Please check your mail after some time.</font></center><br>";
		    }
		    else{
		      echo "<center><font face='Verdana' size='2' color=red >There is some system problem in sending login details to your address. Please contact site-admin.</font><br>";
		      echo "<center><font face='Verdana' size='2' color=red >$msg <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";
		    }
        }
        } else {
		    echo "<center><font face='Verdana' size='2' color=red >$msg <br><br><input type='button' value='Retry' onClick='history.go(-1)'></center></font>";
		}
?>

</body>

</html>
