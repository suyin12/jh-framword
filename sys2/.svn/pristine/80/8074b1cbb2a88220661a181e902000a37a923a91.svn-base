<?php
class latesoins{
	public $tableName="d_soinslate_tmp";
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
	function addsoInslate($arr){
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
	function getListAll($month,$columList="*"){
		return $arr=db::select($this->tableName, $columList,"where paydate='{$month}'");
	}
	function selectListArr($id,$columList="*"){
		return $arr=db::select($this->tableName,$columList,"where id='{$id}'","order by id desc");
	}
	#所有补缴年月
	function getsoInsAll($fID,$columList="distinct `paydate`"){
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
	#合计社保总费用
	function TotalsoinsArr($latesoinsListArr,$current_month){
		$sql = "select ID from a_action_record where month='{$current_month}' and type like '%agentSS%'";
    	$agent = db::query($sql);
    	if(empty($agent)){
			foreach ($latesoinsListArr as $k =>$v ){
				foreach ($v as $kk => $vv) {
			    	switch ($kk) {
			            case "latepay":
			            case "basicPension":
			            case "latemanagementCost":
			                if (is_numeric($vv)) {
			                    $TsoinsArr[$kk]+=round((double) $vv, 2);
			                    $latesoinsListArr[$k][$kk]=(float)$vv;
			                } else {
			                    $TsoinsArr[$kk] = null;
			                }
			                break;
			            default:
			                break;
			    	}
			    }
			}
    	}
    	//echo "<pre>";var_dump($TsoinsArr);
		return $TsoinsArr;
	}
	#合计补缴应缴数
	function expenlatesoins($paydate){
		$ListAll = $this->getListAll($paydate,"distinct `fID`");
		foreach ($ListAll as $k =>$v ){
			$lateListArr = $this->getListByfID($v['fID'],$paydate);
    		$TsoinsArr = $this->TotalsoinsArr($lateListArr,$paydate);
    		$Tsoins = $TsoinsArr["latepay"] + $TsoinsArr["basicPension"];
    		$newArr[$v["fID"]]["latesoIns"] = $Tsoins;
		}
		return $newArr;
	}
	
	
	
	
}