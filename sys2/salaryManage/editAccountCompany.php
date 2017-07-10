<?php
/*
*     2010-9-27
*          <<<公司挂账调整  >>>
*          1。要调整成公司挂账首先需要满足的两个必要条件: ①,已经完成二次平账 ②,已经完成个人挂账调整及调账给他人调整
*          2. 公司挂账部分默认商保,残障金,管理费为公司挂账(即默认勾选)
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

$title = "公司挂账调整";
$salaryDate = $_GET ['salaryDate'];
$soInsDate = $_GET ['soInsDate'];
$month =$_GET['month'];
$unitID = $_GET ['unitID'];
//获取本月有挂账的人员名单
$sql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID =b.uID where a.month like :month and a.unitID like :unitID and a.type like '1'";
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
							$sql .= " and a.$fieldSel not like ''";
						elseif ($pVal == "Null")
							$sql .= " and a.$fieldSel like ''";
						else
							$sql .= " and a.$fieldSel = '$pVal'";
					}
					break;
			
			}
		}
	}
}
$res = $pdo->prepare ( $sql );
$res->execute ( array (":month" => $month, ":unitID" => $unitID ) );
$re = $res->fetchAll ( PDO::FETCH_ASSOC );
foreach ( $re as $key => $val ) {
	$ret [$val ['uID']] = $val;
}
unset ( $re );
#找出本月申请公司挂账的记录
$eSql = " select * from a_editAccountList where unitID like :unitID and month like :month and type ='3'";
$eRes = $pdo->prepare ( $eSql );
$eRes->execute ( array (":month" => $month, ":unitID" => $unitID ) );
$eRet = $eRes->fetchAll ( PDO::FETCH_ASSOC );
foreach ( $eRet as $key => $val ) {
	$fieldArr = explode ( "|", $val ['field'] );
	foreach ( $fieldArr as $fv ) {
		$aT [$val ['roleA']] += $ret [$val ['roleA']] [$fv];
	}
	$retMA [$val ['roleA']] = $val;
}
//找出该被调账人的本月调账记录(如果未签收,则不可以调整成公司挂账)
$eSqlB = " select * from a_editAccountList where unitID like :unitID and month like :month and status='0' and type <>'3'";
$eResB = $pdo->prepare ( $eSqlB );
$eResB->execute ( array (":month" => $month, ":unitID" => $unitID ) );
$eRetB = $eResB->fetchAll ( PDO::FETCH_ASSOC );
foreach ( $eRetB as $key => $val ) {
	$retMB [$val ['roleB']] = $val;
}
//释放数组
unset ( $eRetB );
//获取操作的数组
if ($ret)
	foreach ( $ret as $key => $val ) {
		if ($retMB && array_key_exists ( $val ['uID'], $retMB )) {
			unset ( $ret [$key] );
		}
	}
if ($ret) {
	foreach ( $ret as $rKey => $rVal ) {
		$uPDInsMoneyArr [] = $rVal ['uPDInsMoney'];
		$uSoInsMoneyArr [] = $rVal ['uSoInsMoney'];
		$uComInsMoneyArr [] = $rVal ['uComInsMoney'];
		$managementCostMoneyArr [] = $rVal ['managementCostMoney'];
		$uOtherMoneyArr [] = $rVal ['uOtherMoney'];
	}
	$uPDInsMoneyArr = array_unique ( $uPDInsMoneyArr );
	$uSoInsMoneyArr = array_unique ( $uSoInsMoneyArr );
	$uComInsMoneyArr = array_unique ( $uComInsMoneyArr );
	$managementCostMoneyArr = array_unique ( $managementCostMoneyArr );
	$uOtherMoneyArr = array_unique ( $uOtherMoneyArr );
}
//print_r($uOtherMoneyArr);
$smarty->assign ( array ("ret" => $ret, "retMA" => $retMA, "retMB" => $retMB, "aT" => $aT ) );
$smarty->assign ( array ("uPDInsMoneyArr" => $uPDInsMoneyArr, "uSoInsMoneyArr" => $uSoInsMoneyArr, "uComInsMoneyArr" => $uComInsMoneyArr, "managementCostMoneyArr" => $managementCostMoneyArr, "uOtherMoneyArr" => $uOtherMoneyArr ) );

#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "salaryManage/editAccountCompany.tpl" );

?>