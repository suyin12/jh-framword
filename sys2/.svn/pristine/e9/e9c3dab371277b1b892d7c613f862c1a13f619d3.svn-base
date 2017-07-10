<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/25
 * Time: 8:50
 */
require_once "BAClassLink.class.php";

//执行获取请求参数
getParm();
#解析参数 ,及回传信息
function getParm()
{
    $aSet = new businessAnalysis();
    $key = $aSet->businessAnalysisSetArr("wx_encrypt_key");
    $model = $_GET ['model'];
    $content = file_get_contents('php://input');
    $json = think_decrypt($content, $key);
    $param = json_decode($json, true);
    $ret = call_user_func($model, $param);
    $ret = json_encode($ret);
    $ret = think_encrypt($ret, $key);
    echo $ret;
}

//需要封装的结果
function dataCreate($data)
{
    $count = count($data);
    if (is_null($data)) {
        $ret['msg'] = "未获取记录";
        $ret['status'] = 0;
        $ret['result'] = 1;
    } else {
        $ret['msg'] = "获取记录";
        $ret['status'] = 1;
        $ret['result'] = 1;
        $ret['count'] = $count;
        $ret ['data'] = $data;
    }
    return $ret;
}

#基础信息设置
function basicSet()
{
    //中英文对照
    $data['engToChs'] = engTochs();
    $data = dataCreate($data);
    return $data;
}

#员工入离职情况
function workerStat()
{
    $pdo = $GLOBALS['pdo'];
    $unitArr = unitAll($pdo, "unitID,unitName", " and status=1 ", "all");
    #构造 SQL, 入/离职,修改社保统一显示在一起(其实,社保的最后修改时间,可以判断员工的离入职情况)
    $sql = "select distinct(a.uID),a.name,a.domicile,a.unitID,b.unitName,a.type,a.soInsModifyDate,a.status,a.soInsurance,a.housingFund,a.comInsurance,a.helpCost, a.mountGuardDay,a.radix,a.pension,a.hospitalization,a.employmentInjury,a.unemployment,a.housing,a.PDIns,a.hand from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID  ";
    #获取某时间段
    $beginTime = timeStyle("firstdayMon", "-", strtotime("-1 month"));
    $endTime = timeStyle("finallyDayMon", "-", strtotime("-1 month"));
    $excVar = array(":beginTime" => $beginTime, ":endTime" => $endTime);


    if ($excVar) {
        //入职SQL
//			$sql1 = " a.mountGuardDay between :beginTime and :endTime and a.status not like '0'";
//	$sql1 .= " select uID from a_soInsList where soInsModifyDate between  :beginTime and :endTime and soInsurance in ('1','2') ";
        //离职SQL
        $sql2 = " select uID from a_dimission where dimissionDate between :beginTime and :endTime";
        //社保修改SQL
        $sql3 = " select uID from a_soInsList  where soInsModifyDate between :beginTime and :endTime and soInsurance like '2' ";
        //停保人员名单(因为停保人数大于离职人数..)
        $sql5 = " select uID from a_soInsList where soInsModifyDate between  :beginTime and :endTime and soInsurance like '0'";
        //封存公积金名单(因为封存人数大于离职人数..)
        $sql6 = " select uID from a_HFList where HFModifyDate between  :beginTime and :endTime and housingFund like '0'";

        $sql1 = $sql . "   where   a.status not like '0'  and a.mountGuardDay between :beginTime and :endTime " . $sqlUnit . " order by a.unitID";
        $sql2 = $sql . "  left join (" . $sql2 . ") c on a.uID=c.uID  where  c.uID is not null   and a.status like '0' " . $sqlUnit . " order by a.unitID";
        $sql3 = $sql . "  left join (" . $sql3 . ") c on a.uID=c.uID  where  c.uID is not null   and a.status not like '0' " . $sqlUnit . " order by a.unitID";
        $sql5 = $sql . "  left join (" . $sql5 . ") c on a.uID=c.uID  where  c.uID is not null    " . $sqlUnit . " order by a.unitID";
        $sql6 = $sql . "  left join (" . $sql6 . ") c on a.uID=c.uID  where  c.uID is not null    " . $sqlUnit . " order by a.unitID";
        //合成 入职,离职,修改 数组
        $mountArray = SQL($pdo, $sql1, $excVar);
        $dimissionArray = SQL($pdo, $sql2, $excVar);
        $modifyArray = SQL($pdo, $sql3, $excVar);
        $stopSoInsArray = SQL($pdo, $sql5, $excVar);
        $stopHFArray = SQL($pdo, $sql6, $excVar);
        foreach ($unitArr as $key => $val) {
            $tmp[$key]['unitName'] = $val['unitName'];
            #入职
            foreach ($mountArray as $mv) {
                if ($key == $mv['unitID']) {
                    $tmp[$key]['mount'] += 1;
                }

            }
            #离职
            foreach ($dimissionArray as $dv) {
                if ($key == $dv['unitID']) {
                    $tmp[$key]['dimission'] += 1;
                }

            }
            #公积金停缴人员
            foreach ($stopHFArray as $sv) {
                if ($key == $sv['unitID']) {
                    $tmp[$key]['stopHF'] += 1;
                }

            }


        }
    }

    $ret = dataCreate($tmp);
    return $ret;

}

# 欠款
function requireMoney()
{
    $pdo = $GLOBALS['pdo'];
    $unitArr = unitAll($pdo, "unitID,unitName", " and status=1 ", "all");

    $moneyData = new money();
    $moneyData->pdo = $pdo;
    $moneyData->month = date("Ym");
    $i=0;
    foreach ($unitArr as $key => $val) {
        if($i<15){
            $moneyData->unitID = $key;
            $moneyData->thisMonth = true;
            $sumMoney[$key] = $moneyData->sumMoneyByUnit();
            $sumMoney[$key]['unitName'] = $val['unitName'];
        }
        $i++;
    }
//    echo "<pre>";
//    print_r($sumMoney);
    $ret = dataCreate($sumMoney);
    return $ret;


}