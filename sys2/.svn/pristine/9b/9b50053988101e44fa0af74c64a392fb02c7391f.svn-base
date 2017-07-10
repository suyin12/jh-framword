<?php

/* 该类为excel文件导出类,主要还是太懒..代码重用写个类,方便了事
 *   之后还会再加上一个部分内容,就是表格的头部标题,,,
 *   还有待改进...
 *   演示:
 *   #保存为EXCEL
  $thArr [] = $tableHead;
  if ($ret)
  $excelRet = array_merge ( $thArr, $ret );
  require_once '../class/phpExcel/Classes/PHPExcel.php';
  require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
  require_once '../class/excel.class.php';
  $oExcel = new PHPExcel();
  #构造输出函数
  $op = new excelOutput();
  $op->oExcel = $oExcel;
  $op->eRes = $wAverRet;
  $op->selFieldArray = $wAverTableHead;
  $op->title = $wAverSheetTitle;
  $op->fillData();
  $oExcel->createSheet();
  $op->sheetIndex=1;
  $op->eRes = $mAverRet;
  $op->selFieldArray = $mAverTableHead;
  $op->title = $mAverSheetTitle;
  $op->fillData();
  $op->eFileName = "excelTable/" . $excelTitle . ".xls";
  $op->output();
 * 
 * 
 * */
require_once 'phpExcel/Classes/PHPExcel/IOFactory.php';
ini_set("memory_limit","1024M");
class excelOutput {

    public $oExcel; //定义操作的对象,跟$pdo一个概念
    public $sheetIndex = 0; //定义的$oSheet = $oExcel->getActiveSheet (); 多个sheet中第一个
    public $eRes; //实际操作的数组(eRes[0]为标题行)
    public $selFieldArray; //每列数据相应的标题名 及其数组KEY
    public $headRow = 1; //实际数据 开始的行数
    public $rowHeight = 30; //标题行的行高
    public $eFileName; //输出的文件的标题
    public $title = "sheet"; //定义该sheet的title

#设置第几个操作的sheet

    private function getSeet() {
        $oExcel = $this->oExcel;
#设置当前的sheet索引，用于后续的内容操作。
#一般只有在使用多个sheet的时候才需要显示调用。
#缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
#用get替换,,可以解决多个workerSheet的问题
//		$oExcel->setActiveSheetIndex ( $this->sheetIndex );
//		$oSheet = $oExcel->getActiveSheet ();
        $oSheet = $oExcel->getSheet($this->sheetIndex);
        $oSheet->setTitle($this->title);
        $oSheet->getDefaultStyle()->getFont()->setSize(10);
        return $oSheet;
    }

#获取数组属性

    private function cellBasic() {
        $eRes = $this->eRes;
#获取需要多少列,数组中任意一行数据总共有多少列, 和数据中总共包括多少行
        $colNum = count($eRes [0]);
        $rowNum = count($eRes);
#定义EXCEL列 从A开始到该数组的总长度,++ 居然是从Z变成AA..
        $fColNum = intval($colNum / 26);
        $beginCol = 'A';
        for ($x = 0; $x < $colNum; $x++) {
            $colName [] = $beginCol;
            $beginCol++;
        }
        return $colName;
    }

    #设置隐藏列

    public function hideCol($hideArr) {
        $oSheet = $this->getSeet();
        $selFieldArrayKey = array_keys($this->selFieldArray);
        $colName = $this->cellBasic();
        foreach ($hideArr as $val) {
            $colKey = array_search($val, $selFieldArrayKey);
            $oSheet->getColumnDimension($colName[$colKey])->setVisible(false);
        }
    }

#设置表头,固定表头格式
//$array,任意传递一个数组,用于对应下面特定type下的显示方法

    public function setSheetHeader($type, $array) {
        $oSheet = $this->getSeet();
        $colName = $this->cellBasic();
        $lastColName = end($colName);
        $lastSecColName = prev($colName);
        switch ($type) {
            case "fee"://费用表固定格式
                $oSheet->mergeCells('A1:' . $lastColName . "3");
                $oSheet->setCellValueExplicit('A1', $array['headStr'], PHPExcel_Cell_DataType::TYPE_STRING);
                $oSheet->mergeCells('A4:D4');
                $oSheet->setCellValueExplicit('A4', $array['unitName'], PHPExcel_Cell_DataType::TYPE_STRING);
                $oSheet->mergeCells($lastSecColName . '4:' . $lastColName . "4");
                $oSheet->setCellValueExplicit($lastSecColName . '4', $array['createTime'], PHPExcel_Cell_DataType::TYPE_STRING);
                //调整字体
                $oSheet->getStyle('A1')->getFont()->setSize(16);
                $oSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //冻结窗口
                // $oSheet->freezePane("C9");
                break;
        }
    }

    public function setSheetFooter($type, $array) {
        $oSheet = $this->getSeet();
        $selFieldArray = $this->selFieldArray;
        $colName = $this->cellBasic();
        $maxColNum = max(array_keys($colName));
        switch ($type) {
            case "fee"://费用表固定格式
                //获取表尾开始的行数  =总人数+15
                $footRow = max(array_keys($array)) + 10;
                $oSheet->mergeCells('A' . $footRow . ":" . $colName[$maxColNum] . $footRow);
                $oSheet->setCellValue('A' . $footRow, "复核:                                                 客户经理:                                        出纳:                                    制表人:");
                foreach (end($array) as $key => $val) {
                    $oSheet->setCellValue('A' . ($footRow + 7), $selFieldArray[$key]);
                    $oSheet->setCellValue('B' . ($footRow + 7), $val);
                    $footRow++;
                }
                break;
            case "salary"://费用表固定格式
                //获取表尾开始的行数  =总人数+10
                $footRow = max(array_keys($array)) + 10;
                $oSheet->mergeCells('A' . $footRow . ":" . $colName[$maxColNum] . $footRow);
                $oSheet->setCellValue('A' . $footRow, "审批:                                   部门负责人:                                          复核:                                                 客户经理:                                        出纳:                                    制表人:");
//                foreach (end($array) as $key => $val) {
//                    $oSheet->setCellValue('A' . ($footRow + 7), $selFieldArray[$key]);
//                    $oSheet->setCellValue('B' . ($footRow + 7), $val);
//                    $footRow++;
//                }
                break;
        }
    }

    public function fillData() {
        $eRes = $this->eRes;
        $selFieldArray = $this->selFieldArray;
        $sFAKey = array_keys($selFieldArray);
        $oSheet = $this->getSeet();

#设置标题栏在第几行及它的 行高(用作标题行)
        $headRow = $this->headRow;
        $rowHeight = $this->rowHeight;
        $oSheet->getRowDimension($headRow)->setRowHeight($rowHeight);
        $colName = $this->cellBasic();
        //设置需要到处的列相关的
        $fieldColArr = array_combine($colName, $sFAKey);
        #判断是否存在有需要设置格式的
        foreach ($colName as $colK => $colV) {
//循环设置列宽
            $oSheet->getColumnDimension($colV)->setAutoSize(true);
//设置标题栏的边框
            $oSheet->getStyle($colV . $headRow)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $oSheet->getStyle($colV . $headRow)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $oSheet->getStyle($colV . $headRow)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $oSheet->getStyle($colV . $headRow)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $oSheet->getStyle($colV . $headRow)->getFont()->setBold(true);
            $oSheet->getStyle($colV . $headRow)->getAlignment()->setWrapText(true);
        }
        //设置每个单元格的值
        foreach ($eRes as $eKey => $eVcal) {
            $beginRow = $headRow + $eKey;
            foreach ($fieldColArr as $fK => $fV) {
                switch ($fV) {
                    case "bID":
                    case "pID":
                    case "houseNumber":
                    case "spousePID":
                        $oSheet->setCellValueExplicit($fK . $beginRow, $eVcal[$fV], PHPExcel_Cell_DataType::TYPE_STRING);
                        break;
                    default :
                        //设置单元格内容 ,同时设置每个单元格的值是  文本格式,解决长数字串 科学计数法的问题
                        if (is_numeric($eVcal[$fV])) {
                            $oSheet->setCellValueExplicit($fK . $beginRow, $eVcal[$fV], PHPExcel_Cell_DataType::TYPE_NUMERIC);
                        } else {
                            $oSheet->setCellValueExplicit($fK . $beginRow, $eVcal[$fV], PHPExcel_Cell_DataType::TYPE_STRING);
                        }
                        break;
                }
            }
        }
        unset($eRes);
    }

    public function output() {
        $oExcel = $this->oExcel;
#UTF-8转为GBK
        $eFileName = $this->eFileName;
        $eFileName = iconv("UTF-8", "GBK", $eFileName);
#导出
        $oWrite = new PHPExcel_Writer_Excel5($oExcel);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="' . $eFileName . '"');
        header("Content-Transfer-Encoding: binary");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $oWrite->save('php://output');
    }

}

?>