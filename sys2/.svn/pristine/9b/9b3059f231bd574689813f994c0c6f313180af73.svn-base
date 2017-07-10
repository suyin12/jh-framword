<?php 

require_once '../settings.inc';
require_once '../phpToExcel/class-excel-xml.inc.php';

//$_POST['sql']="select * from soconvertsbb where sessionID='1' ";
   if(!isset($_POST['sql']))exit();
   
   function convData_1($x){
     if($x!=NULL){
         $x=1;
                 }
     else{
         $x=0;
     }   
     return $x; 
     
   }
   
    function convData_2($x){
     if($x!=NULL){
         $x=2;
                 }
     else{
         $x=0;
     }   
     return $x; 
     
   }
   
function convData_4($x){
     if($x!=NULL){
         $x=4;
                 }
     else{
         $x=0;
     }   
     return $x; 
     
   }
   
   function rebulidData($j,$k,$l)
   {
       if($j==1&&$k==0&&$l==0)
       {
           $x=$j;
       }
       if($j==0&&$k==2&&$l==0)
       {
           $x=$k;
           
       }
       if($j==0&&$k==0&&$l==4)
       {
           $x=$l;
           
       }
       if(($j!=0&&$k!=0)||($j!=0&&$l!=0)||($k!=0&&$l!=0))
       {
           $x="出错了";
       }
          return $x;
   }
   function choiceData($j,$k)
   {
       if($k!=null&&eregi("/[0-9]/",$k)&&$k!="0")
       {
           $x=$k;
       }
       else 
       {
           $x=$j;
       }
       return $x;
   }
   
   
   $sql=str_replace('\\','',$_POST['sql']);
   $ret=mysql_query($sql);
 
   
	  while(@$row = mysql_fetch_row($ret)){
	      $rw[0]=$row[0];
	      $rw[1]=$row[1];
	      $rw[2]=$row[2];
	      $row[3]=convData_1($row[3]);
	      $row[4]=convData_2($row[4]);
	      $row[5]=convData_4($row[5]);
	      $rw[3]=rebulidData($row[3],$row[4],$row[5]);
	      $rw[4]=choiceData($row[6],$row[7]);
	   $rw[5]=convData_1($row[8]);
	     $row[9]=convData_1($row[9]);
	     $row[10]=convData_2($row[10]);
	     $row[11]=convData_4($row[11]);
	     $rw[6]=rebulidData($row[9],$row[10],$row[11]);
	      $rw[7]=convData_1($row[12]);
	      $rw[8]=convData_1($row[13]);
	      $rw[9]=convData_1($row[14]);
	      $rw[10]=$row[15];
	    
	      
	   $doc[]=array($rw[0],$rw[1],$rw[2],$rw[3],$rw[4],$rw[5],$rw[6],$rw[7],$rw[8],$rw[9],$rw[10]);
	   
	  }
	  
	  
//     print_r($doc);

//  
  $name="excel_".time();
  $xls = new Excel_XML;
  @$xls->addArray ( $doc );
  @$xls->generateXML ($name);
?>
