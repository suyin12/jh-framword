<?php
/*
*     2010-9-14
*          <<< 本人不同费用减的费用调整...从本人的挂账中支付 >>>
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

$title = "本人挂账调整";
$salaryDate = $_GET ['salaryDate'];
$soInsDate = $_GET ['soInsDate'];
$month =$_GET['month'];
$unitID = $_GET ['unitID'];
//获取本月有挂账的人员名单
$sql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID =b.uID where a.month like :month and a.unitID like :unitID and a.type like '1'";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":month" => $month, ":unitID" => $unitID ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
//获取有累计欠款的人员名单,包括本月欠款的(最近的一条欠款记录)
$sql = "select a.uID as uID,sum(a.uPDInsMoney) as uPDInsMoney,sum(a.uSoInsMoney) as uSoInsMoney,sum(a.uComInsMoney) as uComInsMoney,sum(a.managementCostMoney) as managementCostMoney,sum(a.uOtherMoney) as uOtherMoney  from `a_prsRequireMoney` a
           left join `a_workerInfo` b on a.uID = b.uID where a.month <= :month and a.status='0' and a.type in ('2','3') and a.unitID like :unitID and b.uID is not null
            group by a.uID HAVING sum(a.uPDInsMoney) <>0 or sum(a.uSoInsMoney) <>0 or sum(a.uComInsMoney) <>0 or sum(a.managementCostMoney)<>0 or sum(a.uOtherMoney) <>0";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":month" => $month, ":unitID" => $unitID ) );
$retMoney = $res->fetchAll ( PDO::FETCH_ASSOC );
foreach ( $retMoney as $val ) {
	$retM [$val ['uID']] = $val;
}
unset ( $retMoney );
//获取操作的数组
foreach ( $ret as $key => $val ) {
	if (! array_key_exists ( $val ['uID'], $retM )) {
		unset ( $ret [$key] );
	}
}

$eSql = " select * from a_editAccountList where unitID like :unitID and month like :month and type like '1'";
$eRes = $pdo->prepare ( $eSql );
$eRes->execute ( array (":month" => $month, ":unitID" => $unitID ) );
$eRet = $eRes->fetchAll(PDO::FETCH_ASSOC);
foreach ($eRet as $key=>$val){
	$retMA [$val['roleA']]=$val;
}
$smarty->assign ( array ("ret" => $ret, "retM" => $retM,"retMA"=>$retMA ) );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "salaryManage/editAccountMine.tpl" );
?>