<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../common.function.php';
#分页类
require_once '../class/pagenation.class.php';

$unit_arr = $_GET['unit'];
$unit_num = count($unit_arr);
$mID = $_GET['st'];
if (!$unit_arr && !$mID) {
    sys_error($smarty, "未选择任何记录");
}
$unit_str = implode(",", $unit_arr);
if ($mID) {
    $sql = "select `unitID` from `s_user` where mID=:mID";
    $ret = SQL($pdo, $sql, array(":mID" => $mID), "one");
    $unit_str = rtrim($ret['unitID'], ",");
}
$sql = "SELECT unitID from `a_talent` where unitID in (" . $unit_str . ")";
$ret = $pdo->query($sql);
$rows = $ret->rowCount();
if (!$rows) {
    sys_error($smarty, "该单位没有待岗人员需要处理");
}


$allunits = getUnits($pdo);
$title = "待岗人员名单";



#查找方式的选项
//$col_opt = array("t.name"=>"姓名","t.idCard"=>"身份证","un.unitName"=>"单位","p.name"=>"岗位");
$col_opt = array("t.name" => "姓名", "t.idCard" => "身份证", "p.name" => "岗位");

#交资料情况选项
$ismaterial_opt = array(1 => "无", 2 => "户口本", 3 => "计生证", 4 => "体检表", 5 => "户口本,计生证", 6 => "户口本,体检表", 7 => "计生证,体检表", 8 => "户口本,计生证,体检表");

#培训，证明人，交资料到市局的选项 - 是，否
$istrain_opt = $isreference_opt = $iscommit_opt = array(1 => "是", 2 => "否");

#排序的列的选项
$sort_opt = array("name" => "按姓名", "unitRemarks" => "按单位", "idCard" => "按身份证", "posRemarks" => "按岗位",
    "d_material" => "按资料递交情况", "d_train" => "按是否培训", "d_reference" => "按是否见证明人", "d_commit" => "按是否递交资料到单位",
    "lastModifyTime" => "按最后一次修改日期", "lastModifiedBy" => "按最后一次修改人员", "remarksA" => "备注1", "remarksB" => "备注2");

$sort_ad_opt = array("asc" => "升序", "desc" => "降序");



$column = $_GET['col'];
$content = $_GET['con'];
$is_material = $_GET['material'];
$is_train = $_GET['train'];
$is_reference = $_GET['reference'];
$is_commit = $_GET['commit'];
$sort_column = $_GET['sort'];
$sort_ad = $_GET['sort_ad'];


$sql = "SELECT t.talentID,t.name as t_name,t.idCard,t.sex,un.unitName,
			t.education,t.major,t.telephone as t_telephone,t.positionID,t.unitRemarks,
			t.recruitManagerId,t.status,t.onDuty,t.marketID,t.infoValid,t.material,
			t.remarks,t.createdBy,t.createdOn,t.sign,t.signTime,t.label,t.posRemarks,t.remarksA,t.remarksB,
			t.d_material,t.d_train,t.d_reference,t.d_commit,u3.mName as lastModifiedBy,t.lastModifyTime,
			m.name as m_name,u1.mName as recruitManagerName,u2.mName as sponsorName,
			p.name as p_name,t.marks,t.pass,t.marksRemarks FROM a_talent t
			left join a_market m on t.marketID = m.marketID
			left join s_user u1 on t.recruitManagerId = u1.mID
			left join s_user u2 on t.createdBy = u2.mID
			left join s_user u3 on t.lastModifiedBy = u3.mID
			left join a_position p on t.positionID = p.positionID
			left join a_unitinfo un on p.unitId = un.unitID
			where t.sign = 1 and t.unitID in (" . $unit_str . ") ";
if ($column && $content)
    $sql .= "and " . $column . " like '" . $content . "' ";
if ($is_material)
    $sql .= "and t.d_material = " . $is_material . " ";
if ($is_train)
    $sql .= "and t.d_train = " . $is_train . " ";
if ($is_reference)
    $sql .= "and t.d_reference = " . $is_reference . " ";
if ($is_commit)
    $sql .= "and t.d_commit = " . $is_commit . " ";
if ($sort_column)
    $sql .= "order by t." . $sort_column . " " . $sort_ad;

$mypage = new Pagination (); //使用分页类
$mypage->page = $_GET ['page']; //设置当前页
$mypage->form_mothod = "get";
$pre = $pdo->prepare($sql);
$pre->execute();
$mypage->count = $pre->rowCount(); //获取并设置数据库总记录数
$mypage->pagesize = 20; //每页多少条记录
$sql .= $mypage->get_limit(); //分页条件查询
$res = $pdo->prepare($sql);
$res->execute();
if ($res) {
    $talents = $res->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['QUERY_STRING'])
    $pageList = $mypage->page_list("http://" . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . preg_replace("/&page=[0-9]*/", "", $_SERVER["REQUEST_URI"])); //输出分页按扭get 方式
else
    $pageList = $mypage->page_list("http://" . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"] . "?"); //输出分页按扭get 方式

if ($_POST['excelout']) {

    // 导出数组的键值
    $selFieldArray = array(/* 'talentID', */'t_name', 'idCard', 'sex', 'unitName',
        'education', 'major', 't_telephone', /* 'positionID', 
          'recruitManagerId', 'status', 'onDuty', 'marketID', 'infoValid', 'remarks',
          'createdBy', 'createdOn', 'sign', 'signTime', 'label', */ 'd_material', 'd_train',
        'd_reference', 'd_commit', 'lastModifiedBy', 'lastModifyTime', 'm_name', 'recruitManagerName',
        'sponsorName', 'p_name', 'marks', 'pass', 'marksRemarks');
    require 'talents.excelout.php';
}


//}// END isset($_GET['col'])

$smarty->assign("unit_arr", $unit_arr);
$smarty->assign("talents", $talents);
$smarty->assign("col_opt", $col_opt);
$smarty->assign("sort_opt", $sort_opt);
$smarty->assign("ismaterial_opt", $ismaterial_opt);
$smarty->assign("istrain_opt", $istrain_opt);
$smarty->assign("iscommit_opt", $iscommit_opt);
$smarty->assign("isreference_opt", $isreference_opt);

$smarty->assign("sort_ad_opt", $sort_ad_opt);
$smarty->assign("page", $_GET['page']);
$smarty->assign("pageList", $pageList);
// 保存已经选择的值
$smarty->assign("col_s", $column);
$smarty->assign("con_s", $content);
$smarty->assign("ismaterial_s", $is_material);
$smarty->assign("istrain_s", $is_train);
$smarty->assign("isreference_s", $is_reference);
$smarty->assign("iscommit_s", $is_commit);
$smarty->assign("sort_s", $sort_column);
$smarty->assign("sort_ad_s", $sort_ad);



$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("recruitManage/talentsList2.tpl");
?>