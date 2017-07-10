<?php

/**
 * Description of soins\HF\comIns Paymoney
 * Description 计算该单位的本月社保\公积金\商保实际缴交金额\用工单位信息,涉及多个表
 * @author loskin 
 * update time 2014-08-15
 */
class Insurance {
	public $pdo;
	public $unitID; //string or array 单位编号
    public $SqlStr;
    public $day_start;
    public $day_end;

    #post构造
    public function Sqlstr($post){
        foreach($post as $k=>$v){
            switch($k){
                case "day_start":
                case "day_end":
                    break;
                default:
                    $SqlStr  .=",`{$k}`";
                    break;
            }
        }
        $SqlStr ="`uID`,`name`,`month`{$SqlStr}";
        $this->Sqlstr = $SqlStr;
        return $SqlStr ;
    }
    #获取该单位人员的费用明细
    public function basicRet($tableType){
        $pdo = $this->pdo;
        $unitID = $this->unitID;
        $SqlStr = $this->Sqlstr;
        $day_start = $this->day_start;
        $day_end = $this->day_end;
        switch ($tableType) {
            case "fee" :
                $Sql = "select {$SqlStr} from a_originalfee where unitID='{$unitID}' and month between {$day_start} and {$day_end}";
                break;
            case "mul":
                $Sql = "select {$SqlStr} from a_mul_originalfee where unitID='{$unitID}' and month between {$day_start} and {$day_end}";
                break;
            case "rew":
                $Sql = "select `uID`,`name`,`month`,`unitID`,`totalFee`,`acheive` from a_rewardfee where unitID='{$unitID}' and month between {$day_start} and {$day_end}";
                break;
        }
        $ret = SQL ( $pdo, $Sql , null);
        return $ret;
    }
    #//返回需要输出数组的结构形式
    public function Retarr($arr){
        if(!empty($arr)){
            foreach ($arr as $key=>$val){
                foreach($val as $k=>$v){
                    switch($k){
                        case "uID":
                        case "name":
                        case "month":
                        case "unitID":
                            //$arr [$val['uID']][$val['month']][$k] = $val[$k];
                            break;
                        default:
                            $ret [$val['uID']][$val['month']][$k] += $val[$k];
                            break;
                    }
                }
            }
        }
        return $ret;
    }
    #处理数组输出将结果
    public function RetTotal($Arr,$Brr,$Crr){
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
                    case "name":
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
	#获取该单位的本月社保\公积金\商保实际缴交金额\,tableType : 查询表信息
	public function sumTotal($tableType , $month){
		$pdo = $this->pdo;
		$unitID = $this->unitID;
		$sql = "";
		if($tableType == 'soIns'){
			$sql = "select sum(pTotal) as pTotal,sum(uTotal) as uTotal from a_soInsfee_tmp where `soInsDate` like '{$month}' and `unitID` like '{$unitID}'";
		}else if($tableType == 'HF'){
			$sql = "select sum(pTotal) as pTotal,sum(uTotal) as uTotal from a_hffee_tmp where `HFDate` like '{$month}' and `unitID` like '{$unitID}'";
		}else if($tableType == 'comIns'){
			// $comInsSql = "select sum(y.comInsMoney) as comInsR from ( SELECT a.unitID,b.comInsType from a_comInsList a left join a_unitInfo b on a.unitID=b.unitID where a.batch like 'Com.$exRet[comInsDate]' and a.unitID like :unitID) x LEFT join s_comins_set y  on  x.comInsType=y.comInsType ";
			$sql = "SELECT a.unitID,sum(b.`uComInsMoney`+b.`pComInsMoney`) as comInsR,b.comInsType from a_comInsList a left join a_unitInfo b on a.unitID=b.unitID where a.batch like '{$month}' and a.unitID like '{$unitID}' ";
		}
		$Ret = SQL($pdo,$sql,null,'one');
		return $Ret;
	}
}