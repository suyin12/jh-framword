<?php

/*
 *  worker内的各种数据库操作
 * 
 * 关于社保信息添加,乱七八糟的的 还要改
 */
#连接权限验证文件
require_once '../auth.php';
#连接公用函数库
require_once '../common.function.php';

$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
$today = timeStyle("date", "-");

//屏蔽警告性错误
//error_reporting ( E_ALL & ~ (E_NOTICE | E_WARNING) );
#格式化字符串,用于员工信息更新时的社保字符串定义
function formatString($type, $str) {
    switch ($type) {
        case "num" :
            $new = number_format($str, 2);

            break;
        case "oneStr" :
            if (!$str)
                $new = '0';
            break;
    }
    return $new;
}

#自动生成员工ID
if (isset($_POST ['unitID']) && !isset($_POST ['wMG']) && !isset($_POST ['wUP'])) {
    $sql = "select uID from a_workerInfo where unitID like '" . $_POST ['unitID'] . "'";
    //生成UID数组,找到哪个拼音字母开头的数目比较多,然后求这个比较多的最大值
    foreach ($pdo->query($sql) as $row) {
        $uIDArr [] = $row ['uID'];
    }
    foreach ($uIDArr as $uIDV) {
        $newUIDArr [] = str_replace(substr($uIDV, - 5, 5), "", $uIDV);
    }
    $uIDCount = array_count_values($newUIDArr);
    //排序下,,,输出第一个就是最大值了
    arsort($uIDCount);
    $i = 0;
    foreach ($uIDCount as $uIDK => $uIDV) {
        if ($i == 0)
            $MaxuIDStr = $uIDK;
        $i++;
    }

    $sql = "select max(uID) from a_workerInfo where uID like '$MaxuIDStr%' and unitID like '" . $_POST ['unitID'] . "'";
    foreach ($pdo->query($sql) as $row) {
        $uID = ++$row ['max(uID)'];
    }
    if ($_POST ['unitID'] == $_POST ['oldUnitID']) {
        $uID = $_POST ['oldUID'];
    }
    echo $uID;
}

#提交花名册信息(员工入职登记)
if (isset($_POST ['wMG'])) {
    if (!pIDVildator($_POST ['pID'])) {
        echo "添加失败，请校验身份证号码是否正确";
        exit();
    } else {
        $_POST ['pID'] = pIDVildator($_POST ['pID']);
    }
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "radix":
            case "HFRadix":
            case "pHFPer":
            case "uHFPer":
                if ($val == 0) {
                    $_POST[$key] = NULL;
                }
                break;
        }
    }
    //是否购买保险
    if ((($_POST ['radix'] || $_POST ['pension'] || $_POST ['unemployment'] || $_POST ['PDIns'] || $_POST ['hospitalization'] || $_POST ['employmentInjury']) && (!$_POST ['radix'] || !$_POST ['employmentInjury']))) {
        echo "添加失败(缴交基数,工伤为必选项)";
    } else {
        if (($_POST ['HFRadix'] || $_POST ['pHFPer'] || $_POST ['uHFPer']) && (!$_POST ['HFRadix'] || !$_POST ['pHFPer'] || !$_POST ['uHFPer'])) {
            echo "公积金基数,个人比例,单位比例,是必填项";
            exit();
        } elseif ($_POST ['HFRadix'] > 0 && $_POST ['pHFPer'] && $_POST ['uHFPer']) {
            $housingFund = 1;
            $HFModifyDate = $_POST ['HFBuyDate'];
        } else {
            $housingFund = 0;
            $HFModifyDate = NULL;
        }

        if ($_POST ['radix'] && $_POST ['employmentInjury']) {
            $soInsurance = "1";
            $soInsModifyDate = $_POST ['soInsBuyDate'];
        } else {
            $soInsurance = "0";
            $soInsModifyDate = NULL;
        }
        $_POST ['lastModifyDate'] = timeStyle("dateTime");
        $_POST ['sponsorName'] = $_SESSION ['exp_user'] ['mName'];
        foreach ($_POST as $k => $v) {
            if ($k == "tid")
                continue;
            if ($k != "wMG") {
                $sql1 .= $k . ",";
                $sql2 .= "'" . $v . "',";
            }

            if ($v) {
                switch ($k) {
                    case "pID" :
                    case "bID" :
                    case "uID" :
                    case 'sID' :
                    case 'HFID' :
                    case 'photoID' :
                    case 'birthID' :
                        $sql3 .= $k . " like '" . $v . "' or ";
                        break;
                }
            }
        }
        //验证身份证号码,工资账号,员工编号,员工合同编号,员工社保号是否重复
        $sql3 = substr($sql3, 0, - 3);
        $sql = "select name from a_workerInfo where " . $sql3;
        $row = $pdo->query($sql);
        $rc = $row->rowCount();
        if ($rc) {
            foreach ($row as $key => $row) {
                echo "身份证号码/工资账号/社保号/员工编号/公积金号/图像号/广东节育编号与员工<<<<[{$row['name']}]>>>>重复,请重新输入\n";
            }
        } else {
            //插入表单信息(员工花名册信息)
            $sql = "insert into a_workerInfo(";
            $sql1 = substr($sql1, 0, - 1);
            $sql2 = substr($sql2, 0, - 1);
            $sql .= $sql1 . ",soInsurance,soInsModifyDate,housingFund,HFModifyDate)values(" . $sql2 . ",'" . $soInsurance . "','" . $soInsModifyDate . "','" . $housingFund . "','" . $HFModifyDate . "')";
            if ($pdo->exec($sql)) {
                /*
                 *  added by snail
                 */
                $current_date = date('Y-m-d');
                $current_date3monthago = date('Y-m-d', strtotime($current_date) - 90 * 24 * 60 * 60);
                $sql_label_talent = "update a_talent set sign = '4' where name = '" . $_POST ['name'] . "' and sex = '" . $_POST ['sex'] . "' and telephone = '" . $_POST ['mobilePhone'] . "' and createdOn > '" . $current_date3monthago . "' ";

                $ret = $pdo->query($sql_label_talent);
                $rows = $ret->rowCount();
                if ($rows)
                    echo "<<<<<" . $_POST ['name'] . ">>>>>信息添加成功" . "|||" . "人才库中标记状态成功";
                else
                    echo "<<<<<" . $_POST ['name'] . ">>>>>信息添加成功" . "|||" . "人才库中标记状态失败（不影响员工信息的添加）";
            } else {

                echo $sql . "添加失败(1.未选择单位变更员工编号 )";
            }
        }
    }
}
#员工信息更新
if (isset($_POST ['wUP'])) {

    $uID = $_POST ['oldUID'];
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "radix":
            case "HFRadix":
            case "pHFPer":
            case "uHFPer":
                if ($val == 0) {
                    $_POST[$key] = NULL;
                }
                break;
        }
    }
    if (($_POST ['radix'] || $_POST ['pension'] || $_POST ['unemployment'] || $_POST ['PDIns'] || $_POST ['hospitalization'] || $_POST ['employmentInjury']) && (!$_POST ['radix'] || !$_POST ['employmentInjury'])) {

        echo "添加失败(缴交基数,工伤为必选项)";
    } else {
        //POST生成相应的字段名,及其字段值
        if (($_POST ['HFRadix'] || $_POST ['pHFPer'] || $_POST ['uHFPer']) && (!$_POST ['HFRadix'] || !$_POST ['pHFPer'] || !$_POST ['uHFPer'])) {
            echo "公积金基数,个人比例,单位比例,是必填项";
            exit();
        } elseif ($_POST ['HFRadix'] > 0) {
            $housingFund = 1;
            $HFModifyDate = $_POST ['HFBuyDate'];
        } elseif ($_POST ['housingFund'] > 0) {
            $housingFund = 0;
            $HFModifyDate = $today;
        }
        //登记修改记录
        //		$insertSql= "insert into a_workerInfo_history (`uID`,`name`,`pID`,`dID`,`sID`,`HFID`,`bID`,`oldBID`,`photoID`,`birthID`,`status`,`sex`,`nation`,`homeAddress`,`workAddress`,`domicile`,`education`,`role`,`proTitle`,`proLevel`,`marriage`,`mobilePhone`,`telephone`,`spouseName`,`spousePID`,`contact`,`contactPhone`,`school`,`blank`,`type`,`unitID`,`filiale`,`department`,`station`,`mountGuardDay`,`cBeginDay`,`cEndDay`,`radix`,`pension`,`hospitalization`,`employmentInjury`,`unemployment`,`housing`,`PDIns`,`hand`,`soInsurance`,`soInsBuyDate`,`soInsModifyDate`,`housingFund`,`HFRadix`,`pHFPer`,`uHFPer`,`HFBuyDate`,`HFModifyDate`,`comInsurance`,`comInsModifyDate`,`helpCost`,`helpModifyDate`,`managementCost`,`remarks`,`lastModifyDate`,`sponsorName`)select `uID`,`name`,`pID`,`dID`,`sID`,`HFID`,`bID`,`oldBID`,`photoID`,`birthID`,`status`,`sex`,`nation`,`homeAddress`,`workAddress`,`domicile`,`education`,`role`,`proTitle`,`proLevel`,`marriage`,`mobilePhone`,`telephone`,`spouseName`,`spousePID`,`contact`,`contactPhone`,`school`,`blank`,`type`,`unitID`,`filiale`,`department`,`station`,`mountGuardDay`,`cBeginDay`,`cEndDay`,`radix`,`pension`,`hospitalization`,`employmentInjury`,`unemployment`,`housing`,`PDIns`,`hand`,`soInsurance`,`soInsBuyDate`,`soInsModifyDate`,`housingFund`,`HFRadix`,`pHFPer`,`uHFPer`,`HFBuyDate`,`HFModifyDate`,`comInsurance`,`comInsModifyDate`,`helpCost`,`helpModifyDate`,`managementCost`,`remarks`,'$now'`,'$mName' from a_workerInfo where `uID` like '$uID'";
        $insertSql = "insert into a_workerInfo_history select * from a_workerInfo where uID like '$uID'";
        $pdo->query($insertSql);
        $soInsKey = array('radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment', 'housing');
        //生成原始的社保字符串
        $sql = "select radix, pension, hospitalization, employmentInjury, unemployment, housing, PDIns, hand ,soInsBuyDate from a_workerInfo where uID like '" . $uID . "'";
        $res = $pdo->query($sql);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        foreach ($row as $r_k => $r_v) {
            switch ($r_k) {
                case "radix" :
                case "pension" :
                case "hospitalization" :
                case "employmentInjury" :
                case "unemployment" :
                case "housing" :
                    if (!$r_v) {
                        $r_v = '0';
                    }

                    $oldSoIns .= $r_v;
                    break;
                case "PDIns" :
                    if (!$r_v) {
                        $r_v = '0';
                    }
                    break;
            }
            $oldRadix = $row ['radix'];
            $oldSoInsBuyDate = $row ['soInsBuyDate'];
        }
        //构造新的社保字符串
        foreach ($soInsKey as $v) {
            switch ($v) {
                case "radix" :
                    $newSoIns .= number_format($_POST [$v], 2, ".", "");
                    break;
                default :
                    if (!$_POST [$v]) {
                        $_POST [$v] = '0';
                    }
                    $newSoIns .= $_POST [$v];
                    break;
            }
        }
        if ($oldSoIns == $newSoIns) {
            //等于空 是为了让下面的update语句,不更新soInsModifyDate字段
            $_POST ['soInsModifyDate'] = NULL;
        } else {
            $_POST ['soInsModifyDate'] = date("Ymd", $time);
            //判断是新增社保或者是修改社保的
            if ($oldRadix != 0) {
                $_POST ['soInsurance'] = "2";
            } else {
                $_POST ['soInsurance'] = "1";
            }
        }
        if ($_POST ['soInsBuyDate'] != $oldSoInsBuyDate) {
            $_POST ['soInsModifyDate'] = $_POST ['soInsBuyDate'];
        }
        $_POST ['housingFund'] = $housingFund;
        if ($HFModifyDate)
            $_POST ['HFModifyDate'] = $HFModifyDate;
        $_POST ['lastModifyDate'] = timeStyle("dateTime");
        $_POST ['sponsorName'] = $_SESSION ['exp_user'] ['mName'];
        $_POST ['PDIns'] = $_POST ['PDIns'] ? $_POST ['PDIns'] : 0;
        $_POST ['comInsurance'] = $_POST ['comInsurance'] ? $_POST ['comInsurance'] : 0;
        $_POST ['helpCost'] = $_POST ['helpCost'] ? $_POST ['helpCost'] : 0;
        //POST生成相应的字段名,及其字段值
        foreach ($_POST as $k => $v) {
            switch ($k) {
                case "pID" :
                case "bID" :
                case 'sID' :
                case 'HFID' :
                case 'spID':
                case 'photoID' :
                case 'birthID' :
                    if ($v)
                        $sql3 .= $k . " like '" . $v . "' or ";
                    $sql1 .= $k . "='" . $v . "',";
                    break;
                case 'wUP' :
                case 'oldUnitID' :
                case 'oldUID' :
                case 'oldSoIns' :
                case "uID" :
                    break;
                case 'comInsurance' :
                case 'helpCost' :
                case "pension" :
                case "hospitalization" :
                case "employmentInjury" :
                case "unemployment" :
                case "housing" :
                case "PDIns" :
                    if (!$v)
                        $v = 0;
                    $sql1 .= $k . "='" . $v . "',";
                    break;
                case "soInsModifyDate" :
                    if ($v)
                        $sql1 .= $k . "='" . $v . "',";
                    break;
                default :
                    $sql1 .= $k . "='" . $v . "',";
                    break;
            }
        }
        //验证身份证号码,工资账号,员工编号,员工合同编号,员工社保号是否重复
        $sql3 = substr($sql3, 0, - 3);
        $rc = 0;
        if ($sql3) {
            $sql = "select name from a_workerInfo where ( " . $sql3 . " )and uID<>'" . $uID . "'";
            $row = $pdo->query($sql);
            $rc = $row->rowCount();
        }
        if ($rc) {
            foreach ($row as $key => $row) {
                echo "身份证号码/工资账号/社保号/公积金号/特定编号/计划生育编号/图像号与员工<<<<[{$row['name']}]>>>>重复,请重新输入\n";
            }
        } else {

            //插入表单信息(员工花名册信息)
            $sql = "update a_workerInfo set ";
            $sql1 = substr($sql1, 0, - 1);
            $sql .= $sql1;
            $sql .= " where uID like '" . $_POST ['oldUID'] . "' and `status`!='0'";

            if ($pdo->exec($sql) > 0) {

                echo "\n<<<<<" . $_POST ['name'] . ">>>>>信息更新成功";
            } else {
                echo "\n更新失败(1.信息未变更 2. 该员工是离职状态 )";
            }
        }
    }
}
#修改员工信息
if ($_POST ['btn'] == "wChangeBtn") {
    list ( $uID, $field ) = explode("|", $_POST ['ID']);
    $value = $_POST ['value'];
    switch ($field) {
        case "pID" :
        case "bID" :
        case 'sID' :
        case 'HFID' :
        case 'spID':
        case 'photoID' :
        case 'birthID' :
            if ($value):
                $sql = "select name from a_workerInfo where   " . $field . " like '" . $value . "' and uID<>'$uID' ";
                $row = $pdo->query($sql);
                $rc = $row->rowCount();
                foreach ($row as $key => $row) {
                    $errMsg =  "与<<<<[{$row['name']}]>>>>重复,请重新输入";
                }
            endif;
            break;
    }
    $engToChs = array_merge( engTochs(),wInfoExtraFieldSet());
    $modifyRemarks="修改: ".$engToChs[$field];
    if (!$errMsg) {
        $upSql[0] = "insert into a_workerInfo_history select * from a_workerInfo where uID like '$uID'";
        $upSql[1] = " update `a_workerInfo` set `$field`='$value',`sponsorName`='$mName',`lastModifyDate`='$now',`modifyRemarks`='$modifyRemarks' where `uID`='$uID'";
        $result = transaction($pdo, $upSql);
        $errMsg = $result ['error'];
        if (empty($errMsg)) {
            $succMsg = "修改成功";
        }
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#修改员工离职信息
if ($_POST ['btn'] == "wDimissionChangeBtn") {
	list ( $uID, $field,$ID ) = explode("|", $_POST ['ID']);
	$value = $_POST ['value'];
	if(isDate($value,"Y-m-d")==false)
		$errMsg="输入的日期格式有误: ".$value;
	$engToChs = array_merge( engTochs(),wInfoExtraFieldSet());
	$modifyRemarks="修改: ".$engToChs[$field];
	if (!$errMsg) {
		$upSql[0] =" insert into a_workerInfo_history select * from a_workerInfo where uID like '$uID'";
		$upSql[1] =" update `a_workerInfo` set `$field`='$value',`sponsorName`='$mName',`lastModifyDate`='$now',`modifyRemarks`='$modifyRemarks' where `uID`='$uID'";
		$upSql[2] =" update `a_dimission` set dimissionDate='".$value."',`createdBy`='".$mID."',`createdOn`='".$now."' where `ID`=".$ID;
		$result = transaction($pdo, $upSql);
		$errMsg = $result ['error'];
		if (empty($errMsg)) {
			$succMsg = "修改成功";
		}
	}
	$msg = array("error" => $errMsg, "succ" => $succMsg);
	$msg = array_filter($msg);
	$js_msg = json_encode($msg);
	echo $js_msg;
}
//;
#页面wChangeSurvery.php 更新社保信息
if ($_POST ['update'] == "wCS" && $_POST ['btn'] == "soBtn") {
    $today = date("Ymd", $time);
    $uID = $_POST ['soCheck'];
    foreach ($uID as $uK => $uV) {
        if ($_POST ['radix'] [$uK] == 0) {
            $_POST ['radix'] [$uK] = NULL;
        }
        if ($_POST ['radix'] [$uK] && $_POST ['employmentInjury'] [$uK]) {
            $sql [$uK] = "update a_workerInfo set ";
            foreach ($_POST as $pK => $pV) {
                switch ($pK) {
                    case "radix" :
                    case "pension" :
                    case "hospitalization" :
                    case "employmentInjury" :
                    case "unemployment" :
                    case "housing" :
                    case "PDIns" :
                    case "hand" :
                        if (!$pV [$uK])
                            $pV [$uK] = '0';
                        $sqlV [$uK] .= $pK . "= '" . $pV [$uK] . "',";
                        break;
                }
            }
            $sql [$uK] = $sql [$uK] . $sqlV [$uK] . " soInsurance='1',soInsModifyDate=$today where uID like '" . $uV . "'";
        } else {
            $errMsg [] = "员工编号为{" . $uV . "}的社保基数,养老,工伤为必填项\n";
        }
    }

    //如果基本的社保验证没有错误的话,就进行事务处理,所有更新成功为成功
    if (!$errMsg) {
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        $succNum = $result ['num'];

        if (empty($errMsg ['sql'])) {
            $succMsg ["num"] = "成功新增社保" . $succNum . "人";
        }
    }
    $errMsg = array_filter($errMsg);
    $succMsg = array_filter($succMsg);
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#页面wChangeSurvery.php 更新15-19号社保信息
if ($_POST ['update'] == "wCS" && $_POST ['btn'] == "spSoBtn") {
    $spTime = date("Ym", strtotime($_POST ['spTime']));
    $d = timeStyle("d");
    if ($d > insuranceInTurn("soIns")) {
        $m = date("Ym", strtotime(timeStyle("Ym") . "+1 month"));
    } else {
        $m = timeStyle("Ym", "");
    }
    if ($m != $spTime) {
        $errMsg [] = "无法完成停保,操作日期已过期";
    } else {
        $batch = "So." . $spTime;
        $sponsorName = $_SESSION ['exp_user'] ['mName'];
        $sponsorTime = date("Y-m-d H:i:s", $time);
        $today = date("Y-m-d", $time);
        $uID = $_POST ['spSoCheck'];
        $unitID = $_POST ['unitIDArr'];
        $extraBatch =90;
        $exSql ="select max(extraBatch) as extraBatch from a_soInsList where sponsorName like '$sponsorName' and soInsModifyDate='$today' and extraBatch>89 limit 1";
        $exRet = SQL($pdo, $exSql,NULL,'one');
        if($exRet['extraBatch']){
        	$extraBatch=$exRet['extraBatch']+1;
        }
        $soInsKey = array('radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment', 'housing', 'PDIns', 'soInsModifyDate');
        foreach ($uID as $uK => $uV) {
            if ($_POST ['radix'] [$uK] == 0) {
                $_POST ['radix'] [$uK] = NULL;
            }
            if ($_POST ['radix'] [$uK] && $_POST ['employmentInjury'] [$uK]) {
                $sql [$uK] = "update a_workerInfo set ";
                foreach ($soInsKey as $pV) {
                    if (!$_POST [$pV] [$uK])
                        $_POST [$pV] [$uK] = '0';
                    $sqlV [$uK] .= $pV . "= '" . $_POST [$pV] [$uK] . "',";
                }
                $sql [$uK] = $sql [$uK] . $sqlV [$uK] . " soInsurance='1',sponsorName='$sponsorName',lastModifyDate='$sponsorTime' where uID like '" . $uV . "'";
                $insertStr .= "('$uV','$unitID[$uK]','$today','0','2','$batch','$extraBatch','$sponsorName','$sponsorTime'),";
            } else {
                $errMsg [] = "员工编号为{" . $uV . "}的社保基数,养老,工伤为必填项\n";
            }
        }
        //这里把extraBatch 设置成90，因为一天中不可能有90批申报名单....如果一天多次报表,则extraBatch随之增加
        $fieldStr = "uID,unitID,soInsModifyDate,soInsurance,status,batch,extraBatch,sponsorName,sponsorTime";
        $insertStr = rtrim($insertStr, ",");
        $sql ['insert'] = " insert into a_soInsList (" . $fieldStr . ")values" . $insertStr;
    }
    //如果基本的社保验证没有错误的话,就进行事务处理,所有更新成功为成功
    if (!$errMsg) {
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        $succNum = $result ['num'];
        if (empty($errMsg ['sql'])) {
            $succMsg ["num"] = "操作成功";
            $succMsg = array_filter($succMsg);
        }
    }
    if ($errMsg)
        $errMsg = array_filter($errMsg);
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#页面wChangeSurvery.php 更新商保信息
if ($_POST ['update'] == "wCS" && $_POST ['btn'] == "comBtn") {

    $today = date("Ymd", $time);
    $uID = $_POST ['comCheck'];
    foreach ($uID as $uK => $uV) {
        $sql [$uK] = "update a_workerInfo set comInsurance = '1' ,comInsModifyDate = $today ";
        $sqlV [$uK] = " where uID like '" . $uV . "'";
        $sql [$uK] = $sql [$uK] . $sqlV [$uK];
    }
    //进行事务处理,所有更新成功为成功
    if (!$errMsg) {
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        $succNum = $result ['num'];
        if (empty($errMsg ['sql'])) {
            $succMsg ["num"] = "成功新增商保" . $succNum . "人";
        }
    }
    $errMsg = array_filter($errMsg);
    $succMsg = array_filter($succMsg);
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#页面editHousingFund.php 更新公积金信息
if ($_POST ['btn'] == "HFBtn") {
    $today = date("Ymd", $time);
    $uID = $_POST ['HFCheck'];
    $sql = "update a_workerInfo set ";
    foreach ($uID as $uK => $uV) {
        $HFModifyDate = NULL;
        foreach ($_POST as $pK => $pV) {
            switch ($pK) {
                case "HFRadix" :
                case "uHFPer" :
                case "pHFPer" :
                    if (is_numeric($pV [$uV]) && $pV [$uV] > 0) {
                        $sqlV [$uK] .= "`" . $pK . "`= '" . $pV [$uV] . "',";
                    }
                    else
                        $errMsg [] = "员工编号为{" . $uV . "}的公积金基数,单位比例,个人比例为必填项\n";
                    break;
                case "HFBuyDate" :
                    if (!isDate($pV[$uV], "Y-m-d"))
                        $errMsg [] = "员工编号为{" . $uV . "}的公积金启用日期格式有误\n";
                    else {
                        $HFModifyDate = $pV [$uV];
                        $sqlV [$uK] .= "`" . $pK . "`= '" . $pV [$uV] . "',";
                    }
                    break;
            }
        }
        $actionSql [] = $sql . $sqlV [$uK] . " `housingFund`='1',`HFModifyDate`='$HFModifyDate',`modifyRemarks`='申报公积金',`sponsorName`='$mName',`lastModifyDate`='$now' where `uID` like '" . $uV . "'";
        $insertSql[] = "insert into a_workerInfo_history select * from a_workerInfo where `uID` like '$uV'";
    }
    //如果基本的社保验证没有错误的话,就进行事务处理,所有更新成功为成功
    if (!$errMsg) {
        transaction($pdo, $insertSql);
        $result = transaction($pdo, $actionSql);
        $errMsg ['sql'] = $result ['error'];
        $succNum = $result ['num'];

        if (empty($errMsg ['sql'])) {
            $succMsg = "提交成功 " . $succNum . "人";
        }
    }
    $errMsg = array_filter($errMsg);

    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#页面wChangeSurvery.php 更新互助会信息
if ($_POST ['update'] == "wCS" && $_POST ['btn'] == "helpBtn") {

    $today = date("Ymd", $time);
    $uID = $_POST ['helpCheck'];
    foreach ($uID as $uK => $uV) {
        $sql [$uK] = "update a_workerInfo set helpCost = '1' ,helpModifyDate = $today ";
        $sqlV [$uK] = " where uID like '" . $uV . "'";
        $sql [$uK] = $sql [$uK] . $sqlV [$uK];
    }
    //进行事务处理,所有更新成功为成功
    if (!$errMsg) {
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        $succNum = $result ['num'];
        if (empty($errMsg ['sql'])) {
            $succMsg ["num"] = "成功新增互助会" . $succNum . "人";
            $succMsg = array_filter($succMsg);
        }
    }
    if ($errMsg)
        $errMsg = array_filter($errMsg);
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#页面createList.php 生成社保清单
if ($_POST ['insert'] == "cL" && $_POST ['btn'] == "soList") {
	//var_dump($_POST);
    //定义发起人,及其发起时间
    $sponsorName = $_SESSION ['exp_user'] ['mName'];
    $sponsorTime = date("Y-m-d H:i:s", $time);
    $unitID = $_SESSION ['exp_user'] ['unitID'];
    //为下面的日期格式做铺垫
    if ($_POST ['currentMon'] && $_POST ['currentDay']) {
        $currentMon = $_POST ['currentMon'];
        $currentDay = $_POST ['currentDay'];
    } else {
        $currentMon = date("Ym", $time);
        $currentDay = date('d', $time);
    }
    $startMon = $currentMon . "01";
    //社保年月界定为,当月20号到次月19号,为一个投保期限..这样生成的目的是避免客户经理提前做入职,但到社保购买日,忘记购买社保的情况(或购买次月社保的情况)...
    // 如果把$eT设定为当前日期的话,则是一种比较正规的操作方法,但是这就可能造成为购买次月社保的情况
    if ($currentDay <= insuranceInTurn("soIns")) {
        $mon = $currentMon;
        $bT = date("Ym", strtotime("$startMon -1 month")) . (insuranceInTurn("soIns") + 1);
        $eT = $currentMon . insuranceInTurn("soIns");
    } else {
        $mon = date("Ym", strtotime("$startMon +1 month"));
        $bT = $currentMon . (insuranceInTurn("soIns") + 1);
        $eT = date("Ym", strtotime("$startMon +1 month")) . insuranceInTurn("soIns");
    }

    //	#先查找出本月到当前日期为止,应该缴社保的人员名单(条件 : 本段时间段内,该客户经理所管辖员工的一切社保状态)
    //	//同一个天内,不同的员工编号的人员社保信息(不同天也包含在内)
    //	$sql ["diff"] = "select x.uID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.housing,x.PDIns,x.hand,y.ID,y.status from a_workerInfo x left join a_soInsList y on (x.uID=y.uID and x.soInsModifyDate= y.soInsModifyDate  )where  x.unitID in ($unitID) and x.status in (1,2) and x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is null ";
    //	//同一个天内(防止同一天内多次修改社保状态的问题),相同员工编号的社保信息处理(1.未签收则update,2.签收则insert 注意的是:社保专题要为2)
    //	$sql ["same"] = "select x.uID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.housing,x.PDIns,x.hand,y.ID,y.status from a_workerInfo x left join a_soInsList y on (x.uID=y.uID )where  x.unitID in ($unitID) and x.status in (1,2) and x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is not null and x.soInsurance like '2' ";
    //	//之前月份社保状态未更改,且在职的员工(判断不是在本月,且在职和购买社保即可)
    //	$sql ['unchange'] = "select x.uID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.housing,x.PDIns,x.hand from a_workerInfo x where x.status in (1,2) and x.soInsurance in (1,2) and x.unitID in ($unitID) and x.soInsModifyDate < '$bT'";
    #更换了社保的生成方法,首先删除本月未签收数据,然后插入本月应该购买的社保人员名单...这个方法在效率上估计会比上一个方法效率上会高...也就是说可以不用更新操作来麻烦了..再者上面那个社保生成名单也是错误的...
    //删除本客户经理,本月未签收的数据(这里不限定月份的原因是,因为每批数据社保专员那边必需跟进,签收然后做网上申报,一般当天就可以签收了)
    $sql ["delete"] = "delete from a_soInsList where status like '0' and sponsorName like '$sponsorName'  and type='0'";
    //插入语句则是,本月该段时间内,即soInsModifyDate在该段操作时间内,的一切社保行为,无论是新增,修改,停保等...故更社保状态无关
    $sql ['diff'] = "select x.uID as uID,x.unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand,y.status from a_workerInfo x left join a_soInsList y on (x.uID=y.uID and x.soInsModifyDate= y.soInsModifyDate  )where  x.unitID in ($unitID) and x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is null";
    //同一个天内(防止同一天内多次修改社保状态的问题),相同员工编号的社保信息处理(1.未签收被删除2.签收则insert 注意的是:社保专题要为2)
    $sql ["same"] = "select distinct(x.uID) as uID,x.unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand,y.status from a_workerInfo x left join a_soInsList y on (x.uID=y.uID and x.soInsModifyDate= y.soInsModifyDate )where  x.unitID in ($unitID) and x.status in (1,2) and x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is not null and x.soInsurance like '2'  ";
    //同一天离职,入职的情况,也不是特别确定就是了..
    $sql ["same_time"] = " select distinct(x.uID) as uID,x.unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand ,0 as status from a_workerInfo x where x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and x.unitID in ($unitID)and  exists(select 1 from ( select max(y.ID) as ID from  a_soinslist y where y.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.unitID in ($unitID) group by y.uID) s,a_soinslist t where  t.ID=s.ID and x.uID=t.uID and x.soInsurance != t.soInsurance  and t.status =  '1' AND t.soInsurance !=  '2' ) ";
    //同一天修改,同一天离职的情况

  $sql ["same_time2"] = " select distinct(x.uID) as uID,x.unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand,0 as status from a_workerInfo x where x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and x.unitID in ($unitID)and  exists(select 1 from ( select max(y.ID) as ID from  a_soinslist y where y.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.unitID in ($unitID) group by y.uID) s,a_soinslist t where  t.ID=s.ID and x.uID=t.uID and x.soInsurance != t.soInsurance  and t.status =  '1' AND t.soInsurance =  '2' and x.soInsurance = '0' ) ";

    foreach ($sql as $sK => $sV) {
        $res = $pdo->query($sV);
        if ($res)
            $ret [$sK] = $res->fetchAll(PDO::FETCH_ASSOC);
    }
    $insertArr = keyArray($ret ['diff'], "uID");
    foreach ($ret ['diff'] as $rdK => $rdV) {
        $soInsModifyDateArr [] = $rdV ['soInsModifyDate'];
    }
    foreach ($ret ['same'] as $rK => $rV) {
        if ($rV ['status'] == "1") {
            $insertArr [$rV['uID']] = $rV;
            $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
        }
    }
    foreach ($ret ['same_time'] as $rK => $rV) {
        $insertArr [$rV['uID']] = $rV;
        $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
    }
    foreach ($ret ['same_time2'] as $rK => $rV) {
        $insertArr [$rV['uID']] = $rV;
        $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
    }
    if ($soInsModifyDateArr) {
        $soInsModifyDateArr = array_unique($soInsModifyDateArr);
        foreach ($soInsModifyDateArr as $sMDV) {
            $soInsModifyDateStr .= "'" . $sMDV . "',";
        }
        $soInsModifyDateStr = rtrim($soInsModifyDateStr, ",");
        $existsSql = "select max(extraBatch) as eB,soInsModifyDate from a_soInsList where soInsModifyDate in($soInsModifyDateStr) and sponsorName like '$sponsorName' group by soInsModifyDate";
        $existsRes = $pdo->query($existsSql);
        $existsRet = $existsRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($existsRet as $eK => $eV) {
            $extraBatchArr [$eV ['soInsModifyDate']] = ++$eV ['eB'];
        }
    }
//	print_r($insertArr);
    $fieldStr = "uID,unitID,soInsModifyDate,soInsurance,radix, pension, hospitalization, employmentInjury, unemployment, PDIns, hand,status,batch,extraBatch,sponsorName,sponsorTime";
    //构成插入语句
    if ($insertArr) {
        $insertSql = " insert into a_soInsList (" . $fieldStr . ")values";
        foreach ($insertArr as $iV) {

            $iV ['batch'] = "So." . $mon;
            $iV ['extraBatch'] = $extraBatchArr [$iV ['soInsModifyDate']];
            $iV ['sponsorName'] = $sponsorName;
            $iV ['sponsorTime'] = $sponsorTime;
            $iV ['status'] = "0";
            $insertStr .= "(";
            foreach ($iV as $iKey => $iVal) {
                if (!$iVal)
                    $iVal = '0';
                $insertStr .= "'" . $iVal . "',";
            }
            $insertStr = rtrim($insertStr, ",");
            $insertStr .= "),";
        }
        $insertStr = rtrim($insertStr, ",");
        //insert sql
        $actionSql [] = $insertSql . $insertStr;
    }
    extraTransaction($pdo, $actionSql);
    $errMsg = $result ['error'];
    if (empty($errMsg)) {
        $succMsg = "成功生成社保申报名单";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg, "type" => "soIns");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#页面createList.php 生成住房公积金清单
if ($_POST ['insert'] == "cL" && $_POST ['btn'] == "HFList") {

    //定义发起人,及其发起时间
    $sponsorName = $_SESSION ['exp_user'] ['mName'];
    $sponsorTime = date("Y-m-d H:i:s", $time);
    $unitID = $_SESSION ['exp_user'] ['unitID'];
    //为下面的日期格式做铺垫
    if ($_POST ['currentMon'] && $_POST ['currentDay']) {
        $currentMon = $_POST ['currentMon'];
        $currentDay = $_POST ['currentDay'];
    } else {
        $currentMon = date("Ym", $time);
        $currentDay = date('d', $time);
    }
    $startMon = $currentMon . "01";
    if ($currentDay <= insuranceInTurn("HF")) {
        $mon = $currentMon;
        $bT = date("Ym", strtotime("$startMon -1 month")) . ( insuranceInTurn("HF") + 1);
        $eT = $currentMon . insuranceInTurn("HF");
    } else {
        $mon = date("Ym", strtotime("$startMon +1 month"));
        $bT = $currentMon . ( insuranceInTurn("HF") + 1);
        $eT = date("Ym", strtotime("$startMon +1 month")) . insuranceInTurn("HF");
    }

    #更换了公积金的生成方法,首先删除本月未签收数据,然后插入本月应该购买的公积金人员名单...这个方法在效率上估计会比上一个方法效率上会高...也就是说可以不用更新操作来麻烦了..再者上面那个社保生成名单也是错误的...
    //删除本客户经理,本月未签收的数据(这里不限定月份的原因是,因为每批数据公积金专员那边必需跟进,签收然后做网上申报,一般当天就可以签收了)
    $sql ["delete"] = "delete from a_HFList where status like '0' and sponsorName like '$sponsorName' and type='0'";
    //插入语句则是,本月该段时间内,即HFModifyDate在该段操作时间内,的一切社保行为,无论是新增,修改,停保等...故更社保状态无关
    $sql ['diff'] = "select x.uID,x.unitID,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,y.status from a_workerInfo x left join a_HFList y on (x.uID=y.uID and x.HFModifyDate= y.HFModifyDate  )where  x.unitID in ($unitID) and x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is null";
    //同一个天内(防止同一天内多次修改社保状态的问题),相同员工编号的社保信息处理(1.未签收被删除2.签收则insert 注意的是:社保专题要为2)
    $sql ["same"] = "select distinct(x.uID),x.unitID,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,y.status from a_workerInfo x left join a_HFList y on (x.uID=y.uID and x.HFModifyDate= y.HFModifyDate  )where  x.unitID in ($unitID) and x.status in (1,2) and x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is not null and x.housingFund like '2' ";
    foreach ($sql as $sK => $sV) {
        $res = $pdo->query($sV);
        if ($res)
            $ret [$sK] = $res->fetchAll(PDO::FETCH_ASSOC);
    }
    $insertArr = $ret ['diff'];
    foreach ($ret ['diff'] as $rdK => $rdV) {
        $HFModifyDateArr [] = $rdV ['HFModifyDate'];
    }
    foreach ($ret ['same'] as $rK => $rV) {
        if ($rV ['status'] == "1") {
            $insertArr [] = $rV;
            $HFModifyDateArr [] = $rV ['HFModifyDate'];
        }
    }

    if ($HFModifyDateArr) {
        $HFModifyDateArr = array_unique($HFModifyDateArr);
        foreach ($HFModifyDateArr as $sMDV) {
            $HFModifyDateStr .= "'" . $sMDV . "',";
        }
        $HFModifyDateStr = rtrim($HFModifyDateStr, ",");
        $existsSql = "select max(extraBatch) as eB,HFModifyDate from a_HFList where HFModifyDate in($HFModifyDateStr) and sponsorName like '$sponsorName' group by HFModifyDate";
        $existsRes = $pdo->query($existsSql);
        $existsRet = $existsRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($existsRet as $eK => $eV) {
            $extraBatchArr [$eV ['HFModifyDate']] = ++$eV ['eB'];
        }
    }
    //	print_r($extraBatchArr);
    $fieldStr = "uID,unitID,HFModifyDate,housingFund,HFRadix, pHFPer,uHFPer,status,batch,extraBatch,sponsorName,sponsorTime";
    //构成插入语句
    if ($insertArr) {
        $insertSql = " insert into a_HFList (" . $fieldStr . ")values";
        foreach ($insertArr as $iV) {
            if ($iV ['housingFund'] > 0 && ($iV ['pHFPer'] != 0.05 || $iV ['uHFPer'] != 0.05)&& ($iV ['pHFPer'] != 0.06 || $iV ['uHFPer'] != 0.06)&& ($iV ['pHFPer'] != 0.1 || $iV ['uHFPer'] != 0.1)&&($iV ['pHFPer'] != 0.12 || $iV ['uHFPer'] != 0.12)) {
                $errMsg = "报表生成失败;目前派遣员工只开放比例为 5%,6%,10%,12%的公积金(错误:员工编号为:" . $iV ['uID'] . "-单位比例:" . $iV ['uHFPer'] . "-个人比例:" . $iV ['pHFPer'] . ")";
                break;
            } else {
                $iV ['batch'] = "HF." . $mon;
                $iV ['extraBatch'] = $extraBatchArr [$iV ['HFModifyDate']];
                $iV ['sponsorName'] = $sponsorName;
                $iV ['sponsorTime'] = $sponsorTime;
                $iV ['status'] = "0";
                $insertStr .= "(";
                foreach ($iV as $iKey => $iVal) {
                    if (!$iVal)
                        $iVal = '0';
                    $insertStr .= "'" . $iVal . "',";
                }
                $insertStr = rtrim($insertStr, ",");
                $insertStr .= "),";
            }
        }
        $insertStr = rtrim($insertStr, ",");
        //insert sql
        $actionSql [] = $insertSql . $insertStr;
    }
    if (!$errMsg) {
        extraTransaction($pdo, $actionSql);
        $errMsg = $result ['error'];
        if (empty($errMsg)) {
            $succMsg = "成功生成公积金申报名单";
        }
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg, "type" => "HF");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#页面createList.php 生成就业登记清单(引用的操作方法跟社保是一致的,代码也引用社保的)
if ($_POST ['insert'] == "cL" && $_POST ['btn'] == "jobRegList") {

    //定义发起人,及其发起时间
    $sponsorName = $_SESSION ['exp_user'] ['mName'];
    $sponsorTime = date("Y-m-d H:i:s", $time);
    $unitID = $_SESSION ['exp_user'] ['unitID'];
    //为下面的日期格式做铺垫
    if ($_POST ['currentMon'] && $_POST ['currentDay']) {
        $currentMon = $_POST ['currentMon'];
        $currentDay = $_POST ['currentDay'];
    } else {
        $currentMon = date("Ym", $time);
        $currentDay = date('d', $time);
    }
    $startMon = $currentMon . "01";
    //社保年月界定为,当月20号到次月19号,为一个投保期限..这样生成的目的是避免客户经理提前做入职,但到社保购买日,忘记购买社保的情况(或购买次月社保的情况)...
    // 如果把$eT设定为当前日期的话,则是一种比较正规的操作方法,但是这就可能造成为购买次月社保的情况
    if ($currentDay <= insuranceInTurn("soIns")) {
        $mon = $currentMon;
        $bT = date("Ym", strtotime("$startMon -1 month")) . (insuranceInTurn("soIns") + 1);
        $eT = $currentMon . insuranceInTurn("soIns");
    } else {
        $mon = date("Ym", strtotime("$startMon +1 month"));
        $bT = $currentMon . (insuranceInTurn("soIns") + 1);
        $eT = date("Ym", strtotime("$startMon +1 month")) . insuranceInTurn("soIns");
    }

    //删除本客户经理,本月未签收的数据(这里不限定月份的原因是,因为每批数据社保专员那边必需跟进,签收然后做网上申报,一般当天就可以签收了)
    $sql ["delete"] = "delete from a_jobRegList where status like '0' and sponsorName like '$sponsorName'  ";
    //插入语句 新入职的员工
    $sql ['diff'] = "select x.uID,x.unitID,x.jobRegModifyDate as jobRegModifyDate,1,y.status from a_workerInfo x left join a_jobRegList y on (x.uID=y.uID and x.jobRegModifyDate= y.jobRegModifyDate  )where  x.unitID in ($unitID) and x.jobRegModifyDate between '" . $bT . "' and '" . $eT . "' and  y.uID is null and x.status in ('1','2') and x.type='1' and (x.domicile='2' and x.photoID<>'' or x.domicile='1')";
    //离职员工
    $sql ["same"] = "select x.uID,x.lastUnitID as unitID,x.dimissionDate as jobRegModifyDate,0,y.status from a_dimission x left join a_jobRegList y on (x.uID=y.uID and x.dimissionDate= y.jobRegModifyDate  )where  x.lastUnitID in ($unitID)  and x.dimissionDate between '" . $bT . "' and '" . $eT . "' and  y.uID is null ";
    foreach ($sql as $sK => $sV) {
        $res = $pdo->query($sV);
        if ($res)
            $ret [$sK] = $res->fetchAll(PDO::FETCH_ASSOC);
    }
    $insertArr = mergeArray($ret['diff'], $ret['same']);
    foreach ($insertArr as $rdK => $rdV) {
        $jobRegModifyDateArr [] = $rdV ['jobRegModifyDate'];
    }
    if ($jobRegModifyDateArr) {
        $jobRegModifyDateArr = array_unique($jobRegModifyDateArr);
        foreach ($jobRegModifyDateArr as $sMDV) {
            $jobRegModifyDateStr .= "'" . $sMDV . "',";
        }
        $jobRegModifyDateStr = rtrim($jobRegModifyDateStr, ",");
        $existsSql = "select max(extraBatch) as eB,jobRegModifyDate from a_jobRegList where jobRegModifyDate in($jobRegModifyDateStr) and sponsorName like '$sponsorName' group by jobRegModifyDate";
        $existsRes = $pdo->query($existsSql);
        $existsRet = $existsRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($existsRet as $eK => $eV) {
            $extraBatchArr [$eV ['jobRegModifyDate']] = ++$eV ['eB'];
        }
    }
    $fieldStr = "uID,unitID,jobRegModifyDate,jobReg,status,batch,extraBatch,sponsorName,sponsorTime";
    //构成插入语句
    if ($insertArr) {
        $insertSql = " insert into a_jobRegList (" . $fieldStr . ")values";
        foreach ($insertArr as $iV) {

            $iV ['batch'] = "JR." . $mon;
            $iV ['extraBatch'] = $extraBatchArr [$iV ['jobRegModifyDate']];
            $iV ['sponsorName'] = $sponsorName;
            $iV ['sponsorTime'] = $sponsorTime;
            $iV ['status'] = "0";
            $insertStr .= "(";
            foreach ($iV as $iKey => $iVal) {
                if (!$iVal)
                    $iVal = '0';
                $insertStr .= "'" . $iVal . "',";
            }
            $insertStr = rtrim($insertStr, ",");
            $insertStr .= "),";
        }
        $insertStr = rtrim($insertStr, ",");
        //insert sql
        $actionSql [] = $insertSql . $insertStr;
    }
    extraTransaction($pdo, $actionSql);
    $errMsg = $result ['error'];
    if (empty($errMsg)) {
        $succMsg = "成功生成就业登记申报名单";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg, "type" => "jobReg");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#页面createList.php 生成社保,商保,互助会清单
if ($_POST ['insert'] == "cL" && $_POST ['btn'] == "comList") {
    $unitID = $_SESSION ['exp_user'] ['unitID'];
    $sponsorName = $_SESSION ['exp_user'] ['mName'];
    $sponsorTime = date("Y-m-d H:i:s", $time);
    $today = date("d", $time);
    $currentMon = date("Ym", $time);
    $firstDay = $currentMon . "01";
    if ($today < (insuranceInTurn("comIns") + 1)) {
        $comMon = $currentMon;
        $lastDay = date("Ymd", strtotime("$firstDay  -1 day"));
    } else {
        $comMon = date("Ym", strtotime(timeStyle("Ym") . "+1 month"));
        $lastDay = date("Ymd", strtotime("$firstDay +1 month -1 day"));
    }

    //如果今天是月结日的最后三天,才可以做生成报表操作,或者月初3天
//    if ($time > strtotime("$lastDay -4 day") and $time < strtotime("$lastDay +3 day")) {
        $batch = "Com." . $comMon;
        //删除本月未签收数据,重新导入
        $delSql = "delete a.* from a_comInsList a  where a.status <>'1' and a.batch like '$batch' and a.unitID in ($unitID)";
        $pdo->query($delSql);
        //当前在册,且购买商保的,都归结为本月名单
	    $sql = "SELECT x.uID,x.unitID from a_workerinfo x left join (SELECT b.uID from a_cominslist b where b.batch like '$batch') y on x.uID=y.uID where y.uID is null and x.unitID in ($unitID) and x.status in ('1','2') and x.comInsurance like '1' ";
        $res = $pdo->query($sql);
        $ret = $res->fetchAll(PDO::FETCH_ASSOC);
        if ($ret) {
            $insertSql = "insert into a_comInsList (uID,unitID,batch,status,comInsModifyDate,sponsorName,sponsorTime) values ";
            foreach ($ret as $rV) {
                $rV ['batch'] = $batch;
                $rV ['status'] = "0";
                $rV ['comInsModifyDate'] = $currentMon . $today;
                $rV ['sponsorName'] = $sponsorName;
                $rV ['sponsorTime'] = $sponsorTime;
                $insertStr .= "(";
                foreach ($rV as $rVal) {
                    if (!$rVal)
                        $rVal = '0';
                    $insertStr .= "'" . $rVal . "',";
                }
                $insertStr = rtrim($insertStr, ",");
                $insertStr .= "),";
            }
            $insertStr = rtrim($insertStr, ",");
            //insert sql语句
            $actionSql = $insertSql . $insertStr;
            if (!$pdo->query($actionSql)) {
                $errMsg [] = "发生未知错误,请联系管理员";
            } else {
                $succMsg = date("Y年m月", strtotime($comMon . "01")) . "商保名单生成成功";
            }
        }
//    } else {
//        $errMsg [] = "今天是 $today 号,未到月结日期,请于本月最后四天或次月前3天再进行商保清单生成";
//    }

    $msg = array("error" => $errMsg, "succ" => $succMsg, "type" => "comIns");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#续签合同日期修改(1.添加续签记录,2. 更新到员工花名册中,3.必需成功)
if ($_POST ['btn'] == "renewalBtn") {
    $sponsorName = $_SESSION ['exp_user'] ['mName'];
    $sponsorTime = date("Y-m-d H:i:s", $time);
    foreach ($_POST ['renewalCheck'] as $val) {
        $renewalDay = $_POST ['renewalDay'] [$val];
        $helpCost = $_POST ['helpCost'] [$val] ? $_POST ['helpCost'] [$val] : 0;
        $lastCEndDay = $_POST ['cEndDay'] [$val];
//         if (!isDate($renewalDay, "Y-m-d")) {
//             $errMsg [] = "续签合同日期有误,请更正(错误代码:<$renewalDay>";
//         }
        $sql [] = "update a_workerInfo set cEndDay ='$renewalDay',helpCost='$helpCost' where uID like '$val'";
        $insertStr .= "('$val','$lastCEndDay','$renewalDay','$sponsorName','$sponsorTime'),";
    }
    $insertStr = rtrim($insertStr, ",");
    $sql [] = "insert into a_renewalList (`uID`,`lastCEndDate`,`renewalCEndDate`,`sponsorName`,`sponsorTime`) values" . $insertStr;
    if (!$errMsg) {
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty($errMsg ['sql'])) {
            $succMsg = "续签成功";
        }
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "/n";
        }
        $errMsg = $errorMsg;
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

# 员工复职,清楚合同日期等信息
if ($_POST ['btn'] == "reentry") {
    $current_date = date("Y-m-d");
    $uid = $_POST ['uid'];
    // 查询最近一次离职的离职日期和离职原因
    $sql = "select dimissionReason,dimissionDate,createdOn from a_dimission where uID = '" . $uid . "' order by dimissionDate DESC limit 1";
    $ret = $pdo->query($sql);
    $dimission = $ret->fetch(PDO::FETCH_ASSOC);
    if ($dimission ['dimissionReason'] == 2) {
        $error2 = "被辞退的员工不得复职";
    } else if (date("Y-m-d", strtotime($dimission ['createdOn'])) >= $current_date) {
        $error3 = "请至少在离职1天后复职";
    } else {
        $sql = "update a_workerinfo set status = '1', mountGuardDay = '',cBeginDay = '',cEndDay = '',radix = '',
						soInsBuyDate = '',managementCost = 0 where uID = '" . $uid . "'";

        $ret = $pdo->query($sql);
        if ($ret) {
            $rows = $ret->rowCount();
            if ($rows == 1)
                $success = "办理成功，现在跳转到员工入职界面";
            else
                $error = "清空失败";
        } else {
            $fatal = "数据库查询错误";
        }
    }
    $msg = array("error" => $error, "error2" => $error2, "error3" => $error3, "success" => $success, "fatal" => $fatal);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
?>