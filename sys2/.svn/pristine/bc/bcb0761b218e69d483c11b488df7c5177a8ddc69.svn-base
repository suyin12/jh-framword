<?php
/*
作者：LOSKIN
time:2013-11-27
描述：劳动事务代理列表页
更新：
	11-27 改造数组的传递方式,引用agencySet.data.php
	
*/
#引用配置文件
require_once 'agMconfig.php';
require_once 'bill_agm.php';
require_once 'latepay_agm.php';
require_once 'lateHF_agm.php';
require_once 'aInfo_agm.php';
require_once 'hfFee_agm.php';

$bill=new bill();
$fee=new feeExtra($pdo);
$latesoins = new latesoins();
$lateHF = new lateHF();
$aInfo=new aInfo();
$HFFee=new HFFee();


/*  初始化设置 */
$title = "个人社保代理";
$current_month = date('Ym');
#配置个人代理专员roleID = '3_2'
$unitManager = unit_manager($pdo, "3_2","null");
$smarty->assign("unitManager",$unitManager);
$sql="select `roleName` from s_role where `roleID`='3_2'";
$roleNameArr=SQL($pdo,$sql);
$roleName=$roleNameArr["0"]["roleName"];
$smarty->assign("roleName",$roleName);
//得到agencySet.data.php里的数组
$aInfoSet = $aSet->agencySet;
foreach ($aInfoSet as $key => $val){
	switch ($key){
		case 'm':
		case 'domicile':
		case 'hospitalization':
		case 'status':
			$smarty->assign("{$key}",$val);
			break;
	}
}
#使用分页类
$mypage = new Pagination();
#处理get提交的查询条件
$m = $_GET ['m'];
$where="";

if(!empty($_GET['mID'])){
	$mID=$_GET['mID'];
	foreach ($unitManager as $um_v) {
		unset($um_v["unit"]);
        if($um_v["mID"]==$mID){
        	$where.=" and `lastModifyBy`='{$um_v["mName"]}'";
        }
    }
}
if(!empty($_GET["status"])||$_GET["status"]=="0"){
	$s_status=(int)$_GET["status"];
	$where.=" and `status`='{$s_status}'";
}
if(($_GET['m'] && $_GET['s_status_stop'] == '1') || empty($_GET) || !$_GET['m'] && $_GET["page"]){
	$where.=" and `status`!='0'";
}
if($_GET['m'] && empty($_GET['s_status_stop'])){
	$s_status_stop = "unchecked";
}
if (!empty($_GET["c"])) {
	$c=$_GET['c'];
	$where.=" and ".$m." like '%{$c}%'";
}
if(!empty($where)){
	$where=substr($where,"4");
	$where="where ".$where;
	if (!$_GET['m']){
		$mypage->form_mothod = "post";
	}
}else{
	//echo $where = "where `status`!='0'";
	$mypage->form_mothod = "post";
}
if($_GET['m'] && $_GET['s_status_stop'] !== '1'){
	$mypage->form_mothod = "get";
}
$smarty->assign("s_m",$m);
$smarty->assign("s_c",$c);
$smarty->assign("s_mID",$mID);
$smarty->assign("s_status",$s_status);

//设置当前页
$mypage->page = $_GET ['page'];
$mypage->pagesize="8";
#个代个人信息
$tableName="d_agent_personalInfo";

#***************公共部分****************
$fee=new feeExtra($pdo);
$fee->soInsMonlist("distinct `month`","order by month asc");
$NewMon=$fee->soInsMon($current_month);
$order="order by id desc";
$fArr=db::select($tableName,"*",$where,$order);
//返回查询数据库总记录数
$mypage->count=db::$nums;
//页码的开始和结束
$limit=$mypage->get_limit();
$remainsAll = $aInfo->remainsAll();
//****************列表**************
foreach ($fArr as $k=>$v){
	#***********状态*************
	$status = $v["status"];
	//$v["status"] = $aInfo->statusAgents($v,$pdo);
	$s=$fee->exdays($current_month,$v['cEndDay']);
	if($s>0 && $s<insuranceInTurn("soIns") && $v["soInsurance"]=="1"){
		if($status!=="5")
			$status="5";
	}
	$h=$fee->exdays($current_month,$v['hEndDay']);
	if($h>0 && $h<insuranceInTurn("HF") && $v["housingFund"]=="1"){
		if($status!=="5")
			$status="5";
	}
	$cmonths=0;
	$hmonths=0;
	$months=0;
	if($status!=="0"){
		#***************预算部分*******************欠费
		#预算缴费金额
		$soInsBill="";
		$TsoinsArr=array();
		$Tsoins="";
		if($v["soInsurance"]!=="0"){
			$soInsBill=$fee->soInsFun($v,$NewMon);
			#当月总缴费金额应该判断是否加上残障金
			$soInsBill["Total"]=$soInsBill["uTotal"]+$soInsBill["pTotal"]+$soInsBill["uPDIns"];
			#缴交月数(剩余的月数)***********
			$cmonths=$fee->cmoths($v['cBeginDay'],$v['cEndDay'],$v['id']);
			#合计补缴社保费用
			$soInspaydate = $aInfo->soInspaydate($current_month);
			$lateListArr = $latesoins->getListByfID($v['id'],$soInspaydate);
			if(!empty($lateListArr)){
				$TsoinsArr = $latesoins->TotalsoinsArr($lateListArr,$soInspaydate);
				$Tsoins = $TsoinsArr["latepay"] + $TsoinsArr["basicPension"];
			}
		}
		#公积金部分*******************
		$HFFun="";
		$THFArr=array();
		$THF=""; 
		$HFtotal="";
		if($v["housingFund"]!=="0"){
			$HFFun=$fee->HFFun($v,date("Ym"));
			$HFtotal=$HFFun["uTotal"]+$HFFun["pTotal"];
			$hmonths=$fee->hmoths($v['hBeginDay'],$v['hEndDay'],$v['id']);
			#合计补缴公积金费用
			$HFpaydate = $aInfo->HFpaydate($current_month);
			$lateHFListArr = $lateHF->getListByfID($v['id'],$HFpaydate);
			if(!empty($lateHFListArr)){
				$THFArr = $lateHF->TotalHFArr($lateHFListArr,$HFpaydate);
				$THF = $THFArr["total"];
			}
		}
		$months=$fee->moths($cmonths,$hmonths);
		if($status == "1" || $status == "2"){
			//echo $soInsBill["Total"]."+".$HFtotal."+".$Tsoins."+".$THF."=".(int)($soInsBill["Total"]+$HFtotal+$Tsoins+$THF).$v["name"].$remainsAll[$v['id']]."<br/>";
			if($remainsAll[$v['id']]<(int)($soInsBill["Total"]+$HFtotal+$Tsoins+$THF)){
				$status="2";
			}else{
				$status="1";
			}
		}
	}
	if($status!=$v["status"]){
		$aSet->status(array("status"=>$status,"id"=>$v["id"]));
	}
	#保存下载Excel时所需数组
	$excelRet[$v['id']] = array(
		"dID" => $v["dID"],
		"name" => $v["name"],
		"pID" => $v["pID"],
		"mobilePhone" => $v["mobilePhone"],
		"sID" => $v["sID"],
		"relationalName" => $v["relationalName"],
		"hospitalization" => $aInfoSet["hospitalization"][$v["hospitalization"]],
		"domicile" => $aInfoSet["domicile"][$v["domicile"]],
		"Ctotal" => $soInsBill["Total"],
		"cmonths" => $cmonths,
		"HFtotal" => $HFtotal,
		"hmonths" => $hmonths,
		"managementCost" => $v["managementCost"]=='0' ? "免" : $v["managementCost"],
		"months" => $months,
		"remains" => $remainsAll[$v['id']],
		"Total" => $soInsBill["Total"] * $cmonths + $HFtotal * $hmonths + $Tsoins + $THF,
		"remarks" => $v["remarks"],
		"soinsterm" => $v["cBeginDay"]=="0000-00-00" ? "" : $v["cBeginDay"] ."至".$v["cEndDay"],
		"HFterm" => $v["hBeginDay"]=="0000-00-00" ? "" : $v["hBeginDay"]."至".$v["hEndDay"]
	);
}

$tableName = "d_agent_personalInfo";
$columList = "`id`,`name`,`pID`,`dID`,`sID`,`domicile`,`mobilePhone`,`cBeginDay`,`cEndDay`,`hBeginDay`,`hEndDay`,`hospitalization`,`managementCost`,`relationalName`,`remarks`,`status`,`soInsurance`,`housingFund`";
$siagency = db::select($tableName,$columList,$where,$limit,$order);
$pageList = $mypage->page_list($_SERVER ['REQUEST_URI']);

#给查询数组中的关键字标红
foreach ($siagency as $k=>$v){
	$siagency["{$k}"]["{$m}"]=str_replace($c, "<font color='red'>$c</font>", $siagency["{$k}"]["{$m}"]);
}
#下载人员名单信息
if ($_POST ['intoExcel']) {
    #保存为EXCEL
    $tableHead = array(
        "dID" => "档案编号",
        "name" => "姓名",
    	"sID" => "电脑号",
        "pID" => "身份证",
        "mobilePhone" => "联系电话",
        "relationalName" => "关系来源",
        "managementCost" => "管理费",
        "domicile" => "户籍",
    	"hospitalization" => "医保类型",
    	"remarks" => "备注",
        "remains" => "余额",
        "Ctotal" => "社保费",
        "HFtotal" => "公积金费",
    	"Total" => "合计应缴",
    	"soinsterm" => "社保最新代理期限",
    	"HFterm" => "公积金最新代理期限"
    );
	$excelTitle = date('Ym') . $aInfoSet["status"][$s_status]."人员预算表";
    $thArr [] = $tableHead;
    $excelRet = array_merge($thArr, $excelRet);
    if (!$excelRet)
        exit ("<script> alert('无数据导出') </script>");
    //echo "<pre>";var_dump($excelRet);
    #链接PHPEXCEL CLASS
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once '../class/excel.class.php';
    $oExcel = new PHPExcel ();
    #设置文档基本属性
    $oPro = $oExcel->getProperties();
    $oPro->setCreator($serverCompany); //公司名
    #构造输出函数
    $op = new excelOutput ();
    $op->oExcel = $oExcel;
    $op->eRes = $excelRet;
    $op->selFieldArray = $tableHead;
    $op->title = $excelTitle;
    $op->fillData();
    $op->eFileName = $excelTitle . ".xls";
    $op->output();
    unset($op);
    exit();
}

#定义模板变量
$smarty->assign("s_status_stop",$s_status_stop);
$smarty->assign("actionURL", httpPath . "agencyService/agencyManage.php");
$smarty->assign(array("siagency"=>$siagency,"current_month"=>$current_month,"modifydate"=>date("Y-m")));
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
#显示查询结果
$smarty->assign("pageList", $pageList);
$smarty->display("agencyService/agencyManage.tpl");

?>