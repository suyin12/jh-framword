<?php

/**
 * Description of exportExcel
 *  设置并 导出,费用表,发放表,
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/reward.data.php';
#连接费用核算类
require_once sysPath . 'dataFunction/fee.data.php';
#页面标题
$title = "设置/导出报表";
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
if ($_POST['wantToMerge'] == "1") {
    $uSql = "select a.unitID,a.wantToMerge from `a_unitInfo` a  where a.`wantToMerge`= (select `wantToMerge` from `a_unitInfo` where `unitID` like :unitID) ";
    $uRet = SQL($pdo, $uSql, array(":unitID" => $unitID));
    $unitID = null;
    foreach ($uRet as $uVal) {
        $unitID .= "'" . $uVal['unitID'] . "',";
    }
    $unitID = rtrim($unitID, ",");
    $wantToMergeInfo = wantToMergeInfo();
    $unitName = $wantToMergeInfo[$uRet['0']['wantToMerge']];
}
$extraBatch = $_GET['extraBatch'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");

$sql = "select *  from `a_rewardFee` where `month` like :month  and `unitID` in ( $unitID ) and `extraBatch` = :extraBatch ";
if ($_POST['search']) {
    $sql .=" and name like '" . trim($_POST['name']) . "%'";
}
$sql .=" order by unitID ";
$feeRet = SQL($pdo, $sql, array(':month' => $month, ":extraBatch" => $extraBatch));
$rewardDate = $feeRet['0'] ['rewardDate'];
$extraBatch = $feeRet['0'] ['extraBatch'];
$zID = $feeRet['0']['zID'];
$feeBasicFieldArr = array('pay', 'uAccount');
$salaryBasicFieldArr = array('pay', 'ratal');
#验证是否存在本奖金月份的工资表
$feeData = new feeData();
$feeData->pdo = $pdo;
$feeData->unitID = $unitID;
$feeData->month = $month;
$feeData->salaryDate = $rewardDate;
$feeData->wArr = $feeRet;
$exSalaryRet = $feeData->mergeTax_fee("mulFee");
$salaryMonth = $rewardDate;

#是否有需要合并计税的相关
$rewardData = new rewardData();
$rewardData->pdo = $pdo;
$rewardData->month = $month;
$rewardData->unitID = $unitID;
$rewardData->rewardDate = $rewardDate;
$rewardDataArr = $rewardData->ratalAsReward($extraBatch);
#获取已设置的合并项
$mergeTaxSql = "select * from `a_merge_tax` where `month`='$month' and `unitID` in ($unitID) and `extraBatch`='$extraBatch' and `basic`='reward'";
$mergeTaxRet = SQL($pdo, $mergeTaxSql);
foreach ($mergeTaxRet as $mVal) {
    $rewardCheck[$mVal['action']][$mVal['actionExtraBatch']] = 'checked';
    $taxTypeCheck = $mVal['taxType'] == '1' ? 'checked' : null;
}
#获取中英文对照数组
$engToChsArr = array(
    'status' => "在职状态",
    'uAccount' => '单位挂账',
    'pTaxTotal' => '应扣税合计',
    'ratalTotal' => '应缴纳税额合计',
    'ratalMonAvg' => '月均奖金',
    'taxPer' => '税率',
    'pay' => "应发奖金",
    'acheive' => "实发奖金",
    'pTax' => "奖金税"
);
$ratalNum = 0;
if ($rewardCheck) {
    foreach ($rewardCheck as $reKey => $reVal) {
        switch ($reKey) {
            case "salary":
                //已发的工资费用
                $mergeTaxChart[] = 'ratal' . $ratalNum;
                if ($taxTypeCheck != 'checked')
                    $mergeTaxChart[] = 'pTax' . $ratalNum;                
                $engToChsArr['ratal' . $ratalNum] = "工资应税额";
                $engToChsArr['pTax' . $ratalNum] = "已扣工资税";
                $ratalNum++;
                break;
            case "reward":
                //已发的奖金费用
                foreach ($reVal as $reK => $reV) {
                    $mergeTaxChart[] = 'ratal' . $ratalNum;
					if ($taxTypeCheck != 'checked')
                      $mergeTaxChart[] = 'pTax' . $ratalNum;
                    $engToChsArr['ratal' . $ratalNum] = "奖金应税额[$reK]";
                    $engToChsArr['pTax' . $ratalNum] = "已扣奖金税[$reK]";
                    $ratalNum++;
                }
                break;      
			 
        }
    }
    if ($taxTypeCheck != 'checked')
        $mergeTaxChart = mergeArray($mergeTaxChart, array('ratalTotal', 'pTaxTotal', 'pTax'));
    else
        $mergeTaxChart = mergeArray($mergeTaxChart, array('ratalTotal','ratalMonAvg','taxPer','pTax'));		
}else
    array_push($salaryBasicFieldArr, 'pTax');
#获取应发奖金项名称
$zFSql = "select `field` from `a_zFormatInfo` where `zID`='$zID'";
$zFRet = SQL($pdo, $zFSql, null, 'one');
$zFEngToCHN = makeArray($zFRet['field']);
$engToChsArr = array_merge($engToChsArr, $zFEngToCHN);
#获取额外项目的显示格式
$firstFieldArr = array("num", "unitName", "name","pID","spID");
$fieldDisplay = new fieldDisplay();
$fieldDisplay->style = "none";
$wInfoFieldArr = $fieldDisplay->wInfoField();
$formulasFieldArr = $fieldDisplay->formulasField($pdo, "reward", array('month' => $month, "unitID" => $unitID, 'extraBatch' => $extraBatch));
$payFieldArr = $formulasFieldArr['payFormulas'];
$acheiveFieldArr = $formulasFieldArr['acheiveFormulas'];
$totalFeeFieldArr = $formulasFieldArr['totalFeeFormulas'];
//如果有额外项
if ($totalFeeFieldArr)
    $feeBasicFieldArr = mergeArray($feeBasicFieldArr, $totalFeeFieldArr);
array_push($feeBasicFieldArr, "totalFee");
//合并扣税项
if ($mergeTaxChart)
    $salaryBasicFieldArr = mergeArray($salaryBasicFieldArr, $mergeTaxChart);
if ($acheiveFieldArr)
    $salaryBasicFieldArr = mergeArray($salaryBasicFieldArr, $acheiveFieldArr);
$salaryBasicFieldArr = array_merge($salaryBasicFieldArr, array("acheive", "bID"));
$feeExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $feeBasicFieldArr, $wInfoFieldArr));
$salaryExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $salaryBasicFieldArr, $wInfoFieldArr));
$fieldDisplay->actionArr = $feeExtraFieldArr;
$feeExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
$fieldDisplay->actionArr = $salaryExtraFieldArr;
$salaryExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
if ($_POST['subStyle'] || $_GET['output'] == 'true') {
    $wSql = "select a.*,b.unitName from `a_workerInfo` a left join `a_unitInfo` b on a.unitID=b.unitID where a.`unitID` in ( $unitID )";
    $wArr = SQL($pdo, $wSql);
    if (!$_POST['wantToMerge'] == "1")
        $unitName = $wArr['0']['unitName'];
    $wArr = keyArray($wArr, "uID");
    #重构显示的数组
    if ($_GET['output']) {
        $feeExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $feeBasicFieldArr));
        $salaryExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $salaryBasicFieldArr));
    } else {
        $feeExtraFieldArr = $_POST['feeExcelStyle'];
        $salaryExtraFieldArr = $_POST['salaryExcelStyle'];
    }$fieldDisplay->actionArr = $feeExtraFieldArr;
    $feeExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
    $fieldDisplay->actionArr = $salaryExtraFieldArr;
    $salaryExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
    $i = $j = 0;
    foreach ($feeRet as $fVal) {
        #费用发放表
        foreach ($feeExtraFieldArr as $fEV) {
            switch ($fEV) {
                case "num":
                    $feeArr[$i][$fEV] = $i + 1;
                    break;
                case "unitName":
                    $feeArr[$i][$fEV] = $wArr[$fVal['uID']][$fEV];
                    break;
                //本月欠挂
                default :
                    if (array_key_exists($fEV, $fVal)) {
                        if (is_numeric($fVal[$fEV]))
                            $feeArr[$i][$fEV] = $fVal[$fEV] == 0 ? NULL : $fVal[$fEV];
                        else
                            $feeArr[$i][$fEV] = $fVal[$fEV];
                    } elseif (in_array($fEV, $wInfoFieldArr)) {
                        $feeArr[$i][$fEV] = $wArr[$fVal['uID']][$fEV];
                    }
                    break;
            }
        }
        $i++;
        #奖金发放表
        if ($fVal['pay'] > 0) {
            foreach ($salaryExtraFieldArr as $sEV) {
                switch ($sEV) {
                    case "num":
                        $salaryArr[$j][$sEV] = $j + 1;
                        break;
                    case "unitName":
                        $salaryArr[$j][$sEV] = $wArr[$fVal['uID']][$sEV];
                        break;
                    case $mergeTaxChart && in_array($sEV, $mergeTaxChart):
                        $mergeTax = $ratalNum = $mergeRatal = 0;
                        foreach ($rewardCheck as $reKey => $reVal) {
                            switch ($reKey) {
                                case "salary":
                                    //已发的工资费用
                                    $salaryArr[$j]['ratal' . $ratalNum] = $exSalaryRet[$fVal['uID']]['ratal'];
                                    if ($taxTypeCheck != 'checked')
                                        $salaryArr[$j]['pTax' . $ratalNum] = $exSalaryRet[$fVal['uID']]['pTax'];
                                    $mergeRatal +=$salaryArr[$j]['ratal' . $ratalNum];
                                    $mergeTax+=$salaryArr[$j]['pTax' . $ratalNum];
                                    $ratalNum++;
                                    break;
                                case "reward":
                                    //已发的奖金费用
                                    foreach ($reVal as $reK => $reV) {
                                        $salaryArr[$j]['ratal' . $ratalNum] = $rewardDataArr[$reK][$fVal['uID']]['ratal'];
										if ($taxTypeCheck != 'checked')
                                        $salaryArr[$j]['pTax' . $ratalNum] = $rewardDataArr[$reK][$fVal['uID']]['pTax'];
                                        $mergeRatal +=$salaryArr[$j]['ratal' . $ratalNum];
                                        $mergeTax+=$salaryArr[$j]['pTax' . $ratalNum];
                                        $ratalNum++;
                                    }
                                    break;
                            }
                        }
                        if ($taxTypeCheck != 'checked') {
                            $salaryArr [$j] ['ratalTotal'] = $fVal['ratal'] + $mergeRatal;
                            $salaryArr [$j] ['pTaxTotal'] = round(taxCount($salaryArr [$j] ['ratalTotal']), 2);
                        } else {
                            $taxTypeArr = array("type" => "yearAward", "salary" => $mergeRatal);
                            $yearAwardArr = taxCount($fVal['ratal'], $taxTypeArr);
                            $salaryArr [$j] ['ratalTotal'] = $yearAwardArr['ratalTotal'];
                            $salaryArr [$j] ['ratalMonAvg'] = $yearAwardArr['ratalMonAvg'];
                            $salaryArr [$j] ['taxPer'] = $yearAwardArr['taxPer'];
                        }
                        $salaryArr [$j] ['pTax'] = $fVal ['pTax'];
                        break;
                    default :
                        if (array_key_exists($sEV, $fVal)) {
                            if (is_numeric($fVal[$sEV]) && $fVal[$sEV] == 0)
                                $salaryArr[$j][$sEV] = NULL;
                            else
                                $salaryArr[$j][$sEV] = $fVal[$sEV];
                        } elseif (in_array($sEV, $wInfoFieldArr)) {
                            $salaryArr[$j][$sEV] = $wArr[$fVal['uID']][$sEV];
                        }
                        break;
                }
            }
            $j++;
        }
    }
//    echo "<pre>";
//    print_r($salaryArr);
#合计数
    foreach ($feeArr as $fAVal) {
        foreach ($fAVal as $fAK => $fAV) {
            switch ($fAK) {
                case 'name':
                    $feeTotal[$fAK] = $feeArr[$i][$fAK] = "合计:" . $i . "人";
                    break;
                case "num":
                case "bID":
                case "pID":
                case "spID":
                    $feeTotal[$fAK] = $feeArr[$i][$fAK] = NULL;
                    break;
                default :
                    if (in_array($fAK, $feeBasicFieldArr))
                        $feeTotal[$fAK] = $feeArr[$i][$fAK] +=$fAV;
                    else
                        $feeTotal[$fAK] = $feeArr[$i][$fAK] = NULL;
                    break;
            }
        }
    }

    foreach ($salaryArr as $sAVal) {
        foreach ($sAVal as $sAK => $sAV) {
            switch ($sAK) {
                case 'name':
                    $salaryTotal[$sAK] = $salaryArr[$j][$sAK] = "合计:" . $j . "人";
                    break;
                case "num":
                case "bID":
                case "pID":
                case "spID":
                    $salaryTotal[$sAK] = $salaryArr[$j][$sAK] = NULL;
                    break;
                default :
                    if (in_array($sAK, $salaryBasicFieldArr))
                        $salaryTotal[$sAK] = $salaryArr[$j][$sAK] +=$sAV;
                    else
                        $salaryTotal[$sAK] = $salaryArr[$j][$sAK] = NULL;
                    break;
            }
        }
    }
    #如果只是显示,则不下载EXEL
    if ($_GET['output'] == 'true') {
        $exportUrl = httpPath . "rewardManage/exportExcel.php?unitID=$unitID&month=$month&extraBatch=$extraBatch";
        if ($_GET['type'] == "fee") {
            $smarty->assign("newFieldArr", $feeExtraFieldStr);
            array_pop($feeArr);
            $editUrl = httpPath . "rewardManage/makeRewardFee.php?unitID=$unitID&month=$month&extraBatch=$extraBatch";
            $smarty->assign("ret", $feeArr);
            $smarty->assign("total", $feeTotal);
        } elseif ($_GET['type'] == "salary") {
            $smarty->assign("newFieldArr", $salaryExtraFieldStr);
            array_pop($salaryArr);
            $editUrl = httpPath . "rewardManage/makeReward.php?unitID=$unitID&month=$month&extraBatch=$extraBatch";
            $smarty->assign("ret", $salaryArr);
            $smarty->assign("total", $salaryTotal);
        }
        #模板配置
        $smarty->assign(array("editUrl" => $editUrl, "exportUrl" => $exportUrl));
        $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
        $smarty->display("rewardManage/detail.tpl");
        die();
    }
    $thArr [] = $feeExtraFieldStr;
    $feeArr = array_merge($thArr, $feeArr);
    unset($thArr);
    $thArr [] = $salaryExtraFieldStr;
    $salaryArr = array_merge($thArr, $salaryArr);
    #获取表底,有关费用的相关合计数组
    foreach ($salaryArr[$j + 1] as $salaryK => $salaryV) {
        if ($salaryK != 'bID' && in_array($salaryK, $salaryBasicFieldArr) && $salaryV != 0) {
            switch ($salaryK) {
                case "bID":
                case "pay":
                case "ratal":
                    break;
                default:
                    $feeFooterArr[$i][$salaryK] = $salaryV;
                    break;
            }
            $salaryFooterArr[$j][$salaryK] = $salaryV;
        }
    }
    foreach ($feeArr[$i + 1] as $feeK => $feeV) {
        if ($feeK != 'pay' && in_array($feeK, $feeBasicFieldArr) && $feeV != 0) {
            $feeFooterArr[$i][$feeK] = $feeV;
        }
    }
    #链接PHPEXCEL CLASS
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once '../class/excel.class.php';
    $oExcel = new PHPExcel ();
    #设置文档基本属性
    $oPro = $oExcel->getProperties();
    $oPro->setCreator($authorCompany); //公司名   
    #构造输出函数
    $op = new excelOutput ();
    $op->oExcel = $oExcel;
    $op->title = "奖金费用表";
    $op->eRes = $feeArr;
    $op->selFieldArray = $feeExtraFieldStr;
    $op->hideCol(mergeArray($payFieldArr, array('pID',"spID")));
    $op->setSheetHeader("fee", array("headStr" => $authorCompany . substr($rewardDate, 0, 4) . '年' . substr($rewardDate, 4) . '月' . "奖金费用表", 'unitName' => "客户名称:" . $unitName, 'createTime' => '制表时间:' . timeStyle("dateTime")));
    $op->headRow = 5;
    $op->fillData();
    $op->selFieldArray = array_merge($feeExtraFieldStr, $salaryExtraFieldStr);
    $op->setSheetFooter("fee", $feeFooterArr);
    $oExcel->createSheet();
    $op->sheetIndex = 1;
    $op->title = "奖金发放表";
    $op->eRes = $salaryArr;
    $op->selFieldArray = $salaryExtraFieldStr;
    $op->hideCol($payFieldArr);
    $op->setSheetHeader("fee", array("headStr" => $authorCompany . substr($rewardDate, 0, 4) . '年' . substr($rewardDate, 4) . '月' . "奖金发放表", 'unitName' => "客户名称:" . $unitName, 'createTime' => '制表时间:' . timeStyle("dateTime")));
    $op->headRow = 5;
    $op->fillData();
    $op->setSheetFooter("salary", $salaryFooterArr);
    $op->eFileName = $month . $unitName . ".xls";
    $op->output();
    exit();
}

#变量配置
$smarty->assign(array("firstFieldArr" => $firstFieldArr, "payFieldArr" => $payFieldArr, "totalFeeFieldArr" => $totalFeeFieldArr));
$smarty->assign(array("salaryBasicFieldArr" => $salaryBasicFieldArr, "salaryExtraFieldStr" => $salaryExtraFieldStr));
$smarty->assign(array("feeBasicFieldArr" => $feeBasicFieldArr, "feeExtraFieldStr" => $feeExtraFieldStr));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("rewardManage/exportExcel.tpl");
?>
