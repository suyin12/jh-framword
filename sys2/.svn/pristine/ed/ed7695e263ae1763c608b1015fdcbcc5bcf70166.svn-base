<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/3/29 - 11:26
 *
 *
 *  社保清单明细
 */
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";

#标题
$title = "社保清单批次明细";
$sponsorName = urldecode($_GET ['n']);
$soInsModifyDate = $_GET ['d'];
$extraBatch = $_GET ['e'];
$type = $_GET ['type'];

#先查询出该社保专员负责的单位信息
$sL = new agentSoInsList();
$detailArr = $sL->soInsListBasic("city,batch,extraBatch,fID,(ROUND(radix,'0')) as radix,pension,hospitalization,
				employmentInjury,unemployment,PDIns,soInsurance as insuranceListStatus,
				soInsModifyDate,status,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID",
                "soInsModifyDate = '$soInsModifyDate' and sponsorName like '$sponsorName' and extraBatch='$extraBatch' and type='$type'");
$detailArr = keyArray($detailArr, "fID");
//echo "<pre>";
//print_r($detailArr);
$fIDArr = array_keys($detailArr);
$fIDStr = implode(",", $fIDArr);
$aU = new agentUser();
$aUserArr = $aU->agentUserBasic("fID,name,pID", "fID in ($fIDStr)");

//echo "<pre>";
//print_r($extraArr);
$tableHead = array(
    "num" => "序号",
    "city" => "城市",
    "soInsID" => "社保账户",
    "unitName" => "单位",
    "name" => "姓名",
    "pID" => "身份证号码",
    "mobilePhone" => "电话",
    "sID" => "社保号",
    'radix' => "基数",
    'pension' => "养老",
    'hospitalization' => "医疗",
    'employmentInjury' => "工伤",
    'unemployment' => "失业",
    'hand' => "利手",
    "insuranceListStatus" => "社保状态",
    "spRemarks" => "",
    "remarks" => "备注",
    "sponsorName" => "提交人",
    "receiverName"=>"签收人",
    "receiveTime" => "签收时间"
);
$i = 0;
foreach ($detailArr as $key => $val) {
    $excelRet[$key] ['num'] = $i + 1;
    $i++;
    foreach ($tableHead as $tk => $tv) {
        switch ($tk) {
            case "name":
            case "pID":
                $excelRet[$key][$tk] = $aUserArr[$val['fID']][$tk];
                break;
            case "pension" :
            case "employmentInjury" :
            case "unemployment" :
            case "PDIns" :
            case "helpCost" :
                if ($val[$tk] == "1") {
                    $excelRet[$key][$tk] = "参加";
                } elseif (!$val[$tk]) {
                    $excelRet[$key][$tk] = "";
                } else {
                    $excelRet[$key][$tk] = "出错了";
                }
                break;
            case "hospitalization" :
                if ($val[$tk] == "1") {
                    $excelRet[$key][$tk] = "一档";
                } elseif ($val[$tk] == "2") {
                    $excelRet[$key][$tk] = "二档";
                } elseif ($val[$tk] == "4") {
                    $excelRet[$key][$tk] = "三档";
                } elseif (!$val[$tk]) {
                    $excelRet[$key][$tk] = "";
                } else {
                    $excelRet[$key][$tk] = "出错了";
                }
                break;
            case "hand" :
                if ($val[$tk] == "1") {
                    $excelRet[$key][$tk] = "右手";
                } elseif ($val[$tk] == "2") {
                    $excelRet[$key][$tk] = "左手";
                }
                break;
            default:
                $excelRet[$key][$tk] = $val[$tk];
                break;
        }

    }
}
$aU->agentUserArr = $excelRet;
$excelRet = $aU->agentUserRecreate();
//echo "<pre>";
//print_r($excelRet);

$excelTitle = $soInsModifyDate . "社保清单";
if (isset ($_POST ['intoExcel'])) {
    #保存为EXCEL
//    print_r($excelRet);
    if (!$excelRet)
        exit ("<script> alert('无数据导出') </script>");
    else {
        $thArr [] = $tableHead;
        $excelRet = array_merge($thArr, $excelRet);
    }


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
$smarty->assign("detailArr", $excelRet);
#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("agent/soInsListDetail.tpl");