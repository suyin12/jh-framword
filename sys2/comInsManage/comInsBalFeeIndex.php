<?php

/*
 *     2011-06-08
 *          <<<商保平账索引页面  >>>
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
$title = "商保平账首页";
if ($_GET ['comInsDate']) {
	$comInsDate = $_GET ['comInsDate'];
	$lastcomInsDate = date ( "Ym", strtotime ( timeStyle ( "firstdayMon" ) . " -1 month" ) );
} else {
	header ( "location:" . httpPath . "comInsManage/comInsBalFeeIndex.php?comInsDate=" . timeStyle ( "Ym", "" ) );
}
$exceArr = array (
		":comInsDate" => $comInsDate 
);
#/验证商保缴交明细的人员是否都已经录入到系统中...并获取已经导入的月份
$sql = "select uID,right(batch,6) as comInsDate from a_comInsList group by  batch order by batch desc limit 6";
$comInsDateRet = SQL ( $pdo, $sql );
foreach ( $comInsDateRet as $sov ) {
	$comInsDateArr [timeStyle ( "Ym", "" )] = date ( "Y年m月", time () );
	$comInsDateArr [$comInsDate] = substr ( $comInsDate, 0, 4 ) . "年" . substr ( $comInsDate, 4, 2 ) . "月";
	$comInsDateArr [$lastcomInsDate] = substr ( $lastcomInsDate, 0, 4 ) . "年" . substr ( $lastcomInsDate, 4, 2 ) . "月";
	//验证商保缴交明细的人员是否都已经录入到系统中...
	if ($comInsDate == $sov ['comInsDate'])
		$existsRet = $sov;
	$comInsDateArr [$sov ['comInsDate']] = substr ( $sov ['comInsDate'], 0, 4 ) . "年" . substr ( $sov ['comInsDate'], 4, 2 ) . "月";
}

if ($existsRet) {
	
	#客户经理单位数组
	$unitManager = unit_manager ( $pdo, "2_1" );
	#<<实缴>>费用
	$comRSql = "SELECT a.unitID,sum(c.`comInsMoney`) as comInsR from a_comInsList a left join (a_unitInfo b  left join s_comIns_set c on b.comInsType=c.comInsType )  on a.unitID=b.unitID where   a.batch like 'Com.$comInsDate' and a.status=1 group by a.unitID ";
	$comRRet = SQL ( $pdo, $comRSql );
	$comRRet = keyArray ( $comRRet, "unitID" );
	#取得商保<<应收费>>用中各个单位的数组,以unitID为KEY
	$comSSql = "SELECT a.unitID,sum(b.`uComInsMoney`) as uTotal, sum(b.`pComInsMoney`) as pTotal from a_comInsList a left join a_unitInfo b on a.unitID=b.unitID where b.comInsType<>0 and a.batch like 'Com.$comInsDate' and a.status=1 group by a.unitID";
	$comSRet = SQL ( $pdo, $comSSql );
	$comSRet = keyArray ( $comSRet, "unitID" );
	#查看费用表情况
	$sql = "select unitID,month,sum(uComIns) as uTotal,sum(pComIns) as pTotal from a_originalFee where comInsDate like :comInsDate group by unitID";
	$fUnitRet = SQL ( $pdo, $sql, $exceArr );
	$sql = "select unitID,month,sum(uComIns) as uTotal,sum(pComIns) as pTotal from a_mul_originalFee where comInsDate like :comInsDate group by unitID";
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
		#获取该商保月份对应的费用月份...每个单位是不同的商保月份,费用月份
		$pMR = $sql = $mR = $uAR = $cAR = $cART = null;
		foreach ( $feeUnitRet as $key => $val ) {
			$month = $val ['month'];
			#查看欠/挂/冲减挂账记录表
			$sql = "select a.unitID,a.uComInsMoney,a.pComInsMoney,a.type,a.status from a_prsRequireMoney a where a.unitID like '$key' and a.month like '$month' ";
			$prsMoneyRet = SQL ( $pdo, $sql );
			foreach ( $prsMoneyRet as $v ) {
				$prsType = $v ['type'];
				switch ($prsType) {
					case "1" :
						$pMR [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMR [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
					case "2" :
						$pMR [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMR [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
					case "3" :
						$pMR [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMR [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
					case "4" :
						$pMR [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMR [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
				}
			}
			#查看欠/挂/冲减挂账记录表
			$sql = "select a.unitID,a.uComInsMoney,a.pComInsMoney,a.type,a.status from a_prsRequireMoney_tmp a where a.unitID like '$key' and a.month like '$month' ";
			$prsMoneyRet = SQL ( $pdo, $sql );
			foreach ( $prsMoneyRet as $v ) {
				$prsType = $v ['type'];
				switch ($prsType) {
					case "1" :
						$pMRTmp [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMRTmp [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
					case "2" :
						$pMRTmp [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMRTmp [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
					case "3" :
						$pMRTmp [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMRTmp [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
					case "4" :
						$pMRTmp [$key] [$prsType] ['pComIns'] += $v ['pComInsMoney'];
						$pMRTmp [$key] [$prsType] ['uComIns'] += $v ['uComInsMoney'];
						break;
				}
			}

			#平账提交结果验证
			$balDetailSql = "select * from a_action_record a where  a.`month`='$month'  and  a.type='7' and a.unitID like '$key'";
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
		"comInsDateRet" => $comInsDateRet,
		"comInsDateArr" => $comInsDateArr,
		"s_comInsDate" => $comInsDate,
		"balDetailRet" => $balDetailRet,
		"balStatusArr" => $balStatusArr  
) );
$smarty->assign ( array (
		"existsRet" => $existsRet 
) );
$smarty->assign ( "unitManager", $unitManager );
$smarty->assign ( array (
		"HF" => $HF 
) );
$smarty->assign ( array (
		"feeUnitRet" => $feeUnitRet,
		"comRRet" => $comRRet,
		"comSRet" => $comSRet,
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
$smarty->display ( "comInsManage/comInsBalFeeIndex.tpl" );
?>