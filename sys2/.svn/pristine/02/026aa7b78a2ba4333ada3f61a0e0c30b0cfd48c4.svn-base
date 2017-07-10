<?php
require_once '../setting.php';
require_once sysPath.'common.function.php';

$btn = $_POST['btn'];
$current_user = $_SESSION['exp_user']['mID'];

// 列举未来四周的时间，供用户进行时间的选择
$today_w = date('N');
$week_start = time() - ($today_w-1)*24*60*60;
$week_name = array("（一）","（二）","（三）","（四）","（五）","（六）","（日）");
		
for($i = 0; $i < 4 ; $i++ )
{
	$next_four_weeks[] = date("Y-m-d",strtotime(date("Y-m-d",$week_start)) + $i*7*24*60*60);
}

if($btn == "arrangement")
{
		$marketID = $_POST['marketid'];
		$uid = $_POST['uid'];
		$arrangementID = $_POST['arid'];
		$amOrPm = $_POST['amorpm'];
		$date = $_POST['date'];
		
		$type = $_POST['type'];
		
		if($type == "insert")
		{
			$sql = "INSERT INTO a_dailyrecruit(mID, marketID, amOrPm, recruitDate) 
					VALUES(" . $uid . "," . $marketID . ",'" . $amOrPm . "', '" . $date ."' )" ;
			$op_type = "添加";
		}
		
		if($type == "update")
		{
			$sql = "UPDATE a_dailyrecruit 
					SET mID = " . $uid . ",
						marketID = " . $marketID . ",
						amOrPm = '" . $amOrPm . "',
						recruitDate = '" . $date . "'
						WHERE arrangementID = " . $arrangementID ;
			$op_type = "更新";			 
		}
		
		if($type == "delete")
		{
			$sql = "DELETE FROM a_dailyrecruit WHERE arrangementID = " . $arrangementID;
			$op_type = "删除";
		}

		$ret = $pdo->query($sql);
		$rows = $ret->rowCount();
		
		if($rows == 1)
			$success = $op_type . "成功";
		else 
			$error = $op_type . "失败";
		
		$msg = array("error"=>$error,"success"=>$success);
		$msg = array_filter($msg);
		$js_msg = json_encode($msg);
		echo $js_msg;
}

if($btn == "condition")
{
		$markets = $_POST['markets'];
		$users = $_POST['users'];
		$date_index = $_POST['date'];
		
		$markets_str = implode(",",$markets);
		$users_str = implode(",",$users);
		$mID = $_SESSION['exp_user']['mID'];
		
		$current_date = date('Y-m-d');
		
		$planWeek = $next_four_weeks[$date_index];
		
		
		
		
		
		$sql = "SELECT id FROM a_operationrecord WHERE mID = ".$mID." and planWeek = '".$planWeek."'";
		$ret = $pdo->query($sql);
		$res = $ret->fetch(PDO::FETCH_ASSOC);
		$record_id = $res['id'];
		$rows = $ret->rowCount();
		
		if(!$rows)
		{
		
		$sql = "INSERT INTO a_operationrecord(mID,markets,users,planWeek,updateDate)
				VALUES(" . $mID . ",'" . $markets_str . "','" . $users_str . "','"
				. $planWeek . "','" . $current_date . "')" ;
		}
		else 
		{
			$sql = "UPDATE a_operationrecord SET markets = '"
					.$markets_str."', users = '".$users_str."' WHERE id = ".$record_id;
		}
		
		$ret = $pdo->query($sql);

//FIXME 假设全部执行成功
//		$rows = $ret->rowCount();
//		
//		
//		if($rows == 1)
			$success = "操作成功";
//		else
//			$error = "操作失败请联系系统管理员";
//			
		$msg = array("error"=>$error,"success"=>$success);
		$msg = array_filter($msg);
		$js_msg = json_encode($msg);
		echo $js_msg;
}
if($btn == "deletemarket")
{
		$marketID = $_POST['marketid'];
		$date_index = $_POST['planweek'];
		
		$planWeek = $next_four_weeks[$date_index];
		
		// 删除安排表中marketID的所有安排
		$sql = "DELETE FROM a_dailyrecruit WHERE marketID = ".$marketID;
		$ret = $pdo->query($sql);
		
		// 更新计划表
     	$sql = "SELECT id,markets FROM a_operationrecord WHERE mID = " . $current_user . 
				" and planWeek = '" . $planWeek . "'";
		
		
		$ret = $pdo->query($sql);
		$result = $ret->fetch();

		$old_market_str = $result['markets'];
		$record_id = $result['id'];

		$new_market_str = delete_a_value($old_market_str,$marketID);

		$sql = "UPDATE a_operationrecord SET markets = '" . $new_market_str . "' WHERE id = " . $record_id;
		$ret = $pdo->query($sql);

		$rows = $ret->rowCount();
		
//		echo $rows;exit();
		
		
		if(!$rows)
			$error = "删除市场失败请联系系统管理员";
		else 
			$success = "已删除该市场的所有安排";
		
		$msg = array("error"=>$error,"success"=>$success);
		$msg = array_filter($msg);
	
		$js_msg = json_encode($msg);
		echo $js_msg;

}
if($btn == "deleteuser")
{
		$uid = $_POST['uid'];
		$date_index = $_POST['planweek'];
		
		$planWeek = $next_four_weeks[$date_index];
		
		// 删除安排表
		$sql = "DELETE FROM a_dailyrecruit WHERE mID = ".$uid;
		$ret = $pdo->query($sql);
		
		// 更新计划表
		$sql = "SELECT id,users FROM a_operationrecord WHERE mID = " 
				. $current_user . " and planWeek = '" . $planWeek . "'";
				
	
		$ret = $pdo->query($sql);
		$result = $ret->fetch(PDO::FETCH_ASSOC);
		
		$old_users_str = $result['users'];
		$record_id = $result['id'];

		$new_users_str = delete_a_value($old_users_str,$uid);
		
		
		$sql = "UPDATE a_operationrecord SET users = '" . $new_users_str . "' WHERE id = " . $record_id;
		
		$ret = $pdo->query($sql);
		$rows = $ret->rowCount();
		
		if(!$rows)
			$error = "操作失败请联系系统管理员";
		else 
			$success = "已删除该人员的所有安排";
			
		$msg = array("error"=>$error,"success"=>$success);
		$msg = array_filter($msg);
		$js_msg = json_encode($msg);
		echo $js_msg;
}