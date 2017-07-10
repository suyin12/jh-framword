<?php
/*
*     2010-7-13
*          <<<设置让windows自动运行的文档  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#单位,客户经理联动菜单
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';

#临时做个函数,,专门用来统计人数的..
function retCount($arr, $str) {
	foreach ( $arr as $value ) {
		foreach ( $value as $key => $val ) {
			if ($key == $str)
				$ar [] = $val;
		}
	}
	$count = array_count_values ( $ar );
	unset ( $wArr );
	return $count;
}

$title = "业务综合月报表";
if (timeStyle ( "d" ) >= insuranceInTurn("performance"))
	$toMon = date ( "Y-m", strtotime ( "+1 month" ) ) . "-".insuranceInTurn("performance");
else
	$toMon = timeStyle ( "Ym" ) . "-".insuranceInTurn("performance");
	#获取基本参数
//if (! $_GET ['mon'])
//	header ( "location:" . $_SERVER ['PHP_SELF'] . "?mon=" . $toMon );
$eT = $_GET ['mon'];
$bT = date ( "Y-m-d", strtotime ( "$eT -1 Month" ) );
#查询所有单位,因为是innodb类型的表,故不能用count(*),只能求出数组后用array_count_value来取得重复的单位的信息即为该单位人数
#客户经理roleID = '2_1',单位信息
$unitManager = unit_manager ( $pdo, "2_1" );
#1.在册人数,新增减少
//在册总人数
$sql = "select unitID from a_workerInfo where status not like '0'";
$res = $pdo->query ( $sql );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$wCount = @retCount ( $ret, "unitID" );
//在册新增
$sql = "select unitID from a_workerInfo where  mountGuardDay between :bT and :eT ";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$wIncreaseCount = @ retCount ( $ret, "unitID" );
//在册减少
$sql = "select a.unitID from a_workerInfo a left join a_dimission b on a.uID=b.uID where  b.dimissionDate between :bT and :eT ";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$wDecreaseCount = @ retCount ( $ret, "unitID" );
#2.合同相关
//1.新签合同数
$sql = "select unitID from a_workerInfo where  mountGuardDay between :bT and :eT and  cBeginDay <>0 and cEndDay <> 0";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$cIncreaseCount = @ retCount ( $ret, "unitID" );
//2.续签合同数
$sql = "select a.uID,b.unitID from a_renewalList a left join a_workerInfo b on a.uID=b.uID where a.sponsorTime  between :bT and :eT ";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$cRenewalCount = @ retCount ( $ret, "unitID" );
//3.新签实习生合同数
$sql = "select unitID from a_workerInfo where  mountGuardDay between :bT and :eT and  cBeginDay <>0 and cEndDay <> 0 and type like '3'";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$cStIncreaseCount = @ retCount ( $ret, "unitID" );
//4.新签其他情况合同数
$sql = "select unitID from a_workerInfo where  mountGuardDay between :bT and :eT and  cBeginDay <>0 and cEndDay <> 0 and type not in ('0','1','2','3')";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$cOtIncreaseCount = @ retCount ( $ret, "unitID" );
//5.累计合同
$sql = "select unitID from a_workerInfo where  mountGuardDay <= :eT and  cBeginDay <>0 and cEndDay <> 0 ";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$cTotalCount = @ retCount ( $ret, "unitID" );
#工资相关
//1.应发数
//2.实发数
//3.待发数
#社保
//1.新增(为啥以社保购买日为准呢,,其实也可以以社保申报表的新增为准,)
$sql = "select unitID from a_workerInfo where  soInsBuyDate between :bT and :eT";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$sInsIncreaseCount = @ retCount ( $ret, "unitID" );
//2.减少
$sql = "select a.unitID from a_workerInfo a right join a_soInsList b on a.uID=b.uID where b.soInsModifyDate between :bT and :eT and a.uID is not null and b.soInsurance like '0'";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $bT, ":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$sInsDecreaseCount = @ retCount ( $ret, "unitID" );
//3.参保
$sql = "select unitID from a_workerInfo where soInsurance in ('1','2') and soInsBuyDate <= :eT";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$sInsCount = @ retCount ( $ret, "unitID" );
#商保(这里统计人数只能是自然月,不在是上月20到本月20了)
$tM = timeStyle ( "Ym" ) . "-01";
if (timeStyle ( "d" ) >=insuranceInTurn("performance")) {
	$comBatch = "Com." . timeStyle ( "Ym", "" );
	$helpBatch = "Help." . timeStyle ( "Ym", "" );
} else {
	$comBatch = "Com." . date ( "Ym", strtotime ( "-1 month" ) );
	$helpBatch = "Help." . timeStyle ( "Ym", "" );
}
//1.实收数(这个就要从费用表里面出来了)
//2.实缴
$sql = "select b.unitID from a_comInsList a left join a_workerInfo b on a.uID=b.uID where  a.batch like :batch";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":batch" => $comBatch ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$cInsCount = @ retCount ( $ret, "unitID" );
#互助会
//1.新增
$sql = "select unitID from a_workerInfo where  mountGuardDay  between :bT and :eT and helpCost like '1'";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":bT" => $tM, ":eT" => timeStyle ( "finallyDayMon" ) ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$heIncreaseCount = @ retCount ( $ret, "unitID" );
//2.会员总数
$sql = "select unitID from a_workerInfo where helpCost like '1' and mountGuardDay  <= :eT";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":eT" => $eT ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$heCount = @ retCount ( $ret, "unitID" );
#深圳户籍
//1.深户
$sql = "select unitID from a_workerInfo where domicile like '1' and status not like '0'";
$res = $pdo->prepare ( $sql );
$res->execute ();
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$szCount = @ retCount ( $ret, "unitID" );
//2.非深户
$sql = "select unitID from a_workerInfo where domicile like '2' and status not like '0'";
$res = $pdo->prepare ( $sql );
$res->execute ();
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
$nszCount = @ retCount ( $ret, "unitID" );
$arr = $_ENV;
echo "<pre>";
print_r($arr);
?>