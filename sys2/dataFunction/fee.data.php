<?php

/*
 * 2011-07-12  根据员工信息计算社保费用,公积金费用,商保费用,互助会费用,管理费用等
 * 此类应用到  common.function.php里面的函数,所以引用此类的同时要require该文件
 * author  : sToNe  email: shi35dong@gmail.com
 * 
 */
class feeData
{
    public $pdo; // pdo配置
    public $wArr; //员工信息
    public $month; //月份
    public $salaryDate; //工资年月
    public $soInsDate; //社保年月
    public $HFDate; //公积金年月
    public $comInsDate; //商保年月
    public $mCostDate; //管理费年月
    public $extraBatch; //批次
    public $unitID; //单位编号
    public $unitArr;
	static $tableName="s_soIns_set";
    #获取单位信息表
    function unitArr()
    {
        $pdo = $this->pdo;
        $unitID = $this->unitID;
        $sql = "select * from a_unitInfo where unitID like '$unitID'";
        $unitArr = SQL($pdo, $sql, null, "one");
        return $this->unitArr = $unitArr;
    }

    #是否存在临时更改基数
    function changeRadix()
    {
        $pdo = $this->pdo;
        $month = $this->month;
        $unitID = $this->unitID;
        #如果设置过基数则调整
        $radixSql = "select * from a_changeRadix_tmp where `month` like '$month' and `unitID` like '$unitID'";
        $radixRes = $pdo->query($radixSql);
        $rCount = $radixRes->rowCount();
        $radixRet = $radixRes->fetch(PDO::FETCH_ASSOC);
        if ($rCount > 0) {
            return $radixRet;
        }
        else
            return false;
    }

    #找出对应缴社保比例的年月
    function soInsMon($soInsDate){
        $pdo=$this->pdo;
        $soInsSql = "select month from s_soIns_set group by month order by month desc ";
        $soInsRes = $pdo->query($soInsSql);
        $soDateAll = $soInsRes->fetchAll(PDO::FETCH_ASSOC);
        foreach($soDateAll as $v){
        	if($v["month"]<=$soInsDate){
                $actionSoInsDate=$v["month"];
                break;
        	}
            $actionSoInsDate=$v["month"];
        }
    	return $actionSoInsDate;
    }
    #社保系统设置比例表
    function soInsSet()
    {
        $pdo = $this->pdo;
        $soInsDate = $this->soInsDate;
        $actionSoInsDate=$this->soInsMon($soInsDate);
        #社保缴交比例表
        $soInsSql = "select * from s_soIns_set";
       	$soInsSql .= " where month='{$actionSoInsDate}'";
       	$soInsRes = $pdo->query($soInsSql);
        $R = $soInsRes->fetchAll(PDO::FETCH_ASSOC);
        $R =keyArray($R,'type');
        $soInsExtraSet = $this->soInsExtraSet();
        $unitArr = $this->unitArr;
        $soInsID = $unitArr['soInsID'];
        if( array_key_exists($unitArr['soInsID'],$soInsExtraSet )){
            foreach($R as $sy => $sr){
                foreach($sr as $sk=>$sv){
                    $R[$sy][$sk]=$soInsExtraSet[$soInsID][$sk]?$soInsExtraSet[$soInsID][$sk]:$sv;
                }
            }
        }
        return $R;
    }
    #社保特殊缴交比例设置
    function soInsExtraSet(){
        $pdo = $this->pdo;
        #社保缴交比例表
        $sql = "select * from s_soIns_extra_set";
        $res = $pdo->query($sql);
        $R = $res->fetchAll(PDO::FETCH_ASSOC);
        $R =keyArray($R,'soInsID');
        return $R;
    }

    #商保系统设置比例表
    function comInsSet()
    {
        $pdo = $this->pdo;
        $sql = "select * from a_comIns_set";
        $comInsSet = SQL($pdo, $sql);
        return $comInsSet;
    }

    #社保缴交明细
    function exSoRet()
    {
        $pdo = $this->pdo;
        $unitID = $this->unitID;
        $unitArr = $this->unitArr;
        $soInsDate = $this->soInsDate;
        $wArr = $this->wArr;
        $wArr = keyArray($wArr, "uID");
        #验证是否已经存在本月社保的缴交明细,如果已经存在则直接以缴交明细为主
        $exSoSql = "select a.uID,a.pTotal,a.uTotal from a_soInsFee_tmp a   where a.soInsDate like :soInsDate and a.uID not like '' and a.unitID like :unitID ";
        $exSoRet = SQL($pdo, $exSoSql, array(
            ":soInsDate" => $soInsDate,
            ":unitID" => $unitID
        ));
        if ($unitArr ['soInsFrom'] == "1") {
            foreach ($exSoRet as $val) {
                //如果该单位是由单位垫付单位社保,则本月应收社保=0
                $newExSoRet [$val ['uID']] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
                $newExSoRet [$val ['uID']] ['pTotal'] = 0;
                $newExSoRet [$val ['uID']] ['uID'] = $val ['uID'];
            }
        }
        elseif ($unitArr ['soInsFrom'] == "2") {
            foreach ($exSoRet as $val) {
                //如果该单位是由个人垫付单位社保,则本月应收社保=单位+个人
                $newExSoRet [$val ['uID']] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
                $newExSoRet [$val ['uID']] ['uTotal'] = 0;
                $newExSoRet [$val ['uID']] ['uID'] = $val ['uID'];
            }
        }
        else {
            foreach ($exSoRet as $val) {
                $uID = $val ['uID'];
                if ($wArr [$uID] ['type'] != "1") {
                    if ($unitArr ['notFullSoInsFrom'] == "1") {
                        //由单位支付  个人+单位的费用
                        $newExSoRet [$uID] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
                        $newExSoRet [$uID] ['pTotal'] = 0;
                        $newExSoRet [$uID] ['uID'] = $uID;
                    }
                    elseif ($unitArr ['notFullSoInsFrom'] == "2") {
                        //由个人支付  个人+单位的费用
                        $newExSoRet [$uID] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
                        $newExSoRet [$uID] ['uTotal'] = 0;
                        $newExSoRet [$uID] ['uID'] = $uID;
                    }
                    else {
                        $newExSoRet [$uID] ['pTotal'] = $val ['pTotal'];
                        $newExSoRet [$uID] ['uTotal'] = $val ['uTotal'];
                        $newExSoRet [$uID] ['uID'] = $uID;
                    }
                }
                else {
                    $newExSoRet [$uID] ['pTotal'] = $val ['pTotal'];
                    $newExSoRet [$uID] ['uTotal'] = $val ['uTotal'];
                    $newExSoRet [$uID] ['uID'] = $uID;
                }
            }
        }
        return $newExSoRet;
    }

    #公积金缴交明细
    function exHFRet()
    {
        $pdo = $this->pdo;
        $unitID = $this->unitID;
        $HFDate = $this->HFDate;
        $unitArr = $this->unitArr;
        $wArr = $this->wArr;
        $wArr = keyArray($wArr, "uID");
        #验证是否已经存在本月的公积金缴交明细,如果已经存在则直接以缴交明细为主
        $exHFSql = "select a.uID,a.pTotal,a.uTotal from a_HFFee_tmp a   where a.HFDate like :HFDate and a.uID not like '' and a.unitID like :unitID ";
        $exHFRet = SQL($pdo, $exHFSql, array(
            ":HFDate" => $HFDate,
            ":unitID" => $unitID
        ));
        if ($unitArr ['HFFrom'] == "1") {
            foreach ($exHFRet as $val) {
                //如果该单位是由单位垫付单位公积金,则本月应收公积金=0
                $newExHFRet [$val ['uID']] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
                $newExHFRet [$val ['uID']] ['pTotal'] = 0;
                $newExHFRet [$val ['uID']] ['uID'] = $val ['uID'];
            }
        }
        elseif ($unitArr ['HFFrom'] == "2") {
            foreach ($exHFRet as $val) {
                //如果该单位是由个人垫付单位公积金,则本月应收公积金=单位+个人
                $newExHFRet [$val ['uID']] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
                $newExHFRet [$val ['uID']] ['uTotal'] = 0;
                $newExHFRet [$val ['uID']] ['uID'] = $val ['uID'];
            }
        }
        else {
            foreach ($exHFRet as $val) {
                $uID = $val ['uID'];
                if ($wArr [$uID] ['type'] != "1") {
                    if ($unitArr ['notFullHFFrom'] == "1") {
                        //由单位支付  个人+单位的费用
                        $newExHFRet [$uID] ['uTotal'] = $val ['pTotal'] + $val ['uTotal'];
                        $newExHFRet [$uID] ['pTotal'] = 0;
                        $newExHFRet [$uID] ['uID'] = $uID;
                    }
                    elseif ($unitArr ['notFullHFFrom'] == "2") {
                        //由个人支付  个人+单位的费用
                        $newExHFRet [$uID] ['pTotal'] = $val ['pTotal'] + $val ['uTotal'];
                        $newExHFRet [$uID] ['uTotal'] = 0;
                        $newExHFRet [$uID] ['uID'] = $uID;
                    }
                }
                else {
                    $newExHFRet [$uID] ['pTotal'] = $val ['pTotal'];
                    $newExHFRet [$uID] ['uTotal'] = $val ['uTotal'];
                    $newExHFRet [$uID] ['uID'] = $uID;
                }
            }
        }
        return $newExHFRet;
    }

    #商保缴交明细,区别于社保和公积金,这边只涉及商保缴交清单,因为收支是不一致的
    function exComRet()
    {
        $pdo = $this->pdo;
        $unitID = $this->unitID;
        $comInsDate = $this->comInsDate;
        $unitArr = $this->unitArr;
        $wArr = $this->wArr;
        $wArr = keyArray($wArr, "uID");
        $changeRadix = $this->changeRadix();
        if ($changeRadix) {
            $pComInsMoney = $changeRadix ['pComInsMoneyRadix'];
            $uComInsMoney = $changeRadix ['uComInsMoneyRadix'];
        }
        else {
            $pComInsMoney = $unitArr ['pComInsMoney'];
            $uComInsMoney = $unitArr ['uComInsMoney'];
        }
        #商保缴交明细表
        $comInsSql = "select a.uID from a_comInsList a  where a.unitID like :unitID and a.batch like :batch and status='1'";
        $comInsRet = SQL($pdo, $comInsSql, array(
            ":unitID" => $unitID,
            ":batch" => "Com." . $comInsDate
        ));
        foreach ($comInsRet as $key => $val) {
            $uID = $val ['uID'];
            //如果该员工是非全日制员工,则员工的个人商保由单位承担
            if ($wArr [$uID] ['type'] != "1") {
                if ($unitArr ['notFullComInsFrom'] == "1") {
                    $exComRet [$uID] ['pComInsMoney'] = 0;
                    $exComRet [$uID] ['uComInsMoney'] = $uComInsMoney + $pComInsMoney;
                }
                elseif ($unitArr ['notFullComInsFrom'] == "2") {
                    $exComRet [$uID] ['pComInsMoney'] = $uComInsMoney + $pComInsMoney;
                    $exComRet [$uID] ['uComInsMoney'] = 0;
                }
                else {
                    $exComRet [$uID] ['pComInsMoney'] = $pComInsMoney;
                    $exComRet [$uID] ['uComInsMoney'] = $uComInsMoney;
                }
            }
            else {
                $exComRet [$uID] ['pComInsMoney'] = $pComInsMoney;
                $exComRet [$uID] ['uComInsMoney'] = $uComInsMoney;
            }
        }
        return $exComRet;
    }

    #社保的计算方法
    public function soInsFun($wValue)
    {
        $soInsSet = $this->soInsSet();
        $unitArr = $this->unitArr;
        $societyAvg = $soInsSet [1] ['societyAvg'];
        #如果封停日期在封帐日期之后,则收取对应社保月的社保费用
        $soInsInTurnDate = $this->soInsDate . insuranceInTurn("soIns");
        if ($wValue['soInsurance'] == '0' && strtotime($wValue['soInsModifyDate']) > strtotime($soInsInTurnDate)) {
            $pdo = $this->pdo;
            $sql = "select uID,name,PDIns,radix,domicile,hospitalization,pension,employmentInjury,unemployment,hospitalization,type
                   from `a_workerInfo_history` where `uID` like '" . $wValue['uID'] . "' and soInsurance !=0 order by lastModifyDate desc limit 1";
            $ret = SQL($pdo, $sql, null, 'one');
            $wValue = $ret;
        }
        switch ($wValue) {
            case "PDIns" :
                $soInsFun = round($societyAvg * 0.005 * 0.6, 2);
                break;
            default :
                foreach ($wValue as $wK => $wV) {
                    $radix = $wValue ['radix'];
                    if ($wValue ['domicile'] == "1") {
                        $type = "1";
                    }
                    elseif ($wValue ['domicile'] == "2" && ($wValue ['hospitalization'] == "2" || ($wValue ['employmentInjury'] == "1" && $wValue ['hospitalization'] == "0"))) {
                        $type = "2";
                    }
                    elseif ($wValue ['domicile'] == "2" && $wValue ['hospitalization'] == "4") {
                        $type = "3";
                    }
                    elseif ($wValue ['domicile'] == "2" && $wValue ['hospitalization'] == "1") {
                        $type = "4";
                    }
                    elseif (!$wValue ['domicile']) {
                        exit ($wValue ['name'] . ": 户籍类型或购买险种出错了,请联系管理员查证");
                    }
                    switch ($wK) {
                        case "pension" :
                            if ($wV == "1") {
                                $uPension = round($wValue ['radix'] * $soInsSet [$type] ['uPension'], 2);
                                $pPension = round($wValue ['radix'] * $soInsSet [$type] ['pPension'], 2);
                            }
                            break;
                        case "employmentInjury" :
                            if ($wV == "1") {
                                $uEmploymentInjury = round($wValue ['radix'] * $soInsSet [$type] ['uEmploymentInjury'], 2);
                            }
                            break;
                        case "unemployment" :
                            if ($wV == "1") {
                                $uUnemployment = round($soInsSet [$type] ['minSalaryAvg'] * $soInsSet [$type] ['uUnemployment'], 2);
                                $pUnemployment = round($soInsSet [$type] ['minSalaryAvg'] * $soInsSet [$type] ['pUnemployment'], 2);
                            }
                            break;
                        case "PDIns" :
                            //残障金部分就与失业险一样
                            if ($wV == "1") {
                                $uPDIns = round($societyAvg * 0.005 * 0.6, 2);
                            }
                            break;
                        case "hospitalization" :

                            switch ($wV) {
                                //医疗部分,综合住院,单位医疗皆有生育险需加进去
                                case "1" :
                                    $prsRadix = $wValue ['radix'] > $soInsSet [$type] ['minRadix'] ? $wValue ['radix'] : $soInsSet [$type] ['minRadix'];
                                    //两种计算方式
                                     $uHospitalization = round(($prsRadix * $soInsSet [$type] ['uHospitalization']), 2) + round(($radix * $soInsSet [$type] ['uBirth']), 2);
                                    //$uHospitalization = round(($prsRadix * $soInsSet [$type] ['uHospitalization'] + $prsRadix * $soInsSet [$type] ['uBirth']), 2);
                                    $pHospitalization = round($prsRadix * $soInsSet [$type] ['pHospitalization'], 2);
                                    break;
                                case "2" :
                                    //两种计算方式
                                    $uHospitalization =  substr(sprintf("%.3f", ($societyAvg * $soInsSet [$type] ['uHospitalization'])),0,-1)+round(($radix * $soInsSet [$type] ['uBirth']),2);
                                    $pHospitalization = round($societyAvg * $soInsSet [$type] ['pHospitalization'], 2);
                                    break;
                                case "4" :
                                    $uHospitalization = round(($societyAvg * $soInsSet [$type] ['uHospitalization'] + $radix * $soInsSet [$type] ['uBirth']), 2);
                                    $pHospitalization = round($societyAvg * $soInsSet [$type] ['pHospitalization'], 2);
                                    break;
                            }
                            break;
                        default :
                            break;
                    }
                }
                $uTotal = round(($uPension + $uHospitalization + $uEmploymentInjury + $uUnemployment), 2);
                $pTotal = round(($pPension + $pHospitalization + $pUnemployment), 2);
                if ($unitArr ['soInsFrom'] == "1") {
                    //如果该单位是由单位垫付单位社保,则本月应收社保=0
                    $uTotal = $pTotal + $uTotal;
                    $pTotal = 0;
                }
                elseif ($unitArr ['soInsFrom'] == "2") {
                    //如果该单位是由个人垫付单位社保,则本月应收社保=单位+个人
                    $pTotal = $pTotal + $uTotal;
                    $uTotal = 0;
                }
                else {
                    if ($wValue ['type'] != "1") {
                        if ($unitArr ['notFullSoInsFrom'] == "1") {
                            //由单位支付  个人+单位的费用
                            $uTotal = $pTotal + $uTotal;
                            $pTotal = 0;
                        }
                        elseif ($unitArr ['notFullSoInsFrom'] == "2") {
                            //由个人支付  个人+单位的费用
                            $pTotal = $pTotal + $uTotal;
                            $uTotal = 0;
                        }
                    }
                }
                //1.获取社保费用数组(这里面含有残障金,但单位合计中不包含)
                $soInsFun = array(
                    "uTotal" => $uTotal,
                    "pTotal" => $pTotal,
                    "uPension" => $uPension,
                    "pPension" => $pPension,
                    "uHospitalization" => $uHospitalization,
                    "pHospitalization" => $pHospitalization,
                    "uEmploymentInjury" => $uEmploymentInjury,
                    "uUnemployment" => $uUnemployment,
                    "pUnemployment" => $pUnemployment,
                    "uPDIns" => $uPDIns
                );
                break;
        }
        //单位合计不包括残障金,,这样才可以规避残障金风险
        return $soInsFun;
    }

    private function HFFun($wValue)
    {
        $unitArr = $this->unitArr;
        #如果封停日期在封帐日期之后,则收取对应公积金月的公积金费用
        $HFInTurnDate = $this->HFDate . insuranceInTurn("HF");
        if ($wValue['housingFund'] == '0' && strtotime($wValue['HFModifyDate']) > strtotime($HFInTurnDate)) {
            $pdo = $this->pdo;
            $sql = "select uID,name,HFRadix,uHFPer,pHFPer,housingFund,type
                                from `a_workerInfo_history` where `uID` like '" . $wValue['uID'] . "' and housingFund !=0 order by lastModifyDate desc limit 1";
            $ret = SQL($pdo, $sql, null, 'one');
            $wValue = $ret;
        }

        $uTotal = round(($wValue ['HFRadix'] * $wValue ['uHFPer']), 2);
        $pTotal = round(($wValue ['HFRadix'] * $wValue ['pHFPer']), 2);


        if ($unitArr ['HFFrom'] == "1") {
            //如果该单位是由单位垫付单位公积金,则本月应收公积金=0
            $uTotal = $pTotal + $uTotal;
            $pTotal = 0;
        }
        elseif ($unitArr ['HFFrom'] == "2") {
            //如果该单位是由个人垫付单位公积金,则本月应收公积金=单位+个人
            $pTotal = $pTotal + $uTotal;
            $uTotal = 0;
        }
        else {
            if ($wValue ['type'] != "1") {
                if ($unitArr ['notFullHFFrom'] == "1") {
                    //由单位支付  个人+单位的费用
                    $uTotal = $pTotal + $uTotal;
                    $pTotal = 0;
                }
                elseif ($unitArr ['notFullHFFrom'] == "2") {
                    //由个人支付  个人+单位的费用
                    $pTotal = $pTotal + $uTotal;
                    $uTotal = 0;
                }
            }
        }

        $HFFun = array(
            "uTotal" => $uTotal,
            "pTotal" => $pTotal
        );
        return $HFFun;
    }

    #计算相应的社保,公积金,商保,管理费等
    private function mCostFun($wValue)
    {
        $unitArr = $this->unitArr;
        if ($unitArr ['mCostLimit']) {
            $mLimit = makeArray($unitArr ['mCostLimit']);
            $mCostDate = $this->mCostDate;
            $mCostDate = $mCostDate . "01";
            $firstday = (strtotime($wValue ['mountGuardDay']) > strtotime($mCostDate)) ? strtotime($wValue ['mountGuardDay']) : strtotime($mCostDate);
            if ($wValue ['status'] == "0") {
                $lastDay = strtotime($wValue ['dimissionDate']);
            }
            else {
                $lastDay = strtotime(date("Y-m-t", $firstday));
                //员工在职,且入职月份大于管理费月份,则不收取管理费,即 $lastDay =0
                if ($lastDay > strtotime(date("Y-m-t", strtotime($mCostDate))))
                    $lastDay = 0;
            }
            $t = date('t', $firstday);
            $days = ($lastDay - $firstday) / 86400 + 1;
            switch ($mLimit ['type']) {
                #多少天内(小于一个月)按多少比例结算
                case 'dailyLimit' :
                    $mCostLimit = $mLimit ['act'];
                    end($mCostLimit);
                    $lastKey = key($mCostLimit);
                    reset($mCostLimit);
                    foreach ($mCostLimit as $key => $val) {
                        if ($wValue ['status'] == "0") {
                            switch ($days) {
                                case ($days <= 0) :
                                    $mCost = 0;
                                    break;
                                case ($days <= $t && $days < $key) :
                                    $mCost = round(($wValue ['managementCost'] * $val), 2);
                                    break 2;
                                case ($days > $t && ($days - $t) < $key) :
                                    $mCost = round(($wValue ['managementCost'] * $val + $wValue ['managementCost']), 2);
                                    break 2;
                                case ($days > $t && ($days - $t) >= $lastKey) :
                                    $mCost = round(($wValue ['managementCost'] * 2), 2);
                                    break 2;
                                default :
                                    $mCost = $wValue ['managementCost'];
                                    break;
                            }
                        }
                        else {
                            if ($days > 0 && $days <= $key) { //如果入职的天数小于设定的参数天数,就计算并跳出循环
                                $mCost = round($wValue ['managementCost'] * $val, 2);
                                break;
                            }
                            elseif ($days < 0) {
                                $mCost = 0;
                            }
                            else {
                                $mCost = $wValue ['managementCost'];
                            }
                        }
                    }
                    break;
                #多少天内(大于一个月的)按多少比例结算,[仅限于目前广州莱帕德的管理费计算方式]
                case 'GZLPD' :
                    $mCostLimit = $mLimit ['act'];
                    end($mCostLimit);
                    $lastKey = key($mCostLimit);
                    reset($mCostLimit);
                    $firstday = (strtotime($wValue ['mountGuardDay']) < strtotime($mCostDate)) ? strtotime($wValue ['mountGuardDay']) : strtotime($mCostDate);
                    if ($wValue ['status'] == "0") {
                        //离职则以离职日期为准
                        $lastDay = strtotime($wValue ['dimissionDate']);
                        //如果离职月份小于管理费费用月份
                        if (strtotime(date("Y-m-t", $lastDay)) < strtotime($mCostDate))
                            $lastDay = 0;
                    }
                    else {
                        //每月15号为结算期
                        $lastDay = strtotime(date("Y-m-15", strtotime($mCostDate)));
                    }
                    $days = ($lastDay - $firstday) / 86400 + 1;

                    foreach ($mCostLimit as $key => $val) {
                        if ($wValue ['status'] == "0") {
                            switch ($days) {
                                case ($days <= 0) :
                                    $mCost = 0;
                                    break;
                                case ($days < $key) :
                                    $mCost = round(($wValue ['managementCost'] * $val), 2);
                                    break 2;
                                default :
                                    $mCost = $wValue ['managementCost'];
                                    break;
                            }
                        }
                        else {
                            if ($days > 0 && $days <= $key) { //如果入职的天数小于设定的参数天数,就计算并跳出循环
                                $mCost = round($wValue ['managementCost'] * $val, 2);
                                break;
                            }
                            elseif ($days < 0) {
                                $mCost = 0;
                            }
                            else {
                                $mCost = $wValue ['managementCost'];
                            }
                        }
                    }
//                    echo ($wValue['uID']."==$wValue[status]===".date("Y-m-d",$firstday)."->".date("Y-m-d",$lastDay)."->".$days."->".$mCost)."<br>";
                    break;
                #按天数结算
                case 'daily' :
                    if ($wValue ['status'] == "0") {
                        //员工离职的情况
                        switch ($days) {
                            case ($days <= 0) :
                                $mCost = 0;
                                break;
                            case ($days <= $t) :
                                $mCost = round($wValue ['managementCost'] / $t * $days, 2);
                                break;
                            case ($days > $t) :
                                $mCost = round(($wValue ['managementCost'] / $t * ($days - $t) + $wValue ['managementCost']), 2);
                                break;
                        }
                    }
                    else {
                        //员工在职
                        if ($days < 0) {
                            $mCost = 0;
                        }
                        elseif ($days < $t) {
                            $mCost = round($wValue ['managementCost'] / $t * $days, 2);
                        }
                        else {
                            $mCost = $wValue ['managementCost'];
                        }
                    }
                    break;
                #按天数结算,每月按天数分开结算,离职后不合并计算
                case 'dailyPerMonth' :
                    if ($days < 0) {
                        $mCost = 0;
                    }
                    elseif ($days < $t) {
                        $mCost = round($wValue ['managementCost'] / $t * $days, 2);
                    }
                    else {
                        $mCost = $wValue ['managementCost'];
                    }

                    break;
            }
        }
        else {
            if ($wValue ['status'] == "0") {
                $mCost = 0;
            }
            else {
                $mCost = $wValue ['managementCost'];
            }
        }
        return $mCost;
    }

    function extraFeeArr()
    {
        $wArr = $this->wArr;
        $unitArr = $this->unitArr;
        $exSoRet = $this->exSoRet();
        //		$exSoRet = null;
        $exHFRet = $this->exHFRet();
        $changeRadix = $this->changeRadix();
        if ($changeRadix)
            $helpCost = $changeRadix ['helpCost'];
        else
            $helpCost = 2;
        foreach ($wArr as $wKey => $wValue) {
            if (!$exSoRet) {
                //1.获取社保费用数组(这里面含有残障金,但单位合计中不包含)
                $soInsFeeArr [$wValue ['uID']] = $this->soInsFun($wValue);
            }
            //3.获取互助会费用数组,,这里直接把互助会的金额填上...其实是可以设置数据库来管理互助会的金额的..但是不理会...
            if ($wValue ['helpCost'] == "1") {
                $helpCostFeeArr [$wValue ['uID']] = $helpCost;
            }
            //5.管理费
            $mCostFeeArr [$wValue ['uID']] = $this->mCostFun($wValue);
            //4.公积金
            if (!$exHFRet) {
                $HFFeeArr  [$wValue ['uID']] = $this->HFFun($wValue);
            }
        }
        //有缴交明细,就替代系统计算
        if ($exSoRet) {
            unset ($soInsFeeArr);
            foreach ($exSoRet as $exSokey => $exSoVal) {
                $soInsFeeArr [$exSokey] = $exSoRet [$exSokey];
                if (array_key_exists($exSokey, $wArr))
                    if ($wArr [$exSokey] ['PDIns'] == "1") {
                        $soInsFeeArr [$exSokey] ['uPDIns'] = $this->soInsFun('PDIns');
                    }
            }
        }
        //有缴交明细,就替代系统计算
        if ($exHFRet) {
            unset ($HFFeeArr);
            foreach ($exHFRet as $exHFkey => $exHFVal) {
                $HFFeeArr [$exHFkey] = $exHFRet [$exHFkey];
            }
        }

        //商保缴交明细
        $extraFeeArr = array(
            "soInsFeeArr" => $soInsFeeArr,
            "HFFeeArr" => $HFFeeArr,
            "comInsFeeArr" => $this->exComRet(),
            "mCostFeeArr" => $mCostFeeArr,
            "helpCostFeeArr" => $helpCostFeeArr
        );
        return $extraFeeArr;
    }

    #只验证 a_originalFee 中相同的salaryDate是否存在需要合并扣税的数据
    public function mergeTax_fee($type = null)
    {
        //获取发放表的人员
        $pdo = $this->pdo;
        $salaryDate = $this->salaryDate;
        $extraBatch = $this->extraBatch;
        $unitID = $this->unitID;
        switch ($type) {
            case "mulFee" :
                $oFee = $this->wArr;
                foreach ($oFee as $oVal) {
                    $uIDStr .= "'" . $oVal ['uID'] . "',";
                }
                unset ($oVal);
                $uIDStr = rtrim($uIDStr, ",");
                #解决已发工资内, 已经扣除个人的社保,公积金,商保等相关项目,不再累计扣除的问题
                //获取不在本单位, 但却需要合并扣税的应缴纳税额及已扣个税
                $s1 = "select uID,sum(pTax) as pTax,sum(ratal) as ratal from a_originalFee  where  salaryDate like '$salaryDate' and unitID not in ( $unitID )  and uID in ($uIDStr) and ratal>0  group by uID ";
                //获取本单位内,首次工资费用 及多次工资费用的 应缴纳税额,已扣个税,个人社保,个人公积金,个人商保,个人互助会费
                if ($extraBatch)
                    $s2 = "select uID,sum(pTax) as pTax,sum(ratal) as ratal,sum(pSoIns) as pSoIns,sum(pHF) as pHF,sum(pComIns) as pComIns,sum(helpCost) as helpCost from a_mul_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID ) and extraBatch <'$extraBatch'  and uID in ($uIDStr) and pay>0  group by uID
                        union all
                        select uID,pTax,ratal,pSoIns,pHF,pComIns,helpCost from a_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0   ";
                else
                    $s2 = "select uID,sum(pTax) as pTax,sum(ratal) as ratal,sum(pSoIns) as pSoIns,sum(pHF) as pHF,sum(pComIns) as pComIns,sum(helpCost) as helpCost from a_mul_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0  group by uID
                        union all
                        select uID,pTax,ratal,pSoIns,pHF,pComIns,helpCost from a_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0   ";

                $r1 = SQL($pdo, $s1);
                $r2 = SQL($pdo, $s2);
                foreach ($r1 as $v1) {
                    $ret [$v1 ['uID']] ['ratal'] = $v1 ['ratal'];
                    $ret [$v1 ['uID']] ['pTax'] = $v1 ['pTax'];
                }
                foreach ($r2 as $v2) {
                    $ret [$v2 ['uID']] ['ratal'] = $ret [$v2 ['uID']] ['ratal'] + $v2 ['ratal'];
                    $ret [$v2 ['uID']] ['pTax'] = $ret [$v2 ['uID']] ['pTax'] + $v2 ['pTax'];
                    $ret [$v2 ['uID']] ['pSoIns'] += $v2 ['pSoIns'];
                    $ret [$v2 ['uID']] ['pHF'] += $v2 ['pHF'];
                    $ret [$v2 ['uID']] ['pComIns'] += $v2 ['pComIns'];
                    $ret [$v2 ['uID']] ['helpCost'] += $v2 ['helpCost'];
                }
                break;
            case "mulRatalYet" :
                $extraBatch = $this->extraBatch;
                $sql = "select uID,pay,ratalYet as ratal,pTaxYet as pTax from a_mul_originalFee where salaryDate like '$salaryDate' and unitID like '$unitID' and extraBatch='$extraBatch' and ratalYet>0";
                $ret = SQL($pdo, $sql);
                $ret = keyArray($ret, "uID");
                break;
            case "ratalYet" :
                $sql = "select uID,pay,ratalYet as ratal,pTaxYet as pTax from a_originalFee where salaryDate like '$salaryDate' and unitID like '$unitID'and ratalYet>0";
                $ret = SQL($pdo, $sql);
                $ret = keyArray($ret, "uID");
                break;
            default :
                $oFee = $this->wArr;
                foreach ($oFee as $oVal) {
                    $uIDStr .= "'" . $oVal ['uID'] . "',";
                }
                $uIDStr = rtrim($uIDStr, ",");
                $sql = "select uID,sum(pay) as pay,sum(pTax) as pTax,sum(ratal) as ratal from a_originalFee  where  salaryDate like '$salaryDate' and unitID not like '$unitID' and uID in ($uIDStr) and ratal>0  group by uID ";
                $ret = SQL($pdo, $sql);
                $ret = keyArray($ret, "uID");
                break;
        }

        return $ret;
    }

    #同一个单位中,同一个月份内多次制作费用表时, 社保,公积金,管理费,商保等是否重复收取的问题
    public function alreadyFee($type = null)
    {
        //获取费用表的人员
        $pdo = $this->pdo;
        $month = $this->month;
        $extraBatch = $this->extraBatch;
        $unitID = $this->unitID;
        switch ($type) {
            case "mulFee" :
                $oFee = $this->wArr;
                foreach ($oFee as $oVal) {
                    $uIDStr .= "'" . $oVal ['uID'] . "',";
                }
                unset ($oVal);
                $uIDStr = rtrim($uIDStr, ",");
                #解决已结算的费用表中, 已经扣除单位的社保,公积金,商保等相关项目,不再累计扣除的问题
                //获取本单位内,首次工资费用 及多次工资费用的 单位社保,单位公积金,单位商保,管理费,残障金等项目
                if ($extraBatch)
                    $s2 = "select uID,sum(uPDIns) as uPDIns,sum(uSoIns) as uSoIns,sum(uHF) as uHF,sum(uComIns) as uComIns,sum(managementCost) as managementCost from a_mul_originalFee  where  month like '$month' and unitID in ( $unitID ) and extraBatch <'$extraBatch'  and uID in ($uIDStr)  group by uID
    				union all
    				select uID,uPDIns,uSoIns,uHF,uComIns,managementCost from a_originalFee  where  month like '$month' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0   ";
                else
                    $s2 = "select uID,sum(uPDIns) as uPDIns,sum(ratal) as ratal,sum(uSoIns) as uSoIns,sum(uHF) as uHF,sum(uComIns) as uComIns,sum(managementCost) as managementCost from a_mul_originalFee  where  month like '$month' and unitID in ( $unitID )  and uID in ($uIDStr)   group by uID
    				union all
    				select uID,uPDIns,uSoIns,uHF,uComIns,managementCost from a_originalFee  where  month like '$month' and unitID in ( $unitID )  and uID in ($uIDStr)    ";
                $r2 = SQL($pdo, $s2);
                foreach ($r2 as $v2) {
                    $ret [$v2 ['uID']] ['uSoIns'] += $v2 ['uSoIns'];
                    $ret [$v2 ['uID']] ['uHF'] += $v2 ['uHF'];
                    $ret [$v2 ['uID']] ['uComIns'] += $v2 ['uComIns'];
                    $ret [$v2 ['uID']] ['managementCost'] += $v2 ['managementCost'];
                    $ret [$v2 ['uID']] ['uPDIns'] += $v2 ['uPDIns'];
                }
                break;
        }

        return $ret;
    }
}

?>
