<?php
/*
*       2012-8-14
*       <<< 人才状态信息,及处理函数,如初试,复试,待岗等   >>>
*       create by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/
class tInfoStatus {
	public $pdo;
	public $ret; //array 获取相关人才库数组
	public $categoryArr; // array 根据人才库信息,分类获得相应的 mIDArr,marketIDArr,positionIDArr
	public $statusArr; //array 不同状态类型对应的数组
	public $recruitNotesArr; //array   返回通知回访记录数组
	public $recruitMarksArr; // array 复试/驾考/培训的等相关成绩信息
	public $x; // object 链接各个类
	

	#加载连接各种设置类
	public function classLinkClass() {
		$x = new classLink ();
		$x->pdo = $this->pdo;
		return $this->x = $x;
	}
	#人才状态对应的数组
	public function tInfoStatusArr($type) {
		$ret = $this->ret;
		if (! is_null ( $type )) {
			foreach ( $ret as $val ) {
				if ($val ['status'] == $type)
					$arr [$val ['talentID']] = $val;
			}
		} else
			$arr = $ret;
		return $this->statusArr = $arr;
	}
	
	#各类通知回访记录的相关信息
	public function recruitNotesArr($status = null) {
		$pdo = $this->pdo;
		if ($status) {
			$talentArr = $this->statusArr;
			$talentIDArr = array_keys ( $talentArr );
			$talentIDStr = implode ( ",", $talentIDArr );
			$sql = "select * from b_recruit_notes where talentID in ($talentIDStr) and `status`='$status' order by createdOn desc";
		} else {
			$talentArr = $this->ret;
			$talentIDArr = array_keys ( $talentArr );
			$talentIDStr = implode ( ",", $talentIDArr );
			$sql = "select * from b_recruit_notes where talentID in ($talentIDStr) order by createdOn desc";
		}
		$ret = SQL ( $pdo, $sql );
		$recruitNotesArr = $ret;
		return $this->recruitNotesArr = $recruitNotesArr;
	}
	
	#是否通过复试/驾考/培训的等相关成绩信息
	public function recruitMarksArr($status = null) {
		$pdo = $this->pdo;
		if ($status) {
			$talentArr = $this->statusArr;
			$talentIDArr = array_keys ( $talentArr );
			$talentIDStr = implode ( ",", $talentIDArr );
			$sql = "select * from `b_recruit_marks` where `talentID` in ($talentIDStr) and `status` in ($status) order by createdOn desc";
		} else {
			$talentArr = $this->ret;
			$talentIDArr = array_keys ( $talentArr );
			$talentIDStr = implode ( ",", $talentIDArr );
			$sql = "select * from `b_recruit_marks` where `talentID` in ($talentIDStr)  order by createdOn desc";
		}
		$ret = SQL ( $pdo, $sql );
		$recruitMarksArr = $ret;
		return $this->recruitMarksArr = $recruitMarksArr;
	}
	
	#验证所有的培训项目是否已经通过, 需引入 class position  确定需要的培训有哪些, 再对比已通过的项目, 即可获知培训是否全部通过
	public function trainPassStatusArr($type = "2") {
		$talentArr = $this->ret;
		$positionIDArr = $this->categoryArr ['positionIDArr'];
		$positionIDStr = implode ( ",", $positionIDArr );
		#各岗位对应的培训流程
		$x = $this->x;
		$x->positionClass ( array (
				"selStr" => "`positionID`,`reexamineProcedureID`,`trainProcedureID`,`materialProcedureID`,`waitProcedureID`",
				"conStr" => " `positionID` in ($positionIDStr) " 
		) );
		$x->b->recruitProcedurer ( $type );
		$x->b->x = $x;
		$x->b->needTrain ( $type );
		$needTrainArr = $x->b->needTrainArr;
		$recruitMarksArr = $this->recruitMarksArr;
		if ($needTrainArr && $recruitMarksArr) {
			foreach ( $talentArr as $key => $val ) {
				foreach ( $recruitMarksArr as $rkey => $rval ) {
					if ($key == $rval ['talentID'])
						if ($rval ['marksStatus'] == "1") {
							$trainPassArr [$key] [] = $rval ['trainClassicID'];
						} else
							$trainPassArr [$key] [] = null;
				}
				foreach ( $needTrainArr as $nkey => $nval ) {
					if ($nkey == $val ['positionID'])
						$needTrainKeyArr [$key] = array_keys ( $nval );
				}
			}
			foreach ( $talentArr as $tkey => $tval ) {
				if (! $trainPassArr [$tkey])
					$valid [$tkey] = $needTrainKeyArr [$tkey];
				elseif (! $needTrainKeyArr [$tkey])
					$valid [$tkey] = $trainPassArr [$tkey];
				else
					$valid [$tkey] = array_diff ( $needTrainKeyArr [$tkey], $trainPassArr [$tkey] );
			}
		} else {
			#初始化 $valid 为 true
			foreach ( $talentArr as $tKey => $tVal ) {
				$valid [$tKey] = true;
			}
		}
		return $valid;
	}
}
?>