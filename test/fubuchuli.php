<?php
/**
 *
 * User: suyin
 * Date: 2017/10/17 9:42
 *
 */
session_start();

$re=$_POST["jsr"];
$comment=$_POST["neirong"];
$time=date("Y-m-d H:i:s"); //获取当前时间

$_SESSION["username"]=$user;

include("DADB.class.php");
$db=new DADB();


$sql="insert into liuyan VALUES ('','{$user}','{$jsr}','{$time}','{$comment}',false)";

if($db->Query($sql,0))
{

    header("location:main.php");
}
else{
    echo"发布失败";
}
?>