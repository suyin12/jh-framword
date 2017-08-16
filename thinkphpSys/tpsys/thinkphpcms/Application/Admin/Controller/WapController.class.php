<?php
/**
 * Created by phpStrom.
 * User: Administrator
 * Date: 2016/8/3
 * Time: 10:36
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Dispatcher;

class WapController extends Controller {
    var $powers;
    function _initialize()
    {
        //todo
        $this->dao = D('CheckMe');
        $this->powers = 1;

    }
    /************************************				用户模块				********************************/
    #查看phpInfo()
    function phpInfo(){
        phpinfo();
    }
    function login(){
        $this->display();
    }
    function loginDo(){
        $userName = I('userName');
        $password = md5(I('password'));
        session(array('userName'=>$userName,'password'=>$password,'expire'=>3600));
        $ret = M('user','a_')->where('userName='.'\''.$userName.'\'  and '.'password='.'\''.$password.'\'')->select();
        if($ret){
            $this->success('登录成功!','Login/index');
            session(array('userName'=>$userName,'expire'=>3600));
        }
        else{
            redirect('register');
        }
    }
    #注册
    function register(){
        $this->display();
    }
    #编辑
    function registerDo(){
        $userName = I('userName');
        $password = md5(I('password'));
        $userArr = array('userName'=>$userName,'password'=>$password,'powers'=>$this->powers);
        $retAdd = M('user','a_')->add($userArr);
        if($retAdd){
            $this->success('注册成功!','Login/index');
        }
    }
    #编辑
//    function registerDo(){
//        $userName = I('userName');
//        $password = md5(I('password'));
//        $question = I('question');
//        $answer = I('answer');
//        $pID = I('pID');
//        $tel = I('tel');
//        $email = I('email');
//        $address = I('address');
//        $blance = I('blance');
//        $userArr = array('userName'=>$userName,'password'=>$password,'question'=>$question,'answer'=>$answer,'pID'=>$pID,
//            'tel'=>$tel,'email'=>$email,'address'=>$address,'blance'=>$blance);
//        $retAdd = M('adminInfo')->add($userArr);
//        if($retAdd){
//            $this->success('注册成功!','Login/index');
//        }
//    }
    #密码重置
    function pwdReset(){
        $this->display();
    }
    function pwdResetDo(){
//         $email = "452292741@qq.com";//测试
       $email = I('email');
        $email = injectChk($email);//防止sql注入
       $userArr = M('menberinfo')->where('email='.'\''.$email.'\'')->getField('userName');
       if($userArr['userName']){
            $title = '尼玛英雄联盟商城找回密码邮件';
            $from = 'suyin@ssunse.com';//域名邮箱
            $to = $email;
            $time = time();
            $time = buildDate($time);
            $userName = 'su_yin12@qq.com';
            $password = 'sdvhpgakahujbjdj';//第三方授权码,非登陆密码
            $url = "https:".$_SERVER ['HTTP_HOST'].U('Admin/Login/editpwd').'?userName='.$userArr['userName'].'&backTime='.$time;
            $body = "<h3>亲爱的".$email."：</h3><br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码（按钮24小时内有效）。<br/><a href='" . $url . "' target='_blank'>" . $url . "</a>
            <br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>如果您没有提交找回密码请求，请忽略此邮件。";
            $ret = sendMail($title,$from,$to,$userName,$password,$body);
            if ($ret['status'])
            {
            	//更新数据发送时间
            	$ret = M('user');
            	$ret->where('id='.'\''.$uid.'\'')->save('getpasstime='.'\''.$getpasstime.'\'');
                $this->success($ret['msg'],'login');
            }
            else{
                $this->error($ret['msg']);
            }
       }else{
           $this->error('该邮箱尚未注册,请先注册!','Wap/register');
       }

    }
    function editPwd(){
        $userName = I('userName');
        $time = I("backTime");
        $newPwd = I("newPwd");
        if(!empty($newPwd)){
			$ret = M('menberinfo')->where()->save('password=.'."$newPwd");
			if($ret){
				$this->success("密码修改成功");
			}
        }else{
        	$ret = M('menberinfo')->where('username='.'\''.$userName.'\'')->select();
        	if(getMinute(time()-$time)>30&&empty($ret['id'])){
        		$this->display();
        	}
        }

    }

    function savePwd(){

    }
    #首页
    function index(){
    	if(empty(session('userName'))){
    		redirect('login');
    	}
    	$param[] = I('userName');
    	$param[] = I('userID');
    	if(!empty($param)){
    		$userInfo = $this->dao->userInfo('$param');//获取用户数据
    		$this->assign('userInfo',$userInfo);
    		$this->display('search');
    	}else{
			$this->display();
    	}

    }
    #查找指定用户
    function search(){

    }
    #获取用户信息
    function getUserInfo(){

    }
    #保存用户信息
    function userInfoDo(){

    }
    #用户个人中心
    function userCenter(){
    	$areaData = $this->dao->areaData();
		$this->assign('provinces',$areaData['provinces']);
		$this->assign('cities',$areaData['cities']);
		$this->assign('areas',$areaData['areas']);
// 		echo "<pre>";
// 		print_r($areaData['provinces']);
		$this->display();
    }
    #权限设置,选择开放区域
    function userPowers(){
        $provinceid = I('provinceid');
        if(!empty($provinceid)){
            $cities = M('cities')->where('provinceid='.'\''.$provinceid .'\'')->getField('city,cityid');
            $this->ajaxReturn(json_encode($cities),"JSON");
//            echo json_encode($cities);
        }
        $provinces = M('provinces')->select();
        $this->assign("provinces",$provinces);
        $this->display();
    }
    #编辑用户信息
    function editUserInformation(){

    }
    #删除用户数据
    function deleteUserInfo(){

    }
    /************************************				管理员模块				********************************/
    function manageLogin(){
		$this->display();
    }
    function manageLoginDo(){
    	$userName = I('userName');
    	$password = md5(I('password'));
    	$ret = M('adminInfo')->where('tpcms_userName='.'\''.$userName.'\'  and '.'tpcms_password='.'\''.$password.'\'')->select();
    	if($ret){
    		$this->success('登录成功!','Login/index');
    		session(array('userName'=>$userName,'expire'=>3600));
    	}
    }
    #权限管理
    function managePowers(){

    }

}

// function sendmail()
//     {
//         $email = $this->injectChk(stripslashes(trim($_POST['mail'])));
//         $ret = M('user')->where('email='.'\''.$email .'\'')->find();//getfield('id','username','password');
//         if (empty($ret['id'])) {//该邮箱尚未注册！
//             echo 'noreg';
//             exit;
//         } else {
//             $getpasstime = time();
//             $uid = $ret['id'];
//             $time = date('Y-m-d H:i');
//             $result = $this->sendmailDoWith($time, $email);
//             if ($result == 1) {//邮件发送成功
//                 $msg = '系统已向您的邮箱发送了一封邮件<br/>请登录到您的邮箱及时重置您的密码！';
//                 //更新数据发送时间
//                 $ret = M('user');
//                 $ret->where('id='.'\''.$uid.'\'')->save('getpasstime='.'\''.$getpasstime.'\'');
//
//             } else {
//                 $msg = $result;
//             }
//             echo $msg;
//         }
//     }

//     function reset(){
//         $token = stripslashes(trim($_GET['token']));
//         $email = stripslashes(trim($_GET['email']));
//         $sql = "select * from `t_user` where email='$email'";

//         $query = mysql_query($sql);
//         $row = mysql_fetch_array($query);
//         if($row){
//             $mt = md5($row['id'].$row['username'].$row['password']);
//             if($mt==$token){
//                 if(time()-$row['getpasstime']>24*60*60){
//                     $msg = '该链接已过期！';
//                 }else{
//                     //重置密码...
//                     $msg = '请重新设置密码，显示重置密码表单，<br/>这里只是演示，略过。';
//                 }
//             }else{
//                 $msg =  '无效的链接<br/>'.$mt.'<br/>'.$token;
//             }
//         }else{
//             $msg =  '错误的链接';
//         }
//         echo $msg;
//     }