<?php

/*
 *     2010-12-28
 *          <<< 用来做费用表及工资表的审批 >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接数据函数
require_once sysPath . 'dataFunction/unit.data.php';
#分页类
require_once sysPath . 'class/pagenation.class.php';
$title = "发放表/费用表审批";
$mID = $_SESSION ['exp_user'] ['mID'];
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

$listSql = "select a.*,b.typeName,b.type as aType from a_approval_list a left join s_approvalPro_set b on a.appID=b.appID where a.appProID like :appProID";
$listRes = $pdo->prepare($listSql);
$listRes->execute(array(":appProID" => $appProID));
$listRet = $listRes->fetch(PDO::FETCH_ASSOC);
#获取员工信息,求出社保费用,商保费用,互助会费用
$wSql = "select x.uID,x.name,x.department,x.bID,x.status from a_workerInfo x where exists ( select a.uID from a_originalFee a where $listRet[conStr] and a.uID= x.uID)";
$wRes = $pdo->prepare($wSql);
$wRes->execute();
$wRet = $wRes->fetchAll(PDO::FETCH_ASSOC);
foreach ($wRet as $wVal) {
    $wR [$wVal ['uID']] = $wVal;
}
unset($wRet);
#获取工资表,费用表
$ret = SQL($pdo, $sql, null, 'one');
$viewType = $_GET ['viewType'];
if (!$viewType)
    header("Location:" . httpPath . "approval/fee.php" . "?" . $_SERVER ['QUERY_STRING'] . "&viewType=fee");
switch ($listRet['type']) {
    case "reward" ://奖金
        $sql = " select a.zID,a.month,a.unitID,a.extraBatch from `a_rewardFee` a where $listRet[conStr] limit 1 ";
        $ret = SQL($pdo, $sql, null, 'one');
        $iframeUrl = httpPath . "rewardManage/exportExcel.php?month=" . $ret['month'] . "&unitID=" . $ret['unitID'] . "&extraBatch=" . $ret['extraBatch'] . "&type=$viewType&output=true&iframe=true";
        $detailUrl = httpPath . "rewardManage/rewardManage.php?month=" . $ret['month'] . "&unitID=" . $ret['unitID'];
        $zfSql = "select b.zIndex,b.field,a.payFormulas,a.ratalFormulas,a.acheiveFormulas,a.uAccountFormulas,a.totalFeeFormulas from `a_otherFormulas` a left join a_zformatInfo b on a.zID=b.zID where a.zID like :zID and a.unitID like :unitID and a.month like :month and a.extraBatch=:extraBatch and a.type='1'";
        $zfRes = $pdo->prepare($zfSql);
        $zfRes->execute(array(":zID" => $ret['zID'], ":unitID" => $ret ['unitID'], ":month" => $ret ['month'], ":extraBatch" => $ret['extraBatch']));
        break;
    default ://工资,和多次工资
        if ($_GET['extraBatch'] > 0):
            $sql = " select a.zID,a.month,a.unitID,a.extraBatch from a_mul_originalFee a where $listRet[conStr] limit 1 ";
            $ret = SQL($pdo, $sql, null, 'one');
            $iframeUrl = httpPath . "salaryManage/exportExcel.php?month=" . $ret['month'] . "&unitID=" . $ret['unitID'] . "&extraBatch=" . $ret['extraBatch'] . "&type=$viewType&output=true&iframe=true";
            $detailUrl = httpPath . "salaryManage/salaryManage.php?month=" . $ret['month'] . "&unitID=" . $ret['unitID'];
            $zfSql = "select b.zIndex,b.field,a.payFormulas,a.ratalFormulas,a.acheiveFormulas,a.uAccountFormulas,a.totalFeeFormulas from `a_otherFormulas` a left join a_zformatInfo b on a.zID=b.zID where a.zID like :zID and a.unitID like :unitID and a.month like :month and a.extraBatch=:extraBatch and a.type='4'";
            $zfRes = $pdo->prepare($zfSql);
            $zfRes->execute(array(":zID" => $ret['zID'], ":unitID" => $ret ['unitID'], ":month" => $ret ['month'], ":extraBatch" => $ret['extraBatch']));
        else:
            $sql = " select a.zID,a.month,a.unitID from a_originalFee a where $listRet[conStr] limit 1 ";
            $ret = SQL($pdo, $sql, null, 'one');
            $iframeUrl = httpPath . "salaryManage/exportExcel.php?month=" . $ret['month'] . "&unitID=" . $ret['unitID'] . "&type=$viewType&output=true&iframe=true";
            $detailUrl = httpPath . "salaryManage/salaryManage.php?month=" . $ret['month'] . "&unitID=" . $ret['unitID'];
            $zfSql = "select b.zIndex,b.field,a.payFormulas,a.ratalFormulas,a.acheiveFormulas,a.uAccountFormulas,a.totalFeeFormulas from a_zformulas a left join a_zformatInfo b on a.zID=b.zID where a.zID like :zID and a.unitID like :unitID and a.month like :month";
            $zfRes = $pdo->prepare($zfSql);
            $zfRes->execute(array(":zID" => $ret['zID'], ":unitID" => $ret ['unitID'], ":month" => $ret ['month']));
        endif;

        break;
}
#获取单位信息表
$unit = unitAll($pdo, " unitID,unitName ");
#获取中英文对照数组
$engToChsArr = engTochs();
#获取该帐套对应的列,包括列的中文名
$zfRet = $zfRes->fetch(PDO::FETCH_ASSOC);
$fieldArr = makeArray($zfRet ['field']);
$zIndex = makeArray($zfRet ['zIndex']);
$zIndex = array_flip($zIndex);
foreach ($fieldArr as $key => $val) {
    if (array_key_exists($key, $zIndex)) {
        $key = $zIndex [$key];
        $val = $engToChsArr [$key];
    }
    $newFieldArr [$key] = $val;
    $formulasChart [$key] = $val . "(" . $key . ")";
}
//print_r($fieldArr);
//这里增加几个字段,可以自定义控制查询所需的字段名
$newFieldArr ['salaryDate'] = $engToChsArr ['salaryDate'];
$newField = implode(",", array_keys($newFieldArr));
if (!$formulasChart)
    exit("本月未提交公式,请返回费用表制作页面点击<提交公式>");
#设置公式所需要的代号
$formulasChart = $formulasChart;
$i = 0;
$formulasChartStr .= "<tr>";
foreach ($formulasChart as $chartKey => $chart) {
    if ($i % 9 == 0 && $i != 0)
        $formulasChartStr .= "</tr><tr>";
    $i++;
    $formulasChartStr .= "<td>";
    $formulasChartStr .= "<a href='#' id='$chartKey' class='chart'>$chart</a>";
    $formulasChartStr .= "</td>";
}
$formulasChartStr .= "</tr>";
#获取各种公式..
$formulasStr = array("pay" => $zfRet ['payFormulas'], "ratal" => $zfRet ['ratalFormulas'], "acheive" => $zfRet ['acheiveFormulas'], "uAccount" => $zfRet ['uAccountFormulas'], "totalFee" => $zfRet ['totalFeeFormulas']);
//这里就获得了应发工资的字符串了..再EVAL 一下..就可以转成PHP代码进行运算了
if ($formulasStr ['pay']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['pay'], $payStr);
    $formulasStr ['pay'] = strtr($formulasStr ['pay'], $newFieldArr);
}
if ($formulasStr ['ratal']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['ratal'], $ratalStr);
    $formulasStr ['ratal'] = strtr($formulasStr ['ratal'], $newFieldArr);
}
if ($formulasStr ['acheive']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['acheive'], $otherCostsStr);
    $formulasStr ['acheive'] = strtr($formulasStr ['acheive'], $newFieldArr);
}
if ($formulasStr ['uAccount']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['uAccount'], $uAccountStr);
    $formulasStr ['uAccount'] = strtr($formulasStr ['uAccount'], $newFieldArr);
}
if ($formulasStr ['totalFee']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['totalFee'], $otherCostsStrFee);
    $formulasStr ['totalFee'] = strtr($formulasStr ['totalFee'], $newFieldArr);
}

//echo "<pre>";
//print_r($salaryArr);
//unset ( $pageArr ['ret'] );
#变量配置
$smarty->assign("nRet", $nRet);
$smarty->assign("listRet", $listRet);
$smarty->assign("newFieldArr", $newFieldArr);
$smarty->assign(array("iframeUrl" => $iframeUrl, "detailUrl" => $detailUrl));
$smarty->assign("ret", $ret);
$smarty->assign("num", $num);
$smarty->assign("unit", $unit);
$smarty->assign("payStr", $payStr);
$smarty->assign("otherCostsStr", $otherCostsStr);
$smarty->assign("otherCostsStrFee", $otherCostsStrFee);
$smarty->assign("formulasChartStr", $formulasChartStr);
$smarty->assign("formulasStr", $formulasStr);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("approval/fee.tpl");
?>