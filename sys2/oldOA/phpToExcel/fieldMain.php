<?php 

require_once '../settings.inc';
require_once 'class-excel-xml.inc.php';
   if(!isset($_POST['sql']))exit();
   $formName=$_POST['formName'];
   $month=$_POST['formMonth'];
   $preMonth=$month-1;
   $sql=str_replace('\\','',$_POST['sql']);
   $ret=mysql_query($sql);
   
   function contentRet($r_1,$r_2,$r_3,$r_4,$r_5)
    {
        if($r_1>0){$content.="单位挂账/";} else{ if($r_1<0){ $content.="单位欠款/";} }
        if($r_2>0){$content.="个人挂账/";} else{ if($r_2<0){ $content.="个人欠款/";} }
       // 残障金再行处理 if($r3)
//       if($r_4>0){$content.="失业金挂账/";} else{ if($r_4<0){ $content.="失业金欠款/";} } 
       if($r_5!=0){$content.="缴交基数有误/";}
       return $content;
    }
   
 function printField($FName)
 {
 switch($FName)
 {
     case "1_1":$fieldName=array();break;
     case "2_1":$fieldName=array("平帐月份","单位名称","姓名","电脑号","身份证","应缴合计(社保明细)","实收合计(备忘录的应收)","应缴补缴","实收补缴(备忘录的补缴)","应缴公积金","实收公积金","应收管理费","实收管理费","帐套名称");break;
     case "2_2":$fieldName=array("平帐月份","单位名称","姓名","电脑号","身份证","应缴合计(社保明细)","实收合计(备忘录的应收)","应缴补缴","实收补缴(备忘录的补缴)","应缴公积金","实收公积金","应收管理费","实收管理费","帐套名称");break;
     case "2_3":$fieldName=array("平帐月份","单位名称","姓名","电脑号","身份证","应缴合计(社保明细)","实收合计(备忘录的应收)","应缴补缴","实收补缴(备忘录的补缴)","应缴公积金","实收公积金","应收管理费","实收管理费","帐套名称");break;
     case "2_4":$fieldName = array("平账月份","不知道","申报日期","单位账号","个人账号","基数","单位比例","个人比例","金额","缴存月份","身份证");
 }
 return $fieldName;
 }
 $row_null="0";
  while($row = @mysql_fetch_array($ret)){
      if($row['f1']==null)
      {
          $row['f1']=0;
      }
      if($row['f2']==null)
      {
          $row['f2']=0;
      }
	  if($row['t1']==null)
	      {
	          $row['t1']=0;
	      }
	  if($row['t2']==null)
	      {
	          $row['t2']=0;
	      }
      switch ($formName)
      {
          case "2_1":$doc[]=array($row['month'],$row_null,$row['name'],$row['SBNO'],$row['peopleID'],$row['f1'],$row_null,$row['t1'],$row_null,$row_null,$row['h1'],($row['f7']+$row['f5']),($row['f16']+$row['f17']),$row_null);break;
          case "2_2":$doc[]=array($row['month'],$row['unitName'],$row['name'],$row_null,$row['peopleID'],$row_null,$row['f2'],$row_null,$row['t2'],$row_null,$row['h2'],$row['f7'],($row['f16']+$row['f17']),$row['zFID']);break;
          case "2_3":$doc[]=array($row['month'],$row['unitName'],$row['name'],$row['SBNO'],$row['peopleID'],$row['f1'],$row['f2'],$row['t1'],$row['t2'],$row['h1'],$row['h2'],($row['f7']+$row['f5']),$row['m1'],$row['zFID']);break;
          case "2_4":$doc[]=array($row['month'],$row['field1'],$row['field2'],$row['field3'],$row['field4'],$row['field5'],$row['field6'],$row['field7'],$row['field8'],$row['field8'],$row['peopleID']);break;
      }
  
  }
//  print_r($doc);
$field[]=printField($formName);
//print_r($field);
$doc=array_merge($field,$doc);
// print_r($doc);
  $name=$_POST['tableName'].$month;
   $name=iconv('UTF-8','GBK',$name);
  $xls = new Excel_XML;
  @$xls->addArray ( $doc );
  @$xls->generateXML ($name);
?>