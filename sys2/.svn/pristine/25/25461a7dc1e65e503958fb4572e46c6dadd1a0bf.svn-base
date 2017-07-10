<?php

/*
 *     2011-6-9
 *          <<<商保平帐表,主要完成商保的平账>>>
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
#连接费用核算类
require_once sysPath . 'dataFunction/fee.data.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
#页面标题
$title = "商保平账";
$unitID = $_GET ['unitID'];
$comInsDate = $_GET ['comInsDate'];
$month = $_GET ['month'];
if (! $unitID || ! $comInsDate)
	exit ( "非法网址" );
if ($_GET ['query'] != "detail") {
	#获取员工相关信息, 
	$wSql = "select uID,name,type from a_workerInfo where unitID like '$unitID'";
	$wRet = SQL ( $pdo, $wSql );
	$wRet = keyArray ( $wRet, "uID" );
	#获取缴交明细的费用
	$feeData = new feeData ();
	$feeData->pdo = $pdo;
	$feeData->unitID = $unitID;
	$feeData->month = $month;
	$feeData->comInsDate = $comInsDate;
	$unitArr = $feeData->unitArr ();
	$changeRadix = $feeData->changeRadix ();
	$feeData->wArr = $wRet;
	$comInsR = $feeData->exComRet ();
	#获取费用表中的商保费用
	$s = new salaryFee ();
	$s->pdo = $pdo;
	$s->month = $comInsDate;
	$s->monthType = "comInsDate";
	$s->unitID = $unitID;
	$monthArr = $s->AFee ( "fee", null, array (
			"comInsDate" 
	) );
	$comInsDate = $monthArr ['0'] ['comInsDate'];
	$ofR = $s->BFee ( null, "fee", array (
			"pay",
			"pComIns",
			"uComIns" 
	), array (
			"uID",
			"name" 
	) );
	#获取本月的欠/挂费用
	$moneyData = new money ();
	$moneyData->pdo = $pdo;
	$moneyData->unitID = $unitID;
	$moneyData->month = $month;
	$curMonthMoney = $moneyData->curMonth ();
	$curRMRet = $curMonthMoney ['curRM'];
	//由$ofR遍历,然后还需要获取不在$ofR中的其他有缴费的员工
	$extraComR = array_diff_key ( $comInsR, $ofR );
	foreach ( $extraComR as $key => $val ) {
		$pMargin = - $comInsR [$key] ['pComInsMoney'];
		$uMargin = - $comInsR [$key] ['uComInsMoney'];
		$margin [$key] ['pMargin'] = $pMargin;
		$margin [$key] ['uMargin'] = $uMargin;
	}
	foreach ( $ofR as $key => $val ) {
		$pMargin = $ofR [$key] ['pComIns'] - $comInsR [$key] ['pComInsMoney'];
		$uMargin = $ofR [$key] ['uComIns'] - $comInsR [$key] ['uComInsMoney'];
		if ($curRMRet [$key] ['uComInsMoney'] == $uMargin)
			$uMargin = 0;
		if ($curRMRet [$key] ['pComInsMoney'] == $pMargin)
			$pMargin = 0;
		$margin [$key] ['pMargin'] = $pMargin;
		$margin [$key] ['uMargin'] = $uMargin;
	}
	unset ( $ofRet );
} else {
	$sql = "select b.uID,b.name,a.uComInsMoney,a.pComInsMoney from a_editAccountList a left join a_workerInfo b on a.roleA=b.uID where a.unitID like :unitID and a.comInsDate like :comInsDate";
	$ret = SQL ( $pdo, $sql, array (
			":comInsDate" => $comInsDate,
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
		"comInsR" => $comInsR,
		"ofR" => $ofR,
		"curRMRet" => $curRMRet,
		"wRet" => $wRet,
		"extraComR" => $extraComR,
		"margin" => $margin 
) );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "comInsManage/comInsBalFeeDetail.tpl" );
?>