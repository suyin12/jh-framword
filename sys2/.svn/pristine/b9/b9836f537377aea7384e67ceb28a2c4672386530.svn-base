<?php 
/*
*	功能：利用PHP安装windows自动运行的服务
*	简介：停止服务
*	作者：LiangJQ
*	时间：2008年3月7日
*/

require_once "Config.php";

//停止服务
$s=win32_stop_service( _SERVICENAME );

if($s != 0){
	//1062
	echo "服务未启动！";
}else{
	echo "服务已停止!";
}
?>