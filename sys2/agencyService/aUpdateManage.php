<?php
/*
作者：LOSKIN
time:2013-12-05
描述：劳动事务代理修改页
更新：
	
*/
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#连接参保人信息设置
require_once sysPath . 'dataFunction/agencySet.data.php';
#数据库操作类
require_once '../class/db_class.php';

$title = "个人劳务代理编辑";
$today = timeStyle("date");
/*  初始化设置 */
$aSet = new agencySet();
$aSet->agencySetArr();
//得到agencySet.data.php里的数组
$aInfoSet = $aSet->agencySet;
foreach ($aInfoSet as $key => $val){
	switch ($key){
		case 'm':
		case 'domicile':
		case 'hospitalization':
		case 'marriage':
		case 'proTitle':
		case 'proLevel':
		case 'education':
			//var_dump($val);
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

#获取员工信息
$id = $_GET ['id'];
new db($pdo);
$tableName="d_agent_personalInfo";
$row=db::select($tableName,"*","where id={$id}");
foreach ($row['0'] as $k => $v) {
	 switch ($k) {
        case "sex" :
        case "domicile" :
        case "hospitalization" :
        case "status" :
        case 'marriage':
		case 'proTitle':
		case 'proLevel':
		case 'education':
        	$k = "s_" . $k;
        	break;
        case "HFRadix":
        case "uHFPer":
        case "pHFPer":
	        if(empty($v)){
	        	unset($v);
	        }
	        break;
    }
    $smarty->assign("{$k}", $v);
}

#smarty 参数定义
$smarty->assign("today", $today);

//模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/aUpdateManage.tpl");
?>