<?php
/*
*       2012-8-7
*       <<<   有关市场的一些操作方法 >>>
*       create by Great sToNe
*       have fun,.....
*/
class market {
	public $pdo;
	public $marketArr; //市场的相关信息
	public $marketOrderArr; //市场安排的相关信息
	

	#市场的基础信息   默认查询有效的市场
	function marketBasic($selStr = " * ", $conStr = ' active="1" ') {
		$pdo = $this->pdo;
		$sql = "select $selStr from a_market where $conStr";
		$ret = SQL ( $pdo, $sql );
		$ret = keyArray ( $ret, "marketID" );
		return $this->marketArr = $ret;
	}
	
	#市场的安排情况
	function marketOrder($conStr = ' 1=1 ') {
		$pdo = $this->pdo;
		$sql = "select * from a_dailyrecruit where $conStr";
		$ret = SQL ( $pdo, $sql );
		return $this->marketOrderArr = $ret;
	}
	
	#按招聘人员统计招聘场次
	function mID_marketNum() {
		$marketOrderArr = $this->marketOrderArr;
		require_once 'user.data.php';
		$a = new user ();
		$a->pdo = $this->pdo;
		$users = $a->userBasic ( "`mID`,`mName`", " `roleID` REGEXP ',4_1,'" );
		foreach ( $marketOrderArr as $val ) {
			$t = explode ( ",", $val ['mID'] );
			foreach ( $t as $tv ) {
				$mID_marketNumArr [$tv] ['marketNum'] += 1;
				$mID_marketNumArr [$tv] ['mName'] = $users [$tv] ['mName'];
			}
		}
		return $mID_marketNumArr;
	}
	
	#按安排情况统计招聘场次
	function market_marketNum() {
		$marketOrderArr = $this->marketOrderArr;
		$marketArr = $this->marketArr;
		foreach ( $marketOrderArr as $val ) {
			$market_marketNumArr [$val ['marketID']] ['num'] += 1;
			$market_marketNumArr [$val ['marketID']] ['marketName'] = $marketArr [$val ['marketID']] ['name'];
		}
		return $market_marketNumArr;
	}
	
	#获取各市场招聘效果最好的岗位
	function betterPosition($talentArr) {
		foreach ( $talentArr as $val ) {
			$betterPosition [$val ['marketID']] [$val ['positionID']] += 1;
		}
		foreach ( $betterPosition as $key => $val ) {
			arsort($val);
			$betterPosition[$key] =$val;
		}
		return $betterPosition;
	}
}

?>