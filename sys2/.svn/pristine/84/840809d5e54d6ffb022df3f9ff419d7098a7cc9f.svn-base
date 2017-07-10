<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 分页
require_once '../class/pagenation.class.php';
require_once '../common.function.php';

$title = "招聘计划管理";


#招聘人员
$sql = "SELECT mID,mName FROM s_user WHERE groupID  REGEXP '4,' and status<>0";
$ret = $pdo->query($sql);
if($ret)
{
	$result = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $v)
	{
		$recruiter_opt[$v['mID']] = $v['mName'];
	}
}

if($_GET['sp'])
{
	$sql = "SELECT id,name,createdBy,createdOn,mName,requires,leader,member,market,period_s,period_e FROM a_recruitplan r LEFT JOIN s_user u ON r.createdBy = u.mID WHERE 1=1 ";
	
	$planName = $_GET['pn'];
	$createdBy = $_GET['cb'];
	$createdOn = $_GET['co'];
	if($planName)
		$sql .= " and r.name like '".$planName."' ";
	if($createdBy)
		$sql .= " and r.createdBy = ".$createdBy;
	if($createdOn)
		$sql .= " and r.createdOn = '".$createdOn."' ";
		
	$ret = $pdo->query($sql);
	if($ret)
	{
		$plans = $ret->fetchAll(PDO::FETCH_ASSOC);
	}
}
else 
{
	$sql = "SELECT id,name,createdBy,createdOn,mName,requires,leader,member,market,period_s,period_e FROM a_recruitplan r LEFT JOIN s_user u ON r.createdBy = u.mID";

	$page = new Pagination();
	$page->page = $_GET['page'];
	$page->form_mothod = "get";
	$page->pagesize = 20;
	

	$page->count = $pdo->query($sql)->rowCount();

	$sql .= $page->get_limit();

	$ret = $pdo->query($sql);
	if($ret)
	{
		$plans = $ret->fetchAll(PDO::FETCH_ASSOC);
		foreach($plans as $num => $plan)
		{
			foreach($plan as $k => $v)
			{
				if($k == "requires")
				{
					$plans[ $num ][$k] = idtoname($pdo,"require", $v);
				}
				elseif ( $k == "leader" || $k == "member" )
				{
					$plans[ $num ][$k] = idtoname($pdo,"user",$v);
				}
				elseif ( $k == "market")
				{
					$plans[$num][$k] = idtoname($pdo, "market", $v);
				}
			}
		}
	}
	$pageList = $page->page_list ( $_SERVER ['PHP_SELF'] . "?"  );//输出分页按扭get 方式

}

$smarty->assign("plans",$plans);
$smarty->assign("pageList",$pageList);
$smarty->assign("recruiter_opt",$recruiter_opt);

$smarty->assign("pn_s",$planName);
$smarty->assign("cb_s",$createdBy);
$smarty->assign("co_s",$createdOn);

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/planManage.tpl");

?>