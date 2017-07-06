<?php
/**
 *
 * User: suyin
 * Date: 2017/7/4 11:18
 *
 */
namespace jh;
require './setting.php';
use jh\Conn;

class PrivilegeManagement{
    //实例
    private static $_instance;
    //包含的权限
    var $rulesArr = [];
    //包含的角色
    var $rolesArr = [];
    //构造函数声明为private,防止直接创建对象
//    private function __construct()
//    {
//
//    }
    //单例方法
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    //阻止用户复制对象实例
    private function __clone(){
        trigger_error('Clone is not allow' ,E_USER_ERROR);//E_USER_ERROR E_USER_WARNING E_USER_NOTICE（默认）
    }
    /**
     * 获取用户角色数组
     * param $id
     * return array()
    */
    public function rulesArr($id,$bool = false){
        $conn = Conn::$_instance;
//        var_dump($conn);exit;
        if(empty($id)){
            echo "传入id有误,请确认!!!";exit;
        }
        if(!$bool){
            $sql = "select rules.name from roles_in_rules 
                    left join rules on rules.id = roles_in_rules.rules_id 
                    left join users_in_roles on  users_in_roles.user_id={$id} order by rules.id ASC";//默认是递增形式
        }else{
            $sql = "select name from rules where 1=1";
        }

        $ret = $conn->query($sql);
        $this->rolesArr = $ret->fetchAll(\PDO::FETCH_ASSOC);

//        foreach($this->rolesArr as $key => &$val){
//            $this->rolesArr = $val;
//        }
        echo "<pre>";
        var_dump($this->rolesArr);exit();
        return $this->rolesArr;
    }
    //设置用户权限 return array()
    public function updateUserRules(){

    }

}
$PrivilegeManagement = PrivilegeManagement::getInstance();
$PrivilegeManagement->rulesArr(1);
