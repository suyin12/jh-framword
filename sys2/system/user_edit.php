<?php

/**
 * 用户编辑
 */
require_once ('../auth.php'); //页面访问权限
require_once ('../setting.php'); //配置文件 数据库和pdo smarty初始化等
require_once ('../templateConfig.php'); //连接模板文件
require_once ('../dataFunction/unit.data.php');

$title = "用户编辑";
//根据用户id，查出用户信息
if (isset($_GET["id"])) {
    $userID = $_GET["id"];
    $sql = "SELECT * FROM `s_user` where `mID`=?";
    $userByIDResult = SQL($pdo, $sql, $var = array($userID), $type = "one");
    $groupArr = array_filter(explode(",", $userByIDResult['groupID']));
    $roleArr = array_filter(explode(",", $userByIDResult['roleID']));
    $roleSTR = $userByIDResult[roleID]; //重组 角色
    if ($roleSTR != "") {
        $rolelist = array_filter(explode(",", $roleSTR));
        $userByIDResult['roleID'] = array_shift($rolelist); //主角色	 
        $userByIDResult[roleOtherID] = $rolelist; //辅助角色  	 
    } else {
        $userByIDResult[roleID] = array();
    }


    $unitinfoSTR = $userByIDResult[unitID]; //重组 附属部门
    if ($unitinfoSTR != "") {//重组 管理单位
        $unitinfoList = explode(",", $unitinfoSTR);
        $userByIDResult[unitID] = $unitinfoList;
    } else {
        $userByIDResult[unitID] = array();
    }
}

//查找出空余派遣单位，并为角色为“客户经理”，“业务文员”，“社保专员”的用户  分配
$unitList = unitList($userByIDResult[roleID], $pdo, $userByIDResult[status]);
//角色
$allRole = getALLRole($pdo);
//部门
$allGroup = getALLGruop($pdo);
//单位
$allUnitInfo = getAllUnitinfo($pdo);


//编辑用户信息
if (isset($_POST["editUser"])) {
    $UID = $_POST["userID"];
    $UName = $_POST["userName"];
    $URole = $_POST["selRole"];
    if ($roleArr) {
        $replaceStr = array(",".$userByIDResult['roleID'] . "," => ",".$URole . ",");
        $roleIDStr = strtr($roleSTR, $replaceStr);
    }
    else
        $roleIDStr = ",".$URole . ",";
    $newRoleArr = array_filter(explode(",", $roleIDStr));
    foreach ($newRoleArr as $v) {
        foreach ($allRole as $val) {
            if ($val['roleID'] == $v)
                if (!$groupIDArr)
                    $groupIDArr = explode(",", $val['groupID']);
                else
                    $groupIDArr = mergeArray($groupIDArr, explode(",", $val['groupID']));
        }
    }
    $groupIDArr = array_filter(array_unique($groupIDArr));
    $groupIDStr = "," . implode(",", $groupIDArr) . ",";
    $UUnitInfoList = $_POST["ckbUnitInfo"];
    $UUnitInfoStr =  implode(",", $UUnitInfoList); //负责单位
    if (isset($_GET["id"])):
        $sql_update = "UPDATE `s_user` SET `mName`='$UName',`roleID`='$roleIDStr',`groupID`='$groupIDStr', `unitID`='$UUnitInfoStr' WHERE `mID`='$UID'";
        $res = $pdo->prepare($sql_update);
        $affected = $res->execute();
        $success_Meg = "<script>alert('编辑成功！');window.location.href=window.location.href;</script>";
        $fail_Meg = "<script>alert('错了，错了！');window.location.href=window.location.href;</script>";
    else:
        $mPW = pwMcrypt($_POST['mPW']);
        $iSql = "insert into `s_user` set `mName`='$UName',`status`='1',`mPw`='$mPW',`roleID`='$roleIDStr',`groupID`='$groupIDStr'";
        $affected = $pdo->query($iSql);
        $lastID = $pdo->lastInsertId();
        $success_Meg = "<script>alert('编辑成功！');location.href='user_edit.php?id=$lastID';</script>";
        $fail_Meg = "<script>alert('添加失败!!用户名,不能重复');</script>";
    endif;
    if ($affected) {
        echo $success_Meg;
    } else {
        echo $fail_Meg;
    }
}

$smarty->assign("userByIDResult", $userByIDResult);
$smarty->assign(array('groupArr' => $groupArr, "roleArr" => $roleArr));
$smarty->assign("allrole", $allRole);
$smarty->assign("allGroup", $allGroup);
$smarty->assign("allUnitInfo", $allUnitInfo);
$smarty->assign("unitList", $unitList);
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display('system/user_edit.tpl');
?>