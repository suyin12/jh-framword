<?php
/**
 * 2010-3-25              
 * <<<>>>
 * 
 * @author  yours  sToNe
 * @version 
 */
session_start();
if (!$_SESSION['UserName']) {
    $errMsg = "页面失效请重新登陆";
    $msg = array("error" => $errMsg , "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
} else {
    require_once '../settings.inc';
    $time = time();
    if ($_POST['btn'] == "insert") {
        //    print_r($_POST);
        foreach ($_POST as $pKey => $pVal) {
            if ($pKey != "btn") {
                $fieldStr .= "`" . $pKey . "`,";
                $insertStr .= "'" . $pVal . "',";
            }
        }
        $insertTime = date("Y-m-d H:i:s", $time);
        $actionPer = $_SESSION['UserName'];
        $inserSql = "insert into m_waitWorkList (" . $fieldStr . "insertTime,lastModifyTime,actionPer,status) values(" . $insertStr . "'" . $insertTime . "','" . $insertTime . "','" . $actionPer . "','0')";
        //    print_r()
        if (mysql_query($inserSql)) {
            $succMsg = "信息添加成功";
        } else {
            $errMsg = "添加失败!!未知原因,请联系管理员";
        }
        $msg = array("error" => $errMsg , "succ" => $succMsg);
        $msg = array_filter($msg);
        $js_msg = json_encode($msg);
        echo $js_msg;
    }
    if ($_POST['btn'] == "update") {
        //  
        //        print_r($_POST);   
        $lastModifyTime = date("Y-m-d H:i:s", $time);
        $actionPer = $_SESSION['UserName'];
        		 if($_SESSION['SubGroupIDs']==",14,"){
        foreach ($_POST['ID'] as $key => $val) {
            $updateSql = "update m_waitWorkList set ";
            $fieldStr = null;
            foreach ($_POST as $k => $v) {
                switch ($k) {
                    case "ID":
                    case "btn":
                        break;
                    default:
                        $fieldStr .= "`" . $k . "` = '" . $v[$key] . "',";
                        break;
                }
            }
            $conSql = $fieldStr . " `lastModifyTime`='$lastModifyTime',actionPer='$actionPer' where ID = '$val'";
            $sql[] = $updateSql . $conSql;
        }
        //        print_r($sql);
        foreach ($sql as $SQL) {
            $RET = mysql_query($SQL);
        }
        $succMsg = "更新成功";
        		}else{
        		    $errMsg = "您无权进行更新操作";
        		}
        $msg = array("error" => $errMsg , "succ" => $succMsg);
        $msg = array_filter($msg);
        $js_msg = json_encode($msg);
        echo $js_msg;
    }
    if ($_POST['type'] == "updateSub") {
        $lastModifyTime = date("Y-m-d H:i:s", $time);
        $field = $_POST['btn'];
        		 if($_SESSION['SubGroupIDs']==",14,"){
        if ($field == "dataStatus") {
            $value = '齐';
        } else {
            $value = "1";
        }
        
        if($field == "deleteMark"){
          $field = "mark";
          $value = '0';
        } 
        foreach ($_POST['listCheck'] as $key => $val) {
            $IDStr .= $val.","; 
            $updateSql[] = "update m_waitWorkList set $field = '$value' ,`lastModifyTime`='$lastModifyTime',actionPer='$_SESSION[UserName]' where ID='$val'";
        }
        foreach ($updateSql as $SQL) {
            mysql_query($SQL);
        }
        $succMsg = "更新成功";
        		}else{
        		    $errMsg = "您无权进行更新操作";
        		}
        $msg = array("error" => $errMsg , "succ" => $succMsg);
        $msg = array_filter($msg);
        $js_msg = json_encode($msg);
        echo $js_msg;
    }
}
?>