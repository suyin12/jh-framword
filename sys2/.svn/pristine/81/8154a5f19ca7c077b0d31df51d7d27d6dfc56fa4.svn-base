<?php

/*
 *     2010-10-9
 *          <<< 费用审批索引页 ,,这只是一个简单的版本,接下去,还会分开,独立出来>>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接各类库
require_once sysPath . 'dataFunction/classLink.data.php';
#欠/挂费用类库
require_once sysPath . 'dataFunction/moneyInfo.data.php';
#链接员工信息类库
require_once sysPath . 'dataFunction/wInfo.data.php';
#链接员工信息设置类库
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';

$title = "费用审批";
if ($_GET ['month']) {
	$month = $_GET ['month'];
	$mID = $_GET ['mID'];
	$unitID = $_GET ['unitID'];
} else {
	header ( "location:" . httpPath . "approval/feeApprovalIndex.php?month=" . timeStyle ( "Ym", "" ) );
}
#获取每个客户经理的
$unitManager = unit_manager ( $pdo, "2_1" );
$unitArr = unitAll ( $pdo, " unitID,unitName ", "" );
foreach ( $unitManager as $uValue ) {
	if ($uValue ['mID'] == $mID) {
		foreach ( $uValue ['unit'] as $uV ) {
			$unitIDStr .= "'" . $uV ['unitID'] . "',";
		}
	}
}
$unitIDStr = rtrim ( $unitIDStr, "," );
#获取费用月份
$monthSql = "select * from a_editAccountList group by month order by month desc";
$monthRet = SQL ( $pdo, $monthSql );
$monthArr [timeStyle ( "Ym", "" )] = date ( "Y年m月", time () );
foreach ( $monthRet as $sov ) {
	//验证是否有本月待审批的数据
	if ($month == $sov ['month'])
		$existsRet = $sov;
	$monthArr [$sov ['month']] = substr ( $sov ['month'], 0, 4 ) . "年" . substr ( $sov ['month'], 4, 2 ) . "月";
}
#平账提交结果验证
$balDetailSql = "select * from a_action_record a where  a.`month`='$month'";
$balDetailRet = SQL ( $pdo, $balDetailSql );
foreach ( $balDetailRet as $bKey => $bVal ) {
	switch ($bVal ['type']) {
		case "5" :
			$bDetailRet ['soIns'] [$bVal ['unitID']] = $bVal;
			break;
		case "6" :
			$bDetailRet ['HF'] [$bVal ['unitID']] = $bVal;
			break;
		case "7" :
			$bDetailRet ['comIns'] [$bVal ['unitID']] = $bVal;
			break;
	}
}
$balDetailRet = keyArray ( $balDetailRet, "unitID" );

#获取该费用月份的所有审批请求
$sql = "select * from a_editAccountList where month like :month";
if ($mID)
	$sql .= " and unitID in ($unitIDStr)";
if ($unitID)
	$sql .= " and unitID like '$unitID'";
$ret = SQL ( $pdo, $sql, array (
		":month" => $month 
) );
foreach ( $ret as $key => $val ) {
	$type = $val ['type'];
	switch ($type) {
		case "1" :
			$mineArr [$val ['unitID']] = array (
					"unitName" => $unitArr [$val ['unitID']] ['unitName'],
					"status" => $val ['status'],
					"confirmStatus" => $val ['confirmStatus'],
					"type" => $type 
			);
			break;
		case "2" :
			$theirArr [$val ['unitID']] = array (
					"unitName" => $unitArr [$val ['unitID']] ['unitName'],
					"status" => $val ['status'],
					"confirmStatus" => $val ['confirmStatus'],
					"type" => $type 
			);
			break;
		case "3" :
			$companyArr [$val ['unitID']] = array (
					"unitName" => $unitArr [$val ['unitID']] ['unitName'],
					"status" => $val ['status'],
					"confirmStatus" => $val ['confirmStatus'],
					"type" => $type 
			);
			break;
		case "4" :
			$writeDownArr [$val ['unitID']] = array (
					"unitName" => $unitArr [$val ['unitID']] ['unitName'],
					"status" => $val ['status'],
					"confirmStatus" => $val ['confirmStatus'],
					"type" => $type 
			);
			break;
		case "5" :
			$soInsArr [$val ['unitID']] = array (
					"unitName" => $unitArr [$val ['unitID']] ['unitName'],
					"status" => $val ['status'],
					"confirmStatus" => $val ['confirmStatus'],
					"type" => $type 
			);
			break;
		case "6" :
			$HFArr [$val ['unitID']] = array (
					"unitName" => $unitArr [$val ['unitID']] ['unitName'],
					"status" => $val ['status'],
					"confirmStatus" => $val ['confirmStatus'],
					"type" => $type 
			);
			break;
		case "7" :
			$comInsArr [$val ['unitID']] = array (
					"unitName" => $unitArr [$val ['unitID']] ['unitName'],
					"status" => $val ['status'],
					"confirmStatus" => $val ['confirmStatus'],
					"type" => $type 
			);
			break;
	}
}
unset ( $ret );
$wholeWDSql = "select a.*,b.unitID from a_uWriteDownList a left join a_unitInfo b on a.unitID=b.unitID where a.month like :month ";
if ($mID)
	$wholeWDSql .= " and a.unitID in ($unitIDStr)";
if ($unitID)
	$wholeWDSql .= " and a.unitID like '$unitID'";
$wholeWDSql .= " group by a.unitID";
$wholeWDRet = SQL ( $pdo, $wholeWDSql, array (
		":month" => $month 
) );
foreach ( $wholeWDRet as $key => $val ) {
	$wholeWDArr [$val ['unitID']] = array (
			"unitName" => $unitArr [$val ['unitID']] ['unitName'],
			"status" => $val ['status'] 
	);
}
//echo "<pre>";
//print_r ( $companyArr );
#下载当月欠/挂明细
if (isset ( $_POST ['downLoadDetail'] )) {
	#获取符合条件的人才,即合格状态以上的人员
	$a = new moneyInfo ();
	$a->pdo = $pdo;
	$a->moneyBasic ( " * ", " `month`='" . $month . "' order by `unitID`" );
	$a->classLinkClass ();
	#各应聘人员的信息
	$a->moneyDetailArr ();
	$moneyDetailArr = $a->ret;
	
	#保存为EXCEL
	$tableHead = array (
			"ID" => "系统编号",
			"uID" => "员工编号",
			"name" => "姓名",
			"pID" => "身份证",
			"unitName" => "单位",
			"month" => "费用月份",
			"extraBatch" => "批次",
			"uPDInsMoney" => "残障金",
			"pSoInsMoney" => "个人社保",
			"uSoInsMoney" => "单位社保",
			"uHFMoney" => "单位公积金",
			"pHFMoney" => "个人公积金",
			"uComInsMoney" => "单位商保",
			"pComInsMoney" => "个人商保",
			"managementCostMoney" => "管理费",
			"typeName" => "类型",
			"wStatus" => "在职状态" 
	);
	$excelTitle = $month . "平账明细";
	$thArr [] = $tableHead;
	$excelRet = array_merge ( $thArr, $moneyDetailArr );
	if (! $excelRet)
		exit ( "<script> alert('无数据导出') </script>" );
		
		#链接PHPEXCEL CLASS
	require_once '../class/phpExcel/Classes/PHPExcel.php';
	require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
	require_once '../class/excel.class.php';
	$oExcel = new PHPExcel ();
	#设置文档基本属性
	$oPro = $oExcel->getProperties ();
	$oPro->setCreator ( $serverCompany ); //公司名
	#构造输出函数
	$op = new excelOutput ();
	$op->oExcel = $oExcel;
	$op->eRes = $excelRet;
	$op->selFieldArray = $tableHead;
	$op->title = $excelTitle;
	$op->fillData ();
	$op->eFileName = $excelTitle . ".xls";
	$op->output ();
}

#加载模板变量
$smarty->assign ( array (
		"mineArr" => $mineArr,
		"theirArr" => $theirArr,
		"companyArr" => $companyArr,
		"writeDownArr" => $writeDownArr,
		"wholeWDArr" => $wholeWDArr,
		"soInsArr" => $soInsArr,
		"HFArr" => $HFArr,
		"comInsArr" => $comInsArr 
) );
$smarty->assign ( array (
		"monthArr" => $monthArr,
		"month" => $month,
		"s_month" => $month,
		"s_mID" => $mID,
		"bDetailRet" => $bDetailRet,
		"balStatusArr" => $balStatusArr 
) );
$smarty->assign ( "unitManager", $unitManager );
//$smarty->assign();
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "approval/feeApprovalIndex.tpl" );
?>