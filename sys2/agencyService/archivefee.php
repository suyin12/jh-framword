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
require_once '../common.function.php';

$title = "缴费";

$aid = $_GET['aid'];

$sql = "select a.id as a_id ,a.name,a.sex,a.idcard,a.type,f.* from a_archive a left join a_archivehistoryfee f on a.id = f.aid where a.id = ".$aid ;
$ret = $pdo->query($sql);
if(!$ret)
{
	sys_error($smarty,"参数错误");
}

$the_archive = $ret->fetchAll(PDO::FETCH_ASSOC);
$type = $the_archive[0]['type'];
if($type == 1)
{
	sys_error($smarty,"派遣员工无需缴费");
}


$smarty->assign("the_archive",$the_archive);



$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("agencyService/archivefee.tpl")
?>