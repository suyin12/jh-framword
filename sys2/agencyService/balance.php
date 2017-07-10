<?php
/*
*      Date: 14-1-23
*   
*    <<<  平账数据的下载  >>>
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


#基本变量
$title = "平账详情";
$feeID = $_GET['feeID'];
$month = $_GET['month'];
$s_status = $_GET['status'] ? $_GET['status'] : 1;
$statusArr = array('1' => "正常数据", '2' => "异常数据");

#查询链接属性
$v_sql[] = "delete from `c_basic_fee_in` where soInsTotal=0 and soInsSecTotal=0 and HFTotal=0 and mCost=0 ";
//$v_sql[] = "update `c_basic_fee_in` x , `c_soIns_fee_out` y set x.status=1 where x.feeID='$feeID' and x.status=0 and x.pID=y.pID ";
//$v_sql[] = "update `c_basic_fee_in` x , `c_HF_fee_out` y set x.status=1 where x.feeID='$feeID' and x.status=0 and x.pID=y.pID ";
$v_sql[] = "update `c_basic_fee_in` x , `c_soIns_fee_out` y set y.feeID=x.feeID where y.feeID like '' and x.pID=y.pID ";
$v_sql[] = "update `c_basic_fee_in` x , `c_HF_fee_out` y set y.feeID=x.feeID where y.feeID like '' and x.pID=y.pID ";
extraTransaction($pdo, $v_sql);
#系统自动平账后数据详情

#第二种方法
//资金往来备忘录数组
$b_sql = "select * from c_basic_fee_in where feeID like '$feeID' ";
$b = SQL($pdo, $b_sql);
$b = keyArray($b, "pID");
//社保及公积金汇总数组
$s_h_sql = "select `a`.`name` AS `name`,upper(`a`.`pID`) AS `pID`,`a`.`total` AS `soInsTotal`,`b`.`total` AS `HFTotal`,(`a`.`mCost` + ifnull(`b`.`mCost`,0)) AS `mCost` from (`c_soins_fee_out` `a` left join `c_hf_fee_out` `b` on((`a`.`pID` = `b`.`pID`))) where a.feeID like '$feeID'
            union all
            select `a`.`name` AS `name`,upper(`b`.`pID`) AS `pID`,`a`.`total` AS `soInsTotal`,`b`.`total` AS `HFTotal`,`b`.`mCost` AS `mCost` from (`c_hf_fee_out` `b` left join `c_soins_fee_out` `a` on((`a`.`pID` = `b`.`pID`))) where isnull(`a`.`pID`) and b.feeID like '$feeID'";
$s_h = SQL($pdo, $s_h_sql);
$s_h = keyArray($s_h, "pID");
//print_r($b);
//正常数据
foreach ($b as $val) {
     $pID= strtoupper($val['pID']);
    $tmp[$pID]['feeID'] = $val['feeID'];
    $tmp[$pID]['unitName'] = $val['unitName'];
    $tmp[$pID]['name'] = $val['name'];
    $tmp[$pID]['pID'] = $pID;
    $tmp[$pID]['iS'] = $val['soInsTotal'];
    $tmp[$pID]['iSS'] = $val['soInsSecTotal'];
    $tmp[$pID]['oS'] = $s_h[$pID]['soInsTotal'];
    $tmp[$pID]['iH'] = $val['HFTotal'];
    $tmp[$pID]['oH'] = $s_h[$pID]['HFTotal'];
    $tmp[$pID]['iM'] = $val['mCost'];
    $tmp[$pID]['oM'] = $s_h[$pID]['mCost'];

}
$arr['1'] = $tmp;
unset($tmp);
//异常数据
$e_sql = "select `a`.`name` AS `name`,upper(`a`.`pID`) AS `pID`,`a`.`total` AS `soInsTotal`,0 AS `HFTotal`,`a`.`mCost`  AS `mCost` from `c_soins_fee_out` `a` where a.feeID like ''
            union all
            select `b`.`name` AS `name`,upper(`b`.`pID`) AS `pID`,0 AS `soInsTotal`,`b`.`total` AS `HFTotal`,`b`.`mCost` AS `mCost` from `c_hf_fee_out` `b`  where  b.feeID like ''";
$arr['2']=SQL($pdo,$e_sql);

#网址字符串
$queryString = "&month=$month&feeID=$feeID";
#下载
if ($_POST ['download']) {
    require_once sysPath . 'class/phpToExcelXML/class-excel-number-xml.inc.php';
    switch ($s_status) {
        case "1":
            $tableName = "正常数据";
            #表头标题
            $fieldName["field"] = array("帐套", '单位', "姓名", "身份证号码", "实收社保", "实收社保补缴", "实缴社保", "实收公积金", "实缴公积金", "实收管理费", "应收管理费");
            break;
        case "2":
            $tableName = "异常数据";
            #表头标题
            $fieldName["field"] = array("姓名", "身份证号码", "实缴社保", "实缴公积金", "应收管理费");
            break;
    }
    if (is_array($arr[$s_status]))
        $newArr = $fieldName + $arr[$s_status];
    else
        $newArr = $fieldName;
    $doc = $newArr;
    $name = $tableName;
    $name = iconv('UTF-8', 'GBK', $name);
    $xls = new Excel_XML ();
    $xls->addArray($doc);
    $xls->generateXML($name);
    exit ();
}

#变量配置
$smarty->assign(array("s_month" => $month, "statusArr" => $statusArr, "s_status" => $s_status, "queryString" => $queryString));
$smarty->assign(array('arr' => $arr));
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("agencyService/balance.tpl");