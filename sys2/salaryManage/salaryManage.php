<?php

/*
 *     2010-8-16
 *          <<< 工资表.费用表管理 >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接数据函数
require_once sysPath . 'dataFunction/unit.data.php';
#错误验证类
require_once sysPath . 'dataFunction/error.data.php';
#工资费用相关类
require_once sysPath . "dataFunction/salaryFee.data.php";
#页面标题
$title = "工资表及费用表管理";
$zID = $_GET ['zID'];
$salaryDate = $_GET ['salaryDate'];
$soInsDate = $_GET ['soInsDate'];
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
#验证本月台账是否已经生成
$error = new error();
$error->pdo = $pdo;
$error->month = $month;
$error->unitID = $unitID;
$error->validLedger();
#链接验证审批过程
require_once sysPath . 'approval/approval.class.php';
$approval = new approval ();
$approval->pdo = $pdo;
//判断有哪些是需要审批的,当设置审批类型为不审批时,屏蔽审批流程
$appTypeArr = array("fee","WDWhole", "WDDetail", "editTheir");
if ($authArr ['approval']) {
    $appTypeNeedArr = array_intersect($appTypeArr, array_keys($authArr ['approval']));
    foreach ($appTypeNeedArr as $appType) {
        $exArr = null;
        $appConStr = "a.`month`=\'$month\' and a.`unitID`=\'$unitID\'";
        $approval->type = $appType;
        $approval->conStr = $appConStr;
        $exArr = $approval->validEx();
        $exAppArr [$appType] = $exArr;
    }
}
if ($exAppArr) {
    foreach ($exAppArr as $key => $val) {
        switch ($val ['status']) {
            case "1" :
                $appMsg [$key] = "已完成审批流程";
                break;
            case "5" :
                $appMsg [$key] = "审批流程进行中,无法修改数据";
                break;
            case "99" :
                $appMsg [$key] = "审批被退回";
                break;
        }
    }
}
//冲减挂账审批
#获取员工信息,求出社保费用,商保费用,互助会费用
$wSql = "select b.unitName,b.uComInsMoney,b.pComInsMoney from  a_unitInfo b where b.unitID like :unitID";
$wRes = $pdo->prepare($wSql);
$wRes->execute(array(":unitID" => $unitID));
$wRet = $wRes->fetch(PDO::FETCH_ASSOC);
#商保缴交设置
$pComInsMoneyRadix = $wRet ['pComInsMoney'];
$uComInsMoneyRadix = $wRet ['uComInsMoney'];
$helpCost = 2;
#如果设置过基数则调整
$radixSql = "select * from a_changeRadix_tmp where month like '$month' and unitID like '$unitID'";
$radixRes = $pdo->query($radixSql);
$rCount = $radixRes->rowCount();
$radixRet = $radixRes->fetch(PDO::FETCH_ASSOC);
if ($rCount > 0) {
    $pComInsMoneyRadix = $radixRet ['pComInsMoneyRadix'];
    $uComInsMoneyRadix = $radixRet ['uComInsMoneyRadix'];
    $helpCost = $radixRet ['helpCost'];
}
# 费用相关
$salaryFee = new salaryFee();
$salaryFee->pdo = $pdo;
$salaryFee->month = $month;
$salaryFee->unitID = $unitID;
$oret = $salaryFee->basicTmpRet("fee");
$ret = $salaryFee->basicRet("fee");
$originalFeeCount=count($ret);
//未处理原始费用相关项
$mulAFee = $salaryFee->AFee("mulFee", "mul"); 
//已生成的费用表相关项
$mulAFeeYet = $salaryFee->AFee("mulFee", "yet");
//多次工资总费用合计
$salaryFee->basicRet("mulFee");
$mulTotalFee = $salaryFee->totalFee("mul");
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1");
#获取相关数组
$salaryNum = $salaryTotalPay = $feeNum = $feeTotalPay = $pTax = $pSoIns = $uSoIns = $pHF = $pComIns = $uComIns = $managementCost = 0;
foreach ($ret as $key => $val) {
    if ($val ['pay'] != 0) {
        $salaryNum++;
        $salaryTotalPay += $val ['pay'];
        $pTax += $val ['pTax'];
        $pSoIns += $val ['pSoIns'];
        $pHF+= $val ['pHF'];
        $pComIns += $val ['pComIns'];
        $acheive+=$val ['acheive'];
    }
    $feeNum++;
    $feeTotalPay += $val ['totalFee'];
    $uSoIns += $val ['uSoIns'];
    $uComIns += $val ['uComIns'];
    $managementCost += $val ['managementCost'];
}
$reSql = "select a.ID,a.uID,b.name,a.uPDInsMoney,a.uSoInsMoney,a.pSoInsMoney,a.uHFMoney,a.pHFMoney,a.uComInsMoney,a.pComInsMoney,a.managementCostMoney,a.uAccount,a.uOtherMoney,a.pOtherMoney,a.type from `a_prsRequireMoney` a left join `a_workerInfo` b on a.uID = b.uID where a.month like :month and a.unitID like :unitID and b.uID is not null  ";

#这里就做个EXCEL筛选模式..
if ($_REQUEST ['selPost'] == "1") {
    foreach ($_POST as $pKey => $pVal) {
        if ($pKey != "selPost" && $pKey != "intoExcel") {
            //配置Smarty 模板的筛选变量..POST后选中的值
            $smartyName = "s_" . $pKey;
            $smarty->assign($smartyName, $pVal);
            $fieldSel = substr($pKey, 0, - 3);
            switch ($pKey) {
                default :
                    if ($pVal != "") {
                        if ($pVal == "notNull")
                            $selSql .= " and a.$fieldSel not like ''";
                        elseif ($pVal == "Null")
                            $selSql .= " and a.$fieldSel like ''";
                        else
                            $selSql .= " and a.$fieldSel = '$pVal'";
                    }
                    break;
            }
        }
    }
}
$reSql = $reSql . $selSql . " order by  a.uID,a.type";
$reRes = $pdo->prepare($reSql);
$reRes->execute(array(":month" => $month, ":unitID" => $unitID));
$reRet = $reRes->fetchAll(PDO::FETCH_ASSOC);
$type = array("1" => "挂账", "2" => "欠款", "3" => "收回欠款", "4" => "冲减挂账");
if ($reRet) {
    foreach ($reRet as $rKey => $rVal) {
        if ($rVal ['type'] == "1" || $rVal ['type'] == "2" || $rVal ['type'] == "3") {
            $uSoIns += $rVal ['uSoInsMoney'];
            $uComIns += $rVal ['uComInsMoney'];
            $managementCost += $rVal ['managementCostMoney'];
            $totalMoneyArr[$rVal['type']] ['uPDInsMoney']+=$rVal ['uPDInsMoney'];
            $totalMoneyArr[$rVal['type']] ['uSoInsMoney']+=$rVal ['uSoInsMoney'];
            $totalMoneyArr[$rVal['type']] ['pSoInsMoney']+=$rVal ['pSoInsMoney'];
            $totalMoneyArr[$rVal['type']] ['uHFMoney']+=$rVal ['uHFMoney'];
            $totalMoneyArr[$rVal['type']] ['pHFMoney']+=$rVal ['pHFMoney'];
            $totalMoneyArr[$rVal['type']] ['uComInsMoney']+= $rVal ['uComInsMoney'];
            $totalMoneyArr[$rVal['type']] ['pComInsMoney']+= $rVal ['pComInsMoney'];
            $totalMoneyArr[$rVal['type']] ['managementCostMoney'] += $rVal ['managementCostMoney'];
            #暂时屏蔽
//            $totalMoneyArr[$rVal['type']] ['soInsCardMoney']+=$rVal ['soInsCardMoney'];
//            $totalMoneyArr[$rVal['type']] ['residentCardMoney']+= $rVal ['residentCardMoney'];
            $totalMoneyArr[$rVal['type']] ['uAccount']+=$rVal ['uAccount'];
            $totalMoneyArr[$rVal['type']] ['uOtherMoney']+=$rVal ['uOtherMoney'];
            $totalMoneyArr[$rVal['type']] ['pOtherMoney']+=$rVal ['pOtherMoney'];
        }
        if ($rVal ['type'] == "4") {
            $totalMoneyArr[$rVal['type']] ['uPDInsMoney']+=$rVal ['uPDInsMoney'];
            $totalMoneyArr[$rVal['type']] ['uSoInsMoney']+=$rVal ['uSoInsMoney'];
            $totalMoneyArr[$rVal['type']] ['pSoInsMoney']+=$rVal ['pSoInsMoney'];
            $totalMoneyArr[$rVal['type']] ['uHFMoney']+=$rVal ['uHFMoney'];
            $totalMoneyArr[$rVal['type']] ['pHFMoney']+=$rVal ['pHFMoney'];
            $totalMoneyArr[$rVal['type']] ['uComInsMoney']+= $rVal ['uComInsMoney'];
            $totalMoneyArr[$rVal['type']] ['pComInsMoney']+= $rVal ['pComInsMoney'];
            $totalMoneyArr[$rVal['type']] ['managementCostMoney'] += $rVal ['managementCostMoney'];
            #暂时屏蔽
//            $totalMoneyArr[$rVal['type']] ['soInsCardMoney']+=$rVal ['soInsCardMoney'];
//            $totalMoneyArr[$rVal['type']] ['residentCardMoney']+= $rVal ['residentCardMoney'];
            $totalMoneyArr[$rVal['type']] ['uAccount']+=$rVal ['uAccount'];
            $totalMoneyArr[$rVal['type']] ['uOtherMoney']+=$rVal ['uOtherMoney'];
            $totalMoneyArr[$rVal['type']] ['pOtherMoney']+=$rVal ['pOtherMoney'];
            $uSoIns -= $rVal ['uSoInsMoney'];
            $uComIns -= $rVal ['uComInsMoney'];
            $managementCost -= $rVal ['managementCostMoney'];
        }
        $uPDInsMoneyArr [] = $rVal ['uPDInsMoney'];
        $uSoInsMoneyArr [] = $rVal ['uSoInsMoney'];
        $pSoInsMoneyArr [] = $rVal ['pSoInsMoney'];
        $uHFMoneyArr [] = $rVal ['uHFMoney'];
        $pHFMoneyArr [] = $rVal ['pHFMoney'];
        $uComInsMoneyArr [] = $rVal ['uComInsMoney'];
        $pComInsMoneyArr [] = $rVal ['pComInsMoney'];
        $managementCostMoneyArr [] = $rVal ['managementCostMoney'];
        #暂时屏蔽
//        $soInsCardMoneyArr [] = $rVal ['soInsCardMoney'];
//        $residentCardMoneyArr [] = $rVal ['residentCardMoney'];
        $uAccountArr [] = $rVal ['uAccount'];
        $typeArr [] = $rVal ['type'];
    }
    $uPDInsMoneyArr = array_unique($uPDInsMoneyArr);
    $uSoInsMoneyArr = array_unique($uSoInsMoneyArr);
    $pSoInsMoneyArr = array_unique($pSoInsMoneyArr);
    $uHFMoneyArr = array_unique($uHFMoneyArr);
    $pHFMoneyArr = array_unique($pHFMoneyArr);
    $uComInsMoneyArr = array_unique($uComInsMoneyArr);
    $pComInsMoneyArr = array_unique($pComInsMoneyArr);
    $managementCostMoneyArr = array_unique($managementCostMoneyArr);
    #暂时屏蔽
//    $soInsCardMoneyArr = array_unique($soInsCardMoneyArr);
//    $residentCardMoneyArr = array_unique($residentCardMoneyArr);
    $uAccountArr = array_unique($uAccountArr);
    $typeArr = array_unique($typeArr);
}
#查看调账记录
$editAccountSql = "select * from a_editAccountList where unitID like :unitID and month like :month";
$editAccountRes = $pdo->prepare($editAccountSql);
$editAccountRes->execute(array(":month" => $month, ":unitID" => $unitID));
$editAccountRet = $editAccountRes->fetchAll(PDO::FETCH_ASSOC);
//print_r($editAccountRet);
foreach ($editAccountRet as $key => $val) {
    if ($val ['type'] == "3") {
        //如果设置为公司挂账,则,这种情况,是对应以应收设置 a_originalFee的uSoIns,uComIns等,
        if ($val ['confirmStatus'] == "1") {
            $uSoIns += $val ['uSoInsMoney'];
            $uComIns += $val ['uComInsMoney'];
            $managementCost += $val ['managementCostMoney'];
        }
    } elseif ($val ['type'] == "1" or $val ['type'] == "2") {
        $eAR [$val ['roleB']] = $val;
    }
}
if (isset($_POST ['editAccountMine'])) {
    $showWindow = "<script>tipsWindown('本人挂账调整','iframe:" . httpPath . "salaryManage/editAccountMine.php?" . $_SERVER ['QUERY_STRING'] . "', '1024', '580', 'true', '', 'true', 'leotheme'); </script>";
}
if (isset($_POST ['editAccountCompany'])) {
    $showWindow = "<script>tipsWindown('公司挂账调整','iframe:" . httpPath . "salaryManage/editAccountCompany.php?" . $_SERVER ['QUERY_STRING'] . "', '1024', '580', 'true', '', 'true', 'leotheme'); </script>";
}
if (isset($_POST ['editWriteDownMoney'])) {
    $showWindow = "<script>tipsWindown('公司挂账调整','iframe:" . httpPath . "salaryManage/editWriteDownMoney.php?" . $_SERVER ['QUERY_STRING'] . "', '1024', '580', 'true', '', 'true', 'leotheme'); </script>";
}

#这里就暂时把每月的实收数 替换了吧,.,,有点蒙蒙的,,(需要考虑的是,当不是社保费用,而把它调整为社保费用的时候,这里的统计数就应变化,但是暂时是不变的,然后这里社保呢就是: 
#社保=原始费用表实收社保-收回社保欠款(暂时不考虑从其他费用上调整过来的,而且如果是社保项目之间的调整,其实是不影响的)
#其他项目与社保相似
$uSoIns = $uComIns = $uHF = $managementCost = 0;
foreach ($oret as $oKey => $oVal) {
    $uSoIns += ( (double) $oVal ['uPension'] + (double) $oVal['uHospitalization'] + (double) $oVal['uEmploymentInjury'] + (double) $oVal['uUnemployment'] + (double) $oVal['uBirth']);
    $uHF += $oVal ['uHF'];
    $uComIns += $oVal ['uComIns'];
    $managementCost += $oVal ['managementCost'];
}
$uSoIns = $uSoIns + $totalMoneyArr[4]['uSoInsMoney'];
$uHF = $uHF + $totalMoneyArr[4]['uHFMoney'];
$uComIns = $uComIns + $totalMoneyArr[4]['uComInsMoney'];
$managementCost = $managementCost + $totalMoneyArr[4]['managementCostMoney'];
#配置变量
$smarty->assign(array("pComInsMoneyRadix" => $pComInsMoneyRadix, "uComInsMoneyRadix" => $uComInsMoneyRadix, "helpCost" => $helpCost, "originalFeeCount" => $originalFeeCount));
$smarty->assign("oret", $oret);
$smarty->assign("ret", $ret);
$smarty->assign(array("mulTotalFee"=>$mulTotalFee,"mulAFee" => $mulAFee,"mulAFeeYet"=>$mulAFeeYet));
$smarty->assign(array("salaryNum" => $salaryNum, "salaryTotalPay" => $salaryTotalPay,"acheive"=>$acheive, "pTax" => $pTax, "pSoIns" => $pSoIns, "uSoIns" => $uSoIns, "pHF" => $pHF, "uHF" => $uHF, "pComIns" => $pComIns, "uComIns" => $uComIns, "managementCost" => $managementCost, "feeNum" => $feeNum, "feeTotalPay" => $feeTotalPay));
$smarty->assign("unitManager", $unitManager);
$smarty->assign("reRet", $reRet);
$smarty->assign("eAR", $eAR);
$smarty->assign("totalMoneyArr", $totalMoneyArr);
$smarty->assign("type", $type);
$smarty->assign(array("exAppArr" => $exAppArr, "appMsg" => $appMsg));
$smarty->assign(array("uPDInsMoneyArr" => $uPDInsMoneyArr, "uSoInsMoneyArr" => $uSoInsMoneyArr, "pSoInsMoneyArr" => $pSoInsMoneyArr, "uHFMoneyArr" => $uHFMoneyArr, "pHFMoneyArr" => $pHFMoneyArr, "uComInsMoneyArr" => $uComInsMoneyArr, "pComInsMoneyArr" => $pComInsMoneyArr, "managementCostMoneyArr" => $managementCostMoneyArr, "soInsCardMoneyArr" => $soInsCardMoneyArr, "residentCardMoneyArr" => $residentCardMoneyArr, "uAccountArr" => $uAccountArr, "typeArr" => $typeArr));
$smarty->assign("showWindow", $showWindow);

#模板配置
$smarty->assign(array("title" => $title, "authArr" => $authArr, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("salaryManage/salaryManage.tpl");
?>