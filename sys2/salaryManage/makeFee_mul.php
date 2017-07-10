<?php

/*
 *     2011-12-12
 *          <<<  制作二次或多次工资表,费用表>>>
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
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#连接费用核算类
require_once sysPath . 'dataFunction/fee.data.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
ini_set ( "memory_limit", "500M" );
#页面标题
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
$extraBatch = $_GET ['extraBatch'];
$title = "制作第" . ($extraBatch + 1) . "次费用表";
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle ( "dateTime", "-" );
#设置显示的默认属性
$_GET ['displaySp'] = is_null ( $_GET ['displaySp'] ) ? true : $_GET ['displaySp'];
$_GET ['fixTable'] = is_null ( $_GET ['fixTable'] ) ? true : $_GET ['fixTable'];
#链接验证审批过程
require_once sysPath . 'approval/approval.class.php';
$appType = "fee";
$appTable = "a_mul_originalFee";
$appConStr = "a.`month`=\'$month\' and a.`unitID`=\'$unitID\' and a.`extraBatch`=\'$extraBatch\'";
$approval = new approval ();
$approval->pdo = $pdo;
$approval->month = $month;
$approval->unitID = $unitID;
$approval->extraBatch = $extraBatch;
$approval->type = $appType;
$approval->table = $appTable;
$approval->conStr = $appConStr;
$approval->url = "salaryManage/makeFee_mul.php?" . $_SERVER ['QUERY_STRING'];
$exAppArr = $approval->validEx ();
#验证该单位数据是否已经存在
$existsSql = "select month,zID from a_mul_originalFee_tmp where `month` like :month and unitID like :unitID and uID like '' and extraBatch=:extraBatch";
$existsRes = $pdo->prepare ( $existsSql );
$existsRes->execute ( array (
		":unitID" => $unitID,
		":month" => $month,
		":extraBatch" => $extraBatch 
) );
$existsRet = $existsRes->fetch ( PDO::FETCH_ASSOC );
$validFee = $existsRes->rowCount ();
if ($validFee > 0) {
	$originalFeeValidUrl = httpPath . "salaryManage/validOriginalFee.php?month=$month&unitID=$unitID&extraBatch=$extraBatch&zID=" . $existsRet ['zID'] . '&whatDate=mulFee';
}
if ($validFee == 0) {
	#获取费用表中的相关信息	
	$feeSql = "select * from a_mul_originalFee_tmp where month like :month and unitID like :unitID and extraBatch=:extraBatch ";
	if ($_POST ['search'])
		$feeSql .= " and name like '" . trim ( $_POST ['name'] ) . "%'";
	$feeRes = $pdo->prepare ( $feeSql );
	$feeRes->execute ( array (
			":unitID" => $unitID,
			":month" => $month,
			":extraBatch" => $extraBatch 
	) );
	$feeRet = $feeRes->fetchAll ( PDO::FETCH_ASSOC );
	if (! $feeRet) {
		echo "<script>alert('查无此人');location.reload();</script>";
		die ();
	}
	$salaryDate = $feeRet ['0'] ['salaryDate'];
	$comInsDate = $feeRet ['0'] ['comInsDate'];
	$soInsDate = $feeRet ['0'] ['soInsDate'];
	$HFDate = $feeRet ['0'] ['HFDate'];
	$managementCostDate = $feeRet ['0'] ['managementCostDate'];
	$zID = $feeRet ['0'] ['zID'];
	foreach ( $_GET as $getKey => $getVal ) {
		switch ($getKey) {
			case "zID" :
			case "unitID" :
			case "extraBatch" :
				if (is_numeric ( $getVal ))
					$getQuery [$getKey] = $getVal;
				else
					exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
				break;
			case "month" :
			case "salaryDate" :
			case "soInsDate" :
			case "HFDate" :
			case "comInsDate" :
			case "managementCostDate" :
				if (isMonth ( $getVal ))
					$getQuery [$getKey] = $getVal;
				else
					exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
				break;
		}
	}
	#获取员工信息,求出社保费用,商保费用,互助会费用
	$wSql = "select a.* from a_workerInfo a left join a_mul_originalFee_tmp b on a.uID=b.uID where b.month like :month and b.unitID like :unitID and b.extraBatch=:extraBatch";
	$wRes = array (
			":unitID" => $unitID,
			":month" => $month,
			":extraBatch" => $extraBatch 
	);
	$wRet = SQL ( $pdo, $wSql, $wRes );
	$wR = keyArray ( $wRet, "uID" );
	#累计欠款明细,及本月的欠挂明细
	$moneyData = new money ();
	$moneyData->pdo = $pdo;
	$moneyData->unitID = $unitID;
	$moneyData->month = $month;
	$moneyData->thisMonth = true;
	$moneyData->extraBatch = $extraBatch;
	$curMonthMoney = $moneyData->curMonth ();
	$rMRet = $moneyData->sumMoney ();
	#本月各费用
	$feeData = new feeData ();
	$feeData->pdo = $pdo;
	$feeData->unitID = $unitID;
	$feeData->month = $month;
	$feeData->soInsDate = $soInsDate;
	$feeData->HFDate = $HFDate;
	$feeData->comInsDate = $comInsDate;
	$feeData->mCostDate = $managementCostDate;
	$unitArr = $feeData->unitArr ();
	$changeRadix = $feeData->changeRadix ();
	$feeData->wArr = $wR;
	$extraFeeArr = $feeData->extraFeeArr ();
	$soInsFeeArr = $extraFeeArr ['soInsFeeArr'];
	$HFFeeArr = $extraFeeArr ['HFFeeArr'];
	$comInsFeeArr = $extraFeeArr ['comInsFeeArr'];
	$mCostFeeArr = $extraFeeArr ['mCostFeeArr'];
	$comInsRet = $comInsFeeArr;
	
	#获取本月的欠/挂费用
	$curRMRet = $curMonthMoney ['curRM'];
	$prsReMoneyRet = $curMonthMoney ['prsReMoney'];
	//获取中英文对照数组
	$engToChsArr = engTochs ();
	#获取该帐套对应的列,包括列的中文名
	$zfSql = "select zIndex,field,payFormulas,ratalFormulas,acheiveFormulas,uAccountFormulas from a_zformatInfo where zID like :zID";
	$zfRes = $pdo->prepare ( $zfSql );
	$zfRes->execute ( array (
			":zID" => $zID 
	) );
	$zfRet = $zfRes->fetch ( PDO::FETCH_ASSOC );
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
	//查找所需的字段,生成预览 ,限制3条
	$sql = "select $newField  from `a_mul_originalFee_tmp` where unitID like  :unitID and month like :month and extraBatch=:extraBatch limit 0,3";
	$res = $pdo->prepare ( $sql );
	$res->execute ( array (
			":unitID" => $unitID,
			":month" => $month,
			":extraBatch" => $extraBatch 
	) );
	$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
	#设置公式所需要的代号
	$formulasChart = array_merge ( array (
			"+" => "+ (加)",
			"-" => "- (减)",
			"/" => "/ (除)",
			"*" => "* (乘)",
			"(" => "( (左括号)",
			")" => ")(右括号)" 
	), $formulasChart );
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
	
	#获取临时更改费用明细
	$feeTmpSql = "select * from `a_fee_tmp` where month like :month and unitID like :unitID and extraBatch=:extraBatch";
	$feeTmpRes = $pdo->prepare ( $feeTmpSql );
	$feeTmpRes->execute ( array (
			":month" => $month,
			":unitID" => $unitID,
			":extraBatch" => $extraBatch 
	) );
	if ($feeTmpRes) {
		$fTR = NULL;
		$feeTmpRet = $feeTmpRes->fetchAll ( PDO::FETCH_ASSOC );
		foreach ( $feeTmpRet as $ftv ) {
			$fTR [$ftv ['uID']] ['uPDInsS'] = $ftv ['uPDInsS'];
			$fTR [$ftv ['uID']] ['uSoInsS'] = $ftv ['uSoInsS'];
			$fTR [$ftv ['uID']] ['uHFS'] = $ftv ['uHFS'];
			$fTR [$ftv ['uID']] ['uComInsS'] = $ftv ['uComInsS'];
			$fTR [$ftv ['uID']] ['managementCostS'] = $ftv ['managementCostS'];
		}
	}
	#获取工资表明细数组(注:该数组是有对应显示顺序的...所以这里也要注意一下先后顺序)
	//获取各种公式..
	$formulasStr = array (
			"pay" => $zfRet ['payFormulas'],
			"uAccount" => $zfRet ['uAccountFormulas'],
			"totalFee" => $zfRet ['totalFeeFormulas'] 
	);
	#这里重新修改过,设置公式,可以每月的公式都不一样,
	$formulasSql = " select * from `a_otherFormulas` where `month`='$month' and `unitID`='$unitID' and `zID`='$zID' and `extraBatch`='$extraBatch' and `type`='4'";
	$formulasRet = SQL ( $pdo, $formulasSql, null, 'one' );
	if ($formulasRet ['ID']) {
		$formulasStr = array (
				"pay" => $formulasRet ['payFormulas'],
				"uAccount" => $formulasRet ['uAccountFormulas'],
				"totalFee" => $formulasRet ['totalFeeFormulas'] 
		);
		$smarty->assign ( "formulasID", $formulasRet ['ID'] );
	}
	// echo "<pre>";
	// print_r($formulasStr);
	//求得应发工资相关的所有列
	if ($formulasStr ['pay']) {
		preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['pay'], $payStr );
		$payFormulas = strToPHP ( $formulasStr ['pay'] );
	}
	if ($formulasStr ['uAccount']) {
		$uAccountFormulas = strToPHP ( $formulasStr ['uAccount'] );
	}
	if ($formulasStr ['totalFee']) {
		preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['totalFee'], $otherCostsStr );
		$totalFeeFormulas = strToPHP ( $formulasStr ['totalFee'] );
	}
	//如果已经存在合并扣税的项目
	$vSql = "select uID,ratal,ratalYet from a_mul_originalFee where month like :month and unitID like :unitID and extraBatch=:extraBatch and ratalYet>0 limit 1";
	$vRet = SQL ( $pdo, $vSql, array (
			":month" => $month,
			":unitID" => $unitID,
			":extraBatch" => $extraBatch 
	), 'one' );
	$feeData->extraBatch = $extraBatch;
	$feeData->wArr = $feeRet;
	$alreadyFeeRet = $feeData->alreadyFee ( "mulFee" );
	
	// 		   echo "<pre>".count($alreadyFeeRet);
	// 		   print_r($alreadyFeeRet);
	$iFieldArr = array (
			"uHF",
			"uSoIns",
			"uComIns",
			"managementCost",
			"uPDIns" 
	);
	// echo "<pre>";
	// print_r($feeRet);
	foreach ( $feeRet as $fKey => $fVal ) {
		$a = $b = $c = $d = $e = $uAccount = 0;
		$uID = $fVal ['uID'];
		//离职人员的提示
		$feeArr [$uID] = array (
				"name" => $fVal ['name'],
				'uID' => $uID,
				"unitName" => $unitArr ['unitName'],
				"department" => $wR [$uID] ['department'] 
		);
		if ($payStr [0] and $_GET ['hideHeader'] != "true")
			foreach ( $payStr [0] as $payVal ) {
				$feeArr [$uID] [$payVal] = $fVal [$payVal];
			}
			
			//应发,应缴纳税额,个税
		@eval ( '$payMoney=' . $payFormulas . ";" );
		@eval ( '$uAccount=' . $uAccountFormulas . ";" );
		@eval ( '$otherCosts=' . $totalFeeFormulas . ";" );
		$feeArr [$uID] ['pay'] = $payMoney;
		if ($_GET ['hideFeeHeader'] != "true") {
			//实收的社保费用,不包括残障金
			$uSoInsR = round ( $fVal ['uPension'] + $fVal ['uHospitalization'] + $fVal ['uEmploymentInjury'] + $fVal ['uUnemployment'] + $fVal ['uHousing'] + $fVal ['uBirth'], 2 );
			
			foreach ( $iFieldArr as $iVal ) {
				$iValS = $iVal . "S";
				if (! is_null ( $fTR [$uID] [$iValS] ))
					$$iValS = $fTR [$uID] [$iValS];
				elseif ($_GET ['re'] == "true") {
					$$iValS = 0;
				} else {
					$$iValS = $tmp = null;
					switch ($iVal) {
						case "uSoIns" :
							switch ($unitArr ['soInsModel']) {
								//如果该单位是循环垫付的单位,则本月应收为0
								case "2" :
								case "3" :
									$$iValS = null;
									break;
								default :
									//存在首次工资费用表中,且已经付过费用则,多次费用内不收取任何费用
									$tmp = round ( ($soInsFeeArr [$uID] ['uTotal'] - $alreadyFeeRet [$uID] [$iVal]), 2 );
									$$iValS = $tmp > 0 ? $tmp : null;
									break;
							}
							break;
						case "uHF" :
							switch ($unitArr ['HFModel']) {
								//如果该单位是循环垫付的单位,则本月应收为0
								case "2" :
								case "3" :
									$$iValS = null;
									break;
								default :
									//存在首次工资费用表中,且已经付过费用则,多次费用内补收不足的费用或不收取任何费用
									$tmp = round ( ($HFFeeArr [$uID] ['uTotal'] - $alreadyFeeRet [$uID] [$iVal]), 2 );
									$$iValS = $tmp > 0 ? $tmp : null;
									break;
							}
							break;
						case "uComIns" :
							//存在首次工资费用表中,且已经付过费用则,多次费用内不收取任何费用
							$tmp = round ( ($comInsFeeArr [$uID] ['uComInsMoney'] - $alreadyFeeRet [$uID] [$iVal]), 2 );
							$$iValS = $tmp > 0 ? $tmp : null;
							break;
						case "managementCost" :
							//存在首次工资费用表中,且已经付过费用则,多次费用内不收取任何费用
							$tmp = round ( ($mCostFeeArr [$uID] - $alreadyFeeRet [$uID] [$iVal]), 2 );
							$$iValS = $tmp > 0 ? $tmp : null;
							break;
						case "uPDIns" :
							switch ($unitArr ['soInsModel']) {
								//如果该单位是循环垫付的单位,则本月应收为0
								case "2" :
								case "3" :
									$$iValS = null;
									break;
								default :
									//存在首次工资费用表中,且已经付过费用则,多次费用内不收取任何费用
									$tmp = round ( ($soInsFeeArr [$uID] ['uPDIns'] - $alreadyFeeRet [$uID] [$iVal]), 2 );
									$$iValS = $tmp > 0 ? $tmp : null;
									break;
							}
							break;
					}
				}
			}
			
			#社保
			//社保部分,商保,收回单位社保欠款,收回单位商保欠款
			//应收社保	
			$feeArr [$uID] ['uSoInsS'] = $uSoInsS;
			//实收社保 = 收取社保总费用
			$feeArr [$uID] ['uSoInsR'] = round ( $uSoInsR, 2 );
			//社保冲减
			$feeArr [$uID] ['soInsWriteDownMoney'] = $curWriteDownRet [$uID] ['uSoInsMoney'];
			//应收回欠款(单位社保)
			$feeArr [$uID] ['uSoInsMoneyS'] = $rMRet [$uID] ['uSoInsMoney'] < 0 ? - $rMRet [$uID] ['uSoInsMoney'] : null;
			//		//收回社保欠款  = 实收-本月欠/挂-应收+冲减挂账
			//		$feeArr [$uID] ['uSoInsMoney'] = $prsReMoneyRet[$uID]['uSoInsMoney'];
			//收回社保欠款
			$b = $feeArr [$uID] ['uSoInsR'] + $feeArr [$uID] ['soInsWriteDownMoney'] - $feeArr [$uID] ['uSoInsS'];
			if ($b < 0) {
				$uSoInsMoney = 0;
				$curUSoInsMoney = $b;
			} elseif ($feeArr [$uID] ['uSoInsMoneyS'] >= $b && $b >= 0) {
				$uSoInsMoney = $b;
				$curUSoInsMoney = 0;
			} elseif ($b > $feeArr [$uID] ['uSoInsMoneyS']) {
				$uSoInsMoney = $feeArr [$uID] ['uSoInsMoneyS'];
				$curUSoInsMoney = $b - $uSoInsMoney;
			}
			$feeArr [$uID] ['uSoInsMoney'] = $prsReMoneyRet [$uID] ['uSoInsMoney'] != 0 ? $prsReMoneyRet [$uID] ['uSoInsMoney'] : $uSoInsMoney;
			//本月欠/挂
			$feeArr [$uID] ['curUSoInsMoney'] = $curRMRet [$uID] ['uSoInsMoney'];
			//累计欠款
			$feeArr [$uID] ['uSoInsMoneyTotal'] = - $feeArr [$uID] ['uSoInsMoneyS'] + $feeArr [$uID] ['uSoInsMoney'];
			if ($feeArr [$uID] ['curUSoInsMoney'] < 0) {
				$feeArr [$uID] ['uSoInsMoneyTotal'] += $feeArr [$uID] ['curUSoInsMoney'];
			}
			//社保均衡值:实收+冲减挂账-应收-收回欠款-本月欠/挂
			$feeArr [$uID] ['soInsMargin'] = round ( $b - $feeArr [$uID] ['uSoInsMoney'] - $feeArr [$uID] ['curUSoInsMoney'], 2 );
			//        if ($feeArr [$uID] ['uSoInsMoney'] != 0 && $b == 0 && ($feeArr [$uID] ['uSoInsMoney'] - $feeArr [$uID] ['uSoInsMoneyS']) == 0) {
			//            //当实收+冲减=应收, 收回欠款=应收欠款
			//            $feeArr [$uID] ['soInsMargin'] = 0;
			//        }
			#公积金
			//公积金应收	
			$feeArr [$uID] ['uHFS'] = $uHFS;
			//实收公积金
			$feeArr [$uID] ['uHFR'] = round ( $fVal ['uHF'], 2 );
			//公积金冲减
			$feeArr [$uID] ['HFWriteDownMoney'] = $curWriteDownRet [$uID] ['uHFMoney'];
			//应收回欠款(单位公积金)
			$feeArr [$uID] ['uHFMoneyS'] = $rMRet [$uID] ['uHFMoney'] < 0 ? - $rMRet [$uID] ['uHFMoney'] : null;
			//收回公积金欠款
			$e = $feeArr [$uID] ['uHFR'] + $feeArr [$uID] ['HFWriteDownMoney'] - $feeArr [$uID] ['uHFS'];
			if ($e < 0) {
				$uHFMoney = 0;
				$curUHFMoney = $e;
			} elseif ($feeArr [$uID] ['uHFMoneyS'] >= $e && $e >= 0) {
				$uHFMoney = $e;
				$curUHFMoney = 0;
			} elseif ($e > $feeArr [$uID] ['uHFMoneyS']) {
				$uHFMoney = $feeArr [$uID] ['uHFMoneyS'];
				$curUHFMoney = $e - $uHFMoney;
			}
			$feeArr [$uID] ['uHFMoney'] = $prsReMoneyRet [$uID] ['uHFMoney'] != 0 ? $prsReMoneyRet [$uID] ['uHFMoney'] : $uHFMoney;
			//本月欠/挂
			$feeArr [$uID] ['curUHFMoney'] = $curRMRet [$uID] ['uHFMoney'];
			//累计欠款
			$feeArr [$uID] ['uHFMoneyTotal'] = - $feeArr [$uID] ['uHFMoneyS'] + $feeArr [$uID] ['uHFMoney'];
			if ($feeArr [$uID] ['curUHFMoney'] < 0) {
				$feeArr [$uID] ['uHFMoneyTotal'] += $feeArr [$uID] ['curUHFMoney'];
			}
			//公积金均衡值:实收+冲减挂账-应收-收回欠款-本月欠/挂
			$feeArr [$uID] ['HFMargin'] = round ( $e - $feeArr [$uID] ['uHFMoney'] - $feeArr [$uID] ['curUHFMoney'], 2 );
			//        if ($feeArr [$uID] ['uHFMoney'] != 0 && $e == 0 && ($feeArr [$uID] ['uHFMoney'] - $feeArr [$uID] ['uHFMoneyS']) == 0) {
			//            //当实收+冲减=应收, 收回欠款=应收欠款
			//            $feeArr [$uID] ['HFMargin'] = 0;
			//        }
			#商保
			//有发工资的由个人承担部分费用,不发工资的则由单位全部承担
			//应收商保
			$feeArr [$uID] ['uComInsS'] = $uComInsS;
			//实收商保
			$feeArr [$uID] ['uComInsR'] = round ( $fVal ['uComIns'], 2 );
			//本月商保冲减
			$feeArr [$uID] ['comInsWriteDownMoney'] = $curWriteDownRet [$uID] ['uComInsMoney'];
			//应收商保欠款
			$feeArr [$uID] ['uComInsMoneyS'] = $rMRet [$uID] ['uComInsMoney'] < 0 ? - $rMRet [$uID] ['uComInsMoney'] : null;
			//收回商保欠款
			$c = $feeArr [$uID] ['uComInsR'] + $feeArr [$uID] ['comInsWriteDownMoney'] - $feeArr [$uID] ['uComInsS'];
			if ($c < 0) {
				$uComInsMoney = 0;
				$curUComInsMoney = $c;
			} elseif ($feeArr [$uID] ['uComInsMoneyS'] >= $c && $c >= 0) {
				$uComInsMoney = $c;
				$curUComInsMoney = 0;
			} elseif ($c > $feeArr [$uID] ['uComInsMoneyS']) {
				$uComInsMoney = $feeArr [$uID] ['uComInsMoneyS'];
				$curUComInsMoney = $c - $uComInsMoney;
			}
			$feeArr [$uID] ['uComInsMoney'] = $prsReMoneyRet [$uID] ['uComInsMoney'] != 0 ? $prsReMoneyRet [$uID] ['uComInsMoney'] : $uComInsMoney;
			//本月商保欠/挂
			$feeArr [$uID] ['curUComInsMoney'] = $curRMRet [$uID] ['uComInsMoney'];
			//累计商保欠/挂
			$feeArr [$uID] ['uComInsMoneyTotal'] = - $feeArr [$uID] ['uComInsMoneyS'] + $feeArr [$uID] ['uComInsMoney'];
			if ($feeArr [$uID] ['curUComInsMoney'] < 0) {
				$feeArr [$uID] ['uComInsMoneyTotal'] += $feeArr [$uID] ['curUComInsMoney'];
			}
			//本月商保均衡值(防止从其他项目上调账过来``实收的费用就不正确,必需是 实收=实收+其他项目调账)
			$feeArr [$uID] ['comInsMargin'] = round ( ($c - $feeArr [$uID] ['uComInsMoney'] - $feeArr [$uID] ['curUComInsMoney']), 2 );
			if ($feeArr [$uID] ['uComInsMoney'] != 0 && $c == 0 && ($feeArr [$uID] ['uComInsMoney'] - $feeArr [$uID] ['uComInsMoneyS']) == 0) {
				//当实收+冲减=应收, 收回欠款=应收欠款
				$feeArr [$uID] ['comInsMargin'] = 0;
			}
			#管理费
			//应收管理费
			$feeArr [$uID] ['managementCostS'] = $managementCostS;
			//实收管理费
			$feeArr [$uID] ['managementCostR'] = round ( $fVal ['managementCost'], 2 );
			//本月管理费冲减
			$feeArr [$uID] ['mCostWriteDownMoney'] = $curWriteDownRet [$uID] ['managementCostMoney'];
			//应收管理费欠款
			$feeArr [$uID] ['managementCostMoneyS'] = $rMRet [$uID] ['managementCostMoney'] < 0 ? - $rMRet [$uID] ['managementCostMoney'] : null;
			//收回管理欠款
			$d = $feeArr [$uID] ['managementCostR'] + $feeArr [$uID] ['mCostWriteDownMoney'] - $feeArr [$uID] ['managementCostS'];
			if ($d < 0) {
				$managementCostMoney = 0;
				$curManagementCostMoney = $d;
			} elseif ($feeArr [$uID] ['managementCostMoneyS'] >= $d && $d >= 0) {
				$managementCostMoney = $d;
				$curManagementCostMoney = 0;
			} elseif ($d > $feeArr [$uID] ['managementCostMoneyS']) {
				$managementCostMoney = $feeArr [$uID] ['managementCostMoneyS'];
				$curManagementCostMoney = $d - $managementCostMoney;
			}
			$feeArr [$uID] ['managementCostMoney'] = $prsReMoneyRet [$uID] ['managementCostMoney'] != 0 ? $prsReMoneyRet [$uID] ['managementCostMoney'] : $managementCostMoney;
			//本月管理费欠/挂
			$feeArr [$uID] ['curManagementCostMoney'] = $curRMRet [$uID] ['managementCostMoney'];
			//累计欠款
			$feeArr [$uID] ['managementCostMoneyTotal'] = - $feeArr [$uID] ['managementCostMoneyS'] + $feeArr [$uID] ['managementCostMoney'];
			if ($feeArr [$uID] ['curManagementCostMoney'] < 0) {
				$feeArr [$uID] ['managementCostMoneyTotal'] += $feeArr [$uID] ['curManagementCostMoney'];
			}
			//管理费均衡值
			$feeArr [$uID] ['managementCostMargin'] = round ( ($d - $feeArr [$uID] ['managementCostMoney'] - $feeArr [$uID] ['curManagementCostMoney']), 2 );
			//        if ($feeArr [$uID] ['managementCostMoney'] != 0 && $d == 0 && ($feeArr [$uID] ['managementCostMoney'] - $feeArr [$uID] ['managementCostS']) == 0) {
			//            //当实收+冲减=应收, 收回欠款=应收欠款
			//            $feeArr [$uID] ['managementCostMargin'] = 0;
			//        }
			//残障金应收
			//改为 残障金跟社保分离
			$feeArr [$uID] ['uPDInsS'] = $uPDInsS;
			$feeArr [$uID] ['uPDInsR'] = round ( $fVal ['uPDIns'], 2 );
			//残障金冲减
			$feeArr [$uID] ['PDInsWriteDownMoney'] = $curWriteDownRet [$uID] ['uPDInsMoney'];
			//应收回残障金欠款(单位社保)
			$feeArr [$uID] ['uPDInsMoneyS'] = $rMRet [$uID] ['uPDInsMoney'] < 0 ? - $rMRet [$uID] ['uPDInsMoney'] : null;
			//收回残障金欠款
			$a = $feeArr [$uID] ['uPDInsR'] + $feeArr [$uID] ['PDInsWriteDownMoney'] - $feeArr [$uID] ['uPDInsS'];
			if ($a < 0) {
				$uPDInsMoney = 0;
				$curUPDInsMoney = $a;
			} elseif ($feeArr [$uID] ['uPDInsMoneyS'] >= $a && $a >= 0) {
				$uPDInsMoney = $a;
				$curUPDInsMoney = 0;
			} elseif ($a > $feeArr [$uID] ['uPDInsMoneyS']) {
				$uPDInsMoney = $feeArr [$uID] ['uPDInsMoneyS'];
				$curUPDInsMoney = $a - $uPDInsMoney;
			}
			$feeArr [$uID] ['uPDInsMoney'] = $prsReMoneyRet [$uID] ['uPDInsMoney'] != 0 ? $prsReMoneyRet [$uID] ['uPDInsMoney'] : $uPDInsMoney;
			//本月欠/挂
			$feeArr [$uID] ['curUPDInsMoney'] = $curRMRet [$uID] ['uPDInsMoney'];
			//累计欠款
			$feeArr [$uID] ['uPDInsMoneyTotal'] = - $feeArr [$uID] ['uPDInsMoneyS'] + $feeArr [$uID] ['uPDInsMoney'];
			if ($feeArr [$uID] ['curUPDInsMoney'] < 0) {
				$feeArr [$uID] ['uPDInsMoneyTotal'] += $feeArr [$uID] ['curUPDInsMoney'];
			}
			//残障金均衡值:实收+冲减挂账-应收-收回欠款-本月欠/挂
			$feeArr [$uID] ['PDInsMargin'] = round ( ($a - $feeArr [$uID] ['uPDInsMoney'] - $feeArr [$uID] ['curUPDInsMoney']), 2 );
			//        if ($feeArr [$uID] ['PDInsMoney'] != 0 && $a == 0 && ($feeArr [$uID] ['PDInsMoney'] - $feeArr [$uID] ['PDInsMoneyS']) == 0) {
			//            //当实收+冲减=应收, 收回欠款=应收欠款
			//            $feeArr [$uID] ['PDInsMargin'] = 0;
			//        }
		}
		//收回工资垫付款
		$feeArr [$uID] ['advanceMoney'] = $fVal ['advanceMoney'];
		//单位挂账
		if ($uAccountRet && array_key_exists ( $uID, $uAccountRet ))
			$uAccount = $curRMRet [$uID] ['uAccount'];
		$feeArr [$uID] ['uAccount'] = round ( $uAccount, 2 );
		//其他单位费用
		if ($otherCostsStr [0])
			foreach ( $otherCostsStr [0] as $oVal ) {
				$feeArr [$uID] [$oVal] = $fVal [$oVal];
			}
			
			//	总费用=应发工资+应收单位社保+收回社保欠款+本月社保欠/挂+应收单位商保+收回商保欠款+本月商保欠/挂+收回其他欠款+单位挂账+应收管理费+本月管理费欠/挂+收回管理费欠款
			// 		$totalFee = $feeArr [$uID] ['pay'] + $feeArr [$uID] ['uSoInsS'] + $feeArr [$uID] ['uSoInsMoney'] + $feeArr [$uID] ['curUSoInsMoney']+ $feeArr [$uID] ['uHFS'] + $feeArr [$uID] ['uHFMoney'] + $feeArr [$uID] ['curUHFMoney'] + $feeArr [$uID] ['uComInsS'] + $feeArr [$uID] ['uComInsMoney'] + $feeArr [$uID] ['curUComInsMoney']  + $feeArr [$uID] ['managementCostS'] + $feeArr [$uID] ['curManagementCostMoney'] + $feeArr [$uID] ['managementCostMoney']+ $feeArr [$uID] ['uPDInsS'] + $feeArr [$uID] ['uPDInsMoney'] + $feeArr [$uID] ['curUPDInsMoney']+ $feeArr [$uID] ['advanceMoney'] + $feeArr [$uID] ['uAccount'];
			//总费用=应发工资+实收单位残障金+本月残障金冲减+实收单位社保+本月社保冲减+实收单位商保+本月商保冲减+实收管理费+本月管理费冲减+单位挂账
		$totalFee = $feeArr [$uID] ['pay'] + $feeArr [$uID] ['uPDInsR'] + $feeArr [$uID] ['PDInsWriteDownMoney'] + $feeArr [$uID] ['uSoInsR'] + $feeArr [$uID] ['soInsWriteDownMoney'] + $feeArr [$uID] ['uHFR'] + $feeArr [$uID] ['HFWriteDownMoney'] + $feeArr [$uID] ['uComInsR'] + $feeArr [$uID] ['comInsWriteDownMoney'] + $feeArr [$uID] ['managementCostR'] + $feeArr [$uID] ['mCostWriteDownMoney'] + $feeArr [$uID] ['advanceMoney'] + $feeArr [$uID] ['uAccount'];
		$feeArr [$uID] ['totalFee'] = $totalFee + $otherCosts;
		$feeArr [$uID] ['status'] = $wR [$uID] ['status'];
	}
	// print_r($feeArr);
	

	$editSql = "select uID from `a_fee_tmp` where `month` like :month and `unitID` like :unitID and `extraBatch`=:extraBatch";
	$editArr = SQL ( $pdo, $editSql, array (
			":month" => $month,
			":unitID" => $unitID,
			":extraBatch" => $extraBatch 
	) );
	$editArr = keyArray ( $editArr, "uID" );
	
	$selSql = "select uID,ID from a_mul_originalFee  where month like :month and unitID like :unitID and extraBatch=:extraBatch ";
	$selRet = SQL ( $pdo, $selSql, array (
			":month" => $month,
			":unitID" => $unitID,
			":extraBatch" => $extraBatch 
	) );
	$selRet = keyArray ( $selRet, "uID" );
	
	if ($selRet) {
		if ($editArr)
			$needArr = array_diff_key ( $editArr, $selRet );
		$prsReStr = null;
		foreach ( $feeArr as $feeKey => $feeVal ) {
			$iStr = $str = null;
			//如果存在调账记录,且不存在于原始费用表则添加
			if ($needArr && array_key_exists ( $feeKey, $needArr )) {
				foreach ( $feeVal as $feeK => $feeV ) {
					switch ($feeK) {
						case "name" :
						case "uID" :
							$iStr .= "`$feeK`='$feeV',";
							$feeTotalArr [$feeK] = null;
							break;
						case "unitName" :
						case "department" :
							$feeTotalArr [$feeK] = null;
							break;
						case "status" :
							break;
						case "soInsMargin" :
						case "HFMargin" :
						case "comInsMargin" :
						case "managementCostMargin" :
							if ($feeV != 0)
								$margin = $feeV;
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uPDInsS" :
							if (! $feeV)
								$feeV = 0;
							$iStr .= "`uPDIns`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uSoInsS" :
							if (! $feeV)
								$feeV = 0;
							$iStr .= "`uSoIns`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uHFS" :
							if (! $feeV)
								$feeV = 0;
							$iStr .= "`uHF`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uComInsS" :
							if (! $feeV)
								$feeV = 0;
							$iStr .= "`uComIns`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "managementCostS" :
							if (! $feeV)
								$feeV = 0;
							$iStr .= "`managementCost`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "pay" :
						case "totalFee" :
							$iStr .= "`$feeK`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						// 收回欠款,但是它对应的type=3
						case "uSoInsMoney" :
						case "uHFMoney" :
						case "uComInsMoney" :
						case "uPDInsMoney" :
						case "managementCostMoney" :
						case "uOtherMoney" :
							if ($feeV != 0) {
								$prsTrStr [$feeKey] .= "`" . $feeK . "`='" . $feeV . "',";
							}
							$feeTotalArr [$feeK] += $feeV;
							break;
						//设置单位挂账type=1
						case "uAccount" :
							if ($feeV != 0) {
								$prsReStr [$feeKey] .= "`" . $feeK . "`='" . $feeV . "',";
							}
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "advanceMoney" :
							$iStr .= "`$feeK`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						default :
							if ($otherCostsStr [0] && in_array ( $feeK, $otherCostsStr [0] ) || in_array ( $feeK, $payStr [0] ))
								$iStr .= "`$feeK`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
					}
				}
				$upOFSql [] = "insert into `a_mul_originalFee` set  `month`='$month',extraBatch='$extraBatch',`salaryDate`='$salaryDate',`soInsDate`='$soInsDate',`HFDate`='$HFDate',`comInsDate`='$comInsDate',`managementCostDate`='$managementCostDate',`unitID`='$unitID',`zID`='$zID',`salaryStatus`='1' ," . $iStr . " `sponsorName`='$mName',`sponsorTime`='$now' ";
			} else {
				foreach ( $feeVal as $feeK => $feeV ) {
					switch ($feeK) {
						case "name" :
						case "uID" :
						case "unitName" :
						case "department" :
							$feeTotalArr [$feeK] = null;
							break;
						case "status" :
							break;
						case "soInsMargin" :
						case "HFMargin" :
						case "comInsMargin" :
						case "managementCostMargin" :
							if ($feeV != 0)
								$margin = $feeV;
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uPDInsS" :
							if (! $feeV)
								$feeV = 0;
							$str .= "`uPDIns`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uSoInsS" :
							if (! $feeV)
								$feeV = 0;
							$str .= "`uSoIns`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uHFS" :
							if (! $feeV)
								$feeV = 0;
							$str .= "`uHF`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "uComInsS" :
							if (! $feeV)
								$feeV = 0;
							$str .= "`uComIns`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "managementCostS" :
							if (! $feeV)
								$feeV = 0;
							$str .= "`managementCost`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "pay" :
						case "totalFee" :
							$str .= "`$feeK`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						// 收回欠款,但是它对应的type=3
						case "uSoInsMoney" :
						case "uHFMoney" :
						case "uComInsMoney" :
						case "uPDInsMoney" :
						case "managementCostMoney" :
						case "uOtherMoney" :
							if ($feeV != 0) {
								$prsTrStr [$feeKey] .= "`" . $feeK . "`='" . $feeV . "',";
							}
							$feeTotalArr [$feeK] += $feeV;
							break;
						//设置单位挂账type=1
						case "uAccount" :
							if ($feeV != 0) {
								$prsReStr [$feeKey] .= "`" . $feeK . "`='" . $feeV . "',";
							}
							$feeTotalArr [$feeK] += $feeV;
							break;
						case "advanceMoney" :
							$str .= "`$feeK`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
						default :
							if ($otherCostsStr [0] && in_array ( $feeK, $otherCostsStr [0] ) || in_array ( $feeK, $payStr [0] ))
								$str .= "`$feeK`='$feeV',";
							$feeTotalArr [$feeK] += $feeV;
							break;
					}
				}
				$upOFSql [] = "update `a_mul_originalFee` set " . $str . " `confirmStatus`='0', `sponsorName`='$mName',`sponsorTime`='$now' where `ID` ='" . $selRet [$feeKey] ['ID'] . "'";
				;
			}
		}
	} else {
		$prsReStr = null;
		foreach ( $feeArr as $feeKey => $feeVal ) {
			$str = null;
			foreach ( $feeVal as $feeK => $feeV ) {
				switch ($feeK) {
					case "name" :
					case "uID" :
						$str .= "`$feeK`='$feeV',";
						$feeTotalArr [$feeK] = null;
						break;
					case "unitName" :
					case "department" :
						$feeTotalArr [$feeK] = null;
						break;
					case "status" :
						break;
					case "soInsMargin" :
					case "HFMargin" :
					case "comInsMargin" :
					case "managementCostMargin" :
						if ($feeV != 0)
							$margin = $feeV;
						$feeTotalArr [$feeK] += $feeV;
						break;
					case "uPDInsS" :
						if (! $feeV)
							$feeV = 0;
						$str .= "`uPDIns`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
					case "uSoInsS" :
						if (! $feeV)
							$feeV = 0;
						$str .= "`uSoIns`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
					case "uHFS" :
						if (! $feeV)
							$feeV = 0;
						$str .= "`uHF`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
					case "uComInsS" :
						if (! $feeV)
							$feeV = 0;
						$str .= "`uComIns`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
					case "managementCostS" :
						if (! $feeV)
							$feeV = 0;
						$str .= "`managementCost`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
					case "pay" :
					case "totalFee" :
						$str .= "`$feeK`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
					// 收回欠款,但是它对应的type=3
					case "uSoInsMoney" :
					case "uHFMoney" :
					case "uComInsMoney" :
					case "uPDInsMoney" :
					case "managementCostMoney" :
					case "uOtherMoney" :
						if ($feeV != 0) {
							$prsTrStr [$feeKey] .= "`" . $feeK . "`='" . $feeV . "',";
						}
						$feeTotalArr [$feeK] += $feeV;
						break;
					//设置单位挂账type=1
					case "uAccount" :
						if ($feeV != 0) {
							$prsReStr [$feeKey] .= "`" . $feeK . "`='" . $feeV . "',";
						}
						$feeTotalArr [$feeK] += $feeV;
						break;
					case "advanceMoney" :
						$str .= "`$feeK`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
					default :
						if ($otherCostsStr [0] && in_array ( $feeK, $otherCostsStr [0] ) || in_array ( $feeK, $payStr [0] ))
							$str .= "`$feeK`='$feeV',";
						$feeTotalArr [$feeK] += $feeV;
						break;
				}
			}
			$upOFSql [] = "insert into `a_mul_originalFee` set  `month`='$month',extraBatch='$extraBatch',`salaryDate`='$salaryDate',`soInsDate`='$soInsDate',`HFDate`='$HFDate',`comInsDate`='$comInsDate',`managementCostDate`='$managementCostDate',`unitID`='$unitID',`zID`='$zID',`salaryStatus`='1' ," . $str . " `sponsorName`='$mName',`sponsorTime`='$now' ";
		}
	}
	unset ( $wR, $rMRet, $soInsRet, $feeRet );
	
	if (isset ( $_POST ['edit'] )) {
		$needArr = null;
		$selSql = "select uID from `a_fee_tmp`  where month like :month and unitID like :unitID and extraBatch=:extraBatch";
		$selRet = SQL ( $pdo, $selSql, array (
				":month" => $month,
				":unitID" => $unitID,
				":extraBatch" => $extraBatch 
		) );
		$selRet = keyArray ( $selRet, "uID" );
		$needArr = array_diff_key ( $editArr, $selRet );
		if (! $selRet) {
			$insertSql = "insert into `a_fee_tmp` (`month`,`unitID`,`extraBatch`,`name`,`uID`,`uSoInsS` , `uSoInsR`,`uSoInsMoneyS`, `uHFS` , `uHFR`,`uHFMoneyS`, `uComInsS` ,`uComInsR` , `uComInsMoneyS`,  `managementCostS`,`managementCostR`,`managementCostMoneyS` , `uPDInsS` ,`uPDInsR` , `uPDInsMoneyS` )values";
			foreach ( $feeArr as $feeKey => $feeVal ) {
				$insertStr .= "('" . $month . "','" . $unitID . "','" . $extraBatch . "',";
				foreach ( $feeVal as $feeK => $feeV ) {
					switch ($feeK) {
						case "uID" :
						case "name" :
						case "uPDInsS" :
						case "uPDInsMoneyS" :
						case "uPDInsR" :
						case "uSoInsS" :
						case "uSoInsMoneyS" :
						case "uSoInsR" :
						case "uHFS" :
						case "uHFMoneyS" :
						case "uHFR" :
						case "uComInsS" :
						case "uComInsMoneyS" :
						case "uComInsR" :
						case "managementCostS" :
						case "managementCostMoneyS" :
						case "managementCostR" :
							$insertStr .= "'" . $feeV . "',";
							break;
					}
				}
				$insertStr = rtrim ( $insertStr, "," );
				$insertStr .= "),";
			}
			$insertStr = rtrim ( $insertStr, "," );
			$actionSql [0] = $insertSql . $insertStr;
			//            echo "<pre>";
			//            print_r($actionSql);
			$result = extraTransaction ( $pdo, $actionSql );
			if ($result ['error']) {
				exit ( $result ['error'] . "<br/>系统发生错误,请及时联系管理员查证" );
			} else {
				$showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "salaryManage/feeEdit_mul.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
			}
		} elseif ($needArr) {
			$insertSql = "insert into `a_fee_tmp` (`month`,`unitID`,`extraBatch`,`name`,`uID`,`uSoInsS` , `uSoInsR`,`uSoInsMoneyS`, `uHFS` , `uHFR`,`uHFMoneyS`, `uComInsS` ,`uComInsR` , `uComInsMoneyS`,  `managementCostS`,`managementCostR`,`managementCostMoneyS` , `uPDInsS` ,`uPDInsR` , `uPDInsMoneyS` )values";
			$feeArrEdit = array_intersect_key ( $feeArr, $needArr );
			foreach ( $feeArrEdit as $feeKey => $feeVal ) {
				$insertStr .= "('" . $month . "','" . $unitID . "','" . $extraBatch . "',";
				foreach ( $feeVal as $feeK => $feeV ) {
					switch ($feeK) {
						case "uID" :
						case "name" :
						case "uPDInsS" :
						case "uPDInsMoneyS" :
						case "uPDInsR" :
						case "uSoInsS" :
						case "uSoInsMoneyS" :
						case "uSoInsR" :
						case "uHFS" :
						case "uHFMoneyS" :
						case "uHFR" :
						case "uComInsS" :
						case "uComInsMoneyS" :
						case "uComInsR" :
						case "managementCostS" :
						case "managementCostMoneyS" :
						case "managementCostR" :
							$insertStr .= "'" . $feeV . "',";
							break;
					}
				}
				$insertStr = rtrim ( $insertStr, "," );
				$insertStr .= "),";
			}
			$insertStr = rtrim ( $insertStr, "," );
			$actionSql [0] = $insertSql . $insertStr;
			//            echo "<pre>";
			//            echo "dddd=".count($needArr);
			//            print_r( $feeArrEdit);
			//            print_r($actionSql);
			$result = extraTransaction ( $pdo, $actionSql );
			if ($result ['error']) {
				exit ( $result ['error'] . "<br/>系统发生错误,请及时联系管理员查证" );
			} else {
				$showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "salaryManage/feeEdit_mul.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
			}
		} else {
			$showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "salaryManage/feeEdit_mul.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
		}
	}
	
	if (isset ( $_POST ['save'] )) {
		if ($margin != 0) {
			exit ( "未调整均衡值,不允许保存,<a href='$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]'>点击返回</a>" );
		} else {
			//			print_r($prsReStr);
			if ($prsReStr) {
				$curAccRMRet = null;
				if ($curRMRet)
					foreach ( $curRMRet as $key => $val ) {
						foreach ( $val as $k => $v ) {
							if ($k != "ID" && $v > 0) {
								$curAccRMRet [$key] ['ID'] = $val ['ID'];
								$curAccRMRet [$key] [$k] = $v;
							}
						}
					}
				foreach ( $prsReStr as $prK => $prV ) {
					if ($prV) {
						if ($curAccRMRet) {
							if (array_key_exists ( $prK, $curAccRMRet )) {
								$upPrsReSql [] = "update a_prsRequireMoney set $prV `status`='0',`sponsorName`='$mName',sponsorTime='$now' where  `ID` = " . $curAccRMRet [$prK] ['ID'];
							} else {
								$inPrsReSql [] = "insert into a_prsRequireMoney set $prV `uID`='$prK',`unitID`='$unitID',`extraBatch`='$extraBatch',`type`='1',`month`='$month', `feeType`='0',`status`='0',`sponsorName`='$mName',sponsorTime='$now'";
							}
						} else {
							$inPrsReSql [] = "insert into a_prsRequireMoney set $prV `uID`='$prK',`unitID`='$unitID',`extraBatch`='$extraBatch',`type`='1',`month`='$month', `feeType`='0',`status`='0',`sponsorName`='$mName',sponsorTime='$now'";
						}
					}
				}
			} else {
				//如果没有单位挂账的话,就设置已经有单位挂账的等于0
				$upPrsAccSql = "update a_prsRequireMoney set `uAccount`='0' where `uAccount`<>'0' and `month`='$month' and `unitID`='$unitID' and `extraBatch`='$extraBatch' and type ='1' ";
			}
			if ($prsTrStr) {
				foreach ( $prsTrStr as $prK => $prV ) {
					if ($prV) {
						if ($prsReMoneyRet) {
							if (array_key_exists ( $prK, $prsReMoneyRet )) {
								$upPrsReSql [] = "update `a_prsRequireMoney` set $prV `status`='0',`sponsorName`='$mName',sponsorTime='$now' where `ID` = " . $prsReMoneyRet [$prK] ['ID'];
							} else {
								$inPrsReSql [] = "insert into `a_prsRequireMoney` set $prV `uID`='$prK',`unitID`='$unitID',`type`='3',`extraBatch`='$extraBatch',`month`='$month', `status`='0',`sponsorName`='$mName',`sponsorTime`='$now'";
							}
						} else {
							$inPrsReSql [] = "insert into `a_prsRequireMoney` set $prV `uID`='$prK',`unitID`='$unitID',`extraBatch`='$extraBatch',`type`='3',`month`='$month', `status`='0',`sponsorName`='$mName',`sponsorTime`='$now'";
						}
					}
				}
			}
			$actionSql = null;
			$actionSql = mergeArray ( $upPrsReSql, $inPrsReSql, $upOFSql );
			// 			echo "<pre>";
			// 			print_r ( $actionSql );
			// 			exit ();
			// 			           			print_r(mergeArray ( $upPrsReSql, $inPrsReSql ));
			$result = transaction ( $pdo, $actionSql );
			if ($result ['error']) {
				exit ( $result ['error'] . "<br/>系统发生错误,请及时联系管理员查证" );
			} else {
				//删除所有数值都为0的数据
				delPrsMoney ( $pdo );
				//保存a_prsRequireMoney的临时数据
				saveMoneyTmp ( $pdo, array (
						"month" => $month,
						"unitID" => $unitID,
						"extraBatch" => $extraBatch 
				) );
				$actionSql2 = array (
						$upPrsAccSql 
				);
				extraTransaction ( $pdo, $actionSql2 );
				$showWindow = "<script>window.location.href='" . httpPath . "salaryManage/makeSalaryFee_mul.php?" . $_SERVER ['QUERY_STRING'] . "';</script>";
			}
		}
	}
	
	if (isset ( $_POST ['subApproval'] )) {
		if ($margin != 0) {
			exit ( "均衡值调整失败(不为0),不允许提交审批申请,<a href='$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]'>点击返回</a>" );
		}
		$mID = manager ( $pdo, $unitID, "2_1" );
		$appIDSql = "select * from s_approvalPro_set where type='$appType' and process like '\"mID\"=>\"$mID\"%'";
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
	if ($_POST ['download']) {
		$tableName = "费用表";
		require_once sysPath . 'class/phpToExcelXML/class-excel-xml.inc.php';
		$doc = $feeArr;
		$name = $tableName;
		$name = iconv ( 'UTF-8', 'GBK', $name );
		$xls = new Excel_XML ();
		$xls->addArray ( $doc );
		$xls->generateXML ( $name );
		exit ();
	}
}

//$smarty->debugging=true;
#变量配置
$smarty->assign ( array (
		"societyAvg" => $societyAvg,
		"pComInsMoney" => $pComInsMoneyRadix,
		"uComInsMoney" => $uComInsMoneyRadix 
) );
$smarty->assign ( "newFieldArr", $newFieldArr );
$smarty->assign ( "ret", $ret );
$smarty->assign ( "formulasChartStr", $formulasChartStr );
$smarty->assign ( "formulasStr", $formulasStr );
$smarty->assign ( array (
		"validFee" => $validFee,
		"validSoIns" => $validSoIns 
) );
$smarty->assign ( array (
		"originalFeeValidUrl" => $originalFeeValidUrl,
		"soInsValidUrl" => $soInsValidUrl 
) );
$smarty->assign ( "payStr", $payStr );
$smarty->assign ( "otherCostsStr", $otherCostsStr );
$smarty->assign ( "zID", $zID );
$smarty->assign ( "feeArr", $feeArr );
$smarty->assign ( "feeTotalArr", $feeTotalArr );
$smarty->assign ( "showWindow", $showWindow );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "salaryManage/makeFee_mul.tpl" );
?>
