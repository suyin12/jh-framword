<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('禁止访问');
}
header("Content-type: text/html; charset=utf-8");
//验证完权限后更改模板地址及创建类
require_once smartyLibPath . 'Smarty.class.php';
$smarty = new Smarty ();
$smarty->template_dir = sysPath . "templates";
$smarty->compile_dir = sysPath . "templates_r";
$smarty->config_dir = sysPath . "configs";
$smarty->allow_php_tag = true;
#配置自定义插件
$smarty->autoload_filters['pre'][] = 'switch';
#下面这个可能某些时候搞错了,,暂时不鸟先
$current_userName = $_SESSION['exp_user']['mName'];
$smarty->assign("current_userName", $current_userName);
#配置标题栏
$smarty->assign("headerConfig", headerConfig($pdo));
#配置底栏版权信息
$smarty->assign(array("authorCompany"=>$authorCompany,"authorUrl"=>$authorUrl));
?>
