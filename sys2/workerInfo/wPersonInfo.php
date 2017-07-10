<?php

//验证权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
//$smarty->debugging=true;
//初始化页面信息
$title = "员工信息查看及更新";
/*  初始化设置*/
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->wInfoSetArr ();
$wInfoSet = $wSet->wInfoSet;
$firstOp = array ("" => "---请选择---" );
$status = $wInfoSet ['status'];
$role = $wInfoSet ['role'];
$type = $wInfoSet ['type'];
$domicile = $firstOp + $wInfoSet ['domicile'];
$proTitle = $wInfoSet ['proTitle'];
$proLevel = $wInfoSet ['proLevel'];
$cType =$wInfoSet ['cType'];
$model = array ("" => "--请选择查询方式--", "name" => "姓名", "uID" => "员工编号", "pID" => "身份证", "sID" => "社保号", "bID" => "工资账号" );
$sql = "select unitID,unitName from a_unitInfo where unitName<>'深圳市' and type='1' order by unitName";
foreach ( $pdo->query ( $sql ) as $row ) {
	$unit [$row ['unitID']] = $row ['unitName'];
}

$unit = array ("" => "--------------请选择单位-------------" ) + $unit;
$marriage = $wInfoSet ['marriage'];
$education = $wInfoSet ['education'];
$nation = $wInfoSet ['nation'];
$sex = $firstOp + $wInfoSet ['sex'];
$hospitalization = array("" => "不参加", "1" => "综合", "2" => "住院", "4" => "合作");
$hand = array("1" => "右手", "2" => "左手");
//额外的添加的员工信息项
$wInfoExtraField = wInfoExtraFieldSet();
//输出员工信息
$uID = $_GET ['uID'];
$sql = "select * from a_workerInfo where uID like '" . $uID . "'";
$res = $pdo->query($sql);
$row = $res->fetch(PDO::FETCH_ASSOC);
foreach ($row as $k => $v) {
    switch ($k) {
        case "status" :
        case "sex":
        case "role":
        case "type" :
        case "domicile" :
        case "proTitle":
        case "proLevel":
        case "unitID" :
        case "marriage" :
        case "education":
        case "nation":
        case "hospitalization" :
        case "hand" :
        case "cType":	
            $k = "s_" . $k;
            break;
        case array_key_exists($k, $wInfoExtraField):
            $wInfoExtraFieldVal[$k] = $v;
            $smarty->assign("$k", $v);
            break;
    }
    $smarty->assign("{$k}", $v);
}
#如果员工为离职,则不允许编辑
# 离职再复职，需要编辑  by snail
//if (! $row ['status'])
//	exit ();
#smarty 参数定义
//get传值
$smarty->assign ( "model", $model );
//资料的完整性
$smarty->assign ( "status", $status );
//性别
$smarty->assign ( "sex", $sex );
//派遣类型
$smarty->assign ( "type", $type );
//户口类型
$smarty->assign ( "domicile", $domicile );
//单位信息
$smarty->assign ( "unit", $unit );
//婚姻情况
$smarty->assign ( "marriage", $marriage );
//保险项目
$smarty->assign("hospitalization", $hospitalization);
$smarty->assign("hand", $hand);
//额外项
$smarty->assign(array("wInfoExtraField" => $wInfoExtraField, "wInfoExtraFieldVal" => $wInfoExtraFieldVal));
$smarty->assign(array("education" => $education, "nation" => $nation, "role" => $role, "proTitle" => $proTitle, "proLevel" => $proLevel,"cType"=>$cType));
//模板配置信息
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "workerInfo/wPersonInfo.tpl" );
?>