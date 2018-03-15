<?php
/**
 * Auth: sjh
 * Date: 2018/3/13 13:44
 */

session_start();
$maxLifeTime = ini_get('session.gc_maxlifetime');


$sessionProbability = ini_get('session.gc_probability');
$sessiondivisor = ini_get('session.gc_divisor');
echo $maxLifeTime.'---'.$sessionProbability.'---'.$sessiondivisor;


$_SESSION['name'] = '粟建晖';
//setcookie(session_name(),session_id(),time()+3600);
//header('Location:http://localhost/jh-framwork/php/session%E7%94%9F%E5%AD%98%E6%97%B6%E9%97%B4%E7%9A%84%E4%BF%AE%E6%94%B9/%E8%8E%B7%E5%8F%96session.php');