<?php

/*
 * 2011-06-08
 * 公积金平账审核, 这里呢, 是新版本的,:  通过 a_editAccountList , a_prsRequireMoney运算,直接得到结果,然后呢, 能从显示的页面上修改,并通过审核的
 * 
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
$type = $_GET ['type'];
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle ( "dateTime", "-" );
$upSql = "update a_editAccountList set status='1',receiverName='$mName',receiveTime='$now' where status='0' and type='$type' and month like '$month' and unitID like '$unitID'";
$pdo->query ( $upSql );

$conSql = "select * from a_editAccountList where unitID like '$unitID' and  month like '$month' and type = '$type'  and status ='1'  and confirmStatus='0' ";
$conRet = SQL ( $pdo, $conSql );
#判断是否已经执行过
if ($conRet) {
	
	foreach ( $conRet as $val ) {
		$roleAStr .= "'" . $val ['roleA'] . "',";
		$roleBStr .= "'" . $val ['roleB'] . "',";
	}
	$roleAStr = rtrim ( $roleAStr, "," );
	$roleBStr = rtrim ( $roleBStr, "," );
	
	$extArr = array (
			":month" => $month,
			":unitID" => $unitID 
	);
	$existSql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID=b.uID where a.month like :month and a.type in ('1','2') and a.uID in ($roleAStr)";
	$existRet = SQL ( $pdo, $existSql, array (
			":month" => $month 
	) );
	foreach ( $existRet as $exKey => $exVal ) {
		if ($exVal ['type'] == "1") {
			$exACRet [$exVal ['uID']] = $exVal;
		} else {
			$exRERet [$exVal ['uID']] = $exVal;
		}
	}
	unset ( $existRet );
	$sql = " select * from a_editAccountList where unitID like :unitID and  month like :month and type = '$type' and roleB in ($roleBStr) and status ='1'  ";
	$ret = SQL ( $pdo, $sql, $extArr );
	$ret = keyArray ( $ret, "roleA" );
	$insertSql = "insert into `a_prsRequireMoney` set ";
	$updateSql = "update `a_prsRequireMoney` set sponsorTime='$now',";
	foreach ( $ret as $key => $val ) {
		//获取需要调整的字段,a_prsRequireMoney表里的
		$field = $upStr1 = $upStr2 = $inStr1 = $inStr2 = $str = $type = $upConStr1 = $upConStr2 = $typeStr1 = $typeStr2 = null;
		$field = explode ( "|", $val ['field'] );
		$field = array_filter ( $field );
		if ($exACRet && array_key_exists ( $key, $exACRet )) {
			//更新a_prsRequireMoney, type=1,且判断是否相加后的值$v是否小于0，如果小于0 ,如果存在欠款记录则update,否则insert
			foreach ( $val as $k => $v ) {
				$ID = $rr = NULL;
				switch ($k) {
					case "uComInsMoney" :
					case "pComInsMoney" :
						if ($v != 0) {
							if ($exACRet [$key] [$k] >= 0) {
								$acVal = $exACRet [$key] [$k];
								if ($exRERet && $exRERet [$key] [$k] < 0) {
									//判断当月如果在公积金未进行平账前,既存在挂账又有欠款..这肯定是出错了!!!;
									$errMsg [] = "员工编号为{" . $key . "}的员工公积金平账出现问题..请及时查证..(该员工存在个人公积金欠/挂问题)";
								}
								$v = $v + $acVal;
								if ($v >= 0) {
									$type = 1;
									$upStr1 .= "`$k`='$v',";
									$ID = $exACRet [$key] ['ID'];
									$upConStr1 = " `ID`='$ID' ";
								} else {
									//如果小于0，判断是否有欠款记录,如果有的话,就update,没有的话就insert
									$type = 2;
									// $upStr1 .= "`$k`='0',";
									$ID = $exACRet [$key] ['ID'];
									// $upConStr1 = " `ID`='$ID' ";
									if ($exRERet && array_key_exists ( $key, $exRERet )) {
										$upStr2 .= "`$k`='$v',";
										$rr = $exRERet [$key] ['ID'];
										$upConStr2 = " `ID`='$rr' ";
									} else {
										$inStr2 .= "`$k`='$v',";
										$typeStr2 = "`type`='$type'";
									}
								}
							} elseif ($exACRet [$key] [$k] < 0) {
								$errMsg [] = "员工编号为{" . $key . "}的挂账为负数,请核实";
								break;
							}
						}
						break;
					default :
				}
			}
			if ($inStr1)
				$inSql1 [] = $insertSql . $inStr1 . $typeStr1 . " ,`uID`='$key',`month`='$month',`unitID`='$unitID',`status`='0'";
			if ($inStr2)
				$inSql2 [] = $insertSql . $inStr2 . $typeStr2 . " ,`uID`='$key',`month`='$month',`unitID`='$unitID',`status`='0'";
			if ($upStr1)
				$upSql1 [] = $updateSql . rtrim ( $upStr1, "," ) . " where " . $upConStr1;
			if ($upStr2)
				$upSql2 [] = $updateSql . rtrim ( $upStr2, "," ) . " where " . $upConStr2;
		} elseif ($exRERet && array_key_exists ( $key, $exRERet )) {
			//更新a_prsRequireMoney, type=2,且判断是否相加后的值$v是否大于0，如果大于0 ,如果存在挂账记录则update,否则insert
			foreach ( $val as $k => $v ) {
				switch ($k) {
					case "uComInsMoney" :
					case "pComInsMoney" :
						if ($v != 0) {
							if ($exRERet [$key] [$k] <= 0) {
								$acVal = $exRERet [$key] [$k];
								$v = $v + $acVal;
								if ($v <= 0) {
									$type = 2;
									$upStr2 .= "`$k`='$v',";
									$ID = $exRERet [$key] ['ID'];
									$upConStr2 = " `ID`='$ID'";
								} else {
									//如果大0，判断是否有欠款记录,如果有的话,就update,没有的话就insert
									$type = 1;
									$upStr2 .= "`$k`='0',";
									$ID = $exRERet [$key] ['ID'];
									$upConStr2 = " `ID`='$ID' ";
									$inStr1 .= "`$k`='$v',";
									$typeStr1 = "`type`='$type'";
								}
							} elseif ($exRERet [$key] [$k] > 0) {
								$errMsg [] = "员工编号为{" . $key . "}的欠款为正数,请核实";
								break;
							}
						}
						break;
					default :
						break;
				}
			}
			if ($inStr1)
				$inSql1 [] = $insertSql . $inStr1 . $typeStr1 . " ,`uID`='$key',`month`='$month',`unitID`='$unitID',`status`='0'";
			if ($inStr2)
				$inSql2 [] = $insertSql . $inStr2 . $typeStr2 . " ,`uID`='$key',`month`='$month',`unitID`='$unitID',`status`='0'";
			if ($upStr1)
				$upSql1 [] = $updateSql . rtrim ( $upStr1, "," ) . " where " . $upConStr1;
			if ($upStr2)
				$upSql2 [] = $updateSql . rtrim ( $upStr2, "," ) . " where " . $upConStr2;
		} else {
			foreach ( $val as $k => $v ) {
				switch ($k) {
					case "uComInsMoney" :
					case "pComInsMoney" :
						if ($v > 0) {
							$type = 1;
							$inStr1 .= "`$k`='$v',";
							$typeStr1 = "`type`='$type'";
						} elseif ($v < 0) {
							$type = 2;
							$inStr2 .= "`$k`='$v',";
							$typeStr2 = "`type`='$type'";
						}
						break;
					default :
						break;
				}
			}
			if ($inStr1)
				$inSql1 [] = $insertSql . $inStr1 . $typeStr1 . " ,`uID`='$key',`month`='$month',`unitID`='$unitID',`status`='0'";
			if ($inStr2)
				$inSql2 [] = $insertSql . $inStr2 . $typeStr2 . " ,`uID`='$key',`month`='$month',`unitID`='$unitID',`status`='0'";
		}
		$confirmSql [] = "update a_editAccountList set `confirmStatus`='1' where `ID`='$val[ID]'";
	}
	$actionSql = mergeArray ( $inSql1, $inSql2, $upSql1, $upSql2, $confirmSql );
	if (! $errMsg) {
		$actionSql = array_filter ( $actionSql );
		$result = transaction ( $pdo, $actionSql );
		$errMsg ['sql'] = $result ['error'];
		if (empty ( $errMsg ['sql'] )) {
			//删除所有数值都为0的数据
			delPrsMoney ( $pdo );
			$succMsg = "审核成功";
		}
	}
	$errMsg = array_filter ( $errMsg );
	if ($errMsg) {
		print_r ( $errMsg );
		exit ( "错误信息: " . fetchArray ( $errMsg ) );
	}
}
#下面这部分就是获取相应的值 a_prsRequireMoney
$reSql = "select a.ID,a.uID,b.name,a.uComInsMoney,a.pComInsMoney,a.type from `a_prsRequireMoney` a left join `a_workerInfo` b on a.uID = b.uID where a.month like :month and a.unitID like :unitID and ( a.uComInsMoney<>0 or a.pComInsMoney<>0) and b.uID is not null  ";
#这里就做个EXCEL筛选模式..
if ($_REQUEST ['selPost'] == "1") {
	foreach ( $_POST as $pKey => $pVal ) {
		if ($pKey != "selPost" && $pKey != "intoExcel") {
			//配置Smarty 模板的筛选变量..POST后选中的值
			$smartyName = "s_" . $pKey;
			$smarty->assign ( $smartyName, $pVal );
			$fieldSel = substr ( $pKey, 0, - 3 );
			switch ($pKey) {
				default :
					if ($pVal != "") {
						if ($pVal == "notNull")
							$selSql .= " and a.$fieldSel not like ''";
						elseif ($pVal == "Null")
							$selSql .= " and a.$fieldSel like ''";
						else
							$selSql .= " and a.$fieldSel = '$pVal'";
					}
					break;
			}
		}
	}
}
$reSql = $reSql . $selSql . " order by  a.uID,a.type";
$reRes = $pdo->prepare ( $reSql );
$reRes->execute ( array (
		":month" => $month,
		":unitID" => $unitID 
) );
$reRet = $reRes->fetchAll ( PDO::FETCH_ASSOC );
$type = array (
		"1" => "挂账",
		"2" => "欠款",
		"3" => "收回欠款",
		"4" => "冲减挂账" 
);
if ($reRet) {
	foreach ( $reRet as $rKey => $rVal ) {
		if ($rVal ['type'] == "1" || $rVal ['type'] == "2" || $rVal ['type'] == "3") {
			$totalMoneyArr [$rVal ['type']] ['uComInsMoney'] += $rVal ['uComInsMoney'];
			$totalMoneyArr [$rVal ['type']] ['pComInsMoney'] += $rVal ['pComInsMoney'];
		}
		if ($rVal ['type'] == "4") {
			$totalMoneyArr [$rVal ['type']] ['uComInsMoney'] += $rVal ['uComInsMoney'];
			$totalMoneyArr [$rVal ['type']] ['pComInsMoney'] += $rVal ['pComInsMoney'];
		}
		$uComInsMoneyArr [] = $rVal ['uComInsMoney'];
		$pComInsMoneyArr [] = $rVal ['pComInsMoney'];
		$typeArr [] = $rVal ['type'];
	}
	$uComInsMoneyArr = array_unique ( $uComInsMoneyArr );
	$pComInsMoneyArr = array_unique ( $pComInsMoneyArr );
	$typeArr = array_unique ( $typeArr );
}

if (isset ( $_POST ['editAccountMine'] )) {
	$showWindow = "<script>tipsWindown('本人挂账调整','iframe:" . httpPath . "salaryManage/editAccountMine.php?" . $_SERVER ['QUERY_STRING'] . "', '1024', '580', 'true', '', 'true', 'leotheme'); </script>";
}
if (isset ( $_POST ['editAccountCompany'] )) {
	$showWindow = "<script>tipsWindown('公司挂账调整','iframe:" . httpPath . "salaryManage/editAccountCompany.php?" . $_SERVER ['QUERY_STRING'] . "', '1024', '580', 'true', '', 'true', 'leotheme'); </script>";
}
if (isset ( $_POST ['editWriteDownMoney'] )) {
	$showWindow = "<script>tipsWindown('公司挂账调整','iframe:" . httpPath . "salaryManage/editWriteDownMoney.php?" . $_SERVER ['QUERY_STRING'] . "', '1024', '580', 'true', '', 'true', 'leotheme'); </script>";
}
#变量配置
$smarty->assign ( "unitManager", $unitManager );
$smarty->assign ( "reRet", $reRet );
$smarty->assign ( "eAR", $eAR );
$smarty->assign ( "totalMoneyArr", $totalMoneyArr );
$smarty->assign ( "type", $type );
$smarty->assign ( array (
		"exAppArr" => $exAppArr,
		"appMsg" => $appMsg 
) );
$smarty->assign ( array (
		"uComInsMoneyArr" => $uComInsMoneyArr,
		"pComInsMoneyArr" => $pComInsMoneyArr,
		"typeArr" => $typeArr 
) );
$smarty->assign ( "showWindow", $showWindow );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"authArr" => $authArr,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "approval/comInsBalFeeApproval.tpl" );
?>
