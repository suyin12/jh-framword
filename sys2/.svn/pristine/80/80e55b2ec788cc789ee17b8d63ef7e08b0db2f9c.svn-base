<?php

/**
 * Description of reward
 *  1. 统计总奖金的应税额, 没有扣除应税起征额(3500)  2. 参与合并扣税的项目
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
class rewardData {
	public $pdo; //数据库链接
	public $unitID;
	public $month;
	public $extraBatch;
	public $wArr;
	public $rewardDate;
	#按费用月份划分的奖金应缴税额
	public function ratalAsMonth() {
		$pdo = $this->$pdo;
		$unitID = $this->unitID;
		$month = $this->month;
		$sql = "select `month`,`rewardDate`,`extraBatch`,`ratal` from `a_rewardFee` where `month` like '$month' and `unitID` in ($unitID) ";
		$ret = SQL ( $pdo, $sql );
	}
	
	#按奖金月份划分的奖金应缴税额:如果传入批次的值, 就表示涉及到奖金合并计算的部分, 
	public function ratalAsReward($extraBatch = NULL) {
		$pdo = $this->pdo;
		$unitID = $this->unitID;
		$rewardDate = $this->rewardDate;
		$sql = "select `uID`,`month`,`rewardDate`,`extraBatch`,`ratal` ,`pTax` from `a_rewardFee` where `rewardDate` like '$rewardDate' and `unitID` in ($unitID) ";
		if ($extraBatch)
			$sql .= " and `extraBatch`<'$extraBatch' ";
		$ret = SQL ( $pdo, $sql );
		//构造数组, array[extraBatch][uID][]的形式
		foreach ( $ret as $val ) {
			foreach ( $val as $k => $v ) {
				switch ($k) {
					case "ratal" :
					case "pTax" :
						$arr [$val ['extraBatch']] [$val ['uID']] [$k] = $v;
						break;
				}
			}
		}
		unset ( $ret );
		return $arr;
	}
	
	#合计某月内的所有已经发放的奖金的应纳税额及已扣个税合计
	public function ratalAsRewardTotal($extraBatch = NULL) {
		$pdo = $this->pdo;
		$unitID = $this->unitID;
		$wArr = $this->wArr;
		$extraBatch = $this->extraBatch;
		$rewardDate = $this->rewardDate;
		if ($wArr) {
			foreach ( $wArr as $oVal ) {
				$uIDStr .= "'" . $oVal ['uID'] . "',";
			}
			unset ( $oVal );
			$uIDStr = rtrim ( $uIDStr, "," );
			$sql = "select `uID`,sum(`ratal`) as ratal ,sum(`pTax`) as pTax from `a_rewardFee` where `rewardDate` like '$rewardDate' and `uID` in ($uIDStr) ";
		} else {
			$sql = "select `uID`,sum(`ratal`) as ratal ,sum(`pTax`) as pTax from `a_rewardFee` where `rewardDate` like '$rewardDate' and `unitID` in ($unitID) ";
			if ($extraBatch)
				$sql .= " and `extraBatch`<'$extraBatch' ";
		}
		$sql .= " group by uID";
		$ret = SQL ( $pdo, $sql );
		//构造数组, array[extraBatch][uID][]的形式
		foreach ( $ret as $val ) {
			foreach ( $val as $k => $v ) {
				switch ($k) {
					case "ratal" :
					case "pTax" :
						$arr [$val ['uID']] [$k] = $v;
						break;
				}
			}
		}
		unset ( $ret );
		return $arr;
	}
}

?>
