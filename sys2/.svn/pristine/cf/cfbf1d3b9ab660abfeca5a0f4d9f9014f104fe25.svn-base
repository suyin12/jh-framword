<?php
/*
*       2013-2-21
*       <<< 网上办公,员工服务首页   >>>
*       create by Great sToNe
*       have fun,.....
*       
*       email:  shi35dong@gmail.com
*/

#目前先暂时直接跳转到信息登记页
require_once '../../setting.php';
//页面访问权限
require_once webSysPath . 'w/auth.php';
#连接公用函数库
require_once sysPath . 'common.function.php';
#连接模板文件
require_once webSysPath . 'templateConfig.php';
require_once sysPath."dataFunction/talent.data.php";
require_once sysPath."dataFunction/pre_batch.data.php";
require_once sysPath . 'recruitManage/requireClassFile.php';

$talentID = $_SESSION["web_worker"]["talentID"];
$p=new batch();
$p->pdo=$pdo;
$p->classLinkClass();
$p->batchBasic('tID,batchID','tID='.$talentID);
$p->web_batch_define();
$p->web_a_unitInfo_extra();
$statuInfo=$p->web_batchInfoArr();
$statuInfo=$statuInfo[0];
$smarty->assign("statuInfo", $statuInfo);
$smarty->assign(array("title" => $title, "httpPath" => httpPath));
$smarty->display("w/wIndex.tpl");
?>