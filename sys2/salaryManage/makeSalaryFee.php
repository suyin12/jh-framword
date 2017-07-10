<?php

/*
 *     2010-6-8
 *          <<<制作工资表  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接费用核算类
require_once sysPath . 'dataFunction/fee.data.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/reward.data.php';
ini_set ( "memory_limit", "500M" );
#页面标题
$title = "制作工资表";
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
$sponsorName = $_SESSION ['exp_user'] ['mName'];
$sponsorTime = timeStyle ( "dateTime" );
#设置显示的默认属性
$_GET ['displaySp'] = is_null ( $_GET ['displaySp'] ) ? true : $_GET ['displaySp'];
$_GET ['fixTable'] = is_null ( $_GET ['fixTable'] ) ? true : $_GET ['fixTable'];
$_GET ['hideHeader'] = is_null ( $_GET ['hideHeader'] ) ? true : $_GET ['hideHeader'];
#验证该单位数据是否已经存在
$existsSql = "select * from a_originalFee_tmp where month like :month and unitID like :unitID and uID like ''";
$existsRes = $pdo->prepare ( $existsSql );
$existsRes->execute ( array (
		":unitID" => $unitID,
		":month" => $month 
) );
$validFee = $existsRes->rowCount ();
if ($validFee > 0) {
	$originalFeeValidUrl = httpPath . "salaryManage/validOriginalFee.php?" . $_SERVER ['QUERY_STRING'] . '&whatDate=salaryDate';
}
if ($validFee == 0) {
	#获取费用表中的相关信息	
	$feeSql = "select * from a_originalFee_tmp where month like :month and unitID like :unitID";
	if ($_POST ['search'])
		$feeSql .= " and name like '" . trim ( $_POST ['name'] ) . "%'";
	$feeRes = $pdo->prepare ( $feeSql );
	$feeRes->execute ( array (
			":month" => $month,
			":unitID" => $unitID 
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
	$zID = $feeRet ['0'] ['zID'];
	foreach ( $_GET as $getKey => $getVal ) {
		switch ($getKey) {
			case "zID" :
			case "unitID" :
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
	//获取中英文对照数组
	$engToChsArr = engTochs ();
	#获取该帐套对应的列,包括列的中文名
	$zfSql = "select zIndex,field,payFormulas,ratalFormulas,acheiveFormulas from a_zformatInfo where zID like :zID";
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
	//查找所需的字段,生成预览 ,限制10条
	$sql = "select $newField  from a_originalFee_tmp where unitID like  :unitID and month like :month limit 0,3";
	$res = $pdo->prepare ( $sql );
	$res->execute ( array (
			":unitID" => $unitID,
			":month" => $month 
	) );
	$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
	#设置公式所需要的代号
	$formulasChart = array (
			"+" => "+ (加)",
			"-" => "- (减)",
			"/" => "/ (除)",
			"*" => "* (乘)",
			"(" => "( (左括号)",
			")" => ")(右括号)" 
	) + $formulasChart;
	$i = 0;
	$formulasChartStr .= "<tr>";
	foreach ( $formulasChart as $chartKey => $chart ) {
		
		if ($i % 10 == 0 && $i != 0)
			$formulasChartStr .= "</tr><tr>";
		$i ++;
		$formulasChartStr .= "<td>";
		$formulasChartStr .= "<a href='#' id='$chartKey' class='chart'>$chart</a>";
		$formulasChartstr .= "</td>";
	}
	$formulasChartStr .= "</tr>";
	#定义变量
	//$smarty->debugging = true;
	#获取员工信息,求出社保费用,商保费用,互助会费用
    $wSql = "select a.* from a_workerInfo a left join a_originalFee_tmp b on a.uID=b.uID where b.month like :month and b.unitID like :unitID ";
    $wRes = array (
        ":unitID" => $unitID,
        ":month" => $month,
    );
    $wRet = SQL ( $pdo, $wSql, $wRes );
    $wR = keyArray ( $wRet, "uID" );
	
	#累计欠款明细,及本月的欠挂明细
	$moneyData = new money ();
	$moneyData->pdo = $pdo;
	$moneyData->unitID = $unitID;
	$moneyData->month = $month;
	$curMonthMoney = $moneyData->curMonth ();
	$rMRet = $moneyData->sumMoney ();
	// 	echo "<pre>";
	// 	print_r($rMRet);
	#本月各费用
	$feeData = new feeData ();
	$feeData->pdo = $pdo;
	$feeData->unitID = $unitID;
	$feeData->month = $month;
	$feeData->salaryDate = $salaryDate;
	$feeData->soInsDate = $soInsDate;
	$feeData->HFDate = $HFDate;
	$feeData->comInsDate = $comInsDate;
	$unitArr = $feeData->unitArr ();
	$changeRadix = $feeData->changeRadix ();
	$feeData->wArr = $wR;
	$extraFeeArr = $feeData->extraFeeArr ();
	$soInsFeeArr = $extraFeeArr ['soInsFeeArr'];
	$HFFeeArr = $extraFeeArr ['HFFeeArr'];
	$comInsFeeArr = $extraFeeArr ['comInsFeeArr'];
	$mCostFeeArr = $extraFeeArr ['mCostFeeArr'];
	$helpCostFeeArr = $extraFeeArr ['helpCostFeeArr'];
	$comInsRet = $comInsFeeArr;
	#是否有需要合并计税的相关
	$rewardData = new rewardData ();
	$rewardData->pdo = $pdo;
	$rewardData->month = $month;
	$rewardData->unitID = $unitID;
	$rewardData->rewardDate = $salaryDate;
	#获取本月的收回欠款费用
	$prsReMoneyRet = $curMonthMoney ['prsReMoney'];
	// echo "<pre>";
	// print_r($prsReMoneyRet);
	#获取工资表明细数组(注:该数组是有对应显示顺序的...所以这里也要注意一下先后顺序)
	//获取各种公式..
	#这里重新修改过,设置公式,可以每月的公式都不一样,
	$formulasSql = " select * from `a_zFormulas` where `month`='$month' and `unitID`='$unitID' and `zID`='$zID'";
	$formulasRet = SQL ( $pdo, $formulasSql, null, 'one' );
	if ($formulasRet ['ID']) {
		$formulasStr = array (
				"pay" => $formulasRet ['payFormulas'],
				"ratal" => $formulasRet ['ratalFormulas'],
				"acheive" => $formulasRet ['acheiveFormulas'],
				"pSoIns" => "(pPension+pHospitalization)",
				"pComIns" => "pComIns",
				"utilities" => "utilities" 
		);
		$smarty->assign ( "formulasID", $formulasRet ['ID'] );
	}
	//求得应发工资相关的所有列
	if ($formulasStr ['pay']) {
		preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['pay'], $payStr );
		$payFormulas = strToPHP ( $formulasStr ['pay'] );
	}
	//这里就获得了应发工资的字符串了..再EVAL 一下..就可以转成PHP代码进行运算了
	if ($formulasStr ['ratal']) {
		$ratalFormulas = strToPHP ( $formulasStr ['ratal'] );
	}
	if ($formulasStr ['acheive']) {
		preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['acheive'], $otherCostsStr );
		$acheiveFormulas = strToPHP ( $formulasStr ['acheive'] );
	}
	
	#如果已经导入到 a_originalFee表后
	$salarySql = "select  a.uID,a.name,a.pSoIns,a.pHF,a.pComIns,a.helpCost,a.cardMoney,a.utilities,a.pSoInsMoney,a.pHFMoney from `a_salary_tmp` a where a.month like :month and a.unitID like :unitID and extraBatch='0' and a.lastModifyTIme<>0";
	$salaryRes = $pdo->prepare ( $salarySql );
	$salaryRes->execute ( array (
			":month" => $month,
			":unitID" => $unitID 
	) );
	$salaryRet = $salaryRes->fetchAll ( PDO::FETCH_ASSOC );
	$originalFeeCount = $salaryRes->rowCount ();
	foreach ( $salaryRet as $sav ) {
		$sRet [$sav ['uID']] = $sav;
	}
	//	echo "<pre>";
	//	print_r($sRet);
	

	unset ( $salaryRet );
	
	//如果已经存在合并扣税的项目
	$vSql = "select uID,ratal,ratalYet from a_originalFee where month like :month and unitID like :unitID and ratalYet>0 limit 1";
	$vRet = SQL ( $pdo, $vSql, array (
			":month" => $month,
			":unitID" => $unitID 
	), 'one' );
	if (! $vRet ['ratal']) {
		//已发工资
		$feeData->wArr = $feeRet;
		$exSalaryRet = $feeData->mergeTax_fee ();
		//已发奖金
		$rewardData->wArr = $feeRet;
		$rewardDataArr = $rewardData->ratalAsRewardTotal ();
		$exSalaryRet = recursionAdd ( $exSalaryRet, $rewardDataArr );
		$mergeTaxChart = array (
				'pTaxTotal',
				'ratalTotal' 
		);
	} elseif ($vRet ['ratalYet']) {
		//已经保存记录
		$exSalaryRet = $feeData->mergeTax_fee ( "ratalYet" );
		$mergeTaxChart = array (
				'pTaxTotal',
				'ratalTotal' 
		);
	}
	foreach ( $feeRet as $fKey => $fVal ) {
        $uID =$fVal ['uID'];
		$pSoIns = $sRet [$uID] ['pSoIns'] ? $sRet [$uID] ['pSoIns'] : round ( $soInsFeeArr [$uID] ['pTotal'], 2 );
		#这里临时设置了补缴公积金的项目,如果外部导入模式
		if (array_key_exists ( 'pHF', $newFieldArr )) {
			$pHF = $fVal ['pHF'];
		} else {
			$pHF = $sRet [$uID] ['pHF'] ? $sRet [$uID] ['pHF'] : round ( $HFFeeArr [$uID] ['pTotal'], 2 );
		}
		//收回社保欠款
		$pSoInsMoney = $sRet [$uID] ['pSoInsMoney'] ? $sRet [$uID] ['pSoInsMoney'] : - $rMRet [$uID] ['pSoInsMoney'];
		$pHFMoney = $sRet [$uID] ['pHFMoney'] ? $sRet [$uID] ['pHFMoney'] : - $rMRet [$uID] ['pHFMoney'];
		
		$salaryArr [$uID] = array (
				"name" => $sRet [$uID] ['name'] ? $sRet [$uID] ['name'] : $fVal ['name'],
				"unitName" => $unitArr ['unitName'],
				"department" => $wR [$uID] ['department'],
				'uID' => $uID,
				'bID' => $wR [$uID] ['bID']
		);
		if ($payStr and $_GET ['hideHeader'] != "true")
			foreach ( $payStr [0] as $payVal ) {
				$salaryArr [$uID] [$payVal] = $fVal [$payVal];
			}
			
			//应发,应缴纳税额,个税
		@eval ( '$payMoney=' . $payFormulas . ";" );
		@eval ( '$ratalMoney=' . $ratalFormulas . ";" );
		@eval ( '$otherCosts=' . $acheiveFormulas . ";" );
		//这里主要针对的是房补部分,不能高于2803
		//        if ($ratalMoney > 2803)
		//            $ratalMoney = 2803;
		$ratal = $payMoney;
		if ($unitArr ['soInsModel'] == "2" || $unitArr ['soInsModel'] == "4")
			$ratal = $ratal - $pSoInsMoney;
		else
			$ratal = $ratal - $pSoIns;
		if ($unitArr ['HFModel'] == "2" || $unitArr ['HFModel'] == "4")
			$ratal = $ratal - $pHFMoney;
		else
			$ratal = $ratal - $pHF;
		$ratal = round ( ($ratal + $ratalMoney), 2 );
		$salaryArr [$uID] ['pay'] = $payMoney;
		$salaryArr [$uID] ['ratal'] = $ratal;
		if ($exSalaryRet) {
			$ratalNum = "Yet";
			$mergeRatal = $mergeTax = 0;
			//已发的工资费用
			$salaryArr [$uID] ['ratal' . $ratalNum] = $exSalaryRet [$uID] ['ratal'];
			$salaryArr [$uID] ['pTax' . $ratalNum] = $exSalaryRet [$uID] ['pTax'];
			$mergeRatal += $salaryArr [$uID] ['ratal' . $ratalNum];
			$mergeTax += $salaryArr [$uID] ['pTax' . $ratalNum];
			$salaryArr [$uID] ['ratalTotal'] = $ratal + $mergeRatal;
			$salaryArr [$uID] ['pTaxTotal'] = round ( taxCount ( $salaryArr [$uID] ['ratalTotal'] ), 2 );
			$salaryArr [$uID] ['pTax'] = $salaryArr [$uID] ['pTaxTotal'] - $mergeTax;
		} else {
			$salaryArr [$uID] ['ratal'] = $ratal;
			$salaryArr [$uID] ['pTax'] = round ( taxCount ( $salaryArr [$uID] ['ratal'] ), 2 );
		}
		
		//社保部分,商保,收回个人社保欠款,收回个人商保欠款
		$salaryArr [$uID] ['radix'] = $sRet [$uID] ['radix'] ? $sRet [$uID] ['radix'] : $wR [$uID] ['radix'];
		
		if ($payMoney) {
			#应收社保
			if ($unitArr ['soInsModel'] == "2" || $unitArr ['soInsModel'] == "4")
				//如果该单位是循环垫付的单位,则本月应收社保为0 
				$salaryArr [$uID] ['pSoIns'] = $sRet [$uID] ['pSoIns'] ? $sRet [$uID] ['pSoIns'] : 0;
			else {
				$salaryArr [$uID] ['pSoIns'] = $sRet [$uID] ['pSoIns'] ? $sRet [$uID] ['pSoIns'] : $pSoIns;
			}
			#应收公积金
			if ($unitArr ['HFModel'] == "2" || $unitArr ['HFModel'] == "4")
				$salaryArr [$uID] ['pHF'] = $sRet [$uID] ['pHF'] ? $sRet [$uID] ['pHF'] : 0;
			else {
				$salaryArr [$uID] ['pHF'] = $sRet [$uID] ['pHF'] ? $sRet [$uID] ['pHF'] : $pHF;
			}
		} else {
			$salaryArr [$uID] ['pSoIns'] = $sRet [$uID] ['pSoIns'] ? $sRet [$uID] ['pSoIns'] : 0;
			$salaryArr [$uID] ['pHF'] = $sRet [$uID] ['pHF'] ? $sRet [$uID] ['pHF'] : 0;
		}
		//有发工资的由个人承担部分费用,不发工资的则由单位全部承担
		if ($comInsRet && array_key_exists ( $uID, $comInsRet )) {
			if ($payMoney) {
				$salaryArr [$uID] ['pComIns'] = $sRet [$uID] ['pComIns'] ? $sRet [$uID] ['pComIns'] : $comInsFeeArr [$uID] ['pComInsMoney'];
			} else {
				$salaryArr [$uID] ['pComIns'] = $sRet [$uID] ['pComIns'] ? $sRet [$uID] ['pComIns'] : 0;
			}
		} else {
			$salaryArr [$uID] ['pComIns'] = $sRet [$uID] ['pComIns'] ? $sRet [$uID] ['pComIns'] : null;
		}
		//暂时开通收回社保欠款是可以调整的
		//		$salaryArr [$uID] ['pSoInsMoney'] = $prsReMoneyRet [$uID] ['pSoInsMoney'] ? $prsReMoneyRet [$uID] ['pSoInsMoney'] : - $rMRet [$uID] ['pSoInsMoney'];
		$salaryArr [$uID] ['pSoInsMoney'] = $sRet [$uID] ['pSoInsMoney'] ? $sRet [$uID] ['pSoInsMoney'] : - $rMRet [$uID] ['pSoInsMoney'];
		$salaryArr [$uID] ['pHFMoney'] = $sRet [$uID] ['pHFMoney'] ? $sRet [$uID] ['pHFMoney'] : - $rMRet [$uID] ['pHFMoney'];
		$salaryArr [$uID] ['pComInsMoney'] = $prsReMoneyRet [$uID] ['pComInsMoney'] ? $prsReMoneyRet [$uID] ['pComInsMoney'] : - $rMRet [$uID] ['pComInsMoney'];
		$salaryArr [$uID] ['pOtherMoney'] = $prsReMoneyRet [$uID] ['pOtherMoney'] ? $prsReMoneyRet [$uID] ['pOtherMoney'] : - $rMRet [$uID] ['pOtherMoney'];
		//		$salaryArr [$uID] ['soInsCardMoney'] = $prsReMoneyRet [$uID] ['soInsCardMoney'] ? $prsReMoneyRet [$uID] ['soInsCardMoney'] : - $rMRet [$uID] ['soInsCardMoney'];
		//		$salaryArr [$uID] ['residentCardMoney'] = $prsReMoneyRet [$uID] ['residentCardMoney'] ? $prsReMoneyRet [$uID] ['residentCardMoney'] : - $rMRet [$uID] ['residentCardMoney'];
		$salaryArr [$uID] ['cardMoney'] = $sRet [$uID] ['cardMoney'] ? $sRet [$uID] ['cardMoney'] : $fVal ['cardMoney'];
		$salaryArr [$uID] ['utilities'] = $sRet [$uID] ['utilities'] ? $sRet [$uID] ['utilities'] : $fVal ['utilities'];
		$salaryArr [$uID] ['helpCost'] = $sRet [$uID] ['helpCost'] ? $sRet [$uID] ['helpCost'] : $helpCostFeeArr [$uID];
		if ($otherCostsStr [0])
			foreach ( $otherCostsStr [0] as $oVal ) {
				$salaryArr [$uID] [$oVal] = $fVal [$oVal];
			}
		$acheive = $salaryArr [$uID] ['pay'] - $salaryArr [$uID] ['pTax'] - $salaryArr [$uID] ['pSoIns'] - $salaryArr [$uID] ['pHF'] - $salaryArr [$uID] ['pComIns'] - $salaryArr [$uID] ['pSoInsMoney'] - $salaryArr [$uID] ['pHFMoney'] - $salaryArr [$uID] ['pComInsMoney'] - $salaryArr [$uID] ['pOtherMoney'] - $salaryArr [$uID] ['cardMoney'] - $salaryArr [$uID] ['utilities'] - $salaryArr [$uID] ['helpCost'] + $otherCosts;
		$salaryArr [$uID] ['acheive'] = round ( $acheive, 2 );
		$salaryArr [$uID] ['status'] = $wR [$uID] ['status'];
		if (! $payMoney) {
			$extraSalarypArr [$uID] = $salaryArr [$uID];
			unset ( $salaryArr [$uID] );
		}
	}
	//	echo "<pre>";
	//	echo count($salaryArr);
	//	print_r($salaryArr);
	$salaryTotalArr = null;
	foreach ( $salaryArr as $salaryVal ) {
		foreach ( $salaryVal as $salaryK => $salaryV ) {
			switch ($salaryK) {
				case "uID" :
				case "name" :
				case "unitName" :
				case "department" :
				case "status" :
				case "bID" :
					$salaryTotalArr [$salaryK] = null;
					break;
				case "uID" :
					continue;
					break;
				default :
					$salaryTotalArr [$salaryK] += $salaryV;
					break;
			}
		}
	}
	//	echo "<pre>";
	//	print_r ( $salaryTotalArr );
	//注销全局变量释放内存
	unset ( $wR, $rMRet, $soInsRet, $feeRet );
	if (isset ( $_POST ['edit'] )) {
		$selSql = "select uID from a_salary_tmp  where month like :month and unitID like :unitID and extraBatch='0' limit 1";
		$selRes = $pdo->prepare ( $selSql );
		$selRes->execute ( array (
				":month" => $month,
				":unitID" => $unitID 
		) );
		$selRow = $selRes->rowCount ();
		if ($selRow <= 0 && $salaryArr) {
			$insertSql = "insert into `a_salary_tmp`  set `month`='$month',`unitID`='$unitID',";
			foreach ( $salaryArr as $feeKey => $feeVal ) {
				$insertStr = null;
				foreach ( $feeVal as $feeK => $feeV ) {
					switch ($feeK) {
						case "uID" :
						case "name" :
						case "pay" :
						case "pSoIns" :
						case "pHF" :
						case "pComIns" :
						case "helpCost" :
						case "utilities" :
						case "cardMoney" :
						case "pSoInsMoney" :
						case "pHFMoney" :
							$insertStr .= "`" . $feeK . "`='" . $feeV . "',";
							break;
						case "status" :
							$insertStr .= "`mountGuardStatus`='" . $feeV . "',";
							break;
					}
				}
				$insertStr = rtrim ( $insertStr, "," );
				$inSql [] = $insertSql . $insertStr;
			}
			$actionSql = $inSql;
			$result = transaction ( $pdo, $actionSql );
			if ($result ['error']) {
				exit ( $result ['error'] . "<br/>系统发生错误,请及时联系管理员查证" );
			} else {
				$showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "salaryManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
			}
		} else {
			$showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "salaryManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
		}
	}
	if (isset ( $_POST ['next'] ) || isset ( $_POST ['salarySet'] )) {
		if ($_POST ['next'])
			$url = "<script>window.location.href='" . httpPath . "salaryManage/makeFee.php?" . $_SERVER ['QUERY_STRING'] . "';</script>";
		elseif ($_POST ['salarySet'])
			$url = "<script>tipsWindown('发放表设置','iframe:" . httpPath . "salaryManage/salarySet.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
		elseif ($_POST ['edit'])
			$url = "<script>tipsWindown('发放表设置','iframe:" . httpPath . "salaryManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
		
		$selSql = "select uID from a_originalFee  where month like :month and unitID like :unitID limit 1";
		$selRes = $pdo->prepare ( $selSql );
		$selRes->execute ( array (
				":month" => $month,
				":unitID" => $unitID 
		) );
		$selRow = $selRes->rowCount ();
		if ($selRow > 0 && $salaryArr) {
			$requireSql = "select a.* from a_prsrequiremoney a   where a.type like '3' and a.month like :month and a.unitID like :unitID and extraBatch=0 and a.feeType='0'";
			$exArr = array (
					":month" => $month,
					":unitID" => $unitID 
			);
			$requireRes = $pdo->prepare ( $requireSql );
			$requireRes->execute ( $exArr );
			$requireRet = $requireRes->fetchAll ( PDO::FETCH_ASSOC );
			if ($requireRet) {
				foreach ( $requireRet as $rRK ) {
					$rqRet [$rRK ['uID']] = $rRK;
				}
				unset ( $requireRet );
			}
			//             echo "<pre>";
			//            print_r($salaryArr);
			$updateSql = "update a_originalFee set `sponsorName`='$sponsorName',`sponsorTime`='$sponsorTime',`confirmStatus`='0',";
			foreach ( $salaryArr as $sKey => $sVal ) {
				$upStr = $reStr = $conStr = null;
				foreach ( $sVal as $sK => $sV ) {
					switch ($sK) {
						case "uID" :
							$conStr = " `uID` like '$sV' ";
							break;
						case "bID" :
						case "radix" :
						case "pSoIns" :
						case "pHF" :
						case "pComIns" :
						case "pay" :
						case "ratal" :
						case "pTax" :
						case "utilities" :
						case "helpCost" :
						case "cardMoney" :
							//插入费用明细表sql
							$upStr .= "`" . $sK . "`='" . $sV . "',";
							break;
						case "pSoInsMoney" :
						case "pHFMoney" :
						case "pComInsMoney" :
						case "pOtherMoney" :
							//						case "soInsCardMoney" :
							//						case "residentCardMoney" :
							if ($sV) {
								//插入欠/挂记录表sql,等于0 的就不要理它了
								$reStr .= "`" . $sK . "`='" . $sV . "',";
							}
							break;
						
						case "unitName" :
						case "department" :
						case "status" :
							break;
						case "acheive" :
							if ($sV < 0)
								exit ( "[" . $sVal ['name'] . "] 实发工资小于0,不允许保存,<a href='$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]'>点击返回</a> " );
							else
								$upStr .= "`" . $sK . "`='" . $sV . "',";
							break;
						default :
							if (! in_array ( $sK, $mergeTaxChart )) {
								if (is_numeric ( $sV ))
									$sV = round ( $sV, 2 );
								$upStr .= "`" . $sK . "`='" . $sV . "',";
							}
							break;
					}
				}
				$upStr = rtrim ( $upStr, "," );
				$uSql [] = $updateSql . $upStr . " where `unitID`='$unitID' and `month`='$month' and " . $conStr;
				if ($reStr) {
					if ($rqRet) {
						if (array_key_exists ( $sVal ['uID'], $rqRet )) {
							//生成更新语句,因为同一种type底下,在同一个月内,同一个人只能有一条记录
							$ruSql [] = "update a_prsrequiremoney set " . $reStr . " `sponsorName`= '$sponsorName',`sponsorTime` = '$sponsorTime' where ID like '" . $rqRet [$sVal ['uID']] ['ID'] . "'";
						} else {
							//不存在相同的type=3 的就插入
							$riSql [] = "insert into a_prsrequiremoney set " . $reStr . " `uID`='$sVal[uID]', `month`='$month',`unitID`='$unitID',`type`='3',`sponsorName`= '$sponsorName',`sponsorTime` = '$sponsorTime',`feeType`='0'";
						}
					} else {
						//不存在相同的type=3 的就插入
						$riSql [] = "insert into a_prsrequiremoney set " . $reStr . " `uID`='$sVal[uID]', `month`='$month',`unitID`='$unitID',`type`='3',`sponsorName`= '$sponsorName',`sponsorTime` = '$sponsorTime',`feeType`='0'";
					}
				}
			}
			$actionSql = mergeArray ( $uSql, $riSql, $ruSql );
//			 echo "<pre>";
//			 print_r($actionSql);
//            exit();
			$result = transaction ( $pdo, $actionSql );
			
			if ($result ['error']) {
				exit ( $result ['error'] . "<br>发生未知错误,请联系管理员" );
			} else {
				//删除所有数值都为0的数据
				delPrsMoney ( $pdo );
				//保存a_prsRequireMoney的临时数据
				saveMoneyTmp ( $pdo, array (
						"month" => $month,
						"unitID" => $unitID 
				) );
				$showWindow = $url;
			}
		}
	}
	//          echo "<pre>";
	//          print_r($salaryArr);
	//          echo key($salaryArr);
	//     print_r($salaryArr[key($salaryArr)]);
	if ($_POST ['download']) {
		$tableName = "发放表";
		require_once sysPath . 'class/phpToExcelXML/class-excel-xml.inc.php';
		$doc = $salaryArr;
		$name = $tableName;
		$name = iconv ( 'UTF-8', 'GBK', $name );
		$xls = new Excel_XML ();
		$xls->addArray ( $doc );
		$xls->generateXML ( $name );
		exit ();
	}
}

#变量配置
$smarty->assign ( array (
		"societyAvg" => $societyAvg,
		"pComInsMoney" => $pComInsMoneyRadix,
		"uComInsMoney" => $uComInsMoneyRadix,
		"originalFeeCount" => $originalFeeCount 
) );
$smarty->assign ( "newFieldArr", $newFieldArr );
$smarty->assign ( "ret", $ret );
$smarty->assign ( "formulasChartStr", $formulasChartStr );
$smarty->assign ( "formulasStr", $formulasStr );
$smarty->assign ( array (
		"validFee" => $validFee 
) );
$smarty->assign ( array (
		"originalFeeValidUrl" => $originalFeeValidUrl 
) );
$smarty->assign ( "zID", $zID );
$smarty->assign ( "unitArr", $unitArr );
$smarty->assign ( "payStr", $payStr );
$smarty->assign ( "exSalaryRet", $exSalaryRet );
$smarty->assign ( "otherCostsStr", $otherCostsStr );
$smarty->assign ( "salaryArr", $salaryArr );
$smarty->assign ( "salaryTotalArr", $salaryTotalArr );
$smarty->assign ( "showWindow", $showWindow );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "salaryManage/makeSalaryFee.tpl" );
?>
