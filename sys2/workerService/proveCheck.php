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

$uID = $_GET['uID'];
$expressID = $_GET['ID'];
$ID = $_GET['ID'];//证明ID
$status = $_GET['status'];
$name = $_GET['name'];
$pID = $_GET['pID'];
$expressNumber = $_GET['expressNumber'];
$mobilePhone = $_GET['mobilePhone'];
$c = $_GET['c'];
$title = "证明审核";
$modelArr = array("name" => "姓名","pID" => "身份证","mobilePhone" => "手机号码");
$wU = new workerAction();
//审核结果,0不通过,1通过,2已邮寄,99回退
if(!empty($status)&&!empty($ID)){
    $wU->modifyStatus("status='".$status."'","ID = '".$ID."'");
    $wU->sendProveMsg($status,$ID);//推送一条消息给用户
}
$conStr = "`" . $_GET['m'] . "` like '%" . $c . "%'";
if($status==1&&$expressNumber!=''&&$_GET['ID']!=''){
    $wU->expressNumber("expressNumber='".$expressNumber."'","proveID='".$_GET['ID']."'");//快递单号写进数据表
    $wU->modifyStatus("status=2","ID = '".$expressID."'");
}
$myPage = new Pagination (); //使用分页类
$myPage->page = filterParam('page', 0); //设置当前页
$myPage->form_mothod = "get";
$myPage->count = $pdo->query("select * from  a_prove where  status = '".$status."'" )->rowCount();//获取并设置数据库总记录数
$myPage->pagesize = "20";//每页多少条记录
$pagesizeLimit = $myPage->get_limit();//分页条件查询
$statusArr = $wU->statusArr();
if($uID==''&&$ID==''&&$status==''&&$name==''&&$pID==''&&$mobilePhone==''){
    $ret = $wU->proveID();//首先删除无效的证明
    $wUserArr = $wU->proveInfo("*","`status`= 0 order by createtime desc"."$pagesizeLimit");//未审核证明的员工信息
}elseif(!empty($status)&&$_GET['m']!=''&&$_GET['c']!=''){
    $wUserArr = $wU->proveInfo("*", "`status`='".$status."'and".$conStr."order by createtime desc $pagesizeLimit");
}elseif((!empty($expressNumber))||!empty($status)||$status==0){
    if(!empty($expressNumber))
        $status=2;
    $wUserArr = $wU->proveInfo("*", "`status`='".$status."'order by createtime desc"."$pagesizeLimit");
}
if(!empty($uID)&&!empty($ID)){
    $wUserArr2 = $wU->proveInfo("*", "`status`='".$status."'and ID='".$ID."'order by createtime desc"."$pagesizeLimit");
}
$contactArr = $wU->proveContactInfo("contactname,express,address,phone","uID='".$uID."'and proveID='".$ID."'");

foreach ($_GET as $key => $val) {
    if ($key != "page" and $key != "intoExcel") {
        $queryStr .= $key . "=" . $val . "&";
    }
}
$queryStr = substr($queryStr, 0, -1);
$pageList = $myPage->page_list($_SERVER['PHP_SELF'] . "?" . $queryStr);
#模板配置信息
$smarty->assign(array("statusArr" => $statusArr, "modelArr" => $modelArr));
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath,"a"=>5));
if($uID==''||$ID==''){
    $smarty->assign(array("wUserArr"=>$wUserArr,"pageList"=>$pageList));
    $smarty->display("workerService/proveCheck.tpl");
//    echo "<pre>";
//    print_r($ret);
}else{
    $smarty->assign(array("wUserArr"=>$wUserArr2,"contactArr"=>$contactArr));
    $smarty->display("workerService/personalProve.tpl");
}