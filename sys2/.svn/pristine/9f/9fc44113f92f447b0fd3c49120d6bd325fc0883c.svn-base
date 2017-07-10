<?php
/*
*      Date: 14-1-14
*   
*    <<<  平账模块的数据库相关操作  >>>
*       created by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/
#连接权限验证文件(简单的一级验证,系统用户?)
require_once '../auth.php';
require_once '../common.function.php';
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");

#更改社保/公积金/资金往来备忘录身份证号码
if ($_POST ['btn'] == "editBtn") {
    list ($m, $field, $ID) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    switch ($m) {
        case "soIns":
            $sql[] = "update `c_soIns_fee_out` set `$field`='$fieldVal',`mID`='$mID',`lastModifyTime`='$now' where `ID`='$ID'";
            break;
        case "HF":
            $sql[] = "update `c_HF_fee_out` set `$field`='$fieldVal',`mID`='$mID',`lastModifyTime`='$now' where `ID`='$ID'";
            break;
        case "basicFee":
            $sql[] = "update `c_basic_fee_in` set `$field`='$fieldVal',`mID`='$mID',`lastModifyTime`='$now' where `ID`='$ID'";
            break;
    }
    $result = transaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty ($errMsg ['sql'])) {
        $succMsg = "修改成功";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}


#删除各个明细数据
if ($_POST ['btn'] == "deleteDetail") {
    foreach ($_POST as $key => $val) {
        if ($key != "btn")
            $$key = $val;
    }
    switch ($m) {
        case "soIns":
            $sql[] = "delete from `c_soIns_fee_out` where soInsDate like '$month' and soInsID like '$keyID'";
            break;
        case "HF":
            $sql[] = "delete from `c_HF_fee_out` where HFDate like '$month' and housingFundID like '$keyID'";
            break;
        case "basicFee":
            $sql[] = "delete from `c_basic_fee_in` where month like '$month' and feeID like '$keyID'";
            break;
    }
    $result = extraTransaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty ($errMsg ['sql'])) {
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
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#清空数据库相关数据
if ($_POST ['btn'] == "empty") {

    $sql[0] = "truncate table `c_soIns_fee_out` ";

    $sql[1] = "truncate table `c_HF_fee_out` ";

    $sql[2] = "truncate table `c_basic_fee_in` ";

    $result = extraTransaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty ($errMsg ['sql'])) {
        $succMsg = "数据成功";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
        
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}