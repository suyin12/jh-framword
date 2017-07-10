<?php

/*
 *     2012-01-09
 *          <<<  该版本,改换为PARSE版本的EXCEL 导入, 区别于phpexcel版本, 效率较高
 *                  读取EXCEL; 可以读取多个sheet , 并且可以把多个sheet的数组 合并数据,但是多个sheet格式必须一致 
 *             设置get参数mulSheet=1 则合并数据,否则默认为第一个sheet,,,,最主要的是暂时不开放多个sheet的功能,,,
 *             需要用是 只需设置GET参数即可
 *            >>>
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
#连接EXCEL类
require_once sysPath . 'class/Parser/excelparser.php';
require_once sysPath . 'class/Parser/includes.php';
#输出错误信息

function excelToArray($file, $startRow) {
    $exc = new ExcelFileParser ();
    $res = $exc->ParseFromString($file);
    switch ($res) {
        case 0 :
            break;
        case 1 :
            fatal("无法打开文件");
        case 2 :
            fatal("文件太小,不是一个Excel文档");
        case 3 :
            fatal("无法读取文件头");
        case 4 :
            fatal("读取文件时出错");
        case 5 :
            fatal("这不是一个Excel文档,请选择版本低于5.0 的Excel");
        case 6 :
            fatal("File corrupted");
        case 7 :
            fatal("Excel文档中没有数据或者该文档不是Excel文档");
        case 8 :
            fatal("不支持文件的版本");

        default :
            fatal("未知错误");
    }
    $ws_number = count($exc->worksheet ['name']);
    if ($ws_number < 1)
        fatal("在 Excel文件中没有sheet.");
    $ws_number = 1;
    $ws_n = 0;
    $ws = $exc->worksheet ['data'] [$ws_n];

    $excelData = cellVal($ws, $exc, $startRow);
    return $excelData;
}

$actionUrl = $_GET ['a'];
if (!isset($_POST ['step']))
    $_POST ['step'] = '0';

$title = "导入EXCEL";

if ($_POST ['step'] == "1") {
    $excel_file = $_FILES ['excel_file'];
    //	解决文件名中文的情况
    $_FILES ['excel_file'] ['name'] = iconv("GBK", "utf-8", $_FILES ['excel_file'] ['name']);
    $_FILES ['excel_file'] ['tmp_name'] = iconv("GBK", "utf-8", $_FILES ['excel_file'] ['tmp_name']);

    if ($excel_file)
        $excel_file = $_FILES ['excel_file'] ['tmp_name'];
    if ($excel_file == '')
        $errorMsg = fatal("没上传文件或重命名文件名");

    move_uploaded_file($excel_file, 'upload/' . $_FILES ['excel_file'] ['name']);
    $excel_file = 'upload/' . $_FILES ['excel_file'] ['name'];

    $fh = @fopen($excel_file, 'rb');
    if (!$fh)
        $errorMsg = fatal("没上传文件");
    if (filesize($excel_file) == 0)
        $errorMsg = fatal("没上传文件,或文件过小");

    $fc = fread($fh, filesize($excel_file));
    @fclose($fh);
    if (strlen($fc) < filesize($excel_file))
        $errorMsg = fatal("无法读取文件");

    if (!$errorMsg) {
        $smarty->assign("excel_file", $excel_file);
        //取得有效行,并且去除每个单元格空格
        if ($_POST ['startRow']) {
            $startRow = $_POST ['startRow'];
            $newCellVal = excelToArray($fc, $startRow);
        }
        #加载相应的类文件(基本配置函数,及验证函数)
        switch ($actionUrl) {
            case "wMulInsert" :
            case "wMulInsertSp" :
                require_once sysPath . 'workerInfo/' . $actionUrl . '.php';
                $valid = new $actionUrl ();
                $valid->p = $pdo;
                $valid->cellArray($newCellVal);
                $cellArr = $valid->cellArray;
                if ($cellArr) {
                    //生成异常数据数组
                    $errMsg = $valid->validator();
                    $errMsgSql = $valid->validatorSql();
                    //生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
                    //				$cellArray = $valid->extraFieldValue ();
                }
                break;
            case "wMulModify" :
            case "wMulModifySp":
                require_once sysPath . 'workerInfo/' . $actionUrl . '.php';
                $valid = new $actionUrl ();
                $valid->p = $pdo;
                $valid->cellArray($newCellVal);
                $cellArr = $valid->cellArray;
                if ($cellArr) {
                    //生成异常数据数组
                    $errMsg = $valid->validator();
                    $errMsgSql = $valid->validatorSql();
                    //生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
                    //				$cellArray = $valid->extraFieldValue ();
                }
                break;

            case "sCheckMulInsert" :
                require_once sysPath . 'superCheck/sCheckMulInsert.php';
                $valid = new sCheckMulInsert ();
                $valid->p = $pdo;
                $valid->zID = $_GET ['zID'];
                $valid->t = $_GET["t"];
                $valid->field();
                $valid->cellArray($newCellVal);
                $cellArr = $valid->cellArray;
                foreach ($_GET as $getKey => $getVal) {
                    switch ($getKey) {
                        case "zID" :
                            if (is_numeric($getVal))
                                $getQuery [$getKey] = $getVal;
                            else
                                exit("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                            break;
                        default :
                            $getQuery [$getKey] = $getVal;
                            break;
                    }
                }

                break;
            default :
                exit("非法网址");
                break;
        }
        #抛出错误信息
        //	var_dump($valid->cellArray);
        if ($cellArr) {
            if (!empty($errMsg) || !empty($errMsgSql)) {
                $errorMsg = fetchArray($errMsg) . "<br/>" . fetchArray($errMsgSql);
            } else {
                //构造基本参数,页面显示
                $setArray = $valid->set($getQuery);
                $title = $setArray ['title'];
                $fieldHeader = $setArray ['fieldHeader'];
                $db_table = $setArray ['table'];
                //生成相应信息
                $dataInfo = $valid->dataInfo();
            }
        } else {
            $errorMsg = "1.请验证你的表格数据列是否完整 <br/>2. 表格底部无多余数据 <br>3.表格为无公式数据若有公式请尝试[ 在EXCEL中 <全选> -> <复制> -> <选择性粘贴(数值)>] ";
        }
    }
}
//这样分步可以防止POST多次提交,造成数据库出错
if ($_POST ['step'] == "2") {
    $excel_file = $_POST ['excel_file'];
    $fh = @fopen($excel_file, 'rb');
    if (!$fh)
        $errorMsg = fatal("请重新上传文件,禁止非法刷新重复添加");
    if (filesize($excel_file) == 0)
        $errorMsg = fatal("没上传文件,或上传文件过小");

    $fc = fread($fh, filesize($excel_file));
    @fclose($fh);
    if (strlen($fc) < filesize($excel_file))
        $errorMsg = fatal("无法读取文件");

    if (!$errorMsg) {
        //连接READEREXCEL 类
        if ($_POST ['startRow']) {
            $startRow = $_POST ['startRow'];
            $newCellVal = excelToArray($fc, $startRow);
        }

        #加载相应的类文件(基本配置函数,及验证函数)
        switch ($actionUrl) {
            case "wMulInsert" :
            case "wMulInsertSp":
            case "wMulModify" :
            case "wMulModifySp":
                require_once (sysPath . 'workerInfo/' . $actionUrl . '.php');
                $valid = new $actionUrl ();
                $valid->p = $pdo;
                $cellArr = $valid->cellArray($newCellVal);
                //生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
                $cellArray = $valid->extraFieldValue();
                $sql = $valid->sql();
                break;
            case "sCheckMulInsert" :
                require_once sysPath . 'superCheck/sCheckMulInsert.php';
                $valid = new sCheckMulInsert ();
                $valid->p = $pdo;
                $valid->zID = $_GET ['zID'];
                $valid->t = $_GET["t"];
                $valid->field();
                $valid->cellArray($newCellVal);
                $cellArr = $valid->cellArray;
                foreach ($_GET as $getKey => $getVal) {
                    switch ($getKey) {
                        case "zID" :
                            if (is_numeric($getVal))
                                $getQuery [$getKey] = $getVal;
                            else
                                exit("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                            break;
                        default :
                            $getQuery [$getKey] = $getVal;
                            break;
                    }
                }
                $setArray = $valid->set($getQuery);
                $valid->extraFieldValue($getQuery);
                $sql = $valid->sql();
                break;
        }

        $result = extraTransaction($pdo, $sql);
//        print_r($sql);
//        echo "<pre>";
//        print_r($pdo);
//        print_r ( $result );
        $err = $result ['error'];
        $execNum = $result ['num'];
        if (!empty($err)) {
            $err .= "发生未知错误,请联系管理员<br/>";
        } else {
            switch ($actionUrl) {
                case "wMulModify" :
                case "wMulModifySp":
                    $result = @$valid->extraTransaction($sql ['extra']);
                    break;
            }
        }
        if (empty($err)) {
            $insertInfo .= '导入成功,' . $valid->dataInfo() . ' <a href="readExcelParse.php?' . $_SERVER ['QUERY_STRING'] . '">继续导入</a>';
            switch ($actionUrl) {
                case "salaryMulInsert" :
                    $insertInfo .= "进入<a href='" . httpPath . "salaryManage/salaryManage.php?" . $_SERVER ['QUERY_STRING'] . "' target='_blank'>[  费用制作  ]</a>";
                    break;
                case "rewardMulInsert" :
                    $insertInfo .= "进入<a href='" . httpPath . "rewardManage/rewardManage.php?" . $_SERVER ['QUERY_STRING'] . "' target='_blank'>[  奖金制作  ]</a>";
                    break;
            }
        } else
            $errorMsg .= $err . "<a href='readExcel.php?" . $_SERVER ['QUERY_STRING'] . "'>重新导入</a>";

        @unlink($excel_file);
    }
}
#模板变量配置
if ($errorMsg)
    $smarty->assign("errorMsg", $errorMsg);
$smarty->assign("fieldHeader", $fieldHeader);
$smarty->assign("cellArr", $cellArr);
$smarty->assign("db_table", $db_table);
$smarty->assign("fieldHeader", $fieldHeader);
$smarty->assign("insertInfo", $insertInfo);
if ($dataInfo)
    $smarty->assign("dataInfo", $dataInfo);

#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("excelAction/readExcel.tpl");
?>