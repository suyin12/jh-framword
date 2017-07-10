<?php

/**
 * Description of money
 * 计算该单位的本月欠款, 累计欠款,本月挂账,累计挂账明细
 *
 * @author sToNe     shi35dong@gmail.com
 */
class money {
	public $pdo;
	public $month; //string 核算月份
	public $extraBatch; //string 批次, 每月的第几批次相关
	public $unitID; //string or array 单位编号
	public $thisMonth; //bool 是否包含本月数据
	

	#本月欠/挂/冲减/收回明细(注意, 返回的是以uID为准的参数,故只能查找一个批次的数据,否则uID会合并,造成显示错误)
	function curMonth($tmp = null) {
		$pdo = $this->pdo;
		$month = $this->month;
		$extraBatch = $this->extraBatch;
		$unitID = $this->unitID;
		if ($tmp == "tmp")
			$sql = "select  * from `a_prsRequireMoney_tmp`  where `month` like :month and `unitID` in ($unitID) and `feeType`='0'";
		else
			$sql = "select  * from `a_prsRequireMoney`  where `month` like :month and `unitID` in ($unitID) and `feeType`='0'";
		if ($extraBatch)
			$sql .= " and `extraBatch`='$extraBatch'";
		else
			$sql .= " and `extraBatch`='0'";
		$res = $pdo->prepare ( $sql );
		$res->execute ( array (
				":month" => $month 
		) );
		$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
		$curRMRet = $curWriteDownRet = $prsReMoneyRet = null;
		foreach ( $ret as $val ) {
			if ($val ['type'] == "1" || $val ['type'] == "2") { //本月欠/挂记录,把个人部分去除了
				$curRMRet [$val ['uID']] ['ID'] = $val ['ID'];
				if ($val ['uPDInsMoney'] != 0)
					$curRMRet [$val ['uID']] ['uPDInsMoney'] = $val ['uPDInsMoney'];
				if ($val ['uSoInsMoney'] != 0)
					$curRMRet [$val ['uID']] ['uSoInsMoney'] = $val ['uSoInsMoney'];
				if ($val ['pSoInsMoney'] != 0)
					$curRMRet [$val ['uID']] ['pSoInsMoney'] = $val ['pSoInsMoney'];
				if ($val ['uHFMoney'] != 0)
					$curRMRet [$val ['uID']] ['uHFMoney'] = $val ['uHFMoney'];
				if ($val ['pHFMoney'] != 0)
					$curRMRet [$val ['uID']] ['pHFMoney'] = $val ['pHFMoney'];
				if ($val ['uComInsMoney'] != 0)
					$curRMRet [$val ['uID']] ['uComInsMoney'] = $val ['uComInsMoney'];
				if ($val ['pComInsMoney'] != 0)
					$curRMRet [$val ['uID']] ['pComInsMoney'] = $val ['pComInsMoney'];
				if ($val ['uOtherMoney'] != 0)
					$curRMRet [$val ['uID']] ['uOtherMoney'] = $val ['uOtherMoney'];
				if ($val ['pOtherMoney'] != 0)
					$curRMRet [$val ['uID']] ['pOtherMoney'] = $val ['pOtherMoney'];
				if ($val ['managementCostMoney'] != 0)
					$curRMRet [$val ['uID']] ['managementCostMoney'] = $val ['managementCostMoney'];
				if ($val ['salaryMoney'] != 0)
					$curRMRet [$val ['uID']] ['salaryMoney'] = $val ['salaryMoney'];
				if ($val ['uAccount'] != 0)
					$curRMRet [$val ['uID']] ['uAccount'] = $val ['uAccount'];
			}
			if ($val ['type'] == "3") { //本月的收回欠款
				$prsReMoneyRet [$val ['uID']] ['ID'] = $val ['ID'];
				$prsReMoneyRet [$val ['uID']] ['uPDInsMoney'] = $val ['uPDInsMoney'];
				$prsReMoneyRet [$val ['uID']] ['uSoInsMoney'] = $val ['uSoInsMoney'];
				$prsReMoneyRet [$val ['uID']] ['uHFMoney'] = $val ['uHFMoney'];
				$prsReMoneyRet [$val ['uID']] ['uComInsMoney'] = $val ['uComInsMoney'];
				$prsReMoneyRet [$val ['uID']] ['uOtherMoney'] = $val ['uOtherMoney'];
				$prsReMoneyRet [$val ['uID']] ['managementCostMoney'] = $val ['managementCostMoney'];
				$prsReMoneyRet [$val ['uID']] ['pSoInsMoney'] = $val ['pSoInsMoney'] > 0 ? $val ['pSoInsMoney'] : null;
				$prsReMoneyRet [$val ['uID']] ['pHFMoney'] = $val ['pHFMoney'] > 0 ? $val ['pHFMoney'] : null;
				$prsReMoneyRet [$val ['uID']] ['pComInsMoney'] = $val ['pComInsMoney'] > 0 ? $val ['pComInsMoney'] : null;
				$prsReMoneyRet [$val ['uID']] ['pOtherMoney'] = $val ['pOtherMoney'] > 0 ? $val ['pOtherMoney'] : null;
				$prsReMoneyRet [$val ['uID']] ['soInsCardMoney'] = $val ['soInsCardMoney'] > 0 ? $val ['soInsCardMoney'] : null;
				$prsReMoneyRet [$val ['uID']] ['residentCardMoney'] = $val ['residentCardMoney'] > 0 ? $val ['residentCardMoney'] : null;
			}
			if ($val ['type'] == "4") { //本月申请的冲减挂账,把个人部分去除了
				$curWriteDownRet [$val ['uID']] ['ID'] = $val ['ID'];
				$curWriteDownRet [$val ['uID']] ['uPDInsMoney'] = $val ['uPDInsMoney'];
				$curWriteDownRet [$val ['uID']] ['uSoInsMoney'] = $val ['uSoInsMoney'];
				$curWriteDownRet [$val ['uID']] ['pSoInsMoney'] = $val ['pSoInsMoney'];
				$curWriteDownRet [$val ['uID']] ['uHFMoney'] = $val ['uHFMoney'];
				$curWriteDownRet [$val ['uID']] ['pHFMoney'] = $val ['pHFMoney'];
				$curWriteDownRet [$val ['uID']] ['uComInsMoney'] = $val ['uComInsMoney'];
				$curWriteDownRet [$val ['uID']] ['pComInsMoney'] = $val ['pComInsMoney'];
				$curWriteDownRet [$val ['uID']] ['uOtherMoney'] = $val ['pOtherMoney'];
				$curWriteDownRet [$val ['uID']] ['managementCostMoney'] = $val ['managementCostMoney'];
			}
		}
		unset ( $ret );
		$arr = array (
				"curRM" => $curRMRet,
				"prsReMoney" => $prsReMoneyRet,
				"curWriteDown" => $curWriteDownRet 
		);
		return $arr;
	}
	
    #该单位,本月各项目的欠/挂/收回合计
    function curMonthTotal($tmp = null) {
        $pdo = $this->pdo;
        $month = $this->month;
        $extraBatch = $this->extraBatch;
        $unitID = $this->unitID;
        if ($tmp == "tmp")
            $sql = "select a.unitID as unitID,sum(a.uPDInsMoney) as uPDInsMoney,sum(a.uSoInsMoney) as uSoInsMoney,sum(a.pSoInsMoney) as pSoInsMoney,sum(a.uHFMoney) as uHFMoney,sum(a.pHFMoney) as pHFMoney,sum(a.uComInsMoney) as uComInsMoney,sum(a.pComInsMoney) as pComInsMoney,sum(a.managementCostMoney) as managementCostMoney,sum(a.soInsCardMoney) as soInsCardMoneySum,sum(a.residentCardMoney) as residentCardMoney,sum(a.uOtherMoney) as uOtherMoney,sum(a.pOtherMoney) as pOtherMoney,sum(a.salaryMoney) as salaryMoney,sum(a.uAccount) as uAccount,a.type as type from `a_prsRequireMoney_tmp` a where  a.`month` like '$month'  and a.`unitID` in ($unitID) and a.`feeType`='0' ";
        else
            $sql = "select a.unitID as unitID,sum(a.uPDInsMoney) as uPDInsMoney,sum(a.uSoInsMoney) as uSoInsMoney,sum(a.pSoInsMoney) as pSoInsMoney,sum(a.uHFMoney) as uHFMoney,sum(a.pHFMoney) as pHFMoney,sum(a.uComInsMoney) as uComInsMoney,sum(a.pComInsMoney) as pComInsMoney,sum(a.managementCostMoney) as managementCostMoney,sum(a.soInsCardMoney) as soInsCardMoneySum,sum(a.residentCardMoney) as residentCardMoney,sum(a.uOtherMoney) as uOtherMoney,sum(a.pOtherMoney) as pOtherMoney,sum(a.salaryMoney) as salaryMoney,sum(a.uAccount) as uAccount,a.type as type from `a_prsRequireMoney` a where  a.`month` like '$month'  and a.`unitID` in ($unitID) and a.`feeType`='0' ";
        if ($extraBatch=="all")
            $sql =$sql;
        elseif($extraBatch)
            $sql .= " and `extraBatch`='$extraBatch'";
        else
            $sql .= " and `extraBatch`='0'";
        $sql .= " group by a.type";
        $ret = SQL ( $pdo, $sql );
        foreach ( $ret as $key => $val ) {
            $curMonthTotal [$val ['type']] ['uPDInsMoney'] = $val ['uPDInsMoney'];
            $curMonthTotal [$val ['type']] ['uSoInsMoney'] = $val ['uSoInsMoney'];
			$curMonthTotal [$val ['type']] ['pSoInsMoney'] = $val ['pSoInsMoney'];
            $curMonthTotal [$val ['type']] ['uHFMoney'] = $val ['uHFMoney'];
            $curMonthTotal [$val ['type']] ['pHFMoney'] = $val ['pHFMoney'];
            $curMonthTotal [$val ['type']] ['uComInsMoney'] = $val ['uComInsMoney'];
            $curMonthTotal [$val ['type']] ['managementCostMoney'] = $val ['managementCostMoney'];
            $curMonthTotal [$val ['type']] ['uAccount'] = $val ['uAccount'];
            $curMonthTotal [$val ['type']] ['soInsCardMoney'] = $val ['soInsCardMoney'];
            $curMonthTotal [$val ['type']] ['residentCardMoney'] = $val ['residentCardMoney'];
            $curMonthTotal [$val ['type']] ['pOtherMoney'] = $val ['pOtherMoney'];
            $curMonthTotal [$val ['type']] ['uOtherMoney'] = $val ['uOtherMoney'];
            $curMonthTotal [$val ['type']] ['salaryMoney'] = $val ['salaryMoney'];
            if ($val ['type'] == "3") {
                $curMonthTotal [$val ['type']] ['pSoInsMoney'] = $val ['pSoInsMoney'];
                $curMonthTotal [$val ['type']] ['pHFMoney'] = $val ['pHFMoney'];
                $curMonthTotal [$val ['type']] ['pComInsMoney'] = $val ['pComInsMoney'];
            }
        }
        return $curMonthTotal;
    }
	
	#累计欠款明细
	function sumMoney() {
		$pdo = $this->pdo;
		$month = $this->month;
		$unitID = $this->unitID;
		$thisMonth = $this->thisMonth;
		$extraBatch = $this->extraBatch;
		$thisExtraBatch = $this->thisExtraBatch;
		
		//累计到当前月份
		$sql = "select a.uID as uID,sum(a.uPDInsMoney) as uPDInsMoney,sum(a.uSoInsMoney) as uSoInsMoney,sum(a.pSoInsMoney) as pSoInsMoney,sum(a.uHFMoney) as uHFMoney,sum(a.pHFMoney) as pHFMoney,sum(a.uComInsMoney) as uComInsMoney,sum(a.pComInsMoney) as pComInsMoney,sum(a.managementCostMoney) as managementCostMoney,sum(a.uOtherMoney) as uOtherMoney,sum(salaryMoney) as salaryMoney from `a_prsRequireMoney` a where (a.status='0' and a.type in ('2','3')  and a.unitID in ($unitID ) ";
		if ($thisMonth == true) {
			if ($extraBatch) {
				if ($thisExtraBatch == true )
					$sql .= " and (a.month<'$month'  or ( a.month='$month' and a.extraBatch <= '$extraBatch'))";
				else
					$sql .= " and (a.month<'$month'  or ( a.month='$month' and a.extraBatch < '$extraBatch')) ";
			}else{
				$sql .= " and a.month <= '$month'";
			}
		} else {
			$sql .= " and a.month < '$month' ";		
		}
		$sql .= " ) group by a.uID";
		
		$ret = SQL ( $pdo, $sql );
		
		foreach ( $ret as $val ) {
			foreach ( $val as $k => $v ) {
				switch ($k) {
					case "uPDInsMoney" :
					case "uSoInsMoney" :
					case "pSoInsMoney" :
					case "uHFMoney" :
					case "pHFMoney" :
					case "uComInsMoney" :
					case "pComInsMoney" :
					case "uOtherMoney" :
					case "pOtherMoney" :
					case "soInsCardMoney" :
					case "residentCardMoney" :
					case "salaryMoney" :
					case "managementCostMoney" :
						if ($v < 0)
							$rMRet [$val ['uID']] [$k] = $v;
						break;
				}
			}
		}
		return $rMRet;
	}

    #累计欠款合计
    function sumMoneyByUnit() {
        $pdo = $this->pdo;
        $month = $this->month;
        $unitID = $this->unitID;
        $thisMonth = $this->thisMonth;
        $extraBatch = $this->extraBatch;
        $thisExtraBatch = $this->thisExtraBatch;

        //累计到当前月份
        $sql = "select a.uID as uID,sum(a.uPDInsMoney) as uPDInsMoney,sum(a.uSoInsMoney) as uSoInsMoney,sum(a.pSoInsMoney) as pSoInsMoney,sum(a.uHFMoney) as uHFMoney,sum(a.pHFMoney) as pHFMoney,sum(a.uComInsMoney) as uComInsMoney,sum(a.pComInsMoney) as pComInsMoney,sum(a.managementCostMoney) as managementCostMoney,sum(a.uOtherMoney) as uOtherMoney,sum(salaryMoney) as salaryMoney from `a_prsRequireMoney` a where (a.status='0' and a.type in ('2','3')  and a.unitID in ($unitID ) ";
        if ($thisMonth == true) {
            if ($extraBatch) {
                if ($thisExtraBatch == true )
                    $sql .= " and (a.month<'$month'  or ( a.month='$month' and a.extraBatch <= '$extraBatch'))";
                else
                    $sql .= " and (a.month<'$month'  or ( a.month='$month' and a.extraBatch < '$extraBatch')) ";
            }else{
                $sql .= " and a.month <= '$month'";
            }
        } else {
            $sql .= " and a.month < '$month' ";
        }
        $sql .= " ) group by a.uID";

        $ret = SQL ( $pdo, $sql );

        foreach ( $ret as $val ) {
            foreach ( $val as $k => $v ) {
                switch ($k) {
                    case "uPDInsMoney" :
                    case "uSoInsMoney" :
                    case "pSoInsMoney" :
                    case "uHFMoney" :
                    case "pHFMoney" :
                    case "uComInsMoney" :
                    case "pComInsMoney" :
                    case "uOtherMoney" :
                    case "pOtherMoney" :
                    case "soInsCardMoney" :
                    case "residentCardMoney" :
                    case "salaryMoney" :
                    case "managementCostMoney" :
                        if ($v < 0)
                            $rMRet[$k] += $v;
                        break;
                }
            }
        }
        return $rMRet;
    }
}

?>
