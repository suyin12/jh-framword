<?php

/*
 *     2010-9-30
 *          <<<缴交明细  >>>
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

$title = "查看社保缴交明细";
$soInsDate = $_GET ['soInsDate'];
$soInsID = $_GET['soInsID'];
$sql = "select ID,uID,name,unitID,soInsID,soInsDate,sID,pID,radix,total,pTotal,uTotal,uPension,pPension,pHospitalization,uHospitalization,employmentRadix,uEmploymentInjury,uUnemployment,uBirth,sponsorName,sponsorTime from a_soInsFee_tmp where soInsDate like :soInsDate";
if ($_POST['search']) {
    $sql .=" and name like '" . $_POST['name'] . "%'";
}
if ($_GET['ID'])
    $sql .=" and ID='$_GET[ID]' ";
if ($soInsID) {
    $sql .= " and soInsID like :soInsID";

    $ret = SQL($pdo, $sql, array(":soInsDate" => $soInsDate, ":soInsID" => $soInsID));
} else {
    $ret = SQL($pdo, $sql, array(":soInsDate" => $soInsDate));
}

$engToChsArr = engTochs();
foreach ($ret[0] as $key => $val) {
    if ($key != "ID")
        $newFieldArr [$key] = $engToChsArr[$key];
}
foreach ($ret as $val) {
    foreach ($val as $k => $v) {
        switch ($k) {
            case "name":
                $total[$k] = "合计";
                break;
            case "ID":
                break;
            case "unitID":
            case "pID":
            case "sponsorName":
            case "sponsorTime":
            case "soInsID":
            case "soInsDate":
            case "sID":
            case "radix":
            case "employmentRadix" :
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
$smarty->display("soInsManage/soInsFeeDetail.tpl");
?>