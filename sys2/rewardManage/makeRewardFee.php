<?php

/*
 *       2011-2-25
 *       <<<  奖金费用表的处理页面: 特别注意,这里的挂账跟常规的费用表不同, 我把uAccount(挂账)直接存放到a_rewardFee表中,原因是, 这部分挂账是要返还给单位  >>>
 *       create by Great sToNe
 *       have fun,.....
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#页面标题
$title = "制作奖金费用表";
$unitID = $_GET ['unitID'];
$extraBatch = $_GET ['extraBatch'];
$month = $_GET ['month'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
#设置显示的默认属性
$_GET['displaySp'] = is_null($_GET['displaySp']) ? true : $_GET['displaySp'];
$_GET['fixTable'] = is_null($_GET['fixTable']) ? true : $_GET['fixTable'];
#链接验证审批过程
require_once sysPath . 'approval/approval.class.php';
$appType = "reward";
$appTable = "a_rewardFee";
$appConStr = "a.`month`=\'$month\' and a.`unitID`=\'$unitID\' and a.`extraBatch`=\'$extraBatch\'";
$approval = new approval ();
$approval->pdo = $pdo;
$approval->month = $month;
$approval->unitID = $unitID;
$approval->extraBatch = $extraBatch;
$approval->type = $appType;
$approval->table = $appTable;
$approval->conStr = $appConStr;
$approval->url = "rewardManage/makeRewardFee.php?" . $_SERVER ['QUERY_STRING'];
$exAppArr = $approval->validEx();
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
    foreach ($fieldArr as $key => $val) {
        if (array_key_exists($key, $zIndex)) {
            $key = $zIndex [$key];
            $val = $engToChsArr [$key];
        }
        $newFieldArr [$key] = $val;
        $formulasChart [$key] = $val . "(" . $key . ")";
    }
    //这里增加几个字段,可以自定义控制查询所需的字段名
    $newFieldArr ['rewardDate'] = $engToChsArr ['rewardDate'];
    $newField = implode(",", array_keys($newFieldArr));
    //查找所需的字段,生成预览 ,限制3条
    $sql = "select $newField  from `a_rewardFee_tmp` where unitID like  :unitID and month like :month and extraBatch like :extraBatch limit 0,3";
    $res = $pdo->prepare($sql);
    $res->execute(array(":unitID" => $unitID, ":month" => $month, ":extraBatch" => $extraBatch));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    #设置公式所需要的代号
    $formulasChart = array_merge(array("+" => "+ (加)", "-" => "- (减)", "/" => "/ (除)", "*" => "* (乘)", "(" => "( (左括号)", ")" => ")(右括号)"), $formulasChart);
    $i = 0;
    $formulasChartStr .= "<tr>";
    foreach ($formulasChart as $chartKey => $chart) {
        if ($i % 9 == 0 && $i != 0)
            $formulasChartStr .= "</tr><tr>";
        $i++;
        $formulasChartStr .= "<td>";
        $formulasChartStr .= "<a href='#' id='$chartKey' class='chart'>$chart</a>";
        $formulasChartStr .= "</td>";
    }
    $formulasChartStr .= "</tr>";
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
        $formulasStr = array("pay" => $formulasRet ['payFormulas'], "uAccount" => $formulasRet ['uAccountFormulas'], "totalFee" => $formulasRet ['totalFeeFormulas']);
        $smarty->assign("formulasID", $formulasRet ['ID']);
    }
    // echo "<pre>";
    // print_r($formulasStr);
    //求得应发工资相关的所有列
    if ($formulasStr ['pay']) {
        preg_match_all("/[a-zA-Z]+/", $formulasStr ['pay'], $payStr);
        $payFormulas = strToPHP($formulasStr ['pay']);
    }
    if ($formulasStr ['uAccount']) {
        $uAccountFormulas = strToPHP($formulasStr ['uAccount']);
    }
    if ($formulasStr ['totalFee']) {
        preg_match_all("/[a-zA-Z]+/", $formulasStr ['totalFee'], $otherCostsStr);
        $totalFeeFormulas = strToPHP($formulasStr ['totalFee']);
    }

    foreach ($feeRet as $fKey => $fVal) {
        $feeArr [$fVal ['uID']] = array("name" => $fVal ['name'], 'uID' => $fVal ['uID'], "unitName" => $wR [$fVal ['uID']] ['unitName'], "department" => $wR [$fVal ['uID']] ['department']);
        if ($payStr [0] and $_GET['hideHeader'] != "true")
            foreach ($payStr [0] as $payVal) {
                $feeArr [$fVal ['uID']] [$payVal] = $fVal [$payVal];
            }

        //应发,应缴纳税额,个税
        @eval('$payMoney=' . $payFormulas . ";");
        @eval('$uAccount=' . $uAccountFormulas . ";");
        @eval('$otherCosts=' . $totalFeeFormulas . ";");
        $feeArr [$fVal ['uID']] ['pay'] = $payMoney;
        //单位挂账
        if ($uAccountRet && array_key_exists($fVal ['uID'], $uAccountRet))
            $uAccount = $curRMRet [$fVal ['uID']] ['uAccount'];
        $feeArr [$fVal ['uID']] ['uAccount'] = round($uAccount, 2);
        //其他单位费用
        if ($otherCostsStr [0])
            foreach ($otherCostsStr [0] as $oVal) {
                $feeArr [$fVal ['uID']] [$oVal] = $fVal [$oVal];
            }
        $totalFee = $feeArr [$fVal ['uID']] ['pay'] + $feeArr [$fVal ['uID']] ['uAccount'];
        $feeArr [$fVal ['uID']] ['totalFee'] = $totalFee + $otherCosts;
        $feeArr [$fVal ['uID']] ['status'] = $wR [$fVal ['uID']] ['status'];
    }
    $selSql = "select uID from `a_rewardFee`  where month like :month and unitID like :unitID and extraBatch like :extraBatch limit 1";
    $selRes = $pdo->prepare($selSql);
    $selRes->execute(array(":month" => $month, ":unitID" => $unitID, ":extraBatch" => $extraBatch));
    $selRow = $selRes->rowCount();
    if ($selRow > 0) {
        foreach ($feeArr as $feeKey => $feeVal) {
            $str = null;
            foreach ($feeVal as $feeK => $feeV) {
                switch ($feeK) {
                    case "name" :
                    case "uID" :
                    case "unitName" :
                    case "department" :
                        $feeTotalArr [$feeK] = null;
                        break;
                    case "status" :
                        break;
                    case "uAccount" :
                    case "totalFee" :
                        $str .= "`$feeK`='$feeV',";
                        $feeTotalArr [$feeK] += $feeV;
                        break;
                    default :
                        if (is_numeric($feeV))
                            $feeV = round($feeV, 2);
                        $str .= "`$feeK`='$feeV',";
                        $feeTotalArr [$feeK] += $feeV;
                        break;
                }
            }
            $upOFSql [] = "update `a_rewardFee` set " . $str . " `confirmStatus`='0', `sponsorName`='$mName',`sponsorTime`='$now' where `uID` like '$feeKey' and `rewardDate` like '$rewardDate' and `extraBatch`='$extraBatch'";
        }
    } else {
        foreach ($feeArr as $feeKey => $feeVal) {
            $str = null;
            foreach ($feeVal as $feeK => $feeV) {
                switch ($feeK) {
                    case "name" :
                    case "uID" :
                        $str .= "`$feeK`='$feeV',";
                        $feeTotalArr [$feeK] = null;
                        break;
                    case "unitName" :
                    case "department" :
                        $feeTotalArr [$feeK] = null;
                        break;
                    case "status" :
                        break;
                    case "uAccount":
                    case "totalFee" :
                        $str .= "`" . $feeK . "`='$feeV',";
                        $feeTotalArr [$feeK] += $feeV;
                        break;
                    default :
                        if (is_numeric($feeV))
                            $feeV = round($feeV, 2);
                        $str .= "`$feeK`='$feeV',";
                        $feeTotalArr [$feeK] += $feeV;
                        break;
                }
            }
            $upOFSql [] = "insert into `a_rewardFee` set  `month`='$month',`rewardDate`='$rewardDate',`extraBatch`='$extraBatch',`unitID`='$unitID',`zID`='$zID',`salaryStatus`='1' ," . $str . " `sponsorName`='$mName',`sponsorTime`='$now' ";
        }
    }
    if (isset($_POST ['save'])) {
        $actionSql = $upOFSql;
        $result = transaction($pdo, $actionSql);
        if ($result ['error']) {
            exit($result ['error'] . "<br/>系统发生错误,请及时联系管理员查证");
        } else {
            $showWindow = "<script>window.location.href='" . httpPath . "rewardManage/makeReward.php?" . $_SERVER ['QUERY_STRING'] . "';</script>";
        }
    }
    if (isset($_POST ['subApproval'])) {
        if ($margin != 0) {
            exit("均衡值调整失败(不为0),不允许提交审批申请,<a href='$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]'>点击返回</a>");
        }
        $mID = manager($pdo, $unitID, "2_1");
        $appIDSql = "select * from s_approvalPro_set where type='reward' and process like '\"mID\"=>\"$mID\"%'";
        $appIDRes = $pdo->query($appIDSql);
        $appIDRet = $appIDRes->fetch(PDO::FETCH_ASSOC);
        $appID = $appIDRet ['appID'];
        //这里引用类 approval
        if ($appID) {
            $msg = $approval->approvalSet($appID);
            $msgr = fetchArray($msg);
            $showWindow = "<script>alert('$msgr');</script>";
        } else
            exit("对应该客户经理的审批流程还未建立,请先设置");
    }
    if ($_POST['download']) {
        $tableName = "费用表";
        require_once sysPath . 'class/phpToExcelXML/class-excel-xml.inc.php';
        $doc = $feeArr;
        $name = $tableName;
        $name = iconv('UTF-8', 'GBK', $name);
        $xls = new Excel_XML ( );
        $xls->addArray($doc);
        $xls->generateXML($name);
        exit();
    }
}
$smarty->assign("newFieldArr", $newFieldArr);
$smarty->assign("ret", $ret);
$smarty->assign("formulasChartStr", $formulasChartStr);
$smarty->assign("formulasStr", $formulasStr);
$smarty->assign(array("validFee" => $validFee, "validUrl" => $validUrl));
$smarty->assign("payStr", $payStr);
$smarty->assign("otherCostsStr", $otherCostsStr);
$smarty->assign("zID", $zID);
$smarty->assign("feeArr", $feeArr);
$smarty->assign("feeTotalArr", $feeTotalArr);
$smarty->assign("showWindow", $showWindow);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("rewardManage/makeRewardFee.tpl");
?>