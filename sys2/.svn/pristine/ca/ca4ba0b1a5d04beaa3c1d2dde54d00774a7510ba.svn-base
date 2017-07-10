<?php
/*
作者：LOSKIN
time:2013-03-01
描述：流水账表
更新：
	
*/
class bill{
	protected  $tableName="d_agent_bill";
	function getWhere($get){
		$where="";
		foreach ($_GET as $k=>$v){
			switch ($k){
				case 'type':
					if(!empty($v))
						$where.=" and type='{$v}'";
					break;
				case 'payment':
					if(!empty($v))
						$where.=" and payment='{$v}'";
					break;
				case 'fID':
					if(!empty($v))
						$where.=" and fID='{$v}'";
					break;
				case 'modifydate':
					if(!empty($v))
						$where.=" and lastModifyTime like '{$v}%'";
					break;
			}
		}
		if(!empty($where)){
			$where=substr($where,"4");
			$where="where ".$where;
		}
		return $where;
	}
	function getBlList($where="",$columList="*",$limit,$order="order by id desc",$group){
		//id倒序排列，limit子句
		return db::select($this->tableName,$columList,$where,$limit,$order,$group);
	}
	function getBlByfID($fID,$where="",$order="order by id desc"){
		if($fID && !empty($where)){
			$where.=" and fID='{$fID}'";
		}
		$arr=db::select($this->tableName, "*",$where,$order);
		if(is_array($arr)){
			return $arr[0];
		}else {
			return false;
		}
	}
	#不重复的fID
	function getBltotal($where="",$order="order by fID desc"){
		return db::select($this->tableName,"distinct fID",$where,$order);
	}
	
	#总条数
	function getBlcount($where=""){
		$arr=db::select($this->tableName,"count(*) as num",$where);
		if(is_array($arr)){
			return $arr[0]['num'];
		}else{
			return false;
		}
	}
	#显示前3个月流水账年月
	function getBlmonth($months="",$where="",$columList="distinct lastModifyTime",$order="order by id desc"){
		$arr=db::select($this->tableName,$columList,$where,$limit,$order);
		if(is_array($arr)){
			foreach ($arr as $key=>$val){
				$mon=date("Y-m",strtotime("{$val["lastModifyTime"]}"));
				$date=date("Y年m月",strtotime("{$val["lastModifyTime"]}"));
				$Newarr[$mon]="{$date}";
			}
		}else{
			return false;
		}
		$i=1;
		foreach ($Newarr as $k=>$v){
			$i++;
			$brr[$k]="{$v}";
			if($i>$months){
				break;
			}
		}
		return $brr;
	}
	#结算
	public function clearing($val){
		$day = date("d");
		$thisMonth = date("Ym");
		$lastMonth = date("Ym",strtotime("-1 month"));
		//$PArr = $aInfo->getPlByfID($val["id"],"`name`,`soInsurance`,`housingFund`");
		if($day<insuranceInTurn("HF")){
			$sql = "select ID from a_action_record where month='{$lastMonth}' and type like '%agent%'";
	    	$agent = db::query($sql);
	    	if(empty($agent)){
	    		$clearing = "(资金冻结, $lastMonth 未入账)";
	    	}
		}else{
			$sql = "select ID from a_action_record where month='{$thisMonth}' and type like '%agent%'";
	    	$agent = db::query($sql);
	    	if(empty($agent)){
				$clearing = "(资金冻结, $thisMonth 未入账)";
	    	}
		}
		//echo "<pre>";var_dump($agentS);                                         
		return $clearing;
	}
	#余额
	public function remains ($fID) {
        $arr=db::select("d_agent_personalinfo","remain","where id='{$fID}'");
        if(is_array($arr)){
            return $arr[0]['remain'];
        }else{
            return false;
        }
	}
	#所有人的余额
	function remainsAll(){
        $agm_arr = db::select("d_agent_personalinfo","`id`,`remain`");
        foreach ($agm_arr as $v){
            $newArr[$v["id"]] = round($v['remain'],2);
        }
		return $newArr;
	}

	function expenditure($arr,$mess,$payment="9",$paydate){
		#初始化流水账明细数组配置
		#$paydate缴交的月份 type余额支付
		if(!empty($arr["fID"])){
			//$remain=$this->remains($arr['fID']);
			$billArr=array(
				"fID" => $arr["fID"],
				"paydate" => $paydate,
				"payment" => $payment,
				"type" => "2",
				"mess" => "{$mess}",
				"expenditure" => $arr["total"],
				"lastModifyBy" => $_SESSION['exp_user']['mName'],
				"lastModifyTime" => date('Y-m-d H:i:s')
			);
			$re=db::insert($this->tableName,$billArr);
		}
		return $re;
	}
	function expenditure2($arr,$mess,$payment="9",$paydate){

		#初始化流水账明细数组配置
		#$paydate缴交的月份 type余额支付
		if(!empty($arr["fID"])){
			$remain = $this->remains($arr['fID']);
			
			$billArr=array(
				"fID" => $arr["fID"],
				"paydate" => $paydate,
				"payment" => $payment,
				"type" => "2",
				"mess" => "{$mess}",
				"expenditure" => $arr["total"],
				"remains" => $remain,
				"lastModifyBy" => $_SESSION['exp_user']['mName'],
				"lastModifyTime" => date('Y-m-d H:i:s'),
				"status" => "1"
			);
			$re=db::insert($this->tableName,$billArr);
		}
		return $re;
	}
	function expenpay($fIDArr,$paydate,$pdo){
		$billArr = $this-> getArr("2",$paydate);
		$statusArr = $this-> status("2",$paydate);
		$remainsArr = $this->remainsAll();
        $current_time = date('Y-m-d H:i:s');
		//echo "<pre>";var_dump($statusArr);
        //echo date("H:i:s")."<br/>";

		foreach ($fIDArr as $k => $v) {
			if($statusArr[$v]["PDIns"]=="0" || $statusArr[$v]["PDIns"]=="2"){
                $remainsArr[$v] = $remainsArr[$v]-$billArr[$v]["PDIns"];
				$PDInsSQl[$v] = "update d_agent_bill set remains='{$remainsArr[$v]}',status='1' where fID='{$v}' and paydate='{$paydate}' and payment='4' and type='2'";
			}
			if($statusArr[$v]["HF"]=='0' || $statusArr[$v]["HF"]=="2"){
                $remainsArr[$v] = $remainsArr[$v]-$billArr[$v]["HF"];
				$sql="update d_agent_bill set remains='{$remainsArr[$v]}',status='1',lastModifyTime='$current_time' where fID='{$v}' and paydate='{$paydate}' and payment='2' and type='2'";
				db::query($sql);
				$re = true;
			}
			if($statusArr[$v]["latesoIns"]=='0' || $statusArr[$v]["latesoIns"]=="2"){
                $remainsArr[$v] = $remainsArr[$v]-$billArr[$v]["latesoIns"];
				$sql="update d_agent_bill set remains='{$remainsArr[$v]}',status='1',lastModifyTime='$current_time' where fID='{$v}' and paydate='{$paydate}' and payment='5' and type='2'";
				db::query($sql);
				$re = true;
			}
            if($statusArr[$v]["soIns"]=="0" || $statusArr[$v]["soIns"]=="2"){
                $remainsArr[$v] = $remainsArr[$v]-$billArr[$v]["soIns"];
                $soinsSQl[$v]="update d_agent_bill set remains='{$remainsArr[$v]}',status='1',lastModifyTime='$current_time' where fID='{$v}' and paydate='{$paydate}' and payment='1' and type='2'";
            }
            db::update("d_agent_personalinfo",array("id"=>$v,"remain"=>$remainsArr[$v]),"id");
		}
        //echo date("H:i:s")."<br/>";
       //echo "<pre>";var_dump($PDInsSQl);var_dump($soinsSQl);
		if(!empty($PDInsSQl)){
			$re = extraTransaction($pdo, $PDInsSQl);
		}
        //echo date("H:i:s")."<br/>";
		if(!empty($soinsSQl)){
			$re = extraTransaction($pdo, $soinsSQl);
		}
        //echo date("H:i:s")."<br/>";
        //die();
		return $re;
	}
	#数组包含****支出的社保、公积金、管理费、残障金
	function getArr($type,$paydate,$fID){
		$where="where type='{$type}' and paydate='{$paydate}'";
		if(!empty($fID)){
			$where.=" and fID='{$fID}'";
		}
		$arr=db::select($this->tableName,"`fID`,`payment`,`expenditure`",$where,"order by fID desc");
		foreach ($arr as $k =>$v){
			foreach ($v as $kk=>$vv){
				if($kk=="payment"){
					switch ($vv){
						case "1" :
							$newArr[$v["fID"]]["soIns"]=$v["expenditure"];
							break;
						case "2" :
							$newArr[$v["fID"]]["HF"]=$v["expenditure"];
							break;
						case "3" :
							$newArr[$v["fID"]]["GuanLi"]=$v["expenditure"];
							break;
						case "4" :
							$newArr[$v["fID"]]["PDIns"]=$v["expenditure"];
							break;
						case "5" :
							$newArr[$v["fID"]]["latesoIns"]=$v["expenditure"];
							break;
						case "6" :
							$newArr[$v["fID"]]["lateGuanLi"]=$v["expenditure"];
							break;
						default :
							break;
					}
				}
			}
		}
		return $newArr;
	}
	#流水账支出是否有审核$payment(社保1、公积金2)
	function status($type="2",$paydate,$fID){
		$where="where type='{$type}' and paydate='{$paydate}'";
		if(!empty($fID)){
			$where.=" and fID='{$fID}'";
		}
		$arr=db::select($this->tableName,"`fID`,`status`,`payment`",$where,"order by fID desc");
		foreach ($arr as $k =>$v){
			foreach ($v as $kk=>$vv){
				if($kk=="payment"){
					switch ($vv){
						case "1" :
							$newArr[$v["fID"]]["soIns"]=$v["status"];
							break;
						case "2" :
							$newArr[$v["fID"]]["HF"]=$v["status"];
							break;
						case "3" :
							$newArr[$v["fID"]]["GuanLi"]=$v["status"];
							break;
						case "4" :
							$newArr[$v["fID"]]["PDIns"]=$v["status"];
							break;
						case "5" :
							$newArr[$v["fID"]]["latesoIns"]=$v["status"];
							break;
						case "6" :
							$newArr[$v["fID"]]["lateGuanLi"]=$v["status"];
							break;
						default :
							break;
					}
				}
			}
		}
		return $newArr;
	}
	#修改流水的审核状态updateByState(array("state"=>$_POST['state'],"id"=>$v));
	function updateStatus($status='1',$fID){
		$re=db::update($this->tableName, array("status"=>$status,"fID"=>$fID),"fID");
		return $re;
	} 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}