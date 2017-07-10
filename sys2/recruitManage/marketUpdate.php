<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once '../common.function.php';

$id = $_GET['id'];
if(!$id)
{
	sys_error($smarty,"参数错误");
}

$sql = "select marketID from a_market where marketID = ".$id;
$ret = $pdo->query($sql);
$rows = $ret->rowCount();
if(!$rows)
{
	sys_error($smarty,"该市场不存在，请不要随意修改URL");
}


// 查询指定市场ID的信息
$sql = "select * from a_market where marketID = ".$id;
$ret = $pdo->query($sql);
if($ret)
{
	$market = $ret->fetch(PDO::FETCH_ASSOC);
}

$sql = "select * from a_market_contactinfo where marketid = ".$id;
$ret = $pdo->query($sql);
if($ret)
{
	$contactinfo = $ret->fetchAll(PDO::FETCH_ASSOC);
}

// 招聘部人员名单
$sql = "SELECT mID,mName FROM s_user WHERE groupID REGEXP '4,'";
$ret = $pdo->query($sql);
if($ret)
{
	$result = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $v)
	{
		$users[$v['mID']] = $v['mName'];
	}
}



$smarty->assign("market",$market);
$smarty->assign("contactinfo",$contactinfo);
$smarty->assign("users",$users);

//$smarty->debugging = true;

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/marketUpdate.tpl");

?>