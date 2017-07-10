<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="{$httpPath}css/login.css" rel="stylesheet" media="all" />
        <title>{$title}</title>
    </head>
    <body> 
        <div id="wrapper">
            <h3>欢迎,{$mName}</h3>
            <p>您已经成功登陆,请选择下方链接进行访问... </p>

            <a href="index.php?logoff=1" >退出系统</a> |            
            <a href="{$system}" >进入派遣系统</a> |
            <a href="{$httpPath}user/manage/changeUserInfo.php" >修改密码</a> 
        </div>
        
    </body>
</html>