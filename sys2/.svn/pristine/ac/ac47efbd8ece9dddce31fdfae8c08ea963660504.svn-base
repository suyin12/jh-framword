<?php

/*
 * Description of roleManage
 *  添加,修改角色信息
 * @author sToNe    
 * email :  shi35dong@gmail.com
 * 
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#标题
$title = "角色及组管理";
//查询所有角色
$roleArr = getALLRole($pdo);
$groupArr = getALLGruop($pdo);

$smarty->assign(array("roleArr" => $roleArr, "groupArr" => $groupArr));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/roleManage.tpl');
?>
