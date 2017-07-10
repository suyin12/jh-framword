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
require_once sysPath . 'dataFunction/user.data.php';

$title = "用户访问权限分配";

//通过ID得出用户的相关信息
if (isset ( $_GET ["id"] )) {
	$mID = $_GET ["id"];
	$user = new user ();
	$user->pdo = $pdo;
	$user->userBasic ( 'mID,roleID,Function_ID_STR  as userAllowStr', "`mID`=$mID" );
	$user->roleRelation ( ' Function_ID_STR  as roleAllowStr' );
	$accessArr = $user->userAccessArr ();
	$functionList = $accessArr [$mID] ['allow'];
}

#获取权限列表
$headerConfig = headerConfig ( $pdo, "'1','2'" );
$father = $headerConfig ['father'];
$child = $headerConfig ['child'];

#权限配置
if (isset ( $_POST ['Submit'] )) {
	$success_Meg = "<script>alert('权限编辑成功！');window.location.href=window.location.href;</script>";
	$fail_Meg = "<script>alert('错了，错了！');window.location.href=window.location.href;</script>";
	#
	$allowList = $_POST["action_code"];
	$banList =$allowList? array_diff(array_keys($child),$allowList):array_keys($child);
	$allowList? $allowStr = ",".implode(',', $allowList) :"";
	$banList?$banStr = ",-".implode(',-', $banList) :"";
	$function_STR = $allowStr .$banStr. ",";
	#
	$sql_update = "UPDATE `s_user` SET `Function_ID_STR`='$function_STR' WHERE `mID`=:var";
	$res = $pdo->prepare ( $sql_update );
	$res->bindParam ( ":var", $mID );
	$affected = $res->execute ();
	if ($affected) {
		echo $success_Meg;
	} else {
		echo $fail_Meg;
	}
}
$smarty->assign ( "userID", $userID );
$smarty->assign ( array (
		"father" => $father,
		"child" => $child 
) );
$smarty->assign ( "roleList", $functionList );
$smarty->assign ( "lastUrl", httpPath . "system/user_Manager.php" );
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( 'system/edit_role.tpl' );
?>