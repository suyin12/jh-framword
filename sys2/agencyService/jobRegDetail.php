<?php
/**
 * 2010-4-29              
 * <<<该页面主要的功能是对社保分批次清单签收数据的显示和下载>>>
 * 
 * @author  yours  sToNe
 * @version 
 */

#验证权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接公用函数
require_once '../common.function.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->wInfoSetArr ();
$wInfoSet = $wSet->wInfoSet;
#标题
$title = "社保清单批次明细";
$sponsorName = urldecode ( $_GET ['n'] );
$soInsModifyDate = $_GET ['d'];
$extraBatch =$_GET['e'];
$zhuanyuan = $_GET['zy'];

#先查询出该社保专员负责的单位信息
$sql = "select unitID from s_user where mID = ".$zhuanyuan ;
$ret = $pdo->query($sql);
$res = $ret->fetch(PDO::FETCH_ASSOC);
$units_str = $res['unitID'];

/*
 * 我要用query！！！
 * 
	$sql = "select batch,extraBatch,uID,(ROUND(radix,'0')) as radix,pension,hospitalization,employmentInjury,unemployment,housing,PDIns,hand,soInsurance as soInsStatus,soInsModifyDate,status,sponsorName,sponsorTime,leaderName,receiverName,receiveTime,ID from a_soInsList where sponsorName like :sponsorName and soInsModifyDate = :soInsModifyDate and status like '1' and extraBatch=:extraBatch";
	$res = $pdo->prepare ( $sql );
	$res->execute ( array (":sponsorName" => $sponsorName, ":soInsModifyDate" => $soInsModifyDate,":extraBatch"=>$extraBatch ) );
*/


$sql = "select a.batch,a.extraBatch,a.uID,(ROUND(a.radix,'0')) as radix,a.pension,a.hospitalization,a.employmentInjury, 
		a.unemployment,a.housing,a.PDIns,a.hand,a. soInsStatus,a.soInsModifyDate,a.status,a.sponsorName, a.sponsorTime,
		a.leaderName,a.receiverName,a.receiveTime,a.ID from (select batch,extraBatch,uID,(ROUND(radix,'0')) as radix,
		pension,hospitalization,employmentInjury, unemployment,housing,PDIns,hand,soInsurance as soInsStatus,
		soInsModifyDate,status,sponsorName, sponsorTime,leaderName,receiverName,receiveTime,ID 
		from a_soInsList where sponsorName = '".$sponsorName."' and soInsModifyDate = '".$soInsModifyDate."' and 
		status like '1' and extraBatch='".$extraBatch."' ) as a left join a_workerinfo b on a.uID = b.uID 
		where b.unitID in (".$units_str.")";


$res = $pdo->query($sql);
$ret = $res->fetchAll ( PDO::FETCH_ASSOC );
foreach ($ret as $rkey=>$rval){
	$ret[$rkey]['num'] = $rkey+1;
}
if (! $ret)
{
//	exit ( "数据读取出错,请重试" );
	sys_error($smarty, "由于社保专员负责单位的变更，这些数据不再提供，如有需要，请联系技术组！");
}
foreach ( $ret as $val ) {
	$uIDStr .= "'" . $val ['uID'] . "',";
}
$uIDStr = rtrim ( $uIDStr, "," );

$detailSql = "select a.uID,a.name,a.pID,a.sID,b.unitName,a.domicile,b.soInsID from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where a.uID in($uIDStr) order by b.soInsID";
$detailRet = $pdo->prepare ( $detailSql );
$detailRet->execute ();
$detailRet = $detailRet->fetchAll ( PDO::FETCH_ASSOC );



if (! $detailRet)
	exit ( "未知的单位信息" );
foreach ( $detailRet as $dKey => $dVal ) {
	$dRet [$dVal ['uID']] = $dVal;
}
#重新设置数组
foreach ( $ret as $val ) {
	$re [] = array_merge ( $val, $dRet [$val ['uID']] );
}
$re = reCreateArray($re,$wInfoSet);
#保存为EXCEL
//$tableHead = array ("num"=>"序号","batch" => "批次号", "unitName" => "单位", "uID" => "员工编号", "name" => "姓名", "pID" => "身份证号码", "sID" => "社保号", 'domicile' => "户籍", 'radix' => "基数", 'pension' => "养老", 'hospitalization' => "医疗", 'employmentInjury' => "工伤", 'unemployment' => "失业", 'housing' => "住房", 'PDIns' => "残障金", 'hand' => "利手",  "soInsurance" => "社保状态","sponsorName"=>"客户经理" );
$tableHead = array ("num"=>"序号","soInsID"=>"社保账户","unitName" => "单位","name" => "姓名",  "pID" => "身份证号码", "sID" => "社保号", 'domicile' => "户籍", 'radix' => "基数", 'pension' => "养老", 'hospitalization' => "医疗", 'employmentInjury' => "工伤", 'unemployment' => "失业", 'housing' => "住房", 'hand' => "利手",  "soInsStatus" => "社保状态","sponsorName"=>"客户经理","receiveTime"=>"签收时间" );
$excelTitle =$soInsModifyDate."社保清单";
$thArr [] = $tableHead;
if ($re)
	$excelRet = array_merge ( $thArr, $re );
if (isset ( $_POST ['intoExcel'] )) {
	if (! $excelRet)
		exit ( "<script> alert('无数据导出') </script>" );
		
		#链接PHPEXCEL CLASS
	require_once '../class/phpExcel/Classes/PHPExcel.php';
	require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
	require_once '../class/excel.class.php';
	$oExcel = new PHPExcel ( );
	#设置文档基本属性
	$oPro = $oExcel->getProperties ();
	$oPro->setCreator ( $authorCompany ); //公司名
	#构造输出函数
	$op = new excelOutput ( );
	$op->oExcel = $oExcel;
	$op->eRes = $excelRet;
	$op->selFieldArray = $tableHead;
	$op->title = $excelTitle;
	$op->fillData ();
	$op->eFileName = $excelTitle . ".xls";
	$op->output ();
}
#配置变量
$smarty->assign ( "ret", $re );
#模板配置
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display ( "soInsManage/soInsListDetail.tpl" );
?>