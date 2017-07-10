<?php 
/*
*	功能：利用PHP安装windows自动运行的服务
*	简介：重启服务
*	作者：LiangJQ
*	时间：2008年3月7日
*/

require_once "Config.php";

//重启服务
$svcStatus=win32_query_service_status( _SERVICENAME );
if($svcStatus == 1060){

	echo "服务 [ "._SERVICENAME." ] 未被安装，请先安装";
	
}else{

	if($svcStatus['CurrentState'] == 1){
	
		$s=win32_start_service( _SERVICENAME );
		
		if($s != 0){
			echo "服务无法被启动，请重试！";
		}else{
			echo "服务已启动!";
		}
		
	}else{
	
		$s=win32_stop_service( _SERVICENAME );

		if($s != 0){
			echo "服务正在执行，请重试！";
		}else{
		
			$s=win32_start_service( _SERVICENAME );
		
			if($s != 0){
				echo "服务无法被启动，请重试！";
			}else{
				echo "服务已启动!";
			}
			
		}
		
	}

}

?>