<?php
#引用配置文件
require_once 'agMconfig.php';
require_once 'bill_agm.php';
new db($pdo);
$bill=new bill();
#where组合条件
$where=$bill->getWhere($_GET);
$arr=$bill->getBlList($where,"*","","order by lastModifyTime desc");
$aInfoSet = $aSet->agencySet;
foreach ($arr as $k =>$v ){
	$income="";
	$expenditure="";
	$remains="";
	if($v['income']>0){
		$income="+".$v['income'];
	}
	if($v['expenditure']>0){
		$expenditure="-".$v['expenditure'];
	}
    $remains=$v['remains'];
	if($k>0){
		echo "<tr class=\"son{$v['fID']}\">
				<td>┝</td>
				<td></td>
				<td></td>
				<td>{$v['mess']}</td>
				<td>{$v['paydate']}</td>
				<td>{$aInfoSet['billtype'][$v['type']]}</td>
				<td>{$aInfoSet['billpayment'][$v['payment']]}</td>
				<td>{$income}</td>
				<td>{$expenditure}</td>
				<td>{$remains}</td>
				<td>{$aInfoSet['billstatus'][$v['status']]}</td>
				<td>{$v['lastModifyBy']}</td>
				<td>{$v['lastModifyTime']}</td>
			</tr>
		";
	}
}
//var_dump($aInfoSet);