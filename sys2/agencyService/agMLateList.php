<?php
/*
作者：LOSKIN
time:2014-04-04
描述：社保、公积金的补缴
更新：
	
*/
#引用配置文件
require_once 'agMconfig.php';
require_once 'latepay_agm.php';
require_once 'lateHF_agm.php';
require_once 'aInfo_agm.php';
require_once 'hfFee_agm.php';
require_once 'bill_agm.php';

$title = "个人补缴记录";
$fee=new feeExtra($pdo);
$latesoins = new latesoins();
$lateHF = new lateHF();
$aInfo=new aInfo();
$HFFee=new HFFee();
$bill=new bill();

$fID = $_GET["fID"];
$latepaymonth = $_GET["latepaymonth"];
$radix = $_GET["radix"];
$pension = $_GET["pension"];
$latemanagementCost = $_GET["latemanagementCost"];
$paydate = $_GET["paydate"];
$closedate = $_GET["closedate"];//台账年月
$current_month = date("Ym");

$fee->soInsMonlist("distinct `month`","order by month asc");
if($_GET["type"]=="delsoins"){
	#删除补缴社保的记录
	$arr = $latesoins->selectListArr($_GET["id"],"`fID`,`paydate`");
	$re = $bill->status("2",$arr['0']["paydate"],$arr['0']["fID"]);
	if($re[$arr['0']["fID"]]["latesoIns"]!=="1"){
		$re = $latesoins->delLateByID(array("id"=>$_GET["id"]));
	}
}
if($_GET["type"]=="delHF"){
	#删除补缴公积金的记录
	$arr = $lateHF->selectListArr($_GET["id"],"`fID`,`paydate`");
	$re = $bill->status("2",$arr['0']["paydate"],$arr['0']["fID"]);
	if($re[$arr['0']["fID"]]["lateGuanLi"]!=="1"){
		$re = $lateHF->delLateByID(array("id"=>$_GET["id"]));
	}
}
if($radix && !$pension){
	#添加公积金的补缴记录
	$re = $lateHF->monthisIN($fID,$latepaymonth);
    #公积金的台账年月
    if(date("d")>insuranceInTurn("HF")){
        $paydate = date("Ym");
    }else{
        $paydate = date("Ym",strtotime("-1 month"));
    }
	if(!$re){
		#传值的补缴月份不存在
		$arr = $aInfo->getPlByfID($fID,"`id`,`name`,`uHFPer`,`pHFPer`");
		$arr["radix"] = $radix;
		$total = $radix * $arr["uHFPer"] + $radix * $arr["pHFPer"];
		$HFlateArr=array(
			"fID" =>$fID,
			"HFradix" =>$radix,
			"paydate" => $paydate,
			"latepaymonth" => $latepaymonth,
			"uHFPer" => $arr["uHFPer"],
			"pHFPer" => $arr["pHFPer"],
			"latemanagementCost" => $latemanagementCost,
			"total" => $total,
			"sponsorTime" => timeStyle("dateTime"),
			"sponsorName" => $_SESSION ['exp_user'] ['mName']
		);
		$re = $lateHF->addHFlate($HFlateArr);
	}
}elseif($pension && $radix){
	#添加社保的补缴记录
	$re = $latesoins->monthisIN($fID,$latepaymonth);
    $paydate = date("Ym",strtotime($closedate));
	if(!$re){
		#传值的补缴月份不存在
		$arr = $aInfo->getPlByfID($fID,"`name`,`domicile`,`hospitalization`");
		$arr["radix"] = $radix;
		$arr["pension"] = $pension;
		#应缴养老本金；
		$pensionArr = $fee->soInsPension($arr,$latepaymonth);
		$basicPension = $pensionArr["uPension"] + $pensionArr["pPension"];
		#滞纳金
		$latepay=$fee->exlatepay($latepaymonth, $basicPension ,$closedate);
		$soInslateArr=array(
			"fID" =>$fID,
			"radix" =>$radix,
			"paydate" => $paydate,
			"closedate" => $closedate,
			"latepaymonth" => $latepaymonth,
			"latepaydays" => $latepay["latepaydays"],
			"latepay" => $latepay["latepay"],
			"latemanagementCost" => $latemanagementCost,
			"pension" => $pension,
			"basicPension" => $basicPension,
			"sponsorTime" => timeStyle("dateTime"),
			"sponsorName" => $_SESSION ['exp_user'] ['mName']
		);
		$total = $basicPension + $latepay["latepay"] + $latemanagementCost;
        //echo "<pre>";var_dump($soInslateArr);
        $re = $latesoins->addsoInslate($soInslateArr);
	}
}

#所有社保缴交年月的记录
$soInsMonAll=$fee->getSoInsMonAll();
//unset($soInsMonAll["{$current_month}"]);
#公积金的缴交记录近3年
$HFMonAll=$HFFee->getHFMonAll("48");
//unset($HFMonAll["{$current_month}"]);
#社保合计费用
$lateListArr = $latesoins->getListByfID($fID,$paydate);
$TsoinsArr = $latesoins->TotalsoinsArr($lateListArr);
$Tsoins = $TsoinsArr["latepay"] + $TsoinsArr["basicPension"];
$latesoInsMonAll = $latesoins->getsoInsAll($fID);

#公积金合计费用
$lateHFListArr = $lateHF->getListByfID($fID,$paydate);
$THFArr = $lateHF->TotalHFArr($lateHFListArr);
$THF = $THFArr["total"];
$lateHFMonAll = $lateHF->getHFAll($fID);

#合计补缴管理费费用
$Cost = $TsoinsArr["latemanagementCost"] + $THFArr["latemanagementCost"];
$re = $bill->status("1",$current_month,$fID);
$remains = $bill->remains($fID);
if($re[$fID]["lateGuanLi"]!=='1'){
	$smarty->assign("status",1);
}
#smarty 参数定义
$smarty->assign(array(
	"soInsMonAll" => $soInsMonAll,
	"HFMonAll" => $HFMonAll,
	"latemanagementCost" => "60",
	"lateListArr" => $lateListArr,
	"lateHFListArr" => $lateHFListArr,
	"Tsoins" => $Tsoins,
	"fID" => $fID,
	"paydate" => $paydate,
	"latesoInsMonAll" => $latesoInsMonAll,
	"lateHFMonAll" => $lateHFMonAll,
	"THF" => $THF,
	"Cost" => $Cost,
	"remains" => $remains,
	"today" => date("Y-m-d")
));
#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/agMLateList.tpl");