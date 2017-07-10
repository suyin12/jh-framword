<?php

/*
*       2015-12-4
*       <<< 代理人员信息相关类  >>>
*       create by Great sToNe
*       have fun,.....
*/

class agentUser
{
    public $pdo;
    public $agentUserArr; //array  代理人员信息数组
    public $personalRecordsArr; // array 个人参保记录
    public $feeCounterArr; //计算社保,公积金,管理费
    public $personalBillArr; //array 个人流水账记录
    public $stopUserArr;//停缴中人员列表

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #参保人基础信息
    public function agentUserBasic($selStr = " * ", $conStr = " status='1' ")
    {
        $pdo = $this->pdo;
       echo $sql = " select $selStr from d_agent_personalinfo where $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "fID");
        return $this->agentUserArr = $ret;
    }
    #参保人历史信息
    public function agentUserHistoryBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        $sql = " select $selStr from d_agent_personalinfo_history where $conStr ";
        $ret = SQL($pdo, $sql);
        return $this->agentUserArr = $ret;
    }

    #参保人信息重构
    public function  agentUserRecreate()
    {
        $aSet = new agencySet();
        $aSetArr = $aSet->agencySetArr("all");

        $aUserArr = $this->agentUserArr;
        foreach ($aUserArr as $key => $val) {
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "cityInsurance":
                        $val[$k . "Txt"] = $aSetArr['activeCity'][$val['city']]['cityInsurance'][$v];
                        break;
                    case "city":
                        $val[$k . "Txt"] = $aSetArr['activeCity'][$val['city']]['title'];
                        break;
                    case "mCostLimit":
                        $mCostLimit = makeArray($v);
                        $val[$k . "Txt"] = $aSetArr['mCostLimitTxt'][$mCostLimit['model']]['txt'];
                        break;
                    case "soInsurance":
                    case "housingFund":
                    case "sex":
                        $val[$k . "Txt"] = $aSetArr[$k . 'Txt'][$v];
                        break;
                    case array_key_exists($k . "Txt", $aSetArr):
                        $val[$k . "Txt"] = $aSetArr[$k . "Txt"][$v];
                        break;
                }

            }
            $agentUserRecreateArr[$key] = $val;
        }

        return $agentUserRecreateArr;
    }


    #个人参保记录, type=soIns只有社保,type=HF只有公积金
    public function  personalRecords($fID, $fieldStr = "*", $type)
    {
        $personalRecords = new agentInsuranceRecords();
        switch ($type) {
            case "soIns":
                $personalRecords->soInsFeeRecordsBasic($fieldStr, "`fID`  = '$fID' order by ID desc");
                $soInsRecords = $personalRecords->soInsOutFeeArr;
                $recordsArr = $soInsRecords;
                break;
            case "HF":
                $personalRecords->HFFeeRecordsBasic($fieldStr, "`fID` ='$fID' order by ID desc");
                $HFRecords = $personalRecords->HFOutFeeArr;
                $recordsArr = $HFRecords;
                break;
        }

        return $this->personalRecordsArr = $recordsArr;
    }

    #个人服务费+社保费+公积金费计算($field=('soIns','HF','mCost'),$val 传递的参数)
    function  feeCounter($field = "mCost", $val = "counter")
    {
        $fCounter = new agentFeeCounter();
        $agentUserArr = $this->agentUserArr;
        //
        foreach ($agentUserArr as $fID => $personalInfoArr) {
            //这里是起缴月份
            $soInsBeginDay = $personalInfoArr['soInsBeginDay'];
            $HFBeginDay = $personalInfoArr['HFBeginDay'];
            $soInsNeedMonthNum = $personalInfoArr['soInsNeedMonthNum'];
            $HFNeedMonthNum = $personalInfoArr['HFNeedMonthNum'];
            //计算社保费用
            $soInsFun = $fCounter->soInsFun($personalInfoArr, $soInsBeginDay, $soInsNeedMonthNum);
            //计算公积金费用
            $HFFun = $fCounter->HFFun($personalInfoArr, $HFBeginDay, $HFNeedMonthNum);
            //计算管理费费用
            if ($field == "mCost")
                $mCostCounterType = $val ? $val : "counter";
            $mCostFun = $fCounter->mCostFun($personalInfoArr, $mCostCounterType);
            $feeCounterArr[$fID] = array("soInsFun" => $soInsFun, "HFFun" => $HFFun, "mCostFun" => $mCostFun);
        }

        return $this->feeCounterArr = $feeCounterArr;

    }

    #申请停缴的人员列表,默认为停缴中的人员
    function stopUserBasic($selStr = " * ", $conStr = "status=0")
    {
        $pdo = $this->pdo;
        $sql = " select $selStr from d_agent_stop where $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "ID");
        return $this->stopUserArr = $ret;
    }


    #查看人员是否在停缴中的状态
    function checkUserStop()
    {
        $pdo = $this->pdo;
        $aUArr = $this->agentUserArr;
        $fIDArr = array_keys($aUArr);
        $fIDStr = implode(",", $fIDArr);
        $sql = "select * from `d_agent_stop` where fID in ($fIDStr) ";
        $stopUserArr = SQL($pdo, $sql);
        $stopUserArr = keyArray($stopUserArr, "fID");
        return $this->stopUserArr = $stopUserArr;
    }
}

?>
	
