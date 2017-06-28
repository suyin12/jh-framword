<?php
/**
 *
 * User: suyin
 * Date: 2017/6/2713:49
 *
 */
/**
 *
 * 1）用文件存储会员信息，会员注册输入用户名和电子邮件就行。
 * 2）用户信息包括：用户名，电子邮件。
 * 3）要求用户可以登录、退出和注销用户。
 * 4）如果用户没有退出，下次登录自动显示用户名。
 * 5）保存用户上次浏览时间。
 *
 *
 * */
use conn;

class MemberModel{
    private static $_instance;
    private $username;
    private $email;
    private $saveTime;
    private $pdo;

    public function __construct($username='',$email=''){
        $this->username = $username;
        $this->email = $email ;
        session_start();;
        $this->pdo = Conn::get_instance();
    }
    public function dataRet($data,$message=""){
        if(!empty($data)){
           $arr['status'] = "0";
           $arr['data'] = "";
           $arr['message'] = $message;
        }else{
            $arr['status'] = "1";
            $arr['data'] = $data;
            $arr['message'] = "成功!";
        }
        return json_encode($arr);
    }
    public function getMemberInfo(){
        //保存到数据库
        $sql = "select email from member_info where email=`$this->email`";
        if($this->pdo->query($sql)){
            return $this->dataRet($this->pdo->query($sql),"该邮箱已经注册,请通过邮箱找回密码!");
        }
        $str = "insert into member_info(M_ID,M_Name,M_Password,M_Question,M_Answer,M_Card,M_Tel,M_QQ,M_Email,M_Address,M_Code,M_Money,M_Blance,M_CreateTime,M_Status)values(,:username,'','','','','','',:email,'','','','','','')";
        $sth = $this->pdo->prepare($str,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $res = $sth->execute(array(':username'=>$this->username,':email'=>$this->email));
        return $this->dataRet($res,"插入失败!");
        //保存为文件格式
//        $arr = "\r\n".$this->username." ".$this->email." ";
//        if(file_exists("merber.txt")) {
//            file_put_contents("merber.txt", $arr, FILE_APPEND);
//            echo "保存成功";
//            exit;
//        }

    }
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function login(){
        $merberStr = file_get_contents("merber.txt");
        $merberArr = explode(" ",$merberStr);
//        var_dump($merberArr);exit;
        foreach($merberArr as $key => $value){
            if($value == $this->email){
                $_SESSION['email'] = $this->email;
                $_SESSION['saveTime'] = time();
                $_SESSION['username'] = $merberArr[$key-1];
//                header("Location:index.php");
            }
        }
    }
    public function userExit(){
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
        exit;
    }
    public function logout(){
        unset($_SESSION['email']);
        echo '注销成功！点击此处 <a href="login.html">登录</a>';
        exit;
    }
    public function getUsername(){
        echo $_SESSION['username'];
    }
    public function saveStartTime(){
        $config = ["username","email","saveTime"];
        $arr = array($this->username,$this->email, $this->saveTime);
        if(!file_exists("saveTime.txt")){
            file_put_contents("saveTime.txt",$config,FILE_APPEND);
        }else{
            file_put_contents("saveTime.txt",$arr,FILE_APPEND);
        }
    }
    public function checkLogout(){
        echo date("Y-m-d H:i:s",$_SESSION['saveTime']);
    }
}
$test = new MemberModel("李四","452292741@qq.com");
//$test->getMerberInfo();
$test->checkLogout();