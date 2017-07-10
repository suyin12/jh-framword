<?php
/*
 *列出所有用户角色
 * 
 * */
//页面访问权限
require_once ('../../auth.php');
//配置文件 数据库和pdo smarty初始化等
require_once ('../../setting.php');
//连接模板文件
require_once ('../../templateConfig.php');
require_once ('../../dataFunction/unit.data.php');

$title="角色管理";
//查询所有角色
$roleResult=getALLRole($pdo);
//echo "<pre>";
//print_r($roleResult);
$smarty->assign("roleResult",$roleResult);
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/role/index.tpl');
?>