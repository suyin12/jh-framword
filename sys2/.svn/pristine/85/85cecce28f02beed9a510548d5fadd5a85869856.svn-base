<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 分页
require_once '../class/pagenation.class.php';

require_once 'constantConfig.php';
require_once '../dataFunction/unit.data.php';


$title = "档案管理";

$huzheng_type = array("1"=>"深户档案托管","2"=>"招工","3"=>"调工","4"=>"招干","5"=>"调干");

$type = $_GET['type'];
$id = $_GET['id'];

if(!$type || !in_array($type,array(1,2,3,4)))
	$type = 1;

if($id)
{
	$sql = "select * from a_workerinfo w 
			left join a_unitinfo u on w.unitID = u.unitID 
			left join a_dimission d on w.uID = d.uID where w.uID = '".$id."'";
	$ret = $pdo->query($sql);
	if($ret)
		$worker = $ret->fetch(PDO::FETCH_ASSOC);
	$smarty->assign("worker",$worker);
	if($managerID = manager($pdo,$worker['unitID'],"2_1"))
		$smarty->assign("managerID",$managerID);
}
	
// 客户经理
$sql = "SELECT mID,mName FROM s_user  WHERE roleID REGEXP '2_1,'";
$ret = $pdo->query($sql);
if($ret)
{
	$result = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $v)
	{
		$managers[$v['mID']] = $v['mName'];
	}
}
	


$smarty->assign("type",$type);
$smarty->assign("c_sex",$c_sex);
$smarty->assign("huzheng_type",$huzheng_type);
$smarty->assign("managers",$managers);
$smarty->assign("yesno",array(1=>"是",2=>"否"));


$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("agencyService/archiveCreate.tpl");


?>