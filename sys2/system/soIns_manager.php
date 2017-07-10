<?php
require_once ('../auth.php');
require_once ('../templateConfig.php');
#数据库操作类
require_once '../class/db_class.php';
#社保计算方法
require_once '../dataFunction/feeExtra.data.php';
$fee=new feeExtra($pdo);
$fee->soInsMonlist("distinct `month`","order by month asc");
$date=$fee->soInsMon(date("Ym"));
$title="社保管理";
$sql="SELECT * FROM `s_soins_set` where month ='{$date}' order by type";
$ret = $pdo->query($sql);
$res = $ret->fetchAll(PDO::FETCH_ASSOC);
$smarty->assign("soIns",$res);
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("system/soIns_manager.tpl");

?>