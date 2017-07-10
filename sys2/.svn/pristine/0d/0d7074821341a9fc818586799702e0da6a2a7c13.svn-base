<?php

/**
 * 2010-4-29
 * <<<该页面主要的功能是对社保分批次清单签收数据的显示和下载>>>
 *
 * @author  yours  sToNe
 * @version
 */
#验证权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接公用函数
require_once '../common.function.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
$wSet = new wInfoSet ();
$wSet->p = $pdo;
$wSet->type = "housingFund";
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
$wInfoSetExtra = $wSet->wInfoSetExtra;

#标题
$title = "公积金清单批次明细";
$sponsorName = urldecode($_GET ['n']);
$HFModifyDate = $_GET ['d'];
$extraBatch = $_GET ['e'];
$type = $_GET ['type'];
//
//if($units_str){
//$sql = "select a.batch,a.extraBatch,a.uID,a.IDType,(ROUND(a.HFRadix,'0')) as HFRadix,a.pHFPer,a.uHFPer,a.housingFund as housingFundStatus,right(a.batch,6) as HFModifyDate,a.status,a.sponsorName, a.sponsorTime,
//		a.leaderName,a.receiverName,a.receiveTime,a.ID,b.HFID,b.proTitle,b.proLevel,b.marriage,b.spousePID,b.spouseName,b.education,b.sID,b.mobilePhone from (select * from a_HFList where sponsorName = '" . $sponsorName . "' and HFModifyDate = '" . $HFModifyDate . "' and
//		status like '1' and extraBatch='" . $extraBatch . "' ) as a left join a_workerinfo b on a.uID = b.uID
//		where b.unitID in (" . $units_str . ")";
////		}else{
//		$sql = "select a.batch,a.extraBatch,a.uID,a.IDType,(ROUND(a.HFRadix,'0')) as HFRadix,a.pHFPer,a.uHFPer,a.housingFund as housingFundStatus,right(a.batch,6) as HFModifyDate,a.status,a.sponsorName, a.sponsorTime,
//		a.leaderName,a.receiverName,a.receiveTime,a.ID,b.HFID,b.proTitle,b.proLevel,b.marriage,b.spousePID,b.spouseName,b.education,b.sID,b.mobilePhone from (select * from a_HFList where sponsorName = '" . $sponsorName . "' and HFModifyDate = '" . $HFModifyDate . "' and
//		status like '1' and extraBatch='" . $extraBatch . "' and receiverName like '".$res['mName']."' ) as a left join a_workerinfo b on a.uID = b.uID";
//
//		}
if ($type == "9") {
    $sql = "select a.batch,a.extraBatch,a.uID,a.IDType,(ROUND(a.HFRadix,'0')) as HFRadix,a.pHFPer,a.uHFPer,a.housingFund as housingFundStatus,right(a.batch,6) as HFModifyDate,a.status,a.sponsorName, a.sponsorTime,
	    	a.remarks,a.receiverName,a.receiveTime,a.ID,b.HFID,b.proTitle,b.proLevel,b.marriage,b.spousePID,b.spouseName,b.education,b.sID,b.mobilePhone from (select * from a_HFList where sponsorName = '" . $sponsorName . "' and HFModifyDate = '" . $HFModifyDate . "' and
	        extraBatch='" . $extraBatch . "' and type='9' ) as a left join d_agent_personalInfo b on a.uID = b.id";
} else {
    $sql = "select a.batch,a.extraBatch,a.uID,a.IDType,(ROUND(a.HFRadix,'0')) as HFRadix,a.pHFPer,a.uHFPer,a.housingFund as housingFundStatus,right(a.batch,6) as HFModifyDate,a.status,a.sponsorName, a.sponsorTime,
	    	a.leaderName,a.receiverName,a.receiveTime,a.ID,b.HFID,b.proTitle,b.proLevel,b.marriage,b.spousePID,b.spouseName,b.education,b.sID,b.mobilePhone from (select * from a_HFList where sponsorName = '" . $sponsorName . "' and HFModifyDate = '" . $HFModifyDate . "' and
	        extraBatch='" . $extraBatch . "' and type='0' ) as a left join a_workerinfo b on a.uID = b.uID";
}
$ret = SQL($pdo, $sql);
$ret = keyArray($ret, "uID");
$inNum = $trNum = $outNum = 0;
foreach ($ret as $rkey => $rval) {
    if ($rval ['housingFundStatus'] == '1' || $rval ['housingFundStatus'] == '2' || $rval ['housingFundStatus'] == '9') {
        $inRet [$rkey] = $ret [$rkey];
        $inRet [$rkey] ['num'] = $inNum + 1;
        $inNum++;
    } elseif ($rval ['housingFundStatus'] == '3') {
        $trRet [$rkey] = $ret [$rkey];
        $trRet [$rkey] ['num'] = $trNum + 1;
        $trNum++;
    } elseif ($rval ['housingFundStatus'] == '0') {
        $outRet [$rkey] = $ret [$rkey];
        $outRet [$rkey] ['num'] = $outNum + 1;
        $outNum++;
    }
}

if (!$ret) {
    sys_error($smarty, "由于公积金专员负责单位的变更，这些数据不再提供，如有需要，请联系技术组！");
}
foreach ($ret as $val) {
    if ($type == "9")
        $fIDStr .= "'" . $val ['uID'] . "',";
    else
        $uIDStr .= "'" . $val ['uID'] . "',";
}
$uIDStr = rtrim($uIDStr, ",");
$fIDStr = rtrim($fIDStr, ",");
#派遣员工部分
$detailSql = "select a.uID,a.name,a.pID,a.sID,a.HFID,b.unitName,a.domicile,b.housingFundID from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.uID in($uIDStr) order by b.housingFundID";
$detailRet = $pdo->prepare($detailSql);
$detailRet->execute();
$detailRet = $detailRet->fetchAll(PDO::FETCH_ASSOC);
$dRet = keyArray($detailRet, "uID");
#个人代理的部分
$fIDSql = "select a.ID as uID,a.name,a.pID,a.sID,a.HFID,b.unitName,a.domicile,b.housingFundID from d_agent_personalInfo a left join a_unitInfo b on b.unitID like '3000.001' where a.id in ($fIDStr)";
$fIDRet = SQL($pdo, $fIDSql);
$fIDRet = keyArray($fIDRet, "uID");
#重新设置数组
if ($inRet) {
    foreach ($inRet as $val) {
        if ($dRet)
            $inRe [] = array_merge($val, $dRet [$val ['uID']]);
        if ($fIDRet)
            $inRe [] = array_merge($val, $fIDRet [$val ['uID']]);
    }
    $inRe = reCreateArray($inRe, $wInfoSetExtra);
#保存为EXCEL
    $inTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "unitName" => "单位", "name" => "姓名", "IDType" => "证件类型", "pID" => "身份证号码", "sID" => "社保号", "education" => "最高学位", "proTitle" => "职称", "HFModifyDate" => "启用年月", "HFRadix" => "基数", 'domicile' => "户籍", "mobilePhone" => "移动电话", "marriage" => "婚姻状况", "spouseName" => "配偶姓名", "spousePID" => "配偶身份证", "housingFundStatus" => "公积金状态", "remarks" => "备注", "sponsorName" => "提交人", "receiveTime" => "签收时间");
    $inExcelTitle = "设立";
    $inThArr [] = $inTableHead;
}

if ($trRet) {
    foreach ($trRet as $val) {
        if ($dRet)
            $trRe [] = array_merge($val, $dRet [$val ['uID']]);
    }
    $trRe = reCreateArray($trRe, $wInfoSetExtra);
#保存为EXCEL
    $trTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "HFID" => "个人公积金号", "name" => "姓名", "pID" => "身份证", "HFRadix" => "启封后基数", "housingFundStatus" => "公积金状态", "unitName" => "单位名称", "uID" => "员工编号", "sponsorName" => "提交人", "receiveTime" => "签收时间");
    $trExcelTitle = "市内转移";
    $trThArr [] = $trTableHead;
}
if ($outRet) {
    foreach ($outRet as $val) {
        if ($dRet)
            $outRe [] = array_merge($val, $dRet [$val ['uID']]);
        if ($fIDRet)
            $outRe [] = array_merge($val, $fIDRet [$val ['uID']]);
    }
   
   
    $outRe = reCreateArray($outRe, $wInfoSetExtra);
#保存为EXCEL
    $outTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "HFID" => "个人公积金号", "name" => "姓名", "pID" => "身份证", "housingFundStatus" => "公积金状态", "unitName" => "单位名称", "uID" => "员工编号", "unitName" => "单位名称", "sponsorName" => "提交人", "receiveTime" => "签收时间");
    $outExcelTitle = "封存";
    $outThArr [] = $outTableHead;
}

if ($inRe)
    $inExcelRet = array_merge($inThArr, $inRe);
if ($trRe)
    $trExcelRet = array_merge($trThArr, $trRe);
if ($outRe)
    $outExcelRet = array_merge($outThArr, $outRe);
if (isset($_POST ['intoExcel'])) {
    if (!$inExcelRet && !$outExcelRet && !$trExcelRet)
        exit("<script> alert('无数据导出') </script>");

#链接PHPEXCEL CLASS
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once '../class/excelString.class.php';
    $oExcel = new PHPExcel ();
#设置文档基本属性
    $oPro = $oExcel->getProperties();
    $oPro->setCreator($serverCompany); //公司名
#构造输出函数
    $op = new excelOutput ();
    $op->oExcel = $oExcel;
    $sheetIndex = 0;
    if ($inExcelRet) {
        $op->eRes = $inExcelRet;
        $op->selFieldArray = $inTableHead;
        $op->title = $inExcelTitle;
        $op->fillData();
        $oExcel->createSheet();
        $op->sheetIndex = $sheetIndex + 1;
        $sheetIndex = $sheetIndex + 1;
    }
    if ($trExcelRet) {
        $op->eRes = $trExcelRet;
        $op->selFieldArray = $trTableHead;
        $op->title = $trExcelTitle;
        $op->fillData();
        $oExcel->createSheet();
        $op->sheetIndex = $sheetIndex + 1;
    }
    if ($outExcelRet) {
        $op->eRes = $outExcelRet;
        $op->selFieldArray = $outTableHead;
        $op->title = $outExcelTitle;
        $op->fillData();
    }
    $op->eFileName = $HFModifyDate . "公积金清单.xls";
    $op->output();
}
#配置变量
$smarty->assign(array("HFModifyDate" => $HFModifyDate));
$smarty->assign(array("inRet" => $inRe, "trRet" => $trRe, "outRet" => $outRe));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("housingFundManage/HFListDetail.tpl");
?>