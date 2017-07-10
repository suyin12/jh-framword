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

$title = "查看公积金缴交明细";
$HFDate = $_GET ['HFDate'];
$housingFundID = $_GET['housingFundID'];
$sql = "select * from a_HFFee_tmp where HFDate like :HFDate";
if ($_GET['ID'])
    $sql .=" and ID='$_GET[ID]' ";
if ($_POST['search']) {
    $sql .=" and name like '" . trim($_POST['name']) . "%'";
}
if ($housingFundID) {
    $sql .= " and housingFundID like :housingFundID";
    $ret = SQL($pdo, $sql, array(":HFDate" => $HFDate, ":housingFundID" => $housingFundID));
} else {
    $ret = SQL($pdo, $sql, array(":HFDate" => $HFDate));
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
            case "housingFundID":
            case "HFDate":
            case "HFID":
            case "HFRadix":
            case "pHFPer":
            case "uHFPer":    
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
$smarty->display("housingFundManage/HFBalFeeDetail.tpl");
?>