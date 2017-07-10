<?php

/*
 *     2011-10-12
 *          <<< 奖金设置,如设置待发奖金, >>>
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
$extraBatch = $_GET['extraBatch'];
if (!$_GET ['month'] || !$_GET ['unitID']) {
    exit("非法网址");
} else {
    $sql = "select ID,uID,salaryStatus,name,bID,pay,acheive,salaryProvideDate from a_rewardFee where `month` like :month and `unitID` like :unitID and `extraBatch` like :extraBatch and pay<>0 order by salaryStatus asc";
    $res = $pdo->prepare($sql);
    $res->execute(array(":month" => $month, ":unitID" => $unitID, ":extraBatch" => $extraBatch));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $row = $res->rowCount();
    if ($row <= 0) {
        exit("发生未知错误,请联系管理员");
    } else {
        $smarty->assign("month", $month);
        $smarty->assign("salaryArr", $ret);
        #模板配置
        $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
        $smarty->display("rewardManage/rewardSet.tpl");
    }
}
?>