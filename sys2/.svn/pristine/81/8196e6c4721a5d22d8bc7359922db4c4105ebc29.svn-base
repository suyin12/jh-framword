<?php
/*
*       2011-3-15
*       <<<  创建离职工资  >>>
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
#页面标题
$title = "离职工资垫付申请";
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle ( "dateTime", "-" );
if (! $_GET ['month'] and ! $_GET ['extraBatch']) {
	if (! $_POST)
		exit ( "没有所需操作的数据" );
	
	foreach ( $_POST as $key => $val ) {
		if ($key == "dimissionID") {
			foreach ( $val as $v ) {
				$IDStr .= "'" . $v . "',";
			
			}
		} else {
			$$key = $val;
			$inStr .= "`" . $key . "`='" . $val . "',";
		}
	}
	$IDStr = rtrim ( $IDStr, "," );
	$sql = " select a.ID,a.lastUnitID,b.name,a.uID,a.entryDate as mountGuardDay,a.dimissionDate from a_dimission a left join a_workerInfo b on a.uID=b.uID where a.ID in ($IDStr)";
	$ret = SQL ( $pdo, $sql );
	
	foreach ( $ret as $key => $val ) {
		$unitIDArr [] = $val ['lastUnitID'];
	}
	
	$unitIDArr = array_unique ( $unitIDArr );
	if (count ( $unitIDArr ) > 1)
		exit ( "请选择同一单位人员" );
	else
		$unitID = $unitIDArr [0];
	
	#把欲处理为离职工资的员工,先删除未操作过的数据 ,并添加进入 a_dimissionSalary中,并设置status='0';
	$delSql [0] = "delete from a_dimissionSalary where `status`='0' and `unitID` like '$unitID'";
	$delSql [1] = "delete from a_otherFormulas where month like '$month' and extraBatch like '$extraBatch' and type='2' and `unitID` like '$unitID'";
	extraTransaction ( $pdo, $delSql );
	#首先验证本月内是否已经有多批次的离职人员	
	$exSql = "select max(extraBatch) as extraBatch from a_dimissionSalary where `month` like '$month' and `unitID` like '$unitID' limit 1";
	$exRet = SQL ( $pdo, $exSql, NULL, "one" );
	$extraBatch = $exRet ['extraBatch'];
	$newExtraBatch = $extraBatch + 1;
	#插入离职人员数据到 a_dimissionSalary
	foreach ( $ret as $key => $val ) {
		$inSql [] = "insert into a_dimissionSalary set `status`='0',`uID`='$val[uID]'," . $inStr . " `unitID`='$val[lastUnitID]',`extraBatch`='$newExtraBatch'";
	}
	$actionSql = $inSql;
	$result = extraTransaction ( $pdo, $actionSql );
	$errMsg = $result ['error'];
	if ($errMsg)
		exit ( $errMsg );
	else
		header ( "location:" . httpPath . "salaryManage/editDimissionSalary.php?month=$month&extraBatch=$newExtraBatch&unitID=$unitID&zID=$zID" );
} else {
	
	#
	foreach ( $_GET as $key => $val ) {
		$$key = $val;
	}
	#链接验证审批过程
	require_once sysPath . 'approval/approval.class.php';
	$appType = "dimissionSalary";
	$appTable = "a_dimissionSalary";
	$appConStr = "a.`month`=\'$month\' and a.`unitID`=\'$unitID\' and a.`extraBatch` =\'$extraBatch\'";
	$approval = new approval ();
	$approval->pdo = $pdo;
	$approval->month = $month;
	$approval->extraBatch = $extraBatch;
	$approval->unitID = $unitID;
	$approval->type = $appType;
	$approval->table = $appTable;
	$approval->conStr = $appConStr;
	$approval->url = "salaryManage/editDimissionSalary.php?" . $_SERVER ['QUERY_STRING'];
	$exAppArr = $approval->validEx ();
	#查询
	$feeSql = "select * from a_dimissionSalary where `month` like '$month' and `unitID` like '$unitID' and `extraBatch` like '$extraBatch'";
	$feeRet = SQL ( $pdo, $feeSql );
	
	$zID = $feeRet ['0'] ['zID'];
	foreach ( $feeRet as $key => $val ) {
		$uIDStr .= "'" . $val ['uID'] . "',";
		$soInsDate = $val ['soInsDate'];
		$comInsDate = $val ['comInsDate'];
	}
	$uIDStr = rtrim ( $uIDStr, "," );
}
#获取中英文对照数组
$engToChsArr = engTochs ();
#获取该帐套对应的列,包括列的中文名
$zFsql = "select a.field,a.zIndex,b.* from a_zFormatInfo a left join a_zFormulas  b on a.zID=b.zID where  a.`zID`='$zID' order by a.zID desc limit 1";
$zfRet = SQL ( $pdo, $zFsql, NULL, 'one' );

$fieldArr = makeArray ( $zfRet ['field'] );
$zIndex = makeArray ( $zfRet ['zIndex'] );
$zIndex = array_flip ( $zIndex );
foreach ( $fieldArr as $key => $val ) {
	if (array_key_exists ( $key, $zIndex )) {
		$key = $zIndex [$key];
		$val = $engToChsArr [$key];
	}
	$newFieldArr [$key] = $val;
	$formulasChart [$key] = $val . "(" . $key . ")";
}
//这里增加几个字段,可以自定义控制查询所需的字段名
$newFieldArr ['salaryDate'] = $engToChsArr ['salaryDate'];
$newField = implode ( ",", array_keys ( $newFieldArr ) );
#设置公式所需要的代号
$formulasChart = array_merge ( array ("+" => "+ (加)", "-" => "- (减)", "/" => "/ (除)", "*" => "* (乘)", "(" => "( (左括号)", ")" => ")(右括号)" ), $formulasChart );
$i = 0;
$formulasChartStr .= "<tr>";
foreach ( $formulasChart as $chartKey => $chart ) {
	
	if ($i % 9 == 0 && $i != 0)
		$formulasChartStr .= "</tr><tr>";
	$i ++;
	$formulasChartStr .= "<td>";
	$formulasChartStr .= "<a href='#' id='$chartKey' class='chart'>$chart</a>";
	$formulasChartStr .= "</td>";
}
$formulasChartStr .= "</tr>";
#获取工资表明细数组(注:该数组是有对应显示顺序的...所以这里也要注意一下先后顺序)
//获取各种公式..
$formulasStr = array ("pay" => $zfRet ['payFormulas'], "ratal" => $zfRet ['ratalFormulas'], "acheive" => $zfRet ['acheiveFormulas'], "uAccount" => $zfRet ['uAccountFormulas'], "uFeeSp" => "$zfRet ['uFeeSpFormulas']", "totalFee" => $zfRet ['totalFeeFormulas'], "pSoIns" => "(pPension+pHospitalization)", "pComIns" => "pComIns", "utilities" => "utilities" );
#这里重新修改过,设置公式,可以每月的公式都不一样,
$formulasSql = " select * from `a_otherFormulas` where `type`='2' and `extraBatch`='$extraBatch' and `month`='$month' and `unitID`='$unitID' and `zID`='$zID'";
$formulasRet = SQL ( $pdo, $formulasSql, null, 'one' );

if ($formulasRet ['ID']) {
	$formulasStr = array ("pay" => $formulasRet ['payFormulas'], "ratal" => $formulasRet ['ratalFormulas'], "acheive" => $formulasRet ['acheiveFormulas'], "uAccount" => $formulasRet ['uAccountFormulas'], "uFeeSp" => "$formulasRet ['uFeeSpFormulas']", "totalFee" => $formulasRet ['totalFeeFormulas'] );
	$smarty->assign ( "formulasID", $formulasRet ['ID'] );
}

//求得应发工资相关的所有列
if ($formulasStr ['pay']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['pay'], $payStr );
	$payFormulas = strToPHP ( $formulasStr ['pay'] );
}
if ($formulasStr ['uAccount']) {
	$uAccountFormulas = strToPHP ( $formulasStr ['uAccount'] );
}
if ($formulasStr ['totalFee']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['totalFee'], $uOtherCostsStr );
	$totalFeeFormulas = strToPHP ( $formulasStr ['totalFee'] );
}
if ($formulasStr ['ratal']) {
	$ratalFormulas = strToPHP ( $formulasStr ['ratal'] );
}
if ($formulasStr ['acheive']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['acheive'], $pOtherCostsStr );
	$acheiveFormulas = strToPHP ( $formulasStr ['acheive'] );
}
#查询人员信息
$wSql = "select * from a_workerInfo where uID in ($uIDStr)";
$wR = SQL ( $pdo, $wSql );
$wR = keyArray ( $wR, "uID" );
#查询商保信息
$exComSql = "select a.uID,b.uComInsMoney,b.pComInsMoney from a_comInsList a left join a_unitInfo b on a.unitID=b.unitID where uID in ($uIDStr)";
$exComRet = SQL ( $pdo, $exComSql );
$comInsFeeArr = keyArray ( $exComRet, "uID" );
#验证是否已经存在本月的缴交明细,如果已经存在则直接以缴交明细为主
$exSoSql = "select a.uID,a.pTotal,a.uTotal from a_soInsFee_tmp a   where a.soInsDate like '$soInsDate'  and a.unitID like '$unitID' and a.`uID` in ($uIDStr) ";
$exSoRet = SQL ( $pdo, $exSoSql );
$soInsFeeArr = keyArray ( $exSoRet, "uID" );
#查看该员工是否还有未收回的个人欠款费用,如果有就做收回欠款处理
$requireMoneySql = "select a.uID as uID,sum(a.pSoInsMoney) as pSoInsMoney,sum(a.pComInsMoney) as pComInsMoney,sum(a.pOtherMoney) as pOtherMoney,sum(soInsCardMoney) as soInsCardMoney,sum(residentCardMoney) as residentCardMoney ,a.type as type from `a_prsRequireMoney` a  where a.month < :month and a.status='0' and a.type in ('2','3') and a.uID in ($uIDStr) and a.unitID like :unitID  group by a.uID";
$requireMoneyRet = SQL ( $pdo, $requireMoneySql, array (":unitID" => $unitID, ":month" => $month ) );
$rMRet = null;
foreach ( $requireMoneyRet as $requireMoneyVal ) {
	$rMRet [$requireMoneyVal ['uID']] ['pSoInsMoney'] += $requireMoneyVal ['pSoInsMoney'];
	$rMRet [$requireMoneyVal ['uID']] ['pComInsMoney'] += $requireMoneyVal ['pComInsMoney'];
	$rMRet [$requireMoneyVal ['uID']] ['soInsCardMoney'] += $requireMoneyVal ['soInsCardMoney'];
	$rMRet [$requireMoneyVal ['uID']] ['residentCardMoney'] += $requireMoneyVal ['residentCardMoney'];
	$rMRet [$requireMoneyVal ['uID']] ['pOtherMoney'] += $requireMoneyVal ['pOtherMoney'];
}
#获取本月的欠/挂费用
$curRequireMoneySql = "select a.* from `a_prsRequireMoney` a where a.month like :month and a.unitID like :unitID ";
$curRequireMoneyRet = SQL ( $pdo, $curRequireMoneySql, array (":month" => $month, ":unitID" => $unitID ) );
$curRMRet = $prsReMoneyRet = null;
foreach ( $curRequireMoneyRet as $curRequireMoneyVal ) {
	if ($curRequireMoneyVal ['type'] == "3") { //本月的收回欠款
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['pSoInsMoney'] = $curRequireMoneyVal ['pSoInsMoney'] > 0 ? $curRequireMoneyVal ['pSoInsMoney'] : null;
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['pComInsMoney'] = $curRequireMoneyVal ['pComInsMoney'] > 0 ? $curRequireMoneyVal ['pComInsMoney'] : null;
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['pOtherMoney'] = $curRequireMoneyVal ['pOtherMoney'] > 0 ? $curRequireMoneyVal ['pOtherMoney'] : null;
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['soInsCardMoney'] = $curRequireMoneyVal ['soInsCardMoney'] > 0 ? $curRequireMoneyVal ['soInsCardMoney'] : null;
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['residentCardMoney'] = $curRequireMoneyVal ['residentCardMoney'] > 0 ? $curRequireMoneyVal ['residentCardMoney'] : null;
	}
}
unset ( $curRequireMoneyRet );
unset ( $requireMoneyRet );
#输出要操作的离职人员名单
foreach ( $feeRet as $fKey => $fVal ) {
	$a = $b = $c = $d = 0;
	//离职人员的提示
	$feeArr [$fVal ['uID']] = array ("ID" => $fVal ['ID'], "name" => $wR [$fVal ['uID']] ['name'], 'uID' => $fVal ['uID'] );
	$salaryArr [$fVal ['uID']] = $feeArr [$fVal ['uID']];
	$salaryArr [$fVal ['uID']] ['bID'] = $wR [$fVal ['uID']] ['bID'];
	if ($payStr [0] and $_GET ['hideHeader'] != "true")
		foreach ( $payStr [0] as $payVal ) {
			$feeArr [$fVal ['uID']] [$payVal] = $fVal [$payVal];
		
	//			$salaryArrArr [$fVal ['uID']] [$payVal] = $fVal [$payVal];
		}
	
	//应发,应缴纳税额,个税
	@eval ( '$payMoney=' . $payFormulas . ";" );
	@eval ( '$uAccount=' . $uAccountFormulas . ";" );
	@eval ( '$uOtherCosts=' . $totalFeeFormulas . ";" );
	@eval ( '$ratalMoney=' . $ratalFormulas . ";" );
	@eval ( '$pOtherCosts=' . $acheiveFormulas . ";" );
	$feeArr [$fVal ['uID']] ['pay'] = $payMoney;
	$salaryArr [$fVal ['uID']] ['pay'] = $payMoney;
	$ratal = round ( ($payMoney - $soInsFeeArr [$fVal ['uID']] ['pTotal'] + $ratalMoney), 2 );
	if ($ratal < 0)
		$salaryArr [$fVal ['uID']] ['ratal'] = 0;
	else
		$salaryArr [$fVal ['uID']] ['ratal'] = round ( $ratal, 2 );
	$salaryArr [$fVal ['uID']] ['pTax'] = round ( taxCount ( $salaryArr [$fVal ['uID']] ['ratal'] ), 2 );
	if ($payMoney == 0) {
		#残障金
		$feeArr [$fVal ['uID']] ['uPDIns'] = 0;
		#社保
		$feeArr [$fVal ['uID']] ['uSoIns'] = $soInsFeeArr [$fVal ['uID']] ['uTotal'];
		$salaryArr [$fVal ['uID']] ['pSoIns'] = $fVal ['pSoIns'];
		#商保
		$feeArr [$fVal ['uID']] ['uComIns'] = $comInsFeeArr [$fVal ['uID']] ['uComInsMoney'];
		$salaryArr [$fVal ['uID']] ['pComIns'] = $fVal ['pComIns'];
		#管理费
		$feeArr [$fVal ['uID']] ['managementCost'] = $wR [$fVal ['uID']] ['managementCost'];
		$updateSql [] = "update `a_dimissionSalary` set `uSoIns`='" . $feeArr [$fVal ['uID']] ['uSoIns'] . "',`pSoIns`='" . $soInsFeeArr [$fVal ['uID']] ['pTotal'] . "',`uComIns`='" . $feeArr [$fVal ['uID']] ['uComIns'] . "',`pComIns`='" . $comInsFeeArr [$fVal ['uID']] ['pComInsMoney'] . "',`managementCost`='" . $feeArr [$fVal ['uID']] ['managementCost'] . "' where `ID`='" . $fVal ['ID'] . "'";
	} else {
		#残障金
		$feeArr [$fVal ['uID']] ['uPDIns'] = $fVal ['uPDIns'];
		#社保
		$feeArr [$fVal ['uID']] ['uSoIns'] = $fVal ['uSoIns'];
		$salaryArr [$fVal ['uID']] ['pSoIns'] = $fVal ['pSoIns'];
		#商保
		$feeArr [$fVal ['uID']] ['uComIns'] = $fVal ['uComIns'];
		$salaryArr [$fVal ['uID']] ['pComIns'] = $fVal ['pComIns'];
		#管理费
		$feeArr [$fVal ['uID']] ['managementCost'] = $fVal ['managementCost'];
	}
	$salaryArr [$fVal ['uID']] ['pSoInsMoney'] = $prsReMoneyRet [$fVal ['uID']] ['pSoInsMoney'] ? $prsReMoneyRet [$fVal ['uID']] ['pSoInsMoney'] : - $rMRet [$fVal ['uID']] ['pSoInsMoney'];
	$salaryArr [$fVal ['uID']] ['pComInsMoney'] = $prsReMoneyRet [$fVal ['uID']] ['pComInsMoney'] ? $prsReMoneyRet [$fVal ['uID']] ['pComInsMoney'] : - $rMRet [$fVal ['uID']] ['pComInsMoney'];
	$salaryArr [$fVal ['uID']] ['pOtherMoney'] = $prsReMoneyRet [$fVal ['uID']] ['pOtherMoney'] ? $prsReMoneyRet [$fVal ['uID']] ['pOtherMoney'] : - $rMRet [$fVal ['uID']] ['pOtherMoney'];
	$salaryArr [$fVal ['uID']] ['soInsCardMoney'] = $prsReMoneyRet [$fVal ['uID']] ['soInsCardMoney'] ? $prsReMoneyRet [$fVal ['uID']] ['soInsCardMoney'] : - $rMRet [$fVal ['uID']] ['soInsCardMoney'];
	$salaryArr [$fVal ['uID']] ['residentCardMoney'] = $prsReMoneyRet [$fVal ['uID']] ['residentCardMoney'] ? $prsReMoneyRet [$fVal ['uID']] ['residentCardMoney'] : - $rMRet [$fVal ['uID']] ['residentCardMoney'];
	$salaryArr [$fVal ['uID']] ['utilities'] = $fVal ['utilities'];
	$salaryArr [$fVal ['uID']] ['helpCost'] = $fVal ['helpCost'];
	
	//其他单位费用
	if ($uOtherCostsStr [0])
		foreach ( $uOtherCostsStr [0] as $oVal ) {
			$feeArr [$fVal ['uID']] [$oVal] = $fVal [$oVal];
		}
	
	//其他个人费用
	if ($pOtherCostsStr [0])
		foreach ( $pOtherCostsStr [0] as $oVal ) {
			$salaryArr [$fVal ['uID']] [$oVal] = $fVal [$oVal];
		}
	
	//总费用=应发工资+实收单位残障金+本月残障金冲减+实收单位社保+本月社保冲减+实收单位商保+本月商保冲减+实收管理费+本月管理费冲减+单位挂账
	$totalFee = $feeArr [$fVal ['uID']] ['pay'] + $feeArr [$fVal ['uID']] ['uPDIns'] + $feeArr [$fVal ['uID']] ['uSoIns'] + $feeArr [$fVal ['uID']] ['uComIns'] + $feeArr [$fVal ['uID']] ['managementCost'];
	$feeArr [$fVal ['uID']] ['totalFee'] = $totalFee + $uOtherCosts;
	$salaryArr [$fVal ['uID']] ['acheive'] = $salaryArr [$fVal ['uID']] ['pay'] - $salaryArr [$fVal ['uID']] ['pTax'] - $salaryArr [$fVal ['uID']] ['pSoIns'] - $salaryArr [$fVal ['uID']] ['pComIns'] - $salaryArr [$fVal ['uID']] ['pSoInsMoney'] - $salaryArr [$fVal ['uID']] ['pComInsMoney'] - $salaryArr [$fVal ['uID']] ['pOtherMoney'] - $salaryArr [$fVal ['uID']] ['soInsCardMoney'] - $salaryArr [$fVal ['uID']] ['residentCardMoney'] - $salaryArr [$fVal ['uID']] ['utilities'] - $salaryArr [$fVal ['uID']] ['helpCost'] + $pOtherCosts;
    $feeArr [$fVal ['uID']] ['confirmStatus']=$salaryArr [$fVal ['uID']] ['confirmStatus'] = $fVal['confirmStatus']; 
}
#如果还未填入应发工资...则先更新数据库记录
if ($updateSql)
	extraTransaction ( $pdo, $updateSql );

	#遍历生成更新语句
$prsReStr = null;
foreach ( $salaryArr as $feeKey => $feeVal ) {
	$str = null;
	foreach ( $feeVal as $feeK => $feeV ) {
		switch ($feeK) {
			case "name" :
			case "bID":
				$str .= "`$feeK`='$feeV',";
				break;	
			case "uID" :
				$feeTotalArr [$feeK] = null;
				$salaryTotalArr [$feeK] = null;
				break;
			case "pay" :
			case "ratal" :
			case "acheive" :
				$str .= "`$feeK`='$feeV',";
				$feeTotalArr [$feeK] += $feeV;
				break;
			// 收回欠款,但是它对应的type=3
			case "pSoInsMoney" :
			case "pComInsMoney" :
			case "pOtherMoney" :
			case "soInsCardMoney" :
			case "residentCardMoney" :
				if ($feeV != 0) {
					$prsTrStr [$feeKey] .= "`" . $feeK . "`='" . $feeV . "',";
				}
				$feeTotalArr [$feeK] += $feeV;
				break;
			default :
				if ($otherCostsStr [0] && in_array ( $feeK, $otherCostsStr [0] ))
					$str .= "`$feeK`='$feeV',";
				$feeTotalArr [$feeK] += $feeV;
				break;
		}
	}
	$upOFSql [] = "update `a_dimissionSalary` set " . $str . "`totalFee`='" . $feeArr [$feeKey] ['totalFee'] . "', `confirmStatus`='0', `status`='1',`sponsorName`='$mName',`sponsorTime`='$now' where `ID` like '$feeVal[ID]' ";
}
#保存并提交审批	
if (isset ( $_POST ['save'] )) {
	
	//			print_r($prsReStr);
	if ($prsReStr) {
		$curAccRMRet = null;
		if ($curRMRet)
			foreach ( $curRMRet as $key => $val ) {
				if ($val > 0) {
					$curAccRMRet [$key] = $val;
				}
			}
		foreach ( $prsReStr as $prK => $prV ) {
			if ($prV) {
				if ($curAccRMRet) {
					if (array_key_exists ( $prK, $curAccRMRet )) {
						$upPrsReSql [] = "update a_prsRequireMoney set $prV `status`='1',`sponsorName`='$mName',sponsorTime='$now' where uID like '$prK' and unitID like '$unitID' and type like '1' and month like '$month'";
					} else {
						$inPrsReSql [] = "insert into a_prsRequireMoney set $prV `uID`='$prK',`unitID`='$unitID',`type`='1',`month`='$month',`feeType`='2',`extraBatch`='$extraBatch', `status`='1',`sponsorName`='$mName',sponsorTime='$now'";
					}
				} else {
					$inPrsReSql [] = "insert into a_prsRequireMoney set $prV `uID`='$prK',`unitID`='$unitID',`type`='1',`month`='$month', `feeType`='2',`extraBatch`='$extraBatch',`status`='1',`sponsorName`='$mName',sponsorTime='$now'";
				}
			}
		}
	} else {
		//如果没有单位挂账的话,就设置已经有单位挂账的等于0
		$upPrsAccSql = "update a_prsRequireMoney set `uAccount`='0' where `uAccount`<>'0' and `month`='$month' and `unitID`='$unitID' and type ='1' ";
	}
	if ($prsTrStr) {
		foreach ( $prsTrStr as $prK => $prV ) {
			if ($prV) {
				if ($prsReMoneyRet) {
					if (array_key_exists ( $prK, $prsReMoneyRet )) {
						$upPrsReSql [] = "update `a_prsRequireMoney` set $prV `status`='0',`sponsorName`='$mName',sponsorTime='$now' where `uID` like '$prK' and unitID like '$unitID' and `type` like '3' and `month` like '$month'";
					} else {
						$inPrsReSql [] = "insert into `a_prsRequireMoney` set $prV `uID`='$prK',`unitID`='$unitID',`type`='3',`feeType`='2',`extraBatch`='$extraBatch',`month`='$month', `status`='0',`sponsorName`='$mName',`sponsorTime`='$now'";
					}
				} else {
					$inPrsReSql [] = "insert into `a_prsRequireMoney` set $prV `uID`='$prK',`unitID`='$unitID',`type`='3',`feeType`='2',`extraBatch`='$extraBatch',`month`='$month', `status`='0',`sponsorName`='$mName',`sponsorTime`='$now'";
				}
			}
		}
	}
	$actionSql = null;
	$delSql = "delete from `a_prsRequireMoney` where `uPDInsMoney`='0' and `uSoInsMoney`='0' and `pSoInsMoney`='0' and `uComInsMoney`='0' and `pComInsMoney`='0' and `managementCostMoney`='0' and `soInsCardMoney`='0' and `residentCardMoney`='0' and `uAccount`='0' and `pOtherMoney` = '0' and `uOtherMoney`='0' ";
	$actionSql = mergeArray ( $upPrsReSql, $inPrsReSql, $upOFSql );
	$result = transaction ( $pdo, $actionSql );
	if ($result ['error']) {
		exit ( $result ['error'] . "<br/>系统发生错误,请及时联系管理员查证" );
	} else {
		$actionSql2 = array ($upPrsAccSql, $delSql );
		extraTransaction ( $pdo, $actionSql2 );
		$showWindow = "<script>alert('保存成功')</script>";
	}
}

if (isset ( $_POST ['subApproval'] )) {
	$mID = manager ( $pdo, $unitID, "2_1" );
	$appIDSql = "select * from s_approvalPro_set where type='dimissionSalary' and process like '\"mID\"=>\"$mID\"%'";
	$appIDRes = $pdo->query ( $appIDSql );
	$appIDRet = $appIDRes->fetch ( PDO::FETCH_ASSOC );
	$appID = $appIDRet ['appID'];
	//这里引用类 approval
	if ($appID) {
		$msg = $approval->approvalSet ( $appID );
		$msgr = fetchArray ( $msg );
		$showWindow = "<script>alert('$msgr');</script>";
	} else
		exit ( "对应该客户经理的审批流程还未建立,请先设置" );
}

#加载变量
$smarty->assign ( "newFieldArr", $newFieldArr );
$smarty->assign ( "formulasChartStr", $formulasChartStr );
$smarty->assign ( "formulasStr", $formulasStr );
$smarty->assign ( array ("payStr" => $payStr, "pOtherCostsStr" => $pOtherCostsStr, "uOtherCostsStr" => $uOtherCostsStr ) );
$smarty->assign ( array ("extraBatch" => $extraBatch, "unitID" => $unitID ) );
$smarty->assign ( array ("feeArr" => $feeArr, "salaryArr" => $salaryArr ) );
$smarty->assign ( "showWindow", $showWindow );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "salaryManage/editDimissionSalary.tpl" );
?>