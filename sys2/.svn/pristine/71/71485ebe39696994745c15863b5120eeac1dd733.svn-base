<?php
/*
*     2010-5-13
*          <<<  员工信息汇总,该功能,是统计每个单位的人数,及当前客户经理的情况>>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath.'templateConfig.php';
#单位,客户经理联动菜单
require_once sysPath.'dataFunction/unit.data.php';

$title = "员工信息汇总";
//$smarty->debugging =  true;
#查询所有单位,因为是innodb类型的表,故不能用count(*),只能求出数组后用array_count_value来取得重复的单位的信息即为该单位人数


// 先查询出所有客户经理负责的单位的unitID

$sql = "select unitID from s_user where roleID REGEXP '2_1,' and status='1' ";
$ret = $pdo->query($sql);
if($ret)
{
	$unitIDs = $ret->fetchAll(PDO::FETCH_ASSOC);
	$unit_str = "";
	foreach($unitIDs as $unitid)
	{
		if($unitid['unitID'])
			$unit_str .= ($unit_str?",":"").$unitid['unitID']; 
	}
	
}


$sql = "select unitID from a_workerInfo where status not like '0' and unitID in (".$unit_str.")" ;

$res = $pdo->query ( $sql );
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
foreach ( $ret as $value ) {
	foreach ( $value as $key => $val ) {
		if ($key == 'unitID')
			$unitArr [] = $val;
	}
}

$sql2 = "select unitID from a_workerinfo where userID <> 0 and status=1 and unitID in (".$unit_str.") ";
$res2 = $pdo->query ( $sql2 );
$ret2 = $res2->fetchAll(PDO::FETCH_ASSOC);
foreach ( $ret2 as $value ) {
    foreach ( $value as $key => $val ) {
        if ($key == 'unitID')
            $unitArr2 [] = $val;
    }
}

$unitCount = array_count_values ( $unitArr );
$unitCounts = array_count_values($unitArr2);
#客户经理roleID = '2_1',单位信息

$unitManager = unit_manager ( $pdo, "2_1",null,"1" );
foreach($unitManager as $key=>$val){
	foreach($val['unit'] as $k=>$v){
		$managerCount[$val['mID']]+=$unitCount[$v['unitID']];
	}
}

$unitManager2 = unit_manager ( $pdo, "2_1",null,"1" );
foreach($unitManager2 as $key=>$val){
    foreach($val['unit'] as $k=>$v){
        $loginCounts[$val['mID']]+=$unitCounts[$v['unitID']];
    }
}
// echo "<pre>";
// print_r($unit_str);
//exit();

#变量配置
$smarty->assign ( "unitCount", $unitCount );
$smarty->assign ( "unitCounts", $unitCounts );
$smarty->assign ( "unitManager", $unitManager );
$smarty->assign ( "loginCounts", $loginCounts );
$smarty->assign ( "managerCount", $managerCount );

#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "leader/workerInfoSummary.tpl" );
?>