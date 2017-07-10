<?php
/*
*     2010-12-15
*          <<< 审批过程明细,这个是用来体现审批流程的过程 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接单位信息函数
require_once sysPath . 'dataFunction/unit.data.php';
#标题
$title = "审批流程";
$appProID = $_GET ['appProID'] ? $_GET ['appProID'] : $_POST ['appProID'];
$sql = "select * from `a_approval_process` where `appProID` =:appProID order by `order`";
$ret = SQL ( $pdo, $sql, array (":appProID" => $appProID ) );
$lastKey = array_pop ( array_keys ( $ret ) );
#获取各角色对应的角色名称
$labelArr = getRoleLable ( $pdo );
echo "<table class='approvalTable'><tr>";
foreach ( $ret as $key => $val ) {
	$remarks = $val ['remarks'] ? "<br>[ 备注: " . $val ['remarks'] . " ]" : null;
	$str = "<td>";
	if (($val ['order'] + 1) == $ret [$key + 1] ['order']) {
		switch ($val ['status']) {
			case "1" :
				$strA = "<span class='pass'>" . $labelArr [$val ['curKey']] [$val ['curVal']] ['name'] . "(通过)$remarks </span>";
				break;
			case "99" :
				$strA = "<span class='rollback'>" . $labelArr [$val ['curKey']] [$val ['curVal']] ['name'] . "(退回)$remarks </span>";
				break;
			case "0" :
				$strA = "<span>" . $labelArr [$val ['curKey']] [$val ['curVal']] ['name'] . "$remarks </span>";
				break;
		}
		if ($key == 0)
			echo $str . $strA . "</td><td>=></td><td>";
		else
			echo $strA . "</td><td>=></td><td>";
	} else {
		switch ($val ['status']) {
			case "1" :
				$strB = "<span class='pass'>" . $labelArr [$val ['curKey']] [$val ['curVal']] ['name'] . "(通过)$remarks </span>";
				break;
			case "99" :
				$strB = "<span class='rollback'>" . $labelArr [$val ['curKey']] [$val ['curVal']] ['name'] . "(退回)$remarks </span>";
				break;
			case "0" :
				$strB = "<span>" . $labelArr [$val ['curKey']] [$val ['curVal']] ['name'] . "$remarks </span>";
				break;
		}
		if ($lastKey == $key)
			echo $strB . "<br>";
		else
			echo $strB . "<br>-------------<br>";
	}
}
echo "</td></tr></table>";
?>