<?php
/*
*     2010-12-28
*          <<< 这个主要用来用作审批的主要界面 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接数据函数
require_once sysPath . 'dataFunction/unit.data.php';

#页面标题
$title = "审批索引页";
$mID = $_SESSION ['exp_user'] ['mID'];
$mSql = "select mID,mName,groupID,subGroupID,roleID from s_user where `mID` like '$mID'";
$mRes = $pdo->query ( $mSql );
$mRet = $mRes->fetch ( PDO::FETCH_ASSOC );
#
if (! $_GET ['process'])
	header("location:".httpPath.'approval/approvalIndex.php?process=process');
#控制页面中需要几个审批流程
#设立typeURL
$appTypeArr = array ("fee", "WDWhole", "WDDetail", "editTheir","reward" );
if ($authArr ['approval']) {
	$appTypeNeedArr = array_intersect ( $appTypeArr, array_keys ( $authArr ['approval'] ) );
	foreach ( $appTypeNeedArr as $atv ) {
		if ($atv)
			$typeStr .= "'" . $atv . "',";
	}
	$typeStr = rtrim ( $typeStr, "," );
}

#获取该人员是否有对应的审批流程,分成两部分, 一部分是查未审批及未完成的审批,另一部分是近50条已经审批的数据
foreach ( $mRet as $mKey => $mVal ) {
	
	switch ($mKey) {
		case "mID" :
			//一个人只有一个mid
			$nSql = $nRes = $nRet = null;
			$nSql = "select  appProID from v_approval_listPro where `curKey` like '$mKey' and `curVal` like '$mVal'  ";
			if ($typeStr)
				$nSql .= " and type in ($typeStr) ";
			$nSql .= " group by appProID";
			$nRes = $pdo->query ( $nSql );
			$nRet = $nRes->fetchAll ( PDO::FETCH_ASSOC );
			if ($nRet)
				$appProIDArr [] = $nRet;
			break;
		default :
			//获取当一个人多个角色的情况
			if ($mVal) {
				$roRet = explode ( ",", $mVal );
				foreach ( $roRet as $roVal ) {
					if ($roVal) {
						$nSql = $nRes = $nRet = null;
						$nSql = "select  appProID from v_approval_listPro where `curKey` like '$mKey' and `curVal` like '$roVal'  ";
						if ($typeStr)
							$nSql .= " and type in ($typeStr) ";
						$nSql .= " group by appProID";
						$nRes = $pdo->query ( $nSql );
						$nRet = $nRes->fetchAll ( PDO::FETCH_ASSOC );
						if ($nRet)
							$appProIDArr [] = $nRet;
					}
				}
			}
			break;
	}
}
$appProIDArr = array_unique ( $appProIDArr );
foreach ( $appProIDArr as $aVal ) {
	foreach ( $aVal as $aK => $aV ) {
		$appProIDA [] = $aV ['appProID'];
	}
}
unset ( $appProIDArr, $nRet, $mRet );
$appProIDA = array_unique ( $appProIDA );
foreach ( $appProIDA as $av ) {
	$appProIDStr .= "'" . $av . "',";
}
$appProIDStr = rtrim ( $appProIDStr, "," );
#获取该人员所有未处理的审批流程
if ($_GET ['process'] == 'process')
	$listNSql = "select a.appProID,a.extraBatch,a.month,a.unitID,a.status,a.appID,a.type,b.typeName from a_approval_list a left join s_approvalPro_set b on a.appID=b.appID where a.status !='1' and a.appProID in ($appProIDStr)";
elseif ($_GET ['process'] == 'history')
	$listNSql = "select a.appProID,a.extraBatch,a.month,a.unitID,a.status,a.appID,a.type,b.typeName from a_approval_list a left join s_approvalPro_set b on a.appID=b.appID where a.status ='1' and  a.appProID in ($appProIDStr) order by a.appProID desc limit 0,50 ";
$listNRet = SQL ( $pdo, $listNSql );

#获取单位信息表
$unit = unitAll ( $pdo, " unitID,unitName " );
#变量配置
$smarty->assign ( "listNRet", $listNRet );
$smarty->assign ( "unit", $unit );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "approval/approvalIndex.tpl" );
?>