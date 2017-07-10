<?php
/*
*       2011-3-24
*       <<< 离职工资垫付,审批   >>>
*       create by Great sToNe
*       have fun,.....
*/
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接数据函数
require_once sysPath . 'dataFunction/unit.data.php';
#分页类
require_once sysPath . 'class/pagenation.class.php';
$title = "工资表/费用表审批";
$mID = $_SESSION ['exp_user'] ['mID'];
$appProID = $_GET ['appProID'];
$mSql = "select mID,mName,groupID,subGroupID,roleID from s_user where `mID` like '$mID'";
$mRes = $pdo->query ( $mSql );
$mRet = $mRes->fetch ( PDO::FETCH_ASSOC );
foreach ( $mRet as $mKey => $mVal ) {
	switch ($mKey) {
		case "mID" :
			//一个人只有一个mid
			$nSql = $nRes = $nRet = null;
			$nSql = "select  appProID,proID from v_approval_listPro where `curKey` like '$mKey' and `curVal` like '$mVal' and `appProID`='$appProID' and `proStatus`='0' ";
			$nRes = $pdo->query ( $nSql );
			$nRet = $nRes->fetch ( PDO::FETCH_ASSOC );
			
			break;
		default :
			//获取当一个人多个角色的情况
			if ($mVal) {
				$roRet = explode ( ",", $mVal );
				foreach ( $roRet as $roVal ) {
					if ($roVal) {
						$nSql = $nRes = $nRet = null;
						$nSql = "select  appProID,proID from v_approval_listPro where `curKey` like '$mKey' and `curVal` like '$roVal' and `appProID`='$appProID' and `proStatus`='0' ";
						$nRes = $pdo->query ( $nSql );
						$nRet = $nRes->fetch ( PDO::FETCH_ASSOC );
						if ($nRet)
							break;
					}
				}
			}
			break;
	}
	if ($nRet)
		break;
}
$listSql = "select a.*,b.typeName from a_approval_list a left join s_approvalPro_set b on a.appID=b.appID where a.appProID like :appProID";
$listRes = $pdo->prepare ( $listSql );
$listRes->execute ( array (":appProID" => $appProID ) );
$listRet = $listRes->fetch ( PDO::FETCH_ASSOC );
#获取员工信息,求出社保费用,商保费用,互助会费用
$wSql = "select x.uID,x.name,x.department,x.bID,x.status from a_workerInfo x where exists ( select a.uID from a_dimissionSalary a where $listRet[conStr] and a.uID= x.uID)";
$wRes = $pdo->prepare ( $wSql );
$wRes->execute ();
$wRet = $wRes->fetchAll ( PDO::FETCH_ASSOC );
foreach ( $wRet as $wVal ) {
	$wR [$wVal ['uID']] = $wVal;
}
unset ( $wRet );
#获取工资表,费用表
$sql = " select a.* from a_dimissionSalary a where $listRet[conStr] ";
$pageArr = paginationAction ( $pdo, $sql, $_GET ['page'], $_SERVER ['QUERY_STRING'], $pagesize = 20, "all" );
#获取单位信息表
$unit = unitAll ( $pdo, " unitID,unitName " );
#计算相关费用
$allRet = $pageArr ['allRet'];
$num = 0;
foreach ( $allRet as $key => $val ) {
	foreach ( $val as $k => $v ) {
		switch ($k) {
			case "name" :
			case "unitName" :
			case "department" :
			case "status" :
			case "bID" :
			case "uID" :
				break;
			default :
				if (is_numeric ( $v ))
					$totalArr [$k] += $v;
				break;
		}
	}
	$num ++;
}
unset ( $pageArr ['allRet'] );
//print_r($pageArr);
#获取中英文对照数组
$engToChsArr = engTochs ();
#获取该帐套对应的列,包括列的中文名
$zfSql = "select b.zIndex,b.field,a.payFormulas,a.ratalFormulas,a.acheiveFormulas,a.totalFeeFormulas from a_otherformulas a left join a_zformatInfo b on a.zID=b.zID where a.zID like :zID and a.unitID like :unitID and a.month like :month and extraBatch like :extraBatch and type='2'";
$zfRes = $pdo->prepare ( $zfSql );
$zfRes->execute ( array (":zID" => $pageArr ['ret'] ['0'] ['zID'], ":unitID" => $pageArr ['ret'] ['0'] ['unitID'], ":month" => $pageArr ['ret'] ['0'] ['month'], ":extraBatch" => $pageArr ['ret'] ['0'] ['extraBatch'] ) );
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
//print_r($fieldArr);
//这里增加几个字段,可以自定义控制查询所需的字段名
$newFieldArr ['salaryDate'] = $engToChsArr ['salaryDate'];
$newField = implode ( ",", array_keys ( $newFieldArr ) );
if (! $formulasChart)
	exit ( "本月未提交公式,请返回费用表制作页面点击<提交公式>" );

	#设置公式所需要的代号
$formulasChart = array ("+" => "+ (加)", "-" => "- (减)", "/" => "/ (除)", "*" => "* (乘)", "(" => "( (左括号)", ")" => ")(右括号)" ) + $formulasChart;
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
#获取各种公式..
$formulasStr = array ("pay" => $zfRet ['payFormulas'], "ratal" => $zfRet ['ratalFormulas'], "acheive" => $zfRet ['acheiveFormulas'], "uAccount" => $zfRet ['uAccountFormulas'], "totalFee" => $zfRet ['totalFeeFormulas'] );
//这里就获得了应发工资的字符串了..再EVAL 一下..就可以转成PHP代码进行运算了
if ($formulasStr ['pay']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['pay'], $payStr );
	$formulasStr ['pay'] = strtr ( $formulasStr ['pay'], $newFieldArr );
}
if ($formulasStr ['ratal']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['ratal'], $ratalStr );
	$formulasStr ['ratal'] = strtr ( $formulasStr ['ratal'], $newFieldArr );
}
if ($formulasStr ['acheive']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['acheive'], $otherCostsStr );
	$formulasStr ['acheive'] = strtr ( $formulasStr ['acheive'], $newFieldArr );
}
if ($formulasStr ['uAccount']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['uAccount'], $uAccountStr );
	$formulasStr ['uAccount'] = strtr ( $formulasStr ['uAccount'], $newFieldArr );
}
if ($formulasStr ['totalFee']) {
	preg_match_all ( "/[a-zA-Z]+/", $formulasStr ['totalFee'], $otherCostsStrFee );
	$formulasStr ['totalFee'] = strtr ( $formulasStr ['totalFee'], $newFieldArr );
}
#获取本月的欠/挂费用
$curRequireMoneySql = "select a.* from `a_prsRequireMoney` a where  $listRet[conStr] and feeType='2' ";
$curRequireMoneyRes = $pdo->query ( $curRequireMoneySql );
$curRequireMoneyRet = $curRequireMoneyRes->fetchAll ( PDO::FETCH_ASSOC );
$curRMRet = $curWriteDownRet = $fTR = $prsReMoneyRet = null;
foreach ( $curRequireMoneyRet as $curRequireMoneyVal ) {
	if ($curRequireMoneyVal ['type'] == "1" || $curRequireMoneyVal ['type'] == "2") { //本月欠/挂记录,把个人部分去除了
		if ($curRequireMoneyVal ['uPDInsMoney'] != 0)
			$curRMRet [$curRequireMoneyVal ['uID']] ['uPDInsMoney'] = $curRequireMoneyVal ['uPDInsMoney'];
		if ($curRequireMoneyVal ['uSoInsMoney'] != 0)
			$curRMRet [$curRequireMoneyVal ['uID']] ['uSoInsMoney'] = $curRequireMoneyVal ['uSoInsMoney'];
		if ($curRequireMoneyVal ['uComInsMoney'] != 0)
			$curRMRet [$curRequireMoneyVal ['uID']] ['uComInsMoney'] = $curRequireMoneyVal ['uComInsMoney'];
		if ($curRequireMoneyVal ['uOtherMoney'] != 0)
			$curRMRet [$curRequireMoneyVal ['uID']] ['uOtherMoney'] = $curRequireMoneyVal ['uOtherMoney'];
		if ($curRequireMoneyVal ['managementCostMoney'] != 0)
			$curRMRet [$curRequireMoneyVal ['uID']] ['managementCostMoney'] = $curRequireMoneyVal ['managementCostMoney'];
		if ($curRequireMoneyVal ['uAccount'] != 0)
			$curRMRet [$curRequireMoneyVal ['uID']] ['uAccount'] = $curRequireMoneyVal ['uAccount'];
	}
	if ($curRequireMoneyVal ['type'] == "3") { //本月的收回欠款
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['uPDInsMoney'] = $curRequireMoneyVal ['uPDInsMoney'];
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['uSoInsMoney'] = $curRequireMoneyVal ['uSoInsMoney'];
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['pSoInsMoney'] = $curRequireMoneyVal ['pSoInsMoney'];
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['uComInsMoney'] = $curRequireMoneyVal ['uComInsMoney'];
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['pComInsMoney'] = $curRequireMoneyVal ['pComInsMoney'];
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['uOtherMoney'] = $curRequireMoneyVal ['uOtherMoney'];
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['pOtherMoney'] = $curRequireMoneyVal ['pOtherMoney'];
		$prsReMoneyRet [$curRequireMoneyVal ['uID']] ['managementCostMoney'] = $curRequireMoneyVal ['managementCostMoney'];
	}
	if ($curRequireMoneyVal ['type'] == "4") { //本月申请的冲减挂账,把个人部分去除了
		$curWriteDownRet [$curRequireMoneyVal ['uID']] ['uPDInsMoney'] = $curRequireMoneyVal ['uPDInsMoney'];
		$curWriteDownRet [$curRequireMoneyVal ['uID']] ['uSoInsMoney'] = $curRequireMoneyVal ['uSoInsMoney'];
		$curWriteDownRet [$curRequireMoneyVal ['uID']] ['uComInsMoney'] = $curRequireMoneyVal ['uComInsMoney'];
		$curWriteDownRet [$curRequireMoneyVal ['uID']] ['uOtherMoney'] = $curRequireMoneyVal ['pOtherMoney'];
		$curWriteDownRet [$curRequireMoneyVal ['uID']] ['managementCostMoney'] = $curRequireMoneyVal ['managementCostMoney'];
	}
}

unset ( $curRequireMoneyRet );

foreach ( $pageArr ['ret'] as $fKey => $fVal ) {
	if ($fVal ['pay']) {
		$salaryArr [$fVal ['uID']] = array ("name" => $fVal ['name'], "unitName" => $unit [$fVal ['unitID']] ['unitName'], "department" => $wR [$fVal ['uID']] ['department'], 'uID' => $fVal ['uID'], 'bID' => $wR [$fVal ['uID']] ['bID'] );
		if ($payStr)
			foreach ( $payStr [0] as $payVal ) {
				$salaryArr [$fVal ['uID']] [$payVal] = $fVal [$payVal];
			}
		
	//应发,应缴纳税额,个税
		$ratal = $fVal ['ratal'];
		$salaryArr [$fVal ['uID']] ['pay'] = $fVal ['pay'];
		$salaryArr [$fVal ['uID']] ['ratal'] = $fVal ['ratal'];
		$salaryArr [$fVal ['uID']] ['pTax'] = $fVal ['pTax'];
		//社保部分,商保,收回个人社保欠款,收回个人商保欠款
		$salaryArr [$fVal ['uID']] ['radix'] = $fVal ['radix'];
		$salaryArr [$fVal ['uID']] ['pSoIns'] = $fVal ['pSoIns'];
		//有发工资的由个人承担部分费用,不发工资的则由单位全部承担
		$salaryArr [$fVal ['uID']] ['pComIns'] = $fVal ['pComIns'];
		$salaryArr [$fVal ['uID']] ['pSoInsMoney'] = $prsReMoneyRet [$fVal ['uID']] ['pSoInsMoney'];
		$salaryArr [$fVal ['uID']] ['pComInsMoney'] = $prsReMoneyRet [$fVal ['uID']] ['pComInsMoney'];
		$salaryArr [$fVal ['uID']] ['pOtherMoney'] = $prsReMoneyRet [$fVal ['uID']] ['pOtherMoney'];
		$salaryArr [$fVal ['uID']] ['soInsCardMoney'] = $prsReMoneyRet [$fVal ['uID']] ['soInsCardMoney'];
		$salaryArr [$fVal ['uID']] ['residentCardMoney'] = $prsReMoneyRet [$fVal ['uID']] ['residentCardMoney'];
		$salaryArr [$fVal ['uID']] ['utilities'] = $fVal ['utilities'];
		$salaryArr [$fVal ['uID']] ['helpCost'] = $fVal ['helpCost'];
		if ($otherCostsStr [0])
			foreach ( $otherCostsStr [0] as $oVal ) {
				$salaryArr [$fVal ['uID']] [$oVal] = $fVal [$oVal];
			}
		$salaryArr [$fVal ['uID']] ['acheive'] = $fVal ['acheive'];
		$salaryArr [$fVal ['uID']] ['status'] = $wR [$fVal ['uID']] ['status'];
	}
	
	#费用表
	//离职人员的提示
	$feeArr [$fVal ['uID']] = array ("name" => $fVal ['name'], 'uID' => $fVal ['uID'], "unitName" => $unit [$fVal ['unitID']] ['unitName'], "department" => $wR [$fVal ['uID']] ['department'] );
	$feeArr [$fVal ['uID']] ['pay'] = $fVal ['pay'];
	#残障金
	$feeArr [$fVal ['uID']] ['uPDIns'] = $fVal ['uPDIns'];
	//社保
	$feeArr [$fVal ['uID']] ['uSoIns'] = $fVal ['uSoIns'];
	//商保
	$feeArr [$fVal ['uID']] ['uComIns'] = $fVal ['uComIns'];
	//管理费
	$feeArr [$fVal ['uID']] ['managementCost'] = $fVal ['managementCost'];
	//其他
	$feeArr [$fVal ['uID']] ['uOtherMoney'] = $prsReMoneyRet [$fVal ['uID']] ['uOtherMoney'];
	if ($otherCostsStrFee [0])
		foreach ( $otherCostsStrFee [0] as $oVal ) {
			$feeArr [$fVal ['uID']] [$oVal] = $fVal [$oVal];
		}
	$feeArr [$fVal ['uID']] ['totalFee'] = $fVal ['totalFee'];
	$feeArr [$fVal ['uID']] ['status'] = $wR [$fVal ['uID']] ['status'];
	$uID = $fVal ['uID'];
}
foreach ( array_keys ( $salaryArr [$uID] ) as $feeK ) {
	switch ($feeK) {
		case "name" :
		case "unitName" :
		case "department" :
		case "status" :
		case "bID" :
			$salaryTotalArr [$feeK] = null;
			break;
		case "uID" :
			continue;
		default :
			$salaryTotalArr [$feeK] += $totalArr [$feeK];
			break;
	}
}
foreach ( array_keys ( $feeArr [$uID] ) as $feeK ) {
	switch ($feeK) {
		case "name" :
		case "unitName" :
		case "department" :
		case "status" :
		case "bID" :
		case "uID" :
			$feeTotalArr [$feeK] = null;
			break;
		default :
			$feeTotalArr [$feeK] += $totalArr [$feeK];
			break;
	}
}

//echo "<pre>";
//print_r($salaryArr);
//unset ( $pageArr ['ret'] );
#变量配置
$smarty->assign ( "nRet", $nRet );
$smarty->assign ( "listRet", $listRet );
$smarty->assign ( "newFieldArr", $newFieldArr );
$smarty->assign ( "pageArr", $pageArr );
$smarty->assign ( "salaryArr", $salaryArr );
$smarty->assign ( "salaryTotalArr", $salaryTotalArr );
$smarty->assign ( "feeArr", $feeArr );
$smarty->assign ( "feeTotalArr", $feeTotalArr );
$smarty->assign ( "num", $num );
$smarty->assign ( "unit", $unit );
$smarty->assign ( "payStr", $payStr );
$smarty->assign ( "otherCostsStr", $otherCostsStr );
$smarty->assign ( "otherCostsStrFee", $otherCostsStrFee );
$smarty->assign ( "formulasChartStr", $formulasChartStr );
$smarty->assign ( "formulasStr", $formulasStr );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "approval/dimissionSalary.tpl" );
?>