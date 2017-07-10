<?php

/*
 *          费用高级应用SQL操作
 * 
 *          author sToNe   2011-07-27
 * 
 */
#连接权限验证文件(简单的一级验证,系统用户?)
require_once '../auth.php';
#连接公共函数文件
require_once sysPath . 'common.function.php';
#链接验证审批过程
require_once sysPath . 'approval/approval.class.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");

#删除公式(费用核算)
if ($_POST ['btn'] == 'deleteFormulas') {
    $unitID = $_POST ['unitID'];
    $month = $_POST ['month'];
    $sql = "delete from a_otherFormulas where `month` like '$month' and `unitID` like '$unitID' and type like '3'";
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
#设置费用表公式(费用核算)
if ($_POST ['btn'] == 'subFormulas') {
//不能是这些数据库字段中的某一个
    $fieldDisplay = new fieldDisplay();
    $validArr = $fieldDisplay->feeField();
    $unitID = $_POST ['unitID'];
    $month = $_POST ['month'];
    $formulas = $_POST ['formulas'];
    $formulasID = $_POST ['ID'];
    $extraBatch = $_POST ['extraBatch'];
    $totalFeeFormulas = $formulas ['totalFee'];
    preg_match_all("/[a-zA-Z]+/", $totalFeeFormulas, $otherCostsStr);
    $totalFeeValid = array_diff($otherCostsStr [0], $validArr);
// 如果总费用之外有上述验证项之外的项的时候就会报错
    if ($totalFeeValid)
        $errMsg = "总费用运算公式中,存在非法项,请联系管理员查证";
    if (!$errMsg) {
        $exSql = "select * from `a_otherFormulas` where `ID`='$formulasID'";
        $exRet = SQL($pdo, $exSql, null, "one");
        switch ($_POST ['x']) {
            case "createFee" :
                if ($exRet ['ID'])
                    $sql = "update a_otherFormulas set `totalFeeFormulas`='$totalFeeFormulas'  where ID like '$formulasID'";
                else
                    $sql = "insert into `a_otherFormulas` set `totalFeeFormulas`='$totalFeeFormulas',`unitID`='$unitID',`month`='$month',`type`='3'";
                break;
        }
//		echo $sql;
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
#设置费用表公式(费用核算)
if ($_POST ['btn'] == 'citeFormulas') {
//不能是这些数据库字段中的某一个
    $unitID = $_POST ['unitID'];
    $month = $_POST ['month'];
    $formulasID = $_POST ['ID'];
    if (!$errMsg) {
        $lastSql = "select  `totalFeeFormulas`  from `a_otherFormulas` where `unitID`='$unitID' and `type`='3' group by `unitID`  having max(`ID`)";
        $lastRet = SQL($pdo, $lastSql, null, "one");
        $totalFeeFormulas = $lastRet['totalFeeFormulas'];
        $exSql = "select * from `a_otherFormulas` where `ID`='$formulasID'";
        $exRet = SQL($pdo, $exSql, null, "one");
        switch ($_POST ['x']) {
            case "createFee" :
                if ($exRet ['ID'])
                    $sql = "update a_otherFormulas set `totalFeeFormulas`='$totalFeeFormulas'  where ID like '$formulasID'";
                else {
                    $sql = "insert into `a_otherFormulas` set `totalFeeFormulas`='$totalFeeFormulas',`unitID`='$unitID',`month`='$month',`type`='3'";
                }
                break;
        }
//		echo $sql;
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

#设置费用表公式(费用核算)
if ($_POST ['btn'] == 'styleBtn') {
//不能是这些数据库字段中的某一个
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "unitID":
            case "ID":
                $$key = $val;
                break;
            case "btn":
            case "x":
                break;
            default :
                $styleStr .= $key . ",";
                break;
        }
    }
    $styleStr = rtrim($styleStr, ",");
    $exSql = "select `ID` from `a_export_style` where `ID`='$ID'";
    $exRet = SQL($pdo, $exSql, null, "one");
    switch ($_POST ['x']) {
        case "createFee" :
            if ($exRet ['ID'])
                $sql = "update `a_export_style` set `createFeeStyle`='$styleStr',`sponsorName`='$mName',`lastModifyTime`='$now'   where ID like '$ID'";
            else
                $sql = "insert into `a_export_style` set `createFeeStyle`='$styleStr',`unitID`='$unitID',`sponsorName`='$mName',`lastModifyTime`='$now' ";
            break;
    }
    if ($pdo->query($sql)) {
        $succMsg = "设置成功";
    } else {
        $errMsg = "发生未知错误,请联系管理员";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#修改欠/挂/冲减明细
if ($_POST ['btn'] == "prsReBtn") {
    list ($field, $ID, $type) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'] ? $_POST ['value'] : 0;
    if ($field != "remarks" && !is_numeric($fieldVal)) {
        $errMsg [] = "请输入数字";
    } else {
        if ($type == "1" && $fieldVal < 0) {
            $errMsg [] = "输入的值不能是负数";
        }
//	if ($type == "3") {
//		$errMsg [] = "请修改应收费用或重新填写垫付申请";
//	}
//	if ($type == "4") {
//		$errMsg [] = "请重新申请冲减挂账";
//	}
        if (($type == "2") && $fieldVal > 0) {
            $errMsg [] = "输入的值不能是正数";
        }
//	if ($field == "uAccount") {
//		$errMsg [] = "单位挂账(指定费用)不可修改";
//	}
//	if ($field == "pSoInsMoney") {
//		$errMsg [] = "个人的社保费用不可修改";
//	}
        if ($field == "soInsCardMoney" || $field == "residentCardMoney") {
            $errMsg [] = "制卡费只能由制卡相关人员修改";
        }
    }
    if (!$errMsg) {
        $reSql = "update `a_prsrequiremoney` set `sponsorTime`='$now',`sponsorName`='$mName',`$field`='$fieldVal',`status`='0' where `ID`='$ID'";
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
#删除欠款/挂账/冲减/收回欠款记录
if ($_POST ['btn'] == "delPrsReBtn") {
    $ID = $_POST ['ID'];
    $sql [0] = "delete from `a_prsRequireMoney` where `ID` like '$ID'";
    $result = transaction($pdo, $sql);
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
#转换欠款/挂账/冲减/收回欠款记录的状态为入账
if ($_POST ['btn'] == "changePrsReBtn") {
    list($ID, $status) = explode("|", $_POST ['ID']);
    $sql [0] = "update `a_prsRequireMoney` set `sponsorTime`='$now',`sponsorName`='$mName',`status`='$status' where `ID` like '$ID'";
    $result = transaction($pdo, $sql);
    // print_r($sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty($errMsg ['sql'])) {
        $succMsg = "转换成功";
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

//增加欠款/挂账/冲减/收回欠款记录
if ($_POST ['btn'] == "addPrsMoney") {
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn":
            case "selPost":
                break;
            case "uID":
            case "unitID":
            case "remarks":
            case "type":
                $fieldStr .= "`" . $key . "`='" . $val . "',";
                break;
            case "month":
                if (isDate($val, "Ym"))
                    $fieldStr .= "`" . $key . "`='" . $val . "',";
                else
                    $errMsg[] = "错误:正确的日期格式应如201405";
                break;
            //欠款必须为负数
            case  $_POST['type']==2:
                if($val>0)
                    $errMsg[] = "错误: 请输入负数".$val;
                elseif($val)
                    $fieldStr .= "`" . $key . "`='" . $val . "',";
                break;
            //挂账/收回欠款/冲减挂账必须为正数
            case $_POST['type']==1 || $_POST['type']==3 ||$_POST['type']==4 :
                if($val<0)
                    $errMsg[] = "错误: 请输入正数";
                elseif($val)
                    $fieldStr .= "`" . $key . "`='" . $val . "',";
                break;
        }
    }


    if (!$errMsg) {
        $reSql = "insert into  `a_prsrequiremoney` set `sponsorTime`='$now',`sponsorName`='$mName'," . $fieldStr . "`status`='0'";
        $sql [0] = $reSql;
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty($errMsg ['sql'])) {
            $succMsg = "添加成功";
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
