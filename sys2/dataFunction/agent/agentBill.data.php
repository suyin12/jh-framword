<?php

/**
 * Created by sToNe.
 * User: Administrator
 * Date: 2015/12/4
 * Time: 15:17
 *
 *   流水账相关数据
 */
class agentBill
{
    public $pdo;//pdo 对象
    public $agentBillArr; //流水账信息的原始数据
    public $remainder; //当前余额


    function  __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #注册人流水账基础信息(合计本月该UserID下所产生账目的汇总)
    public function agentUserBillBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        //为保证正确的余额,以ID最大值对应的remainder 为余额,强制倒序, 不准修改 --TODO
        $sql = " select $selStr from d_agent_user_bill where $conStr ORDER  BY  ID DESC";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "ID");
        return $this->agentBillArr = $ret;
    }

    #参保人支出明细
    public function  agentUserExpenditureDetailBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;

        $sql = " select $selStr from d_agent_expenditure_detail where $conStr  ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "ID");
        return $this->agentBillArr = $ret;
    }

    #流水账格式 ( 按月 罗列明细)
    public function userBillRecreate()
    {
        $billArr = $this->agentBillArr;
        $s = new agencySet();
        $setArr = $s->agencySetArr("basic");
        foreach ($billArr as $key => $val) {
            $i = 0;
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "billType":
                    case "billPayment":
                        $field = $k;
                        $val[$k . "Txt"] = $setArr[$field][$v];
                        break;
                    case "income":
                        if ($v != 0) {
                            $billTxt = "收";
                            $billModel = "income";
                        }
                        break;
                    case "expenditure":
                        if ($v != 0) {
                            $billTxt = "支";
                            $billModel = "expenditure";
                        }
                        break;
                    case "month":
                        $monthTxt = date("Y年m月", strtotime($v . "01"));
                        break;
                    case "remainder":
                        if (is_null($billArrByMonth[$val['userID']]['detail'] [$val['month']]['monthRemainder'])) {
                            $monthRemainder = $v;
                        }
                        break;
                }
            }
            $billArrByMonth[$val['userID']]['detail'] [$val['month']][$val['ID']] = $val;
            $billArrByMonth[$val['userID']]['detail'] [$val['month']][$val['ID']]['billTxt'] = $billTxt;
            $billArrByMonth[$val['userID']]['detail'] [$val['month']][$val['ID']]['billModel'] = $billModel;
            $billArrByMonth[$val['userID']]['detail'] [$val['month']]['monthTxt'] = $monthTxt;
            $billArrByMonth[$val['userID']]['detail'] [$val['month']]['monthRemainder'] = $monthRemainder;
        }

        //求余额
        foreach ($billArr as $key => $val) {
            $billArrByMonth[$val['userID']]['remainder'] = $val['remainder'];
            break;
        }

        return $billArrByMonth;

    }

    #求注册人当前余额
    function remainder()
    {
        $billArr = $this->agentBillArr;
        //求余额
        foreach ($billArr as $key => $val) {
            $remainder[$val['userID']] = $val['remainder'];
            break;
        }
        return $this->remainder = $remainder;
    }

}

