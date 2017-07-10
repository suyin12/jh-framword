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
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->type = "jobReg";
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
//$wInfoSetExtra = $wSet->wInfoSetExtra;
#标题
$title = "就业登记清单批次明细";
$sponsorName = urldecode($_GET ['n']);
$jobRegModifyDate = $_GET ['d'];
$extraBatch = $_GET['e'];
$zhuanyuan = $_GET['zy'];
$houseNumber =insuranceID("houseNumber"); 
#先查询出该就业登记专员负责的单位信息
$sql = "select unitID from s_user where mID = " . $zhuanyuan;
$ret = $pdo->query($sql);
$res = $ret->fetch(PDO::FETCH_ASSOC);
$units_str = $res['unitID'];

$sql = "select a.batch,a.extraBatch,a.uID,a.jobReg as jobRegStatus,a.jobRegModifyDate,a.status,a.sponsorName, a.sponsorTime,
		a.leaderName,a.receiverName,a.receiveTime,a.ID,b.* from (select * from a_jobRegList where sponsorName = '" . $sponsorName . "' and jobRegModifyDate = '" . $jobRegModifyDate . "' and 
		status like '1' and extraBatch='" . $extraBatch . "' ) as a left join a_workerinfo b on a.uID = b.uID 
		where b.unitID in (" . $units_str . ")";


$res = $pdo->query($sql);
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
foreach ($ret as $rkey => $rval) {
    $ret[$rkey]['num'] = $rkey + 1;
}
if (!$ret) {
//	exit ( "数据读取出错,请重试" );
    sys_error($smarty, "由于就业登记专员负责单位的变更，这些数据不再提供，如有需要，请联系技术组！");
}
foreach ($ret as $key => $val) {
    $uIDStr .= "'" . $val ['uID'] . "',";
    foreach ($val as $k => $v) {
        $ret[$key]['oldName'] = null;
        $ret[$key]['employmentType'] = $val['domicile'] == 1 ? 2 : 5;
        $ret[$key]['currentUnitStart'] = $val['mountGuardDay'];
        $ret[$key]['comeDate'] = $val['mountGuardDay'];
        $ret[$key]['houseType'] = 3;
        $ret[$key]['residentialDate'] = $val['mountGuardDay'];
        $ret[$key]['residentialType'] = 4;
        $ret[$key]['proTitle'] = $val['proTitle'] ? $val['proTitle'] : 9;
        $ret[$key]['proLevel'] = $val['proLevel'] ? $val['proLevel'] : 9;
        $ret[$key]['houseNumber'] = $houseNumber;
        $ret[$key]['contactTelephone'] = $val['contactPhone'];
        $ret[$key]['birthIDYESorNO'] = $val['birthID'] ? 1 : 0;
        $ret[$key]['remarks'] = null;
		$ret[$key]['station'] ='4070000';
        if ($val['domicile'] == 2) {
            if (strstr($val['homeAddress'], "广东")) {
                if (strstr($val['homeAddress'], "村")) {
                    $ret[$key]['domicile'] = "21";
                } else {
                    $ret[$key]['domicile'] = "11";
                }
            } else {
                if (strstr($val['homeAddress'], "村")) {
                    $ret[$key]['domicile'] = "23";
                } else {
                    $ret[$key]['domicile'] = "12";
                }
            }
        } else {
            $ret[$key]['domicile'] = "10";
        }
    }
}


$uIDStr = rtrim($uIDStr, ",");
$detailSql = "select a.uID,a.name,a.pID,a.sID,b.unitName from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.uID in($uIDStr) order by b.soInsID";
$detailRet = $pdo->prepare($detailSql);
$detailRet->execute();
$detailRet = $detailRet->fetchAll(PDO::FETCH_ASSOC);



if (!$detailRet)
    exit("未知的单位信息");
foreach ($detailRet as $dKey => $dVal) {
    $dRet [$dVal ['uID']] = $dVal;
}
#重新设置数组
foreach ($ret as $val) {
    $re [] = array_merge($val, $dRet [$val ['uID']]);
}

foreach ($ret as $rkey => $rval) {
    if ($rval ['jobRegStatus'] == '1') {
        $inRet [$rkey] = $ret [$rkey];
        $inRet [$rkey] ['num'] = $inNum + 1;
        $inNum++;
    } elseif ($rval ['jobRegStatus'] == '0') {
        $outRet [$rkey] = $ret [$rkey];
        $outRet [$rkey] ['num'] = $outNum + 1;
        $outNum++;
    }
}

#保存为EXCEL
#重新设置数组
if ($inRet) {
    foreach ($inRet as $val) {
        $inRe [] = array_merge($val, $dRet [$val ['uID']]);
    }
//    $inRe = reCreateArray($inRe, $wInfoSetExtra);
#保存为EXCEL
    $inTableHead = array("pID" => "身份证号码", "name" => "姓名", "oldName" => "曾用名", "education" => "文化程度", "nation" => "民族", "role" => "政治面貌", "marriage" => "婚姻状况", "sID" => "社保号", 'domicile' => "户籍", "mountGuardDay" => "参加工作时间", "proTitle" => "职称", "cBeginDay" => "合同开始日期", 'cEndDay' => "合同终止日期", "employmentType" => "就业类型", 'radix' => "工资", 'proLevel' => "职业等级技能", 'currentUnitStart' => "本单位工作起始日期", 'photoID' => "相片图像号码", 'houseNumber' => "房屋地址信息编码", 'homeAddress' => "身份证住址", 'comeDate' => "来深时间", "houseType" => "住所类别", "residentialDate" => "入住日期", "residentialType" => "居住方式", "telephone" => "本人固定电话", "mobilePhone" => "本人手机", "contact" => "紧急联系人姓名", "contactTelephone" => "紧急联系人固定电话", "contactPhone" => "紧急联系人手机", "birthIDYESorNO" => "广东省流动人口避孕节育情况报告单", "birthID" => "报告单编号", "unitName" => "就业登记备注", "station" => "工种");
    $inExcelTitle = "新增";
    $inThArr [] = $inTableHead;
}
if ($outRet) {
    foreach ($outRet as $val) {
        $outRe [] = array_merge($val, $dRet [$val ['uID']]);
    }
//    $outRe = reCreateArray($outRe, $wInfoSetExtra);
#保存为EXCEL
    $outTableHead = array("num" => "序号", "pID" => "身份证号码", "name" => "姓名", "jobRegStatus" => "就业登记状态", "uID" => "员工编号", "sponsorName" => "客户经理", "receiveTime" => "签收时间");
    $outExcelTitle = "终止";
    $outThArr [] = $outTableHead;
}

if ($inRe)
    $inExcelRet = array_merge($inThArr, $inRe);
if ($outRe)
    $outExcelRet = array_merge($outThArr, $outRe);
if (isset($_POST ['intoExcel'])) {
    if (!$inExcelRet && !$outExcelRet && !$trExcelRet)
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
    $sheetIndex = 0;
    if ($inExcelRet) {
        $op->headRow = 4;
        $op->eRes = $inExcelRet;
        $op->selFieldArray = $inTableHead;
        $op->title = $inExcelTitle;
        $op->fillData();
        $oExcel->createSheet();
        $op->sheetIndex = $sheetIndex + 1;
        $sheetIndex = $sheetIndex + 1;
    }
    if ($outExcelRet) {
        $op->headRow = 1;
        $op->eRes = $outExcelRet;
        $op->selFieldArray = $outTableHead;
        $op->title = $outExcelTitle;
        $op->fillData();
    }
    $op->eFileName = $jobRegModifyDate . "就业登记清单.xls";
    $op->output();
}
#配置变量
$smarty->assign(array("jobRegModifyDate" => $jobRegModifyDate));
$smarty->assign(array("inRet" => $inRe, "outRet" => $outRe));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/jobRegListDetail.tpl");
?>