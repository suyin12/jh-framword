<?php
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#标题
$title = "审批流程管理";
#
$sql="select * from `s_approvalPro_set` ";
$ret = SQL($pdo,$sql);


$smarty->assign(array("ret" => $ret));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/approvalManage.tpl');
?>
