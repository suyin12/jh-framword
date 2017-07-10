<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';

$title = "渠道管理";

// 招聘部人员名单
$sql = "SELECT mID,mName FROM s_user WHERE groupID  REGEXP '4,'";
$ret = $pdo->query($sql);
if($ret)
{
	$result = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $v)
	{
		$users[$v['mID']] = $v['mName'];
	}
}




$smarty->assign("users",$users);


$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/marketCreate.tpl");

?>