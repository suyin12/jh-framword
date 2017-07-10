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

$title = "更新人才信息";
$talentID = $_GET ['tid'];

if (!$talentID) {
    sys_error($smarty, "参数错误");
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
$e->marketBasic("`marketID`,`name`", " active=1 ");
$marketArr = $e->marketArr;
#招聘人员信息
$f = new user ();
$f->pdo = $pdo;
$f->userBasic("`mID`,`mName`", " roleID  REGEXP '4_1,' and status='1' ");
$userArr = $f->userArr;

// 操作人和更新日期
$current_user = $_SESSION ['exp_user'] ['mID'];
$current_user_name = $_SESSION ['exp_user'] ['mName'];
$current_date = date('Y-m-d');

// education value and name array 
$edu_value = array(
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8
);
$edu_label = array(
    "博士",
    "硕士",
    "本科",
    "大专",
    "高中",
    "中专",
    "初中",
    "小学"
);

// sex value and name array
$sex_value = array(
    1,
    2
);
$sex_label = array(
    "男",
    "女"
);

#获取符合条件的人才,即合格状态以上的人员
$a = new talent ();
$a->pdo = $pdo;
$a->talentBasic(" * ", "talentID = " . $talentID);
$a->classLinkClass();
#各应聘人员的信息
$a->talentInfoArr();
$ret = $a->ret;
$talent = $ret [$talentID];
#各岗位对应的培训流程
$positionArr [$talent ['positionID']] = $d->positionArr [$talent ['positionID']];
$a->x->b->positionArr = $positionArr;
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
$b = new tInfoStatus ();
$b->pdo = $pdo;
$b->ret = $ret;
//培训通过数组(对应不同$s_status)
$b->statusArr = $ret;
//通知及回访备注信息
$recruitNotesArr = $b->recruitNotesArr();
$recruitMarksArr = $b->recruitMarksArr("8,99");
foreach ($recruitMarksArr as $rkey => $rval) {
    $newRecruitMarksArr [$rval ['talentID']] [] = $rval;
}
$trainMarksArr = $b->recruitMarksArr("7");
foreach ($trainMarksArr as $rkey => $rval) {
    $newTrainMarksArr [$rval ['talentID']] [] = $rval;
}



#变量配置
$smarty->assign(array("talent" => $talent, "web_workerArr" => $web_workerArr));
$smarty->assign(array(
    "unitPositionArr" => $unitPositionArr,
    "j_unitPositionArr" => $j_unitPositionArr,
    "marketArr" => $marketArr
));
$smarty->assign(array(
    "userArr" => $userArr,
    "statusArr" => $statusArr,
    "statusToCHNArr" => $statusToCHNArr,
    "s_status" => $s_status,
    "needTrainArr" => $needTrainArr,
    "needMaterialArr" => $needMaterialArr,
    "needWaitArr" => $needWaitArr
));
$smarty->assign(array(
    "recruitNotesArr" => $recruitNotesArr,
    "newRecruitMarksArr" => $newRecruitMarksArr,
    "newTrainMarksArr" => $newTrainMarksArr
));
$smarty->assign("recruitManagers", $recruitManagers);
$smarty->assign("recruitManager_selected", $talent ['recruitManagerId']);

$smarty->assign("current_user", $current_user);
$smarty->assign("current_user_name", $current_user_name);
$smarty->assign("current_date", $current_date);

$smarty->assign("units", $units);
$smarty->assign("edu_value", $edu_value);
$smarty->assign("edu_label", $edu_label);
$smarty->assign("sex_value", $sex_value);
$smarty->assign("sex_label", $sex_label);

$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath,
    "webHttpPath"=>webHttpPath
));
$smarty->display("recruitManage/tUpdate.tpl");

?>