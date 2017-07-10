<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';

$title = "招聘计划详细信息";

$id = $_GET['id'];
if(!$id)
{
	sys_error($smarty,"参数错误");
}

$sql = "SELECT r.*,u.mName FROM a_recruitplan r LEFT JOIN s_user u ON r.createdBy = u.mID WHERE id = ".$id;
$ret = $pdo->query($sql);

if($ret)
{
	$plan = $ret->fetch(PDO::FETCH_ASSOC);
}

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

// 查询所有需求

$sql = "SELECT r.*,p.*,u.mName,un.unitName FROM a_recruitdemand r 
		LEFT JOIN a_position p on r.positionID = p.positionID 
		LEFT JOIN a_unitinfo un on p.unitId = un.unitID
		LEFT JOIN s_user u on r.createdBy = u.mID ";

$ret = $pdo->query($sql);
if($ret)
{
	$res = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($res as $v)
	{
		$requires_opt [ $v['demandID'] ] = $v['name']." ".$v['unitName'];
	}
}

// 查询所有市场


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



$smarty->assign("plan",$plan);
$smarty->assign("recruiter_opt",$recruiter_opt);
$smarty->assign("requires_opt",$requires_opt);
$smarty->assign("markets_opt",$markets);
$smarty->assign("leader_s",$plan['leader']);
$smarty->assign("member_s",explode(",",$plan['member']));
$smarty->assign("requires_s",explode(",",$plan['requires']));
$smarty->assign("market_s",explode(",", $plan['market']));


$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/planInfo.tpl");

?>