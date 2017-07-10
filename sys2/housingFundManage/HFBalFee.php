<?php

/*
 *     2011-6-9
 *          <<<公积金平帐表,主要完成公积金的平账>>>
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
#工资费用相关类
require_once sysPath . "dataFunction/salaryFee.data.php";
#页面标题
$title = "公积金平账";
$unitID = $_GET ['unitID'];
$HFDate = $_GET ['HFDate'];
$month = $_GET ['month'];
if (! $unitID || ! $HFDate)
	exit ( "非法网址" );
if ($_GET ['query'] != "detail") {
	#获取员工相关信息, 
	$wSql = "select uID,managementCost,PDIns,type from a_workerInfo where unitID like '$unitID'";
	$wRet = SQL ( $pdo, $wSql );
	$wRet = keyArray ( $wRet, "uID" );
	#获取缴交明细的费用
	$HFSql = "select uID,name,pTotal,uTotal from a_HFFee_tmp a where unitID like :unitID and HFDate like :HFDate";
	$HFRet = SQL ( $pdo, $HFSql, array (
			":HFDate" => $HFDate,
			":unitID" => $unitID 
	) );
	$HFR = keyArray ( $HFRet, "uID" );
	#获取费用表中的公积金费用
	$s = new salaryFee ();
	$s->pdo = $pdo;
	$s->month = $HFDate;
	$s->monthType = "HFDate";
	$s->unitID = $unitID;
	$monthArr = $s->AFee ( "fee", null, array (
			"salaryDate",
			"comInsDate" 
	) );
	$salaryDate = $monthArr ['0'] ['salaryDate'];
	$comInsDate = $monthArr ['0'] ['comInsDate'];
	$ofR = $s->BFee ( null, "fee", array (
			"pay",
			"pHF",
			"uHF",
			"uPDIns" 
	), array (
			"uID",
			"name" 
	) );
	#处理费用是由个人支付,还是由单位支付的问题
	$unitArr = unitAll ( $pdo, " `unitID`,`HFFrom`,`notFullHFFrom`,`HFMoneyRecive` ", " and unitID like '$unitID' ", "one" );
	if ($unitArr ['HFFrom'] == "1") {
		foreach ( $HFR as $key => $val ) {
			$HFR [$key] ['pTotal'] = 0;
			$HFR [$key] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
		}
	} elseif ($unitArr ['HFFrom'] == "2") {
		foreach ( $HFR as $key => $val ) {
			$HFR [$key] ['uTotal'] = 0;
			$HFR [$key] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
		}
	} else {	
		#处理从单位中扣公积金的非全日制员工
		foreach ( $HFR as $key => $val ) {
			if ($wRet [$key] ['type'] != "1") {
				if ($unitArr [$unitID] ['notFullHFFrom'] == "1") {
					//由单位支付  个人+单位的费用
					$HFR [$key] ['pTotal'] = 0;
					$HFR [$key] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
				} elseif ($unitArr [$unitID] ['notFullHFFrom'] == "2") {
					//由个人支付  个人+单位的费用
					$HFR [$key] ['uTotal'] = 0;
					$HFR [$key] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
				} else if ( $ofR [$key] ['pay'] == 0) {
					//如果是单位和个人均摊的方式, 如果没有发放工资则由单位承担
					$HFR [$key] ['pTotal'] = 0;
					$HFR [$key] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
				}
			}
		}
	}
	#获取本月的欠/挂费用
	$curRequireMoneySql = "select uID,pHFMoney,uHFMoney,type  from `a_prsRequireMoney_tmp`  where month like :month and unitID like :unitID ";
	$curRequireMoneyRes = $pdo->prepare ( $curRequireMoneySql );
	$curRequireMoneyRes->execute ( array (
			":month" => $month,
			":unitID" => $unitID 
	) );
	$curRequireMoneyRet = $curRequireMoneyRes->fetchAll ( PDO::FETCH_ASSOC );
	$curRMRet = $curWriteDownRet = $fTR = $prsReMoneyRet = null;
	foreach ( $curRequireMoneyRet as $curRequireMoneyVal ) {
		if ($curRequireMoneyVal ['type'] == "1" || $curRequireMoneyVal ['type'] == "2") {
			if ($curRequireMoneyVal ['uHFMoney'] != 0)
				$curRMRet [$curRequireMoneyVal ['uID']] ['uHFMoney'] = $curRequireMoneyVal ['uHFMoney'];
			if ($curRequireMoneyVal ['pHFMoney'] != 0)
				$curRMRet [$curRequireMoneyVal ['uID']] ['pHFMoney'] = $curRequireMoneyVal ['pHFMoney'];
		}
	}
	//由$ofR遍历,然后还需要获取不在$ofR中的其他有缴费的员工
	$extraHFR = array_diff_key ( $HFR, $ofR );
	foreach ( $extraHFR as $key => $val ) {
		$pMargin = - $HFR [$key] ['pTotal'];
		$uMargin = - $HFR [$key] ['uTotal'];
		//如果属于欠款均摊情况
		if ($unitArr ['HFMoneyRecive'] == "1" && $unitArr ['HFFrom'] != "0" && ($pMargin < 0 || $uMargin < 0)) {
			$margin [$key] ['pMargin'] = ($pMargin + $uMargin) / 2;
			$margin [$key] ['uMargin'] = ($pMargin + $uMargin) / 2;
		} else {
			$margin [$key] ['pMargin'] = $pMargin;
			$margin [$key] ['uMargin'] = $uMargin;
		}
	}
	foreach ( $ofR as $key => $val ) {
		$pMargin = $ofR [$key] ['pHF'] - $HFR [$key] ['pTotal'];
		$uMargin = $ofR [$key] ['uHF'] - $HFR [$key] ['uTotal'];
		if ($curRMRet [$key] ['uHFMoney'] == $uMargin)
			$uMargin = 0;
		if ($curRMRet [$key] ['pHFMoney'] == $pMargin)
			$pMargin = 0;
			//如果属于欠款均摊情况
		if ($unitArr ['HFMoneyRecive'] == "1" && $unitArr ['HFFrom'] != "0" && ($pMargin < 0 || $uMargin < 0)) {
			$margin [$key] ['pMargin'] = ($pMargin + $uMargin) / 2;
			$margin [$key] ['uMargin'] = ($pMargin + $uMargin) / 2;
		} else {
			$margin [$key] ['pMargin'] = $pMargin;
			$margin [$key] ['uMargin'] = $uMargin;
		}
	}
	unset ( $HFRet, $ofRet, $curRequireMoneyRet );
} else {
	$sql = "select b.uID,b.name,a.uHFMoney,a.pHFMoney from a_editAccountList a left join a_workerInfo b on a.roleA=b.uID where a.unitID like :unitID and a.HFDate like :HFDate";
	$ret = SQL ( $pdo, $sql, array (
			":HFDate" => $HFDate,
			":unitID" => $unitID 
	) );
	$engToChsArr = engTochs ();
	foreach ( $ret [0] as $key => $val ) {
		$newFieldArr [$key] = $engToChsArr [$key];
	}
	$smarty->assign ( "ret", $ret );
	$smarty->assign ( "newFieldArr", $newFieldArr );
}
//echo "<pre>";
//print_r($unitArr);
#变量配置
//$smarty->debugging = true;
$smarty->assign ( "unitArr", $unitArr );
$smarty->assign ( array (
		"HFR" => $HFR,
		"ofR" => $ofR,
		"curRMRet" => $curRMRet,
		"comRet" => $comRet,
		"wRet" => $wRet,
		"extraHFR" => $extraHFR,
		"uPDIns" => $uPDIns,
		"margin" => $margin 
) );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "housingFundManage/HFBalFee.tpl" );
?>