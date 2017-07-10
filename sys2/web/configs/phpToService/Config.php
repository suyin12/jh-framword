<?PHP
/*
*	功能：利用PHP安装windows自动运行的服务
*	作者：LiangJQ
*	时间：2008年3月7日
*/

//定义服务名称
define("_SERVICENAME", "PHP Service");


//定义服务显示名称
define("_SERVICEINFONAME", "PHP Service");


//定义php.exe存放路径
define("_PATH", "D:\xampp\php\php.exe");


//定义所要执行的程序名称
define("_PARAMS", "D:\xampp\htdocs\dispatchSys\configs\phpToService\win32_service.php");


//定义程序分隔执行时间，单位：秒
define("_SLEEP", 5);

?>