<?php
/**
 *
 * User: suyin
 * Date: 2017/6/2310:56
 *
 */
class Conn{
    //保存实例在此属性中
    private static $_instance;
    //主机
    private $host = "bdm243423240.my3w.com";
    //用户名
    private $username = "bdm243423240";
    //密码
    private $password = "sfjxhl0908";
    //端口
    private $port = "";
    //数据库名
    private $dbname = "bdm243423240_db";
    //数据库编码
    private $ut = "utf-8";

    private function __construct(){
        $this->connet();
    }
    public static function get_instance(){
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    //阻止用户复制对象实例
    private function __clone(){
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }
    function connet(){
        $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname","$this->username","$this->password") or die("数据库链接失败!");
        $pdo->query("set names $this->ut");
        return $pdo;
    }
}
$pdo = Conn::get_instance();
define("webPath","https://".$_SERVER['HTTP_HOST'].__DIR__);

