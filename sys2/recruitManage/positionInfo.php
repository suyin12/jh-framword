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
#标题
$title = "岗位信息更新";
$id = $_GET ['id'];
if (! $id) {
	sys_error ( $smarty, "参数错误" );
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
		foreach($rv as $rr){
			$r [$i] ['detail'] .= $rr['name']."=>";
		}
		$i ++;
	}
}
$j_r = json_encode ( $r );
#配置岗位的基本信息
$d = new position ();
$d->pdo = $pdo;
$d->positionBasic ( " * ", " `positionID`='$id' order by shortcut" );
$d->classLinkClass ();
$the_position = $d->positionArr [$id];
#单位信息
$units = unitAll ( $pdo, "`unitID`,`unitName`", " and `status`='1'" );

#变量配置
$smarty->assign ( "units", $units );
$smarty->assign ( "the_position", $the_position );
$smarty->assign ( array (
		"recruitProcedurerArr" => $recruitProcedurerArr,
		"j_r" => $j_r 
) );
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "recruitManage/positionInfo.tpl" );

?>