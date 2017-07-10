<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/3
 * Time: 16:45
 */
class agentAction
{
    public $pdo; //PDO对象
    public $ret; //返回操作结果

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #新增参保人
    function agentUserAdd($fieldArr)
    {
        $pdo = $this->pdo;

        //验证是否已经存在记录
        if ($fieldArr['pID']) {
            $pID = $fieldArr['pID'];
            $fieldArr['sex'] = getSexByPID($pID);
            foreach ($fieldArr as $key => $val) {
                switch ($key) {
                    case "fID":
                        break;
                    default:
                        $fieldStr .= "`$key`='$val',";
                        break;
                }
            }
            $fieldStr = rtrim($fieldStr, ",");
            if (!pIDVildator($pID)) {
                $ret['status'] = "1";
                $ret['msg'] = "身份证号码输入错误";
                $ret['result'] = "0";
            }
            if (mobileNumValid($fieldArr['mobilePhone'])) {
                $ret['status'] = "1";
                $ret ['msg'] = "手机号输入错误";
                $ret['result'] = "0";
            }
            if ($ret['result'] != "0") {
                $existSql = "select 1 from `d_agent_personalinfo` where pID = '$pID'";
                $exRet = SQL($pdo, $existSql);
                if ($exRet) {
                    $ret['status'] = "1";
                    $ret ['msg'] = "参保人已存在";
                    $ret['result'] = "0";
                } else {
                    $sql[] = "insert into `d_agent_personalinfo` set " . $fieldStr;

                    $result = transaction($pdo, $sql);
                    $errMsg ['sql'] = $result ['error'];
                    if (empty ($errMsg ['sql'])) {
                        $ret ['msg'] = "添加成功";
                        $ret['status'] = "1";
                        $ret['result'] = "1";
                    } else {
                        $ret['status'] = "1";
                        $ret ['msg'] = $errMsg ['sql'];
                        $ret['result'] = "0";
                    }
                }
            }
        }
        return $this->ret = $ret;
    }


    #参保人信息修改, 传入的参数按照二维数组传递,满足多人更新操作,默认保存记录
    # $fieldArr = array ([fID1]=>array(),[fID2]=>array())
    function agentUserEdit($fieldArr, $history = "1")
    {
        $pdo = $this->pdo;
        $up = "update `d_agent_personalinfo` set ";
        //也可以完成批量状态更新
        foreach ($fieldArr as $key => $val) {
            $fIDStr .= "'$key',";
            //多维数组,更新多人
            $updateStr = null;
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "fID":
                    case "soInsBeginMonth":
                    case "HFBeginMonth":
                    case "soInsEndMonth":
                    case "HFEndMonth":
                        break;
                    default:
                        $updateStr .= "`$k`='$v',";
                        break;
                }
            }
            $updateStr = rtrim($updateStr, ",");
            $sql[] = $up . $updateStr . " where `fID`='$key'";
        }
        //保留历史记录
        if ($history = 1) {
            $fIDStr = rtrim($fIDStr, ",");
            $hisSql = "insert into d_agent_personalinfo_history select * from d_agent_personalinfo where fID in ($fIDStr)";
            SQL($pdo, $hisSql);
        }
//        echo "<pre>";
//        print_r($sql);
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "更新成功";
            $ret['status'] = "1";
            $ret['result'] = "1";

        } else {
            $ret['status'] = "1";
            $ret ['msg'] = "agentUserEdit:" . $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $this->ret = $ret;

    }

    #参保人信息删除,$fIDArr = array(1,2)
    function agentUserDel($fIDArr)
    {
        $pdo = $this->pdo;
        $dl = "delete from  `d_agent_personalinfo` where  `fID` in  (";
        foreach ($fIDArr as $val) {
            $fIDStr .= "'$val',";
        }
        $fIDStr = rtrim($fIDStr, ",");
        $sql[] = $dl . $fIDStr . ")";
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "删除成功";
            $ret['status'] = "1";
            $ret['result'] = "1";

        } else {
            $ret['status'] = "0";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $this->ret = $ret;
    }

    #停缴提交 $param=>array("[fID]"=>array("userID"=>1,"fID"=>"1","stopMonth"=> 2015-12,"soIns"=>"1","HF"=>"0"))
    function agentUserStop($fieldArr)
    {
        $pdo = $this->pdo;
        $createdTime = timeStyle("dateTime");
        $bSql = "insert into `d_agent_stop` set `createdTime`='$createdTime',`status`='0',";

        foreach ($fieldArr as $key => $val) {
            $str = null;
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "stopMonth":
                        break;
                    case "soIns":
                        if ($v == 1)
                            $str .= "`soInsStopMonth`='" . $val['stopMonth'] . "',";
                        break;
                    case "HF":
                        if ($v == 1)
                            $str .= "`HFStopMonth`='" . $val['stopMonth'] . "',";
                        break;
                    default:
                        $str .= "`$k`='$v',";
                        break;
                }
            }
            $str = rtrim($str, ",");
            $sql[] = $bSql . $str;
        }
//        echo "<pre>";
//        print_r($fieldArr);
//        print_r($sql);

        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "提交成功";
            $ret['status'] = "1";
            $ret['result'] = "1";

        } else {
            $ret['status'] = "1";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $this->ret = $ret;
    }

    #停缴提交 $param=>array("[fIDArr]"=>array("1","2"))
    function agentUserCancelStop($fIDArr)
    {
        $pdo = $this->pdo;

        foreach ($fIDArr as $val) {
            $str .= "'$val',";

        }
        $str = rtrim($str, ",");
        $sql[] = "delete from `d_agent_stop` where `fID` in ($str) and `status`='0' ";
//        echo "<pre>";
//        print_r($sql);
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "取消成功";
            $ret['status'] = "1";
            $ret['result'] = "1";

        } else {
            $ret['status'] = "1";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $this->ret = $ret;
    }

    #创建订单 fieldArr  = array([fIDArr]=> , ['total']=> ,['userID'])
    function  orderAdd($fieldArr, $delOld = "true", $orderType = '1')
    {
        $pdo = $this->pdo;
        $fieldStr = null;
        foreach ($fieldArr as $key => $val) {
            switch ($key) {
                case "status":
                    break;
                case "refundMethod":
                    break;
                case "createdTime":
                    break;
                case "fIDArr":
                    $fIDStr = implode(",", $val);
                    $fieldStr .= "`fIDStr` = '$fIDStr',";
                    break;
                default:
                    $fieldStr .= "`$key` = '$val',";
                    break;
            }
        }
        $fieldStr = rtrim($fieldStr, ",");
        //生成订单号,同时增加d_agent_order_tmp 信息
        $orderID = date("YmdHis") . rand(0, 1000000);
        $createdTime = timeStyle("dateTime");
        switch ($orderType) {
            case "1":
                //生成投保订单
                $msg = "订单生成成功";
                #删除老订单
                if ($delOld) {
                    //先删除订单临时信息,再删除订单列表信息
                    $delSql = "delete a,b from `d_agent_order_tmp` a ,`d_agent_order` b where b.`userID`='" . $fieldArr['userID'] . "' and b.`payStatus`='0' and b.`status`='1' and b.`orderType`='$orderType' and a.orderID =b.orderID";
                    SQL($pdo, $delSql);
                }
                $sql[] = "insert into `d_agent_order` set `orderID` = '$orderID',`payStatus` = '0',`status` = '1',`orderType`='$orderType',`createdTime`='$createdTime'," . $fieldStr;
                #同时增加d_agent_order_tmp , 返回SQL!
                $tmpSql = $this->orderAddTmp($orderID, $fIDStr);
                $sql = mergeArray($sql, $tmpSql);
                break;
            case "99":
                //生成退款订单
                $msg = "退款申请已提交";
                //删除未退款的名单
                if ($delOld) {
                    //先删除订单临时信息,再删除订单列表信息
                    $delSql = "delete a,b from `d_refund_detail` a ,`d_agent_order` b where b.`userID`='" . $fieldArr['userID'] . "' and b.`payStatus`='99' and b.`status`='1' and b.`orderType`='$orderType' and a.orderID =b.orderID";
//                    SQL($pdo, $delSql);
                    $pdo->query($delSql);
                }

                switch ($fieldArr['refundMethod']) {
                    case "bank":
                        //目前取消订单中, 只选择最后一条选择的退款方式
                        $bSql = "select ID from wx_user_bank where userID='" . $fieldArr["userID"] . "' order by lastModifyTime desc limit 1";
                        $bArr = SQL($pdo, $bSql, "", "one");
                        $userBankID = $bArr['ID'];
                        break;
                    case "weixin":
                        break;
                }

                $sql[] = "insert into `d_agent_order` set `orderID` = '$orderID',`payStatus` = '99',`status` = '1',`orderType`='$orderType',`userBankID`='$userBankID',`createdTime`='$createdTime'," . $fieldStr;
                #同时增加d_agent_order_tmp , 返回SQL!
                $refundArr = array("orderID" => $orderID, "fIDArr" => $fieldArr["fIDArr"], "userID" => $fieldArr["userID"]);
                $tmpSql = $this->refundDetailAdd($refundArr);
                $sql = mergeArray($sql, $tmpSql);
                break;
        }
//        print_r($sql);

        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = $msg;
            $ret['status'] = "1";
            $ret['result'] = "1";
            $ret['orderID'] = "$orderID";
        } else {
            $ret['status'] = "1";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $this->ret = $ret;
    }

#插入订单的临时信息表 ,返回SQL!
    function orderAddTmp($orderID, $fIDStr)
    {
        require_once sysPath . 'dataFunction/agentUser.data.php';
        require_once sysPath . 'dataFunction/agentFeeCounter.data.php';
        $aU = new agentUser();
        $con = array(
            'selStr' => "`fID`,`userID`,`name`,`pID`,`city`,`cityInsurance`,`status`,`soInsBeginDay`,`HFBeginDay`,`soInsNeedMonthNum`,`HFNeedMonthNum`,`mCost`,`mCostLimit`,
                         `soInsurance`,`radix`,`pension`,`hospitalization`,`employmentInjury`,`unemployment`,`PDIns`,`housingFund`,`HFRadix`,`uHFPer`,`pHFPer`",
            'conStr' => " `fID`  in( $fIDStr)"
        );
        $aU->agentUserBasic($con['selStr'], $con['conStr']);
        $aUserArr = $aU->agentUserArr;
        $feeCounterArr = $aU->feeCounter("mCost", "counter");
        #获取真实月份
        $aFC = new agentFeeCounter();

        foreach ($aUserArr as $key => $val) {
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "soInsBeginDay":
                        $val['soInsBeginMonth'] = $aFC->realMonth($v, "soIns");
                        break;
                    case "HFBeginDay":
                        $val['HFBeginMonth'] = $aFC->realMonth($v, "HF");
                        break;
                }
            }
            if ($feeCounterArr[$key]) {
                $val = array_merge($val, $feeCounterArr[$key]);
            }
            $tmpArr[$key] = $val;
        }
//        echo "<pre>";
//print_r($tmpArr);
        $fieldArr = array("fID", "name", "soInsurance", "housingFund", "soInsBeginMonth", "HFBeginMonth", "soInsNeedMonthNum", "HFNeedMonthNum", "soInsTotal", "HFTotal", "mCostTotal", "soInsNeedMonthNumTotal", "HFNeedMonthNumTotal", "mCostNeedMonthNumTotal");
        $inSql = "insert into `d_agent_order_tmp` set `orderID` = '$orderID',";
        foreach ($tmpArr as $key => $val) {
            $str = null;
            foreach ($fieldArr as $v) {
                switch ($v) {
                    case "soInsTotal":
                        $str .= "`$v`='" . $val['soInsFun']['total'] . "',";
                        break;
                    case "HFTotal":
                        $str .= "`$v`='" . $val['HFFun']['total'] . "',";
                        break;
                    case "mCostTotal":
                        $str .= "`$v`='" . $val['mCostFun']['total'] . "',";
                        break;
                    case "soInsNeedMonthNumTotal":
                        $str .= "`$v`='" . $val['soInsFun']['needMonthNumTotal'] . "',";
                        break;
                    case "HFNeedMonthNumTotal":
                        $str .= "`$v`='" . $val['HFFun']['needMonthNumTotal'] . "',";
                        break;
                    case "mCostNeedMonthNumTotal":
                        $str .= "`$v`='" . $val['mCostFun']['needMonthNumTotal'] . "',";
                        break;

                    default:
                        $str .= "`" . $v . "` = '" . $val[$v] . "',";
                        break;
                }
            }
            $str = rtrim($str, ",");
            $sql[] = $inSql . $str;
        }
//        print_r($sql);
        return $sql;

    }

    #添加退款详情信息, 返回SQL
    function refundDetailAdd($arr)
    {
        $pdo = $this->pdo;
        $now = timeStyle("dateTime");
        $fIDStr = implode(",", $arr['fIDArr']);
        $stopSql = "select a.*,b.name from `d_agent_stop` a LEFT JOIN `d_agent_personalInfo` b on a.fID=b.fID where a.fID in ($fIDStr) and a.status=0 and a.userID='" . $arr['userID'] . "'";
        $stopArr = SQL($pdo, $stopSql);
        $stopArr = keyArray($stopArr, "fID");
        foreach ($arr['fIDArr'] as $key => $val) {
            $sql[] = "insert into `d_refund_detail` set orderID='" . $arr['orderID'] . "',`fID`='$val',
                        `name`='" . $stopArr[$val]['name'] . "',`soInsStopMonth`='" . $stopArr[$val]['soInsStopMonth'] . "',`HFStopMonth`='" . $stopArr[$val]['HFStopMonth'] . "',`createdTime`='$now'";
        }
//        echo "<pre>";
//        print_r($sql);
        return $sql;
    }

    #修改订单
    function  orderEdit($fieldArr)
    {
        $pdo = $this->pdo;
        $now = timeStyle("dateTime");
        $up = "update  `d_agent_order` set lastModifyTime='$now',";
        //也可以完成批量状态更新
        foreach ($fieldArr as $key => $val) {
            //多维数组,更新多个订单
            $updateStr = null;
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "orderID":
                        break;
                    default:
                        $updateStr .= "`$k`='$v',";
                        break;
                }
            }
            $updateStr = rtrim($updateStr, ",");
            $sql[] = $up . $updateStr . " where `orderID`='$key'";
        }
//echo "<pre>";
//        print_r($sql);
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "成功";
            $ret['status'] = "1";
            $ret['result'] = "1";
        } else {
            $ret['status'] = "1";
            $ret ['msg'] = "orderEdit:" . $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $this->ret = $ret;
    }

    #关闭订单
    function  orderCancel($fieldArr)
    {
        $arr = array($fieldArr['orderID'] => array("status" => 0, "cancelReason" => $fieldArr['cancelReason']));
        $ret = $this->orderEdit($arr);
        return $this->ret = $ret;
    }

#删除订单,同时删除临时订单数据
    function  orderDel($orderIDStr)
    {
        $pdo = $this->pdo;
        $sql = "delete from  `d_agent_order` where `orderID` in('$orderIDStr')";
        $result = SQL($pdo, $sql);
        $sqltmp = "delete from `d_agent_order_tmp` where `orderID` in('$orderIDStr')";
        SQL($pdo, $sqltmp);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "删除成功";
            $ret['status'] = "1";
            $ret['result'] = "1";
        } else {
            $ret['status'] = "1";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $ret;
    }

#订单支付成功后,更新参保人状态
    function paidAction($orderArr)
    {
        if ($orderArr['payStatus'] == 1) {
            $orderID = $orderArr['orderID'];
            $b = new agentOrder();
            $oArr = $b->agentOrderBasic("`orderID`,`fIDStr`,`total`,`userID`", " orderID='$orderID'");
            $fIDStr = $oArr[$orderID]['fIDStr'];
            $a = new agentUser();
            $aUserArr = $a->agentUserBasic("`fID`,`status`,`soInsurance`,`housingFund`,`soInsBeginDay`,`HFBeginDay`", "`fID` in ($fIDStr)");
            foreach ($aUserArr as $key => $val) {
                foreach ($val as $k => $v) {
                    switch ($k) {
                        case "soInsurance":
                        case "housingFund":
                            if ($v != 0) {
                                $fieldArr[$key][$k] = "1";
                            }
                            break;
                    }
                    $fieldArr[$key]['status'] = "1";
                    $fieldArr[$key]['soInsModifyDate'] = $val['soInsBeginDay'];
                    $fieldArr[$key]['HFModifyDate'] = $val['HFBeginDay'];
                    $fieldArr[$key]['cBeginDay'] = timeStyle("date", "-");
                    $fieldArr[$key]['adminModifyTime'] = timeStyle("dateTime");
                    $fieldArr[$key]['status'] = "1";
                }

            }//end foreach $aUserArr
//            echo "<pre>";
//            print_r($fieldArr);
            $ret = $this->agentUserEdit($fieldArr);
            if ($ret['result'] == 1) {
                //更新订单明细
                $orderEditArr = array($orderID => array("orderID" => $orderID, "payStatus" => 1, "payMoney" => $orderArr['payMoney']));
                $ret = $this->orderEdit($orderEditArr);
                if ($ret['result'] == 1) {
                    //支付成功后, 设置流水账信息及个人余额
                    $billAddArr = array("orderID" => $orderID, "month" => timeStyle("Ym", ""), "userID" => $oArr[$orderID]['userID'], "income" => $orderArr['payMoney'], "billType" => $orderArr['billType']);
                    $ret = $this->billAdd($billAddArr);

                }
            }
//            echo "<pre>";
//            print_r($ret);

        }//endif
        $ret['userID'] = $orderArr['userID'];
        $ret['orderID'] = $orderID;
        $ret['payMoney'] = $orderArr['payMoney'];
        return $ret;

    }

    #申请退款订单生成 ,$fieldArr = array(fIDArr=>array(1,2),userID=>1)
    function refundAdd($fieldArr, $delOld = "true")
    {
        $ret = $this->orderAdd($fieldArr, $delOld, "99");

        return $ret;
    }

    #取消退款订单
    function refundCancel($fieldArr)
    {
        $pdo=$this->pdo;
        $arr = array($fieldArr['orderID'] => array("status" => 0, "message" => "用户取消退款"));
        //当用户的退款流程已经签收后,无法取消退款
        $exSql = "select ID,`payStatus` from `d_agent_order` where orderID ='" . $fieldArr['orderID'] . "'";
        $exRes = SQL($pdo, $exSql, "", "one");
        if($exRes['payStatus']!="99"){
            $ret['status'] = "1";
            $ret['msg'] = "退款已核算无法取消";
            $ret['result'] = "0";

        }else{
            $ret = $this->orderEdit($arr);
            if ($ret['result'] == 1) {
                $ret['msg'] = "取消成功";
            }
        }

        return $ret;
    }

    #填写退款信息,账号,姓名及银行相关信息
    function userBankAdd($fieldArr)
    {
        $pdo = $this->pdo;
        $now = timeStyle("dateTime");
        if (mobileNumValid($fieldArr['phone'])) {
            $ret['status'] = "1";
            $ret ['msg'] = "手机号输入错误";
            $ret['result'] = "0";
        }
        //验证是否存在相应的银行账号信息
        $exSql = "select ID from `wx_user_bank` where bankID ='" . $fieldArr['bankID'] . "'";
        $exRes = SQL($pdo, $exSql, "", "one");
        if ($ret['result'] != "0") {
            if ($exRes) {
                foreach ($fieldArr as $key => $val) {
                    switch ($key) {
                        case "userID":
                            break;
                        default:
                            $fieldStr .= "`$key`='$val',";
                            break;
                    }
                }
                $fieldStr = rtrim($fieldStr, ",");
                $sql[] = "update wx_user_bank set lastModifyTime='$now'," . $fieldStr . "where ID ='" . $exRes['ID'] . "'";
            } else {
                foreach ($fieldArr as $key => $val) {
                    $fieldStr .= "`$key`='$val',";
                }
                $fieldStr = rtrim($fieldStr, ",");
                $sql[] = "insert into wx_user_bank set `createdTime`='$now'," . $fieldStr;
            }
            $result = extraTransaction($pdo, $sql);
            $errMsg ['sql'] = $result ['error'];
            if (empty ($errMsg ['sql'])) {
                $ret ['msg'] = "成功";
                $ret['status'] = "1";
                $ret['result'] = "1";
            } else {
                $ret['status'] = "1";
                $ret ['msg'] = $errMsg ['sql'];
                $ret['result'] = "0";
            }
        }
//        print_r($sql);
        return $ret;
    }

    #编辑修改银行账户相关信息
    function userBankEdit($fieldArr)
    {

    }

    #新增流水账明细
    function billAdd($fieldArr)
    {
        $pdo = $this->pdo;
        $now = timeStyle("dateTime");

        $exSql = "select ID from `d_agent_user_bill` where orderID ='" . $fieldArr['orderID'] . "'";
        $exRes = SQL($pdo, $exSql, "", "one");
        if (!$exRes) {
            //不存在该订单号则添加否则报错

            #求余额
            $aB = new agentBill();
            $aB->agentUserBillBasic("ID,userID,remainder", "`userID`='" . $fieldArr['userID'] . "'");
            $remainderArr = $aB->remainder();
            //如果有 收入 income ,或者支出 expenditure  ,设置余额
            $incomeOrExpenditure = $fieldArr['income'] ?: $fieldArr['expenditure'];
            $remainder = $remainderArr[$fieldArr['userID'] ] + $incomeOrExpenditure;
            foreach ($fieldArr as $key => $val) {
                $fieldStr .= "`$key`='$val',";
            }
            $fieldStr = rtrim($fieldStr, ",");
            $sql[] = "insert into d_agent_user_bill set `createdTime`='$now',`remainder`=$remainder ," . $fieldStr;

        } else {
            $ret['status'] = "1";
            $ret['msg'] = "警报: 支付已成功,无需重复支付";
            $ret['result'] = "0";
            return $ret;
        }
//        print_r($sql);
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "成功";
            $ret['status'] = "1";
            $ret['result'] = "1";
        } else {
            $ret['status'] = "1";
            $ret['msg'] = "billAdd:" . $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $ret;
    }

    #修改流水账明细
    function billEdit($fieldArr)
    {

    }
}