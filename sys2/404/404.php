<?php

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';


#页面标题
$title = "404错误页";

#变量配置
$smarty->assign(array("authorCompany" => $authorCompany, "authorUrl" => $authorUrl));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("404/404.tpl");
?>