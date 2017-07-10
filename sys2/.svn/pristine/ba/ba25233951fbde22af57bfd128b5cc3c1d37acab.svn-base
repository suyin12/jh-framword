<?php
/*
作者：LOSKIN
time:2013-12-18
描述：劳动事务代理协议
更新：
	协议1：委托代缴社会保险标准确认表
*/
#引用配置文件
require_once 'agMconfig.php';
/*  初始化设置 */
$current_month = date('Y-m');
$fee=new feeExtra($pdo);
$fee->soInsMonlist("distinct `month`","order by month asc");
#获取协议信息
$tableName="d_agency_agreement";
new db($pdo);
$row=db::select($tableName,"*");
$smarty->assign("row",$row);
#个人所交保险信息
if($_GET["id"]){
	$id=$_GET["id"];
	$tableName="d_agent_personalInfo";
	$aValue=db::select($tableName,"*","where id={$id}");
	foreach ($aValue['0'] as $k => $v) {
	    $smarty->assign("{$k}", $v);
	}
	#社保协议
	if($_GET["A"]){
		$title = "社保协议";
		$cmonths=$fee->exmoths($aValue['0']["cBeginDay"],$aValue['0']["cEndDay"]);
		$cBeginDay=explode("-",$aValue[0]["cBeginDay"]);
		$cEndDay=explode("-",$aValue[0]["cEndDay"]);
		#计算社保费用
		if($aValue[0]["status"]=="4")
			$date = date ("Ym", strtotime($aValue[0]["cBeginDay"]));
		else
			$date=date("Ym");
		$soIns=$fee->soInsFun($aValue[0],$date);
		//var_dump($aValue);
		$smarty->assign(array("soIns"=>$soIns,"cmonths"=>$cmonths,"cBeginDay"=>$cBeginDay,"cEndDay"=>$cEndDay,"date"=>$date));
	}
	
	#公积金协议
	if($_GET["B"]){
		$title = "公积金协议";
		$hmonths=$fee->exmoths($aValue['0']["hBeginDay"],$aValue['0']["hEndDay"]);
		$hBeginDay=explode("-",$aValue[0]["hBeginDay"]);
		$hEndDay=explode("-",$aValue[0]["hEndDay"]);
		$HF=$fee->HFFun($aValue[0]);
		$smarty->assign(array("HF"=>$HF,"hmonths"=>$hmonths,"hBeginDay"=>$hBeginDay,"hEndDay"=>$hEndDay));
	}
}	

#打印页面
if($_GET["print"]){
	$smarty->display("agencyService/aprintA.tpl");
}else{
	#定义模板变量
	$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
	#显示查询结果
	$smarty->display("agencyService/agreeMent.tpl");
}






