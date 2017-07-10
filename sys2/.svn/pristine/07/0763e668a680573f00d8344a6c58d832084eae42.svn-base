<?php
/**
 * <<用于调整账目的功能,并设置相关权限>>
 *
 * Created by Great sToNe.
 *
 * Date: 14-9-24
 * Time: 下午4:15
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#连接费用核算类
require_once sysPath . 'dataFunction/fee.data.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
$title = "个人欠/挂明细";
$uID = $_GET ['uID'];
$unit = unitAll($pdo, "unitID,unitName", " and status='1' and type='1' ");
foreach ($unit as $uv) {
    $unit_s[$uv['unitID']] = $uv['unitName'];
}
$js_unit = json_encode($unit_s);
$wSql = "select a.uID,a.name,b.unitName,a.unitID from a_workerInfo a,a_unitInfo b where  a.uID=:uID  and a.unitID=b.unitID";
$wRet =SQL($pdo, $wSql, array(":uID" => $uID),"one");
$sql = "select a.ID,a.uID,a.month,a.extraBatch+1,b.name,a.unitID,c.unitName,a.uPDInsMoney,a.uSoInsMoney,a.pSoInsMoney,a.uHFMoney,a.pHFMoney,a.uComInsMoney,a.pComInsMoney,a.managementCostMoney,a.uAccount,a.uOtherMoney,a.pOtherMoney,a.type,a.remarks,a.status from `a_prsRequireMoney` a , `a_workerInfo` b,`a_unitInfo` c   where a.uID like :uID and a.uID = b.uID and a.unitID=c.unitID order by a.month desc";

$ret = SQL($pdo, $sql, array(
    ":uID" => $uID
));
$type = array(
    "1" => "挂账",
    "2" => "欠款",
    "3" => "收回欠款",
    "4" => "冲减挂账"
);
$status = array(
    "0" => "未入账",
    "1" => "已"
);

#变量配置
$smarty->assign(array(
    "ret" => $ret,
    "wRet" => $wRet,
    "js_unit" => $js_unit,
    "unit" => $unit,
    "type" => $type,
    "status"=>$status
));
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("feeAdvancedManage/prsMoneyModify.tpl");