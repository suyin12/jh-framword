<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/*    <<<<<<<<  批量导入首页  >>>>>>>>>
 * 
 * 该文档被我改得一大堆
 * 除了显示部分和读取excel部分,其他的全都改了...
 * smarty  都可以做,但是没用着做,,
 * 
和之前相比呢..其实就是增加了 验证函数和一个基本配置函数,

验证函数{  validator()  }返回的结果集为 $error的数组形式,错误类型,错误的数据,当返回的结果集为true时,则进行导入操作,,

基本的配置函数{  set()  }返回的数组类型 包括, 导入的表名$db_table,该功能的文件名$title,导入的字段名$field,导入的表显示格式$fieldHeader,

使用get操作方法,判断具体是哪个批量导入功能,对应的使用相应的函数
* */
require_once '../settings.inc';
require_once ("excelparser.php");
require_once ("includes.php");
if (! isset($_POST['step']))
    $_POST['step'] = 0;
?>

<html>
<head>
<STYLE type="text/css">
body,table,tr,td {
	font-size: 14px;
	font-family: Verdana, MS sans serif, Arial, Helvetica, sans-serif
}
</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/multipleInsert.css" type="text/javascript"
	rel="stylesheet" />
</head>
<body>
<table width="100%" align="center" bgcolor="#4f6b72">
	<tr>
		<td width="100%"><font color="#FFFFFF" size="+2"></font></td>
	</tr>
</table>

<?php
// Outputting fileselect form (step 0)
/**
 * 简单的应用
 */
if ($_POST['step'] == 0)
    echo <<<FORM
<table width="100%" border="0" align="center" bgcolor="#CAE8EA">
<tr>
<td>&nbsp;</td>
<td>
<p>&nbsp;</p>
选择一个Excel文档
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>

<table border="0">
<form name="exc_upload" method="post" action="" enctype="multipart/form-data">

<tr><td>Excel文档:</td><td><input type="file" size="25" name="excel_file"></td></tr>
<tr ><td>第一行为标题栏:</td><td><input type="checkbox" name="useheaders" checked></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="step" value="1">
<input type="button" value="下一步" onClick="
javascript:
if( (document.exc_upload.excel_file.value.length==0))
{ alert('请选择Excel文档'); return; }; submit();
"></td></tr>


</form>
</table>

</td>
</tr>


<tr>
<td>&nbsp;</td>
<td align="right">
<p>&nbsp;</p>
</td>
</tr>
</table>

FORM;
    // Processing excel file (step 1)
if ($_POST['step'] == 1) {
    echo "<br>";
    // Uploading file
    $excel_file = $_FILES['excel_file'];
    #解决文件名中文的情况
    $_FILES['excel_file']['name'] = iconv("GBK", "utf-8", $_FILES['excel_file']['name']);
    $_FILES['excel_file']['tmp_name'] = iconv("GBK", "utf-8", $_FILES['excel_file']['tmp_name']);
    if ($excel_file)
        $excel_file = $_FILES['excel_file']['tmp_name'];
		// print_r($excel_file);
    if ($excel_file == '')
        fatal("没上传文件或重命名文件名");
    move_uploaded_file($excel_file, 'upload/' . $_FILES['excel_file']['name']);
    $excel_file = 'upload/' . $_FILES['excel_file']['name'];
    $fh = @fopen($excel_file, 'rb');
    if (! $fh)
        fatal("没上传文件或者文件名是中文,建议把文件名改为数字如'20081018'");
    if (filesize($excel_file) == 0)
        fatal("没上传文件或者文件名是中文");
    $fc = fread($fh, filesize($excel_file));
    @fclose($fh);
    if (strlen($fc) < filesize($excel_file))
        fatal("Cannot read file");
        // Check excel file
    $exc = new ExcelFileParser();
    $res = $exc->ParseFromString($fc);
    switch ($res) {
        case 0:
            break;
        case 1:
            fatal("无法打开文件");
        case 2:
            fatal("文件太小,不是一个Excel文档");
        case 3:
            fatal("无法读取文件头");
        case 4:
            fatal("读取文件时出错");
        case 5:
            fatal("这不是一个Excel文档,请选择版本低于5.0 的Excel");
        case 6:
            fatal("File corrupted");
        case 7:
            fatal("Excel文档中没有数据或者该文档不是Excel文档");
        case 8:
            fatal("不支持文件的版本");
        default:
            fatal("未知错误");
    }
    // Pricessing worksheets
    $ws_number = count($exc->worksheet['name']);
    if ($ws_number < 1)
        fatal("在 Excel文件中没有sheet.");
    $ws_number = 1; // Setting to process only the first worksheet
    $ws_n = 0;
    //  这里把循环去掉了..只读取第一个sheet
    //	for($ws_n = 0; $ws_n < $ws_number; $ws_n ++) {
    $ws = $exc->worksheet['data'][$ws_n]; // Get worksheet data
    #加载相应的类文件(基本配置函数,及验证函数)
    $actionUrl = $_GET['a'];
    $cellVal = cellVal($ws, $exc);
    echo "<pre>";
    switch ($actionUrl) {
        case "wMulModify":
            require_once '../workerManager/wMulModify.php';
            $valid = new wMulModify();
            $valid->sqlCon();
            $cellVal = $valid->cellArray($cellVal);
            $colValid = $valid->cellArray;
            if ($colValid) {
                //生成异常数据数组
                $errMsg = $valid->validator();
                $errMsgSql = $valid->validatorSql();
            }
            break;
    }

    #抛出错误信息
    if ($colValid) {
        if (! empty($errMsg) || ! empty($errMsgSql)) {
            echo fetchArray($errMsg);
            echo "<br/>";
            echo fetchArray($errMsgSql);
        } else {
            
//            switch ($actionUrl) {
//                case "wMulInsert":
//                case "wMulModify":
//                    //生成相应信息
////                    echo $valid->dataInfo();
//                    break;
//            }
            if (! $exc->worksheet['unicode'][$ws_n])
                $db_table = $ws_name = $exc->worksheet['name'][$ws_n];
            else {
                $ws_name = uc2html($exc->worksheet['name'][$ws_n]);
                $db_table = convertUnicodeString($exc->worksheet['name'][$ws_n]);
            }
            echo "<div align=\"center\">当前文档: <b>$ws_name</b></div><br>";
            $max_row = $ws['max_row'];
            $max_col = $ws['max_col'];
            if ($max_row > 0 && $max_col > 0)
                getTableData(&$ws, &$exc); // Get structure and data of worksheet
            else
                fatal("空文档");
        }
    } else {
        echo "1.请验证你的表格数据列是否完整";
    }
}
if ($_POST['step'] == 2) {
    // Adding data into mysql (step 2)
    $excel_file = $_POST['excel_file'];
    $fh = @fopen($excel_file, 'rb');
    if (! $fh)
        fatal("请重新上传文件,禁止非法刷新重复添加");
    if (filesize($excel_file) == 0)
        fatal("没上传文件或者文件名是中文");
    $fc = fread($fh, filesize($excel_file));
    @fclose($fh);
    if (strlen($fc) < filesize($excel_file))
        fatal("Cannot read file");
        // Check excel file
    $exc = new ExcelFileParser();
    $res = $exc->ParseFromString($fc);
    switch ($res) {
        case 0:
            break;
        case 1:
            fatal("无法打开文件");
        case 2:
            fatal("文件太小,不是一个Excel文档");
        case 3:
            fatal("无法读取文件头");
        case 4:
            fatal("读取文件时出错");
        case 5:
            fatal("这不是一个Excel文档,请选择版本低于5.0 的Excel");
        case 6:
            fatal("File corrupted");
        case 7:
            fatal("Excel文档中没有数据或者该文档不是Excel文档");
        case 8:
            fatal("不支持文件的版本");
        default:
            fatal("未知错误");
    }
    // Pricessing worksheets
    $ws_number = count($exc->worksheet['name']);
    if ($ws_number < 1)
        fatal("在 Excel文件中没有sheet.");
    $ws_number = 1; // Setting to process only the first worksheet
    $ws_n = 0;
    $ws = $exc->worksheet['data'][$ws_n]; // Get worksheet data
    #加载相应的类文件(基本配置函数,及验证函数)
    $actionUrl = $_GET['a'];
    $cellVal = cellVal($ws, $exc);
    switch ($actionUrl) {
        case "wMulModify":
            require_once '../workerManager/' . $actionUrl . '.php';
            $valid = new $actionUrl();
            $valid->sqlCon();
            $cellVal = $valid->cellArray($cellVal);
            //生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
            $cellArray = $valid->extraFieldValue();
            $sql = $valid->sql();
//            print_r($sql);
            break;
    }
    	$result =$valid-> extraTransaction($sql);
//    	var_dump($result);
    $err = $result['error'];
    $execNum = $result['num'];
    if (! empty($err)) {
        $err .= "<br/>发生未知错误,请联系管理员";
    }
    if (empty($err)) {
        $insertInfo .= '<div align="center"><b>添加记录成功.</b><br><br>	总共' . $execNum . '行插入表中 <br/></div>';
        echo $insertInfo;
    } else
        echo "<br><br><div align=\"center\"><font color=\"red\">$err</font><br><br><a href='index.php?a=$actionUrl>继续</a></div>";
    @unlink($excel_file);
}
?>
</body>
</html>
</div>
</body>
</html>