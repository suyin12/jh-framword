<?php
/**
 *
 * User: suyin
 * Date: 2017/6/30 13:52
 *
 */
//检测php当前版本是否为5.4以上
if(version_compare(PHP_VERSION,"5.4.0","<"))  die("快来试试PHP5.4以上版本的新特性吧~");
//定义开发环境
const JH = true;
if(JH){
    ini_set("display_errors", "On");
    error_reporting(E_ALL | E_STRICT);
}else{
    ini_set("display_errors", "Off");
}

$base_path = rtrim(str_replace("\\","/",__DIR__),"/")."/";

define("SYS_PATH",$base_path."sys/");
define("APP_PATH",$base_path."app/");
define("CONF_PATH", SYS_PATH . "conf/");
define("JH_PATH", SYS_PATH . "jh/");

require JH_PATH  ."jh.php";

$a = "create a new branch is quick and simple";

