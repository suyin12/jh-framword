<?php

require_once '../../setting.php';
require_once sysPath . 'common.function.php';
//连接模板文件
require_once webSysPath . 'templateConfig.php';
$title = "登陆窗口";
#通过服务器验证
//$_SESSION ['historyUrl'] = $_SERVER ['HTTP_REFERER'];
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("w/login/login.tpl");
?>

