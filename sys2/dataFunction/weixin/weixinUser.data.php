<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/1/28 - 15:49
 */

class weixinUser{
    public $pdo;
    public $wxUserArr; //订单信息

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #微信用户相关信息
    public function wxUserBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        $sql = " select $selStr from `wx_user` where $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "uid");
        return $this->wxUserArr = $ret;
    }
}