<?php

/*
 *  错误信息提示函数
 * 
 * @author sToNe  email: shi35dong@gmail.com
 * 
 */
class error {
	public $pdo;
	public $unitID; //单位编号 , 可以是一个string如  '2202.002','2202.044'
	public $month; //月份 可以是一个string如 '201111','201109'
	public $monthType = "month"; //费用月份,工资月份,等月份类型,默认为费用月份
	public $extraBatch; //如果没有传入批次编号, 则默认为查询所有批次
	public $conStr; //定义需要额外控制的SQL语句条件,如 and uID='YZLH00012'
	public $actionArr; //获取该类内,各个方法需要操作的数组
	

	#签约服务器验证
	public function validAccess() {
		$ret = $this->actionArr;
		if ($ret) {
			foreach ( $ret as $k => $v ) {
				switch ($k) {
					case "status" :
						if ($v != "1")
							return $this->errorInfo ( "101" );
						break;
					case "now" :
						if (abs ( time () - strtotime ( $v ) ) > 86400)
							return $this->errorInfo ( "102" );
						break;
					case "UUID" :
						$UUID = _UUID;
						if ($UUID != $v) {
							return $this->errorInfo ( "103" );
						}
						break;
					case "end" :
						if (strtotime ( $v ) - strtotime ( $ret ['now'] ) < 0)
							return $this->errorInfo ( "101" );
						break;
				}
			}
			return true;
		} else {
			return $this->errorInfo ( "104" );
		}
	}
	
	#验证是否有页面的访问权限
	public function validPageAccess() {
		#连接页面访问验证类
		require_once sysPath . 'class/validateAuthority.class.php';
		#
		$auth_pageAccess = new authority ();
		$auth_pageAccess->pdo = $this->pdo;
		$auth_pageAccess->userId = $_SESSION ['exp_user'] ['mID'];
		$auth_pageAccess->functionStr_URL = ltrim(str_replace ( "/sys/", "", $_SERVER ['PHP_SELF'] ),"/");
		if (! $auth_pageAccess->validAccess ()) {
			return $this->errorInfo ( "105", "warning" );
		}
	}
	#验证上月的台账是否已经生成
	public function validLedger() {
		$pdo = $this->pdo;
		$unitID = $this->unitID;
		$month = $this->month;
		$lastMonth = date ( "Ym", strtotime ( $month . "01 -1 month" ) );
		$sql = "select 1 from a_ledger where month in ($lastMonth) and unitID in ($unitID) limit 1";
		$ret = SQL ( $pdo, $sql );
		$exSql = "select 1 from a_ledger where unitID in ($unitID) and month not like '$month' limit 1";
		$exRet = SQL ( $pdo, $exSql );
		//存在台账且,上月未生成台账,则提示错误
		if (! $ret && $exRet)
			return $this->errorInfo ( "1" );
	}
	
	#错误信息方法, $code 表示错误代码, $type= error ,warning 
	public function errorInfo($code, $type = "error") {
		global $authorCompany, $authorUrl;
		$errMsg = "错误提示: ";
		switch ($code) {
			case "1" :
				$errMsg .= "未完成上月台账.点击进入生成<a href='" . httpPath . "/leader/ledger.php'>台账</a>";
				break;
			case "101" :
				$errMsg .= "您的合同已过期,请尽快联系<a href='" . $authorUrl . "'>" . $authorCompany . "[" . $authorUrl . "]</a>进行续约";
				break;
			case "102" :
				$errMsg .= "您的计算机时间与国际标准时间相差超过1天,请调整以保证正常登陆";
				break;
			case "103" :
				$errMsg .= "如果您是更新或转移了系统所在的服务器,请尽快联系<a href='" . $authorUrl . "'>" . $authorCompany . "[" . $authorUrl . "]</a>帮助更正注册信息";
				break;
			case "104" :
				$errMsg .= "您还未完成系统登记注册,请<a href='" . httpPath . "system/reset.php'>点击此处</a>进行登记";
				break;
			case "105" :
				$errMsg .= "您还未开通本页面的访问权限,请联系管理员";
				break;
		}
		switch ($type) {
			case "error" :
				$pdo = $this->pdo;
                require sysPath . 'templateConfig.php';
				#
				$titile = "错误";
				#
				$smarty->assign ( "errorMsg", $errMsg );
				$smarty->assign ( array (
						"title" => $title,
						"css" => httpPath . "css/main.css",
						"httpPath" => httpPath
				) );
				$smarty->display ( "404/warning.tpl" );
				die ();
				break;
			case "warning" :
				$pdo = $this->pdo;
                require sysPath . 'templateConfig.php';
				#
				$titile = "警告";
				#
				$smarty->assign ( "errorMsg", $errMsg );
				$smarty->assign ( array (
						"title" => $title,
						"css" => httpPath . "css/main.css",
						"httpPath" => httpPath 
				) );
				$smarty->display ( "404/warning.tpl" );
				die ();
				break;
		}
	}
}

?>
