<?php
/*
*     2010-5-20
*          <<< 公式设置 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#分页类
require_once sysPath . 'class/pagenation.class.php';
#单位,客户经理联动菜单
require_once sysPath . 'dataFunction/unit.data.php';
$title ="费用表公式设置";
#重置GET参数
foreach ( $_GET as $getKey => $getVal ) {
	switch ($getKey) {
		case "zID" :
		case "unitID" :
			if (is_numeric ( $getVal ))
				$getQuery [$getKey] = $getVal;
			else
				exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
			break;
		case "salaryDate" :
		case "soInsDate" :
		case "comInsDate" :
			if (isMonth ( $getVal ))
				$getQuery [$getKey] = $getVal;
			else
				exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
			break;
	}
}
//获取中英文对照数组
$engToChsArr = engTochs ();
//获取GET参数
$zID = $getQuery ['zID'];
$unitID = $getQuery ['unitID'];
$soInsDate = $getQuery ['soInsDate'];
$comInsDate = $getQuery ['comInsDate'];
$salaryDate = $getQuery ['salaryDate'];
#获取该帐套对应的列,包括列的中文名
$zfSql = "select zIndex,field from a_zformatInfo where zID like :zID";
$zfRes = $pdo->prepare ( $zfSql );
$zfRes->execute ( array (":zID" => $zID ) );
$zfRet = $zfRes->fetch ( PDO::FETCH_ASSOC );
$fieldArr = makeArray ( $zfRet ['field'] );
$zIndex = makeArray ( $zfRet ['zIndex'] );
$zIndex = array_flip ( $zIndex );
foreach ( $fieldArr as $key => $val ) {
	if (array_key_exists ( $key, $zIndex )) {
		$key = $zIndex [$key];
		$val = $engToChsArr [$key];
	}
	$newFieldArr [$key] = $val;
}
//这里增加几个字段,可以自定义控制查询所需的字段名
$newFieldArr ['salaryDate'] = $engToChsArr ['salaryDate'];
$newFieldArr ['soInsDate'] = $engToChsArr ['soInsDate'];
$newFieldArr ['comInsDate'] = $engToChsArr ['comInsDate'];
$newField = implode ( ",", array_keys ( $newFieldArr ) );
//查找所需的字段,生成预览 ,限制10条
$sql = "select $newField  from a_originalFee_tmp where unitID like  :unitID and salaryDate = :salaryDate and soInsDate = :soInsDate and comInsDate= :comInsDate limit 0,6";
$res = $pdo->prepare ( $sql );
$res->execute ( array (":unitID" => $unitID, ":salaryDate" => $salaryDate, ":soInsDate" => $soInsDate, ":comInsDate" => $comInsDate ) );
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
#设置公式所需要的代号
$formulasChart = array ("+" => "+ (加)", "-" => "- (减)", "/" => "/ (除)", "*" => "* (乘)","("=>"( (左括号)",")"=>")(右括号)" ) + $newFieldArr;
$i = 0;
$formulasChartStr.="<tr>";
foreach ( $formulasChart as $chartKey => $chart ) {

	if ($i % 15 == 0 && $i != 0)
		$formulasChartStr .= "</tr><tr>";
	$i ++;
	$formulasChartStr .= "<td>";
	$formulasChartStr .= "<a href='#' id='$chartKey' class='chart'>$chart</a>";
	$formulasChartstr .= "</td>";

}
$formulasChartStr .= "</tr>";
//print_r($formulasChart);
#定义变量
//$smarty->debugging = true;
$smarty->assign ( "newFieldArr", $newFieldArr );
$smarty->assign ( "ret", $ret );
$smarty->assign ( "formulasChartStr", $formulasChartStr );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "salaryManage/salaryFormulasSet.tpl" );
?>