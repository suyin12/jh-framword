<?php

/**
 * Description of exportExcel
 *  单位的新增及信息更新
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#页面标题
$title = "单位设置";
#保险由哪方承担
$unitSet = unitSet ( $pdo );
$statusArr = $unitSet ['status'];
$typeArr = $unitSet ['type'];
$insuranceFromArr = $unitSet ['insuranceFrom'];
$insuranceModelArr = $unitSet ['insuranceModel'];
$insuranceMoneyReciveArr = $unitSet ['insuranceMoneyRecive'];
$comInsTypeArr = $unitSet ['comInsType'];
$soInsIDArr = $unitSet ['soInsID'];
$HFIDArr = $unitSet ['HFID'];

if ($_GET ["id"]) {
	$ID = $_GET ["id"];
	$sql = "SELECT * FROM `a_unitInfo`where `ID`=:ID";
	$ret = SQL ( $pdo, $sql, array (
			":ID" => $ID 
	), "one" );
	foreach ( $ret as $k => $v ) {
		switch ($k) {
			case "status" :
			case "type" :
			case "comInsType" :
			case "soInsFrom" :
			case "HFFrom" :
			case "notFullComInsFrom" :
			case "notFullSoInsFrom" :
			case "notFullHFFrom" :
			case "soInsModel" :
			case "HFMoneyRecive" :
			case "HFModel" :
			case "soInsID" :
			case "housingFundID" :
				$smarty->assign ( "s_$k", $v );
				break;
			default :
				$smarty->assign ( $k, $v );
				break;
		}
	}
}

if (isset ( $_POST ["edit"] )) {
	$bianji = $_POST ["edit"];
	switch ($bianji) {
		//修改“社保设置”
		case "modify" :
			foreach ( $_POST as $key => $val ) {
				switch ($key) {
					case "add" :
					case "edit" :
						break;
					case "unitID" :
						break;
					case "mCostLimit" : //如果是数组形式的,就不转义
						$str .= "`" . $key . "`='" . htmlspecialchars_decode ( $val ) . "',";
						break;
					default :
						$str .= "`" . $key . "`='" . $val . "',";
						break;
				}
			}
			$str = rtrim ( $str, "," );
			$sql = "update `a_unitInfo` set " . $str . " where `ID`='$ID' ";
			$affected = $pdo->exec ( $sql );
			if ($affected) {
				echo "<script>alert('修改成功！'); window.location.href=window.location.href;</script>";
			} else {
				echo "<script>alert('数据未作修改！') window.location.href=window.location.href;</script>";
			}
			break;
		case "add" :
			foreach ( $_POST as $key => $val ) {
				switch ($key) {
					case "add" :
					case "edit" :
						break;
					default :
						$str .= "`" . $key . "`='" . $val . "',";
						break;
				}
			}
			$str = rtrim ( $str, "," );
			$sql = "insert into `a_unitInfo` set " . $str;
			$affected = $pdo->exec ( $sql );
			$idStr = "id=" . $pdo->lastInsertId ();
			if ($affected) {
				echo "<script>alert('添加成功！'); location.href='unitInfo_edit.php?" . $idStr . "';</script>";
			} else {
				echo "<script>alert('添加失败！请更改类型编号'); window.location.href=window.location.href;</script>";
			}
			break;
	}
}
$smarty->assign ( array (
		"typeArr" => $typeArr,
		"statusArr" => $statusArr,
		"insuranceFromArr" => $insuranceFromArr,
		"insuranceModelArr" => $insuranceModelArr,
		"insuranceMoneyReciveArr" => $insuranceMoneyReciveArr,
		"comInsTypeArr" => $comInsTypeArr,
		"soInsIDArr" => $soInsIDArr,
		"HFIDArr" => $HFIDArr 
) );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "system/unitInfo_edit.tpl" );
?>
