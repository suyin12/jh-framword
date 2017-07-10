<?php
/*
*       2012-9-3
*       <<<   复试/驾考/培训 等成绩导入 >>>
*       create by Great sToNe
*       have fun,.....
*       
 * 目前主要包括两个函数,一个是基本配置文件函数,
* 另一个是验证数据正确与否的函数
*
*
*  set() 返回相应的数组格式: 文件名,表名,字段名,字段显示格式
*
*  validator(被操作数组)
* 最后返回的数组形式,仅仅是一个 foreach 递归的形式,也就是说 错误类型及其对应的说明已经包含在该数组中
* */
class recruitMarksMulInsert {
	
	//参数  p - > $PDO(传入参数)
	public $p;
	public $cellArray;
	public $fieldArr; // array  设置导出的格式数组 如array("pID"=>"身份证")
	

	#获取数据库中预定义的$field,$fieldName
	public function fieldArr() {
		$fieldArr = array (
				"talentID" => "人才库编号",
				"name" => "姓名",
				"marksStatus" => "成绩情况",
				"remarks" => "备注" 
		);
		return $this->fieldArr = $fieldArr;
	}
	#获取数组,并加上KEY
	public function cellArray($cellVal) {
		$field = array_keys ( $this->fieldArr );
		$countCell = count ( $cellVal );
		for($k = 0; $k < $countCell; $k ++) {
			$cellArray [] = array_combine ( $field, $cellVal [$k] );
		}
		$cellArray = array_filter ( $cellArray );
		$this->cellArray = $cellArray;
	}
	
	#设置文档内容函数
	public function set($status) {
		$title = "导入成绩";
		$table = "a_recruit_marks";
		$setArray = array (
				"title" => $title,
				"table" => $table,
				"status" => $status,
				"field" => array_keys ( $this->fieldArr ),
				"fieldHeader" => array_values ( $this->fieldArr ) 
		);
		return $setArray;
	}
	
	#验证数据正确性及到数据库部分的 函数
	public function validator() {
		$tableContent = $this->fieldArr;
		$cellArray = $this->cellArray;
		$countCell = count ( $cellArray );
		
		foreach ( $cellArray as $val ) {
			if (is_array ( $val )) {
				foreach ( $val as $k => $v ) {
					if (! is_null ( $v )) {
						$cellK [$k] [] = $v;
					}
					switch ($k) {
						//人才库 编号不能为空且重复
						case "talentID" :
							if (is_null ( $v )) {
								$errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 不能为空 {" . $v . "}";
							} else {
								$countRe [$k] = array_count_values ( $cellK [$k] );
							}
							break;
						//验证合格	情况
						case "marksStatus" :
							if (is_null ( $v ) || ! preg_match ( "/^[0-1]{1,1}$/", $v )) {
								$errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 必需是数字代码 '0'或'1' {" . $v . "}";
							}
							break;
					}
				}
			}
		}
		
		// 查找出重复编号的人员
		foreach ( $countRe as $cKey => $cVal ) {
			foreach ( $cVal as $cK => $cV ) {
				if ($cV > 1) {
					$reCell [$cKey] [] = $cK;
				}
			}
		}
		foreach ( $reCell as $reK => $reV ) {
			foreach ( $reV as $rV ) {
				for($cC = 0; $cC < $countCell; $cC ++) {
					if ($rV === $cellArray [$cC] [$reK]) {
						//$reErrMsg [] = "<<<" . $tableContent [$reK] . "{" . $rV . "}>>> 重复";
						//对应的格式是(姓名,错误的项)
						$reErrMsg [$reK] [$rV] [] = $cellArray [$cC] ['name'];
					}
				}
			}
		}
		
		foreach ( $reErrMsg as $re_k => $re_v ) {
			$reMsg .= "错误的重复项: " . $tableContent [$re_k] . "<br/>";
			foreach ( $re_v as $r_k => $r_v ) {
				$reMsg .= "  重复代码为: " . $r_k . "  错误名单为:(";
				foreach ( $r_v as $r_v_v ) {
					$reMsg .= $r_v_v . "/";
				}
				$reMsg .= " ) <br/><br/> ";
			}
			$errMsg2 = $reMsg;
		}
		$errMsg = array_unique ( $errMsg );
		$errMsg = array (
				$errMsg,
				$errMsg2 
		);
		$errMsg = array_filter ( $errMsg );
		return $errMsg;
		//	echo fetchArray ( $errMsg );
	}
	
	#验证数据库
	public function validatorSql($getQuery) {
		$pdo = $this->p;
		$cellArray = $this->cellArray;
		$countCell = count ( $cellArray );
		
		foreach ( $cellArray as $val ) {
			if (is_array ( $val )) {
				foreach ( $val as $k => $v ) {
					switch ($k) {
						//如果导入的数据不为空,判断是否存在相应的员工,不存在则报错
						case "talentID" :
							//注释掉的这部分是通过数据库验证,可是他要执行很多次...哎!尴尬...
							if ($v) {
								$sql = "select name," . $k . " from a_talent where ";
								$sql1 = $k . " in (";
								$sql2 .= ",'" . $v . "'";
								$sql2 = ltrim ( $sql2, "," );
								$wReSql = $sql . $sql1 . $sql2 . ") and `status`='" . $getQuery ['status'] . "' ";
							}
							break;
					}
				}
			}
		}
		
		$res = $pdo->query ( $wReSql );
		if ($res->rowCount () > 0) {
			$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
			foreach ( $ret as $rV ) {
				for($cC = 0; $cC < $countCell; $cC ++) {
					if (($rV ['talentID'] == $cellArray [$cC] ['talentID'] && $rV ['name'] == $cellArray [$cC] ['name'])) {
						unset ( $cellArray [$cC] );
					}
				}
			}
			//			$countCell = count ( $cellArray );
			//			for($cC = 0; $cC < $countCell; $cC ++) {
			foreach ( $cellArray as $cKey => $cVal ) {
				$errMsg [] = "该流程中不存在人才编号及姓名与导入数据一致的人员{" . $cVal ['talentID'] . "}(" . $cVal ['name'] . ")";
			}
			//		
		} else {
			$errMsg [] = "该流程中不存在相应人才库编号的应聘人员";
		}
		return $errMsg;
		#end validator()
	}
	
	#数据库操作语句
	public function sql($getQuery) {
		#初始化配置
		$time = time ();
		$mID = $_SESSION ['exp_user'] ['mID'];
		$mName = $_SESSION ['exp_user'] ['mName'];
		$now = timeStyle ( "dateTime", "-" );
		$today = timeStyle ( "date", "-" );
		$pdo = $this->p;
		$cellArray = $this->cellArray;
		$trainClassicID = $getQuery ['trainClassicID'];
		$status = $getQuery ['status'];
		foreach ( $cellArray as $key => $val ) {
			$talentID = $val ['talentID'];
			$talentIDStr .= $val ['talentID'] . ",";
			//默认先删除相关的培训记录
			$tSql = "delete from `b_recruit_marks` where `talentID`='$talentID' and `trainClassicID`='$trainClassicID'";
			$pdo->query ( $tSql );
			$tSql = " insert into `b_recruit_marks` set  `talentID`='$talentID' , `trainClassicID`='$trainClassicID' , `status`='$status',`marksStatus`='".$val['marksStatus']."',`remarks`='" . $val ['remarks'] . "',`createdBy`='$mID',`createdOn`='$now'";
			$pdo->query ( $tSql );
		}
		$talentIDStr = rtrim ( $talentIDStr, "," );
		#验证此时的培训是否已经全部通过
		$a = new talent ();
		$a->pdo = $pdo;
		$a->talentBasic ( "`talentID`,`status`,`positionID`", " `talentID` in ($talentIDStr) " );
		$a->categoryBasic ();
		$positionIDArr = $a->categoryArr ['positionIDArr'];
		$positionIDStr = rtrim ( implode ( ",", $positionIDArr ), "," );
		#获取对应岗位的相关复试流程
		$b = new position ();
		$b->pdo = $pdo;
		$b->positionBasic ( "`positionID`,`reexamineProcedureID`", "`positionID`  in (" . $positionIDStr . ")" );
		$b->recruitProcedurer ( "1" );
		$b->thisProcedurer = $status;
		$preOrNextProcedurerArr = $b->preOrNextProcedurer ();
		
		#按人才当前状态分类
		$c = new tInfoStatus ();
		$c->pdo = $pdo;
		$c->ret = $a->ret;
		$c->categoryArr = $a->categoryArr;
		$c->classLinkClass ();
		$c->recruitMarksArr ();
		$trainPassStatusArr = $c->trainPassStatusArr ();
		#存在记录验证
		$exSql = "select `talentID` from `b_recruit_notes` where `talentID` in ($talentIDStr) and `status`='$status'";
		$exRet = keyArray ( SQL ( $pdo, $exSql ), "talentID" );
		foreach ( $a->ret as $tKey => $tVal ) {
			
			if (! $trainPassStatusArr [$tKey])
				// 如果都通过了培训的全部考试,则
				$procedurerStatus = "1";
			else
				//初始化如果需要培训而未参加培训的,则 $procedurerStatus  默认为 等待("2")
				$procedurerStatus = "2";
				#更新人才库状态信息
			$nextProcedurer = $preOrNextProcedurerArr [$tVal ['positionID']] ['next'] ['procedurerID'];
			switch ($procedurerStatus) {
				case "0" : //不通过的员工直接转换成储备人才库
					$sql [$tKey] = "update a_talent set `status`='2' ,`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$tKey'";
					break;
				case "1" :
					$sql [$tKey] = "update a_talent set `status`='$nextProcedurer' ,`d_train`='1',`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$tKey'";
					break;
				case "2" :
					$sql [$tKey] = "update a_talent set `status`='$status' ,`d_train`='0',`lastModifyTime`='$now',`lastModifiedBy`='$mID' where `talentID`='$tKey'";
					break;
			}
			if ($exRet [$tKey]) {
				$iSql [$tKey] = "update `b_recruit_notes` set `procedurerStatus`='$procedurerStatus',`createdBy`='$mID',`createdOn`='$now' where  `talentID`='$tKey' and `status`='$status'";
			} else {
				$iSql [$tKey] = "insert  `b_recruit_notes` set `talentID`='$tKey',`status`='$status',`procedurerStatus`='$procedurerStatus',`createdBy`='$mID',`createdOn`='$now' ";
			}
		}
		$actionSql = mergeArray ( $sql, $iSql );
		return $actionSql;
	}
	
	#导入信息概况
	public function dataInfo() {
		return $insertInfo;
	}
	
	#end class
}

?>

