<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h5>真的要</h5>
    <?php
        if(isset($_COOKIE['user'])){
            echo $_COOKIE['user'];
        }else{
            echo "找不到该用户";
        }
    ini_set("smtp_port",25);
    $to = "jh.su@csmall.cn";
    $subject = "Test mail";
    $message = "Hello! This is a simple email message.";
    $from = "452292741@qq.com";
    $headers = "From: $from";
    mail($to,$subject,$message,$headers);
    echo "Mail Sent.";
    ?>
</body>
</html>