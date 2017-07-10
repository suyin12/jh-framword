<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/29 - 11:26
 */

require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";

#标题
$title = "公积金清单批次明细";
$sponsorName = urldecode($_GET ['n']);
$HFModifyDate = $_GET ['d'];
$extraBatch = $_GET ['e'];
$type = $_GET ['type'];

$HL = new agentHFList();
$detailArr = $HL->HFListBasic("city,batch,extraBatch,fID,(ROUND(HFRadix,'0')) as HFRadix,uHFPer,pHFPer,housingFund as insuranceListStatus,
				HFModifyDate,status,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID",
    "HFModifyDate = '$HFModifyDate' and sponsorName like '$sponsorName' and extraBatch='$extraBatch' and type='$type'");
$detailArr = keyArray($detailArr, "fID");
//echo "<pre>";
//print_r($detailArr);
$fIDArr = array_keys($detailArr);
$fIDStr = implode(",", $fIDArr);
$aU = new agentUser();
$aUserArr = $aU->agentUserBasic("fID,name,pID,HFID,proTitle,proLevel,marriage,spousePID,spouseName,education,sID,mobilePhone", "fID in ($fIDStr)");
//echo "<pre>";
//print_r($aUserArr);

$inNum = $moNum = $outNum = 0;
foreach ($detailArr as $rkey => $rval) {
    if ($rval ['insuranceListStatus'] == '1' || $rval ['insuranceListStatus'] == '3' || $rval ['insuranceListStatus'] == '9') {
        //市内转移,设立,补缴
        $inRet [$rkey] = $detailArr [$rkey];
        $inRet [$rkey] ['num'] = $inNum + 1;
        $inNum++;
    } elseif ($rval ['insuranceListStatus'] == '2') {
        //修改
        $moRet [$rkey] = $detailArr [$rkey];
        $moRet [$rkey] ['num'] = $inNum + 1;
        $moNum++;
    } elseif ($rval ['insuranceListStatus'] == '0') {
        //封存
        $outRet [$rkey] = $detailArr [$rkey];
        $outRet [$rkey] ['num'] = $outNum + 1;
        $outNum++;
    }
}
echo "<pre>";
print_r($inRet);
//print_r($moRet);

$fIDArr = array_keys($detailArr);
$fIDStr = implode(",", $fIDArr);
#个人代理的部分
$fIDSql = "select a.ID as fID,a.name,a.pID,a.sID,a.HFID,b.unitName,a.domicile,b.housingFundID from d_agent_personalInfo a left join a_unitInfo b on b.unitID like '3000.001' where a.id in ($fIDStr)";
$fIDRet = SQL($pdo, $fIDSql);
$fIDRet = keyArray($fIDRet, "fID");
#重新设置数组
if ($inRet) {
    #保存为EXCEL
    $inTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "unitName" => "单位", "name" => "姓名", "IDType" => "证件类型", "pID" => "身份证号码", "sID" => "社保号", "education" => "最高学位", "proTitle" => "职称", "HFModifyDate" => "启用年月", "HFRadix" => "基数", 'domicile' => "户籍", "mobilePhone" => "移动电话", "marriage" => "婚姻状况", "spouseName" => "配偶姓名", "spousePID" => "配偶身份证", "insuranceListStatus" => "公积金状态", "remarks" => "备注", "sponsorName" => "提交人", "receiveTime" => "签收时间");
    $inExcelTitle = "设立";

    foreach ($inRet as $key => $val) {
        foreach ($inTableHead as $tk => $tv) {
            switch ($tk) {
                case "":
                    break;
                default:
                    $inRe[$key][$tk] = $val[$tk];
                    break;
            }
        }
    }
//    $inRe = $aU->agentUserRecreate();
    $inThArr [] = $inTableHead;
    echo "<pre>";
    print_r($inRe);
}

if ($outRet) {
    foreach ($outRet as $val) {
        if ($fIDRet)
            $outRe [] = array_merge($val, $fIDRet [$val ['fID']]);
    }


    $outRe = reCreateArray($outRe, $wInfoSetExtra);
#保存为EXCEL
    $outTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "HFID" => "个人公积金号", "name" => "姓名", "pID" => "身份证", "insuranceListStatus" => "公积金状态", "unitName" => "单位名称", "fID" => "员工编号", "unitName" => "单位名称", "sponsorName" => "提交人", "receiveTime" => "签收时间");
    $outExcelTitle = "封存";
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
$smarty->display("agent/HFListDetail.tpl");