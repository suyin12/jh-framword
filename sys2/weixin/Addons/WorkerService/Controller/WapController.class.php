<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/20
 * Time: 16:46
 */
namespace Addons\WorkerService\Controller;
use Home\Controller\AddonsController;
//use Think\Verify;

class WapController extends AddonsController
{
    var $dao;
    var $workerInfo;

    function _initialize()
    {
        //todo
//        $this->mid=552;
        $this->dao = D('WorkerService');
        // 邀请日志
        $invite_code = I ( 'invite_code' );
        $invite_uid = I ( 'invite_uid' );
        $this->_invite_log ( $invite_code, $invite_uid );
    }
    //邀请日记
    private function _invite_log($invite_code = '', $invite_uid = 0) {
        $invite_uid == 0 && $invite_uid = intval ( session ( 'workerservice_invite_uid' ) );
        if (! empty ( $invite_code ) && $invite_uid == 0) {

            $umap ['invite_code'] = $invite_code;
            $invite_uid = M ( 'user' )->where ( $umap )->getField ( 'uid' );
        }
        if ($invite_uid > 0 && $this->mid < 0) {
            // 当前用户未登录情况下先保存到session里，登录后再写入表中
            session ( 'workerservice_invite_uid', $invite_uid );
        } else if ($invite_uid > 0 && $this->mid > 0 && $invite_uid != $this->mid) {
            $data ['invite_uid'] = $invite_uid;
            $data ['uid'] = $this->mid;
            $data ['accessUrl'] = __SELF__;
            if (M ( 'workerservice_invite_log' )->where ( $data )->getField ( 'id' )) {
                M ( 'workerservice_invite_log' )->setField ( 'cTime', NOW_TIME );
            } else {
                $data ['cTime'] = NOW_TIME;
                M ( 'workerservice_invite_log' )->add ( $data );
            }
        }
    }
    //首页
    function index()
    {
        $userID2 = I('userID');
        $uid = $this->getWXUid();
        $userID = M('workerinfo', 'a_')->where('userID = '.'\''.$uid.'\'')->getField('userID,name,unitID,uID');//查询wx_workerinfo表
         if($userID['userID']!=$uid&&$userID2==$uid){
             redirect(U('loginFirst'));
         }else{
         $mName = $this->mName();
         $this->assign('mName',$mName['data'][0]);
         $this->display();
         }
    }
    //判断员工是否登录过
    function existUser(){
        $uid = $this->getWXUid();
        $userID = M('workerinfo', 'a_')->where('userID = '.'\''.$uid.'\'')->getField('userID');//查询wx_workerinfo表
        if($userID){
            return true;
        }else{
            redirect(U('loginFirst'));
        }
    }
    //首次登录添加当前用户id到表a_workerinfo中
    function fixedUserID($param)
    {
        $userData = array(
            'userID' => $this->getWXUid(),
        );
        if (!empty($param['idCard'])) {
            $workerInfo = M('workerinfo', 'a_');
            $workerInfo->where("pID='".$param['idCard']."'")->save($userData);
            $userID = $workerInfo->where("pID='".$param['idCard']."'")->getField('userID');
            $url = U ( 'index', array (
                'userID' => $userID['userID']
            ) );
            redirect($url);
        }
    }
    function test(){
        $model = M('User');
        $data['id'] = $_POST['id'];
        $data['name'] = $_POST['name'];
        $res1 = $model->create($data);
        $res2 = $model->add($data);
        $res3 = $model->where($data)->order('id desc,time')->limit(10)->select();
        $res4 = $model->where('status = 1 AND name ="thinkphp" ')->find();
        $res5 = $model->where('id = 3')->getField('nickname');
        $res6 = $model->where('id=1')->save($data);
        $res7 = $model->where('id=5')->delete();
        $model->field('name')->filter('strip_tags')->save();
        $res4->data();
        dump($res1);
        $this->assign('mName',$res4);
        $this->display();

    }
    //当前用户uID
    function getUid()
    {
        $getWXUid = $this->getWXUid();
        $uID = M('workerinfo', 'a_')->where('userID=' . '\'' . $getWXUid . '\'')->getField('uID');
        return $uID;
    }
    //获取用户uid
    function getWXUid()
    {
        $uid = getuserinfo($this->mid,'uid');
        return $uid;
    }
    //登录页面
    function loginFirst()
    {
        $this->display();
    }
    // 注册及验证员工信息是否一致
    function checkUV() {
        if (IS_POST) {
            $invite_code = I ( 'invite_code' );
            $this->_invite_log ( $invite_code );
            $param = I("post.");
            $wxUid = $this->getWXUid();
            $userID = M('workerinfo', 'a_')->where('pID ='.'\''.$param['idCard'].'\''.'and name ='.'\''.$param['name'].'\''.'and mobilePhone ='.'\''.$param['mobilePhone'].'\'')->getField('userID');
            $status = M('workerinfo', 'a_')->where('pID ='.'\''.$param['idCard'].'\''.'and name ='.'\''.$param['name'].'\''.'and mobilePhone ='.'\''.$param['mobilePhone'].'\'')->getField('status');
            if ($userID!=$wxUid&&$status==1) {
                $this->fixedUserID($param);
            } else {
//                echo "<pre>";
//                print_r($status);
                redirect(U('errorLogin'));
            }
        }
    }
    //登录错误信息
    function errorLogin()
    {
        $mName = $this->mName();
        $this->assign('mName',$mName['data'][0]);
        $this->display();
    }
    //校验验证码
    function checkVerify()
    {
        $i_code = I('i_code');
        $verify = session("iCode");
        if ($i_code != $verify['verify']) {
            $errorInfo['error'] = '验证码输入错误!' ;
            $this->ajaxReturn($errorInfo);
        }
    }
    //验证码
    function verify()
    {
        $url = 'http://sms.10690221.com:9011/hy/';
        $uid = '80258';
        $auth = '86d3344c5704956ebbbb56262050ba96';
        $now = time();
        $iCode = session("iCode");
        $verify = $this->dao->rands();
        $msg = "动态验证码" . $verify . "（半小时内有效），为信息安全，请妥善保管验证码，切勿泄露。";
        if($iCode){
            if($iCode['iCodeSendTime']+$iCode['expire']<$now){
                $mobile = I('phone');
                $expid = '0';
                $encode = 'utf-8';
                $data = $this->dao->content($uid, $auth, $mobile, $msg, $expid, $encode);
                $url1 = $this->generateUrl($url, $data);
                $ret = $this->getUrl($url1);
                list($sendStatus,$sendID) = explode(",",$ret);
                if($sendStatus == "0"){
                    $iCodeSession = array('verify'=> $verify,"expire"=>"1800","iCodeSendTime"=>$now);
                    session('iCode',$iCodeSession);
                }
            }else{
                $errorInfo['error'] = "验证码半小时内有效!";
                $this->ajaxReturn($errorInfo);
            }
        }else{
            $mobile = I('phone');
            $verify = $this->dao->rands();
            session(array("iCode"=>array('verify'=> $verify,"expire"=>"1800","iCodeSendTime"=>$now)));
            $msg = "动态验证码" . $verify . "（半小时内有效），为信息安全，请妥善保管验证码，切勿泄露。";
            $expid = '0';
            $encode = 'utf-8';
            $data = $this->dao->content($uid, $auth, $mobile, $msg, $expid, $encode);
            $url1 = $this->generateUrl($url, $data);
            $ret = $this->getUrl($url1);
            list($sendStatus,$sendID) = explode(",",$ret);
            if($sendStatus == "0"){
                $iCodeSession = array('verify'=> $verify,"expire"=>"1800","iCodeSendTime"=>$now);
                session('iCode',$iCodeSession);
            }
        }
    }
    function generateUrl($url, $data)
    {
        $get = '';
        while (list($k, $v) = each($data)) {
            $get .= $k . "=" . urlencode($v) . "&";//转URL标准码
        }
        return $url = $url . '?' . $get;
    }
    function getUrl($url)
    {
        if (function_exists('file_get_contents')) {
            $file_contents = file_get_contents($url);
        } else {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }
    //当月工资详情
    function lastSalaryDetail()
    {
        $this->existUser();
        $param['uID'] = $this->getUid();
        $data = $this->dao->lastSalaryDetail($param);
        $engToChs = $this->dao->getConfigData('engToChs');
        if ($data['result']) {
            $this->assign("engToChs",$engToChs);
            $this->assign("data",$data['data']);
        } else {
          redirect(U('salaryNone'));//查询无记录
        }
        $this->display();
    }
    //过去3个月实发工资
    function moreSalaryList()
    {
        $param['uID'] = $this->getUid();
        $data = $this->dao->moreSalaryList($param);
        $total = $this->dao->total($param);
        foreach($data['data'] as $key => $val){
           $tem[$val['salaryDate']]['salaryDate'] = $val['salaryDate'];
            $tem[$val['salaryDate']]['acheive'] +=$val['acheive'];
        }
        if ($data['result']) {
            $this->assign('total', $total);//实发工资金额总和
            $this->assign('Date_data', $tem);
            $this->display();
        } else {
            redirect(U('pastNone'));//查询无记录
        }
    }
    //过去3个月工资工资详情
    function moreSalaryDetail()
    {
        $id = I('get.id');
        session('id', $id);
        $param['uID'] = $this->getUid();
        $param['type'] = I('get.type');
        $param['salaryDate'] = I('get.salaryDate');
        $data = $this->dao->moreSalaryDetail($param,$id);
        $engToChs = $this->dao->getConfigData('engToChs');
        if ($data['result']) {
            $this->assign("engToChs",$engToChs);
            $this->assign("data",$data['data']);
        } else {
            redirect(U('salaryNone'));//查询无记录
        }
        $this->display();
        $this->salaryReaded();
    }
    //登记已查阅工资
    function salaryReaded()
    {
        $id = session('id');
        $uID = $this->getUid();
        $getWXUid = $this->getWXUid();
        $personalData = $this->dao->presonalData($getWXUid);
        $month = $this->dao->salaryReaded($getWXUid, $id);
        foreach($month['data'] as $val){
            $salaryDate=$val[0]['salaryDate'];
        }
        $data = array(
            'uID' => $uID,
            'status' => 1,
            'name' => $personalData['name'],
            'createtime' => date('Y-m-d H:i:s', time()),
            'month' => $salaryDate
        );
        $month =  M('salayreaded','a_')->where('month='.'\''.$salaryDate.'\'')->getField('uID');
        if($month){
            return true;
        }else{
            M('salayreaded', 'a_')->where('status null')->add($data);
        }

    }
    //当前月查询无记录
    function salaryNone()
    {
        $this->display();
    }
    // 过去3月查询无记录
    function pastNone()
    {
        $this->display();
    }

    //证明列表
    function proveList()
    {
        $this->existUser();
        $this->display();
    }
    //客户经理
    function mName(){
        $getWXUid = $this->getWXUid();
        $mName = $this->dao->mName($getWXUid);
        return $mName;
    }
    function uName(){
        $getWXUid = $this->getWXUid();
        $uName = $this->dao->uName($getWXUid);
        return $uName;
    }
    function nowTime(){
        $nowTime = (date('Y')).'年'.(date('n'))."月".(date('j'))."日 ";
        return $nowTime;
    }
    //收入证明(月收入)
    function aforProve()
    {
        $param['uID'] = $this->getUid();
        $getWXUid = $this->getWXUid();
        $averageWage = $this->dao->averageWage($param);
        $personalData = $this->dao->presonalData($getWXUid);
        $mName = $this->mName();
        $nowTime = $this->nowTime();
        if (1 == $personalData['status']) {
            $status = '在职员工';
        } else {
            $status = '离职员工';
        }
        $time = $this->dao->workTime($getWXUid);//工作年限
        $this->assign('nowTime',$nowTime);
        $this->assign('time', $time);
        $this->assign('status', $status);
        $this->assign('personalData', $personalData);
        $this->assign('averageWage',$averageWage);
        $this->assign('mName',$mName['data'][0]);
        $this->display();
    }
    //收入证明(年收入)
    function incomeYear()
    {
        $getWXUid = $this->getWXUid();
        $param['uID'] = $this->getUid();
        $personalData = $this->dao->presonalData($getWXUid);
        $incomeYear = $this->dao->incomeYear($param);
        $nowTime = $this->nowTime();
        $mName = $this->mName();
        // dump($mName);
        if ($personalData['status'] == 1) {
            $status = '在职员工';
        } else {
            $status = '离职员工';
        }
        $time = $this->dao->workTime($getWXUid);//工作年限
        $this->assign('nowTime',$nowTime);
        $this->assign('time', $time);
        $this->assign('status', $status);
        $this->assign('personalData', $personalData);
        $this->assign('incomeYear',$incomeYear);
        $this->assign('mName',$mName['data'][0]);
        $this->display();
    }
    //在职证明
    function serving()
    {
        $getWXUid = $this->getWXUid();
        $personalData = $this->dao->presonalData($getWXUid);
        $nowTime = $this->nowTime();
        $uName = $this->uName();
        $this->assign('uName',$uName['data'][0]['unitName']);
        $this->assign('nowTime',$nowTime);
        $this->assign('personalData', $personalData);
        $this->display();
    }
    //离职证明
    function turnover()
    {
        $getWXUid = $this->getWXUid();
        $personalData = $this->dao->presonalData($getWXUid);
        $dimissionDate = $this->dao->dimissionDate($getWXUid);
        $mName = $this->mName();
        $nowTime = $this->nowTime();
        $this->assign('nowTime',$nowTime);
        $this->assign('mName',$mName['data'][0]);
        $this->assign('personalData', $personalData);
        $this->assign('dimissionDate', $dimissionDate['dimissionDate']);
        $this->display();
    }
    //参保证明
    function insurance()
    {
        $getWXUid = $this->getWXUid();
        $personalData = $this->dao->presonalData($getWXUid);
        $nowTime = $this->nowTime();
        $this->assign('nowTime',$nowTime);
        $this->assign('personalData', $personalData);
        $this->display();
    }
    //落户证明
    function settled(){
        $getWXUid = $this->getWXUid();
        $personalData = $this->dao->presonalData($getWXUid);
        $mName = $this->mName();
        $nowTime = $this->nowTime();
        $this->assign('nowTime',$nowTime);
        $this->assign('mName',$mName['data'][0]);
        $this->assign('personalData', $personalData);
        $this->display();
    }
    //出错证明
    function error()
    {
        $this->display();
    }

    //自定义证明
    function personal()
    {
        $this->display();
    }

    //获取证明信息
    function proveInfo()
    {
        $content = I('content');
        $proveName = I('proveName');
        $acceptUnit = I('acceptUnit');
        $id = I('get.id');
        $provetype = $this->dao->proveType($id);
        $getWXUid = $this->getWXUid();
        $personalData = $this->dao->presonalData($getWXUid);
        $provedata = array(
            'uID' => $personalData['uID'],
            'name' => $personalData['name'],
            'pID' => $personalData['pID'],
            'status' => 0,
            'unit' => $personalData['filiale'],
            'position' => $personalData['station'],
            'createtime' => date('Y-m-d H:i:s', time()),
            'acceptUnit' => $acceptUnit,
            'proveName' => $proveName,
            'content' => $content,
            'provetype' => $provetype
        );
        if($personalData['userID']!=0){
            $add = M('prove', 'a_');
            $add->add($provedata);
        }
            $ID = M('prove','a_')->where('uID='.'\''.$personalData['uID'].'\'')->order ('ID desc' )->limit ( 1 )->getField('ID');
            $url = U ( 'contactInfo', array (
                'proveID' => $ID
            ) );
            redirect($url);

    }
    //收件人信息页面
    function contactInfo()
    {   $proveID = I('get.proveID');
        $this->assign('proveID',$proveID);
        $this->display();
    }

    //收件人信息写进数据表
    function contactInfoSave()
    {
        $name = I('name');
        $proveID = I('proveID');
        $mobilePhone = I( 'mobilePhone');
        $address = I('address');
        $express = I('express');
        $uID = $this->getUid();
        $data = array(
            'contactname' => $name,
            'phone' => $mobilePhone,
            'address' => $address,
            'express' => $express,
            'createtime' => date('Y-m-d H:i:s', time()),
            'uID' => $uID,
            'proveID' => $proveID
        );
        $isID = M('contactinfo','a_')->where('proveID='.'\''.$proveID.'\'')->select();
        if (!empty($data['contactname']) && !empty($data['phone'])&&empty($isID)) {
            $add = M('contactinfo', 'a_');
            $add->add($data);
            $this->dao->deleteProveData($uID);//删除无效证明
        }
        $this->display('success');
    }
    //删除证明
    function proveDel() {
        $res = $this->dao->proveDel ( I ( 'proveID' ) );
        $this->ajaxReturn ( $res );
    }

    //证明保存
    function proveSave()
    {
        if (I('post.files')) {
            $monthPatches = "proveAttachment" . date("Ymd", time());
            $uploadPath = "Uploads/" . $monthPatches;
            $files = array();
            foreach ($_POST['files'] as $k => $l) {
                $orderImgPathStr .= $monthPatches . "/" . $l . ",";
                $orderImgPathArr[] = $monthPatches . "/" . $l;
            }
            $files = array_filter($files);
        }
        $this->display();
    }
    //个人中心
    function userCenter()
    {
        $this->existUser();
        $this->display();
    }
    // 个人中心-招聘协议
    function groom()
    {
        $this->existUser();
        $this->display();
    }
    //个人中心-个人信息
    function workerInfo()
    {
        $this->existUser();
        $getWXUid = $this->getWXUid();
        $data = $this->dao->workerInfo($getWXUid);
        $replacebID = $data['data'][0];
        $uName = $this->uName();
        $pID = substr_replace($replacebID['pID'],'********',6,8);
        $bID = substr_replace($replacebID['bID'],'*******',6,7);
        $this->assign('bID', $bID);
        $this->assign('pID', $pID);
        $this->assign('uName',$uName['data'][0]['unitName']);
        $this->assign('Personal_data', $data['data'][0]);
        $this->display();
    }
    //个人中心-关于我们
    function about()
    {
        $this->display();
    }

    // 个人中心-申请进度查询
    function process()
    {
        $this->existUser();
        $address = I('address');
        $uID = $this->getUid();
        $expressData = M('contactinfo', 'a_')->where('uID=' . '\'' . $uID . '\'')->order('createtime desc')->limit('5')->select();
        foreach($expressData as $key => $value){
            $proveID[] = $value['proveID'];
        }
        for($i=0;$i<count($proveID);$i++){
            $proveData[] = M('prove','a_')->where('uID=' . '\'' . $uID . '\''.'and ID='.'\''.$proveID[$i].'\'')->order('createtime desc')->select();
        }
        foreach($proveData as $k => $v){
            foreach($v as $m => $n){
                $mergeData[] = array_merge_recursive($expressData[$k],$n);
            }
        }
        $this->assign('mergeData',$mergeData);
        $this->display();
    }

// 个人中心-招聘信息
    function recruitmentInfo()
    {
        $this->existUser();
        $recruitmentInfo = M('recruitment','a_')->where('1=1')->limit('5')->select();
        $this->assign('recruitmentInfo',$recruitmentInfo);
        $this->display();
    }
// 招聘详细页
    function workDetails()
    {
        $ID = I('ID');
        $recruitmentDetails = M('recruitment','a_')->where('ID='.'\''.$ID.'\'')->select();
        $this->assign('recruitmentDetails',$recruitmentDetails[0]);
        $this->display();
    }
    // 分享推荐
    function share() {
        $map['uid'] = $this->getWXUid();
        $userInfo = M ( 'user' )->where($map)->field ( 'invite_code' )->select ();
        $invite_code = $userInfo[0]['invite_code'];
        if(!$invite_code){
            $invite_code= D ( 'Common/Follow' )->makeInviteCode ();
            M ( 'user' )->where ( $map )->setField ( 'invite_code', $invite_code );
        }
        $workerInfo = $this->workerInfo;
        $this->assign(array("name"=>$workerInfo['name'],"mid"=>$map['uid'],"invite_code"=>$invite_code));
        $this->display();
    }
    // 邀请记录
    function inviteLog() {
        $map ['invite_uid'] = $this->mid;
        $list = M ( 'workerService_invite_log' )->where ( $map )->order ( 'cTime desc' )->selectPage ();
        $this->assign ( $list );
        $this->display ();
    }

// 自定义证明提交成功跳转页面
    function success()
    {
        $this->display();
    }

    //文件上传
    function fileUpload()
    {
        $today = date("Ymd", time());
        $path = "Uploads/userFiles/proveFiles/" . $today . "/";
        $options = array(
            'upload_dir' => $path,
            'upload_url' => $path,
            'accept_file_types' => '/\.(dll|txt|doc|gif|jpe?g|png|rar|pdf|ai|cs|bmp|zip|docx?|ppt|e?ps|pict|raw|ai|psd|cdr|tiff?)$/i'
        );
        $info = new \OT\UploadHandler($options);
        return $info;
    }

}

    




