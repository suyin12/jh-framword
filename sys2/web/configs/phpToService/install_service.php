<?php 
/*
*	功能：利用PHP安装windows自动运行的服务
*	作者：LiangJQ
*	时间：2008年3月7日
*/

require_once "Config.php";

//注册服务
$x = win32_create_service(array(
    'service' => _SERVICENAME,
	'display' => _SERVICEINFONAME, 
    'path' => _PATH,
    'params' => _PARAMS,
	));


//启动服务
win32_start_service( _SERVICENAME );


if($x !== true){
	die('服务创建失败!');
}else{
	die('服务创建成功!');
}

?>