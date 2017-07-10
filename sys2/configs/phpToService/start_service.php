<?php
/*
*	功能：利用PHP安装windows自动运行的服务
*	简介：启动服务
*	作者：LiangJQ
*	时间：2008年3月7日
*/

require_once "Config.php";

//启动服务
$s=win32_start_service( _SERVICENAME );

if($s != 0){
	//1056
	echo "服务正在运行中！";
}else{
	echo "服务已启动!";
}
?>