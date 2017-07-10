<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 分页
require_once '../class/pagenation.class.php';

require_once 'constantConfig.php';
require_once '../dataFunction/unit.data.php';

$c_type_opt = array(1=>"派遣员工",2=>"代理员工",3=>"个人代理",4=>"增值服务");


$title = "档案管理";

$type = $_GET['type'];
$name = $_GET['name'];
$idcard = $_GET['idcard'];

$sql = "select a.*,u.mName from a_archive a left join s_user u on a.manager = u.mID where a.wtype = '".$type."'";

if($name)
	$sql .= " and a.name = '".$name."' ";
if($idcard)
	$sql .= " and a.idcard = '".$idcard."' ";

	$page = new Pagination();
	$page->page = $_GET['page'];
	$page->form_mothod = "get";
	$page->pagesize = 20;
	
	$page->count = $pdo->query($sql)->rowCount();

	$sql .= $page->get_limit();
	
$ret = $pdo->query($sql);
if($ret)
{
	$archives = $ret->fetchAll(PDO::FETCH_ASSOC);
	$smarty->assign("archives",$archives);
	$smarty->assign("type",$type);
}

$pageList = $page->page_list ( $_SERVER ['PHP_SELF']."?");


$smarty->assign("c_type_opt",$c_type_opt);
$smarty->assign("c_type_selected",$type);
$smarty->assign("name_selected",$name);
$smarty->assign("idcard_selected",$idcard);
$smarty->assign("pageList",$pageList);


$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );

$smarty->display("agencyService/archives.tpl");

?>