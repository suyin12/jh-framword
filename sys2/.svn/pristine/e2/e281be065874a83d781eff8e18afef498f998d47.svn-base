<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
//分页类
require_once '../class/pagenation.class.php';
require_once '../common.function.php';

$title = "市场评估";

#招聘人员
$sql = "SELECT mID,mName FROM s_user WHERE groupID REGEXP '4'";
$ret = $pdo->query($sql);

if($ret)
{
	$result = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $v)
	{
		$recruiter_opt[$v['mID']] = $v['mName'];
	}
}

if(isset($_GET['searchassess']))
{
	$sql = "SELECT m.*,u.mName,p.name FROM a_marketassess m LEFT JOIN s_user u on m.createdBy = u.mID 
			left join a_position p on m.position = p.positionID WHERE 1=1 ";
		
	$subject = $_GET['subject'];
	$createdBy = $_GET['createdBy'];
	$createdOn = $_GET['createdOn'];
	
	if($subject)
		$sql .= "and m.subject like '".$subject."' ";
	if($createdBy)
		$sql .= "and m.createdBy = ".$createdBy." ";
	if($createdOn)
		$sql .= "and m.createdOn = '".$createdOn."' ";
		
	$ret = $pdo->query($sql);
	if($ret)
	{
		$assesses = $ret->fetchAll(PDO::FETCH_ASSOC);
		foreach($assesses as $num => $assess)
		{
			foreach($assess as $k => $v)
			{
				if($k == "proper" || $k == "improper" || $k == "increase")
				{
					$assesses [ $num ][ $k ] = idtoname($pdo, "market", $v);
				}
			}
		}

	}
	
}
else
{
	$sql = "SELECT m.*,u.mName,p.name FROM a_marketassess m LEFT JOIN s_user u on m.createdBy = u.mID  
			left join a_position p on m.position = p.positionID WHERE 1=1 ";
	
	$page = new Pagination();
	$page->page = $_GET['page'];
	$page->form_mothod = "get";
	$page->pagesize = 20;
	$page->count = $pdo->query($sql)->rowCount();
	
	$sql .= $page->get_limit(); //分页条件查询
	
	$ret = $pdo->query($sql);
	if($ret)
	{
		$assesses = $ret->fetchAll(PDO::FETCH_ASSOC);
		foreach($assesses as $num => $assess)
		{
			foreach($assess as $k => $v)
			{
				if($k == "proper" || $k == "improper" || $k == "increase")
				{
					$assesses [ $num ][ $k ] = idtoname($pdo, "market", $v);
				}
			}
		}
	}
	
	$pageList = $page->page_list ( $_SERVER ['PHP_SELF'] . "?"  );//输出分页按扭get 方式
}

$smarty->assign("assesses",$assesses);
$smarty->assign("recruiter_opt",$recruiter_opt);
// 保存默认选中的值
$smarty->assign("subject_s",$subject);
$smarty->assign("recruiter_s",$createdBy);
$smarty->assign("createdOn_s",$createdOn);

$smarty->assign("pageList",$pageList);

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/marketAssess.tpl");

?>