<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once '../common.function.php';


$title = "招聘需求详细信息";

$id = $_GET['id'];
if(!$id)
	sys_error($smarty, "URL缺少参数");

$sql = "select p.*,r.deadline,r.required,r.recommend,r.entry,r.status 
		 from a_recruitdemand r left join a_position p on r.positionID = p.positionID 
		 left join s_user u on r.createdBy = u.mID  where demandID = ".$id ;


$ret = $pdo->query($sql);
$rows = $ret->rowCount();

if(!$rows)
	sys_error($smarty, "该需求不存在，请不要修改URL");
else 
{
	$the_require = $ret->fetch(PDO::FETCH_ASSOC);
	$smarty->assign("the_require",$the_require);
	
}


$allunits = getUnits($pdo);


$smarty->assign("allunits",$allunits);

$smarty->assign("demandID",$id);



$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/requireInfo.tpl");

?>
