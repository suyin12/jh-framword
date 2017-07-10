<?php

namespace Addons\WorkerService\Model;
use Think\Model;

/**
 * WorkerService模型
 */
class WorkerServiceModel extends Model{
    var $tableName = 'user';
    // **************************** 获取系统配置数据 ********************************************//
    function getConfigData($field = '') {
        $data = agentDataByPost ( 'basicSet' ,null,false,"workerService/workerServiceAPI.class.php");
        return empty ( $field ) ? $data ['data'] : $data ['data'] [$field];
    }
    //更多工资详情
    function moreSalaryDetail($param,$id){
        $param['id'] = $id;
        $ret = agentDataByPost("moreSalaryDetail",$param,false,"workerService/workerServiceAPI.class.php");
        return $ret;
    }
    //更多工资列表
    function moreSalaryList($param){
        $ret = agentDataByPost("moreSalaryList",$param,false,"workerService/workerServiceAPI.class.php");
        return $ret;
    }
    //当前月工资详情
    function lastSalaryDetail($param){
        $ret = agentDataByPost("lastSalaryDetail",$param,false,"workerService/workerServiceAPI.class.php");
        return $ret;
    }
    //员工信息
    function workerInfo($getWXUid){
        $param['uid'] = $getWXUid;
        $ret = agentDataByPost("workerInfo",$param,false,"workerService/workerServiceAPI.class.php");
        return $ret;
    }//工作年限
    function workTime($getWXUid){
        $personalData = M('workerinfo', 'a_')->where( 'userID ='.'\''.$getWXUid. '\'')->find();
        $time=intval((time()-strtotime($personalData['cBeginDay']))/(60*60*24*365));//工作的年限，以年为单位
        switch ($time) {
            case 1==$time:
                $time = '一';
                break;
            case 2==$time:
                $time = '贰';
                break;
            case 3==$time:
                $time = '叁';
                break;
            case 4==$time:
                $time = '肆';
                break;
            case 5==$time:
                $time = '伍';
                break;
            default:
                $time = '一';
                break;
        }
        return $time;
    }
    //月收入税前工资
    function averageWage($param){
        $ret = agentDataByPost("averageWage",$param,false,"workerService/workerServiceAPI.class.php");//floatval
        $total = 0;
        foreach($ret['data'] as $count =>  $value){
            $total += $value['pay'];
        }
        return $total=round($total/count($ret['data']) ,2);
    }
    //证明人信息
    function presonalData($getWXUid){
        $personalData = M('workerinfo', 'a_')->where( 'userID ='.'\''.$getWXUid. '\'')->find();
        return $personalData;
    }
    //客户经理
    function mName($getWXUid){
        $unitID = M('workerinfo','a_')->where('userID = '.'\''.$getWXUid.'\'')->getField('unitID');
        $param['unitID'] = $unitID;
        $ret = agentDataByPost("mName",$param,false,"workerService/workerServiceAPI.class.php");
        return $ret;
    }
    //单位名称
    function uName($getWXUid){
        $unitID = M('workerinfo','a_')->where('userID = '.'\''.$getWXUid.'\'')->getField('unitID');
        $param['unitID'] = $unitID;
        $ret = agentDataByPost("uName",$param,false,"workerService/workerServiceAPI.class.php");
//        dump($ret);
        return $ret;
    }

    function proveType($id){
        switch($id){
            case 1==$id:
                $provetype = "收入证明(月收入)";
                break;
            case 2==$id:
                $provetype = "收入证明(年收入)";
                break;
            case 3==$id:
                $provetype = "在职证明";
                break;
            case 4==$id:
                $provetype = "参保证明";
                break;
            case 5==$id:
                $provetype = "落户证明";
                break;
            default:
                $provetype = "自定义证明";
        }
        return $provetype;
    }
    //合同终止日期
    function dimissionDate($getWXUid){
        $personalData = $this->presonalData($getWXUid);
        $dimissionDate = M('dimission','a_')->where('uID='.'\''.$personalData['uID'].'\'')->find();
        return $dimissionDate;
    }
    //实发工资金额总计
    function total($param){
        $data = $this->moreSalaryList($param);
        $total = 0;
        foreach($data['data'] as  $value){
            foreach($value as $key => $v){
                if('acheive'==$key){
                    $total += floatval($v);
                }
            }
        }
        return $total=round($total ,2);
    }
    //年收入税前工资
    function incomeYear($param){
        $ret = agentDataByPost("incomeYear",$param,false,"workerService/workerServiceAPI.class.php");
        $total = 0;
        foreach($ret['data'] as $count =>  $value){
            foreach($value as $key => $val){
                $total += $val['pay'];
            }
        }
        return $total=round($total ,2);
    }
    //登记已查阅工资
    function salaryReaded($getWXUid,$id){
        $param['uid'] = $getWXUid;
        $param['id'] = $id;
        $ret = agentDataByPost("salaryReaded",$param,false,"workerService/workerServiceAPI.class.php");
//        dump($ret);
        return $ret;
    }
    function content($uid,$auth,$mobile,$msg,$expid,$encode){
        $data = array(
            'uid'=>$uid,
            'auth'=>$auth,
            'mobile'=>$mobile,
            'msg'=>$msg,
            'expid'=>$expid,
            'encode'=>$encode
        );
        return $data;
    }
    //验证码位数控制
    function rands(){
        $verify = '';
        for($i=0;$i<4;$i++){
            $verifyCode = rand(0,9);
            $verify.=$verifyCode;
        }
        return $verify;
    }
    //删除没有填写收件信息的证明记录
    function deleteProveData($uID){
        $param['uid'] = $uID;
        $ret = agentDataByPost("deleteProveData",$param,false,"workerService/workerServiceAPI.class.php");
        return $ret;
    }
    //删除证明记录
    function proveDel($proveID) {
        $param ['proveID'] = $proveID;
        $res = agentDataByPost ( 'proveDel',$param,false,"workerService/workerServiceAPI.class.php" );
        return $res;
    }




}
