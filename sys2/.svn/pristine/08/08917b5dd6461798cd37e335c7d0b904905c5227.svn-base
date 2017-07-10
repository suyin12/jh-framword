<?php

require_once ('../auth.php'); //页面访问权限
require_once ('../setting.php'); //配置文件 数据库和pdo smarty初始化等
require_once ('../templateConfig.php'); //连接模板文件
require_once ('../dataFunction/unit.data.php');


$str = $_GET["Str"];
$type = $_GET["type"];
$StrList = explode(",", $str);
array_pop($StrList);
if (in_array("ckball", $StrList)) {
    $k = array_search("ckball", $StrList);
    unset($StrList[$k]);
}
$IdStr = implode(",", $StrList);
$success_Meg = "<script>alert('操作成功！');history.go(-1);</script>";
$fail_Meg = "<script>alert('未作修改！');history.go(-1);</script>";

/*
 * 重置密码
 */
if ($type == "delPwd") {
    $mPWStr = "abc654321";
    $mPw = pwMcrypt($mPWStr);
    $sql = "UPDATE `s_user` SET `mPW` = '$mPw' WHERE `mID` in($IdStr)";
    //echo  $sql;
    $affected = $pdo->exec($sql);
    if ($affected) {
        echo $success_Meg;
    } else {
        echo $fail_Meg;
    }
}

/*
 * 禁止登录
 */
if ($type == "noLogin") {
    $sql = "UPDATE `s_user` SET `status` = '0' WHERE `mID` in($IdStr)";
    $affected = $pdo->exec($sql);
    if ($affected) {
        echo $success_Meg;
    } else {
        echo $fail_Meg;
    }
}
?>