<?php
require_once ('../auth.php');
require_once ('../setting.php');
require_once ('../templateConfig.php');
require_once ('../class/pagenation.class.php');
require_once '../common.function.php';


$title = "人才管理统计";
// 得到post过来的月份

$cur_y = date("Y");
$cur_m = date("m");

$batchy_opt = array(($cur_y-1)=>($cur_y-1),$cur_y=>$cur_y,($cur_y+1)=>($cur_y+1));
for($i=1;$i<=12;$i++)
{
	$batchm_opt[$i] = $i;
}


//$batch = "201012";

$batch_y = $_GET['batch_y'];
$batch_m = $_GET['batch_m'];



if($batch_y)
{
			$batch = $batch_y.sprintf("%02x",$batch_m);
			
			// 计算绩效表的各项
	echo		$sql = "select b.mName,a.* from a_rperformancemain a left join s_user b on a.`user` = b.mID where batch = '".$batch."'";
			
			$ret = $pdo->query($sql);
			$pm_main = $ret->fetchAll(PDO::FETCH_ASSOC);
			
			$sql = "select c.unitName,b.mName,a.* from a_rperformanceunit a left join s_user b on a.`user` = b.mID 
					left join a_unitinfo c on a.unit = c.unitID where batch = '".$batch."' order by a.`user`,a.unit";
			
			$ret = $pdo->query($sql);
			$pm_unit = $ret->fetchAll(PDO::FETCH_ASSOC);
			
			//echo "<pre>";print_r($pm_main);print_r($pm_unit);
			
			foreach($pm_main as $data)
			{
				foreach($pm_unit as $unit)
				{
					$xxx[$unit['mName']][$unit['unit']] = $unit['number'];
				}
				$xxx[$data['mName']]['entry'] = $data['entry'];
				$xxx[$data['mName']]['cv'] = $data['cv'];
				$xxx[$data['mName']]['posManage'] = $data['posManage'];
				$xxx[$data['mName']]['numTest'] = $data['numTest'];
				$xxx[$data['mName']]['numTele'] = $data['numTele'];
				$xxx[$data['mName']]['rateTele'] = $data['rateTele'];
				$xxx[$data['mName']]['changci'] = $data['changci'];
				$xxx[$data['mName']]['netcv'] = $data['netcv'];
				$xxx[$data['mName']]['updWebsite'] = $data['updWebsite'];
				$xxx[$data['mName']]['rateSuccess'] = $data['rateSuccess'];
				$xxx[$data['mName']]['rateValid'] = $data['rateValid'];
				$xxx[$data['mName']]['amount'] = $data['amount'];
			}
			
			// 计算绩效表的总计
			$xxx_sum[] = "合计";
			foreach($pm_unit as $unit)
			{
				$xxx_sum[$unit['unit']] += $unit['number'];
			}
			foreach($pm_main as $data)
			{
				$xxx_sum['entry'] += $data['entry'];
				$xxx_sum['cv'] += $data['cv'];
				$xxx_sum['posManage'] += $data['posManage'];
				$xxx_sum['numTest'] += $data['numTest'];
				$xxx_sum['numTele'] += $data['numTele'];
				$xxx_sum['rateTele'] += $data['rateTele'];
				$xxx_sum['changci'] += $data['changci'];
				$xxx_sum['netcv'] += $data['netcv'];
				$xxx_sum['updWebsite'] += $data['updWebsite'];
				$xxx_sum['rateSuccess'] += $data['rateSuccess'];
				$xxx_sum['rateValid'] += $data['rateValid'];
				$xxx_sum['amount'] += $data['amount'];
			}
			
			// 绩效表的表头
			$sql = "select c.unitName,b.mName,a.* from a_rperformanceunit a left join s_user b on a.`user` = b.mID 
					left join a_unitinfo c on a.unit = c.unitID where batch = '".$batch."' group by a.unit order by a.unit";
			
			$ret = $pdo->query($sql);
			$pm_head = $ret->fetchAll(PDO::FETCH_ASSOC);
			
			$xxx_head[] = "姓名";
			foreach($pm_head as $unit)
			{
					$xxx_head[] = $unit['unitName'];
					$xxx_sum_final[] += $unit['number'];		
			}
			$xxx_head[] = "入职";
			$xxx_head[] = "简历";
			$xxx_head[] = "岗位管理数";
			$xxx_head[] = "复试";
			$xxx_head[] = "电话通知";
			$xxx_head[] = "电话通知率";
			$xxx_head[] = "场次";
			$xxx_head[] = "网络简历";
			$xxx_head[] = "网站更新";
			$xxx_head[] = "成功率";
			$xxx_head[] = "简历有效率";
			$xxx_head[] = "金额";
			
			$smarty->assign("xxx",$xxx);
			$smarty->assign("xxx_head",$xxx_head);
			$smarty->assign("xxx_sum",$xxx_sum);

}
else 
{
			$_SERVER ["QUERY_STRING"] = "?batch_y=" . "2010" . "&batch_m=" . "12";
			header ( "Location:" . $_SERVER ["PHP_SELF"] . $_SERVER ["QUERY_STRING"] );
}


$smarty->assign("batchy_opt",$batchy_opt);
$smarty->assign("batchm_opt",$batchm_opt);
$smarty->assign("batchy_s",$cur_y);
$smarty->assign("batchm_s",$cur_m);



$smarty->assign("batchy_s",$batch_y);
$smarty->assign("batchm_s",$batch_m);




$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display("recruitManage/statistics.tpl");






?>