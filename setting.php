<?php
/**
 *
 * User: suyin
 * Date: 2017/6/23 10:56
 *
 */

/**
 *设计模式之单例模式
 * $_instance必须声明为静态的私有变量
 * 构造函数必须声明为私有,防止外部程序new类从而失去单例模式的意义
 * getInstance()方法必须设置为公有的,必须调用此方法以返回实例的一个引用
 * ::操作符只能访问静态变量和静态函数
 * new对象都会消耗内存
 * 使用场景:最常用的地方是数据库连接。
 * 使用单例模式生成一个对象后，该对象可以被其它众多对象所使用。
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
        return $pdo;
    }
}
$pdo = Conn::get_instance();
define("webPath","https://".$_SERVER['HTTP_HOST'].__DIR__);

/**
 *
 *class man
{
//保存例实例在此属性中
private static $_instance;

//构造函数声明为private,防止直接创建对象
private function __construct()
{
echo '我被实例化了！';
}

//单例方法
public static function get_instance()
{
var_dump(isset(self::$_instance));

if(!isset(self::$_instance))
{
self::$_instance=new self();
}
return self::$_instance;
}

//阻止用户复制对象实例
private function __clone()
{
trigger_error('Clone is not allow' ,E_USER_ERROR);
}

function test()
{
echo("test");

}
}

// 这个写法会出错，因为构造方法被声明为private
//$test = new man;

// 下面将得到Example类的单例对象
$test = man::get_instance();
//$test = man::get_instance();
$test->test();

// 复制对象将导致一个E_USER_ERROR.
//$test_clone = clone $test;
 *
 *
 */

