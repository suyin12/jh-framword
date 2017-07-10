<?php
require_once '../../../header/societyHeader.php';
if (!defined('ALLOW'))exit();
include_once '../../../settings.inc';
include_once ("./includes.inc");
//include_once ("$parser_path/excelparser.php");
include_once ("../../excelparser.php");
//echo 'dfasfasd=',$_GET[table];
if ( !isset($_POST['step']) )
	$_POST['step'] = 0;
	
?>

<html>
<head>
<STYLE>

body, table, tr, td {font-size: 14px; font-family: Verdana, MS sans serif, Arial, Helvetica, sans-serif}


</STYLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/multipleInsert.css" type="text/javascript" rel="stylesheet" />
</head>
<body text="#000000" link="#000000" vlink="#000000" alink="#000000" topmargin="0" leftmargin="2" marginwidth="0" marginheight="0">
<table width="100%" align="center" bgcolor="#4f6b72">
<tr>
<td width="100%"><font color="#FFFFFF" size="+2"></font></td>
</tr>
</table>

<?php

// Outputting fileselect form (step 0)

if ( $_POST['step'] == 0 )
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
<tr style="visibility:hidden"><td>选择第一行作为数据库字段:</td><td><input type="checkbox" name="useheaders"></td></tr>
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

if ( $_POST['step'] == 1 ) {
	
	echo "<br>";
	
	// Uploading file
	
	$excel_file = $_FILES['excel_file'];
	if( $excel_file )
		$excel_file = $_FILES['excel_file']['tmp_name'];

	if( $excel_file == '' ) fatal("没上传文件或者文件名是中文");
	
	move_uploaded_file( $excel_file, 'upload/' . $_FILES['excel_file']['name']);	
	$excel_file = 'upload/' . $_FILES['excel_file']['name'];
	
	
	$fh = @fopen ($excel_file,'rb');
	if( !$fh ) fatal("没上传文件或者文件名是中文,建议把文件名改为数字如'20081018'");
	if( filesize($excel_file)==0 ) fatal("没上传文件或者文件名是中文");

	$fc = fread( $fh, filesize($excel_file) );
	@fclose($fh);
	if( strlen($fc) < filesize($excel_file) )
		fatal("Cannot read file");	
	
	
	// Check excel file
	
	$exc = new ExcelFileParser;
	$res = $exc->ParseFromString($fc);
	
	switch ($res) {
		case 0: break;
		case 1: fatal("无法打开文件");
		case 2: fatal("文件太小,不是一个Excel文档");
		case 3: fatal("无法读取文件头");
		case 4: fatal("读取文件时出错");
		case 5: fatal("这不是一个Excel文档,请选择版本低于5.0 的Excel");
		case 6: fatal("File corrupted");
		case 7: fatal("Excel文档中没有数据或者该文档不是Excel文档");
		case 8: fatal("不支持文件的版本");

		default:
			fatal("未知错误");
	}
	
		
	// Pricessing worksheets
	
	$ws_number = count($exc->worksheet['name']);
	if( $ws_number < 1 ) fatal("在 Excel文件中没有sheet.");
	
	$ws_number = 1; // Setting to process only the first worksheet
	
	for ($ws_n = 0; $ws_n < $ws_number; $ws_n++) {
		
		$ws = $exc -> worksheet['data'][$ws_n]; // Get worksheet data
			
		if ( !$exc->worksheet['unicode'][$ws_n] )
			$db_table = $ws_name = $exc -> worksheet['name'][$ws_n];
		else 	{
			$ws_name = uc2html( $exc -> worksheet['name'][$ws_n] );
			$db_table = convertUnicodeString ( $exc -> worksheet['name'][$ws_n] );
			}
		
		echo "<div align=\"center\">当前文档: <b>$ws_name</b></div><br>";

		
		$max_row = $ws['max_row'];
		$max_col = $ws['max_col'];
		
		if ( $max_row > 0 && $max_col > 0 )
			getTableData ( &$ws, &$exc ); // Get structure and data of worksheet
		else fatal("空文档");
		
	}
	
}

if ( $_POST['step'] == 2 ) { // Adding data into mysql (step 2)
		
	echo "<br>";
	
	extract ($_POST);
		
	$db_table = ereg_replace ( "[^a-zA-Z0-9$]", "", $db_table );
	$db_table = ereg_replace ( "^[0-9]+", "", $db_table );
	
	if ( empty ( $db_table ) )
		$db_table = "Table1";
	
	// Database connect check
	
	if ( !$link = @mysql_connect ($db_host, $db_user, $db_pass) )
        fatal("Database connection error. Please check connection settings.");
	
	if ( !$connect = mysql_select_db ($db_name ) )
        fatal("Wrong database name.");
		
	if ( empty ($db_table) )
		fatal("Empty table name.");
	
	if ( !isset ($fieldcheck) )
		fatal("No fields selected.");
	
	if ( !is_array ($fieldcheck) )
		fatal("No fields selected.");
	
	$tbl_SQL .= "CREATE TABLE IF NOT EXISTS $db_table( ";
	
	foreach ($fieldcheck as $fc)
		if ( empty ( $fieldname[$fc] ) )
			fatal("Empty fieldname for selected field $fc.");
		else {
			// Prepare table structure
			
			$fieldname[$fc] = ereg_replace ( "[^a-zA-Z0-9$]", "", $fieldname[$fc] );
			$fieldname[$fc] = ereg_replace ( "^[0-9]+", "", $fieldname[$fc] );
			if ( empty ( $fieldname[$fc] ) )
					$fieldname[$fc] = "field" . $fc;
			
			$tbl_SQL .= $fieldname[$fc] . " varchar(50) NOT NULL,";
			
		}
	
	$tbl_SQL = rtrim($tbl_SQL, ',');
	
	$tbl_SQL .= ") TYPE=MyISAM";

	
	$fh = @fopen ($excel_file,'rb');
	if( !$fh ) fatal("No file uploaded");
	if( filesize($excel_file)==0 ) fatal("No file uploaded");

	$fc = fread( $fh, filesize($excel_file) );
	@fclose($fh);
	if( strlen($fc) < filesize($excel_file) )
		fatal("Cannot read file");		
	
	
	$exc = new ExcelFileParser;
	$res = $exc->ParseFromString($fc);
	
	switch ($res) {
		case 0: break;
		case 1: fatal("无法打开文件");
		case 2: fatal("文件太小,不是一个Excel文档");
		case 3: fatal("无法读取文件头");
		case 4: fatal("读取文件时出错");
		case 5: fatal("这不是一个Excel文档,请选择版本低于5.0 的Excel");
		case 6: fatal("File corrupted");
		case 7: fatal("Excel文档中没有数据或者该文档不是Excel文档");
		case 8: fatal("不支持文件的版本");

		default:
			fatal("未知错误");
	}
	
	// Pricessing worksheets
	
	$ws_number = count($exc->worksheet['name']);
	if( $ws_number < 1 ) fatal("No worksheets in Excel file.");
	
	$ws_number = 1; // Setting to process only the first worksheet
	
	for ($ws_n = 0; $ws_n < $ws_number; $ws_n++) {
		
		$ws = $exc -> worksheet['data'][$ws_n]; // Get worksheet data
			
		$max_row = $ws['max_row'];
		$max_col = $ws['max_col'];
		
		if ( $max_row > 0 && $max_col > 0 )
			$SQL = prepareTableData ( &$exc, &$ws, $fieldcheck, $fieldname );
		else fatal("Empty worksheet");
		
	}
	
		
	if (empty ( $SQL ))
		fatal("Output table error");


	// Output data into database
	
	
	// Drop table
	
	if ( isset($db_drop) ) {
	
		$drop_tbl_SQL = "DROP TABLE IF EXISTS $db_table";
		
		if ( !mysql_query ($drop_tbl_SQL) )
			fatal ("Drop table error");
	
	}
	
	// Create table
	
       
       
	if ( !mysql_query ($tbl_SQL) )
		fatal ("Create table error");
	
	$sql_pref = "INSERT INTO " . $db_table . " SET ";	
	
	
	$err = "";	
	$nmb = 0; // Number of inserted rows
	$alterTable="alter table $db_table add sessionID varchar(20) not null";
        mysql_query($alterTable,$db_con);
	$alterTable="alter table $db_table add ID int(50)  PRIMARY KEY auto_increment not null";
        mysql_query($alterTable,$db_con);//添加字段
//	$alterTable="ALTER TABLE $db_table ADD UNIQUE(`field4`)";
//        mysql_query($alterTable,$db_con);
//    
	
	foreach ( $SQL as $sql ) {
	
		$sql = $sql_pref . $sql;
		$sql =$sql.$_SESSION['exp_user']['mID'];
		if ( !mysql_query ($sql) ) {
		$err .= "<b>SQL error in</b> :<br>$sql <br>";
			
		}
		else {$nmb++;
//		  $insertsql1="insert into $db_table(ID)values($nmb) ";
//		  mysql_query($insertsql1,$db_con);
		}
			
	}
	
//	$selectesql="select * from $db_table";
//	$r1=mysql_query($selectsql,$db_con);

//	$selectsql="select * from $db_table"; 
//		 $r1=mysql_query($selectsql,$db_con);
//		$selectnum=mysql_num_rows($r1);
//    $selectnum=mysql_num_rows($r1);   //表的行数(ID值)
//    echo $selectnum;
//    $updatesql="update $db_table set ID=(ID+$nmb)";
//		mysql_query($updatesql,$db_con);
//	for($updateI=($selectnum-$nmb+1);$updateI<=$selectnum;$updateI++)
//	{
//		echo "--".$updateI;
////		$updatesql="update $db_table set ID=$updateI limit 1 ";
//			
//		
//	}
	if ( empty ($err) ) {
		
		echo <<<SUCC
		<br><br>
		<div align="center">
		<b>添加记录成功.</b><br><br>
		总共$nmb 行插入表 "$db_table"中<br>
		<br><a href="index.php?table=$db_table">继续</a>
		

		</div>
		
SUCC;
        
//		$selectsql="select * from $db_table"; 
//		 $r1=mysql_query($selectsql,$db_con);
//		$selectnum=mysql_num_rows($r1);   //表的行数
//		$deletenum=$selectnum-$nmb;//要删除的行数
//		echo "表中有".$selectnum."行";
//		echo "要从第".($deletenum+1)."行起删除";
		
//		for($r2=$selectnum;$r2>$deletenum;$r2--){
//		$deletesql="DELETE FROM $db_table WHERE ID";
//		mysql_query($deletesql,$db_con);
//		}
		
	}
	else 	echo "<br><br><font color=\"red\">$err</font><br><br><div align=\"center\"><a href='index.php?table=$db_table'>继续</a></div>";
	
	@unlink ($excel_file);

	echo <<<ZAKKIS
	
	<br><br>
	<div align="right">
	</div>
	
ZAKKIS;
	
}		
	
?>