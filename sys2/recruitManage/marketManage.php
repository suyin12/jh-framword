<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once ('../class/pagenation.class.php');

$title = "渠道管理";

// 招聘部人员名单
$sql = "SELECT mID,mName FROM s_user WHERE groupID  REGEXP '4,'";
$ret = $pdo->query($sql);
if($ret)
{
	$result = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $v)
	{
		$users[$v['mID']] = $v['mName'];
	}
}

// 显示现有市场信息
$sql = "select m.*,s.mName from a_market m left join s_user s on m.openBy = s.mID where active !=0";



	$page = new Pagination();
	$page->page = $_GET['page'];
	$page->form_mothod = "get";
	$page->pagesize = 50;
	

	$page->count = $pdo->query($sql)->rowCount();
	
	$sql .= $page->get_limit(); //分页条件查询

	$ret = $pdo->query($sql);
	if($ret)
	{
		$markets_info = $ret->fetchAll(PDO::FETCH_ASSOC);
	}
	
	if($_SERVER['QUERY_STRING'])
		$pageList = $page->page_list ( "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]  );//输出分页按扭get 方式
	else 
		$pageList = $page->page_list ( "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]."?"  );//输出分页按扭get 方式

	


$smarty->assign("users",$users);
$smarty->assign("markets_info",$markets_info);
$smarty->assign("pageList",$pageList);

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/marketManage.tpl");

?>