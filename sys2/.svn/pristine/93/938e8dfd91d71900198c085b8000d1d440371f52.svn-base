<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
require_once '../common.function.php';




$id = $_GET['id'];

if(is_numeric($id))
{
	
	$sql = "select id,name,requires,market,leader,member,period_s,period_e from a_recruitplan where id = ".$id;
	$ret = $pdo->query($sql);
	if(!$ret)
	{
		sys_error($smarty, "不存在该计划");
	}
	else 
	{
		$res = $ret->fetch(PDO::FETCH_ASSOC);
		//echo "<pre>";print_r($res);
		$markets_str = $res['market'];
		$users_str = $res['leader'].",".$res['member'];
		$date_from = $res['period_s'];
		$date_to = $res['period_e'];
		
		$markets = explode(",", $markets_str);
		$users = explode(",", $users_str);
	}
}
else 
{
		// 市场，用户的数组，期限，然后算出对应的字符串
		$markets = $_GET['markets'];
		$users = $_GET['users'];
		$cur_week = $_GET['cur_week'];
		$date_from = $_GET['date_from'];
		$date_to = $_GET['date_to'];
}		


		if($markets )
			$markets_str = implode(",",$markets);
		else
			sys_error($smarty,"请选择市场");

/*
 * 		if($users)
			$users_str = implode(",",$users);
		else 
			sys_error($smarty,"请选择人员");
*/
		if($cur_week)
		{
			$today_w = date('N');
			$week_start = time() - ($today_w-1)*24*60*60;
			$date_from = date("Y-m-d",strtotime(date("Y-m-d",$week_start)));
			$date_to = date("Y-m-d",strtotime(date("Y-m-d",$week_start)) + 6*24*60*60); 
			
		}
		else
		{
			if(strtotime($date_from) >= strtotime($date_to))
				sys_error($smarty,"终止日期要大于起始日期");
		}


		$title = "工作管理";

		$current_user = $_SESSION['exp_user']['mID'];		

		$markets_str = $markets_str?$markets_str:0;
//		$users_str = $users_str?$users_str:0;
		/*
		 * 这里改来改去的，是在不想改了，偷懒吧
		 */
	
		
		
		
		if($markets)
		{
			$sql = "SELECT marketID,name FROM a_market WHERE marketID in (".$markets_str.") order by marketID";
		}
		else 
		{
			$sql = "SELECT marketID,name FROM a_market order by marketID";
		}

		$pdostmt = $pdo->query($sql);
		if($pdostmt)
		{
			$ret = $pdostmt->fetchALL(PDO::FETCH_ASSOC);
			
			unset($markets);
			foreach($ret as $value)
			{
					foreach($value as $k=> $v)
					{
						if($k == "marketID")
							$marketID = $v;
						if($k == "name")
							$name = $v;
					}
					$markets[$marketID] = $name;
			}
		}
		
		if($users)
		{
			$sql = "SELECT mID,mName FROM s_user WHERE roleID REGEXP '4_1,' and `status`='1' order by mID";
		}
		else 
		{
			$sql = "SELECT mID,mName FROM s_user WHERE roleID REGEXP '4_1,' and `status`='1' order by mID";
		}
		
		$pdostmt = $pdo->query($sql);
		if($pdostmt)
		{
			$ret = $pdostmt->fetchAll(PDO::FETCH_ASSOC);			
			unset($users);
			foreach($ret as $value)
			{
				foreach($value as $k => $v)
				{
					if($k == "mID"){
						$mID = $v;
						$users_str.=$v.",";
					}					
					if($k == "mName")
						$mName = $v;
				}
				$users[$mID] = $mName;
			}	
			$users_str = rtrim($users_str,",");
		}	
		

		// 计算出本周的日期
		for($i = strtotime($date_from); $i <= strtotime($date_to) ;  $i += 24*60*60)
		{
			$dates[] = date("Y-m-d",$i);
			$dates_head[] = date("m-d(D)",$i);
			/* 这个供直接添加任何人的接口使用 */
			$dir_dates[ date("Y-m-d",$i) ] = date("Y-m-d",$i); 
		}
		$date_num = ($i-strtotime($date_from))/(24*60*60);
		

		/*
		 * 创建空的日招聘安排数组，然后填充有安排的位置 
		 * $ar[$a][$b][$c] = array($d => $e)
		 * $a 市场ID
		 * $b 上下午场 1为上午场 2为下午场
		 * $c 招聘日期 默认为本周7天
		 * $d 招聘人员
		 * $e 安排表的ID
		 */

		
		$apm = array(1,2);
		$markets_num = count($markets);
		$current_date = date('Y-m-d');
		$current_date_without_y = date('m-d(D)');

		foreach($markets as $k1 => $v1)
		{
			foreach($apm as $v2)
			{
				foreach($dates as $v3)
				{
					$ar[$k1][$v2][$v3] = array( 0 => array( ""=>0) );
				}
			}
		}

		
		/*	
	 	* 	查询市场渠道表和日招聘安排表以及系统用户表，市场渠道表和日招聘安排表进行自然连接，选出有招聘安排的渠道信息
		*	结果再和系统用户表左连接，查询出系统用户的名字
		*	结果集分为上午场的记录和下午场的记录，不再将上下午场合并在一个数组里，便于处理
		*	FIXME (marketID,mID,amOrPm,recruitDate)应该是唯一确定一个安排，不能重复 目前使用自增id做主键，组合可以重复
		*/
		
		$sql = "select a.marketID, a.name,b.arrangementID,b.mID,b.amOrPm,b.recruitDate,b.planID from a_market a
				left join a_dailyrecruit b on a.marketID = b.marketID
				left join s_user c on b.mID = c.mID 
        		where a.marketID in (".$markets_str.") 
        		and b.recruitDate >= '".$date_from."' and b.recruitDate <= '".$date_to.
        		"' ORDER BY a.marketID";

		$pdostmt = $pdo->query($sql);
		if($pdostmt)
		{
			$result = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
		
			foreach($result as $v)
			{
//				$ar[$v['marketID']][$v['amOrPm']][$v['recruitDate']] = array (  $v['arrangementID']=> idtoname($pdo,"user",$v['mID']) );
				$ar[$v['marketID']][$v['amOrPm']][$v['recruitDate']] = 
						array (  $v['arrangementID']=> array(idtoname($pdo,"user",$v['mID'])=> $v['planID']) );
			}
			
		}

		if($_POST['excelout'])
		{
			echo "haha";exit();
		}
		
		// 计算本周内每个人参加的场次和里程
		
		$statics = calc_numdis($pdo, $markets_str, $users_str, $date_from, $date_to);
    // echo "<pre>";
	// print_r($statics);
		/*
		 * 工作管理中，直接添加任何人的接口
		 */
		$allusers = getUsers($pdo);
		$allmarkets = getMarkets($pdo,1);
		$dir_apm = array(1=>"上午场",2=>"下午场");
		
		$smarty->assign("allusers",$allusers);
		$smarty->assign("allmarkets",$allmarkets);
		$smarty->assign("dir_dates",$dir_dates);
		$smarty->assign("dir_apm",$dir_apm);

		
		$smarty->assign ("markets",$markets);
		$smarty->assign ("dates",$dates);
		$smarty->assign ("dates_head",$dates_head);
		$smarty->assign ("apm",$apm);
		$smarty->assign ("week_name",$week_name);
		$smarty->assign ("users",$users);
		$smarty->assign ("ar",$ar);
		$smarty->assign ("statics",$statics);
		$smarty->assign ("current_date",$current_date );
		$smarty->assign ("current_date_without_y",$current_date_without_y);
		
		$smarty->assign("curURL","http://".$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]);

		
		$smarty->assign("date_from",$date_from);
		$smarty->assign("date_to",$date_to);
		
		if($id)
			$smarty->assign("id",$id);
		else// 从工作管理入口添加的计划planID = -1
			$smarty->assign("id",-1);
			
//		foreach($markets as $k=>$v)
//		{
//			$str .= "|"."replace:\"".$k."\":\"".$v."\"";
//		}
//		echo $str;
		
	
		$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
		$smarty->display("recruitManage/drDisplay.tpl");
		
?>