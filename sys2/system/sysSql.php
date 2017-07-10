<?php

/**
 * 2012-2-15
 * <<<该页面主要负责system的数据库操作语句,
 * 1.创建工资帐套>>>
 * 
 * @author  yours  sToNe
 * @version 
 */
#连接数据库PDO
//require_once '../setting.php';
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

#删除社保类型
if ($_POST ['btn'] == 'delSoInsType') {
    $ID = $_POST['ID'];
    $sql[] = "delete from `s_soIns_set` where ID='$ID'";
    $result = transaction($pdo, $sql);
    $errMsg = $result ['error'];
    if (empty($errMsg)) {
        $succMsg = "操作成功";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#删除商保类型
if ($_POST ['btn'] == 'delComInsType') {
    $ID = $_POST['ID'];
    $sql[] = "delete from `s_comIns_set` where comInsType='$ID'";
    $result = transaction($pdo, $sql);
    $errMsg = $result ['error'];
    if (empty($errMsg)) {
        $succMsg = "操作成功";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}


#修改角色信息
if ($_POST ['btn'] == "roleEdit") {
    list ( $field, $roleID ) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    $sql[] = "update `s_role` set `$field`='$fieldVal' where `roleID`='$roleID'";
    $result = transaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty($errMsg ['sql'])) {
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
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#添加角色
if ($_POST ['btn'] == "addRole") {
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn":
                break;
            default:
                $val = trim($val);
                if (!$val) {
                    $errMsg = "都为必填项,请完整填写";
                    break 2;
                }
               $str .="`" . $key . "`='" . $val . "',";
                break;
        }
    }
    $str = rtrim($str, ",");
    if (!$errMsg) {
       $sql[] = "insert into `s_role` set $str ";
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
#删除角色
if ($_POST ['btn'] == "delRole") {
    $ID = $_POST ['ID'];
    $sql [0] = "delete from `s_role` where `roleID` like '$ID'";
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
#修改组信息
if ($_POST ['btn'] == "groupEdit") {
    list ( $field, $groupID ) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    $sql[] = "update `s_group` set `$field`='$fieldVal' where `groupID`='$groupID'";
    $result = transaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty($errMsg ['sql'])) {
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
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#添加组
if ($_POST ['btn'] == "addGroup") {
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn":
                break;
            default:
                $val = trim($val);
                if (!$val) {
                    $errMsg = "都为必填项,请完整填写";
                    break 2;
                }
               $str .="`" . $key . "`='" . $val . "',";
                break;
        }
    }
    $str = rtrim($str, ",");
    if (!$errMsg) {
       $sql[] = "insert into `s_group` set $str ";
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
#删除组
if ($_POST ['btn'] == "delGroup") {
    $ID = $_POST ['ID'];
    $sql [0] = "delete from `s_group` where `groupID` like '$ID'";
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

#修改审批流程
if ($_POST ['btn'] == "approvalProEdit") {
    list ( $field, $appID ) = explode("|", $_POST ['field']);
    $fieldVal = htmlspecialchars_decode($_POST ['value']);
    $sql[] = "update `s_approvalPro_set` set `$field`='$fieldVal' where `appID`='$appID'";
    $result = transaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty($errMsg ['sql'])) {
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
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#添加审批流程
if ($_POST ['btn'] == "addApprovalPro") {
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn":
                break;
            default:
                $val = trim($val);
                if (!$val) {
                    $errMsg = "都为必填项,请完整填写";
                    break 2;
                }
               $str .="`" . $key . "`='" . htmlspecialchars_decode($val) . "',";
                break;
        }
    }
    $str = rtrim($str, ",");
    if (!$errMsg) {
       $sql[] = "insert into `s_approvalPro_set` set $str ,`status`='1' ";
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
#删除审批流程
if ($_POST ['btn'] == "delApprovalPro") {
    $ID = $_POST ['ID'];
    $sql [0] = "delete from `s_approvalPro_set` where `appID` like '$ID'";
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
?>
