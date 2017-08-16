<?php
import('Com.Email.PHPMailer');
import('Com.Email.SMTP');
import('Com.Email.pop3');
import('Com.Email.PHPMailerAutoload');

function sendMail($title,$from,$to,$userName,$password,$body){
    $mail = new PHPMailer();
//是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
//    $mail->SMTPDebug = 1;
//使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
//可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
    $mail->isSMTP();
//smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;
//链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';
//设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';
//设置ssl连接smtp服务器的远程服务器端口号 可选465或587
    $mail->Port = 465;
////设置smtp的helo消息头 这个可有可无 内容任意
//    $mail->Helo = 'Hello smtp.qq.com Server';
//设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    $mail->Hostname = 'ssunse.com';
//设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';
//设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = 'suyin';
//smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = $userName;//su_yin12@qq.com
//smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
    $mail->Password = $password;//sdvhpgakahujbjdj
//设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = $from;
//邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);
//设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to,'');
//添加多个收件人 则多次调用方法即可
//    $mail->addAddress('644186268@qq.com');
//添加该邮件的主题
    $mail->Subject = $title;
//添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $body;
//为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
//    $mail->addAttachment('', '');
//同样该方法可以多次调用 上传多个附件
//    $mail->addAttachment('', '');
//发送命令 返回布尔值
//PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
    $status = $mail->send();
    $msg = '';//返回信息
//简单的判断与提示信息
    if ($status)
    {
        $msg = '发送邮件成功';
    }
    else{
        $msg = '发送邮件失败，错误信息为<pre>：' . $mail->ErrorInfo;
    }
    $ret = array('status'=>$status,'msg'=>$msg);
    return $ret;
}

function send_mail($title, $content, $from, $to, $chart = 'utf-8', $attachment = '') {
	$mail = new PHPMailer ();
	$mail->CharSet = $chart; // 设置采用gb2312中文编码
	$mail->isSMTP ( 'SMTP' ); // 设置采用SMTP方式发送邮件
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPDebug = 1;
	$mail->Host = "smtp.qq.com"; // 设置邮件服务器的地址
    //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
    $mail->Port = 465;
	$mail->From = $from; // 设置发件人的邮箱地址
	$mail->FromName = "suyin@ssunse.com"; // 设置发件人的姓名
	$mail->SMTPAuth = true; // 设置SMTP是否需要密码验证，true表示需要
	$mail->Username = "su_yin12@qq.com"; // 设置发送邮件的邮箱
	$mail->Password = "sdvhpgakahujbjdj"; // 设置邮箱的密码//hduzaspugtlfbjdj
	$mail->Subject = $title; // 设置邮件的标题
	$mail->AltBody = "text/html"; // optional, comment out and test
	$mail->Body = $content; // 设置邮件内容
	$mail->isHTML ( true ); // 设置内容是否为html类型
	$mail->WordWrap = 50; // 设置每行的字符数
	$mail->addReplyTo ( "地址", "名字" ); // 设置回复的收件人的地址
	$mail->addAddress ( $to, "" ); // 设置收件的地址
	if ($attachment != '') {
		$mail->addAttachment ( $attachment, $attachment );
	}
	if ($mail->send()) {
		//$status1 = "$to" . '&nbsp;&nbsp;已投送成功<br />';
		$status = 1;

	} else {
		//$status2 = "$to" . '&nbsp;&nbsp;发送邮件失败<br />';
		$status = 0;
	}
	return $status;
}
#返回当前时间年份,时间格式为时间戳:2016-9-19
function getYear($time="",$type=""){
    if($time==""){
        $time = time();
    }
    if($type==1){
        return $year = date("y",$time);//返回格式16
    }else{
        return $year = date("Y",$time);//返回格式2016
    }
}
#返回当前时间月份,时间格式为时间戳:2016-9-19
function getMonth($time="",$type=""){
    if($time==""){
        $time = time();
    }
    switch($type){
        case 1:
            $month = date("n",$time);//返回格式9
            break;
        case 2:
            $month = date("m",$time);//返回格式09
            break;
        case 3:
            $month = date("M",$time);//返回格式Sep
            break;
        case 4:
            $month = date("M",$time);//返回格式Septempber
            break;
        default:
            $month = date("n",$time);
    }
    return $month;
}
#返回当前时间天数,时间格式为时间戳:2016-9-19
function getDay($time="",$type=""){
    if($time==""){
        $time = time();
    }
    if($type==1){
        $day = date("d",$time);//返回格式19
    }else{
        $day = date("j",$time);//返回格式19
    }
    return $day;
}
#返回当前时间小时,时间格式为时间戳:2016-9-19 16:57:00 1:20:00
function getHour($time="",$type=""){
    if($time==""){
        $time = time();
    }
    switch($type){
        case 1:
            $hour = date("H",$time);//返回格式16 1
            break;
        case 2:
            $hour = date("h",$time);//返回格式04 01
            break;
        case 3:
            $hour = date("G",$time);//返回格式16 1
            break;
        case 4:
            $hour = date("g",$time);//返回格式4 1
            break;
        default:
            $hour = date("H",$time);
    }
    return $hour;
}
#返回当前时间分钟数,时间格式为时间戳:2016-9-19 16:57:00
function getMinute($time=""){
    if($time==""){
        $time = time();
    }
        $minute = date("i",$time);//返回格式57
    return $minute;
}
#返回当前时间秒数,时间格式为时间戳:2016-9-19 16:57:01
function getSecond($time=""){
    if($time==""){
        $time = time();
    }
    $second = date("s",$time);//返回格式01
    return $second;
}
#比较两个时间的大小,时间格式为时间戳:2016-9-19 16:57:01
function compare($time1,$time2){
    $time1=strtotime($time1);
    $time2=strtotime($time2);
    if($time1>$time2){
        return 1;
    }else{
        return -1;
    }
}
#比较两个时间的差值
function diffdate($time1="",$time2=""){
    if($time1==""){
        $time1 = date("Y-m-d H:i:s",time());
    }
    if($time2==""){
        $time1 = date("Y-m-d H:i:s",time());
    }
    $date1 = strtotime($time1);
    $date2 = strtotime($time2);

    if($date1>=$date2){
        $diffDate = $date1-$date2;
    }else{
        $diffDate = $date2-$date1;
    }
    $day = floor(($diffDate%86400));
    $hour = floor((($diffDate%86400)%3600));
    $minute = floor(($diffDate%3600)%60);
    $second = floor($diffDate%60);

    return "相差".$day."天".$hour."小时".$minute."分".$second."秒";
}
#返回某年某月某日
function buildDate($time="",$type=""){
   if($type==1){
       $longDate = getYear($time)."年".getMonth($time)."月".getDay($time)."日";
   }else{
       $longDate = getYear($time)."年".getMonth($time)."月".getDay($time)."日".getHour()."时".getMinute($time)."分";
   }
    return $longDate;
}
#返回中文大写日期
function changDate($time=""){
    if($time==""){
        $time = date("Ymd",time());
    }else{
        $time = date("Ymd",strtotime($time));
    }
    for($i=0;$i<strlen($time);$i++){
        $timeArr[] = substr($time,$i,1);
    }
    $numArr = array('零','一','贰','叁','肆','伍','陆','柒','捌','玖');
    foreach($timeArr as $key => $value){
        foreach($numArr as $k => $v){
            if($value==$k){
                $comArr[] = $v;
            }
        }
    }
    $comArr = implode("",$comArr);
    $comArr = substr_replace($comArr,"年",12,0);
    $comArr = substr_replace($comArr,"月",21,0);
    $comArr = substr_replace($comArr,"日",30,0);
    return $comArr;
}
#防止sql注入
function injectChk($sql_str) {
	$check = eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);
	if ($check) {
		echo('非法字符串');
		exit();
	} else {
		return $sql_str;
	}
}
#php加密解密
function encryptDecrypt($key, $string, $decrypt){
    if($decrypt){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12");
        return $decrypted;
    }else{
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }
}
#获取当前页面URL
function curPageURL() {
    $pageURL = 'http';
    if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

//使用方法如下：
//echo curPageURL();
//使用方法如下：
//echo curPageURL();
////以下是将字符串“Helloweba欢迎您”分别加密和解密
////加密：
//echo encryptDecrypt('password', 'Helloweba欢迎您',0);
////解密：
//echo encryptDecrypt('password', 'z0JAx4qMwcF+db5TNbp/xwdUM84snRsXvvpXuaCa4Bk=',1);

?>
