<?php

/**
 * 2010-4-21              
 * <<<管理现有的帐套,删除,修改及更新,,,客户经理离职工作移交部分,>>>
 * 
 * @author  yours  sToNe
 * @version 
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
#页面标题
$title = "管理工资帐套";
#配置所有用户
$userSql = "select mID,mName from s_user";
$userRet = SQL($pdo, $userSql);
$unitManager = keyArray($userRet, "mID");
#查询目前所有的帐套信息
$sql = "select * from a_zformatinfo";
if ($_GET['displayAll'] != "true")
    $sql .=" where status='1' ";
$sql .=" order by mID";
$res = $pdo->query($sql);
$ret = $res->fetchAll(PDO::FETCH_ASSOC);

//$sql="select * from a_zformatinfo where zID like '$zID'";
#变量配置
$smarty->assign("unitManager", $unitManager);
$smarty->assign("ret", $ret);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("salaryManage/manageZF.tpl");
?>