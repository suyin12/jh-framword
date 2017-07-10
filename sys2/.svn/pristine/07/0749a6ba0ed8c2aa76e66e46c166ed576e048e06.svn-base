<?php
/*
作者：LOSKIN
time:2013-12-06
描述：劳动事务代理详细页面
更新：
	
*/
#引用配置文件
require_once 'agMconfig.php';
require_once 'bill_agm.php';
require_once 'aInfo_agm.php';
$title = "劳务代理人员信息";

$fee=new feeExtra($pdo);
$today = timeStyle("date");
$paydate = date("Ym");

/*  初始化设置 */
$aSet = new agencySet();
$aSet->p=$pdo;
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
#获取个人信息
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
#查询余额
$aInfo = new aInfo();
//$bill_arr = $bill -> remainsAll();
//echo "<pre>";var_dump($bill_arr);
#历史版本
$hisRet=db::select($tableName."_history","`id`,`lastModifyBy`,`lastModifyTime`,`modifyRemarks`","where id={$id}","order by lastModifyTime desc");
if ($hisRet)
    $smarty->assign("hisRet", $hisRet);
#余额
if($row[0]['pID']){
	$remain = $aInfo->remain($row[0]["id"]);
	$smarty->assign("remains",$remain);
}
#smarty 参数定义
$smarty->assign(array("today" => $today,
	"paydate" => $paydate,
));
#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/aManage.tpl");
?>