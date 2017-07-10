<?php
/*
作者：LOSKIN
time:2014-02-21
描述：个人代理平账
更新：
	社保、公积金上传Excel模板数据<<<<平账>>>>
*/

#引用配置文件
require_once 'agMconfig.php';
require_once 'aInfo_agm.php';
/*  初始化设置 */
$title = "个代平账首页";
require_once 'soInsFee_agm.php';
require_once 'bill_agm.php';
require_once 'aInfo_agm.php';
require_once 'hfFee_agm.php';
require_once 'latepay_agm.php';

$latesoins = new latesoins();
$SoFee=new SoFee();
$bill=new bill();
$aInfo=new aInfo();
$fee=new feeExtra($pdo);
$HFFee=new HFFee();

#***************公共部分****************
$aInfoSet = $aSet->agencySet;
#所有社保缴交年月的记录
$soInsMonAll=$fee->getSoInsMonAll();
#公积金的缴交记录近2年
$HFMonAll=$HFFee->getHFMonAll("6");

if ($_GET ['soInsDate']) {
	$soInsDate = $_GET ['soInsDate'];
} elseif ($_GET ['HFDate']){
	$HFDate = $_GET ['HFDate'];
}else {
	header ( "location:" . httpPath . "agencyService/agMFeelist.php?soInsDate=" . timeStyle ( "Ym", "" ) );
}

#************************对社保缴交的数据进行平账******************
if (!empty($soInsDate)) {
	#验证社保缴交明细的人员是否都已经录入到系统中...并获取已经导入的月份
	$sql = "select dID,soInsDate,soInsID,type from d_soInsfee_tmp where soInsDate='{$soInsDate}' and type='1' group by  soInsID";
	$soInsIDArrA = SQL ( $pdo, $sql);
	$sql = "select dID,soInsDate,soInsID,type from d_soInsfee_tmp where soInsDate='{$soInsDate}' and type='2' group by  soInsID";
	$soInsIDArrB = SQL ( $pdo, $sql);
	$soInsIDArr = array_merge($soInsIDArrA,$soInsIDArrB);
	
    #调出社保的缴交明细
    $columList="a.`fID`,a.`soInsID`,a.`sID`,a.`name`,a.`radix`,a.`total`,a.`pTotal`,a.`uTotal`,b.`expenditure` as Soprice,b.`status`";
	$query="select {$columList} from d_soInsFee_tmp a left join d_agent_bill b on a.fID=b.fID where a.soInsDate='{$soInsDate}' and a.type='1' and b.paydate='{$soInsDate}' and b.payment='1' and b.type='2' and b.status!='1'";
    $SoDateList = SQL ( $pdo, $query);
	if (!empty($soInsIDArrA["0"]["dID"])){
		if (empty($SoDateList)){
	    	#说明该月所有的人社保费已入账，全部社保已经入账产生一条已入账的记录
	    	$sql = "select ID from a_action_record where month='{$soInsDate}' and type='agentS'";
	    	$agentS = SQL ($pdo,$sql);
	    	if (empty($agentS)){
	    		$sql = "insert into a_action_record(type,month,status) values('agentS','{$soInsDate}','1')";
				$AB = SQL ( $pdo, $sql);
	    	}
	    }
	    #社保补缴记录
	    $query="select id from d_agent_bill where paydate='{$soInsDate}' and payment='5' and type='2' and status='1'";
	    $SolateList = SQL ( $pdo, $query);
		if (!empty($SolateList)){
	    	$sql = "select ID from a_action_record where month='{$soInsDate}' and type='agentSS'";
	    	$agentSS = SQL ($pdo,$sql);
	    	if (empty($agentSS)){
	    		$sql = "insert into a_action_record(type,month,status) values('agentSS','{$soInsDate}','1')";
				$AB = SQL ( $pdo, $sql);
	    	}
	    }
	}
    
    #查出符合给出条件数组soInsDate,fID,payment,type
    #查找与条件(ˇˍˇ） 想～相应的流水账支出记录
    $billArr=$bill->getArr("2",$soInsDate);
    #系统折算社保费应缴数
    //$SoFeeArr=$SoFee->SoFeeprice($SoDateList,$soInsDate);
    $Soprice=$aInfo->SoAgmprice($soInsDate,$pdo);
    #补缴合计
    $latesoinsArr = $latesoins->expenlatesoins($soInsDate);
    foreach ($SoDateList as $k => $v){
    	foreach ($v as $kk => $vv) {
    		switch ($kk) {
            	case "fID":
            		break;
            	default:
                if (is_numeric($vv)) {
                    $total[$kk]+=round((double) $vv, 2);
                    $SoDateList[$k][$kk]=(float)$vv;
                } else {
                    $total[$kk] = null;
                }
                break;
    		}
    	}
    }
    
	#社保补交
	
	$query="select a.`fID`,a.`soInsID`,a.`sID`,a.`pID`,a.`name`,a.`type`,a.`radix`,a.`total`,a.`uPension`,a.`pPension`,a.`latepay`,a.`latepaymonth`,b.`expenditure` as Soprice ,b.`status` from d_soInsFee_tmp a left join d_agent_bill b on a.fID=b.fID where a.soInsDate='{$soInsDate}' and a.type='2' and b.paydate='{$soInsDate}' and b.payment='5' and b.type='2' and b.status!='1'";
    $Solate = SQL ( $pdo, $query);

}

#************************对公积金缴交的数据进行平账******************
if (!empty($HFDate)) {
	#验证社保缴交明细的人员是否都已经录入到系统中...并获取已经导入的月份
	$sql = "select dID,HFDate,housingFundID from d_hffee_tmp where HFDate='{$HFDate}' group by housingFundID";
	$HFIDArr = SQL ( $pdo, $sql);
	#调出公积金的缴交明细
    $columList="a.`fID`,a.`housingFundID`,a.`HFID`,a.`name`,a.`HFradix`,a.`total`,a.`pTotal`,a.`uTotal`,b.`expenditure` as HFprice,b.`status`";
	$query="select {$columList} from d_hffee_tmp a left join d_agent_bill b on a.fID=b.fID where a.HFDate='{$HFDate}' and b.payment='2' and b.type='2' and b.status!='1'";
    $HFDateList = SQL ( $pdo, $query);
	if (!empty($HFIDArr["0"]["dID"])){
		if (empty($HFDateList)){
	    	#说明该月所有的人公积金费已入账，全部已经入账产生一条已入账的记录
	    	$sql = "select ID from a_action_record where month='{$HFDate}' and type='agentH'";
	    	$agentH = SQL ($pdo,$sql);
	    	if (empty($agentH)){
	    		$sql = "insert into a_action_record(type,month,status) values('agentH','{$HFDate}','1')";
				$AB = SQL ( $pdo, $sql);
	    	}
	    }
	}
    $billArr=$bill->getArr("2",$HFDate);
	$HFprice=$aInfo->HFAgmprice($HFDate,$pdo);
}
//echo "<pre>";var_dump($latesoinsArr);
#变量配置
//$smarty->debugging = true;
$smarty->assign ( array (
	"soInsMonAll" => $soInsMonAll,
	"soInsIDArr" => $soInsIDArr,
	"s_soInsDate" => $soInsDate,
	"SoDateList" => $SoDateList,
	"Soprice" => $Soprice,
	"billArr" => $billArr,
	"HFMonAll" => $HFMonAll,
	"s_HFDate" => $HFDate,
	"HFIDArr" => $HFIDArr,
	"HFDateList" => $HFDateList,
	"HFprice" => $HFprice,
	"Solate" => $Solate,
	"latesoinsArr" => $latesoinsArr
));
$smarty->assign ( array (
	"aInfoSet" => $aInfoSet
));
#定义模板变量
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
#显示查询结果
$smarty->display("agencyService/agMFeelist.tpl");








