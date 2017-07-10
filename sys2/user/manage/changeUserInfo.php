<?php

require_once '../../auth.php';
require_once '../../setting.php';
require_once '../../templateConfig.php';
require_once '../../common.function.php';

$current_user = $_SESSION['exp_user']['mID'];
$sql = "select * from s_user where mID = " . $current_user;
$ret = $pdo->query($sql);
$user = $ret->fetch(PDO::FETCH_ASSOC);


if (!$_POST['mID']) {
    $smarty->assign('user', $user);
    $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
    $smarty->display('user/manage/changeUserInfo.tpl');
} else {
    $mID = $_POST['mID'];
    if (strlen($_POST['newpass']) < 5 || strlen($_POST['newpass']) > 20)
        sys_error($smarty, "密码必须在5-20位之间");
    $oldpass = pwMcrypt($_POST['oldpass']);
    $newpass = pwMcrypt($_POST['newpass']);
    $newpass2 = pwMcrypt($_POST['newpass2']);


    if ($oldpass != $user['mPW'])
        sys_error($smarty, "您输入的原密码不正确");

    if ($oldpass == $newpass)
        sys_error($smarty, "您输入的新密码和原密码相同");

    if ($newpass != $newpass2)
        sys_error($smarty, "您输入的新密码不一致");

    $sql = "update s_user set mPW = '" . $newpass . "' where mID = " . $mID;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    echo "<br /><br /><br /><p align='center' >修改密码成功，点击<a href='" . httpPath . "' >这里</a>到首页</p>";
}
?>