<?php

/**
 * Description of sql
 *  奖金数据库操作文件
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
#连接权限验证文件(简单的一级验证,系统用户?)
require_once '../auth.php';
#连接公共函数文件
require_once '../common.function.php';
#链接验证审批过程
require_once sysPath . 'approval/approval.class.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
#删除当月奖金公式
if ($_POST ['btn'] == 'deleteFormulas') {
    $unitID = $_POST ['unitID'];
    $month = $_POST ['month'];
    $extraBatch = $_POST['extraBatch'];
    $sql = "delete from `a_otherFormulas` where `month` like '$month' and `unitID` like '$unitID' and `extraBatch` like '$extraBatch' and `type`='1'";
    if ($pdo->query($sql)) {
        $succMsg = "删除成功";
    } else {
        $errMsg = "发生未知错误,请联系管理员";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#设置奖金费用表公式
if ($_POST ['btn'] == 'subFormulas') {
    //不能是这些数据库字段中的某一个
    $validArr = array('radix', 'pSoIns', 'uSoIns', 'uPDIns', 'pComIns', 'uComIns', 'managementCost', 'helpCost');
    $unitID = $_POST ['unitID'];
    $month = $_POST ['month'];
    $formulas = $_POST ['formulas'];
    $formulasID = $_POST ['ID'];
    $zID = $_POST ['zID'];
    $extraBatch = $_POST ['extraBatch'];
    $payFormulas = $formulas ['pay'];
    $ratalFormulas = $formulas ['ratal'];
    $acheiveFormulas = $formulas ['acheive'];
    $uAccountFormulas = $formulas ['uAccount'];
    $totalFeeFormulas = $formulas ['totalFee'];
    preg_match_all("/[a-zA-Z]+/", $totalFeeFormulas, $otherCostsStr);
    $totalFeeValid = array_intersect($validArr, $otherCostsStr [0]);
    //	$uFeeSpFormulas = $formulas['uFeeSp'];
    $payValid = validFormulas($payFormulas);
    $ratalValid = validFormulas($ratalFormulas);

    if ($payValid)
        $errMsg = $payValid;
    if ($ratalValid)
        $errMsg = $ratalValid;
    if ($totalFeeValid)
        $errMsg = "总费用运算公式中,存在非法项,请联系管理员查证";
    if (!$errMsg) {
        $exSql = "select * from `a_otherFormulas` where `ID`='$formulasID'";
        $exRet = SQL($pdo, $exSql, null, "one");
        switch ($_POST ['type']) {
            case "reward" :
                if ($exRet ['ID'])
                    $sql = "update a_otherFormulas set ratalFormulas='$ratalFormulas',acheiveFormulas='$acheiveFormulas' where ID like '$formulasID'";
                else
                    $sql = "insert into `a_ohterFormulas` set `zID`='$zID',ratalFormulas='$ratalFormulas',acheiveFormulas='$acheiveFormulas',`unitID`='$unitID',`month`='$month',`extraBatch`='$extraBatch',`type`='1'";
                break;
            case "rewardFee" :
                if ($exRet ['ID'])
                    $sql = "update a_otherFormulas set payFormulas= '$payFormulas',uAccountFormulas='$uAccountFormulas',`totalFeeFormulas`='$totalFeeFormulas'  where ID like '$formulasID'";
                else
                    $sql = "insert into `a_otherFormulas` set `zID`='$zID', payFormulas= '$payFormulas',uAccountFormulas='$uAccountFormulas',`totalFeeFormulas`='$totalFeeFormulas',`unitID`='$unitID',`month`='$month',`extraBatch`='$extraBatch',`type`='1'";
                break;
        }
        if ($pdo->query($sql)) {
            $succMsg = "公式设置成功";
        } else {
            $errMsg = "发生未知错误,请联系管理员";
        }
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#设置需要合并扣税的相关项目
if ($_POST ['btn'] == 'mergeTaxBtn') {

    //重构POST
    foreach ($_POST as $key => $val) {
        $$key = $val;
    }
    //先清空再做导入
    $delSql = "delete from `a_merge_tax` where `month`='$month' and `unitID`='$unitID' and `extraBatch`='$extraBatch' and `basic`='$type'";
    $pdo->query($delSql);
    if ($mergeTax) {
        foreach ($mergeTax as $mVal) {
            $action = $actionDate = $actionExtraBatch = null;
            list($action, $actionDate, $actionExtraBatch) = explode("|", $mVal);
            $iSql[] = "insert into `a_merge_tax` set `month`='$month',`unitID`='$unitID',`extraBatch`='$extraBatch',`basic`='$type',`action`='$action',`actionExtraBatch`='$actionExtraBatch',`actionDate`='$actionDate',`taxType`='$taxType',`sponsorName`='$mName',`lastModifyTime`='$now'";
        }
        $actionSql = $iSql;
        $result = transaction($pdo, $actionSql);
        $errMsg = $result ['error'];
    }
    if (empty($errMsg)) {
        $succMsg = "设置成功 ";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#设置奖金待发
if ($_POST ['btn'] == "setWait" && $_POST ['type'] == "reward") {
    $sql = "update `a_rewardFee` set salaryStatus='0'";
    foreach ($_POST ['salarySetCheck'] as $cV) {
        $salaryProvideDate = $_POST ['salaryProvideDate'] [$cV];
        if (!isDate($salaryProvideDate, "Y-m-d") || strtotime($salaryProvideDate) < $time) {
            $errMsg [] = "发放日期有误,请更正(错误代码:<$salaryProvideDate>";
        } else {
            $upSql [] = $sql . " , salaryProvideDate='$salaryProvideDate',sponsorName='$mName',sponsorTime='$now' where ID='$cV'";
        }
    }
    if (!$errMsg) {
        $result = transaction($pdo, $upSql);
        $errMsg ['sql'] = $result ['error'];
        if (empty($errMsg ['sql'])) {
            $succMsg = "设置成功";
        }
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
        }
        $errMsg = $errorMsg;
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#取消待发奖金
if ($_POST ['btn'] == "cancelWait" && $_POST ['type'] == "reward") {
    $sql = "update `a_rewardFee` set salaryStatus='1'";
    foreach ($_POST ['salarySetCheck'] as $cV) {
        $upSql [] = $sql . " , sponsorName='$mName',sponsorTime='$now' where ID='$cV'";
    }
    if (!$errMsg) {
        $result = transaction($pdo, $upSql);
        $errMsg ['sql'] = $result ['error'];
        if (empty($errMsg ['sql'])) {
            $succMsg = "设置成功";
        }
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
        }
        $errMsg = $errorMsg;
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#删除原始费用表
if ($_POST ['btn'] == "delRewardFeeBtn" && $_POST ['type'] = "reward") {
    foreach ($_POST['rewardCheck'] as $val) {
        $month = $unitID = $extraBatch = null;
        list($month, $unitID, $extraBatch) = explode("|", $val);
        $sql [] = "delete from `a_rewardFee_tmp` where `month` like '$month' and `unitID` like '$unitID' and `extraBatch` like '$extraBatch' ";
        $sql [] = "delete from `a_reward_tmp`  where month like '$month' and unitID like '$unitID' and `extraBatch`='$extraBatch' ";
    }
    $result = extraTransaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty($errMsg ['sql'])) {
        $succMsg = "删除成功";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#删除奖金费用表 a_rewardFee ,临时奖金发放表 a_reward_tmp 
if ($_POST ['btn'] == "delFeeBtn" && $_POST ['type'] = "fee") {
    $month = $_POST ['month'];
    $rewardDate = $_POST ['rewardDate'];
    $extraBatch = $_POST ['extraBatch'];
    $unitID = $_POST ['unitID'];

    //删除临时费用表
    $sql [0] = "delete from a_rewardFee where month like '$month' and unitID like '$unitID' and `extraBatch`='$extraBatch'";
    //删除临时工资表
    $sql [1] = "delete from a_reward_tmp  where month like '$month' and unitID like '$unitID' and `extraBatch`='$extraBatch' ";
    //删除审批流程
    $sql [2] = "delete a.*,b.* from a_approval_list a,a_approval_process b where a.month like '$month' and a.unitID like '$unitID' and `extraBatch`='$extraBatch' and a.appProID=b.appProID and type = 'reward'";
    //删除审批验证
    $sql [3] = "delete from a_valid_approval_finished where month like '$month' and unitID like '$unitID' and `extraBatch`='$extraBatch' ";
    //删除奖金公式
    $sql [4] = "delete from a_otherFormulas where month like '$month' and unitID like '$unitID' and `extraBatch`='$extraBatch' and type='1'";

    $result = extraTransaction($pdo, $sql);
    // print_r($sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty($errMsg ['sql'])) {
        $succMsg = "删除成功";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#更改原始费用表姓名及工资账号
if ($_POST ['btn'] == "editRewardFee_tmpBtn") {
    list ( $field, $ID ) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    if ($field == "uID") {
        $oSql = "select name from `a_rewardFee_tmp` where `ID`='$ID'";
        $oRet = SQL($pdo, $oSql, null, "one");
        $wSql = "select name from `a_workerInfo` where `uID`='$fieldVal'";
        $wRet = SQL($pdo, $wSql, null, "one");
        if (!$wRet['name'])
            $errMsg[] = "不存在该员工编号,请重新输入";
        elseif ($wRet['name'] != $oRet['name'])
            $errMsg[] = "该员工编号的姓名[$fieldVal/" . $wRet['name'] . "],与该费用表的姓名[" . $oRet['name'] . "]不匹配";
    }
    if (!$errMsg) {
        $reSql = "update a_rewardFee_tmp set `$field`='$fieldVal' where `ID`='$ID'";
        $sql [0] = $reSql;
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty($errMsg ['sql'])) {
            $succMsg = "修改成功";
        }
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
?>
