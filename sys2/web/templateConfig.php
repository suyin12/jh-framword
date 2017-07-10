<?php
if (realpath ( __FILE__ ) == realpath ( $_SERVER ['SCRIPT_FILENAME'] )) {
	exit ( '禁止访问' );
}
header ( "Content-type: text/html; charset=utf-8" );
//验证完权限后更改模板地址及创建类
require_once smartyLibPath . 'Smarty.class.php';
$smarty = new Smarty ();
$smarty->template_dir = webSysPath . "templates";
$smarty->compile_dir = webSysPath . "templates_r";
$smarty->config_dir = webSysPath . "configs";
$smarty->allow_php_tag = true;
#配置自定义插件
$smarty->autoload_filters ['pre'] [] = 'switch';

?>