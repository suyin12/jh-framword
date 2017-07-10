<?php 
/*
*	功能：利用PHP安装windows自动运行的服务
*	简介：移除服务
*	作者：LiangJQ
*	时间：2008年3月7日
*/

require_once "Config.php";

//移除服务
$removeService = win32_delete_service( _SERVICENAME );

switch($removeService)
{
	case 1060: die('服务不存在！');break;
	case 1072: die('服务不能被正常移除!');break;
	case 0:die('服务已被成功移除！');break;
	default:die();break;
}

?>