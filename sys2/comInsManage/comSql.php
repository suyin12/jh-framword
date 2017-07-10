<?php
/*
*     2010-11-29
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
#连接权限验证文件(简单的一级验证,系统用户?)
require_once '../auth.php';
require_once sysPath . 'common.function.php';
$time = time ();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle ( "dateTime", "-" );
#商保专员签收社保申报表
if ($_POST ['btn'] == "receive") {
	$receiverName = $_SESSION ['exp_user'] ['mName'];
	$receiveTime = timeStyle ( "dateTime" );
	foreach ( $_POST ['chkList'] as $chkVal ) {
		list (  $unitID,$batch ) = explode ( "|", $chkVal );
		$sql[]="update a_comInsList a,a_workerInfo b set a.status='1',a.receiverName='$mName',a.receiveTime='$now' where a.uID=b.uID and b.unitID like '$unitID' and a.ComInsModifyDate like '$batch'";
	}
	//进行事务处理,所有更新成功为成功
	$result = extraTransaction ( $pdo, $sql );
	$errMsg = $result ['error'];
	$succNum = $result ['num'];
	if (empty ( $errMsg )) {
		$succMsg = "签收成功";
	}
	$msg = array ("error" => $errMsg, "succ" => $succMsg );
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}
if ($_POST ['btn'] == "rollback") {
	$receiverName = $_SESSION ['exp_user'] ['mName'];
	$receiveTime = timeStyle ( "dateTime" );
	foreach ( $_POST ['chkList'] as $chkVal ) {
		list (  $unitID,$comInsModifyDate ) = explode ( "|", $chkVal );
		$sql[]="update a_comInsList a,a_workerInfo b set a.status='99',a.receiverName='$mName',a.receiveTime='$now' where a.uID=b.uID and b.unitID like '$unitID' and a.comInsModifyDate like '$comInsModifyDate'";
	}
	//进行事务处理,所有更新成功为成功
	$result = extraTransaction ( $pdo, $sql );
	$errMsg = $result ['error'];
	$succNum = $result ['num'];
	if (empty ( $errMsg )) {
		$succMsg = "退回成功";
	}
	$msg = array ("error" => $errMsg, "succ" => $succMsg );
	$msg = array_filter ( $msg );
	$js_msg = json_encode ( $msg );
	echo $js_msg;
}


#平账结果提交
if (isset($_POST ['btn']) == "comInsBalFeeBtn" && $_POST ['type'] == "comInsFee") {
	$month = $_POST ['month'];
	$unitID = $_POST ['unitID'];
	$comInsDate = $_POST ['comInsDate'];
	//验证签收状态,签收后是不可以删除的
	$exSql = "select roleA from a_editAccountList where month like :month and unitID like :unitID and type like '7' and confirmStatus ='1' ";
	$exRes = $pdo->prepare($exSql);
	$exRes->execute(array(":unitID" => $unitID, ":month" => $month));
	$exCount = $exRes->rowCount();
	if ($exCount > 0) {
		$errMsg [] = "平账数据已存在,无需再次提交";
	} else {
		//先删除已经申请的平账记录,再做添加
		$deSql [0] = "delete from a_editAccountList where month like '$month' and unitID like '$unitID' and type = '7'";
		foreach ($_POST as $key => $val) {
			if (is_array($val)) {
				foreach ($val as $k => $v) {
					$tsql [$k] = "insert into `a_editAccountList` set `status`='1',`roleA`='$k',`roleB`='$k',`comInsDate`='$comInsDate',month='$month',unitID='$unitID',type='7',sponsorName='$mName',sponsorTime='$now',";
					switch ($key) {
						case "pComInsMoney" :
						case "uComInsMoney" :
							if ($v != 0) {
								$field [$k] .= $key . "|";
								$str [$k] .= "`" . $key . "`='" . $v . "',";
							}
							break;
						default :
							if ($v != 0) {
								$v = - $v;
								$str [$k] .= "`" . $key . "`='" . $v . "',";
							}
							break;
					}
				}
			}
		}
		foreach ($str as $sk => $sv) {
			$sql [$sk] = "insert into `a_editAccountList` set `status`='1',`roleA`='$sk',`roleB`='$sk',comInsDate='$comInsDate',month='$month',unitID='$unitID',type='7',sponsorName='$mName',sponsorTime='$now'," . $sv . "`field`='" . $field [$sk] . "'";
		}
		$actionSql = mergeArray($deSql, $sql);
		$result = extraTransaction($pdo, $actionSql);
		$errMsg ['sql'] = $result ['error'];
		if (empty($errMsg ['sql'])) {
			#这里另外单独建立了一个报表提交登记表
			require sysPath . "dataFunction/actionRecord.data.php";
			$a = new actionRecord ();
			$a->pdo = $pdo;
			$conStr = array("month"=>$month,"unitID"=>$unitID);
			$sql?$status="0":$status="1";
			$result = $a->sponsor ( '7', $conStr,$status );
			$succMsg = "提交成功";
		}
	}
	if ($errMsg) {
		$errMsg = array_filter($errMsg);
		$errMsg = array_unique($errMsg);
		foreach ($errMsg as $eV) {
			$errorMsg .= $eV . "<br/>";
		}
		$errMsg = $errorMsg;
	}
	$msg = array("error" => $errMsg, "succ" => $succMsg);
	$msg = array_filter($msg);
	$js_msg = json_encode($msg);
	echo $js_msg;
}
?>