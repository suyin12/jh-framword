<?php
/*
**	@desc:	PHP ajax login form using jQuery
**	@author:	programmer@chazzuka.com
**	@url:		http://www.chazzuka.com/blog
**	@date:	15 August 2008
**	@license:	Free!, but i'll be glad if i my name listed in the credits'
*/

// @ error reporting setting  (  modify as needed )
ini_set("display_errors", 1);

require_once '../../setting.php';
//连接模板文件
require_once '../../templateConfig.php';
$title="登陆窗口";


//@ if logoff
if(!empty($_GET['logoff'])) { $_SESSION = array(); }

//@ is authorized?
if(empty($_SESSION['exp_user']) || @$_SESSION['exp_user']['expires'] < time()) {
	header("location:login.php");	//@ redirect 
} else {
	$_SESSION['exp_user']['expires'] = time()+(60*60);	//@ renew 60 minutes
}
#配置 链接地址
$smarty->assign("home","http://www.cnhrmo.com");
$smarty->assign("system",httpPath);
$smarty->assign ("mName",$_SESSION['exp_user']['mName']);
#配置基础模板
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "user/login/index.tpl" );
?>

