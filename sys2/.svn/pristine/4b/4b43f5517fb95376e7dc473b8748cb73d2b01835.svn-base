<?php
/*
作者：LOSKIN
time:2014-02-28
描述：个人代理流水账记录
更新：
	需要连接流水账计算类agm_Bill.php
	创建agMconfig.php<<<<引用配置文件>>>>
*/

#引用配置文件
require_once 'agMconfig.php';

/*  初始化设置 */
$title = "流水账记录";
#实例化
$x = new agmLink($pdo);
$a = $x->classaInfo($pdo);
$b = $x->classBill($pdo);
$mypage = new Pagination();
$aInfoSet = $aSet->agencySet;
foreach ($aInfoSet as $key => $val){
	switch ($key){
		case 'm':
		case 'billtype':
		case 'billpayment':	
		case 'billstatus':
			$smarty->assign("{$key}",$val);
			break;
	}
}
$mypage->page = $_GET ['page'];
$mypage->pagesize="5";
$billArr=array();
#***************where条件****************
if(empty($_GET["modifydate"])){
    $s_modifydate = date("Y-m");
    $_GET["modifydate"] = $s_modifydate;
}else{
    $s_modifydate=$_GET["modifydate"];
}

$where=$b->getWhere($_GET);
#统计数=人数+台账年月+where组合条件
$total=$b->getBltotal($where);
#仅初始化余额
$a -> addOne();
if (!empty($_GET["c"])) {
	$total = array();
	$where2="where ".$_GET["m"]." like '%{$_GET["c"]}%'";
	$list=$a->getPlList($where2,"`id`");
	foreach ($list as $k => $v)
		$total[$k]["fID"]=$v["id"];
		//echo "<pre>";var_dump($total);
}
$mypage->count=db::$nums;
$mypage->get_limit();
$limit_start = ($mypage->page - 1) * $mypage->pagesize;

foreach ($total as $k => $v){
	if($k>=$limit_start){
		$billArr[$k]=$b->getBlByfID($v["fID"],$where,"order by lastModifyTime desc");
		$arr=$a->getPlByfID($v["fID"],"`name`,`pID`");
		$billArr[$k]["name"]=$arr["name"];
		$billArr[$k]["pID"]=$arr["pID"];
		if($k===$limit_start+$mypage->pagesize-1){
			break;
		}
	}
}
$pageList = $mypage->page_list($_SERVER ['REQUEST_URI']);
#***************流水账年月显示最后三个月****************
$modifydate=$b->getBlmonth("3");
#下载人员名单信息
if ($_GET ['intoExcel']) {
    #保存为EXCEL
    $tableHead = array(
        "dID" => "档案编号",
        "name" => "姓名",
    	"sID" => "电脑号",
        "pID" => "身份证",
        "mess" => "交易备注",
        "type" => "缴费类型",
        "payment" => "缴费明细",
        "income" => "收入",
        "expenditure" => "支出",
        "remains" => "余额",
        "status" => "状态",
        "lastModifyBy" => "操作人",
        "lastModifyTime" => "操作时间"
    );
	if($_GET["codeVison"]){
		foreach ($total as $k => $v){
			$arr = $a->getPlByfID($v["fID"],"`name`,`sID`,`pID`,`dID`");
			$arrt = $b->getBlList("where fID='{$v['fID']}'","*","limit 1");
			$excelRet[$k] = $arrt[0];
			$excelRet[$k]["type"] = $aInfoSet["billtype"][$arrt[0]['type']];
			$excelRet[$k]["payment"] = $aInfoSet["billpayment"][$arrt[0]['payment']];
			$excelRet[$k]["status"] = $aInfoSet["billstatus"][$arrt[0]['status']];
			$excelRet[$k]["name"]=$arr["name"];
			$excelRet[$k]["sID"]=$arr["sID"];
			$excelRet[$k]["pID"]=$arr["pID"];
			$excelRet[$k]["dID"]=$arr["dID"];
		}
		//echo "<pre>";var_dump($excelRet);
	}else{
		$excelRet = $b->getBlList($where);
		foreach ($excelRet as $k => $v){
			$arr=$a->getPlByfID($v["fID"],"`name`,`sID`,`pID`,`dID`");
			$excelRet[$k]["type"] = $aInfoSet["billtype"][$v['type']];
			$excelRet[$k]["payment"] = $aInfoSet["billpayment"][$v['payment']];
			$excelRet[$k]["status"] = $aInfoSet["billstatus"][$v['status']];
			$excelRet[$k]["name"]=$arr["name"];
			$excelRet[$k]["sID"]=$arr["sID"];
			$excelRet[$k]["pID"]=$arr["pID"];
			$excelRet[$k]["dID"]=$arr["dID"];
		}
	}
	$excelTitle = $modifydate[$s_modifydate]."流水账记录";
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
$smarty->assign("actionURL", httpPath . "agencyService/agMBillList.php");
$smarty->assign(array("bill"=>$billArr,"current_month"=>$current_month,"modifydate"=>$modifydate,"date"=>date("Y-m")));
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
#显示查询结果
$smarty->assign("pageList", $pageList);
$smarty->display("agencyService/agMBillList.tpl");