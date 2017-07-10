<?php

namespace Common\Model;

use Think\Model;

/**
 * 粉丝操作
 */
class FollowModel extends Model {
	protected $tableName = 'user';
	function init_follow($openid, $token = '', $has_subscribe = false) {
		empty ( $token ) && $token = get_token ();
		//addWeixinLog($token,'test1');
		//addWeixinLog($openid,'test2');
		
		if (empty ( $openid ) || $openid == - 1 || empty ( $token ) || $token == - 1)
		{
			return false;
		}
		
		$data ['token'] = $token;
		$data ['openid'] = $openid;
		$datas = $data;
		$uid = M ( 'public_follow' )->where ( $data )->getField ( 'uid' );
		//addWeixinLog($uid,'test3');
		if ($uid) {
			return $uid;
		}
		
		// 自动注册
		$config = getAddonConfig ( 'UserCenter', $token );
		
		$user = array (
				'experience' => intval ( $config ['experience'] ),
				'score' => intval ( $config ['score'] ),
				
				'reg_ip' => get_client_ip ( 1 ),
				'reg_time' => NOW_TIME,
				'last_login_ip' => get_client_ip ( 1 ),
				'last_login_time' => NOW_TIME,
				'invite_code' => $this->makeInviteCode (),
				
				'status' => 1,
				'is_init' => 1,
				'is_audit' => 1,
				'come_from' => 1 
		);
		$user2 = getWeixinUserInfo ( $openid );
		
		$user = array_merge ( $user, $user2 );
		
		$map['unionid'] =$user['unionid'];
		$res=D('Common/user')->where($map)->getField('uid');
		//addWeixinLog($res,'test1234');
		if($res){
			$data['uid'] =$uid =$res;
		}else{
		$data ['uid']  = $uid=D ( 'Common/User' )->add ( $user );
 	}
		if ($has_subscribe !== false) {
			$data ['has_subscribe'] = $has_subscribe;
		}
		M ( 'public_follow' )->add ( $data );
		
		return $uid;
	}
	// 生成邀请码
	function makeInviteCode() {
		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$leter1 = rand ( 0, 35 );
		$leter2 = rand ( 0, 35 );
		$leter3 = rand ( 0, 35 );
		$leter4 = rand ( 0, 35 );
		$leter5 = rand ( 0, 35 );
		
		$code = $str [$leter1] . $str [$leter2] . $str [$leter3] . $str [$leter4] . $str [$leter5];
		
		$map ['invite_code'] = $code;
		$uid = M ( 'user' )->where ( $map )->getField ( 'uid' );
		if ($uid > 0) {
			return $this->makeInviteCode ();
		} else {
			return $code;
		}
	}
	
	/**
	 * 兼容旧的写法
	 */
	public function getFollowInfo($id, $update = false) {
		return D ( 'Common/User' )->getUserInfo ( $id, $update );
	}
	function update($id, $data) {
		return D ( 'Common/User' )->updateInfo ( $id, $data );
	}
	function updateByMap($map, $data) {
		return false; // 已停用该方法
	}
	function updateField($id, $field, $val) {
		return D ( 'Common/User' )->updateInfo ( $id, array (
				$field => $val 
		) );
	}
	function set_subscribe($user_id, $has_subscribe = 1) {
		if (is_numeric ( $user_id )) {
			$map ['uid'] = $user_id;
		} else {
			$map ['openid'] = $user_id;
		}
		if ($token && $token != '-1') {
			$map ['token'] = $token;
		}
		
		M ( 'public_follow' )->where ( $map )->setField ( 'has_subscribe', $has_subscribe );
	}
}
?>
