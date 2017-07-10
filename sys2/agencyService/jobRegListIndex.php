<?php

/**
 * 2011-5-26             
 * <<<就业名单管理,这里主要是做签收处理,必需签收完,才可以打开查看/下载申报表
 * 1.首先就按就业批次号分组,select选择
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
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->type = "jobReg";
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
$wInfoSetExtra = $wSet->wInfoSetExtra;
$title = "就业清单管理";
#就业登记房屋编码
$houseNumber =insuranceID("houseNumber"); 
#获取就业批次号
$batchSql = " select batch from a_jobRegList group by batch order by batch desc  limit 6";
$batchRes = $pdo->query($batchSql);
if (!$batchRes)
    exit("该功能首次使用，暂无申报数据");
$batch = $batchRes->fetchAll(PDO::FETCH_COLUMN);

#获取就业专员
$sql = "select mID,mName from s_user where roleID REGEXP '3_6,' and status !='0'";
$ret = $pdo->query($sql);
if ($ret) {
    $res = $ret->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $r) {
        $zhuanyuan_opt [$r ['mID']] = $r ['mName'];
        $zhuanyuan_arr [] = $r ['mID'];
    }
    $smarty->assign("zhuanyuan_opt", $zhuanyuan_opt);
}

//查找详细的就业信息
$s_batch = $_GET ['batch'];
$zhuanyuan_s = $_GET ['zhuanyuan'];

if ($s_batch) {

    if ($zhuanyuan_s) {
        $sql = "select unitID from s_user where mID = " . $zhuanyuan_s;
    } else { //专员值是0，表示想要显示全部单位
        $sql = "select unitID from s_user where roleID REGEXP '3_6,'";
    }

    $ret = $pdo->query($sql);
    $res = $ret->fetchAll(PDO::FETCH_ASSOC);
    $units_str = NULL;
    foreach ($res as $v) {
        if ($v ['unitID'])
            $units_str .= $v ['unitID'] . ",";
    }
    $units_str = substr($units_str, 0, - 1);

    $sql = "select a.batch,a.extraBatch,a.jobRegModifyDate,a.sponsorName,a.sponsorTime,a.receiverName,a.receiveTime,c.mID as receiverID,
			a.status from (select uID,batch,extraBatch,jobRegModifyDate,sponsorName,sponsorTime,receiverName,receiveTime,
			status from a_jobRegList where batch = '" . $s_batch . "' and jobRegModifyDate<='" . timeStyle("date") . "') as a left join a_workerinfo b on a.uID = b.uID
			 left join s_user c on a.receiverName = c.mName  ";
    if ($units_str)
        $sql .= "	where b.unitID in (" . $units_str . " )";
    $sql .= " group by a.sponsorName,a.jobRegModifyDate,a.extraBatch order by a.sponsorTime desc";

    $res = $pdo->query($sql);
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);

    // 查询结果
    $smarty->assign("s_batch", $s_batch);
    $smarty->assign("ret", $ret);

    //	echo "<pre>";print_r($ret);
    $smarty->assign("zhuanyuan_s", $zhuanyuan_s);

    if (isset($_POST ['intoExcel'])) {

        $sql = "select a.batch,a.extraBatch,a.uID,a.jobReg as jobRegStatus,a.jobRegModifyDate,a.status,a.sponsorName, a.sponsorTime,
		a.leaderName,a.receiverName,a.receiveTime,a.ID,b.* from (select * from a_jobRegList where batch = '" . $s_batch . "' and status = '1' ) as a left join a_workerinfo b on a.uID = b.uID and  b.unitID in (" . $units_str . " ) order by a.jobRegModifyDate,a.sponsorTime ";

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
                $ret[$key]['proLevel'] = $val['proLevel'] ? $val['proLevel'] : 9;
                $ret[$key]['houseNumber'] = $houseNumber;
                $ret[$key]['contactTelephone'] = $val['contactPhone'];
                $ret[$key]['birthIDYESorNO'] = $val['birthID'] ? 1 : 0;
                $ret[$key]['remarks'] = null;
            }
        }

//echo "<pre>";
//print_r($ret);
        $uIDStr = rtrim($uIDStr, ",");
        $detailSql = "select a.uID,a.name,a.pID,a.sID,b.unitName,a.domicile from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.uID in($uIDStr) order by b.soInsID";
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
    $inRe = reCreateArray($inRe, $wInfoSet);
#保存为EXCEL
            $inTableHead = array("pID" => "身份证号码", "name" => "姓名", "oldName" => "曾用名", "education" => "文化程度", "nation" => "民族", "role" => "政治面貌", "marriage" => "婚姻状况", "sID" => "社保号", 'domicile' => "户籍", "mountGuardDay" => "参加工作时间", "proTitle" => "职称", "cBeginDay" => "合同开始日期", 'cEndDay' => "合同终止日期", "employmentType" => "就业类型", 'radix' => "工资", 'proLevel' => "职业等级技能", 'currentUnitStart' => "本单位工作起始日期", 'photoID' => "相片图像号码", 'houseNumber' => "房屋地址信息编码", 'homeAddress' => "身份证住址", 'comeDate' => "来深时间", "houseType" => "住所类别", "residentialDate" => "入住日期", "residentialType" => "居住方式", "telephone" => "本人固定电话", "mobilePhone" => "本人手机", "contact" => "紧急联系人姓名", "contactTelephone" => "紧急联系人固定电话", "contactPhone" => "紧急联系人手机", "birthIDYESorNO" => "广东省流动人口避孕节育情况报告单", "birthID" => "报告单编号", "unitName" => "就业登记备注", "station" => "工种");
            $inExcelTitle = "新增";
            $inThArr [] = $inTableHead;
        }
        if ($outRet) {
            foreach ($outRet as $val) {
                $outRe [] = array_merge($val, $dRet [$val ['uID']]);
            }
    $outRe = reCreateArray($outRe, $wInfoSet);
#保存为EXCEL
            $outTableHead = array("num" => "序号", "pID" => "身份证号码", "name" => "姓名", "jobRegStatus" => "就业登记状态", "uID" => "员工编号", "sponsorName" => "客户经理", "receiveTime" => "签收时间");
            $outExcelTitle = "终止";
            $outThArr [] = $outTableHead;
        }

        if ($inRe)
            $inExcelRet = array_merge($inThArr, $inRe);
        if ($outRe)
            $outExcelRet = array_merge($outThArr, $outRe);
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
        $op->eFileName = $s_batch . "就业登记清单.xls";
        $op->output();
    }
} else {
    $startMon = timeStyle("Ym", "") . "01";
    $toBatch = "JR." . timeStyle("Ym", "");
    if (timeStyle("d") > 19) {
        $toBatch = "JR." . date("Ym", strtotime("$startMon +1 month"));
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
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/jobRegListIndex.tpl");
?>