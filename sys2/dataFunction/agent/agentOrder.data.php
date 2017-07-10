<?php

/**
 * Created by sToNe.
 * User: Administrator
 * Date: 2015/12/11
 * Time: 16:08
 *
 *  获取订单相关
 */
class agentOrder
{
    public $pdo;
    public $agentOrderArr; //订单信息
    public $agentOrderExtraArr; //订单的详细信息
    public $refundDetailArr; //退款详情数组

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #订单相关信息
    public function agentOrderBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        $sql = " select $selStr from d_agent_order where $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "orderID");
        return $this->agentOrderArr = $ret;
    }


    #订单内的附加信息
    public function orderExtra()
    {
        $pdo = $this->pdo;
        $orderArr = $this->agentOrderArr;
        $orderIDArr = array_keys($orderArr);
        $orderIDStr = implode(",", $orderIDArr);
        $sql = "select * from `d_agent_order_tmp` where `orderID` in ($orderIDStr)";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "ID");
        return $this->agentOrderExtraArr = $ret;

    }
    #重构订单信息
    function recreateOrderInfo(){
        $arr = $this->agentOrderArr;
        $aSet = new agencySet();
        $aSetArr = $aSet->agencySetArr("all");

        foreach ($arr as $key => $val) {
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "status":
                        $val[$k . "Txt"] = $aSetArr['orderStatus'][$v];
                        break;
                    case "cancelReason":
                        $val[$k . "Txt"] = $aSetArr['orderCancelReason'][$v];
                        break;
                    case "payStatus":
                        $val[$k . "Txt"] = $aSetArr[$k][$v];
                        break;
                    case array_key_exists($k . "Txt", $aSetArr):
                        $val[$k . "Txt"] = $aSetArr[$k . "Txt"][$v];
                        break;
                }

            }
            $recreateOrderInfoArr[$key] = $val;
        }
        return $recreateOrderInfoArr;
    }


    #退款订单的详情信息
    public function refundDetail()
    {
        $pdo = $this->pdo;
        $orderArr = $this->agentOrderArr;
        $orderIDArr = array_keys($orderArr);
        $orderIDStr = implode(",", $orderIDArr);
        $bankSql = "select a.*,b.orderID from `wx_user_bank` a left join `d_agent_order` b on a.ID=b.userBankID where b.orderID in ($orderIDStr)  ";
        $bankInfoArr =SQL($pdo,$bankSql);
        $bankInfoArr = keyArray($bankInfoArr,"orderID");
        $sql = "select * from `d_refund_detail` where `orderID` in ($orderIDStr)";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "ID");
        $count= count($ret);
        $aS = new agencySet();
        $payStatusTxt=$aS->agencySetArr("payStatus");
        foreach($orderIDArr as $key=>$val){
            $refundDetailArr[$val]['bankInfo']=$bankInfoArr[$val];
            $refundDetailArr[$val]['count'] = $count;
            //---退款金额 ----TODO
            $refundDetailArr[$val]['refundMoney'] = "财务审核中";
            $refundDetailArr[$val]['payStatusTxt'] = $payStatusTxt[$orderArr[$val]['payStatus']];
            $refundDetailArr[$val]['payStatus'] = $orderArr[$val]['payStatus'];
            foreach($ret as $rval){
                if($rval['orderID']==$val){
                    $refundDetailArr[$val]['data'][] = $rval;
                }
            }

        }
//        echo "<pre>";
//        print_r($refundDetailArr);
        return $this->refundDetailArr = $refundDetailArr;

    }


}