<?php
/*
*       2012-8-14
*
*    <<< 员工不同状态下对应的操作办理   >>>
*       create by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/
# 页面访问权限
require_once '../auth.php';
# 连接模板文件
require_once sysPath . 'templateConfig.php';
# 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'dataFunction/unit.data.php';
require_once sysPath . 'common.function.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';
#连接临时数据处理类
require_once sysPath .'dataFunction/tempAction.data.php';
#标题
$title = "人才状态流程";
#配置查询条件
$s_status = $_GET ['status'];
if (!$s_status && !isset ($_GET ['wS']))
    header("location:" . httpPath . "recruitManage/tInfoStatus.php?status=3");
$model = array(
    "name" => "姓名",
    "talentID" => "人才库编号",
    "idCard" => "身份证",
    "telephone" => "电话",
    "createdOnPre" => "创建日期(前)",
    "createdOnNext" => "创建日期(后)"
);
$orderArr = array(
    "lastModifyTime" => "操作时间",
    "createdOn" => "创建日期",
    "createdBy" => "创建人",
    "d_material" => "资料齐备"
);
#配置单位和岗位二级联动
$d = new position ();
$d->pdo = $pdo;
$d->positionBasic("`positionID`,`lastPositionID`,`name`,`unitId` as `unitID`,`shortcut`,`reexamineProcedureID`,`trainProcedureID`,`materialProcedureID`,`waitProcedureID`", " active=1 order by shortcut");
$d->classLinkClass();
$positionArr = $d->positionArr;
$unitPositionArr = $d->unitPosition();
$j_unitPositionArr = json_encode($unitPositionArr);
#获取对应岗位的相关复试流程
//重置positionArr 使已失效的岗位可继续调入流程
$d->positionBasic("`positionID`,`reexamineProcedureID`,`trainProcedureID`,`materialProcedureID`,`waitProcedureID`", " 1=1");
$d->recruitProcedurer("1");
$d->thisProcedurer = $s_status;
$preOrNextProcedurerArr = $d->preOrNextProcedurer();

#市场相关信息
$e = new market ();
$e->pdo = $pdo;
$e->marketBasic("`marketID`,`name`", " active=1 ");
$marketArr = $e->marketArr;
if (isset ($_GET ['wS'])) {
    #查询条件
    foreach ($_GET as $k => $v) {
        switch ($k) {
            case "order" :
                $talentConStr_3 = " order by " . $v . " desc";
                $smarty->assign("s_" . $k, $v);
                break;
            case "m" :
                if ($v == "createdOnPre")
                    $talentConStr_1 = "  `createdOn`<='" . $_GET ['c'] . "'";
                elseif ($v == "createdOnNext")
                    $talentConStr_1 = "  `createdOn`>='" . $_GET ['c'] . "'";
                else
                    $talentConStr_1 = " `" . $v . "` like '%" . $_GET ['c'] . "%'";
                $smarty->assign("s_" . $k, $v);
                break;
            case "c" :
                $smarty->assign("s_" . $k, $v);
                break;
            case "positionID" :
                if ($v) {
                    if ($positionArr [$v] ['lastPositionID'])
                        $v = rtrim($v . $positionArr [$v] ['lastPositionID'], ",");
                    $talentConStr_2 .= " and `" . $k . "` in (" . $v . ")";
                    $smarty->assign("s_" . $k, $v);
                }
                break;
            case "wS" :
            case "status" :
                break;
            default :
                if ($v) {
                    $talentConStr_2 .= " and `" . $k . "`='" . $v . "'";
                    $smarty->assign("s_" . $k, $v);
                }
                break;
        }
    }
    $talentConStr = $talentConStr_1 . $talentConStr_2 . $talentConStr_3;
}
else {
    $talentConStr = " `status`='$s_status'  order by createdOn desc";
}
#获取符合条件的人才,即合格状态以上的人员
//todo
$talentConStr .= " limit 100";
$a = new talent ();
$a->pdo = $pdo;
$a->talentBasic("`talentID`,`name`,`status`,`positionID`,`idCard` as pID,`unitID`,`recruitManagerId`,`telephone`,`sex`,`education`,`marketID`,`createdOn`,`lisence`,`wantedArea`,`d_material`,`remarks`", $talentConStr);
$a->classLinkClass();
#各应聘人员的信息
$a->talentInfoArr();

#获取系统用户信息
$userArr = $a->x->d->userBasic("`mID`,`mName`", " 1=1 ");
#各岗位对应的培训流程
$a->x->b->positionArr = $d->positionArr;
$a->x->b->x = $a->x;
$a->x->b->recruitProcedurer('2');
$a->x->b->needTrain('2');
$needTrainArr = $a->x->b->needTrainArr;
#各岗位对应的需要的待岗流程
$a->x->b->recruitProcedurer('3');
$a->x->b->needTrain('3');
$needWaitArr = $a->x->b->needTrainArr;
#各岗位对应的需要交的资料
$a->x->b->recruitProcedurer('4');
$a->x->b->needTrain('4');
$needMaterialArr = $a->x->b->needTrainArr;
#按人才当前状态分类
$ret = $a->ret;
$b = new tInfoStatus ();
$b->pdo = $pdo;
$b->ret = $ret;
$statusArr = array(
    "3",
    "4",
    "9",
    "5",
    "6",
    "7",
    "8",
    "98",
    "97",
    "99"
);
foreach ($statusArr as $val) {
    $arr [$val] = $b->tInfoStatusArr($val);
}
//通知及回访备注信息
$recruitNotesArr = $b->recruitNotesArr();
//成绩通过数组(对应不同$s_status)
$b->statusArr = $arr [$s_status];
if ($s_status == "8" || $s_status == "99") {
    //待岗 和 合同签订状态公用交资料情况记录
    $recruitMarksArr = $b->recruitMarksArr("8,99");
}
else {
    $recruitMarksArr = $b->recruitMarksArr($s_status);
}
foreach ($recruitMarksArr as $rkey => $rval) {
    $newRecruitMarksArr [$rval ['talentID']] [] = $rval;
}

#获取招聘相关信息设置数组
$c = new recruitInfoSet ();
$c->pdo = $pdo;
$c->recruitInfoSetBasic();
$statusToCHNArr = $c->recruitInfoSetArr ['reexamineArr'];
//当前招聘状态的通过情况
$procedurerStatusArr = $c->recruitInfoSetArr ['procedurerStatusArr'];
//备注设置数组
$recruitRemarksArr = $c->recruitInfoSetArr ['recruitRemarksArr'];
//意向区域配置数组
$wantedAreaArr = $c->recruitInfoSetArr ['wantedAreaArr'];

#下载人员名单
if ($_POST ['downloadExcel']) {
    #保存为EXCEL
    $tableHead = array(
        "talentID" => "人才库编号",
        "name" => "姓名",
        "telephone" => "电话",
        "unitName" => "单位",
        "positionName" => "岗位",
        "lisence" => "驾照",
        "sexName" => "性别",
        "educationName" => "学历",
        "pID" => "身份证",
        "statusName" => "状态",
        "wantedArea" => "意向区域",
        "marketName" => "市场",
        "mName" => "招聘人",
        "createdOn" => "招聘时间"
    );
    $excelTitle = $statusToCHNArr [$s_status] ['name'] . "人员名单";
    $thArr [] = $tableHead;
    if ($arr [$s_status])
        $excelRet = array_merge($thArr, $arr [$s_status]);
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
    unset($op);
    exit();
}
#判断员工是否填写情况表
$talentIDStr = rtrim(implode(",", array_keys($arr[$s_status])), ",");
$w = new  web_worker();
$w->pdo = $pdo;
$w->classLinkClass();
$web_workerBasicArr = $w->web_workerBasic("`talentID`,`wID`,`infoConfirm`", "`talentID` in ($talentIDStr)");
$web_wInfo_extraArr = $w->web_wInfo_extraArr(" `wID` ");
$web_workerBasicArr = keyArray($web_workerBasicArr, "talentID");

#获取临时处理数据
$temp = new tempAction();
$temp->tempBasic(" ID,whichID,value");
$tempJsonArr = $temp->tempExtraArr();
#变量配置
$smarty->assign(array(
    "model" => $model,
    "unitPositionArr" => $unitPositionArr,
    "j_unitPositionArr" => $j_unitPositionArr,
    "marketArr" => $marketArr,
    "orderArr" => $orderArr,
    "queryString" => preg_replace("/[?|&]status=[^\\s&#]*/", "", "&" . $_SERVER ['QUERY_STRING'])
));
$smarty->assign(array(
    "userArr" => $userArr,
    "statusArr" => $statusArr,
    "statusToCHNArr" => $statusToCHNArr,
    "s_status" => $s_status,
    "recruitRemarksArr" => $recruitRemarksArr,
    "procedurerStatusArr" => $procedurerStatusArr,
    "preOrNextProcedurerArr" => $preOrNextProcedurerArr,
    "needTrainArr" => $needTrainArr,
    "needMaterialArr" => $needMaterialArr,
    "needWaitArr" => $needWaitArr,
    "wantedAreaArr" => $wantedAreaArr,
    "s_procedurerStatusArr" => $s_procedurerStatusArr
));
$smarty->assign(array("web_workerBasicArr" => $web_workerBasicArr, "web_wInfo_extraArr" => $web_wInfo_extraArr));
$smarty->assign(array(
    "recruitNotesArr" => $recruitNotesArr,
    "newRecruitMarksArr" => $newRecruitMarksArr
));
$smarty->assign("arr", $arr);
#临时数据配置
$smarty->assign("tempJsonArr",$tempJsonArr);
# 模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("recruitManage/tInfoStatus.tpl");
?>