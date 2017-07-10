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


$title = "缴费";


$current_user = $_SESSION['exp_user']['mID'];
$current_date = date('Y-m-d');
$current_time = date('Y-m-d H:i:s');

/*
 * paytype 用来表示那个项目的缴费记录
 * 1 - 档案管理
 * 2 - 个人社保代理 
 */
$paytype = $_GET['ptype'];
		
		
if($paytype == 1)
{

		$id = $_GET['id'];
		
		$sql = "select a.id as userid ,a.name,a.sex,a.idcard,a.wtype as wtype,b.* from a_archive a left join a_agencypaymenthistory b 
				on a.id = b.userid and b.paytype = 1 where a.id = ".$id ;
		$ret = $pdo->query($sql);
		if(!$ret)
		{
			sys_error($smarty,"参数错误");
		}

		$the_archive = $ret->fetchAll(PDO::FETCH_ASSOC);

		$type = $the_archive[0]['wtype'];
		if($type == 1)
		{
			sys_error($smarty,"派遣员工无需缴费");
		}
		
		$smarty->assign("the_archive",$the_archive);
		$smarty->assign("current_date",$current_date);
		$smarty->assign("userid",$id);
		$smarty->assign("paytype",$paytype);
		




}

if($paytype == 2)
{

		$id = $_GET['id'];
		$sql = "select * from a_soinsagency a left join a_agencypaymenthistory b on a.id = b.userid and b.paytype = 1  where a.id = ".$id;
	
		$ret = $pdo->query($sql);
		if(!$ret)
		{
			sys_error($smarty,"参数错误");
		}
		$the_soinsagency = $ret->fetchAll(PDO::FETCH_ASSOC);
				
		$smarty->assign("the_soinsagency",$the_soinsagency);
		$smarty->assign("current_date",$current_date);
		
		$smarty->assign("userid",$id);
		$smarty->assign("paytype",$paytype);

		
		
}

		$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
		$smarty->display("agencyService/agencydopayment.tpl");

?>