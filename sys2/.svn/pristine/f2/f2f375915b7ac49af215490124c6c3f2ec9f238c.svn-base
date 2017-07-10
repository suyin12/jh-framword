<?php

/**
 * Created by sToNe.
 * User: Administrator
 * Date: 2015/12/4
 * Time: 18:00
 *
 *   代理费用计算
 */
class agentFeeCounter
{
    public $pdo; //pdo 对象

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #起始缴交月份 $thisMonth = Y-m-d  ,返回格式 Ym  ,$cat返回格式的连字符例如2016-01
    function  realMonth($thisMonth, $type = "soIns", $cat = "")
    {

        if ($thisMonth == "0000-00-00") {
            $realMonth = "";
        } else {
            //传入的格式为年月Ym格式, 转换为年月日的时间戳格式
            $thisMonth = isMonth($thisMonth) ? strtotime($thisMonth . "01") : strtotime($thisMonth);
            //判断传入的时间是否已过封账日, 这里的封账日只适用于个代人员,企业个代引用派遣的机制管理
//                $soInsInTurnDate = strtotime(timeStyle("Ym") . insuranceInTurn("soIns"));
//                if($thisMonth>$soInsInTurnDate){
//                    $actionMonth = timeStyle("Ym");
//                }
            $d = timeStyle("d", "", $thisMonth);
            if ($d > insuranceInTurn($type)) {
                $thisMonth = strtotime("+1 months", $thisMonth);
            }
            $realMonth = timeStyle("Ym", $cat, $thisMonth);
        }


        return $realMonth;

    }

    #缴交的月份数组,返回格式 array("201509","201510","201511")
    function actionMonth($personalInfoArr, $type = "soIns")
    {
        $beginDayFieldName = $type . "BeginDay";
        $beginMonthFieldName = $type . "BeginMonth";
        $needMonthNumFieldName = $type . "NeedMonthNum";
        $beginDay = $personalInfoArr[$beginDayFieldName] ? $personalInfoArr[$beginDayFieldName] : $personalInfoArr[$beginMonthFieldName];
        $needMonthNum = $personalInfoArr[$needMonthNumFieldName];
        if ($beginDay != '0000-00-00' && !is_null($beginDay)) {
            //实际缴交月份
            $realMonth = $this->realMonth($beginDay, $type) . "01";
            if ($needMonthNum > 0) {
                for ($x = 0; $x < $needMonthNum; $x++) {
                    $singleMonth = strtotime("+$x months", strtotime($realMonth));
                    $singleMonth = timeStyle("Ym", "", $singleMonth);
                    $actionMonth[] = $singleMonth;
                }
            } else {
                $actionMonth[] = $realMonth;
            }
        }
        return $actionMonth;
    }

    #社保特殊缴交比例设置
    function soInsExtraSet()
    {
        $pdo = $this->pdo;
        #社保缴交比例表
        $sql = "select * from s_soIns_extra_set";
        $res = $pdo->query($sql);
        $R = $res->fetchAll(PDO::FETCH_ASSOC);
        $R = keyArray($R, 'soInsID');
        return $R;
    }

    #社保系统设置比例表 , soInsArr =array([soInsDate],[city])
    function soInsSet($soInsArr)
    {
        $pdo = $this->pdo;
        $soInsDate = $soInsArr['soInsDate'];
        $city = $soInsArr['city'];
        $type = $soInsArr['type'];
        #社保缴交比例表
        $soInsSql = "select * from s_soIns_set where `city`='$city' and `type` in ($type) and   month  like   (select month from s_soIns_set where month<='$soInsDate' order by month desc limit 1) ";
        $R = SQL($pdo, $soInsSql);
        $R = keyArray($R, 'type');
        $soInsExtraSet = $this->soInsExtraSet();
        $unitArr = $this->unitArr;
        $soInsID = $unitArr['soInsID'];
        if (array_key_exists($unitArr['soInsID'], $soInsExtraSet)) {
            foreach ($R as $sy => $sr) {
                foreach ($sr as $sk => $sv) {
                    $R[$sy][$sk] = $soInsExtraSet[$soInsID][$sk] ? $soInsExtraSet[$soInsID][$sk] : $sv;
                }
            }
        }
        return $R;
    }

    #社保计算($thisMonth 默认的是当前月 ,用于缴交界面购买应该是起始月)
    public function soInsFun($personalInfoArr, $thisMonth = null, $needMonthNum = 1)
    {


        //判断是否为当前月默认为NULL,同时判断,传入的日期格式
        if ($thisMonth) {
            $soInsDate = $this->realMonth($thisMonth, "soIns");
        } else {
            $soInsDate = timeStyle("Ym");
        }
        $soInsArr = array("soInsDate" => $soInsDate, "city" => $personalInfoArr['city'], "type" => $personalInfoArr['cityInsurance']);
        $soInsSet = $this->soInsSet($soInsArr);
//        echo "<pre>";
//        print_r($soInsArr);
        $soInsSet = $soInsSet[$personalInfoArr['cityInsurance']];
        $unitArr = $this->unitArr;
        $societyAvg = $soInsSet['societyAvg'];
        #如果封停日期在封帐日期之后,则收取对应社保月的社保费用(非企业用户结算,不存在这个封账日)
//            $soInsInTurnDate = $this->soInsDate . insuranceInTurn("soIns");
//            if ($personalInfoArr['soInsurance'] == '0' && strtotime($personalInfoArr['soInsModifyDate']) > strtotime($soInsInTurnDate)) {
//                $pdo = $this->pdo;
//                $sql = "select fID,name,PDIns,radix,domicile,hospitalization,pension,employmentInjury,unemployment,hospitalization,type
//                   from `d_agent_personalInfo_history` where `fID` like '" . $personalInfoArr['fID'] . "' and soInsurance !=0 order by lastModifyDate desc limit 1";
//                $ret = SQL($pdo, $sql, null, 'one');
//                $personalInfoArr = $ret;
//            }

        switch ($personalInfoArr) {
            case "PDIns" :
                $soInsFun = round($societyAvg * 0.005 * 0.6, 2);
                break;
            default :
                $radix = $personalInfoArr ['radix'];
                foreach ($personalInfoArr as $wK => $wV) {

                    #以后所有的domicile ,都用cityInsurance 来代替
//                    if ($personalInfoArr ['domicile'] == "1") {
//                        $type = "1";
//                    } elseif ($personalInfoArr ['domicile'] == "2" && ($personalInfoArr ['hospitalization'] == "2" || ($personalInfoArr ['employmentInjury'] == "1" && $personalInfoArr ['hospitalization'] == "0"))) {
//                        $type = "2";
//                    } elseif ($personalInfoArr ['domicile'] == "2" && $personalInfoArr ['hospitalization'] == "4") {
//                        $type = "3";
//                    } elseif ($personalInfoArr ['domicile'] == "2" && $personalInfoArr ['hospitalization'] == "1") {
//                        $type = "4";
//                    } elseif (!$personalInfoArr ['domicile']) {
//                        exit ($personalInfoArr ['name'] . ": 户籍类型或购买险种出错了,请联系管理员查证");
//                    }

                    switch ($wK) {
                        case "pension" :
                            if ($wV == "1") {
                                $uPension = round($personalInfoArr ['radix'] * $soInsSet ['uPension'], 2);
                                $pPension = round($personalInfoArr ['radix'] * $soInsSet ['pPension'], 2);
                            }
                            break;
                        case "employmentInjury" :
                            if ($wV == "1") {
                                $uEmploymentInjury = round($personalInfoArr ['radix'] * $soInsSet ['uEmploymentInjury'], 2);
                            }
                            break;
                        case "unemployment" :
                            if ($wV == "1") {
                                $uUnemployment = round($soInsSet ['minSalaryAvg'] * $soInsSet ['uUnemployment'], 2);
                                $pUnemployment = round($soInsSet ['minSalaryAvg'] * $soInsSet ['pUnemployment'], 2);
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
                                    $prsRadix = $personalInfoArr ['radix'] > $soInsSet ['minRadix'] ? $personalInfoArr ['radix'] : $soInsSet ['minRadix'];
                                    //两种计算方式
                                    $uHospitalization = round(($prsRadix * $soInsSet ['uHospitalization']), 2) + round(($radix * $soInsSet ['uBirth']), 2);
                                    //$uHospitalization = round(($prsRadix * $soInsSet ['uHospitalization'] + $prsRadix * $soInsSet ['uBirth']), 2);
                                    $pHospitalization = round($prsRadix * $soInsSet ['pHospitalization'], 2);
                                    break;
                                case "2" :
                                    //两种计算方式
                                    //$uHospitalization = round(($societyAvg * $soInsSet ['uHospitalization']), 2) + round(($societyAvg * $soInsSet ['uBirth']), 2);
                                    $uHospitalization = round(($societyAvg * $soInsSet ['uHospitalization']), 2) + round(($radix * $soInsSet ['uBirth']), 2);
                                    $pHospitalization = round($societyAvg * $soInsSet ['pHospitalization'], 2);
                                    break;
                                case "4" :
                                    $uHospitalization = round(($societyAvg * $soInsSet ['uHospitalization'] + $radix * $soInsSet ['uBirth']), 2);
                                    $pHospitalization = round($societyAvg * $soInsSet ['pHospitalization'], 2);
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
                } elseif ($unitArr ['soInsFrom'] == "2") {
                    //如果该单位是由个人垫付单位社保,则本月应收社保=单位+个人
                    $pTotal = $pTotal + $uTotal;
                    $uTotal = 0;
                } else {
                    if ($personalInfoArr ['type'] != "1") {
                        if ($unitArr ['notFullSoInsFrom'] == "1") {
                            //由单位支付  个人+单位的费用
                            $uTotal = $pTotal + $uTotal;
                            $pTotal = 0;
                        } elseif ($unitArr ['notFullSoInsFrom'] == "2") {
                            //由个人支付  个人+单位的费用
                            $pTotal = $pTotal + $uTotal;
                            $uTotal = 0;
                        }
                    }
                }
                $total = $pTotal + $uTotal;
                //1.获取社保费用数组(这里面含有残障金,但单位合计中不包含)
                $soInsFun = array(
                    "needMonthNumTotal" => $total * $needMonthNum,
                    'total' => $total,
                    "pension" => $uPension + $pPension,
                    "hospitalization" => $uHospitalization + $pHospitalization,
                    "employmentInjury" => $uEmploymentInjury,
                    "unemployment" => $uUnemployment + $pUnemployment,
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

    #公积金计算($thisMonth 默认的是当前月 ,用于缴交界面购买应该是起始月)
    function HFFun($personalInfoArr, $thisMonth = null, $needMonthNum = 1)
    {

        #如果封停日期在封账日期之后,则收取对应公积金月的公积金费用
//        $HFInTurnDate = $this->HFDate . insuranceInTurn("HF");
//        if ($personalInfoArr['housingFund'] == '0' && strtotime($personalInfoArr['HFModifyDate']) > strtotime($HFInTurnDate)) {
//            $pdo = $this->pdo;
//            $sql = "select fID,name,HFRadix,uHFPer,pHFPer,housingFund,type
//                                from `d_agent_personalInfo_history` where `fID` like '" . $personalInfoArr['$fID'] . "' and housingFund !=0 order by lastModifyDate desc limit 1";
//            $ret = SQL($pdo, $sql, null, 'one');
//            $personalInfoArr = $ret;
//        }

        $uTotal = round(($personalInfoArr ['HFRadix'] * $personalInfoArr ['uHFPer']), 2);
        $pTotal = round(($personalInfoArr ['HFRadix'] * $personalInfoArr ['pHFPer']), 2);
        $total = $pTotal + $uTotal;
        $HFFun = array(
            "needMonthNumTotal" => $total * $needMonthNum,
            "total" => $total,
            "uTotal" => $uTotal,
            "pTotal" => $pTotal
        );
        return $HFFun;
    }

    #服务费计算($thisMonth 默认的是当前月 ,用于缴交界面购买应该是起始月)
    #算法:分开结算社保和公积金的服务费,当有两项同时购买时,则当月的服务费在其中一项中总额增加20元,否则独立结算; 当二者的最新购买月份,及最后购买月份满足1-12个月的条件时,对应选择相应的服务费金额

    function mCostFun($personalInfoArr, $type = "counter")
    {

        //是否购买
        $soInsurance = $personalInfoArr['soInsurance'];
        $housingFund = $personalInfoArr['housingFund'];
        //如果已设置了管理费为固定模式changeless, 则type=basic
        if (!is_null($personalInfoArr['mCostLimit'])) {
            $mLimit = makeArray($personalInfoArr ['mCostLimit']);
            switch ($mLimit['model']) {
                //如果已设置了管理费为固定模式changeless, 则type=basic
                case "changeless":
                    $type = "basic";
                    break;
            }
        }
        //
        switch ($type) {
            //需要个人信息,重新计算服务费
            case "counter":
                //获取服务费初始化设置
                $mC = new agencySet();
                $mC->agencySetArr("programme");
                $mCostSet = $mC->agencySet;
                krsort($mCostSet);
                //只交社保
                if ($soInsurance != 0 && $housingFund == 0) {
                    //获取对应的服务费
                    $needMonthNum = $personalInfoArr['soInsNeedMonthNum'];
                    foreach ($mCostSet as $mk => $mv) {
                        if ($needMonthNum >= $mk) {
                            $actionMCostFun = $mv;
                            break;
                        }
                    }
//                    print_r($actionMCostFun);
                    $total = $actionMCostFun['money'];
                    $needMonthNumTotal = $needMonthNum * $actionMCostFun['money'];
                }

                //只交公积金
                if ($soInsurance == 0 && $housingFund != 0) {
                    //获取对应的服务费
                    $needMonthNum = $personalInfoArr['HFNeedMonthNum'];
                    foreach ($mCostSet as $mk => $mv) {
                        if ($needMonthNum >= $mk) {
                            $actionMCostFun = $mv;
                            break;
                        }
                    }
                    $total = $actionMCostFun['money'];
                    $needMonthNumTotal = $needMonthNum * $actionMCostFun['money'];
                }
                //两者都交
                if ($soInsurance != 0 && $housingFund != 0) {
                    //获取二者的缴交月份
                    $soInsMonth = $this->actionMonth($personalInfoArr, "soIns");
                    $HFMonth = $this->actionMonth($personalInfoArr, "HF");
                    $sameMonth = array_intersect($soInsMonth, $HFMonth);
                    $sameMonthNum = count($sameMonth);
                    //获取二者最大的月份差
                    $soInsBeginMonth = min($soInsMonth);
                    $HFBeginMonth = min($HFMonth);
                    $soInsEndMonth = max($soInsMonth);
                    $HFEndMonth = max($HFMonth);
                    $beginMonth = $soInsBeginMonth < $HFBeginMonth ? timeStyle("Ym", "-", strtotime($soInsBeginMonth . "01")) : timeStyle("Ym", "-", strtotime($HFBeginMonth . "01"));
                    $endMonth = $soInsEndMonth > $HFEndMonth ? timeStyle("Ym", "-", strtotime($soInsEndMonth . "01")) : timeStyle("Ym", "-", strtotime($HFEndMonth . "01"));
                    list($by, $bm) = explode("-", $beginMonth);
                    list($ey, $em) = explode("-", $endMonth);
                    $needMonthNum = ($ey - $by) * 12 + ($em - $bm) + 1;
                    foreach ($mCostSet as $mk => $mv) {
                        if ($needMonthNum >= $mk) {
                            $actionMCostFun = $mv;
                            break;
                        }
                    }
                    $needMonthNumTotal = $sameMonthNum * ($actionMCostFun['money'] + $mCostSet['both']['money']) + ($needMonthNum - $sameMonthNum) * $actionMCostFun['money'];
                    $total = round($needMonthNumTotal / $needMonthNum, 2);
                }
                break;
            //根据已设置的服务费,直接计算
            case "basic":
                //只交社保
                if ($soInsurance != 0 && $housingFund == 0) {
                    //获取对应的服务费
                    $needMonthNumTotal = round($personalInfoArr['mCost'] * $personalInfoArr['soInsNeedMonthNum']);
                    $total = $personalInfoArr['mCost'];
                }
                //只交公积金
                if ($soInsurance == 0 && $housingFund != 0) {
                    $needMonthNumTotal = round($personalInfoArr['mCost'] * $personalInfoArr['HFNeedMonthNum']);
                    $total = $personalInfoArr['mCost'];
                }
                //两者都交
                if ($soInsurance != 0 && $housingFund != 0) {
                    //获取二者的缴交月份
                    $soInsMonth = $this->actionMonth($personalInfoArr, "soIns");
                    $HFMonth = $this->actionMonth($personalInfoArr, "HF");
                    //获取二者最大的月份差
                    $soInsBeginMonth = min($soInsMonth);
                    $HFBeginMonth = min($HFMonth);
                    $soInsEndMonth = max($soInsMonth);
                    $HFEndMonth = max($HFMonth);
                    $beginMonth = $soInsBeginMonth < $HFBeginMonth ? timeStyle("Ym", "-", strtotime($soInsBeginMonth . "01")) : timeStyle("Ym", "-", strtotime($HFBeginMonth . "01"));
                    $endMonth = $soInsEndMonth > $HFEndMonth ? timeStyle("Ym", "-", strtotime($soInsEndMonth . "01")) : timeStyle("Ym", "-", strtotime($HFEndMonth . "01"));
                    list($by, $bm) = explode("-", $beginMonth);
                    list($ey, $em) = explode("-", $endMonth);
                    $needMonthNum = ($ey - $by) * 12 + ($em - $bm) + 1;
                    //
                    $needMonthNumTotal = round($needMonthNum * $personalInfoArr['mCost']);
                    $total = $personalInfoArr['mCost'];
                }
                break;
        }
        $mCostFun = array("needMonthNumTotal" => $needMonthNumTotal, "total" => $total, "needMonthNum" => $needMonthNum);
        return $mCostFun;


    }
}
