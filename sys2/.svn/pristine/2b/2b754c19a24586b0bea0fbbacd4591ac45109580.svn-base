<?php
/*
*     2010-5-21
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
require_once '../common.function.php';
class soInsFeeMulInsert {
	public $p; //$pdo   对象
	public $cellArray; //欲操作数组
	private $field; //通过数据库查询,获得
	private $fieldName; //通过数据库查询,获得
	public $extraCellArray; //预插入数据库的数据
	#获取数据库中预定义的$field,$fieldName
	public function field() {
		$engToChsArr = engTochs ();
		//引用该类的源文件要有引用common.function.php
		$field = array ("sID", "name", "pID", "radix", "total", "pTotal", "uTotal", "pPension", "uPension", "uHousing", "pHospitalization", "uHospitalization", "employmentRadix","uEmploymentInjury", "uUnemployment", "uBirth" );
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
		$title = "导入社保缴交明细";
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
		$sql = "select soInsID from a_soInsFee_tmp where soInsID like '$soInsID' and soInsDate= '$soInsDate' ";
		$res = $pdo->query ( $sql );
		$row = $res->rowCount ();
		if ($row) {
			$errMsg [] = "数据库已经存在该单位本月数据,请勿重复导入,您可以通过<a href='" . httpPath . "soInsBalFeeIndex.php?soInsDate=$soInsDate'>社保缴交明细管理</a>,修改您的数据";
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
			$cellArray [$key] ['soInsID'] = $soInsID;
			$cellArray [$key] ['soInsDate'] = $soInsDate;
			$cellArray [$key] ['sponsorName'] = $sponsorName;
			$cellArray [$key] ['sponsorTime'] = $sponsorTime;
		}
		//		echo "<pre>";
		//		print_r($cellArray);
		return $this->extraCellArray = $cellArray;
	
	}
	
	#数据库操作语句
	public function sql() {
		$cellArray = $this->extraCellArray;
		foreach ( $cellArray as $cValue ) {
			$s_V = null;
			$sqlK = $sqlV=null;
			foreach ( $cValue as $cK => $cV ) {
				$sqlK .= $cK . ',';
				$s_V .= "'" . $cV . "',";
			}
			$sqlK = rtrim($sqlK,",");
			$s_V = rtrim ( $s_V, "," );
			$sqlV = "(" . $s_V . ")";
			$sql []= "insert into a_soInsFee_tmp ( ". $sqlK . ") values " . $sqlV;
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