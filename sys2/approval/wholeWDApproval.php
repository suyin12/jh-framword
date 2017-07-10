<?php
/*
*     2010-11-18
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#通用函数库
require_once '../common.function.php';
$title = "整体类:冲减挂账";
$type = $_GET ['type'];
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle ( "dateTime", "-" );
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
if($nRet){
	//更改签收状态
	 $upSql = "update a_uWriteDownList set status='1',receiverName='$mName',receiveTime='$now' where status ='0' and  month like '$month' and unitID like '$unitID'";
    $pdo->query($upSql);
}
$listSql = "select a.*,b.typeName from a_approval_list a left join s_approvalPro_set b on a.appID=b.appID where a.appProID like :appProID";
$listRes = $pdo->prepare ( $listSql );
$listRes->execute ( array (":appProID" => $appProID ) );
$listRet = $listRes->fetch ( PDO::FETCH_ASSOC );
#获取单位信息表
$unit = unitAll ( $pdo, " unitID,unitName " );
$typeArr = array ("wholeWD" => array ("name" => "整体冲减挂账", "url" => httpPath . "salaryManage/editWriteDownMoney.php" ) );
$extArr = array ("month" => $month, "unitID" => $unitID );
$sql = "select a.*,b.unitName from a_uWriteDownList a left join a_unitInfo b on a.unitID=b.unitID where ".$listRet['conStr'] ." and a.status='1' ";
$ret = SQL ( $pdo, $sql, $extArr );

//echo "<pre>";
//print_r ( $nRet );
#变量配置
$smarty->assign ( "nRet", $nRet );
$smarty->assign ( "listRet", $listRet );
$smarty->assign ( "unit", $unit );
$smarty->assign ( "ret", $ret );
$smarty->assign ( array ("nameR" => $nameR, "typeArr" => $typeArr ) );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "approval/wholeWDApproval.tpl" );
?>