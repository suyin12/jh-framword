<?php
/*
作者：LOSKIN
time:2014-02-27
描述：用excel把社保模板数据插入数据库的类
更新：
	
*/
require_once '../common.function.php';
class soInsFeeMulAgmInsert {
	public $p; //$pdo   对象
	public $cellArray; //欲操作数组
	private $field; //通过数据库查询,获得
	private $fieldName; //通过数据库查询,获得
	public $extraCellArray; //预插入数据库的数据
	#获取数据库中预定义的$field,$fieldName
	public function field() {
		$engToChsArr = engTochs ();
		//引用该类的源文件要有引用common.function.php
		$field = array ("sID", "name", "pID", "radix", "total", "pPension", "uPension", "latepay", "latepaymonth");
		foreach ( $field as $val ) {
			if (array_key_exists ( $val, $engToChsArr )) {
				$fieldName [] = $engToChsArr [$val];
			}
			switch ($val){
				case "latepay":
					$fieldName [] = "滞纳金";
					break;
				case "latepaymonth":
					$fieldName [] = "补交年月";
					break;
				default:
					break;			
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
		foreach ( $cellArray as $key => $val ) {
			foreach ($val as $k => $v){
				switch ($k){
					case "sID":
					case "name":
					case "pID":
					case "radix":
						$newCellArray[$val["sID"]]["{$k}"] = $v;
						break;
					case "latepaymonth":
						$newCellArray[$val["sID"]]["{$k}"] .= ",".$v;
						break;
					default:
						$newCellArray[$val["sID"]]["{$k}"] += $v;
						break;
				}
			}
		}
		$this->cellArray = $newCellArray;
	}
	
	#设置文档内容函数
	public function set() {
		$title = "导入社保缴交明细";
		$table = "d_soInsfee_tmp";
		$field = $this->field;
		$fieldHeader = $this->fieldName;
		$setArray = array ("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader );
		return $setArray;
	}
	public function validatorSql($getQuery) {
		$pdo = $this->p;
		$soInsID = $getQuery ['soInsID'];
		$soInsDate = $getQuery ['soInsDate'];
		$sql = "select soInsID from d_soInsFee_tmp where soInsID like '$soInsID' and soInsDate= '$soInsDate' and type='2'";
		$res = $pdo->query ( $sql );
		$row = $res->rowCount ();
		if ($row) {
			$errMsg [] = "数据库已经存在该单位本月数据,请勿重复导入";
		}
		return $errMsg;
	}
	#生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery
	public function extraFieldValue($getQuery) {
		$sponsorTime = timeStyle ( "dateTime" );
		$sponsorName = $_SESSION ['exp_user'] ['mName'];
		$soInsID = $getQuery ['soInsID'];
		$soInsDate = $getQuery ['soInsDate'];
		$status = $getQuery ['status'];
		$cellArray = $this->cellArray;
		foreach ( $cellArray as $key => $val ) {
			$pID = pIDVildator ( $cellArray [$key] ['pID'] );
			if ($pID)
				$cellArray [$key] ['pID'] = $pID;
			$cellArray [$key] ['soInsID'] = $soInsID;
			$cellArray [$key] ['soInsDate'] = $soInsDate;
			$cellArray [$key] ['type'] = "2";
			$cellArray [$key] ['sponsorName'] = $sponsorName;
			$cellArray [$key] ['sponsorTime'] = $sponsorTime;
		}
				//echo "<pre>";
				//print_r($cellArray);
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
			$sql []= "insert into d_soInsFee_tmp ( ". $sqlK . ") values " . $sqlV;
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