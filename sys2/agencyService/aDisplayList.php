<?php
/*
*      Date: 14-4-23
*   
*    <<<    >>>
*       created by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/
#验证权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#分页类
require_once '../class/pagenation.class.php';
#通用函数库
require_once '../common.function.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#标题
$title = "社保/公积金";
#初始化变量
$unitID='3000.001';
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
//$smarty->debugging = true;
//获取GET参数,判断是商保或是社保清单
$type = $_GET ['type'];
$sponsorName = $_SESSION ['exp_user'] ['mName'];
$page = $_GET ['page'];
$queryStr = "type=" . $type;
$time = time();
$currentMon = date("Ym", $time);
$currentDay = date('d', $time);
$startMon = $currentMon . "01";
if ($currentDay <=  insuranceInTurn("soIns")) {
    $mon = $currentMon;
    $bT = date("Ym", strtotime("$startMon -1 month")) . ( insuranceInTurn("soIns")+1);
    $eT = $currentMon . $currentDay;
    //	$eT = $currentMon . "19";
} else {
    $mon = date("Ym", strtotime("$startMon +1 month"));
    $bT = $currentMon . ( insuranceInTurn("soIns")+1);
    $eT = $currentMon . $currentDay;
    //	$eT = date ( "Ym", strtotime ( "$startMon +1 month" ) ) . "19";
}

switch ($type) {
    case "soIns" :
        $sql = "select x.batch,x.uID,x.soInsModifyDate,x.sponsorName,x.sponsorTime,x.soInsurance as soInsStatus,y.domicile,y.name,y.pID,y.sID,z.unitName,x.radix, x.pension, x.hospitalization, x.employmentInjury, x.unemployment,  x.PDIns, x.hand,x.remarks from a_soInsList x left join (d_agent_personalInfo y ,a_unitInfo z )on (x.uID=y.id and z.unitID='$unitID') where x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and x.status in( '0','2')  and x.sponsorName like '$sponsorName' order by x.sponsorTime asc ";
        $pageArr = paginationAction($pdo, $sql, $page, $queryStr);
        $ret = reCreateArray($pageArr ['ret'], $wInfoSet);
        $allRet = SQL($pdo, $sql);
        $allRet = reCreateArray($allRet, $wInfoSet);
        $tableHead = array("batch" => "批次号", "unitName" => "单位", "uID" => "员工编号", "name" => "姓名", "pID" => "身份证号码", "sID" => "社保号", 'domicile' => "户籍", 'radix' => "基数", 'pension' => "养老", 'hospitalization' => "医疗", 'employmentInjury' => "工伤", 'unemployment' => "失业", 'PDIns' => "残障金", 'hand' => "利手", "soInsStatus" => "社保状态", "soInsModifyDate" => "社保更改日期", "remarks"=>"备注","sponsorTime" => "报表生成时间");
        $excelTitle = $mon . $currentDay . "社保清单";
        break;
    case "HF" :
        if ($currentDay <= insuranceInTurn("HF")) {
            $mon = $currentMon;
            $bT = date("Ym", strtotime("$startMon -1 month")) . insuranceInTurn("HF");
            $eT = $currentMon . $currentDay;
        } else {
            $mon = date("Ym", strtotime("$startMon +1 month"));
            $bT = $currentMon . insuranceInTurn("HF");
            $eT = $currentMon . $currentDay;
        }

        $wSet->type = 'hosuingFund';

        $sql = "select x.batch,x.uID,x.IDType,x.HFModifyDate,x.sponsorName,x.sponsorTime,x.housingFund as housingFundStatus,y.domicile,y.name,y.pID,y.proTitle,y.proLevel,y.marriage,y.spousePID,y.spouseName,y.education,y.sID,y.mobilePhone,z.unitName,x.HFRadix, x.pHFPer, x.uHFPer,x.remarks from a_HFList x left join (d_agent_personalInfo y ,a_unitInfo z )on (x.uID=y.id and z.unitID= '$unitID') where x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and x.status in( '0','2')  and x.sponsorName like '$sponsorName' order by x.sponsorTime asc ";
        $pageArr = paginationAction($pdo, $sql, $page, $queryStr);
        $ret = reCreateArray($pageArr ['ret'], $wInfoSet);
        $allRet = SQL($pdo, $sql);
        $allRet = reCreateArray($allRet, $wInfoSet);
        $tableHead = array("batch" => "批次号", "unitName" => "单位", "uID" => "员工编号", "housingFundStatus" => "状态", "name" => "姓名", "IDType" => "证件类型", "pID" => "身份证号码", "sID" => "社保号", "education" => "最高学位", "proTitle" => "职称", "HFModifyDate" => "启用年月", 'HFRadix' => "缴存基数", "uHFPer" => "单位比例", "pHFPer" => "个人比例", 'domicile' => "户籍", "mobilePhone" => "移动电话", "marriage" => "婚否", "spouseName" => "配偶姓名", "spousePID" => "配偶身份证", "HFModifyDate" => "公积金更改日期", "remarks"=>"备注","sponsorTime" => "报表生成时间");
        $excelTitle = $mon . $currentDay . "公积金清单";
        break;
   }
//处理分页类
$pageList = $pageArr ['pageList'];
#保存为EXCEL
$thArr [] = $tableHead;
if ($allRet)
    $excelRet = array_merge($thArr, $allRet);
if (isset($_POST ['intoExcel'])) {
    if (!$excelRet)
        exit("<script> alert('无数据导出') </script>");
    #链接PHPEXCEL CLASS
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once '../class/excel.class.php';
    $oExcel = new PHPExcel ( );
    #设置文档基本属性
    $oPro = $oExcel->getProperties();
    $oPro->setCreator($serverCompany); //公司名
    #构造输出函数
    $op = new excelOutput ( );
    $op->oExcel = $oExcel;
    $op->eRes = $excelRet;
    $op->selFieldArray = $tableHead;
    $op->title = $excelTitle;
    $op->fillData();
    $op->eFileName = $excelTitle . ".xls";
    $op->output();
}

#显示查询结果
$smarty->assign("pageList", $pageList);
$smarty->assign("tableHead", $tableHead);
$smarty->assign("tableCell", $ret);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("workerInfo/wDisplayList.tpl");