<?php
/*
作者：LOSKIN
time:2014-05-06
描述：个代缴费
更新：
	11-27 改造数组的传递方式,引用agencySet.data.php
	
*/
#引用配置文件
require_once 'agMconfig.php';
require_once 'bill_agm.php';
require_once 'latepay_agm.php';
require_once 'lateHF_agm.php';
require_once 'aInfo_agm.php';
require_once 'hfFee_agm.php';

$bill=new bill();
$fee=new feeExtra($pdo);
$latesoins = new latesoins();
$lateHF = new lateHF();
$aInfo=new aInfo();
$HFFee=new HFFee();

/*  初始化设置 */
$title = "个代缴费";
$current_month = date('Ym');
//得到agencySet.data.php里的数组
$aInfoSet = $aSet->agencySet;
foreach ($aInfoSet as $key => $val){
	switch ($key){
		case 'm':
		case 'status':
		case 'billpayment':
			$smarty->assign("{$key}",$val);
			break;
	}
}
#处理get提交的查询条件..
$payment = $_GET['payment'];
if (empty($payment)) {
	$payment = 1;
}
$m = $_GET ['m'];
$where="";
if (!empty($_GET["c"])) {
	$c=$_GET['c'];
	$where.=" and `status`='2'  and {$m} like '%{$c}%'";
}

if(!empty($where)){
	$where=substr($where,"4");
	$where="where ".$where;
}
$smarty->assign("s_m",$m);
$smarty->assign("s_c",$c);
#***************公共部分****************
$fee=new feeExtra($pdo);
$fee->soInsMonlist("distinct `month`","order by month asc");
$NewMon=$fee->soInsMon($current_month);
$order="order by id desc";

//***************缴费****************
#补交或是欠费需要缴费
$tableName="d_agent_personalInfo";
if(empty($where)){
	$where="where status='2'";
}

if($_GET['id']){
	$id = $_GET["id"];
	$where = "where id='{$id}'";
	$smarty->assign("s_id",$id);
}
$remainsAll = $aInfo ->remainsAll();
$billArr=db::select($tableName,"*",$where,$order);
foreach ($billArr as $k=>$v){
	$cmonths=0;
	$hmonths=0;
	$months=0;
	if ($v['status']){
		$soInsBill="";
		$TsoinsArr=array();
		$Tsoins="";
		if($v["soInsurance"]!=="0"){
			$soInsBill=$fee->soInsFun($v,$NewMon);
			#当月总缴费金额应该判断是否加上残障金
			$soInsBill["Total"]=$soInsBill["uTotal"]+$soInsBill["pTotal"]+$soInsBill["uPDIns"];
			#缴交月数(剩余的月数)***********
			$cmonths=$fee->cmoths($v['cBeginDay'],$v['cEndDay'],$v['id']);
			#合计补缴社保费用
			$soInspaydate = $aInfo->soInspaydate($current_month);
			$lateListArr = $latesoins->getListByfID($v['id'],$soInspaydate);
			if(!empty($lateListArr)){
				$TsoinsArr = $latesoins->TotalsoinsArr($lateListArr,$soInspaydate);
				$Tsoins = $TsoinsArr["latepay"] + $TsoinsArr["basicPension"];
			}
			$v=array_merge($v,array("cmonths"=>$cmonths,"Tsoins"=>$Tsoins));
			$v=array_merge($v,$soInsBill);
		}
		#公积金部分*******************
		$HFFun="";
		$THFArr=array();
		$THF=""; 
		$HFtotal="";
		if($v["housingFund"]!=="0"){
			$HFFun=$fee->HFFun($v,date("Ym"));
			$HFtotal=$HFFun["uTotal"]+$HFFun["pTotal"];
			$hmonths=$fee->hmoths($v['hBeginDay'],$v['hEndDay'],$v['id']);
			#合计补缴公积金费用
			$HFpaydate = $aInfo->HFpaydate($current_month);
			$lateHFListArr = $lateHF->getListByfID($v['id'],$HFpaydate);
			if(!empty($lateHFListArr)){
				$THFArr = $lateHF->TotalHFArr($lateHFListArr,$HFpaydate);
				$THF = $THFArr["total"];
			}
			$v=array_merge($v,array("hmonths"=>$hmonths,"HFtotal"=>$HFtotal,"THF"=>$THF));
		}
		$months=$fee->moths($cmonths,$hmonths);
		$v=array_merge($v,array("remains"=>$remainsAll[$v['id']],"months"=>$months));
		$billArr[$k]=$v;
	}
}

#给查询数组中的关键字标红
foreach ($billArr as $k=>$v){
	$billArr["{$k}"]["{$m}"]=str_replace($c, "<font color='red'>$c</font>", $billArr["{$k}"]["{$m}"]);
}

#定义模板变量
$smarty->assign("billArr",$billArr);
$smarty->assign("actionURL", httpPath . "agencyService/agMPayList.php");
$smarty->assign(array("current_month"=>$current_month,"modifydate"=>date("Y-m"),"s_payment"=>$payment));
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
#显示查询结果
$smarty->display("agencyService/agMPayList.tpl");

?>