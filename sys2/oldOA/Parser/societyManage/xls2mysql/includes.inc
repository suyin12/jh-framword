<?php
//输出表单头部
function fieldHeader($tab)
{
    $i=$tab;
    switch ($i)
    {
        case "society1tmp":
        case  "society3tmp":
             $fieldHeader='<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="95%"> 
		<thead>
		<tr bgcolor="#CAE8EA" style="text-align:center;">
    <td>姓名</td>
    <td>电脑号</td>
    <td>身份证</td>
    <td>户口</td>
    <td>缴交基数</td>
    <td>养老</td>
    <td>医疗</td>
    <td>工伤</td>
    <td>失业</td>
    <td>住房</td>
    <td>备注</td>
     </tr>
    </thead>
    ';
             break;
        case "soConvertSBB":
         $fieldHeader='<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="95%"> 
	<thead>
		<tr bgcolor="#CAE8EA" style="text-align:center;">
    <td rowspan="2">姓名</td>
    <td rowspan="2">电脑号</td>
    <td colspan="2">缴交基数</td>
    <td rowspan="2">身份证</td>
    <td colspan="3">户口</td>
    <td rowspan="2">养老</td>
    <td colspan="3">医疗</td>
    <td rowspan="2">失业</td>
    <td rowspan="2">工伤</td>
    <td rowspan="2">住房</td>
    <td rowspan="2">备注</td>
    </tr>
    <tr bgcolor="#CAE8EA" style="text-align:center;">
    <td>工资</td>
    <td>住房基数</td>
    <td>深沪</td>
    <td>非深户城镇</td>
    <td>非深户农村</td>
    <td>综合</td>
    <td>住院</td>
    <td>农民工</td>
    </tr>
    </thead>';
               break;
	
 }
    return $fieldHeader;
}
	

	

function print_error( $msg )
	{
		print <<<END
		<tr>
			<td colspan=5><font color=red><b>Error: </b></font>$msg</td>
			<td><font color=red><b>Rejected</b></font></td>
		</tr>
END;
	}

function getHeader( $exc, $data )
{
		// string
	
		$ind = $data['data'];
		if( $exc->sst[unicode][$ind] )
			return convertUnicodeString ($exc->sst['data'][$ind]);
		else
			return $exc->sst['data'][$ind];

}


function convertUnicodeString( $str )
{
	for( $i=0; $i<strlen($str)/2; $i++ )
	{
		$no = $i*2;
		$hi = ord( $str[$no+1] );
		$lo = $str[$no];
		
		if( $hi != 0 )
			continue;
		elseif( ! ctype_alnum( $lo ) )
			continue;
		else
			$result .= $lo;
	}
	
	return $result;
}
function getmicrotime() {
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}

function uc2html($str) {
	$ret = '';
	for( $i=0; $i<strlen($str)/2; $i++ ) {
		$charcode = ord($str[$i*2])+256*ord($str[$i*2+1]);
		// $ret .= '&#'.$charcode; 
 $ret .= u2utf8($charcode); 

	}
	return $ret;
}
 // ����u2utf8Ϊ   
 
function u2utf8($c) { 
$str=""; 
if ($c < 0x80) { 
  $str.=chr($c); 
} else if ($c < 0x800) { 
  $str.=chr(0xC0 | $c>>6); 
  $str.=chr(0x80 | $c & 0x3F); 
} else if ($c < 0x10000) { 
  $str.=chr(0xE0 | $c>>12); 
  $str.=chr(0x80 | $c>>6 & 0x3F); 
  $str.=chr(0x80 | $c & 0x3F); 
} else if ($c < 0x200000) { 
  $str.=chr(0xF0 | $c>>18); 
  $str.=chr(0x80 | $c>>12 & 0x3F); 
  $str.=chr(0x80 | $c>>6 & 0x3F); 
  $str.=chr(0x80 | $c & 0x3F); 
}
return $str; 
}





function show_time() {
	global $time_start,$time_end;

	$time = $time_end - $time_start;
	echo "Parsing done in $time seconds<hr size=1><br>";
}

function fatal($msg = '') {
	echo '[错误提示]';
	if( strlen($msg) > 0 )
		echo ": $msg";
	echo "<br>\n读取脚本终止<br>\n";
	if( $f_opened) @fclose($fh);
	exit();
};


    
  


function   get(   $exc,   $data   )   
  {   
  switch(   $data['type']   )   
  {   
  //   string   
  case   0:   
  $ind   =   $data['data'];   
  if(   $exc->sst[unicode][$ind]   )   {   
  return   uc2html($exc->sst['data'][$ind]);//
  }else   
  return   $exc->sst['data'][$ind];   
  //   integer   
  case   1:   
  return   (integer)   $data['data'];   
  //   float   
  case   2:   
  return   (float)   $data['data'];   
                  case   3:   
  return   gmdate("m-d-Y",$exc->xls2tstamp($data[data]));   
  default:   
  return   '';   
  }   
  }







function getTableData ( $ws, $exc ) {
		
	global $excel_file, $db_table;
	global $db_host, $db_name, $db_user, $db_pass;
	
	if ( !isset ( $_POST['useheads'] ) )
		$_POST['useheads'] = "";
	
	$data = $ws['cell'];
	
echo <<<FORM
     <div>
	<form action="" method="POST" name="db_export" >
	<!--<table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="100%">-->
	<div style="visibility:hidden">
	<table>
	<tr>
FORM;

// Form fieldnames
	
if ( !$_POST['useheaders'] ) {
	for ( $j = 0; $j <= $ws['max_col']; $j++ ) {

		$field = "field" . $j;
						
		echo <<<HEADER

		<td>
		<input type="checkbox" name="fieldcheck[$j]" value="$j" checked title="Check to proceed this field">
		<input type="text" name="fieldname[$j]" value="$field" title="Field name" style="width:50px;">
	</td>

HEADER;
	}
	
}
else {
	for ( $j = 0; $j <= $ws['max_col']; $j++ ) {
		
		$field = getHeader ( $exc, $data[0][$j] );
			
		$field = ereg_replace ( "^[0-9]+", "", $field );
		
		if (empty ($field) )
			$field = "field" . $j;
		
		echo <<<HEADER

		<td>
		<input type="checkbox" name="fieldcheck[$j]" value="$j" checked title="Check to proceed this field">
		<input type="text" name="fieldname[$j]" value="$field" title="Field name" >
		</td>
  
HEADER;
	}
}

	
	echo "</tr></table></div>";
	
	echo fieldHeader($_GET['table']);
	foreach( $data as $i => $row ) { // Output data and prepare SQL instructions
		
				
		if ( $i == 0 && $_POST['useheaders'] )
		continue;
		
		echo "<tr bgcolor=\"#ffffff\">";
		
		for ( $j = 0; $j <= $ws['max_col']; $j++ ) {
		
			$cell = get ( $exc, $row[$j] );
			echo "<td>$cell</td>";
					
		}
		
		echo "</tr>";
		$i++;
	}
	
	if ( empty ( $db_table ) )
		$db_table = "Table1";

					
echo <<<FORM2
   
	
	</table></div><br>
	<table align="center" width="100%">
	<tr><!--<td>请选择月份:</td>--><td>
	<!--<input type="text" name="db_table" value="$db_table">-->
	<input  type="hidden" name="db_table" value="$_GET[table]"/>
	<!--<select name="db_table">
	<option value="">--请选择--</option>
	<option value="yue1">1月</option>
	<option value="yue2">2月</option>
	<option value="yue3">3月</option>
	<option value="yue4">4月</option>
	<option value="yue5">5月</option>
	<option value="yue6">6月</option>
	<option value="yue7">7月</option>
	<option value="yue8">8月</option>
	<option value="yue9">9月</option>
	<option value="yue10">10月</option>
	<option value="yue11">11月</option>
	<option value="yue12">12月</option>
	</select>-->
	<td><input type="submit" name="submit" value="添加"></td>
	</tr>
    
	<tr style="visibility:hidden"><td>如果表名存在,则删除:</td><td><input type="checkbox" name="db_drop" unchecked></td></tr>
	<tr style="visibility:hidden"><td colspan="2">
	<i>不打钩,表示不删除已有的数据库表.<br><font color="red">
	注意:如果你已经定义了数据库表的字段名,那么重定义字段后,插入的数据会出错!</td></tr>
	<tr style="visibility:hidden"><td>数据库主机:</td><td>&nbsp;<input type="text" size=30 name="db_host" value="$db_host"></td></tr>
	<tr style="visibility:hidden"><td>数据库名:</td><td>&nbsp;<input type="text" size=30 name="db_name" value="$db_name"></td></tr>
	<tr style="visibility:hidden"><td>用户名:</td><td>&nbsp;<input type="text" size=30 name="db_user" value="$db_user"></td></tr>
	<tr style="visibility:hidden"><td>密码:</td><td>&nbsp;<input type="password" size=30 name="db_pass" value="$db_pass"></td></tr>
	<tr><td><input type="hidden" name="excel_file" value="$excel_file"></tr>
	<tr>
	<td><input type="hidden" name="useheaders" value="$_POST[useheaders]"></td>
	<td><input type="hidden" name="step" value="2"></td>
	</tr>
	</table>
	</form>
	</table>
	</div>
FORM2;


} 



function prepareTableData ( $exc, $ws, $fieldcheck, $fieldname ) {
    session_start();
    $data = $ws['cell'];
	
	
	foreach( $data as $i => $row ) { // Output data and prepare SQL instructions
		
	
		if ( $i == 0 && $_POST['useheaders'] )
			continue;
		
		$SQL[$i] = "";
		
		for ( $j = 0; $j <= $ws['max_col']; $j++ ) {
		
			if ( isset($fieldcheck[$j]) ) {
			
								
				$SQL[$i] .= $fieldname[$j];
				$SQL[$i] .= "=\"";
				$SQL[$i] .= trim(addslashes ( get ( $exc, $row[$j] ) ));
				$SQL[$i] .= "\"";
				
				$SQL[$i] .= ",";
				
							
			}
	   
				
		}
//			$salaryNo=addslashes ( get ( $exc, $row[4] ) );
//			$month=addslashes ( get ( $exc, $row[0] ) );
//		//echo "<br>dfadfa=".
//		$title=substr(trim($month),0,4)."年".substr($month,4,5)."月份工资条";
//		//echo $salaryNo;
//		//echo $title;
//		$today =date('Ymd');
//		$messageSql="insert into message set sender='鑫锦程公司',
//		                                     receiver=(select field7 from workerinfo where field28='$salaryNo'),
//		                                     title='$title',
//											 sendTime=$today,
//											 sessionID='$_SESSION[UserID]',
//											 stauts=0";
//		mysql_query($messageSql);
		
		$SQL[$i] .="sessionID=$_SESSION[UserID],";
//         $SQL[$i] .="sessionID=1,";
		$SQL[$i] = rtrim($SQL[$i], ',');
		
		$i++;
		
	}
	 
	
	return $SQL;	
			
} 

?>