<?php

/*
 * 用来统计 a_originalFee , a_originalFee_tmp , a_mul_originalFee, a_mul_originalFee_tmp 相关的费用情况
 * 更新:2014-08-06
 * 		加入统计a_rewardfee 相关的费用
 * @author  sToNe 
 */
class salaryFee {
	public $pdo;
	public $unitID; //单位编号 , 可以是一个string如  '2202.002','2202.044'
	public $month; //月份 可以是一个string如 '201111','201109'
	public $monthType = "month"; //费用月份,工资月份,等月份类型,默认为费用月份
	public $extraBatch; //如果没有传入批次编号, 则默认为查询所有批次
	public $conStr; //定义需要额外控制的SQL语句条件,如 and uID='YZLH00012'
	public $actionArr; //获取该类内,各个方法需要操作的数组
	
	#获取费用的基础操作数组, $type=fee , mulFee, reward ,  默认为当月的首次工资费用
	public function basicRet($type = "fee") {
		$pdo = $this->pdo;
		$unitID = $this->unitID;
		$month = $this->month;
		$extraBatch = $this->extraBatch;
		$monthType = $this->monthType;
		$conStr = $this->conStr;
		switch ($type) {
			case "mulFee" :
				$sql = "select * from a_mul_originalFee where unitID in ($unitID) and " . $monthType . " in ($month)";
				if ($extraBatch)
					$sql .= " and extraBatch='$extraBatch'";
				break;
			case "reward" :
				$sql = "select * from a_rewardfee where unitID in ($unitID) and " . $monthType . " in ($month)";
				break;
			case "fee" :
				$sql = "select * from a_originalFee where unitID in ($unitID) and " . $monthType . " in ($month)";
				break;
		}
		if ($conStr)
			$sql .= $conStr;
		$ret = SQL ( $pdo, $sql );
		return $this->actionArr = $ret;
	}
	#统计单位工资\奖金的费用
	public function feeSum($Arr){
		$sumArr = array();
		foreach ($Arr as $k => $v){
			$sum = ++$k;
			foreach ($v as $kk => $vv){
				switch ($kk){
					case "zID":
					case "unitID":
					case "month":
					case "salaryDate":
					case "soInsDate":
					case "HFDate":
					case "comInsDate":
					case "managementCostDate":
						$sumArr["{$kk}"] = $vv;
						break;
					case "uPDIns":
					case "pSoIns":
					case "uSoIns":
					case "pHF":
					case "uHF":
					case "pComIns":
					case "uComIns":
					case "managementCost":
						$sumArr["{$kk}"."Sum"] += $vv;
						break;
					case "utilities":
					case "cardMoney":
					case "pay":
					case "ratal":
					case "uAccount":
					case "pTax":
					case "helpCost":
					case "acheive":
					case "totalFee":
					case "advanceMoney":
						$sumArr["{$kk}"] += $vv;
						break;
					default:
						break;
				}
			}
		}
		$sumArr["num"] = $sum;
		return $sumArr;
	}
	
	
	function array_sum_values() {
	   $return = array();
	   $intArgs = func_num_args();
	   $arrArgs = func_get_args();
	   if($intArgs < 1) trigger_error('Warning: Wrong parameter count for array_sum_values()', E_USER_WARNING);
	   
	   foreach($arrArgs as $arrItem) {
	       if(!is_array($arrItem)) trigger_error('Warning: Wrong parameter values for array_sum_values()', E_USER_WARNING);
	       foreach($arrItem as $k => $v) {
	       		switch ($k){
	       			case "zID":
					case "unitID":
					case "month":
					case "salaryDate":
					case "soInsDate":
					case "HFDate":
					case "comInsDate":
					case "managementCostDate":
					case "num":
	       				break;
	       			default:
	       				$return[$k] += $v;
	       		}
	       }
	   }
	   return $return;
	}
	
	#单位工资奖金的费用合计得到数组,$Arr首次$Brr奖金$Crr多次
	public function sumTotal($Arr=array(),$Brr=array(),$Crr=array()){
		$newArr = $this->array_sum_values( $Arr, $Brr, $Crr);
		foreach($Arr as $k => $v) {
       		switch ($k){
       			case "zID":
				case "unitID":
				case "month":
				case "salaryDate":
				case "soInsDate":
				case "HFDate":
				case "comInsDate":
				case "managementCostDate":
				case "num":
					$new_arr[$k] = $v;
       				break;
       			default:
       			 	break;
       		}
        }
        $newArr = array_merge($new_arr,$newArr);
		return $newArr;
	}
	#构造输出的数组
	public function ex_arr($arr){
		if(!empty($arr)){
			$newArr = array(
				"month" => $arr["month"],
				"salaryDate" => $arr["salaryDate"],
				"soInsDate" => $arr["soInsDate"],
				"HFDate" => $arr["HFDate"],
				"comInsDate" => $arr["comInsDate"],
                "managementCostDate" => $arr["managementCostDate"],
				"comments" => "劳务费",
				"num" => $arr["num"],
				"totalFeeR" => $arr["totalFee"],
				"WDMoney" => $arr["WDMoney"],
				"salaryS" => $arr["pay"],
				"mCostNum" => $arr["mCostNum"],
				"managementCost" => $arr["managementCostSum"],
				"uPDInsS" => $arr["uPDInsSum"],
				"pSoInsS" => $arr["pSoInsSum"],
				"uSoInsS" => $arr["uSoInsSum"],
				"pHFS" => $arr["pHFSum"],
				"uHFS" => $arr["uHFSum"],
				"pComInsS" => $arr["pComInsSum"],
				"uComInsS" => $arr["uComInsSum"]
			);
		}
		return $newArr;
	}
	#获 取临时费用的基础操作数组, $type=fee , mulFee, reward ,  默认为当月的 临时工资费用
	public function basicTmpRet($type = "fee") {
		$pdo = $this->pdo;
		$unitID = $this->unitID;
		$month = $this->month;
		$extraBatch = $this->extraBatch;
		$monthType = $this->monthType;
		$conStr = $this->conStr;
		switch ($type) {
			case "mulFee" :
				$sql = "select * from a_mul_originalFee_tmp where unitID in ($unitID) and " . $monthType . " in ($month)";
				if ($extraBatch)
					$sql .= " and extraBatch='$extraBatch'";
				break;
			case "reward" :
				$sql = "select * from a_reward_tmp where unitID in ($unitID) and " . $monthType . " in ($month)";
				break;
			case "fee" :
				$sql = "select * from a_originalFee_tmp where unitID in ($unitID) and " . $monthType . " in ($month)";
				break;
		}
		if ($conStr)
			$sql .= $conStr;
		$ret = SQL ( $pdo, $sql );
		return $this->actionArr = $ret;
	}
	
	#合并该单位所有类型的费用,返回每个人的合计费用数组 [ 还没写完这个方法 ]
	public function allRet($typeArr = array("fee", "mulFee", "reward"), $needArr = array("pay", "pTax", "acheive", "totalFee")) {
		//获取要操作的数据,默认为 费用, 多次费用, 奖金费用.
		foreach ( $typeArr as $val ) {
			$arr [$val] = $this->basicRet ( $val );
		}
		//定义需要合并的数组        
		foreach ( $arr as $aVal ) {
			foreach ( $needArr as $nV ) {
				$ret [$aVal ['uID']] [$nV] += $aVal [$nV];
			}
		}
		return $ret;
	}
	
	#获取操作数组的基本信息,如 unitID,month,salaryDate等 不累加的信息
	public function AFee($type = "fee", $mul = null, $needArr = array("zID", "month", "unitID", "salaryDate", "soInsDate", "HFDate", "comInsDate", "managementCostDate")) {
		$pdo = $this->pdo;
		$unitID = $this->unitID;
		$month = $this->month;
		$monthType = $this->monthType;
		foreach ( $needArr as $nV ) {
			$fieldStr .= $nV . ",";
		}
		$fieldStr = rtrim ( $fieldStr, "," );
		switch ($type) {
			case "mulFee" :
				if ($mul == "mul")
					$sql = "select extraBatch,$fieldStr from a_mul_originalFee_tmp where unitID in ($unitID) and " . $monthType . " in ($month) group by extraBatch";
				elseif ($mul == "yet")
					$sql = "select extraBatch,$fieldStr from a_mul_originalFee where unitID in ($unitID) and " . $monthType . " in ($month) group by extraBatch";
				break;
			case "reward" :
				if ($mul == "mul")
					$sql = "select extraBatch,$fieldStr from a_reward_tmp where unitID in ($unitID) and " . $monthType . " in ($month) group by extraBatch";
				elseif ($mul == "yet")
					$sql = "select extraBatch,$fieldStr from a_reward where unitID in ($unitID) and " . $monthType . " in ($month) group by extraBatch";
				break;
			case "fee" :
				$sql = "select $fieldStr from a_originalFee_tmp where unitID in ($unitID) and " . $monthType . " in ($month) limit 1";
				break;
		}
		$ret = SQL ( $pdo, $sql );
		if ($type != "fee")
			$ret = keyArray ( $ret, "extraBatch" );
		return $this->actionArr = $ret;
	}
	
	#获取劳务费相关的数组,各类费用类型独立的数组 , 累加相关的项目 ($mul=有需要显示批次的, $totalType 需要的是所有工资批次的累计数, $needArr 需要合计的项目 $basicArr 例如 name,uID不合计的项目 )
	public function BFee($mul = null, $totalType = null, $needArr = array("uSoIns", "pSoIns", "uHF", "pHF", "uComIns", 'pComIns', "uPDIns", "managementCost"), $basicArr = null) {
		switch ($totalType) {
			case "feeTmp" :
				$actionArr = mergeArray ( $this->basicTmpRet ( "fee" ), $this->basicTmpRet ( "mulFee" ) );
				break;
			case "fee" :
				$actionArr = mergeArray ( $this->basicRet ( "fee" ), $this->basicRet ( "mulFee" ) );
				break;
			default :
				$actionArr = $this->actionArr;
				break;
		}
		foreach ( $actionArr as $key => $val ) {
			if ($basicArr)
				foreach ( $basicArr as $bv ) {
					if ($mul == "mul") :
						$ret [$val ['uID']] [$val ['extraBatch']] [$bv] = $val [$bv];
					 else :
						$ret [$val ['uID']] [$bv] = $val [$bv];
					endif;
				}
			foreach ( $needArr as $nV ) {
				if ($totalType == "feeTmp" && $nV == "uSoIns") {
					$val [$nV] = (( double ) $val ['uPension'] + ( double ) $val ['uHospitalization'] + ( double ) $val ['uEmploymentInjury'] + ( double ) $val ['uUnemployment'] + ( double ) $val ['uBirth']);
				}
				if ($mul == "mul") :
					$ret [$val ['uID']] [$val ['extraBatch']] [$nV] += $val [$nV];
				 else :
					$ret [$val ['uID']] [$nV] += $val [$nV];
				endif;
			}
		}
		return $ret;
	}
	
	#获取劳务费相关的数组, 不区分个人的单位合计累加相关的项目 ($mul=有需要显示批次的, $totalType 需要的是所有工资批次的累计数, $needArr 需要合计的项目 $basicArr 例如 name,uID不合计的项目 )
	public function BFeeTotal($mul = null, $totalType = null, $needArr = array("uSoIns", "pSoIns", "uHF", "pHF", "uComIns", 'pComIns', "uPDIns", "managementCost"), $basicArr = null) {
		switch ($totalType) {
			case "feeTmp" :
				$actionArr = mergeArray ( $this->basicTmpRet ( "fee" ), $this->basicTmpRet ( "mulFee" ) );
				break;
			case "fee" :
				$actionArr = mergeArray ( $this->basicRet ( "fee" ), $this->basicRet ( "mulFee" ) );
				break;
			default :
				$actionArr = $this->actionArr;
				break;
		}
		foreach ( $actionArr as $key => $val ) {
			if ($basicArr)
				foreach ( $basicArr as $bv ) {
					if ($mul == "mul") :
						$ret [$val ['extraBatch']] [$bv] = $val [$bv];
					 else :
						$ret [$bv] = $val [$bv];
					endif;
				}
			foreach ( $needArr as $nV ) {
				if ($totalType == "feeTmp" && $nV == "uSoIns") {
					$val [$nV] = (( double ) $val ['uPension'] + ( double ) $val ['uHospitalization'] + ( double ) $val ['uEmploymentInjury'] + ( double ) $val ['uUnemployment'] + ( double ) $val ['uBirth']);
				}
				if ($mul == "mul") :
					$ret [$val ['extraBatch']] [$nV] += $val [$nV];
				 else :
					$ret [$nV] += $val [$nV];
				endif;
			}
		}
		return $ret;
	}
	
	#获取发放表合计数(还未做过测试, 不确定是否准确)
	public function totalFee($mul = null) {
		$actionArr = $this->actionArr;
		$salaryNeedArr = array (
				"pay",
				"acheive",
				"pTax",
				"pSoIns",
				"pHF",
				"pComIns",
				"helpCost" 
		);
		$feeNeedArr = array (
				"pay",
				"totalFee",
				"uSoIns",
				"uHF",
				"uComIns",
				"uPDIns",
				"managementCost" 
		);
		foreach ( $actionArr as $key => $val ) {
			if ($val ['pay'] > 0) {
				foreach ( $salaryNeedArr as $nV ) {
					if ($mul == "mul") :
						$salary [$val ['extraBatch']] ['num'] += 1 / 7;
						$salary [$val ['extraBatch']] [$nV] += $val [$nV];
					 else :
						$salary ['num'] += 1 / 7;
						$salary [$nV] += $val [$nV];
					endif;
				}
			}
			foreach ( $feeNeedArr as $fv ) {
				if ($mul == "mul") :
					$fee [$val ['extraBatch']] ['num'] += 1 / 7;
					$fee [$val ['extraBatch']] [$fv] += $val [$fv];
				 else :
					$fee ['num'] += 1 / 7;
					$fee [$fv] += $val [$fv];
				endif;
			}
			if ($mul == "mul") :
				$salary [$val ['extraBatch']] ['num'] = round ( $salary [$val ['extraBatch']] ['num']);
				$fee [$val ['extraBatch']] ['num'] = round ( $fee [$val ['extraBatch']] ['num'] );
			 else :
				$salary ['num'] = round ( $salary ['num']);
				$fee ['num'] = round ( $fee ['num']);
			endif;
		}
		return $ret = array (
				"fee" => $fee,
				"salary" => $salary
		);
	}
}

?>
