<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 13-4-7
 * Time: 上午9:50
 * To change this template use File | Settings | File Templates.
 */

require_once ('../setting.php');
#连接公用函数库
require_once sysPath . 'common.function.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';
#链接人才库信息类
require_once sysPath . 'dataFunction/talent.data.php';
#初始化配置
$time = time();
$now = timeStyle("dateTime", "-");
$today = timeStyle("date", "-");



#员工信息登记

if ($_POST ['btn'] == "wInput") {
    $wID = $_POST['wID'];
    $kID = $_POST['kID'];
    $talentID = $_POST['talentID'];
    $wName = $_POST['dataName'];
    $wValue = $_POST['dataValue'];
    switch ($wName) {
        //更新到web_worker_basic和a_talent
        case "name":
            $sql[] = "update web_worker_basic set " . $wName . "='" . $wValue . "' where wID= " . $wID;
            $sql[] = "update a_talent set " . $wName . "='" . $wValue . "' where talentID= " . $talentID;
            break;
        //更新web_winfo_extra和a_talent
        case "sex" :
        case "education":
        case "telephone":
            $exSql = "select " . $wName . " from `web_winfo_extra` where `wID`= " . $wID;
            $ret = SQL($pdo, $exSql);
            if ($ret) {
                $sql[] = "update `web_winfo_extra` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."'," . $wName . "='" . $wValue . "' where wID= " . $wID;
            } elseif($wValue) {
                $sql[] = "INSERT INTO `web_winfo_extra` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."',`wID`='" . $wID . "', " . $wName . "='" . $wValue . "'";
            }
            $sql[] = "update a_talent set  " . $wName . "='" . $wValue . "' where talentID= " . $talentID;
            break;
        //插入到员工基本信息表 web_winfo_extra
        case "marriage":
        case "nativePlace":
        case "birthPlace":
        case "domicilePlace":
        case "nation":
        case "role":
        case "homeAddress":
        case "lastUnit":
        case "contact":
        case "contactAddress":
        case "cHomePhone":
        case "homePhone":
        case "contactPhone":
        case "everName":
        case "englishName":
        case "height":
        case "health":
        case "weight":
        case "blood":
        case "nativePost":
        case "birthday":
        case "workAddress":
        case "nativeType":
        case "otherStatus":
        case "oID":
        case "emergency":
        case "workTime":
        case "driveType":
        case "driveValid":
        case "hobby":
        case "strongPoint":
        case "QQ":
        case "Email":
        case "Twitter":
        case "spouseName":
        case "spousePID":
        case "wCertificate":
        case "proLevel":
        case "cRelation":
        case "entryWay":

            $exSql = "select " . $wName . " from web_winfo_extra where wID = " . $wID;
            $ret = SQL($pdo, $exSql);
            if ($ret) {
                $sql[] = "update web_winfo_extra set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."'," . $wName . "='" . $wValue . "' where wID= " . $wID;
            } elseif($wValue){
                $sql[] = "INSERT INTO  web_winfo_extra set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."', wID='" . $wID . "', " . $wName . " ='" . $wValue . "'";
            }
            break;

        //插入或更新家庭信息表web_winfo_extra_relative
        case "f_name[]":
        case "f_sex[]":
        case "f_birthday[]":
        case "f_workUnit[]":
        case "f_job[]":
        case "f_phone[]":
        case "f_address[]":
        case "f_domicilePlace[]":
        case "f_relation[]":
            $sName = substr("$wName", 2, -2);
            if (!is_numeric($kID)) {
                $exSql = "select " . $sName . ",ID from `web_winfo_extra_relative` where `wID`= " . $wID . " and `sp`='" . $kID . "'";
                $ret = SQL($pdo, $exSql, null, one);
                $kID = $ret["ID"] ? $ret["ID"] : $kID;
            } else {
                $exSql = "select " . $sName . " from `web_winfo_extra_relative` where `wID`= " . $wID . " and `ID`=" . $kID;
                $ret = SQL($pdo, $exSql);
            }

            if ($ret) {
                $sql[] = "update `web_winfo_extra_relative` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."'," . $sName . "='" . $wValue . "' where `wID`= " . $wID . " and `ID`=" . $kID;
            } elseif($wValue) {
                $sql[] = "INSERT INTO `web_winfo_extra_relative` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."',`wID`='" . $wID . "', " . $sName . " ='" . $wValue . "',`sp`='$kID'";
            }
            break;
        //插入或更新个人工作简历表web_winfo_extra_study
        case "o_BETime[]":
        case "o_jobType[]":
        case "o_workUnit[]":
        case "o_department[]":
        case "o_job[]":
        case "o_leaveReason[]":
        case "o_reterence[]":
        case "o_phone[]":
        case "o_overSeas[]":
            $sName = substr("$wName", 2, -2);
            if (!is_numeric($kID)) {
                $exSql = "select " . $sName . ",ID from `web_winfo_extra_workinfo` where `wID`= " . $wID . " and `sp`='" . $kID . "'";
                $ret = SQL($pdo, $exSql, null, one);
                $kID = $ret["ID"] ? $ret["ID"] : $kID;
            } else {
                $exSql = "select " . $sName . " from `web_winfo_extra_workinfo` where `wID`= " . $wID . " and `ID`=" . $kID;
                $ret = SQL($pdo, $exSql);
            }

            if ($ret) {
                $sql[] = "update `web_winfo_extra_workinfo` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."'," . $sName . "='" . $wValue . "' where `wID`= " . $wID . " and `ID`=" . $kID;
            } elseif($wValue) {
                $sql[] = "INSERT INTO `web_winfo_extra_workinfo` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."',`wID`='" . $wID . "', " . $sName . " ='" . $wValue . "',`sp`='$kID'";
            }

            break;
        //插入或更新学习经历信息
        case "s_BETime[]":
        case "s_graduate[]":
        case "s_major[]":
        case "s_education[]":
        case "s_degree[]":
        case "s_diplomaNumber[]":
        case "s_studyWay[]":
        case "s_overSeas[]":
            $sName = substr("$wName", 2, -2);
            if (!is_numeric($kID)) {
                $exSql = "select " . $sName . ",ID from `web_winfo_extra_study` where `wID`= " . $wID . " and `sp`='" . $kID . "'";
                $ret = SQL($pdo, $exSql, null, one);
                $kID = $ret["ID"] ? $ret["ID"] : $kID;
            } else {
                $exSql = "select " . $sName . " from `web_winfo_extra_study` where `wID`= " . $wID . " and `ID`=" . $kID;
                $ret = SQL($pdo, $exSql);
            }

            if ($ret) {
                $sql[] = "update `web_winfo_extra_study` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."'," . $sName . "='" . $wValue . "' where `wID`= " . $wID . " and `ID`=" . $kID;
            } elseif($wValue) {
                $sql[] = "INSERT INTO `web_winfo_extra_study` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."',`wID`='" . $wID . "', " . $sName . " ='" . $wValue . "',`sp`='$kID'";
            }

            break;
        //插入或更新培训信息
        case "t_BETime[]":
        case "t_course[]":
        case "t_trainTime[]":
        case "t_organization[]":
        case "t_diploma[]":
            $sName = substr("$wName", 2, -2);
            if (!is_numeric($kID)) {
                $exSql = "select " . $sName . ",ID from `web_winfo_extra_train` where `wID`= " . $wID . " and `sp`='" . $kID . "'";
                $ret = SQL($pdo, $exSql, null, one);
                $kID = $ret["ID"] ? $ret["ID"] : $kID;
            } else {
                $exSql = "select " . $sName . " from `web_winfo_extra_train` where `wID`= " . $wID . " and `ID`=" . $kID;
                $ret = SQL($pdo, $exSql);
            }

            if ($ret) {
                $sql[] = "update `web_winfo_extra_train` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."'," . $sName . "='" . $wValue . "' where `wID`= " . $wID . " and `ID`=" . $kID;
            } elseif($wValue){
                $sql[] = "INSERT INTO `web_winfo_extra_train` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."',`wID`='" . $wID . "', " . $sName . " ='" . $wValue . "',`sp`='$kID'";
            }

            break;
        case "d_BETime[]":
        case "d_diploma[]":
        case "d_grade[]":
        case "d_getWay[]":
        case "d_judgeUnit[]":
            $sName = substr("$wName", 2, -2);
            if (!is_numeric($kID)) {
                $exSql = "select " . $sName . ",ID from `web_winfo_extra_diploma` where `wID`= " . $wID . " and `sp`='" . $kID . "'";
                $ret = SQL($pdo, $exSql, null, one);
                $kID = $ret["ID"] ? $ret["ID"] : $kID;
            } else {
                $exSql = "select " . $sName . " from `web_winfo_extra_diploma` where `wID`= " . $wID . " and `ID`=" . $kID;
                $ret = SQL($pdo, $exSql);
            }

            if ($ret) {
                $sql[] = "update `web_winfo_extra_diploma` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."', " . $sName . "='" . $wValue . "' where `wID`= " . $wID . " and `ID`=" . $kID;
            } elseif($wValue){
                $sql[] = "INSERT INTO `web_winfo_extra_diploma` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."', `wID`='" . $wID . "', " . $sName . " ='" . $wValue . "',`sp`='$kID'";
            }
            break;
        //插入或更新语种表
        case "language[]":
        case "speakLevel[]":
        case "readLevel[]":
        case "writeLevel[]":
            $sName = substr("$wName", 0, -2);

            if (!is_numeric($kID)) {
                $exSql = "select " . $sName . ",ID from `web_winfo_extra_language` where `wID`= " . $wID . " and `sp`='" . $kID . "'";
                $ret = SQL($pdo, $exSql, null, one);
                $kID = $ret["ID"] ? $ret["ID"] : $kID;
            } else {
                $exSql = "select " . $sName . " from `web_winfo_extra_language` where `wID`= " . $wID . " and `ID`=" . $kID;
                $ret = SQL($pdo, $exSql);
            }

            if ($ret) {
                $sql[] = "update `web_winfo_extra_language` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."', " . $sName . "='" . $wValue . "' where `wID`= " . $wID . " and `ID`=" . $kID;
            } elseif($wValue) {
                $sql[] = "INSERT INTO `web_winfo_extra_language` set  `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."', `wID`='" . $wID . "', " . $sName . " ='" . $wValue . "',`sp`='$kID'";
            }

            break;
        //插入或更新内部推荐信息表
        case "iName":
        case "iNumber":
        case "iLocal":
        case "iDepartment":
        case "iJob":
        case "iSex":
        case "iPhone":
        case "iRelation":
            $exSql = "select " . $wName . " from `web_winfo_extra_interior` where `wID` = " . $wID;
            $ret = SQL($pdo, $exSql);
            if ($ret) {
                $sql[] = "update `web_winfo_extra_interior` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."'," . $wName . "='" . $wValue . "' where `wID`= " . $wID;
            } elseif($wValue) {
                $sql[] = "INSERT INTO `web_winfo_extra_interior` set `lastModifyTime`='".$now."',`lastModifyBy`='".$wID."',`wID`='" . $wID . "', " . $wName . " ='" . $wValue . "'";
            }
            break;
    }
    if($sql)
    {

        $result = extraTransaction($pdo, $sql);
    }
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
        }
        $errMsg = $errorMsg;
    } else {
        $succMsg = "成功了";
    }

    $msg = array(
        "error" => $errMsg,
        "succ" => "成功了"
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;

}


#登记身份证信息
if ($_POST ['btn'] == "up_personInfoBtn") {
    $talentID = $_POST['tID'];
    $idCard = trim($_POST['idCard']);
    $tel = trim($_POST['telephone']);
    $t = new talent();
    $t->pdo=$pdo;
    $t->talentBasic("1"," `talentID`=$talentID and `telephone`='$tel'");
    if(!$t->ret)
        $errMsg[]="输入的手机号码与登记的信息不匹配";
    elseif (pIDVildator($idCard)) {
        $sql[] = "update `a_talent` set `idCard`='" . $idCard . "',`lastModifyTime`='" . $now . "' where `talentID`=$talentID and `telephone`='$tel'";
        $sql[] = "update `web_worker_basic` set `mName`='" . $idCard . "',`lastModifyManagerTime`='".$now."' where `talentID`=$talentID ";
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
    }
    else {
        $errMsg[] = "身份证号码验证失败";
    }
    $errMsg = array_filter($errMsg);
    if ($errMsg) {
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV ;
        }
        $errMsg = $errorMsg;
    }
    else {
        $succMsg = "信息登记成功了";
    }

    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}