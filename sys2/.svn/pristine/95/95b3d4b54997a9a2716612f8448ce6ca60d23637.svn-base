<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 13-4-16
 * Time: 上午9:12
 * To change this template use File | Settings | File Templates.
 */

require_once '../setting.php';
//页面访问权限
require_once 'auth.php';
require_once sysPath . 'common.function.php';
#连接模板文件
require_once webSysPath . 'templateConfig.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';
#员工部分配置类
require_once webSysPath . "w/wConfig.php";
#获取数据
$talentID = $_SESSION["web_worker"]["talentID"];
$wID = $_SESSION["web_worker"]["wID"];
$time = time();
$today = timeStyle("date", "-");

#调用员工信息设置类
$wSet = new wInfoSet ();
$wSet->p = $pdo;
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
#人才库信息类
$t = new talent();
$t->pdo = $pdo;
$t->classLinkClass();
$t->talentBasic("talentID,name,idCard as pID,sex,major,telephone,unitID,positionID", "talentID=" . $talentID);
$talentArr = $t->talentInfoArr();
$talent = $talentArr[$talentID];
$unitIDArr[$talent["unitID"]]=$talent["unitID"];
#判断打印模板
$p=new wConfig();
$p->printStyleSet($unitIDArr);
$style=$p->s;

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
$wInfo['relative'] = array_values($wInfo['relative']);
$wInfo['workInfo'] = array_values($wInfo['workInfo']);
$wInfo['studyInfo'] = array_values($wInfo['studyInfo']);
$wInfo['language'] = array_values($wInfo['language']);
$wInfo['trainInfo'] = array_values($wInfo['trainInfo']);
$wInfo['diploma'] = array_values($wInfo['diploma']);

#计算年纪
function countAge($year, &$smarty)
{
    extract($year);
    $toYear = date("Y");
    $age = $toYear - $year;
    if ($age == $toYear || $age <= 0)
        return null;
    else
        return $age;
}

#配置

$smarty->assign("wInfoSet", $wInfoSet);
$smarty->assign("wInfo", $wInfo);
$smarty->assign("talent", $talent);
$smarty->registerPlugin('function', 'countAge', countAge);
$smarty->assign(array("title" => $title, "httpPath" => httpPath));
$smarty->display("w/".$style);
?>