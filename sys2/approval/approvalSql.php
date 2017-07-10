<?php

/*
 *     2010-10-9
 *          <<< 审批相关数据库操作 >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#连接权限验证文件(简单的一级验证,系统用户?)
require_once '../auth.php';
#连接公共函数文件
require_once sysPath . 'common.function.php';
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
#大审批流程审批通过
if ($_POST ['btn'] == "approvalSucc") {
    $ID = $_POST ['proID'];
    #获取该流程
    $sql = "select `order`,`appProID` from `a_approval_process` where `ID`='$ID'";
    $res = $pdo->query($sql);
    $ret = $res->fetch(PDO::FETCH_ASSOC);
    #验证是否在该流程之前是否有未签收或已经退回的
    $exSql = "select a.appProID,a.order from `a_approval_process`  a  where a.`appProID`='$ret[appProID]' and a.`order`<'$ret[order]'and a.`status` in ('0','99')";
    $exRes = $pdo->query($exSql);
    $exRet = $exRes->fetch(PDO::FETCH_ASSOC);
    if ($exRet) {
        $errMsg [] = "审批失败:请依照审批顺序完成审批或审批已被退回";

    } else {
        $orderSql = "select appProID from `a_approval_process` where `order` >'$ret[order]' and 	`appProID` like '$ret[appProID]'";
        $orderRes = $pdo->query($orderSql);
        $orderRet = $orderRes->fetch(PDO::FETCH_ASSOC);
        if (!$orderRet) {
            $passSql = "update `a_approval_list` set `status`='1' where `appProID` like '$ret[appProID]'";
            $passRet = $pdo->exec($passSql);
        }
        $updateSql = "update a_approval_process set `status`='1',`remarks`='$_POST[approvalRemarks]',`sponsorName`='$mName',`sponsorTime`='$now' where `ID`='$ID'";
        $ret = $pdo->exec($updateSql);
        if ($ret)
            $succMsg = "审批通过";
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
#大审批流程退回
if ($_POST ['btn'] == "approvalRollback") {
    $ID = $_POST ['proID'];
    #获取该流程
    $sql = "select `order`,`appProID` from `a_approval_process` where `ID`='$ID'";
    $res = $pdo->query($sql);
    $ret = $res->fetch(PDO::FETCH_ASSOC);
    $updateSql [0] = "update `a_approval_list` set `status`='99' where `appProID` like '$ret[appProID]'";
    $updateSql [1] = "update a_approval_process set `status`='99',`remarks`='$_POST[approvalRemarks]',`sponsorName`='$mName',`sponsorTime`='$now' where `ID`='$ID'";
    if ($_POST['WDDetail'] == "1") {
        $type = $_POST ['type'];
        $month = $_POST ['month'];
        $unitID = $_POST ['unitID'];
        $updateSql[2] = "update a_editAccountList set status='99' where type='$type' and month like '$month' and unitID like '$unitID'";
    }
    $actionSql = $updateSql;
    $result = extraTransaction($pdo, $actionSql);
    $errMsg ['sql'] = $result ['error'];
    if (empty ($errMsg ['sql'])) {
        $succMsg = "退回成功";
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
#签收审批清单
if ($_POST ['btn'] == "receive") {
    $type = $_POST ['type'];
    $month = $_POST ['month'];
    $unitID = $_POST ['unitID'];
    $ID = $_POST ['ID'];
    switch ($type) {
        case "wholeWD" :
            $sql = "update a_uWriteDownList set status='1',receiverName='$mName',receiveTime='$now' where  month like '$month' and unitID like '$unitID'";
            $row = $pdo->exec($sql);
            if ($row) {
                $succMsg = "签收成功";
            } else {
                $errMsg = "$sql 签收失败:请联系系统管理员";
            }
            break;
        case "2" :
            $unitID = $ID;
            $sql = "update a_editAccountList set status='1',receiverName='$mName',receiveTime='$now' where type='$type' and month like '$month' and unitID like '$unitID'";
            $row = $pdo->exec($sql);
            if ($row) {
                $succMsg = "签收成功";
            } else {
                $errMsg = "$sql 签收失败:请联系系统管理员";
            }
            break;
            break;
        default :
            #这里另外单独建立了一个报表提交登记表,跟上面的整体冲减挂账不同
            require sysPath . "dataFunction/actionRecord.data.php";
            $a = new actionRecord ();
            $a->pdo = $pdo;
            $result = $a->receive($ID);
            $errMsg ['sql'] = $result ['error'];
            if (empty ($errMsg ['sql'])) {
                $succMsg = "签收成功";
            }
            if ($errMsg) {
                $errMsg = array_filter($errMsg);
                $errMsg = array_unique($errMsg);
                foreach ($errMsg as $eV) {
                    $errorMsg .= $eV . "/n";
                }
                $errMsg = $errorMsg;
            }
            break;
    }

    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#退回(暂时没做完..这个退回功能还必须包括已经操作的数据删除)
if ($_POST ['btn'] == "rollback") {
    $type = $_POST ['type'];
    $month = $_POST ['month'];
    $unitID = $_POST ['unitID'];
    $ID = $_POST ['ID'];
    switch ($type) {
        case "wholeWD" :
            $sql = "update a_uWriteDownList set status='99' where month like '$month' and unitID like '$unitID'";
            $row = $pdo->exec($sql);
            if ($row) {
                $succMsg = "退回成功";
            } else {
                $errMsg = "退回失败:请联系系统管理员";
            }
            break;
        default :
            // 			$sql = "update a_editAccountList set status='99' where type='$type' and month like '$month' and unitID like '$unitID'";
            #这里另外单独建立了一个报表提交登记表,跟上面的整体冲减挂账不同
            require sysPath . "dataFunction/actionRecord.data.php";
            $a = new actionRecord ();
            $a->pdo = $pdo;
            $result = $a->rollback($ID);
            $errMsg ['sql'] = $result ['error'];
            if (empty ($errMsg ['sql'])) {
                $succMsg = "退回成功";
            }
            if ($errMsg) {
                $errMsg = array_filter($errMsg);
                $errMsg = array_unique($errMsg);
                foreach ($errMsg as $eV) {
                    $errorMsg .= $eV . "/n";
                }
                $errMsg = $errorMsg;
            }
            break;
    }

    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#审批通过..
if ($_POST ['btn'] == "feeApprovalSuccBtn") {
    $type = $_POST ['type'];
    $month = $_POST ['month'];
    $unitID = $_POST ['unitID'];
    if ($_POST ['roleA']) {
        $roleAArr = array_unique($_POST ['roleA']);
        foreach ($roleAArr as $val) {
            $roleAStr .= "'" . $val . "',";
        }
        $roleAStr = rtrim($roleAStr, ",");
    }
    if ($_POST ['roleB']) {
        $roleBArr = array_unique($_POST ['roleB']);
        foreach ($roleBArr as $val) {
            $roleBStr .= "'" . $val . "',";
        }
        $roleBStr = rtrim($roleBStr, ",");
    }
    $extArr = array(
        ":month" => $month,
        ":unitID" => $unitID
    );
    switch ($type) {
        //1. 本人间不同项目的调账(只有单位的欠款部分)
        case "1" :
            $errSql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID=b.uID where a.month like :month and a.type like '3' and a.uID in ($roleAStr)";
            $errRet = SQL($pdo, $errSql, array(
                ":month" => $month
            ));
            $errRet = keyArray($errRet, "uID");
            $exSql = "select * from a_prsRequireMoney where unitID like :unitID and month like :month and uID in ($roleBStr) and type = '1' ";
            $exRet = SQL($pdo, $exSql, $extArr);
            $exRet = keyArray($exRet, "uID");
            $sql = " select * from a_editAccountList where unitID like :unitID and  month like :month and type = '$type' and roleB in ($roleBStr)  and status ='1' ";
            $ret = SQL($pdo, $sql, $extArr);
            $ret = keyArray($ret, "roleA");
            foreach ($ret as $key => $val) {
                //获取需要调整的字段,a_prsRequireMoney表里的
                $field = $fieldArr = $editAccountTotal = $accountTotal = $ac = $upStr = $inStr = null;
                $field = explode("|", $val ['field']);
                $field = array_filter($field);
                foreach ($field as $fVal) {
                    $accountTotal += $exRet [$val ['roleB']] [$fVal];
                    $fieldArr [$fVal] = $exRet [$val ['roleB']] [$fVal];
                }
                foreach ($val as $k => $v) {
                    switch ($k) {
                        case "uPDInsMoney" :
                        case "uSoInsMoney" :
                        case "uHFMoney" :
                        case "uComInsMoney" :
                        case "managementCostMoney" :
                        case "uOtherMoeny" :
                            if ($v != 0) {
                                $editAccountTotal += $v;
                                if ($errRet && array_key_exists($key, $errRet)) {
                                    $v = $v + $errRet [$key] [$k];
                                    $inStr .= "`$k`='$v',";
                                } else {
                                    $inStr .= "`$k`='$v',";
                                }
                            }
                            break;
                        default :
                            break;
                    }
                }
                $mar = round(($editAccountTotal - $accountTotal), 2);
                if ($mar > 0) {
                    $errMsg [] = ($editAccountTotal [$val ['roleB']] - $accountTotal) . "调整失败,请核实'挂账额度'>'调整的额度'?";
                    break;
                } else {
                    asort($fieldArr);
                    $ac = recursionSub($fieldArr, $editAccountTotal);
                    foreach ($ac as $akey => $aval) {
                        $upStr .= "`$akey`='$aval',";
                    }
                    //更新挂账明细,注意下,因为这个是本人间的调账,所以可以这样写,每个被调整人只对应一条挂账数据,
                    $upStr = rtrim($upStr, ",");
                    $inStr = rtrim($inStr, ",");
                    $updateSql [] = "update `a_prsRequireMoney` set $upStr where `uID`='$val[roleB]' and type ='1' and unitID like '$unitID' and month like '$month'";
                    if ($errRet && array_key_exists($key, $errRet)) {
                        $upReSql [$val ['roleA']] = "update `a_prsRequireMoney` set  $inStr  where `ID`='" . $errRet [$key] ['ID'] . "' ";
                    } else {
                        //增加收回欠款记录
                        $insertSql [] = "insert into `a_prsRequireMoney` set  $inStr ,`month`='$month',`unitID`='$unitID',`uID`='$val[roleA]',`type`='3' ";
                    }
                    $confirmSql [] = "update a_editAccountList set `confirmStatus`='1' where `ID`='$val[ID]'";
                }
            }
            $actionSql = mergeArray($updateSql, $upReSql, $insertSql, $confirmSql);
            break;
        // 2. 调账给他人	(只有单位的欠款部分)
        case "2" :
            #查找本月内已经调整的相关数据
            $errSql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID=b.uID where a.month like :month and a.type like '3' and a.uID in ($roleAStr)";
            $errRet = SQL($pdo, $errSql, array(
                ":month" => $month
            ));
            $errRet = keyArray($errRet, "uID");
            #获取被调整人相关
            $exSql = "select * from a_prsRequireMoney where unitID like :unitID and month like :month and uID in ($roleBStr) and type = '1' ";
            $exRet = SQL($pdo, $exSql, $extArr);
            $exRet = keyArray($exRet, "uID");
            #获取调整方法
            $sql = " select * from a_editAccountList where unitID like :unitID and  month like :month and type = '$type' and roleB in ($roleBStr)  and status ='1'";
            $ret = SQL($pdo, $sql, $extArr);
            $ret = keyArray($ret, "roleA");
            #获取原始费用表相关项,并做调整实收费用
            $oSql = "select ID,month,unitID,uID,soInsDate,comInsDate,salaryDate,HFDate,managementCostDate,zID,uComIns,uPension,uHospitalization,uBirth,uEmploymentInjury,uUnemployment,uPDIns,uHF,managementCost from `a_originalFee_tmp` where unitID like :unitID and  month like :month and uID in ($roleAStr,$roleBStr)";
            $oRet = SQL($pdo, $oSql, $extArr);
            $oRet = keyArray($oRet, "uID");
            #获取员工信息
            $wSql = "select uID,name from `a_workerInfo` where `uID` in ($roleAStr)";
            $wArr = SQL($pdo, $wSql);
            $wArr = keyArray($wArr, "uID");
            $editAccountTotal = null;
            foreach ($ret as $key => $val) {
                //获取需要调整的字段,a_prsRequireMoney表里的
                $field = $upOStr = $uOStr = $iOStr = $fieldArr = $accountTotal = $ac = $upStr = $inStr = null;
                $field = explode("|", $val ['field']);
                $field = array_filter($field);
                foreach ($field as $fVal) {
                    $accountTotal += $exRet [$val ['roleB']] [$fVal];
                    $fieldArr [$fVal] = $exRet [$val ['roleB']] [$fVal];
                }
                foreach ($val as $k => $v) {
                    switch ($k) {
                        case "uPDInsMoney" :
                        case "uSoInsMoney" :
                        case "uHFMoney" :
                        case "uComInsMoney" :
                        case "managementCostMoney" :
                        case "uOtherMoeny" :
                            if ($v != 0) {
                                #更新a_prsRequireMoney
                                $editAccountTotal [$val ['roleB']] += $v;
                                if ($errRet && array_key_exists($key, $errRet)) {
                                    $pV = $v + $errRet [$key] [$k];
                                    $inStr .= "`$k`='$pV',";
                                } else {
                                    $inStr .= "`$k`='$v',";
                                }
                                #更新费用表的实收
                                $k = substr($k, 0, -5);
                                if ($k == "uSoIns")
                                    $k = "uPension";
                                if (array_key_exists($key, $oRet)) {
                                    $oV = 0;
                                    $oV = $oRet [$key] [$k] + $v;
                                    $uOStr .= "`$k`='$oV',";
                                } else {
                                    $iOStr .= "`$k`='$v',";
                                }
                            }
                            break;
                        case "pSoInsMoney" :
                        case "pHFMoney" :
                        case "pComInsMoney" :
                            if ($v != 0) {
                                #更新a_prsRequireMoney
                                $editAccountTotal [$val ['roleB']] += $v;
                                if ($errRet && array_key_exists($key, $errRet)) {
                                    $pV = $v + $errRet [$key] [$k];
                                    $inStr .= "`$k`='$pV',";
                                } else {
                                    $inStr .= "`$k`='$v',";
                                }
                            }
                            break;
                        default :
                            break;
                    }
                }
                $mar = round(($editAccountTotal [$val ['roleB']] - $accountTotal), 2);
                if ($mar > 0) {
                    $errMsg [] = ($editAccountTotal [$val ['roleB']] - $accountTotal) . "调整失败,请核实'挂账额度'>'调整的额度'?";
                    break;
                } else {
                    asort($fieldArr);
                    $ac = recursionSub($fieldArr, $editAccountTotal [$val ['roleB']]);
                    foreach ($ac as $akey => $aval) {
                        $upStr .= "`$akey`='$aval',";
                        switch ($akey) {
                            case "uAccount" :
                                break;
                            case "uSoInsMoney" :
                                $upORet = array(
                                    "uPension" => $oRet [$val ['roleB']] ['uPension'],
                                    "uHospitalization" => $oRet [$val ['roleB']] ['uHospitalization'],
                                    "uBirth" => $oRet [$val ['roleB']] ['uBirth'],
                                    "uEmploymentInjury" => $oRet [$val ['roleB']] ['uEmploymentInjury'],
                                    "uUnemployment" => $oRet [$val ['roleB']] ['uUnemployment']
                                );
                                $bc = recursionSub($upORet, ($fieldArr [$akey] - $aval));
                                foreach ($bc as $bkey => $bval) {
                                    $upOStr .= "`$bkey`='$bval',";
                                }
                                break;
                            default :
                                $upOK = substr($akey, 0, -5);
                                $upOV = $oRet [$val ['roleB']] [$upOK] - $fieldArr [$akey] + $aval;
                                $upOStr .= "`$upOK`='$upOV',";
                                break;
                        }
                    }
                    #更新费用表的实收
                    //更新挂账明细,注意下,因为这个是本人间的调账,所以可以这样写,每个被调整人只对应一条挂账数据,
                    $upStr = rtrim($upStr, ",");
                    $inStr = rtrim($inStr, ",");
                    $updateSql [$val ['roleB']] = "update `a_prsRequireMoney` set $upStr ,`sponsorTime`='$now'  where `ID`='" . $exRet [$val ['roleB']] ['ID'] . "'";
                    if ($errRet && array_key_exists($key, $errRet)) {
                        $upReSql [] = "update `a_prsRequireMoney` set  $inStr ,`sponsorTime`='$now'  where `ID`='" . $errRet [$key] ['ID'] . "' ";
                    } else {
                        //增加收回欠款记录
                        $insertSql [] = "insert into `a_prsRequireMoney` set  $inStr ,`sponsorTime`='$now', `month`='$month',`unitID`='$unitID',`uID`='$key',`type`='3' ";
                    }
                    #更新费用表的实收
                    $uOStr = rtrim($uOStr, ",");
                    $upOStr = rtrim($upOStr, ",");
                    //更新调整的响应原始费用表实收
                    if ($uOStr && array_key_exists($key, $oRet))
                        $uOSql [] = "update `a_originalFee_tmp` set $uOStr,`modifyType`='1'  where `ID`='" . $oRet [$key] ['ID'] . "'";
                    if ($iOStr) {
                        $iOSql [] = "insert into `a_originalFee_tmp` set $iOStr `uID`='$key',`modifyType`='1',`name`='" . $wArr [$key] ['name'] . "',`month`='" . $oRet [$val ['roleB']] ['month'] . "',`unitID`='" . $oRet [$val ['roleB']] ['unitID'] . "',`salaryDate`='" . $oRet [$val ['roleB']] ['salaryDate'] . "',`soInsDate`='" . $oRet [$val ['roleB']] ['soInsDate'] . "',`HFDate`='" . $oRet [$val ['roleB']] ['HFDate'] . "',`comInsDate`='" . $oRet [$val ['roleB']] ['comInsDate'] . "',`managementCostDate`='" . $oRet [$val ['roleB']] ['managementCostDate'] . "',`zID`='" . $oRet [$val ['roleB']] ['zID'] . "' ";
                    }
                    //更新被调整的原始费用表实收
                    if ($upOStr)
                        $upOSql [$val ['roleB']] = "update `a_originalFee_tmp` set " . $upOStr . " ,`modifyType`='1' where `ID`='" . $oRet [$val ['roleB']] ['ID'] . "'";
                    $confirmSql [] = "update a_editAccountList set `confirmStatus`='1' where `ID`='$val[ID]'";
                }
            }
            // 			$actionSql = mergeArray ( $upOSql, mergeArray ( $updateSql, $upReSql, $insertSql, $uOSql, $iOSql ), $confirmSql );
            // 去除更新原始费用表的细节
            $actionSql = mergeArray($updateSql, $upReSql, $insertSql, $confirmSql);
            break;
        // 3. 公司挂账	(只有单位的挂账部分)
        case "3" :
            $exSql = "select * from a_prsRequireMoney where unitID like :unitID and month like :month and uID in ($roleBStr) and type = '1' ";
            $exRet = SQL($pdo, $exSql, $extArr);
            $exRet = keyArray($exRet, "uID");
            $sql = " select * from a_editAccountList where unitID like :unitID and  month like :month and type = '$type' and roleB in ($roleBStr)  and status ='1'";
            $ret = SQL($pdo, $sql, $extArr);
            $ret = keyArray($ret, "roleA");
            foreach ($ret as $key => $val) {
                //获取需要调整的字段,a_prsRequireMoney表里的
                $field = $fieldArr = $editAccountTotal = $accountTotal = $ac = $upStr = $inStr = null;
                $field = explode("|", $val ['field']);
                $field = array_filter($field);
                foreach ($field as $fVal) {
                    $accountTotal += $exRet [$val ['roleB']] [$fVal];
                    $fieldArr [$fVal] = $exRet [$val ['roleB']] [$fVal];
                }
                foreach ($val as $k => $v) {
                    switch ($k) {
                        case "uSoInsMoney" :
                        case "uHFMoney" :
                        case "uComInsMoney" :
                        case "managementCostMoney" :
                        case "uOtherMoeny" :
                            if ($v != 0) {
                                $editAccountTotal += $v;
                                $inStr .= "`$k`='$v',";
                            }
                            break;
                        default :
                            break;
                    }
                }
                if ($editAccountTotal > $accountTotal) {
                    $errMsg [] = "调整失败,请核实'挂账额度'>'调整的额度'?";
                    break;
                } else {
                    asort($fieldArr);
                    $ac = recursionSub($fieldArr, $editAccountTotal);
                    foreach ($ac as $akey => $aval) {
                        $upStr .= "`$akey`='$aval',";
                    }
                    //更新挂账明细,注意下,因为这个是本人间的调账,所以可以这样写,每个被调整人只对应一条挂账数据,
                    $upStr = rtrim($upStr, ",");
                    $inStr = rtrim($inStr, ",");
                    $updateSql [$val ['roleA']] = "update `a_prsRequireMoney` set $upStr where `uID`='$val[roleB]' and type ='1' and unitID like '$unitID' and month like '$month'";
                    //增加收回欠款记录
                    $insertSql [$val ['roleA']] = "insert into `a_cAccountList` set  $inStr ,`month`='$month',`unitID`='$unitID',`uID`='$val[roleA]',`type`='1' ";
                    $confirmSql [] = "update a_editAccountList set `confirmStatus`='1' where `ID`='$val[ID]'";
                }
            }
            $actionSql = mergeArray($updateSql, $insertSql, $confirmSql);
            break;
        //4. 明细冲减挂账
        case "4" :
            //已存在的冲减挂账
            $errSql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID=b.uID where a.month like :month and a.type ='4' and a.uID in ($roleAStr)";
            $errRet = SQL($pdo, $errSql, array(
                ":month" => $month
            ));
            $errRet = keyArray($errRet, "uID");
            $reerrSql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID=b.uID where a.month like :month and a.type ='3' and a.uID in ($roleAStr)";
            $reerrRet = SQL($pdo, $reerrSql, array(
                ":month" => $month
            ));
            $reerrRet = keyArray($reerrRet, "uID");
            $exSql = "select * from a_ledger where ID=(select max(ID) as maxID from a_ledger where unitID like :unitID)";
            $exRet = SQL($pdo, $exSql, array(
                ":unitID" => $unitID
            ), 'one');
            $sql = " select * from a_editAccountList where unitID like :unitID and  month like :month and type = '$type' and roleB in ($roleBStr)  and status ='1'";
            $ret = SQL($pdo, $sql, $extArr);
            $ret = keyArray($ret, "roleA");
            $editAccountTotal = 0;
            foreach ($ret as $key => $val) {
                $IDStr .= $val ['ID'] . ",";
                //获取需要调整的字段,a_prsRequireMoney表里的
                $field = $fieldArr = $ac = $upStr = $inStr = $reupStr = $reinStr = $accountTotal = null;
                $field = explode("|", $val ['field']);
                $field = array_filter($field);
                foreach ($field as $fVal) {
                    $accountTotal += $exRet [$fVal];
                    $fieldArr [$fVal] = $exRet [$fVal];
                }
                foreach ($val as $k => $v) {
                    switch ($k) {
                        case "uPDInsMoney" :
                        case "uSoInsMoney" :
                        case "pSoInsMoney" :
                        case "uHFMoney" :
                        case "pHFMoney" :
                        case "uComInsMoney" :
                        case "pComInsMoney" :
                        case "managementCostMoney" :
                        case "uOtherMoeny" :
                            if ($v != 0) {
                                $editAccountTotal += $v;
                                if ($errRet && array_key_exists($key, $errRet)) {
                                    $t = $v + $errRet [$key] [$k];
                                    $upStr .= "`$k`='$t',";
                                } else {
                                    $inStr .= "`$k`='$v',";
                                }
                                if ($reerrRet && array_key_exists($key, $reerrRet)) {
                                    $s = $v + $reerrRet [$key] [$k];
                                    $reupStr .= "`$k`='$s',";
                                } else {
                                    $reinStr .= "`$k`='$v',";
                                }
                            }
                            break;
                        default :
                            break;
                    }
                }
                if ($editAccountTotal > $accountTotal) {
                    $errMsg [] = "调整失败,请核实'挂账额度'<'冲减额度'?";
                    break;
                } else {
                    if ($upStr) {
                        $upReSql [$val ['roleA']] = "update `a_prsRequireMoney` set  $upStr `sponsorTime`='$now'   where `ID`='" . $errRet [$key] ['ID'] . "' ";
                    }
                    if ($inStr) {
                        //增加冲减挂账
                        $insertSql [$val ['roleA']] = "insert into `a_prsRequireMoney` set  $inStr `sponsorTime`='$now', `month`='$month',`unitID`='$unitID',`uID`='$val[roleA]',`type`='4',`status`='1' ";
                    }
                    if ($reupStr) {
                        $reupReSql [$val ['roleA']] = "update `a_prsRequireMoney` set  $reupStr  `sponsorTime`='$now' where `ID`='" . $reerrRet [$key] ['ID'] . "' ";
                    }
                    if ($reinStr) {
                        //增加冲减挂账
                        $reinsertSql [$val ['roleA']] = "insert into `a_prsRequireMoney` set  $reinStr  `sponsorTime`='$now', `month`='$month',`unitID`='$unitID',`uID`='$val[roleA]',`type`='3',`status`='0' ";
                    }
                    $confirmSql [] = "update a_editAccountList set `confirmStatus`='1' where `ID`='$val[ID]'";
                }
            }
            $actionSql = mergeArray($upReSql, $insertSql, $reupReSql, $reinsertSql, $confirmSql);
            break;
        //wholeWD. 整体冲减挂账
        case "wholeWD" :
            $exSql = "select * from a_ledger where ID=(select max(ID) as maxID from a_ledger where unitID like :unitID)";
            $exRet = SQL($pdo, $exSql, array(
                ":unitID" => $unitID
            ));
            if ($exRet [0] ['type'] == '1' && $exRet [0] ['month'] == $month) {
                $errMsg [] = "本月的劳务费的台账已经生成,请先删除本月台账";
            } else {
                $sql = " select * from a_uWriteDownList where unitID like :unitID and  month like :month and  status = '1' ";
                $ret = SQL($pdo, $sql, $extArr);
                $ret = keyArray($ret, "unitID");
                $editAccountTotal = null;
                foreach ($ret as $key => $val) {
                    //获取需要调整的字段,a_prsRequireMoney表里的
                    $field = $fieldArr = $accountTotal = $ac = $upStr = $inStr = null;
                    $field = explode("|", $val ['field']);
                    $field = array_filter($field);
                    foreach ($field as $fVal) {
                        $accountTotal += $exRet [0] [$fVal];
                        $fieldArr [$fVal] = $exRet [0] [$fVal];
                    }
                    $inStr = "`WDMoney`='$val[wholeWD]',";
                    $editAccountTotal = $val ['wholeWD'];
                    if ($editAccountTotal > $accountTotal) {
                        $errMsg [] = "调整失败,请核实'挂账额度'<'冲减额度'?";
                        break;
                    } else {
                        //						asort ( $fieldArr );
                        //						$ac = recursionSub ( $fieldArr, $editAccountTotal );
                        //						foreach ( $ac as $akey => $aval ) {
                        //							$inStr .= "`$akey`='$aval',";
                        //						}
                        //						$inStr = rtrim ( $inStr, "," );
                        //增加台账的冲减记录,这里要改!!!里面的累计挂账项目,不做添加,只添加一个台账的总额进去..
                        $insertSql [] = "insert into `a_ledger` set  $inStr ,`month`='$month',`unitID`='$unitID',`type`='1' ";
                        $confirmSql [] = "update a_uWriteDownList set `confirmStatus`='1' where `ID`='$val[ID]'";
                    }
                }

                //	下面把插入a_ledger记录去掉,等台账生成的时候再生成	$actionSql = mergeArray ( $insertSql, $confirmSql );
                $actionSql = $confirmSql;
            }
            break;
    }
    // 	print_r ( $actionSql );
    if (!$errMsg) {
        $actionSql = array_filter($actionSql);
        $result = transaction($pdo, $actionSql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            //删除 prsRequireMoney表中的数据全为0 的记录
            //             delPrsMoney($pdo);
            $succMsg = "审核成功";
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
#修改社保审批通过时,出现的商保,管理费欠款问题
if ($_POST ['btn'] == "feeApprovalEditBtn") {
    list ($ID, $field) = explode("|", $_POST ['ID']);
    $value = $_POST ['value'];
    if ($value > 0) {
        $errMsg = "这里只能填写负数";
    } else {
        $upSql [0] = " update `a_editAccountList` set `$field`='$value',`receiverName`='$mName',`receiveTime`='$now' where `ID`='$ID'";
        $result = transaction($pdo, $upSql);
        $errMsg = $result ['error'];
        if (empty ($errMsg)) {
            $succMsg = "修改成功";
        }
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#把离职工资添加至台账
if ($_POST ['btn'] == "addToLedgerBtn") {
    $unitID = $_POST ['unitID'];
    $month = $_POST ['month'];
    $extraBatch = $_POST ['extraBatch'];
    #
    $sql = "select sum(totalFee) as totalFee from a_dimissionSalary where month like '$month' and unitID like '$unitID' and extraBatch like '$extraBatch' ";
    $ret = SQL($pdo, $sql);
    #上月累计挂账/欠款
    $sumMoneySql = "select sumAccount,sumMoney from a_ledger where  ID=(select max(ID) as maxID from a_ledger where unitID like :unitID and (sumAccount<>0 or sumMoney <>0))";
    $sumMoneyRet = SQL($pdo, $sumMoneySql, array(
        ":unitID" => $unitID
    ), 'one');
}
?>