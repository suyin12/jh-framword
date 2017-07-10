<?php
/*
*       2013-1-4
*       <<<  其他项目相关的欠/挂费用表 ,用于统计和显示相关, 欠/挂费用还是以money.data.php为主 >>>
*       create by Great sToNe
*       have fun,.....
*/
class moneyInfo {
	public $pdo;
	public $x; // object 链接各个类
	public $ret; // array 返回的结果集
	

	#加载连接各种设置类
	public function classLinkClass() {
		$x = new classLink ();
		$x->pdo = $this->pdo;
		return $this->x = $x;
	}
	#欠/挂/冲减/收回明细
	function moneyBasic($selStr = " * ", $conStr = " 1=1 ") {
		$pdo = $this->pdo;
		$sql = "select " . $selStr . " from `a_prsRequireMoney` where " . $conStr;
		$ret = SQL ( $pdo, $sql );
		return $this->ret = $ret;
	}
	#显示本月对应的名称(同一个月内可能存在多条同一人的数据,故不能用uID做KEY)
	function moneyDetailArr() {
		$ret = $this->ret;
		$x = $this->x;
		//加载单位基本信息类
		$x->unitClass ( array (
				"selStr" => " unitID,unitName " 
		) );
		//加载员工信息类
		$x->wInfoClass ( array (
				"selStr" => " uID,name,status,pID ",
				'conStr' => '1=1' 
		) );
		//加载员工编码对照表类
		$x->wInfoSetClass ();
		#
		$unitArr = $x->unitArr;
		$wInfoArr = $x->g->wInfoArr;
		$wInfoSetArr = $x->c->wInfoSet;
		$typeArr = array (
				"1" => "挂账",
				"2" => "欠款",
				"3" => "收回欠款",
				"4" => "冲减挂账" 
		);
		;
		foreach ( $ret as $key => $val ) {
			$ret [$key] ['unitName'] = $unitArr [$val ['unitID']] ['unitName'];
			$ret [$key] ['name'] = $wInfoArr [$val ['uID']] ['name'];
			$ret [$key] ['pID'] = $wInfoArr [$val ['uID']] ['pID'];
			$ret [$key] ['wStatus'] = $wInfoArr [$val ['uID']] ['status']==0? $wInfoSetArr ['status'] [$wInfoArr [$val ['uID']] ['status']]:"";
			$ret [$key] ['typeName'] = $typeArr [$val ['type']];
			//批次号+1 对应工资费用内的第几个批次
			$ret [$key] ['extraBatch'] = $val ['extraBatch'] + 1;
		}
		unset($x);
		return $this->ret = $ret;
	}
}

?>