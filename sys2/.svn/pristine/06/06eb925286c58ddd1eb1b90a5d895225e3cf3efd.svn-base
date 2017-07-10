<?php

/**
 * Description of rewardIndex
 * 奖金索引页
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接数据函数
require_once sysPath . 'dataFunction/unit.data.php';
#页面标题
$title = "奖金管理首页";
if ($_GET ['year']) {
    $year = $_GET ['year'];
} else {
    header("location:" . httpPath . "rewardManage/rewardIndex.php?year=" . date("Y", time()));
}

#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1",NULL,"1");
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
        $sqlUnit .= " and unitID like '$unitID' ";
    } else
        $sqlUnit .= " and unitID in(" . $sqlV . ")";
} else {
    if (!$_GET ['wCS'])
        $mID = $_SESSION ['exp_user'] ['mID'];
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

#获取相关年份
$toYear = date("Y", time());
$yearArr = array (($toYear+1) => ($toYear+1),$toYear => $toYear, ($toYear - 1) => ($toYear - 1) );
if ($year) {
    $s_year = $year;
} else {
    $s_year = $toYear;
}
#获取相关数据
$sql = "select `unitID`,`month`,`rewardDate`,`zID` from a_rewardFee_tmp where substr(month,1,4)= :year ";
$sql = $sql . $sqlUnit;
$sql .=" group by unitID,month ";
$res = $pdo->prepare($sql);
$res->execute(array(":year" => $year));
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
#配置变量
$smarty->assign("s_year", $s_year);
$smarty->assign("yearArr", $yearArr);
$smarty->assign(array("s_mID" => $mID,"s_unitID"=>$unitID));
$smarty->assign("ret", $ret);
$smarty->assign("js_unitManager", $js_unitManager);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("rewardManage/rewardIndex.tpl");
?>
