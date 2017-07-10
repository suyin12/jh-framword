<?php
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';

require_once '../common.function.php';

$title = "工作管理";

$current_user = $_SESSION['exp_user']['mID'];
$current_date = date('Y-m-d');


		// 先查询所有市场的列表
		
		$sql = "SELECT marketID,name FROM a_market where active = '1'";
		$pdostmt = $pdo->query($sql);
		
		if($pdostmt)
		{
			$ret = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($ret as $v)
			{
				$markets[$v['marketID']] = array($v['name'] => "");
			}
		}


		
		// 查询所有招聘组用户
		$sql = "SELECT mID,mName FROM s_user WHERE groupID REGEXP '4,'";
		$ret = $pdo->query($sql);
		
		if($ret)
		{
			$result = $ret->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($result as $v)
			{
				$users[$v['mID']] = array($v['mName'] => "");
			}
		}
		
		
		//  直接查看本周和下周的所有市场的安排，构造URL
		
		$all_markets = getMarkets($pdo,1);
		foreach($all_markets as $k => $v)
		{
			$all_markets_URL .= "markets[]=".$k."&";
		}
		$today_w = date('N');
		$week_start = time() - ($today_w-1)*24*60*60;
		$fdayOfThisWeek = date("Y-m-d",strtotime(date("Y-m-d",$week_start)));
		$fdayOfNextWeek = date("Y-m-d",strtotime(date("Y-m-d",$week_start)) + 7*24*60*60 );
		$edayOfThisWeek = date("Y-m-d",strtotime(date("Y-m-d",$week_start)) + 6*24*60*60);
		$edayOfNextWeek = date("Y-m-d",strtotime(date("Y-m-d",$week_start)) + 13*24*60*60 ); 
		$cwURL = "drDisplay.php?".$all_markets_URL."&date_from=".$fdayOfThisWeek."&date_to=".$edayOfThisWeek;
		$nwURL = "drDisplay.php?".$all_markets_URL."&date_from=".$fdayOfNextWeek."&date_to=".$edayOfNextWeek;
		
		
		
		$smarty->assign("markets",$markets);
		$smarty->assign("users",$users);
		$smarty->assign("next_four_weeks",$next_four_weeks);
		$smarty->assign("cwURL",$cwURL);
		$smarty->assign("nwURL",$nwURL);
		

		
		$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
		$smarty->display("recruitManage/drManage.tpl");
?>