<?php

/*
 *     2010-5-27
 *          <<<社保平帐表,主要完成社保的平账 , 额外再增加商保平账功能>>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#劳务费计算
require_once sysPath . 'dataFunction/fee.data.php';
#通用函数库
require_once '../common.function.php';
#工资费用相关类
require_once sysPath . "dataFunction/salaryFee.data.php";
#页面标题
$title = "社保平账";
$unitID = $_GET ['unitID'];
$soInsDate = $_GET ['soInsDate'];
$month = $_GET ['month'];
if (!$unitID || !$soInsDate)
    exit ("非法网址");
if ($_GET ['query'] != "detail") {
    #更新该月内在这个单位,但被调走到另一个单位的问题
    //    $updateSql = "update a_soInsFee_tmp a,a_originalFee_tmp b set a.unitID=b.unitID where  a.soInsDate like :soInsDate and a.unitID like :unitID and a.uID=b.uID  and a.unitID != b.unitID and a.soInsDate=b.soInsDate ";
    //    $upRest = $pdo->prepare($updateSql);
    //    $upRest->execute(array("soInsDate" => $soInsDate, ":unitID" => $unitID));
    #获取缴交明细的费用
    $soSql = "select uID,name,pTotal,uTotal from a_soInsFee_tmp a where unitID like :unitID and soInsDate like :soInsDate";
    $soRet = SQL($pdo, $soSql, array(
        ":soInsDate" => $soInsDate,
        ":unitID" => $unitID
    ));
    $soR = keyArray($soRet, "uID");
    #获取员工相关信息,
    $wSql = "select uID,name,domicile,managementCost,PDIns,type from a_workerInfo where unitID like '$unitID'";
    $wRet = SQL($pdo, $wSql);
    $wRet = keyArray($wRet, "uID");
    #获取费用表中的社保费用
    $s = new salaryFee ();
    $s->pdo = $pdo;
    $s->month = $soInsDate;
    $s->monthType = "soInsDate";
    $s->unitID = $unitID;
    $monthArr = $s->AFee("fee", null, array(
        "salaryDate",
        "comInsDate",
        "managementCostDate"
    ));
    $salaryDate = $monthArr ['0'] ['salaryDate'];
    $comInsDate = $monthArr ['0'] ['comInsDate'];
    $managementCostDate = $monthArr ['0'] ['managementCostDate'];
    $ofR = $s->BFee(null, "fee", array(
        "pay",
        "pSoIns",
        "uSoIns",
        "uPDIns",
        "managementCost"
    ), array(
        "uID",
        "name"
    ));
    #处理费用是由个人支付,还是由单位支付的问题
    $unitArr = unitAll($pdo, " `unitID`,`notFullSoInsFrom`,`soInsFrom` ", " and unitID like '$unitID' ");
    if ($unitArr [$unitID] ['soInsFrom'] == "1") {
        //由单位支付  个人+单位的费用
        foreach ($soR as $key => $val) {
            $soR [$key] ['pTotal'] = 0;
            $soR [$key] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
        }
    }
    elseif ($unitArr [$unitID] ['soInsFrom'] == "2") {
        //由个人支付  个人+单位的费用
        foreach ($soR as $key => $val) {
            $soR [$key] ['uTotal'] = 0;
            $soR [$key] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
        }
    }
    else {
        #处理从单位中扣社保的非全日制员工
        foreach ($soR as $key => $val) {
            if ($wRet [$key] ['type'] != "1") {
                if ($unitArr [$unitID] ['notFullSoInsFrom'] == "1") {
                    //由单位支付  个人+单位的费用
                    $soR [$key] ['pTotal'] = 0;
                    $soR [$key] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
                }
                elseif ($unitArr [$unitID] ['notFullSoInsFrom'] == "2") {
                    //由个人支付  个人+单位的费用
                    $soR [$key] ['uTotal'] = 0;
                    $soR [$key] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
                }
                else if ($ofR [$key] ['pay'] == 0) {
                    //如果是单位和个人均摊的方式, 如果没有发放工资则由单位承担
                    $soR [$key] ['pTotal'] = 0;
                    $soR [$key] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
                }
            }
        }
    }

    #获取社平工资
    $feeData = new feeData ();
    $feeData->pdo = $pdo;
    $feeData->unitID = $unitID;
    $feeData->month = $month;
    $feeData->soInsDate = $soInsDate;
    $feeData->comInsDate = $comInsDate;
    $feeData->mCostDate = $managementCostDate;
    $uPDIns = $feeData->soInsFun('PDIns');
    $unitArr = $feeData->unitArr();
    $changeRadix = $feeData->changeRadix();
    $feeData->wArr = $wRet;
    $extraFeeArr = $feeData->extraFeeArr();
    $mCostFeeArr = $extraFeeArr ['mCostFeeArr'];
    $comInsFeeArr = $extraFeeArr ['comInsFeeArr'];
    //由$ofR遍历,然后还需要获取不在$ofR中的其他有缴费的员工
    $extraSoR = array_diff_key($soR, $ofR);
    #获取本月的欠/挂费用
    $curRequireMoneySql = "select uID,pSoInsMoney,uSoInsMoney,uPDInsMoney,type  from `a_prsRequireMoney_tmp`  where month like :month and unitID like :unitID ";
    $curRequireMoneyRes = $pdo->prepare($curRequireMoneySql);
    $curRequireMoneyRes->execute(array(
        ":month" => $month,
        ":unitID" => $unitID
    ));
    $curRequireMoneyRet = $curRequireMoneyRes->fetchAll(PDO::FETCH_ASSOC);
    $curRMRet = $curWriteDownRet = $fTR = $prsReMoneyRet = null;
    foreach ($curRequireMoneyRet as $curRequireMoneyVal) {
        if ($curRequireMoneyVal ['type'] == "1" || $curRequireMoneyVal ['type'] == "2") {
            if ($curRequireMoneyVal ['uSoInsMoney'] != 0)
                $curRMRet [$curRequireMoneyVal ['uID']] ['uSoInsMoney'] = $curRequireMoneyVal ['uSoInsMoney'];
            if ($curRequireMoneyVal ['pSoInsMoney'] != 0)
                $curRMRet [$curRequireMoneyVal ['uID']] ['pSoInsMoney'] = $curRequireMoneyVal ['pSoInsMoney'];
        }
    }
    unset ($soRet, $ofRet, $curRequireMoneyRet);
}
else {
    $sql = "select b.uID,b.name,a.uSoInsMoney,a.pSoInsMoney from a_editAccountList a left join a_workerInfo b on a.roleA=b.uID where a.unitID like :unitID and a.soInsDate like :soInsDate";
    $ret = SQL($pdo, $sql, array(
        ":soInsDate" => $soInsDate,
        ":unitID" => $unitID
    ));
    $engToChsArr = engTochs();
    foreach ($ret [0] as $key => $val) {
        $newFieldArr [$key] = $engToChsArr [$key];
    }
    $smarty->assign("ret", $ret);
    $smarty->assign("newFieldArr", $newFieldArr);
}
//echo "<pre>";
//print_r($comRet);
#变量配置
//$smarty->debugging = true;
$smarty->assign(array(
    "soR" => $soR,
    "ofR" => $ofR,
    "curRMRet" => $curRMRet,
    "comRet" => $comInsFeeArr,
    "mCostFeeArr" => $mCostFeeArr,
    "wRet" => $wRet,
    "extraSoR" => $extraSoR,
    "uPDIns" => $uPDIns
));
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("soInsManage/soInsBalFee.tpl");
?>