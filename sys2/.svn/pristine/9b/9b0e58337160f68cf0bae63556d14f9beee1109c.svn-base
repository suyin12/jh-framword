<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/14
 * Time: 14:26
 */
#链接代理通用类
require_once "workerClassLink.class.php";
#验证类
require_once sysPath . "auth.php";
require_once  "workerAction.sql.php";

$name = $_GET['name'];
$pID = $_GET['pID'];
$mobilePhone = $_GET['mobilePhone'];
$ID = $_GET['ID'];
$c = $_GET['c'];
$title = "微信解绑";
$modelArr = array("name" => "姓名","pID" => "身份证","mobilePhone" => "手机号码");
$wU = new workerAction();
$conStr = "`" . $_GET['m'] . "` like '%" . $c . "%'";
$myPage = new Pagination (); //使用分页类
$myPage->page = filterParam('page',0); //设置当前页
$myPage->form_mothod = "get";
$myPage->count = $pdo->query("select 1 from  a_workerinfo ")->rowCount();
$myPage->pagesize = "10";
$pagesizeLimit = $myPage->get_limit();
$a = $wU->resetWeChat("mobilePhone ='".$c."'");
$wUserArr = $wU->workerInfo("*",$conStr.$pagesizeLimit);
foreach ($_GET as $key => $val) {
    if ($key != "page" and $key != "intoExcel") {
        $queryStr .= $key . "=" . $val . "&";
    }
}
$queryStr = substr($queryStr, 0, -1);
$pageList = $myPage->page_list($_SERVER ['PHP_SELF'] . "?" . $queryStr);


#配置变量
$smarty->assign(array("statusArr" => $statusArr, "modelArr" => $modelArr));
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath,"a"=>5));
#模板配置信息
if($c!=''){
    $smarty->assign(array("wUserArr"=>$wUserArr,"contactArr"=>$contactArr));
    $smarty->display("workerService/resetWeChat.tpl");
}else{
    $smarty->assign(array("wUserArr"=>$wUserArr,"contactArr"=>$contactArr,"pageList"=>$pageList));
    $smarty->display("workerService/resetWeChat.tpl");
}


