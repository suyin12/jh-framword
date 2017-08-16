<?php
/**
 *
 * User: suyin
 * Date: 2017/8/11 10:01
 *
 */
session_start();
include 'setting.php';
require 'lib/Tpl.class.php';
require 'auth.php';

$tpl = new Tpl();
$tpl->display('index.html');