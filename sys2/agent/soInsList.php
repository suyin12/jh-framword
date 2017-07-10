<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/3 - 14:51
 *
 *     社保缴交申报
 */
#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";
#
$title = "社保申报表";
$today = timeStyle("date");
#
$sL = new agentSoInsList();
//获取社保批次号
$batchBasicArr = $sL->soInsListBasic("ID,batch", " 1=1 group by batch order by batch desc limit 6");
foreach ($batchBasicArr as $val) {
    $batchStr .= $val['batch'];
    $batchArr[] = $val['batch'];
}
$createSoInsList = filterParam("createSoInsList", 0);
$s_batch = filterParam('get.batch', 0);
$intoExcel = filterParam('post.intoExcel', 0);
if ($s_batch) {
//获取社保清单汇总表
    $soInsListArr = $sL->soInsListBasic("ID,fID,batch,extraBatch,soInsModifyDate,sponsorName,sponsorTime,receiverName,receiveTime,status,type", "batch = '" . $s_batch . "' and soInsModifyDate<='" . timeStyle("date") . "'  group by sponsorName,soInsModifyDate,extraBatch order by soInsModifyDate,sponsorTime");
    if ($intoExcel) {
        $tret = $sL->soInsListBasic("city,batch,extraBatch,fID,(ROUND(radix,'0')) as radix,pension,hospitalization,
				employmentInjury,unemployment,PDIns,soInsurance as insuranceListStatus,
				soInsModifyDate,status,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID",
            "batch = '$s_batch' and status = '1' order by soInsModifyDate,sponsorTime");
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
        $tableHead = array("num" => "序号", "cityTxt" => "城市", "soInsID" => "社保账户", "batch" => "批次号", "fID" => "参保人ID", "name" => "姓名", "pID" => "身份证号码", "sID" => "社保号",  'radix' => "基数", 'pension' => "养老", 'hospitalization' => "医疗", 'employmentInjury' => "工伤", 'unemployment' => "失业", 'PDIns' => "残障金", "insuranceListStatusTxt" => "社保状态", "sponsorName" => "客户经理", "soInsModifyDate" => "申报日期", "receiverName" => "签收人", "receiveTime" => "签收时间");
        $excelTitle = $s_batch . "社保清单";
        $thArr [] = $tableHead;
        if ($re) {
            foreach ($re as $key => $val) {
                foreach ($tableHead as $tk => $tv) {
                    $v = $val[$tk];
                    switch ($tk) {
                        case "pension" :
                        case "employmentInjury" :
                        case "unemployment" :
                        case "PDIns" :
                        case "helpCost" :
                            if ($v == "1") {
                                $v = "参加";
                            } elseif (!$v) {
                                $v = "";
                            } else {
                                $v = "出错了";
                            }
                            break;
                        case "hospitalization" :
                            if ($v == "1") {
                                $v = "一档";
                            } elseif ($v == "2") {
                                $v = "二档";
                            } elseif ($v == "4") {
                                $v = "三档";
                            } elseif (!$v) {
                                $v = "";
                            } else {
                                $v = "出错了";
                            }
                            break;
                        case "hand" :
                            if ($v == "1") {
                                $v = "右手";
                            } elseif ($v == "2") {
                                $v = "左手";
                            }
                            break;
                    }
                    $excelRet[$key][$tk] = $v;
                }
            }
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
    $toBatch = "So." . timeStyle("Ym", "");
    if (timeStyle("d") > insuranceInTurn("soIns")) {
        $toBatch = "So." . date("Ym", strtotime("$startMon +1 month"));
    }
    $_SERVER ["QUERY_STRING"] = "?batch=" . $toBatch;
    header("Location:" . $_SERVER ["PHP_SELF"] . $_SERVER ["QUERY_STRING"]);
}
#
$smarty->assign(array("batchArr" => $batchArr, "s_batch" => $s_batch));
$smarty->assign(array("soInsListArr" => $soInsListArr));

#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agent/soInsList.tpl");