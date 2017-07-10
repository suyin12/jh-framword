<?php

/*
 *     2010-6-25
 *          <<< 续签合同提醒及续签处理 >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#单位,客户经理联动菜单
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'dataFunction/wInfoSet.data.php';
$title = "续签合同管理";
#获取中英文对照数组
$engToChsArr = engTochs();
#员工类型数组
$w = new wInfoSet();
$w->p=$pdo;
$w->wInfoSetArr();
$wInoSet = $w->wInfoSet;
$typeArr = $wInoSet['type'];
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1");
$j_unitManager = json_encode($unitManager);
if (!is_null($_GET ['monthAgo']))
    $monthAgo = $_GET ['monthAgo'];
else {
    $finallyDay = timeStyle('finallyDayMon');
    $monthAgo = date("Y-m-d", strtotime("$finallyDay +1 month"));
}

$eT = $monthAgo;
$mID = $_GET ['mID'];
$unitID = $_GET ['unitID'];
#查看需续签人员名单,以客户经理及单位分开
$sql = "select b.unitName,a.uID,a.name,a.type,a.pID,a.cBeginDay,a.cEndDay,a.helpCost from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.cEndDay<'$eT' and a.status in('1','2') and cType='1'";
//print_r($ret);
//遍历客户经理,单位数组
foreach ($unitManager as $um_v) {
    foreach ($um_v as $um_v_k => $um_v_v) {
        if ($um_v ['mID'] == $mID) {
            //构造get后,单位数组
            $um [0] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName'], "unit" => $um_v ['unit']);

            if (is_array($um_v_v)) {
                foreach ($um_v_v as $um_v_v_k => $um_v_v_v) {
                    $sql1 .= "'" . $um_v_v_v ['unitID'] . "',";
                }
            }
        } else {
            //构造get后,单位数组,除get外其余的客户经理
            $um_m[$um_v['mID']] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName']);
        }
    }
}

//GET參數
if ($_GET) {
    foreach ($_GET as $key => $val) {
        if ($key != "page" and $key != "intoExcel") {
            $queryStr .= $key . "=" . $val . "&";
        }
        if ($val) {
            switch ($key) {
                case "mID" :
                    //构造高级查询
                    $sql1 = substr($sql1, 0, - 1);
                    $sql2 = " and a.unitID in (" . $sql1 . ")";
                    //构造get后,单位数组
                    
                    $um = array_merge($um, $um_m);
                    $smarty->assign("unitManager", $um);
                    break;
                case "unitID" :
                    $sql2 = " and a." . $key . " like '" . $val . "'";
                    break;
            }
        } elseif (!$_GET ['mID']) {
            $smarty->assign("unitManager", $unitManager);
        }
    }
} else {
    $smarty->assign("unitManager", $unitManager);
}
$sql = $sql . $sql2;
$res = $pdo->query($sql);
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
if ($_POST ['intoExcel']) {
    #保存为EXCEL
    $tableHead = array("unitName" => "单位", "uID" => "员工编号", "name" => "姓名", "pID" => "身份证号码", "cBeginDay" => "合同开始日期", "cEndDay" => "合同终止日期");
    $excelTitle = "续签合同清单";
    $thArr [] = $tableHead;
    if ($ret)
        $excelRet = array_merge($thArr, $ret);
    if (!$excelRet)
        exit("<script> alert('无数据导出') </script>");

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
#配置变量
$smarty->assign("typeArr", $typeArr);
$smarty->assign("monthAgo", $monthAgo);
$smarty->assign("engToChsArr", $engToChsArr);
$smarty->assign("j_unitManager", $j_unitManager);
$smarty->assign("s_mID", $mID);
$smarty->assign("s_unitID", $unitID);
#显示查询结果
$smarty->assign("ret", $ret);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("workerInfo/renewalContract.tpl");
?>