<?php
/*
*     2011-1-18
*          <<<验证审批流程是否都已经完事  >>>
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

#标题
$title = "入台账前的验证审批";
$time = time ();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle ( "dateTime", "-" );
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
if (! $unitID or ! $month)
	exit ( "访问地址出错" );

	#获取需要审批的流程,并记录到数据库中
$exSql = "select * from `a_valid_approval_finished` where `month` like :month and `unitID` like :unitID ";
$exRes = $pdo->prepare ( $exSql );
$exRes->execute ( array (":unitID" => $unitID, ":month" => $month ) );
$exNum = $exRes->rowCount ();
if (! $exNum) {
	#获取需要验证的审批流程,并保存在数据库中
	//添加费用表,为必要验证条件 a_originalFee
	if ($authArr ['approval']) {
		foreach ( $authArr ['approval'] as $val ) {
			$inSql [] = "insert into `a_valid_approval_finished` set `month`='$month',`unitID`='$unitID',`approvalType` ='$val[type]',`status`='0',`sponsorName`='$mName',`sponsorTime`='$now' ";
		}
		//进行事务处理,所有更新成功为成功
		$result = transaction ( $pdo, $inSql );
		$errMsg = $result ['error'];
		$succNum = $result ['num'];
		if ($errMsg) {
			exit ( "发生未知错误,系统不能载入审批流程,请联系管理员[$errMsg]" );
		}
	}
}

#直接更新,先更新为1，再更新为0 ,因为存在同一个type多条审批流程
  $upSql1  = "update `a_valid_approval_finished` x,(select a.ID from `a_valid_approval_finished` a left join`a_approval_list`  b on (a.`approvalType`=b.`type` and a.`month`=b.`month` and a.`unitID`=b.`unitID`) where   a.`month`='$month' and a.`unitID`='$unitID'  and b.`status` is null or b.`status` = '1' ) y set x.status='1' where x.ID=y.ID ";
 
$upSql2 = "update `a_valid_approval_finished` a,`a_approval_list` b set a.`status`='0' where a.`approvalType`=b.`type` and a.`month`='$month' and a.`unitID`='$unitID' and a.`month`=b.`month` and a.`unitID`=b.`unitID` and b.`status` !='1'";
$actionSql = array ($upSql1, $upSql2 );
$result = extraTransaction ( $pdo, $actionSql );
$errMsg = $result ['error'];
if ($errMsg)
	exit ( "发生未知错误,系统不能载入审批流程,请联系管理员[$errMsg]" );

	#重新获取数据库中需要验证的审批流程
$sql = "select a.*,b.typeName from `a_valid_approval_finished` a left join `s_approvalPro_set` b on a.approvalType=b.type where a.`month` like :month and a.`unitID` like :unitID group by a.approvalType";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":unitID" => $unitID, ":month" => $month ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
//echo "<pre>";
//print_r($ret);
#变量配置
$smarty->assign ( "ret", $ret );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "leader/validApprovalFinished.tpl" );
?>