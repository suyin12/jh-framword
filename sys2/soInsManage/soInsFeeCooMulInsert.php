<?php
/*
*     2010-9-29
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
class soInsFeeCooMulInsert {
	public $p; //$pdo   对象
	public $cellArray; //欲操作数组
	private $field; //通过数据库查询,获得
	private $fieldName; //通过数据库查询,获得
	public $extraCellArray; //预插入数据库的数据
	#获取数据库中预定义的$field,$fieldName
	public function field() {
		$engToChsArr = engTochs ();
		//引用该类的源文件要有引用common.function.php
		$field = array ("sID", "name", "total", "pHospitalization", "uHospitalization" );
		foreach ( $field as $val ) {
			if (array_key_exists ( $val, $engToChsArr )) {
				$fieldName [] = $engToChsArr [$val];
			}
		}
		$this->field = $field;
		$this->fieldName = $fieldName;
	}
	
	#获取数组,并加上KEY
	public function cellArray($cellVal) {
		$field = $this->field;
		$countCell = count ( $cellVal );
		for($k = 0; $k < $countCell; $k ++) {
			$cellArray [] = array_combine ( $field, $cellVal [$k] );
		}
		$cellArray = array_filter ( $cellArray );
		$this->cellArray = $cellArray;
	}
	
	#设置文档内容函数
	public function set() {
		$title = "导入合作医疗明细";
		$table = "a_soInsFee_tmp";
		$field = $this->field;
		$fieldHeader = $this->fieldName;
		$setArray = array ("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader );
		return $setArray;
	}
	public function validatorSql($getQuery) {
		$pdo = $this->p;
		$soInsID = $getQuery ['soInsID'];
		$soInsDate = $getQuery ['soInsDate'];
		$sql = "select soInsID from a_soInsFee_tmp where soInsDate= '$soInsDate' ";
		$res = $pdo->query ( $sql );
		$row = $res->rowCount ();
		if (! $row) {
			$errMsg [] = "数据库不存在该单位本月数据,请先导入本月的缴交明细";
		}
		return $errMsg;
	}
	#生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery
	public function extraFieldValue($getQuery) {
		$sponsorTime = timeStyle ( "dateTime" );
		$sponsorName = $_SESSION ['exp_user'] ['mName'];
		$soInsID = $getQuery ['soInsID'];
		$soInsDate = $getQuery ['soInsDate'];
		$cellArray = $this->cellArray;
		foreach ( $cellArray as $key => $val ) {
			$pID = pIDVildator ( $cellArray [$key] ['pID'] );
			if ($pID)
				$cellArray [$key] ['pID'] = $pID;
			$cellArray [$key] ['soInsDate'] = $soInsDate;
		}
		//		echo "<pre>";
		//		print_r ( $cellArray );
		return $this->extraCellArray = $cellArray;
	
	}
	
	#数据库操作语句
	public function sql() {
		$cellArray = $this->extraCellArray;
		$upSql = "update a_soInsFee_tmp set   ";
		foreach ( $cellArray as $cValue ) {
			$soInsDate = $cValue['soInsDate'];
			$sID = $cValue['sID'];
			if (! $cValue ['pHospitalization'])
				$pHospitalization = 0;
			else
				$pHospitalization = $cValue ['pHospitalization'];
			if (! $cValue ['uHospitalization'])
				$uHospitalization = 0;
			else
				$uHospitalization = $cValue ['uHospitalization'];
			if (! $cValue ['total'])
				$total = 0;
			else
				$total = $cValue ['total'];
			$sqlV = "total=total+$total, pTotal=pTotal+$pHospitalization,uTotal=uTotal+$uHospitalization,pHospitalization=$pHospitalization,uHospitalization=$uHospitalization where sID like '$sID' and soInsDate like '$soInsDate'";
			$sql [] = $upSql . $sqlV;
		}
		return $sql;
	}
	#导入信息概况
	public function dataInfo() {
		$cellArray = $this->cellArray;
		$insertInfo = '共' . count ( $cellArray ) . "条";
		return $insertInfo;
	}
}

?>