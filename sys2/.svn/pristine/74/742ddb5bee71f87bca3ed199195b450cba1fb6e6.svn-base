<?php
/*
*       2012-8-9
*       <<<  系统用户相关的操作  >>>
*       create by Great sToNe
*       have fun,.....
*/
class user {
	public $pdo;
	public $userArr; //array 用户的基本信息
	public $roleRelation; //以mID为KEY的用户角色数组

    #
    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

	#用户的基本信息表
	public function userBasic($selStr = " * ", $conStr = " status='1' ") {
		$pdo = $this->pdo;
		$sql = " select $selStr from s_user where $conStr ";
		$ret = SQL ( $pdo, $sql );
		$ret = keyArray ( $ret, "mID" );
        return $this->userArr = $ret;
	}
	#用户角色列表相关
	public function roleRelation($selStr = " * ", $conStr = null) {
		$pdo = $this->pdo;
		$userArr = $this->userArr;
		foreach ( $userArr as $key => $val ) {
			$roleIDStr = "'" . implode ( "','", (array_filter ( explode ( ",", $val ['roleID'] ) )) ) . "'";
			$conStr = $conStr ? $conStr : "`roleID` in ($roleIDStr)";
			$sql = "select $selStr from `s_role` where $conStr";
			$ret [$key] = SQL ( $pdo, $sql );
		}
		#重置多个roleID的user相关的权限设置
		foreach ( $ret as $rKey => $rVal ) {
			foreach ( $rVal as $rv ) {
				$roleAllowStrArr = array_filter ( explode ( ",", $rv ['roleAllowStr'] ) );
				foreach ( $roleAllowStrArr as $rav ) {
					$rav > 0 ? $ret [$rKey] ['allow'] [] = $rav : $ret [$rKey] ['ban'] [] = abs ( $rav );
				}
			}
		}
		return $this->roleRelation = $ret;
	}
	#用户的访问权限相关获取访问列表的权限及
	public function userAccessArr() {
		$userArr = $this->userArr;
		$roleRelation = $this->roleRelation;
		foreach ( $userArr as $key => $val ) {
			$allowStrArr = array_filter ( explode ( ",", $val ['userAllowStr'] ) );
			foreach ( $allowStrArr as $rav ) {
				$rav > 0 ? $allowArr [] = $rav : $banArr [] = abs ( $rav );
			}
			// 1. 验证是否在s_user表内有无定义访问权限,若未定义则以s_role表中设置的为准
			$allow = $allowArr ? $allowArr : $roleRelation [$key] ['allow'];
			$ban = $banArr ? $banArr : $roleRelation [$key] ['ban'];
			$userAccessArr [$key] = array (
					"allow" => $allow,
					"ban" => $ban 
			);
		}
		return $userAccessArr;
	}
}
?>