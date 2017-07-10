<?php

/**
 * 2010-3-22              
 * <<<该页面主要负责salaryManage的数据库操作语句,
 * 1.创建工资帐套>>>
 * 
 * @author  yours  sToNe
 * @version 
 */
#连接数据库PDO
//require_once '../setting.php';
#连接权限验证文件(简单的一级验证,系统用户?)
require_once '../auth.php';
#连接公共函数文件
require_once '../common.function.php';
#链接验证审批过程
require_once sysPath . 'approval/approval.class.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
$time = time ();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle ( "dateTime", "-" );
#屏蔽警告性错误
//error_reporting ( E_ALL & ~ (E_NOTICE | E_WARNING) );
#创建帐套
if ($_POST ['btn'] == "zFCreate") {
	$zName = $_POST ['zName'];
	$existSql = "select * from a_zFormatInfo where zName like '$zName'";
	$existRet = $pdo->query ( $existSql );
	$existRowCount = $existRet->rowCount ();
	if ($existRowCount > 0) {
		$errMsg = "已经存在账套名为: " . $zName . " ,请更换账套名";
	} else {
		foreach ( $_POST ['fieldName'] as $field => $fieldName ) {
			$fieldNameStr .= '"' . $field . '"=>"' . $fieldName . '",';
		}
		$fieldNameStr = rtrim ( $fieldNameStr );
		foreach ( $_POST ['index'] as $indexKey => $indexVal ) {
			if ($indexVal) {
				$indexVal = trim ( $indexVal );
				$indexStr .= '"' . $indexKey . '"=>"' . $indexVal . '",';
			}
		}
		$indexStr = rtrim ( $indexStr, "," );
		$modifyTime = date ( "Y-m-d H:i:s", $time );
		$insertArr = array (
				"zName" => $zName,
				"field" => $fieldNameStr,
				"zIndex" => $indexStr,
				"mID" => $mID,
				"modifyTime" => $modifyTime 
		);
		
		//构成生成工资帐套SQL
		$insertStr = "(";
		foreach ( $insertArr as $iK => $iV ) {
			$fieldStr .= "`" . $iK . "`,";
			$insertStr .= "'" . $iV . "',";
		}
		$fieldStr = rtrim ( $fieldStr, "," );
		$insertStr = rtrim ( $insertStr, "," );
		$insertStr .= ")";
		$insertSql = " insert into a_zFormatInfo(" . $fieldStr . ")values";
		//insert sql
		$actionSql [0] = $insertSql . $insertStr;
		$result = transaction ( $pdo, $actionSql );
		$errMsg = $result ['error'];
	}
	if (empty ( $errMsg )) {
		$succMsg = "成功生成工资账套: " . $zName;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#帐套更新
if ($_POST ['btn'] == "zFUpdate") {
	
	$zID = $_POST ['zID'];
	$zName = $_POST ['zName'];
	$existSql = "select * from a_zFormatInfo where zName like '$zName' and zID not like '$zID'";
	$existRet = $pdo->query ( $existSql );
	$existRowCount = $existRet->rowCount ();
	if ($existRowCount > 0) {
		$errMsg = "已经存在账套名为: " . $zName . " ,请更换账套名";
	} else {
		foreach ( $_POST ['fieldName'] as $field => $fieldName ) {
			$fieldNameStr .= '"' . $field . '"=>"' . $fieldName . '",';
		}
		$fieldNameStr = rtrim ( $fieldNameStr );
		foreach ( $_POST ['index'] as $indexKey => $indexVal ) {
			if ($indexVal) {
				$indexVal = trim ( $indexVal );
				$indexStr .= '"' . $indexKey . '"=>"' . $indexVal . '",';
			}
		}
		$indexStr = rtrim ( $indexStr, "," );
		$modifyTime = date ( "Y-m-d H:i:s", $time );
		$updateArr = array (
				"zName" => $zName,
				"field" => $fieldNameStr,
				"zIndex" => $indexStr,
				"mID" => $mID,
				"modifyTime" => $modifyTime 
		);
		
		//构成生成工资帐套SQL
		foreach ( $updateArr as $uK => $uV ) {
			$updateStr .= "`" . $uK . "`='" . $uV . "',";
		}
		$updateStr = rtrim ( $updateStr, "," );
		$updateSql = " update a_zFormatInfo set " . $updateStr . " where zID like '$zID'";
		//update sql
		$actionSql [0] = $updateSql;
		$result = transaction ( $pdo, $actionSql );
		$errMsg = $result ['error'];
	}
	if (empty ( $errMsg )) {
		$succMsg = "成功生成工资账套: " . $zName;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#账套启用及失效
if ($_POST ['btn'] == 'zFAction') {
	list ( $zID, $field, $status ) = explode ( "|", $_POST ['zID'] );
	$updateSql = "update a_zFormatInfo set `$field`='$status' where `zID`='$zID'";
	$actionSql [0] = $updateSql;
	$result = transaction ( $pdo, $actionSql );
	$errMsg = $result ['error'];
	if (empty ( $errMsg )) {
		$succMsg = "操作成功";
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#删除公式
if ($_POST ['btn'] == 'deleteFormulas') {
	$unitID = $_POST ['unitID'];
	$month = $_POST ['month'];
	switch ($_POST ['type']) {
		case "mulFee" :
			$extraBatch = $_POST ['extraBatch'];
			$sql = "delete from a_otherFormulas where `month` like '$month' and `unitID` like '$unitID'and extraBatch='$extraBatch' and type='4'";
			break;
		default :
			$sql = "delete from a_zFormulas where `month` like '$month' and `unitID` like '$unitID'";
			break;
	}
	if ($pdo->query ( $sql )) {
		$succMsg = "删除成功";
	} else {
		$errMsg = "发生未知错误,请联系管理员";
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#设置费用表公式
if ($_POST ['btn'] == 'subFormulas') {
	//不能是这些数据库字段中的某一个
	$validArr = array (
			'radix',
			'pSoIns',
			'uSoIns',
			'uPDIns',
			'pComIns',
			'uComIns',
			'managementCost',
			'helpCost' 
	);
	$unitID = $_POST ['unitID'];
	$month = $_POST ['month'];
	$formulas = $_POST ['formulas'];
	$formulasID = $_POST ['ID'];
	$zID = $_POST ['zID'];
	$extraBatch = $_POST ['extraBatch'];
	$payFormulas = $formulas ['pay'];
	$ratalFormulas = $formulas ['ratal'];
	$acheiveFormulas = $formulas ['acheive'];
	$uAccountFormulas = $formulas ['uAccount'];
	$totalFeeFormulas = $formulas ['totalFee'];
	$sIncomeFormulas = $formulas ['sIncome'];
	$sExpenditureFormulas = $formulas ['sExpenditure'];
	$sOtherFeeFormulas = $formulas ['sOtherFee'];
	preg_match_all ( "/[a-zA-Z]+/", $totalFeeFormulas, $otherCostsStr );
	$totalFeeValid = array_intersect ( $validArr, $otherCostsStr [0] );
	//	$uFeeSpFormulas = $formulas['uFeeSp'];
	$payValid = validFormulas ( $payFormulas );
	$ratalValid = validFormulas ( $ratalFormulas );
	
	if ($payValid)
		$errMsg = $payValid;
	if ($ratalValid)
		$errMsg = $ratalValid;
	if ($totalFeeValid)
		$errMsg = "总费用运算公式中,存在非法项,请联系管理员查证";
	if (! $errMsg) {
		switch ($_POST ['type']) {
			case "salary" :
				$exSql = "select * from `a_zFormulas` where `ID`='$formulasID'";
				$exRet = SQL ( $pdo, $exSql, null, "one" );
				if ($exRet ['ID'])
					$sql = "update a_zFormulas set ratalFormulas='$ratalFormulas',acheiveFormulas='$acheiveFormulas' where ID like '$formulasID'";
				else
					$sql = "insert into `a_zFormulas` set `zID`='$zID',ratalFormulas='$ratalFormulas',acheiveFormulas='$acheiveFormulas',`unitID`='$unitID',`month`='$month'";
				break;
			case "fee" :
				$exSql = "select * from `a_zFormulas` where `ID`='$formulasID'";
				$exRet = SQL ( $pdo, $exSql, null, "one" );
				if ($exRet ['ID'])
					$sql = "update a_zFormulas set payFormulas= '$payFormulas',uAccountFormulas='$uAccountFormulas',`totalFeeFormulas`='$totalFeeFormulas'  where ID like '$formulasID'";
				else
					$sql = "insert into `a_zFormulas` set `zID`='$zID', payFormulas= '$payFormulas',uAccountFormulas='$uAccountFormulas',`totalFeeFormulas`='$totalFeeFormulas',`unitID`='$unitID',`month`='$month'";
				break;
			case "mulSalary" :
				$exSql = "select * from `a_otherFormulas` where `ID`='$formulasID'";
				$exRet = SQL ( $pdo, $exSql, null, "one" );
				if ($exRet ['ID'])
					$sql = "update a_otherFormulas set ratalFormulas='$ratalFormulas',acheiveFormulas='$acheiveFormulas' where ID like '$formulasID'";
				else
					$sql = "insert into `a_ohterFormulas` set `zID`='$zID',ratalFormulas='$ratalFormulas',acheiveFormulas='$acheiveFormulas',`unitID`='$unitID',`month`='$month',`extraBatch`='$extraBatch',`type`='4'";
				break;
			case "mulFee" :
				$exSql = "select * from `a_otherFormulas` where `ID`='$formulasID'";
				$exRet = SQL ( $pdo, $exSql, null, "one" );
				if ($exRet ['ID'])
					$sql = "update a_otherFormulas set payFormulas= '$payFormulas',uAccountFormulas='$uAccountFormulas',`totalFeeFormulas`='$totalFeeFormulas'  where ID like '$formulasID'";
				else
					$sql = "insert into `a_otherFormulas` set `zID`='$zID', payFormulas= '$payFormulas',uAccountFormulas='$uAccountFormulas',`totalFeeFormulas`='$totalFeeFormulas',`unitID`='$unitID',`month`='$month',`extraBatch`='$extraBatch',`type`='4'";
				break;
			case "ledger" :
				$exSql = "select * from `a_zFormulas` where `ID`='$formulasID'";
				$exRet = SQL ( $pdo, $exSql, null, "one" );
				if ($exRet ['ID'])
					$sql = "update a_zFormulas set sIncomeFormulas= '$sIncomeFormulas',sExpenditureFormulas='$sExpenditureFormulas',`sOtherFeeFormulas`='$sOtherFeeFormulas'  where ID like '$formulasID'";
				else
					$sql = "insert into `a_zFormulas` set `zID`='$zID', sIncomeFormulas= '$sIncomeFormulas',sExpenditureFormulas='$sExpenditureFormulas',`sOtherFeeFormulas`='$sOtherFeeFormulas',`unitID`='$unitID',`month`='$month'";
				break;
			case "dimissionSalary" :
				unset ( $exRet );
				$exSql = "select * from `a_otherFormulas` where `ID`='$formulasID'";
				$exRet = SQL ( $pdo, $exSql, null, "one" );
				if ($exRet ['ID'])
					$sql = "update a_otherFormulas set `payFormulas`= '$payFormulas',`ratalFormulas`='$ratalFormulas',`acheiveFormulas`='$acheiveFormulas',`totalFeeFormulas`='$totalFeeFormulas'  where ID like '$formulasID'";
				else
					$sql = "insert into `a_otherFormulas` set `zID`='$zID',`extraBatch`='$extraBatch', `type`='2',`payFormulas`= '$payFormulas',`ratalFormulas`='$ratalFormulas',`acheiveFormulas`='$acheiveFormulas',`totalFeeFormulas`='$totalFeeFormulas',`unitID`='$unitID',`month`='$month'";
				break;
		}
		//        echo $sql;
		if ($pdo->query ( $sql )) {
			$succMsg = "公式设置成功";
		} else {
			$errMsg = "发生未知错误,请联系管理员";
		}
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#调整工资发放表;
if ($_POST ['btn'] == "editSalaryBtn" && $_POST ['type'] == "salary") {
	$sql = "update a_salary_tmp set sponsorName='$mName',lastModifyTime='$now' ,";
	$month = $_POST ['month'];
	foreach ( $_POST ['editSalaryCheck'] as $cv ) {
		if ($_POST ['pSoIns'] [$cv] < 0 || $_POST ['pHF'] [$cv] < 0 || $_POST ['pComIns'] [$cv] < 0 || $_POST ['helpCost'] [$cv] < 0) {
			$errMsg [] = "应收费用不能是负数!";
		} else {
			$name = $_POST ['name'] [$cv];
			$radix = $_POST ['radix'] [$cv];
			$pSoIns = $_POST ['pSoIns'] [$cv];
			$pHF = $_POST ['pHF'] [$cv];
			$pComIns = $_POST ['pComIns'] [$cv];
			$helpCost = $_POST ['helpCost'] [$cv];
			$utilities = $_POST ['utilities'] [$cv];
			$cardMoney = $_POST ['cardMoney'] [$cv];
			$pSoInsMoney = $_POST ['pSoInsMoney'] [$cv];
			$pHFMoney = $_POST ['pHFMoney'] [$cv];
			$upSql [] = $sql . " name='$name',pSoIns='$pSoIns',pHF='$pHF',pComIns='$pComIns',helpCost='$helpCost',`cardMoney`='$cardMoney',utilities='$utilities' ,`pSoInsMoney`='$pSoInsMoney',`pHFMoney`='$pHFMoney'  where ID = '$cv'";
		}
	}
	if (! $errMsg) {
		$result = transaction ( $pdo, $upSql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "设置成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "/n";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#设置待发工资
if ($_POST ['btn'] == "setWait") {
	switch ($_POST ['type']) {
		case "salary" :
			$sql = "update a_originalFee set salaryStatus='0'";
			break;
		case "mulSalary" :
			$sql = "update a_mul_originalFee set salaryStatus='0'";
			break;
	}
	foreach ( $_POST ['salarySetCheck'] as $cV ) {
		$salaryProvideDate = $_POST ['salaryProvideDate'] [$cV];
		if (! isDate ( $salaryProvideDate, "Y-m-d" ) || strtotime ( $salaryProvideDate ) < $time) {
			$errMsg [] = "发放日期有误,请更正(错误代码:<$salaryProvideDate>";
		} else {
			$upSql [] = $sql . " , salaryProvideDate='$salaryProvideDate',sponsorName='$mName',sponsorTime='$now' where ID like '$cV' ";
		}
	}
	if (! $errMsg) {
		$result = transaction ( $pdo, $upSql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "设置成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "/n";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#取消待发工资
if ($_POST ['btn'] == "cancelWait" && $_POST ['type'] == "salary") {
	$sql = "update a_originalFee set salaryStatus='1'";
	foreach ( $_POST ['salarySetCheck'] as $cV ) {
		$upSql [] = $sql . " , sponsorName='$mName',sponsorTime='$now' where ID like '$cV'";
	}
	if (! $errMsg) {
		$result = transaction ( $pdo, $upSql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "设置成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "/n";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}

#设置欠/挂记录
if ($_POST ['btn'] == "setMoney") {
	$month = $_POST ['month'];
	$unitID = $_POST ['unitID'];
	$sql = "update a_fee_tmp set sponsorName='$mName',lastModifyTime='$now' ,";
	$iReSql = "insert into a_prsrequiremoney set sponsorName='$mName',sponsorTime='$now' ,status='0',unitID='$unitID',`extraBatch`='0',";
	$uReSql = "update a_prsrequiremoney set sponsorName='$mName',sponsorTime='$now' ,status='0',";
	$checkName = $_POST ['type'] . 'EditFeeCheck';
	foreach ( $_POST [$checkName] as $cv ) {
		if ($_POST ['uSoInsS'] [$cv] < 0 || $_POST ['uHFS'] [$cv] < 0 || $_POST ['uComInsS'] [$cv] < 0 || $_POST ['managementCostS'] [$cv] < 0) {
			$errMsg [] = "应收费用不能是负数!";
		} else {
			$selStr .= "'" . $cv . "',";
			$str = $str1 = $str2 = $str3 = $str4 = null;
			$st1 = "type='1',";
			$st2 = "type='2',";
			$st3 = "type='3',";
			switch ($_POST ['type']) {
				case "uSoIns" :
					$uSoInsS = $_POST ['uSoInsS'] [$cv];
					$uSoInsMoney = $_POST ['uSoInsMoney'] [$cv];
					$curUSoInsMoney = $_POST ['soInsMargin'] [$cv];
					$upSql [] = $sql . "uSoInsS='$uSoInsS'  where uID like '$cv' and unitID='$unitID'  and month like '$month' and `extraBatch`='0'";
					if ($curUSoInsMoney > 0)
						$str1 .= "uSoInsMoney='$curUSoInsMoney',";
					elseif ($curUSoInsMoney < 0)
						$str2 .= "uSoInsMoney='$curUSoInsMoney',";
					else
						$str4 .= "uSoInsMoney='$curUSoInsMoney',";
					$str3 .= "`uSoInsMoney`='$uSoInsMoney',";
					break;
				case "uHF" :
					$uHFS = $_POST ['uHFS'] [$cv];
					$uHFMoney = $_POST ['uHFMoney'] [$cv];
					$curUHFMoney = $_POST ['HFMargin'] [$cv];
					$upSql [] = $sql . "uHFS='$uHFS'  where uID like '$cv' and unitID='$unitID'  and month like '$month' and `extraBatch`='0'";
					if ($curUHFMoney > 0)
						$str1 .= "uHFMoney='$curUHFMoney',";
					elseif ($curUHFMoney < 0)
						$str2 .= "uHFMoney='$curUHFMoney',";
					else
						$str4 .= "uHFMoney='$curUHFMoney',";
					$str3 .= "`uHFMoney`='$uHFMoney',";
					break;
				case "uComIns" :
					$uComInsS = $_POST ['uComInsS'] [$cv];
					$uComInsMoney = $_POST ['uComInsMoney'] [$cv];
					$curUComInsMoney = $_POST ['comInsMargin'] [$cv];
					$upSql [] = $sql . "uComInsS='$uComInsS'  where uID like '$cv' and unitID='$unitID'  and month like '$month' and `extraBatch`='0'";
					if ($curUComInsMoney > 0)
						$str1 .= "uComInsMoney='$curUComInsMoney',";
					elseif ($curUComInsMoney < 0)
						$str2 .= "uComInsMoney='$curUComInsMoney',";
					else
						$str4 .= "uComInsMoney='$curUComInsMoney',";
					$str3 .= "`uComInsMoney`='$uComInsMoney',";
					break;
				case "mCost" :
					$managementCostMoney = $_POST ['managementCostMoney'] [$cv];
					$managementCostS = $_POST ['managementCostS'] [$cv];
					$curManagementCostMoney = $_POST ['managementCostMargin'] [$cv];
					$upSql [] = $sql . "managementCostS='$managementCostS'   where uID like '$cv'  and unitID='$unitID'  and month like '$month' and `extraBatch`='0'";
					if ($curManagementCostMoney > 0)
						$str1 .= "managementCostMoney='$curManagementCostMoney',";
					elseif ($curManagementCostMoney < 0)
						$str2 .= "managementCostMoney='$curManagementCostMoney',";
					else
						$str4 .= "managementCostMoney='$curManagementCostMoney',";
					$str3 .= "`managementCostMoney`='$managementCostMoney',";
					break;
				case "uPDIns" :
					$uPDInsS = $_POST ['uPDInsS'] [$cv];
					$uPDInsMoney = $_POST ['uPDInsMoney'] [$cv];
					$curUPDInsMoney = $_POST ['PDInsMargin'] [$cv];
					$upSql [] = $sql . "uPDInsS='$uPDInsS'  where uID like '$cv' and unitID='$unitID'  and month like '$month' and `extraBatch`='0'";
					if ($curUPDInsMoney > 0)
						$str1 .= "uPDInsMoney='$curUPDInsMoney',";
					elseif ($curUPDInsMoney < 0)
						$str2 .= "uPDInsMoney='$curUPDInsMoney',";
					else
						$str4 .= "uPDInsMoney='$curUPDInsMoney',";
					$str3 .= "`uPDInsMoney`='$uPDInsMoney',";
					break;
			}
			
			if ($str1)
				$upReSql1 [$cv] = $st1 . $str1;
			if ($str2)
				$upReSql2_1 [$cv] = $str2;
			if ($str3)
				$upReSql3 [$cv] = $st3 . $str3;
			if ($str4)
				$upReSql4 [$cv] = $str4;
			$upReSql2 [$cv] .= $st2 . $upReSql2_1 [$cv];
		}
	}
	//	print_r ( $upReSql1 );
	$selStr = rtrim ( $selStr, "," );
	$selSql = "select * from a_prsrequiremoney where uID in ($selStr) and month like '$month' and unitID like '$unitID' and type in ('1','2','3')";
	$selRes = $pdo->query ( $selSql );
	if ($selRes) {
		$selRet = $selRes->fetchAll ( PDO::FETCH_ASSOC );
		foreach ( $selRet as $sv ) {
			if ($sv ['type'] == "1" && $upReSql1 [$sv ['uID']]) {
				$uSql1 [$sv ['uID']] = $uReSql . rtrim ( $upReSql1 [$sv ['uID']], "," ) . " where `ID`=" . $sv ['ID'];
				unset ( $upReSql1 [$sv ['uID']] );
			}
			if ($sv ['type'] == "2" && $upReSql2 [$sv ['uID']]) {
				$uSql2 [$sv ['uID']] = $uReSql . rtrim ( $upReSql2 [$sv ['uID']], "," ) . " where `ID`=" . $sv ['ID'];
				unset ( $upReSql2 [$sv ['uID']] );
			}
			if ($sv ['type'] == "3" && $upReSql3 [$sv ['uID']]) {
				$uSql3 [$sv ['uID']] = $uReSql . rtrim ( $upReSql3 [$sv ['uID']], "," ) . " where`ID`=" . $sv ['ID'];
				unset ( $upReSql3 [$sv ['uID']] );
			}
			if (($sv ['type'] == "1" || $sv ['type'] == "2") && $upReSql4 [$sv ['uID']]) {
				$uSql4 [$sv ['uID']] = "update a_prsrequiremoney set sponsorName='$mName',sponsorTime=date_add('$now', INTERVAL 1 SECOND) ,status='0'," . rtrim ( $upReSql4 [$sv ['uID']], "," ) . " where uID like '$sv[uID]' and month like '$month' and `extraBatch`='0' and type in ('1','2')";
				unset ( $upReSql4 [$sv ['uID']] );
			}
		}
	}
	if ($upReSql1) {
		foreach ( $upReSql1 as $uk1 => $uv1 ) {
			$iSql1 [] = $iReSql . $uv1 . "`uID` ='$uk1',`month`='$month'";
		}
	}
	if ($upReSql2) {
		foreach ( $upReSql2 as $uk2 => $uv2 ) {
			if (! $upReSql2_1 [$uk2] && $_POST ['uPDInsMoneyTotal'] [$uk2] == 0 && $_POST ['uSoInsMoneyTotal'] [$uk2] == 0 && $_POST ['uHFMoneyTotal'] [$uk2] == 0 && $_POST ['uComInsMoneyTotal'] [$uk2] == 0 && $_POST ['managementCostMoneyTotal'] [$uk2] == 0) {
				$iSql2 [] = null;
			} else {
				$iSql2 [] = $iReSql . $uv2 . "`uID` ='$uk2',`month`='$month'";
			}
		}
	}
	if ($upReSql3) {
		foreach ( $upReSql3 as $uk3 => $uv3 ) {
			if ($_POST ['uPDInsMoney'] [$uk3] == 0 && $_POST ['uSoInsMoney'] [$uk3] == 0 && $_POST ['uHFMoney'] [$uk3] == 0 && $_POST ['uComInsMoney'] [$uk3] == 0 && $_POST ['managementCostMoney'] [$uk3] == 0) {
				$iSql3 [] = null;
			} else {
				$iSql3 [] = $iReSql . $uv3 . "`uID` ='$uk3',`month`='$month'";
			}
		}
	}
	delPrsMoney ( $pdo );
	$actionSql = mergeArray ( mergeArray ( $uSql1, $uSql2, $uSql3, $uSql4 ), $iSql1, $iSql2, $iSql3, $upSql );
	$actionSql = array_filter ( $actionSql );
	if (! $errMsg) {
		$result = extraTransaction ( $pdo, $actionSql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "设置成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "/n";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#设置欠/挂记录(多次工资费用)
if ($_POST ['btn'] == "setMoney_mul") {
	$month = $_POST ['month'];
	$unitID = $_POST ['unitID'];
	$extraBatch = $_POST ['extraBatch'];
	$sql = "update a_fee_tmp set sponsorName='$mName',lastModifyTime='$now' ,";
	$iReSql = "insert into a_prsrequiremoney set sponsorName='$mName',sponsorTime='$now' ,status='0',unitID='$unitID',`extraBatch`='$extraBatch',";
	$uReSql = "update a_prsrequiremoney set sponsorName='$mName',sponsorTime='$now' ,status='0',";
	$checkName = $_POST ['type'] . 'EditFeeCheck';
	foreach ( $_POST [$checkName] as $cv ) {
		if ($_POST ['uSoInsS'] [$cv] < 0 || $_POST ['uHFS'] [$cv] < 0 || $_POST ['uComInsS'] [$cv] < 0 || $_POST ['managementCostS'] [$cv] < 0) {
			$errMsg [] = "应收费用不能是负数!";
		} else {
			$selStr .= "'" . $cv . "',";
			$str = $str1 = $str2 = $str3 = $str4 = null;
			$st1 = "type='1',";
			$st2 = "type='2',";
			$st3 = "type='3',";
			switch ($_POST ['type']) {
				case "uSoIns" :
					$uSoInsS = $_POST ['uSoInsS'] [$cv];
					$uSoInsMoney = $_POST ['uSoInsMoney'] [$cv];
					$curUSoInsMoney = $_POST ['soInsMargin'] [$cv];
					$upSql [] = $sql . "uSoInsS='$uSoInsS'  where uID like '$cv' and unitID='$unitID'  and month like '$month' and `extraBatch`='$extraBatch'";
					if ($curUSoInsMoney > 0)
						$str1 .= "uSoInsMoney='$curUSoInsMoney',";
					elseif ($curUSoInsMoney < 0)
						$str2 .= "uSoInsMoney='$curUSoInsMoney',";
					else
						$str4 .= "uSoInsMoney='$curUSoInsMoney',";
					$str3 .= "`uSoInsMoney`='$uSoInsMoney',";
					break;
				case "uHF" :
					$uHFS = $_POST ['uHFS'] [$cv];
					$uHFMoney = $_POST ['uHFMoney'] [$cv];
					$curUHFMoney = $_POST ['HFMargin'] [$cv];
					$upSql [] = $sql . "uHFS='$uHFS'  where uID like '$cv' and unitID='$unitID'  and month like '$month'  and `extraBatch`='$extraBatch'";
					if ($curUHFMoney > 0)
						$str1 .= "uHFMoney='$curUHFMoney',";
					elseif ($curUHFMoney < 0)
						$str2 .= "uHFMoney='$curUHFMoney',";
					else
						$str4 .= "uHFMoney='$curUHFMoney',";
					$str3 .= "`uHFMoney`='$uHFMoney',";
					break;
				case "uComIns" :
					$uComInsS = $_POST ['uComInsS'] [$cv];
					$uComInsMoney = $_POST ['uComInsMoney'] [$cv];
					$curUComInsMoney = $_POST ['comInsMargin'] [$cv];
					$upSql [] = $sql . "uComInsS='$uComInsS'  where uID like '$cv' and unitID='$unitID'  and month like '$month'  and `extraBatch`='$extraBatch'";
					if ($curUComInsMoney > 0)
						$str1 .= "uComInsMoney='$curUComInsMoney',";
					elseif ($curUComInsMoney < 0)
						$str2 .= "uComInsMoney='$curUComInsMoney',";
					else
						$str4 .= "uComInsMoney='$curUComInsMoney',";
					$str3 .= "`uComInsMoney`='$uComInsMoney',";
					break;
				case "mCost" :
					$managementCostMoney = $_POST ['managementCostMoney'] [$cv];
					$managementCostS = $_POST ['managementCostS'] [$cv];
					$curManagementCostMoney = $_POST ['managementCostMargin'] [$cv];
					$upSql [] = $sql . "managementCostS='$managementCostS'   where uID like '$cv'  and unitID='$unitID'  and month like '$month'  and `extraBatch`='$extraBatch'";
					if ($curManagementCostMoney > 0)
						$str1 .= "managementCostMoney='$curManagementCostMoney',";
					elseif ($curManagementCostMoney < 0)
						$str2 .= "managementCostMoney='$curManagementCostMoney',";
					else
						$str4 .= "managementCostMoney='$curManagementCostMoney',";
					$str3 .= "`managementCostMoney`='$managementCostMoney',";
					break;
				case "uPDIns" :
					$uPDInsS = $_POST ['uPDInsS'] [$cv];
					$uPDInsMoney = $_POST ['uPDInsMoney'] [$cv];
					$curUPDInsMoney = $_POST ['PDInsMargin'] [$cv];
					$upSql [] = $sql . "uPDInsS='$uPDInsS'  where uID like '$cv' and unitID='$unitID'  and month like '$month'  and `extraBatch`='$extraBatch'";
					if ($curUPDInsMoney > 0)
						$str1 .= "uPDInsMoney='$curUPDInsMoney',";
					elseif ($curUPDInsMoney < 0)
						$str2 .= "uPDInsMoney='$curUPDInsMoney',";
					else
						$str4 .= "uPDInsMoney='$curUPDInsMoney',";
					$str3 .= "`uPDInsMoney`='$uPDInsMoney',";
					break;
			}
			
			if ($str1)
				$upReSql1 [$cv] = $st1 . $str1;
			if ($str2)
				$upReSql2_1 [$cv] = $str2;
			if ($str3)
				$upReSql3 [$cv] = $st3 . $str3;
			if ($str4)
				$upReSql4 [$cv] = $str4;
			$upReSql2 [$cv] .= $st2 . $upReSql2_1 [$cv];
		}
	}
	//	print_r ( $upReSql1 );
	$selStr = rtrim ( $selStr, "," );
	$selSql = "select * from a_prsrequiremoney where uID in ($selStr) and month like '$month' and unitID like '$unitID'  and `extraBatch`='$extraBatch' and type in ('1','2','3')";
	$selRes = $pdo->query ( $selSql );
	if ($selRes) {
		$selRet = $selRes->fetchAll ( PDO::FETCH_ASSOC );
		foreach ( $selRet as $sv ) {
			if ($sv ['type'] == "1" && $upReSql1 [$sv ['uID']]) {
				$uSql1 [$sv ['uID']] = $uReSql . rtrim ( $upReSql1 [$sv ['uID']], "," ) . " where `ID`=" . $sv ['ID'];
				unset ( $upReSql1 [$sv ['uID']] );
			}
			if ($sv ['type'] == "2" && $upReSql2 [$sv ['uID']]) {
				$uSql2 [$sv ['uID']] = $uReSql . rtrim ( $upReSql2 [$sv ['uID']], "," ) . " where `ID`=" . $sv ['ID'];
				unset ( $upReSql2 [$sv ['uID']] );
			}
			if ($sv ['type'] == "3" && $upReSql3 [$sv ['uID']]) {
				$uSql3 [$sv ['uID']] = $uReSql . rtrim ( $upReSql3 [$sv ['uID']], "," ) . " where `ID`=" . $sv ['ID'];
				unset ( $upReSql3 [$sv ['uID']] );
			}
			if (($sv ['type'] == "1" || $sv ['type'] == "2") && $upReSql4 [$sv ['uID']]) {
				$uSql4 [$sv ['uID']] = "update a_prsrequiremoney set sponsorName='$mName',sponsorTime=date_add('$now', INTERVAL 1 SECOND) ,status='0'," . rtrim ( $upReSql4 [$sv ['uID']], "," ) . " where uID like '$sv[uID]' and month like '$month'  and `extraBatch`='$extraBatch' and type in ('1','2')";
				unset ( $upReSql4 [$sv ['uID']] );
			}
		}
	}
	if ($upReSql1) {
		foreach ( $upReSql1 as $uk1 => $uv1 ) {
			$iSql1 [] = $iReSql . $uv1 . "`uID` ='$uk1',`month`='$month'";
		}
	}
	if ($upReSql2) {
		foreach ( $upReSql2 as $uk2 => $uv2 ) {
			if (! $upReSql2_1 [$uk2] && $_POST ['uPDInsMoneyTotal'] [$uk2] == 0 && $_POST ['uSoInsMoneyTotal'] [$uk2] == 0 && $_POST ['uHFMoneyTotal'] [$uk2] == 0 && $_POST ['uComInsMoneyTotal'] [$uk2] == 0 && $_POST ['managementCostMoneyTotal'] [$uk2] == 0) {
				$iSql2 [] = null;
			} else {
				$iSql2 [] = $iReSql . $uv2 . "`uID` ='$uk2',`month`='$month'";
			}
		}
	}
	if ($upReSql3) {
		foreach ( $upReSql3 as $uk3 => $uv3 ) {
			if ($_POST ['uPDInsMoney'] [$uk3] == 0 && $_POST ['uSoInsMoney'] [$uk3] == 0 && $_POST ['uHFMoney'] [$uk3] == 0 && $_POST ['uComInsMoney'] [$uk3] == 0 && $_POST ['managementCostMoney'] [$uk3] == 0) {
				$iSql3 [] = null;
			} else {
				$iSql3 [] = $iReSql . $uv3 . "`uID` ='$uk3',`month`='$month'";
			}
		}
	}
	delPrsMoney ( $pdo );
	$actionSql = mergeArray ( mergeArray ( $uSql1, $uSql2, $uSql3, $uSql4 ), $iSql1, $iSql2, $iSql3, $upSql );
	$actionSql = array_filter ( $actionSql );
	if (! $errMsg) {
		$result = extraTransaction ( $pdo, $actionSql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "设置成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "/n";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#删除欠款/挂账/冲减/收回欠款记录
if ($_POST ['btn'] == "delPrsReBtn") {
	$ID = $_POST ['ID'];
	$sql [0] = "delete from `a_prsRequireMoney` where `ID` like '$ID'";
	$result = transaction ( $pdo, $sql );
	// print_r($sql);
	$errMsg ['sql'] = $result ['error'];
	if (empty ( $errMsg ['sql'] )) {
		$succMsg = "删除成功";
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#修改欠/挂/冲减明细
if ($_POST ['btn'] == "prsReBtn") {
	list ( $field, $uID, $type ) = explode ( "|", $_POST ['field'] );
	$fieldVal = $_POST ['value'] ? $_POST ['value'] : 0;
	$month = $_POST ['month'];
	if (! is_numeric ( $fieldVal )) {
		$errMsg [] = "请输入数字";
	}
	if ($type == "1" && $fieldVal < 0) {
		$errMsg [] = "输入的值不能是负数";
	}
	//	if ($type == "3") {
	//		$errMsg [] = "请修改应收费用或重新填写垫付申请";
	//	}
	//	if ($type == "4") {
	//		$errMsg [] = "请重新申请冲减挂账";
	//	}
	if (($type == "2") && $fieldVal > 0) {
		$errMsg [] = "输入的值不能是正数";
	}
	//	if ($field == "uAccount") {
	//		$errMsg [] = "单位挂账(指定费用)不可修改";
	//	}
	//	if ($field == "pSoInsMoney") {
	//		$errMsg [] = "个人的社保费用不可修改";
	//	}
	if ($field == "soInsCardMoney" || $field == "residentCardMoney") {
		$errMsg [] = "制卡费只能由制卡相关人员修改";
	}
	if (! $errMsg) {
		$reSql = "update `a_prsrequiremoney` set `sponsorTime`='$now',`sponsorName`='$mName',`$field`='$fieldVal',`status`='0' where `uID` like '$uID' and `month` like '$month' and type='$type'";
		if ($type == "2") {
			if ($field == "pSoInsMoney" or $field == "pComInsMoney") {
				$reSql = "update `a_prsrequiremoney` set `sponsorTime`='$now',`sponsorName`='$mName',`$field`=$fieldVal,`status`='0' where `uID` like '$uID' and `month` like '$month' and type='$type'";
			} else {
				//当修改的是欠款部分,则一并修改累计欠款问题				
				$reSql = "update `a_prsrequiremoney` set `sponsorTime`='$now',`sponsorName`='$mName',`$field`=$fieldVal,`status`='0' where `uID` like '$uID' and `month` like '$month' and type='$type'";
			}
		}
		$sql [0] = $reSql;
		$result = transaction ( $pdo, $sql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "修改成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#设置社保基数,商保基数,互助会费
if ($_POST ['btn'] == "changeRadix" && $_POST ['type'] = "fee") {
	$month = $_POST ['month'];
	$unitID = $_POST ['unitID'];
	$selSql = "select * from a_changeRadix_tmp where month like '$month' and unitID like '$unitID'";
	$res = $pdo->query ( $selSql );
	$rCount = $res->rowCount ();
	foreach ( $_POST as $k => $v ) {
		switch ($k) {
			case "societyAvg" :
			case "pComInsMoneyRadix" :
			case "uComInsMoneyRadix" :
			case "helpCost" :
				if (! $v) {
					$v = 0;
				} elseif (! is_numeric ( $v )) {
					$errMsg [] = "修改失败!!!请输入数字";
				}
				$str .= "`" . $k . "`='" . $v . "',";
				break;
		}
	}
	if (! $errMsg) {
		if ($rCount > 0) {
			$str = rtrim ( $str, "," );
			$sql [0] = "update a_changeRadix_tmp set " . $str . " where month like '$month' and unitID like '$unitID'";
		} else {
			$sql [0] = "insert into  a_changeRadix_tmp set " . $str . " month = '$month' , unitID= '$unitID'";
		}
		$result = transaction ( $pdo, $sql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "修改成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#删除,原始费用表
if ($_POST ['btn'] == "delOriginalFeeBtn" && $_POST ['type'] = "fee") {
	if ($_POST ['feeCheck']) {
		list ( $month, $unitID ) = explode ( "|", $_POST ['feeCheck'] );
		$sql [] = "delete from `a_originalFee_tmp` where `month` like '$month' and `unitID` like '$unitID' ";
		$sql [] = "delete from `a_fee_tmp` where `month` like '$month' and `unitID` like '$unitID' and `extraBatch`='0'";
		$sql [] = "delete from `a_salary_tmp` where `month` like '$month' and `unitID` like '$unitID' and extraBatch='0' ";
        $sql [] = "delete from `a_prsrequiremoney_tmp` where `month` like '$month' and `unitID` like '$unitID' and extraBatch='0' ";
	}
	if ($_POST ['mulFeeCheck'])
		foreach ( $_POST ['mulFeeCheck'] as $val ) {
			$month = $unitID = $extraBatch = null;
			list ( $month, $unitID, $extraBatch ) = explode ( "|", $val );
			$sql [] = "delete from `a_mul_originalFee_tmp` where `month` like '$month' and `unitID` like '$unitID' and `extraBatch` like '$extraBatch' ";
			$sql [] = "delete from `a_fee_tmp` where `month` like '$month' and `unitID` like '$unitID' and extraBatch='$extraBatch' ";
			$sql [] = "delete from `a_salary_tmp` where `month` like '$month' and `unitID` like '$unitID' and extraBatch='$extraBatch' ";
            $sql [] = "delete from `a_prsrequiremoney_tmp` where `month` like '$month' and `unitID` like '$unitID' and extraBatch='$extraBatch'  ";
        }
		//    print_r($sql);
	$result = extraTransaction ( $pdo, $sql );
	$errMsg ['sql'] = $result ['error'];
	if (empty ( $errMsg ['sql'] )) {
		$succMsg = "删除成功";
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#删除费用表 a_oiginalFee ,临时费用表 a_fee_tmp ,欠挂记录表 a_prsRequireMoney
if ($_POST ['btn'] == "delFeeBtn" && $_POST ['type'] = "fee") {
	if ($_POST ['feeCheck']) {
		list ( $month, $unitID ) = explode ( "|", $_POST ['feeCheck'] );
		//删除临时费用表
		$sql [0] = "delete from a_originalFee where month like '$month' and unitID like '$unitID'";
		$sql [1] = "delete from a_fee_tmp  where month like '$month' and unitID like '$unitID' and extraBatch='0' ";
		//删除临时工资表
		$sql [2] = "delete from a_salary_tmp  where month like '$month' and unitID like '$unitID' and extraBatch='0' ";
		//删除挂账,及收回欠款记录,
		$sql [3] = "delete a.* from a_prsRequireMoney a  where a.unitID like '$unitID' and a.month like '$month' and extraBatch='0'  and a.feeType='0'  and (a.type in ('1','3','4') or (a.type=2 and a.soInsCardMoney=0  and a.residentCardMoney=0 and a.uOtherMoney=0 and a.pOtherMoney=0))";
		$sql [4] = "update a_prsRequireMoney a set a.uSoInsMoney=0 ,a.pSoInsMoney=0 , a.uHFMoney=0 ,a.pHFMoney=0 ,a.uComInsMoney=0 ,a.pComInsMoney=0 , a.managementCostMoney=0,a.sponsorName='$mName',a.sponsorTime='$now' where a.unitID like '$unitID' and a.type=2 and a.feeType='0' and a.month like '$month' and a.extraBatch='0'  and (a.soInsCardMoney<>0 or a.residentCardMoney<>0 or a.uOtherMoney<>0 or a.pOtherMoney<>0)";
		//删除调账记录表,平账数据,公司挂账数据;
		$sql [5] = "delete from a_editAccountList where month like '$month' and unitID like '$unitID'";
		//
		$sql [6] = "delete from a_cAccountList where month like '$month' and unitID like '$unitID'";
		//删除审批流程
		$sql [7] = "delete a.*,b.* from a_approval_list a,a_approval_process b where a.month like '$month' and a.unitID like '$unitID' and a.appProID=b.appProID and a.extraBatch like '0' and a.type not in ('dimissionSalary','mulFee') ";
		//删除审批验证
		$sql [8] = "delete from a_valid_approval_finished where month like '$month' and unitID like '$unitID' and extraBatch='0'";
        //删除挂账,及收回欠款记录,临时表
        $sql [9] = "delete a.* from a_prsRequireMoney_tmp a  where a.unitID like '$unitID' and a.month like '$month' and extraBatch='0'  and a.feeType='0'  and (a.type in ('1','3','4') or (a.type=2 and a.soInsCardMoney=0  and a.residentCardMoney=0 and a.uOtherMoney=0 and a.pOtherMoney=0))";
		//删除已平账的登记记录
		$sql [10] = "delete from a_action_record where month like '$month' and unitID like '$unitID'";

    }
	if ($_POST ['mulFeeCheck']) {
		foreach ( $_POST ['mulFeeCheck'] as $val ) {
			$month = $unitID = $extraBatch = null;
			list ( $month, $unitID, $extraBatch ) = explode ( "|", $val );
			$sql [] = "delete from `a_mul_originalFee` where `month` like '$month' and `unitID` like '$unitID' and `extraBatch` like '$extraBatch' ";
			$sql [] = "delete a.*,b.* from a_approval_list a,a_approval_process b where a.month like '$month' and a.unitID like '$unitID' and a.appProID=b.appProID and a.extraBatch like '$extraBatch' and type = 'mulFee'";
			$sql [] = "delete from a_salary_tmp  where month like '$month' and unitID like '$unitID' and extraBatch='$extraBatch'";
			$sql [] = "delete from a_valid_approval_finished where month like '$month' and unitID like '$unitID' and extraBatch='$extraBatch'";
			$sql [] = "delete from a_fee_tmp  where month like '$month' and unitID like '$unitID' and extraBatch='$extraBatch' ";
			$sql [] = "delete a.* from a_prsRequireMoney a  where a.unitID like '$unitID' and a.month like '$month' and extraBatch='$extraBatch'  and a.feeType='0'  and (a.type in ('1','3','4') or (a.type=2 and a.soInsCardMoney=0  and a.residentCardMoney=0 and a.uOtherMoney=0 and a.pOtherMoney=0))";
			$sql [] = "update a_prsRequireMoney a set a.uSoInsMoney=0 ,a.pSoInsMoney=0 , a.uHFMoney=0 ,a.pHFMoney=0 ,a.uComInsMoney=0 ,a.pComInsMoney=0 , a.managementCostMoney=0,a.sponsorName='$mName',a.sponsorTime='$now' where a.unitID like '$unitID' and a.type=2 and a.feeType='0' and a.month like '$month' and a.extraBatch='$extraBatch'  and (a.soInsCardMoney<>0 or a.residentCardMoney<>0 or a.uOtherMoney<>0 or a.pOtherMoney<>0)";
            $sql [] = "update a_prsRequireMoney_tmp a set a.uSoInsMoney=0 ,a.pSoInsMoney=0 , a.uHFMoney=0 ,a.pHFMoney=0 ,a.uComInsMoney=0 ,a.pComInsMoney=0 , a.managementCostMoney=0,a.sponsorName='$mName',a.sponsorTime='$now' where a.unitID like '$unitID' and a.type=2 and a.feeType='0' and a.month like '$month' and a.extraBatch='$extraBatch'  and (a.soInsCardMoney<>0 or a.residentCardMoney<>0 or a.uOtherMoney<>0 or a.pOtherMoney<>0)";
        }
	}
	$result = extraTransaction ( $pdo, $sql );
	//     print_r($sql);
	$errMsg ['sql'] = $result ['error'];
	if (empty ( $errMsg ['sql'] )) {
		$succMsg = "删除成功";
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}

#本人费用不同项目调整申请
if ($_POST ['btn'] == "editAccountMineBtn" && $_POST ['type'] == "fee") {
	$unitID = $_POST ['unitID'];
	$month = $_POST ['month'];
	$actionKey = array_keys ( $_POST ['editAccountCheck'] );
	foreach ( $_POST as $key => $val ) {
		if (is_array ( $val )) {
			foreach ( $val as $k => $v ) {
				if (! in_array ( $k, $actionKey ))
					unset ( $_POST [$key] [$k] );
			}
		}
	}
	$upSql = "update a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',`status`='0',`field`='$field',";
	$iSql = "insert into a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',";
	$sqlStr = null;
	foreach ( $_POST ['editAccountCheck'] as $ck => $cv ) {
		$sA = $hA = $cA = $mA = $uA = $field = null;
		$uIDStr .= "'" . $cv . "',";
		$uPDInsMoney = $_POST ['uPDInsMoney'] [$cv] ? $_POST ['uPDInsMoney'] [$cv] : 0;
		$uSoInsMoney = $_POST ['uSoInsMoney'] [$cv] ? $_POST ['uSoInsMoney'] [$cv] : 0;
		$uHFMoney = $_POST ['uHFMoney'] [$cv] ? $_POST ['uHFMoney'] [$cv] : 0;
		$uComInsMoney = $_POST ['uComInsMoney'] [$cv] ? $_POST ['uComInsMoney'] [$cv] : 0;
		$managementCostMoney = $_POST ['managementCostMoney'] [$cv] ? $_POST ['managementCostMoney'] [$cv] : 0;
		$uOtherMoney = $_POST ['uOtherMoney'] [$cv] ? $_POST ['uOtherMoney'] [$cv] : 0;
		$sA = $_POST ['sA'] [$cv];
		$hA = $_POST ['hA'] [$cv];
		$cA = $_POST ['cA'] [$cv];
		$mA = $_POST ['mA'] [$cv];
		$uA = $_POST ['uA'] [$cv];
		if ($sA)
			$field .= $sA . "|";
		if ($hA)
			$field .= $hA . "|";
		if ($cA)
			$field .= $cA . "|";
		if ($mA)
			$field .= $mA . "|";
		if ($uA)
			$field .= $uA . "|";
		$str = null;
		$str = "`uPDInsMoney`='$uPDInsMoney',`uSoInsMoney`='$uSoInsMoney',`uHFMoney`='$uHFMoney',`uComInsMoney`='$uComInsMoney',`managementCostMoney`='$managementCostMoney',`uOtherMoney`='$uOtherMoney',`field`='$field',";
		$sqlStr [$cv] = $str;
	}
	$uIDStr = rtrim ( $uIDStr, "," );
	$eSql = "select ID,roleA from a_editAccountList where month like '$month' and roleA in ($uIDStr) and type='1'";
	$eRes = $pdo->query ( $eSql );
	$eRow = $eRes->rowCount ();
	if ($eRow > 0) {
		$eRet = $eRes->fetchAll ( PDO::FETCH_ASSOC );
		foreach ( $eRet as $key => $val ) {
			$updateSql [] = $upSql . rtrim ( $sqlStr [$val ['roleA']], "," ) . " where `ID`='$val[ID]'";
			unset ( $sqlStr [$val ['roleA']] );
		}
	} else {
		foreach ( $sqlStr as $key => $val ) {
			$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$key',`type`=1,`status`=0,`unitID`='$unitID'";
			unset ( $sqlStr [$key] );
		}
	}
	if ($sqlStr) {
		foreach ( $sqlStr as $key => $val ) {
			$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$key',`type`=1,`status`=0,`unitID`='$unitID'";
		}
	}
	$actionSql = mergeArray ( $updateSql, $insertSql );
	$result = transaction ( $pdo, $actionSql );
	//	 print_r($actionSql);
	$errMsg ['sql'] = $result ['error'];
	if (empty ( $errMsg ['sql'] )) {
		$succMsg = "提交成功";
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#调账给他人
if ($_POST ['btn'] == "editAccountTheirBtn" && $_POST ['type'] == "fee") {
	$unitID = $_POST ['unitID'];
	$month = $_POST ['month'];
	$actionKey = array_keys ( $_POST ['editAccountCheck'] );
	$roleB = $_POST ['roleB'];
	$sA = $hA = $cA = $mA = $uA = $field = null;
	$sA = $_POST ['sA'] [$roleB];
	$hA = $_POST ['hA'] [$roleB];
	$cA = $_POST ['cA'] [$roleB];
	$mA = $_POST ['mA'] [$roleB];
	$uA = $_POST ['uA'] [$roleB];
	if ($sA)
		$field .= $sA . "|";
	if ($hA)
		$field .= $hA . "|";
	if ($cA)
		$field .= $cA . "|";
	if ($mA)
		$field .= $mA . "|";
	if ($uA)
		$field .= $uA . "|";
	foreach ( $_POST as $key => $val ) {
		if (is_array ( $val )) {
			foreach ( $val as $k => $v ) {
				if (! in_array ( $k, $actionKey ))
					unset ( $_POST [$key] [$k] );
			}
		}
	}
	$upSql = "update a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',`status`='0',`field`='$field',";
	$iSql = "insert into a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',";
	$sqlStr = null;
	foreach ( $_POST ['editAccountCheck'] as $ck => $cv ) {
		$uIDStr .= "'" . $cv . "',";
		$uPDInsMoney = $_POST ['uPDInsMoney'] [$cv] ? $_POST ['uPDInsMoney'] [$cv] : 0;
		$uSoInsMoney = $_POST ['uSoInsMoney'] [$cv] ? $_POST ['uSoInsMoney'] [$cv] : 0;
		$pSoInsMoney = $_POST ['pSoInsMoney'] [$cv] ? $_POST ['pSoInsMoney'] [$cv] : 0;
		$uHFMoney = $_POST ['uHFMoney'] [$cv] ? $_POST ['uHFMoney'] [$cv] : 0;
		$pHFMoney = $_POST ['pHFMoney'] [$cv] ? $_POST ['pHFMoney'] [$cv] : 0;
		$uComInsMoney = $_POST ['uComInsMoney'] [$cv] ? $_POST ['uComInsMoney'] [$cv] : 0;
		$pComInsMoney = $_POST ['pComInsMoney'] [$cv] ? $_POST ['pComInsMoney'] [$cv] : 0;
		$managementCostMoney = $_POST ['managementCostMoney'] [$cv] ? $_POST ['managementCostMoney'] [$cv] : 0;
		$uOtherMoney = $_POST ['uOtherMoney'] [$cv] ? $_POST ['uOtherMoney'] [$cv] : 0;
		if (($uPDInsMoney + $uSoInsMoney + $pSoInsMoney + $uHFMoney + $pHFMoney + $uComInsMoney + $pComInsMoney + $managementCostMoney + $uOtherMoney) == 0)
			continue;
		$str = null;
		$str = "`uPDInsMoney`='$uPDInsMoney',`uSoInsMoney`='$uSoInsMoney',`pSoInsMoney`='$pSoInsMoney',`uHFMoney`='$uHFMoney',`pHFMoney`='$pHFMoney',`uComInsMoney`='$uComInsMoney',`pComInsMoney`='$pComInsMoney',`managementCostMoney`='$managementCostMoney',`uOtherMoney`='$uOtherMoney',";
		$sqlStr [$cv] = $str;
	}
	$uIDStr = rtrim ( $uIDStr, "," );
	$eSql = "select ID,roleA from a_editAccountList where month like '$month' and roleA in ($uIDStr) and type=2";
	$eRes = $pdo->query ( $eSql );
	$eRow = $eRes->rowCount ();
	if ($eRow > 0) {
		$eRet = $eRes->fetchAll ( PDO::FETCH_ASSOC );
		foreach ( $eRet as $key => $val ) {
			$updateSql [] = $upSql . rtrim ( $sqlStr [$val ['roleA']], "," ) . " where `ID`='$val[ID]'";
			unset ( $sqlStr [$val ['roleA']] );
		}
	} else {
		foreach ( $sqlStr as $key => $val ) {
			$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$roleB',`type`=2,`status`=0,`unitID`='$unitID',`field`='$field'";
			unset ( $sqlStr [$key] );
		}
	}
	if ($sqlStr) {
		foreach ( $sqlStr as $key => $val ) {
			$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$roleB',`type`=2,`status`=0,`unitID`='$unitID',`field`='$field'";
		}
	}
	$actionSql = mergeArray ( $updateSql, $insertSql );
	$result = transaction ( $pdo, $actionSql );
	$errMsg ['sql'] = $result ['error'];
	if (empty ( $errMsg ['sql'] )) {
		$succMsg = "提交成功";
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#申请欠款的明细冲减挂账
if ($_POST ['btn'] == "editWriteDownBtn") {
	$unitID = $_POST ['unitID'];
	$month = $_POST ['month'];
	$actionKey = array_keys ( $_POST ['editAccountCheck'] );
	$aTotal = $_POST ['aTotal'];
	$saA = $_POST ['saA'];
	$sA = $_POST ['sA'];
	$hA = $_POST ['hA'];
	$cA = $_POST ['cA'];
	$mA = $_POST ['mA'];
	$uOA = $_POST ['uOA'];
	$uAST = $_POST ['uAST'];
	if ($uAST) {
		$field .= $uAST . "|";
	}
	if ($saA) {
		$field .= $saA . "|";
	}
	if ($sA) {
		$field .= $sA . "|";
	}
	if ($hA) {
		$field .= $hA . "|";
	}
	if ($cA) {
		$field .= $cA . "|";
	}
	if ($mA) {
		$field .= $mA . "|";
	}
	if ($uOA) {
		$field .= $uOA . "|";
	}
	if (! $field)
		$errMsg [] = "请选择要进行冲减的项";
	else {
		$upSql = "update a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',`status`='0',`field`='$field',";
		$iSql = "insert into a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',";
		$sqlStr = null;
		foreach ( $_POST as $key => $val ) {
			if (is_array ( $val )) {
				foreach ( $val as $k => $v ) {
					if (! in_array ( $k, $actionKey ))
						unset ( $_POST [$key] [$k] );
				}
			}
		}
		
		foreach ( $_POST ['editAccountCheck'] as $ck => $cv ) {
			$uIDStr .= "'" . $cv . "',";
			$uPDInsMoney = $_POST ['uPDInsMoney'] [$cv] ? $_POST ['uPDInsMoney'] [$cv] : 0;
			$uSoInsMoney = $_POST ['uSoInsMoney'] [$cv] ? $_POST ['uSoInsMoney'] [$cv] : 0;
			$pSoInsMoney = $_POST ['pSoInsMoney'] [$cv] ? $_POST ['pSoInsMoney'] [$cv] : 0;
			$uHFMoney = $_POST ['uHFMoney'] [$cv] ? $_POST ['uHFMoney'] [$cv] : 0;
			$pHFMoney = $_POST ['pHFMoney'] [$cv] ? $_POST ['pHFMoney'] [$cv] : 0;
			$uComInsMoney = $_POST ['uComInsMoney'] [$cv] ? $_POST ['uComInsMoney'] [$cv] : 0;
			$pComInsMoney = $_POST ['pComInsMoney'] [$cv] ? $_POST ['pComInsMoney'] [$cv] : 0;
			$managementCostMoney = $_POST ['managementCostMoney'] [$cv] ? $_POST ['managementCostMoney'] [$cv] : 0;
			$uOtherMoney = $_POST ['uOtherMoney'] [$cv] ? $_POST ['uOtherMoney'] [$cv] : 0;
			if (($uPDInsMoney + $uSoInsMoney + $pSoInsMoney + $uHFMoney + $pHFMoney + $uComInsMoney + $pComInsMoney + $managementCostMoney + $uOtherMoney) == 0)
				continue;
			$str = null;
			$str = "`uPDInsMoney`='$uPDInsMoney',`uSoInsMoney`='$uSoInsMoney',`pSoInsMoney`='$pSoInsMoney',`uHFMoney`='$uHFMoney',`pHFMoney`='$pHFMoney',`uComInsMoney`='$uComInsMoney',`pComInsMoney`='$pComInsMoney',`managementCostMoney`='$managementCostMoney',`uOtherMoney`='$uOtherMoney',";
			$sqlStr [$cv] = $str;
		}
		$uIDStr = rtrim ( $uIDStr, "," );
		$eSql = "select ID,roleA from a_editAccountList where month like '$month' and roleA in ($uIDStr) and type='4'";
		$eRes = $pdo->query ( $eSql );
		$eRow = $eRes->rowCount ();
		if ($eRow > 0) {
			$eRet = $eRes->fetchAll ( PDO::FETCH_ASSOC );
			foreach ( $eRet as $key => $val ) {
				$updateSql [] = $upSql . rtrim ( $sqlStr [$val ['roleA']], "," ) . " where `ID`='$val[ID]'";
				unset ( $sqlStr [$val ['roleA']] );
			}
		} else {
			foreach ( $sqlStr as $key => $val ) {
				$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$key',`type`='4',`status`=0,`unitID`='$unitID',`field`='$field'";
				unset ( $sqlStr [$key] );
			}
		}
		if ($sqlStr) {
			foreach ( $sqlStr as $key => $val ) {
				$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$key',`type`='4',`status`=0,`unitID`='$unitID',`field`='$field'";
			}
		}
		$actionSql = mergeArray ( $updateSql, $insertSql );
		#添加审批
		$month = $_POST ['month'];
		$unitID = $_POST ['unitID'];
		$appProID = $_POST ['appProIDDE'];
		if ($appProID) {
			$delSql = "delete a.*,b.* from `a_approval_list` a ,`a_approval_process` b where a.`appProID`= '$appProID' and a.`appProID`= b.`appProID`";
			$pdo->query ( $delSql );
		}
		$appType = "WDDetail";
		$appTable = "a_editAccountList";
		$appConStr = "a.`month`=\'$month\' and a.`unitID`=\'$unitID\'";
		$approval = new approval ();
		$approval->pdo = $pdo;
		$approval->month = $month;
		$approval->unitID = $unitID;
		$approval->type = $appType;
		$approval->table = $appTable;
		$approval->conStr = $appConStr;
		$approval->url = "salaryManage/editWriteDownMoney.php?month=$month&unitID=$unitID";
		$exAppArr = $approval->validEx ();
		$mID = manager ( $pdo, $unitID, "2_1" );
		$appIDSql = "select * from s_approvalPro_set where type='WDDetail' and process like '\"mID\"=>\"$mID\"%'";
		$appIDRes = $pdo->query ( $appIDSql );
		$appIDRet = $appIDRes->fetch ( PDO::FETCH_ASSOC );
		$appID = $appIDRet ['appID'];
		//这里引用类 approval
		if ($appID) {
			
			$msg = $approval->approvalSet ( $appID );
			if ($msg ['error'])
				$errMsg [] = $msg ['error'];
			else {
				$result = transaction ( $pdo, $actionSql );
				$errMsg ['sql'] = $result ['error'];
				if (empty ( $errMsg ['sql'] )) {
					$succMsg = "提交成功";
				}
			}
		} else {
			$errMsg [] = "对应该客户经理的审批流程还未建立,请先设置";
		}
		
		//		$result = transaction ( $pdo, $actionSql );
		//		$errMsg ['sql'] = $result ['error'];
		//		if (empty ( $errMsg ['sql'] )) {
		//			$succMsg = "提交成功";
		//		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#设置公司挂账
if ($_POST ['btn'] == "editAccountCompanyBtn" && $_POST ['type'] == "fee") {
	$unitID = $_POST ['unitID'];
	$month = $_POST ['month'];
	$actionKey = array_keys ( $_POST ['editAccountCheck'] );
	foreach ( $_POST as $key => $val ) {
		if (is_array ( $val )) {
			foreach ( $val as $k => $v ) {
				if (! in_array ( $k, $actionKey ))
					unset ( $_POST [$key] [$k] );
			}
		}
	}
	$upSql = "update a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',`status`='0',";
	$iSql = "insert into a_editAccountList set `sponsorName`='$mName',`sponsorTime`='$now',";
	$sqlStr = null;
	foreach ( $_POST ['editAccountCheck'] as $ck => $cv ) {
		$pA = $sA = $hA = $cA = $mA = $uA = $field = $str = null;
		$uIDStr .= "'" . $cv . "',";
		$uPDInsMoney = $_POST ['uPDInsMoney'] [$cv] ? $_POST ['uPDInsMoney'] [$cv] : 0;
		$uSoInsMoney = $_POST ['uSoInsMoney'] [$cv] ? $_POST ['uSoInsMoney'] [$cv] : 0;
		$uHFMoney = $_POST ['uHFMoney'] [$cv] ? $_POST ['uHFMoney'] [$cv] : 0;
		$uComInsMoney = $_POST ['uComInsMoney'] [$cv] ? $_POST ['uComInsMoney'] [$cv] : 0;
		$managementCostMoney = $_POST ['managementCostMoney'] [$cv] ? $_POST ['managementCostMoney'] [$cv] : 0;
		$uOtherMoney = $_POST ['uOtherMoney'] [$cv] ? $_POST ['uOtherMoney'] [$cv] : 0;
		$pA = $_POST ['pA'] [$cv];
		$sA = $_POST ['sA'] [$cv];
		$hA = $_POST ['hA'] [$cv];
		$cA = $_POST ['cA'] [$cv];
		$mA = $_POST ['mA'] [$cv];
		$uA = $_POST ['uA'] [$cv];
		if ($pA) {
			$field .= $pA . "|";
		} else {
			$uPDInsMoney = 0;
		}
		if ($sA) {
			$field .= $sA . "|";
		} else {
			$uSoInsMoney = 0;
		}
		if ($hA) {
			$field .= $hA . "|";
		} else {
			$uHFMoney = 0;
		}
		if ($cA) {
			$field .= $cA . "|";
		} else {
			$uComInsMoney = 0;
		}
		if ($mA) {
			$field .= $mA . "|";
		} else {
			$managementCostMoney = 0;
		}
		if ($uA) {
			$field .= $uA . "|";
		} else {
			$uOtherMoney = 0;
		}
		if (! $pA && ! $sA && ! $hA && ! $cA && ! $mA && ! $uA)
			$errMsg [] = "请选择要调账的项";
		
		$str = "`uPDInsMoney`='$uPDInsMoney',`uSoInsMoney`='$uSoInsMoney',`uHFMoney`='$uHFMoney',`uComInsMoney`='$uComInsMoney',`managementCostMoney`='$managementCostMoney',`uOtherMoney`='$uOtherMoney',`field`='$field',";
		$sqlStr [$cv] = $str;
	}
	if (! $errMsg) {
		$uIDStr = rtrim ( $uIDStr, "," );
		$eSql = "select ID,roleA from a_editAccountList where month like '$month' and roleA in ($uIDStr) and type='3'";
		$eRes = $pdo->query ( $eSql );
		$eRow = $eRes->rowCount ();
		if ($eRow > 0) {
			$eRet = $eRes->fetchAll ( PDO::FETCH_ASSOC );
			foreach ( $eRet as $key => $val ) {
				$updateSql [] = $upSql . rtrim ( $sqlStr [$val ['roleA']], "," ) . " where `ID`='$val[ID]'";
				unset ( $sqlStr [$val ['roleA']] );
			}
		} else {
			foreach ( $sqlStr as $key => $val ) {
				$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$key',`type`='3',`status`=0,`unitID`='$unitID'";
				unset ( $sqlStr [$key] );
			}
		}
		if ($sqlStr) {
			foreach ( $sqlStr as $key => $val ) {
				$insertSql [] = $iSql . $sqlStr [$key] . "`month`='$month',`roleA` ='$key',`roleB`='$key',`type`='3',`status`=0,`unitID`='$unitID'";
			}
		}
		$actionSql = mergeArray ( $updateSql, $insertSql );
		$result = transaction ( $pdo, $actionSql );
		// print_r($sql);
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "提交成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#删除调账记录
if ($_POST ['btn'] == "deleteAccount") {
	$ID = $_POST ['ID'];
	$sql = "delete from a_editAccountList where ID='$ID' and status in ('0','99')";
	$row = $pdo->exec ( $sql );
	if ($row) {
		$succMsg = "删除成功";
	} else {
		$errMsg = "删除失败:请联系系统管理员";
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#添加原始费用表记录
if ($_POST ['btn'] == "addOriginalFee_tmpBtn") {
	$extSql1 = "select uID from `a_workerInfo` where `uID`='" . $_POST ['uID'] . "' and name='" . $_POST ['name'] . "'";
	$extRet1 = SQL ( $pdo, $extSql1, null, "one" );
	if (! $extRet1)
		$errMsg [] = "系统中不存在该员工信息,请重新确认输入";
	switch ($_POST ['a']) {
		case "originalFee_tmp" :
			$extSql2 = "select uID from `a_originalFee_tmp` where `uID`='" . $_POST ['uID'] . "' and `month`='" . $_POST ['month'] . "' and `unitID`='" . $_POST ['unitID'] . "'";
			$extRet2 = SQL ( $pdo, $extSql2, null, "one" );
			$extSql3 = "select uID from `a_Fee_tmp` where `month`='" . $_POST ['month'] . "' and `unitID`='" . $_POST ['unitID'] . "' and `extraBatch`='0' limit 1";
			$extRet3 = SQL ( $pdo, $extSql3, null, "one" );
			$sql = "insert into a_originalFee_tmp set";
			$sql2 = "insert into a_fee_tmp set";
			break;
		case "mulFee_tmp" :
			$extSql2 = "select uID from `a_mul_originalFee_tmp` where `uID`='" . $_POST ['uID'] . "' and `month`='" . $_POST ['month'] . "' and `unitID`='" . $_POST ['unitID'] . "' and `extraBatch`='" . $_POST ['extraBatch'] . "'";
			$extRet2 = SQL ( $pdo, $extSql2, null, "one" );
			$extSql3 = "select uID from `a_Fee_tmp` where `month`='" . $_POST ['month'] . "' and `unitID`='" . $_POST ['unitID'] . "' and `extraBatch`='" . $_POST ['extraBatch'] . "' limit 1";
			$extRet3 = SQL ( $pdo, $extSql3, null, "one" );
			$sql = "insert into a_mul_originalFee_tmp set";
			$sql2 = "insert into a_fee_tmp set";
			break;
	}
	
	if ($extRet2)
		$errMsg [] = "本月的费用表中已存在该人员,请确认是否是员工编号错误";
	if (! $errMsg) :
		foreach ( $_POST as $key => $val ) {
			switch ($key) {
				case "btn" :
				case "a" :
					break;
				case "month" :
				case "unitID" :
				case "uID" :
				case "name" :
				case "extraBatch" :
					$sql .= "`$key`='$val',";
					$sql2 .= "`$key`='$val',";
					break;
				default :
					$sql .= "`$key`='$val',";
					break;
			}
		}
		$actionSql [0] = rtrim ( $sql, "," );
		$sql2 = rtrim ( $sql2, "," );
		$result = transaction ( $pdo, $actionSql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "修改成功";
			if ($extRet3)
				$pdo->query ( $sql2 );
		}
	
    endif;
	
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#更改原始费用表姓名及工资账号
if ($_POST ['btn'] == "editOriginalFee_tmpBtn") {
	list ( $field, $ID ) = explode ( "|", $_POST ['field'] );
	$fieldVal = $_POST ['value'];
	if ($_POST ['extraBatch'] != '0')
		$oSql = "select name from `a_mul_originalFee_tmp` where `ID`='$ID'";
	else
		$oSql = "select name,uID,month,unitID,uPension,uHospitalization,uEmploymentInjury,uUnemployment,uBirth from `a_originalFee_tmp` where `ID`='$ID'";
	$oRet = SQL ( $pdo, $oSql, null, "one" );
	if ($field == "uID") {
		$wSql = "select name from `a_workerInfo` where `uID`='$fieldVal'";
		$wRet = SQL ( $pdo, $wSql, null, "one" );
		if (! $wRet ['name'])
			$errMsg [] = "不存在该员工编号,请重新输入";
		elseif ($wRet ['name'] != $oRet ['name'])
			$errMsg [] = "该员工编号的姓名[$fieldVal/" . $wRet ['name'] . "],与该费用表的姓名[" . $oRet ['name'] . "]不匹配";
	}
	if (! $errMsg) {
		if ($_POST ['extraBatch'] != '0')
			$reSql = "update a_mul_originalFee_tmp set `$field`='$fieldVal' where `ID`='$ID'";
		else
			$reSql = "update a_originalFee_tmp set `$field`='$fieldVal' where `ID`='$ID'";
		
		$sql [0] = $reSql;
		$result = transaction ( $pdo, $sql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			$succMsg = "修改成功";
			//同时这里更新a_fee_tmp里面的记录,以适合调整
			switch ($field) {
				case "uPension" :
				case "uHospitalization" :
				case "uEmploymentInjury" :
				case "uUnemployment" :
				case "uBirth" :
					$fieldtmp = "uSoInsR";
					$fieldVal = $oRet ['uPension'] + $oRet ['uHospitalization'] + $oRet ['uEmploymentInjury'] + $oRet ['uUnemployment'] + $oRet ['uBirth'] - $oRet [$field] + $fieldVal;
					break;
				case "uHF" :
				case "uComIns" :
				case "managementCost" :
				case "uPDIns" :
					$fieldtmp = $field . "R";
					break;
			}
			$feetmpSql = "update a_fee_tmp set `$fieldtmp`='$fieldVal' where `uID`='" . $oRet ['uID'] . "' and `month`='" . $oRet ['month'] . "' and `unitID`='" . $oRet ['unitID'] . "' and `extraBatch`='" . $_POST ['extraBatch'] . "'";
			$pdo->query ( $feetmpSql );
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#申请整体费用冲减
if ($_POST ['btn'] == "editWholeWDBtn") {
	$wholeWD = $_POST ['wholeWD'];
	$aTotal = $_POST ['aTotal'];
	$uAST = $_POST ['uAST'];
	$saA = $_POST ['saA'];
	$sA = $_POST ['sA'];
	$hA = $_POST ['hA'];
	$cA = $_POST ['cA'];
	$mA = $_POST ['mA'];
	$uOA = $_POST ['uOA'];
	if ($uAST) {
		$field .= $uAST . "|";
	}
	if ($saA) {
		$field .= $saA . "|";
	}
	if ($sA) {
		$field .= $sA . "|";
	}
	if ($hA) {
		$field .= $hA . "|";
	}
	if ($cA) {
		$field .= $cA . "|";
	}
	if ($mA) {
		$field .= $mA . "|";
	}
	if ($uOA) {
		$field .= $uOA . "|";
	}
	if (! $field)
		$errMsg [] = "请选择要进行冲减的项";
	elseif (($aTotal - $wholeWD) < 0) {
		$errMsg [] = "挂账额度不足,请确认您的冲减额度";
	} else {
		if ($wholeWD <= 0) {
			$errMsg [] = "冲减挂账不能小于或等于0";
		} else {
			$ID = $_POST ['ID'];
			if ($ID) {
				$actionSql [0] = "update `a_uWriteDownList` set `wholeWD`='$wholeWD',`field`='$field',`status`='0',`sponsorName`='$mName',`sponsorTime`='$now' where `ID`='$ID'";
			} else {
				$sql = " insert into `a_uWriteDownList` set `sponsorName`='$mName',`sponsorTime`='$now',`field`='$field',";
				foreach ( $_POST as $key => $val ) {
					switch ($key) {
						case "unitID" :
						case "month" :
						case "wholeWD" :
						case "type" :
							$str .= "`$key`='$val',";
							$$key = $val;
							break;
					}
				}
				$actionSql [0] = $sql . rtrim ( $str, "," );
			}
			#添加审批
			//			$month = $_POST ['month'];
			//			$unitID = $_POST ['unitID'];
			$appProID = $_POST ['appProIDWH'];
			$extraSql = "select ID,max(extraBatch) as extraBatch from `a_uwritedownlist` where `month` like '$month' and `unitID` like '$unitID' and `type` like '$type'";
			$extraRet = SQL ( $pdo, $extraSql, NULL, 'one' );
			if ($extraRet ['ID']) {
				$extraBatch = $extraRet ['extraBatch'] + 1;
			} else {
				$extraBatch = 0;
			}
			if ($appProID) {
				$delSql = "delete a.*,b.* from `a_approval_list` a ,`a_approval_process` b where a.`appProID`= '$appProID' and a.`appProID`= b.`appProID`";
				$pdo->query ( $delSql );
			}
			$appType = "WDWhole";
			$appTable = "a_uWriteDownList";
			$appConStr = "a.`month`=\'$month\' and a.`unitID`=\'$unitID\' and a.`type`=\'$type\' and a.`extraBatch`=\'$extraBatch\'";
			$approval = new approval ();
			$approval->pdo = $pdo;
			$approval->month = $month;
			$approval->unitID = $unitID;
			$approval->type = $appType;
			$approval->table = $appTable;
			$approval->conStr = $appConStr;
			$approval->url = "salaryManage/editWriteDownMoney.php?month=$month&unitID=$unitID&wdtype=$type&extraBatch=$extraBatch";
			$exAppArr = $approval->validEx ();
			$mID = manager ( $pdo, $unitID, "2_1" );
			$appIDSql = "select * from s_approvalPro_set where type='WDWhole' and process like '\"mID\"=>\"$mID\"%'";
			$appIDRes = $pdo->query ( $appIDSql );
			$appIDRet = $appIDRes->fetch ( PDO::FETCH_ASSOC );
			$appID = $appIDRet ['appID'];
			//这里引用类 approval
			if ($appID) {
				$msg = $approval->approvalSet ( $appID );
				if ($msg ['error'])
					$errMsg [] = $msg ['error'];
				else {
					$result = transaction ( $pdo, $actionSql );
					$errMsg ['sql'] = $result ['error'];
					if (empty ( $errMsg ['sql'] )) {
						$succMsg = "提交成功";
					}
				}
			} else {
				$errMsg [] = "对应该客户经理的审批流程还未建立,请先设置";
			}
		}
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#删除整体冲减挂账记录
if ($_POST ['btn'] == "deleteWholeWD") {
	$ID = $_POST ['ID'];
	$sql = "delete from a_uWriteDownList where ID='$ID' and status in ('0','99')";
	$row = $pdo->exec ( $sql );
	if ($row) {
		$succMsg = "删除成功";
	} else {
		$errMsg = "删除失败:请联系系统管理员";
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#离职工资修改
if ($_POST ['btn'] == "editDimissionSalaryBtn") {
	list ( $ID, $field ) = explode ( "|", $_POST ['ID'] );
	$value = $_POST ['value'];
	$upSql [0] = " update `a_dimissionSalary` set `$field`='$value',`sponsorName`='$mName',`sponsorTime`='$now' where `ID`='$ID'";
	$result = transaction ( $pdo, $upSql );
	$errMsg = $result ['error'];
	if (empty ( $errMsg )) {
		$succMsg = "修改成功";
	}
	$msg = array (
			"error" => $errMsg,
			"reload" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
#删除 离职工资表 a_dimissionSalary, 审批流程表
if ($_POST ['btn'] == "delDimissionSalaryBtn") {
	list ( $month, $unitID, $extraBatch ) = explode ( "|", $_POST ['field'] );
	
	//删除临时费用表
	$sql [0] = "delete from a_dimissionSalary where month like '$month' and unitID like '$unitID' and extraBatch like '$extraBatch'";
	//删除挂账,及收回欠款记录,
	$sql [1] = "delete a.* from a_prsRequireMoney a left join a_workerInfo b on a.uID=b.uID where b.unitID like '$unitID' and a.month like '$month' and `feeType`='2' and extraBatch ='$extraBatch'  and (a.type in ('1','3','4') or (a.type=2 and a.soInsCardMoney=0 and a.residentCardMoney=0 and a.uOtherMoney=0 and a.pOtherMoney=0))";
	$sql [2] = "update a_prsRequireMoney a,a_workerInfo b set a.uSoInsMoney=0 ,a.pSoInsMoney=0 , a.uComInsMoney=0 ,a.pComInsMoney=0 , a.managementCostMoney=0,a.sponsorName='$mName',a.sponsorTime='$now' where b.unitID like '$unitID' and a.type=2 and a.month like '$month' and `extraBatch`='$extraBatch' and `feeType`='2' and (a.soInsCardMoney<>0 or a.residentCardMoney<>0 or a.uOtherMoney<>0 or a.pOtherMoney<>0)";
	//删除审批流程
	$sql [3] = "delete a.*,b.* from a_approval_list a,a_approval_process b where a.month like '$month' and a.unitID like '$unitID' and `extraBatch`='$extraBatch' and a.appProID=b.appProID and a.type = 'dimissionSalary'";
	//删除审批验证
	$sql [4] = "delete from a_valid_approval_finished where month like '$month' and unitID like '$unitID' and extraBatch like '$extraBatch' and approvalType like 'dimissionSalary'";
	//删除台账
	

	$result = extraTransaction ( $pdo, $sql );
	// print_r($sql);
	$errMsg ['sql'] = $result ['error'];
	if (empty ( $errMsg ['sql'] )) {
		$succMsg = "删除成功";
	}
	if ($errMsg) {
		$errMsg = array_filter ( $errMsg );
		$errMsg = array_unique ( $errMsg );
		foreach ( $errMsg as $eV ) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array (
			"error" => $errMsg,
			"succ" => $succMsg 
	);
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
?>