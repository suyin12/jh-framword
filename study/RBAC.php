<?php
/**
 *
 * User: suyin
 * Date: 2017/7/4 11:21
 *
 */
header("Content-type:text/html;charset=utf-8");
require_once "./setting.php";
$sql = "select id,name from rules where 1=1";
$pdo = $pdo->connet();
$pdo->query("set names utf8");
$rulesArr =  $pdo->query($sql);
$ret = $rulesArr->fetchAll(PDO::FETCH_ASSOC);

$rulesId = array_keys($ret);
//echo "<pre>";
//var_dump($rulesId);
$sql = "select rules_id,id,roles_id from roles_in_rules where roles_id = 1";
$rules =  $pdo->query($sql);
$res = $rules->fetchAll(PDO::FETCH_ASSOC);

$res = array_values($res);
echo "<pre>";
var_dump($res);