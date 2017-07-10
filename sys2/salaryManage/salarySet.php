<?php

/*
 *     2010-8-12
 *          <<< 工资设置,如设置待发工资,或冲减费用(从单位挂账中支出) >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
$title = "工资表设置";
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
$extraBatch=$_GET['extraBatch'];
if (!$_GET ['month'] || !$_GET ['unitID']) {
    exit("非法网址");
} else {
    if ($extraBatch)
        $sql = "select ID,uID,salaryStatus,name,bID,pay,acheive,salaryProvideDate from a_mul_originalFee where month like :month and unitID like :unitID and extraBatch='$extraBatch' and pay<>0 order by salaryStatus asc";
    else
        $sql = "select ID,uID,salaryStatus,name,bID,pay,acheive,salaryProvideDate from a_originalFee where month like :month and unitID like :unitID and pay<>0 order by salaryStatus asc";
    $res = $pdo->prepare($sql);
    $res->execute(array(":month" => $month, ":unitID" => $unitID));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $row = $res->rowCount();
    if ($row <= 0) {
        exit("暂无数据,请保存工资表");
    } else {
        $smarty->assign("month", $month);
        $smarty->assign("salaryArr", $ret);
        #模板配置
        $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
        $smarty->display("salaryManage/salarySet.tpl");
    }
}
?>