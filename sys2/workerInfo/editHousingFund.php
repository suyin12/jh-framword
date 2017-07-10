<?php

/**
 * Description of editHousingFund
 * <<通过工资制作,完成公积金的申报工作>>
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';

$month = $_GET['month'];
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1", " unitID,unitName,HFFrom");
$js_unitManager = json_encode($unitManager);
#生成单位ID
if ($_GET ['mID']) {
    $mID = $_GET ['mID'];
    foreach ($unitManager as $uValue) {
        if ($uValue ['mID'] == $mID) {
            foreach ($uValue ['unit'] as $uV) {
                $sqlV .= "'" . $uV ['unitID'] . "',";
            }
        }
    }
    $sqlV = rtrim($sqlV, ",");
    if ($_GET ['unitID']) {
        $unitID = $_GET ['unitID'];
        $sqlUnit .= " and a.`unitID` like '$unitID' ";
    } else
        $sqlUnit .= " and a.`unitID` in(" . $sqlV . ")";
} else {
    if (!$_GET ['wCS'])
        $mID = $_SESSION ['exp_user'] ['mID'];
}
if (!$unitID) {
    exit("错误提示：请选择单位,<a href='javascript:history.go(-1)'>点击返回</a>");
}
//遍历客户经理,单位数组
foreach ($unitManager as $um_v) {
    foreach ($um_v as $um_v_k => $um_v_v) {
        if ($um_v ['mID'] == $mID) {
            //构造get后,单位数组
            $um [0] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName'], "unit" => $um_v ['unit']);
        } else {
            //构造get后,单位数组,除get外其余的客户经理
            $um_m [$um_v ['mID']] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName']);
        }
    }
}
//构造get后,单位数组
if ($um) {
    $um = array_merge($um, $um_m);
    $smarty->assign("unitManager", $um);
} else {
    $smarty->assign("unitManager", $unitManager);
}
$unitArr = unitAll($pdo, " unitID,HFFrom ");
$HFFrom = $unitArr[$unitID]['HFFrom'];
if ($HFFrom == "1") {
    $sql = "select a.uID,b.name,(a.uHF/2) as uHF,a.HFDate,c.unitName from `a_originalFee_tmp` a left join `a_workerInfo` b on a.uID=b.uID  left join `a_unitInfo` c on a.unitID=c.unitID  where a.`month` like :month  ";
    $sql .=$sqlUnit;
    $sql .= "and a.uHF>0 and b.`housingFund`='0' and  b.`status` in ('1','2')  ";
    $sql .= " union ";
    $sql = "select a.uID,b.name,(a.uHF/2) as uHF,a.HFDate,c.unitName from `a_mul_originalFee_tmp` a left join `a_workerInfo` b on a.uID=b.uID  left join `a_unitInfo` c on a.unitID=c.unitID  where a.`month` like :month  ";
    $sql .=$sqlUnit;
    $sql .= "and a.uHF>0 and b.`housingFund`='0' and  b.`status` in ('1','2')  ";
} elseif ($HFFrom == "2") {
    $sql = "select a.uID,b.name,(a.pHF/2) as uHF,a.HFDate,c.unitName from `a_originalFee` a left join `a_workerInfo` b on a.uID=b.uID  left join `a_unitInfo` c on a.unitID=c.unitID  where a.`month` like :month  ";
    $sql .=$sqlUnit;
    $sql .= "and a.pHF>0 and b.`housingFund`='0' and  b.`status` in ('1','2')  ";
    $sql .= " union ";
    $sql = "select a.uID,b.name,(a.pHF/2) as uHF,a.HFDate,c.unitName from `a_mul_originalFee` a left join `a_workerInfo` b on a.uID=b.uID  left join `a_unitInfo` c on a.unitID=c.unitID  where a.`month` like :month  ";
    $sql .=$sqlUnit;
    $sql .= "and a.pHF>0 and b.`housingFund`='0' and  b.`status` in ('1','2')  ";
} else {
    $sql = "select a.uID,b.name,a.uHF,a.HFDate,c.unitName from `a_originalFee_tmp` a left join `a_workerInfo` b on a.uID=b.uID  left join `a_unitInfo` c on a.unitID=c.unitID  where a.`month` like :month  ";
    $sql .=$sqlUnit;
    $sql .= "and a.uHF>0 and b.`housingFund`='0' and  b.`status` in ('1','2')  ";
    $sql .= " union ";
    $sql .= "select a.uID,b.name,a.uHF,a.HFDate,c.unitName from `a_mul_originalFee_tmp` a left join `a_workerInfo` b on a.uID=b.uID  left join `a_unitInfo` c on a.unitID=c.unitID  where a.`month` like :month  ";
    $sql .=$sqlUnit;
    $sql .= "and a.uHF>0 and b.`housingFund`='0' and  b.`status` in ('1','2')  ";
}
$ret = SQL($pdo, $sql, array(":month" => $month));
#配置变量
$smarty->assign(array("s_mID" => $mID, "s_unitID" => $unitID));
$smarty->assign("js_unitManager", $js_unitManager);
$smarty->assign("ret", $ret);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("workerInfo/editHousingFund.tpl");
?>
