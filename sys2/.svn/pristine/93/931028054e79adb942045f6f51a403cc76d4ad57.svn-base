<?php

/**
 * 用户编辑
 */
require_once ('../auth.php'); //页面访问权限
require_once ('../setting.php'); //配置文件 数据库和pdo smarty初始化等
require_once ('../templateConfig.php'); //连接模板文件
require_once ('../dataFunction/unit.data.php');

$title = "用户辅助角色编辑";
//根据用户id，查出用户信息
if (isset($_GET["id"])) {
    $userID = $_GET["id"];
    $sql = "SELECT * FROM `s_user` where `mID`=?";
    $userByIDResult = SQL($pdo, $sql, $var = array($userID), $type = "one");

    $roleSTR = $userByIDResult['roleID']; //重组 角色
    if ($roleSTR != "") {
        $rolelist = array_filter(explode(",", $roleSTR));
        $userByIDResult['roleID'] = array_shift($rolelist); //主角色	 
        $userByIDResult['roleOtherID'] = $rolelist; //辅助角色  	 
    } else {
        $userByIDResult['roleID'] = array();
    }

    $group_other_STR = $userByIDResult['group_otherID']; //重组 附属部门
    if ($group_other_STR != "") {
        $group_other_list = array_filter(explode(",", $group_other_STR));
        $userByIDResult['group_otherID'] = $group_other_list;
    } else {
        $userByIDResult['group_otherID'] = array();
    }

    $unitinfoSTR = $userByIDResult['unitID']; //重组 附属部门
    if ($unitinfoSTR != "") {//重组 管理单位
        $unitinfoList = explode(",", $unitinfoSTR);
        $userByIDResult['unitID'] = $unitinfoList;
    } else {
        $userByIDResult['unitID'] = array();
    }

    //echo "<pre>";
    // print_r($userByIDResult);
}

//角色
$allRole = getALLRole($pdo);
$allGroup = getALLGruop($pdo);
//echo "<pre>";
//print_r($allGroup);


if ($_POST["sub"]) {
    $success_Meg = "<script>alert('编辑成功！');history.go(-1);</script>";
    $fail_Meg = "<script>alert('错了，错了！');history.go(-1);</script>";
    $userID = $userID;
    $RID = $userByIDResult['roleID']; //主角色
    $other_RIDList = $_POST["ckbRole"];
    #部门的ID也要跟着变化
    if ($other_RIDList)
        array_unshift($other_RIDList, $RID);
    else
        $other_RIDList = array($RID);
    foreach ($other_RIDList as $v) {
        foreach ($allRole as $val) {
            if ($val['roleID'] == $v)
                $groupArr = mergeArray($groupArr, explode(",", $val['groupID']));
        }
    }
   $groupArr = array_filter(array_unique($groupArr));
    $groupIDStr = ",".implode(",", $groupArr) . ",";
    $roleIDStr = ",".implode(",", $other_RIDList) . ",";
    //print_r($roleStr);

    $sql_update = "UPDATE `s_user` SET `groupID`='$groupIDStr',`roleID`='$roleIDStr' WHERE `mID`=:var";
    $res = $pdo->prepare($sql_update);
    $res->bindParam(":var", $userID);
    $affected = $res->execute();
    if ($affected) {
        echo $success_Meg;
    } else {
        echo $fail_Meg;
    }
}
$smarty->assign("userByIDResult", $userByIDResult);
$smarty->assign(array("allRole" => $allRole, "allGroup" => $allGroup));
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/user_edit_otherRole.tpl');
?>