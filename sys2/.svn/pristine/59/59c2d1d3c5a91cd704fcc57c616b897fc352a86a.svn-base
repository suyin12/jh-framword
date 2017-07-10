<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/2/17 - 14:34
 *
 * 代理网络订单列表
 */

#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";


$title = "订单列表";

#加载基础配置
$wxU = new weixinUser();
$aSet = new agencySet();
$setArr = $aSet->agencySetArr("basic");
$modelArr = array("mobile" => "手机号码", "orderID" => "订单号");
#
$model = filterParam('m', 0);
$c = filterParam('c', 0);
$payStatusArr = filterParam('payStatus', 0);
if ($payStatusArr) {
    $payStatusStr = implode(",", $payStatusArr);
    $s_payStatusArr = $payStatusArr;
} else {
    $s_payStatusArr = array("0","99","95");
    $payStatusStr = implode(",", $s_payStatusArr);
}
if ($model) {
    $conArr['selStr'] = "`ID`,`orderID`,`userID`,`payStatus`,`status`,`total`,`payMoney`,`cancelReason`";
    switch ($model) {
        case "mobile":
            #
            if (!is_null($payStatusStr)) {
                $conStr .= " payStatus in ($payStatusStr)";
            }
            if ($c) {
                $wxUserArr = $wxU->wxUserBasic("`uid`", "`mobile` like '$c'");
                $userID = array_values($wxUserArr);
                $conStr .= "and userID='" . $userID[0]['uid'] . "'";
            }

            $conArr['conStr'] = $conStr . "  order by ID desc";
            break;
        default:
            $conStr = "`" . $model . "` like '%" . $c . "%'";
            if (!is_null($payStatusStr)) {
                $conStr .= " and payStatus in ($payStatusStr)";
            }
            $conArr['conStr'] = $conStr . "  order by ID desc";
            break;
    }


    #参保人数组
    $aO = new agentOrder();
    $myPage = new Pagination (); //使用分页类
    $myPage->page = filterParam('page', 0); //设置当前页
    $myPage->form_mothod = "get";
    $myPage->count = $pdo->query("select count(1) from  d_agent_order where " . $conArr['conStr'])->rowCount();
    $myPage->pagesize = "20";
    $pagesizeLimit = $myPage->get_limit();
    $aO->agentOrderBasic($conArr['selStr'], $conArr['conStr'] . $pagesizeLimit);
    $aOrderArr = $aO->recreateOrderInfo();
//    echo "<pre>";
//    print_r($aOrderArr);
    foreach ($_GET as $key => $val) {
        if ($key != "page" and $key != "intoExcel") {
            $queryStr .= $key . "=" . $val . "&";
        }
    }
    $queryStr = substr($queryStr, 0, -1);
    $pageList = $myPage->page_list($_SERVER ['PHP_SELF'] . "?" . $queryStr);
    if ($aOrderArr) {
        foreach ($aOrderArr as $val) {
            $userIDArr[] = $val['userID'];
        }
        $userIDArr = array_unique($userIDArr);
        $userIDStr = implode(",", $userIDArr);
        $wxUserArr = $wxU->wxUserBasic("uid,mobile,nickname"," uid in ($userIDStr)");
    }



}
#变量配置
$smarty->assign(array("modelArr" => $modelArr, "payStatusArr" => $setArr['payStatus'], "s_payStatusArr" => $s_payStatusArr,"pageList"=>$pageList));
$smarty->assign(array("aOrderArr" => $aOrderArr,"wxUserArr"=>$wxUserArr));
#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agent/agentOrderList.tpl");