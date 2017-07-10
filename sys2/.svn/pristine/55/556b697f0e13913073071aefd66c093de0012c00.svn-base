<?php
/*
*       2013-2-21
*       <<<  搜索,验证是否存在该员工的信息  >>>
*       create by Great sToNe
*       have fun,.....
*       
*       EMAIL:  shi35dong@gmail.com
*/


#连接验证头文件
require_once '../setting.php';
#连接公用函数库
require_once sysPath . 'common.function.php';
#连接模板文件
require_once webSysPath . 'templateConfig.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';


#页面标题
$title = "名单匹配";

#人才库信息类
$t = new talent();
$t->pdo = $pdo;
$c = $_GET['content'];
if($c){
    $t->talentBasic(" talentID,name,idCard as pID,positionID,telephone,status "," (name like '%$c%' or telephone like '$c')");
}else{
    $t->talentBasic(" talentID,name,idCard as pID,positionID,telephone,status "," `status`>'2' order by talentID desc limit 50");
}
$t->classLinkClass();
$t->talentInfoArr();
$talentArr=$t->ret;
#变量配置
$smarty->assign("talentArr",$talentArr);
#环境变量配置
$smarty->assign(array("title" => $title, "httpPath" => httpPath));
$smarty->display("w/match.tpl");
?>