<?php
/*
*       2013-1-4
*       <<<   返回员工相关的信息类 >>>
*       create by Great sToNe
*       have fun,.....
*/
class wInfo {
	public $pdo;
	public $wInfoArr; //array 用户的基本信息

	#用户的基本信息表
	public function wInfoBasic($selStr = " * ", $conStr = " 1=1 ") {
		$pdo = $this->pdo;
		$sql = " select $selStr from `a_workerInfo` where $conStr ";
		$ret = SQL ( $pdo, $sql );
		$ret = keyArray ( $ret, "uID" );
		return $this->wInfoArr = $ret;
	}
    #用户在职总人数
    public function wInfoNum($selStr = " sum(1) as num ", $conStr = " staus !='0'") {
        $pdo = $this->pdo;
        $sql = " select $selStr from `a_workerInfo` where $conStr ";
        $num = SQL ( $pdo, $sql ,null , one);
        return $num;
    }
}
?>