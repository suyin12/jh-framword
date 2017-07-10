<?php
/**
 * 2010-4-23
 * <<<>>>
 *
 * @author  yours  sToNe
 * @version
 */
#连接权限验证文件(简单的一级验证,系统用户?)
require_once '../auth.php';
require_once '../common.function.php';
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
#社保专员签收社保申报表
if ($_POST ['btn'] == "receive") {

    $zhuanyuan = $_POST ['zy'];
    if ($_SESSION ['exp_user'] ['mID'] != $zhuanyuan) //if(0)
    {
        $error2 = "只能签收自己管理的社保单位";
    } else {
        $manageSql = "select unitID,mName from s_user where roleID REGEXP '2_1,'";
        $manageRes = $pdo->query($manageSql);
        $manageRet = $manageRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($manageRet as $mK => $mV) {
            $manageArr [$mV ['mName']] = $mV ['unitID'];
        }
        $receiverName = $_SESSION ['exp_user'] ['mName'];
        $receiveTime = timeStyle("dateTime");
        $zySql = "select unitID from s_user where mID = " . $zhuanyuan;
        $ret = $pdo->query($zySql);
        $res = $ret->fetch(PDO::FETCH_ASSOC);
        $units_str = $res ['unitID'];

        foreach ($_POST ['chkList'] as $chkVal) {
            list ($soInsModifyDate, $sponsorName, $extraBatch, $type) = explode("|", $chkVal);
          
            //这句要改
            #补缴相关
            if ($type == "9") {
                $sql [] = "update a_soinslist a set a.receiverName = '" . $receiverName . "', a.receiveTime = '" . $receiveTime . "', a.status = '1'
							where  a.soInsModifyDate = '" . $soInsModifyDate . "' and a.sponsorName = '" . $sponsorName . "' and a.extraBatch = '" . $extraBatch . "' and a.unitID like '3000.001'";

                $sql [] = "update d_agent_personalInfo a,a_soInsList b set a.soInsurance ='1' where b.soInsurance like '2'
							and a.id=b.uID and b.soInsModifyDate ='$soInsModifyDate' and b.sponsorName like '$sponsorName'
							and b.extraBatch = '$extraBatch' and b.unitID like '3000.001'";
            } else {
                $sql [] = "update a_soinslist a , a_workerinfo b set a.receiverName = '" . $receiverName . "', a.receiveTime = '" . $receiveTime . "', a.status = '1'
							where a.uID = b.uID and a.soInsModifyDate = '" . $soInsModifyDate . "' and a.sponsorName = '" . $sponsorName . "' and a.extraBatch = '" . $extraBatch . "' and b.unitID in (" . $units_str . ")";

                $sql [] = "update a_workerInfo a,a_soInsList b set a.soInsurance ='1' where b.soInsurance like '2'
							and a.uID=b.uID and b.soInsModifyDate ='$soInsModifyDate' and b.sponsorName like '$sponsorName'
							and b.extraBatch = '$extraBatch' and a.unitID in (" . $units_str . ")";
            }
        }


        //进行事务处理,所有更新成功为成功
        $result = extraTransaction($pdo, $sql);
        $errMsg = $result ['error'];
        $succNum = $result ['num'];
        if (empty ($errMsg)) {
            $succMsg = "签收成功";
        }
    }

    $msg = array(
        "error" => $errMsg,
        "error2" => $error2,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#平账结果提交
if (isset ($_POST ['btn']) == "soInsBalFeeBtn" && $_POST ['type'] == "soFee") {
    $month = $_POST ['month'];
    $unitID = $_POST ['unitID'];
    $soInsDate = $_POST ['soInsDate'];
    //验证签收状态,签收后是不可以删除的
    $exSql = "select roleA from a_editAccountList where month like :month and unitID like :unitID and type like '5' and confirmStatus ='1' ";
    $exRes = $pdo->prepare($exSql);
    $exRes->execute(array(
        ":unitID" => $unitID,
        ":month" => $month
    ));
    $exCount = $exRes->rowCount();
    if ($exCount > 0) {
        $errMsg [] = "平账数据已存在,无需再次提交";
    } else {
        //先删除已经申请的平账记录,再做添加
        $deSql [0] = "delete from a_editAccountList where month like '$month' and unitID like '$unitID' and type = '5'";
        foreach ($_POST as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    $tsql [$k] = "insert into `a_editAccountList` set `status`='1',`roleA`='$k',`roleB`='$k',soInsDate='$soInsDate',month='$month',unitID='$unitID',type='5',sponsorName='$mName',sponsorTime='$now',";
                    switch ($key) {
                        case "pSoInsMoney" :
                        case "uSoInsMoney" :
                            if ($v != 0) {
                                $field [$k] .= $key . "|";
                                $str [$k] .= "`" . $key . "`='" . $v . "',";
                            }
                            break;
                        default :
                            if ($v != 0) {
                                $v = -$v;
                                $str [$k] .= "`" . $key . "`='" . $v . "',";
                            }
                            break;
                    }
                }
            }
        }
        foreach ($str as $sk => $sv) {
            $sql [$sk] = "insert into `a_editAccountList` set `status`='1', `roleA`='$sk',`roleB`='$sk',soInsDate='$soInsDate',month='$month',unitID='$unitID',type='5',sponsorName='$mName',sponsorTime='$now'," . $sv . "`field`='" . $field [$sk] . "'";
        }
        $actionSql = mergeArray($deSql, $sql);
        $result = extraTransaction($pdo, $actionSql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            #这里另外单独建立了一个报表提交登记表
            require sysPath . "dataFunction/actionRecord.data.php";
            $a = new actionRecord ();
            $a->pdo = $pdo;
            $conStr = array("month" => $month, "unitID" => $unitID);
            $sql ? $status = "0" : $status = "1";
            $result = $a->sponsor('5', $conStr, $status);
            $succMsg = "提交成功";
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
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#删除缴交明细
if ($_POST ['btn'] == "deleteSoInsFeeDetail") {
    $soInsID = $_POST ['soInsID'];
    $soInsDate = $_POST ['soInsDate'];
    $exSql = "select roleA from a_editAccountList where soInsDate like '$soInsDate' and type='5' and status='1'";
    $exRes = $pdo->query($exSql);
    $exRowCount = $exRes->rowCount();
    if ($exRowCount > 0) {
        $errMsg [] = "平账数据已经被签收,无法删除缴交明细";
    } else {
        #一并删除本月的平账数据,如果已经被签收平账数据,则不可以删除原始表
        $sql [0] = "delete from a_soInsFee_tmp where soInsID like '$soInsID' and soInsDate like '$soInsDate'";
        $sql [1] = "delete from a_editAccountList where soInsDate like '$soInsDate' and type='5'";
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $succMsg = "删除成功";
        } else
            $errMsg [] = "删除失败,请联系管理员";
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
#更改缴交明细姓名及身份证号码
if ($_POST ['btn'] == "editSoInsFee_tmpBtn") {
    list ($field, $ID) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    $reSql = "update a_soInsFee_tmp set `$field`='$fieldVal',`sponsorName`='$mName',`sponsorTime`='$now' where `ID`='$ID'";
    $sql [0] = $reSql;
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
#更改缴交账户及添加备注
if ($_POST ['btn'] == "editSoInsRemarks") {
    list ($field, $uID) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    switch ($field) {
        case "spRemarks" :
            $fieldVal = "soIns=>" . htmlspecialchars($fieldVal) . "";
            break;
    }
    $reSql = "update `a_workerInfo` set `$field`='$fieldVal' where `uID`='$uID'";
    $sql [0] = $reSql;
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

?>