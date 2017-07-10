<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/3 - 14:52
 *
 *  公积金申报表
 */

#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";
#
$title = "公积金申报表";
$today = timeStyle("date");
#
$sL = new agentHFList();
//获取公积金批次号
$batchBasicArr = $sL->HFListBasic("ID,batch", " 1=1 group by batch order by batch desc limit 6");
foreach ($batchBasicArr as $val) {
    $batchStr .= $val['batch'];
    $batchArr[] = $val['batch'];
}
$createHFList = filterParam("createHFList", 0);
$s_batch = filterParam('get.batch', 0);
$intoExcel = filterParam('post.intoExcel', 0);


if ($s_batch) {
//获取公积金清单汇总表
    $HFListArr = $sL->HFListBasic("ID,fID,batch,extraBatch,HFModifyDate,sponsorName,sponsorTime,receiverName,receiveTime,status,type", "batch = '" . $s_batch . "' and HFModifyDate<='" . timeStyle("date") . "'  group by sponsorName,HFModifyDate,extraBatch order by HFModifyDate,sponsorTime");
    if ($intoExcel) {
        $tret = $sL->HFListBasic("city,batch,extraBatch,uID,(ROUND(HFRadix,'0')) as HFRadix,pHFPer,uHFPer,housingFund as insuranceListStatusTxt,
				HFModifyDate,status,type,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID",
            "batch = '$s_batch' and status = '1' order by HFModifyDate,sponsorTime");
        $i=0;
        foreach ($tret as $rkey => $rval) {
            $tret [$rkey] ['num'] = $i+1;
            $i++;
        }
        if (!$tret)
            exit ("数据读取出错,请重试");
        foreach ($tret as $val) {
            $fIDStr .= "'" . $val ['fID'] . "',";
        }
        $fIDStr = rtrim($fIDStr, ",");
        #个人代理的部分
        $aU = new agentUser();
        $aUserArr = $aU->agentUserBasic("fID, name,pID,sID,cityInsurance", " fID in ($fIDStr)");
        #重新设置数组
        foreach ($tret as $val) {
            if ($aUserArr)
                $re [] = array_merge($val, $aUserArr[$val['fID']]);
        }
        $aU->agentUserArr = $re;
        $re = $aU->agentUserRecreate();
        #保存为EXCEL
        $tableHead = array("num" => "序号", "cityTxt" => "城市", "HFID" => "公积金账户", "batch" => "批次号", "fID" => "参保人ID", "name" => "姓名", "pID" => "身份证号码", "sID" => "公积金号",  'radix' => "基数", 'pension' => "养老", 'hospitalization' => "医疗", 'employmentInjury' => "工伤", 'unemployment' => "失业", 'PDIns' => "残障金", "insuranceListStatusTxt" => "公积金状态", "sponsorName" => "客户经理", "HFModifyDate" => "申报日期", "receiverName" => "签收人", "receiveTime" => "签收时间");
        $excelTitle = $s_batch . "公积金清单";
        $thArr [] = $tableHead;
        if ($re) {
            $excelRet = array_merge($thArr, $excelRet);
        }
        if (!$excelRet)
            exit ("<script> alert('无数据导出') </script>");
//        echo "<pre>";
//        print_r($excelRet);
        #链接PHPEXCEL CLASS
        require_once '../class/phpExcel/Classes/PHPExcel.php';
        require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
        require_once '../class/excel.class.php';
        $oExcel = new PHPExcel ();
        #设置文档基本属性
        $oPro = $oExcel->getProperties();
        $oPro->setCreator($serverCompany); //公司名
        #构造输出函数
        $op = new excelOutput ();
        $op->oExcel = $oExcel;
        $op->eRes = $excelRet;
        $op->selFieldArray = $tableHead;
        $op->title = $excelTitle;
        $op->fillData();
        $op->eFileName = $excelTitle . ".xls";
        $op->output();
    }

} else {
    $startMon = timeStyle("Ym", "") . "01";
    $toBatch = "HF." . timeStyle("Ym", "");
    if (timeStyle("d") > insuranceInTurn("HF")) {
        $toBatch = "HF." . date("Ym", strtotime("$startMon +1 month"));
    }
    $_SERVER ["QUERY_STRING"] = "?batch=" . $toBatch;
    header("Location:" . $_SERVER ["PHP_SELF"] . $_SERVER ["QUERY_STRING"]);
}
#
$smarty->assign(array("batchArr" => $batchArr, "s_batch" => $s_batch));
$smarty->assign(array("HFListArr" => $HFListArr));

#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agent/HFList.tpl");