<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';

$title = "员工管理";
/*  初始化设置*/
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->wInfoSetArr ();
$wInfoSet = $wSet->wInfoSet;
$status = $wInfoSet ['status'];
$role = $wInfoSet ['role'];
$type = $wInfoSet ['type'];
$domicile = $wInfoSet ['domicile'];
$proTitle = $wInfoSet ['proTitle'];
$proLevel = $wInfoSet ['proLevel'];
$cType = $wInfoSet ['cType'];
$hospitalization = array ("1" => "综合", "2" => "住院", "4" => "合作" );
$hand = array ("1" => "右手", "2" => "左手" );
$marriage = $wInfoSet ['marriage'];
$education = $wInfoSet ['education'];
$nation = $wInfoSet ['nation'];
$sex = $wInfoSet ['sex'];
//额外的添加的员工信息项
$wInfoExtraField = wInfoExtraFieldSet();
#获取员工信息
$uID = $_GET ['uID'];
$lastModifyDate = $_GET ['lastModifyTime'];
if (! $lastModifyDate)
	$sql = "select a.*,b.unitName,c.dimissionDate,c.dimissionReason,c.dimissionRemarks,d.status as paper_status from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID left join a_dimission c on a.uID=c.uID 
		left join a_papers d on a.uID = d.uID where a.uID like '" . $uID . "'";
else
	$sql = "select a.*,b.unitName from a_workerInfo_history a left join a_unitInfo b on a.unitID=b.unitID  where a.uID like '" . $uID . "' and a.lastModifyDate='$lastModifyDate'";
$res = $pdo->prepare ( $sql );
$res->execute ( array ($uID ) );

//$sql = "select a.*,b.unitName from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.uID like '" . $uID . "'";
//$res = $pdo->query ( $sql );
$row = $res->fetch ( PDO::FETCH_ASSOC );
foreach ( $row as $k => $v ) {
	switch ($k) {
		case "status" :
		case "sex" :
		case "role" :
		case "type" :
		case "domicile" :
		case "proTitle" :
		case "proLevel" :
		case "unitID" :
		case "marriage" :
		case "education" :
		case "nation" :
		case "hospitalization" :
		case "hand" :
		case "cType":	
			$k = "s_" . $k;
			break;
	
	}
	$smarty->assign ( "{$k}", $v );
}

#smarty 参数定义
//get传值
$smarty->assign ( "model", $model );
//资料的完整性
$smarty->assign ( "status", $status );
//性别
$smarty->assign ( "sex", $sex );
//派遣类型
$smarty->assign ( "type", $type );
//户口类型
$smarty->assign ( "domicile", $domicile );
//单位信息
$smarty->assign ( "unit", $unit );
//婚姻情况
$smarty->assign ( "marriage", $marriage );
//保险项目
$smarty->assign ( "hospitalization", $hospitalization );
$smarty->assign ( "hand", $hand );
$smarty->assign ( array ("education" => $education, "nation" => $nation, "role" => $role, "proTitle" => $proTitle, "proLevel" => $proLevel ,"cType"=>$cType) );
//额外项
$smarty->assign(array("wInfoExtraField" => $wInfoExtraField, "wInfoExtraFieldVal" => $wInfoExtraFieldVal));
$smarty->assign ( "unitAll", $unitAll );

//模板配置信息
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "workerInfo/wPersonInfoList.tpl" );
?>