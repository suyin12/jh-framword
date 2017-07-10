<?php
/*
作者：LOSKIN
time:2013-03-01
描述：缴交明细表（社保）
更新：
	
*/
class SoFee{
	protected  $tableName="d_soInsFee_tmp";
	function getListBysoInsID($where){
		$arr=db::select($this->tableName,"*",$where);
		return $arr;
	}
	function getTotalByDate($where,$columList="*",$order="order by fID desc"){
		$arr=db::select($this->tableName,$columList,$where,$order);
		return $arr;
	}
	#用系统折算得出应缴社保费$list包含	fID参社保人ID 不计算
	function SoFeeprice($list,$soInsDate){
		foreach ($list as $k =>$v){
			//echo $v["fID"];
		}
	}
	#查询个人社保最后
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}