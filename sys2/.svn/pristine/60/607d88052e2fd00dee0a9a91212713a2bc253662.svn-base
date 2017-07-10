<?php
/*
*       2012-8-10
*       <<< 岗位信息相关函数   >>>
*       create by Great sToNe
*       have fun,.....
*/
class position {
	public $pdo;
	public $x;
	public $positionArr; //array 获取岗位的基础信息
	public $recruitProcedurerArr; //array 招聘相关流程数组 复试\培训流程
	public $thisProcedurer; // array 当前状态流程
	public $needTrainArr; // array 各个岗位需参加的培训
	

	#加载连接各种设置类
	public function classLinkClass() {
		$x = new classLink ();
		$x->pdo = $this->pdo;
		return $this->x = $x;
	}
	#岗位相关基础信息
	public function positionBasic($selStr = " * ", $conStr = " active='1' ") {
		$pdo = $this->pdo;
		$sql = "select $selStr from a_position where $conStr";
		$ret = SQL ( $pdo, $sql );
		$ret = keyArray ( $ret, "positionID" );
		return $this->positionArr = $ret;
	}
	#单位和岗位的二级联动数组
	public function unitPosition() {
		$x = $this->x;
		$x->unitClass ( array (
				"selStr" => "`unitID`,`unitName`",
				"conStr" => ' and status=1 ' 
		) );
		$unitArr = $x->unitArr;
		$positionArr = $this->positionArr;
		foreach ( $unitArr as $key => $val ) {
			$t = null;
			foreach ( $positionArr as $pkey => $pval ) {
				if ($key == $pval ['unitID']) {
					$t [] = array("positionID"=>$pval['positionID'],"name"=>$pval['shortcut']."-".$pval['name']);
				}
			}
			$unitPositionArr [] = array (
					"unitID" => $key,
					"unitName" => $val ['unitName'],
					"position" => $t 
			);
		}
		return $unitPositionArr;
	}
	
	#获取各岗位招聘效果最好的市场
	function betterMarket($talentArr) {
		foreach ( $talentArr as $val ) {
			$betterMarket [$val ['positionID']] [$val ['marketID']] += 1;
		}
		foreach ( $betterMarket as $key => $val ) {
			arsort ( $val );
			$betterMarket [$key] = $val;
		}
		return $betterMarket;
	}
	
	#获取招聘相关的各类流程的设置
	public function recruitProcedurer($type) {
		$pdo = $this->pdo;
		$positionArr = $this->positionArr;
		foreach ( $positionArr as $key => $val ) {
			$sql = "select * from b_recruit_procedurer where ID in ('" . $val ['reexamineProcedureID'] . "','" . $val ['trainProcedureID'] . "','" . $val ['materialProcedureID'] . "','" . $val ['waitProcedureID'] . "')";
			$ret = SQL ( $pdo, $sql );
			foreach ( $ret as $v ) {
				//1.获取对应各个岗位的复试流程  type=1
				//2.获取对应各个岗位的培训流程  type=2
				if (! $type)
					$recruitProcedurerArr [$key] = $v;
				elseif ($type == $v ['type'])
					$recruitProcedurerArr [$key] = $v;
			}
		}
		return $this->recruitProcedurerArr = $recruitProcedurerArr;
	}
	
	#各流程对应的前一个和后一个流程
	public function preOrNextProcedurer() {
		$recruitProcedurerArr = $this->recruitProcedurerArr;
		$thisProcedurer = $this->thisProcedurer;
		foreach ( $recruitProcedurerArr as $key => $val ) {
			$procedurerArr = explode ( ",", $val ['procedurer'] );
			foreach ( $procedurerArr as $pK => $pV ) {
				if ($pV == $thisProcedurer) {
					$preOrNextProcedurerArr [$key] ['pre'] ['procedurerID'] = $procedurerArr [$pK - 1];
					$preOrNextProcedurerArr [$key] ['next'] ['procedurerID'] = $procedurerArr [$pK + 1];
				}
			}
		}
		return $preOrNextProcedurerArr;
	}
	
	#各个岗位需要的培训/资料/待岗项目
	public function needTrain($type = "2") {
		$trainProcedurerArr = $this->recruitProcedurerArr;
		$x = $this->x;
		// 加载相关招聘设置信息类
		$x->recruitInfoSetClass ();
		$x->e->recruitProcedurerArr = $trainProcedurerArr;
		$needTrainArr = $x->e->recruitProcedurerDetailArr($type);
		return $this->needTrainArr = $needTrainArr;
	}
}
?>