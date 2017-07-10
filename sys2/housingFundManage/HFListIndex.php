<?php

/**
 * 2011-5-23
 * <<<公积金名单管理,这里主要是做签收处理,必需签收完,才可以打开查看/下载申报表
 * 1.首先就按公积金批次号分组,select选择
 * >>>
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
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
//$smarty->debugging = true;
$title = "公积金清单管理";
#获取社保批次号
$batchSql = " select batch from a_HFList group by batch order by batch desc limit 6";
$batchRes = $pdo->query($batchSql);
$batch = $batchRes->fetchAll(PDO::FETCH_COLUMN);

#获取公积金专员
$sql = "select mID,mName from s_user where roleID REGEXP '3_5,' and status !='0'";
$ret = $pdo->query($sql);
if ($ret) {
    $res = $ret->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $r) {
        $zhuanyuan_opt [$r ['mID']] = $r ['mName'];
        $zhuanyuan_arr [] = $r ['mID'];
    }
    $smarty->assign("zhuanyuan_opt", $zhuanyuan_opt);
}

//查找详细的社保信息
$s_batch = $_GET ['batch'];
$zhuanyuan_s = $_GET ['zhuanyuan'];

if ($s_batch) {
    if ($zhuanyuan_s) {
        $sql = "select unitID from s_user where mID = " . $zhuanyuan_s;
    } else { //专员值是0，表示想要显示全部单位
        $sql = "select unitID from s_user where roleID REGEXP '3_5,'";
    }

    $ret = $pdo->query($sql);
    $res = $ret->fetchAll(PDO::FETCH_ASSOC);
    $units_str = NULL;
    foreach ($res as $v) {
        if ($v ['unitID'])
            $units_str .= $v ['unitID'] . ",";
    }
    $units_str = substr($units_str, 0, -1);
    $sql = "select uID,batch,extraBatch,HFModifyDate,sponsorName,sponsorTime,receiverName,receiveTime,status,type
            from a_HFList where batch = '" . $s_batch . "' and HFModifyDate<='" . timeStyle("date") . "' group by sponsorName,HFModifyDate,extraBatch,type order by HFModifyDate,sponsorTime";
    $res = $pdo->query($sql);
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST ['intoExcel'])) {
        $tsql = "select batch,extraBatch,uID,(ROUND(HFRadix,'0')) as HFRadix,pHFPer,uHFPer,housingFund as housingFundStatus,
				HFModifyDate,status,type,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID  from a_HFList where batch = '" . $s_batch . "' and status = '1' order by HFModifyDate,sponsorTime ";
        $tres = $pdo->query($tsql);
        $tret = $tres->fetchAll(PDO::FETCH_ASSOC);
        $inNum = $trNum = $outNum = 0;
        foreach ($tret as $rkey => $rval) {
            if ($rval ['housingFundStatus'] == '1') {
                $inRet [$rkey] = $tret [$rkey];
                $inRet [$rkey] ['num'] = $inNum + 1;
                $inNum++;
            } elseif ($rval ['housingFundStatus'] == '3') {
                $trRet [$rkey] = $tret [$rkey];
                $trRet [$rkey] ['num'] = $trNum + 1;
                $trNum++;
            } elseif ($rval ['housingFundStatus'] == '0') {
                $outRet [$rkey] = $tret [$rkey];
                $outRet [$rkey] ['num'] = $outNum + 1;
                $outNum++;
            }
        }
        if (!$tret)
            exit("数据读取出错,请重试");

        foreach ($tret as $val) {
            $uIDStr .= "'" . $val ['uID'] . "',";
        }
        $uIDStr = rtrim($uIDStr, ",");
        $detailSql = "select a.uID,a.name,a.pID,a.sID,a.HFID,b.unitName,a.domicile,b.housingFundID from a_workerInfo a 
						left join a_unitInfo b on a.unitID=b.unitID where a.uID in($uIDStr)";
        $detailRet = $pdo->prepare($detailSql);
        $detailRet->execute();
        $detailRet = $detailRet->fetchAll(PDO::FETCH_ASSOC);
        if (!$detailRet)
            exit("未知的单位信息");

        foreach ($detailRet as $dKey => $dVal) {
            $dRet [$dVal ['uID']] = $dVal;
        }

        #重新设置数组
        if ($inRet) {
            foreach ($inRet as $val) {
                $inRe [] = array_merge($val, $dRet [$val ['uID']]);
            }
            $inRe = reCreateArray($inRe, $wInfoSet);
#保存为EXCEL
            $inTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "unitName" => "单位", "name" => "姓名", "IDType" => "证件类型", "pID" => "身份证号码", "sID" => "社保号", "education" => "最高学位", "proTitle" => "职称", "HFModifyDate" => "启用年月", "HFRadix" => "基数", 'domicile' => "户籍", "mobilePhone" => "移动电话", "marriage" => "婚姻状况", "spouseName" => "配偶姓名", "spousePID" => "配偶身份证", "housingFundStatus" => "公积金状态", "sponsorName" => "客户经理", "receiveTime" => "签收时间");
            $inExcelTitle = "设立";
            $inThArr [] = $inTableHead;
        }
        if ($trRet) {
            foreach ($trRet as $val) {
                $trRe [] = array_merge($val, $dRet [$val ['uID']]);
            }
            $trRe = reCreateArray($trRe, $wInfoSet);
#保存为EXCEL
            $trTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "HFID" => "个人公积金号", "name" => "姓名", "pID" => "身份证", "HFRadix" => "启封后基数", "housingFundStatus" => "公积金状态", "uID" => "员工编号", "unitName" => "单位名称", "sponsorName" => "客户经理", "receiveTime" => "签收时间");
            $trExcelTitle = "市内转移";
            $trThArr [] = $trTableHead;
        }
        if ($outRet) {
            foreach ($outRet as $val) {
                $outRe [] = array_merge($val, $dRet [$val ['uID']]);
            }
            $outRe = reCreateArray($outRe, $wInfoSet);
#保存为EXCEL
            $outTableHead = array("num" => "序号", "housingFundID" => "公积金账户", "HFID" => "个人公积金号", "name" => "姓名", "housingFundStatus" => "公积金状态", "uID" => "员工编号", "unitName" => "单位名称", "sponsorName" => "客户经理", "receiveTime" => "签收时间");
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
    }

//	echo "<pre>";
//	print_r ( $ret );
} else {
    $startMon = timeStyle("Ym", "") . "01";
    $toBatch = "HF." . timeStyle("Ym", "");
    if (timeStyle("d") > insuranceInTurn("HF")) {
        $toBatch = "HF." . date("Ym", strtotime("$startMon +1 month"));
    }

    if (in_array($_SESSION ['exp_user'] ['mID'], $zhuanyuan_arr))
        $zy = $_SESSION ['exp_user'] ['mID'];
    else
        $zy = 0;
    $_SERVER ["QUERY_STRING"] = "?batch=" . $toBatch . "&zhuanyuan=" . $zy;
    header("Location:" . $_SERVER ["PHP_SELF"] . $_SERVER ["QUERY_STRING"]);
}

#配置变量
$smarty->assign("batch", $batch);
// 查询结果
$smarty->assign("s_batch", $s_batch);
$smarty->assign("ret", $ret);
$smarty->assign("zhuanyuan_s", $zhuanyuan_s);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("housingFundManage/HFListIndex.tpl");
?>