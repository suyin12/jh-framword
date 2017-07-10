<?php
require_once '../settings.inc';
//echo $_POST['checkBox'];
$checkName = $_POST ['checkName'];
$delMonth = $_POST ['delMonth'];
$month = $_POST ['month'];
$userID = $_SESSION ['exp_user'] ['mID'];
#过滤重复数据
if (isset ( $_POST ['insert'] )) {	
    
		$insertSql = "insert into so_bal_3 (field0,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15,field16,field17,month,sessionID)  
         select a.field0,a.field1,a.field2,SUM(a.field3),SUM(a.field4),SUM(a.field5),a.field6,SUM(a.field7),SUM(a.field8),SUM(a.field9),SUM(a.field10),SUM(a.field11),SUM(a.field12),SUM(a.field13),SUM(a.field14),a.field15,sum(a.field16),sum(a.field17),a.month,a.sessionID from so_bal_3_tmp a where field2<>'' and a.month='$month' and a.sessionID='$userID' group by a.field2,a.sessionID";
		$insertRet1 = mysql_query ( $insertSql );
		// $t2 = mysql_affected_rows ();
		//这个公积金部分是没有做验证的
    	$insertSql2 = "insert into so_bal_6 (field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,peopleID,month,sessionID)  
select a.field0,a.field1,a.field2,a.field3,a.field4,a.field5,a.field6,SUM(a.field7),a.field8,a.field10,a.field9,a.month,a.sessionID from so_bal_6_tmp a where a.field4<>'' and a.month='$month' and a.sessionID='$userID' group by a.field3,a.sessionID";
		$insertRet2 = mysql_query ( $insertSql2 );
	
		// $t3 = mysql_affected_rows ();
		//echo "insertSql1:".$insertSql."<br/>"."insertsql2:".$insertSql2."<br/>";
                //echo $insertRet1."and".$insertRet2;
		if ($insertRet1 and $insertRet2) {		    
			echo '<script>alert("过滤重复数据成功!")</script>';
		} else {
			$del1 = "delete from so_bal_3 where month='$month' and sessionID='$userID'";
			mysql_query ( $del1 );
			$del2 = "delete from so_bal_6 where month='$month' and sessionID='$userID'";
			mysql_query ( $del2 );
			echo '<script>alert("导入失败,请再次点击<过滤重复数据>! ")</script>';
		}
}
//身份证号码提取 JQ 2011-11-14 注释
if (isset ( $_POST ['distill'] )) {
	//$distillSql = "update so_bal_2 a,so_bal_4 b set a.peopleID=b.field4 where a.peopleID=0 and a.month='$month' and a.field1=b.field1  and a.month=b.month and a.sessionID='$userID'";
	$distillSql = "update so_bal_2  set  peopleID=field3 where month='$month' and sessionID='$userID'";
	$distillRet = mysql_query ( $distillSql );
	$t1=@mysql_num_rows ( $distillRet );
	if ($t1 > 0) {
		echo '<script>alert("身份证号码提取成功!!")</script>';
	} else {
		echo '<script>alert("身份证号码已经提取或提取出错!!")</script>';
	}
}
//身份证15位转18 JQ 2011-11-14 注释
if (isset ( $_POST ['convert'] )) {
	$convertSql1 = "UPDATE so_bal_2 SET peopleID=
                       concat( SUBSTRING( peopleID, 1, 6 ) , '19', SUBSTRING( peopleID, 7, 9 ) , SUBSTRING( '10X98765432', (
                        CAST( SUBSTRING( peopleID, 1, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( peopleID, 2, 1 ) AS UNSIGNED ) *9 + 
                        CAST( SUBSTRING( peopleID, 3, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( peopleID, 4, 1 ) AS UNSIGNED ) *5 +
                        CAST( SUBSTRING( peopleID, 5, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( peopleID, 6, 1 ) AS UNSIGNED ) *4 +1 *2 +9 *1 +
                        CAST( SUBSTRING( peopleID, 7, 1 ) AS UNSIGNED ) *6 + CAST( SUBSTRING( peopleID, 8, 1 ) AS UNSIGNED ) *3 + 
                        CAST( SUBSTRING( peopleID, 9, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( peopleID, 10, 1 ) AS UNSIGNED ) *9 +
                        CAST( SUBSTRING( peopleID, 11, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( peopleID, 12, 1 ) AS UNSIGNED ) *5 + 
                        CAST( SUBSTRING( peopleID, 13, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( peopleID, 14, 1 ) AS UNSIGNED ) *4 + 
                        CAST( SUBSTRING( peopleID, 15, 1 ) AS UNSIGNED ) *2 ) %11 +1, 1 ))
                        WHERE LENGTH(peopleID)=15 AND SUBSTRING(peopleID,13,3) NOT IN ('999','998','997','996') and month='$month'  and sessionID='$userID'";
	//            echo "<br/>";
	$convertSql2 = "UPDATE so_bal_3 SET field2=
                       concat( SUBSTRING( field2, 1, 6 ) , '19', SUBSTRING( field2, 7, 9 ) , SUBSTRING( '10X98765432', (
                        CAST( SUBSTRING( field2, 1, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 2, 1 ) AS UNSIGNED ) *9 + 
                        CAST( SUBSTRING( field2, 3, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 4, 1 ) AS UNSIGNED ) *5 +
                        CAST( SUBSTRING( field2, 5, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 6, 1 ) AS UNSIGNED ) *4 +1 *2 +9 *1 +
                        CAST( SUBSTRING( field2, 7, 1 ) AS UNSIGNED ) *6 + CAST( SUBSTRING( field2, 8, 1 ) AS UNSIGNED ) *3 + 
                        CAST( SUBSTRING( field2, 9, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 10, 1 ) AS UNSIGNED ) *9 +
                        CAST( SUBSTRING( field2, 11, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 12, 1 ) AS UNSIGNED ) *5 + 
                        CAST( SUBSTRING( field2, 13, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 14, 1 ) AS UNSIGNED ) *4 + 
                        CAST( SUBSTRING( field2, 15, 1 ) AS UNSIGNED ) *2 ) %11 +1, 1 ))
                        WHERE LENGTH(field2)=15 AND SUBSTRING(field2,13,3) NOT IN ('999','998','997','996') and month='$month'  and sessionID='$userID'";
	$convertSql3 = "UPDATE so_bal_5 SET field2=
                       concat( SUBSTRING( field2, 1, 6 ) , '19', SUBSTRING( field2, 7, 9 ) , SUBSTRING( '10X98765432', (
                        CAST( SUBSTRING( field2, 1, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 2, 1 ) AS UNSIGNED ) *9 + 
                        CAST( SUBSTRING( field2, 3, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 4, 1 ) AS UNSIGNED ) *5 +
                        CAST( SUBSTRING( field2, 5, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 6, 1 ) AS UNSIGNED ) *4 +1 *2 +9 *1 +
                        CAST( SUBSTRING( field2, 7, 1 ) AS UNSIGNED ) *6 + CAST( SUBSTRING( field2, 8, 1 ) AS UNSIGNED ) *3 + 
                        CAST( SUBSTRING( field2, 9, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( field2, 10, 1 ) AS UNSIGNED ) *9 +
                        CAST( SUBSTRING( field2, 11, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( field2, 12, 1 ) AS UNSIGNED ) *5 + 
                        CAST( SUBSTRING( field2, 13, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( field2, 14, 1 ) AS UNSIGNED ) *4 + 
                        CAST( SUBSTRING( field2, 15, 1 ) AS UNSIGNED ) *2 ) %11 +1, 1 ))
                        WHERE LENGTH(field2)=15 AND SUBSTRING(field2,13,3) NOT IN ('999','998','997','996') and month='$month'  and sessionID='$userID'";
	$convertSql4 = "UPDATE so_bal_6 SET peopleID=
                       concat( SUBSTRING( peopleID, 1, 6 ) , '19', SUBSTRING( peopleID, 7, 9 ) , SUBSTRING( '10X98765432', (
                        CAST( SUBSTRING( peopleID, 1, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( peopleID, 2, 1 ) AS UNSIGNED ) *9 + 
                        CAST( SUBSTRING( peopleID, 3, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( peopleID, 4, 1 ) AS UNSIGNED ) *5 +
                        CAST( SUBSTRING( peopleID, 5, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( peopleID, 6, 1 ) AS UNSIGNED ) *4 +1 *2 +9 *1 +
                        CAST( SUBSTRING( peopleID, 7, 1 ) AS UNSIGNED ) *6 + CAST( SUBSTRING( peopleID, 8, 1 ) AS UNSIGNED ) *3 + 
                        CAST( SUBSTRING( peopleID, 9, 1 ) AS UNSIGNED ) *7 + CAST( SUBSTRING( peopleID, 10, 1 ) AS UNSIGNED ) *9 +
                        CAST( SUBSTRING( peopleID, 11, 1 ) AS UNSIGNED ) *10 + CAST( SUBSTRING( peopleID, 12, 1 ) AS UNSIGNED ) *5 + 
                        CAST( SUBSTRING( peopleID, 13, 1 ) AS UNSIGNED ) *8 + CAST( SUBSTRING( peopleID, 14, 1 ) AS UNSIGNED ) *4 + 
                        CAST( SUBSTRING( peopleID, 15, 1 ) AS UNSIGNED ) *2 ) %11 +1, 1 ))
                        WHERE LENGTH(peopleID)=15 AND SUBSTRING(peopleID,13,3) NOT IN ('999','998','997','996') and month='$month'  and sessionID='$userID'";
	
	mysql_query ( $convertSql1 );
	mysql_query ( $convertSql2 );
	mysql_query ( $convertSql3 );
	mysql_query ( $convertSql4 );
	echo '<script>alert("身份证15位转18位转换成功!")</script>';
}
//合并< 公积金 >和< 合作医疗 > JQ 2011-11-14 注释
if (isset ( $_POST ['merge'] )) {
	$mergeSql1 = "update so_bal_2 a,so_bal_2_tmp b  set a.field4=a.field4+b.field2,a.field5=a.field5+b.field3,a.field6=a.field6+b.field4,a.field10=b.field3,a.field11=b.field4 where a.month='$month' and a.sessionID='$userID' and a.field1=b.field0 and a.month=b.month and a.field10=0 and a.field11=0";
	mysql_query ( $mergeSql1 );
	$t1 = mysql_affected_rows ();
	
	$mergeSql2 = "update so_bal_2 a,so_bal_6 b set a.field9=b.field8 where  a.month='$month' and a.sessionID='$userID' and a.sessionID=b.sessionID and a.peopleID=b.peopleID and a.month=b.month and a.field9='0' ";
	mysql_query($mergeSql2);
	$t2 = mysql_affected_rows ();
	if ($t1 > 0 and $t2 > 0) {
		echo '<script>alert("合并< 公积金 >和< 合作医疗 >成功!")</script>';
	} else {
		echo '<script>alert("请先确认是否已导入社保明细数据或已经合并过数据!")</script>';
	}
}

if (isset ( $_POST ['delMonth'] )) {
	$count = count ( $checkName );
	for($i = 0; $i < $count; $i ++) {
		$delTabName = $checkName [$i];
		//        echo '<script>alert("成功删除'.$delTabName.'数据成功!")</script>';
		if ($delTabName == "so_bal_2" || $delTabName == "so_bal_3"||$delTabName == "so_bal_6") {
			$delSql_tmp = "delete from $delTabName" . "_tmp where sessionID='$userID' and month='$delMonth'";
			//      echo '<script>alert("成功删除'.$delSql_tmp.'数据成功!")</script>';
			mysql_query ( $delSql_tmp );
		}
		$delSql = "delete from $delTabName where sessionID='$userID' and month='$delMonth'";
		$delRet = mysql_query ( $delSql );
		$sum += mysql_affected_rows ();
	}
	if ($sum > 0) {
		echo '<script>alert("成功删除' . $delMonth . '数据成功!")</script>';
	} else {
		echo '<script>alert("请确认是否存在该月数据!")</script>';
	}
}

?>
