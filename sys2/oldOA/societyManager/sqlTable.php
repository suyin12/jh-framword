<?php
require_once '../header/societyHeader.php';
if (! defined('ALLOW'))
    exit();
require_once '../settings.inc';
//$userID=$_SESSION['UserID'];
$userID=$_SESSION['exp_user']['mID'];
//$userID = '1';
if (isset($_POST['clear'])) {
    for ($i = 1; $i < 4; $i ++) {
        // $clearSql1 = "delete from society$i where sessionID='$userID'";
        // $clearSql2 = "delete from society$i" . "tmp where sessionID='$userID'";
        $clearSql1 = "truncate table society$i";
        $clearSql2 = "truncate table society$i" . "tmp ";
        //    echo "<br/>";
        mysql_query($clearSql1);
        mysql_query($clearSql2);
    }
    // $clearSql3="delete from soconvertsbb where sessionID='$userID'";
	$clearSql3="truncate table soconvertsbb ";
    mysql_query($clearSql3);
    echo '<script>alert("临时表的数据成功被清空!")</script>';
}

if (isset($_POST['clear_small'])) {
    for ($i = 1; $i < 4; $i ++) {
        $clearSql1 = "delete from society$i where sessionID='$userID'";
        //    echo "<br/>";
        mysql_query($clearSql1);
    }
    //同时清空转换后的申报表(未过滤),因为后面还有导入申报表的部分会添加 society2tmp内容
    $clearSql2 = "delete from society2tmp where sessionID='$userID'";
    mysql_query($clearSql2);
    echo '<script>alert("实际操作数据表成功被清空!")</script>';
}

if (isset($_POST['clear_convert'])) {
        $clearSql = "delete from soConvertSBB where sessionID='$userID'";
        //    echo "<br/>";
        mysql_query($clearSql);
    echo '<script>alert("临时表的数据成功被清空!")</script>';
}


if (isset($_POST['insert'])) {
    for ($i = 1; $i < 4; $i ++) {
        $validRet = mysql_query("select field2 from society$i where sessionID='$userID' ");
        $tt1[$i] = mysql_num_rows($validRet);
        $t1 += $tt1[$i];
    }
    if ($t1 > 0) {
        echo '<script>alert("已经成功,过滤重复数据,若你需要再度过滤数据,请先清空临时表,重新进行导入!")</script>';
    } else {
        for ($i = 1; $i < 4; $i ++) {
            $insertSql = "insert into society$i (field0,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,sessionID)  select a.field0,a.field1,a.field2,a.field3,a.field4,a.field5,a.field6,a.field7,a.field8,a.field9,a.field10,a.field11,a.sessionID from society$i" . "tmp a,(select max(ID) c from society$i" . "tmp where sessionID='$userID'group by field2 ) b where a.ID=b.c and a.sessionID='$userID' order by a.ID asc";
            //    echo "<br/>";
            $insertRet = mysql_query($insertSql);
            $tt2[$i] = mysql_affected_rows();
            $t2 += $tt2[$i];
        }
        if ($t2 > 0) {
            echo '<script>alert("过滤重复数据成功!")</script>';
        }
    }
}
if (isset($_POST['convert'])) {
    for ($i = 1; $i < 4; $i ++) {
       $convertSql1 = "UPDATE society$i"."tmp SET field2=
                       concat( SUBSTRING( field2, 1, 6 ) , '19', SUBSTRING( field2, 7, 9 ) , SUBSTRING( '10X98765432', (
                        CAST( SUBSTRING( field2, 1, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 2, 1 ) AS UNSIGNED ) *9 + 
                        CAST( SUBSTRING( field2, 3, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 4, 1 ) AS UNSIGNED ) *5 +
                        CAST( SUBSTRING( field2, 5, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 6, 1 ) AS UNSIGNED ) *4 +1 *2 +9 *1 +
                        CAST( SUBSTRING( field2, 7, 1 ) AS UNSIGNED ) *6 + CAST( SUBSTRING( field2, 8, 1 ) AS UNSIGNED ) *3 + 
                        CAST( SUBSTRING( field2, 9, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 10, 1 ) AS UNSIGNED ) *9 +
                        CAST( SUBSTRING( field2, 11, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 12, 1 ) AS UNSIGNED ) *5 + 
                        CAST( SUBSTRING( field2, 13, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 14, 1 ) AS UNSIGNED ) *4 + 
                        CAST( SUBSTRING( field2, 15, 1 ) AS UNSIGNED ) *2 ) %11 +1, 1 ))
                        WHERE LENGTH(field2)=15 AND SUBSTRING(field2,13,3) NOT IN ('999','998','997','996')  and sessionID='$userID'";
        //    echo "<br/>";
        $convertSql2 = "UPDATE society$i SET field2=
                       concat( SUBSTRING( field2, 1, 6 ) , '19', SUBSTRING( field2, 7, 9 ) , SUBSTRING( '10X98765432', (
                        CAST( SUBSTRING( field2, 1, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 2, 1 ) AS UNSIGNED ) *9 + 
                        CAST( SUBSTRING( field2, 3, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 4, 1 ) AS UNSIGNED ) *5 +
                        CAST( SUBSTRING( field2, 5, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 6, 1 ) AS UNSIGNED ) *4 +1 *2 +9 *1 +
                        CAST( SUBSTRING( field2, 7, 1 ) AS UNSIGNED ) *6 + CAST( SUBSTRING( field2, 8, 1 ) AS UNSIGNED ) *3 + 
                        CAST( SUBSTRING( field2, 9, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 10, 1 ) AS UNSIGNED ) *9 +
                        CAST( SUBSTRING( field2, 11, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 12, 1 ) AS UNSIGNED ) *5 + 
                        CAST( SUBSTRING( field2, 13, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 14, 1 ) AS UNSIGNED ) *4 + 
                        CAST( SUBSTRING( field2, 15, 1 ) AS UNSIGNED ) *2 ) %11 +1, 1 ))
                        WHERE LENGTH(field2)=15 AND SUBSTRING(field2,13,3) NOT IN ('999','998','997','996')  and sessionID='$userID'";
        mysql_query($convertSql1);
        mysql_query($convertSql2);
    }
    echo '<script>alert("身份证15位转18位转换成功!")</script>';
}
if (isset($_POST['model1'])) {
    //删除当月增当月减,当月减当月增的情况
    $deleteSql = "delete a.* from society2 a , society2_rep b where a.field2=b.field2 and a.sessionID=b.sessionID and a.sessionID = '$userID'";
    mysql_query($deleteSql);
    $cutSql = "delete a.* from society1 a,society2 b where a.field2=b.field2 and b.field10='1' and a.sessionID=b.sessionID and a.sessionID='$userID'";
    mysql_query($cutSql);
    $addSql = "insert into society1(field0,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,sessionID) select field0,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,sessionID from society2 where sessionID='$userID' and field10='0'";
    mysql_query($addSql);
    echo '<script>alert("<<当月 - 新增 + 停保>>执行成功!")</script>';
}
if (isset($_POST['model2'])) {
    //删除当月增当月减,当月减当月增的情况
    $deleteSql = "delete a.* from society2 a , society2_rep b where a.field2=b.field2 and a.sessionID=b.sessionID and a.sessionID = '$userID'";
    mysql_query($deleteSql);
    $cutSql = "delete a.* from society3 a,society2 b where a.field2=b.field2 and b.field10='0' and a.sessionID='$userID'";
    mysql_query($cutSql);
    $addSql = "insert into society3(field0,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,sessionID) select field0,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,sessionID from society2 where sessionID='$userID' and field10='1'";
    mysql_query($addSql);
    echo '<script>alert("<<上月 + 新增 - 停保>>执行成功!")</script>';
}


if (isset($_POST['intoSo2'])) {
    
  $sql="select * from soconvertSBB where sessionID='$userID' order by ID asc";
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
   
   function domicileData($j,$k,$l){
      if($j==1&&$k==0&&$l==0)
       {
           $x=$j;
       }
       if($j==0&&$k==2&&$l==0)
       {
           $x=$k;
           
       }
       if($j==0&&$k==0&&$l==2)
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
   
   
   $ret=mysql_query($sql);
 
   
	  while(@$row = mysql_fetch_row($ret)){
	       $rw[0]=$row[0];
	      $rw[1]=$row[1];
	      $rw[2]=$row[4];
	      $row[5]=convData_1($row[5]);
	      $row[6]=convData_2($row[6]);
	      $row[7]=convData_2($row[7]);
	      $rw[3]=domicileData($row[5],$row[6],$row[7]);
	      $rw[4]=choiceData($row[2],$row[3]);
	      $rw[5]=convData_1($row[8]);
	     $row[9]=convData_1($row[9]);
	     $row[10]=convData_2($row[10]);
	     $row[11]=convData_4($row[11]);
	     $rw[6]=rebulidData($row[9],$row[10],$row[11]);
	      $rw[7]=convData_1($row[13]);
	      $rw[8]=convData_1($row[12]);
	      $rw[9]=convData_1($row[14]);
	      $rw[10]=$row[15];
	    
	      echo "<pre>";
	     // print_r($row);
	  //print_r ($doc[]=array($rw[0],$rw[1],$rw[2],$rw[3],$rw[4],$rw[5],$rw[6],$rw[7],$rw[8],$rw[9],$rw[10]));
	    $insertSql="insert into society2tmp(field0,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,sessionID) 
	               values('$rw[0]','$rw[1]','$rw[2]','$rw[3]','$rw[4]','$rw[5]','$rw[6]','$rw[7]','$rw[8]','$rw[9]','$rw[10]','$userID')";
	    mysql_query($insertSql);
	   
	  }
    
    echo '<script>alert("成功导入申报表!")</script>';

}
?>