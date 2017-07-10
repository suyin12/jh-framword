<?php
/*
作者：LOSKIN
time:2013-12-06
描述：劳动事务代理历史记录页面
更新：

*/
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
#连接参保人信息设置
require_once sysPath . 'dataFunction/agencySet.data.php';
#数据库操作类
require_once '../class/db_class.php';

$title = "代理人员信息";
$today = timeStyle("date");
/*  初始化设置 */
$aSet = new agencySet();
$aSet->agencySetArr();
//得到agencySet.data.php里的数组
$aInfoSet = $aSet->agencySet;
foreach ($aInfoSet as $key => $val){
	switch ($key){
		case 'status':
		case 'sex':
		case 'domicile':
		case 'hospitalization':
		case 'marriage':
		case 'proTitle':
		case 'proLevel':
		case 'education':
			$smarty->assign("{$key}",$val);
			break;
	}
}
#获取员工信息
new db($pdo);
$tableName="d_agent_personalInfo_history";
$row=db::select($tableName,"*","where id={$_GET['id']} and lastModifyTime='{$_GET['lastModifyTime']}'");
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

//模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/aPersonInfoList.tpl");
?>