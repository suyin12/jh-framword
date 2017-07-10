<?php

/*
 *     2011-06-08
 *          <<<公积金平账索引页面  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#通用函数库
require_once '../common.function.php';
#页面标题
$title = "公积金平账首页";
if ($_GET ['HFDate']) {
	$HFDate = $_GET ['HFDate'];
	$lastHFDate = date ( "Ym", strtotime ( timeStyle ( "firstdayMon" ) . " -1 month" ) );
} else {
	header ( "location:" . httpPath . "housingFundManage/HFBalFeeIndex.php?HFDate=" . timeStyle ( "Ym", "" ) );
}
$exceArr = array (
		":HFDate" => $HFDate 
);
#/验证公积金缴交明细的人员是否都已经录入到系统中...并获取已经导入的月份
$sql = "select uID,HFDate,housingFundID from a_HFFee_tmp group by  HFDate order by HFDate desc limit 6";
$HFDateRet = SQL ( $pdo, $sql );
foreach ( $HFDateRet as $sov ) {
	$HFDateArr [timeStyle ( "Ym", "" )] = date ( "Y年m月", time () );
	$HFDateArr [$HFDate] = substr ( $HFDate, 0, 4 ) . "年" . substr ( $HFDate, 4, 2 ) . "月";
	$HFDateArr [$lastHFDate] = substr ( $lastHFDate, 0, 4 ) . "年" . substr ( $lastHFDate, 4, 2 ) . "月";
	//验证公积金缴交明细的人员是否都已经录入到系统中...
	if ($HFDate == $sov ['HFDate'])
		$existsRet = $sov;
	$HFDateArr [$sov ['HFDate']] = substr ( $sov ['HFDate'], 0, 4 ) . "年" . substr ( $sov ['HFDate'], 4, 2 ) . "月";
}

$HFValidUrl = httpPath . "housingFundManage/validHFFee.php?" . $_SERVER ['QUERY_STRING'];
if ($existsRet) {
	$housingFundIDSql = "select uID,housingFundID,HFDate from a_HFFee_tmp where HFDate like '$HFDate' group by housingFundID";
	$housingFundIDArr = SQL ( $pdo, $housingFundIDSql );
	#客户经理单位数组
	$unitManager = unit_manager ( $pdo, "2_1" );
	#取得缴交明细中各个单位的数组,以unitID为KEY
	$sql = "select a.unitID,a.pTotal,a.uTotal from a_HFFee_tmp a where a.HFDate like '$HFDate'";
	$HFRet = SQL ( $pdo, $sql );
	$HF = null;
	foreach ( $HFRet as $key => $val ) {
		$HF [$val ['unitID']] ['uTotal'] += $val ['uTotal'];
		$HF [$val ['unitID']] ['pTotal'] += $val ['pTotal'];
		$HF [$val ['unitID']] ['num'] += 1;
	}
	unset ( $HFRet );
	#查看费用表情况
	$sql = "select unitID,month,sum(uHF) as uTotal,sum(pHF) as pTotal from a_originalFee where HFDate like :HFDate group by unitID";
	$fUnitRet = SQL ( $pdo, $sql, $exceArr );
	$sql = "select unitID,month,sum(uHF) as uTotal,sum(pHF) as pTotal from a_mul_originalFee where HFDate like :HFDate group by unitID";
	$mulFeeUnitRet = SQL ( $pdo, $sql, $exceArr );
	if ($mulFeeUnitRet) {
		$mulFeeUnitRet = keyArray ( $mulFeeUnitRet, "unitID" );
		foreach ( $fUnitRet as $fVal ) {
			$feeUnitRet [$fVal ['unitID']] ['unitID'] = $fVal ['unitID'];
			$feeUnitRet [$fVal ['unitID']] ['month'] = $fVal ['month'];
			$feeUnitRet [$fVal ['unitID']] ['uTotal'] = $fVal ['uTotal'] + $mulFeeUnitRet [$fVal ['unitID']] ['uTotal'];
			$feeUnitRet [$fVal ['unitID']] ['pTotal'] = $fVal ['pTotal'] + $mulFeeUnitRet [$fVal ['unitID']] ['pTotal'];
		}
	} else
		$feeUnitRet = $fUnitRet;
	if ($feeUnitRet) {
		
		$feeUnitRet = keyArray ( $feeUnitRet, "unitID" );
		#获取该公积金月份对应的费用月份...每个单位是不同的公积金月份,费用月份
		$pMR = $sql = $mR = $uAR = $cAR = $cART = null;
		foreach ( $feeUnitRet as $key => $val ) {
			$month = $val ['month'];
			#查看欠/挂/冲减挂账记录表
			$sql = "select a.unitID,a.uHFMoney,a.pHFMoney,a.type,a.status from a_prsRequireMoney a where a.unitID like '$key' and a.month like '$month' ";
			$prsMoneyRet = SQL ( $pdo, $sql );
			foreach ( $prsMoneyRet as $v ) {
				$prsType = $v ['type'];
				switch ($prsType) {
					case "1" :
						$pMR [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMR [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
					case "2" :
						$pMR [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMR [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
					case "3" :
						$pMR [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMR [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
					case "4" :
						$pMR [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMR [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
				}
			}
			#查看欠/挂/冲减挂账记录表
			$sql = "select a.unitID,a.uHFMoney,a.pHFMoney,a.type,a.status from a_prsRequireMoney_tmp a where a.unitID like '$key' and a.month like '$month' ";
			$prsMoneyRet = SQL ( $pdo, $sql );
			foreach ( $prsMoneyRet as $v ) {
				$prsType = $v ['type'];
				switch ($prsType) {
					case "1" :
						$pMRTmp [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMRTmp [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
					case "2" :
						$pMRTmp [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMRTmp [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
					case "3" :
						$pMRTmp [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMRTmp [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
					case "4" :
						$pMRTmp [$key] [$prsType] ['pHF'] += $v ['pHFMoney'];
						$pMRTmp [$key] [$prsType] ['uHF'] += $v ['uHFMoney'];
						break;
				}
			}
	
			#平账提交结果验证
			$balDetailSql = "select * from a_action_record a where  a.`month`='$month'  and  a.type='6' and a.unitID like '$key'";
			$balDetailRet [$key] = SQL ( $pdo, $balDetailSql, null, 'one' );
			$balStatusArr = array (
					"0" => "未签收",
					"1" => "已",
					"2" => "已复核",
					"99" => "被退回" 
			);
			unset ( $prsMoneyRet, $moneyRet, $uAccountRet, $cAccountRet, $cAccountRetT, $month );
		}
	}
}
#变量配置
//$smarty->debugging = true;
$smarty->assign ( array (
		"HFDateRet" => $HFDateRet,
		"housingFundIDArr" => $housingFundIDArr,
		"HFDateArr" => $HFDateArr,
		"s_HFDate" => $HFDate,
		"balDetailRet" => $balDetailRet,
		"balStatusArr" => $balStatusArr 
) );
$smarty->assign ( array (
		"existsRet" => $existsRet,
		"HFValidUrl" => $HFValidUrl 
) );
$smarty->assign ( "unitManager", $unitManager );
$smarty->assign ( array (
		"HF" => $HF 
) );
$smarty->assign ( array (
		"feeUnitRet" => $feeUnitRet,
		"HFRet" => $HFRet,
		"pMR" => $pMR,
		"pMRTmp" => $pMRTmp,
		"mR" => $mR,
		"uAR" => $uAR,
		"cAR" => $cAR,
		"cART" => $cART 
) );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "housingFundManage/HFBalFeeIndex.tpl" );
?>