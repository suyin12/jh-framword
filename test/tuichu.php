<?php
/**
 *
 * User: suyin
 * Date: 2017/10/17 9:27
 *
 */

//退出页面代码
session_start();
unset($_SESSION["username"]);
header("location:login.php");

?>