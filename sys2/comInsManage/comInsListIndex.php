<?php
/*
*     2010-11-26
*          <<< 商保清单索引页 >>>
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
$title = "商保清单管理";
#获取社保批次号
$batchSql = " select batch from a_comInsList group by batch order by batch desc limit 6";
$batchRes = $pdo->query ( $batchSql );
$batch = $batchRes->fetchAll ( PDO::FETCH_COLUMN );

//查找详细的社保信息
$s_batch = $_GET ['batch'];
if ($s_batch) {
	$exSql = " select a.comInsModifyDate from a_comInsList a  where a.batch like :batch and a.uID not like '' group by a.comInsModifyDate order by a.sponsorTime desc";
	$exRet = SQL ( $pdo, $exSql, array (
			":batch" => $s_batch 
	) );
	$unitSql = "select a.unitID,a.comInsType,a.unitName,b.typeName from a_unitInfo a left join s_comIns_set b on a.comInsType=b.comInsType where a.type='1' ";
	$unitRet = SQL ( $pdo, $unitSql );
	$unitRet = keyArray ( $unitRet, "unitID" );
	foreach ( $exRet as $eVal ) {
		$sqlTmp = "select a.* from a_comInsList a  where a.batch like :batch and a.uID not like '' and a.comInsModifyDate like '" . $eVal ['comInsModifyDate'] . "' group by a.unitID order by a.sponsorTime desc";
		$retTmp = SQL ( $pdo, $sqlTmp, array (
				":batch" => $s_batch 
		) );
		foreach ( $retTmp as $key => $val ) {
			$retTmp [$key] ['unitName'] = $unitRet [$val ['unitID']] ['unitName'];
			$retTmp [$key] ['comInsType'] = $unitRet [$val ['unitID']] ['comInsType'];
			$retTmp [$key] ['typeName'] = $unitRet [$val ['unitID']] ['typeName'];
		}
		$ret [$eVal ['comInsModifyDate']] = $retTmp;
		unset ( $retTmp );
	}
	
	if (isset ( $_POST ['intoExcel'] )) {
		if (isset ( $_POST ['thisComInsModifyDate'] ))
			$tsql = "select a.*,b.name,b.pID from a_comInsList a left join a_workerInfo b on a.uID=b.uID where a.batch like :batch and a.comInsModifyDate ='".$_POST['thisComInsModifyDate']."' and a.status='1'";
		else
			$tsql = "select a.*,b.name,b.pID from a_comInsList a left join a_workerInfo b on a.uID=b.uID where a.batch like :batch and a.status='1'";
		$tret = SQL ( $pdo, $tsql, array (
				":batch" => $s_batch 
		) );
		foreach ( $tret as $rkey => $rval ) {
			
			$tret [$rkey] ['unitName'] = $unitRet [$rval ['unitID']] ['unitName'];
			$tret [$rkey] ['typeName'] = $unitRet [$rval ['unitID']] ['typeName'];
		}
		$nRet = null;
		foreach ( $tret as $key => $val ) {
			//按缴交商保的保险公司分开sheet
			$nRet [$val ['typeName']] [] = $val;
		}
		unset ( $tret );
		if (! $nRet)
			exit ( "数据读取出错,请重试" );
			
			#保存为EXCEL
		$tableHead = array (
				"batch" => "批次号",
				"typeName" => "投保公司",
				"unitName" => "单位",
				"uID" => "员工编号",
				"name" => "姓名",
				"pID" => "身份证号码",
				"sponsorName" => "客户经理",
				"comInsModifyDate" => "申报日期",
				"receiveTime" => "签收时间" 
		);
		$excelTitle = $s_batch . "商保清单";
		$thArr [] = $tableHead;
		//		#链接PHPEXCEL CLASS
		require_once '../class/phpExcel/Classes/PHPExcel.php';
		require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
		require_once '../class/excel.class.php';
		$oExcel = new PHPExcel ();
		#设置文档基本属性
		$oPro = $oExcel->getProperties ();
		$oPro->setCreator ( $serverCompany ); //公司名
		#构造输出函数
		$op = new excelOutput ();
		$op->oExcel = $oExcel;
		$i = 0;
		foreach ( $nRet as $key => $val ) {
			$excelRet = null;
			$excelRet = array_merge ( $thArr, $val );
			$op->eRes = $excelRet;
			$op->selFieldArray = $tableHead;
			$oExcel->createSheet ();
			$op->sheetIndex = $i;
			$op->title = $key;
			$op->fillData ();
			$i ++;
		}
		$op->eFileName = $excelTitle . ".xls";
		$op->output ();
	}
} else {
	$startMon = timeStyle ( "Ym", "" ) . "01";
	$toBatch = "Com." . timeStyle ( "Ym", "" );
	if (timeStyle ( "d" ) > 27) {
		$toBatch = "Com." . date ( "Ym", strtotime ( "$startMon +1 month" ) );
	}
	$_SERVER ["QUERY_STRING"] = "?batch=" . $toBatch;
	header ( "Location:" . $_SERVER ["PHP_SELF"] . $_SERVER ["QUERY_STRING"] );
}

#配置变量
$smarty->assign ( "s_batch", $s_batch );
$smarty->assign ( "ret", $ret );
$smarty->assign ( "batch", $batch );
#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );
$smarty->display ( "comInsManage/comInsListIndex.tpl" );
?>

