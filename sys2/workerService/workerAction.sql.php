<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/22
 * Time: 9:05
 */
require_once "workerServiceSet.data.php";
require "../msgManage/msgAction.sql.php";
class workerAction
{
    public $ret; //返回操作结果
    public $pdo;
    function __construct()
    {
        $this->pdo = $GLOBALS['pdo'];
    }

    function proveInfo($selStr = " * ", $conStr = " 1=1 "){
        $pdo = $this->pdo;
        $sql1 = " select $selStr from a_prove where $conStr ";
        $ret = SQL($pdo, $sql1);
        $sql2 = "select unitID from a_workerinfo where uID='".$ret[0]['uID']."'";
        $unitID = SQL($pdo,$sql2);
        $sql3 = "select mName from s_user where unitID REGEXP '".$unitID[0]['unitID']."'and roleID REGEXP '2_1'";
        $mName = SQL($pdo,$sql3);
        foreach($ret as $val){
            $arr[] = array_merge($val,$mName[0]);
        }
        return $arr;
    }

    function proveContactInfo($selStr = " * ", $conStr = " 1=1 "){
        $pdo = $this->pdo;
        $sql = " select $selStr from a_contactinfo where $conStr ";
        $ret = SQL($pdo, $sql);
        return $ret;
    }
    //删除无效证明
    function proveID(){
        $pdo = $this->pdo;
        $proveID = "select proveID from a_contactinfo ";
        $ID = "select ID from a_prove ";
        $proveID = SQL($pdo, $proveID, null, $type = "all");
        $ID = SQL($pdo, $ID, null, $type = "all");
        foreach($proveID as $key => $value){
            $a[]=$value['proveID'];
        }
        foreach($ID as $key => $value){
            $b[]=$value['ID'];
        }
        $deleteID = array_diff($b,$a);
//        $strDeleteID = implode(",",$deleteID);
        foreach($deleteID as $key => $value){
            $sql = "delete from a_prove where ID='".$deleteID[$key]."'";
            SQL($pdo, $sql);
        }

    }
    //填写快递单号
    function expressNumber($selStr, $conStr = " 1=1 "){
        $pdo = $this->pdo;
        $sql = " update  a_contactinfo set $selStr where  $conStr ";
        SQL($pdo,$sql);
    }

    function modifyStatus($selStr = "status=0" , $conStr = " 1=1 "){
        $pdo = $this->pdo;
        $sql = "update a_prove set $selStr where $conStr ";
        $ret = SQL($pdo, $sql);
        return $ret;
    }

    function workerInfo($selStr = "status=0" , $conStr = " 1=1 "){
        $sql = " select $selStr from a_workerinfo where $conStr ";
        $ret = SQL($this->pdo, $sql);
        return $ret;
    }
    //微信解绑
    function resetWeChat($selStr = " 1=1 "){
        $pdo = $this->pdo;
        $sql = "update a_workerinfo set userID = 0 where $selStr";
        $ret = SQL($pdo, $sql);
        return $ret;

    }
    function statusArr($field=0){
            $workerProveArr = array("0" => "未审核","1" => "已审核","2"=>"已邮寄",99=>"回退");
        return $workerProveArr;
    }
    //推送微信消息
    function sendProveMsg($status,$ID){
        $pdo = $this->pdo;
        $sql = "select uID from a_prove  where ID='".$ID."'";
        $uID = SQL($pdo, $sql);
        $uID = implode("",$uID[0]);
        $sql = "select userID from a_workerinfo where uID='".$uID."'";
        $userID = SQL($pdo, $sql);
        $userID = implode("",$userID[0]);
        $wSet = new workerServiceSet();
        $wxTemplateIDArr = $wSet->workerServiceSetArr("wx_templateID");
        if ($status == 1) {
            //证明审核结果通过并且已经邮寄推送给微信
            $url = "http://www.szhro.cn/workerService/index.php?s=/addon/WorkerService/Wap/process/";
            $fieldArr['sender'] = "1";
            $fieldArr['receiver'] = $userID;
            $fieldArr['sendTime'] = timeStyle("dateTime");
            $fieldArr['level'] = "1";
            $fieldArr['fromTo'] = "4";
            $wxFieldArr['uid'] = $userID;
            $wxFieldArr['templateID'] = $wxTemplateIDArr['wx_templateID']['proveMsg']['ID'];
            $wxFieldArr['url'] = $url;
            $wxFieldArr['sendTime'] = timeStyle("dateTime");
            $wxparam ['data'] ['first'] ['value'] = "证明审核结果通过";
            $wxparam ['data'] ['first'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword1'] ['value'] = $fieldArr['sendTime'];
            $wxparam ['data'] ['keyword1'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword2'] ['value'] = "证明申请";
            $wxparam ['data'] ['keyword2'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword3'] ['value'] = "请到个人中心查询快递单号";
            $wxparam ['data'] ['keyword3'] ['color'] = "#E60B43";
            $wxparam ['data'] ['remark'] ['value'] = "请注意查收";
            $wxparam ['data'] ['remark'] ['color'] = "#173177";
            $wxFieldArr['param'] = serialize($wxparam);
            $ma = new msgAction();
            $ma->msgAdd($fieldArr);
            $ma->pdo = $GLOBALS['pdo'];
            $ma->wx_msgAdd($wxFieldArr);
        }elseif($status == 99){
            //证明审核结果不通过推送给微信
            $url = "http://www.szhro.cn/workerService/index.php?s=/addon/WorkerService/Wap/process/";
            $fieldArr['sender'] = "1";
            $fieldArr['receiver'] = $userID;
            $fieldArr['sendTime'] = timeStyle("dateTime");
            $fieldArr['level'] = "1";
            $fieldArr['fromTo'] = "4";
            $wxFieldArr['uid'] = $userID;
            $wxFieldArr['templateID'] = $wxTemplateIDArr['wx_templateID']['proveMsg']['ID'];
            $wxFieldArr['url'] = $url;
            $wxFieldArr['sendTime'] = timeStyle("dateTime");
            $wxparam ['data'] ['first'] ['value'] = "证明审核结果不通过";
            $wxparam ['data'] ['first'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword1'] ['value'] = $fieldArr['sendTime'];
            $wxparam ['data'] ['keyword1'] ['color'] = "#173177";
            $wxparam ['data'] ['keyword2'] ['value'] = "证明申请";
            $wxparam ['data'] ['keyword2'] ['color'] = "#173177";
            $wxparam ['data'] ['remark'] ['value'] = "请注意查收";
            $wxparam ['data'] ['remark'] ['color'] = "#173177";
            $wxFieldArr['param'] = serialize($wxparam);
            $ma = new msgAction();
            $ma->msgAdd($fieldArr);
            $ma->pdo = $GLOBALS['pdo'];
            $ma->wx_msgAdd($wxFieldArr);
        }
    }
}