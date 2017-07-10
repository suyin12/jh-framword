<?php
/*
*     2010-5-18
*          <<< 选择工资帐套及设置该工资帐套的工资年月,社保年月,商保年月 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接数据函数
require_once sysPath . 'dataFunction/unit.data.php';
#页面标题
$title = "新建费用";
$mID = $_GET ['mID'];
$unitID = $_GET ['unitID'];
$ZFsql = " select a.zID,a.zName from a_zFormatInfo a left join a_zFormulas  b on a.zID=b.zID where a.status like '1'  and (b.unitID like '$unitID' or b.unitID is null or a.model='1') group by a.zID  order by a.zID";
$ZFRes = $pdo->query ( $ZFsql );
$ZFRet = $ZFRes->fetchAll ( PDO::FETCH_ASSOC );
foreach ($ZFRet as $v){
	$ZFArr[$v['zID']] = $v['zName'];
}
#日期数组
$j = 6; //时间跨度在6个月以内
for($i = -1; $i < $j; $i ++) {
	$t = null;
	 $t = strtotime ( timeStyle ( "firstdayMon","" )."-$i month" );
	$key = date ( "Ym", $t );
	$DateArr [$key] = date ( "Y年m月", $t );
}
switch ($_GET['process']){
    case "createFee":
        $url = httpPath."feeAdvancedManage/createFee.php";
        break;
    default :
        $url = httpPath.'excelAction/readExcel.php';
        break;
}
#配置变量
$smarty->assign ( "ZFArr", $ZFArr );
$smarty->assign ( "DateArr", $DateArr );
$smarty->assign("url",$url);
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "salaryManage/salaryZFChose.tpl" );
?>