<?php
require_once '../setting.php';
//页面访问权限
require_once webSysPath . 'w/auth.php';
#连接公用函数库
require_once sysPath . 'common.function.php';
#连接模板文件
require_once webSysPath . 'templateConfig.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';
#获取数据
$talentID = $_SESSION["web_worker"]["talentID"];
$wID = $_SESSION["web_worker"]["wID"];

#调用员工信息设置类
$wSet = new wInfoSet ();
$wSet->p = $pdo;
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;

#人才库信息类
$t = new talent();
$t->pdo = $pdo;
$t->talentBasic("talentID,name,idCard as pID,sex,major,telephone", "talentID=" . $talentID);
$talentArr = $t->ret;
$talent = $talentArr[$talentID];

#显示信息
$w = new  web_worker();
$w->pdo = $pdo;
$w->classLinkClass();
$w->web_workerBasic("`wID`,`status`", "`wID`=$wID");
$w->web_wInfo_extraArr();
$w->web_wInfo_relativeArr();
$w->web_wInfo_workInfoArr();
$w->web_wInfo_studyInfoArr();
$w->web_wInfo_interiorInfoArr();
$w->web_wInfo_trainInfoArr();
$w->web_wInfo_diplomaInfoArr();
$w->web_wInfo_languageInfoArr();
$wInfo_extraInfoArr = $w->web_wInfo_extraInfoArr();
$wInfo = $wInfo_extraInfoArr[$wID];


#配置变量
$smarty->assign("wInfoSet", $wInfoSet);
$smarty->assign("wInfo_extraInfoArr", $wInfo_extraInfoArr);
//显示员工现有的数据
$smarty->assign("wInfo", $wInfo);
$smarty->assign("wID", $wID);
$smarty->assign("talent", $talent);
$smarty->assign(array("title" => $title, "httpPath" => httpPath));
$smarty->display("w/wInput.tpl");
?>