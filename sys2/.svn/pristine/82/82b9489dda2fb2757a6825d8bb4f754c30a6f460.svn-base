<?php
/*
**	@desc:		PHP ajax login form using jQuery
**	@author:	programmer@chazzuka.com
**	@url:		http://www.chazzuka.com/blog
**	@date:		15 August 2008
**	@license:	Free!, but i'll be glad if i my name listed in the credits'
*/
//@ validate inclusion


if (! defined ( 'VALID_ACL_' ))
	exit ( 'direct access is not allowed.' );

class Authorization {
	
	public function check_status() {
		if (empty ( $_SESSION ['exp_user'] ) || @$_SESSION ['exp_user'] ['expires'] < time ()) {
			return false;
		} else {
			return true;
		}
	}
	
	public function form() {
		global $ACL_LANG;
		$htmlForm = '<form id="frmlogin">' . '<label>';
		switch (LOGIN_METHOD) {
			case 'both' :
				$htmlForm .= $ACL_LANG ['USERNAME'] . '/' . $ACL_LANG ['MID'];
				break;
			case 'email' :
				$htmlForm .= $ACL_LANG ['EMAIL'];
				break;
			default :
				$htmlForm .= $ACL_LANG ['USERNAME'];
				break;
		}
		$htmlForm .= ':</label>' . '<input type="text" name="u" id="u" class="textfield" />' . '<label>' . $ACL_LANG ['PASSWORD'] . '</label>' . '<input type="password" name="p" id="p" class="textfield" />' . '<input type="submit" name="btn" id="btn" class="buttonfield" value="' . $ACL_LANG ['LOGIN'] . '" />' . '&nbsp;&nbsp;&nbsp;&nbsp;<a href="../manage/forgot-password.php">Forgot Password?</a>' . '</form>';
		return $htmlForm;
	}
	
	public function signin($u, $p) {
		global $pdo;
		$return = false;
		if (USEDB) {
			if ($u && $p) {
				//这里选择用户数据表
				$sql = "SELECT * FROM  s_user WHERE ";
				switch (LOGIN_METHOD) {
					case 'both' :
						$sql .= "(mName = :userName OR mID= :mID)";
						$bindArr = array (":userName" => $u, "mID" => $u );
						break;
					case 'email' :
						$sql .= "Email= :email";
						$bindArr = array (":email" => $u );
						break;
					case 'mID' :
						$sql .= " mID= mID";
						$bindArr = array ("mID" => $u );
					default :
						$sql .= "mName= :userName";
						$bindArr = array (":userName" => $u );
						break;
				}
				$sql .= " AND mPW = '" . md5 ( $p ) . "' AND status='1'";
				
				$rs = $pdo->prepare ( $sql );
				$rs->execute ( $bindArr );
				
				if (! $rs)
					return false;
				
				if ($rs->rowCount ()) {
					$ret = $rs->fetch ( PDO::FETCH_ASSOC );
					$this->set_session ( array_merge ($ret , array ('expires' => time () + (60 * 60) ) ) );
					//同时更新其登陆时间,及其登陆相关信息
					$loginSql = "";
					$return = true;
				}
				unset ( $rs, $sql );
			}
		} else {
			$return = false;
		}
		
		return $return;
	}
	
	private function set_session($a = false) {
		if (! empty ( $a )) {
			$_SESSION ['exp_user'] = $a;
		}
	}
}
?>