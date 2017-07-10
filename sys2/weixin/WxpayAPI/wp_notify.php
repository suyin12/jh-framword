<?php
$root_path = str_replace ( '/WxpayAPI', '', dirname ( __FILE__ ) );
define ( 'SITE_PATH', $root_path );
define ( 'SITE_DIR_NAME', str_replace ( '.', '_', pathinfo ( SITE_PATH, PATHINFO_BASENAME ) ) );
define ( 'RUNTIME_PATH', './Runtime/' );

date_default_timezone_set ( 'PRC' );
error_reporting ( E_ERROR );
// error_reporting ( E_ALL );
// ini_set ( 'display_errors', true );
/* ===================================== 配置部分 ========================================== */
$config = require SITE_PATH . '/Application/Common/Conf/config.php';

/* ===================================== 公共部分 ========================================== */

// 过滤非法html标签
function t($text) {
	// 过滤标签
	$text = nl2br ( $text );
	$text = real_strip_tags ( $text );
	$text = addslashes ( $text );
	$text = trim ( $text );
	return addslashes ( $text );
}
function safe($str, $allowable_tags = "") {
	$str = stripslashes ( htmlspecialchars_decode ( $str ) );
	return strip_tags ( $str, $allowable_tags );
}

// 浏览器友好的变量输出
function dump($var) {
	ob_start ();
	var_dump ( $var );
	$output = ob_get_clean ();
	if (! extension_loaded ( 'xdebug' )) {
		$output = preg_replace ( "/\]\=\>\n(\s+)/m", "] => ", $output );
		$output = '<pre style="text-align:left">' . htmlspecialchars ( $output, ENT_QUOTES ) . '</pre>';
	}
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo ($output);
}

// +----------------------------------------------------------------------
// | ThinkPHP 简洁模式数据库中间层实现类 只支持mysql
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://www.thinksns.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: liuxiaoqing <liuxiaoqing@zhishisoft.com>
// +----------------------------------------------------------------------
//
class SimpleDB {
	private static $_instance = null;
	// 是否显示调试信息 如果启用会在知识文件记录sql语句
	public $debug = false;
	// 是否使用永久连接
	protected $pconnect = false;
	// 当前SQL指令
	protected $queryStr = '';
	// 最后插入ID
	protected $lastInsID = null;
	// 返回或者影响记录数
	protected $numRows = 0;
	// 返回字段数
	protected $numCols = 0;
	// 事务指令数
	protected $transTimes = 0;
	// 错误信息
	protected $error = '';
	// 当前连接ID
	protected $linkID = null;
	// 当前查询ID
	protected $queryID = null;
	// 是否已经连接数据库
	protected $connected = false;
	// 数据库连接参数配置
	protected $config = '';
	// SQL 执行时间记录
	protected $beginTime;
	/**
	 * +----------------------------------------------------------
	 * 架构函数
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param array $config
	 *        	数据库配置数组
	 *        	+----------------------------------------------------------
	 */
	public function __construct($config = '') {
		if (! extension_loaded ( 'mysql' )) {
			echo ('not support mysql');
		}
		$this->config = $this->parseConfig ( $config );
	}
	
	/**
	 * +----------------------------------------------------------
	 * 连接数据库方法
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @throws ThinkExecption +----------------------------------------------------------
	 */
	public function connect() {
		if (! $this->connected) {
			$config = $this->config;
			// 处理不带端口号的socket连接情况
			$host = $config ['hostname'] . ($config ['hostport'] ? ":{$config['hostport']}" : '');
			if ($this->pconnect) {
				$this->linkID = mysql_pconnect ( $host, $config ['username'], $config ['password'] );
			} else {
				$this->linkID = mysql_connect ( $host, $config ['username'], $config ['password'], true );
			}
			if (! $this->linkID || (! empty ( $config ['database'] ) && ! mysql_select_db ( $config ['database'], $this->linkID ))) {
				echo (mysql_error ());
			}
			$dbVersion = mysql_get_server_info ( $this->linkID );
			if ($dbVersion >= "4.1") {
				// 使用UTF8存取数据库 需要mysql 4.1.0以上支持
				mysql_query ( "SET NAMES 'UTF8'", $this->linkID );
			}
			// 设置 sql_model
			if ($dbVersion > '5.0.1') {
				mysql_query ( "SET sql_mode=''", $this->linkID );
			}
			// 标记连接成功
			$this->connected = true;
			// 注销数据库连接配置信息
			unset ( $this->config );
		}
	}
	
	/**
	 * +----------------------------------------------------------
	 * 释放查询结果
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 */
	public function free() {
		mysql_free_result ( $this->queryID );
		$this->queryID = 0;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 执行查询 主要针对 SELECT, SHOW 等指令
	 * 返回数据集
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param string $str
	 *        	sql指令
	 *        	+----------------------------------------------------------
	 * @return mixed +----------------------------------------------------------
	 * @throws ThinkExecption +----------------------------------------------------------
	 */
	public function query($str = '') {
		$this->connect ();
		if (! $this->linkID)
			return false;
		if ($str != '')
			$this->queryStr = $str;
			// 释放前次的查询结果
		if ($this->queryID) {
			$this->free ();
		}
		$this->Q ( 1 );
		$this->queryID = mysql_query ( $this->queryStr, $this->linkID );
		$this->debug ();
		if (! $this->queryID) {
			if ($this->debug)
				echo ($this->error ());
			else
				return false;
		} else {
			$this->numRows = mysql_num_rows ( $this->queryID );
			return $this->getAll ();
		}
	}
	
	/**
	 * +----------------------------------------------------------
	 * 执行语句 针对 INSERT, UPDATE 以及DELETE
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param string $str
	 *        	sql指令
	 *        	+----------------------------------------------------------
	 * @return integer +----------------------------------------------------------
	 * @throws ThinkExecption +----------------------------------------------------------
	 */
	public function execute($str = '') {
		$this->connect ();
		if (! $this->linkID)
			return false;
		if ($str != '')
			$this->queryStr = $str;
			// 释放前次的查询结果
		if ($this->queryID) {
			$this->free ();
		}
		$this->W ( 1 );
		$result = mysql_query ( $this->queryStr, $this->linkID );
		$this->debug ();
		if (false === $result) {
			if ($this->debug)
				echo ($this->error ());
			else
				return false;
		} else {
			$this->numRows = mysql_affected_rows ( $this->linkID );
			$this->lastInsID = mysql_insert_id ( $this->linkID );
			return $this->numRows;
		}
	}
	
	/**
	 * +----------------------------------------------------------
	 * 获得所有的查询数据
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return array +----------------------------------------------------------
	 * @throws ThinkExecption +----------------------------------------------------------
	 */
	public function getAll() {
		if (! $this->queryID) {
			echo ($this->error ());
			return false;
		}
		// 返回数据集
		$result = array ();
		if ($this->numRows > 0) {
			while ( $row = mysql_fetch_assoc ( $this->queryID ) ) {
				$result [] = $row;
			}
			mysql_data_seek ( $this->queryID, 0 );
		}
		return $result;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 关闭数据库
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @throws ThinkExecption +----------------------------------------------------------
	 */
	public function close() {
		if (! empty ( $this->queryID ))
			mysql_free_result ( $this->queryID );
		if ($this->linkID && ! mysql_close ( $this->linkID )) {
			echo ($this->error ());
		}
		$this->linkID = 0;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 数据库错误信息
	 * 并显示当前的SQL语句
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return string +----------------------------------------------------------
	 */
	public function error() {
		$this->error = mysql_error ( $this->linkID );
		if ($this->queryStr != '') {
			$this->error .= "\n [ SQL语句 ] : " . $this->queryStr;
		}
		return $this->error;
	}
	
	/**
	 * +----------------------------------------------------------
	 * SQL指令安全过滤
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param string $str
	 *        	SQL字符串
	 *        	+----------------------------------------------------------
	 * @return string +----------------------------------------------------------
	 */
	public function escape_string($str) {
		return mysql_escape_string ( $str );
	}
	
	/**
	 * +----------------------------------------------------------
	 * 析构方法
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 */
	public function __destruct() {
		// 关闭连接
		$this->close ();
	}
	
	/**
	 * +----------------------------------------------------------
	 * 取得数据库类实例
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return mixed 返回数据库驱动类
	 *         +----------------------------------------------------------
	 */
	public static function getInstance($db_config = '') {
		if (self::$_instance == null) {
			self::$_instance = new Db ( $db_config );
		}
		return self::$_instance;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 分析数据库配置信息，支持数组和DSN
	 * +----------------------------------------------------------
	 *
	 * @access private
	 *         +----------------------------------------------------------
	 * @param mixed $db_config
	 *        	数据库配置信息
	 *        	+----------------------------------------------------------
	 * @return string +----------------------------------------------------------
	 */
	private function parseConfig($_db_config = '') {
		// 如果配置为空，读取配置文件设置
		$db_config = array (
				'dbms' => $_db_config ['DB_TYPE'],
				'username' => $_db_config ['DB_USER'],
				'password' => $_db_config ['DB_PWD'],
				'hostname' => $_db_config ['DB_HOST'],
				'hostport' => $_db_config ['DB_PORT'],
				'database' => $_db_config ['DB_NAME'],
				'params' => $_db_config ['DB_PARAMS'] 
		);
		return $db_config;
	}
	
	/**
	 * +----------------------------------------------------------
	 * 数据库调试 记录当前SQL
	 * +----------------------------------------------------------
	 *
	 * @access protected
	 *         +----------------------------------------------------------
	 */
	protected function debug() {
		// 记录操作结束时间
		if ($this->debug) {
			$runtime = number_format ( microtime ( TRUE ) - $this->beginTime, 6 );
			Log::record ( " RunTime:" . $runtime . "s SQL = " . $this->queryStr, Log::SQL );
		}
	}
	
	/**
	 * +----------------------------------------------------------
	 * 查询次数更新或者查询
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param mixed $times
	 *        	+----------------------------------------------------------
	 * @return void +----------------------------------------------------------
	 */
	public function Q($times = '') {
		static $_times = 0;
		if (empty ( $times )) {
			return $_times;
		} else {
			$_times ++;
			// 记录开始执行时间
			$this->beginTime = microtime ( TRUE );
		}
	}
	
	/**
	 * +----------------------------------------------------------
	 * 写入次数更新或者查询
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @param mixed $times
	 *        	+----------------------------------------------------------
	 * @return void +----------------------------------------------------------
	 */
	public function W($times = '') {
		static $_times = 0;
		if (empty ( $times )) {
			return $_times;
		} else {
			$_times ++;
			// 记录开始执行时间
			$this->beginTime = microtime ( TRUE );
		}
	}
	
	/**
	 * +----------------------------------------------------------
	 * 获取最近一次查询的sql语句
	 * +----------------------------------------------------------
	 *
	 * @access public
	 *         +----------------------------------------------------------
	 * @return string +----------------------------------------------------------
	 */
	public function getLastSql() {
		return $this->queryStr;
	}
} // 类定义结束
function think_encrypt($data, $key = '', $expire = 0) {
	$key = md5 ( empty ( $key ) ? C ( 'DATA_AUTH_KEY' ) : $key );
	
	$data = base64_encode ( $data );
	$x = 0;
	$len = strlen ( $data );
	$l = strlen ( $key );
	$char = '';
	
	for($i = 0; $i < $len; $i ++) {
		if ($x == $l)
			$x = 0;
		$char .= substr ( $key, $x, 1 );
		$x ++;
	}
	
	$str = sprintf ( '%010d', $expire ? $expire + time () : 0 );
	
	for($i = 0; $i < $len; $i ++) {
		$str .= chr ( ord ( substr ( $data, $i, 1 ) ) + (ord ( substr ( $char, $i, 1 ) )) % 256 );
	}
	return str_replace ( array (
			'+',
			'/',
			'=' 
	), array (
			'-',
			'_',
			'' 
	), base64_encode ( $str ) );
}
// 接口统一调用方法
function agentDataByPost($model, $param = array(),$path="agent/agentAPI.class.php") {
	$key = 'wx00f249ca19e47f51';
	$url = 'http://www.szhro.com/'.$path.'?model=' . $model;
	
	if (is_array ( $param )) {
		$param = json_encode ( $param );
		$param = think_encrypt ( $param, $key );
	}
	$header [] = "content-type: application/json; charset=UTF-8";
	
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	$res = curl_exec ( $ch );
	
	$flat = curl_errno ( $ch );
	if ($flat) {
		$data = curl_error ( $ch );
	}
	curl_close ( $ch );
	$res = think_decrypt ( $res, $key );
	$res = json_decode ( $res, true );
	
	return $res;
}

$str = file_get_contents ( 'php://input' );

$data = new SimpleXMLElement ( $str );
// $data || die ( '参数获取失败' );
foreach ( $data as $key => $value ) {
	$param [$key] = safe ( strval ( $value ) );
}

$db = new SimpleDB ( $config );

$cTime = 1;
$cTime_format = date ( 'Y-m-d H:i:s' );
$data_post = json_encode ( $_REQUEST );
$sql = "INSERT INTO wx_weixin_log (cTime,cTime_format,`data`,data_post) VALUES ($cTime,'$cTime_format','$str','$data_post')";
// dump ( $sql );
$res = $db->execute ( $sql );
// dump ( $res );
// dump ( $param );
$res = agentDataByPost ( 'paidAction', $param );
// dump ( $res );
echo "success";


