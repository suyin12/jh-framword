<?php
class lateHF{
	public $tableName="d_hflate_tmp";
	
	#判断传值的补缴月份是否已经存在
	function monthisIN($fID,$latepaymonth){
		$arr = db::select($this->tableName,"`id`,`fID`,`latepaymonth`","where latepaymonth='{$latepaymonth}' and fID='{$fID}'");
		if(is_array($arr)){
			return $arr[0];
		}else {
			return false;
		}
	}
	#添加补缴记录
	function addHFlate($arr){
		return db::insert($this->tableName, $arr);
	}
	#删除补缴记录
	function delLateByID($arr) {
		return db::delete($this->tableName,$arr);
	}
	#查询
	function getListByfID($fID,$month){
		return $arr=db::select($this->tableName, "*","where fID='{$fID}' and paydate='{$month}'");
	}
	function selectListArr($id,$columList="*"){
		return $arr=db::select($this->tableName,$columList,"where id='{$id}'","order by id desc");
	}
	#所有补缴年月
	function getHFAll($fID,$columList="distinct `paydate`"){
		$arr=db::select($this->tableName, "{$columList}","where fID='{$fID}'");
		$s=count($arr);
		if(is_array($arr)){
			foreach ($arr as $key=>$val){
				foreach ($val as $kk => $vv){
					$c = $vv."01";
					$date=date("Y年m月",strtotime("{$c}"));
					$Newarr[$vv]="{$date}";
				}
			}
		}else{
			return false;
		}
		return $Newarr;
	}
	#合计公积金总数
	function TotalHFArr($lateHFListArr,$current_month){
		$sql = "select ID from a_action_record where month='{$current_month}' and type like '%agentH%'";
    	$agent = db::query($sql);
    	if(empty($agent)){
	    	foreach ($lateHFListArr as $k =>$v ){
				foreach ($v as $kk => $vv) {
			    	switch ($kk) {
			            case "total":
			            case "latemanagementCost":
			                if (is_numeric($vv)) {
			                    $THFArr[$kk]+=round((double) $vv, 2);
			                    $lateHFListArr[$k][$kk]=(float)$vv;
			                } else {
			                    $THFArr[$kk] = null;
			                }
			                break;
			            default:
			                break;
			    	}
			    }
			}
    	}
		//echo "<pre>";var_dump($THFArr);
		return $THFArr;
	}

	
	
	
	
}