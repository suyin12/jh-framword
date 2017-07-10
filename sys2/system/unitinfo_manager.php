<?php

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#标题
$title = "用人单位管理";
#保险由哪方承担
$unitSet=unitSet($pdo);
$statusArr=$unitSet['status'];
$typeArr = $unitSet['type'];
$insuranceFromArr = $unitSet['insuranceFrom'];
$insuranceModelArr = $unitSet['insuranceModel'];
$insuranceMoneyReciveArr = $unitSet['insuranceMoneyRecive'];
$comInsTypeArr=$unitSet['comInsType'];
#各角色负责的单位
//1.客户经理
$mgrUnit = unit_manager($pdo,"2_1",null,'1');
//2.业务文员
$mgrLUnit =unit_manager($pdo,"2_2",null,'1');
//3.社保专员
$soInsUnit =unit_manager($pdo,"3_1",null,'1');
//4.公积金专员
$HFUnit =unit_manager($pdo,"3_5",null,'1');
//3.商保专员
$comInsUnit =unit_manager($pdo,"3_4",null,'1');
//3.就业登记专员
$jobRegUnit =unit_manager($pdo,"3_6",null,'1');
#商保缴交方式
$status = is_null($_GET["status"])?1:$_GET["status"];
if (!is_null($status)) {
    $retunitinfo = unitAll($pdo, " * ", " and `status`='$status' ");
} else {
    $retunitinfo = unitAll($pdo, " * ");
}

$smarty->assign("retunitinfo", $retunitinfo);
$smarty->assign(array("mgrUnit"=>$mgrUnit,"mgrLUnit"=>$mgrLUnit,"soInsUnit"=>$soInsUnit,"HFUnit"=>$HFUnit,"comInsUnit"=>$comInsUnit,"jobRegUnit"=>$jobRegUnit));
$smarty->assign(array("typeArr"=>$typeArr,"statusArr"=>$statusArr,"insuranceFromArr" => $insuranceFromArr,"insuranceModelArr" => $insuranceModelArr,"insuranceMoneyReciveArr"=>$insuranceMoneyReciveArr, "comInsTypeArr" => $comInsTypeArr));

#配置模板
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("system/unitinfo_manager.tpl");
?>