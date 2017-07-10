<?php

/*
 *     2010-9-20
 *          <<<  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
//echo $_SERVER['QUERY_STRING']; 
$title = "调账给他人调整";
$salaryDate = $_GET ['salaryDate'];
$soInsDate = $_GET ['soInsDate'];
$month = $_GET['month'];
$unitID = $_GET ['unitID'];
$roleB = $_GET ['roleB'];
//获取本月有挂账的人员名单
$sql = "select a.*,b.name from a_prsRequireMoney a left join a_workerInfo b on a.uID =b.uID where a.unitID like :unitID and a.month like :month and a.uID like :uID and a.type like '1'";
//$sql = "select * from a_prsRequireMoney where month like :month and uID like :uID";
$res = $pdo->prepare($sql);
$res->execute(array(":unitID" => $unitID, ":month" => $month, ":uID" => $roleB));
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
//获取有累计欠款的人员名单,包括本月欠款的(最近的一条欠款记录)
$sql = "select a.uID as uID,b.name as name,sum(a.uPDInsMoney) as uPDInsMoney,sum(a.uSoInsMoney) as uSoInsMoney,sum(a.pSoInsMoney) as pSoInsMoney,sum(a.uHFMoney) as uHFMoney,sum(a.pHFMoney) as pHFMoney,sum(a.uComInsMoney) as uComInsMoney,sum(a.pComInsMoney) as pComInsMoney,sum(a.managementCostMoney) as managementCostMoney,sum(a.uOtherMoney) as uOtherMoney, sum(a.salaryMoney) as salaryMoney  from `a_prsRequireMoney` a
           left join `a_workerInfo` b on a.uID = b.uID where  ";
if ($_GET['thisMonth'] == "true") {
    $sql .=" a.month <= :month and ";
} else {
    $sql .=" a.month < :month and ";
    #本月收回的欠款
    $reSql = "select * from a_prsRequireMoney where type like '3' and unitID like :unitID and month like :month ";
    $reRet = SQL($pdo, $reSql, array(":month" => $month, ":unitID" => $unitID));
    $reRet = keyArray($reRet, "uID");
}
$sql .= " a.status='0' and a.type in ('2','3') and a.unitID like :unitID and b.uID is not null  group by a.uID HAVING (sum(a.uPDInsMoney) <>0 or sum(a.uSoInsMoney) <>0 or sum(a.pSoInsMoney) <>0 or sum(a.uHFMoney) <>0 or sum(a.pHFMoney) <>0  or sum(a.uComInsMoney) <>0 or sum(a.pComInsMoney) <>0 or sum(a.managementCostMoney)<>0 or sum(a.uOtherMoney) <>0 or sum(a.salaryMoney)<>0)";
#这里就做个EXCEL筛选模式..
if ($_REQUEST ['selPost'] == "1") {
    foreach ($_POST as $pKey => $pVal) {
        if ($pKey != "selPost" && $pKey != "intoExcel") {
            //配置Smarty 模板的筛选变量..POST后选中的值
            $smartyName = "s_" . $pKey;
            $smarty->assign($smartyName, $pVal);
            $fieldSel = substr($pKey, 0, - 3);
            switch ($pKey) {
                default :
                    if ($pVal != "") {
                        if ($pVal == "notNull")
                            $sql .= " and sum(a.$fieldSel) not like ''";
                        elseif ($pVal == "Null")
                            $sql .= " and sum(a.$fieldSel)  like ''";
                        else
                            $sql .= " and sum(a.$fieldSel)  = '$pVal'";
                    }
                    break;
            }
        }
    }
}

$res = $pdo->prepare($sql);
$res->execute(array(":month" => $month, ":unitID" => $unitID));
$retMoney = $res->fetchAll(PDO::FETCH_ASSOC);
foreach ($retMoney as $val) {
    $retM [$val ['uID']] = $val;
    //如果本月已有收回欠款则加上收回欠款部分
    if ($reRet) {      
         $retM [$val ['uID']] ['uPDInsMoney'] = $val['uPDInsMoney'] + $reRet[$val['uID']]['uPDInsMoney'];
        $retM [$val ['uID']] ['uSoInsMoney'] = $val['uSoInsMoney'] + $reRet[$val['uID']]['uSoInsMoney'];
        $retM [$val ['uID']] ['pSoInsMoney'] = $val['pSoInsMoney'] + $reRet[$val['uID']]['pSoInsMoney'];
        $retM [$val ['uID']] ['uHFMoney'] = $val['uHFMoney'] + $reRet[$val['uID']]['uHFMoney'];
        $retM [$val ['uID']] ['pHFMoney'] = $val['pHFMoney'] + $reRet[$val['uID']]['pHFMoney'];
        $retM [$val ['uID']] ['uComInsMoney'] = $val['uComInsMoney'] + $reRet[$val['uID']]['uComInsMoney'];
        $retM [$val ['uID']] ['pComInsMoney'] = $val['pComInsMoney'] + $reRet[$val['uID']]['pComInsMoney'];
        $retM [$val ['uID']] ['managementCostMoney'] = $val['managementCostMoney'] + $reRet[$val['uID']]['managementCostMoney'];
        $retM [$val ['uID']] ['uOtherMoney'] = $val['uOtherMoney'] + $reRet[$val['uID']]['uOtherMoney'];
    }
}
unset($retMoney);
//找出已经申请过调账的记录,并从操作中删除,但不包括该roleB的申请记录
$eSql = " select * from a_editAccountList where unitID like :unitID and month like :month and roleB not like :roleB  and type in ('2','3','4')";
$eRes = $pdo->prepare($eSql);
$eRes->execute(array(":month" => $month, ":unitID" => $unitID, ":roleB" => $roleB));
$eRet = $eRes->fetchAll(PDO::FETCH_ASSOC);
foreach ($eRet as $key => $val) {
    $retMA [$val ['roleA']] = $val;
}
//找出该被调账人的本月调账记录
$eSqlB = " select * from a_editAccountList where unitID like :unitID and month like :month and roleB  like :roleB and type in ('1','2') ";
$eResB = $pdo->prepare($eSqlB);
$eResB->execute(array(":month" => $month, ":unitID" => $unitID, ":roleB" => $roleB));
$eRetB = $eResB->fetchAll(PDO::FETCH_ASSOC);
foreach ($eRetB as $key => $val) {
    $retMB [$val ['roleA']] = $val;
}
//获取操作的数组
if ($retM)
    foreach ($retM as $key => $val) {
        if (($retMA && array_key_exists($val ['uID'], $retMA))||array_sum($val) == 0){
            unset($retM [$key]);
        }
    }
//删除本人数组
//unset ( $retM [$roleB] );
//释放数组
unset($eRet, $eRetB);
if ($retM) {
    foreach ($retM as $rKey => $rVal) {
        $uPDInsMoneyArr [] = $rVal ['uPDInsMoney'];
        $uSoInsMoneyArr [] = $rVal ['uSoInsMoney'];
        $pSoInsMoneyArr [] = $rVal ['pSoInsMoney'];
        $uHFMoneyArr [] = $rVal ['uHFMoney'];
        $pHFMoneyArr [] = $rVal ['pHFMoney'];
        $uComInsMoneyArr [] = $rVal ['uComInsMoney'];
        $pComInsMoneyArr [] = $rVal ['pComInsMoney'];
        $managementCostMoneyArr [] = $rVal ['managementCostMoney'];
        $uOtherMoneyArr [] = $rVal ['uOtherMoney'];
    }
    $uPDInsMoneyArr = array_unique($uPDInsMoneyArr);
    $uSoInsMoneyArr = array_unique($uSoInsMoneyArr);
    $pSoInsMoneyArr = array_unique($pSoInsMoneyArr);
    $uHFMoneyArr = array_unique($uHFMoneyArr);
    $pHFMoneyArr = array_unique($pHFMoneyArr);
    $uComInsMoneyArr = array_unique($uComInsMoneyArr);
    $pComInsMoneyArr = array_unique($pComInsMoneyArr);
    $managementCostMoneyArr = array_unique($managementCostMoneyArr);
    $uOtherMoneyArr = array_unique($uOtherMoneyArr);
}
//print_r($uOtherMoneyArr);
$smarty->assign(array("ret" => $ret, "retM" => $retM, "retMB" => $retMB));
$smarty->assign(array("uPDInsMoneyArr" => $uPDInsMoneyArr, "uSoInsMoneyArr" => $uSoInsMoneyArr, "pSoInsMoneyArr" => $pSoInsMoneyArr, "uHFMoneyArr" => $uHFMoneyArr, "pHFMoneyArr" => $pHFMoneyArr, "uComInsMoneyArr" => $uComInsMoneyArr, "pComInsMoneyArr" => $pComInsMoneyArr, "managementCostMoneyArr" => $managementCostMoneyArr, "uOtherMoneyArr" => $uOtherMoneyArr));
$smarty->assign("showWindow", $showWindow);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("salaryManage/editAccountTheir.tpl");
?>