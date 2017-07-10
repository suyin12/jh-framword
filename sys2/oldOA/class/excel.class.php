<?php
/* 该类为excel文件导出类,主要还是太懒..代码重用写个类,方便了事
*   之后还会再加上一个部分内容,就是表格的头部标题,,,
*   还有待改进...
* 
* 
* 
* */
class excelOutput {
	
	public $oExcel; //定义操作的对象,跟$pdo一个概念
	public $sheetIndex = 0; //定义的$oSheet = $oExcel->getActiveSheet (); 多个sheet中第一个
	public $eRes; //实际操作的数组(eRes[0]为标题行)
	public $selFieldArray; //每列数据相应的标题名 及其数组KEY
	public $headRow = 1; //实际数据 开始的行数
	public $rowHeight = 30; //标题行的行高
	public $eFileName; //输出的文件的标题
	public $title = "sheet"; //定义该sheet的title
	

	
	public function fillData() {
		$eRes = $this->eRes;
		$oExcel = $this->oExcel;
		$selFieldArray = $this->selFieldArray;
		$sFAKey = array_keys ( $selFieldArray );
		//		echo "<pre>";
		//		print_r($sFAKey);
		#设置当前的sheet索引，用于后续的内容操作。
		#一般只有在使用多个sheet的时候才需要显示调用。
		#缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
		#用get替换,,可以解决多个workerSheet的问题
		//		$oExcel->setActiveSheetIndex ( $this->sheetIndex );
		//		$oSheet = $oExcel->getActiveSheet ();
		$oSheet = $oExcel->getSheet ( $this->sheetIndex );
		$oSheet->setTitle ( $this->title );
		#获取需要多少列,数组中任意一行数据总共有多少列, 和数据中总共包括多少行
		$colNum = count ( $eRes [0] );
		$rowNum = count ( $eRes );
		#定义EXCEL列 从A开始到该数组的总长度,++ 居然是从Z变成AA..
		$fColNum = intval ( $colNum / 26 );
		$beginCol = 'A';
		for($x = 0; $x < $colNum; $x ++) {
			$colName [] = $beginCol;
			$beginCol ++;
		}
		
		#设置标题栏在第几行及它的 行高(用作标题行)
		$headRow = $this->headRow;
		$oSheet->getRowDimension ( $headRow )->setRowHeight ( $rowHeight );
		
		foreach ( $colName as $colK => $colV ) {
			//循环设置列宽
			$oSheet->getColumnDimension ( $colV )->setAutoSize ( true );
			//设置标题栏的边框
			$oSheet->getStyle ( $colV . $headRow )->getBorders ()->getTop ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
			$oSheet->getStyle ( $colV . $headRow )->getBorders ()->getLeft ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
			$oSheet->getStyle ( $colV . $headRow )->getBorders ()->getRight ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
			$oSheet->getStyle ( $colV . $headRow )->getBorders ()->getBottom ()->setBorderStyle ( PHPExcel_Style_Border::BORDER_THIN );
			//设置每个单元格的值
			foreach ( $eRes as $eKey => $eVcal ) {
				//				var_dump ( $eRes [$eKey] [$sFAKey [$colK]] );
				$beginRow = $headRow + $eKey;
				//设置单元格内容 ,同时设置每个单元格的值是  文本格式,解决长数字串 科学计数法的问题
				$oSheet->setCellValueExplicit ( $colV . $beginRow, $eRes [$eKey] [$sFAKey [$colK]], PHPExcel_Cell_DataType::TYPE_STRING );
			}
		}
	
	}
	
	public function output() {
		$oExcel = $this->oExcel;
		#UTF-8转为GBK
		$eFileName = $this->eFileName;
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
	}
}
?>