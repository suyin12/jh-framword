<?php

/**
 * Description of rewardManage
 *  各月奖金管理界面
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
$title = "奖金管理";

$month = $_GET["month"];
$unitID = $_GET['unitID'];
#本费用月份内的所有各月奖金
$exSql = "select `month`,`extraBatch`,`unitID`,`rewardDate`,`zID` from `a_rewardFee_tmp` where `month` like :month and `unitID` like :unitID group by extraBatch order by extraBatch";
$exRet = SQL($pdo, $exSql, array(":month" => $month, ":unitID" => $unitID));
#原始奖金费用表
$sql = "select `month`,`unitID`,`rewardDate`,`extraBatch`,`confirmStatus`,sum(`pay`) as pay, sum(`ratal`) as ratal,sum(`pTax`) as pTax,sum(`acheive`) as acheive,sum(`totalFee`) as totalFee  from `a_rewardFee` where month like :month and unitID like :unitID group by `extraBatch`";
$res = $pdo->prepare($sql);
$res->execute(array(":month" => $month, ":unitID" => $unitID));
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
$ret = keyArray($ret, "extraBatch");
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1");
#链接验证审批过程
require_once sysPath . 'approval/approval.class.php';
$approval = new approval ();
$approval->pdo = $pdo;
//判断有哪些是需要审批的,当设置审批类型为不审批时,屏蔽审批流程
$appTypeArr = array("reward");
if ($authArr ['approval']) {
    $appTypeNeedArr = array_intersect($appTypeArr, array_keys($authArr ['approval']));
    foreach ($appTypeNeedArr as $appType) {
        foreach ($ret as $rVal) {
            $exArr = null;
            $appConStr = "a.`month`=\'$month\' and a.`unitID`=\'$unitID\' and a.`extraBatch`=\'$rVal[extraBatch]\'";
            $approval->type = $appType;
            $approval->conStr = $appConStr;
            $exArr = $approval->validEx();
            $exAppArr [$rVal['extraBatch']] = $exArr;
        }
    }
}
if ($exAppArr) {
    foreach ($exAppArr as $key => $val) {
        switch ($val ['status']) {
            case "1" :
                $appMsg [$key] = "已完成审批流程";
                break;
            case "5" :
                $appMsg [$key] = "审批流程进行中,无法修改数据";
                break;
            case "99" :
                $appMsg [$key] = "审批被退回";
                break;
        }
    }
}
#变量配置
$smarty->assign(array("exRet" => $exRet, "ret" => $ret));
$smarty->assign(array("exAppArr" => $exAppArr, "appMsg" => $appMsg));
#模板配置
$smarty->assign(array("title" => $title, "authArr" => $authArr, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("rewardManage/rewardManage.tpl");
?>
