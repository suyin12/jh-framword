<?php

namespace Addons\BusinessAnalysis\Model;
use Think\Model;

/**
 * BusinessAnalysis模型
 */
class BusinessAnalysisModel extends Model{
    var $tableName = 'user';
    // **************************** 获取系统配置数据 ********************************************//
    function getConfigData($field = '') {
        $data = agentDataByPost ( 'basicSet' ,null,false,"businessAnalysis/BAAPI.class.php");
        return empty ( $field ) ? $data ['data'] : $data ['data'] [$field];
    }


    function workerStat(){
        $ret = agentDataByPost("workerStat",NULL,false,"businessAnalysis/BAAPI.class.php");
        return $ret;
    }

    function requireMoney(){
        $ret = agentDataByPost("requireMoney",NULL,false,"businessAnalysis/BAAPI.class.php");
        return $ret;
    }
}
