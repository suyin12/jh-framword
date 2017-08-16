<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/3
 * Time: 17:24
 */
namespace Admin\Model;
use Think\Model;

class CheckMeModel extends Model{
	Protected $autoCheckFields = false;//虚拟模型
	function userInfo($param){
		$userInfo = M('personalinfo','a_')->where('userName='.'\''.$param['userName'].'\''.'and ID='.'\''.$param['userID'].'\'')->select();
		return $userInfo;
	}
	function userPower($param){
		return 1;
	}
	function areaData(){
		$areaStr['provinces'] = M('provinces','a_')->select();
		$areaStr['cities'] = M('cities','a_')->select();
		$areaStr['areas'] = M('areas','a_')->select();
// 		$areaStr['zipcode'] = M('zipcode','a_')->where('1=1')->select();
		return $areaStr;
	}
}