<?php

/**
 * 权限验证
 * <<<初步想法为,第一次判断是否是系统用户,接着判断用户可以访问当前页面,如果可以访问,就继续执行不做返回,如果不能访问则返回出错处理>>>
 * 
 * 
*       create by Great sToNe
*       have fun,.....
*       
*       email:  shi35dong@gmail.com
 */
if (realpath ( __FILE__ ) == realpath ( $_SERVER ['SCRIPT_FILENAME'] )) {
	exit ( '禁止访问' );
}
require_once 'setting.php';
require_once 'common.function.php';
require_once sysPath . 'dataFunction/error.data.php';

#
if (empty ( $_SESSION ['exp_user'] ) || @$_SESSION ['exp_user'] ['expires'] < time ()) {
	header ( "location:" . httpPath . "user/login/login.php" ); //@ redirect
} else {
	$error_class = new error ();
	$error_class->pdo = $pdo;
	#链接柳悟服务器验证
	if (! $_SESSION ['access'])
		exit ( '非法访问,无法通过服务器验证!!' );
	$_SESSION ['exp_user'] ['expires'] = time () + (60 * 60); //@ renew 60 minutes
	#验证是否满足访问条件
	$error_class->validPageAccess ();
	#验证是否满足修改条件
	#验证页面中需要是否需要审批流程
	#验证审批流程的类型是否需要审批
	$sql = "select * from `s_approvalPro_set` where `status`='1'";
	$ret = SQL ( $pdo, $sql );
	$appRet = keyArray ( $ret, "type" );
	unset ( $sql, $ret );
	#合并各个验证状态
	$authArr = array (
			"approval" => $appRet 
	);
	unset ( $error_class );
}
?>