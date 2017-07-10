<?php
/*
*      Date: 2014-4-23
*   
*    <<<  生成社保及公积金申报表  >>>
*       created by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/

require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';

$title = "生成申报表";


#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "agencyService/aCreateList.tpl" );
?>
