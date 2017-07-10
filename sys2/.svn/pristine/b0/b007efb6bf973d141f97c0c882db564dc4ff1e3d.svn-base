<?php
/*
如此有成就感的代码...哇哈哈..
每次的get参数都能完整把握其相应的数组..而且可扩展性还不错..
要是在对  unitManager数组处理得好些,,就完全不用考虑该数组是否会增加列的因素了....
总之,还是可以的..^_^
* */
#验证权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#分页类
require_once '../class/pagenation.class.php';
#单位,客户经理联动菜单
require_once '../dataFunction/unit.data.php';

$title="员工批量入职";
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "workerInfo/BatchEntry.tpl" );
?>