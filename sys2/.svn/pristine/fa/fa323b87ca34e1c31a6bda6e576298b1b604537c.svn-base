<?php

require_once '../../setting.php';

require_once '../../templateConfig.php';

require_once '../../class/PHPMailer/class.phpmailer.php';

require_once '../../common.function.php';

$title = "忘记密码";


if (!$_POST['forgetpass']) {
    $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
    $smarty->display('user/manage/forgot-password.tpl');
} else {

// process here

    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "select * from s_user WHERE mName = '" . $username . "' and secretEmail = '" . $email . "'";
    $ret = $pdo->query($sql);
    $user_info = $ret->fetch(PDO::FETCH_ASSOC);
    $rows = $ret->rowCount();

    if ($rows != 1)
        sys_error($smarty, "您输入的用户名和安全邮箱不匹配");

    // 生成新密码

    srand();

    for ($i = 0; $i < 5; $i++) {
        // ascii中 65~90为大写字母，97~122为小写字母，48~57为数字
        $password[$i] = sprintf("%c%c%c", rand(65, 90), rand(97, 122), rand(48, 57));
    }

    $password = implode("", $password);

    $msg = "感谢您对".$authorCompany."的支持,你的新密码为:" . $password;
    // 发送新密码到安全邮箱
    $mail = new PHPMailer();

    $mail->CharSet = "UTF-8"; // 设置字符集编码，GB2312 GBK
    $mail->Encoding = "base64"; //设置文本编码方式
//    $mail->SMTPDebug = 1;
    $mail->IsSMTP(); // telling the class to use SMTP  
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.mail.yahoo.com.cn"; // SMTP server  
    $mail->Username = "shi35dong@yahoo.com.cn";
    $mail->Password = "abc654321";
//    $mail->SetFrom("1018732357@qq.com", $authorCompany);
    $mail->From = "shi35dong@yahoo.com.cn";
    $mail->FromName = $authorCompany;
    $mail->AddReplyTo("1018732357@qq.com", $authorCompany);
    $mail->Subject = "找回密码";
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test  
    $mail->MsgHTML($msg);
    $mail->AddAddress($email, $email);
    if ($mail->Send()) {
        $password = pwMcrypt($password);
        $sql = "UPDATE s_user SET mPW = '" . $password . "' WHERE mID = " . $user_info['mID'];
        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows != 1)
        // 在数据库中将密码更新为新生成的密码
            sys_error($smarty, "系统错误，请联系系统管理员");
        echo "发送成功";
    }else {
        echo "发送失败!!请点击登录<a href='" . $authorUrl . "'>".$authorCompany."</a>留言,并联系工程师为您解决";
    }
//    echo "成功";
}
?>