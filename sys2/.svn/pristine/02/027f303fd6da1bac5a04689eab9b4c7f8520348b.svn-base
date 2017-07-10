<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/25
 * Time: 8:50
 */

require_once "workerClassLink.class.php";
//执行获取请求参数
getParm();
#解析参数 ,及回传信息
function getParm()
{
    $aSet = new workerServiceSet();
    $key = $aSet->workerServiceSetArr("wx_encrypt_key");
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
#员工个人工资详情
function moreSalaryDetail($param)
{
    $id = (int)$param['id'];
    $pdo = $GLOBALS['pdo'];
    $uID =$param['uID'] ;
    $salaryDate = $param['salaryDate'];
    //应发工资，个人社保，个人公积金，商保，个人所得税，实发工资
    //$sql = "select bID,pay,pSoIns,pHousingFund,pTax,acheive from a_workerinfo a a_originalFee b  where a.uID=b.uID and unionid = '".$param['unionid']."'limit".$param['id'].",1";
    $sql1 = "select bID,month,name,pay,pSoIns,salaryDate,pComIns,pHF,pTax,acheive from a_originalFee  where salaryDate='" . $salaryDate. "'and uID ='".$uID."' order by salaryDate desc";
    $sql2 = "select bID,month,name,pay,pSoIns,salaryDate,pComIns,pHF,pTax,acheive from a_mul_originalFee  where salaryDate='" . $salaryDate. "'and uID ='".$uID."' order by salaryDate desc";
    $mainArr = SQL($pdo, $sql1,"");
    $sql3 = "select bID,name,month,rewardDate,pay,pTax,acheive from a_rewardFee  where rewardDate='".$salaryDate."' and uID='".$uID."'";
    $mulArr = SQL($pdo, $sql2);
    $rewardArr = SQL($pdo, $sql3);
    $tempMonthArr = mergeArray($mainArr,$mulArr);
    foreach($tempMonthArr as $val){
        $monthArr[] =$val['month'];
    }
    $month = max($monthArr);
    $sql4 = "select pSoInsMoney,pHFMoney,pComInsMoney,month from a_prsRequireMoney where month like '$month' and uID like '$uID' ";
    $prsRequireMoneyArr = SQL($pdo,$sql4);
    $ret = array("main" => $mainArr, "mul" => $mulArr, "reward" => $rewardArr,"prsRequireMoney"=>$prsRequireMoneyArr);
    $ret = dataCreate($ret);
    return $ret;

}
function moreSalaryList($param)
{
    $pdo = $GLOBALS['pdo'];
    $uID =$param['uID'] ;
    $sendStatus = " and sendStatus='1' ";
    $sql = "select salaryDate from (select salaryDate from  a_originalFee  where uID= '$uID' $sendStatus order by salaryDate desc limit 1) t1
     union
        select salaryDate from ( select salaryDate from  a_mul_originalFee  where uID= '$uID' $sendStatus order by salaryDate desc limit 1) t2
    union
        select salaryDate from (select rewardDate as salaryDate from  a_rewardFee  where uID= '$uID' $sendStatus order by rewardDate desc limit 1) t3
    ";
    $date = SQL($pdo,$sql,"");
    foreach($date as $key=>$val){
        $salaryDateArr[] =$val['salaryDate'];
    }
    $salaryDate = max($salaryDateArr);
    //应发工资，个人社保，个人公积金，商保，个人所得税，实发工资
    $sql1 = "select sponsorTime,salaryDate,acheive from a_originalFee  where salaryDate='" .$salaryDate. "' and uID='$uID' $sendStatus order by sponsorTime desc ";
    $sql2 = "select sponsorTime,salaryDate,acheive from a_mul_originalFee  where salaryDate='" .$salaryDate. "' and uID= '$uID' $sendStatus order by sponsorTime desc ";
    $mainArr1 = SQL($pdo, $sql1);
    $mulArr1 = SQL($pdo, $sql2);
    $sponsorTime1=date('Ym',strtotime($salaryDate."01"."-1 month"));
    $sponsorTime2=date('Ym',strtotime($salaryDate."01"." -1 month"));
    $sql3 = "select sponsorTime,salaryDate,acheive from a_originalFee  where salaryDate='" .$sponsorTime1. "' and uID='$uID' $sendStatus order by sponsorTime desc ";
    $sql4 = "select sponsorTime,salaryDate,acheive from a_mul_originalFee  where salaryDate='" .$sponsorTime2. "' and uID= '$uID' $sendStatus order by sponsorTime desc ";
    $mainArr2 = SQL($pdo, $sql3);
    $mulArr2 = SQL($pdo, $sql4);
    $sponsorTime3=date('Ym',strtotime($salaryDate."01"."-2 month"));
    $sponsorTime4=date('Ym',strtotime($salaryDate."01"." -2 month"));
    $sql5 = "select sponsorTime,salaryDate,acheive from a_originalFee  where salaryDate='" .$sponsorTime3. "' and uID='$uID' $sendStatus order by sponsorTime desc ";
    $sql6 = "select sponsorTime,salaryDate,acheive from a_mul_originalFee  where salaryDate='" .$sponsorTime4. "' and uID= '$uID' $sendStatus order by sponsorTime desc ";
    $mainArr3 = SQL($pdo, $sql5);
    $mulArr3 = SQL($pdo, $sql6);
    $ret=array_merge_recursive($mainArr1,$mainArr2,$mainArr3,$mulArr1,$mulArr2,$mulArr3);
    $ret = dataCreate($ret);
    return $ret;

}
//当前月份工资
function lastSalaryDetail($param)
{

    $pdo = $GLOBALS['pdo'];
    $uID =$param['uID'] ;
    //todo 控制审核后可查
    $sendStatus = " and sendStatus='1' ";
    $sql = "select salaryDate from (select salaryDate from  a_originalFee  where uID= '".$uID."' $sendStatus order by salaryDate desc limit 1) t1
     union
        select salaryDate from ( select salaryDate from  a_mul_originalFee  where uID= '".$uID."' $sendStatus order by salaryDate desc limit 1) t2
    union
        select salaryDate from (select rewardDate as salaryDate from  a_rewardFee  where uID= '".$uID."' $sendStatus order by rewardDate desc limit 1) t3
    ";
    $date = SQL($pdo,$sql,"");
    foreach($date as $key=>$val){
        $salaryDateArr[] =$val['salaryDate'];
    }
   $salaryDate = max($salaryDateArr);
//    应发工资，个人社保，个人公积金，商保，个人所得税，实发工资
    $sql1 = "select bID,name,month,salaryDate,pay,pSoIns,pHF,pComIns,pTax,acheive from a_originalFee  where  salaryDate='" . $salaryDate. "'and uID= '".$uID."' $sendStatus";
    $mainArr = SQL($pdo, $sql1,"");
    $sql2 = "select bID,name,month,salaryDate,pay,pSoIns,pHF,pComIns,pTax,acheive from a_mul_originalFee  where salaryDate='" . $salaryDate. "'  and uID= '".$uID."' $sendStatus";
    $sql3 = "select bID,name,month,rewardDate,pay,pTax,acheive from a_rewardFee  where  rewardDate='" . $salaryDate . "' and uID= '".$uID."' $sendStatus";
    $mulArr = SQL($pdo, $sql2);
    $rewardArr = SQL($pdo, $sql3);
    $tempMonthArr = mergeArray($mainArr,$mulArr);
    foreach($tempMonthArr as $val){
        $monthArr[] =$val['month'];
    }
    $month = max($monthArr);
    $sql4 = "select pSoInsMoney,pHFMoney,pComInsMoney,month from a_prsRequireMoney where month like '$month' and uID like '$uID' ";
    $prsRequireMoneyArr = SQL($pdo,$sql4);
    $ret = array("main" => $mainArr, "mul" => $mulArr, "reward" => $rewardArr,"prsRequireMoney"=>$prsRequireMoneyArr);
    $ret = dataCreate($ret);
    return $ret;
}
//员工信息
function workerInfo($param)
{
    //姓名，身份证号码，手机号码，联系地址，银行卡账号，单位名称，合同到期时间，紧急联系人，紧急联系人电话。
    $sql = "select name,pID,mobilePhone,homeAddress,bID,cEndDay,contact,contactPhone from a_workerinfo where userID= '" . $param['uid'] . "'";
    $pdo = $GLOBALS['pdo'];
    $ret = SQL($pdo, $sql, $var = null, $type = "all");
    $ret = dataCreate($ret);
    return $ret;
}
//月平均工资
function averageWage($param)
{
    $pdo = $GLOBALS['pdo'];
    $uID =$param['uID'] ;
    $sql1 ="select salaryDate from a_originalFee where  uID='".$uID."' order by salaryDate desc limit 1 ";
    $time = SQL($pdo,$sql1);
    $bt[] = $time[0]['salaryDate'];
    $sql2 ="select salaryDate from a_mul_originalFee where uID='".$uID."' order by salaryDate desc limit 1 ";
    $time = SQL($pdo,$sql2);
    $bt[] = $time[0]['salaryDate'];
    $bt = max($bt);
    $et = date('Ym',strtotime($bt."01".'-1 year'));
    $sql3 ="select pay,salaryDate from a_originalFee where  uID='".$uID."' and salaryDate > $et ";
    $mainArr = SQL($pdo, $sql3, $var = null, $type = "all");
    $sql4 ="select pay,salaryDate from a_mul_originalFee where  uID='".$uID."' and salaryDate > $et ";
    $mulArr = SQL($pdo, $sql4, $var = null, $type = "all");
    $ret = array_merge_recursive($mainArr,$mulArr);
    foreach($ret as $key => $val){
        $tem[$val['salaryDate']]['salaryDate'] = $val['salaryDate'];
        $tem[$val['salaryDate']]['pay'] +=$val['pay'];
    }
    $ret = dataCreate($tem);
    return $ret;
}

//记录查阅工资
function salaryReaded($param)
{
    $pdo = $GLOBALS['pdo'];
    $id = (int)$param['id'];
    $uID =$param['uID'] ;
    $salaryDate = $param['salaryDate'];
    $sql1 = "select salaryDate from a_originalFee  where salaryDate='".$salaryDate."' and uID='".$uID."' order by sponsorTime desc limit ".$id.",1";
    $mainArr = SQL($pdo, $sql1, $var = null, $type = "all");
    $sql2 = "select salaryDate from a_mul_originalFee  where salaryDate='".$salaryDate."' and uID='".$uID."'order by sponsorTime desc limit ".$id.",1";
    $mulArr = SQL($pdo, $sql2, $var = null, $type = "all");
    $ret = array("main"=>$mainArr,"mul"=>$mulArr);
    $ret = dataCreate($ret);
    return $ret;
}
//年收入
function incomeYear($param)
{
    $pdo = $GLOBALS['pdo'];
    $uID =$param['uID'] ;
    $sql1 ="select salaryDate from a_originalFee where  uID='".$uID."' order by salaryDate desc limit 1 ";
    $time = SQL($pdo,$sql1);
    $bt[] = $time[0]['salaryDate'];
    $sql2 ="select salaryDate from a_mul_originalFee where uID='".$uID."' order by salaryDate desc limit 1 ";
    $time = SQL($pdo,$sql2);
    $bt[] = $time[0]['salaryDate'];
    $bt = max($bt);
    $et = date('Ym',strtotime($bt."01".'-1 year'));
    $sql3 ="select pay from a_originalFee where  uID='".$uID."' and salaryDate > $et ";
    $mainArr = SQL($pdo, $sql3, $var = null, $type = "all");
    $sql4 ="select pay from a_mul_originalFee where  uID='".$uID."' and salaryDate > $et ";
    $mulArr = SQL($pdo, $sql4, $var = null, $type = "all");
    $ret = array("main"=>$mainArr,"mul"=>$mulArr);
    $ret = dataCreate($ret);
    return $ret;
}
//删除证明数据
function deleteProveData($param)
{
    $proveID = "select proveID from a_contactinfo where uID='" . $param['uid'] . "'";
    $ID = "select ID from a_prove where  uID='" . $param['uid'] . "'";
    $pdo = $GLOBALS['pdo'];
    $proveID = SQL($pdo, $proveID, null, $type = "all");
    $ID = SQL($pdo, $ID, null, $type = "all");
    foreach ($proveID as $key => $value) {
        $a[] = $value['proveID'];
    }
    foreach ($ID as $key => $value) {
        $b[] = $value['ID'];
    }
    $deleteID = array_diff($b, $a);
    $strDeleteID = implode(",", $deleteID);
    for ($d = 0; $d <= strlen($strDeleteID); $d++) {
        $sql = "delete from a_prove where ID='" . $deleteID[$d] . "'";
        $ret = SQL($pdo, $sql, null, $type = "all");
    }
}
//客户经理
function mName($param)
{
    $sql = "select mName from s_user  where unitID REGEXP '" . $param['unitID'] . "' and roleID REGEXP '2_1'";
    $pdo = $GLOBALS['pdo'];
    $ret = SQL($pdo, $sql, $var = null, $type = "all");
    $ret = dataCreate($ret);
    return $ret;
}

//单位名称
function uName($param)
{
    $sql = "select unitName from a_unitinfo  where unitID REGEXP '" . $param['unitID'] . "'";
    $pdo = $GLOBALS['pdo'];
    $ret = SQL($pdo, $sql, $var = null, $type = "all");
    $ret = dataCreate($ret);
    return $ret;
}

//删除证明ID
function proveDel($param)
{
    $sqlOne = "delete from `a_prove` where ID = '" . $param['proveID'] . "'";
    $sqlTwo = "delete from `a_contactinfo` where proveID = '" . $param['proveID'] . "'";
    $pdo = $GLOBALS['pdo'];
    $retOne = SQL($pdo, $sqlOne, $var = null, $type = "all");
    $retTwo = SQL($pdo, $sqlTwo, $var = null, $type = "all");
    $result = extraTransaction($pdo, $retOne);
    $errMsg ['sql'] = $result ['error'];
    if (empty($errMsg ['sql'])) {
        $ret['msg'] = "未获取记录";
        $ret['status'] = 0;
        $ret['result'] = 1;
    } else {
        $ret['msg'] = "删除成功";
        $ret['status'] = 1;
        $ret['result'] = 1;
    }
    return $ret;

}

function sendProveMsg($param)
{
    $wSet = new workerServiceSet();
    $wxTemplateIDArr = $wSet->workerServiceSetArr("wx_templateID");
//    if ($param['status'] == 2) {
    //证明审核结果推送给微信
    $url = "http://www.szhro.cn/workerService/index.php?s=/addon/WorkerService/Wap/process/";
    $fieldArr['sender'] = "1";
    $fieldArr['receiver'] = $param['uID'];
    $fieldArr['sendTime'] = timeStyle("dateTime");
    $fieldArr['level'] = "1";
    $fieldArr['fromTo'] = "4";
    $wxFieldArr['uid'] = $param['uID'];
    $wxFieldArr['templateID'] = $wxTemplateIDArr['proveMsg']['ID'];
    $wxFieldArr['url'] = $url;
    $wxparam ['data'] ['first'] ['value'] = "证明审核结果通过";
    $wxparam ['data'] ['first'] ['color'] = "#173177";
    $wxparam ['data'] ['keyword1'] ['value'] = $fieldArr['sendTime'];
    $wxparam ['data'] ['keyword1'] ['color'] = "#173177";
    $wxparam ['data'] ['keyword2'] ['value'] = "证明申请";
    $wxparam ['data'] ['keyword2'] ['color'] = "#173177";
    $wxparam ['data'] ['keyword3'] ['value'] = "请到个人中心查询快递单号";
    $wxparam ['data'] ['keyword3'] ['color'] = "#E60B43";
    $wxparam ['data'] ['remark'] ['value'] = "请注意查收";
    $wxparam ['data'] ['remark'] ['color'] = "#173177";
    $wxFieldArr['param'] = serialize($wxparam);
    $ma = new msgAction();
    $ma->msgAdd($fieldArr);
    $ma->pdo = $GLOBALS['pdo'];
    $ma->wx_msgAdd($wxFieldArr);
//    }

}

#代理基础信息设置
function workerServiceBasicSet($param)
{
    $aSet = new agencySet();
    $aSet->p = $GLOBALS['pdo'];
    $data = $aSet->agencySetArr();
    $data = dataCreate($data);
    return $data;
}

