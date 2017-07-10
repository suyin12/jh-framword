<?php
// 页面访问权限
require_once '../auth.php';
// 连接模板文件
require_once sysPath . 'templateConfig.php';
// 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'dataFunction/unit.data.php';
require_once sysPath . 'common.function.php';
//连接人才库类
require_once sysPath . 'dataFunction/talent.data.php';
#载入各相关类
require_once sysPath . 'dataFunction/market.data.php';
require_once sysPath . 'dataFunction/position.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#载入各相关连接类
require_once sysPath . 'dataFunction/classLink.data.php';

#标题
$title = "生成招聘数据统计";

# 日期数组
$j = 6; // 时间跨度在3个月以内
for($i = -1; $i < $j; $i ++) {
	$t = null;
	$t = strtotime ( timeStyle ( "firstdayMon", "" ) . "-$i month" );
	$key = date ( "Ym", $t );
	$DateArr [$key] = date ( "Y年m月", $t );
}
if (isset ( $_POST ['jxconfirm'] )) {
	#确定统计时间
	$month = $_POST ['month'];
	$s = date ( "Ym", strtotime ( $month."01 -1 month" ) ) . insuranceInTurn ( "recruit" );
	$e = date ( "Ymd", strtotime ( $month . insuranceInTurn ( "recruit" ) . " -1 day" ) );
	
	#设置显示的标题栏
	$engToCHN = array (
			"name" => "名称" 
	);
	$fieldDisplay = new fieldDisplay ();
	$fieldDisplay->style = "none";
	#各统计相关项
	$recruitManagerStatistics_head = array (
			"name",
			"cvNum",
			"createdByNum",
			"mountGuardNum",
			"rateSuccess",
			"marketNum",
			"phoneAccessNum" 
	);
	$fieldDisplay->actionArr = $recruitManagerStatistics_head;
	$recruitManagerStatistics_head = $fieldDisplay->fieldStyle ( 10, $engToCHN );
	$marketStatistics_head = array (
			"name",
			"cvNum",
			"marketNum",
			"mountGuardNum",
			"rateSuccess",
			"betterPosition" 
	);
	$fieldDisplay->actionArr = $marketStatistics_head;
	$marketStatistics_head = $fieldDisplay->fieldStyle ( 10, $engToCHN );
	$positionStatistics_head = array (
			"name",
			"cvNum",
			"mountGuardNum",
			"rateSuccess",
			"betterMarket" 
	);
	$fieldDisplay->actionArr = $positionStatistics_head;
	$positionStatistics_head = $fieldDisplay->fieldStyle ( 10, $engToCHN );
	#获取统计信息
	$b = new talent ();
	$b->pdo = $pdo;
	//加载人才库基础信息类
	$b->talentBasic ( " * ", " createdOn between '" . $s . "' and '" . $e . "'" );
	$b->classLinkClass();
	//加载单位基本信息类
	$b->x->unitClass ( array (
			"selStr" => " unitID,unitName " 
	) );
	//加载市场基础信息类
	$b->x->marketClass ( array (
			"selStr" => " marketID,name ",
			"conStr" => "1=1" 
	), array (
			"conStr" => " recruitDate between '" . $s . "' and '" . $e . "'" 
	) );
	$b->marketOrder ();
	//加载岗位基础信息类
	$b->x->positionClass ( array (
			"selStr" => " positionID,name,unitId as unitID ",
			"conStr" => "1=1" 
	) );
	//1.按招聘人员统计
	$recruitManagerStatistics = $b->recruitManagerStatistics ();
	//2.按招聘市场统计
	$marketStatistics = $b->marketStatistics ();
	//3.按招聘岗位统计
	$positionStatistics = $b->positionStatistics ();
	#设置显示的标题栏
	$fieldDisplay = new fieldDisplay ();
	$fieldDisplay->style = "none";
} // END $_POST['jxconfirm']


# 变量配置
$smarty->assign ( "DateArr", $DateArr );
$smarty->assign ( "s_month", $month );
$smarty->assign ( "statisticsDate", insuranceInTurn ( "recruit" ) );
$smarty->assign ( array (
		"recruitManagerStatistics_head" => $recruitManagerStatistics_head,
		"marketStatistics_head" => $marketStatistics_head,
		"positionStatistics_head" => $positionStatistics_head 
) );

$smarty->assign ( array (
		"recruitManagerStatistics" => $recruitManagerStatistics,
		"marketStatistics" => $marketStatistics,
		"positionStatistics" => $positionStatistics 
) );
# 模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "recruitManage/jxconfirm.tpl" );

?>