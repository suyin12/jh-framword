<?php
/*
*      Date: 14-1-10
*   
*    <<<  各类型的详细清单  >>>
*       created by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';

#获取参数
$m = $_GET['m'];
switch ($m) {
    case "soIns":
        $title = "查看社保缴交明细";
        $keyID = $_GET['soInsID'];
        $month = $_GET['soInsDate'];
        $sql = "select ID,name,soInsDate,sID,pID,total,mCost,soInsID from `c_soIns_fee_out` where soInsDate like :month";
        if ($keyID)
            $sql .= " and soInsID like :keyID ";
        break;
    case "HF":
        $title = "查看公积金缴交明细";
        $keyID = $_GET['housingFundID'];
        $month = $_GET['HFDate'];
        $sql = "select ID,name,HFDate,HFID,pID,total,mCost,housingFundID from `c_HF_fee_out` where HFDate like :month";
        if ($keyID)
            $sql .= " and housingFundID like :keyID";
        break;
    case "basicFee":
        $title = "查看资金往来备忘录";
        $keyID = $_GET['feeID'];
        $month = $_GET['month'];
        $sql = "select ID,unitName,name,month,pID,soInsTotal,soInsSecTotal,HFTotal,mCost,feeID from `c_basic_fee_in` where month like :month";
        if ($keyID)
            $sql .= " and feeID like :keyID";
        break;

}
if ($_GET['ID'])
    $sql .= " and ID='$_GET[ID]' ";
if ($_POST['search'] || $_GET['name']) {
    $name = $_POST['name']?$_POST['name']:$_GET['name'];
    $sql .= " and name like '" . $name . "%'";
}
if ($keyID) {
    $ret = SQL($pdo, $sql, array(":month" => $month, ":keyID" => $keyID));
} else {
    $ret = SQL($pdo, $sql, array(":month" => $month));
}
$extraEngToChsArr=array("month"=>"月份","soInsTotal"=>"社保合计","soInsSecTotal"=>"社保补缴合计","HFTotal"=>"公积金合计","feeID"=>"账套名称");
$engToChsArr = engTochs();
$engToChsArr = array_merge($engToChsArr,$extraEngToChsArr);
foreach ($ret[0] as $key => $val) {
    if ($key != "ID")
        $newFieldArr [$key] = $engToChsArr[$key];
}

#变量配置
$smarty->assign(array("m" => $m));
$smarty->assign("newFieldArr", $newFieldArr);
$smarty->assign("ret", $ret);
$smarty->assign("total", $total);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/balance_detail.tpl");