<?php
/*
*	功能：利用PHP安装windows自动运行的服务
*	简介：自动执行程序
*	作者：LiangJQ
*	时间：2008年3月7日
*/

require_once "Config.php";

//检测服务是否存在
if (!win32_start_service_ctrl_dispatcher( _SERVICENAME )) {
 die("没有发现正在运行的 [ "._SERVICENAME." ] 服务");
}


//如果运行中
while (WIN32_SERVICE_CONTROL_STOP != win32_get_last_control_message()) {

	//写入文件
	for($i=1;$i<=1;$i++){
		$b_file_path="D:\\localhost\\test.txt";
		$f=fopen($b_file_path,'a+');
		$msg='Dernier backup  correctement:'.date('y/m/d h:i:s');
		fwrite($f,$msg."\r\n");
		fclose($f);
		sleep(1);
	}

}


?>
