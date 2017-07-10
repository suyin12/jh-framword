<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/1/8 - 17:42
 *
 *  用户存储的银行信息
 */


class userBank
{
    public $pdo;
    public $agentOrderArr; //订单信息
    public $agentOrderExtraArr; //订单的详细信息
    public $refundDetailArr; //退款详情数组

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }


    #用户存储银行相关信息
    public function agentOrderBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        $sql = " select $selStr from `wx_user_bank` where $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "ID");
        return $this->agentOrderArr = $ret;
    }
}