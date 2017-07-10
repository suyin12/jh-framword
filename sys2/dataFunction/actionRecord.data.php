<?php
/*
*       2013-1-7
*       <<<   操作记录统计表
*       status : 0 未签收,  1 签收 ,2 已 , 99 退回
*        >>>
*       create by Great sToNe
*       have fun,.....
*/
class actionRecord {
	public $pdo;
	public $ret; //返回的结果集
	#操作人员
	private function actioner() {
		return $actioner = array (
				"mID" => $_SESSION ['exp_user'] ['mID'],
				"mName" => $_SESSION ['exp_user'] ['mName'],
				"now" => timeStyle ( "dateTime", "-" ) 
		);
	}
	#操作记录提交
	function sponsor($type, $conStr,$status=0) {
		$pdo = $this->pdo;
		$actioner = $this->actioner ();
		$sql [0] = "delete from  `a_action_record` where `type`='$type' and `month`='$conStr[month]' and `unitID`='$conStr[unitID]'";
		$sql [1] = "insert into `a_action_record` set `status`=$status,`type`='$type',`month`='$conStr[month]',`unitID`='$conStr[unitID]',`createdBy`='" . $actioner ['mID'] . "',`createdOn`='" . $actioner ['now'] . "'";
		$ret = transaction ( $pdo, $sql );
		return $ret;
	}
	#签收
	function receive($ID) {
		$pdo = $this->pdo;
		$actioner = $this->actioner ();
		$sql[0] = "update `a_action_record` set `status`=1,`lastModifyBy`='" . $actioner ['mID'] . "',`lastModifyTime`='" . $actioner ['now'] . "' where ID in ($ID)";
		$ret = transaction ( $pdo, $sql );
		return $ret;
	}
	#退回
	function rollback($ID) {
		$pdo = $this->pdo;
		$actioner = $this->actioner ();
		$sql[0] = "update `a_action_record` set `status`=99,`lastModifyBy`='" . $actioner ['mID'] . "',`lastModifyTime`='" . $actioner ['now'] . "' where ID in ($ID)";
		$ret = transaction ( $pdo, $sql );
		return $ret;
	}
}
?>