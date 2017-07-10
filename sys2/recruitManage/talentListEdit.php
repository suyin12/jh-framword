<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';

require_once '../common.function.php';


$id = $_GET['id'];

$sql = "SELECT t.talentID,t.name as t_name,t.idCard,t.sex,un.unitName,
			t.education,t.major,t.telephone as t_telephone,t.positionID,t.unitId,
			t.recruitManagerId,t.status,t.onDuty,t.marketID,t.infoValid,t.material,
			t.remarks,t.createdBy,t.createdOn,t.sign,t.signTime,t.label,t.posRemarks,t.remarksA,t.remarksB,
			t.d_material,t.d_train,t.d_reference,t.d_commit,u3.mName as lastModifiedBy,t.lastModifyTime,
			m.name as m_name,u1.mName as recruitManagerName,u2.mName as sponsorName,
			p.name as p_name,t.marks,t.pass,t.marksRemarks FROM a_talent t
			left join a_market m on t.marketID = m.marketID
			left join s_user u1 on t.recruitManagerId = u1.mID
			left join s_user u2 on t.createdBy = u2.mID
			left join s_user u3 on t.lastModifiedBy = u3.mID
			left join a_position p on t.positionID = p.positionID
			left join a_unitinfo un on p.unitId = un.unitID
			where t.talentID = ".$id;
$ret = $pdo->query($sql);

$rows = $ret->rowCount();
if(!$rows)
{
	echo "参数错误";exit();
}

$talent = $ret->fetch(PDO::FETCH_ASSOC);



$sql = "select unitID,unitName from a_unitinfo where type = 1 or type = 3";
$ret = $pdo->query($sql);
if($ret)
{
	$res = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($res as $v)
	{
		$units [ $v['unitID'] ] = $v['unitName'];
	} 
}


	$sql = "SELECT positionID,name,unitName,shortcut FROM a_position p left join a_unitinfo u 
			on p.unitId = u.unitID where p.active = 1 order by shortcut";
	
$ret = $pdo->query($sql);
if($ret)
{
	$res = $ret->fetchAll();
	foreach($res as $v)
	{
		$positions[$v['positionID']] = $v['shortcut']." ".$v['name'];
	}
}


$smarty->assign("talent",$talent);
$smarty->assign("units",$units);
$smarty->assign("positions",$positions);
$smarty->assign("TRCyesno",array("1"=>"是","2"=>"否"));

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/talentListEdit.tpl");


?>