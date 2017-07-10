<?php
/**
 *
 * User: suyin
 * Date: 2017/7/4 11:18
 *
 */
namespace jh;
require 'setting.php';

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
     * param $id $bool
     * return array()
    */
    public function rulesArr($id,$bool = false){
        $pdo = Conn::get_instance();
        $pdo = $pdo->connet();
        if(empty($id))  die("传入id有误,请确认!!!");

        if(!$bool){
            $sql = "select rules.name from roles_in_rules 
                    left join rules on rules.id = roles_in_rules.rules_id 
                    left join users_in_roles on  users_in_roles.user_id={$id} order by rules.id ASC";//默认是递增形式
        }else{
            $sql = "select name from rules where 1=1";
        }

        $ret = $pdo->query($sql);
        $this->rolesArr = $ret->fetchAll(\PDO::FETCH_ASSOC);
        $res = json_encode($this->rolesArr);

        return $res;
    }

    /**
     * 修改用户的角色id状态
     *
     * 1:允许,2:允许查看,0:禁止操作
     */
    public function updateUserRules($arr,$type=1){
        $pdo = Conn::get_instance();
        if($type==1){
            $sql = "update  users_in_roles set status = 1 where user_id = '' and role_id = '' ";
        }elseif($type==2){
            $sql = "update  users_in_roles set status = 2 where user_id = '' and role_id = '' ";
        }else{
            $sql = "update  users_in_roles set status = 0 where user_id = '' and role_id = '' ";
        }

        $ret = $pdo->connet()->exec($sql);

        foreach($arr as $k => $v){

        }
        $ret = json_encode($ret);
        return $ret;
    }

}
$PrivilegeManagement = PrivilegeManagement::getInstance();
$PrivilegeManagement->rulesArr(1);
