<?php
/*
*      Date: 13-9-25
*   
*    <<<  大数据量EXCEL文件读取  >>>
*       created by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/


#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#链接EXCEL文件读取类
require_once sysPath . 'class/excel_reader.class.php';

$actionUrl = $_GET ['a'];
if (!isset ($_POST ['step']))
    $_POST ['step'] = '0';

$title = "";

switch ($actionUrl) {
    case "soInsFeeMulInsert":
        //代理平账, 社保缴交明细导入

        break;


}
if ($_POST ['step'] == "1") {
    $excel_file = $_FILES ['excel_file'];
    //	解决文件名中文的情况
    $_FILES ['excel_file'] ['name'] = iconv ( "GBK", "utf-8", $_FILES ['excel_file'] ['name'] );
    $_FILES ['excel_file'] ['tmp_name'] = iconv ( "GBK", "utf-8", $_FILES ['excel_file'] ['tmp_name'] );

    if ($excel_file)
        $excel_file = $_FILES ['excel_file'] ['tmp_name'];
    if ($excel_file == '')
        $errorMsg = fatal ( "没上传文件或重命名文件名" );

    move_uploaded_file ( $excel_file, 'upload/' . $_FILES ['excel_file'] ['name'] );
    $excel_file = 'upload/' . $_FILES ['excel_file'] ['name'];

    $data = new Spreadsheet_Excel_Reader($excel_file);
    $data->setOutputEncoding("UTF-8");
   echo $data->dump(true,true);

}
#模板变量配置
if ($errorMsg)
    $smarty->assign("errorMsg", $errorMsg);
if ($extraFieldset)
    $smarty->assign("extraFieldset", $extraFieldset);
$smarty->assign("fieldHeader", $fieldHeader);
$smarty->assign("cellArr", $cellArr);
$smarty->assign("db_table", $db_table);
$smarty->assign("fieldHeader", $fieldHeader);
$smarty->assign("insertInfo", $insertInfo);
$smarty->assign("insuranceID", insuranceID());
if ($dataInfo)
    $smarty->assign("dataInfo", $dataInfo);

#模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("excelAction/readExcel.tpl");