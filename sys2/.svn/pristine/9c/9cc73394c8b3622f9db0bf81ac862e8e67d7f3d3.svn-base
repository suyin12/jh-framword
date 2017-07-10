<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once '../class/pagenation.class.php';


$title = "岗位管理";


//用工单位表
$sql = "select * from a_position a left join a_unitinfo b on a.unitId = b.unitID group by a.unitId";
$ret = $pdo->query($sql);
if($ret)
{
	$res = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($res as $v)
	{
		$units_opt[$v['unitID']] = $v['unitName'];
	}
}

//echo "<pre>";print_r($units);


	$sql = "select p.*,u.unitName from a_position p left join a_unitinfo u on p.unitId = u.unitID WHERE 1=1 ";
	
	$unit = $_GET['unit'];
	$pos = $_GET['pos'];
	
	
	if($unit)
		$sql .= " and p.unitID = '".$unit."' ";
	if($pos)
		$sql .= " and p.name like '%".$pos."%' ";

        $sql.= " and p.active='1' order by `positionID` DESC";
	$page = new Pagination();
	$page->page = $_GET['page'];
	$page->form_mothod = "get";
	$page->pagesize = 20;
	

	$page->count = $pdo->query($sql)->rowCount();
	
	$sql .= $page->get_limit(); //分页条件查询
	
	$ret = $pdo->query($sql);

	if($ret)
	{
		$positions_info = $ret->fetchAll(PDO::FETCH_ASSOC);
	}
		
	
//	$pageList = $page->page_list ( $_SERVER ['PHP_SELF'] . "?"  );//输出分页按扭get 方式

	if($_SERVER['QUERY_STRING'])
		$pageList = $page->page_list ( "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].preg_replace("/&page=[0-9]*/", "", $_SERVER["REQUEST_URI"])  );//输出分页按扭get 方式
	else 
		$pageList = $page->page_list ( "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]."?"  );//输出分页按扭get 方式




$smarty->assign("positions_info",$positions_info);
$smarty->assign("pageList",$pageList);
$smarty->assign("units_opt",$units_opt);

$smarty->assign("units_s",$unit);
$smarty->assign("pos_s",$pos);


$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/positionManage.tpl");

?>
