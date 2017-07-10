<?php

# 页面访问权限
require_once '../auth.php';
# 连接模板文件
require_once sysPath . 'templateConfig.php';
# 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'dataFunction/unit.data.php';
require_once sysPath . 'common.function.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';
# 分页
require_once sysPath . 'class/pagenation.class.php';

$title = "招聘需求管理";

# 排序选项
$order_opt = array (
		"status" => "签收状态" 
);
if(!$_GET){
	header ( "Location:" . $_SERVER ["PHP_SELF"] ."?order=" );
}
# 签收状态 
$status_opt = array (
		1 => "未签收",
		2 => "已退回",
		3 => "已签收" 
);

// 查询所有岗位
$sql = "SELECT positionID,name,unitName,shortcut FROM a_position p 
		left join a_unitinfo u on p.unitId = u.unitID where p.active = 1 order by shortcut";

$ret = $pdo->query ( $sql );
if ($ret) {
	$res = $ret->fetchAll ();
	foreach ( $res as $v ) {
		$positions [$v ['positionID']] = $v ['shortcut'] . "-" . $v ['name'] . "(" . $v ['unitName'] . ")";
	}
}

#客户经理
$sql = "SELECT mID,mName FROM s_user WHERE roleID  REGEXP '2_1,'";
$ret = $pdo->query ( $sql );
if ($ret) {
	$result = $ret->fetchAll ( PDO::FETCH_ASSOC );
	foreach ( $result as $v ) {
		$recruiter_opt [$v ['mID']] = $v ['mName'];
	}
}
//echo "<pre>";print_r($positions);exit();


//列举用工单位表
$sql = "select b.unitId,c.unitName from a_recruitdemand a left join a_position b on a.positionID = b.positionID left join a_unitinfo c on b.unitId = c.unitID group by b.unitId ";
$ret = $pdo->query ( $sql );
if ($ret) {
	$res = $ret->fetchAll ( PDO::FETCH_ASSOC );
	foreach ( $res as $v ) {
		$units [$v ['unitId']] = $v ['unitName'];
	}
}

/*
 *  先显示所有未处理的需求-招聘部门 | 已退回的需求-提出部门
 */

$sql_waiting = "SELECT r.batch,r.demandID,r.positionID,r.deadline,r.required,r.recommend,r.entry,r.status,r.createdBy as rCreatedBy,r.createdOn as rCreatedOn,p.*,u.mName,un.unitName FROM a_recruitdemand r 
		LEFT JOIN a_position p on r.positionID = p.positionID 
		LEFT JOIN a_unitinfo un on p.unitId = un.unitID
		LEFT JOIN s_user u on r.createdBy = u.mID WHERE r.status in ('1','2') order by r.createdOn DESC";
$ret = $pdo->query ( $sql_waiting );
if ($ret) {
	$requires_waiting = $ret->fetchAll ( PDO::FETCH_ASSOC );
	$smarty->assign ( "requires_waiting", $requires_waiting );
}

//echo "<pre>";print_r($requires_waiting);


/*
 *   这里合并显示已签收的需求
 */
$sql = "SELECT r.batch,r.demandID,r.positionID,r.deadline,r.required,r.recommend,r.entry,r.status,r.createdBy as rCreatedBy,r.createdOn as rCreatedOn,r.receiverBy,r.receiverTime,u.mName,p.name,p.unitID,p.lastPositionID,un.unitName FROM a_recruitdemand r 
		LEFT JOIN a_position p on r.positionID = p.positionID 
		LEFT JOIN a_unitinfo un on p.unitId = un.unitID
		LEFT JOIN s_user u on r.createdBy = u.mID WHERE   ";
if($_GET['history']=='true'){
	$sql .="r.status in ( 0,3)";
}else{
	$sql .="r.status = '3'";
}

$positionID = $_GET ['p'];
$unitID = $_GET ['u'];
$createdBy = $_GET ['cb'];
$createdOn = $_GET ['co'];
$order = $_GET ['order'];
$status = $_GET ['status'];

if ($positionID)
	$sql .= " and r.positionID = '" . $positionID . "' ";
if ($unitID)
	$sql .= " and un.unitID = '" . $unitID . "'";
	//	if($status)
	//		$sql .= " and r.status = '".$status."'";


if ($createdBy)
	$sql .= " and r.createdBy = '" . $createdBy . "'";
if ($createdOn)
	$sql .= " and r.createdOn = '" . $createdOn . "'";

$sql .= " group by r.positionID,r.batch,r.status ";

	$sql .= " order by r.createdOn DESC";

$page = new Pagination ();
$page->page = $_GET ['page'];
$page->form_mothod = "get";
$page->pagesize = 30;

$page->count = $pdo->query ( $sql )->rowCount ();

$sql .= $page->get_limit ();

$ret = $pdo->query ( $sql );
if ($ret) {
	$requires_info = $ret->fetchAll ( PDO::FETCH_ASSOC );
	
	foreach ( $requires_info as $k => $v ) {
		$positionIDStr = rtrim ( $v ['positionID'] . $v ['lastPositionID'], "," );
		#1. 上岗人数( 在上岗日期之后上岗的人员有多少人)
		$sql_total = "select  count(1) as yetTotal from a_talent where positionID in (" . $positionIDStr . ") and status='100' and `lastModifyTime`>='" . $v ['deadline'] . "';";
		$ret = $pdo->query ( $sql_total );
		$res = $ret->fetch ( PDO::FETCH_ASSOC );
		$requires_info [$k] ['yetTotal'] = $res ['yetTotal'];
	}
}

if ($_SERVER ['QUERY_STRING'])
	$pageList = $page->page_list ( "http://" . $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ["SERVER_PORT"] . $_SERVER ["REQUEST_URI"] ); //输出分页按扭get 方式
else
	$pageList = $page->page_list ( "http://" . $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ["SERVER_PORT"] . $_SERVER ["REQUEST_URI"] . "?" ); //输出分页按扭get 方式
	

$smarty->assign ( "positions", $positions );
$smarty->assign ( "requires_info", $requires_info );
$smarty->assign ( "recruiter_opt", $recruiter_opt );
$smarty->assign ( "units", $units );
$smarty->assign ( "pageList", $pageList );

$smarty->assign ( "order_opt", $order_opt );
$smarty->assign ( "status_opt", $status_opt );

$smarty->assign ( "position_s", $positionID );
$smarty->assign ( "unit_s", $unitID );
$smarty->assign ( "recruiter_s", $createdBy );
$smarty->assign ( "co_s", $createdOn );
$smarty->assign ( "status_s", $status );

$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "recruitManage/requireManage.tpl" );

?>