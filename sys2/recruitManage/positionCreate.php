<?php

# 页面访问权限
require_once '../auth.php';
# 连接模板文件
require_once sysPath . 'templateConfig.php';
# 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'dataFunction/unit.data.php';
require_once sysPath . 'common.function.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';

$title = "新增岗位";

$unit = $_GET ['u'];

$sql = "select p.*,u.unitName from a_position p left join a_unitinfo u on p.unitId = u.unitID";
$ret = $pdo->query ( $sql );
if ($ret) {
	$positions_info = $ret->fetchAll ( PDO::FETCH_ASSOC );
}

//列举用工单位表
$sql = "SELECT unitID,unitName FROM a_unitinfo where type = 1 or type = 3";
$ret = $pdo->query ( $sql );

if ($ret) {
	$res = $ret->fetchAll ( PDO::FETCH_ASSOC );
	foreach ( $res as $v ) {
		$units [$v ['unitID']] = $v ['unitName'];
	}
}

#获取招聘相关信息设置数组
$c = new recruitInfoSet ();
$c->pdo = $pdo;
$c->recruitInfoSetBasic ();
$recruitProcedurerArr = $c->recruitProcedurerArr ();
foreach ( $recruitProcedurerArr as $key => $val ) {
	$c->recruitProcedurerArr = $val;
	$recruitProcedurerDetailArr [$key] = $c->recruitProcedurerDetailArr ( $key );
}
$i = 0;
foreach ( $recruitProcedurerDetailArr as $rval ) {
	foreach ( $rval as $rk => $rv ) {
		$r [$i] ['ID'] = $rk;
		$r [$i] ['detail'] = array_filter ( $rv );
		$i ++;
	}
}
$j_r = json_encode ( $r );


#变量配置
$smarty->assign ( "units", $units );
$smarty->assign ( "unit", $unit );
$smarty->assign ( "positions_info", $positions_info );
$smarty->assign ( array (
		"recruitProcedurerArr" => $recruitProcedurerArr,
		"j_r" => $j_r
) );
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "recruitManage/positionCreate.tpl" );

?>