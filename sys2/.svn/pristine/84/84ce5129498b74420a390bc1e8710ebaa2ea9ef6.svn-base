<?php

/*
 *       2013-9-23
 *       <<<   
 *                劳动事务代理平账模块;
 *               特别注意: 虽说现在有时间的属性,但是具体的平账过程,并问考虑月份因素,即所有数据不做保留,每月定时清除;
 *                时间属性暂时保留,预留后期功能的开发
 *        >>>
 *       create by Great sToNe
 *       have fun,.....
 */

# 页面访问权限
require_once '../auth.php';
# 连接模板文件
require_once sysPath . 'templateConfig.php';
# 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'common.function.php';

#标题
$title = "代理平账";
#初始化平账月份
if ($_GET ['month']) {
    $month = $_GET ['month'];
    $lastMonth = date("Ym", strtotime("-1 month", time()));
} else {
    header("location:" . httpPath . "agencyService/balanceMain.php?month=" . timeStyle("Ym", ""));
}
#月份数组
$monthArr [timeStyle("Ym", "")] = date("Y年m月", time());
$monthArr [$month] = substr($month, 0, 4) . "年" . substr($month, 4, 2) . "月";
$monthArr [$lastMonth] = date("Y年m月", strtotime("-1 month", time()));
#统计各项费用合计数
//社保实缴合计
$s_sql = "select sum(total) as total,sum(mCost) as mCost,soInsID from `c_soIns_fee_out` where soInsDate like '$month' group by soInsID";
$s_r = SQL($pdo, $s_sql);
//公积金实缴合计
$h_sql = "select sum(total) as total,sum(mCost) as mCost,housingFundID from `c_hf_fee_out` where HFDate like '$month' group by housingFundID";
$h_r = SQL($pdo, $h_sql);
//费用实收合计
$b_sql = "select sum(soInsTotal) as soInsTotal,sum(soInsSecTotal) as soInsSecTotal,sum(HFTotal) as HFTotal,sum(mCost) as mCost,feeID from `c_basic_fee_in` where month like '$month' group by feeID";
$b_r = SQL($pdo, $b_sql);

foreach ($s_r as $v) {
    $soInsTotalArr ['soIns'] += $v['total'];
    $soInsTotalArr['mCost'] += $v['mCost'];
}
foreach ($h_r as $v) {
    $HFTotalArr ['HF'] += $v['total'];
    $HFTotalArr['mCost'] += $v['mCost'];
}

#验证结果
$s_sql_v = "select 1 from c_soIns_fee_out where feeID like '' limit 1";
$s_v = SQL($pdo, $s_sql_v, null, "one");
$h_sql_v = "select 1 from c_HF_fee_out where feeID like '' limit 1 ";
$h_v = SQL($pdo, $h_sql_v, null, "one");
$b_sql_v = "select feeID,status from c_basic_fee_in where status=0 group by feeID";
$b_v = SQL($pdo, $b_sql_v, null);
$b_v = keyArray($b_v, 'feeID');
$validUrl = httpPath . "agencyService/balance_valid.php";


#变量配置
$smarty->assign(array("monthArr" => $monthArr, "s_month" => $month, "validUrl" => $validUrl));
$smarty->assign(array("s_r" => $s_r, "h_r" => $h_r, "b_r" => $b_r, "soInsTotalArr" => $soInsTotalArr, "HFTotalArr" => $HFTotalArr));
$smarty->assign(array("s_v" => $s_v, "h_v" => $h_v, "b_v" => $b_v));
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("agencyService/balanceMain.tpl");

?>
