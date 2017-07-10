<?php
/**
 * 2010-4-23
 * <<<社保名单管理,这里主要是做签收处理,必需签收完,才可以打开查看/下载申报表
 * 1.首先就按社保批次号分组,select选择
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
$title = "社保清单管理";
#获取社保批次号
$batchSql = " select batch from a_soInsList group by batch order by batch desc limit 6";
$batchRes = $pdo->query($batchSql);
$batch = $batchRes->fetchAll(PDO::FETCH_COLUMN);

#获取社保专员
$sql = "select mID,mName from s_user where roleID REGEXP '3_1,' and status !='0'";
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
        $sql = "select unitID,mName from s_user where mID = " . $zhuanyuan_s;
    } else //专员值是0，表示想要显示全部单位
    {
        $sql = "select unitID from s_user where roleID REGEXP '3_1,' and status<>'0'";
    }

    $ret = $pdo->query($sql);
    $res = $ret->fetchAll(PDO::FETCH_ASSOC);
    $units_str = NULL;
    foreach ($res as $v) {
        if ($v ['unitID'])
            $units_str .= $v ['unitID'] . ",";
    }
    $units_str = substr($units_str, 0, -1);

    $sql = "select uID,batch,extraBatch,soInsModifyDate,sponsorName,sponsorTime,receiverName,receiveTime,status,type from a_soInsList where batch = '" . $s_batch . "' and soInsModifyDate<='" . timeStyle("date") . "' and unitID in ($units_str) group by sponsorName,soInsModifyDate,extraBatch order by soInsModifyDate,sponsorTime";
    $res = $pdo->query($sql);
    if($res)
	   $ret = $res->fetchAll(PDO::FETCH_ASSOC);

    if (isset ($_POST ['intoExcel'])) {

         $tsql = "select batch,extraBatch,uID,(ROUND(radix,'0')) as radix,pension,hospitalization,
				employmentInjury,unemployment,housing,PDIns,hand,soInsurance as soInsStatus,
				soInsModifyDate,status,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID,type  from a_soInsList where batch = '" . $s_batch . "' and status = '1'
			    order by soInsModifyDate,sponsorTime ";

        $tres = $pdo->query($tsql);
        $tret = $tres->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tret as $rkey => $rval) {
            $tret [$rkey] ['num'] = $rkey + 1;
        }
        if (!$tret)
            exit ("数据读取出错,请重试");
        foreach ($tret as $val) {
            if ($val['type'] == '9') {
                $fIDStr .= "'" . $val ['uID'] . "',";
            } else {
                $uIDStr .= "'" . $val ['uID'] . "',";
            }
        }
        $uIDStr = rtrim($uIDStr, ",");
        $fIDStr = rtrim($fIDStr, ",");
        #派遣部分
        $detailSql = "select a.uID,a.name,a.pID,a.sID,b.unitName,a.domicile,b.soInsID from a_workerInfo a
						left join a_unitInfo b on a.unitID=b.unitID where a.uID in($uIDStr)";
        $detailRet = SQL($pdo, $detailSql);
        $dRet = keyArray($detailRet, "uID");
        #个人代理的部分
         $fIDSql = "select a.id as uID, a.name,a.pID,a.sID,b.unitName,a.domicile,b.soInsID from d_agent_personalInfo a
                        left join a_unitInfo b on b.unitID like '3000.001' where a.id in ($fIDStr)";
        $fIDRet = SQL($pdo, $fIDSql);
        $fIDRet = keyArray($fIDRet, "uID");
        #重新设置数组
        foreach ($tret as $val) {
            if ($dRet)
                $re [] = array_merge($val, $dRet [$val ['uID']]);
            if ($fIDRet)
                $re [] = array_merge($val, $fIDRet[$val['uID']]);
        }
        $re = reCreateArray($re, $wInfoSet);
        #保存为EXCEL
        $tableHead = array("num" => "序号", "soInsID" => "社保账户", "batch" => "批次号", "unitName" => "单位", "uID" => "员工编号", "name" => "姓名", "pID" => "身份证号码", "sID" => "社保号", 'domicile' => "户籍", 'radix' => "基数", 'pension' => "养老", 'hospitalization' => "医疗", 'employmentInjury' => "工伤", 'unemployment' => "失业", 'PDIns' => "残障金", 'hand' => "利手", "soInsStatus" => "社保状态", "sponsorName" => "客户经理", "soInsModifyDate" => "申报日期", "receiverName" => "签收人", "receiveTime" => "签收时间");
        $excelTitle = $s_batch . "社保清单";
        $thArr [] = $tableHead;
        if ($re)
            $excelRet = array_merge($thArr, $re);
        if (!$excelRet)
            exit ("<script> alert('无数据导出') </script>");

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

    //	echo "<pre>";
//	print_r ( $ret );
} else {
    $startMon = timeStyle("Ym", "") . "01";
    $toBatch = "So." . timeStyle("Ym", "");
    if (timeStyle("d") > insuranceInTurn("soIns")) {
        $toBatch = "So." . date("Ym", strtotime("$startMon +1 month"));
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
$smarty->assign("s_batch", $s_batch);
$smarty->assign("ret", $ret);
$smarty->assign("zhuanyuan_s", $zhuanyuan_s);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("soInsManage/soInsList.tpl");
?>