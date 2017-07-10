<?php
/*
作者：LOSKIN
time:2014-02-28
描述：劳动事务个人代理结算
更新：
	给办理停保的人员结算余额
*/

#引用配置文件
require_once 'agMconfig.php';
require_once 'bill_agm.php';
require_once 'aInfo_agm.php';
/*  初始化设置 */
$title = "个代结算";
#实例化
new db($pdo);
$bill=new bill();
$mypage = new Pagination();
$aInfo=new aInfo();
$aInfoSet = $aSet->agencySet;
foreach ($aInfoSet as $key => $val){
	switch ($key){
		case 'm':
			$smarty->assign("{$key}",$val);
			break;
	}
}

if (!empty($_GET["c"])) {
	$where="where ".$_GET["m"]." like '%{$_GET["c"]}%'";
}else{
	$where="where status='0'";
}
#需要停保的所有人
$list=$aInfo->getPlList($where,"`id`,`name`,`pID`");

$where="where status='1'";
foreach ($list as $k => $v){
	$billArr[$k] = $bill->getBlByfID($v["id"],$where);
	$billArr[$k]["clearing"] = $bill->clearing($v);
	$billArr[$k]["name"] = $v["name"];
	$billArr[$k]["pID"] = $v["pID"];
}
//echo "<pre>";var_dump($billArr);
#定义模板变量
$smarty->assign(array("bill" => $billArr));
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
#显示查询结果
$smarty->assign("pageList", $pageList);
$smarty->display("agencyService/aClearing.tpl");