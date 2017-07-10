<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';

require_once '../common.function.php';

$title = "招聘需求管理";



	
	

$id = $_GET['id'];

if(!$id)
{
/*		// 查询所有岗位
		$sql = "SELECT positionID,name,unitName,shortcut FROM a_position p left join a_unitinfo u on p.unitId = u.unitID where p.active = 1 order by shortcut";
		$ret = $pdo->query($sql);
		if($ret)
		{
			$res = $ret->fetchAll();
			foreach($res as $v)
			{
				$positions[$v['positionID']] = $v['shortcut']." ".$v['name']."(".$v['unitName'].")";
			}
		}*/
	
		# 选择岗位改成分成两个步骤，先选择单位，再选择该单位下面的岗位 
		// 查询所有单位	
		$sql = "select unitID,unitName from a_unitinfo where type = 1 or type = 3";
		$ret = $pdo->query($sql);
		if($ret)
		{
			$res = $ret->fetchAll(PDO::FETCH_ASSOC);
			foreach($res as $v)
			{
				$units [ $v['unitID'] ] = $v['unitName'];
			}
		}
		
		// 查询所有岗位	
			$sql = "SELECT positionID,name,unitName,shortcut FROM a_position p left join a_unitinfo u 
					on p.unitId = u.unitID where p.active = 1 order by shortcut";
			
		$ret = $pdo->query($sql);
		if($ret)
		{
			$res = $ret->fetchAll();
			foreach($res as $v)
			{
				$positions[$v['positionID']] = $v['shortcut']." ".$v['name'];
			}
		}
		
		$smarty->assign("units",$units);
//		$smarty->assign("positions",$positions);
		$smarty->assign("has_no_id",1);


}
else 
{
		$sql = "SELECT name,unitName FROM a_position p LEFT JOIN a_unitinfo u on p.unitId = u.unitID WHERE positionID = ".$id;
		$ret = $pdo->query($sql);
		if($ret)
		{
			$the_position = $ret->fetch(PDO::FETCH_ASSOC);
		}
		
		$smarty->assign("positionID",$id);
		$smarty->assign("the_position",$the_position);
		$smarty->assign("has_id",1);

}

$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/addRequire.tpl");

?>