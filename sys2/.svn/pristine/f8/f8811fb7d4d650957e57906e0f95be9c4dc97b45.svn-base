<?php

/**
 * Description of makeReward
 *  奖金发放表制作
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/reward.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接费用核算类
require_once sysPath . 'dataFunction/fee.data.php';
#连接工资,费用表相关的类
require_once sysPath.'dataFunction/salaryFee.data.php';
#页面标题
$title = "制作奖金发放表";
$unitID = $_GET ['unitID'];
$extraBatch = $_GET ['extraBatch'];
$month = $_GET ['month'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
$sponsorName = $_SESSION ['exp_user'] ['mName'];
$sponsorTime = timeStyle("dateTime");
#设置显示的默认属性
$_GET['displaySp'] = is_null($_GET['displaySp']) ? true : $_GET['displaySp'];
$_GET['fixTable'] = is_null($_GET['fixTable']) ? true : $_GET['fixTable'];
$_GET['hideHeader'] = is_null($_GET['hideHeader']) ? true : $_GET['hideHeader'];
#验证该单位数据是否已经存在
$existsSql = "select zID from `a_rewardFee_tmp` where `month` like :month and `unitID` like :unitID and `extraBatch`=:extraBatch and `uID` like '' limit 1";
$existsRes = $pdo->prepare($existsSql);
$existsRes->execute(array(":unitID" => $unitID, ":month" => $month, ":extraBatch" => $extraBatch));
$existsRet = $existsRes->fetch(PDO::FETCH_ASSOC);
$validFee = $existsRes->rowCount();
if ($validFee != 0) {
    $validUrl = httpPath . "rewardManage/validOriginalReward.php?month=$month&unitID=$unitID&extraBatch=$extraBatch&zID=" . $existsRet['zID'] . "&whatDate=rewardDate";
} else {

    #获取费用表中的相关信息	
    $feeSql = "select * from `a_rewardFee_tmp` where month like :month and unitID like :unitID and `extraBatch` like :extraBatch";
    if ($_POST['search'])
        $feeSql .=" and name like '" . trim($_POST['name']) . "%'";
    $feeRes = $pdo->prepare($feeSql);
    $feeRes->execute(array(":month" => $month, ":unitID" => $unitID, ":extraBatch" => $extraBatch));
    $feeRet = $feeRes->fetchAll(PDO::FETCH_ASSOC);
    if (!$feeRet) {
        echo "<script>alert('查无此人');location.reload();</script>";
        die();
    }

    $rewardDate = $feeRet['0'] ['rewardDate'];
    $zID = $feeRet['0']['zID'];

    #验证是否存在本奖金月份的工资表(包括多次工资的状态)
    $feeData = new feeData();
    $feeData->pdo = $pdo;
    $feeData->unitID = $unitID;
    $feeData->month = $month;
    $feeData->salaryDate = $rewardDate;
    $feeData->wArr = $feeRet;
    $exSalaryRet = $feeData->mergeTax_fee("mulFee");
    #获取相应工资月份(salaryDate)的费用月份(month)
    $salaryFeeData= new salaryFee();
    $salaryFeeData->pdo=$pdo;
    $salaryFeeData->unitID=$unitID;
    $salaryFeeData->monthType="salaryDate";
    $salaryFeeData->month=$rewardDate;
    $AFeeArr = $salaryFeeData->AFee();
    $salaryMonth = $AFeeArr['0']['month'];
    #是否有需要合并计税的相关
    $rewardData = new rewardData();
    $rewardData->pdo = $pdo;
    $rewardData->month = $month;
    $rewardData->unitID = $unitID;
    $rewardData->rewardDate = $rewardDate;
    $rewardDataArr = $rewardData->ratalAsReward($extraBatch);
    #获取已设置的合并项
    $mergeTaxSql = "select * from `a_merge_tax` where `month`='$month' and `unitID`='$unitID' and `extraBatch`='$extraBatch' and `basic`='reward'";
    $mergeTaxRet = SQL($pdo, $mergeTaxSql);
    foreach ($mergeTaxRet as $mVal) {
        $rewardCheck[$mVal['action']][$mVal['actionExtraBatch']] = 'checked';
        $taxTypeCheck = $mVal['taxType'] == '1' ? 'checked' : null;
    }
    foreach ($_GET as $getKey => $getVal) {
        switch ($getKey) {
            case "zID" :
            case "unitID" :
                if (is_numeric($getVal))
                    $getQuery [$getKey] = $getVal;
                else
                    exit("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                break;
            case "month" :
            case "rewardDate" :
                if (isMonth($getVal))
                    $getQuery [$getKey] = $getVal;
                else
                    exit("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                break;
        }
    }
    //获取中英文对照数组
    $engToChsArr = engTochs();
    #获取该帐套对应的列,包括列的中文名
    $zfSql = "select zIndex,field,payFormulas,ratalFormulas,acheiveFormulas,uAccountFormulas from a_zformatInfo where zID like :zID";
    $zfRes = $pdo->prepare($zfSql);
    $zfRes->execute(array(":zID" => $zID));
    $zfRet = $zfRes->fetch(PDO::FETCH_ASSOC);
    $fieldArr = makeArray($zfRet ['field']);
    $zIndex = makeArray($zfRet ['zIndex']);
    $zIndex = array_flip($zIndex);
    $newFieldArr = array('rewardDate' => $engToChsArr ['rewardDate'], 'extraBatch' => $engToChsArr ['extraBatch']);
    foreach ($fieldArr as $key => $val) {
        if (array_key_exists($key, $zIndex)) {
            $key = $zIndex [$key];
            $val = $engToChsArr [$key];
        }
        $newFieldArr [$key] = $val;
    }
    //这里增加几个字段,可以自定义控制查询所需的字段名

    $newField = implode(",", array_keys($newFieldArr));
    //查找所需的字段,生成预览 ,限制3条
    $sql = "select $newField  from `a_rewardFee_tmp` where unitID like  :unitID and month like :month and extraBatch like :extraBatch limit 0,3";
    $res = $pdo->prepare($sql);
    $res->execute(array(":unitID" => $unitID, ":month" => $month, ":extraBatch" => $extraBatch));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    #设置公式所需要的代号
    $fieldDisplay = new fieldDisplay();
    $fieldDisplay->style = "math";
    $fieldDisplay->actionArr = array_keys($newFieldArr);
    $formulasChartStr = $fieldDisplay->fieldStyle(9, $fieldArr);
    #定义变量
    #获取员工信息,求出社保费用,商保费用,互助会费用
    $wSql = "select a.name,a.uID,a.bID,b.unitName from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.unitID like :unitID";
    $wRes = $pdo->prepare($wSql);
    $wRes->execute(array(":unitID" => $unitID));
    $wRet = $wRes->fetchAll(PDO::FETCH_ASSOC);
    foreach ($wRet as $wVal) {
        $wR [$wVal ['uID']] = $wVal;
    }

    #获取工资表明细数组(注:该数组是有对应显示顺序的...所以这里也要注意一下先后顺序)
    #这里重新修改过,设置公式,可以每月的公式都不一样,
    $formulasSql = " select * from `a_otherFormulas` where `month`='$month' and `unitID`='$unitID' and `zID`='$zID' and `extraBatch`='$extraBatch' and `type`='1'";
    $formulasRet = SQL($pdo, $formulasSql, null, 'one');
    if ($formulasRet ['ID']) {
        $formulasStr = array("pay" => $formulasRet ['payFormulas'], "ratal" => $formulasRet ['ratalFormulas'], "acheive" => $formulasRet ['acheiveFormulas']);
        $smarty->assign("formulasID", $formulasRet ['ID']);
    }
    // echo "<pre>";
    // print_r($formulasStr);
    //求得应发工资相关的所有列
    if ($formulasStr ['pay']) {
        preg_match_all("/[a-zA-Z]+/", $formulasStr ['pay'], $payStr);
        $payFormulas = strToPHP($formulasStr ['pay']);
    }
    //这里就获得了应发工资的字符串了..再EVAL 一下..就可以转成PHP代码进行运算了
    if ($formulasStr ['ratal']) {
        $ratalFormulas = strToPHP($formulasStr ['ratal']);
    }
    if ($formulasStr ['acheive']) {
        preg_match_all("/[a-zA-Z]+/", $formulasStr ['acheive'], $otherCostsStr);
        $acheiveFormulas = strToPHP($formulasStr ['acheive']);
    }
    $mergeTaxChart = array('pTaxTotal', 'ratalTotal');
    foreach ($feeRet as $fKey => $fVal) {
        $mergeTax = $ratalNum = $mergeRatal = 0;
        $salaryArr [$fVal ['uID']] = array("name" => $sRet [$fVal ['uID']] ['name'] ? $sRet [$fVal ['uID']] ['name'] : $fVal ['name'], "unitName" => $wR [$fVal ['uID']] ['unitName'], 'uID' => $fVal ['uID'], 'bID' => $wR [$fVal ['uID']] ['bID']);
        if ($payStr and $_GET ['hideHeader'] != "true")
            foreach ($payStr [0] as $payVal) {
                $salaryArr [$fVal ['uID']] [$payVal] = $fVal [$payVal];
            }

        //应发,应缴纳税额,个税
        @eval('$payMoney=' . $payFormulas . ";");
        @eval('$ratalMoney=' . $ratalFormulas . ";");
        @eval('$otherCosts=' . $acheiveFormulas . ";");
        $salaryArr [$fVal ['uID']] ['pay'] = $payMoney;
        $ratal = round(($payMoney + $ratalMoney), 2);
        $salaryArr [$fVal ['uID']] ['ratal'] = $ratal;
        if ($rewardCheck) {
            foreach ($rewardCheck as $reKey => $reVal) {
                switch ($reKey) {
                    case "salary":
                        //已发的工资费用
                        $salaryArr[$fVal['uID']]['ratal' . $ratalNum] = $exSalaryRet[$fVal['uID']]['ratal'];
                        if ($taxTypeCheck != "checked") {
                            $salaryArr[$fVal['uID']]['pTax' . $ratalNum] = $exSalaryRet[$fVal['uID']]['pTax'];
                        }
                        $mergeRatal +=$salaryArr[$fVal['uID']]['ratal' . $ratalNum];
                        $mergeTax+=$salaryArr[$fVal['uID']]['pTax' . $ratalNum];
                        $mergeTaxChart[] = 'ratal' . $ratalNum;
                        $mergeTaxChart[] = 'pTax' . $ratalNum;
                        $ratalNum++;
                        break;
                    case "reward":
                        //已发的奖金费用
                        foreach ($reVal as $reK => $reV) {
                            $salaryArr[$fVal['uID']]['ratal' . $ratalNum] = $rewardDataArr[$reK][$fVal['uID']]['ratal'];
							if ($taxTypeCheck != "checked")
                            $salaryArr[$fVal['uID']]['pTax' . $ratalNum] = $rewardDataArr[$reK][$fVal['uID']]['pTax'];
                            $mergeRatal +=$salaryArr[$fVal['uID']]['ratal' . $ratalNum];
                            $mergeTax+=$salaryArr[$fVal['uID']]['pTax' . $ratalNum];
                            $mergeTaxChart[] = 'ratal' . $ratalNum;
                            $mergeTaxChart[] = 'pTax' . $ratalNum;
                            $ratalNum++;
                        }
                        break;
                }
            }
        }
        if ($rewardCheck) {
            if ($taxTypeCheck == "checked") {
                $taxTypeArr = array("type" => "yearAward", "salary" => $mergeRatal);
                $yearAwardArr = taxCount($salaryArr [$fVal ['uID']] ['ratal'], $taxTypeArr);
                $salaryArr [$fVal ['uID']] ['ratalTotal'] = $yearAwardArr['ratalTotal'];
                $salaryArr [$fVal ['uID']] ['ratalMonAvg'] = $yearAwardArr['ratalMonAvg'];
                $salaryArr [$fVal ['uID']] ['taxPer'] = $yearAwardArr['taxPer'];
                $salaryArr [$fVal ['uID']] ['pTax'] = round($yearAwardArr['tax'], 2);
            } else {
                $salaryArr [$fVal ['uID']] ['ratalTotal'] = $ratal + $mergeRatal;
                $salaryArr [$fVal ['uID']] ['pTaxTotal'] = round(taxCount($salaryArr [$fVal ['uID']] ['ratalTotal']), 2);
                $salaryArr [$fVal ['uID']] ['pTax'] = $salaryArr [$fVal ['uID']] ['pTaxTotal'] - $mergeTax;
            }
        } else {
            $salaryArr [$fVal ['uID']] ['ratal'] = $ratal;
            $salaryArr [$fVal ['uID']] ['pTax'] = round(taxCount($salaryArr [$fVal ['uID']] ['ratal']), 2);
        }

        if ($otherCostsStr [0])
            foreach ($otherCostsStr [0] as $oVal) {
                $salaryArr [$fVal ['uID']] [$oVal] = $fVal [$oVal];
            }
        $acheive = $salaryArr [$fVal ['uID']] ['pay'] - $salaryArr [$fVal ['uID']] ['pTax'] + $otherCosts;
        $salaryArr [$fVal ['uID']] ['acheive'] = $acheive;
        $salaryArr [$fVal ['uID']] ['status'] = $wR [$fVal ['uID']] ['status'];
        if (!$payMoney) {
            unset($salaryArr [$fVal ['uID']]);
        }
    }
    //	echo "<pre>";
    //	echo count($salaryArr);
    //	print_r($salaryArr);
    $salaryTotalArr = null;
    foreach ($salaryArr as $salaryVal) {
        foreach ($salaryVal as $salaryK => $salaryV) {
            switch ($salaryK) {
                case "uID":
                case "name" :
                case "unitName" :
                case "bID" :
                    $salaryTotalArr [$salaryK] = null;
                    break;
                case "status" :
                    continue;
                    break;
                default :
                    $salaryTotalArr [$salaryK] += $salaryV;
                    break;
            }
        }
    }
    //	echo "<pre>";
    //	print_r ( $salaryTotalArr );
    //注销全局变量释放内存
    unset($wR, $rMRet, $soInsRet, $feeRet);
    if (isset($_POST ['edit'])) {
        $selSql = "select uID from a_salary_tmp  where month like :month and unitID like :unitID";
        $selRes = $pdo->prepare($selSql);
        $selRes->execute(array(":month" => $month, ":unitID" => $unitID));
        $selRow = $selRes->rowCount();
        if ($selRow <= 0) {
            $insertSql = "insert into `a_reward_tmp`  set `month`='$month',`unitID`='$unitID',";
            foreach ($salaryArr as $feeKey => $feeVal) {
                $insertStr = null;
                foreach ($feeVal as $feeK => $feeV) {
                    switch ($feeK) {
                        case "uID" :
                        case "name" :
                        case "pay" :
                            $insertStr .= "`" . $feeK . "`='" . $feeV . "',";
                            break;
                        case "status" :
                            $insertStr .= "`mountGuardStatus`='" . $feeV . "',";
                            break;
                    }
                }
                $insertStr = rtrim($insertStr, ",");
                $inSql [] = $insertSql . $insertStr;
            }
            $actionSql = $inSql;
            $result = transaction($pdo, $actionSql);
            if ($result ['error']) {
                exit($result ['error'] . "<br/>系统发生错误,请及时联系管理员查证");
            } else {
                $showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "rewardManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme'); </script>";
            }
        } else {
            $showWindow = "<script>tipsWindown('调整费用','iframe:" . httpPath . "rewardManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme'); </script>";
        }
    }
    if (isset($_POST ['next']) || isset($_POST ['salarySet'])) {
        if ($_POST ['next'])
            $url = "<script>window.location.href='" . httpPath . "rewardManage/makeRewardFee.php?" . $_SERVER ['QUERY_STRING'] . "';</script>";
        elseif ($_POST ['salarySet'])
            $url = "<script>tipsWindown('奖金待发设置','iframe:" . httpPath . "rewardManage/rewardSet.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme'); </script>";
        elseif ($_POST ['edit'])
            $url = "<script>tipsWindown('发放表设置','iframe:" . httpPath . "rewardManage/salaryEdit.php?" . $_SERVER ['QUERY_STRING'] . "', '1000', '580', 'true', '', 'true', 'leotheme'); </script>";


        // echo "<pre>";
        // print_r($rqRet);
        $updateSql = "update a_rewardFee set `sponsorName`='$sponsorName',`sponsorTime`='$sponsorTime',`confirmStatus`='0',";
        foreach ($salaryArr as $sKey => $sVal) {
            $upStr = $reStr = $conStr = null;
            foreach ($sVal as $sK => $sV) {
                switch ($sK) {
                    case "uID" :
                        $conStr = " `uID` like '$sV' ";
                        break;
                    case "bID" :
                    case "pay" :
                    case "ratal" :
                    case "pTax" :
                        //插入费用明细表sql
                        $upStr .= "`" . $sK . "`='" . $sV . "',";
                        break;
                    case "unitName" :
                    case "status" :
					case "ratalMonAvg":
					case "taxPer":
                        break;
                    default :
                        if (!in_array($sK, $payStr[0]) && !in_array($sK, $mergeTaxChart)) {
                            if (is_numeric($sV))
                                $sV = round($sV, 2);
                            $upStr .= "`" . $sK . "`='" . $sV . "',";
                        }
                        break;
                }
            }
            $upStr = rtrim($upStr, ",");
            $uSql [] = $updateSql . $upStr . " where `unitID`='$unitID' and `month`='$month' and `extraBatch`='$extraBatch' and " . $conStr;
        }
        $actionSql = $uSql;
        $result = transaction($pdo, $actionSql);
        if ($result ['error']) {
            exit($result ['error'] . "<br>发生未知错误,请联系管理员");
        } else {
            $showWindow = $url;
        }
    }
    if ($_POST['download']) {
        $tableName = "发放表";
        require_once sysPath . 'class/phpToExcelXML/class-excel-xml.inc.php';
        $doc = $salaryArr;
        $name = $tableName;
        $name = iconv('UTF-8', 'GBK', $name);
        $xls = new Excel_XML ( );
        $xls->addArray($doc);
        $xls->generateXML($name);
        exit();
    }
}

#变量配置
$smarty->assign(array("societyAvg" => $societyAvg, "pComInsMoney" => $pComInsMoneyRadix, "uComInsMoney" => $uComInsMoneyRadix, "originalFeeCount" => $originalFeeCount));
$smarty->assign("newFieldArr", $newFieldArr);
$smarty->assign("ret", $ret);
$smarty->assign(array("exSalaryRet" => $exSalaryRet, "rewardCheck" => $rewardCheck, "taxTypeCheck" => $taxTypeCheck));
$smarty->assign("mergeTaxRet", $mergeTaxRet);
$smarty->assign("rewardData", $rewardDataArr);
$smarty->assign("formulasChartStr", $formulasChartStr);
$smarty->assign("formulasStr", $formulasStr);
$smarty->assign(array("zID" => $zID, "month" => $month, "rewardDate" => $rewardDate, "salaryMonth" => $salaryMonth, 'unitID' => $unitID));
$smarty->assign("unitArr", $unitArr);
$smarty->assign("payStr", $payStr);
$smarty->assign("otherCostsStr", $otherCostsStr);
$smarty->assign("salaryArr", $salaryArr);
$smarty->assign("salaryTotalArr", $salaryTotalArr);
$smarty->assign("showWindow", $showWindow);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("rewardManage/makeReward.tpl");
?>
