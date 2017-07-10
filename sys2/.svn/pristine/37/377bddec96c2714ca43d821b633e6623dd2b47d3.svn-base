<?php
/*
*     2010-11-26
*          <<< 商保清单明细 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

#验证权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接公用函数
require_once '../common.function.php';

//$smarty->debugging = true;
$title = "商保清单明细";
#获取已经签收的社保清单
$batch = $_GET ['batch'];
$comInsType = $_GET ['comInsType'];
$comInsModifyDate=$_GET['comInsModifyDate'];
$unitID = $_GET ['unitID'];
if ($batch) {
	$sql = "select a.*,b.name,b.pID from a_comInsList a left join a_workerInfo b on a.uID=b.uID where a.batch like :batch and a.status='1' and a.comInsModifyDate like :comInsModifyDate ";
	if ($comInsType) {
		$sql .= " and a.unitID in (select unitID from a_unitInfo where comInsType like :comInsType) ";
		$ret = SQL ( $pdo, $sql, array (":comInsType" => $comInsType, ":batch" => $batch,":comInsModifyDate"=>$comInsModifyDate ) );
	} elseif ($unitID) {
		$sql .= " and a.unitID like :unitID ";
		$ret = SQL ( $pdo, $sql, array (":unitID" => $unitID, ":batch" => $batch,":comInsModifyDate"=>$comInsModifyDate ) );
	}
	foreach ( $ret as $rkey => $rval ) {
		$ret [$rkey] ['num'] = $rkey + 1;
		$ret [$rkey] ['sex']= (substr($rval['pID'], -2,1))%2==1?"男":"女";
	}
}else{
	exit("出错了");
}
#配置变量
$smarty->assign ( "ret", $ret );
$smarty->assign ( "batch", $batch );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "comInsManage/comInsListDetail.tpl" );
?>