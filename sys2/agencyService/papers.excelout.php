<?php

/*
 * 导出excel
 * 输入数组为$talents
 */

#设置缓存128M
ini_set('memory_limit', '128M');



//$eRes = reCreateArray ( $talents );
$eRes = $papers;

require_once sysPath . 'class/phpExcel/Classes/PHPExcel.php';
require_once sysPath . 'class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';

$oExcel = new PHPExcel ();
$oExcel->setActiveSheetIndex ( 0 );
$oSheet = $oExcel->getActiveSheet ();
//$oSheet->setTitle ( "待岗人员名单" );


#获取需要多少列,数组中任意一行数据总共有多少列, 和数据中总共包括多少行
$colNum = count ( $eRes [0] );
//$rowNum = count ( $eRes );
#定义EXCEL列 从A开始到该数组的总长度,++ 居然是从Z变成AA..
$fColNum = intval ( $colNum / 26 );
$beginCol = 'A';
for($x = 0; $x < $colNum; $x ++) {
	$colName [] = $beginCol;
	$beginCol ++;
}

#设置标题栏在第几行及它的 行高(用作标题行)

  $headRow = 4;
  $oSheet->getRowDimension ( $headRow )->setRowHeight ( 30 );
 
#我要合并单元格，制作模板

$oSheet->mergeCells("D1:K1")->mergeCells("L1:N1");
$oSheet->setCellValue("D1","新增人员上传文件模板")
		->setCellValue("L1","所有的日期格式都要按照yyyy-mm-dd的形式填写，如:2005-01-05")
		->setCellValue("C2","单位机构代码")
		->setCellValue("D2","XXXXX")
		->setCellValue("F2","单位名称")
		->setCellValue("G2","XXXXX")
		->setCellValue("I2","经办人")
		->setCellValue("J2","XXX")
		->setCellValue("K2","联系电话")
		->setCellValue("L2","XXX")
		->setCellValue("A4","身份证号码")
		->setCellValue("B4","姓名")
		->setCellValue("C4","曾用名")
		->setCellValue("D4","文化程度")
		->setCellValue("E4","民族")
		->setCellValue("F4","政治面貌")
		->setCellValue("G4","婚姻状况")
		->setCellValue("H4","社保号")
		->setCellValue("I4","户口类型")
		->setCellValue("J4","参加工作时间")
		->setCellValue("K4","职称")
		->setCellValue("L4","合同起止时间")
		->setCellValue("M4","合同终止时间")
		->setCellValue("N4","就业类型")
		->setCellValue("O4","工资")
		->setCellValue("P4","职业等级技能")
		->setCellValue("Q4","本单位工作起始日期")
		->setCellValue("R4","相片图像号码")
		->setCellValue("S4","房屋地址编码")
		->setCellValue("T4","身份证住址")
		->setCellValue("U4","来深时间")
		->setCellValue("V4","住所类别")
		->setCellValue("W4","入住时间")
		->setCellValue("X4","居住方式")
		->setCellValue("Y4","本人固定电话")
		->setCellValue("Z4","本人手机")
		->setCellValue("AA4","紧急联系人姓名")
		->setCellValue("AB4","紧急联系人固定电话")
		->setCellValue("AC4","紧急联系人手机")
		->setCellValue("AD4","广东省流动人口避孕节育情况报告单")
		->setCellValue("AE4","报告单编号")
		->setCellValue("AF4","就业登记备注");
		
	$oSheet->getColumnDimension ( 'A' )->setWidth(20);
	$oSheet->getColumnDimension ( 'B' )->setWidth(8);
	$oSheet->getColumnDimension ( 'C' )->setWidth(8);
	$oSheet->getColumnDimension ( 'D' )->setWidth(5);
	$oSheet->getColumnDimension ( 'E' )->setWidth(5);
	$oSheet->getColumnDimension ( 'F' )->setWidth(5);
	$oSheet->getColumnDimension ( 'G' )->setWidth(5);
	$oSheet->getColumnDimension ( 'H' )->setWidth(14);
	$oSheet->getColumnDimension ( 'I' )->setWidth(5);
	$oSheet->getColumnDimension ( 'J' )->setWidth(10);
	$oSheet->getColumnDimension ( 'K' )->setWidth(5);
	$oSheet->getColumnDimension ( 'L' )->setWidth(10);
	$oSheet->getColumnDimension ( 'M' )->setWidth(10);
	$oSheet->getColumnDimension ( 'N' )->setWidth(5);
	$oSheet->getColumnDimension ( 'O' )->setWidth(8);
	$oSheet->getColumnDimension ( 'P' )->setWidth(5);
	$oSheet->getColumnDimension ( 'Q' )->setWidth(10);
	$oSheet->getColumnDimension ( 'R' )->setWidth(14);
	$oSheet->getColumnDimension ( 'S' )->setWidth(20);
	$oSheet->getColumnDimension ( 'T' )->setWidth(60);
	$oSheet->getColumnDimension ( 'U' )->setWidth(10);
	$oSheet->getColumnDimension ( 'V' )->setWidth(5);
	$oSheet->getColumnDimension ( 'W' )->setWidth(10);
	$oSheet->getColumnDimension ( 'X' )->setWidth(5);
	$oSheet->getColumnDimension ( 'Y' )->setWidth(12);
	$oSheet->getColumnDimension ( 'Z' )->setWidth(12);
	$oSheet->getColumnDimension ( 'AA' )->setWidth(8);
	$oSheet->getColumnDimension ( 'AB' )->setWidth(12);
	$oSheet->getColumnDimension ( 'AC' )->setWidth(12);
	$oSheet->getColumnDimension ( 'AD' )->setWidth(5);
	$oSheet->getColumnDimension ( 'AE' )->setWidth(14);
	$oSheet->getColumnDimension ( 'AF' )->setWidth(8);


foreach ( $colName as $colK => $colV ) {
	//设置标题栏的边框
	/*
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getTop ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getLeft ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getRight ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	$oSheet->getStyle ( $colV . '1' )->getBorders ()->getBottom ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
	*/
	//设置每个单元格的值
	foreach ( $eRes as $eKey => $eVcal ) {
		$beginRow = $headRow + $eKey + 1;
		//设置单元格内容 ,同时设置每个单元格的值是  文本格式,解决长数字串 科学计数法的问题
		$oSheet->setCellValueExplicit ( $colV . $beginRow, $eRes[$eKey] [$selFieldArray [$colK]], PHPExcel_Cell_DataType::TYPE_STRING );
		unset(  $eRes [$eKey] [$selFieldArray [$colK]]);
	}
	//循环设置列宽
	//$oSheet->getColumnDimension ( $colV )->setAutoSize ( true );
}
unset($eRes);
#UTF-8转为GBK
$eFileName = "居住证办理.xls";
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