<?php

/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/3 - 16:10
 *
 *  代理模块管理员操作SQL类
 */
class managerAgentAction
{
    public $pdo; //PDO对象
    public $now;
    public $ret; //返回操作结果

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
        $this->now = timeStyle("dateTime");
    }

    #生成社保清单
    function createSoInsList()
    {
        //var_dump($_POST);
        //定义发起人,及其发起时间
        $pdo = $this->pdo;
        $sponsorName = $_SESSION ['exp_user'] ['mName'];
        $sponsorTime = $this->now;
        //为下面的日期格式做铺垫
        $currentMon = timeStyle("Ym", "");
        $currentDay = timeStyle("d");
        $startMon = $currentMon . "01";
        //社保年月界定为,当月20号到次月19号,为一个投保期限..这样生成的目的是避免客户经理提前做入职,但到社保购买日,忘记购买社保的情况(或购买次月社保的情况)...
        // 如果把$eT设定为当前日期的话,则是一种比较正规的操作方法,但是这就可能造成为购买次月社保的情况
        if ($currentDay <= insuranceInTurn("soIns")) {
            $mon = $currentMon;
            $bT = date("Ym", strtotime("$startMon -1 month")) . (insuranceInTurn("soIns") + 1);
            $eT = $currentMon . insuranceInTurn("soIns");
        } else {
            $mon = date("Ym", strtotime("$startMon +1 month"));
            $bT = $currentMon . (insuranceInTurn("soIns") + 1);
            $eT = date("Ym", strtotime("$startMon +1 month")) . insuranceInTurn("soIns");
        }

//        $bT = "20150201";
//        $eT = "20160301";

        #更换了社保的生成方法,首先删除本月未签收数据,然后插入本月应该购买的社保人员名单...这个方法在效率上估计会比上一个方法效率上会高...也就是说可以不用更新操作来麻烦了..再者上面那个社保生成名单也是错误的...
        //删除本月未签收的数据(这里不限定月份的原因是,因为每批数据社保专员那边必需跟进,签收然后做网上申报,一般当天就可以签收了)
        $sql ["delete"] = "delete from d_soInsList where status like '0' ";
        //插入语句则是,本月该段时间内,即soInsModifyDate在该段操作时间内,的一切社保行为,无论是新增,修改,停保等...故更社保状态无关
        $sql ['diff'] = "select x.fID as fID,x.unitID,x.city,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand,y.status from d_agent_personalInfo x left join d_soInsList y on (x.fID=y.fID and x.soInsModifyDate= y.soInsModifyDate  )where x.soInsurance in ('0','1','2') and   x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.fID is null";
        //同一个天内(防止同一天内多次修改社保状态的问题),相同员工编号的社保信息处理(1.未签收被删除2.签收则insert 注意的是:社保专题要为2)
        $sql ["same"] = "select distinct(x.fID) as fID,x.unitID,x.city,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand,y.status from d_agent_personalInfo x left join d_soInsList y on (x.fID=y.fID and x.soInsModifyDate= y.soInsModifyDate )where  x.status!=0 and x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.fID is not null and x.soInsurance like '2'  ";
        //同一天离职,入职的情况,也不是特别确定就是了..
        $sql ["same_time"] = "select distinct(x.fID) as fID,x.unitID,x.city,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand, 0 as status from d_agent_personalInfo x where x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and  exists(select 1 from ( select max(y.ID) as ID from  d_soInsList y where y.soInsModifyDate between '" . $bT . "' and '" . $eT . "'  group by y.fID) s,d_soInsList t where  t.ID=s.ID and x.fID=t.fID and x.soInsurance != t.soInsurance  and t.status =  '1' AND t.soInsurance !=  '2' ) ";
        //同一天修改,同一天离职的情况
        $sql ["same_time2"] = "select distinct(x.fID) as fID,x.unitID,x.city,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,x.hand ,0 as status from d_agent_personalInfo x where x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and  exists(select 1 from ( select max(y.ID) as ID from  d_soInsList y where y.soInsModifyDate between '" . $bT . "' and '" . $eT . "' group by y.fID) s,d_soInsList t where  t.ID=s.ID and x.fID=t.fID and x.soInsurance != t.soInsurance  and t.status =  '1' AND t.soInsurance =  '2' and x.soInsurance = '0' ) ";
        foreach ($sql as $sK => $sV) {
            $res = $pdo->query($sV);
            if ($res)
                $ret [$sK] = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        $insertArr = keyArray($ret ['diff'], "fID");
        foreach ($ret ['diff'] as $rdK => $rdV) {
            $soInsModifyDateArr [] = $rdV ['soInsModifyDate'];
        }
        foreach ($ret ['same'] as $rK => $rV) {
            if ($rV ['status'] == "1") {
                $insertArr [$rV['fID']] = $rV;
                $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
            }
        }
        foreach ($ret ['same_time'] as $rK => $rV) {
            $insertArr [$rV['fID']] = $rV;
            $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
        }
        foreach ($ret ['same_time2'] as $rK => $rV) {
            $insertArr [$rV['fID']] = $rV;
            $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
        }
        if ($soInsModifyDateArr) {
            $soInsModifyDateArr = array_unique($soInsModifyDateArr);
            foreach ($soInsModifyDateArr as $sMDV) {
                $soInsModifyDateStr .= "'" . $sMDV . "',";
            }
            $soInsModifyDateStr = rtrim($soInsModifyDateStr, ",");
            $existsSql = "select max(extraBatch) as eB,soInsModifyDate from d_soInsList where soInsModifyDate in($soInsModifyDateStr) and sponsorName like '$sponsorName' group by soInsModifyDate";
            $existsRes = $pdo->query($existsSql);
            $existsRet = $existsRes->fetchAll(PDO::FETCH_ASSOC);
            foreach ($existsRet as $eK => $eV) {
                $extraBatchArr [$eV ['soInsModifyDate']] = ++$eV ['eB'];
            }
        }
//	print_r($insertArr);
        $fieldStr = "fID,unitID,city,soInsModifyDate,soInsurance,radix, pension, hospitalization, employmentInjury, unemployment, PDIns, hand,status,batch,extraBatch,sponsorName,sponsorTime";
        //构成插入语句
        if ($insertArr) {
            $insertSql = " insert into d_soInsList (" . $fieldStr . ")values";
            foreach ($insertArr as $iV) {

                $iV ['batch'] = "So." . $mon;
                $iV ['extraBatch'] = $extraBatchArr [$iV ['soInsModifyDate']];
                $iV ['sponsorName'] = $sponsorName;
                $iV ['sponsorTime'] = $sponsorTime;
                $iV ['status'] = "0";
                $insertStr .= "(";
                foreach ($iV as $iKey => $iVal) {
                    if (!$iVal)
                        $iVal = '0';
                    $insertStr .= "'" . $iVal . "',";
                }
                $insertStr = rtrim($insertStr, ",");
                $insertStr .= "),";
            }
            $insertStr = rtrim($insertStr, ",");
            //insert sql
            $actionSql [] = $insertSql . $insertStr;
        }
//        print_r($actionSql);
        if ($actionSql) {
            $result = extraTransaction($pdo, $actionSql);
            $errMsg ['sql'] = $result ['error'];
            if (empty ($errMsg ['sql'])) {
                $text ['msg'] = "同步成功";
                $text['status'] = "1";
                $text['result'] = "1";
            } else {
                $text['status'] = "1";
                $text ['msg'] = "同步失败:" . $errMsg ['sql'];
                $text['result'] = "0";
            }

        } else {
            $text['status'] = "1";
            $text ['msg'] = "当前已是最新报表";
            $text['result'] = "0";
        }

        return $this->ret = $text;


    }


    #签收社保申报表
    function  receiveSoInsList($chkList)
    {
        $pdo = $this->pdo;
        $receiverName = $_SESSION ['exp_user'] ['mName'];
        $receiveTime = timeStyle("dateTime");

        foreach ($chkList as $chkVal) {
            list ($soInsModifyDate, $sponsorName, $extraBatch) = explode("|", $chkVal);
            //这句要改
            $sql [] = "update d_soinslist a set a.receiverName = '" . $receiverName . "', a.receiveTime = '" . $receiveTime . "', a.status = '1'
							where  a.soInsModifyDate = '" . $soInsModifyDate . "' and a.sponsorName = '" . $sponsorName . "' and a.extraBatch = '" . $extraBatch . "' ";

            $sql [] = "update d_agent_personalInfo a,d_soInsList b set a.soInsurance ='1' where b.soInsurance like '2'
							and a.fID=b.fID and b.soInsModifyDate ='$soInsModifyDate' and b.sponsorName like '$sponsorName'
							and b.extraBatch = '$extraBatch'";
        }

//        print_r($sql);

        //进行事务处理,所有更新成功为成功
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret['msg'] = "签收成功";
            $ret['status'] = "1";
            $ret['result'] = "1";
        } else {
            $ret['status'] = "1";
            $ret['msg'] = "签收失败:" . $errMsg ['sql'];
            $ret['result'] = "0";
        }

        return $this->ret = $ret;
    }


    #生成公积金申报表
    function createHFList()
    {
        $pdo = $this->pdo;
        //定义发起人,及其发起时间
        $sponsorName = $_SESSION ['exp_user'] ['mName'];
        $sponsorTime = $this->now;
        //为下面的日期格式做铺垫
        $currentMon = timeStyle("Ym", "");
        $currentDay = timeStyle("d");
        $startMon = $currentMon . "01";
        if ($currentDay <= insuranceInTurn("HF")) {
            $mon = $currentMon;
            $bT = date("Ym", strtotime("$startMon -1 month")) . (insuranceInTurn("HF") + 1);
            $eT = $currentMon . insuranceInTurn("HF");
        } else {
            $mon = date("Ym", strtotime("$startMon +1 month"));
            $bT = $currentMon . (insuranceInTurn("HF") + 1);
            $eT = date("Ym", strtotime("$startMon +1 month")) . insuranceInTurn("HF");
        }

        $bT = "20150201";
        $eT = "20160301";//todo

        #更换了公积金的生成方法,首先删除本月未签收数据,然后插入本月应该购买的公积金人员名单...这个方法在效率上估计会比上一个方法效率上会高...也就是说可以不用更新操作来麻烦了..再者上面那个社保生成名单也是错误的...
        //删除本客户经理,本月未签收的数据(这里不限定月份的原因是,因为每批数据公积金专员那边必需跟进,签收然后做网上申报,一般当天就可以签收了)
        $sql ["delete"] = "delete from d_HFList where status like '0'";
        //插入语句则是,本月该段时间内,即HFModifyDate在该段操作时间内,的一切社保行为,无论是新增,修改,停保等...故更社保状态无关
        $sql ['diff'] = "select x.fID,x.unitID,x.city,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,0 as status from d_agent_personalInfo x left join d_HFList y on (x.fID=y.fID and x.HFModifyDate= y.HFModifyDate  )where   x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and x.housingFund in ('0','1','2') and y.fID is null";
        //同一个天内(防止同一天内多次修改社保状态的问题),相同员工编号的社保信息处理(1.未签收被删除2.签收则insert 注意的是:社保专题要为2)
        $sql ["same"] = "select distinct(x.fID),x.unitID,x.city,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,0 as status from d_agent_personalInfo x left join d_HFList y on (x.fID=y.fID and x.HFModifyDate= y.HFModifyDate  )where  x.status !=0 and x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and y.fID is not null and x.housingFund like '2' ";
        //同一天离职,入职的情况,也不是特别确定就是了..
        $sql ["same_time"] = "select distinct(x.fID) as fID,x.unitID,x.city,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,0 as status from d_agent_personalInfo x where x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and  exists(select 1 from ( select max(y.ID) as ID from  d_HFList y where y.HFModifyDate between '" . $bT . "' and '" . $eT . "'  group by y.fID) s,d_HFList t where  t.ID=s.ID and x.fID=t.fID and x.housingFund != t.housingFund  and t.status =  '1' AND t.housingFund !=  '2' ) ";
        //同一天修改,同一天离职的情况
        $sql ["same_time2"] = "select distinct(x.fID) as fID,x.unitID,x.city,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,0 as status from d_agent_personalInfo x where x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and  exists(select 1 from ( select max(y.ID) as ID from  d_HFList y where y.HFModifyDate between '" . $bT . "' and '" . $eT . "' group by y.fID) s,d_HFList t where  t.ID=s.ID and x.fID=t.fID and x.housingFund != t.housingFund  and t.status =  '1' AND t.housingFund =  '2' and x.housingFund = '0' ) ";

        foreach ($sql as $sK => $sV) {
            $res = $pdo->query($sV);
            if ($res)
                $ret [$sK] = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        $insertArr = $ret ['diff'];
        foreach ($ret ['diff'] as $rdK => $rdV) {
            $HFModifyDateArr [] = $rdV ['HFModifyDate'];
        }
        foreach ($ret ['same'] as $rK => $rV) {
            if ($rV ['status'] == "1") {
                $insertArr [] = $rV;
                $HFModifyDateArr [] = $rV ['HFModifyDate'];
            }
        }

        foreach ($ret ['same_time'] as $rK => $rV) {
            $insertArr [$rV['fID']] = $rV;
            $HFModifyDateArr [] = $rV ['HFModifyDate'];
        }
        foreach ($ret ['same_time2'] as $rK => $rV) {
            $insertArr [$rV['fID']] = $rV;
            $HFModifyDateArr [] = $rV ['HFModifyDate'];
        }

        if ($HFModifyDateArr) {
            $HFModifyDateArr = array_unique($HFModifyDateArr);
            foreach ($HFModifyDateArr as $sMDV) {
                $HFModifyDateStr .= "'" . $sMDV . "',";
            }
            $HFModifyDateStr = rtrim($HFModifyDateStr, ",");
            $existsSql = "select max(extraBatch) as eB,HFModifyDate from d_HFList where HFModifyDate in($HFModifyDateStr) and sponsorName like '$sponsorName' group by HFModifyDate";
            $existsRes = $pdo->query($existsSql);
            $existsRet = $existsRes->fetchAll(PDO::FETCH_ASSOC);
            foreach ($existsRet as $eK => $eV) {
                $extraBatchArr [$eV ['HFModifyDate']] = ++$eV ['eB'];
            }
        }
        //	print_r($extraBatchArr);
        $fieldStr = "fID,unitID,city,HFModifyDate,housingFund,HFRadix, pHFPer,uHFPer,status,batch,extraBatch,sponsorName,sponsorTime";
        //构成插入语句
        if ($insertArr) {
            $insertSql = " insert into d_HFList (" . $fieldStr . ")values";
            foreach ($insertArr as $iV) {
                if ($iV ['housingFund'] > 0 && ($iV ['pHFPer'] != 0.05 || $iV ['uHFPer'] != 0.05) && ($iV ['pHFPer'] != 0.06 || $iV ['uHFPer'] != 0.06) && ($iV ['pHFPer'] != 0.1 || $iV ['uHFPer'] != 0.1)) {
                    $errMsg = "报表生成失败;目前开放比例为 5%,6%,10%的公积金(错误:fID为:" . $iV ['fID'] . "-单位比例:" . $iV ['uHFPer'] . "-个人比例:" . $iV ['pHFPer'] . ")";
                    break;
                } else {
                    $iV ['batch'] = "HF." . $mon;
                    $iV ['extraBatch'] = $extraBatchArr [$iV ['HFModifyDate']];
                    $iV ['sponsorName'] = $sponsorName;
                    $iV ['sponsorTime'] = $sponsorTime;
                    $iV ['status'] = "0";
                    $insertStr .= "(";
                    foreach ($iV as $iKey => $iVal) {
                        if (!$iVal)
                            $iVal = '0';
                        $insertStr .= "'" . $iVal . "',";
                    }
                    $insertStr = rtrim($insertStr, ",");
                    $insertStr .= "),";
                }
            }
            $insertStr = rtrim($insertStr, ",");
            //insert sql
            $actionSql [] = $insertSql . $insertStr;
        }
        if (!$errMsg) {
            if ($actionSql) {
                $result = extraTransaction($pdo, $actionSql);
                $errMsg = $result ['error'];
                if (empty ($errMsg ['sql'])) {
                    $text ['msg'] = "同步成功";
                    $text['status'] = "1";
                    $text['result'] = "1";
                } else {
                    $text['status'] = "1";
                    $text ['msg'] = "同步失败:" . $errMsg ['sql'];
                    $text['result'] = "0";
                }
            } else {
                $text['status'] = "1";
                $text ['msg'] = "当前已是最新报表";
                $text['result'] = "0";
            }

        }


        return $this->ret = $text;
    }

    #签收公积金申报表

    function receiveHFList($chkList)
    {

        $pdo = $this->pdo;
        $receiverName = $_SESSION ['exp_user'] ['mName'];
        $receiveTime = $this->now;

        foreach ($chkList as $chkVal) {
            list ($HFModifyDate, $sponsorName, $extraBatch) = explode("|", $chkVal);
            //这句要改
            $sql [] = "update d_HFList a set a.receiverName = '" . $receiverName . "', a.receiveTime = '" . $receiveTime . "', a.status = '1'
							where  a.HFModifyDate = '" . $HFModifyDate . "' and a.sponsorName = '" . $sponsorName . "' and a.extraBatch = '" . $extraBatch . "' ";

            $sql [] = "update d_agent_personalInfo a,d_HFList b set a.housingFund ='1' where b.housingFund like '2'
							and a.fID=b.fID and b.HFModifyDate ='$HFModifyDate' and b.sponsorName like '$sponsorName'
							and b.extraBatch = '$extraBatch'";
        }
        print_r($sql);

        //进行事务处理,所有更新成功为成功
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret['msg'] = "签收成功";
            $ret['status'] = "1";
            $ret['result'] = "1";
        } else {
            $ret['status'] = "1";
            $ret['msg'] = "签收失败:" . $errMsg ['sql'];
            $ret['result'] = "0";
        }

        return $this->ret = $ret;
    }
}

