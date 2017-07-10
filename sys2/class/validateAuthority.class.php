<?php
/*
 * 判断页面操作权限类
 */
class authority {
	public $pdo;
	public $functionStr_URL; //url地址中的 "操作功能"	
	

	/**获取页面地址中在数据库对应的ID*/
	private function getUrlID() {
		$pdo = $this->pdo;
		$thisPageUrl = $this->functionStr_URL;
		//  ID>15 跳过父菜单
		$sql = "select Fun_ID as ID from `s_function` where Fun_code like '$thisPageUrl' and `Fun_ID`>15";
		$ret = SQL ( $pdo, $sql, null, 'one' );
		return $ID = $ret ['ID'];
	}
	
	#验证是否有权限访问
	public function validAccess() {
		$pdo = $this->pdo;
		$ID = $this->getUrlID ();
		if ($ID) {
			#连接角色类
			require_once sysPath . 'dataFunction/user.data.php';
			//若在数据库中有登记,则验证其有无访问权限
			$mID = $_SESSION ['exp_user'] ['mID'];
			$user = new user ();
			$user->pdo = $pdo;
			$user->userBasic ( 'mID,roleID,Function_ID_STR  as userAllowStr', "`mID`=$mID" );
			$user->roleRelation ( ' Function_ID_STR  as roleAllowStr ' );
			$userAccessArr = $user->userAccessArr ();
			in_array ( $ID, $userAccessArr [$mID]['allow'] ) ? $pass = true : $pass = false;
			return $pass;
		} else {
			//未在数据库中定义的页面可访问
			return true;
		}
	}
}

?>