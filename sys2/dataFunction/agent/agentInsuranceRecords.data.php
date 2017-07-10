<?php
/**
 * Created by sToNe.
 * User: Administrator
 * Date: 2015/12/4
 * Time: 16:49
 *
 *   社保,公积金缴交记录
 */

class agentInsuranceRecords{
    public $pdo;//pdo 对象
    public $soInsOutFeeArr; // 社保缴交记录
    public $HFOutFeeArr ; // 公积金缴交记录

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #社保缴交记录
    function soInsFeeRecordsBasic($selStr = " * ", $conStr = " 1=1 ") {
		$pdo = $this->pdo;
		$sql = " select $selStr from `d_soInsFee_tmp` where $conStr ";
		$ret = SQL ( $pdo, $sql );
		$ret = keyArray ( $ret, "ID" );
        return $this->soInsOutFeeArr = $ret;
	}

    #公积金缴交记录
    function HFFeeRecordsBasic($selStr = " * ", $conStr = " 1=1 ") {
        $pdo = $this->pdo;
        $sql = " select $selStr from `d_HFFee_tmp` where $conStr ";
        $ret = SQL ( $pdo, $sql );
        $ret = keyArray ( $ret, "ID" );
        return $this->HFOutFeeArr = $ret;
    }

    #


}