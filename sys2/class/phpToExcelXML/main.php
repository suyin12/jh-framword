<?php 
require_once sysPath.'class/phpToExcelXML/class-excel-xml.inc.php';
  $doc=$eRes;
  $name=$tableName.date('ymd',time());
   $name=iconv('UTF-8','GBK',$name);
  $xls = new Excel_XML;
  @$xls->addArray ( $doc );
  @$xls->generateXML ($name);
?>