<?php

/**
 * Created by sToNe.
 * User: Administrator
 * Date: 2015/12/30
 * Time: 17:38
 */
class msgAction
{
    public $pdo; //PDO对象
    public $ret; //返回操作结果

    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    #新增消息
    function msgAdd($fieldArr)
    {
        $pdo = $this->pdo;
        foreach ($fieldArr as $key => $val) {
            switch ($key) {
                case "ID":
                    break;
                default:
                    $fieldStr .= "`$key`='$val',";
                    break;
            }
        }
        $fieldStr = rtrim($fieldStr, ",");
        $sql[] = "insert into `s_msg_logs` set " . $fieldStr;
        $result = transaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "添加成功";
            $ret['status'] = "1";
            $ret['result'] = "1";
        } else {
            $ret['status'] = "1";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
    }

    #添加微信通知
    function wx_msgAdd($fieldArr){
        $pdo = $this->pdo;
        foreach ($fieldArr as $key => $val) {
            switch ($key) {
                case "ID":
                    break;
                default:
                    $fieldStr .= "`$key`='$val',";
                    break;
            }
        }
        $fieldStr = rtrim($fieldStr, ",");
        $sql[] = "insert into `wx_template_msg` set " . $fieldStr;
//        echo "<pre>";
//        print_r($sql);
//        try {
//             $pdo->query($sql);
//        }catch (Exception $e) {
//            $result['error'] .= "\n 事务处理出错:" . $e->getMessage();
//        }
//        print_r($result);
        $result = transaction($pdo, $sql);
        if($result['error']){
            $errMsg ['sql'] = $result ['error'];
        }
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "添加成功";
            $ret['status'] = "1";
            $ret['result'] = "1";
        } else {
            $ret['status'] = "1";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
    }

    #消息修改
    function msgEdit($fieldArr)
    {
        $pdo = $this->pdo;
        $up = "update `s_msg_logs` set ";
        //也可以完成批量状态更新
        foreach ($fieldArr as $key => $val) {
            //多维数组,更新多条信息
            $updateStr = null;
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "ID":
                        break;
                    default:
                        $updateStr .= "`$k`='$v',";
                        break;
                }
            }
            $updateStr = rtrim($updateStr, ",");
            $sql[] = $up . $updateStr . " where `ID`='$key'";
        }
//        echo "<pre>";
//        print_r($sql);
        $result = extraTransaction($pdo, $sql);
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $ret ['msg'] = "更新成功";
            $ret['status'] = "1";
            $ret['result'] = "1";

        } else {
            $ret['status'] = "1";
            $ret ['msg'] = $errMsg ['sql'];
            $ret['result'] = "0";
        }
        return $this->ret = $ret;
    }


}