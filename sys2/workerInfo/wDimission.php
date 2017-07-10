<?php

# 为个人员工办理离职
# 由wManage.php页面提交过来
//验证权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//$smarty->debugging=true;


require_once '../common.function.php';

//收集表单内容
$uID = $_POST ['uID'];
$date = $_POST ['dimissionDate'];
$soInsModifyDate = $_POST['soInsModifyDate'];
$HFModifyDate = $_POST['HFModifyDate'];
$type = $_POST ['dimissionType'];
$reason = $_POST ['dimissionReason'];

//当前日期
$today = timeStyle("date");
$now = timeStyle("dateTime");
$current_user = $_SESSION ['exp_user'] ['mID'];
$current_userName = $_SESSION ['exp_user'] ['mName'];

//查询该员工是否是在职状态，如果是，可以办理离职，否则，不能办理离职
$pdostat = $pdo->prepare("SELECT uID,mountGuardDay,unitID,housingFund FROM a_workerinfo WHERE uID like :uID and status in('1','2')");
$pdostat->execute(array(":uID" => $uID));
$ret = $pdostat->fetch(PDO::FETCH_ASSOC);
$result = $pdostat->rowCount();
// 该员工不是在职状态，不能办理离职
if (!$result) {
    $error = "该员工不是在职状态，不能办理离职";
}elseif ($soInsModifyDate < $today || $HFModifyDate < $today)
    $error = "停保/封存日期不能小于今日日期";
if (!$error) {

    // 将该员工的在职状态，缴交基数，养老，医疗，工伤，失业，住房，残障险，商保，互助会全部清零
    // 将社保更改日期，商保更改日期，互助会更改日期修改为当前日期
    $insertSql = "insert into a_workerInfo_history select * from a_workerInfo where uID like '$uID'";
    $pdo->query($insertSql);
    $sql [0] = "UPDATE a_workerinfo SET 
                                    `dimissionDate`='$date',
                                    status = '0' ,
                                    radix = '0' ,
                                    pension = '0' ,
                                    hospitalization = '0' ,
                                    employmentInjury = '0' ,
                                    unemployment = '0' ,
                                    PDIns = '0' ,
                                    HFRadix = '0' ,
                                    pHFPer= '0' ,
                                    uHFPer= '0' ,
                                    soInsurance = '0' ,
                                    housingFund='0',
                                    comInsurance = '0' ,
                                    helpCost = '0',
                                    soInsModifyDate = '" . $soInsModifyDate . "',";
    //判断之前是否买过公积金
    if ($ret['housingFund'] != 0) {
        $sql[0].="HFModifyDate ='" . $HFModifyDate . "',";
    }
    $sql[0].="comInsModifyDate = '" . $today . "',
					helpModifyDate = '" . $today . "',
					lastModifyDate = '" . $now . "',
					sponsorName = '" . $current_userName . "'
					 WHERE uID like '" . $uID . "'";

    $sql [] = "INSERT INTO a_dimission(uID,entryDate,lastUnitID,dimissionDate,dimissionReason,dimissionRemarks,createdBy,createdOn)
						VALUES('" . $uID . "','" . $ret['mountGuardDay'] . "','" . $ret['unitID'] . "','" . $date . "','" . $type . "','" . $reason . "','" . $current_user . "','" . $now . "')";

//	print_r($sql);
    $result = transaction($pdo, $sql);
    if (!$result ['error'])
        $success = "已成功为该员工办理离职";
    else
        $error = "办理员工失败:" . $result ['error'];
}
$msg = array("error" => $error, "success" => $success);
$msg = array_filter($msg);
$js_msg = json_encode($msg);
echo $js_msg;
?>