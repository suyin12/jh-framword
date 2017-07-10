<?php
/**
 *   <<<   添加临时处理数据       >>>
 *
 * Created by Great sToNe.
 *
 * Date: 13-5-28
 * Time: 上午9:42
 * EMAIL: shi35dong@gmail.com
 *
 */

# 页面访问权限
require_once '../auth.php';
# 连接模板文件
require_once sysPath . 'templateConfig.php';
# 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'dataFunction/unit.data.php';
#连接公共函数库
require_once sysPath . 'common.function.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';

$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
#添加临时数据到数据库中
if ($_POST ['btn'] == 'addToTemp') {
    $tempArr = json_decode(stripslashes($_POST['tempJsonTxt']), true);
    foreach ($tempArr as $key => $val) {
        $exSql = "select 1 from `s_temp` where `whichID`='" . $val['whichID'] . "' and `value`='" . $val['value'] . "' and `createdBy`='" . $mID . "'";
        if (!SQL($pdo, $exSql)) {
            $sql[] = "insert into `s_temp` set `whichID`='" . $val['whichID'] . "' , `value`='" . $val['value'] . "' , `createdBy`='" . $mID . "',`createdOn`='" . $now . "'";
            $succArr[] = $val;
        }
    }
    $actionSql = $sql;
    $result = extraTransaction($pdo, $actionSql);
    $errMsg = $result ['error'];
    if (empty ($errMsg)) {
        $succMsg = $succArr;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#删除临时数据
if ($_POST ['btn'] == 'deleteFromTemp') {
    list($whichID, $value) = explode("|", $_POST['tempJsonTxt']);
    $sql[] = "delete from `s_temp` where `whichID` like '" . $whichID . "' and `value`='" . $value . "' and `createdBy`='$mID'";
    $actionSql = $sql;
    $result = extraTransaction($pdo, $actionSql);
    $errMsg = $result ['error'];
    if (empty ($errMsg)) {
        $succMsg = $value;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}