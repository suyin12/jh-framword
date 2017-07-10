<?php

/*
 * 2011-06-28   系统计算,劳务费用,不包含员工工资;根据员工信息计算费用,包括各个欠款数据的收回及返还款
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
#页面标题
$title = "生成劳务费用表";
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
$salaryDate = $_GET ['salaryDate'];
$soInsDate = $_GET ['soInsDate'];
$HFDate = $_GET ['HFDate'];
$comInsDate = $_GET ['comInsDate'];
$managementCostDate = $_GET ['managementCostDate'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
$sql = "select unitID,month,salaryDate,soInsDate,HFDate,comInsDate,managementCostDate from `a_createFee_tmp` where `month` like :month and `unitID` like :unitID";
$ret = SQL($pdo, $sql, array(":month" => $month, ":unitID" => $unitID), "one");
#设置
if ($_POST['setDate'] && !$ret) {
    $bT = $_POST['bT'];
    $eT = $_POST['eT'];
    $wSql = "select a.* from a_workerInfo a left join a_dimission b on a.uID=b.uID where  a.unitID like :unitID and ( a.status in ('1','2') and a.`mountGuardDay`<'$eT' or ( a.status like '0'  and b.dimissionDate > '$bT' ) ) ";
    $wArr = SQL($pdo, $wSql, array(":unitID" => $unitID));
    $wArr = keyArray($wArr, "uID");

#累计欠款明细
    $moneyData = new money();
    $moneyData->pdo = $pdo;
    $moneyData->unitID = $unitID;
    $moneyData->month = $month;
    $moneyData->thisMonth = true;
    $sumMoney = $moneyData->sumMoney();
    #本月各费用
    $feeData = new feeData();
    $feeData->pdo = $pdo;
    $feeData->unitID = $unitID;
    $feeData->month = $month;
    $feeData->soInsDate = $soInsDate;
    $feeData->HFDate = $HFDate;
    $feeData->comInsDate = $comInsDate;
    $feeData->mCostDate = $managementCostDate;
    $feeData->unitArr();
    $feeData->wArr = $wArr;
    $extraFeeArr = $feeData->extraFeeArr();
    $soInsFeeArr = $extraFeeArr['soInsFeeArr'];
    $HFFeeArr = $extraFeeArr['HFFeeArr'];
    $comInsFeeArr = $extraFeeArr['comInsFeeArr'];
    $mCostFeeArr = $extraFeeArr['mCostFeeArr'];
    $helpCostFeeArr = $extraFeeArr['helpCostFeeArr'];
    $needPrsArr = null;
#核算出本月费用表需要的名单,包括累计欠款的人员,社保缴交明细人员,公积金缴交明细人员,商保缴交明细人员
    if ($sumMoney && $wArr) {
        //加上有欠款,却不出现在现有人员名单里的人员
        $needPrsArr_money = array_diff(array_keys($sumMoney), array_keys($wArr));
    }
    //找出在社保缴交明细里面,却不出现现有人员名单的人员
    if ($soInsFeeArr && $wArr) {
        $needPrsArr_soIns = array_diff(array_keys($soInsFeeArr), array_keys($wArr));
    }
    //找出在公积金缴交明细里面,却不出现现有人员名单的人员
    if ($HFFeeArr && $wArr) {
        $needPrsArr_HF = array_diff(array_keys($HFFeeArr), array_keys($wArr));
    }
    //找出在商保缴交明细里面,却不出现现有人员名单的人员
    if ($comInsFeeArr && $wArr) {
        $needPrsArr_comIns = array_diff(array_keys($comInsFeeArr), array_keys($wArr));
    }
    $needPrsArr = mergeArray($needPrsArr_money, $needPrsArr_soIns, $needPrsArr_HF, $needPrsArr_comIns);
    if ($needPrsArr) {
        $needPrsArr = array_unique($needPrsArr);
        $needPrsStr = implode("','", $needPrsArr);
        $needSql = "select * from a_workerInfo where uID in ('" . $needPrsStr . "')";
        $needArr = keyArray(SQL($pdo, $needSql), "uID");
        $wArr = mergeArray($wArr, $needArr);
    }


#构造数组
    foreach ($wArr as $val) {
        $uID = $val['uID'];
        $feeArr[] = array(
            "uID" => $uID,
            "name" => $val['name'],
            "uSoIns" => $soInsFeeArr[$uID]['uTotal'],
            "pSoIns" => $soInsFeeArr[$uID]['pTotal'],
            "uHF" => $HFFeeArr[$uID]['uTotal'],
            "pHF" => $HFFeeArr[$uID]['pTotal'],
            "uComIns" => $comInsFeeArr[$uID]['uComInsMoney'],
            "pComIns" => $comInsFeeArr[$uID]['pComInsMoney'],
            "uPDIns" => $soInsFeeArr[$uID]['uPDIns'],
            "managementCostFee" => $mCostFeeArr[$uID],
            "helpCostFee" => $helpCostFeeArr[$uID],
            "pSoInsMoney" => $sumMoney[$uID]['pSoInsMoney'] < 0 ? -$sumMoney[$uID]['pSoInsMoney'] : null,
            "uSoInsMoney" => $sumMoney[$uID]['uSoInsMoney'] < 0 ? -$sumMoney[$uID]['uSoInsMoney'] : null,
            "pHFMoney" => $sumMoney[$uID]['pHFMoney'] < 0 ? -$sumMoney[$uID]['pHFMoney'] : null,
            "uHFMoney" => $sumMoney[$uID]['uHFMoney'] < 0 ? -$sumMoney[$uID]['uHFMoney'] : null,
            "pComInsMoney" => $sumMoney[$uID]['pComInsMoney'] < 0 ? -$sumMoney[$uID]['pComInsMoney'] : null,
            "uComInsMoney" => $sumMoney[$uID]['uComInsMoney'] < 0 ? -$sumMoney[$uID]['uComInsMoney'] : null,
            "uPDInsMoney" => $sumMoney[$uID]['uPDInsMoney'] < 0 ? -$sumMoney[$uID]['uPDInsMoney'] : null,
            "managementCostMoney" => $sumMoney[$uID]['managementCostMoney'] < 0 ? -$sumMoney[$uID]['managementCostMoney'] : null,
            "salaryMoney" => $sumMoney[$uID]['salaryMoney'] < 0 ? -$sumMoney['salaryMoney'] : null,
        );
    }
    #把得到的数组插入到数据库中
    $iSql = "insert into `a_createFee_tmp` set `unitID`='$unitID',`month`='$month',`salaryDate`='$salaryDate',`soInsDate`='$soInsDate',`HFDate`='$HFDate',`comInsDate`='$comInsDate',`managementCostDate`='$managementCostDate',`sponsorName`='$mName',`sponsorTime`='$now', ";
    foreach ($feeArr as $fVal) {
        $iStr = NULL;
        foreach ($fVal as $fk => $fv) {
            $iStr .="`" . $fk . "`='" . $fv . "',";
        }
        $iStr = rtrim($iStr, ",");
        $actionSql [] = $iSql . $iStr;
    }
    $result = transaction($pdo, $actionSql);
    $errMsg = $result ['error'];
    if ($errMsg) {
        exit($errMsg);
    }
    else
        header("Location:" . httpPath . "feeAdvancedManage/createFee.php?month=" . $month . "&unitID=" . $unitID);
} elseif ($_POST['del']) {
    $delSql = "delete from `a_createFee_tmp` where `month` like '$month' and `unitID` like '$unitID'";
    $delRes=$pdo->query($delSql);
    $delRc=$delRes->rowCount();
    if($delRc){
        echo "<script>alert('删除成功'); window.close();</script>";
         die ();
    }else{
        echo "<script>alert('数据已清空'); </script>";
    }
}
#获取中英文对照数组
$engToChsArr = array(
    'status' => "在职状态",
    'pSoInsMoney' => "个人社保欠款",
    'uSoInsMoney' => "单位社保欠款",
    'pHFMoney' => "个人公积金欠款",
    'uHFMoney' => "单位公积金欠款",
    'pComInsMoney' => "个人商保欠款",
    'uComInsMoney' => "单位商保欠款",
    'uPDInsMoney' => "单位残障金欠款",
    "managementCostMoney" => "管理费欠款",
    'salaryMoney' => "工资垫付");
#获取相关的显示格式
$firstFieldArr = array('status', 'uID', 'name');
$fieldDisplay = new fieldDisplay();
$fieldDisplay->style = "math";
#费用相关项
$fieldArr = $fieldDisplay->feeField();
$fieldDisplay->actionArr = $fieldArr;
$formulasChartStr = $fieldDisplay->fieldStyle(7, $engToChsArr);
#获取额外项目的显示格式
$fieldDisplay->style = "none";
$wInfoFieldArr = $fieldDisplay->wInfoField();
$extraFieldArr = array_unique(mergeArray($firstFieldArr, $fieldArr, $wInfoFieldArr));
$fieldDisplay->actionArr = $extraFieldArr;
$extraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
//设置固定项
$fieldDisplay->style = "checkbox";
$fieldDisplay->actionArr = array_diff($wInfoFieldArr, $firstFieldArr);
$assistFieldSql = "select `ID`,`createFeeStyle` from `a_export_style` where `unitID` like :unitID";
$assistFieldRet = SQL($pdo, $assistFieldSql, array(":unitID" => $unitID), "one");
if ($assistFieldRet['ID']) {
    $smarty->assign("assistID", $assistFieldRet['ID']);
    if ($assistFieldRet['createFeeStyle']) {
        $assistArr = explode(",", $assistFieldRet['createFeeStyle']);
        $firstFieldArr = mergeArray($firstFieldArr, $assistArr);
    }
}
$fieldDisplay->assistArr = $assistArr;
$wInfoFieldStr = $fieldDisplay->fieldStyle(11, $engToChsArr);
#这里重新修改过,设置公式,可以每月的公式都不一样,
$formulasSql = " select `ID`,`totalFeeFormulas` from `a_otherFormulas` where `month`='$month' and `unitID`='$unitID' and `type`='3'";
$formulasRet = SQL($pdo, $formulasSql, null, 'one');
if ($formulasRet ['ID']) {
    $formulasStr = array("totalFee" => $formulasRet ['totalFeeFormulas']);
    $smarty->assign("formulasID", $formulasRet ['ID']);
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['totalFee'], $feeFieldArr);
}
#配置jquer grid显示标题
//重构显示的标题 在职状态,uID,name 以及费用相关先显示,其他的放到后面去
$js_fieldName = json_encode(array_values($extraFieldStr));
foreach ($extraFieldArr as $eKey => $eVal) {
    $fieldSet[$eKey]['name'] = $eVal;
    $fieldSet[$eKey]['index'] = $eVal;
    switch ($eVal) {
        case"uID":
            $fieldSet[$eKey]['editable'] = true;
            $fieldSet[$eKey]['editrules'] = array('required' => true);
            break;
        case "name":
            $fieldSet[$eKey]['summaryType'] = 'count';
            $fieldSet[$eKey]['summaryTpl'] = '小计:({0}) 人';
            break;
        case "totalFee":
            $fieldSet[$eKey]['sorttype'] = 'float';
            $fieldSet[$eKey]['formatter'] = "number";
            $fieldSet[$eKey]['summaryType'] = 'sum';
            break;
        default :
            //如果是员工信息项目,除预设的显示外,其余都隐藏
            if (in_array($eVal, $wInfoFieldArr) && !in_array($eVal, $firstFieldArr)) {
                $fieldSet[$eKey]['hidden'] = true;
            } elseif (in_array($eVal, $fieldArr)) {//在费用设置的项目中
                $fieldSet[$eKey]['editable'] = true;
                $fieldSet[$eKey]['sorttype'] = 'float';
                $fieldSet[$eKey]['formatter'] = "number";
                $fieldSet[$eKey]['summaryType'] = 'sum';
                $fieldSet[$eKey]['editrules'] = array('number' => true);
                //如果不在 总费中就隐藏
                if (!in_array($eVal, $feeFieldArr['0']))
                    $fieldSet[$eKey]['hidden'] = true;
            }
            break;
    }
}

$js_fieldSet = json_encode(array_values($fieldSet));
//editUrl
$editUrl = httpPath . "feeAdvancedManage/data.php?a=createFee&unitID=" . $ret['unitID'] . "&month=" . $ret['month'] . "&salaryDate=" . $ret['salaryDate'] . "&soInsDate=" . $ret['soInsDate'] . "&HFDate=" . $ret['HFDate'] . "&comInsDate=" . $ret['comInsDate'] . "&managementCostDate=" . $ret['managementCostDate'];
#变量配置
$smarty->assign(array("formulasChartStr" => $formulasChartStr, "wInfoFieldStr" => $wInfoFieldStr));
$smarty->assign(array("formulasStr" => $formulasStr));
$smarty->assign(array("js_fieldName" => $js_fieldName, "js_fieldSet" => $js_fieldSet, "editUrl" => $editUrl));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("feeAdvancedManage/createFee.tpl");
?>
