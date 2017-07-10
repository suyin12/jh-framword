<?php

/**
 * Description of exportExcel
 *  设置并 导出,费用表,工资表,
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
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#页面标题
$title = "设置/导出报表";
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
$extraBatch = $_GET['extraBatch'];
if ($_GET['wantToMerge'] == "true") {
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
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");

$feeBasicFieldArr = array('pay', 'uSoIns', 'uHF', 'uComIns', 'uPDIns', 'managementCost', 'advanceMoney');
$salaryBasicFieldArr = array('pay', 'ratal', 'ratalYet', 'pTaxYet', 'pTax', 'pSoIns', 'pHF', 'pComIns', 'utilities', 'helpCost', 'cardMoney');
if (!$extraBatch)://如果为首次工资费用,则保留欠/挂账情况导出
    $sql = "select *  from `a_originalFee` where `month` like :month  and `unitID` in ( $unitID )  ";
    if ($_POST['search']) {
        $sql .=" and name like '" . trim($_POST['name']) . "%'";
    }
    $sql .=" order by unitID ";
    $feeRet = SQL($pdo, $sql, array(':month' => $month));
    $salaryDate = $feeRet['0'] ['salaryDate'];
    $comInsDate = $feeRet['0'] ['comInsDate'];
    $soInsDate = $feeRet['0'] ['soInsDate'];
    $HFDate = $feeRet['0'] ['HFDate'];
    $managementCostDate = $feeRet['0'] ['managementCostDate'];
    $zID = $feeRet['0']['zID'];

#本月欠/挂/收回/冲减
    $moneyData = new money();
    $moneyData->pdo = $pdo;
    $moneyData->unitID = $unitID;
    $moneyData->month = $month;
    $curMonthMoney = $moneyData->curMonth("tmp");
    $curMonthMoneyTotal = $moneyData->curMonthTotal("tmp");
#根据本月的累计欠/挂 计算需要显示的项目有哪些
    if ($curMonthMoneyTotal)
        foreach ($curMonthMoneyTotal as $cTKey => $cTVal) {
            switch ($cTKey) {
                case "1":
                case "2":
                    foreach ($cTVal as $cTK => $cTV) {
                        if ($cTV != 0) {
                            $cTK = 'cur' . ucwords($cTK);
                            array_push($feeBasicFieldArr, $cTK);
                        }
                    }
                    break;
                case "3":
                    foreach ($cTVal as $cTK => $cTV) {
                        if ($cTV != 0) {
                            switch ($cTK) {
                                case "pSoInsMoney":
                                case 'pHFMoney':
                                case 'pComInsMoney':
                                    array_push($salaryBasicFieldArr, $cTK);
                                    break;
                                default :
                                    array_push($feeBasicFieldArr, $cTK);
                                    break;
                            }
                        }
                    }
                    break;
                case "4":
                    //不显示冲减挂账
//                foreach ($cTVal as $cTK => $cTV) {
//                    if ($cTV != 0) {
//                        $cTK = substr($cTK, 0, -5) . "WriteDown";
//                        array_push($feeBasicFieldArr, $cTK);
//                    }
//                }
                    break;
            }
        }
    array_unique($feeBasicFieldArr);
    array_unique($salaryBasicFieldArr);
else://如果是多次费用, 则不包括本月欠/挂情况
    $sql = "select *  from `a_mul_originalFee` where `month` like :month  and `unitID` in ( $unitID ) and extraBatch='$extraBatch' ";
    if ($_POST['search']) {
        $sql .=" and name like '" . $_POST['name'] . "%'";
    }
    $sql .=" order by unitID ";
    $feeRet = SQL($pdo, $sql, array(':month' => $month));
    $salaryDate = $feeRet['0'] ['salaryDate'];
    $comInsDate = $feeRet['0'] ['comInsDate'];
    $soInsDate = $feeRet['0'] ['soInsDate'];
    $HFDate = $feeRet['0'] ['HFDate'];
    $managementCostDate = $feeRet['0'] ['managementCostDate'];
    $zID = $feeRet['0']['zID'];
    #本月欠/挂/收回/冲减
    $moneyData = new money();
    $moneyData->pdo = $pdo;
    $moneyData->unitID = $unitID;
    $moneyData->month = $month;
    $moneyData->extraBatch=$extraBatch;
    $curMonthMoney = $moneyData->curMonth("tmp");
    $curMonthMoneyTotal = $moneyData->curMonthTotal("tmp");
    #根据本月的累计欠/挂 计算需要显示的项目有哪些
    if ($curMonthMoneyTotal)
    	foreach ($curMonthMoneyTotal as $cTKey => $cTVal) {
    	switch ($cTKey) {
    		case "1":
    		case "2":
    			foreach ($cTVal as $cTK => $cTV) {
    				if ($cTV != 0) {
    					$cTK = 'cur' . ucwords($cTK);
    					array_push($feeBasicFieldArr, $cTK);
    				}
    			}
    			break;
    		case "3":
    			foreach ($cTVal as $cTK => $cTV) {
    				if ($cTV != 0) {
    					switch ($cTK) {
    						case "pSoInsMoney":
    						case 'pHFMoney':
    						case 'pComInsMoney':
    							array_push($salaryBasicFieldArr, $cTK);
    							break;
    						default :
    							array_push($feeBasicFieldArr, $cTK);
    							break;
    					}
    				}
    			}
    			break;
    		case "4":
    			//不显示冲减挂账
    			//                foreach ($cTVal as $cTK => $cTV) {
    			//                    if ($cTV != 0) {
    			//                        $cTK = substr($cTK, 0, -5) . "WriteDown";
    			//                        array_push($feeBasicFieldArr, $cTK);
    			//                    }
    			//                }
    			break;
    	}
    }
    array_unique($feeBasicFieldArr);
    array_unique($salaryBasicFieldArr);
    //由于多次工资的挂账情况,跟首次工资的不同,故这里要添加单位挂账列
    array_push($feeBasicFieldArr, "uAccount");
endif;

//print_r($salaryBasicFieldArr);
#获取应发工资项名称
$zFSql = "select `field` from `a_zFormatInfo` where `zID`='$zID'";
$zFRet = SQL($pdo, $zFSql, null, 'one');
$zFEngToCHN = makeArray($zFRet['field']);
#获取中英文对照数组
$engToChsArr = array(
    'status' => "在职状态",
    'pTaxYet' => "已扣个税",
    'ratalYet' => "已发工资应税额",
    'pSoInsMoney' => "收回个人社保欠款",
    'uSoInsMoney' => "收回单位社保欠款",
    'pHFMoney' => "收回个人公积金欠款",
    'uHFMoney' => "收回单位公积金欠款",
    'pComInsMoney' => "收回个人商保欠款",
    'uComInsMoney' => "收回单位商保欠款",
    'uPDInsMoney' => "收回残障金欠款",
    "managementCostMoney" => "收回管理费欠款",
    'pSoIns' => "个人社保($soInsDate)",
    'uSoIns' => "单位社保($soInsDate)",
    'pHF' => "个人公积金($HFDate)",
    'uHF' => "单位公积金($HFDate)",
    'pComIns' => "个人商保($comInsDate)",
    'uComIns' => "单位商保($comInsDate)",
    'uPDIns' => "残障金($soInsDate)",
    "managementCost" => "管理费($managementCostDate)",
    "uAccount" => "单位挂账",
    'curUSoInsMoney' => '本月社保欠/挂',
    'curUHFMoney' => '本月公积金欠/挂',
    'curUComInsMoney' => '本月商保欠/挂',
    'curManagementCostMoney' => '本月管理费欠/挂',
    'curUAccount' => '单位挂账',
    'uSoInsWriteDown' => '社保冲减(总费用不累加)',
    'uHFWriteDown' => '公积金冲减(总费用不累加)',
    'uComInsWriteDown' => '商保冲减(总费用不累加)',
    'managementCostWriteDown' => '管理费冲减(总费用不累加)',
    'salaryMoney' => "工资垫付");
$engToChsArr = array_merge($engToChsArr, $zFEngToCHN);
#获取额外项目的显示格式
$firstFieldArr = array("num", "unitName", "name","pID","spID");
$fieldDisplay = new fieldDisplay();
$fieldDisplay->style = "none";
$wInfoFieldArr = $fieldDisplay->wInfoField();
if (!$extraBatch):
    $formulasFieldArr = $fieldDisplay->formulasField($pdo, "fee", array('month' => $month, "unitID" => $_GET['unitID']));
    $formulasStr=$fieldDisplay->formulas;
else:
    $formulasFieldArr = $fieldDisplay->formulasField($pdo, "mulFee", array('month' => $month, "unitID" => $_GET['unitID'], "extraBatch" => $extraBatch));
    $formulasStr=$fieldDisplay->formulas;
endif;
$payFieldArr = $formulasFieldArr['payFormulas'];
$acheiveFieldArr = $formulasFieldArr['acheiveFormulas'];
$totalFeeFieldArr = $formulasFieldArr['totalFeeFormulas'];
if ($totalFeeFieldArr)
    $feeBasicFieldArr = mergeArray($feeBasicFieldArr, $totalFeeFieldArr);
array_push($feeBasicFieldArr, "totalFee");
if ($acheiveFieldArr)
    $salaryBasicFieldArr = mergeArray($salaryBasicFieldArr, $acheiveFieldArr);
$salaryBasicFieldArr = array_merge($salaryBasicFieldArr, array("acheive", "bID"));
$feeExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $feeBasicFieldArr, $wInfoFieldArr));
$salaryExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $salaryBasicFieldArr, $wInfoFieldArr));
// $feeExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $feeBasicFieldArr,array("uSoInsMoney","uHFMoney","uComInsMoney","uPDInsMoney","managementCostMoney","curUSoInsMoney","curUHFMoney","curUComInsMoney","curUAccount","uSoInsWriteDown","uHFWriteDown",'uComInsWriteDown','managementCostWriteDown','salaryMoney'), $wInfoFieldArr));
// $salaryExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $salaryBasicFieldArr, array('pSoInsMoney','pHFMoney','pComInsMoney'),$wInfoFieldArr));
$fieldDisplay->actionArr = $feeExtraFieldArr;
$feeExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
$fieldDisplay->actionArr = $salaryExtraFieldArr;
$salaryExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
$i = 0;
$formulasChartStr .= "<tr>";
foreach ($zFEngToCHN as $chartKey => $chart) {
    if ($i % 9 == 0 && $i != 0)
        $formulasChartStr .= "</tr><tr>";
    $i++;
    $formulasChartStr .= "<td>";
    $formulasChartStr .= "($chartKey)$chart";
    $formulasChartStr .= "</td>";
}
$formulasChartStr .= "</tr>";
#
if ($_POST['subStyle'] || $_GET['output'] == true) {
    $wSql = "select a.*,b.unitName from `a_workerInfo` a left join `a_unitInfo` b on a.unitID=b.unitID where a.`unitID` in ($unitID)";
    $wArr = SQL($pdo, $wSql);
    if (!$_GET['wantToMerge'] == "true")
        $unitName = $wArr['0']['unitName'];
    $wArr = keyArray($wArr, "uID");
    #重构显示的数组
    if ($_GET['output']) {
        $feeExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $feeBasicFieldArr));
        $salaryExtraFieldArr = array_unique(mergeArray($firstFieldArr, $payFieldArr, $salaryBasicFieldArr));
    } else {
        $feeExtraFieldArr = $_POST['feeExcelStyle'];
        $salaryExtraFieldArr = $_POST['salaryExcelStyle'];
    }
    $fieldDisplay->actionArr = $feeExtraFieldArr;
    $feeExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
    $fieldDisplay->actionArr = $salaryExtraFieldArr;
    $salaryExtraFieldStr = $fieldDisplay->fieldStyle(NULL, $engToChsArr);


    $i = $j = 0;
    foreach ($feeRet as $fVal) {

        #费用表
        foreach ($feeExtraFieldArr as $fEV) {
            switch ($fEV) {
                case "num":
                    $feeArr[$i][$fEV] = $i + 1;
                    break;
                case "unitName":
                    $feeArr[$i][$fEV] = $wArr[$fVal['uID']][$fEV];
                    break;
                case "name":
                    $feeArr[$i][$fEV] = $fVal[$fEV];
                    break;
                //本月欠挂
                case 'curUSoInsMoney':
                case 'curUHFMoney' :
                case 'curUComInsMoney' :
                case 'curUPDInsMoney' :
                case 'curManagementCostMoney' :
                case 'curUAccount':
                    $acFEV = strtolower(substr($fEV, 3, 1)) . substr($fEV, 4);
                    $feeArr[$i][$fEV] = $curMonthMoney['curRM'] [$fVal['uID']][$acFEV];
                    break;
                //本月收回
                case 'uSoInsMoney':
                case 'uHFMoney' :
                case 'uComInsMoney' :
                case 'uPDInsMoney':
                case 'managementCostMoney' :
                    $feeArr[$i][$fEV] = $curMonthMoney['prsReMoney'] [$fVal['uID']][$fEV];
                    break;
                //本月冲减
                case 'uSoInsWriteDown':
                case 'uHFWriteDown' :
                case 'uComInsWriteDown' :
                case 'managementCostWriteDown' :
                    $acFEV = substr($fEV, 0, -9) . "Money";
                    $feeArr[$i][$fEV] = $curMonthMoney['curWriteDown'] [$fVal['uID']][$acFEV];
                    break;
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
        #工资表
        if ($fVal['pay'] > 0) {
            foreach ($salaryExtraFieldArr as $sEV) {
                switch ($sEV) {
                    case "num":
                        $salaryArr[$j][$sEV] = $j + 1;
                        break;
                    case "unitName":
                        $salaryArr[$j][$sEV] = $wArr[$fVal['uID']][$sEV];
                        break;
                    case "name":
                        $salaryArr[$j][$sEV] = $fVal[$sEV];
                        break;
                    //本月收回
                    case 'pSoInsMoney':
                    case 'pHFMoney' :
                    case 'pComInsMoney' :
                        $salaryArr[$j][$sEV] = $curMonthMoney['prsReMoney'] [$fVal['uID']][$sEV];
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
                    if (in_array($fAK, $feeBasicFieldArr)){
                        $feeArr[$i][$fAK] =round($feeArr[$i][$fAK]+$fAV,2);
                        $feeTotal[$fAK] = round($feeArr[$i][$fAK],2);
                    }
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
                    if (in_array($sAK, $salaryBasicFieldArr)){
                         $salaryArr[$j][$sAK] =round($salaryArr[$j][$sAK]+$sAV,2);
                         $salaryTotal[$sAK] = round($salaryArr[$j][$sAK],2);
                    }
                    else
                        $salaryTotal[$sAK] = $salaryArr[$j][$sAK] = NULL;
                    break;
            }
        }
    }
    #如果只是显示,则不下载EXEL
    if ($_GET['output'] == true) {
        if ($_GET['type'] == "fee") {
            $smarty->assign("newFieldArr", $feeExtraFieldStr);
            array_pop($feeArr);
            if ($extraBatch):
                $editUrl = httpPath . "salaryManage/makeFee_mul.php?unitID=$unitID&month=$month&extraBatch=$extraBatch";
                $exportUrl = httpPath . "salaryManage/exportExcel.php?unitID=$unitID&month=$month&extraBatch=$extraBatch";
            else:
                $editUrl = httpPath . "salaryManage/makeFee.php?unitID=$unitID&month=$month";
                $exportUrl = httpPath . "salaryManage/exportExcel.php?unitID=$unitID&month=$month";
            endif;
            $smarty->assign("ret", $feeArr);
            $smarty->assign("total", $feeTotal);
        } elseif ($_GET['type'] == "salary") {
            $smarty->assign("newFieldArr", $salaryExtraFieldStr);
            array_pop($salaryArr);
            if ($extraBatch):
                $editUrl = httpPath . "salaryManage/makeSalaryFee_mul.php?unitID=$unitID&month=$month&extraBatch=$extraBatch";
                $exportUrl = httpPath . "salaryManage/exportExcel.php?unitID=$unitID&month=$month&extraBatch=$extraBatch";
            else:
                $editUrl = httpPath . "salaryManage/makeSalaryFee.php?unitID=$unitID&month=$month";
                $exportUrl = httpPath . "salaryManage/exportExcel.php?unitID=$unitID&month=$month";
            endif;
            $smarty->assign("ret", $salaryArr);
            $smarty->assign("total", $salaryTotal);
        }
        #模板配置
        $smarty->assign( array("formulasStr"=>$formulasStr,"formulasChartStr"=>$formulasChartStr));
        $smarty->assign(array("editUrl" => $editUrl, "exportUrl" => $exportUrl));
        $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
        $smarty->display("salaryManage/detail.tpl");
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
                case "ratalYet":
                case "pTaxYet":
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
    $op->title = "费用表";
    $op->eRes = $feeArr;
    $op->selFieldArray = $feeExtraFieldStr;
    $op->hideCol($payFieldArr);
    $op->setSheetHeader("fee", array("headStr" => $authorCompany . substr($salaryDate, 0, 4) . '年' . substr($salaryDate, 4) . '月' . "工资费用表", 'unitName' => "客户名称:" . $unitName, 'createTime' => '制表时间:' . timeStyle("dateTime")));
    $op->headRow = 5;
    $op->fillData();
    //设置表尾显示项,加入了发放表中的标题	
    $op->selFieldArray = array_merge($feeExtraFieldStr, $salaryExtraFieldStr);
    $op->setSheetFooter("fee", $feeFooterArr);
	if(is_array($salaryArr)){
    $oExcel->createSheet();
    $op->sheetIndex = 1;
    $op->title = "发放表";
    $op->eRes = $salaryArr;
    $op->selFieldArray = $salaryExtraFieldStr;
    $op->hideCol(mergeArray($payFieldArr, array('pID','spID','pTaxYet', 'ratalYet')));
    $op->setSheetHeader("fee", array("headStr" => $authorCompany . substr($salaryDate, 0, 4) . '年' . substr($salaryDate, 4) . '月' . "工资发放表", 'unitName' => "客户名称:" . $unitName, 'createTime' => '制表时间:' . timeStyle("dateTime")));
    $op->headRow = 5;
    $op->fillData();
    $op->setSheetFooter("salary", $salaryFooterArr);
	}
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
$smarty->display("salaryManage/exportExcel.tpl");
?>
