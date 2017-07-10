<?php
/*
*     2010-12-8
*          <<< 用于设置不同类型的验证函数,这是一个类,封装成一个类  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

class approval {
	//链接数据库
	public $pdo;
	//月份
	public $month;
	//每月中的第几笔
	public $extraBatch;
	//单位
	public $unitID;
	//类型
	public $type;
	//操作的表明
	public $table;
	//查询条件
	public $conStr;
	//审批的URL
	public $url;
	//结果集
	public $exRet;
	//私有变量,具体的审批清单ID
	private $appProID;
	#判断是否存在
	public function validEx() {
		$pdo = $this->pdo;
		$type = $this->type;
		$table = $this->table;
		$extraBatch = $this->extraBatch;
		$conStr = $this->conStr;
		$exSql = "select * from a_approval_List where `type` like :type and `conStr` like :conStr and `status` in ('1','5','99') ";
		if ($table) {
			$exSql .= " and `table` like '$table'";
		}
		if ($extraBatch)
		    $exSql .= " and `extraBatch`='$extraBatch'";
		$exRes = $pdo->prepare ( $exSql );
		$exRes->execute ( array (":type" => $type, ":conStr" => $conStr ) );
		$exRet = $exRes->fetch ( PDO::FETCH_ASSOC );
		$this->exRet = $exRet;
		return $this->exRet;
	}
	#添加审批流程
	public function approvalSet($appID = null) {
		$mID = $_SESSION ['exp_user'] ['mID'];
		$mName = $_SESSION ['exp_user'] ['mName'];
		$now = timeStyle ( "dateTime", "-" );
		$pdo = $this->pdo;
		$month = $this->month;
		$extraBatch =$this->extraBatch;
		$unitID = $this->unitID;
		$type = $this->type;
		$table = $this->table;
		$conStr = $this->conStr;
		$url = $this->url;
		$exRet = $this->exRet;
		if ($exRet && $exRet ['status'] != '99' && $exRet ['status'] != '0') {
			$this->appProID = $exRet ['appProID'];
			$errMsg [] = "已提交申请,无需重复申请";
		} else {
			$appProID = $exRet ['appProID'];
			$appSql = "select * from s_approvalPro_set where `appID`= '$appID'";
			$appRes = $pdo->query ( $appSql );
			$appRet = $appRes->fetch ( PDO::FETCH_ASSOC );
			$process = array_filter ( explode ( ",", $appRet ['process'] ) );
			$i = 1;
		    $delSql = "delete from `a_approval_list` where `appProID`= '$appProID'";
			$pdo->query ( $delSql );
			$iALSql = "insert into `a_approval_list` set `type` ='$type',`month`='$month',`extraBatch`='$extraBatch',`unitID`='$unitID',`table`='$table',`conStr`='$conStr',`URL`='$url',`status`='5' ,`appID`='$appID',`sponsorName`='$mName',`sponsorTime`='$now'";
			$iALRes = $pdo->exec ( $iALSql );
			if (! $iALRes) {
				$errMsg [] = "获取appProID失败,请联系管理员";
			} else {
				$lastID = $pdo->lastInsertId ();
				$delSql = "delete from `a_approval_process` where `appProID`='$lastID'";
				$pdo->query ( $delSql );
				$insertSql = "insert into `a_approval_process` set ";
				foreach ( $process as $key => $val ) {
					$feildArr = makeArray ( $val );
					foreach ( $feildArr as $fK => $fV ) {
						$fArr = array_filter ( explode ( "|", $fV ) );
						foreach ( $fArr as $fkey => $fval ) {
							$inStr = null;
							if (! is_null ( $fval ))
								$inStr = " `appProID`='$lastID',`curKey`='$fK',`curVal`='$fval',`order`='$i',`status`='0'";
							$iSql [] = $insertSql . $inStr;
						}
						$i ++;
					}
				}
				//			echo "<pre>";
				//			print_r ( $iSql );
				$result = transaction ( $pdo, $iSql );
				$errMsg ['sql'] = $result ['error'];
				if (empty ( $errMsg ['sql'] )) {
					$succMsg = "审批提交成功";
				}
			}
		}
		if ($errMsg) {
			$errMsg = array_filter ( $errMsg );
			$errMsg = array_unique ( $errMsg );
			foreach ( $errMsg as $eV ) {
				$errorMsg .= $eV;
			}
			$errMsg = $errorMsg;
		}
		$msg = array ("error" => $errMsg, "succ" => $succMsg );
		$msg = array_filter($msg);
		return $msg;
	}
	public function approvalProcess() {
		$pdo = $this->pdo;
		$appProID = $this->appProID;
		$appProSql = "select * from a_approval_process where `appProID` like '$appProID'";
		$appProRet = SQL ( $pdo, $appProSql );
		return $appProRet;
	}
}
?>