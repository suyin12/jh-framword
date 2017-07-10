<?php
/*
**	@desc:		PHP ajax login form using jQuery
**	@author:	programmer@chazzuka.com
**	@url:		http://www.chazzuka.com/blog
**	@date:		15 August 2008
**	@license:	Free!, but i'll be glad if i my name listed in the credits'
*/
require  "../wConfig.php";

$wConfig = new wConfig ();
$loginArr = $wConfig->loginConfig();
//@ validate inclusion
if (! defined ( 'VALID_ACL_' ))
	exit ( 'direct access is not allowed.' );
//
define ( 'USEDB', true ); //@ use database? true:false
//
define ( 'LOGIN_METHOD', 'mName' );
//if(empty($_SESSION['historyUrl']))	{		
define ( 'SUCCESS_URL', $loginArr['index'] );
//
define ( 'LOGIN_Table', $loginArr['table'] );
//
define ('SESSION_NAME',$loginArr['sessionName']);
//
define ('PATH_PRE',$loginArr['path_pre']);
unset($loginArr);
//}
//else{
//define('SUCCESS_URL',	$_SESSION['historyUrl']);
//}
?>