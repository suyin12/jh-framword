<?php

//页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
// 分页
require_once '../class/pagenation.class.php';

require_once '../dataFunction/unit.data.php';

$title = "党团工会管理";

$sql = "select * from a_dangtuangong ";

$page = new Pagination();
$page->page = $_GET['page'];
$page->form_mothod = "get";
$page->pagesize = 20;
$page->count = $pdo->query($sql)->rowCount();
$sql .= $page->get_limit();
$ret = $pdo->query($sql);

$dtg = SQL($pdo,$sql);

$pageList = $page->page_list($_SERVER ['PHP_SELF'] . "?"); //输出分页按扭get 方式

$smarty->assign("dtg", $dtg);
$smarty->assign("pageList", $pageList);
#
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/dangtuangong.tpl");
?>