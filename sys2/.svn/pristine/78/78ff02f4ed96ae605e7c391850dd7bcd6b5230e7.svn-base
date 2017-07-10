<?php

/*
 *     2012-4-8
 *          <<<  添加原始费用表记录>>>
 *      create by  Great sToNe
 * 
 *      shi35dong@gmail.com
 * 
 *      have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#标题
$title = "添加记录";

$a = $_GET['a'];
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
$extraBatch = $_GET ['extraBatch'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");

switch ($a) {
    //原始费用表
    case "originalFee_tmp":
        $sql = "select unitID,zID,month,salaryDate,soInsDate,HFDate,comInsDate,managementCostDate from a_originalFee_tmp where month like :month and unitID like :unitID";
        $ret = SQL($pdo, $sql, array(":unitID" => $unitID, ":month" => $month), "one");
        break;
    //多批次原始费用表:
    case "mulFee_tmp":
        $sql = "select unitID,zID,month,extraBatch,salaryDate,soInsDate,HFDate,comInsDate,managementCostDate from a_originalFee_tmp where month like :month and unitID like :unitID and extraBatch like :extraBatch";
        $ret = SQL($pdo, $sql, array(":unitID" => $unitID, ":month" => $month, ":extraBatch" => $extraBatch), 'one');
        break;
}
#变量配置
$smarty->assign("a", $a);
$smarty->assign("ret", $ret);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("salaryManage/addRecord.tpl");
?>
