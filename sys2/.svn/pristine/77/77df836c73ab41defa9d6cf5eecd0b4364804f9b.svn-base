<?php
/*
 * 员工入职登记
 *  * 
 */
#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#连接通用函数库
require_once sysPath . 'common.function.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';

$title = "员工入职登记";

#获取get参数，将欲入职的人才信息查找出来
$tid = $_GET ['id'];
$uid = $_GET ['uid'];
if ($tid) {
	$sql = "select t.*,p.unitId,p.name as p_name from a_talent t left join a_position p on t.positionID = p.positionID 
			where talentID = " . $tid;
	
	$ret = $pdo->query ( $sql );
	$the_talent = $ret->fetch ( PDO::FETCH_ASSOC );
} elseif ($uid) {
	$sql = "select * from a_workerinfo w where w.uID = '" . $uid . "'";
	$ret = $pdo->query ( $sql );
	$the_worker = $ret->fetch ( PDO::FETCH_ASSOC );
}

//$smarty->debugging=true;
/*  初始化设置*/
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->wInfoSetArr ();
$wInfoSet = $wSet->wInfoSet;
//echo "<pre>";
//print_r($wInfoSet);
$firstOp = array ("" => "---请选择---" );
$status = $wInfoSet ['status'];
$role = $wInfoSet ['role'];
$type = $wInfoSet ['type'];
$domicile = $firstOp + $wInfoSet ['domicile'];
$proTitle = $wInfoSet ['proTitle'];
$proLevel = $wInfoSet ['proLevel'];
$cType =$wInfoSet ['cType'];
//额外的添加的员工信息项
$wInfoExtraField = wInfoExtraFieldSet();
//单位信息列表
$sql = "select mID,unitID,mName from s_user where roleID REGEXP '2_1,' ";
$res = $pdo->prepare ( $sql );
$res->execute ( array ($roleID ) );
$ret = @$res->fetchAll ( PDO::FETCH_ASSOC );
//单位信息查询
foreach ( $ret as $k => $v ) {
	if ($ret [$k] ['unitID'])
		$mUnitID .= $ret [$k] ['unitID'] . ",";
}
$mUnitID = rtrim ( $mUnitID, "," );
$sql = "select unitID,unitName from a_unitInfo where unitID in (" . $mUnitID . " ) order by unitName";
foreach ( $pdo->query ( $sql ) as $row ) {
	$unit [$row ['unitID']] = $row ['unitName'];
}
//$unit = array_merge(array("" => "--------------请选择单位-------------"), $unit);
$marriage = $wInfoSet ['marriage'];
$education = $wInfoSet ['education'];
$nation = $wInfoSet ['nation'];
$sex = $firstOp + $wInfoSet ['sex'];
$hospitalization = array ("" => "不参加", "1" => "综合", "2" => "住院", "4" => "合作" );
$hand = array ("1" => "右手", "2" => "左手" );
#smarty 参数定义
//资料的完整性
$smarty->assign ( "status", $status );
//派遣类型
$smarty->assign ( "type", $type );
//户口类型
$smarty->assign ( "domicile", $domicile );
//单位信息
$smarty->assign ( "unit", $unit );
//婚姻情况
$smarty->assign ( "marriage", $marriage );
//性别
$smarty->assign ( "sex", $sex );
//保险项目
$smarty->assign("hospitalization", $hospitalization);
$smarty->assign("hand", $hand);
$smarty->assign(array("wInfoExtraField" => $wInfoExtraField));
$smarty->assign(array("education" => $education, "nation" => $nation, "role" => $role, "proTitle" => $proTitle, "proLevel" => $proLevel,"cType"=>$cType));
if ($tid) {
	// 人才已有的信息自动填入表单:
	

	//	if(!($the_talent['unitID'] < 0))
	if ($the_talent ['unitID'] != "1000.001") {
		$sql = "select uID from a_workerInfo where unitID like '" . $the_talent ['unitId'] . "'";
		//生成UID数组,找到哪个拼音字母开头的数目比较多,然后求这个比较多的最大值
		foreach ( $pdo->query ( $sql ) as $row ) {
			$uIDArr [] = $row ['uID'];
		}
		foreach ( $uIDArr as $uIDV ) {
			$newUIDArr [] = str_replace ( substr ( $uIDV, - 5, 5 ), "", $uIDV );
		}
		$uIDCount = array_count_values ( $newUIDArr );
		//排序下,,,输出第一个就是最大值了
		arsort ( $uIDCount );
		$i = 0;
		foreach ( $uIDCount as $uIDK => $uIDV ) {
			if ($i == 0)
				$MaxuIDStr = $uIDK;
			$i ++;
		}
		
		$sql = "select max(uID) from a_workerInfo where uID like '$MaxuIDStr%' and unitID like '" . $the_talent ['unitId'] . "'";
		foreach ( $pdo->query ( $sql ) as $row ) {
			$uID = ++ $row ['max(uID)'];
		}
		$smarty->assign ( "uID_s", $uID );
		$smarty->assign ( "unit_s", $the_talent ['unitId'] );
	}
	$smarty->assign ( "tid", $tid );
	
	$smarty->assign ( "position", $the_talent ['p_name'] );
	$smarty->assign ( "name", $the_talent ['name'] );
	$smarty->assign ( "idCard", $the_talent ['idCard'] );
	$smarty->assign ( "mobile", $the_talent ['telephone'] );
	$smarty->assign ( "sex_s", $the_talent ['sex'] );

} 

else if ($uid) {
	$smarty->assign ( "uid", $uid );
	$smarty->assign ( "worker", $the_worker );
}

//模板配置信息
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "workerInfo/wMountGuard.tpl" );
?>