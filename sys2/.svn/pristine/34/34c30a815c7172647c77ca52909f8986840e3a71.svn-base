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
	$tid_arr = $_POST['talents'];
	if(!$tid_arr)
		sys_error($smarty, "未选择人才");
}
else 
	$tid_arr = array($id);


$tid_str = implode(",",$tid_arr);
$sql = "select a.*,b.name as positionName,c.mName as nameLastModifiedBy from a_talent a
 		left join a_position b on a.positionID = b.positionID
 		left join s_user c on a.lastModifiedBy = c.mID
 		where talentID in (".$tid_str.")";



$ret = $pdo->query($sql);
if($ret)
{
	$backup_talents = $ret->fetchAll(PDO::FETCH_ASSOC);
	$smarty->assign("backup_talents",$backup_talents); 
}


# 退回原因
$c_backupReason = array(1=>"退回原因1",2=>"退回原因2",3=>"退回原因3",4=>"退回原因4",0=>"其他原因");




$smarty->assign("c_backupReason",$c_backupReason);




$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/reserve.tpl");



?>