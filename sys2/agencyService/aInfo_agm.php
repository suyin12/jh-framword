<?php
/*
作者：LOSKIN
time:2013-03-01
描述：基本信息表
更新：
	
*/
class aInfo{
	protected  $tableName="d_agent_personalinfo";
    public $x;
	function getWhere($get){
		$where="";
		foreach ($_GET as $k=>$v){
			switch ($k){
				
			}
		}
		if(!empty($where)){
			$where=substr($where,"4");
			$where="where ".$where;
		}
		return $where;
	}
    #加载连接各种设置类
    public function agmLinkClass($pdo) {
        require_once 'agmLink.class.php';
        $x = new agmLink($pdo);
        return $this->x = $x;
    }
	function getPlByfID($id,$columList="*",$where="",$order="order by id desc"){
		$arr=db::select($this->tableName, $columList,"where id='{$id}'",$order);
		if(is_array($arr)){
			return $arr[0];
		}else {
			return false;
		}
	}
	function getPlList($where="",$columList="*",$limit,$order="order by id desc"){
		//id倒序排列，limit子句
		return db::select($this->tableName,$columList,$where,$limit,$order);
	}
	#系统折算得个代中应缴社保费      $soInsDate缴交社保的年月
	function SoAgmprice($soInsDate,$pdo){
		$fee=new feeExtra($pdo);
		$fee->soInsMonlist("distinct `month`","order by month asc");
		$where="where soInsurance!='0'";
		$columList="id,name,soInsurance,soInsModifyDate,PDIns,radix,domicile,status,cBeginDay,cEndDay,hospitalization,pension,employmentInjury,unemployment";
		$arr=$this->getPlList($where,$columList);
		$newArr=array();
		foreach ($arr as $k =>$v){
			if($v["status"]=="4"){
				$newArr[$v["id"]] = $fee->exSosuss($v);
			}else{
				$newArr[$v["id"]] = $fee->soInsFun($v,$soInsDate);
			}
		}
	/*	echo "<pre>";
		var_dump($newArr);*/
		return $newArr;
	}
	#系统折算得个代中应缴公积金费   
	function HFAgmprice($HFDate,$pdo){
		$fee=new feeExtra($pdo);
		$where="where housingFund!='0'";
		$columList="`id`,`name`,`HFRadix`,`uHFPer`,`pHFPer`,`housingFund`,`status`,`hBeginDay`,`hEndDay`";
		$arr=$this->getPlList($where,$columList);
		$newArr=array();
        //echo "<pre>";var_dump($arr);
		foreach ($arr as $k =>$v){
			if($v["status"]=="4"){
				$s=$fee->exmoths($v["hBeginDay"],$v["hEndDay"]);
				$priceArr=$fee->HFFun($v,$HFDate);
				$NewPriceArr=array(
					"uTotal" => (int)$priceArr["uTotal"] * $s,
					"pTotal" => (int)$priceArr["pTotal"] * $s,
				);
				$newArr[$v["id"]] = $NewPriceArr;
			}else{
				require_once 'lateHF_agm.php';
				$lateHF = new lateHF();
				$lateHFListArr = $lateHF->getListByfID($v['id'],$HFDate);
                //echo "<pre>";var_dump($lateHFListArr);
				$THFArr = $lateHF->TotalHFArr($lateHFListArr,$HFDate);
				$THF = $THFArr["total"];
				$arrHF = $fee->HFFun($v,$HFDate);
				$a = $arrHF["uTotal"] +  $arrHF["pTotal"];
				$newArr[$v["id"]] = (int)$THF + $a;
			}
		}
		return $newArr;
	}
	#协议过期，社保过期或者是公积金过期********续签
	function statusAgents($v,$pdo){
		$fee=new feeExtra($pdo);
		$current_date = date("Y-m-d");
		$s=$fee->exdays($current_date,$v['cEndDay']);
		if($s>0 && $s<insuranceInTurn("soIns") && $v["soInsurance"]=="1"){
			if($v["status"]!=="5")
				$v["status"]="5";
		}else if($v["soInsurance"]=="1" && $v["status"]=="5"){
				$v["status"]="1";
		}
		
		$h=$fee->exdays($current_date,$v['hEndDay']);
		if($h>0 && $h<insuranceInTurn("HF") && $v["housingFund"]=="1"){
			if($v["status"]!=="5")
				$v["status"]="5";
		}else if($v["housingFund"]=="1" && $v["status"]=="5"){
				$v["status"]="1";
		}
		
		return $v["status"];
	}
	#判断所缴社保是在哪个台账年月
	function soInspaydate($NewMonth){
		if(date("d")>insuranceInTurn("soIns")){
			$NewMonth = date("Ym",strtotime("+1 months"));
		}
		return $NewMonth;
	}
	#判断所缴公积金是在哪个台账年月
	function HFpaydate($NewMonth){
		if(date("d")>insuranceInTurn("HF")){
			$NewMonth = date("Ym",strtotime("+1 months"));
		}
		return $NewMonth;
	}
    #余额
    function remain($id){
        $arr=db::select($this->tableName,"remain","where id='{$id}'");
        if(is_array($arr)){
            return $arr[0]['remain'];
        }else{
            return false;
        }
    }
    #所有人的余额
    function remainsAll(){
        $agm_arr = $this -> getPlList("","`id`,`remain`");
        foreach ($agm_arr as $v){
            $newArr[$v["id"]] = round($v['remain'],2);
        }
        return $newArr;
    }
    #1、缴费(充值和转账)2、退帐3、结账 更新账户余额
    function remainOne($income,$id){
        $remain = $this->remain($id);
        $remain = round($income + $remain, 2);
        $remain_arr = array(
            'id' => $id,
            'remain' => $remain
        );
        db::update($this->tableName,$remain_arr,"id");
    }
    function remainTwo($id){
        $remain_arr = array(
            'id' => $id,
            'remain' => 0
        );
        db::update($this->tableName,$remain_arr,"id");
    }

    function remainThree($type,$paydate){
        $x = $this->agmLinkClass();
        $b = $x->classBill();
        $bill_arr = $b->getArr("2",$paydate);
        $remainsAll = $this->remainsAll();
        $statusArr = $b-> status("2",$paydate);
        //echo "<pre>";var_dump($statusArr);
        if($type == '1'){
            #退正常社保费用和残障金
            foreach($bill_arr as $k=>$v){
                if($statusArr[$k]["soIns"]=="1" || $statusArr[$k]["soIns"]=="5"){
                    db::update($this->tableName,array("id"=>$k,"remain"=>$remainsAll[$k]+$v["soIns"]+$v["PDIns"]),"id");
                }
            }
        }elseif($type == '2'){
            foreach($bill_arr as $k=>$v){
                if($statusArr[$k]["latesoIns"]=="1" || $statusArr[$k]["latesoIns"]=="5"){
                    db::update($this->tableName,array("id"=>$k,"remain"=>$remainsAll[$k]+$v["latesoIns"]),"id");
                }
            }
        }elseif($type == '3'){
            foreach($bill_arr as $k=>$v){
                if(array_key_exists("HF",$bill_arr[$k])){
                    $query[] = "delete from d_agent_bill where fID='$k' and type='2' and payment='3' and paydate like '$paydate'";
                    if($statusArr[$k]["HF"]=="1" || $statusArr[$k]["HF"]=="5"){
                        db::update($this->tableName,array("id"=>$k,"remain"=>$remainsAll[$k]+$v["HF"]),"id");
                    }
                }
            }
            if (count($query) > 0) {
                foreach($query as $v){
                    db::query($v);
                }
            }
        }
        return 1;
    }
    function remainsOld($tableName,$cols,$where,$limit,$order){
        $arr=db::select("d_agent_bill","remains",$where,$limit,$order);
        if(is_array($arr)){
            return $arr[0]['remains'];
        }else{
            return false;
        }
    }
	function addOne(){
        #初始化员工信息表里的余额
        $re = $this->getPlList("where remain>0","id");
        if(empty($re)){
            $agm_arr = db::select("d_agent_bill","`fID`");
            foreach ($agm_arr as $v){
                $remains = $this->remainsOld("d_agent_bill","remains","where fID=\"{$v['fID']}\" and status='1'","limit 1","order by id desc");
                $newArr[$v["fID"]] = round($remains,2);
            }
            foreach ($newArr as $k=>$v) {
                $a_arr = array(
                    'id' => $k,
                    'remain' => $v
                );
                $re = db::update("d_agent_personalinfo",$a_arr,"id");
            }
        }
    }



}