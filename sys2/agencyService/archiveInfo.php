<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 分页
require_once '../class/pagenation.class.php';

require_once 'constantConfig.php';
require_once '../dataFunction/unit.data.php';
require_once '../common.function.php';

$c_type_opt = array(1 => "派遣员工", 2 => "代理员工", 3 => "个人代理", 4 => "增值服务");
$huzheng_type = array("1" => "深户档案托管", "2" => "招工", "3" => "调工", "4" => "招干", "5" => "调干");

// 客户经理
$sql = "SELECT mID,mName FROM s_user  WHERE roleID REGEXP '2_1,'";
$ret = $pdo->query($sql);
if ($ret) {
    $result = $ret->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $v) {
        $managers[$v['mID']] = $v['mName'];
    }
}


$id = $_GET['id'];
if (!$id)
    sys_error($smarty, "URL缺少参数");

$sql = "select * from a_archive where id = " . $id;
$ret = $pdo->query($sql);
$rows = $ret->rowCount();
if (!$rows)
    sys_error($smarty, "参数错误");
else
    $the_archive = $ret->fetch(PDO::FETCH_ASSOC);


$smarty->assign("the_archive", $the_archive);

$smarty->assign("c_sex", $c_sex);
$smarty->assign("yesno", array(1 => "是", 2 => "否"));
$smarty->assign("c_type_opt", $c_type_opt);
$smarty->assign("managers", $managers);
$smarty->assign("huzheng_type", $huzheng_type);

$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));

$smarty->display("agencyService/archiveInfo.tpl");