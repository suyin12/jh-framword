<?php

/*
 * 导出excel
 * 输入数组为$talents
 */

#设置缓存128M
ini_set('memory_limit', '128M');


function reCreateArray2($arr) {
	

	foreach($arr as $key => $one_talent)
	{
		foreach($one_talent as $k => $v)
		{
	
			switch($k)
			{
				case "sex":
					if($v == "1")
						$v = "男";
					elseif($v == "2")
						$v = "女";
					break;
					
				case "education":
					if($v == "1")
						$v = "博士";
					elseif($v == "2")
						$v = "硕士";
					elseif($v == "3")
						$v = "本科";
					elseif($v == "4")
						$v = "大专";
					elseif($v == "5")
						$v = "高中";
					elseif($v == "6")
						$v = "中专";
					elseif($v == "7")
						$v = "初中";
					elseif($v == "8")
						$v = "小学";
					break;

				case "d_train":
				case "d_reference":
				case "d_commit":
					if($v == 1)
						$v = "是";
					elseif ($v == 2)
						$v = "否";
					break;
			}
			$newArr[$key][$k] = $v;
		}
	}
	#定义总共需要多少列,及其设置相应的列宽,及其增加表头标题
	$fieldName = array ("序号","姓名","身份证","性别","单位","学历",
						"专业","电话","岗位ID","单位备注","招聘人ID","合格状态","上岗状态",
						"市场ID","信息是否有效","交材料2","备注","创建人","创建时间","提交状态",
						"提交时间","颜色标记","岗位备注","备注1","备注2","交材料情况","是否培训","是否见证明人","是否交资料到市局",
						"最后修改人ID","最后修改时间","来源市场","招聘人","创建人","岗位名","培训成绩","成绩评定","备注");
	//获取字段名,并设置字段名对应的中文显示名
	$eResColKey = array_keys ( $newArr [0] );
//	echo "<pre>";print_r($eResColKey);
//	echo "<pre>";print_r($fieldName);
	$fERes [] = array_combine ( $eResColKey, $fieldName);
	//添加到数组的第一行作为标题行
	$newArr = array_merge ( $fERes, $newArr );
	
	return $newArr;
}

//echo "<pre>";print_r($talents);
$eRes = reCreateArray2 ( $talents );
//echo "<pre>";print_r($talents);

require_once sysPath . 'class/phpExcel/Classes/PHPExcel.php';
require_once sysPath . 'class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';

$oExcel = new PHPExcel ();
$oExcel->setActiveSheetIndex ( 0 );
$oSheet = $oExcel->getActiveSheet ();
$oSheet->setTitle ( "待岗人员名单" );


#获取需要多少列,数组中任意一行数据总共有多少列, 和数据中总共包括多少行
$colNum = count ( $eRes [0] )-13;
//$rowNum = count ( $eRes );
#定义EXCEL列 从A开始到该数组的总长度,++ 居然是从Z变成AA..
$fColNum = intval ( $colNum / 26 );
$beginCol = 'A';
for($x = 0; $x < $colNum; $x ++) {
	$colName [] = $beginCol;
	$beginCol ++;
}

#设置标题栏在第几行及它的 行高(用作标题行)
$headRow = 1;
$oSheet->getRowDimension ( $headRow )->setRowHeight ( 30 );
foreach ( $colName as $colK => $colV ) {
	//设置标题栏的边框
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getTop ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getLeft ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getRight ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getBottom ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	//设置每个单元格的值
	foreach ( $eRes as $eKey => $eVcal ) {
		$beginRow = $headRow + $eKey;
		//设置单元格内容 ,同时设置每个单元格的值是  文本格式,解决长数字串 科学计数法的问题
		$oSheet->setCellValueExplicit ( $colV . $beginRow, $eRes[$eKey] [$selFieldArray [$colK]], PHPExcel_Cell_DataType::TYPE_STRING );
		unset(  $eRes [$eKey] [$selFieldArray [$colK]]);
	}
	//循环设置列宽
	$oSheet->getColumnDimension ( $colV )->setAutoSize ( true );
}
unset($eRes);
#UTF-8转为GBK
$eFileName = "待岗人员名单.xls";
$eFileName = iconv ( "UTF-8", "GBK", $eFileName );
#导出
$oWrite = new PHPExcel_Writer_Excel5 ( $oExcel );
header ( "Content-Type: application/force-download" );
header ( "Content-Type: application/octet-stream" );
header ( "Content-Type: application/download" );
header ( 'Content-Disposition:inline;filename="' . $eFileName . '"' );
header ( "Content-Transfer-Encoding: binary" );
header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header ( "Pragma: no-cache" );
$oWrite->save ( 'php://output' );


?>