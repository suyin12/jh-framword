<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 分页
require_once '../class/pagenation.class.php';


require_once '../dataFunction/unit.data.php';
$typeArr = array(1 => "派遣员工", 2 => "代理员工", 3 => "个人代理", 4 => "增值服务");


$title = "档案信息统计";

$sql = "select count(*) as total,wtype from a_archive group by wtype";
$ret = $pdo->query($sql);
$res = $ret->fetchAll(PDO::FETCH_ASSOC);
$data = keyArray($res, "wtype");
#
$smarty->assign("data", $data);
$smarty->assign("typeArr", $typeArr);
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/archiveStatus.tpl");
?>