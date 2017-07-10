<?php
/*
*	功能：利用PHP安装windows自动运行的服务
*	作者：LiangJQ
*	时间：2008年3月7日
*/

require_once "Config.php";

//查看服务状态
$svcStatus=win32_query_service_status( _SERVICENAME );
if($svcStatus == 1060){
	echo "服务 [ "._SERVICENAME." ] 未被安装";
}else{
	echo "服务 [ "._SERVICENAME." ] 已经安装";
	
	echo "&nbsp;服务状态：";
	switch($svcStatus['CurrentState']){
		case 1: echo "未启动"; break;
		case 4: echo "已启动"; break;
		default: break;
	}
	
}

echo '<ul>
  <li><a href="install_service.php">安装服务</a></li>
  <li><a href="uninstall_service.php">移除服务</a></li>
  <li><a href="start_service.php">开始服务</a></li>
  <li><a href="stop_service.php">停止服务</a></li>
  <li><a href="restart_service.php">重启服务</a></li>
</ul>
<p>';
?>
