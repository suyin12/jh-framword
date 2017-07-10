<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 常量参数
require_once 'constantConfig.php';


$title = "居住证办理";

$id = $_GET['id'];
if(!$id)
{
	sys_error($smarty, "参数错误");
}

$sql = "select * from a_papers where id = ".$id;
$ret = $pdo->query($sql);
$rows = $ret->rowCount();
if(!$rows)
{
	sys_error($smarty, "参数错误");
}

$the_paper = $ret->fetch(PDO::FETCH_ASSOC);

$smarty->assign("the_paper",$the_paper);


$smarty->assign("c_sex",$c_sex);
$smarty->assign("c_nation",$c_nation);
$smarty->assign("c_marriage",$c_marriage);
$smarty->assign("c_hukouAddressType",$c_hukouAddressType);
$smarty->assign("c_education",$c_education);
$smarty->assign("c_title",$c_title);
$smarty->assign("c_politics",$c_politics);
$smarty->assign("c_employmentType",$c_employmentType);
$smarty->assign("c_skillLevel",$c_skillLevel);
$smarty->assign("c_houseType",$c_houseType);
$smarty->assign("c_residentialType",$c_residentialType);
$smarty->assign("c_planBirthReport",$c_planBirthReport);
$smarty->assign("c_comereason",$c_comereason);
$smarty->assign("c_firstApp",$c_firstApp);

//$smarty->debugging = true;

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("agencyService/rCardupdate.tpl");

?>