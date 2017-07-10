<?php

namespace Addons\Paiqian\Model;

use Think\Model;

/**
 * Paiqian模型
 */
class PaiqianModel extends Model {
	var $tableName = 'user';
	
	// **************************** 获取系统配置数据 ********************************************//
	function getConfigData($field = '', $default = "'0755','2'") {
		$data = agentDataByPost ( 'agentBasicSet' );
		
		$json = '';
		foreach ( $data ['data'] ['activeCity'] as $city => $vo ) {
			$json .= "{v:'{$city}',t:'{$vo[title]}',d:[";
			foreach ( $vo ['cityInsurance'] as $v => $t ) {
				$json .= "{v:'{$v}',t:'{$t}'},";
			}
			$json = rtrim ( $json, ',' ) . ']},';
		}
		$json = rtrim ( $json, ',' );
		
		$data ['data'] ['cityJson'] = "{selectIds:['city','cityInsurance'],default:[{$default}],'json':[" . $json . "]}";
		
		foreach ( $data ['data'] ['bankInitArr'] as $vv ) {
			$data ['data'] ['bank'] [$vv ['ID']] = $vv ['name'];
		}
		
		return empty ( $field ) ? $data ['data'] : $data ['data'] [$field];
	}
	
	// **************************** 参保人操作 ********************************************//
	
	// 新增、编辑参保人信息
	function agentUserEdit($uid, $post, $fID = 0) {
		$param ['userID'] = $uid;
		
		$param ['name'] = safe ( $post ['name'] ); // 姓名
		$param ['mobilePhone'] = safe ( $post ['mobilePhone'] ); // 手机号
		$param ['pID'] = safe ( $post ['pID'] ); // 身份证号
		$param ['pIDImgUrl'] = get_cover ( $post ['pIDImgUrl_1'], 'path' ) . ',' . get_cover ( $post ['pIDImgUrl_2'], 'path' ); // 身份证照片
		$param ['city'] = safe ( $post ['city'] ); // 城市
		$param ['cityInsurance'] = safe ( $post ['cityInsurance'] ); // 参保类型
		$param ['lastModifyTime'] = date ( 'Y-m-d H:i:s' );
		
		if (empty ( $fID )) {
			$model = 'agentUserAdd';
		} else {
			$param ['fID'] = $fID;
			$model = 'agentUserEdit';
		}
		// dump ( $param );
		$res = agentDataByPost ( $model, $param );
		return $res;
	}
	// 删除某个参保人
	function agentUserDel($fID) {
		$param ['fID'] = $fID;
		$res = agentDataByPost ( 'agentUserDel', $param );
		return $res;
	}
	// 我的参保人列表
	function agentUserLists($uid, $status = 1) {
		$param ['userID'] = $uid;
		$param ['status'] = $status;
		$lists = agentDataByPost ( 'agentUserLists', $param );
		// dump ( $lists );
		$config = $this->getConfigData ();
		foreach ( $lists ['data'] as &$vo ) {
			$vo ['city_title'] = $config ['activeCity'] [$vo ['city']] ['title'];
			$vo ['cityInsurance_title'] = $config ['activeCity'] [$vo ['city']] ['cityInsurance'] [$vo ['cityInsurance']];
		}
		
		return $lists;
		
		// 先直接返回测试数据 状态名称使用getConfigData方法获取，对应的key是status
		return array (
				0 => array (
						'fID' => '1',
						'userID' => 1,
						'name' => '韦小宝',
						'pID' => '11111',
						'city' => '0775',
						'cityInsurance' => 0,
						'status' => 0,
						'soInsBeginMonth' => '201509', // 社保起缴月份
						'HFBeginMonth' => '201509', // 公积金起缴月份
						'soInsNeedMonthNum' => '3', // 社保购买月数
						'HFNeedMonthNum' => '3',
						'soInsFun' => array (
								'total' 
						), // 社保费
						'HFFun' => array (
								'total' 
						), // 公积金费
						'mCostFun' => array (
								'total' 
						) 
				), // 服务费
				1 => array (
						'fID' => '2',
						'userID' => 1,
						'name' => '韦小宝2',
						'pID' => '11111',
						'city' => '0775',
						'cityInsurance' => 0,
						'status' => 0,
						'soInsBeginMonth' => '201509', // 社保起缴月份
						'HFBeginMonth' => '201509', // 公积金起缴月份
						'soInsNeedMonthNum' => '3', // 社保购买月数
						'HFNeedMonthNum' => '3',
						'soInsFun' => '300', // 社保费
						'HFFun' => '200', // 公积金费
						'mCostFun' => '100' 
				) 
		);
	}
	// 参保人详情接口
	function agentUserDetail($fID) {
		$config = $this->getConfigData ();
		
		$param ['fID'] = $fID;
		$res = agentDataByPost ( 'agentUserDetail', $param );
		// dump ( $res );
		$res = $res ['data'];
		
		$arr = explode ( ',', $res ['pIDImgUrl'] );
		$res ['pIDImgUrl_1'] = $arr [0];
		$res ['pIDImgUrl_2'] = $arr [1];
		$res ['city_title'] = $config ['activeCity'] [$res ['city']] ['title'];
		$res ['cityInsurance_title'] = $config ['activeCity'] [$res ['city']] ['cityInsurance'] [$res ['cityInsurance']];
		
		return $res;
		
		// 测试数据
		return array (
				'fID' => '1',
				'userID' => 1,
				'name' => '韦小宝' . $fID,
				'mobilePhone' => 13510455210,
				'pID' => '11111',
				'pIDImgUrl' => '/update/1.png,/update/2.pgn',
				'city' => '0775',
				'cityInsurance' => 0,
				'status' => 0,
				'soInsurance' => 1, // '是否 购买社保 0 1',
				'housingFund' => 1, // '是否 购买公积金 0 1',
				'radix' => 2300, // '社保基数',
				'HFRadix' => 2500, // '公积金基数',
				'soInsBeginMonth' => '2015-01', // '社保起缴月份 201509',
				'HFBeginMonth' => '2015-01', // '公积金起缴月份 201509',
				'soInsNeedMonthNum' => 6, // '社保购买月数',
				'HFNeedMonthNum' => 6, // '公积金购买月数',
				'soInsFun' => '300', // 社保费
				'HFFun' => '200', // 公积金费
				'mCostFun' => '200',
				'count' => 10, // 参保记录总数
				'records' => array ( // 前三条参保记录
						0 => array (
								'ID' => 1,
								'paydate' => 2015 - 11,
								'soInsExpenditure' => 100, // '社保金额',
								'HFExpenditure' => 120 
						), // '公积金金额'
						1 => array (
								'ID' => 1,
								'paydate' => 2015 - 12,
								'soInsExpenditure' => 100, // '社保金额',
								'HFExpenditure' => 120 
						) 
				) 
		);
	}
	// 获取查看更多参保记录
	function agentUserPersonalRecord($fID, $page = 1, $row = 20) {
		$param ['fID'] = $fID;
		$param ['page'] = $page;
		$param ['row'] = $row;
		$list = agentDataByPost ( 'agentUserPersonalRecord', $param );
		return $list;
		
		// 返回值
		return array (
				'stauts' => 1,
				'msg' => '',
				'count' => 10,
				'nowPage' => 1,
				'data' => array (
						0 => array (
								'ID' => 1,
								'paydate' => '2015-11',
								'soInsExpenditure' => 250, // '社保金额',
								'HFExpenditure' => 350, // '公积金金额',
								'type' => '微信支付', // '支付类型',
								'remains' => 3500 
						),
						1 => array (
								'ID' => 1,
								'paydate' => '2015-14',
								'soInsExpenditure' => 250, // '社保金额',
								'HFExpenditure' => 350, // '公积金金额',
								'type' => '微信支付', // '支付类型',
								'remains' => 3500 
						) 
				) 
		);
	}
	// 获取保费金额明细
	function agentUserMoney($param) {
		$res = agentDataByPost ( 'agentUserMoney', $param );
		return $res;
	}
	// 保存申缴方案
	function agentUserData($param) {
		$res = agentDataByPost ( 'agentUserData', $param );
		return $res;
		
		// 提交的参数
		$param = array (
				'fID' => 1,
				'soInsurance' => '是否 购买社保 0 1',
				'housingFund' => '是否 购买公积金 0 1',
				'radix' => '社保基数',
				'HFRadix' => '公积金基数',
				'soInsBeginMonth' => '社保起缴月份 201509',
				'HFBeginMonth' => '公积金起缴月份 201509',
				'soInsNeedMonthNum' => '社保购买月数',
				'HFNeedMonthNum' => '公积金购买月数' 
		);
		
		// 返回值
		return array (
				'status' => 1,
				'msg' => '',
				'result' => 1 
		);
	}
	
	// 判断是否已经阅读过协议
	function checkAgreementRead($uid) {
		$param ['userID'] = $uid;
		
		$data = agentDataByPost ( 'checkAgreementRead', $param );
		return $data;
	}
	function doAgreementRead($uid) {
		$param ['userID'] = $uid;
		
		$data = agentDataByPost ( 'doAgreementRead', $param );
		return $data;
	}
	
	// 结算生成订单
	function createOrder($uid, $fIDs, $money) {
		$param ['userID'] = $uid;
		$param ['fIDArr'] = $fIDs;
		$param ['createdTime'] = NOW_TIME;
		$param ['total'] = $money;
		$param ['status'] = 0;
		
		$res = agentDataByPost ( 'createOrder', $param );
		return $res;
	}
	
	// 支付订单详情，需要获取订单人数，总额，和缴费明细,未支付时有取消订单操作
	function getOrderDetail($orderID) {
		$param ['orderID'] = $orderID;
		$data = agentDataByPost ( 'getOrderDetail', $param );
		// dump ( $data );
		$config = $this->getConfigData ( 'payStatus' );
		$data ['data'] ['payStatus_title'] = $config [$data ['data'] ['payStatus']];
		
		return $data ['data'];
	}
	
	// 获取订单列表
	function getOrderLists($uid, $payStatus = '-1') {
		// payStatus 为 -1时取全部，为0时取未支付，1时取已支付
		$param ['userID'] = $uid;
		$param ['payStatus'] = $payStatus;
		// dump ( $param );
		$list = agentDataByPost ( 'getOrderLists', $param );
		
		return $list;
	}
	
	// 取消订单
	function delOrder($orderID, $msgID) {
		$param ['orderID'] = $orderID;
		$param ['msgID'] = $msgID;
		
		$res = agentDataByPost ( 'orderCancel', $param );
		return $res;
	}
	// 确认停缴
	function agentUserStop($param) {
		$res = agentDataByPost ( 'agentUserStop', $param );
		return $res;
	}
	// 取消停缴
	function agentUserCancelStop($param) {
		$res = agentDataByPost ( 'agentUserCancelStop', $param );
		return $res;
	}
	// 停缴-获取预计退款金额，银行账户信息
	function getBankInfo($uid) {
		$param ['userID'] = $uid;
		$res = agentDataByPost ( 'agentUserStopMoney', $param );
		return $res;
	}
	// 停缴-填写退款银行账号
	function postBank($uid, $post) {
		// 请求数据
		$param ['userID'] = $uid;
		$param ['bank'] = safe ( $post ['bank'] ); // 银行
		$param ['code'] = safe ( $post ['code'] ); // 账号
		$param ['name'] = safe ( $post ['name'] ); // 姓名
		$param ['mobilePhone'] = safe ( $post ['mobilePhone'] ); // 手机号
		$param ['address'] = safe ( $post ['address'] ); // 开户分行
		$param ['lastModifyTime'] = date ( 'Y-m-d H:i:s' );
		$param ['password'] = safe ( $post ['password'] );
		$param ['fIDArr'] = array_filter ( explode ( '_', $post ['fIDArr'] ) );
		
		$res = agentDataByPost ( 'refundAdd', $param );
		return $res;
	}
	// 个人空间--消息
	function messageList($uid) {
		$param ['userID'] = $uid;
		$res = agentDataByPost ( 'messageList', $param );
		return $res;
	}
	function counterPer($city = '0755', $cityInsurance = '2') {
		$param = array (
				'city' => $city,
				'cityInsurance' => $cityInsurance 
		);
		$res = agentDataByPost ( 'counterPer', $param );
		return $res ['data'];
	}
	function counterResult($param) {
		$res = agentDataByPost ( 'counterResult', $param );
		return $res ['data'];
	}
	function agentAgreementDetail($param) {
		$res = agentDataByPost ( 'counterPer', $param );
		return $res ['data'];
	}
	function agentUserRenew($param) {
		$res = agentDataByPost ( 'agentUserRenew', $param );
		return $res ['data'];
	}
	function personLists($uid, $status) {
		$param ['userID'] = $uid;
		$param ['status'] = $status;
		$lists = agentDataByPost ( 'personLists', $param );
		// dump ( $lists );
		$config = $this->getConfigData ();
		foreach ( $lists ['data'] as &$vo ) {
			$vo ['city_title'] = $config ['activeCity'] [$vo ['city']] ['title'];
			$vo ['cityInsurance_title'] = $config ['activeCity'] [$vo ['city']] ['cityInsurance'] [$vo ['cityInsurance']];
		}
		
		return $lists;
	}
	function paidAction($param) {
		$res = agentDataByPost ( 'paidAction', $param );
		return $res ['data'];
	}
	function refundAdd($param) {
		$res = agentDataByPost ( 'refundAdd', $param );
		return $res ['data'];
	}
	
	function refundDetail($orderID) {
		$param ['orderID'] = $orderID;
		$res = agentDataByPost ( 'refundDetail', $param );
		//dump ( $res );
		//exit ();
		return $res ['data'];
	}
	function agentUserBill($param){
		$res = agentDataByPost('agentUserBill',$param);
		return $res['data'];
		
	}
	function refundCancel($orderID){
		$param ['orderID'] = $orderID;
		$res = agentDataByPost ( 'refundCancel', $param );
		//dump ( $res );
		//exit ();
		return $res ['data'];
	}
}
