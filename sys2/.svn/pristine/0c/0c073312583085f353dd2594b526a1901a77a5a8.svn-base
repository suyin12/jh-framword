<?php

require_once '../setting.php';
//页面访问权限
require_once webSysPath . 'w/auth.php';
#连接公用函数库
require_once sysPath . 'common.function.php';
#连接模板文件
require_once webSysPath . 'templateConfig.php';

$current_user = $_SESSION['web_worker']['wID'];
$sql = "select * from `web_worker_basic` where wID = " . $current_user;
$ret = $pdo->query($sql);
$user = $ret->fetch(PDO::FETCH_ASSOC);

function   sys_error_alert($msg)
{
    echo "<script> alert('" . $msg . "')</script>";
}

if ($_POST['wID']) {
    $wID = $_POST['wID'];
    if (strlen($_POST['newpass']) < 5 || strlen($_POST['newpass']) > 20)
        $error = "密码必须在5-20位之间";
    $oldpass = pwMcrypt($_POST['oldpass']);
    $newpass = pwMcrypt($_POST['newpass']);
    $newpass2 = pwMcrypt($_POST['newpass2']);


    if ($oldpass != $user['mPW'])
        $error = "您输入的原密码不正确";

    if ($oldpass == $newpass)
        $error = "您输入的新密码和原密码相同";

    if ($newpass != $newpass2)
        $error = "您输入的新密码不一致";
    if ($error) {
        sys_error_alert($error);
    }
    else {
        $sql = "update `web_worker_basic` set mPW = '" . $newpass . "' where wID = " . $wID;
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows)
            sys_error_alert("修改密码成功");
    }
}
$smarty->assign('user', $user);
$smarty->assign(array("title" => $title, "httpPath" => httpPath));
$smarty->display('w/changeUserInfo.tpl');
?>