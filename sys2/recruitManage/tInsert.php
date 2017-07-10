<?php
# 配置文件 数据库和pdo smarty初始化等
require_once ('../auth.php');
require_once ('../templateConfig.php');
require_once ('../class/pagenation.class.php');
require_once sysPath . 'dataFunction/unit.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';


$current_user = $_SESSION ['exp_user'] ['mID'];
$title = "新增人才";
$last_unitID = $_GET ['unitID'];
$last_positionID = $_GET ['positionID'];
$last_marketID = $_GET ['marketID'];
$last_status = $_GET ['status']?$_GET ['status']:3;
$recruitManager_selected = $_GET['recruitManagerId']?$_GET['recruitManagerId']:$current_user;
#获取招聘相关信息设置数组
$c = new recruitInfoSet ();
$c->pdo = $pdo;
$c->recruitInfoSetBasic ();
$statusToCHNArr = $c->recruitInfoSetArr ['reexamineArr'];
//当前招聘状态的通过情况
$procedurerStatusArr = $c->recruitInfoSetArr ['procedurerStatusArr'];
//备注设置数组
$recruitRemarksArr = $c->recruitInfoSetArr ['recruitRemarksArr'];
//意向区域配置数组
$wantedAreaArr = $c->recruitInfoSetArr ['wantedAreaArr'];

#配置单位和岗位二级联动
$d = new position ();
$d->pdo = $pdo;
$d->positionBasic ( "`positionID`,`name`,`unitId` as `unitID`,`shortcut`,`reexamineProcedureID`,`trainProcedureID`,`materialProcedureID`,`waitProcedureID`", " active=1 order by shortcut" );
$d->classLinkClass ();
$unitPositionArr = $d->unitPosition ();
$j_unitPositionArr = json_encode ( $unitPositionArr );
#市场相关信息
$e = new market ();
$e->pdo = $pdo;
$e->marketBasic ( "`marketID`,`name`", " active=1 " );
$marketArr = $e->marketArr;
#招聘人员信息

$f = new user();
$f->pdo =$pdo;
$f->userBasic("`mID`,`mName`"," roleID  REGEXP '4_1,' and status='1' ");
$userArr = $f->userArr;

// 操作人和更新日期
$current_user = $_SESSION ['exp_user'] ['mID'];
$current_user_name = $_SESSION ['exp_user'] ['mName'];
$current_date = date ( 'Y-m-d' );

// education value and name array 
$edu_value = array (
		1,
		2,
		3,
		4,
		5,
		6,
		7,
		8 
);
$edu_label = array (
		"博士",
		"硕士",
		"本科",
		"大专",
		"高中",
		"中专",
		"初中",
		"小学" 
);

// sex value and name array
$sex_value = array (
		1,
		2 
);
$sex_label = array (
		"男",
		"女" 
);

#
$smarty->assign ( array (
		"unitPositionArr" => $unitPositionArr,
		"j_unitPositionArr" => $j_unitPositionArr,
		"marketArr" => $marketArr,
) );
$smarty->assign ( array (
		"userArr" => $userArr,
		"statusArr" => $statusArr,
		"statusToCHNArr" => $statusToCHNArr,
		"s_status" => $s_status,
		"recruitRemarksArr" => $recruitRemarksArr,
		"procedurerStatusArr" => $procedurerStatusArr,
		"needTrainArr" => $needTrainArr,
		"needMaterialArr" => $needMaterialArr,
		"needWaitArr" => $needWaitArr,
		"wantedAreaArr" => $wantedAreaArr,
		"s_procedurerStatusArr" => $s_procedurerStatusArr 
) );


$smarty->assign ( "current_user", $current_user );
$smarty->assign ( "current_user_name", $current_user_name );
$smarty->assign ( "current_date", $current_date );
$smarty->assign ( "edu_value", $edu_value );
$smarty->assign ( "edu_label", $edu_label );
$smarty->assign ( "sex_value", $sex_value );
$smarty->assign ( "sex_label", $sex_label );
$smarty->assign ( "unit_s", $last_unitID );
$smarty->assign ( "position_s", $last_positionID );
$smarty->assign ( "market_s", $last_marketID );
$smarty->assign ( "status_s", $last_status );
$smarty->assign ( "recruitManager_selected",$recruitManager_selected  );

$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "recruitManage/tInsert.tpl" );

?>