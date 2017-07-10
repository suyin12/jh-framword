<?php
require_once ('../auth.php');
require_once ('../templateConfig.php');

$sql="SELECT * FROM `s_comins_set`";
$ret = $pdo->query($sql);
$res = $ret->fetchAll(PDO::FETCH_ASSOC);
$smarty->assign("comIns",$res);
$title="商保管理";
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ("system/comIns_manager.tpl");
?>