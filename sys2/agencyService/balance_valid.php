<?php
/*
*      Date: 14-1-15
*   
*    <<< 代理平账中, 数据验证 ;
 *      特别注意: 虽说现在有时间的属性,但是具体的平账过程,并问考虑月份因素,即所有数据不做保留,每月定时清除;
 *                时间属性暂时保留,预留后期功能的开发
 *   >>>
*       created by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/


# 页面访问权限
require_once '../auth.php';
# 连接模板文件
require_once sysPath . 'templateConfig.php';
# 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'common.function.php';

#基础变量设置
$title = "资金往来备忘录验证";
$feeID = $_GET['feeID'];
$month = $_GET['month'];
#查询链接属性
$v_sql[] = "delete from `c_basic_fee_in` where soInsTotal=0 and soInsSecTotal=0 and HFTotal=0 and mCost=0 ";
$v_sql[] = "update `c_basic_fee_in` x , `c_soIns_fee_out` y set x.status=1 where x.feeID='$feeID' and x.status=0 and x.pID=y.pID ";
$v_sql[] = "update `c_basic_fee_in` x , `c_HF_fee_out` y set x.status=1 where x.feeID='$feeID' and x.status=0 and x.pID=y.pID ";
$v_sql[] = "update `c_basic_fee_in` x , `c_soIns_fee_out` y set y.feeID=x.feeID where y.feeID like '' and x.pID=y.pID ";
$v_sql[] = "update `c_basic_fee_in` x , `c_HF_fee_out` y set y.feeID=x.feeID where y.feeID like '' and x.pID=y.pID ";
extraTransaction($pdo, $v_sql);
#查询验证失败数据
$sql = "select name,pID from `c_basic_fee_in` where status=0 and feeID='$feeID' ";
$ret = SQL($pdo, $sql);
$detailUrl = httpPath . "agencyService/balance_detail.php?m=soIns&soInsDate=$month&name=";
foreach ($ret as $val) {
    $errMsg[] = "人员信息有误{ <a href='" . $detailUrl . $val['name'] . "' target='_blank'>" . $val['name'] . "</a>  }(   " . $val['pID'] . "   )";
}

#变量配置
$smarty->assign(array("errMsg" => $errMsg));
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("agencyService/balance_valid.tpl");
