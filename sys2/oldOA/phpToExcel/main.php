<?php 

require_once '../settings.inc';
require_once 'class-excel-xml.inc.php';
   if(!isset($_POST['sql']))exit();
   $sql=str_replace('\\','',$_POST['sql']);
   $ret=mysql_query($sql);
 
  while(@$row = mysql_fetch_row($ret)){
   $doc[]=$row;
  }
//  print_r($doc);
  $name=$_POST['tableName'].date('ymd',time());
   $name=iconv('UTF-8','GBK',$name);
  $xls = new Excel_XML;
  @$xls->addArray ( $doc );
  @$xls->generateXML ($name);
?>