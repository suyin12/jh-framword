<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/4/12 - 10:53
 *
 *  <<<   返回员工相关的信息类 >>>
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