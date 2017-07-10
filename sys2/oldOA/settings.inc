<?php

/**
 * General settings file.
 *
 */

/*
 * 数据库连接,系统目录连接
 */

#设置时区
date_default_timezone_set ( "PRC" );
#屏蔽警告性错误
error_reporting(E_ALL & ~ (E_NOTICE | E_WARNING));
#控制页面是UTF-8
header("Content-type: text/html; charset=utf-8");
#开启SESSION
session_start();

//链接数据库
$db_user = "root"; 					// Database username
$db_pass = "1qa2WS3ed4RF";					// Database password
$db_name = "sq_user"; 				// Database name
$db_host = "localhost";					// Database host
$db_port = "";						// Database port

$db_con=mysql_connect($db_host,$db_user,$db_pass)or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");
mysql_query("SET NAMES 'UTF8'");

//系统目录定义
$sysPath = $_SERVER ['DOCUMENT_ROOT'] . '/dispatchSys/';
$httpPath = "http://" . $_SERVER ['SERVER_NAME'] . '/';
define ( "httpPath", $httpPath );
define ( "sysPath", $sysPath );
define ( "smartyLibPath", $sysPath . 'smartyLibs/' );

#公司版权信息相关
$authorCompany = "深圳市鑫锦程人力资源管理有限公司";
#处理POST GET  COOKIE的字符串转义,防止SQL注入
foreach ( array ('_POST', '_GET', '_COOKIE' ) as $globalarray ) {
	foreach ( $$globalarray as $inputname => &$input ) {
		if (is_scalar ( $input ) && $inputname {0} != '_') {
			$input = htmlspecialchars ( trim ( $input ) );
			! get_magic_quotes_gpc () && $input = addslashes ( $input );
		}
	}
}
if(empty($_SESSION['exp_user']) || @$_SESSION['exp_user']['expires'] < time()) {
	//header("location:".httpPath);
	 header("location:".httpPath."user/login/login.php");	//@ redirect 
} else {
	$_SESSION['exp_user']['expires'] = time()+(60*60);	//@ renew 60 minutes
	}
?>