<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 分页
require_once '../class/pagenation.class.php';

require_once '../dataFunction/unit.data.php';

require_once '../common.function.php';

 
for($month=1;$month <= 12;$month++)
{
	for($rid=1;$rid<=128;$rid++)
	{
		$sql_compute_eBalance = "update a_soinsagencyfee set eBalance = bBalance - sum where month = ".$month." and rid = ".$rid;
		$ret = $pdo->query($sql_compute_eBalance);
		$rows = $ret->rowCount();
		
		if($rows == 1 || $rows == 0)
		{
			echo "ID为".$rid."的人员".$month."月eBalance计算完毕<br />";
			if($month < 12)
			{
				

			
				$sql_select_last_month_eBalance = "select eBalance from a_soinsagencyfee where month = ".$month." and rid = ".$rid;
				$ret = $pdo->query($sql_select_last_month_eBalance);
				$res = $ret->fetch(PDO::FETCH_ASSOC);
					
				$update_new = "update a_soinsagencyfee set bBalance = ".$res['eBalance']." where month = ".($month+1)." and rid = ".$rid;
				$ret = $pdo->query($update_new);
				$rows = $ret->rowCount();
				if($rows == 1 || $rows == 0)
				{
					echo "ID为".$rid."的人员".($month+1)."月bBalance更新完毕<br />";
				} 
				else
				{
					echo "ID为".$rid."的人员".($month+1)."月bBalance更新出错";exit();
				}
			
			}
		}
		else
		{
			echo "ID为".$rid."的人员".$month."月eBalance计算出错";exit();
		}
		
	}

}

echo "<h1>全部更新结束</h1>";exit();






















?>