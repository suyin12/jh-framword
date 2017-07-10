<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/4 - 15:39
 *
 *  社保缴交清单
 */

class agentSoInsList{
    public $pdo; //PDO对象
    public $ret; //返回操作结果
    public $soInsListArr; //社保清单数组

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #汇总清单
    function  soInsListBasic($selStr="*",$conStr=" 1=1 "){
        $pdo = $this->pdo;
        $sql = "select $selStr from `d_soInsList` where $conStr";
        $ret = SQL($pdo,$sql);
        $ret = keyArray($ret, "ID");
        return $this->soInsListArr = $ret;
    }
    #清单明细
    function soInsListDetail(){
        $pdo = $this->pdo;
        $sql = "";

    }
}