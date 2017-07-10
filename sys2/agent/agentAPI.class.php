<?php
/**
 * 人事代理对接类
 ***/

#链接代理通用类
require_once "agentClassLink.class.php";

//$beginMonth='2016-12';
//$endMonth = '2017-03';
////$beginMonth = $soInsBeginMonth < $HFBeginMonth ? timeStyle("Ym", "-", strtotime($soInsBeginMonth . "01")) : timeStyle("Ym", "-", strtotime($HFBeginMonth . "01"));
////$endMonth = $soInsEndMonth > $HFEndMonth ? timeStyle("Ym", "-", strtotime($soInsEndMonth . "01")) : timeStyle("Ym", "-", strtotime($HFEndMonth . "01"));
//list($by, $bm) = explode("-", $beginMonth);
//list($ey, $em) = explode("-", $endMonth);
//$needMonthNum = ($ey - $by) * 12 + ($em - $bm) + 1;
//echo "开始年份:" .$by."-".$bm;
//echo "<br>结束年份:".$ey."-".$em;
//echo "<br>相差多少个月:".$needMonthNum;


//$param = array("fID" => "45", "HFRadix" => "2000", "radix" => "2800", "soInsurance" => 1, "housingFund" => 0, "city" => "0755", "cityInsurance" => "2",
//    "soInsBeginMonth" => "2016-01", "HFBeginMonth" => "2016-02", "soInsNeedMonthNum" => 4, "HFNeedMonthNum" => "6");
//agentUserData($param);
//$param = array("HFRadix" => 2000, "radix" => "3000", "city" => "0755", "cityInsurance" => "2", "city" => "0755");
//counterPer($param);

//$param = array("HFRadix" => 2000, "radix" => "3000", "city" => "0755", "cityInsurance" => "2", "city" => "0755");
//counterResult($param);

//$param = array("userID" => "1","name"=>"hsd","pID"=>'350583198610228374',"pIDImgUrl"=>"350583198610228374","mobilePhone"=>"13538060870","city"=>"0755","cityInsurance"=>"2");
//    agentUserAdd($param);

//$param = array("fID" => 16);
//agentUserDetail($param);

//$param = array("fID" => "47", "HFRadix" => "2000", "radix" => "3000", "soInsurance" => 1, "housingFund" => 1, "city" => "0755", "cityInsurance" => "2",
//    "soInsBeginMonth" => "2016-01", "HFBeginMonth" => "2016-02", "soInsNeedMonthNum" => 3, "HFNeedMonthNum" => "24");
//agentUserMoney($param);

//$param=array("fIDArr"=>array(25));
//agentUserDel($param);
////
//$param=array("1"=>array("fID"=>"1","stopMonth"=> "2015-12","soIns"=>"1","HF"=>"1","userID"=>"1"),"2"=>array("fID"=>"2","stopMonth"=> "2016-12","soIns"=>"0","HF"=>"1","userID"=>"1"));
// agentUserStop($param);

//$param=array("fIDArr"=>array("1","2"));
//agentUserCancelStop($param);

//$param=array("fIDArr"=>array("1","2"));
//agentUserRenew($param);

//$param['out_trade_no'] = "2016123121231";
//$param['payStatus'] = 1;
//$param['total_fee'] = "0.01";
//$param['return_code'] = "SUCCESS" ;
//$param['result_code'] = "SUCCESS";
//paidAction($param);

//$param = array('status' => 1, "userID" => 1);
//agentUserLists($param);

//$param =array("orderID"=>"20151229175302703");
//getOrderDetail($param);

//$param  = array("fIDArr"=>array(15,16) , 'total'=>"3000" ,'userID'=>1);
//createOrder($param);

//$param = array("userID"=>1);
//messageList($param);

//$param = array("ID"=>2);
//messageRead($param);
////
//$param = array("userID" => 1, "password" => "123", "bank" => "1", "code" => "2112312312312312312312", "mobilePhone" => "13538060870", "address" => "八卦岭支行", "fIDArr" => array(15, 16));
//refundAdd($param);
//$param = array("userID"=>1,"password"=>"123","bank"=>"1","code"=>"2112312312312312312312","mobilePhone"=>"13538060870","address"=>"八卦岭支行","fIDArr"=>array(15,16));
//userBankAdd($param);
//$param = array("userID" => 1, "password" => 123);
//validPassword($param);

//$param['orderID']="20160107121014683563";
// refundCancel($param);


//$param['orderID']="20160121090312825313";
// refundDetail($param);

//$param = array("userID"=>1);
//agentUserBill($param);

//执行获取请求参数
getParm();
#解析参数 ,及回传信息
function getParm()
{
    $aSet = new agencySet();
    $key = $aSet->agencySetArr("wx_encrypt_key");
    $model = $_GET ['model'];
    $content = file_get_contents('php://input');
    $json = think_decrypt($content, $key);
    $param = json_decode($json, true);
//    $param['userID'] = 1; //TODO 项目完成后删除
    $ret = call_user_func($model, $param);
//        print_r($ret);
    $ret = json_encode($ret);
//    $ret = think_encrypt($ret, $key);
    echo $ret;
}

//需要封装的结果
function dataCreate($data)
{
    $count = count($data);
    if (is_null($data)) {
        $ret['msg'] = "未获取记录";
        $ret['status'] = 0;
        $ret['result'] = 0;
    } else {
        $ret['msg'] = null;
        $ret['status'] = 1;
        $ret['result'] = 1;
        $ret['count'] = $count;
        $ret ['data'] = $data;
    }
    return $ret;
}

#代理基础信息设置
function agentBasicSet($param)
{
    $aSet = new agencySet();
    $aSet->p = $GLOBALS['pdo'];
    $data = $aSet->agencySetArr();
    $data = dataCreate($data);
    return $data;
}

#获取代理人员信息
function agentUser($param)
{
    $aUser = new agentUser();
//    $aUser->pdo = $GLOBALS['pdo'];
//    $userID  = $param['userID'];
//    $status = $param['status']?:1;
    $selStr = $param['selStr'];
    $conStr = $param ['conStr'];
    $data = $aUser->agentUserBasic($selStr, $conStr);
    $data = dataCreate($data);
    return $data;
}

#获取参保人列表,已经支付过后的人员名单 $param = array("userID"=>"1","status"=>"1")
function agentUserLists($param)
{
    $fC = new agentUser();
    $status = $param['status'];
    //查找停缴中人员,联合查询 d_agent_stop
    $stopUserArr = $fC->stopUserBasic("*", " `userID`='" . $param['userID'] . "' and `status`='0'");
    $stopUserArr = keyArray($stopUserArr, "fID");
    $fIDArr = array_keys($stopUserArr);
    if ($status == "99") {
        $fIDStr = implode(",", $fIDArr);
        $selStr = "`fID`,`userID`,`name`,`mobilePhone`,`city`,`cityInsurance`";
        $conStr = "`fID` in ($fIDStr)";
    } else {
        $status = $param['status'] != 0 ? "'1','2'" : '0';
        $selStr = "`fID`,`userID`,`name`,`mobilePhone`,`city`,`cityInsurance`,`status`,`soInsBeginDay`,`HFBeginDay`,`soInsNeedMonthNum`,`HFNeedMonthNum`,`mCost`,`mCostLimit`,
        `soInsurance`,`radix`,`pension`,`hospitalization`,`employmentInjury`,`unemployment`,`PDIns`,`housingFund`,`HFRadix`,`uHFPer`,`pHFPer`";
        $conStr = " userID = '" . $param['userID'] . "' and `status` in (" . $status . ") and isUserDelete!=1";
        $feeCounterArr = $fC->feeCounter();
    }
    $con = array(
        'selStr' => $selStr,
        'conStr' => $conStr
    );

    $agentUserArr = $fC->agentUserBasic($con['selStr'], $con['conStr']);


    #获取真实月份
    $aFC = new agentFeeCounter();
    #验证是否未停保中
    foreach ($agentUserArr as $key => $val) {
        foreach ($val as $k => $v) {
            switch ($k) {
                case "soInsBeginDay":
                    $val['soInsBeginMonth'] = $aFC->realMonth($v, "soIns", "-");
                    $mArr = array($k => $v, "soInsNeedMonthNum" => $val['soInsNeedMonthNum']);
                    $actionMonth = $aFC->actionMonth($mArr, "soIns");
                    if ($actionMonth) {
                        $val['soInsEndMonth'] = date("Y-m", strtotime(max($actionMonth) . "01"));
                    } else {
                        $val['soInsEndMonth'] = "未购买";
                    }

                    break;
                case "HFBeginDay":
                    $val['HFBeginMonth'] = $aFC->realMonth($v, "HF", "-");
                    $mArr = array($k => $v, "HFNeedMonthNum" => $val['HFNeedMonthNum']);
                    $actionMonth = $aFC->actionMonth($mArr, "HF");
                    if ($actionMonth) {
                        $val['HFEndMonth'] = date("Y-m", strtotime(max($actionMonth) . "01"));
                    } else {
                        $val['HFEndMonth'] = "未购买";
                    }
                    break;
            }
        }
        if ($feeCounterArr[$key]) {
            $val = array_merge($val, $feeCounterArr[$key]);
        }
        if ($stopUserArr[$key]) {
            if ($param['status'] == "1") {
                continue;
            }
            $val['showTxt'] = "申请停缴月份: ";
            if ($stopUserArr[$key]['soInsStopMonth'])
                $val['showTxt'] = $val['showTxt'] . "[社保 <font color='#6bb022'>" . timeStyle("Ym", "-", strtotime($stopUserArr[$key]['soInsStopMonth'] . "01")) . "</font>]";
            if ($stopUserArr[$key]['HFStopMonth'])
                $val['showTxt'] = $val['showTxt'] . "[公积金 <font color='#6bb022'>" . timeStyle("Ym", "-", strtotime($stopUserArr[$key]['HFStopMonth'] . "01")) . "</font>]";
        } else {
            $val['showTxt'] = "到期年月:[社保 <font color='#6bb022'>" . $val['soInsEndMonth'] . "</font>]  [公积金 <font color='#6bb022'>" . $val['HFEndMonth'] . "</font>]";
        }
        $data[$key] = $val;
    }
//    echo "<pre>";
//    print_r($stopUserArr);
//    print_r($data);
    $data = dataCreate($data);
    return $data;

}

#获取参保人列表,未支付,或者续缴的人员名单
function personLists($param)
{
    $status = $param['status'] ? $param['status'] : 5;
    $con = array(
        'selStr' => "`fID`,`userID`,`name`,`pID`,`city`,`cityInsurance`,`status`,`soInsBeginDay`,`HFBeginDay`,`soInsNeedMonthNum`,`HFNeedMonthNum`,`mCost`,`mCostLimit`,
        `soInsurance`,`radix`,`pension`,`hospitalization`,`employmentInjury`,`unemployment`,`PDIns`,`housingFund`,`HFRadix`,`uHFPer`,`pHFPer`",
        'conStr' => " userID = '" . $param['userID'] . "' and `status` ='$status' and isUserDelete!=1"
    );
    $fC = new agentUser();
    $agentUserArr = $fC->agentUserBasic($con['selStr'], $con['conStr']);
    $feeCounterArr = $fC->feeCounter();
    #获取真实月份
    $aFC = new agentFeeCounter();
    foreach ($agentUserArr as $key => $val) {
        foreach ($val as $k => $v) {
            switch ($k) {
                case "soInsBeginDay":
                    $val['soInsBeginMonth'] = $aFC->realMonth($v, "soIns", "-");
                    break;
                case "HFBeginDay":
                    $val['HFBeginMonth'] = $aFC->realMonth($v, "HF", "-");
                    break;
            }
        }
        if ($feeCounterArr[$key]) {
            $val = array_merge($val, $feeCounterArr[$key]);
        }
        $data[$key] = $val;
    }
//    print_r($data);
    $data = dataCreate($data);
    return $data;

}

#获取参保人个人参保详情
function agentUserDetail($param)
{
    $con = array(
        'selStr' => "`fID`,`userID`,`name`,`pID`,`city`,`cityInsurance`,`status`,`soInsurance`,`housingFund`,
                     `radix`,`HFRadix`,`soInsBeginDay`,`HFBeginDay`,`soInsNeedMonthNum`,`HFNeedMonthNum`,`mobilePhone`,`sID`,`HFID`,`status`
                     `mCostLimit`,`mCost`,`pension`,`hospitalization`,`employmentInjury`,`unemployment`,`PDIns`,`uHFPer`,`pHFPer`",
        'conStr' => " fID = '" . $param['fID'] . "'"
    );
    $aUser = new agentUser();
    $aUserArr = $aUser->agentUserBasic($con['selStr'], $con['conStr']);
    $feeCounterArr = $aUser->feeCounter("mCost", "basic");
    $checkStopArr = $aUser->checkUserStop();
    $soInsOutArr = $aUser->personalRecords($param['fID'], "`ID`,`fID`,`soInsDate`,`total`", "soIns");
    $HFOutArr = $aUser->personalRecords($param['fID'], "`ID`,`fID`,`HFDate`,`total`", "HF");
    $soInsOutArr = keyArray($soInsOutArr, "soInsDate");
    $HFOutArr = keyArray($HFOutArr, "HFDate");
    if ($soInsOutArr && $HFOutArr) {
        $monthArr = array_merge(array_keys($soInsOutArr), array_keys($HFOutArr));
        rsort($monthArr);
        foreach ($monthArr as $val) {
            $recordsArr[$val]['paydate'] = date("Y年m月", strtotime($val . "01"));
            $recordsArr[$val]['soInsExpenditure'] = $soInsOutArr[$val]['total'] ?: 0;
            $recordsArr[$val]['HFExpenditure'] = $HFOutArr[$val]['total'] ?: 0;
        }
    } elseif ($soInsOutArr && !$HFOutArr) {
        foreach ($soInsOutArr as $key => $val) {
            $recordsArr[$key]['paydate'] = date("Y年m月", strtotime($key . "01"));
            $recordsArr[$key]['soInsExpenditure'] = $soInsOutArr[$key]['total'] ?: 0;
        }
    } elseif ($HFOutArr) {
        foreach ($HFOutArr as $key => $val) {
            $recordsArr[$key]['paydate'] = date("Y年m月", strtotime($key . "01"));
            $recordsArr[$key]['HFExpenditure'] = $HFOutArr[$key]['total'] ?: 0;
        }
    }
#获取状态初始化
    $aSet = new agencySet();
    $statusTxt = $aSet->agencySetArr("statusTxt");
#获取真实月份
    $aFC = new agentFeeCounter();
    foreach ($aUserArr as $key => $val) {
        $mArr = null;
        foreach ($val as $k => $v) {
            switch ($k) {
                case "soInsBeginDay":
                    $val['soInsBeginMonth'] = $aFC->realMonth($v, "soIns", "-");
                    $mArr = array($k => $v, "soInsNeedMonthNum" => $val['soInsNeedMonthNum']);
                    $actionMonth = $aFC->actionMonth($mArr, "soIns");
                    if ($actionMonth) {
                        $val['soInsEndMonth'] = date("Y-m", strtotime(max($actionMonth) . "01"));
                    } else {
                        $val['soInsEndMonth'] = "未购买";
                    }
                    break;
                case "HFBeginDay":
                    $val['HFBeginMonth'] = $aFC->realMonth($v, "HF", "-");
                    $mArr = array($k => $v, "HFNeedMonthNum" => $val['HFNeedMonthNum']);
                    $actionMonth = $aFC->actionMonth($mArr, "HF");
                    if ($actionMonth) {
                        $val['HFEndMonth'] = date("Y-m", strtotime(max($actionMonth) . "01"));
                    } else {
                        $val['HFEndMonth'] = "未购买";
                    }
                    break;
                case "status":
                    $val['statusTxt'] = $statusTxt[$v];
                    break;
            }
        }
        if ($feeCounterArr[$key]) {
            $val = array_merge($val, $feeCounterArr[$key]);
        }
        if (array_key_exists($key, $checkStopArr)) {
            $val['stopping'] = "1";
            $val['statusTxt'] = "停缴中";
        }

        $data = $val;
    }
    //获取开始购买月份数组
    $today = timeStyle("d");
    $soInsInTurnDay = insuranceInTurn("soIns");
    $HFInTurnDay = insuranceInTurn("HF");
    if ($today < $soInsInTurnDay) {
        $b = date("Y-m-01");
    } else {
        $b = date("Y-m-01", strtotime("+1 month"));
    }
    if ($today < $HFInTurnDay) {
        $c = date("Y-m-01");
    } else {
        $c = date("Y-m-01", strtotime("+1 month"));
    }

    for ($i = 0; $i < 3; $i++) {
        $dk = date("Y-m", strtotime("+$i months", strtotime($b)));
        $ek = date("Y-m", strtotime("+$i months", strtotime($c)));
        $dv = $dk;
        $ev = $ek;
        $data['soInsBeginMonthList'][$dk] = $dv;
        $data['HFBeginMonthList'][$ek] = $ev;
    }
    $data['records'] = $recordsArr;
    $data = dataCreate($data);
//    echo "<pre>";
//    print_r($data);
    return $data;

}


#参保人流水账记录  $param = array("userID"=>1)
function agentUserBill($param)
{
    $aB = new agentBill();
    $aB->agentUserBillBasic("*", "`userID`='" . $param['userID'] . "'");
    $data = $aB->userBillRecreate();
    $data = $data[$param['userID']];
    $data = dataCreate($data);
//    echo "<pre>";
//    print_r($data);
    return $data;
}

#新增参保人
function agentUserAdd($param)
{
    //
    $aSet = new agencySet();
    //
    $add = new agentAction();
    $add->pdo = $GLOBALS['pdo'];
    //默认参保方案设置
    $soInsBeginDay = timeStyle("date", "-");
    $HFBeginDay = $soInsBeginDay;
//    $mCost = ();
    $defaultArr = array("status" => "5", "soInsurance" => 5, "housingFund" => 5, "soInsBeginDay" => $soInsBeginDay, "HFBeginDay" => $HFBeginDay, "soInsNeedMonthNum" => 6, "HFNeedMonthNum" => 3);
    $soInsDefaultSetArr = $aSet->soInsDefaultSet($param['city'], $param['cityInsurance']);
    $HFDefaultSetArr = $aSet->HFDefaultSet($param['city'], $param['cityInsurance']);
    //目前只接受5%的比例
    $param = array_merge($defaultArr, $soInsDefaultSetArr, $HFDefaultSetArr, $param);
    //管理费预算
    $mC = new agentFeeCounter();
    $mCostArr = $mC->mCostFun($param);
    $param['mCost'] = $mCostArr['total'];
    $param['createdByUserID'] = $param['userID'];
//    echo "<pre>";
//    print_r($param);
    $add->agentUserAdd($param);
    $ret = $add->ret;
    return $ret;

}

#修改参保人信息 , $fieldArr= array ([fID1]=>array(),[fID2]=>array()), $param=array("fID"=>1,"name"=>"张三" .. ... )
function agentUserEdit($param)
{
    $edit = new agentAction();
    $fieldArr[$param['fID']] = $param;
    $edit->agentUserEdit($fieldArr);
    $ret = $edit->ret;
    return $ret;
}

#修改参保人参保方案, $param = array("fID" => "49", "HFRadix" => "2000", "radix" => "2800", "soInsurance" => 1, "housingFund" => 0, "city" => "0755", "cityInsurance" => "2","soInsBeginMonth" => "2016-01", "HFBeginMonth" => "2016-02", "soInsNeedMonthNum" => 4, "HFNeedMonthNum" => "6");
function agentUserData($param)
{
    //初始化参数
    $aSet = new agencySet();
    //
    $edit = new agentAction();
    //当无值传递时,强制传值设置为0
    $param['soInsurance'] = $param['soInsurance'] ? $param['soInsurance'] : 0;
    $param['housingFund'] = $param['housingFund'] ? $param['housingFund'] : 0;
    foreach ($param as $key => $val) {
        switch ($key) {
            case "soInsBeginMonth":
                if ($param['soInsurance'] != 0) {
                    //如果当前日期加多1个月小月购买月,则为购买月的在封账日的2天后,进行购买, 否则结算为最近才购买日
                    $beginMonthTime = strtotime($val . "-01");
                    $today = timeStyle("d");
                    $inTurnDay = insuranceInTurn("soIns");
                    $toMonth = strtotime("-1 month", $beginMonthTime);
                    if (strtotime("+1 month") > $beginMonthTime) {
                        if ($today < $inTurnDay) {
                            $tmp['soInsBeginDay'] = $val . "-" . $today;
                        } else {
                            $tmp['soInsBeginDay'] = date("Y-m", $toMonth) . "-" . $today;
                        }
                    } else {
                        $tmp['soInsBeginDay'] = date("Y-m", $toMonth) . "-" . ($inTurnDay + 2);
                    }
                }
                break;
            case "HFBeginMonth":
                if ($param['housingFund'] != 0) {
                    //如果当前日期加多1个月小月购买月,则为购买月的在封账日的2天后,进行购买, 否则结算为最近才购买日
                    $beginMonthTime = strtotime($val . "-01");
                    $today = timeStyle("d");
                    $inTurnDay = insuranceInTurn("HF");
                    $toMonth = strtotime("-1 month", $beginMonthTime);
                    if (strtotime("+1 month") > $beginMonthTime) {
                        if ($today < $inTurnDay) {
                            $tmp['HFBeginDay'] = $val . "-" . $today;
                        } else {
                            $tmp['HFBeginDay'] = date("Y-m", $toMonth) . "-" . $today;
                        }
                    } else {
                        $tmp['HFBeginDay'] = date("Y-m", $toMonth) . "-" . ($inTurnDay + 2);
                    }
                }
                break;
            //如果有选中,则值设定为5,同时设置购买选项
            case "soInsurance":
                if ($val != 0) {
                    //设置购买社保选项
                    $soInsDefaultSetArr = $aSet->soInsDefaultSet($param['city'], $param['cityInsurance']);
                    $tmp[$key] = 5;
                }else{
                    $tmp[$key] = 0;
                }
                break;
            case "housingFund":
                if ($val != 0) {
                    $HFDefaultSetArr = $aSet->HFDefaultSet($param['city'], $param['cityInsurance']);
                    $tmp[$key] = 5;
                }else{
                    $tmp[$key] = 0;
                }
                break;
            default:
                $tmp[$key] = $val;
                break;
        }
    }
    //两种不同参数的覆盖 ,当不购买社保或公积金时, 覆盖对应参数
    if ($param['soInsurance'] != 0 && $param['housingFund'] != 0) {
        $fieldArr[$param["fID"]] = array_merge($soInsDefaultSetArr, $HFDefaultSetArr, $tmp);
    } elseif ($param['soInsurance'] == 0 && $param['housingFund'] != 0) {
        $soInsDefaultSetArr = $aSet->soInsDefaultSet($param['city'], $param['cityInsurance'], "0");
        $HFDefaultSetArr = $aSet->HFDefaultSet($param['city'], $param['cityInsurance'], "1");
        $fieldArr[$param["fID"]] = array_merge($HFDefaultSetArr, $tmp, $soInsDefaultSetArr);
    } elseif ($param['soInsurance'] != 0 && $param['housingFund'] == 0) {
        $soInsDefaultSetArr = $aSet->soInsDefaultSet($param['city'], $param['cityInsurance'], "1");
        $HFDefaultSetArr = $aSet->HFDefaultSet($param['city'], $param['cityInsurance'], "0");
        $fieldArr[$param["fID"]] = array_merge($soInsDefaultSetArr, $tmp, $HFDefaultSetArr);
    } else {
        $HFDefaultSetArr = $aSet->HFDefaultSet($param['city'], $param['cityInsurance'], "0");
        $soInsDefaultSetArr = $aSet->soInsDefaultSet($param['city'], $param['cityInsurance'], "0");
        $fieldArr[$param["fID"]] = array_merge($tmp, $soInsDefaultSetArr, $HFDefaultSetArr);
    }
//管理费预算
    $aU = new agentUser();
    $aUserArr= $aU->agentUserBasic("`fID`,`mCostLimit`","`fID`='".$param['fID']."'");
    $param['mCostLimit'] = $aUserArr[$param['fID']]['mCostLimit'];
    $mC = new agentFeeCounter();
    $mCostArr = $mC->mCostFun($param);
    $fieldArr[$param["fID"]]['mCost'] = $mCostArr['total'];
//    echo "<pre>";
//    print_r($aUserArr);
    $edit->agentUserEdit($fieldArr);
    $ret = $edit->ret;
//    print_r($ret);
    return $ret;
}

#核算算保费明细
function agentUserMoney($param)
{
    $aF = new agentFeeCounter();
    //初始化参数
    foreach ($param as $key => $val) {
        switch ($key) {
            case "cityInsurance":
                if ($val == "4")
                    $personalInfoArr['hospitalization'] = "1";
                elseif ($val == "3")
                    $personalInfoArr['hospitalization'] = "4";
                else
                    $personalInfoArr['hospitalization'] = $val;
                break;

            default:
                $personalInfoArr[$key] = $val;
                break;
        }
    }
    if ($param['soInsurance'] != 0) {

        $personalInfoArr['cityInsurance'] = $param['cityInsurance'];
        $personalInfoArr["pension"] = "1";
        $personalInfoArr["employmentInjury"] = "1";
        $personalInfoArr["unemployment"] = "1";
        $personalInfoArr["PDIns"] = "1";
        $soInsFun = $aF->soInsFun($personalInfoArr, $param['soInsBeginMonth'], $param['soInsNeedMonthNum']);
    }
    if ($param['housingFund'] != 0) {
        //目前只接受5%的比例
        $aSet = new agencySet();
        $HFPercent = $aSet->agencySetArr("activeCity");
        $personalInfoArr['uHFPer'] = $HFPercent[$param['city']]['HFPercent']["1"]['uHFPer'];
        $personalInfoArr['pHFPer'] = $HFPercent[$param['city']]['HFPercent']["1"]['pHFPer'];
        $HFFun = $aF->HFFun($personalInfoArr, $param['HFBeginMonth'], $param['HFNeedMonthNum']);
    }
    $aU = new agentUser();
    $aUserArr= $aU->agentUserBasic("`fID`,`mCost`,`mCostLimit`","`fID`='".$param['fID']."'");
    $personalInfoArr['mCostLimit'] = $aUserArr[$param['fID']]['mCostLimit'];
    $personalInfoArr['mCost'] = $aUserArr[$param['fID']]['mCost'];
    $mCostFun = $aF->mCostFun($personalInfoArr, "counter");
    $data = array("soInsFun" => $soInsFun, "HFFun" => $HFFun, "mCostFun" => $mCostFun, "soInsurance" => intval($param['soInsurance']), "housingFund" => intval($param['housingFund']));
    $data = dataCreate($data);
//    echo "<pre>";
//    print_r($personalInfoArr);
//    print_r($data);
    return $data;
}

#删除参保人 $param=array("fID"=>"1")
function agentUserDel($param)
{
    $del = new agentAction();
    $fieldArr[$param['fID']]['fID'] = $param['fID'];
    $fieldArr[$param['fID']]['isUserDelete'] = "1";
    $del->agentUserEdit($fieldArr);
    $ret = $del->ret;
    return $ret;
}

#批量续缴 $param=>array("fIDArr"=>array("1","2"))
function agentUserRenew($param)
{
    $r = new agentAction();
    //设置状态为 申缴中
    foreach ($param['fIDArr'] as $val) {
        $fieldArr[$val]['fID'] = $val;
        $fieldArr[$val]['status'] = "2";
        $fieldArr[$val]['lastModifyTime'] = timeStyle("dateTime");
    }

    $r->agentUserEdit($fieldArr);
    $ret = $r->ret;
    return $ret;
}

#停缴 $param=>array("[fID]"=>array("fID"=>"1,"stopMonth"=> 2015-12,"soIns"=>"1","HF"=>"0","userID"=>1))
function agentUserStop($param)
{

    //todo  项目完成后删除这段
//    unset($param['userID']);
    foreach ($param as $key => $val) {
        $param[$key]['stopMonth'] = date("Ym", strtotime($val['stopMonth'] . "-01"));
        $param[$key]['createdByUserID'] = $val['userID'];
        //todo  项目完成后删除这段
//        $param[$key]['userID'] = 1;
    }
    $stop = new agentAction();
    $ret = $stop->agentUserStop($param);
    $ret['param'] = $param;
    return $ret;
}

#取消停缴$param=>array("[fIDArr]"=>array("1","2"))
function agentUserCancelStop($param)
{
    $c = new agentAction();
    $ret = $c->agentUserCancelStop($param['fIDArr']);
    return $ret;
}

#点击结算生成订单 $param  = array([fIDArr]=> , ['total']=> ,['userID'])
function createOrder($param)
{
    $aSet = new agencySet();
    $wxTemplateIDArr = $aSet->agencySetArr("wx_templateID");
    $create = new agentAction();
    $ret = $create->orderAdd($param);
    if ($ret['result'] == 1) {
        //生成下单通知,并推送给微信
//        $url =httpPath."weChat/paiqian/index.php?s=/addon/Paiqian/Wap/choosePayType/orderID/".$ret['orderID'].".html";
        $url = "http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/choosePayType/orderID/" . $ret['orderID'] . ".html";
        $fieldArr['sender'] = "1";
        $fieldArr['receiver'] = $param['userID'];
        $fieldArr['sendTime'] = timeStyle("dateTime");
        $fieldArr['content'] = "成功生成投保订单,订单号为: " . $ret['orderID'] . "  , 请在订单有效期内完成支付 ,<a href=\'$url\'>点击查看详情</a>";
        $fieldArr['level'] = "1";
        $fieldArr['fromTo'] = "4";
        $wxFieldArr['uid'] = $param['userID'];
        $wxFieldArr['templateID'] = $wxTemplateIDArr['orderCreate']['ID'];
        $wxFieldArr['url'] = $url;
        $wxparam ['data'] ['first'] ['value'] = "投保订单已生成";
        $wxparam ['data'] ['first'] ['color'] = "#173177";
        $wxparam ['data'] ['keyword1'] ['value'] = $fieldArr['sendTime'];
        $wxparam ['data'] ['keyword1'] ['color'] = "#173177";
        $wxparam ['data'] ['keyword2'] ['value'] = "缴交社保";
        $wxparam ['data'] ['keyword2'] ['color'] = "#173177";
        $wxparam ['data'] ['keyword3'] ['value'] = $ret['orderID'];
        $wxparam ['data'] ['keyword3'] ['color'] = "#E60B43";
        $wxparam ['data'] ['remark'] ['value'] = "恭喜您下单成功,请在订单有效期内完成支付";
        $wxparam ['data'] ['remark'] ['color'] = "#173177";
        $wxFieldArr['param'] = serialize($wxparam);
        $ma = new msgAction();
        $ma->msgAdd($fieldArr);
        $ma->pdo = $GLOBALS['pdo'];
        $ma->wx_msgAdd($wxFieldArr);
    }

    return $ret;

}

#订单列表
function getOrderLists($param)
{
    if ($param['payStatus'] == -1) {
        $payStatus = "0,1,5,95,98,99";
    } elseif ($param['payStatus'] == 99) {
        $payStatus = "95,98,99";
    } else {
        $payStatus = $param['payStatus'];
    }
    $con = array(
        'selStr' => "`userID`,`orderID`,`fIDStr`,`payStatus`,`status`,`total`,`orderType`",
        'conStr' => " userID = '" . $param['userID'] . "' and `payStatus` in ($payStatus) and status='1'");
    $aO = new agentOrder();
    $aOrderArr = $aO->agentOrderBasic($con['selStr'], $con['conStr']);
    $aSet = new agencySet();
    $payStatusSet = $aSet->agencySetArr("payStatus");
    foreach ($aOrderArr as $key => $val) {
        foreach ($val as $k => $v) {
            switch ($k) {
                case "fIDStr":
                    $fIDArr = explode(",", $v);
                    $personCount = count($fIDArr);
                    $val['person_count'] = $personCount;
                    break;
                case "payStatus":
                    $val['payStatus_title'] = $payStatusSet[$v];
                    break;

            }
        }
        $data[$key] = $val;
    }

    $data = dataCreate($data);
    return $data;
}

#订单详情
function getOrderDetail($param)
{
    $con = array(
        'selStr' => "`userID`,`orderID`,`fIDStr`,`payStatus`,`status`,`total`",
        'conStr' => " `orderID`='" . $param['orderID'] . "' and status='1'");
    $aO = new agentOrder();
    $aOrderArr = $aO->agentOrderBasic($con['selStr'], $con['conStr']);
    $oExtraArr = $aO->orderExtra();
    $aSet = new agencySet();
    $payStatusSet = $aSet->agencySetArr("payStatus");
    foreach ($aOrderArr as $key => $val) {
        foreach ($val as $k => $v) {
            switch ($k) {
                case "fIDStr":
                    $fIDArr = explode(",", $v);
                    $personCount = count($fIDArr);
                    $val['person_count'] = $personCount;
                    break;
                case "payStatus":
                    $val['payStatus_title'] = $payStatusSet[$v];
                    break;
                case "soInsBeginMonth":
                case "HFBeginMonth":
                    $val[$k] = timeStyle("Ym", "-", strtotime($v . "01"));
                    break;
//                case "orderID":
//                    $val['orderID']= $v.time();
//                    break;
            }
        }
        $data = $val;
    }

    $data['data'] = $oExtraArr;
//    echo "<pre>";
//    print_r($data);
    $data = dataCreate($data);
    return $data;

}

#取消订单
function orderCancel($param)
{
    $fieldArr = array("orderID" => $param['orderID'], "cancelReason" => $param['msgID']);
    $aO = new agentAction();
    $ret = $aO->orderCancel($fieldArr);
    return $ret;
}

#首页计算器
function counterResult($param)
{
    //
    $aSet = new agencySet();
    //
    $aF = new agentFeeCounter();
    if ($param['radix'] != 0) {
        //初始化参数
        $soInsDefaultSet = $aSet->soInsDefaultSet($param['city'], $param['cityInsurance']);
        $personalInfoArr = array_merge($soInsDefaultSet, $param);
        $personalInfoArr["soInsurance"] = "1";
        $soInsFun = $aF->soInsFun($personalInfoArr);
    }
    if ($param['HFRadix'] != 0) {
        //目前只接受5%的比例

        $HFPercent = $aSet->HFDefaultSet($param['city'], $param['cityInsurance']);
        $personalInfoArr['uHFPer'] = $HFPercent['uHFPer'];
        $personalInfoArr['pHFPer'] = $HFPercent['pHFPer'];
        $personalInfoArr["housingFund"] = "1";

        $HFFun = $aF->HFFun($personalInfoArr);
    }

    $data = array("soInsFun" => $soInsFun, "HFFun" => $HFFun);
    $data = dataCreate($data);
    return $data;
}

#测算中,获取比例表
function counterPer($param)
{
    $aF = new agentFeeCounter();
    $soInsArr = array("city" => $param['city'], "soInsDate" => date("Ym"), "type" => $param['cityInsurance']);
    $soInsSetArr = $aF->soInsSet($soInsArr);
    $soInsPer = $soInsSetArr[$param['cityInsurance']];
    $aSet = new agencySet();
    $data = $soInsPer;
    $HFDefaultSetArr = $aSet->HFDefaultSet($param['city'], $param['cityInsurance']);
    $data['uHFPer'] = $HFDefaultSetArr['uHFPer'];
    $data['pHFPer'] = $HFDefaultSetArr['pHFPer'];

    foreach ($data as $key => $val) {
        switch ($key) {
            case "radix":
            case "HFRadix":
            case "minRadix":
            case "maxRadix":
            case "ID":
            case "type":
            case "typeName":
            case "city":
            case "societyAvg":
            case "minSalaryAvg":
            case "month":
                break;
            default:
                $val = $val * 100;
                $val = $val . "%";
                break;
        }
        $data[$key] = $val;
    }
    $data = dataCreate($data);
    return $data;
}

#获取协议内容
function agentAgreementDetail($param)
{

}

#验证是否已阅读
function checkAgreementRead($param)
{

}

#阅读协议
function doAgreementRead($param)
{

}

#支付后更新 ,
# 传递回来的数组解释https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_7
#转化为:$param=array("orderID"=>"12312312","payMoney"=>"","payStatus"=>"1")
function paidAction($param)
{
    $fieldArr['orderID'] = $param['out_trade_no'];
    $fieldArr['payMoney'] = $param['total_fee'];
    $action = 0;
    if ($param['return_code'] == "SUCCESS" && $param['result_code'] == "SUCCESS") {
        //支付类型
        $fieldArr['billType'] = "5";
        $action = 1;
    }
    if ($action == 1) {
        $fieldArr['payStatus'] = 1;
        $pa = new agentAction();
        $ret = $pa->paidAction($fieldArr);
        $aSet = new agencySet();
        $wxTemplateIDArr = $aSet->agencySetArr("wx_templateID");
        if ($ret['result'] == 1) {
            //生成支付成功通知,并推送给微信
//        $url =httpPath."weChat/paiqian/index.php?s=/addon/Paiqian/Wap/choosePayType/orderID/".$ret['orderID'].".html";
            $url = "http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/choosePayType/orderID/" . $ret['orderID'] . ".html";
            $fieldArr['sender'] = "1";
            $fieldArr['receiver'] = $ret['userID'];
            $fieldArr['sendTime'] = timeStyle("dateTime");
            $fieldArr['content'] = "订单已支付成功 !支付金额: ￥" . $ret['payTotal'] . " , 订单号为: " . $ret['orderID'] . "   ,<a href=\'$url\'>点击查看详情</a>";
            $fieldArr['level'] = "1";
            $fieldArr['fromTo'] = "4";
            $wxFieldArr['uid'] = $ret['userID'];
            $wxFieldArr['templateID'] = $wxTemplateIDArr['paid']['ID'];
            $wxFieldArr['url'] = $url;
            $wxparam ['data'] ['first'] ['value'] = "支付成功";
            $wxparam ['data'] ['first'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword1'] ['value'] = "缴交社保";
            $wxparam ['data'] ['keyword1'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword2'] ['value'] = $ret['orderID'];
            $wxparam ['data'] ['keyword2'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword3'] ['value'] = $ret['payTotal'];
            $wxparam ['data'] ['keyword3'] ['color'] = "#E60B43";
            $wxparam ['data'] ['keyword4'] ['value'] = $fieldArr['sendTime'];
            $wxparam ['data'] ['keyword4'] ['color'] = "#E60B43";
            $wxparam ['data'] ['remark'] ['value'] = "恭喜支付成功,点击查看详情";
            $wxparam ['data'] ['remark'] ['color'] = "#173177";
            $wxFieldArr['param'] = serialize($wxparam);
            $ma = new msgAction();
            $ma->msgAdd($fieldArr);
            $ma->pdo = $GLOBALS['pdo'];
            $ma->wx_msgAdd($wxFieldArr);
        }

    } else {
        $ret['status'] = 1;
        $ret['msg'] = "支付返回失败";
        $ret['result'] = 0;
    }

//    print_r($ret);
    return $ret;
}

#申请退款 ,$param = array("fIDArr"=>array(1,2),"userID"=>1,"")
function refundAdd($param)
{
    $param['bankID'] = $param['bank'];
    $param['bID'] = $param['code'];
    $param['phone'] = $param['mobilePhone'];
    $param['bankAddress'] = $param['address'];
    unset($param['bank'], $param['code'], $param['mobilePhone'], $param['address']);
    //验证安全密码信息
    $ret = validPassword($param);
    if ($ret['result'] == 1) {
        //添加银行信息
        $bankRes = userBankAdd($param);
        if ($bankRes['result'] == 1) {
            //添加退款订单
            $fieldArr['fIDArr'] = $param['fIDArr'];
            $fieldArr['userID'] = $param['userID'];
            //默认银行退款方式
            $fieldArr['refundMethod'] = "bank";
            $ra = new agentAction();
            $ret = $ra->refundAdd($fieldArr);
        } else {
            $ret = $bankRes;
        }

    }
//    print_r($ret);
    return $ret;
}

#添加银行卡信息
function userBankAdd($param)
{
    unset($param['fIDArr'], $param['password']);
    $param['createdByUserID'] = $param['userID'];
    $aA = new agentAction();
    $ret = $aA->userBankAdd($param);
    return $ret;

}

#退款明细 $param['orderID']="12312312312";
function refundDetail($param)
{
    $aU = new agentOrder();
    $aU->agentOrderBasic("`orderID`,`payStatus`", "orderID='" . $param['orderID'] . "'");
    $refundDetailArr = $aU->refundDetail();
    $data = $refundDetailArr[$param['orderID']];
    $data = dataCreate($data);
    return $data;
}

#取消退款申请 $param['orderID']="12312312312";
function refundCancel($param)
{
    $aA = new agentAction();
    $ret = $aA->refundCancel($param);
//    print_r($ret);
    return $ret;
}


#消息列表 $param = array(userID=>1)
function messageList($param)
{
    $md = new messageData();
    $md->messageDataBasic("*", "receiver='" . $param['userID'] . "' and isDelete !=1 and fromTo='4' order by sendTime desc");
    $data = $md->msgArr;
    foreach ($data as $key => $val) {
        if ($val['isRead'] != 1) {
            $fieldArr[$key]['ID'] = $val['ID'];
            $fieldArr[$key]['isRead'] = "1";
        }
    }
    //进入页面后默认已阅读
    $edit = new msgAction();
    $edit->msgEdit($fieldArr);
    $data = dataCreate($data);
//    echo "<pre>";
//    print_r($data);
    return $data;
}

#消息已阅读 $param= array("ID"=>2)
function messageRead($param)
{
    $edit = new msgAction();
    $fieldArr[$param['ID']]['ID'] = $param['ID'];
    $fieldArr[$param['ID']]['isRead'] = "1";
    $edit->msgEdit($fieldArr);
    $ret = $edit->ret;
    return $ret;
}

#删除消息 $param= array("ID"=>2)
function messageDel($param)
{
    $edit = new msgAction();
    $fieldArr[$param['ID']]['ID'] = $param['ID'];
    $fieldArr[$param['ID']]['isDelete'] = "1";
    $edit->msgEdit($fieldArr);
    $ret = $edit->ret;
    return $ret;
}

#验证登陆密码是否正确 $param = array (userID=>1,password=>123)
function validPassword($param)
{
    $aSet = new agencySet();
    $wx_encrypt_key = $aSet->agencySetArr("wx_encrypt_key");
    $sql = "select uid,password from `wx_user` where uid = '" . $param['userID'] . "'";
    $pdo = $GLOBALS['pdo'];
    $pwArr = SQL($pdo, $sql, "", "one");
    $pw = think_decrypt($pwArr['password'], $wx_encrypt_key);
    if ($pw == $param['password']) {
        $ret ['msg'] = "密码验证成功";
        $ret['status'] = "1";
        $ret['result'] = "1";
    } else {
        $ret['status'] = "1";
        $ret ['msg'] = "密码验证失败!";
        $ret['result'] = "0";
    }
    return $ret;
}


?>
