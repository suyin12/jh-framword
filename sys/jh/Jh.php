<?php
/**
 *
 * User: suyin
 * Date: 2017/6/30 14:18
 *
 */
namespace jh;

require_once SYS_PATH."common/function.php";

compileConf(require_once CONF_PATH ."config.php");

const URL_MODE = URL_COMMON;

require_once JH_PATH.'BaseJh.php';

class JH extends BaseJh{

}

//引入自动加载类,并注册自动加载函数
require_once JH_PATH.'Loader.php';
spl_autoload_register('jh\Loader::autoLoad');


Router::bootstrap();
