<?php

namespace Addons\Paiqian\Controller;

use Home\Controller\AddonsController;

class WapController extends AddonsController {
	var $dao;
	function _initialize() {
		$this->dao = D ( 'Paiqian' );
		
		$guest = array (
				'index',
				'newsDetail',
				'newsIndex',
				'register',
				'login' 
		);
		$mobile = getUserInfo ( $this->mid, 'mobile' );
	}
	
	// 首页
	function index() {
		// 幻灯片
	    
	    //dump($openid);exit;
		$map ['token'] = get_token ();
		$slideshow = M ( 'paiqian_slideshow' )->where ( $map )->order ( 'sort asc, id desc' )->select ();
		foreach ( $slideshow as &$vo ) {
			$vo ['img'] = get_cover_url ( $vo ['img'] );
		}
		$this->assign ( 'slideshow', $slideshow );
		
		// 最新资讯
		$map ['is_index'] = 1;
		$news = M ( 'paiqian_news' )->where ( $map )->order ( 'id desc' )->limit ( 3 )->select ();
		$this->assign ( 'news', $news );
		
		// 邀请日志
		$invite_code = I ( 'invite_code' );
		$invite_uid = I ( 'invite_uid' );
		$this->_invite_log ( $invite_code, $invite_uid );
		
		$this->display ();
	}
	private function _invite_log($invite_code = '', $invite_uid = 0) {
		$invite_uid == 0 && $invite_uid = intval ( session ( 'paiqian_invite_uid' ) );
		if (! empty ( $invite_code ) && $invite_uid == 0) {
			$umap ['invite_code'] = $invite_code;
			$invite_uid = M ( 'user' )->where ( $umap )->getField ( 'uid' );
		}
		if ($invite_uid > 0 && $this->mid < 0) {
			// 当前用户未登录情况下先保存到session里，登录后再写入表中
			session ( 'paiqian_invite_uid', $invite_uid );
		} else if ($invite_uid > 0 && $this->mid > 0 && $invite_uid != $this->mid) {
			$data ['invite_uid'] = $invite_uid;
			$data ['uid'] = $this->mid;
			if (M ( 'paiqian_invite_log' )->where ( $data )->getField ( 'id' )) {
				M ( 'paiqian_invite_log' )->setField ( 'cTime', NOW_TIME );
			} else {
				$data ['cTime'] = NOW_TIME;
				M ( 'paiqian_invite_log' )->add ( $data );
			}
		}
	}
	/**
	 * ******************注册与登录******************
	 */
	// 注册
	function register() {
		if (IS_POST) {
			$invite_code = I ( 'invite_code' );
			$this->_invite_log ( $invite_code );
			$number =I ( 'mobile' );
			 $msg ='';
			 $res =$this->mobileNumValid($number);
			// addWeixinLog($msg,'5555777777');
			 if($res != ''){
			 	//addWeixinLog($msg,'5555555555');
			 	$msg =$res;
			 	exit($msg) ;
			 	
			 }
			 //addWeixinLog($err,'5555555555');
			
			$data ['mobile'] = $number;
			$data ['password'] = think_weiphp_md5 ( I ( 'password' ) );
			//dump($this->mid);exit;
			$openid =get_openid();
			
			if ($openid != -1) {
				$map['token'] =get_token();
				$map['openid'] =$openid;
				$uid =M('public_follow')->where($map)->getField('uid');
				D ( 'Common/User' )->updateInfo ( $uid, $data );
				
			} else {
				$username = I ( 'mobile' );
				$password = I ( 'password' );
				$uid = D ( 'Common/User' )->login ( $username, $password, 'wap_login', 3 );
				if ($uid > 0) {
					redirect ( U ( 'index' ) );
				}
				
				$config = getAddonConfig ( 'UserCenter' );
				
				$user = array (
						'nickname' => $data ['mobile'],
						'experience' => intval ( $config ['experience'] ),
						'score' => intval ( $config ['score'] ),
						
						'reg_ip' => get_client_ip ( 1 ),
						'reg_time' => NOW_TIME,
						'last_login_ip' => get_client_ip ( 1 ),
						'last_login_time' => NOW_TIME,
						'invite_code' => D ( 'Common/Follow' )->makeInviteCode (),
						
						'status' => 1,
						'is_init' => 1,
						'is_audit' => 1,
						'come_from' => 1 
				);
				
				$user = array_merge ( $user, $data );
				$uid = D ( 'Common/User' )->add ( $user );
				
				$uid > 0 && session ( 'mid', $uid );
			}
			
			exit ( $msg );
		}
		$this->display ();
	}
	//验证手机号
	function mobileNumValid($num)
	{   
		$msg ='';
		$re =preg_match('#^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^18[0-9]\d{8}$#', $num) ;
		if($re ==false){
			$msg ='手机号码出错';
		}else{
		$map['mobile'] =$num;
// 		$map1['token'] =get_token();
// 		$rest =M('public_follow')->where($map1)->getField('uid',true);
// 		$map['uid'] =array('in',$rest);
// 		$ans =D('Common/User')->where($map)->getField('mobile',true);
// 		if(in_array($num,$ans)){
// 			$msg ='该手机号已经注册过';
// 		}
		$ans =D('Common/User')->where($map)->select();
		if($ans){
			$msg ='该手机号已经注册过';
		}
		}
		return $msg;
	}
	// 登录 TODO
	function login() {
		if (IS_POST) {
			$username = I ( 'mobile' );
			$password = I ( 'password' );
			$res = D ( 'Common/User' )->login ( $username, $password, 'wap_login', 3 );
			if ($res > 0) {
				redirect ( U ( 'index' ) );
			} else {
				$this->error ( D ( 'Common/User' )->getError () );
			}
		} else {
			$this->display ();
		}
	}
	/**
	 * ******************申缴相关******************
	 */
	// 有参保人信息跳转
	function helpAddPerson() {
		//$status = I ( 'status', 5, 'intval' );
		$list = $this->dao->personLists ( $this->mid, 5 );
 		//dump ( $list );
		if ($list ['result'] != 1) {
			$url = U ( "addPerson" );
		} else {
			$url = U ( 'personList', array (
					'status' => 5 
			) );
		}
		$this->assign ( "url", $url );
		$this->display();
	}
	// 新增/编辑参保人
	function addPerson() {
		$fID = I ( 'fID', 0, 'intval' );
		if ($fID > 0) {
			$info = $this->dao->agentUserDetail ( $fID );
			$this->assign ( 'info', $info );
		}
		
		if (IS_POST) {
			$res = $this->dao->agentUserEdit ( $this->mid, $_POST, $fID );
			
			if ($res ['status'] == 0 || $res ['result'] == 0) {
				// $this->error ( $res ['msg']);
				$data ['info'] = $res ['msg'];
				$data ['status'] = 0;
				$data ['url'] = '';
				$this->ajaxReturn ( $data );
			} else {
				// $this->success ( '操作成功', U ( 'personList' ) );
				$data ['info'] = '操作成功';
				$data ['status'] = 1;
				
				$status = $info ['stopping'] == 1 ? 2 : 5;
				$data ['url'] = U ( 'personList', array (
						'status' => $status 
				) );
				
				$this->ajaxReturn ( $data );
			}
		} else {
			
			$config = $this->dao->getConfigData ();
			$this->assign ( 'json', $config ['cityJson'] );
			// exit ();
			$this->assign ( 'fID', $fID );
			$this->display ();
		}
	}
	function agentUserRenew() {
		$fID = I ( 'fID' );
		if (empty ( $fID )) {
			$param ['fIDArr'] = I ( 'fIDs' );
		} else {
			$param ['fIDArr'] [] = $fID;
		}
		if (empty ( $param ['fIDArr'] )) {
			$this->error ( '请选择参保人' );
		}
		$this->dao->agentUserRenew ( $param );
		$url = U ( 'personList', array (
				'status' => 2 
		) );
		if ($fID) {
			redirect ( $url );
		} else {
			$this->success ( '操作成功', $url );
		}
	}
	// 申缴-参保人列表
	function personList() {
		$status = I ( 'status', 5, 'intval' );
		$list = $this->dao->personLists ( $this->mid, $status );
		$this->assign ( 'list_data', $list ['data'] );
		// dump($list ['data']);
		$this->display ();
	}
	// 申缴-删除参保人
	function personDel() {
		$res = $this->dao->agentUserDel ( I ( 'fID' ) );
		$this->ajaxReturn ( $res );
	}
	// 申缴-参保人详情
	function personDetail() {
		$info = $this->dao->agentUserDetail ( I ( 'fID' ) );
		$this->assign ( 'info', $info );
		
		$this->display ();
	}
	// 申缴-结算-生成订单
	function createOrder() {
		$fIDs = I ( 'fIDs' );
		$total = I ( 'total' );
		
		$res = $this->dao->createOrder ( $this->mid, $fIDs, $total );
		
		if ($res ['status'] == 0 || $res ['result'] == 0) {
			$this->error ( $res ['msg'], true );
		} else {
			$param ['orderID'] = $res ['orderID'];
			
			$url = U ( 'agreement', $param );
			$this->success ( '生成订单成功', $url, true );
		}
	}
	// 基本设置
	function baseSetting() {
		if (IS_POST) {
			$info = $this->dao->agentUserMoney ( $_POST );
			$this->ajaxReturn ( $info ['data'] );
		} else {
			$info = $this->dao->agentUserDetail ( I ( 'fID' ) );
			// dump ( $info );
			// exit ();
			$this->assign ( 'info', $info );
			
			$data = $this->dao->counterPer ();
			$this->assign ( 'data', $data );
			// dump ( $data );
			$config = $this->dao->getConfigData ( '', $info ['city'] . ',' . $info ['cityInsurance'] );
			$this->assign ( 'programmeList', $config ['programme'] );
			$this->assign ( 'json', $config ['cityJson'] );
			// dump ( $config );
			// exit ();
			$from = I ( 'from' );
			if ($from) {
				Cookie ( '__forward__', U ( $from ) );
			}
			
			$this->display ();
		}
	}
	// 保存设置
	function saveBaseSetting() {
		$_POST ['soInsurance'] = $_POST ['soInsurance'] ?  : "0";
		$_POST ['housingFund'] = $_POST ['housingFund'] ?  : "0";
		
		$res = $this->dao->agentUserData ( $_POST );
		// dump($_POST);
		if ($res ['status'] == 0) {
			$this->error ( $res ['msg'] );
		} else {
			// $url = Cookie ( '__forward__' );
			// if ($url) {
			// Cookie ( '__forward__', null );
			// } else {
			$url = U ( 'personList', array (
					'status' => $_POST ['status'] 
			) );
			// }
			$this->success ( '保存成功', $url );
		}
	}
	// 确定申缴-选择支付方式
	function choosePayType() {
		$orderID = I ( 'orderID' );
		$info = $this->dao->getOrderDetail ( $orderID );
		$this->assign ( 'info', $info );
		// dump ( $info );
		// exit ();
		$payUrl = addons_url ( 'Payment://Alipay/pay', array (
				'from' => 'Paiqian:__Wap_payOk',
				'orderName' => urlencode ( '申缴支付' ),
				'price' => $info ['total'],
				'token' => get_token (),
				'wecha_id' => get_openid (),
// 				'paytype' => 0,
				'orderNumber' => $orderID 
		) );
		$this->assign ( 'payUrl', $payUrl );
		
		$this->display ();
	}
	// 确认代理协议
	function agreement() {
		$this->display ();
	}
	// 支付方式说明
	function payIntroduce() {
		$this->display ();
	}
	// 支付完成
	function payOk() {
		$this->display ();
	}
	/* 参保人列表 */
	function userList() {
		$status = I ( 'status', '1' );
		$list = $this->dao->agentUserLists ( $this->mid, $status );
		$this->assign ( 'list_data', $list ['data'] );
		
		$this->display ();
	}
	/**
	 * ******************停缴相关******************
	 */
	// 停缴首页
	function stopIndex() {
		$status = I ( 'status', '1' );
		$list = $this->dao->agentUserLists ( $this->mid, $status );
		$this->assign ( 'list_data', $list ['data'] );
		// 社保封帐前3天可以申请本月停缴
		$config = $this->dao->getConfigData ();
		$today = date ( "d" ) + 2;
		$inTurn = $config ['insuranceInTurn'] ['soInsInTurn'];
		if ($today < $inTurn) {
			$stopMonth = date ( "Y-m" );
		} else {
			$stopMonth = date ( "Y-m", strtotime ( "+1 months" ) );
		}
		$this->assign ( 'stopMonth', $stopMonth );
		$this->display ();
	}
	// 停缴参保人详情
	function userDetail() {
		$info = $this->dao->agentUserDetail ( I ( 'fID' ) );
		$this->assign ( 'info', $info );
		$config = $this->dao->getConfigData ();
		$today = date ( "d" ) + 2;
		$inTurn = $config ['insuranceInTurn'] ['soInsInTurn'];
		if ($today < $inTurn) {
			$stopMonth = date ( "Y-m" );
		} else {
			$stopMonth = date ( "Y-m", strtotime ( "+1 months" ) );
		}
		$this->assign ( 'stopMonth', $stopMonth );
		$this->display ();
	}
	function stopDeal() {
		$type = I ( 'type' );
		$fID = I ( 'fID' );
		if (empty ( $fID )) {
			$param ['fIDArr'] = I ( 'fIDs' );
		} else {
			$param ['fIDArr'] [] = $fID;
		}
		if ($type == 1) {
			$arr ['userID'] = $this->mid;
			$arr ['stopMonth'] = I ( 'stopMonth' );
			$arr ['soIns'] = I ( 'soIns' );
			$arr ['HF'] = I ( 'HF' );
			foreach ( $param ['fIDArr'] as $fID ) {
				$arr ['fID'] = $fID;
				$param2 [$fID] = $arr;
			}
			$res = $this->dao->agentUserStop ( $param2 );
		} else {
			$res = $this->dao->agentUserCancelStop ( $param );
		}
		// dump ( $res );
		$this->ajaxReturn ( $res );
	}
	// 参保记录
	function recordList() {
		$fID = I ( 'fID', 0, 'intval' );
		$page = I ( 'p', 1, 'intval' );
		$row = 20;
		$list = $this->dao->agentUserPersonalRecord ( $fID, $page, $row );
		$this->assign ( 'list_data', $list ['data'] );
		
		// 分页
		if ($list ['count'] > $row) {
			$page = new \Think\Page ( $list ['count'], $row );
			$page->setConfig ( 'theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%' );
			$list_data ['_page'] = $page->show ();
		}
		
		$this->display ();
	}
	// 停缴退款
	function stopRefund() {
		if (IS_POST) {
			$res = $this->dao->postBank ( $this->mid, $_POST );
			if ($res ['status'] == 0 || $res ['result'] == 0) {
				$this->error ( $res ['msg'] );
			} else {
				$this->success ( '', U ( 'stopOk' ) );
			}
		} else {
			$config = $this->dao->getConfigData ();
			$this->assign ( 'banks', $config ['bank'] );
			
			// 获取预计退款
			$res = $this->dao->getBankInfo ( $this->mid );
			$this->assign ( 'info', $res ['data'] );
			
			$this->display ();
		}
	}
	// 停缴完成
	function stopOk() {
		$this->display ();
	}
	/**
	 * ******************订单相关******************
	 */
	// 订单首页
	function orderIndex() {
		$status = I ( 'status', '-1', 'intval' );
		$this->assign ( 'cur_' . (1000 - $status), 'cur' );
		$this->assign ( 'status', $status );
		
		$list = $this->dao->getOrderLists ( $this->mid, $status );
		$this->assign ( 'list_data', $list ['data'] );
		$this->display ();
	}
	// 订单详情
	function orderDetail() {
		$orderID = I ( 'orderID' );
		$info = $this->dao->getOrderDetail ( $orderID );
		// dump ( $info );
		// exit ();
		$this->assign ( 'info', $info );
		
		// 获取取消理由
		$reason_list = $this->dao->getConfigData ( 'orderCancelReason' );
		$this->assign ( 'reason_list', $reason_list );
		
		$this->display ();
	}
	// 退款详情
	function refundDetail() {
		$orderID = I ( 'orderID' );
		$info = $this->dao->refundDetail ( $orderID );
		// dump ( $info );exit;
		// exit ();
		$this->assign ( 'info', $info );
		
		// 获取取消理由
		$reason_list = $this->dao->getConfigData ( 'orderCancelReason' );
		$this->assign ( 'reason_list', $reason_list );
		
		$this->display ();
	}
	//取消退款
	function refundCancel(){
		$orderID = I('orderID');
		//dump(111);
		$res = $this->dao->refundCancel ( $orderID );
		if($res){
			$this->error ( $res ['msg'] );
		}else{
			$this->success ('取消成功',U('orderIndex',array('status'=>99)));
		}
	}
	// 取消订单
	function orderCancel() {
		$orderID = I ( 'orderID' );
		$msgID = I ( 'msgID' );
		$res = $this->dao->delOrder ( $orderID, $msgID );
		if ($res) {
			$this->error ( $res ['msg'] );
		} else {
			$this->success ( '取消成功', U ( 'orderIndex' ) );
		}
	}
	/**
	 * ******************资讯相关******************
	 */
	// 资讯首页
	function newsIndex() {
		$cate_id = I ( 'cate_id', 0, 'intval' );
		// 分类
		$map ['token'] = get_token ();
		$map ['is_show'] = 1;
		$list = M ( 'paiqian_category' )->where ( $map )->order ( 'sort asc,id asc' )->getFields ( 'id,title' );
		$this->assign ( 'category_list', $list );
		
		if ($cate_id == 0) {
			$this->assign ( 'cate_title', '全部资讯' );
		} else {
			$map2 ['cate_id'] = $cate_id;
			$this->assign ( 'cate_title', $list [$cate_id] );
		}
		
		// 资讯列表
		$list = M ( 'paiqian_news' )->where ( $map2 )->field ( 'id,title,intro,cover,cTime' )->selectPage ();
		$this->assign ( $list );
		// dump ( $list );
		
		$this->display ();
	}
	// 资讯详情
	function newsDetail() {
		$map ['id'] = I ( 'id' );
		$info = M ( 'paiqian_news' )->where ( $map )->find ();
		$this->assign ( 'info', $info );
		
		// 保存浏览量
		M ( 'paiqian_news' )->where ( $map )->setField ( 'view_count', $info ['view_count'] + 1 );
		
		$this->display ();
	}
	/**
	 * ******************个人中心******************
	 */
	// 个人中心
	function userCenter() {
		//$openid =get_openid();
		//判断用户是否已经注册过
// 		$map['openid'] =get_openid();
// 		$where['unionid'] = D('Common/User')->where($map)->getField('unionid');
// 		$where['mobile'] =array('neq',null);
// 		//dump($mobile);exit;
// 		$mobile =M('user')->where($where)->getField('mobile');
// 		$this->assign('mobile',$mobile);
		$this->display ();
	}
	// 客服
	function service() {
		$this->display ();
	}
	// 分享推荐
	function share() {
		$list = M ( 'user' )->field ( 'uid' )->select ();
		foreach ( $list as $vo ) {
			$map ['uid'] = $vo ['uid'];
			M ( 'user' )->where ( $map )->setField ( 'invite_code', uniqid () );
		}
		$this->display ();
	}
	// 邀请记录
	function inviteLog() {
		$map ['invite_uid'] = $this->mid;
		$list = M ( 'paiqian_invite_log' )->where ( $map )->order ( 'cTime desc' )->selectPage ();
		$this->assign ( $list );
		
		$this->display ();
	}
	// 消息列表
	function message() {
		$list = $this->dao->messageList ( $this->mid );
		$this->assign ( 'list_data', $list ['data'] );
		
		$this->display ();
	}
	// 测算
	function calculate() {
		$info = $this->dao->counterPer ();
		$this->assign ( 'info', $info );
		
		$config = $this->dao->getConfigData ();
		$this->assign ( 'json', $config ['cityJson'] );
		
		$this->display ();
	}
	function counterResult() {
		$info = $this->dao->counterResult ( $_POST );
		$this->ajaxReturn ( $info );
	}
	
	// 帮助说明等的静态HTML文件
	function help() {
		$tpl = I ( 'tpl' );
		$this->display ( $tpl );
	}
	
	// 流水
	function userAccount() {
		$list = $this->dao->agentUserBill ( $this->mid );
		
		// dump ( $list );
		
		$this->assign ( 'list', $list );
		$this->display ();
	}
	
	
}
