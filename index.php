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
//定义基本路径
$base_path = rtrim(str_replace("\\","/",__DIR__),"/")."/";
//定义系统核心路径
define("SYS_PATH",$base_path."sys/");
//定义应用路径
define("APP_PATH",$base_path."app/");
//定义系统配置文件路径
define("CONF_PATH", SYS_PATH . "conf/");
//定义基础类文件路径
define("JH_PATH", SYS_PATH . "jh/");
var_dump($base_path);exit;
require JH_PATH  ."Jh.php";


