<?php

/*
作者：LOSKIN
time:2014-04-09
描述：公积金缴交明细
更新：
	
*/

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';

$title = "查看社保缴交明细";
$HFDate = $_GET ['HFDate'];
$HFID = $_GET['1002057166'];
$sql = "select ID,dID,housingFundID,HFDate,HFID,name,pID,HFRadix,uHFPer,pHFPer,total,pTotal,uTotal,sponsorName,sponsorTime from d_hffee_tmp where HFDate like :HFDate";
if ($_POST['search']) {
    $sql .=" and name like '" . $_POST['name'] . "%'";
}
if ($_GET['ID'])
    $sql .=" and ID='$_GET[ID]' ";
if ($soInsID) {
    $sql .= " and HFID like :HFID";

    $ret = SQL($pdo, $sql, array(":HFDate" => $HFDate, ":HFID" => $HFID));
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
            case "pID":
            case "housingFundID":
            case "sponsorName":
            case "sponsorTime":
            case "HFID":
            case "HFDate":
            case "HFRadix":
            case "uHFPer":
            case "pHFPer":
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
//echo "<pre>";var_dump($total);echo "</pre>";
#变量配置
$smarty->assign("newFieldArr", $newFieldArr);
$smarty->assign("ret", $ret);
$smarty->assign("total", $total);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/HFAgmDetail.tpl");
?>