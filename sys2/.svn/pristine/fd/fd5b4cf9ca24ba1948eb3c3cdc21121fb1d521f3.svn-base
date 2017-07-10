<?php
/* 
 *  人才库的数据库操作语句
 * 
 */

#连接权限验证文件
require_once '../auth.php';
#连接公用函数库
require_once '../common.function.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';
#初始化配置
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
$today = timeStyle("date", "-");

#应聘人员状态变更
if ($_POST ['btn'] == "procedurerStatus[]") {
    list ($talentID, $status, $positionID) = explode("|", $_POST ['talentArr']);
    $procedurerStatus = $_POST ['checkType'];
    #获取对应岗位的相关复试流程
    $b = new position ();
    $b->pdo = $pdo;
    $b->positionBasic("`positionID`,`reexamineProcedureID`", "`positionID`='" . $positionID . "'");
    $b->recruitProcedurer("1");
    $b->thisProcedurer = $status;
    $preOrNextProcedurerArr = $b->preOrNextProcedurer();
    $nextProcedurer = $preOrNextProcedurerArr [$positionID] ['next'] ['procedurerID'];
    if ($nextProcedurer) {
        #存在记录验证
        $exSql = "select 1 from `b_recruit_notes` where `talentID`='$talentID' and `status`='$status'";
        $exRet = SQL($pdo, $exSql);
        #更新人才库状态信息
        switch ($procedurerStatus) {
            case "0" : //不通过的员工直接转换成储备人才库
                $sql = "update a_talent set `status`='2' ,`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
                break;
            case "1" :
                $sql = "update a_talent set `status`='$nextProcedurer' ,`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
                break;
            case "2" :
                $sql = "update a_talent set `status`='$status' ,`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
                break;
        }
        if ($exRet) {
            $iSql = "update `b_recruit_notes` set `procedurerStatus`='$procedurerStatus',`createdBy`='$mID',`createdOn`='$now' where  `talentID`='$talentID' and `status`='$status'";
        }
        else {
            $iSql = "insert  `b_recruit_notes` set `talentID`='$talentID',`status`='$status',`procedurerStatus`='$procedurerStatus',`createdBy`='$mID',`createdOn`='$now' ";
        }
        $actionSql = array(
            $iSql,
            $sql
        );
        $result = extraTransaction($pdo, $actionSql);
        $errMsg ['sql'] = $result ['error'];
    }
    else {
        $errMsg[] = "发生错误: 该岗位未设置复试流程!!";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
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
#电话回访及通知等相关备注
if ($_POST ['btn'] == "remarksSub") {
    list ($talentID, $status) = explode("|", $_POST ['talentArr']);
    $sql ['0'] = "update `b_recruit_notes` set `remarks`='" . $_POST ['remarks'] . "',`createdBy`='$mID',`createdOn`='$now' where  `talentID`='$talentID' and `status`='$status'";
    $result = extratransaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
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
#合同信息等相关备注
if ($_POST ['btn'] == "contactInfoSub") {
    list ($talentID, $status) = explode("|", $_POST ['talentArr']);
    #存在记录验证
    $exSql = "select 1 from `b_recruit_notes` where `talentID`='$talentID' and `status`='$status'";
    $exRet = SQL($pdo, $exSql);
    if ($exRet) {
        $sql['0'] = "update `b_recruit_notes` set `contactInfo`='" . trim($_POST ['contactInfo']) . "',`createdBy`='$mID',`createdOn`='$now' where  `talentID`='$talentID' and `status`='$status'";
    }
    else {
        $sql['0'] = "insert  `b_recruit_notes` set `talentID`='$talentID',`status`='$status',`contactInfo`='" . trim($_POST ['contactInfo']) . "',`createdBy`='$mID',`createdOn`='$now' ";
    }
    $result = extratransaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
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
#应聘人员培训成绩设置
if ($_POST ['btn'] == "trainStatus[]") {
    list ($trainClassicID, $talentID, $status, $positionID) = explode("|", $_POST ['talentArr']);
    $trainStatus = $_POST ['checkType'];
    //默认先删除相关的培训记录
    $tSql = "delete from `b_recruit_marks` where `talentID`='$talentID' and `trainClassicID`='$trainClassicID'  and `status`='7'";
    $pdo->query($tSql);
    switch ($_POST ['ck']) {
        case "1" :
            $tSql = " insert into `b_recruit_marks` set  `talentID`='$talentID' , `trainClassicID`='$trainClassicID' , `status`='$status',`marksStatus`='1',`createdBy`='$mID',`createdOn`='$now'";
            $pdo->query($tSql);
            break;
    }
    #验证此时的培训是否已经全部通过
    $a = new talent ();
    $a->pdo = $pdo;
    $a->talentBasic("`talentID`,`status`,`positionID`", " `talentID`='$talentID' ");
    $a->categoryBasic();

    #获取对应岗位的相关复试流程
    $b = new position ();
    $b->pdo = $pdo;
    $b->positionBasic("`positionID`,`reexamineProcedureID`", "`positionID`='" . $positionID . "'");
    $b->recruitProcedurer("1");
    $b->thisProcedurer = $status;
    $preOrNextProcedurerArr = $b->preOrNextProcedurer();
    $nextProcedurer = $preOrNextProcedurerArr [$positionID] ['next'] ['procedurerID'] ? $preOrNextProcedurerArr [$positionID] ['next'] ['procedurerID'] : $status;
    if ($trainStatus) {
        $nextProcedurer = $trainStatus;
        $status = $trainStatus;
    }
    #按人才当前状态分类
    $c = new tInfoStatus ();
    $c->pdo = $pdo;
    $c->ret = $a->ret;
    $c->categoryArr = $a->categoryArr;
    $c->classLinkClass();
    $c->statusArr = $a->ret;
    $c->recruitMarksArr("7");
    $trainPassStatusArr = $c->trainPassStatusArr();
    if (!$trainPassStatusArr [$talentID]) {
        // 如果都通过了培训的全部考试,则
        $procedurerStatus = "1";
    }
    else
        //初始化如果需要培训而未参加培训的,则 $procedurerStatus  默认为 等待("2")
        $procedurerStatus = "2";
    #存在记录验证
    $exSql = "select 1 from `b_recruit_notes` where `talentID`='$talentID' and `status`='$status'";
    $exRet = SQL($pdo, $exSql);
    #更新人才库状态信息
    switch ($procedurerStatus) {
        case "0" : //不通过的员工直接转换成储备人才库
            $sql = "update a_talent set `status`='2' ,`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
            break;
        case "1" :
            $sql = "update a_talent set `status`='$nextProcedurer' ,`d_train`='1',`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
            break;
        case "2" :
            $sql = "update a_talent set `status`='$status' ,`d_train`='0',`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
            break;
    }
    if ($exRet) {
        $iSql = "update `b_recruit_notes` set `procedurerStatus`='$procedurerStatus',`createdBy`='$mID',`createdOn`='$now' where  `talentID`='$talentID' and `status`='$status'";
    }
    else {
        $iSql = "insert  `b_recruit_notes` set `talentID`='$talentID',`status`='$status',`procedurerStatus`='$procedurerStatus',`createdBy`='$mID',`createdOn`='$now' ";
    }
    $actionSql = array(
        $iSql,
        $sql
    );
    $result = extraTransaction($pdo, $actionSql);
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
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

#应聘人员交资料情况设置
if ($_POST ['btn'] == "materialStatus[]") {
    list ($trainClassicID, $talentID, $status, $positionID) = explode("|", $_POST ['talentArr']);
    $materialStatus = $_POST ['checkType'];
    //默认先删除相关的培训记录
    $tSql = "delete from `b_recruit_marks` where `talentID`='$talentID' and `trainClassicID`='$trainClassicID' and `status`<>'7'";
    $pdo->query($tSql);
    switch ($_POST ['ck']) {
        case "1" :
            $tSql = " insert into `b_recruit_marks` set  `talentID`='$talentID' , `trainClassicID`='$trainClassicID' , `status`='$status',`marksStatus`='1',`createdBy`='$mID',`createdOn`='$now'";
            $pdo->query($tSql);
            break;
    }
    #验证此时的培训是否已经全部通过
    $a = new talent ();
    $a->pdo = $pdo;
    $a->talentBasic("`talentID`,`status`,`positionID`", " `talentID`='$talentID' ");
    $a->categoryBasic();

    #获取对应岗位的相关复试流程
    $b = new position ();
    $b->pdo = $pdo;
    $b->positionBasic("`positionID`,`materialProcedureID`,`waitProcedureID`", "`positionID`='" . $positionID . "'");


    #按人才当前状态分类
    $c = new tInfoStatus ();
    $c->pdo = $pdo;
    $c->ret = $a->ret;
    $c->categoryArr = $a->categoryArr;
    $c->classLinkClass();
    $c->statusArr = $a->ret;
    $c->recruitMarksArr("8,99");
    switch ($trainClassicID) {
        //待岗流程
        case "98" :
        case "99" :
            $trainPassStatusArr = $c->trainPassStatusArr("3");
            $upField = "d_commit";
            break;
        //交资料流程
        default :
            $trainPassStatusArr = $c->trainPassStatusArr("4");
            $upField = "d_material";
            break;
    }
    if (!$trainPassStatusArr [$talentID]) {
        // 如果都交齐了材料,则
        $procedurerStatus = "1";
    }
    else
        //如果未交齐材料的,则 $procedurerStatus  默认为 等待("2")
        $procedurerStatus = "2";
    #存在记录验证
    $exSql = "select 1 from `b_recruit_notes` where `talentID`='$talentID' and `status`='$status'";
    $exRet = SQL($pdo, $exSql);
    #更新人才库状态信息
    switch ($procedurerStatus) {
        case "1" :
            $sql = "update a_talent set `$upField`='1',`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
            break;
        case "2" :
            $sql = "update a_talent set `$upField`='0',`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
            break;
    }
    if ($exRet) {
        $iSql = "update `b_recruit_notes` set `procedurerStatus`='2',`createdBy`='$mID',`createdOn`='$now' where  `talentID`='$talentID' and `status`='$status'";
    }
    else {
        $iSql = "insert  `b_recruit_notes` set `talentID`='$talentID',`status`='$status',`procedurerStatus`='2',`createdBy`='$mID',`createdOn`='$now' ";
    }
    $actionSql = array(
        $iSql,
        $sql
    );
    $result = extraTransaction($pdo, $actionSql);
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
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

#应聘人员交资料完整性变更
if ($_POST ['btn'] == "materialComplete[]") {
    list ($trainClassicID, $talentID, $status, $positionID) = explode("|", $_POST ['talentArr']);
    $actionSql[] = "update a_talent set `status`='$status' ,`d_material`='" . $_POST ['ck'] . "',`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$talentID'";
    $result = extraTransaction($pdo, $actionSql);
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
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
#意向区域设置调整
if ($_POST ['btn'] == "wantedAreaSub") {
    list ($talentID, $status) = explode("|", $_POST ['talentArr']);
    $sql ['0'] = "update `a_talent` set `wantedArea`='" . $_POST ['wantedArea'] . "' ,`lastModifyTime`='$now',`lastModifiedBy`='$mID'  where  `talentID`='$talentID'";
    $result = extratransaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
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
?>