<!---

  作者:  sToNe

  Email: shi35dong@gmail.com

  QQ: 1018732357
  --->

<!DOCTYPE html>
<html>
<head>
{config_load file="htmlSet.conf"}
    <meta http-equiv="Content-Type" content=text/html; charset='{#charset#}'/>
    <!-- mobile viewport optimisation -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{$httpPath}theme/css/customs.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 7]>
    <link href="{$httpPath}theme/css/yaml/core/iehacks.min.css" rel="stylesheet" type="text/css">
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="{$httpPath}/theme/lib/js/html5shiv.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{$httpPath}favicon.ico" mce_href="{$httpPath}favicon.ico" type="image/x-icon">
    <title>{$title|default:"员工服务窗口"}</title>
    <script type="text/javascript" src="{$httpPath}/theme/lib/jquery/jquery-1.9.1.min.js"></script>
</head>
<body>
<!--加载页面-->
<![if !IE]>
<div id='loading'></div>
<![endif]>
<ul class="ym-skiplinks">
    <li><a class="ym-skip" href="#nav">跳转至导航栏</a></li>
    <li><a class="ym-skip" href="#main">跳转至内容页</a></li>
</ul>
<header>
    <div class="ym-wrapper">
        <div class="ym-wbox">
            <h1>员工服务窗口</h1>
        </div>
    </div>
</header>
<nav id="nav">
    <div class="ym-wrapper">
        <div class="ym-hlist">
            <ul>
                <li><a href="{$httpPath}w/match.php">首页</a></li>
                <li><a href="{$httpPath}w/wInput.php">个人信息登记</a></li>
                <li><a href="{$httpPath}w/wPrint.php">个人信息打印</a></li>
            </ul>
            <form class="ym-searchform">
                <ul>
                    <li><strong>{$smarty.session.web_worker.name}</strong></li>
                    <li><a href="{$httpPath}w/changeUserInfo.php">修改密码</a></li>
                    <li><a href="{$httpPath}w/login/index.php?logoff=1">退出系统</a></li>
                </ul>
            </form>
        </div>
    </div>
</nav>


