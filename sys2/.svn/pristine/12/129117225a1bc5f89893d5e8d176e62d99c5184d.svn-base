<?php

/**
 * Created by sToNe.
 * User: Administrator
 * Date: 2015/12/30
 * Time: 17:29
 *
 * 消息数据类
 */
class messageData
{
    public $pdo; //pdo 对象
    public $msgArr ; //返回消息数组

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #获取消息相关
    function  messageDataBasic($selStr="*",$conStr="isDelete !=1"){
        $pdo = $this->pdo;
        $sql = " select $selStr from s_msg_logs where $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "ID");
        return $this->msgArr = $ret;
    }



}