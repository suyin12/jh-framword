<?php

/*
 *     2011-12-21
 *          <<<制作多次工资发放表  >>>
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
#页面标题
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
$extraBatch = $_GET ['extraBatch'];
$title = "制作第" . ($extraBatch + 1) . "次工资发放表";
$sponsorName = $_SESSION ['exp_user'] ['mName'];
$sponsorTime = timeStyle ( "dateTime" );
#设置显示的默认属性
$_GET ['displaySp'] = is_null ( $_GET ['displaySp'] ) ? true : $_GET ['displaySp'];
$_GET ['fixTable'] = is_null ( $_GET ['fixTable'] ) ? true : $_GET ['fixTable'];
$_GET ['hideHeader'] = is_null ( $_GET ['hideHeader'] ) ? true : $_GET ['hideHeader'];

if (isset ( $_POST ['edit'] )) :
	$showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "salaryManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme','true'); </script>";
 else :
	#验证该单位数据是否已经存在
	$existsSql = "select * from a_mul_originalFee_tmp where month like :month and unitID like :unitID and extraBatch=:extraBatch and uID like '' limit 1";
	$existsRes = $pdo->prepare ( $existsSql );
	$existsRes->execute ( array (
			":unitID" => $unitID,
			":month" => $month,
			":extraBatch" => $extraBatch 
	) );
	$validFee = $existsRes->rowCount ();
	if ($validFee > 0) {
		$originalFeeValidUrl = httpPath . "salaryManage/validOriginalFee.php?" . $_SERVER ['QUERY_STRING'] . '&whatDate=salaryDate';
	}
	if ($validFee == 0) {
		#获取费用表中的相关信息	
		$feeSql = "select * from a_mul_originalFee_tmp where month like :month and unitID like :unitID and extraBatch=:extraBatch";
		if ($_POST ['search'])
			$feeSql .= " and name like '" . trim ( $_POST ['name'] ) . "%'";
		$feeRes = $pdo->prepare ( $feeSql );
		$feeRes->execute ( array (
				":month" => $month,
				":unitID" => $unitID,
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
		$zfSql = "select zIndex,field from a_zformatInfo where zID like :zID";
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
		$sql = "select $newField  from a_mul_originalFee_tmp where unitID like  :unitID and month like :month and extraBatch=:extraBatch limit 0,3";
		$res = $pdo->prepare ( $sql );
		$res->execute ( array (
				":unitID" => $unitID,
				":month" => $month,
				":extraBatch" => $extraBatch 
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
		#获取员工信息,求出社保费用,商保费用,互助会费用
		$wSql = "select a.* from a_workerInfo a left join a_mul_originalFee_tmp b on a.uID=b.uID where b.month like :month and b.unitID like :unitID and b.extraBatch=:extraBatch";
		$wRes = array (
				":unitID" => $unitID,
				":month" => $month,
				":extraBatch" => $extraBatch 
		);
		$wRet = SQL ( $pdo, $wSql, $wRes );
		$wR = keyArray ( $wRet, "uID" );
		
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
		#累计欠款明细,及本月的欠挂明细
		$moneyData = new money ();
		$moneyData->pdo = $pdo;
		$moneyData->unitID = $unitID;
		$moneyData->month = $month;
		$moneyData->thisMonth = true;
		$moneyData->extraBatch = $extraBatch;
		$curMonthMoney = $moneyData->curMonth ();
		$rMRet = $moneyData->sumMoney ();
		#获取本月的收回欠款费用
		$prsReMoneyRet = $curMonthMoney ['prsReMoney'];
		#是否有需要合并计税的相关
		$rewardData = new rewardData ();
		$rewardData->pdo = $pdo;
		$rewardData->month = $month;
		$rewardData->unitID = $unitID;
		$rewardData->rewardDate = $salaryDate;
		// echo "<pre>";
		// print_r($prsReMoneyRet);
		#获取工资表明细数组(注:该数组是有对应显示顺序的...所以这里也要注意一下先后顺序)
		//获取各种公式..
		#这里重新修改过,设置公式,可以每月的公式都不一样,
		$formulasSql = " select * from `a_otherFormulas` where `month`='$month' and `unitID`='$unitID' and extraBatch='$extraBatch' and type='4' and `zID`='$zID'";
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
		$salarySql = "select  a.uID,a.name,a.pSoIns,a.pHF,a.pComIns,a.helpCost,a.cardMoney,a.utilities,a.pSoInsMoney,a.pHFMoney from `a_salary_tmp` a where a.month like :month and a.unitID like :unitID and extraBatch=:extraBatch ";
		$salaryRes = $pdo->prepare ( $salarySql );
		$salaryRes->execute ( array (
				":month" => $month,
				":unitID" => $unitID,
				":extraBatch" => $extraBatch 
		) );
		$salaryRet = $salaryRes->fetchAll ( PDO::FETCH_ASSOC );
		$originalFeeCount = $salaryRes->rowCount ();
		foreach ( $salaryRet as $sav ) {
			$sRet [$sav ['uID']] = $sav;
		}
		//	echo "<pre>";
		//	print_r($newFieldArr);
		

		unset ( $salaryRet );
		//如果已经存在合并扣税的项目
		$vSql = "select uID,ratal,ratalYet from a_mul_originalFee where month like :month and unitID like :unitID and extraBatch=:extraBatch and ratalYet>0 limit 1";
		$vRet = SQL ( $pdo, $vSql, array (
				":month" => $month,
				":unitID" => $unitID,
				":extraBatch" => $extraBatch 
		), 'one' );
		$feeData->extraBatch = $extraBatch;
		if (! $vRet ['ratal']) {
			//已发工资
			$feeData->wArr = $feeRet;
			$exSalaryRet = $feeData->mergeTax_fee ( "mulFee" );
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
			$exSalaryRet = $feeData->mergeTax_fee ( "mulRatalYet" );
			$mergeTaxChart = array (
					'pTaxTotal',
					'ratalTotal' 
			);
		}
		//    echo "<pre>".count($exSalaryRet);
		//    print_r($exSalaryRet);
		$iFieldArr = array (
				"pSoIns",
				"pHF",
				"pComIns",
				"helpCost",
				"pSoInsMoney",
				"pHFMoney" 
		);
		foreach ( $feeRet as $fKey => $fVal ) {
			$uID = $fVal ['uID'];
			foreach ( $iFieldArr as $iVal ) {
				if (! is_null ( $sRet [$uID] [$iVal] ))
					$$iVal = $sRet [$uID] [$iVal];
				else {
					$$iVal = $tmp = null;
					switch ($iVal) {
						case "pSoIns" :
							switch ($unitArr ['soInsModel']) {
								case "2" :
								case "4" :
									$$iVal = null;
									break;
								default :
									//存在首次工资费用表中,且已经付过费用则,多次费用内不收取任何费用
									$tmp = round ( ($soInsFeeArr [$uID] ['pTotal'] - $exSalaryRet [$uID] [$iVal]), 2 );
									$$iVal = $tmp > 0 ? $tmp : null;
									break;
							}
							break;
						case "pHF" :
							switch ($unitArr ['HFModel']) {
								case "2" :
								case "4" :
									$$iVal = null;
									break;
								default :
									if (array_key_exists ( $iVal, $newFieldArr ))
										$$iVal = $fVal [$iVal];
									else {
										//存在首次工资费用表中,且已经付过费用则,多次费用内补收不足的费用或不收取任何费用
										$tmp = round ( ($HFFeeArr [$uID] ['pTotal'] - $exSalaryRet [$uID] [$iVal]), 2 );
										$$iVal = $tmp > 0 ? $tmp : null;
									}
									break;
							}
							break;
						case "pComIns" :
							//存在首次工资费用表中,且已经付过费用则,多次费用内不收取任何费用
							$tmp = round ( ($comInsFeeArr [$uID] ['pComInsMoney'] - $exSalaryRet [$uID] [$iVal]), 2 );
							$$iVal = $tmp > 0 ? $tmp : null;
							break;
						case "helpCost" :
							//存在首次工资费用表中,且已经付过费用则,多次费用内不收取任何费用
							$tmp = round ( ($helpCostFeeArr [$uID] - $exSalaryRet [$uID] [$iVal]), 2 );
							$$iVal = $tmp > 0 ? $tmp : null;
							break;
						case "pSoInsMoney" :
						case "pHFMoney" :
							if ($rMRet [$uID] [$iVal] < 0)
								$$iVal = - $rMRet [$uID] [$iVal];
							else
								$$iVal = null;
							break;
					}
				}
			}
			//应发,应缴纳税额,个税
			@eval ( '$payMoney=' . $payFormulas . ";" );
			@eval ( '$ratalMoney=' . $ratalFormulas . ";" );
			@eval ( '$otherCosts=' . $acheiveFormulas . ";" );
			//这里主要针对的是房补部分,不能高于2803
			//        if ($ratalMoney > 2803)
			//            $ratalMoney = 2803;
			if ($payMoney > 0) {
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
					//已发的工资费用+已发奖金
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
				
				#应收社保
				$salaryArr [$uID] ['pSoIns'] = $pSoIns;
				#应收公积金
				$salaryArr [$uID] ['pHF'] = $pHF;
				
				//有发工资的由个人承担部分费用,不发工资的则由单位全部承担
				$salaryArr [$uID] ['pComIns'] = $pComIns;
				//暂时开通收回社保欠款是可以调整的
				$salaryArr [$uID] ['pSoInsMoney'] = $pSoInsMoney;
				$salaryArr [$uID] ['pHFMoney'] = $pHFMoney;
				$salaryArr [$uID] ['pComInsMoney'] = $prsReMoneyRet [$uID] ['pComInsMoney'] ? $prsReMoneyRet [$uID] ['pComInsMoney'] : - $rMRet [$uID] ['pComInsMoney'];
				$salaryArr [$uID] ['pOtherMoney'] = $prsReMoneyRet [$uID] ['pOtherMoney'] ? $prsReMoneyRet [$uID] ['pOtherMoney'] : - $rMRet [$uID] ['pOtherMoney'];
				$salaryArr [$uID] ['cardMoney'] = $sRet [$uID] ['cardMoney'] ? $sRet [$uID] ['cardMoney'] : $fVal ['cardMoney'];
				$salaryArr [$uID] ['utilities'] = $sRet [$uID] ['utilities'] ? $sRet [$uID] ['utilities'] : $fVal ['utilities'];
				$salaryArr [$uID] ['helpCost'] = $helpCost;
				if ($otherCostsStr [0])
					foreach ( $otherCostsStr [0] as $oVal ) {
						$salaryArr [$uID] [$oVal] = $fVal [$oVal];
					}
				$acheive = $salaryArr [$uID] ['pay'] - $salaryArr [$uID] ['pTax'] - $salaryArr [$uID] ['pSoIns'] - $salaryArr [$uID] ['pHF'] - $salaryArr [$uID] ['pComIns'] - $salaryArr [$uID] ['pSoInsMoney'] - $salaryArr [$uID] ['pHFMoney'] - $salaryArr [$uID] ['pComInsMoney'] - $salaryArr [$uID] ['pOtherMoney'] - $salaryArr [$uID] ['cardMoney'] - $salaryArr [$uID] ['utilities'] - $salaryArr [$uID] ['helpCost'] + $otherCosts;
				$salaryArr [$uID] ['acheive'] = round ( $acheive, 2 );
				$salaryArr [$uID] ['status'] = $wR [$uID] ['status'];
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
		$selSql = "select uID from a_salary_tmp  where month like :month and unitID like :unitID and extraBatch=:extraBatch limit 1";
		$selRes = $pdo->prepare ( $selSql );
		$selRes->execute ( array (
				":month" => $month,
				":unitID" => $unitID,
				":extraBatch" => $extraBatch 
		) );
		$selRow = $selRes->rowCount ();
		if ($selRow <= 0 && $salaryArr) {
			$insertSql = "insert into `a_salary_tmp`  set `month`='$month',`unitID`='$unitID',extraBatch='$extraBatch',";
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
				exit ( $result ['error'] . "<br/>系统添加临时工资表时发生错误,请及时联系管理员查证" );
			}
		}
		if (isset ( $_POST ['next'] ) || isset ( $_POST ['salarySet'] )) {
			if ($_POST ['next'])
				$url = "<script>window.location.href='" . httpPath . "salaryManage/makeFee_mul.php?" . $_SERVER ['QUERY_STRING'] . "';</script>";
			elseif ($_POST ['salarySet'])
				$url = "<script>tipsWindown('发放表设置','iframe:" . httpPath . "salaryManage/salarySet.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme'); </script>";
			elseif ($_POST ['edit'])
				$url = "<script>tipsWindown('发放表设置','iframe:" . httpPath . "salaryManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme'); </script>";
			
			$selSql = "select uID from a_mul_originalFee  where month like :month and unitID like :unitID and extraBatch=:extraBatch limit 1";
			$selRes = $pdo->prepare ( $selSql );
			$selRes->execute ( array (
					":month" => $month,
					":unitID" => $unitID,
					":extraBatch" => $extraBatch 
			) );
			$selRow = $selRes->rowCount ();
			if ($selRow > 0 && $salaryArr) {
				//             echo "<pre>";
				//            print_r($salaryArr);
				$updateSql = "update a_mul_originalFee set `sponsorName`='$sponsorName',`sponsorTime`='$sponsorTime',`confirmStatus`='0',";
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
								if ($sV != 0) {
									//插入欠/挂记录表sql,等于0 的就不要理它了
									$reStr .= "`" . $sK . "`='" . $sV . "',";
								}else{
                                         if(array_key_exists ( $sVal ['uID'], $prsReMoneyRet )){
                                               $reStr .= "`" . $sK . "`='" . $sV . "',";
                                             }
                                      }
								break;
							case "unitName" :
							case "department" :
							case "status" :
							case "pay" :
							case (in_array ( $sK, $mergeTaxChart ) || in_array ( $sK, $payStr [0] )) :
								break;
							case "acheive" :
								if ($sV < 0)
									exit ( "[" . $sVal ['name'] . "] 实发工资小于0,不允许保存,<a href='$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]'>点击返回</a> " );
								else
									$upStr .= "`" . $sK . "`='" . $sV . "',";
								break;
							default :
								if (is_numeric ( $sV ))
									$sV = round ( $sV, 2 );
								$upStr .= "`" . $sK . "`='" . $sV . "',";
								break;
						}
					}
					$upStr = rtrim ( $upStr, "," );
					$uSql [] = $updateSql . $upStr . " where `unitID`='$unitID' and `month`='$month' and extraBatch='$extraBatch' and " . $conStr;
					
					if ($reStr) {
						if ($prsReMoneyRet && array_key_exists ( $sVal ['uID'], $prsReMoneyRet )) {
							//生成更新语句,因为同一种type底下,在同一个月内,同一个人只能有一条记录
							$ruSql [] = "update a_prsrequiremoney set " . $reStr . " `sponsorName`= '$sponsorName',`sponsorTime` = '$sponsorTime' where ID like '" . $prsReMoneyRet [$sVal ['uID']] ['ID'] . "'";
						} else {
							//不存在相同的type=3 的就插入
							$riSql [] = "insert into a_prsrequiremoney set " . $reStr . " `uID`='$sVal[uID]', `month`='$month',`unitID`='$unitID',`extraBatch`='$extraBatch',`type`='3',`sponsorName`= '$sponsorName',`sponsorTime` = '$sponsorTime',`feeType`='0'";
						}
					}
				}
				$actionSql = mergeArray ( $uSql, $riSql, $ruSql );
				$result = transaction ( $pdo, $actionSql );
				
				if ($result ['error']) {
					exit ( $result ['error'] . "<br>发生未知错误,请联系管理员" );
				} else {
					//删除所有数值都为0的数据
					delPrsMoney ( $pdo );
					//保存a_prsRequireMoney的临时数据
					saveMoneyTmp ( $pdo, array (
							"month" => $month,
							"unitID" => $unitID,
							"extraBatch" => $extraBatch 
					) );
					$showWindow = $url;
				}
			}
		}
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
endif; //如果没有点击调整
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
$smarty->assign ( array (
		"exSalaryRet" => $exSalaryRet 
) );
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
$smarty->display ( "salaryManage/makeSalaryFee_mul.tpl" );
?>