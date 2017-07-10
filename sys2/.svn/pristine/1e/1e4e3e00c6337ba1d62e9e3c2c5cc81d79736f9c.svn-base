<?php
/*
作者：LOSKIN
time:2013-11-27
描述：劳动事务代理添加页
更新：
	11-27 改造数组的传递方式,引用agencySet.data.php
*/
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接参保人信息设置
require_once sysPath . 'dataFunction/agencySet.data.php';
#数据库操作类
require_once '../class/db_class.php';
$title = "劳动事务代理登记";
$today = timeStyle("date");
$day = timeStyle("d");
#如果今天日期在封帐日期之后,则收取对应社保费用在下一月开始生效
if($day>insuranceInTurn("soIns")){
	$c=date("Y-m-01",strtotime("+1 months"));
}else{
	$c=timeStyle("firstdayMon");
}
$smarty->assign("cBeginDay",$c);
/*  初始化设置 */
$aSet = new agencySet();
$aSet->agencySetArr();
//得到agencySet.data.php里的数组
$aInfoSet = $aSet->agencySet;
foreach ($aInfoSet as $key => $val){
	//参数定义
	switch ($key){
		case 'domicile':
		case 'hospitalization':
		case 'marriage':
		case 'proTitle':
		case 'proLevel':
		case 'education':
			$smarty->assign("{$key}",$val);
			break;
		case 'sex':
			$sex_ids=array_keys($val);
			$sex_names=array_values($val);
			$smarty->assign('sex_ids', $sex_ids);
			$smarty->assign('sex_names',$sex_names);
			break;
	}
}
#产生档案自增ID
new db();
db::$conn=$pdo;
$tableName="d_agent_personalInfo";
$order="order by id desc";
$idArr=db::select($tableName,"id",$order,"limit 1");
$id=$idArr[0]['id']+1;
$dID=$id+100000;
$dID="GRDL".substr($dID,1);
$smarty->assign("id",$id);
$smarty->assign("dID",$dID);

#smarty 参数定义
$smarty->assign("today", $today);
#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/aCreateManage.tpl");
?>