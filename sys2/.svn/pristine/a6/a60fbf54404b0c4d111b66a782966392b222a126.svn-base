<?php
/*
    作者：LOSKIN
    time:2014-11-07
    描述：class 链接
    更新：
*/
class agmLink
{
    static $conn;
    public $a; //object  返回员工信息表对象
    public $b; //object  返回流水账对象

    function __construct($pdo) {
        self::$conn=$pdo;
    }
    function classaInfo($pdo){
        require_once 'aInfo_agm.php';
        $a = new aInfo($pdo);
        return $this->a = $a;
    }
    function classBill($pdo){
        require_once 'bill_agm.php';
        $b =  new bill($pdo);
        return $this->b = $b;
    }

}
?>