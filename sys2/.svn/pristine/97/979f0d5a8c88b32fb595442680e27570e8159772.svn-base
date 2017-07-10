<?php
/*
作者：LOSKIN
time:2013-03-17
描述：缴交明细表（公积金）
更新：
	
*/
class HFFee{
	protected  $tableName="d_hffee_tmp";
	#查询
	function getListBysoInsID($where){
		$arr=db::select($this->tableName,"*",$where);
		return $arr;
	}
	function getTotalByDate($where,$columList="*",$order="order by fID desc"){
		$arr=db::select($this->tableName,$columList,$where,$order);
		return $arr;
	}
	function getHFMonAll($k){
		$arr=array();
		$start=date("Ym")."15";
		for($i=0;$i<$k;$i++){
			$kk=date("Ym",strtotime("-{$i} months",strtotime($start)));
			$vv=date("Y年m月",strtotime("-{$i} months",strtotime($start)));
			$arr[$kk]=$vv;
		}
		return $arr;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}