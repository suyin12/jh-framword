<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once '../common.function.php';

$title = "创建招聘计划";
$current_date = date('Y-m-d');




#招聘人员
$sql = "SELECT mID,mName FROM s_user WHERE groupID  REGEXP '4,'";
$ret = $pdo->query($sql);
if($ret)
{
	$result = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $v)
	{
		$recruiter_opt[$v['mID']] = $v['mName'];
	}
}


// 查询所有渠道市场信息

$sql = "SELECT marketID,name FROM a_market";
$ret = $pdo->query($sql);
if($ret)
{
	$res = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($res as $v)
	{
		$markets[ $v['marketID'] ] = $v['name'];
	}
}


$smarty->assign("requires_opt",$requires_opt);
$smarty->assign("recruiter_opt",$recruiter_opt);
$smarty->assign("demands_selected",$demands);
$smarty->assign("markets",$markets);


$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/planCreate.tpl");

?>