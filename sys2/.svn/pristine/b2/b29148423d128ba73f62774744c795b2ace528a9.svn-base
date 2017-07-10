<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/**
 * 2010-3-25              
 * <<<>>>
 * 
 * @author  yours  sToNe
 * @version 
 */
ini_set('display_errors', 1);
//error_reporting(E_ALL & ~ (E_NOTICE | E_WARNING));
include_once ("../settings.inc");
//所有员工的信息
$sql=str_replace('\\','',$_POST['sql']);
$ret = mysql_query($sql);
while ($row = mysql_fetch_assoc($ret)) {
    $wAverRet[] = $row;
}

  foreach ($wAverRet as $key=> $val){
	         foreach ($val as $k=> $v){
	             switch ($k){
		             case "status":
		                   switch ($v){
		                       case "0": $v="等待..";break;
		                       case "1": $v="已上岗";break;
		                       case "2": $v="出问题";break;
		                   }
		                 break;
		             case "trainStatus":
		             case "reterence":
		             case "dataToUnit":
		                 switch ($v){
		                       case "0": $v="否";break;
		                       case "1": $v="已";break;
		                   }
		                 break;
	             }
	            $wAverRet [$key] [$k] = $v;
	         }
	    }
//print_r($wThArr);
$excelTitle = "待岗人员名单";
$wSheetTitle = "汇总名单";
$wAverTableHead = array("ID" => "编号" , "status" => "状态" , "unit" => "单位" , "station" => "岗位" , "name" => "姓名" , "dataStatus" => "交资料情况" , "trainStatus" => "是否培训 " , "reterence" => "证明人来否" , "dataToUnit" => "资料交市局情况" , "phone" => "电话" , "pID" => "身份证" , "remarks" => "备注" , "problem" => "问题" , "insertTime" => "添加时间" , "lastModifyTime" => "最后更新时间" , "actionPer" => "操作人");
$wThArr[] = $wAverTableHead;
$wAverRet = array_merge($wThArr, $wAverRet);
//        print_r($wAverRet);
if (! $wAverRet)
    exit("<script> alert('无数据导出') </script>");
    #链接PHPEXCEL CLASS
require_once '../class/phpExcel/Classes/PHPExcel.php';
require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
require_once '../class/excel.class.php';
$oExcel = new PHPExcel();
#构造输出函数
$op = new excelOutput();
$op->oExcel = $oExcel;
$op->eRes = $wAverRet;
$op->selFieldArray = $wAverTableHead;
$op->title = $wSheetTitle;
$op->fillData();
$op->eFileName =  $excelTitle . ".xls";
$op->output();
?>
</div>
</body>
</html>