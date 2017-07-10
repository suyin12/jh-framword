<?php

/*
作者：LOSKIN
time:2014-03-06
描述：社保缴交明细
更新：
	
*/

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';

$title = "查看社保缴交明细";
$soInsDate = $_GET ['soInsDate'];
$soInsID = $_GET['soInsID'];
$type = $_GET['type'];
$sql = "select ID,dID,name,soInsID,soInsDate,sID,pID,radix,total,pTotal,uTotal,uPension,pPension,pHospitalization,uHospitalization,uEmploymentInjury,uUnemployment,uPDIns,sponsorName,sponsorTime from d_soInsFee_tmp where soInsDate like :soInsDate";
if ($_POST['search']) {
    $sql .=" and name like '" . $_POST['name'] . "%'";
}
if ($_GET['ID'])
    $sql .=" and ID='$_GET[ID]'";
if ($soInsID) {
    $sql .= " and type=:type and soInsID like :soInsID";

    $ret = SQL($pdo, $sql, array(":soInsDate" => $soInsDate, ":soInsID" => $soInsID, ":type" => $type));
} else {
    $ret = SQL($pdo, $sql, array(":soInsDate" => $soInsDate));
}
$engToChsArr = engTochs();
foreach ($ret[0] as $key => $val) {
    if ($key != "ID")
        $newFieldArr [$key] = $engToChsArr[$key];
}
//echo "<pre>";var_dump($newFieldArr);echo "</pre>";
foreach ($ret as $val) {
    foreach ($val as $k => $v) {
        switch ($k) {
            case "name":
                $total[$k] = "合计";
                break;
            case "ID":
                break;
            case "pID":
            case "sponsorName":
            case "sponsorTime":
            case "soInsID":
            case "soInsDate":
            case "sID":
            case "radix":
                $total[$k] = null;
                break;
            default:
                if (is_numeric($v)) {
                    $total[$k]+=round((double) $v, 2);
                } else {
                    $total[$k] = null;
                }
                break;
        }
    }
}
#变量配置
$smarty->assign("newFieldArr", $newFieldArr);
$smarty->assign("ret", $ret);
$smarty->assign("total", $total);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/soInsAgmDetail.tpl");
?>