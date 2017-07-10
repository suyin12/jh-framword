<?php

/*
 * 1.设置表d_agent_personalInfo的参保信息函数
 * 2.$con 表示的是 condition(where条件)
 * 3.$num 表示的是 需要那几条sql语句.(array类型)
 * 4.生成的信息为数组格式 $key=>$value
 * 
 */
require_once sysPath . '/dataFunction/wInfoSet.data.php';

class agencySet extends wInfoSet
{
    public $p; //$pdo   对象
    public $agencySet; //这个数组是配合common.function.php中的reCreatArray两个结合使用

    function __construct()
    {
        $this->p = $GLOBALS['pdo'];
    }


    public function agencySetArr($field = "all")
    {
        $agencyBasicSet = array(
            'activeCity' => array(
                '0755' => array("title" => "深圳",
                    "cityInsurance" => array("1" => "深户一档", "4" => "非深户一档", "2" => "非深户二档", "3" => "非深户三档"),
                    "HFPercent" => array(
                        "1" => array("pHFPer" => "0.05", "uHFPer" => "0.05"),
                        "2" => array("pHFPer" => "0.1", "uHFPer" => "0.1"),
                    )),
                '020' => array("title" => "广州", "cityInsurance" => array("1" => "统一")),
            ),
            'insuranceInTurn' => array(
                "soInsInTurn" => insuranceInTurn("soIns"),
                "HFInTurn" => insuranceInTurn("HF"),
            ),
            'programme' => array(
                "0" => array("txt" => "--选择套餐--", "money" => 0),
                "1" => array("txt" => "1个月(首次体验价10元)", "money" => 10),
                "3" => array("txt" => "3个月(68元/月)", "money" => 68),
                "6" => array("txt" => "6个月(58元/月)", "money" => 58),
                "12" => array("txt" => "12个月(40元/月)", "money" => 40),
                'both' => array("txt" => "同时购买社保/公积金,管理费增加20元", "money" => 20)
            ),
            "statusTxt" => array(
                "0" => "已停缴",
                "1" => "正常",
                "2" => "续缴未支付",
                "5" => "新增未支付"
            ),
            'billType' => array(
                "1" => "现金",
                '2' => "余额支付",
                "3" => "转账",
                "4" => "退款",
                "5" => "微信支付",
                "6" => "支付宝支付"
            ),
            'billPayment' => array(
                "1" => "社保",
                '2' => "公积金",
                "3" => "管理费",
                "4" => "残障金",
                "5" => "补缴",
                "6" => "补缴管理费"
            ),
            'orderCancelReason' => array(
                '1' => "服务费太贵",
                '2' => "客服态度较差",
                '3' => "有更合适的机构",
                '4' => "其他"
            ),
            'orderStatus'=> array(
                "0"=>"失效",
                "1"=>"正常",
                "5"=>"异常"
            ),
            'payStatus' => array(
                "0" => "未支付",
                "1" => "已支付",
//                "5" => "确认中",
                "95" => "已受理退款",
                "98" => "已退款",
                "99" => "退款中"
            ),
            'orderType' => array(
                "1" => "投保订单支付",
                "2" => "退款订单"
            ),
            "wx_templateID" => array(
                "orderCreate" => array("txt" => "订单生成通知", "ID" => "1dDOEWdLvKbxmVRBKhLr7Iq1kfxpuOn-M3R6OUDfaR8"),
                "paid" => array("txt" => "支付成功通知", "ID" => "nWd2wt8tg_vRz8Zzl7Qh21EimDPUY35usT8SEa_uQCQ"),
                "noPay" => array("txt" => "下单成功未支付通知", "ID" => "UZEGkSmyDfBpVThF_22z4cIZP2UiV7ZLIOaNb0wZXNA"),
            ),
            "wx_encrypt_key" => "wx00f249ca19e47f51",
            "bankInitArr" => array(
                "1" => array("ID" => "1", "name" => "中国银行",),
                "2" => array("ID" => "2", "name" => "工商银行",)
            ),
            "mCostLimitTxt" => array(
                "" => array("txt" => "套餐模式"),
                "changeless" => array("txt" => "恒定模式"),
            ),
            "soInsuranceTxt" => array(
                "0" => "未购买",
                "1" => "正常",
                "2" => "修改中",
                "5" => "未确认"
            ),
            "insuranceListStatusTxt"=>array(
                "0"=>"封停",
                "1"=>"新增",
                "2"=>"修改",
            ),
            "housingFundTxt" => array(
                "0" => "未购买",
                "1" => "正常",
                "2" => "修改中",
                "5" => "未确认"
            ),


        );
        switch ($field) {
            case "all":
                $wSet = new wInfoSet();
                $wSet->wInfoSetArr();
                $wInfoSet = $wSet->wInfoSet;
                $type = $this->type;
                $pdo = $this->p;

                if ($pdo) {
                    $sql = "select ID,nationName from s_nation";
                    $nationRet = $pdo->query($sql);
                    foreach ($nationRet as $naval) {
                        $naRet [$naval ['ID']] = $naval ['nationName'];
                    }
                    $unitRet = SQL($pdo, "select unitID,unitName from a_unitInfo");
                    foreach ($unitRet as $uval) {
                        $uRet [$uval ['unitID']] = $uval ['unitName'];
                    }
                    unset ($nationRet, $unitRet);
                }
                $extraSet = array(
                    'nationTxt' => $naRet,
                    'unitName' => $uRet,
                    'sexTxt' => $wInfoSet['sex'],
                    'domicileTxt' => $wInfoSet['domicile'],
                    'marriageTxt' => $wInfoSet ['marriage'],
                    'proTitleTxt' => $wInfoSet ['proTitle'],
                    'proLevelTxt' => $wInfoSet ['proLevel'],
                    'educationTxt' => $wInfoSet ['education']
                );
                $agencySet = array_merge($agencyBasicSet, $extraSet);
                break;
            case "basic":
                $agencySet = $agencyBasicSet;
                break;
            default:
                $agencySet = $agencyBasicSet[$field];
                break;
        }

        return $this->agencySet = $agencySet;
    }

    #初始化保险购买原则
    public function soInsDefaultSet($city, $cityInsurance, $yesOrNo = "1")
    {
        if ($yesOrNo == "1") {
            $sql = "select minRadix from s_soIns_set where city='$city' and type='$cityInsurance' order by month desc limit 1";
            $set = SQL($this->p, $sql, "", "one");
            switch ($city) {
                case "0755":

                    //设置购买社保选项
                    $ret["radix"] = $set['minRadix'];
                    $ret["pension"] = "1";
                    if ($cityInsurance == "4")
                        $ret['hospitalization'] = "1";
                    elseif ($cityInsurance == "3")
                        $ret['hospitalization'] = "4";
                    else
                        $ret['hospitalization'] = $cityInsurance;
                    $ret["employmentInjury"] = "1";
                    $ret["unemployment"] = "1";
                    $ret["PDIns"] = "1";
                    break;

            }
        } else {
            $ret["radix"] = "0";
            $ret['hospitalization'] = "0";
            $ret["pension"] = "0";
            $ret["employmentInjury"] = "0";
            $ret["unemployment"] = "0";
            $ret["PDIns"] = "0";
            $ret['soInsBeginDay'] = "0000-00-00";
            $ret['soInsBeginMonth'] = "0000-00";
            $ret['soInsNeedMonthNum'] = "0";
        }

        return $ret;

    }

    #初始化公积金
    public function HFDefaultSet($city, $cityInsurance, $yesOrNo = "1")
    {
        if ($yesOrNo == "1") {
            $sql = "select minRadix from s_soIns_set where city='$city' and type='$cityInsurance' order by month desc limit 1";
            $set = SQL($this->p, $sql, "", "one");
            $HFPercent = $this->agencySetArr("activeCity");
            switch ($city) {
                case "0755":
                    $ret['uHFPer'] = $HFPercent[$city]['HFPercent']["1"]['uHFPer'];
                    $ret['pHFPer'] = $HFPercent[$city]['HFPercent']["1"]['pHFPer'];
                    $ret['HFRadix'] = $set['minRadix'];
                    break;
            }

        } else {
            $ret['uHFPer'] = 0;
            $ret['pHFPer'] = 0;
            $ret['HFRadix'] = 0;
            $ret['HFBeginDay'] = "0000-00-00";
            $ret['HFBeginMonth'] = "0000-00";
            $ret['HFNeedMonthNum'] = "0";
        }


        return $ret;

    }
}

?>