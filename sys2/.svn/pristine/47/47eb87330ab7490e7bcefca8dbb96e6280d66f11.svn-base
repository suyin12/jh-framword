<?php

require_once '../auth.php';

$btn = $_REQUEST['btn'];
$from = $_REQUEST['from'];

if($btn == "addrequire")
{
	$id = $_GET['id'];
	$sql = "select p.*,u.unitName from a_position p left join a_unitinfo u on p.unitId = u.unitID where positionID = ".$id;
	$ret = $pdo->query($sql);
	$p = $ret->fetch(PDO::FETCH_ASSOC);
	
	$html = "<p><span style=\"background:red;color:black;\">请核对岗位信息：</span></p><table class='myTable' width=\"800px\">".
			"<tr><th width=\"10%\">岗位名称</th><th width=\"10%\">用工单位</th><th width=\"10%\">地点</th><th width=\"10%\">年龄</th><th width=\"25%\">要求</th><th width=\"25%\">职责</th><th width=\"10%\">转正后工资</th></tr><tr>".
			"<td><a href='positionInfo.php?id=".$p['positionID']."' target='_blank'>".$p['name']."</a></td><td>".
			$p['unitName']."</td><td>".$p['workPlace']."</td><td>".$p['posAge']."</td><td title='".$p['posOther']."'>".
			substr($p['posOther'],0,50)."</td><td title='".$p['duty']."'>".substr($p['duty'],0,50)."</td><td>".$p['officalTotalSalary']."</td></tr></table>";
			
	echo $html;
}

if($btn == "marketupdate")
{
	$id = $_GET['id'];
	$sql = "delete from a_market_contactinfo where id = ".$id;
	$ret = $pdo->query($sql);
	$rows = $ret->rowCount();
	if($rows == 1)
		echo "删除成功";
	else 
		echo "删除失败";
}

if($btn == "tinsertunit" )
{
	$unit_id = $_GET['id'];
	$sql = "select positionID,name,shortcut from a_position where unitId = '" . $unit_id . "' and active = '1'";
	
	$ret = $pdo->query($sql);
	
	if($ret)
	{
		$res = $ret->fetchAll(PDO::FETCH_ASSOC);
		if($res)
		{
			$options = "<option label='' value=''>----请选择----</option>";
			foreach($res as $v)
			{
				$options .= "<option label='" .$v['name']."' value='".$v['positionID']."'>".$v['shortcut']." ".$v['name']."</option>";
			}
		}
		else 
		{
			$options = "<option label='' value=''>----该单位下无招聘岗位----</option>";
		}		
	}
	else
	{
		$options = "<option label='' value=''>----该单位下无招聘岗位----</option>";
	}
	
	if($from == "addrequire")
		$options .= "<option label='' value='add'>##点击新增岗位##</option>";
		
	echo $options;	
}
/*
 *  先扔在这吧。。。

if($btn == "tinsertpos")
{
	$pos_id = $_GET['id'];
	$sql = "select positionID from a_position where pos_id = ".$pos_id." and active = '1'";
	
}
 */

if($btn == "setprice")
{
	$unit = $_POST['unit'];
	$sql = "select b.unitName,a.* from a_position a left join a_unitinfo b on a.unitId = b.unitID where a.unitId = '".$unit."'";
	
	$ret = $pdo->query($sql);
	$res = $ret->fetchAll(PDO::FETCH_ASSOC);
	
	$price = "<table class=\"myTable\"><tr><th>单位</th><th>岗位名</th><th>价格</th></tr>";
	foreach($res as $v)
	{
		$price .= "<tr><td width=\"150px\">" . $v['unitName'] . "</td><td width=\"100px\">" . $v['name']
					. "</td><td width=\"100px\"><input type=\"hidden\" value=\"" . $v['positionID'] 
					. "\" /><input type=\"text\" class=\"price\" value=\" ". $v['price'] 
					. "\" /></td></tr>" ;
			
	}
	$price .= "</table>";
}























?>