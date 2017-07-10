<?php
# 配置文件 数据库和pdo smarty初始化等
require_once ('../auth.php');
require_once ('../templateConfig.php');
require_once ('../class/pagenation.class.php');
require_once sysPath . 'dataFunction/unit.data.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';

#标题
$title = "人才管理";
#查询条件
$model = array(
    "name" => "姓名",
    "talentID" => "人才库编号",
    "idCard" => "身份证",
    "telephone" => "电话",
    "createdOnPre" => "创建日期(前)",
    "createdOnNext" => "创建日期(后)"
);
$orderArr = array(
    "createdOn" => "创建日期",
    "lastModifyTime" => "操作时间",
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
#市场相关信息
$e = new market ();
$e->pdo = $pdo;
$e->marketBasic("`marketID`,`name`");
$marketArr = $e->marketArr;

$sql = "SELECT t.talentID,t.name as t_name,t.idCard as pID,t.sex,t.unitID,
			t.education,t.major,t.telephone as t_telephone,t.positionID,t.wantedArea,
			t.recruitManagerId,t.status,t.marketID,t.lisence,
			t.remarks,t.createdBy,t.createdOn,t.d_material,t.d_train,t.d_commit
			FROM a_talent t WHERE  ";

if (isset ($_GET ['wS'])) {

    #查询条件
    foreach ($_GET as $k => $v) {
        switch ($k) {
            case "order" :
                $talentConStr_3 = " order by t." . $v . " desc";
                $smarty->assign("s_" . $k, $v);
                break;
            case "m" :
                if ($v == "createdOnPre")
                    $talentConStr_1 = "  t.`createdOn`<='" . $_GET ['c'] . "'";
                elseif ($v == "createdOnNext")
                    $talentConStr_1 = "  t.`createdOn`>='" . $_GET ['c'] . "'";
                else
                    $talentConStr_1 = " t.`" . $v . "` like '%" . $_GET ['c'] . "%'";
                $smarty->assign("s_" . $k, $v);
                break;
            case "c" :
                $smarty->assign("s_" . $k, $v);
                break;
            case "positionID" :
                if ($v) {
                    if ($positionArr [$v] ['lastPositionID'])
                        $v = rtrim($v . $positionArr [$v] ['lastPositionID'], ",");
                    $talentConStr_2 .= " and t.`" . $k . "` in (" . $v . ")";
                    $smarty->assign("s_" . $k, $v);
                }
                break;
            case "wS" :
            case "allTalentChk":
            case "status" :
            case "page" :
                break;
            default :
                if ($v) {
                    $talentConStr_2 .= " and t.`" . $k . "`='" . $v . "'";
                    $smarty->assign("s_" . $k, $v);
                }
                break;
        }
    }
    $talentConStr = $talentConStr_1 . $talentConStr_2 . $talentConStr_3;
}
else {
    $talentConStr = " 1=1 order by t.createdOn desc";
}
$sql .= $talentConStr;
$ret = $pdo->query($sql);
if ($ret) {
    $talents = $ret->fetchAll(PDO::FETCH_ASSOC);
}
#获取符合条件的人才,即合格状态以上的人员
$a = new talent ();
$a->pdo = $pdo;
$a->classLinkClass();
$a->ret = keyArray($talents, "talentID");
#各应聘人员的信息
$talents = $a->talentInfoArr();


#导出
if ($_POST ['excelout']) {
    #保存为EXCEL
    $tableHead = array(
        "talentID" => "人才库编号",
        "t_name" => "姓名",
        "t_telephone" => "电话",
        "unitName" => "单位",
        "positionName" => "岗位",
        "lisence" => "驾照",
        "sexName" => "性别",
        "educationName" => "学历",
        "pID" => "身份证",
        "statusName" => "状态",
        "wantedArea" => "意向区域",
        "marketName"=>"市场",
        "mName" => "招聘人",
        "createdOn" => "招聘时间"
    );
    $excelTitle =  "人员名单";
    $thArr [] = $tableHead;
    if ($talents)
        $excelRet = array_merge($thArr, $talents);
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
}
#分页
$page = new Pagination ();
$page->page = $_GET ['page'];
$page->form_mothod = "get";
$page->pagesize = 20;

$page->count = $pdo->query($sql)->rowCount();

$sql .= $page->get_limit(); //分页条件查询


$ret = $pdo->query($sql);
if ($ret)
    $talents = $ret->fetchAll(PDO::FETCH_ASSOC);

$pageList = $page->page_list($_SERVER ['PHP_SELF'] . "?"); //输出分页按扭get 方式


if ($_SERVER ['QUERY_STRING'])
    $pageList = $page->page_list("http://" . $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ["SERVER_PORT"] . preg_replace("/&page=[0-9]*/", "", $_SERVER ["REQUEST_URI"])); //输出分页按扭get 方式
else
    $pageList = $page->page_list("http://" . $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ["SERVER_PORT"] . $_SERVER ["REQUEST_URI"] . "?"); //输出分页按扭get 方式


#
$a->ret = keyArray($talents, "talentID");
#各应聘人员的信息
$talents = $a->talentInfoArr();
#获取系统用户信息
$userArr = $a->x->d->userBasic("`mID`,`mName`", " 1=1 ");
#按人才当前状态分类
$ret = $a->ret;
$b = new tInfoStatus ();
$b->pdo = $pdo;
$b->ret = $ret;
$b->tInfoStatusArr(null);
//通知及回访备注信息
$recruitNotesArr = $b->recruitNotesArr();
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

#判断员工是否填写情况表
$talentIDStr=rtrim(implode(",",array_keys($talents)),",");
$w = new  web_worker();
$w->pdo = $pdo;
$w->classLinkClass();
$web_workerBasicArr=$w->web_workerBasic("`talentID`,`wID`,`infoConfirm`", "`talentID` in ($talentIDStr)");
$web_wInfo_extraArr = $w->web_wInfo_extraArr(" `wID` ");
$web_workerBasicArr=keyArray($web_workerBasicArr,"talentID");
#变量配置
$smarty->assign(array(
    "model" => $model,
    "unitPositionArr" => $unitPositionArr,
    "j_unitPositionArr" => $j_unitPositionArr,
    "marketArr" => $marketArr,
    "orderArr" => $orderArr,
    "queryString" => $_SERVER ['QUERY_STRING']
));
$smarty->assign("talents", $talents);
$smarty->assign(array(
    "userArr" => $userArr,
    "statusArr" => $statusArr,
    "statusToCHNArr" => $statusToCHNArr,
    "s_status" => $s_status,
    "recruitRemarksArr" => $recruitRemarksArr,
    "procedurerStatusArr" => $procedurerStatusArr,
    "needTrainArr" => $needTrainArr,
    "needMaterialArr" => $needMaterialArr,
    "needWaitArr" => $needWaitArr,
    "wantedAreaArr" => $wantedAreaArr,
    "s_procedurerStatusArr" => $s_procedurerStatusArr
));
$smarty->assign(array(
    "recruitNotesArr" => $recruitNotesArr,
    "newRecruitMarksArr" => $newRecruitMarksArr
));
$smarty->assign("arr", $arr);
#分页

$smarty->assign("page", $_GET ['page']);
$smarty->assign("pageList", $pageList);
$smarty->assign("wInfo", $wInfo);
$smarty->assign(array("web_workerBasicArr"=>$web_workerBasicArr,"web_wInfo_extraArr"=>$web_wInfo_extraArr));
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display('recruitManage/tInfo.tpl');

?>
