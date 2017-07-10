<?php
/**
 * Description of ledger
 * 罗列出所有单位台账信息
 * @author loskin 
 * update time 2014-08-15
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';

#标题
$title = "所有单位年月台账";
$month = $_GET ['month'];
#可选择的月份
$Sql_month = "select distinct `month` from a_ledger order by month desc";
$Ret_month = SQL($pdo, $Sql_month, null);
if(!$month)
    header("location:" . httpPath . "leader/ledgerList.php?month=".date("Ym"));
$Ret_month_arr = array(
    date("Ym")=>date("Y年m月"),
);
//查询近一年,起始年月
$begin_month = date("Ym",strtotime("-12 months",strtotime(date("Ym"))));
foreach($Ret_month as $k=>$v){
    if($v['month']>$begin_month){
        $vv = strtotime($v[month].'01');
        $Ret_month_arr[$v['month']] = date("Y年m月",$vv);
    }
}
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1");
#查询当月的所有台账
$colnums = "`unitID`,`num`,`totalFeeR`,`WDMoney`,`salaryS`,`mCostNum`,`managementCost`,`uPDInsS`,`uAccountSp`,
`totalFeeR` as totalFeeS,`salaryR`,`pTax`,`soInsMoneySum`,`HFMoneySum`,`comInsMoneySum`,`mCostMoneySum`,
`salaryMoneySum`,`remarks`";
$Sql = "select {$colnums} from a_ledger where month='{$month}'";
$fVal = SQL($pdo, $Sql, null);
$fRet = keyArray($fVal,"unitID");
#查询所有分管的单位的编号\名字(与未完成台账的分开)
$u_where_a = "where unitID!='' and type='1' and status='1'";
$Sql_a = "select `unitID`,`unitName` from a_unitinfo ".$u_where_a;
$u_info = SQL($pdo, $Sql_a, null);
for($i=0;$i<count($u_info);$i++){
	$unit_ID = $u_info[$i]['unitID'];
    $unit_Name = $u_info[$i]['unitName'];
	if(empty($fRet[$unit_ID]['unitID'])){
		#未完成台账的取出unitName,组合成数组
		$u_info_arr[] = $u_info[$i];
	}
}
$u_where_b = "where unitID!='' and type='1' and status='1'";
$Sql_b= "select `unitID`,`unitName` from a_unitinfo ".$u_where_b;
$u_info_b = SQL($pdo, $Sql_b, null);
for($i=0;$i<count($u_info_b);$i++){
    $unit_ID = $u_info_b[$i]['unitID'];
    $unit_Name = $u_info_b[$i]['unitName'];
    $u_info_brr[$unit_ID] = $unit_Name;
}
#台账清单数组的处理
foreach ($fVal as $key => $val) {
    foreach($val as $k => $v){
        switch($k){
            case "mCostNum":
                $fVal[$key][$k]  = round($v);
                break;
            case "unitID":
                $fVal[$key][$k] = $u_info_brr[$v];
                break;
            case "soInsMoneySum":
            case "HFMoneySum":
            case "comInsMoneySum":
            case "mCostMoneySum":
            case "salaryMoneySum":
                $fVal[$key]["sumMoney"] += $v;
                $sumMoney +=$v;
                break;
            default:
                break;
        }
        if (is_numeric($v)) {
            $total[$k]+=round((double) $v, 2);
        }
        if(!$v || $v=='0'){
            $fVal[$key][$k] = "";
        }
    }
}
$total["unitID"] = "合计";
$total["sumMoney"] = $sumMoney;
#下载成表格
if ($_POST ['intoExcel']) {
    #表头
    $tableTT = array(
        "A1:S1" => $serverCompany,
        "A2:A4" => "单位",
        "B2:B4" => "费用表人数",
        "C2:D2" => "应到金额",
        "C3" => "实际到账",
        "C4" => "金额",
        "D3:D4" => "冲减挂账",
        "E3:E4" => "应发工资",
        "F3:H3" => "管理费",
        "F4" => "人数",
        "G4" => "金额",
        "H3" => "保险",
        "H4" => "残障金",
        "I3:I4" => "挂账",
        "J3:J4" => "收入合计",
        "K2:L2" => "支出",
        "K3:K4" => "实发工资",
        "L3:L4" => "个税",
        "N2:R2" => "欠款",
        "N3:Q3" => "本月欠款",
        "N4" => "累计社保欠款",
        "M4" => "累计公积金欠款",
        "O4" => "累计商保欠款",
        "P4" => "管理费累计欠款",
        "Q4" => "累计工资欠款",
        "R3:R4" => "累计欠款合计",
        "S2:S4" => "备注"
    );
    #保存为EXCEL
    $tableHead = array(
        "unitID" => "单位",
        "num" => "在职人数",
        "totalFeeS" => "金额",
        "WDMoney" => "冲减挂账",
        "salaryS" => "应发工资",
        "mCostNum" => "人数",
        "managementCost" => "金额",
        "uPDInsS" => "残障金",
        "uAccountSp" => "挂账",
        "totalFeeR" => "收入合计",
        "salaryR" => "实发工资",
        "pTax" => "个税",
        "soInsMoneySum" => "累计社保欠款",
        "HFMoneySum" => "累计公积金欠款",
        "comInsMoneySum" => "累计商保欠款",
        "mCostMoneySum" => "管理费累计欠款",
        "salaryMoneySum" => "累计工资欠款",
        "sumMoney" => "累计欠款合计",
        "remarks" => "备 注"
    );
    $excelTitle = $month . "台账明细表";
    $thArr [] = $tableHead;
    $footArr [] = $total;
    $excelRet = array_merge($thArr, $fVal);
    $excelRet = array_merge($excelRet, $footArr);
    //echo "<pre>";var_dump($excelRet);
    if (!$excelRet)
        exit ("<script> alert('无数据导出') </script>");
    #链接PHPEXCEL CLASS
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once 'tbexcel.class.php';
    $oExcel = new PHPExcel ();
    #设置文档基本属性
    $oPro = $oExcel->getProperties();
    $oPro->setCreator($serverCompany); //公司名
    #构造输出函数
    $op = new tbexcelOutput ();
    $op->oExcel = $oExcel;
    $op->eRes = $excelRet;
    $op->selFieldArray = $tableHead;
    $op->title = $excelTitle;
    $op->headRow = 4;
    $op->fillData($tableTT);
    $op->eFileName = $excelTitle . ".xls";
    $op->output();
    unset($op);
    exit();
}

#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->assign("unitManager", $unitManager);
$smarty->assign(array("fVal" => $fVal,"u_info"=>$u_info,"u_info_arr"=>$u_info_arr,"u_info_brr"=>$u_info_brr,"Ret_month_arr"=>$Ret_month_arr,"total"=>$total));
$smarty->display("leader/ledgerList.tpl");