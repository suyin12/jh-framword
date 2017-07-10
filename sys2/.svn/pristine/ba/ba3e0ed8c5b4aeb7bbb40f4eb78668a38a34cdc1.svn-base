<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
// 分页
require_once '../class/pagenation.class.php';

require_once '../dataFunction/unit.data.php';


$title = "招聘需求明细";

$position = $_GET['pos'];
$batch = $_GET['batch'];


$sql = "SELECT r.batch,r.demandID,r.positionID,r.deadline,r.required,r.recommend,r.entry,r.status,r.createdBy as rCreatedBy,
		r.createdOn as rCreatedOn,p.*,u.mName,un.unitName FROM a_recruitdemand r 
		LEFT JOIN a_position p on r.positionID = p.positionID 
		LEFT JOIN a_unitinfo un on p.unitId = un.unitID
		LEFT JOIN s_user u on r.createdBy = u.mID 
		where r.positionID = '".$position."' and r.batch = '".$batch."' and r.status = '3'";


$ret = $pdo->query($sql);
$requireDetail = $ret->fetchAll(PDO::FETCH_ASSOC);



$smarty->assign("rd",$requireDetail);

//$smarty->debugging = true;
//
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
//
$smarty->display("recruitManage/requireDetail.tpl");

?>