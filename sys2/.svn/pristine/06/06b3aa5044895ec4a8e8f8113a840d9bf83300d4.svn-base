<?php

/*
 *     用于查询/修改个人每月欠/挂/冲减/收回明细
 *  *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
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
$unit = unitAll($pdo, "unitID,unitName");
foreach ($unit as $uv) {
    $unit_s[$uv['unitID']] = $uv['unitName'];
}
$js_unit = json_encode($unit_s);
$sql = "select a.ID,a.uID,a.month,a.extraBatch+1,b.name,c.unitName,a.uPDInsMoney,a.uSoInsMoney,a.pSoInsMoney,a.uHFMoney,a.pHFMoney,a.uComInsMoney,a.pComInsMoney,a.managementCostMoney,a.uAccount,a.uOtherMoney,a.pOtherMoney,a.type,a.remarks,a.status from `a_prsRequireMoney` a , `a_workerInfo` b,`a_unitInfo` c   where a.uID like :uID and a.uID = b.uID and a.unitID=c.unitID ";
#引入查询限制：每半年隐藏上一年度挂账及已收回的欠款数据
$currentYear = date("Y", time());
$currentMonth = date("n", time());
//如果超过6月份,则屏蔽上一年度,否则屏蔽前一年度
if ($currentMonth > "6"){
    $actionMonth = ($currentYear - 1) . "12";
}
else{
    $actionMonth = ($currentYear - 2) . "12";
}
$sql .= " and (a.month>'$actionMonth' or (a.status=0 and a.type in ('2','3')))order by a.month desc ";

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

#显示本人各个月分内的费用相关数据的实收数
$fSql = "select name,unitID,month, 0 as extraBatch,salaryDate,soInsDate,HFDate,comInsDate,managementCostDate,name,pay,pTax,utilities,cardMoney,acheive,advanceMoney,totalFee,bID,uPDIns,uSoIns,pSoIns,uHF,pHF,uComIns,pComIns,managementCost from a_originalFee where uID like '$uID' 
			union all 
			select name,unitID,month,extraBatch,salaryDate,soInsDate,HFDate,comInsDate,managementCostDate,name,pay,pTax,utilities,cardMoney,acheive,advanceMoney,totalFee,bID,uPDIns,uSoIns,pSoIns,uHF,pHF,uComIns,pComIns,managementCost from a_mul_originalFee where uID like '$uID' 
			order by month desc  limit 20 ";
$fRet = SQL($pdo, $fSql);
#显示各月奖金
$rSql = "select zID,name,unitID,month,rewardDate,extraBatch,pay,pTax,acheive,bID from `a_rewardFee` where uID like '$uID' order by month desc limit 20";
$rRet = SQL($pdo, $rSql);
#显示本人各月实缴
#社保
$soInsSql = "select soInsDate,name,unitID,soInsID,radix,pTotal,uTotal,total from a_soInsFee_tmp where uID like '$uID' order by soInsDate desc limit 20";
$soInsRet = SQL($pdo, $soInsSql);
#公积金
$HFSql = "select HFDate,name,unitID,housingFundID,HFRadix,pTotal,uTotal,total from a_HFFee_tmp where uID like '$uID' order by HFDate desc limit 20";
$HFRet = SQL($pdo, $HFSql);
#


#配置变量
$smarty->assign(array(
    "ret" => $ret,
    "js_unit" => $js_unit,
    "unit" => $unit,
    "fRet" => $fRet,
    "rRet" => $rRet,
    "soInsRet" => $soInsRet,
    "HFRet" => $HFRet
));
$smarty->assign(array(
    "type" => $type,
    "status" => $status
));
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("feeAdvancedManage/prsMoney.tpl");
?>
