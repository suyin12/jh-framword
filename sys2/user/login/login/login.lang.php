<?php
/*
**	@desc:		PHP ajax login form using jQuery
**	@author:	programmer@chazzuka.com
**	@url:		http://www.chazzuka.com/blog
**	@date:		15 August 2008
**	@license:	Free!, but i'll be glad if i my name listed in the credits'
*/
//@ validate inclusion
if(!defined('VALID_ACL_')) exit('direct access is not allowed.');

$ACL_LANG = array (
		'USERNAME'			=>	'用户名',
        'MID'               =>  '用户编号',
		'EMAIL'				=>	'E-mail',
		'PASSWORD'			=>	'密码',
        'Forgot_PASSWORD'	=>	'<a href="../manage/forgot-password.php">忘记密码</a>',
		'LOGIN'				=>	'登录!',
		'SESSION_ACTIVE'	=>	'您已登录, 点击 <a href="'.SUCCESS_URL.'">这里</a> 继续访问.<script>window.location="'.SUCCESS_URL.'"</script>',
		'LOGIN_SUCCESS'		=>	'您已登录, 点击 <a href="'.SUCCESS_URL.'">这里</a> 继续访问.<script>window.location="'.SUCCESS_URL.'"</script>',
		'LOGIN_FAILED'		=>	'登录失败: 输入的信息不匹配.. '.((LOGIN_METHOD=='user'||LOGIN_METHOD=='both')?'用户名':''). 
								((LOGIN_METHOD=='both')?'/':'').
								((LOGIN_METHOD=='mid'||LOGIN_METHOD=='both')?'用户编号':'').
								' 和密码.',
	);
?>