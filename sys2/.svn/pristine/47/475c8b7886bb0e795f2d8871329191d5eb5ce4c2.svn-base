<?php

/*
 * 编辑当前用户角色权限
 * 
 * */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';

$title = "编辑角色权限";

//查询角色已赋予的权限然后拆解组成数组
if (isset($_GET["id"])) {
    $roleID = $_GET["id"];
    $sql = "SELECT `Function_ID_STR` FROM `s_role` where `roleID`= ?";
    $roleByIDResult = SQL($pdo, $sql, $var = array($roleID), $type = "one");
    $roleValue = $roleByIDResult[Function_ID_STR];
    if ($roleValue != "") {
        $roleList = explode(",", $roleValue);
        array_pop($roleList); //弹出数组中的最后一个 值
    } else {
        $roleList = array();
    }
}

#获取权限列表
$headerConfig = headerConfig($pdo, "'1','2'");
$father = $headerConfig['father'];
$child = $headerConfig['child'];
#修改权限
if (isset($_POST["Submit"])) {
    $success_Meg = "<script>alert('权限编辑成功！');window.location.href=window.location.href;</script>";
    $fail_Meg = "<script>alert('错了，错了！');window.location.href=window.location.href;</script>";
    $roleID = $roleID;
    $allowList = $_POST["action_code"];
   $banList =$allowList? array_diff(array_keys($child),$allowList):array_keys($child);
    $allowList? $allowStr = ",".implode(',', $allowList) :"";
    $banList?$banStr = ",-".implode(',-', $banList) :"";
    $function_STR = $allowStr .$banStr. ",";
    
//     die($function_STR);
    $sql_Role_update = "UPDATE `s_role` SET `Function_ID_STR`='$function_STR' where `roleID`=:var";
    $res = $pdo->prepare($sql_Role_update);
    $res->bindParam(":var", $roleID);
    $affected = $res->execute();
    if ($affected) {
        echo $success_Meg;
    } else {
        echo $fail_Meg;
    }
}

$smarty->assign("roleID", "$roleID");
$smarty->assign("roleList", $roleList);
$smarty->assign(array("father" => $father, "child" => $child));
$smarty->assign("lastUrl", httpPath."system/roleManage.php");

$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/edit_role.tpl');
?>