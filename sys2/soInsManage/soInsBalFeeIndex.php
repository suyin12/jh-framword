<?php

/*
 *     2010-8-25
 *          <<<社保平账索引页面  >>>
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
$title = "社保平账首页";
if ($_GET ['soInsDate']) {
	$soInsDate = $_GET ['soInsDate'];
	$lastsoInsDate = date ( "Ym", strtotime ( timeStyle ( "firstdayMon" ) . " -1 month" ) );
} else {
	header ( "location:" . httpPath . "soInsManage/soInsBalFeeIndex.php?soInsDate=" . timeStyle ( "Ym", "" ) );
}
$exceArr = array (
	":soInsDate" => $soInsDate
);
#/验证社保缴交明细的人员是否都已经录入到系统中...并获取已经导入的月份
$sql = "select uID,soInsDate,soInsID from a_soInsFee_tmp group by  soInsDate order by soInsDate desc limit 6";
$soInsDateRet = SQL ( $pdo, $sql);

foreach ( $soInsDateRet as $sov ) {
	$soInsDateArr [timeStyle ( "Ym", "" )] = date ( "Y年m月", time () );
	$soInsDateArr [$soInsDate] = substr ( $soInsDate, 0, 4 ) . "年" . substr ( $soInsDate, 4, 2 ) . "月";
	$soInsDateArr [$lastsoInsDate] = substr ( $lastsoInsDate, 0, 4 ) . "年" . substr ( $lastsoInsDate, 4, 2 ) . "月";
	
	//验证社保缴交明细的人员是否都已经录入到系统中...
	if ($soInsDate == $sov ['soInsDate'])
		$existsRet = $sov;
	$soInsDateArr [$sov ['soInsDate']] = substr ( $sov ['soInsDate'], 0, 4 ) . "年" . substr ( $sov ['soInsDate'], 4, 2 ) . "月";
}
//echo "<pre>";var_dump($existsRet);echo "</pre>";
$soInsValidUrl = httpPath . "soInsManage/validSoInsFee.php?" . $_SERVER ['QUERY_STRING'];
if ($existsRet) {
	$soInsIDSql = "select uID,soInsID,soInsDate from a_soInsFee_tmp where soInsDate like '$soInsDate' group by soInsID";
	$soInsIDArr = SQL ( $pdo, $soInsIDSql );
	#客户经理单位数组
	$unitManager = unit_manager ( $pdo, "2_1" );
	#取得缴交明细中各个单位的数组,以unitID为KEY
	$sql = "select a.unitID,a.pTotal,a.uTotal from a_soInsFee_tmp a where a.soInsDate like '$soInsDate'";
	$soInsRet = SQL ( $pdo, $sql );
	$soIns = null;
	foreach ( $soInsRet as $key => $val ) {
		$soIns [$val ['unitID']] ['uTotal'] += $val ['uTotal'];
		$soIns [$val ['unitID']] ['pTotal'] += $val ['pTotal'];
		$soIns [$val ['unitID']] ['num'] += 1;
	}
	unset ( $soInsRet );
	#查看费用表情况
	$sql = "select unitID,month,sum(uSoIns) as uTotal,sum(pSoIns) as pTotal,sum(uPDIns) as uPDIns from a_originalFee where soInsDate like :soInsDate group by unitID";
	$fUnitRet = SQL ( $pdo, $sql, $exceArr );
	$sql = "select unitID,month,sum(uSoIns) as uTotal,sum(pSoIns) as pTotal,sum(uPDIns) as uPDIns from a_mul_originalFee where soInsDate like :soInsDate group by unitID";
	$mulFeeUnitRet = SQL ( $pdo, $sql, $exceArr );
	if ($mulFeeUnitRet) {
		$mulFeeUnitRet = keyArray ( $mulFeeUnitRet, "unitID" );
		foreach ( $fUnitRet as $fVal ) {
			$feeUnitRet [$fVal ['unitID']] ['unitID'] = $fVal ['unitID'];
			$feeUnitRet [$fVal ['unitID']] ['month'] = $fVal ['month'];
			$feeUnitRet [$fVal ['unitID']] ['uTotal'] = $fVal ['uTotal'] + $mulFeeUnitRet [$fVal ['unitID']] ['uTotal'];
			$feeUnitRet [$fVal ['unitID']] ['pTotal'] = $fVal ['pTotal'] + $mulFeeUnitRet [$fVal ['unitID']] ['pTotal'];
			$feeUnitRet [$fVal ['unitID']] ['uPDIns'] = $fVal ['uPDIns'] + $mulFeeUnitRet [$fVal ['unitID']] ['uPDIns'];
		}
	} else
		$feeUnitRet = $fUnitRet;
	if ($feeUnitRet) {
		$feeUnitRet = keyArray ( $feeUnitRet, "unitID" );
		#获取该社保月份对应的费用月份...每个单位是不同的社保月份,费用月份
		$pMR = $sql = $mR = $uAR = $cAR = $cART = null;
		foreach ( $feeUnitRet as $key => $val ) {
			$month = $val ['month'];
			#查看欠/挂/冲减挂账记录表
			$sql = "select a.unitID,a.uSoInsMoney,a.pSoInsMoney,a.uPDInsMoney,a.type,a.status from a_prsRequireMoney a where a.unitID like '$key' and a.month like '$month' ";
			$prsMoneyRet = SQL ( $pdo, $sql );
			foreach ( $prsMoneyRet as $v ) {
				$prsType = $v ['type'];
				switch ($prsType) {
					case "1" :
						$pMR [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMR [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMR [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
					case "2" :
						$pMR [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMR [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMR [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
					case "3" :
						$pMR [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMR [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMR [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
					case "4" :
						$pMR [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMR [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMR [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
				}
			}
			#用于计算单位实收数的临时操作表
			#查看欠/挂/冲减挂账记录表
			$sql = "select a.unitID,a.uSoInsMoney,a.pSoInsMoney,a.uPDInsMoney,a.type,a.status from a_prsRequireMoney_tmp a where a.unitID like '$key' and a.month like '$month' ";
			$prsMoneyRet = SQL ( $pdo, $sql );
			foreach ( $prsMoneyRet as $v ) {
				$prsType = $v ['type'];
				switch ($prsType) {
					case "1" :
						$pMRTmp [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
					case "2" :
						$pMRTmp [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
					case "3" :
						$pMRTmp [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
					case "4" :
						$pMRTmp [$key] [$prsType] ['pSoIns'] += $v ['pSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uSoIns'] += $v ['uSoInsMoney'];
						$pMRTmp [$key] [$prsType] ['uPDIns'] += $v ['uPDInsMoney'];
						break;
				}
			}

			#平账提交结果验证
			$balDetailSql = "select * from a_action_record a where  a.`month`='$month'  and  a.type='5' and a.unitID like '$key'";
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
		"soInsDateRet" => $soInsDateRet,
		"soInsIDArr" => $soInsIDArr,
		"soInsDateArr" => $soInsDateArr,
		"s_soInsDate" => $soInsDate,
		"balDetailRet" => $balDetailRet,
		"balStatusArr" => $balStatusArr 
) );
$smarty->assign ( array (
		"existsRet" => $existsRet,
		"soInsValidUrl" => $soInsValidUrl 
) );
$smarty->assign ( "unitManager", $unitManager );
$smarty->assign ( array (
		"soIns" => $soIns 
) );
$smarty->assign ( array (
		"feeUnitRet" => $feeUnitRet,
		"soInsRet" => $soInsRet,
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
$smarty->display ( "soInsManage/soInsBalFeeIndex.tpl" );
?>