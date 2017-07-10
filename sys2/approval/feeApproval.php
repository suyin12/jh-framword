<?php

/*
 *     2010-10-9
 *          <<<  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#通用函数库
require_once '../common.function.php';

$type = $_GET ['type'];
$month = $_GET ['month'];
$unitID = $_GET ['unitID'];
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
$appProID = $_GET ['appProID'];
$mSql = "select mID,mName,groupID,subGroupID,roleID from s_user where `mID` like '$mID'";
$mRes = $pdo->query($mSql);
$mRet = $mRes->fetch(PDO::FETCH_ASSOC);
foreach ($mRet as $mKey => $mVal) {
    switch ($mKey) {
        case "mID" :
            //一个人只有一个mid
            $nSql = $nRes = $nRet = null;
            $nSql = "select  appProID,proID from v_approval_listPro where `curKey` like '$mKey' and `curVal` like '$mVal' and `appProID`='$appProID' and `proStatus`='0' ";
            $nRes = $pdo->query($nSql);
            $nRet = $nRes->fetch(PDO::FETCH_ASSOC);
            break;
        default :
            //获取当一个人多个角色的情况
            if ($mVal) {
                $roRet = explode(",", $mVal);
                foreach ($roRet as $roVal) {
                    if ($roVal) {
                        $nSql = $nRes = $nRet = null;
                        $nSql = "select  appProID,proID from v_approval_listPro where `curKey` like '$mKey' and `curVal` like '$roVal' and `appProID`='$appProID' and `proStatus`='0' ";
                        $nRes = $pdo->query($nSql);
                        $nRet = $nRes->fetch(PDO::FETCH_ASSOC);
                        if ($nRet)
                            break;
                    }
                }
            }
            break;
    }
    if ($nRet)
        break;
}
if ($nRet) {
    //更改签收状态
    $upSql = "update a_editAccountList set status='1',receiverName='$mName',receiveTime='$now' where status='0' and type='$type' and month like '$month' and unitID like '$unitID'";
    $pdo->query($upSql);
}
$listSql = "select a.*,b.typeName from a_approval_list a left join s_approvalPro_set b on a.appID=b.appID where a.appProID like :appProID and a.status != '0'";
$listRes = $pdo->prepare($listSql);
$listRes->execute(array(":appProID" => $appProID));
$listRet = $listRes->fetch(PDO::FETCH_ASSOC);
#获取单位信息表
$unit = unitAll($pdo, " unitID,unitName ");
$typeArr = array("1" => array("name" => "本人费用项目间调整", "url" => httpPath . "salaryManage/editAccountMine.php"), "2" => array("name" => "调账给他人", "url" => httpPath . "salaryManage/editAccountTheir.php"), "3" => array("name" => "公司挂账", "url" => httpPath . "salaryManage/editAccountCompany.php"), "4" => array("name" => "明细冲减挂账", "url" => httpPath . "salaryManage/editWriteDownMoney.php"), "5" => array("name" => "社保平账", "url" => httpPath . "soInsManage/soInsBalFee.php"));
$extArr = array("month" => $month, "type" => $type, "unitID" => $unitID);
$nameSql = " select uID,name from a_workerInfo where unitID like :unitID";
$nameRet = SQL($pdo, $nameSql, array(":unitID" => $unitID));
$nameR = keyArray($nameRet, "uID");
$sql = "select a.* from a_editAccountList a  where a.unitID like :unitID and a.month like :month and a.type like :type and a.status='1' ";
$ret = SQL($pdo, $sql, $extArr);

foreach ($ret as $key => $val) {
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
            case "uOtherMoney" :
                if ($v > 0) {
                    $totalArr ['1'] [$k] += $v;
                } elseif ($v < 0) {
                    $totalArr ['2'] [$k] += $v;
                }
                break;
        }
    }
}
//print_r($totalArr);
#变量配置
$smarty->assign("nRet", $nRet);
$smarty->assign("listRet", $listRet);
$smarty->assign("unit", $unit);
$smarty->assign(array("ret" => $ret, "totalArr" => $totalArr));
$smarty->assign(array("nameR" => $nameR, "typeArr" => $typeArr));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("approval/feeApproval.tpl");
?>