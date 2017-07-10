<?php

/*
 * 2011-08-28  办理员工单位转签事宜
 * 
 * author  : sToNe  email: shi35dong@gmail.com
 * 
 */
//验证权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/unit.data.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
//$smarty->debugging=true;
//初始化页面信息
$title = "员工单位转签";
/*  初始化设置 */
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
$firstOp = array("" => "---请选择---");
$status = $wInfoSet ['status'];
$role = $wInfoSet ['role'];
$type = $wInfoSet ['type'];
$type = $firstOp+$type;
$domicile = $firstOp + $wInfoSet ['domicile'];
$proTitle = $wInfoSet ['proTitle'];
$proLevel = $wInfoSet ['proLevel'];
$model = array("" => "--请选择查询方式--", "name" => "姓名", "uID" => "员工编号", "pID" => "身份证", "sID" => "社保号", "bID" => "工资账号");
$sql = "select unitID,unitName from a_unitInfo where unitName<>'深圳市' and type='1' order by unitName";
foreach ($pdo->query($sql) as $row) {
    $unit [$row ['unitID']] = $row ['unitName'];
}

$unit = array("" => "--------------请选择单位-------------") + $unit;
$marriage = $wInfoSet ['marriage'];
$education = $wInfoSet ['education'];
$nation = $wInfoSet ['nation'];
$sex = $firstOp + $wInfoSet ['sex'];
$hospitalization = array("" => "不参加", "1" => "综合", "2" => "住院", "4" => "合作");
$hand = array("1" => "右手", "2" => "左手");

//输出员工信息
$uID = $_GET ['uID'];
$sql = "select uID,name,housingFund,helpCost from a_workerInfo where uID like '" . $uID . "'";
$res = $pdo->query($sql);
$row = $res->fetch(PDO::FETCH_ASSOC);
foreach ( $row as $k => $v ) {
	$smarty->assign ( "{$k}", $v );

}
#smarty 参数定义
//保险项目
$smarty->assign("hospitalization", $hospitalization);
$smarty->assign("hand", $hand);
$smarty->assign("type", $type);
$smarty->assign("unit", $unit);
//模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("workerInfo/wChangeUnit.tpl");
?>
