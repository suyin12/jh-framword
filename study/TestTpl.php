<?php
/**
 *
 * User: suyin
 * Date: 2017/7/17 9:00
 *
 */
require "Tpl.class.php";

$tpl = new Tpl();
$tplarr = array(
    'name'=>'waited',
    'age'=>'100'
);
$tpl->assign($tplarr);
$tpl->assign('message','this is a demo');
$tpl->display('TestTpl.html');