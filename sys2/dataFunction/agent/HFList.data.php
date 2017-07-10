<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/7 - 9:47
 *
 * 公积金
 */


class agentHFList{
    public $pdo; //PDO对象
    public $ret; //返回操作结果
    public $HFListArr; //社保清单数组

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #汇总清单
    function  HFListBasic($selStr="*",$conStr=" 1=1 "){
        $pdo = $this->pdo;
        $sql = "select $selStr from `d_HFList` where $conStr";
        $ret = SQL($pdo,$sql);
        $ret = keyArray($ret, "ID");
        return $this->HFListArr = $ret;
    }
    #清单明细
    function HFListDetail(){
        $pdo = $this->pdo;
        $sql = "";

    }
}