<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once '../common.function.php';

$title = "市场评估详细信息";

$id = $_GET['id'];
if(!$id)
{
	sys_error($smarty,"参数错误");
}


$sql = "SELECT m.*,u.mName FROM a_marketassess m LEFT JOIN s_user u on m.createdBy = u.mID WHERE id = ".$id;
$ret = $pdo->query($sql);
if($ret)
{
	$assess = $ret->fetch(PDO::FETCH_ASSOC);
}
else 
{
	sys_error($smarty,"不存在该评估，请不要随意修改URL");
}

// 查询所有岗位
$sql = "SELECT positionID,name,unitName,shortcut FROM a_position p left join a_unitinfo u on p.unitId = u.unitID where p.active = '1'  order by shortcut";
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


$smarty->assign("assess",$assess);
$smarty->assign("positions",$positions);
$smarty->assign("markets",$markets);

$smarty->assign("proper_s",explode(",",$assess['proper']));
$smarty->assign("improper_s",explode(",",$assess['improper']));
$smarty->assign("increase_s",explode(",",$assess['increase']));

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/assessInfo.tpl");

?>