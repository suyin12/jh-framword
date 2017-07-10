<?php

/**
 * 用户管理
 */
//页面访问权限
require_once ('../auth.php');
//配置文件 数据库和pdo smarty初始化等
require_once ('../setting.php');
//连接模板文件
require_once ('../templateConfig.php');
require_once ('../dataFunction/unit.data.php');

$title = "用户管理";

//查出所有部门
$allGroup = getALLGruop($pdo);
//查出所有角色
$allRole = getALLRole($pdo);
//读取出人员信息
if (isset($_GET["selStruts"]) || isset($_GET["selGroup"]) || isset($_GET["selRole"])) {
    $vstatus = $_GET["selStruts"];
    $vgroupID = $_GET["selGroup"];
    $vroleID = $_GET["selRole"];
    //echo $vstatus."+".$vgroupID."+".$vroleID;.
    $allUserIn = getAboutUser($pdo, $status = "$vstatus", $groupID = "$vgroupID", $roleID = "$vroleID");
} else {
    $allUserIn = getAboutUser($pdo, $status = "1", $groupID = "", $roleID = ""); //默认是在职状态
}

foreach ($allUserIn as $key => $val) {
    $allUserIn[$key]['groupID'] = array_filter(explode(",", $val['groupID']));
    $allUserIn[$key]['roleID'] = array_filter(explode(",", $val['roleID']));
}
//echo "<pre>";
//print_r($allUserIn);
$smarty->assign("vstatus", $vstatus);
$smarty->assign("vgroupID", $vgroupID);
$smarty->assign("vroleID", $vroleID);
$smarty->assign("allGroup", $allGroup);
$smarty->assign("allRole", $allRole);
$smarty->assign("allUserIn", $allUserIn);
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/user_manager.tpl');
?>