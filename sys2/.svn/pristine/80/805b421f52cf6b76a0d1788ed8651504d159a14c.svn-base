<?php
/*
*       2011-3-14
*       <<<  申请离职工资  >>>
*       create by Great sToNe
*       have fun,.....
*/
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#链接通用函数库
require_once sysPath . 'common.function.php';
#链接分页类
require_once sysPath . 'class/pagenation.class.php';
#页面标题
$title = "离职工资管理索引页";
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager ( $pdo, "2_1" );
$j_unitManager = json_encode ( $unitManager );
#获取某时间段
if ($_GET ['bT'] and $_GET ['eT']) {
	$beginTime = $_GET ['bT'];
	$endTime = $_GET ['eT'];
} else {
	$endTime = timeStyle ( "date" );
	$beginTime = date ( "Y-m-d", strtotime ( "$beginTime -10 day" ) );
}
$sql = " select a.ID,c.unitName ,b.name,a.uID,a.entryDate as mountGuardDay,a.dimissionDate from a_dimission a left join a_workerInfo b on a.uID=b.uID left join a_unitInfo c on a.lastUnitID=c.unitID where a.dimissionDate between '$beginTime' and '$endTime'";
//echo "<pre>";
//print_r ( $ret );
//获取中英文对照数组
$engToChsArr = engTochs ();
#生成单位ID
if (! $_GET ['wCS'])
	$mID = $_SESSION ['exp_user'] ['mID'];
else
	$mID = $_GET ['mID'];
foreach ( $unitManager as $uValue ) {
	if ($uValue ['mID'] == $mID) {
		foreach ( $uValue ['unit'] as $uV ) {
			$sqlV .= "'" . $uV ['unitID'] . "',";
		}
	}
}
$sqlV = rtrim ( $sqlV, "," );
if ($_GET ['unitID']) {
	$unitID = $_GET ['unitID'];
	$sql .= " and a.lastUnitID like '$unitID' ";
	$ZFsqlV = " and (b.unitID like '$unitID' ";
	$exSqlV = " and a.unitID like '$unitID' ";
} else {
	$sql .= " and a.lastUnitID in(" . $sqlV . ")";
	$ZFsqlV = " and (b.unitID in(" . $sqlV . ")";
	$exSqlV = " and a.unitID in(" . $sqlV . ")";
}
#分页并输出结果
if ($_GET ['displayAll'] == 'true') {
	$pagesize = 'all';
} else {
	$pagesize = '20';
}
$queryStr = $_SERVER ['QUERY_STRING'];
$page = $_GET ['page'];
$ret = paginationAction ( $pdo, $sql, $page, $queryStr, $pagesize );

//遍历客户经理,单位数组
foreach ( $unitManager as $um_v ) {
	foreach ( $um_v as $um_v_k => $um_v_v ) {
		if ($um_v ['mID'] == $mID) {
			//构造get后,单位数组
			$um [0] = array ("mID" => $um_v ['mID'], "mName" => $um_v ['mName'], "unit" => $um_v ['unit'] );
		} else {
			//构造get后,单位数组,除get外其余的客户经理
			$um_m[$um_v['mID']] = array ("mID" => $um_v ['mID'], "mName" => $um_v ['mName'] );
		}
	}
}
//构造get后,单位数组
$um_m = array_unique ( $um_m );
if ($um) {
	$um = array_merge ( $um, $um_m );
	$smarty->assign ( "unitManager", $um );
} else {
	$smarty->assign ( "unitManager", $unitManager );
}
#获取最近10次离职工资的操作记录
$exSql = "select a.month,a.unitID,a.extraBatch,a.salaryDate,a.soInsDate,a.comInsDate,a.managementCostDate,sum(1),sum(a.pay),sum(a.pTax),sum(a.acheive),sum(a.totalFee),a.confirmStatus,a.zID,b.appProID,b.status from a_dimissionSalary a left join a_approval_list b on (a.month=b.month and a.extraBatch=b.extraBatch and a.unitID=b.unitID) where a.status <>'0' ";
$exSql .= $exSqlV;
$exSql .= " and (b.type='dimissionSalary' or b.type is null) group by a.unitID ,a.extraBatch limit 10";
$exRet = SQL ( $pdo, $exSql );
#获取工资账套
$ZFsql = " select a.zID,a.zName from a_zFormatInfo a left join a_zFormulas  b on a.zID=b.zID where a.status like '1'  " . $ZFsqlV . " or b.unitID is null) group by a.zID  ";
$ZFRet = SQL ( $pdo, $ZFsql );
foreach ( $ZFRet as $v ) {
	$ZFArr [$v ['zID']] = $v ['zName'];
}
#日期数组
$j = 6; //时间跨度在6个月以内
for($i = 0; $i < $j; $i ++) {
	$t = null;
	$t = strtotime ( timeStyle ( "Ym", "" ) . "-$i month" );
	$key = date ( "Ym", $t );
	$DateArr [$key] = date ( "Y年m月", $t );
}
#单位名称和编号
$unitArr = unitAll($pdo, " unitID,unitName ");
$unitArr = keyArray($unitArr, "unitID");
#配置变量
$smarty->assign ( array ("ZFArr" => $ZFArr, "engToChsArr" => $engToChsArr, "url" => httpPath . "salaryManage/editDimissionSalary.php" ) );
$smarty->assign ( array("DateArr"=> $DateArr,"unitArr"=>$unitArr ));
$smarty->assign ( "j_unitManager", $j_unitManager );
$smarty->assign ( "s_unitID", $unitID );
$smarty->assign ( "s_mID", $mID );
$smarty->assign ( "ret", $ret );
$smarty->assign ( "exRet", $exRet );
$smarty->assign ( array ("bT" => $beginTime, "eT" => $endTime ) );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "salaryManage/dimissionSalaryIndex.tpl" );
?>