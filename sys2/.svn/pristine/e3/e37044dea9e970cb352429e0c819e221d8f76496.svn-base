<?php
/*
**	@desc:		PHP ajax login form using jQuery
**	@author:	programmer@chazzuka.com
**	@url:		http://www.chazzuka.com/blog
**	@date:		15 August 2008
**	@license:	Free!, but i'll be glad if i my name listed in the credits'
*/

// @ error reporting setting  (  modify as needed )
ini_set ( "display_errors", 1 );
//@ validate inclusion
define ( 'VALID_ACL_', true );

//@ load dependency files
require_once ('../../setting.php');
require ('login.config.php');
require ('login.lang.php');
require ('login.class.php');

sleep ( 1 ); // do not use in production


//@ new acl instance
$acl = new Authorization ();
//@check session status 
$status = $acl->check_status ();
if ($status) {
	// @ session already active
	//		header("Location:index.php");
	$jsonArr = array ('status' => true, 'message' => $ACL_LANG ['SESSION_ACTIVE'], 'url' => SUCCESS_URL );
	$json = json_encode ( $jsonArr );
	echo $json;
	//	echo "{'status':true,'message':'" . $ACL_LANG ['SESSION_ACTIVE'] . "','url':'" . SUCCESS_URL . "'}";
} else {
	//		header("Location:index.php");
	//@ session not active
	if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
		//@ first load
		$jsonArr = array ('status' => false, 'message' => $acl->form () );
		$json = json_encode ( $jsonArr );
		echo $json;
		//		echo "{'status':'false','message':'" . $acl->form () . "'}";
	

	} else {
		//@ form submission
		$u = (! empty ( $_POST ['u'] )) ? trim ( $_POST ['u'] ) : false; // retrive user var
		$p = (! empty ( $_POST ['p'] )) ? trim ( $_POST ['p'] ) : false; // retrive password var
		

		// @ try to signin
		$is_auth = $acl->signin ( $u, $p );
		
		if ($is_auth) {
			//@ success
			$jsonArr = array ('status' => true, 'message' => $ACL_LANG ['LOGIN_SUCCESS'], 'url' => SUCCESS_URL );
			$json = json_encode ( $jsonArr );
			echo $json;
			//			echo "{'status': true,'message':'" . $ACL_LANG ['LOGIN_SUCCESS'] . "','url':'" . SUCCESS_URL . "'}";
		

		} else {
			//@ failed
			$jsonArr = array ('status' => false, 'message' => $ACL_LANG ['LOGIN_FAILED']);
			$json = json_encode ( $jsonArr );
			echo $json;
//			echo "{'status': false,'message':'" . $ACL_LANG ['LOGIN_FAILED'] . "'}";
		}
	}
}

//@ destroy instance
unset ( $acl );
?>