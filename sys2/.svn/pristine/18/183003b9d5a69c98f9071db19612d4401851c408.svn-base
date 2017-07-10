<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
// 分页
require_once '../class/pagenation.class.php';

require_once '../dataFunction/unit.data.php';

$title = "岗位价格参数设置";
$unit = $_GET['units'];
if($unit)
	$sql = "select b.unitName,a.* from a_position a left join a_unitinfo b 
			on a.unitId = b.unitID where a.unitId = '".$unit."'";
else
	$sql = "select b.unitName,a.* from a_position a left join a_unitinfo b on a.unitId = b.unitID";
	
$ret = $pdo->query($sql);
$allpositions = $ret->fetchAll(PDO::FETCH_ASSOC);
$smarty->assign("allpositions",$allpositions);


//列举用工单位表
$sql = "select b.unitID,b.unitName from a_position a left join a_unitinfo b on a.unitId = b.unitID group by a.unitId";
$ret = $pdo->query($sql);
if($ret)
{
	$res = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($res as $v)
	{
		$units[$v['unitID']] = $v['unitName'];
	}
}



$smarty->assign("units",$units);
$smarty->assign("unit_s",$unit);

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );

$smarty->display("recruitManage/pricesetting.tpl");

?>