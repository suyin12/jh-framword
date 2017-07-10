<?php

/*
 *     2012-04-09
 *          <<<  系统初始化设置  >>>
 *      create by  Great sToNe
 *      shi35dong@gmail.com
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../setting.php';
require_once sysPath . 'common.function.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#连接文件操作类
require_once sysPath . 'class/splFile.class.php';
#标题
$title = "系统使用登记";
$now = timeStyle("dateTime");
#
#结算日/封帐日设置
$insuranceInTurnArr = array("soIns" => insuranceInTurn("soIns"), "HF" => insuranceInTurn("HF"), "comIns" => insuranceInTurn("comIns"), "performance" => insuranceInTurn("performance"));
#社保帐户,公积金帐户等相关设置
$insuranceIDArr = insuranceID();
#合并编号设置
$wantToMergeInfoArr = wantToMergeInfo();
#UUID 如果还未注册UUID 就随机生成一枚
$UUID = _UUID ? _UUID : UUID();
#连接柳悟科技服务器
try {
    $serverPDO = new PDO(serverDsn, serverUser, serverPW);
} catch (PDOException $e) {
    header("Content-type: text/html; charset=utf-8");
    exit('柳悟科技公司服务器维护中..给您带来的不便,我们深感抱歉!!我们会尽快解决相关问题,谢谢!!');
}

$serverPDO->query("SET NAMES 'UTF8'");
$exSql = "select `ID`,`contact`,`phone`,`QQ` from `s_unit` where `UUID` like '$UUID' or `ID` like '" . _serverID . "'";
$exRet = SQL($serverPDO, $exSql, null, 'one');
#处理
//提交到柳悟科技的基本注册信息
if (isset($_POST['initSub'])) {
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case substr($key, -6) == "InTurn":
                $inTurnStr .='case "' . substr($key, 0, -6) . '":$day = "' . $val . '";break;';
                break;
            case substr($key, -2) == "ID" && $key != "serverID" && $key != "UUID" && $key != "houseNumberID":
                $IDStr .="'" . substr($key, 0, -2) . "'=>array(" . $val . "),";
                break;
            case "houseNumberID":
                $IDStr .="'" . substr($key, 0, -2) . "'=>'" . $val . "'";
                break;
            case "serverID":
                break;
            case "initSub":
                break;
            default :
                $sqlStr .="`" . $key . "`='" . $val . "',";
                break;
        }
    }
    #注册到柳悟科技
    $end = date("Y-m-d H:i:s", (time() + 24 * 60 * 60 * 365));
    $sqlStr .= " `UUID`='".$UUID."',";
    if ($exRet):
        $serversql = "update `s_unit` set " . $sqlStr . " `lastModifyTime`='$now' where `ID` like '" . _serverID . "' ";
        $serverID = $exRet['ID'];
        $actionStatus = $serverPDO->query($serversql);
    else:
        $serversql = "insert `s_unit` set " . $sqlStr . " `from`='$now',`end`='$end',`status`='1',`inTime`='$now'";
        $actionStatus = $serverPDO->query($serversql);
        $serverID = $serverPDO->lastInsertId();
    endif;
    $serverIDStr = 'define("_serverID", "' . $serverID . '");';
    $UUIDStr = 'define("_UUID", "' . $UUID . '");';
    $serverCompanyStr = '$serverCompany = "' . $_POST['serverCompany'] . '";';
    $serverUrlStr = '$serverUrl = "' . $_POST['serverUrl'] . '";';
    if ($actionStatus) {
        #插入config.php文件
        $f = new splFile();
        $f->fileName = sysPath . 'config.php';
        $f->mode = "line";
        $f->replace = 8;
        $f->actionVal = $serverIDStr;
        $f->repleace();
        if (!_UUID) {
            $f->replace = 9;
            $f->actionVal = $UUIDStr;
            $f->repleace();
        }
        $f->replace = 10;
        $f->actionVal = $serverCompanyStr;
        $f->repleace();
        $f->replace = 11;
        $f->actionVal = $serverUrlStr;
        $f->repleace();
        $f->replace = 15;
        $f->actionVal = $inTurnStr;
        $f->repleace();
        $f->replace = 21;
        $f->actionVal = '$arr = array(' . $IDStr . ');';
        $f->repleace();
        $showWindow = "<script>alert('欢迎使用柳悟劳务派遣系统,系统已登记注册成功'); window.location.reload();</script>";
    } else {
        $errMsg = "发生未知错误,请<a href='" . httpPath . "system/reset.php'>点击此处重置</a>,按规定重新填写";
        sys_error($smarty, $errMsg, $title);
    }
}
#变量配置
$smarty->assign(array("serverID" => _serverID, "serverCompany" => $serverCompany, "serverUrl" => $serverUrl, "UUID" => $UUID, "exRet" => $exRet));
$smarty->assign(array("insuranceInTurnArr" => $insuranceInTurnArr, "insuranceIDArr" => $insuranceIDArr, "wantToMergeInfoArr" => $wantToMergeInfoArr));
$smarty->assign(array("showWindow" => $showWindow));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/initSetting.tpl');
?>
