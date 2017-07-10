<?php

require_once ('../auth.php');
require_once ('../setting.php');
require_once ('../common.function.php');
require_once ('../templateConfig.php');
require_once '../dataFunction/unit.data.php';

$btn = $_POST ['btn'];
$current_user = $_SESSION ['exp_user'] ['mID'];
$current_date = date('Y-m-d');
$current_time = date('Y-m-d H:i:s');
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
$today = timeStyle("date", "-");
# 原SQL.php的内容
# drDisplay.php 和  drManage.php 使用的


/*
// 列举未来四周的时间，供用户进行时间的选择
$today_w = date('N');
$week_start = time() - ($today_w-1)*24*60*60;
$week_name = array("（一）","（二）","（三）","（四）","（五）","（六）","（日）");
		
for($i = 0; $i < 4 ; $i++ )
{
	$next_four_weeks[] = date("Y-m-d",strtotime(date("Y-m-d",$week_start)) + $i*7*24*60*60);
}
*/
if ($btn == "arrangement") {
    $marketID = $_POST ['marketid'];
    $uid = $_POST ['uid'];
    $arrangementID = $_POST ['arid'];
    $amOrPm = $_POST ['amorpm'];
    $date = $_POST ['date'];
    $planid = $_POST ['planid'] ? $_POST ['planid'] : 0;

    $type = $_POST ['type'];

    if ($type == "insert") {
        $sql = "INSERT INTO a_dailyrecruit(mID, marketID, amOrPm, recruitDate,planID)
					VALUES('" . $uid . "'," . $marketID . ",'" . $amOrPm . "', '" . $date . "'," . $planid . " )";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
    }

    if ($type == "update") {
        $sql = "select mID,planID from a_dailyrecruit where arrangementID = " . $arrangementID;
        $ret = $pdo->query($sql);
        $res = $ret->fetch(PDO::FETCH_ASSOC);

        //if($res['planID'] != $planid)
        if (0) {
            $error2 = "您不能更改不属于该计划的安排";
        }
        else {
            $old_uid = $res ['mID'];
            if (is_exist($old_uid, $uid))
                $exist = "已经存在该人员，无需重复添加";
            else {
                $new_uid = $old_uid . "," . $uid;
                $sql = "UPDATE a_dailyrecruit
							SET mID = '" . $new_uid . "',
								marketID = " . $marketID . ",
								amOrPm = '" . $amOrPm . "',
								recruitDate = '" . $date . "'
								WHERE arrangementID = " . $arrangementID;
                $ret = $pdo->query($sql);
                $rows = $ret->rowCount();
            }
        }
    }

    if ($type == "delete") {
        $sql = "select mID,planID from a_dailyrecruit where arrangementID = " . $arrangementID;
        $ret = $pdo->query($sql);
        $res = $ret->fetch(PDO::FETCH_ASSOC);

        //if($res['planID'] != $planid)
        if (0) {
            $error2 = "您不能更改不属于该计划的安排";
        }
        else {
            $sql = "DELETE FROM a_dailyrecruit WHERE arrangementID = " . $arrangementID;
            $ret = $pdo->query($sql);
            $rows = $ret->rowCount();
        }
    }

    switch ($type) {
        case "insert" :
        case "update" :
            $type_des = "添加";
            break;
        case "delete" :
            $type_des = "删除";
            break;
    }

    if ($rows == 1)
        $success = $type_des . "成功";
    else
        $error = $type_des . "失败";

    $msg = array(
        "error2" => $error2,
        "exist" => $exist,
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "dirAr") {
    $marketID = $_POST ['dir_m'];
    $userID = $_POST ['dir_u'];
    $ampm = $_POST ['dir_a'];
    $date = $_POST ['dir_d'];

    $sql = "select arrangementID,mID from a_dailyrecruit where marketID = " . $marketID . " and recruitDate = '" . $date . "' and amOrPm = '" . $ampm . "'";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows > 0) {
        $res = $ret->fetch(PDO::FETCH_ASSOC);
        $old_mID = $res ['mID'];
        $new_mID = $old_mID . "," . $userID;
        $sql = "update a_dailyrecruit
				set mID = '" . $new_mID . "', marketID = " . $marketID . ",amOrPm = '" . $ampm . "', recruitDate = '" . $date . "' where arrangementID = " . $res ['arrangementID'];

        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == 1)
            $success2 = "你选择的场次已经有安排了,现已添加到末尾";
        else
            $error2 = "失败";
    }
    else {
        $sql = "INSERT INTO a_dailyrecruit(mID, marketID, amOrPm, recruitDate,planID)
					VALUES('" . $userID . "'," . $marketID . ",'" . $ampm . "', '" . $date . "',-1 )";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == 1)
            $success = "直接添加成功";
        else
            $error = "失败";
    }
    $msg = array(
        "error2" => $error2,
        "exist" => $exist,
        "error" => $error,
        "success" => $success,
        "success2" => $success2
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 新增人才库记录
// createTalentSign新增人才并提交
if ($btn == "createTalent") {
    // label用来表示是提示重复后的第二次提交，还是首次提交
    $label = $_POST ['label'];
    $name = $_POST ['name'];
    $sex = $_POST ['sex'];
    $idCard = $_POST ['idcard'];
    $education = $_POST ['education'];
    $major = $_POST ['major'];
    $telephone = $_POST ['telephone'];
    $units = $_POST ['unitID'];
    $positionID = $_POST ['positionID'];
    $marketID = $_POST ['marketID'];
    $recruitManagerId = $_POST ['recruitManagerId'];
    $status = $_POST ['status'];
    $updateDate = $_POST ['updateDate'];
    $remarks = $_POST ['remarks'];
    $wantedArea = $_POST ['wantedArea'];
    $lisence = $_POST ['lisence'];

    $sql = "select talentID from a_talent where ( name = '" . $name . "' and telephone = '" . $telephone . "' )
			or (name ='" . $name . "' and idCard != '' and idCard = '" . $idCard . "')";

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows && !$label) {
        $res = $ret->fetch(PDO::FETCH_ASSOC);
        $exist_id = $res ['talentID'];
    }
    else {
        $sql = "INSERT INTO a_talent(name, idCard, sex, education, major, telephone,
					unitID,positionID, recruitManagerId, status,  marketID, wantedArea,lisence ,
					 remarks, createdBy, createdOn) VALUES('" . $name . "','" . $idCard . "','" . $sex . "','" . $education . "','" . $major . "','" . $telephone . "','" . $units . "'," . $positionID . "," . $recruitManagerId . ",'" . $status . "'," . $marketID . ",'" . $wantedArea . "','" . $lisence . "',
					'" . $remarks . "'," . $current_user . ",'" . $current_date . "') ";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows == 1):
            require_once sysPath . "recruitManage/talent.action.php";
            $createUser = new talentAction();
            $talentID = $pdo->lastInsertId();
            $createUser->pdo = $pdo;
            $createUser->talentIDArr = array($talentID);
            $createUser->createWebUser();
            unset($createUser);
            $success = "插入成功";
        else:
            $error = "插入失败";
        endif;
    }
    $msg = array(
        "exist" => $exist_id,
        "success" => $success,
        "error" => $error
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 更新人才
if ($btn == "updateTalent") {
    $talentID = $_POST ['talentID'];
    $name = $_POST ['name'];
    $sex = $_POST ['sex'];
    $idCard = $_POST ['idcard'];
    $education = $_POST ['education'];
    $major = $_POST ['major'];
    $telephone = $_POST ['telephone'];
    $units = $_POST ['unitID'];
    $wantedArea = $_POST ['wantedArea'];
    $positionID = $_POST ['positionID'];
    $marketID = $_POST ['market'];
    $recruitManagerId = $_POST ['recruitManagerId'];
    $createdOn = $_POST ["createdOn"];
    $status = $_POST ['status'];
    $remarks = $_POST ['remarks'];
    $lisence = $_POST ['lisence'];

    $sql = "UPDATE a_talent SET
			name = '" . $name . "',
			idCard = '" . $idCard . "',
			sex = '" . $sex . "',
			education = '" . $education . "',
			major = '" . $major . "',
			telephone = '" . $telephone . "',
			unitID = '" . $units . "',
			wantedArea='" . $wantedArea . "',		
			positionID = " . $positionID . ",
			marketID = " . $marketID . ",
			lisence = '" . $lisence . "',
			recruitManagerId = " . $recruitManagerId . ",
			status = '" . $status . "',
                        createdOn='" . $createdOn . "',
			remarks = '" . $remarks . "',
			`lastModifyTime`='$now'		
			WHERE talentID = " . $talentID;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows == 1) {
        //同时更新网上办公信息中的相关信息,如: 身份证
        require_once sysPath . "recruitManage/talent.action.php";
        $updateWebUser = new talentAction();
        $updateWebUser->pdo = $pdo;
        $updateWebUser->talentIDArr = array($talentID);
        $updateWebUser->updateWebUser("updateBasic");
        unset($updateWebUser);
        $success = "更新成功";
    }
    else
        $error = "更新失败";
    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 处理上岗状态和状态，资料情况，培训情况等
if ($btn == "processOnDuty") {
    $duty_type = $_POST ['type'];
    $talent_array = $_POST ['talents'];
    $talent_num = count($talent_array);
    $talent_str = implode(",", $talent_array);

    $sql = "select talentID from a_talent where status != '3' and talentID in (" . $talent_str . ")";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows) {
        $error2 = "合格状态应为合格才能对该人员进行上岗状态的修改";
    }
    else {

        switch ($duty_type) {
            case 0 :
                $sql = "UPDATE a_talent SET onDuty = 1,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "' WHERE talentID in (" . $talent_str . ")";
                break;
            case 1 :
                $sql = "UPDATE a_talent SET onDuty = 2,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "' WHERE talentID in (" . $talent_str . ")";
                break;
            case 2 :
                $sql = "UPDATE a_talent SET d_material = d_material | 1,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'   WHERE talentID in (" . $talent_str . ")";
                break;
            case 3 :
                $sql = "UPDATE a_talent SET d_material = d_material | 2,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'   WHERE talentID in (" . $talent_str . ")";
                break;
            case 4 :
                $sql = "UPDATE a_talent SET d_material = d_material | 4,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'   WHERE talentID in (" . $talent_str . ")";
                break;
            case 5 :
                $sql = "UPDATE a_talent SET d_material = d_material | 3,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'   WHERE talentID in (" . $talent_str . ")";
                break;
            case 6 :
                $sql = "UPDATE a_talent SET d_material = d_material | 5,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'   WHERE talentID in (" . $talent_str . ")";
                break;
            case 7 :
                $sql = "UPDATE a_talent SET d_material = d_material | 6,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'   WHERE talentID in (" . $talent_str . ")";
                break;
            case 8 :
                $sql = "UPDATE a_talent SET d_material = d_material | 7,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'   WHERE talentID in (" . $talent_str . ")";
                break;

            case 9 :
                $sql = "UPDATE a_talent SET d_train = 1,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'  WHERE talentID in (" . $talent_str . ")";
                break;
            case 10 :
                $sql = "UPDATE a_talent SET d_reference = 1,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'  WHERE talentID in (" . $talent_str . ")";
                break;
            case 11 :
                $sql = "UPDATE a_talent SET d_commit = 1,lastModifiedBy = " . $current_user . ",lastModifyTime = '" . $current_time . "'  WHERE talentID in (" . $talent_str . ")";
                break;
        }

        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows == $talent_num)
            $success = "更新成功";
        else
            $error = "更新失败";
    }

    $msg = array(
        "error2" => $error2,
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "ondutystatus") {
    $status = $_POST ['status'];
    $o_status = $_POST ['otherstatus'];
    $talent_array = $_POST ['talents'];
    $talent_num = count($talent_array);

    if (!$talent_num)
        $error = "您未选择任何记录，无法操作";
    else {
        $talent_str = implode(",", $talent_array);
        if ($status == -1)
            $sql = "update a_talent set onDuty = '" . $o_status . "',sign='2' where talentID in (" . $talent_str . ")";
        else
            $sql = "update a_talent set onDuty = '" . $status . "',sign='2' where talentID in (" . $talent_str . ")";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == 0 || $rows == $talent_num)
            $success = "更新成功";
        else
            $error2 = "更新失败";
    }

    $msg = array(
        "error" => $error,
        "error2" => $error2,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 提交给某个客户经理
if ($btn == "signto") {
    $signto = $_POST ['signToList'];
    $talent_array = $_POST ['talents'];
    $talent_num = count($talent_array);

    if (!$talent_num)
        $error = "您未选择任何记录，无法操作";
    else {
        $talent_str = implode(",", $talent_array);
        $sql = "SELECT talentID,positionID FROM a_talent
				WHERE ( infoValid != 1 or status != 3 or sign != 2 ) and talentID in (" . $talent_str . ")";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows)
            $error2 = "不能提交，类别或者合格状态或者提交状态错误！";
        else {
            $sql = "UPDATE a_talent SET sign = 1,signTime = '" . $current_time . "',signTo = '" . $signto . "',signBy = '" . $current_user . "' WHERE talentID in (" . $talent_str . ")";
            $ret = $pdo->query($sql);
            $rows_a = $ret->rowCount();

            if ($rows_a == $talent_num) {
                $success = "提交成功，共提交 " . $rows_a . " 人";
            }
            else {
                $error3 = "提交失败";
            }
        }
    }

    $msg = array(
        "error" => $error,
        "error2" => $error2,
        "error3" => $error3,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 标记颜色处理
if ($btn == "addcolor") {
    $color_type = $_POST ['type'];
    $talent_array = $_POST ['talents'];
    $talent_num = count($talent_array);
    $talent_str = implode(",", $talent_array);

    $sql = "update a_talent set label = " . $color_type . " where talentID in (" . $talent_str . ")";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    $success = "更新成功";

    $msg = array(
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 将人才从人才库移动到垃圾库或者从垃圾库移动到人才库
if ($btn == "toggleTalents") {
    $talent_array = $_POST ['talents'];
    $talent_num = count($talent_array);

    if (!$talent_num)
        $error2 = "您未选择任何记录，无法操作";
    else {

        $talent_str = implode(",", $talent_array);

        $sql = "UPDATE a_talent SET infoValid = infoValid % 2 + 1 WHERE talentID in (" . $talent_str . ")";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows == $talent_num)
            $success = "更新成功";
        else
            $error = "更新失败";
    }

    $msg = array(
        "error" => $error,
        "error2" => $error2,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 将人才提交到业务部处理
if ($btn == "dorecommend") {
    $talent_array = $_POST ['talents'];
    $talent_num = count($talent_array);

    if (!$talent_num) {
        $error2 = "您未选择任何记录，无法操作";
    }
    else {
        $talent_str = implode(",", $talent_array);
        $sql_a = "SELECT talentID,positionID FROM a_talent
				WHERE ( infoValid != 1 or status != 3 or sign != 2 ) and talentID in (" . $talent_str . ")";
        $ret = $pdo->query($sql_a);
        $rows_a = $ret->rowCount();

        $sql_b .= "SELECT talentID,positionID FROM a_talent where talentID in (" . $talent_str . ") and unitID in ('1000.001','3000.001')";
        $ret = $pdo->query($sql_b);
        $rows_b = $ret->rowCount();
        if ($rows_a) {
            $error = "不能提交，类别或者合格状态或者提交状态错误！";
        }
        else if ($rows_b) {
            $error3 = "特定分配和本部员工请直接提交给客户经理";
        }
        else {

            foreach ($talent_array as $t) {
                $sql_sel = "select unitID from a_talent where talentID = '" . $t . "'";
                $ret = $pdo->query($sql_sel);
                $res = $ret->fetch(PDO::FETCH_ASSOC);
                $mid = manager($pdo, $res ['unitID'], "2_1");
                $sql_upd [] = "UPDATE a_talent SET sign = 1,signTime = '" . $current_time . "',signTo = '" . $mid . "' WHERE talentID = '" . $t . "'";
            }

            $ret = transaction($pdo, $sql_upd);
            if ($ret ['error'])
                $error4 = "事务处理出错：" . $ret ['error'];
            else
                $success = "提交成功，共提交" . $ret ['num'] . "人";
            //print_r($sql_upd);
            //				$sql = "UPDATE a_talent SET sign = 1,signTime = '".$current_time."' WHERE talentID in (" . $talent_str . ")";
            //				$ret = $pdo->query($sql);
            //				$rows_a = $ret->rowCount();
            //
            //				if($rows_a == $talent_num )
            //				{
            //					$success = "提交成功，共提交 ".$rows_a." 人";
            //				}
        }
    }
    $msg = array(
        "error" => $error,
        "error2" => $error2,
        "error3" => $error3,
        "error4" => $error4,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// 招聘需求的签收 或者退回
if ($btn == "dosign") {
    $rbackReason = $_POST ['rbackReason'];
    $demand_array = $_POST ['demands'];
    $demand_num = count($demand_array);
    if ($demand_num == 0) {
        $error3 = "失败: 您未选择任何记录，无法操作";
    }
    else {
        $demand_str = implode(",", $demand_array);

        $sql = "select demandID from a_recruitdemand where status != '1' and demandID in (" . $demand_str . ")";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows) {
            $error2 = "失败: 只能对< 未签收 >的需求做签收或者退回";
        }
        else {
            $sql = "update a_recruitdemand set status = '3',receiverBy='$mID',receiverTime='$now' WHERE demandID in (" . $demand_str . ")";

            $ret = $pdo->query($sql);
            $rows = $ret->rowCount();
            if ($rows == $demand_num)
                $success = "签收成功，共签收" . $rows . "个";
            else
                $error = "签收失败";
        }
    }
    $msg = array(
        "error3" => $error3,
        "error2" => $error2,
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "dounsign") {
    $rbackReason = $_POST ['rbackReason'];
    $demand_array = $_POST ['demands'];
    $demand_num = count($demand_array);
    if ($demand_num == 0) {
        $error3 = "失败: 您未选择任何记录，无法操作";
    }
    else {
        $demand_str = implode(",", $demand_array);

        $sql = "select demandID from a_recruitdemand where status != '1' and demandID in (" . $demand_str . ")";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows) {
            $error2 = "失败:  只能对< 未签收 >的需求做签收或者退回";
        }
        else {
            $sql = "update a_recruitdemand set status = '2',rbackReason = '" . $rbackReason . "'
					 where demandID in (" . $demand_str . ")";

            $ret = $pdo->query($sql);
            $rows = $ret->rowCount();
            if ($rows == $demand_num)
                $success = "退回成功，共退回" . $rows . "个";
            else
                $error = "退回失败";
        }
    }
    $msg = array(
        "error3" => $error3,
        "error2" => $error2,
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#删除需求
if ($btn == "delRequire") {
    $demand_array = $_POST ['demands'];
    $demand_num = count($demand_array);
    if ($demand_num == 0) {
        $error3 = "您未选择任何记录，无法操作";
    }
    else {
        $demand_str = implode(",", $demand_array);
        $sql = "select demandID from a_recruitdemand where status != '2' and demandID in (" . $demand_str . ")";
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows) {
            $error2 = "只能删除 < 退回 >的需求";
        }
        else {
            $sql = "delete from a_recruitdemand  WHERE demandID in (" . $demand_str . ")";

            $ret = $pdo->query($sql);
            $rows = $ret->rowCount();
            if ($rows == $demand_num)
                $success = "删除成功，共" . $rows . "个";
            else
                $error = "删除失败";
        }
    }
    $msg = array(
        "error3" => $error3,
        "error2" => $error2,
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#招聘需求启用及失效
if ($_POST ['btn'] == 'demandAction') {
    list ($demandID, $field, $status) = explode("|", $_POST ['demandID']);
    $updateSql = "update a_recruitdemand set `$field`='$status' where `demandID`='$demandID'";
    $actionSql [0] = $updateSql;
    $result = transaction($pdo, $actionSql);
    $errMsg = $result ['error'];
    if (empty ($errMsg)) {
        $succMsg = "操作成功";
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#人才库管理界面保存备注
if ($btn == "saveremarks") {
    $remarks = $_POST ['value'];
    $talentID = $_POST ['talentID'];
    $sql [0] = "update a_talent set `remarks` = '" . $remarks . "' where `talentID` = '" . $talentID . "'";
    $result = transaction($pdo, $sql);
    if ($result ['error'])
        $error = "处理出错：info:" . $result ['error'];
    else
        $success = "设置成功";
    $msg = array(
        "error" => $error,
        "noSuccMsg" => "yes"
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#电话,复试通知
if ($btn == "remarksType") {
    $field = $_POST ['checkType'];
    $value = $_POST ['ck'];
    $talentID = $_POST ['talentID'];
    $sql [0] = "update a_talent set `$field` = '$value',`lastModifiedBy`='$current_user',`lastModifiedBy`='$current_time' where `talentID` = '" . $talentID . "'";
    $result = transaction($pdo, $sql);
    if ($result ['error'])
        $error = "处理出错：info:" . $result ['error'];
    else
        $success = "设置成功";
    $msg = array(
        "error" => $error,
        "noSuccMsg" => "yes"
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#创建市场
if ($btn == "createMarket") {
    $row = $_POST ['row'];
    $name = $_POST ['name'];
    $district = $_POST ['district'];
    $address = $_POST ['address'];
    $line = $_POST ['line'];
    $openDate = $_POST ['openDate'];
    $openBy = $_POST ['openBy'];
    $period_s = $_POST ['period_s'];
    $period_e = $_POST ['period_e'];
    $fee = $_POST ['fee'];
    $status = $_POST ['status'];
    $area = $_POST ['area'];
    $distance = $_POST ['distance'];
    $other = $_POST ['other'];
    $special = $_POST ['special'];
    $properposition = $_POST ['properposition'];
    $attention = $_POST ['attention'];

    for ($i = 1; $i < $row; $i++) {
        $cName [$i] = $_POST ['cName' . $i];
        $job [$i] = $_POST ['job' . $i];
        $affair [$i] = $_POST ['job' . $i];
        $telephone [$i] = $_POST ['telephone' . $i];
        $mobile [$i] = $_POST ['mobile' . $i];
    }

    $sql = "select marketID from a_market where name = '" . $name . "'";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows)
        $exist = "存在同名的市场，创建市场失败";
    else {
        $sql = "INSERT INTO a_market(name,district,address,status,area,distance,createdBy,createdOn,
				line,openDate,openBy,period_s,period_e,fee,other,special,attention)
				 VALUES('" . $name . "','" . $district . "','" . $address . "','" . $status . "','" . $area . "','" . $distance . "','" . $current_user . "','" . $current_date . "','" . $line . "','" . $openDate . "'," . $openBy . ",'" . $period_s . "','" . $period_e . "','" . $fee . "','" . $other . "','" . $special . "','" . $attention . "')";

        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows == 1) {
            // 只有创建市场成功的时候，才继续创建联系人
            $market_id = $pdo->lastInsertId();
            for ($i = 1; $i < $row; $i++) {
                $contact_sql [] = "insert into a_market_contactinfo(marketid,name,job,affair,mobile,telephone) values(" . $market_id . ",'" . $cName [$i] . "','" . $job [$i] . "','" . $affair [$i] . "','" . $mobile [$i] . "','" . $telephone [$i] . "')";
            }
            $ret = transaction($pdo, $contact_sql);
            if ($ret ['num'] == ($row - 1) && !$ret ['error'])
                $success = "创建市场成功，联系人插入成功" . $ret ['num'] . "条";
            else
                $error1 = "创建市场，但联系人添加失败";
        }
        else
            $error2 = "创建市场失败";
    }
    $msg = array(
        "exist" => $exist,
        "error1" => $error1,
        "error2" => $error2,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "updateMarket") {
    $marketid = $_POST ['marketID'];
    $name = $_POST ['name'];
    $district = $_POST ['district'];
    $address = $_POST ['address'];
    $line = $_POST ['line'];
    $openDate = $_POST ['openDate'];
    $openBy = $_POST ['openBy'];
    $period_s = $_POST ['period_s'];
    $period_e = $_POST ['period_e'];
    $fee = $_POST ['fee'];
    $status = $_POST ['status'];
    $area = $_POST ['area'];
    $other = $_POST ['other'];
    $special = $_POST ['special'];
    $distance = $_POST ['distance'];
    $properposition = $_POST ['properposition'];
    $attention = $_POST ['attention'];

    $sql = "UPDATE a_market SET name = '" . $name . "',district = '" . $district . "',address = '" . $address . "',line = '" . $line . "',openDate = '" . $openDate . "',openBy = '" . $openBy . "',period_s = '" . $period_s . "',period_e = '" . $period_e . "',fee = '" . $fee . "',status = '" . $status . "',area = '" . $area . "',other = '" . $other . "',special = '" . $special . "',distance = '" . $distance . "',properposition = '" . $properposition . "',attention = '" . $attention . "' WHERE marketID = " . $marketid;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows == 1)
        $success = "市场更新成功";
    else
        $error = "市场更新失败";
    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "active") {
    $marketid = $_POST ['marketID'];
    $sql = "update a_market set active = !active where marketID = " . $marketid;
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == 1)
        $success = "更新成功";
    else
        $error = "更新失败";

    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "addmarketcontact") {
    $marketid = $_POST ['marketID'];
    $name = $_POST ['name'];
    $job = $_POST ['job'];
    $affair = $_POST ['affair'];
    $telephone = $_POST ['telephone'];
    $mobile = $_POST ['mobile'];

    $sql = "insert into a_market_contactinfo(marketid,name,job,affair,mobile,telephone)
			values(" . $marketid . ",'" . $name . "','" . $job . "','" . $affair . "','" . $mobile . "','" . $telephone . "')";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == 1)
        $success = "添加成功";
    else
        $error = "添加失败";
    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "createPosition") {
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn" :
            case "positionID" :
                break;
            case "shortcut" :
                if (!$val)
                    $val = pinyinFirstLetter($_POST ['name']);
                else
                    $val = substr($val, 0, 1);
                $conStr .= "`" . $key . "`='" . $val . "',";
                break;
            default :
                $conStr .= "`" . $key . "`='" . $val . "',";
                break;
        }
    }

    $sql = "SELECT positionID FROM a_position WHERE name like '" . $_POST ['name'] . "' and unitId like '" . $_POST ['unitID'] . "'";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows) {
        $exist_error = "存在同名岗位";
    }
    else {
        $sql = "insert into `a_position` set " . $conStr . " `createdBy`='$mID',`createdOn`='$now'";
        $ret = $pdo->query($sql);
        $last_id = $pdo->lastInsertId();
        $rows = $ret->rowCount();
        if ($rows == 1)
            $success = "成功创建岗位";
        else
            $error = "创建岗位失败";
    }

    $msg = array(
        "lastid" => $last_id,
        "exist_error" => $exist_error,
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "updatePosition") {
    $id = $_POST ['positionID'];
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn" :
            case "positionID" :
                break;
            case "shortcut" :
                if (!$val)
                    $val = pinyinFirstLetter($_POST ['name']);
                else
                    $val = substr($val, 0, 1);
                $conStr .= "`" . $key . "`='" . $val . "',";
                break;
            default :
                $conStr .= "`" . $key . "`='" . $val . "',";
                break;
        }
    }
    $sql = "update `a_position` set " . $conStr . " `lastModifyTime`='$now',lastModifyBy='$mID' where  positionID = " . $id;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows == 1)
        $success = "岗位更新成功";
    else
        $error = "岗位更新失败";

    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "updposwithbackup") {
    $id = $_POST ['positionID'];
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn" :
            case "positionID" :
                break;
            case "lastPositionID" :
                if ($val)
                    $lastPositionID = $val . $id . ",";
                else
                    $lastPositionID = "," . $id . ",";
                break;
            case "shortcut" :
                if (!$val)
                    $val = pinyinFirstLetter($_POST ['name']);
                else
                    $val = substr($val, 0, 1);
                $conStr .= "`" . $key . "`='" . $val . "',";
                break;
            default :
                $conStr .= "`" . $key . "`='" . $val . "',";
                break;
        }
    }

    $sql [] = "UPDATE a_position SET active = '0' WHERE positionID = " . $id;
    $sql [] = "insert into a_position set " . $conStr . " `lastPositionID`='$lastPositionID',`createdBy`='$mID',`createdOn`='$now'";
    $ret = transaction($pdo, $sql);

    if ($ret ['error'])
        $error = "更新失败：" . $ret ['error'];
    else
        $success = "更新成功";

    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// FIXME  需求的重复问题，累计问题
if ($btn == "createRequire") {
    $positionID = $_POST ['positionID'];
    $req_num = $_POST ['reqTotal'];
    $deadline = $_POST ['deadline'];

    $res = explode("-", $current_date);
    $deadline_y = $res [0];
    $deadline_m = $res [1];
    $deadline_d = $res [2];

    if ($deadline_d > 20) {
        if ($deadline_m == 12)
            $batch = ($deadline_y + 1) . "01";
        else
            $batch = $deadline_y . sprintf("%02d", ($deadline_m + 1));
    }
    else
        $batch = $deadline_y . sprintf("%02d", $deadline_m);

    $sql = "INSERT INTO a_recruitdemand(batch,positionID,deadline,required,status,createdBy,createdOn)
			VALUES('" . $batch . "'," . $positionID . ",'" . $deadline . "'," . $req_num . ",'1'," . $current_user . ",'" . $current_date . "')";

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows == 1)
        $success = "创建需求成功";
    else
        $error = "创建需求失败";

    $msg = array(
        "success" => $success,
        "error" => $error
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "editrequire") {
    $positionID = $_POST ['positionID'];
    $demandID = $_POST ['demandID'];
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "btn" :
            case "positionID" :
            case "demandID":
                break;
            case "deadline" :
            case "required" :
                $demandConStr .= "`" . $key . "`='" . $val . "',";
                break;
            default :
                $conStr .= "`" . $key . "`='" . $val . "',";
                break;
        }
    }

    $sql = "select * from a_recruitdemand where demandID = '" . $demandID . "' and status in (1,2)";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows) {
        $sql_u [] = "update a_recruitdemand set positionID = '" . $positionID . "'," . $demandConStr . " status = 1,`lastModifyTime`='$now',lastModifyBy='$mID' where demandID = '" . $demandID . "' ";
        $sql_u [] = "update `a_position` set " . $conStr . " `lastModifyTime`='$now',lastModifyBy='$mID' where  positionID = " . $positionID;
        $ret = transaction($pdo, $sql_u);
        if ($ret ['error']) {
            $error2 = "事务处理出错：" . $ret ['error'];
        }
        else {
            $success = "修改成功";
        }
    }
    else {
        $error = "只有未提交或者已退回的需求才能修改";
    }

    $msg = array(
        "success" => $success,
        "error" => $error,
        "error2" => $error2
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "createPlan") {
    $name = $_POST ['name'];
    $requires = $_POST ['requires'];
    $difficulty = $_POST ['difficulty'];
    $ad_poster = $_POST ['ad_poster'];
    $ad_xboard = $_POST ['ad_xboard'];
    $ad_leaflet = $_POST ['ad_leaflet'];
    $ad_market = $_POST ['ad_market'];
    $ad_media = $_POST ['ad_media'];
    $market = $_POST ['market'];
    $period_s = $_POST ['period_s'];
    $period_e = $_POST ['period_e'];
    $leader = $_POST ['leader'];
    $member = $_POST ['member'];
    $bg_adv = $_POST ['bg_adv'];
    $bg_ground = $_POST ['bg_ground'];
    $bg_other = $_POST ['bg_other'];
    $reminder = $_POST ['reminder'];
    $is_urgent = $_POST ['is_urgent'];
    $is_difficult = $_POST ['is_difficult'];
    $is_spend = $_POST ['is_spend'];
    $is_normal = $_POST ['is_normal'];

    $sql = "select id from a_recruitplan where name = '" . $name . "'";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows)
        $exist = "存在同名的计划，请另选择一个名称";
    else {
        if ($requires)
            $requires_str = implode(",", $requires);
        if ($member)
            $member_str = implode(",", $member);
        if ($market)
            $market_str = implode(",", $market);

        if (is_exist($member_str, $leader) || !$market)
            $error2 = "招聘组长和组员有重复 或者 未选择市场";
        else {
            $sql_ins [] = "INSERT INTO a_recruitplan(name,requires,difficulty,ad_poster,ad_xboard,
					ad_leaflet,ad_market,ad_media,period_s,period_e,bg_adv,bg_ground,bg_other,leader,member,market,
					reminder,is_urgent,is_difficult,is_spend,is_normal,createdBy,createdOn)
					values('" . $name . "','" . $requires_str . "','" . $difficulty . "','" . $ad_poster . "','" . $ad_xboard . "','" . $ad_leaflet . "','" . $ad_market . "','" . $ad_media . "','" . $period_s . "','" . $period_e . "','" . $bg_adv . "','" . $bg_ground . "','" . $bg_other . "','" . $leader . "','" . $member_str . "','" . $market_str . "','" . $reminder . "','" . $is_urgent . "','" . $is_difficult . "','" . $is_spend . "','" . $is_normal . "'," . $current_user . ",'" . $current_date . "')";

            //$sql_ins[] = "update a_recruitdemand set status = '3' where demandID in (".$requires_str.")";
            foreach ($requires as $r) {
                $sql_ins [] = "update a_recruitdemand set status = '3' where demandID = " . $r;
            }

            $ret = transaction($pdo, $sql_ins);
            if ($ret ['error'])
                $error = "创建计划失败:" . $ret ['error'];
            else
                $success = "创建计划成功";
        }
    }
    $msg = array(
        "exist" => $exist,
        "success" => $success,
        "error" => $error,
        "error2" => $error2
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "updatePlan") {
    $id = $_POST ['id'];
    $name = $_POST ['name'];
    //	$requires = $_POST['requires'];
    $difficulty = $_POST ['difficulty'];
    $ad_poster = $_POST ['ad_poster'];
    $ad_xboard = $_POST ['ad_xboard'];
    $ad_leaflet = $_POST ['ad_leaflet'];
    $ad_market = $_POST ['ad_market'];
    $ad_media = $_POST ['ad_media'];
    $market = $_POST ['market'];
    $leader = $_POST ['leader'];
    $member = $_POST ['member'];
    $period_s = $_POST ['period_s'];
    $period_e = $_POST ['period_e'];
    $bg_adv = $_POST ['bg_adv'];
    $bg_ground = $_POST ['bg_ground'];
    $bg_other = $_POST ['bg_other'];
    $reminder = $_POST ['reminder'];
    $is_urgent = $_POST ['is_urgent'];
    $is_difficult = $_POST ['is_difficult'];
    $is_spend = $_POST ['is_spend'];

    //	$requires_str = implode(",",$requires);
    $member_str = implode(",", $member);
    $market_str = implode(",", $market);

    $sql = "UPDATE a_recruitplan SET name = '" . $name . "', requires = '" . $requires_str . "', difficulty = '" . $difficulty . "', ad_poster = '" . $ad_poster . "', ad_xboard = '" . $ad_xboard . "', ad_leaflet = '" . $ad_leaflet . "', ad_market = '" . $ad_market . "', ad_media = '" . $ad_media . "', leader = '" . $leader . "', member = '" . $member_str . "', market = '" . $market_str . "', period_s = '" . $period_s . "', period_e = '" . $period_e . "', bg_adv = '" . $bg_adv . "', bg_ground = '" . $bg_ground . "', bg_other = '" . $bg_other . "', reminder = '" . $reminder . "', is_urgent = '" . $is_urgent . "', is_difficult = '" . $is_difficult . "', is_spend = '" . $is_spend . "' WHERE id = " . $id;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows == 1)
        $success = "更新招聘计划成功";
    else
        $error = "更新招聘计划失败";
    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "copyPlan") {
    $id = $_POST ['id'];

    $sql = "select * from a_recruitplan where id = " . $id;

    $ret = $pdo->query($sql);
    $res = $ret->fetch(PDO::FETCH_ASSOC);

    $sql = "INSERT INTO a_recruitplan(name,requires,difficulty,ad_poster,ad_xboard,
				ad_leaflet,ad_market,ad_media,period_s,period_e,bg_adv,bg_ground,bg_other,leader,member,market,
				reminder,is_urgent,is_difficult,is_spend,createdBy,createdOn)
				values('" . $res ['name'] . "(" . time() . ")" . "','" . $res ['requires'] . "','" . $res ['difficulty'] . "','" . $res ['ad_poster'] . "','" . $res ['ad_xboard'] . "','" . $res ['ad_leaflet'] . "','" . $res ['ad_market'] . "','" . $res ['ad_media'] . "','" . $res ['period_s'] . "','" . $res ['period_e'] . "','" . $res ['bg_adv'] . "','" . $res ['bg_ground'] . "','" . $res ['bg_other'] . "','" . $res ['leader'] . "','" . $res ['member_str'] . "','" . $res ['market'] . "','" . $res ['reminder'] . "','" . $res ['is_urgent'] . "','" . $res ['is_difficult'] . "','" . $res ['is_spend'] . "'," . $current_user . ",'" . $current_date . "')";

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == 1)
        $success = "复制成功";
    else
        $error = "复制失败";

    $msg = array(
        "success" => $success,
        "error" => $error
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "createAssess") {
    $subject = $_POST ['subject'];
    $position = $_POST ['position'];
    $period_s = $_POST ['period_s'];
    $period_e = $_POST ['period_e'];
    $salary = $_POST ['salary'];
    $marketPrice = $_POST ['marketPrice'];
    $welfare = $_POST ['welfare'];
    $marketSituation = $_POST ['marketSituation'];
    $intensity = $_POST ['intensity'];
    $problem = $_POST ['problem'];
    $provision = $_POST ['provision'];
    $other = $_POST ['other'];
    $suggestion = $_POST ['suggestion'];

    $proper = $_POST ['proper'];
    $improper = $_POST ['improper'];
    $increase = $_POST ['increase'];

    if ($proper)
        $proper_str = implode(",", $proper);
    if ($improper)
        $improper_str = implode(",", $improper);
    if ($increase)
        $increase_str = implode(",", $increase);

    $sql = "select id from a_marketassess where subject = '" . $subject . "'";

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows)
        $exist = "存在相同标题的评估，请另选一个名称";
    else {

        $sql = "INSERT INTO a_marketassess(subject,position,period_s,period_e,proper,improper,increase,
				salary,marketPrice,welfare,
				marketSituation,intensity,problem,provision,other,suggestion,createdBy,createdOn) 
				VALUES('" . $subject . "','" . $position . "','" . $period_s . "','" . $period_e . "','" . $proper_str . "','" . $improper_str . "','" . $increase_str . "','" . $salary . "','" . $marketPrice . "','" . $welfare . "','" . $marketSituation . "','" . $intensity . "','" . $problem . "','" . $provision . "','" . $other . "','" . $suggestion . "'," . $current_user . ",'" . $current_date . "')";

        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == 1)
            $success = "创建市场评估成功";
        else
            $error = "创建市场评估失败";
    }
    $msg = array(
        "exist" => $exist,
        "success" => $success,
        "error" => $error
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "updateAssess") {
    $id = $_POST ['id'];
    $subject = $_POST ['subject'];
    $position = $_POST ['position'];
    $period_s = $_POST ['period_s'];
    $period_e = $_POST ['period_e'];
    $salary = $_POST ['salary'];
    $marketPrice = $_POST ['marketPrice'];
    $welfare = $_POST ['welfare'];
    $marketSituation = $_POST ['marketSituation'];
    $intensity = $_POST ['intensity'];
    $problem = $_POST ['problem'];
    $provision = $_POST ['provision'];
    $other = $_POST ['other'];
    $suggestion = $_POST ['suggestion'];

    $proper = $_POST ['proper'];
    $improper = $_POST ['improper'];
    $increase = $_POST ['increase'];

    if ($proper)
        $proper_str = implode(",", $proper);
    if ($improper)
        $improper_str = implode(",", $improper);
    if ($increase)
        $increase_str = implode(",", $increase);

    $sql = "UPDATE a_marketassess SET subject = '" . $subject . "',position = '" . $position . "',period_s = '" . $period_s . "',period_e = '" . $period_e . "',salary = '" . $salary . "',marketPrice = '" . $marketPrice . "',welfare = '" . $welfare . "',marketSituation = '" . $marketSituation . "',intensity = '" . $intensity . "',problem = '" . $problem . "',provision = '" . $provision . "',other = '" . $other . "',suggestion = '" . $suggestion . "',proper = '" . $proper_str . "',improper = '" . $improper_str . "',increase = '" . $increase_str . "' WHERE id = " . $id;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows == 1)
        $success = "市场评估更新成功";
    else
        $error = "市场评估更新失败";

    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

# 交资料情况的修改
if ($btn == "materialUpd") {
    $talent_array = $_POST ['talents'];
    $talent_num = count($talent_array);
    $material1 = $_POST ['material1'] ? $_POST ['material1'] : 0;
    $material2 = $_POST ['material2'] ? $_POST ['material2'] : 0;
    $material3 = $_POST ['material3'] ? $_POST ['material3'] : 0;
    // 培训 证明人 交资料到市局 的 表示：1是 2否
    $train = $_POST ['train'] ? $_POST ['train'] : 2;
    $reference = $_POST ['reference'] ? $_POST ['reference'] : 2;
    $commit = $_POST ['commit'] ? $_POST ['commit'] : 2;

    if (!$talent_array)
        $error2 = "您未选择任何人员，无法操作";

    else {
        $talent_str = implode(",", $talent_array);

        if (!$material1 && !$material2 && !$material3)
            $material = "1";
        if ($material1 && !$material2 && !$material3)
            $material = "2";
        if (!$material1 && $material2 && !$material3)
            $material = "3";
        if (!$material1 && !$material2 && $material3)
            $material = "4";
        if ($material1 && $material2 && !$material3)
            $material = "5";
        if ($material1 && !$material2 && $material3)
            $material = "6";
        if (!$material1 && $material2 && $material3)
            $material = "7";
        if ($material1 && $material2 && $material3)
            $material = "8";

        $sql = "update a_talent set d_material = '" . $material . "', d_train = '" . $train . "', d_reference = '" . $reference . "', d_commit = '" . $commit . "' where talentID in (" . $talent_str . ")";

        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == $talent_num || $rows == 0)
            $success = "更新成功";
        else
            $error = "更新失败";
    }
    $msg = array(
        "error" => $error,
        "error2" => $error2,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

# 添加待岗名单备注
if ($btn == "material" || $btn == "unitRemarks" || $btn == "posRemarks" || $btn == "remarksA" || $btn == "remarksB") {
    $talents_arr = $_POST ['talents'];
    $talent_num = count($talents_arr);
    $material = $_POST ['material'];
    $unitRemarks = $_POST ['unitRemarks'];
    $posRemarks = $_POST ['posRemarks'];
    $remarksA = $_POST ['remarksA'];
    $remarksB = $_POST ['remarksB'];

    if (!$talents_arr)
        $error = "您未选择任何人员，无法操作";
    else {
        $talent_str = implode(",", $talents_arr);
        switch ($btn) {
            case "material" :
                $sql = "update a_talent set material = '" . $material . "' where talentID in (" . $talent_str . ")";
                break;
            case "unitRemarks" :
                $sql = "update a_talent set unitRemarks = '" . $unitRemarks . "' where talentID in (" . $talent_str . ")";
                break;
            case "posRemarks" :
                $sql = "update a_talent set posRemarks = '" . $posRemarks . "' where talentID in (" . $talent_str . ")";
                break;
            case "remarksA" :
                $sql = "update a_talent set remarksA = '" . $remarksA . "' where talentID in (" . $talent_str . ")";
                break;
            case "remarksB" :
                $sql = "update a_talent set remarksB = '" . $remarksB . "' where talentID in (" . $talent_str . ")";
                break;
        }
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == $talent_num || $rows == 0)
            $success = "添加成功";
        else
            $error2 = "添加失败";
    }
    $msg = array(
        "error" => $error,
        "error2" => $error2,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "tlEdit") {
    $talent_id = $_POST ['talent'];
    //	$unit_id = $_POST['unitId'];
    //	$pos_id = $_POST['posId'];
    $train = $_POST ['train'];
    $reference = $_POST ['reference'];
    $commit = $_POST ['commit'];
    $posRemarks = $_POST ['posRemarks'];
    $unitRemarks = $_POST ['unitRemarks'];
    $material = $_POST ['material'];
    $remarks_a = $_POST ['remarksA'];
    $remarks_b = $_POST ['remarksB'];

    $sql = "update a_talent set unitRemarks = '" . $unitRemarks . "', posRemarks = '" . $posRemarks . "', d_train = '" . $train . "', d_reference = '" . $reference . "', d_commit = '" . $commit . "', material = '" . $material . "', remarksA = '" . $remarks_a . "', remarksB = '" . $remarks_b . "' where talentID = " . $talent_id;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == 1)
        $success = "成功";
    else
        $error = "失败";
    $msg = array(
        "error" => $error,
        "error2" => $error2,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

# 批量退回
if ($btn == "dobackup") {
    $talents_arr = $_POST ['bctalents'];
    $talent_num = count($talents_arr);
    $bcType = $_POST ['backupReason'];
    $bcReason = $_POST ['backupReasonText'];

    $talents_str = implode(",", $talents_arr);
    if ($bcType == 0) // 另外给出的原因，非原因选项中的
        $sql = "update a_talent set sign = 3, status = '2', backTime = '" . $current_time . "', backReason = '" . $bcReason . "', backBy = " . $current_user . " where talentID in (" . $talents_str . ")";
    else
        // FIXME 等所有系统参数全部存入数据库后，再处理这里，将类型对应的原因写上
        $sql = "update a_talent set sign = 3, status = '2', backTime = '" . $current_time . "', backReason = '" . "原因类型:" . $bcType . "', backBy = " . $current_user . " where talentID in (" . $talents_str . ")";

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == $talent_num || !$rows)
        $success = "批量退回成功";
    else
        $error = "批量退回失败";

    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

/*
 *  这个写的乱七八糟。。。不过还能用。。。
 */
if ($btn == "wlunits") {
    $units_arr = $_POST ['unit'];

    if (!$units_arr) {
        foreach ($units_arr as $u) {
            if ($u < 0)
                echo -2;
        }
    }
    else {
        foreach ($units_arr as $u) {
            if ($u < 0) {
                echo -2;
                exit ();
            }
        }
        $units_num = count($units_arr);
        $units_str = implode(",", $units_arr);
        $sql = "select wltype from a_unitinfo where unitID in(" . $units_str . ") group by wltype ";

        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows != 1)
            echo -1;
        else {
            $res = $ret->fetch(PDO::FETCH_ASSOC);
            /*
             * wltype为待岗名单类型
             */
            $wlType = $res ['wltype'];
            echo $wlType;
        }
    }
}

# 招聘模块参数设置


if ($btn == "setprice") {
    $pos = $_POST ['pos'];
    $price = $_POST ['price'];
    $sql = "update a_position set price = '" . $price . "' where positionID = '" . $pos . "'";

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == 1)
        $success = "设置成功";
    else
        $error = "设置失败";

    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "setallprices") {
    $prices_arr = $_POST ['prices'];

    foreach ($prices_arr as $id => $p) {
        $sql [] = "update a_position set price = '" . $p . "' where positionID = '" . $id . "'";
    }

    $result = extraTransaction($pdo, $sql);
    if ($result ['error'])
        $error = "处理出错：info:" . $result ['error'];
    else
        $success = "设置成功";
    $msg = array(
        "error" => $error,
        "success" => $success
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}


##############
##############
#网上办公相关的操作
##############
##############

#开通/禁用账号

if ($_POST ['btn'] == "activeOrBan") {
    list ($talentID, $status) = explode("|", $_POST ['talentArr']);
    require_once sysPath . "recruitManage/talent.action.php";
    $updateWebUser = new talentAction();
    $updateWebUser->pdo = $pdo;
    $updateWebUser->talentIDArr = array($talentID);
    //已开通则禁用,已禁用则开通
    $status == 1 ? $action = "ban" : $action = "active";
    $result = $updateWebUser->updateWebUser($action);
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
        }
        $errMsg = $errorMsg;
    }
    if (empty ($errMsg)) {
        $succMsg = "操作成功";
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#密码重置
if ($_POST ['btn'] == "resetPW") {
    $talentID =  $_POST ['talentArr'];
    require_once sysPath . "recruitManage/talent.action.php";
    $updateWebUser = new talentAction();
    $updateWebUser->pdo = $pdo;
    $updateWebUser->talentIDArr = array($talentID);
    $result = $updateWebUser->updateWebUser("resetPW");
    $errMsg ['sql'] = $result ['error'];
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
        }
        $errMsg = $errorMsg;
    }
    if (empty ($errMsg)) {
        $succMsg = "操作成功";
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
