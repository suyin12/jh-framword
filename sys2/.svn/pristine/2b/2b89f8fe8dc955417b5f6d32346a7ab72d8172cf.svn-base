<?php
/*
*     2010-5-11
*          <<< 链接PHPEXCEL,做的读取excel的类 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*       
*       
*       链接方法,同样可以通过设置sheetIndex=X 获取多个sheet内 不同的值
*       $readExcel = new readExcel ();
		$readExcel->filePath = $filePath;
		if(!$readExcel->excelCon ()){
			echo "无法读取该EXCEL文件";
		}
		$readExcel->setSheet ();
		$cellVal = $readExcel->cellArr ();
		$readExcel->startRow = 5;
		$readExcel->sheetIndex = 1;
		$readExcel->setSheet ();
		$cellVal2 = $readExcel->cellArr ();
*/
class readExcel {
	public $filePath; //读取EXCEL的路径
	public $startRow = 2; //数据是从第几行开始读取,默认从第二行开始读取
	public $sheetIndex = 0; //获取第几个工作表
	//两个私有变量
	private $PHPReader;
	private $currentSheet;
	#链接PHPEXCEL类
	public function excelCon() {
		$filePath = $this->filePath;
		$PHPExcel = new PHPExcel ();
		$PHPReader = new PHPExcel_Reader_Excel2007 ();
		if (! $PHPReader->canRead ( $filePath )) {
			$PHPReader = new PHPExcel_Reader_Excel5 ();
			if (! $PHPReader->canRead ( $filePath )) {
				$errorMsg = true;
			}
		}
		if ($errorMsg) {
			return false;
		} else {
			return $this->PHPReader = $PHPReader;
		}
	}
	#设置获取的SHEET,满足不同sheet的需求,当然这里还是可以更改更多的模式
	public function setSheet() {
		$PHPReader = $this->PHPReader;
		$filePath = $this->filePath;
		$PHPReader->getReadDataOnly ();
		$excelRead = $PHPReader->load ( $filePath );
		$currentSheet = $excelRead->getSheet ( $this->sheetIndex );
		return $this->currentSheet = $currentSheet;
	}
	#获取CELL数组
	public function cellArr() {
		$startRow = $this->startRow;
		$currentSheet = $this->currentSheet;
		//因为下面的ROW是从1 开始的..
		$key = 0;
		foreach ( $currentSheet->getRowIterator () as $k => $row ) {
			if ($k < $startRow)
				continue;
			$cellIterator = $row->getCellIterator ();
			$cellIterator->setIterateOnlyExistingCells ( false );
			foreach ( $cellIterator as $cell ) {
				//并去空格
				$cellVal [$key] [] = trim ( $cell->getValue () );
			}
			$key ++;
		}
		return $cellVal;
	}
}
?>