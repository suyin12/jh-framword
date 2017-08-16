<?php
/**
 *
 * User: suyin
 * Date: 2017/8/14 9:39
 *
 */
session_start();
var_dump($_POST);
$_SESSION['getTime'] = $_POST['time'];

var_dump($_SESSION);
