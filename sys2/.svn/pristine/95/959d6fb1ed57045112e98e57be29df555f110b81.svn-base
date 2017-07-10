<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/1 - 14:51
 *
 *  订单明细 by OrderID
 */

#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";

$title = "订单详细信息";
$today = timeStyle("date");
#
$aSet = new agencySet();
$setArr = $aSet->agencySetArr("basic");
#订单数组
$orderID = filterParam("orderID", 0);
$aO = new agentOrder();
$aO->agentOrderBasic("*", "`orderID`='$orderID'");
$aOrderArr = $aO->recreateOrderInfo();
foreach($aOrderArr[$orderID] as $k=>$v){
    switch($k){
        case "userID":
            $wxUserID = $v;
            break;
        case "lastModifyBy":
            $sysUserID = $v;
            break;
        case "orderType":
            $orderType=$v;
            break;
    }
    $smarty->assign("{$k}", $v);
}

#
$wxU = new weixinUser();
$wxUserArr= $wxU->wxUserBasic("uid,nickname,truename,mobile","uid='$wxUserID'");
#
$sysU = new user();
$sysUserArr = $sysU->userBasic("mID,mName","mID='$sysUserID'");

switch($orderType){
    case "0": //投保支付订单
        $aOrderExtraArr  =$aO->orderExtra();
        $tpl = "orderDetail.tpl";
        $smarty->assign(array("aOrderExtraArr"=>$aOrderExtraArr));
        break;
    case "99": //退款订单
        $aOrderRefundArr =$aO->refundDetail();
        $tpl = "orderDetailOfRefund.tpl";
        foreach($aOrderRefundArr[$orderID] as $k =>$v){
            $smarty->assign($k,$v);
        }
        break;
}

//echo "<pre>";
//print_r($aOrderRefundArr);
#配置变量
$smarty->assign(array("setArr"=>$setArr));
$smarty->assign(array("wxUserArr"=>$wxUserArr,"sysUserArr"=>$sysUserArr));
#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agent/".$tpl);