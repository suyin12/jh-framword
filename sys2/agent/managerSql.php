<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/7 - 11:22
 *
 *  链接 managerAgentAction.sql.php
 *
 * 作为ajax 交互文件. 调用具体操作方法
 */

#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";

$mAA = new managerAgentAction();

#生成社保报表
if($_POST ['btn'] == "createSoInsList"){

    $ret = $mAA->createSoInsList();
    $js_msg = json_encode($ret);
    echo $js_msg;

}

#社保专员签收社保申报表
if ($_POST ['btn'] == "receiveSoInsList") {

    $ret = $mAA->receiveSoInsList($_POST['chkList']);
    $js_msg = json_encode($ret);
    echo $js_msg;
}

#生成公积金报表
if($_POST ['btn'] == "createHFList"){

    $ret = $mAA->createHFList();
    $js_msg = json_encode($ret);
    echo $js_msg;

}

#公积金专员签收公积金申报表
if ($_POST ['btn'] == "receiveHFList") {

    $ret = $mAA->receiveHFList($_POST['chkList']);
    $js_msg = json_encode($ret);
    echo $js_msg;
}