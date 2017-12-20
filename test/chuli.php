<?php
/**
 *
 * User: suyin
 * Date: 2017/10/17 9:23
 *
 */
session_start(); // 登录之后要把所包含登录的页面连接起来，开启session
include("DADB.class.php");

$db=new DADB();

$user=$_POST["username"];
$pwd=$_POST["password"];

$sql="select password from yuangong where username='{$user}'";

$arr=$db->Query($sql);

if($arr[0][0]==$pwd && !empty($pwd))
{
    $_SESSION["username"]=$user;
    header("location:main.php");
}
else
{
    echo"登录失败";
}

?>