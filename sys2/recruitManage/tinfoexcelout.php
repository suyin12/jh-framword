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

$talents_arr = $_POST['talents'];
$talent_num = count($talents_arr);
if (!$talents_arr)
    sys_error($smarty, "您未选择任何人员，无法操作");
else {
    $talent_str = implode(",", $talents_arr);
    $sql = "SELECT t.talentID,t.name as t_name,t.idCard as pID,t.sex,t.unitID,
			t.education,t.major,t.telephone as t_telephone,t.positionID,t.wantedArea,
			t.recruitManagerId,t.status,t.marketID,t.lisence,
			t.remarks,t.createdBy,t.createdOn,t.d_material,t.d_train,t.d_commit
			FROM a_talent t WHERE   t.talentID in (" . $talent_str . ")";
    $ret = $pdo->query($sql);
    $talents = $ret->fetchAll(PDO::FETCH_ASSOC);
    #获取符合条件的人才,即合格状态以上的人员
    $a = new talent ();
    $a->pdo = $pdo;
    $a->classLinkClass();
    $a->ret = keyArray($talents, "talentID");
    #各应聘人员的信息
    $talents = $a->talentInfoArr();
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
?>