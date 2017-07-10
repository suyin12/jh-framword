<?php
/*
*     2011-1-25
*          <<< 管理层相关管理功能,数据库操作 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
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

#修改台账标签及备注
if ($_POST ['btn'] == "leEditBtn") {
	list ( $ID, $field ) = explode ( "|", $_POST ['ID'] );
	$value = $_POST ['value'];
	$upSql [0] = " update `a_ledger` set `$field`='$value',`lastModifyName`='$mName',`lastModifyTime`='$now' where `ID`='$ID'";
	$result = transaction ( $pdo, $upSql );
	$errMsg = $result ['error'];
	if (empty ( $errMsg )) {
		$succMsg = "修改成功";
	}
	$msg = array ("error" => $errMsg, "succ" => $succMsg );
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}

#删除台账记录
if ($_POST ['btn'] == "leDel") {
	//删除台账记录,同时更新 a_orginalFee表中该单位,本月的费用表为"未入台账", 台账表中的记录必需是 type='1' 即是劳务费类型的台账
	$ID = $_POST ['ID'];
	
	#把费用表中的数据改变为未确认
	$upSql [0] = "update `a_originalFee` a,`a_ledger` b set a.`confirmStatus`='0' where  b.`ID`='$ID' and b.`type`='1' and a.`month`=b.`month` and a.`unitID`=b.`unitID`";
	$upSql [1] = "update `a_rewardfee` a,`a_ledger` b set a.`confirmStatus`='0' where  b.`ID`='$ID' and b.`type`='1' and a.`month`=b.`month` and a.`unitID`=b.`unitID`";
	#查询在生成台账时被更新成1 的记录,并更新回0
	$needUpSql = "select prsReID,ID from `a_ledger_prsReMoney_tmp` where `ledgerID`='$ID' order by ID desc";
	$needUpRet = SQL ( $pdo, $needUpSql, NULL, "one" );
	if ($needUpRet ['prsReID']){
		$upSql [2] = "update `a_prsRequireMoney`  set status='0' where ID in (" . $needUpRet ['prsReID'] . ") ";
		$delSql[1] = "delete from `a_ledger_prsReMoney_tmp` where ID ='".$needUpRet['ID']."' ";
	}
	#这里要改,如果有冲减挂账的话,,除冲减挂账外的其他项目全部清空,
//	$insertSql[0] = "insert into `a_ledger` (`month`,`unitID`,`type`,`WDMoney`)select `month`,`unitID`,`type`,`WDMoney` from `a_ledger` where `ID`='$ID'  and `WDMoney`>'0'";
	$delSql [0] = "delete from `a_ledger` where `ID`='$ID'";
	$actionSql = mergeArray ( $upSql, $delSql );
//	$actionSql = mergeArray ( $upSql, $insertSql,$delSql );
//	print_r($actionSql);
	$result = extraTransaction ( $pdo, $actionSql );
	$errMsg = $result ['error'];
	if (empty ( $errMsg )) {
		$succMsg = "删除成功";
	}
	$msg = array ("error" => $errMsg, "succ" => $succMsg );
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
?>