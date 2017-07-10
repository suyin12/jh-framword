<?php

/*
 *     2010-8-4
 *          <<< 这里是用来调整费用表中的一些相关的应收费用 >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
ini_set("memory_limit", "500M");
#
$title = "调整费用";
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
#
$feeSql = "select * from `a_originalFee_tmp` where month like :month and unitID like :unitID limit 1";
$feeRes = $pdo->prepare($feeSql);
$feeRes->execute(array(":month" => $month, ":unitID" => $unitID));
$feeRet = $feeRes->fetch(PDO::FETCH_ASSOC);
$salaryDate = $feeRet ['salaryDate'];
$comInsDate = $feeRet ['comInsDate'];
$soInsDate = $feeRet ['soInsDate'];
$HFDate = $feeRet ['HFDate'];
unset($feeRet);
#如果存在调账记录, 则以 a_originalFee_tmp 的实收,为准
$oSql = "select a.uID,(a.uPension+a.uHospitalization+a.uEmploymentInjury+a.uUnemployment+a.uBirth) as uSoIns,a.uHF,uComIns,a.managementCost,a.uPDIns from `a_originalFee_tmp` a  where a.month like :month and a.unitID like :unitID  and a.modifyType='1'";
$oRet = SQL($pdo, $oSql, array(":month" => $month, ":unitID" => $unitID));
$oRet = keyArray($oRet,'uID');
// print_r($oRet);
#
$selSql = "select a.*,b.status,b.soInsModifyDate,b.soInsBuyDate,b.HFModifyDate,b.housingFund,b.soInsurance from a_fee_tmp a left join a_workerInfo b on a.uID=b.uID  where a.month like :month and a.unitID like :unitID and a.extraBatch='0'";
if ($_POST['search']){
    unset($_GET ['displayModify']);
    $selSql .=" and a.name like '" . trim($_POST['name']) . "%'";
}
if ($_GET ['displayModify'] == 'true')
    $selSql .= " and a.lastModifyTime<>0";

$selRes = $pdo->prepare($selSql);
$selRes->execute(array(":month" => $month, ":unitID" => $unitID));
$selRow = $selRes->rowCount();
#累计欠款明细,及本月的欠挂明细
$moneyData = new money();
$moneyData->pdo = $pdo;
$moneyData->unitID = $unitID;
$moneyData->month = $month;
$curMonthMoney = $moneyData->curMonth();
$rMRet = $moneyData->sumMoney();
#获取本月的欠/挂费用
$curRMRet = $curMonthMoney['curRM'];
$prsReMoneyRet = $curMonthMoney['prsReMoney'];
$curWriteDownRet = $curMonthMoney['curWriteDown'];
//if ($selRow <= 0) {
//	exit ( '无需要调整的记录,<input type="button" name="closeRefresh" value="关闭窗口" onclick="javascript:top.location.href = \'makeFee.php\'+location.search;">' );
//} else {
$feeRet = $selRes->fetchAll(PDO::FETCH_ASSOC);
$feeArr = null;
foreach ($feeRet as $fKey => $fVal) {
    $a = $b = $c = $d = $e = 0;
    $feeArr [$fVal ['uID']] ["status"] = $fVal ['status'];
    $feeArr [$fVal ['uID']] ["soInsModifyDate"] = $fVal ['soInsModifyDate'];
    $feeArr [$fVal ['uID']] ["HFModifyDate"] = $fVal ['HFModifyDate'];
    $feeArr [$fVal ['uID']] ["soInsBuyDate"] = $fVal ['soInsBuyDate'];
    $feeArr [$fVal ['uID']] ["soInsurance"] = $fVal ['soInsurance'];
    $feeArr [$fVal ['uID']] ["housingFund"] = $fVal ['housingFund'];
    $feeArr [$fVal ['uID']] ["name"] = $fVal ['name'];
    $feeArr [$fVal ['uID']] ["uID"] = $fVal ['uID'];
    #残障金
    //实收的社保费用,包括残障金
    //残障金应收
    $feeArr [$fVal ['uID']] ['uPDInsS'] = $fVal ['uPDInsS'];
    //实收残障金 = if( 实收保险-应收残障金>0) 则 = 应收残障金,表示的是,先把残障金部分收回,再收回保险,规避风险
    $feeArr [$fVal ['uID']] ['uPDInsR'] = !is_null($oRet[$fVal ['uID']]['uPDIns']) ? $oRet[$fVal ['uID']]['uPDIns'] : $fVal ['uPDInsR'];
    //残障金冲减
    $feeArr [$fVal ['uID']] ['PDInsWriteDownMoney'] = $curWriteDownRet [$fVal ['uID']] ['uPDInsMoney'];
    //应收回残障金欠款(单位社保)
    $feeArr [$fVal ['uID']] ['uPDInsMoneyS'] = $fVal ['uPDInsMoneyS'];
    //收回残障金欠款
    $a = $feeArr [$fVal ['uID']] ['uPDInsR'] + $feeArr [$fVal ['uID']] ['PDInsWriteDownMoney'] - $feeArr [$fVal ['uID']] ['uPDInsS'];
    if ($a < 0) {
        $uPDInsMoney = 0;
        $curUPDInsMoney = $a;
    } elseif ($feeArr [$fVal ['uID']] ['uPDInsMoneyS'] >= $a && $a >= 0) {
        $uPDInsMoney = $a;
        $curUPDInsMoney = 0;
    } elseif ($a > $feeArr [$fVal ['uID']] ['uPDInsMoneyS']) {
        $uPDInsMoney = $feeArr [$fVal ['uID']] ['uPDInsMoneyS'];
        $curUPDInsMoney = $a - $uPDInsMoney;
    }
    $feeArr [$fVal ['uID']] ['uPDInsMoney'] = $prsReMoneyRet [$fVal ['uID']] ['uPDInsMoney'] != 0 ? $prsReMoneyRet [$fVal ['uID']] ['uPDInsMoney'] : $uPDInsMoney;
    //本月欠/挂
    //	$feeArr [$fVal ['uID']] ['curUPDInsMoney'] = $curRMRet [$fVal ['uID']] ['uPDInsMoney'] != 0 ? $curRMRet [$fVal ['uID']] ['uPDInsMoney'] : number_format ( $curUPDInsMoney, 2 );
    $feeArr [$fVal ['uID']] ['curUPDInsMoney'] = $curRMRet [$fVal ['uID']] ['uPDInsMoney'];
    //累计欠款
    $feeArr [$fVal ['uID']] ['uPDInsMoneyTotal'] = - $feeArr [$fVal ['uID']] ['uPDInsMoneyS'] + $feeArr [$fVal ['uID']] ['uPDInsMoney'];
    if ($curUPDInsMoney < 0) {
        $feeArr [$fVal ['uID']] ['uPDInsMoneyTotal'] += $curUPDInsMoney;
    }
    //残障金均衡值:实收+冲减挂账-应收-应收欠款-本月欠/挂
    $feeArr [$fVal ['uID']] ['PDInsMargin'] = number_format(($a - $feeArr [$fVal ['uID']] ['uPDInsMoney'] - $feeArr [$fVal ['uID']] ['curUPDInsMoney']), 2);
//    if ($feeArr [$fVal ['uID']] ['PDInsMoney'] != 0 && $a == 0 && ($feeArr [$fVal ['uID']] ['PDInsMoney'] - $feeArr [$fVal ['uID']] ['PDInsMoneyS']) == 0) {
//        //当实收+冲减=应收, 收回欠款=应收欠款
//        $feeArr [$fVal ['uID']] ['PDInsMargin'] = 0;
//    }
    //社保部分,商保,收回单位社保欠款,收回单位商保欠款
    //应收社保
    $feeArr [$fVal ['uID']] ['uSoInsS'] = $fVal ['uSoInsS'];
    //实收社保
    $feeArr [$fVal ['uID']] ['uSoInsR'] =!is_null($oRet[$fVal ['uID']]['uSoIns']) ? $oRet[$fVal ['uID']]['uSoIns'] :  $fVal ['uSoInsR'];
    //社保冲减
    $feeArr [$fVal ['uID']] ['soInsWriteDownMoney'] = $curWriteDownRet [$fVal ['uID']] ['uSoInsMoney'];
    //应收回欠款(单位社保)
    $feeArr [$fVal ['uID']] ['uSoInsMoneyS'] = $fVal ['uSoInsMoneyS'];
    //收回社保欠款
    $b = $feeArr [$fVal ['uID']] ['uSoInsR'] + $feeArr [$fVal ['uID']] ['soInsWriteDownMoney'] - $feeArr [$fVal ['uID']] ['uSoInsS'];
    if ($b < 0) {
        $uSoInsMoney = 0;
        $curUSoInsMoney = $b;
    } elseif ($feeArr [$fVal ['uID']] ['uSoInsMoneyS'] >= $b && $b >= 0) {
        $uSoInsMoney = $b;
        $curUSoInsMoney = 0;
    } elseif ($b > $feeArr [$fVal ['uID']] ['uSoInsMoneyS']) {
        $uSoInsMoney = $feeArr [$fVal ['uID']] ['uSoInsMoneyS'];
        $curUSoInsMoney = $b - $uSoInsMoney;
    }
    $feeArr [$fVal ['uID']] ['uSoInsMoney'] = $prsReMoneyRet [$fVal ['uID']] ['uSoInsMoney'] != 0 ? $prsReMoneyRet [$fVal ['uID']] ['uSoInsMoney'] : $uSoInsMoney;
    //本月社保欠/挂
    $feeArr [$fVal ['uID']] ['curUSoInsMoney'] = $curRMRet [$fVal ['uID']] ['uSoInsMoney'];
    //累计欠款
    $feeArr [$fVal ['uID']] ['uSoInsMoneyTotal'] = - $feeArr [$fVal ['uID']] ['uSoInsMoneyS'] + $feeArr [$fVal ['uID']] ['uSoInsMoney'];
    if ($curUSoInsMoney < 0) {
        $feeArr [$fVal ['uID']] ['uSoInsMoneyTotal'] += $feeArr [$fVal ['uID']] ['curUSoInsMoney'];
    }
    //社保均衡值
    $feeArr [$fVal ['uID']] ['soInsMargin'] = number_format(($b - $feeArr [$fVal ['uID']] ['uSoInsMoney'] - $feeArr [$fVal ['uID']] ['curUSoInsMoney']), 2);
//    if ($feeArr [$fVal ['uID']] ['uSoInsMoney'] != 0 && $b == 0 && ($feeArr [$fVal ['uID']] ['uSoInsMoney'] - $feeArr [$fVal ['uID']] ['uSoInsMoneyS']) == 0) {
//        //当实收+冲减=应收, 收回欠款=应收欠款
//        $feeArr [$fVal ['uID']] ['soInsMargin'] = 0;
//    }
    #公积金
    //应收
    $feeArr [$fVal ['uID']] ['uHFS'] = $fVal ['uHFS'];
    //实收公积金
    $feeArr [$fVal ['uID']] ['uHFR'] = !is_null($oRet[$fVal ['uID']]['uHF']) ? $oRet[$fVal ['uID']]['uHF'] : $fVal ['uHFR'];
    //公积金冲减
    $feeArr [$fVal ['uID']] ['HFWriteDownMoney'] = $curWriteDownRet [$fVal ['uID']] ['uHFMoney'];
    //应收回欠款(单位社保)
    $feeArr [$fVal ['uID']] ['uHFMoneyS'] = $fVal ['uHFMoneyS'];
    //收回社保欠款
    $e = $feeArr [$fVal ['uID']] ['uHFR'] + $feeArr [$fVal ['uID']] ['HFWriteDownMoney'] - $feeArr [$fVal ['uID']] ['uHFS'];
    if ($e < 0) {
        $uHFMoney = 0;
        $curUHFMoney = $e;
    } elseif ($feeArr [$fVal ['uID']] ['uHFMoneyS'] >= $e && $e >= 0) {
        $uHFMoney = $e;
        $curUHFMoney = 0;
    } elseif ($e > $feeArr [$fVal ['uID']] ['uHFMoneyS']) {
        $uHFMoney = $feeArr [$fVal ['uID']] ['uHFMoneyS'];
        $curUHFMoney = $e - $uHFMoney;
    }
    $feeArr [$fVal ['uID']] ['uHFMoney'] = $prsReMoneyRet [$fVal ['uID']] ['uHFMoney'] != 0 ? $prsReMoneyRet [$fVal ['uID']] ['uHFMoney'] : $uHFMoney;
    //本月社保欠/挂
    $feeArr [$fVal ['uID']] ['curUHFMoney'] = $curRMRet [$fVal ['uID']] ['uHFMoney'];
    //累计欠款
    $feeArr [$fVal ['uID']] ['uHFMoneyTotal'] = - $feeArr [$fVal ['uID']] ['uHFMoneyS'] + $feeArr [$fVal ['uID']] ['uHFMoney'];
    if ($curUHFMoney < 0) {
        $feeArr [$fVal ['uID']] ['uHFMoneyTotal'] += $feeArr [$fVal ['uID']] ['curUHFMoney'];
    }
    //社保均衡值
    $feeArr [$fVal ['uID']] ['HFMargin'] = number_format(($e - $feeArr [$fVal ['uID']] ['uHFMoney'] - $feeArr [$fVal ['uID']] ['curUHFMoney']), 2);
//    if ($feeArr [$fVal ['uID']] ['uHFMoney'] != 0 && $e == 0 && ($feeArr [$fVal ['uID']] ['uHFMoney'] - $feeArr [$fVal ['uID']] ['uHFMoneyS']) == 0) {
//        //当实收+冲减=应收, 收回欠款=应收欠款
//        $feeArr [$fVal ['uID']] ['HFMargin'] = 0;
//    }
    #商保
    //有发工资的由个人承担部分费用,不发工资的则由单位全部承担
    //应收商保
    $feeArr [$fVal ['uID']] ['uComInsS'] = $fVal ['uComInsS'];
    //实收商保
    $feeArr [$fVal ['uID']] ['uComInsR'] = !is_null($oRet[$fVal ['uID']]['uComIns']) ? $oRet[$fVal ['uID']]['uComIns'] : $fVal ['uComInsR'];
    //本月商保冲减
    $feeArr [$fVal ['uID']] ['comInsWriteDownMoney'] = $curWriteDownRet [$fVal ['uID']] ['uComInsMoney'];
    //应收商保欠款
    $feeArr [$fVal ['uID']] ['uComInsMoneyS'] = $fVal ['uComInsMoneyS'];
    //收回商保欠款
    $c = $feeArr [$fVal ['uID']] ['uComInsR'] + $feeArr [$fVal ['uID']] ['comInsWriteDownMoney'] - $feeArr [$fVal ['uID']] ['uComInsS'];
    if ($c < 0) {
        $uComInsMoney = 0;
        $curUComInsMoney = $c;
    } elseif ($feeArr [$fVal ['uID']] ['uComInsMoneyS'] >= $c && $c >= 0) {
        $uComInsMoney = $c;
        $curUComInsMoney = 0;
    } elseif ($c > $feeArr [$fVal ['uID']] ['uComInsMoneyS']) {
        $uComInsMoney = $feeArr [$fVal ['uID']] ['uComInsMoneyS'];
        $curUComInsMoney = $c - $uComInsMoney;
    }
    $feeArr [$fVal ['uID']] ['uComInsMoney'] = $prsReMoneyRet [$fVal ['uID']] ['uComInsMoney'] != 0 ? $prsReMoneyRet [$fVal ['uID']] ['uComInsMoney'] : $uComInsMoney;
    //本月商保欠/挂
    $feeArr [$fVal ['uID']] ['curUComInsMoney'] = $curRMRet [$fVal ['uID']] ['uComInsMoney'];
    //累计商保欠/挂
    $feeArr [$fVal ['uID']] ['uComInsMoneyTotal'] = - $feeArr [$fVal ['uID']] ['uComInsMoneyS'] + $feeArr [$fVal ['uID']] ['uComInsMoney'];
    if ($curUComInsMoney < 0) {
        $feeArr [$fVal ['uID']] ['uComInsMoneyTotal'] += $curUComInsMoney;
    }
    //本月商保均衡值
    $feeArr [$fVal ['uID']] ['comInsMargin'] = number_format(($c - $feeArr [$fVal ['uID']] ['uComInsMoney'] - $feeArr [$fVal ['uID']] ['curUComInsMoney']), 2);
//    if ($feeArr [$fVal ['uID']] ['uComInsMoney'] != 0 && $c == 0 && ($feeArr [$fVal ['uID']] ['uComInsMoney'] - $feeArr [$fVal ['uID']] ['uComInsMoneyS']) == 0) {
//        //当实收+冲减=应收, 收回欠款=应收欠款
//        $feeArr [$fVal ['uID']] ['comInsMargin'] = 0;
//    }
    #管理费
    //应收管理费
    $feeArr [$fVal ['uID']] ['managementCostS'] = $fVal ['managementCostS'];
    //实收管理费
    $feeArr [$fVal ['uID']] ['managementCostR'] = !is_null($oRet[$fVal ['uID']]['managementCost']) ? $oRet[$fVal ['uID']]['managementCost'] : $fVal ['managementCostR'];
    //本月管理费冲减
    $feeArr [$fVal ['uID']] ['mCostWriteDownMoney'] = $curWriteDownRet [$fVal ['uID']] ['managementCostMoney'];
    //应收管理费欠款
    $feeArr [$fVal ['uID']] ['managementCostMoneyS'] = $fVal ['managementCostMoneyS'];
    //收回管理欠款
    $d = $feeArr [$fVal ['uID']] ['managementCostR'] + $feeArr [$fVal ['uID']] ['mCostWriteDownMoney'] - $feeArr [$fVal ['uID']] ['managementCostS'];
    if ($d < 0) {
        $managementCostMoney = 0;
        $curManagementCostMoney = $d;
    } elseif ($feeArr [$fVal ['uID']] ['managementCostMoneyS'] >= $d && $d >= 0) {
        $managementCostMoney = $d;
        $curManagementCostMoney = 0;
    } elseif ($d > $feeArr [$fVal ['uID']] ['managementCostMoneyS']) {
        $managementCostMoney = $feeArr [$fVal ['uID']] ['managementCostMoneyS'];
        $curManagementCostMoney = $d - $managementCostMoney;
    }
    $feeArr [$fVal ['uID']] ['managementCostMoney'] = $prsReMoneyRet [$fVal ['uID']] ['managementCostMoney'] != 0 ? $prsReMoneyRet [$fVal ['uID']] ['managementCostMoney'] : $managementCostMoney;
    //本月管理费欠/挂
    $feeArr [$fVal ['uID']] ['curManagementCostMoney'] = $curRMRet [$fVal ['uID']] ['managementCostMoney'];
    //累计欠款
    $feeArr [$fVal ['uID']] ['managementCostMoneyTotal'] = - $feeArr [$fVal ['uID']] ['managementCostMoneyS'] + $feeArr [$fVal ['uID']] ['managementCostMoney'];
    if ($curManagementCostMoney < 0) {
        $feeArr [$fVal ['uID']] ['managementCostMoneyTotal'] += $curManagementCostMoney;
    }
    //管理费均衡值
    $feeArr [$fVal ['uID']] ['managementCostMargin'] = number_format(($d - $feeArr [$fVal ['uID']] ['managementCostMoney'] - $feeArr [$fVal ['uID']] ['curManagementCostMoney']), 2);
//    if ($feeArr [$fVal ['uID']] ['managementCostMoney'] != 0 && $d == 0 && ($feeArr [$fVal ['uID']] ['managementCostMoney'] - $feeArr [$fVal ['uID']] ['managementCostS']) == 0) {
//        //当实收+冲减=应收, 收回欠款=应收欠款
//        $feeArr [$fVal ['uID']] ['managementCostMargin'] = $feeArr [$fVal ['uID']] ['curManagementCostMoney'];
//    }
    //收回其他欠款
    $feeArr [$fVal ['uID']] ['uOtherMoney'] = $prsReMoneyRet [$fVal ['uID']] ['uOtherMoney'] ? $prsReMoneyRet [$fVal ['uID']] ['uOtherMoney'] : 0;
    if (empty($_POST['name']) && $_GET ['displayModify'] != 'true' && $feeArr [$fVal ['uID']] ["status"] != 0 && $feeArr [$fVal ['uID']] ['PDInsMargin'] == 0 && $feeArr [$fVal ['uID']] ['soInsMargin'] == 0 && $feeArr [$fVal ['uID']] ['HFMargin'] == 0 && $feeArr [$fVal ['uID']] ['comInsMargin'] == 0 && $feeArr [$fVal ['uID']] ['managementCostMargin'] == 0) {
        unset($feeArr [$fVal ['uID']]);
    }
}
#重新分配数组(新版本的数据调整)
$uPDInsArr = $uSoInsArr = $uHFArr = $uComInsArr = $mCostArr = null;
$soInsDateDe = date("Y-m-" . insuranceInTurn("soIns"), strtotime("$soInsDate" . "01 -1 month"));
$HFDateDe = date("Y-m-" . insuranceInTurn("HF"), strtotime("$HFDate" . "01 -1 month"));
foreach ($feeArr as $fkk => $fvv) {
    foreach ($fvv as $fk => $fv) {
        switch ($fk) {
            case "uPDInsS" :
            case "uPDInsR" :
            case "PDInsWriteDownMoney" :
            case "uPDInsMoneyS" :
            case "uPDInsMoney" :
            case "curUPDInsMoney" :
            case "PDInsMargin" :
                if (!empty($_POST['name']) or $_GET ['displayModify'] == 'true') {
                    $uPDInsArr [$fkk] ['name'] = $fvv ['name'];
                    $uPDInsArr [$fkk] ['uID'] = $fkk;
                    $uPDInsArr [$fkk] [$fk] = $fv;
                    $uPDInsArr [$fkk] ['status'] = $fvv ['status'];
                } elseif ($fvv ['PDInsMargin'] != 0) {
                    $uPDInsArr [$fkk] ['name'] = $fvv ['name'];
                    $uPDInsArr [$fkk] ['uID'] = $fkk;
                    $uPDInsArr [$fkk] [$fk] = $fv;
                    $uPDInsArr [$fkk] ['status'] = $fvv ['status'];
                }
                break;
            case "uSoInsS" :
            case "uSoInsR" :
            case "soInsWriteDownMoney" :
            case "uSoInsMoneyS" :
            case "uSoInsMoney" :
            case "curUSoInsMoney" :
            case "soInsMargin" :
                if (!empty($_POST['name']) or $_GET ['displayModify'] == 'true') {
                    $uSoInsArr [$fkk] ['name'] = $fvv ['name'];
                    $uSoInsArr [$fkk] ['uID'] = $fkk;
                    $uSoInsArr [$fkk] [$fk] = $fv;
                    $uSoInsArr [$fkk] ['status'] = $fvv ['status'];
                    if (strtotime($fvv ['soInsModifyDate']) > strtotime("$soInsDateDe"))
                        $uSoInsArr [$fkk] ['soInsModifyDate'] = $fvv ['soInsModifyDate'];
                    else
                        $uSoInsArr [$fkk] ['soInsModifyDate'] = NUll;
                } elseif ($fvv ['soInsMargin'] != 0) {
                    $uSoInsArr [$fkk] ['name'] = $fvv ['name'];
                    $uSoInsArr [$fkk] ['uID'] = $fkk;
                    $uSoInsArr [$fkk] [$fk] = $fv;
                    $uSoInsArr [$fkk] ['status'] = $fvv ['status'];
                    if (strtotime($fvv ['soInsModifyDate']) > strtotime(" $soInsDateDe"))
                        $uSoInsArr [$fkk] ['soInsModifyDate'] = $fvv ['soInsModifyDate'];
                    else
                        $uSoInsArr [$fkk] ['soInsModifyDate'] = NUll;
                }
                break;
            case "uHFS" :
            case "uHFR" :
            case "HFWriteDownMoney" :
            case "uHFMoneyS" :
            case "uHFMoney" :
            case "curUHFMoney" :
            case "HFMargin" :
                if (!empty($_POST['name']) or $_GET ['displayModify'] == 'true') {
                    $uHFArr [$fkk] ['name'] = $fvv ['name'];
                    $uHFArr [$fkk] ['uID'] = $fkk;
                    $uHFArr [$fkk] [$fk] = $fv;
                    $uHFArr [$fkk] ['status'] = $fvv ['status'];
                    if (strtotime($fvv ['HFModifyDate']) > strtotime("$HFDateDe"))
                        $uHFArr [$fkk] ['HFModifyDate'] = $fvv ['HFModifyDate'];
                    else
                        $uHFArr [$fkk] ['HFModifyDate'] = NUll;
                } elseif ($fvv ['HFMargin'] != 0) {
                    $uHFArr [$fkk] ['name'] = $fvv ['name'];
                    $uHFArr [$fkk] ['uID'] = $fkk;
                    $uHFArr [$fkk] [$fk] = $fv;
                    $uHFArr [$fkk] ['status'] = $fvv ['status'];
                    if (strtotime($fvv ['HFModifyDate']) > strtotime(" $HFDateDe"))
                        $uHFArr [$fkk] ['HFModifyDate'] = $fvv ['HFModifyDate'];
                    else
                        $uHFArr [$fkk] ['HFModifyDate'] = NUll;
                }
                break;
            case "uComInsS" :
            case "uComInsR" :
            case "comInsWriteDownMoney" :
            case "uComInsMoneyS" :
            case "uComInsMoney" :
            case "curUComInsMoney" :
            case "comInsMargin" :
                if (!empty($_POST['name']) or $_GET ['displayModify'] == 'true') {
                    $uComInsArr [$fkk] ['name'] = $fvv ['name'];
                    $uComInsArr [$fkk] ['uID'] = $fkk;
                    $uComInsArr [$fkk] [$fk] = $fv;
                    $uComInsArr [$fkk] ['status'] = $fvv ['status'];
                } elseif ($fvv ['comInsMargin'] != 0) {
                    $uComInsArr [$fkk] ['name'] = $fvv ['name'];
                    $uComInsArr [$fkk] ['uID'] = $fkk;
                    $uComInsArr [$fkk] [$fk] = $fv;
                    $uComInsArr [$fkk] ['status'] = $fvv ['status'];
                }
                break;
            case "managementCostS" :
            case "managementCostR" :
            case "mCostWriteDownMoney" :
            case "managementCostMoneyS" :
            case "managementCostMoney" :
            case "curManagementCostMoney" :
            case "managementCostMargin" :
                if (!empty($_POST['name']) or $_GET ['displayModify'] == 'true') {
                    $mCostArr [$fkk] ['name'] = $fvv ['name'];
                    $mCostArr [$fkk] ['uID'] = $fkk;
                    $mCostArr [$fkk] [$fk] = $fv;
                    $mCostArr [$fkk] ['status'] = $fvv ['status'];
                    $mCostArr [$fkk] ['soInsBuyDate'] = $fvv ['soInsBuyDate'];
                    $mCostArr [$fkk] ['soInsurance'] = $fvv ['soInsurance'] ? NULL : "否";
                } elseif ($fvv ['managementCostMargin'] != 0) {
                    $mCostArr [$fkk] ['name'] = $fvv ['name'];
                    $mCostArr [$fkk] ['uID'] = $fkk;
                    $mCostArr [$fkk] [$fk] = $fv;
                    $mCostArr [$fkk] ['status'] = $fvv ['status'];
                    $mCostArr [$fkk] ['soInsBuyDate'] = $fvv ['soInsBuyDate'];
                    $mCostArr [$fkk] ['soInsurance'] = $fvv ['soInsurance'] ? NULL : "否";
                }
                break;
        }
    }
}
//echo "<pre>";
//print_r ( $uSoInsArr );
//unset ( $mCostArr );
#变量配置
$smarty->assign(array("salaryDate" => $salaryDate, "soInsDate" => $soInsDate, "soInsDateDe" => $soInsDateDe, "HFDate" => $HFDate, "HFDateDe" => $HFDateDe));
//$smarty->assign ( "feeArr", $feeArr );
$smarty->assign(array("uPDInsArr" => $uPDInsArr, "uSoInsArr" => $uSoInsArr, "uHFArr" => $uHFArr, "uComInsArr" => $uComInsArr, "mCostArr" => $mCostArr));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("salaryManage/feeEdit.tpl");
?>