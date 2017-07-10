<?php
// 面访问权限
require_once '../../auth.php';
// 接模板文件
require_once sysPath . 'templateConfig.php';
require_once sysPath . 'common.function.php';
//
require_once '../settings.inc';

// 细表链接
$tableline = array (
		"so_bal_3_tmp&width=100%&amp;height=80%",
		"so_bal_2&width=100%&amp;height=80%",
		"so_bal_5&width=100%&amp;height=80%",
		"so_bal_4&width=100%&amp;height=80%",
		"so_bal_2_tmp&width=100%&amp;height=80%",
		"so_bal_6_tmp&width=100%&amp;height=80%" 
);

// 期数组
$j = 6; // 时间跨度在6个月以内
for($i = - 1; $i < $j; $i ++) {
	$t = null;
	$t = strtotime ( timeStyle ( "firstdayMon", "" ) . "-$i month" );
	$key = date ( "Ym", $t );
	$ymonth [$key] = date ( "Y年m月", $t );
}

$smarty->assign ( 'ymonth', $ymonth );
$smarty->assign ( 'url', "../Parser/societyManage/xls2mysql/indexBalance.php/" );
$smarty->assign ( 'tableline', $tableline );

$smarty->assign ( array (
		"title" => "代理平账",
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "OA/51jobMain.tpl" );

?>