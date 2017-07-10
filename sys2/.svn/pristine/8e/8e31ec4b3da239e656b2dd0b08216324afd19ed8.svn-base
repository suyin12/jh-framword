<?php
/*
作者：LOSKIN
time:2013-12-23
描述：根据参保人的信息计算社保费等
更新：
*/
class feeExtra
{
    public $pdo; // pdo配置
    public $wArr; //员工信息
    public $month; //月份
    public $soInsDate; //社保年月
    public $HFDate; //公积金年月
    public $extraBatch; //批次
    public $soDateAll;//社保所有比例年月
    static $tableName="s_soIns_set";
    
	//构造函数经过实例化被调用
	function __construct($pdo) {
		$this->pdo=$pdo;
		new db($pdo);
	}
	function soInsMonStart(){
		$arr=db::select(self::$tableName,"distinct `month`","order by month","limit 1");
		return (int)$arr["0"]["month"];
	}
	function getSoInsMonAll(){
		//$statr=$this->soInsMonStart();
		$statr = 201101;
		$k=$statr."15";
		$date = date("Ym")."15";
		$i=$this->exmoths($statr."01",$date)-1;
		$arr=array();
		for($i;$i>=0;$i--){
			$kk=date("Ym",strtotime("+{$i} months",strtotime($k)));
			$vv=date("Y年m月",strtotime("+{$i} months",strtotime($k)));
			$arr[$kk]=$vv;
		}
		return $arr;
	}
	#查找所有社保比例年月信息
	function soInsMonlist($columList,$order){
		$tableName=self::$tableName;
		$soDateAll=db::select($tableName,$columList,$order);
		$this->soDateAll=$soDateAll;
	}
    #找出对应缴社保比例的年月
    function soInsMon($date){
    	$soDateAll=$this->soDateAll;
        foreach($soDateAll as $k=>$v){
        	if($v["month"]<=$date){
        		$Newdate=$v["month"];
        	}
        	$Maxdate=$v["month"];
        }
        if(empty($Newdate))
        	$Newdate=$Maxdate;
    	return $Newdate;
    }
    #社保系统设置比例表(正常交)
    function soInsSet($month)
    {
       	$soInsSql = "select * from s_soIns_set";
       	if(!empty($month)){
       		$soInsSql .= " where month='{$month}'";
       	}else{
       		$this->soInsMonlist("distinct `month`","order by month asc");
       		$Newdate = $this->soInsMon(date("Ym"));
       		$soInsSql .= " where month='{$Newdate}'";
       	}
        $pdo = $this->pdo;
        $soInsRes = $pdo->query($soInsSql);
        $R = $soInsRes->fetchAll(PDO::FETCH_ASSOC);
        $R = keyArray($R,'type');
        $soInsExtraSet = $this->soInsExtraSet();
        $soInsID = "171088";
        if( array_key_exists($soInsID,$soInsExtraSet )){
            foreach($R as $sy => $sr){
                foreach($sr as $sk=>$sv){
                    $R[$sy][$sk]=$soInsExtraSet[$soInsID][$sk]?$soInsExtraSet[$soInsID][$sk]:$sv;
                }
            }
        }
        return $R;
    }
	#社保特殊缴交比例设置
    function soInsExtraSet(){
        $pdo = $this->pdo;
        #社保缴交比例表
        $sql = "select * from s_soIns_extra_set";
        $res = $pdo->query($sql);
        $R = $res->fetchAll(PDO::FETCH_ASSOC);
        $R =keyArray($R,'soInsID');
        return $R;
    }
	function exSo($month,$fID){
		$where="";
		if(!empty($month)){
        	$where.=" and soInsDate='{$month}'";
        }
    	if(!empty($fID)){
        	$where.=" and fID='{$fID}'";
        }
		if(!empty($where)){
			$where=substr($where,"4");
			$where="where ".$where;
        }
		$re=db::select("d_soinsfee_tmp","fID",$where);
        return $re;
	}
	function exHf($month,$fID){
		$where="";
    	if(!empty($month)){
        	$where.=" and HFDate='{$month}'";
        }
    	if(!empty($fID)){
        	$where.=" and fID='{$fID}'";
        }
		if(!empty($where)){
			$where=substr($where,"4");
			$where="where ".$where;
        }
		$re=db::select("d_hffee_tmp","fID",$where);
        return $re;
	}
    #社保缴费明细	$month=>交社保的年月
    function exSohis($v,$month,$type="")
    {
	    if($v["status"]=="4"){
	    	$NewMon=$month;
	    	$soIns=$this->soInsFun($v,$month);
	    }else{
	    	$NewMon=date("Ym");
	    }
	    $Arr=array(
			"month"=>$NewMon,
			"fID"=>$v["id"],
			"lastModifyTime"=>timeStyle("dateTime"),
			"lastModifyBy"=>$_SESSION ['exp_user'] ['mName']
		);
		
		#当月总缴费金额应该判断是否加上残障金
		if($v["PDIns"])
			 $total=$soIns["uTotal"]+$soIns["pTotal"]+$soIns["uPDIns"];
		else
			 $total=$soIns["uTotal"]+$soIns["pTotal"];
			 //echo $total;66y
		if($v["status"]=="4"){
			$latepay=$this->exlatepay($month,$v["radix"]);
			$total=$total+$latepay["latepay"];
		}
		if($total=="0"){
			#该月份不存在补交缴费比例
		}elseif($type=="Yes"){
			$soInsArr=array_merge($Arr,$soIns);
			$tableName="d_soInsfee_tmp";
			$re=db::insert($tableName,$soInsArr);
		}
    	return $total;
    }
	#公积金费用计算
 	function exHfhis($v,$month,$type="")
    {
	    $HFFun=$this->HFFun($v,$month);
	  	$total=$HFFun["uTotal"]+$HFFun["pTotal"];
	    $Arr=array(
			"month"=>$month,
			"fID"=>$v["id"],
			"lastModifyTime"=>timeStyle("dateTime"),
			"lastModifyBy"=>$_SESSION ['exp_user'] ['mName'],
		);
		if($total=="0"){
			#该月份不存在缴费比例
		}elseif($type=="Yes"){
			$HFArr=array_merge($Arr,$HFFun);
			$tableName="d_hffee_tmp";
			$re=db::insert($tableName,$HFArr);
			$aSet = new agencySet();
			$aSet->p=$this->pdo;
			$Arr['total']=$total;
			$re=$aSet->expenditure($Arr,"缴当月公积金款");
		}
    	return $total;
    }
    #社保费缴费
    function exSohisto($total){
    	
    }
    #社保补缴滞纳金的计算
    function exlatepay($month,$basicPension,$closedate){
    	$closedate = date("Ymd",strtotime($closedate));
    	$a = date("Ym"."01",strtotime("+1 months",strtotime($month."01")));
    	$exdays = $this->exdays($closedate,$a) + 1;
    	//echo $radix."*0.21*".$exdays."*0.0005";
    	$latepay=round($basicPension * $exdays * 0.0005,2);
    	return $latepayArr=array(
    		"latepay" => $latepay,
    		"latepaydays" => $exdays
    	);
    }
    #社保补交费用的计算
    function exSosuss($v,$type="")
    {	
    	$s=$this->exmoths($v["cBeginDay"],$v['cEndDay']);
    	for ($i=0;$i<$s;$i++){
    		$date = date ("Ym", strtotime("+{$i} months", strtotime($v["cBeginDay"])));
    		$re=$this->exSo($date,$v['id']);
    		if(empty($re)){
    			$total=$this->exSohis($v,$date,$type);
    			$Arr=array(
					"month"=>$date,
					"fID"=>$v["id"],
					"lastModifyTime"=>timeStyle("dateTime"),
					"lastModifyBy"=>$_SESSION ['exp_user'] ['mName'],
    				"total"=>$total
				);
				$a=$a+$total;
				if($type=="Yes"){
					$aSet = new agencySet();
					$aSet->p=$this->pdo;
					$re=$aSet->expenditure($Arr,"缴该月补交社保款");
					$cmonths=$this->exmoths($v['cBeginDay'],$v['cEndDay'],$v['id']);
    				$hmonths=$this->exmoths($v['hBeginDay'],$v['hEndDay'],$v['id']);
	    			if($cmonths>=$hmonths){
						$Arr['total']=$v["managementCost"];
						$aSet->expenditure($Arr,"缴该月补交管理费");
					}
				}
    		}
    	}
        return $a;
    }
    #公积金补交
    function exHfsuss($v,$type=""){
    	$s=$this->exmoths($v["hBeginDay"],$v['hEndDay']);
    	$arr=array();
    	for ($i=0;$i<$s;$i++){
    		$date = date ("Ym", strtotime("+{$i} months", strtotime($v["hBeginDay"])));
    		$re=$this->exHf($date,$v['id']);
    		if(empty($re)){
    			$total=$this->exHfhis($v,$date,$type);
    			$Arr=array(
					"month"=>$date,
					"fID"=>$v["id"],
					"lastModifyTime"=>timeStyle("dateTime"),
					"lastModifyBy"=>$_SESSION ['exp_user'] ['mName'],
    				"total"=>$total
				);
    			$a=$a+$total;
    			if($type=="Yes"){
    				$aSet = new agencySet();
					$aSet->p=$this->pdo;
    				$cmonths=$this->exmoths($v['cBeginDay'],$v['cEndDay'],$v['id']);
    				$hmonths=$this->exmoths($v['hBeginDay'],$v['hEndDay'],$v['id']);
	    			if($hmonths>$cmonths){
						$Arr['total']=$v["managementCost"];
						$aSet->expenditure($Arr,"缴该月补交管理费");
					}
    			}
    		}
    	}
    	return $a;
    }
 	#社保完成补交的月份
    function exSosu($v)
    {	
    	$s=$this->exmoths($v["cBeginDay"],$v['cEndDay']);
    	$arr=array();
    	for ($i=0;$i<$s;$i++){
    		$date = date ("Ym", strtotime("+{$i} months", strtotime($v["cBeginDay"])));
    		$re=$this->exSo($date,$v['id']);
    		if (!empty($re)){
    			$arr[]=array("month"=>$date);
    		}
    	}
    	return $arr;
    }
	#公积金完成补交的月份
    function exHfsu($v){
    	$s=$this->exmoths($v["hBeginDay"],$v['hEndDay']);
    	$arr=array();
    	for ($i=0;$i<$s;$i++){
    		$date = date ("Ym", strtotime("+{$i} months", strtotime($v["hBeginDay"])));
    		$re=$this->exHf($date,$v['id']);
    		if (!empty($re)){
    			$arr[]=array("month"=>$date);
    		}
    	}
    	return $arr;
    }
    #相差多少月数
 	function exmoths($cB,$cE){
 		$s=round((strtotime($cE)-strtotime($cB))/(86400*30));
 		return $s;
 	}
	#社保剩余月数
	function cmoths($B,$E,$id){
		$cmonths=1;
		if($E>date("Y-m-d") && $B<date("Y-m-d")){
				$exHf=$this->exSo(date("Ym"),$id);
				$cmonths=$this->exmoths(date("Y-m")."-01",$E);
				if(!empty($exHf))
					$cmonths=$cmonths-1;
		}elseif($B>date("Y-m-d")){
			$cmonths=$this->exmoths($B,$E);
		}
		return (int)$cmonths;
	}
 	#公积金剩余月数
	function hmoths($B,$E,$id){
		$hmonths=1;
		if($E>date("Y-m-d") && $B<date("Y-m-d")){
				$exHf=$this->exHf(date("Ym"),$id);
				$hmonths=$this->exmoths(date("Y-m")."-01",$E);
				if(!empty($exHf))
					$hmonths=$hmonths-1;
		}elseif($B>date("Y-m-d")){
			$hmonths=$this->exmoths($B,$E);
		}
		return (int)$hmonths;
	}
	#管理费月数******根据交社保的月数，如果只交公积金按公积金月数
	function moths($cmonths,$hmonths){
		if(!empty($hmonths))
			if ($cmonths>$hmonths)
				$months=$cmonths;
			else
				$months=$hmonths;
		else
			$months=$cmonths;
		return $months;
	}
	
	#相差多少天数
 	function exdays($cB,$cE){
 		$s=round((strtotime($cB)-strtotime($cE))/(86400));
 		return $s;
 	}
 	#补缴养老金
 	function soInsPension($aValue,$month){
 	 	$date=$this->soInsMon($month);
        $soInsSet = $this->soInsSet($date);
        switch ($aValue) {
        	default :
            	$radix = $aValue ['radix'];
                foreach ($aValue as $aK => $aV) {
                	if ($aValue ['domicile'] == "1") {
                        $type = "1";
                    }
                    elseif ($aValue ['domicile'] == "2" && $aValue ['hospitalization'] == "2"){
                        $type = "2";
                    }
                    elseif ($aValue ['domicile'] == "2" && $aValue ['hospitalization'] == "4") {
                        $type = "3";
                    }
                    elseif ($aValue ['domicile'] == "2" && $aValue ['hospitalization'] == "1") {
                        $type = "4";
                    }
                    elseif (!$aValue ['domicile']) {
                        exit ($aValue ['name'] . ": 户籍类型或购买险种出错了,请联系管理员查证");
                    }
                    #每个险种缴交基数
                    switch ($aK) {
                        case "pension" :
                            if ($aV == "1") {
                                $uPension = round($radix * $soInsSet [$type] ['uPension'], 2);
                                $pPension = round($radix * $soInsSet [$type] ['pPension'], 2);
                            }
                            break;
                    }
                }
                 $soInsPension = array(
                    "uPension" => $uPension,
                    "pPension" => $pPension
                );
                break;
        }
        //单位合计不包括残障金,这样才可以规避残障金风险
        return $soInsPension;
 	} 
    #社保的计算方法
    public function soInsFun($aValue,$month)
    {	
        $date=$this->soInsMon($month);
        $soInsSet = $this->soInsSet($date);
        $societyAvg = $soInsSet[1]["societyAvg"];
        $minSalaryAvg = $soInsSet[1]["minSalaryAvg"];
        #如果封停日期在封帐日期之后,则收取对应社保月的社保费用
        $soInsInTurnDate = $month . "-" . 	("soIns");
        if ($aValue['soInsurance'] == '0' && strtotime($aValue['soInsModifyDate']) > strtotime($soInsInTurnDate)) {
            $pdo = $this->pdo;
            $sql = "select id,name,PDIns,radix,domicile,hospitalization,pension,employmentInjury,unemployment
                   from `d_agent_personalInfo_history` where `id` like '" . $aValue['id'] . "' and soInsurance !=0 order by lastModifyTime desc limit 1";
            $ret = SQL($pdo, $sql, null, 'one');
            $aValue = $ret;
        }
        switch ($aValue) {
            case "PDIns" :
                $soInsFun = round($societyAvg * 0.005 * 0.6, 2);
                break;
            default :
            	$radix = $aValue ['radix'];
                foreach ($aValue as $aK => $aV) {
                    if ($aValue ['domicile'] == "1") {
                        $type = "1";
                    }
                    elseif ($aValue ['domicile'] == "2" && ($aValue ['hospitalization'] == "2" || $aValue ['hospitalization'] == "0")){
                        $type = "2";
                    }
                    elseif ($aValue ['domicile'] == "2" && $aValue ['hospitalization'] == "4") {
                        $type = "3";
                    }
                    elseif ($aValue ['domicile'] == "2" && $aValue ['hospitalization'] == "1") {
                        $type = "4";
                    }
                    elseif (!$aValue ['domicile']) {
                        exit ($aValue ['name'] . ": 户籍类型或购买险种出错了,请联系管理员查证");
                    }
                    #每个险种缴交基数
                    switch ($aK) {
                        case "pension" :
                            if ($aV == "1") {
                                $uPension = round($radix * $soInsSet [$type] ['uPension'], 2);
                                $pPension = round($radix * $soInsSet [$type] ['pPension'], 2);
                            }
                            break;
                        case "employmentInjury" :
                            if ($aV == "1") {
                                $uEmploymentInjury = round($radix * $soInsSet [$type] ['uEmploymentInjury'], 2);
                            }
                            break;
                        case "unemployment" :
                            if ($aV == "1") {
                                $uUnemployment = round($minSalaryAvg * $soInsSet [$type] ['uUnemployment'], 2);
                                $pUnemployment = round($minSalaryAvg * $soInsSet [$type] ['pUnemployment'], 2);
                            }
                            break;
                        case "PDIns" :
                            if ($aV == "1") {
                                $uPDIns = round($societyAvg * 0.005 * 0.6, 2);
                            }
                            break;
                        case "hospitalization" :
	                        	switch ($aV) {
	                                //医疗部分,综合住院,单位医疗皆有生育险需加进去
	                                case "1" :
                                        $prsRadix = ($aValue ['radix'] > $soInsSet [$type] ['minRadix']) ? $aValue ['radix'] : $soInsSet [$type] ['minRadix'];
	                                    //两种计算方式
	                                    $uHospitalization = round(($prsRadix * $soInsSet [$type] ['uHospitalization']), 2) + round(($aValue ['radix'] * $soInsSet [$type] ['uBirth']), 2);
	                                    //$uHospitalization = round(($prsRadix * $soInsSet [$type] ['uHospitalization'] + $prsRadix * $soInsSet [$type] ['uBirth']), 2);
	                                    $pHospitalization = round($prsRadix * $soInsSet [$type] ['pHospitalization'], 2);
	                                    break;
	                                case "2" :
	                                    //两种计算方式
	                                    //$uHospitalization = round(($societyAvg * $soInsSet [$type] ['uHospitalization']), 2) + round(($societyAvg * $soInsSet [$type] ['uBirth']), 2);
	                                    $uHospitalization = round(($societyAvg * $soInsSet [$type] ['uHospitalization']),2)+ round(($aValue ['radix'] * $soInsSet [$type] ['uBirth']), 2)-0.01;
	                                    $pHospitalization = round($societyAvg * $soInsSet [$type] ['pHospitalization'], 2);
	                                    break;
	                                case "4" :
	                                	if($month>="201403"){
                        					#2014年3月后新医疗比例
                                            $uHospitalization = round(($societyAvg * $soInsSet [$type] ['uHospitalization']),2)+ round(( $aValue ['radix'] * $soInsSet [$type] ['uBirth']), 2);
                        					$pHospitalization = round($societyAvg * $soInsSet [$type] ['pHospitalization'], 2);
	                                	}else {
	                                		$uHospitalization = $soInsSet [$type] ['uCooperate'];
	                                    	$pHospitalization = $soInsSet [$type] ['pCooperate'];
	                                	}
                                    	break;
                            	}
                            	break;
                        default :
                            break;
                    }
                }
                $uTotal = round(($uPension + $uHospitalization + $uEmploymentInjury + $uUnemployment), 2);
                $pTotal = round(($pPension + $pHospitalization + $pUnemployment), 2);
                
                //1.获取社保费用数组(这里面含有残障金,但单位合计中不包含)
                $soInsFun = array(
                    "uTotal" => $uTotal,
                    "pTotal" => $pTotal,
                    "uPension" => $uPension,
                    "pPension" => $pPension,
                    "uHospitalization" => $uHospitalization,
                    "pHospitalization" => $pHospitalization,
                    "uEmploymentInjury" => $uEmploymentInjury,
                    "uUnemployment" => $uUnemployment,
                    "pUnemployment" => $pUnemployment,
                    "uPDIns" => $uPDIns
                );
                break;
        }
        //单位合计不包括残障金,这样才可以规避残障金风险
        return $soInsFun;
    }

    public function HFFun($aValue,$month)
    {
        #如果封停日期在封帐日期之后,则收取对应公积金月的公积金费用
        $HFInTurnDate = $month ."-". insuranceInTurn("HF");
        if ($aValue['housingFund'] == '0' && strtotime($aValue['HFModifyDate']) > strtotime($HFInTurnDate)) {
            $pdo = $this->pdo;
            $sql = "select `id`,`name`,`HFRadix`,`uHFPer`,`pHFPer`,`housingFund`
                   from `d_agent_personalInfo_history` where `id` like '" . $aValue['id'] . "' and housingFund !=0 order by lastModifyDate desc limit 1";
            $ret = SQL($pdo, $sql, null, 'one');
            $aValue = $ret;
        }

        $uTotal = round(($aValue ['HFRadix'] * $aValue ['uHFPer']), 2);
        $pTotal = round(($aValue ['HFRadix'] * $aValue ['pHFPer']), 2);

        $HFFun = array(
            "uTotal" => $uTotal,
            "pTotal" => $pTotal
        );
        return $HFFun;
    }

    #计算相应的社保,公积金,商保,管理费等
    private function mCostFun($wValue)
    {
        $unitArr = $this->unitArr;
        if ($unitArr ['mCostLimit']) {
            $mLimit = makeArray($unitArr ['mCostLimit']);
            $mCostDate = $this->mCostDate;
            $mCostDate = $mCostDate . "01";
            $firstday = (strtotime($wValue ['mountGuardDay']) > strtotime($mCostDate)) ? strtotime($wValue ['mountGuardDay']) : strtotime($mCostDate);
            if ($wValue ['status'] == "0") {
                $lastDay = strtotime($wValue ['dimissionDate']);
            }
            else {
                $lastDay = strtotime(date("Y-m-t", $firstday));
                //员工在职,且入职月份大于管理费月份,则不收取管理费,即 $lastDay =0
                if ($lastDay > strtotime(date("Y-m-t", strtotime($mCostDate))))
                    $lastDay = 0;
            }
            $t = date('t', $firstday);
            $days = ($lastDay - $firstday) / 86400 + 1;
            switch ($mLimit ['type']) {
                #多少天内(小于一个月)按多少比例结算
                case 'dailyLimit' :
                    $mCostLimit = $mLimit ['act'];
                    end($mCostLimit);
                    $lastKey = key($mCostLimit);
                    reset($mCostLimit);
                    foreach ($mCostLimit as $key => $val) {
                        if ($wValue ['status'] == "0") {
                            switch ($days) {
                                case ($days <= 0) :
                                    $mCost = 0;
                                    break;
                                case ($days <= $t && $days < $key) :
                                    $mCost = round(($wValue ['managementCost'] * $val), 2);
                                    break 2;
                                case ($days > $t && ($days - $t) < $key) :
                                    $mCost = round(($wValue ['managementCost'] * $val + $wValue ['managementCost']), 2);
                                    break 2;
                                case ($days > $t && ($days - $t) >= $lastKey) :
                                    $mCost = round(($wValue ['managementCost'] * 2), 2);
                                    break 2;
                                default :
                                    $mCost = $wValue ['managementCost'];
                                    break;
                            }
                        }
                        else {
                            if ($days > 0 && $days <= $key) { //如果入职的天数小于设定的参数天数,就计算并跳出循环
                                $mCost = round($wValue ['managementCost'] * $val, 2);
                                break;
                            }
                            elseif ($days < 0) {
                                $mCost = 0;
                            }
                            else {
                                $mCost = $wValue ['managementCost'];
                            }
                        }
                    }
                    break;
                #多少天内(大于一个月的)按多少比例结算,[仅限于目前广州莱帕德的管理费计算方式]
                case 'GZLPD' :
                    $mCostLimit = $mLimit ['act'];
                    end($mCostLimit);
                    $lastKey = key($mCostLimit);
                    reset($mCostLimit);
                    $firstday = (strtotime($wValue ['mountGuardDay']) < strtotime($mCostDate)) ? strtotime($wValue ['mountGuardDay']) : strtotime($mCostDate);
                    if ($wValue ['status'] == "0") {
                        //离职则以离职日期为准
                        $lastDay = strtotime($wValue ['dimissionDate']);
                        //如果离职月份小于管理费费用月份
                        if (strtotime(date("Y-m-t", $lastDay)) < strtotime($mCostDate))
                            $lastDay = 0;
                    }
                    else {
                        //每月15号为结算期
                        $lastDay = strtotime(date("Y-m-15", strtotime($mCostDate)));
                    }
                    $days = ($lastDay - $firstday) / 86400 + 1;

                    foreach ($mCostLimit as $key => $val) {
                        if ($wValue ['status'] == "0") {
                            switch ($days) {
                                case ($days <= 0) :
                                    $mCost = 0;
                                    break;
                                case ($days < $key) :
                                    $mCost = round(($wValue ['managementCost'] * $val), 2);
                                    break 2;
                                default :
                                    $mCost = $wValue ['managementCost'];
                                    break;
                            }
                        }
                        else {
                            if ($days > 0 && $days <= $key) { //如果入职的天数小于设定的参数天数,就计算并跳出循环
                                $mCost = round($wValue ['managementCost'] * $val, 2);
                                break;
                            }
                            elseif ($days < 0) {
                                $mCost = 0;
                            }
                            else {
                                $mCost = $wValue ['managementCost'];
                            }
                        }
                    }
//                    echo ($wValue['uID']."==$wValue[status]===".date("Y-m-d",$firstday)."->".date("Y-m-d",$lastDay)."->".$days."->".$mCost)."<br>";
                    break;
                #按天数结算
                case 'daily' :
                    if ($wValue ['status'] == "0") {
                        //员工离职的情况
                        switch ($days) {
                            case ($days <= 0) :
                                $mCost = 0;
                                break;
                            case ($days <= $t) :
                                $mCost = round($wValue ['managementCost'] / $t * $days, 2);
                                break;
                            case ($days > $t) :
                                $mCost = round(($wValue ['managementCost'] / $t * ($days - $t) + $wValue ['managementCost']), 2);
                                break;
                        }
                    }
                    else {
                        //员工在职
                        if ($days < 0) {
                            $mCost = 0;
                        }
                        elseif ($days < $t) {
                            $mCost = round($wValue ['managementCost'] / $t * $days, 2);
                        }
                        else {
                            $mCost = $wValue ['managementCost'];
                        }
                    }
                    break;
                #按天数结算,每月按天数分开结算,离职后不合并计算
                case 'dailyPerMonth' :
                    if ($days < 0) {
                        $mCost = 0;
                    }
                    elseif ($days < $t) {
                        $mCost = round($wValue ['managementCost'] / $t * $days, 2);
                    }
                    else {
                        $mCost = $wValue ['managementCost'];
                    }

                    break;
            }
        }
        else {
            if ($wValue ['status'] == "0") {
                $mCost = 0;
            }
            else {
                $mCost = $wValue ['managementCost'];
            }
        }
        return $mCost;
    }

    function extraFeeArr()
    {
        $wArr = $this->wArr;
        $unitArr = $this->unitArr;
        $exSoRet = $this->exSoRet();
        //		$exSoRet = null;
        $exHFRet = $this->exHFRet();
        $changeRadix = $this->changeRadix();
        if ($changeRadix)
            $helpCost = $changeRadix ['helpCost'];
        else
            $helpCost = 2;
        foreach ($wArr as $wKey => $wValue) {
            if (!$exSoRet) {
                //1.获取社保费用数组(这里面含有残障金,但单位合计中不包含)
                $soInsFeeArr [$wValue ['uID']] = $this->soInsFun($wValue);
            }
            //3.获取互助会费用数组,,这里直接把互助会的金额填上...其实是可以设置数据库来管理互助会的金额的..但是不理会...
            if ($wValue ['helpCost'] == "1") {
                $helpCostFeeArr [$wValue ['uID']] = $helpCost;
            }
            //5.管理费
            $mCostFeeArr [$wValue ['uID']] = $this->mCostFun($wValue);
            //4.公积金
            if (!$exHFRet) {
                $HFFeeArr  [$wValue ['uID']] = $this->HFFun($wValue);
            }
        }
        //有缴交明细,就替代系统计算
        if ($exSoRet) {
            unset ($soInsFeeArr);
            foreach ($exSoRet as $exSokey => $exSoVal) {
                $soInsFeeArr [$exSokey] = $exSoRet [$exSokey];
                if (array_key_exists($exSokey, $wArr))
                    if ($wArr [$exSokey] ['PDIns'] == "1") {
                        $soInsFeeArr [$exSokey] ['uPDIns'] = $this->soInsFun('PDIns');
                    }
            }
        }
        //有缴交明细,就替代系统计算
        if ($exHFRet) {
            unset ($HFFeeArr);
            foreach ($exHFRet as $exHFkey => $exHFVal) {
                $HFFeeArr [$exHFkey] = $exHFRet [$exHFkey];
            }
        }

        //商保缴交明细
        $extraFeeArr = array(
            "soInsFeeArr" => $soInsFeeArr,
            "HFFeeArr" => $HFFeeArr,
            "comInsFeeArr" => $this->exComRet(),
            "mCostFeeArr" => $mCostFeeArr,
            "helpCostFeeArr" => $helpCostFeeArr
        );
        return $extraFeeArr;
    }

    #只验证 a_originalFee 中相同的salaryDate是否存在需要合并扣税的数据
    public function mergeTax_fee($type = null)
    {
        //获取发放表的人员
        $pdo = $this->pdo;
        $salaryDate = $this->salaryDate;
        $extraBatch = $this->extraBatch;
        $unitID = $this->unitID;
        switch ($type) {
            case "mulFee" :
                $oFee = $this->wArr;
                foreach ($oFee as $oVal) {
                    $uIDStr .= "'" . $oVal ['uID'] . "',";
                }
                unset ($oVal);
                $uIDStr = rtrim($uIDStr, ",");
                #解决已发工资内, 已经扣除个人的社保,公积金,商保等相关项目,不再累计扣除的问题
                //获取不在本单位, 但却需要合并扣税的应缴纳税额及已扣个税
                $s1 = "select uID,sum(pTax) as pTax,sum(ratal) as ratal from a_originalFee  where  salaryDate like '$salaryDate' and unitID not in ( $unitID )  and uID in ($uIDStr) and ratal>0  group by uID ";
                //获取本单位内,首次工资费用 及多次工资费用的 应缴纳税额,已扣个税,个人社保,个人公积金,个人商保,个人互助会费
                if ($extraBatch)
                    $s2 = "select uID,sum(pTax) as pTax,sum(ratal) as ratal,sum(pSoIns) as pSoIns,sum(pHF) as pHF,sum(pComIns) as pComIns,sum(helpCost) as helpCost from a_mul_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID ) and extraBatch <'$extraBatch'  and uID in ($uIDStr) and pay>0  group by uID
                        union all
                        select uID,pTax,ratal,pSoIns,pHF,pComIns,helpCost from a_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0   ";
                else
                    $s2 = "select uID,sum(pTax) as pTax,sum(ratal) as ratal,sum(pSoIns) as pSoIns,sum(pHF) as pHF,sum(pComIns) as pComIns,sum(helpCost) as helpCost from a_mul_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0  group by uID
                        union all
                        select uID,pTax,ratal,pSoIns,pHF,pComIns,helpCost from a_originalFee  where  salaryDate like '$salaryDate' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0   ";

                $r1 = SQL($pdo, $s1);
                $r2 = SQL($pdo, $s2);
                foreach ($r1 as $v1) {
                    $ret [$v1 ['uID']] ['ratal'] = $v1 ['ratal'];
                    $ret [$v1 ['uID']] ['pTax'] = $v1 ['pTax'];
                }
                foreach ($r2 as $v2) {
                    $ret [$v2 ['uID']] ['ratal'] = $ret [$v2 ['uID']] ['ratal'] + $v2 ['ratal'];
                    $ret [$v2 ['uID']] ['pTax'] = $ret [$v2 ['uID']] ['pTax'] + $v2 ['pTax'];
                    $ret [$v2 ['uID']] ['pSoIns'] += $v2 ['pSoIns'];
                    $ret [$v2 ['uID']] ['pHF'] += $v2 ['pHF'];
                    $ret [$v2 ['uID']] ['pComIns'] += $v2 ['pComIns'];
                    $ret [$v2 ['uID']] ['helpCost'] += $v2 ['helpCost'];
                }
                break;
            case "mulRatalYet" :
                $extraBatch = $this->extraBatch;
                $sql = "select uID,pay,ratalYet as ratal,pTaxYet as pTax from a_mul_originalFee where salaryDate like '$salaryDate' and unitID like '$unitID' and extraBatch='$extraBatch' and ratalYet>0";
                $ret = SQL($pdo, $sql);
                $ret = keyArray($ret, "uID");
                break;
            case "ratalYet" :
                $sql = "select uID,pay,ratalYet as ratal,pTaxYet as pTax from a_originalFee where salaryDate like '$salaryDate' and unitID like '$unitID'and ratalYet>0";
                $ret = SQL($pdo, $sql);
                $ret = keyArray($ret, "uID");
                break;
            default :
                $oFee = $this->wArr;
                foreach ($oFee as $oVal) {
                    $uIDStr .= "'" . $oVal ['uID'] . "',";
                }
                $uIDStr = rtrim($uIDStr, ",");
                $sql = "select uID,sum(pay) as pay,sum(pTax) as pTax,sum(ratal) as ratal from a_originalFee  where  salaryDate like '$salaryDate' and unitID not like '$unitID' and uID in ($uIDStr) and ratal>0  group by uID ";
                $ret = SQL($pdo, $sql);
                $ret = keyArray($ret, "uID");
                break;
        }

        return $ret;
    }

    #同一个单位中,同一个月份内多次制作费用表时, 社保,公积金,管理费,商保等是否重复收取的问题
    public function alreadyFee($type = null)
    {
        //获取费用表的人员
        $pdo = $this->pdo;
        $month = $this->month;
        $extraBatch = $this->extraBatch;
        $unitID = $this->unitID;
        switch ($type) {
            case "mulFee" :
                $oFee = $this->wArr;
                foreach ($oFee as $oVal) {
                    $uIDStr .= "'" . $oVal ['uID'] . "',";
                }
                unset ($oVal);
                $uIDStr = rtrim($uIDStr, ",");
                #解决已结算的费用表中, 已经扣除单位的社保,公积金,商保等相关项目,不再累计扣除的问题
                //获取本单位内,首次工资费用 及多次工资费用的 单位社保,单位公积金,单位商保,管理费,残障金等项目
                if ($extraBatch)
                    $s2 = "select uID,sum(uPDIns) as uPDIns,sum(uSoIns) as uSoIns,sum(uHF) as uHF,sum(uComIns) as uComIns,sum(managementCost) as managementCost from a_mul_originalFee  where  month like '$month' and unitID in ( $unitID ) and extraBatch <'$extraBatch'  and uID in ($uIDStr)  group by uID
    				union all
    				select uID,uPDIns,uSoIns,uHF,uComIns,managementCost from a_originalFee  where  month like '$month' and unitID in ( $unitID )  and uID in ($uIDStr) and pay>0   ";
                else
                    $s2 = "select uID,sum(uPDIns) as uPDIns,sum(ratal) as ratal,sum(uSoIns) as uSoIns,sum(uHF) as uHF,sum(uComIns) as uComIns,sum(managementCost) as managementCost from a_mul_originalFee  where  month like '$month' and unitID in ( $unitID )  and uID in ($uIDStr)   group by uID
    				union all
    				select uID,uPDIns,uSoIns,uHF,uComIns,managementCost from a_originalFee  where  month like '$month' and unitID in ( $unitID )  and uID in ($uIDStr)    ";
                $r2 = SQL($pdo, $s2);
                foreach ($r2 as $v2) {
                    $ret [$v2 ['uID']] ['uSoIns'] += $v2 ['uSoIns'];
                    $ret [$v2 ['uID']] ['uHF'] += $v2 ['uHF'];
                    $ret [$v2 ['uID']] ['uComIns'] += $v2 ['uComIns'];
                    $ret [$v2 ['uID']] ['managementCost'] += $v2 ['managementCost'];
                    $ret [$v2 ['uID']] ['uPDIns'] += $v2 ['uPDIns'];
                }
                break;
        }

        return $ret;
    }
}

?>
