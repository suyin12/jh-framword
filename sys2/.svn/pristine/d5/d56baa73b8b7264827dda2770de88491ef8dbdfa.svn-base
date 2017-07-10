<?php
/*
作者：LOSKIN
time:2014-01-20
描述：劳动事务代理缴费明细
更新：
	社保、公积金缴费明细查看，下载Excel
	
*/
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once '../common.function.php';
#连接参保人信息设置
require_once sysPath . 'dataFunction/agencySet.data.php';
#数据库操作类
require_once '../class/db_class.php';
#社保计算方法
require_once '../dataFunction/feeExtra.data.php';
#***************公共部分****************
$title = "缴交明细";
$current_month = date('Y-m');
new db($pdo);
#所有公积金缴交年月的记录
$sql="select distinct month from d_soinsfee_tmp where HFID !='' order by month asc";
$row=SQL($pdo,$sql);
foreach ($row as $k=>$v){
	$hmonths[$v["month"]]=$v["month"];
}
$smarty->assign(array("hmonths"=>$hmonths,"hmonth"=>$hmonth));
if($_GET["HFDate"]){
	$hmonth=$_GET["HFDate"];
	$where=" and HFID !=''";
	$where.=" and month='{$hmonth}'";
	$tableName="d_soinsfee_tmp";
	$where=substr($where,"4");
	$where="where ".$where;
	$order="order by id desc";
	$SoArr=db::select($tableName, "*",$where,$order);
	foreach ($SoArr as $k=>$v){
		if($v["HFID"]){
			$re=db::select("d_agent_personalInfo","uHFPer,pHFPer","where HFID={$v['HFID']}");
			
		}
	}
}else{
	#社保缴交明细*******************
	$where=" and sID !=''";
	if($_GET["soInsDate"]){
		$cmonth=$_GET["soInsDate"];
	}else{
		$cmonth=$current_month;
	}
	$where.=" and month='{$cmonth}'";
	$tableName="d_soinsfee_tmp";
	$where=substr($where,"4");
	$where="where ".$where;
	$order="order by id desc";
	$SoArr=db::select($tableName, "*",$where,$order);
}
#所有社保缴交年月的记录
$sql="select distinct month from d_soinsfee_tmp where sID !='' order by month asc";
$row=SQL($pdo,$sql);
foreach ($row as $k=>$v){
	$cmonths[$v["month"]]=$v["month"];
}
$smarty->assign(array("cmonths"=>$cmonths,"cmonth"=>$cmonth));

foreach ($SoArr as $k=>$v){
	foreach ($v as $fk=>$fv){
		$v[$fk]=del0($fv);
	}
	$SoArr[$k]=$v;
}

if(!empty($SoArr)){
	$smarty->assign("SoArr",$SoArr);
}
//调用保存EXCEL文件
if ($_POST ['intoExcel']) {
	
}
#定义模板变量
$smarty->assign(array("list"=>$list,"current_month"=>$current_month));
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
#显示查询结果
$smarty->display("agencyService/agMlist.tpl");








