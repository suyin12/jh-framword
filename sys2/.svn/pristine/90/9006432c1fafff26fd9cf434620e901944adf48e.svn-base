<?php
/**
 * 2010-4-29
 * <<<该页面主要的功能是对社保分批次清单签收数据的显示和下载>>>
 *
 * @author  yours  sToNe
 * @version
 */

#验证权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接公用函数
require_once '../common.function.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
$wSet = new wInfoSet ();
$wSet->p = $pdo;
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
#标题
$title = "社保清单批次明细";
$sponsorName = urldecode($_GET ['n']);
$soInsModifyDate = $_GET ['d'];
$extraBatch = $_GET ['e'];
$type = $_GET ['type'];

#先查询出该社保专员负责的单位信息


$sql = "select batch,extraBatch,uID,(ROUND(radix,'0')) as radix,pension,hospitalization,employmentInjury,unemployment,housing,PDIns,hand,soInsurance as soInsStatus,type,soInsModifyDate,status,remarks,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID from a_soInsList where sponsorName like :sponsorName and soInsModifyDate = :soInsModifyDate  and extraBatch=:extraBatch and type= :type";
$res = $pdo->prepare($sql);
$res->execute(array(":sponsorName" => $sponsorName, ":soInsModifyDate" => $soInsModifyDate, ":extraBatch" => $extraBatch, ":type" => $type));
$tret = $res->fetchAll(PDO::FETCH_ASSOC);
foreach ($tret as $rkey => $rval) {
    $tret [$rkey] ['num'] = $rkey + 1;
}
if (!$tret)
    exit ("数据读取出错,请重试");
foreach ($tret as $val) {
    if ($val['type'] == '9') {
        $fIDStr .= "'" . $val ['uID'] . "',";
    } else {
        $uIDStr .= "'" . $val ['uID'] . "',";
    }
}
$uIDStr = rtrim($uIDStr, ",");
$fIDStr = rtrim($fIDStr, ",");
#派遣部分
$detailSql = "select a.uID,a.name,a.pID,a.sID,b.unitName,a.domicile,b.soInsID,a.soInsID as extraSoInsID,a.spRemarks,a.mobilePhone as mobilePhone from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.uID in($uIDStr) order by b.soInsID";
$detailRet = SQL($pdo, $detailSql);
$dRet = keyArray($detailRet, "uID");
#个人代理的部分
$fIDSql = "select a.id as uID, a.name,a.pID,a.sID,b.unitName,a.domicile,b.soInsID from d_agent_personalInfo a left join a_unitInfo b on b.unitID like '3000.001' where a.id in ($fIDStr)";
$fIDRet = SQL($pdo, $fIDSql);
$fIDRet = keyArray($fIDRet, "uID");
#重新设置数组
foreach ($tret as $val) {
    if ($dRet)
        $tmp [] = array_merge($val, $dRet [$val ['uID']]);
    if ($fIDRet)
        $tmp [] = array_merge($val, $fIDRet[$val['uID']]);
}
$tret = $tmp;
#离职信息表,区别主动辞职和被辞退停保
$dimissionSql = "select uID,dimissionReason from `a_dimission` where uID in($uIDStr) group by uID having max(ID)";
$dimissionRet = SQL($pdo, $dimissionSql);
$dimissionRet = keyArray($dimissionRet, "uID");
foreach ($detailRet as $dKey => $dVal) {
    $dRet [$dVal ['uID']] = $dVal;
    $dRet [$dVal ['uID']] ['soInsID'] = $dVal ['extraSoInsID'] ? $dVal ['extraSoInsID'] : $dVal ['soInsID'];
    if ($dVal ['spRemarks']) {
        $spRemarks = makeArray($dVal ['spRemarks']);
        $dRet [$dVal ['uID']] ['spRemarks'] = $spRemarks ['soIns'];
    }
    unset ($dRet [$dVal ['uID']] ['extraSoInsID']);
}
#重新设置数组
foreach ($tret as $val) {
    $val ['soInsStatus'] == 0 ? $val ['soInsStatus'] = "停保" . $dimissionRet [$val ['uID']] ['dimissionReason'] : $val ['soInsStatus'] = $val ['soInsStatus'];
    if ($dRet)
        $re [] = array_merge($val, $dRet [$val ['uID']]);
    else
        $re [] = $val;
}
$re = reCreateArray($re, $wInfoSet);
#保存为EXCEL
$tableHead = array(
    "num" => "序号",
    "soInsID" => "社保账户",
    "unitName" => "单位",
    "name" => "姓名",
    "pID" => "身份证号码",
    "mobilePhone" => "电话",
    "sID" => "社保号",
    'domicile' => "户籍",
    'radix' => "基数",
    'pension' => "养老",
    'hospitalization' => "医疗",
    'employmentInjury' => "工伤",
    'unemployment' => "失业",
    'hand' => "利手",
    "soInsStatus" => "社保状态",
    "spRemarks" => "标示",
    "remarks"=>"备注",
    "sponsorName" => "客户经理",
    "receiveTime" => "签收时间"
);
$excelTitle = $soInsModifyDate . "社保清单";
$thArr [] = $tableHead;
if ($re)
    $excelRet = array_merge($thArr, $re);
if (isset ($_POST ['intoExcel'])) {
    if (!$excelRet)
        exit ("<script> alert('无数据导出') </script>");

    #链接PHPEXCEL CLASS
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once '../class/excel.class.php';
    $oExcel = new PHPExcel ();
    #设置文档基本属性
    $oPro = $oExcel->getProperties();
    $oPro->setCreator($serverCompany); //公司名
    #构造输出函数
    $op = new excelOutput ();
    $op->oExcel = $oExcel;
    $op->eRes = $excelRet;
    $op->selFieldArray = $tableHead;
    $op->title = $excelTitle;
    $op->fillData();
    $op->eFileName = $excelTitle . ".xls";
    $op->output();
}
#配置变量
$smarty->assign("detailArr", $re);
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("soInsManage/soInsListDetail.tpl");
?>