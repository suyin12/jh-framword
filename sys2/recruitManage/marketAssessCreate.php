<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';

$title = "创建市场评估";

// 查询所有岗位
$sql = "SELECT positionID,name,unitName,shortcut FROM a_position p left join a_unitinfo u on p.unitId = u.unitID where p.active = '1' order by shortcut";
$ret = $pdo->query($sql);
if($ret)
{
	$res = $ret->fetchAll();
	foreach($res as $v)
	{
		$positions[$v['positionID']] = $v['shortcut']." ".$v['name']."(".$v['unitName'].")";
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


$smarty->assign("positions",$positions);
$smarty->assign("markets",$markets);

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/marketAssessCreate.tpl");

?>