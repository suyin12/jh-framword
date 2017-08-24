<?php
/**
 *
 * User: suyin
 * Date: 2017/8/11 13:43
 *
 */
require '../../setting.php';
require '../../lib/Tpl.class.php';

session_start();
$username =  $_POST['username'];
$pwd = md5($_POST['pwd'].$username);

$sql = "select A_ID,A_UserName from admin_info where `A_UserName`=  '".$username."' and `A_Password`= '".$pwd."'";

$ret = $Conn::$pdo->query($sql);
$res = $ret->fetchAll(PDO::FETCH_ASSOC);

if($res[0]){
    $_SESSION['user'] = $username;
    @$_SESSION['expire'] = time() + 60*60;
}
header('Location:'.HTTP_PATH.'jh-framwork/birthday/index.php');


