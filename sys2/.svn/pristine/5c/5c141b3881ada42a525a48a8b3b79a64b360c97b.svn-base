<?php
@session_start();
require_once ("../settings.inc");
if(!$_SESSION['UserName']){
$errMsg = "页面失效请重新登陆";
	   $msg = array("error" => $errMsg , "succ" => $succMsg);
	   $msg = array_filter($msg);
       $js_msg = json_encode($msg);
       echo $js_msg;

}else{
error_reporting ( E_ALL & ~ (E_NOTICE | E_WARNING) );
if ($_POST['sub'] == "1") {
//保存公司所有人信息
    $wInfoSql = "select * from cwps_user where groupID like '13'";
    $wInfoRet = mysql_query($wInfoSql);
    while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
        $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
    }
	$userName = $_SESSION['UserName'];
    $groupID = $_SESSION['SubGroupIDs'];
    $roleID = $wInfoArr[$_SESSION['UserName']]['RoleID'];
    
    $groupSql = "select SubRoleIDs from cwps_group where GroupID in ('14','15','16','17')";
    $groupRet = mysql_query($groupSql);
    while ($groupRow = mysql_fetch_assoc($groupRet)) {
        $groupArr[] = array($groupRow['SubRoleIDs']);
    }
	
    // 如果是相同部门的员工,35%, 其他部门 15%,自评10%
    if ($_POST['type'] == "w") {
        foreach ($_POST['userName'] as $uValue) {
		 $existsUserSql="'".$uValue."',";
          $userSubGroupID = $wInfoArr[$uValue]['SubGroupIDs'];
            if ($_SESSION['SubGroupIDs'] == $userSubGroupID) {
               $persent[$uValue] = "0.35";
            } else {
                $persent[$uValue]  = "0.15";
            }			
            if ($userName == $uValue)
                $persent[$uValue]  = '0.1';
				//这里设计评分比例,部长30%,总经理10%
        switch ($roleID) {
            case "24":
            case "28":
            case "22":
                $persent[$uValue]  = "0.3";
                break;
            case "40":
                $persent[$uValue]  = "0.1";
                break;
        }
        }
        
		
    }
    if ($_POST['type'] == "m") {
    foreach ($_POST['userName'] as $uValue) {
	        $existsUserSql="'".$uValue."',";
            $userSubGroupID = $wInfoArr[$uValue]['SubGroupIDs'];
            if ($_SESSION['SubGroupIDs'] == $userSubGroupID) {
                $persent[$uValue]  = "0.3";
            } else {
                $persent[$uValue]  = "0.2";
            }
            if ($userName == $uValue)
                $persent[$uValue]  = '0.1';
        }
        //部长20%,总经理20%(米总兼职人力资源供应中心部长,故为40%)
        switch ($roleID) {
            case "24":
            case "28":
            case "22":
                $persent[$uValue]  = "0.2";
                break;
            case "40":
                $persent[$uValue]  = "0.2";
                break;
        }
    }
    $time = time();
    $month = $_POST['month'];
    $actionTime = date("Y-m-d H:i:s", $time);
    $status = "0";
    //   print_r($_POST);
    foreach ($_POST['grade'] as $gK => $gV) {
        $gStr = NULL;
        foreach ($gV as $gValue) {
            $gStr .= $gValue . ",";
        }
        $gStr = rtrim($gStr, ",");
        $gradeStr[] = $gStr;
    }
    //        print_r($gradeStr['0']);
    foreach ($_POST['total'] as $tK => $tV) {
	   // echo $persent;
        $actionArr[$tK] = array("month" => $month , "userName" => $_POST['userName'][$tK] , "gradeStr" => $gradeStr[$tK] , "total" => $_POST['total'][$tK] , "remarks" => $_POST['remarks'][$tK] , "actionPer" => $userName , "status" => $status , "actionTime" => $actionTime , "persent" => $persent[$_POST['userName'][$tK]],"userGroupID"=>$wInfoArr[$_POST['userName'][$tK]]['SubGroupIDs'],"actionPerGroupID"=>$groupID);
    }
	
    //    print_r($actionArr);
	$existsUserSql = rtrim($existsUserSql,",");
    $existsSql = "select * from grade_number where month like '$month' and actionPer like '$userName' and userName in ( $existsUserSql )";
    $existsRet = mysql_query($existsSql);
    if (mysql_num_rows($existsRet) > 0) {
        foreach ($actionArr as $aValue) {
            $sqlK = NULL;
            $sqlS = "update grade_number set ";
            foreach ($aValue as $aK => $aV) {
                $sqlK .= $aK . "= '" . $aV . "',";
            }
            $sqlK = rtrim($sqlK, ",");
            $sql[] = $sqlS . $sqlK . " where  month like '$month' and actionPer like '$userName' and userName like '$aValue[userName]'";
        }
    } else {
        $sql[0] = "insert into grade_number (";
        foreach ($actionArr as $aValue) {
            $sqlK = NULL;
            $sqlV .= "(";
            foreach ($aValue as $aK => $aV) {
                $sqlK .= $aK . ",";
                $sqlV .= "'" . $aV . "',";
            }
            $sqlV = rtrim($sqlV, ",");
            $sqlV .= "),";
        }
        $sqlK = rtrim($sqlK, ",");
        $sqlV = rtrim($sqlV, ",");
        $sql[0] .= $sqlK . ") values " . $sqlV;
    }
      // print_r($sql);
	  if ($sql) {
     
       foreach ($sql as $SQL) {
          $RET = mysql_query($SQL);	
        	
		   
       }
	   
       $succMsg = $month . " 评分成功";
	   $msg = array("error" => $errMsg , "succ" => $succMsg);
	   $msg = array_filter($msg);
       $js_msg = json_encode($msg);
       echo $js_msg;
    }
}

//临时保存
if ($_POST['subTemp'] == "1") {
//保存公司所有人信息
    
	$userName = $_SESSION['UserName'];
    $time = time();
    $month = $_POST['month'];
    $actionTime = date("Y-m-d H:i:s", $time);
    $status = "0";
    
    foreach ($_POST['grade'] as $gK => $gV) {
        $gStr = NULL;
        foreach ($gV as $gValue) {
            $gStr .= $gValue . ",";
        }
        $gStr = rtrim($gStr, ",");
        $gradeStr[] = $gStr;
    }
    //        print_r($gradeStr['0']);
    foreach ($_POST['total'] as $tK => $tV) {
	   // echo $persent;
        $actionArr[$tK] = array("month" => $month , "userName" => $_POST['userName'][$tK] , "gradeStr" => $gradeStr[$tK] , "total" => $_POST['total'][$tK] , "remarks" => $_POST['remarks'][$tK] , "actionPer" => $userName );
    }
	
    //    print_r($actionArr);
	    $type = $_POST['type'];
		switch($type){
		    case "w":
			$typeSql= " and b.subGroupIDs not like ',17,' and b.userName is not null ";
			break;
			case "m":
			$typeSql= " and b.subGroupIDs like ',17,' and b.userName is not null ";
			break;
		}
	    $sql[0] = "delete  a.*  from  grade_number_temp a , grade_filter b where a.actionPer like '$userName' and a.userName =b.userName  ".$typeSql;
        $sql[1] = "insert into grade_number_temp (";
        foreach ($actionArr as $aValue) {
            $sqlK = NULL;
            $sqlV .= "(";
            foreach ($aValue as $aK => $aV) {
                $sqlK .= $aK . ",";
                $sqlV .= "'" . $aV . "',";
            }
            $sqlV = rtrim($sqlV, ",");
            $sqlV .= "),";
        }
        $sqlK = rtrim($sqlK, ",");
        $sqlV = rtrim($sqlV, ",");
        $sql[1] .= $sqlK . ") values " . $sqlV;
   
      // print_r($sql);
	  if ($sql) {
	 
       foreach ($sql as $SQL) {
	       $RET=mysql_query($SQL);
		
       }
	   
       $succMsg = $month . " 临时保存成功";
	   // $errMsg = $sql[0];
	   $msg = array("error" => $errMsg , "succ" => $succMsg);
	   $msg = array_filter($msg);
       $js_msg = json_encode($msg);
       echo $js_msg;
    }
}


//状态签收
if ($_POST['update'] == "1") {
    $btn = $_POST['btn'];
    $type = $_POST['type'];
    switch ($type) {
        case "wCheck":
            $sqlCon = " and b.subGroupIDs not LIKE ',17,'";
            break;
        case "mCheck":
            $sqlCon = " and b.subGroupIDs  LIKE ',17,'";
            break;
    }
    foreach ($_POST[$type] as $typeVal) {
        list ($month[], $actionPer[]) = explode(",", $typeVal);
    }
    switch ($btn) {
        case "pass":
            $status = "1";
            $succMsg = "签收成功";
            break;
        case "reGrade":
            $status = "0";
            $succMsg = "退回成功";
            break;
    }
    //    print_r($_POST);
    foreach ($actionPer as $aPerKey => $aPerVal) {
        $sql[] = " update grade_number a ,grade_filter b set a.status = '$status' where a.month like '$month[$aPerKey]' and a.actionPer like '$aPerVal' and a.userName=b.userName " . $sqlCon;
    }
    //    print_r($sql);
    if ($sql) {
        foreach ($sql as $SQL) {
            mysql_query($SQL);
        }
        $msg = array("error" => $errMsg , "succ" => $succMsg);
        $msg = array_filter($msg);
        $js_msg = json_encode($msg);
        echo $js_msg;
    }
}

     //参议人员信息修改
    if ($_POST['attendSub'] == "1") {
        $personSql = "select * from grade_filter order by id";
        $personRet = mysql_query($personSql);
        while ($personRow = mysql_fetch_assoc($personRet)) {
            $personArr[$personRow['userName']] = array("subGroupIDs" => $personRow['subGroupIDs'] , "salary" => $personRow['salary'] , "pyPersent" => $personRow['pyPersent'] , "lhPersent" => $personRow['lhPersent'] , "status" => $personRow['status'] , "ID" => $personRow['id']);
        }
        $personName = array_keys($personArr);
        $checkPer = $_POST['checkPer'];
        $insertName = array_diff($checkPer, $personName);
        if ($insertName) {
            $updateName = array_diff($checkPer, $insertName);
            foreach ($insertName as $insertK) {
                $insertArr[$insertK] = array("id" => $_POST['ID'][$insertK] , "userName" => $insertK , "salary" => $_POST['salary'][$insertK] , "pyPersent" => $_POST['pyPersent'][$insertK] , "lhPersent" => $_POST['lhPersent'][$insertK] , "subGroupIDs" => $_POST['subGroupIDs'][$insertK] , "status" => "1");
            }
        } else {
            $updateName = $checkPer;
        }
        foreach ($updateName as $updateK) {
            $updateArr[$updateK] = array("id" => $_POST['ID'][$updateK] , "userName" => $updateK , "salary" => $_POST['salary'][$updateK] , "pyPersent" => $_POST['pyPersent'][$updateK] , "lhPersent" => $_POST['lhPersent'][$updateK] , "subGroupIDs" => $_POST['subGroupIDs'][$updateK] , "status" => "1");
        }
        if ($insertArr) {
            foreach ($insertArr as $iKey => $iVal) {
                $insertKeyStr = "";
                $insertValStr .= "(";
                foreach ($iVal as $iK => $iV) {
                    $insertKeyStr .= $iK . ",";
                    $insertValStr .= "'" . $iV . "',";
                }
                $insertKeyStr = rtrim($insertKeyStr, ",");
                $insertValStr = rtrim($insertValStr, ",");
                $insertValStr .= "),";
            }
            $insertValStr = rtrim($insertValStr, ",");
            $sql['insert'][0] = "insert into grade_filter($insertKeyStr)values " . $insertValStr;
        }
        foreach ($updateArr as $uKey => $uVal) {
            $sql['update'][$uKey] = "update grade_filter set ";
            foreach ($uVal as $uK => $uV) {
                $updateSqlStr[$uKey] .= $uK . "='" . $uV . "',";
            }
            $updateSqlStr[$uKey] = rtrim($updateSqlStr[$uKey], ",");
            $sql['update'][$uKey] .= $updateSqlStr[$uKey] . " where userName like '$uKey'";
        }
        $sql = array_filter($sql);
        if ($sql) {
            foreach ($sql as $SQL) {
                foreach ($SQL as $S) {
                    mysql_query($S);
                }
            }
            $succMsg = "更新成功 ";
            // $errMsg = $sql[0];
            $msg = array("error" => $errMsg , "succ" => $succMsg);
            $msg = array_filter($msg);
            $js_msg = json_encode($msg);
            echo $js_msg;
        }
        
    }
    if ($_POST['outSub'] == "1") {
        $checkPer = $_POST['checkPer'];
        foreach ($checkPer as $checkName) {
            $sql[] = "update grade_filter set status ='0' where userName like '$checkName'";
        }
        if ($sql) {
            foreach ($sql as $SQL) {
                    mysql_query($SQL);
            }
            $succMsg = "退出评议成功 ";
            $msg = array("error" => $errMsg , "succ" => $succMsg);
            $msg = array_filter($msg);
            $js_msg = json_encode($msg);
            echo $js_msg;
        }
    }
	
	   //保存输入的量化系数及奖金
    if ($_POST['save'] == "1") {
        $lhxs = $_POST['lhxs'];
        $month = $_POST['month'];
        $delSql = "delete from grade_persent where month like '$month'";
        if (! mysql_query($delSql)) {
            $errMsg = "保存失败,发生未知错误";
        } else {
            foreach ($lhxs as $lhKey => $lhVal) {
                $insertArr[$lhKey] = array("month" => $month , "userName" => $lhKey ,'pyPersent'=>$_POST['pyPersent'][$lhKey],'lhPersent'=>$_POST['lhPersent'][$lhKey],'salary'=>$_POST['salary'][$lhKey], "lhxs" => $lhVal , "reward" => $_POST['reward'][$lhKey]);
            }
            if ($insertArr) {
                foreach ($insertArr as $iKey => $iVal) {
                    $insertKeyStr = "";
                    $insertValStr .= "(";
                    foreach ($iVal as $iK => $iV) {
                        $insertKeyStr .= $iK . ",";
                        $insertValStr .= "'" . $iV . "',";
                    }
                    $insertKeyStr = rtrim($insertKeyStr, ",");
                    $insertValStr = rtrim($insertValStr, ",");
                    $insertValStr .= "),";
                }
                $insertValStr = rtrim($insertValStr, ",");
                $sql = "insert into grade_persent($insertKeyStr)values " . $insertValStr;
            }
            
            if (mysql_query($sql)) {
                $succMsg = "保存成功 ";
            } else {
                $errMsg = "信息未变更";
            }
        }
        $msg = array("error" => $errMsg , "succ" => $succMsg);
        $msg = array_filter($msg);
        $js_msg = json_encode($msg);
        echo $js_msg;
    }
}
?>