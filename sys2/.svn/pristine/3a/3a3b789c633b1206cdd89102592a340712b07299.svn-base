<?php


#递归函数
function fetchArray($array) {
	if (! empty ( $array )) {
		foreach ( $array as $val ) {
			if (is_array ( $val )) {
				$arrStr .= fetchArray ( $val );
			} else {
				$arrStr .= $val . "<br/>";
			}
		}
	}
	return $arrStr;
}

#组成CELL 数组
function cellVal($ws, $exc) {
	$data = $ws ['cell'];
	
	foreach ( $data as $i => $row ) { // Output data and prepare SQL instructions
		if ($i == 0 && $_POST ['useheaders'])
			continue;
		for($j = 0; $j <= $ws ['max_col']; $j ++) {
			$cell [$j] = get ( $exc, $row [$j] );
		}
		$cellVal [] = $cell;
		$i ++;
	
	}
	
	return $cellVal;
}

#提示错误信息
function print_error($msg) {
	print <<<END
		<tr>
			<td colspan=5><font color=red><b>Error: </b></font>$msg</td>
			<td><font color=red><b>Rejected</b></font></td>
		</tr>
END;
}

function getHeader($exc, $data) {
	// string
	$ind = $data ['data'];
	if ($exc->sst [unicode] [$ind])
		return convertUnicodeString ( $exc->sst ['data'] [$ind] );
	else
		return $exc->sst ['data'] [$ind];

}

function convertUnicodeString($str) {
	for($i = 0; $i < strlen ( $str ) / 2; $i ++) {
		$no = $i * 2;
		$hi = ord ( $str [$no + 1] );
		$lo = $str [$no];
		
		if ($hi != 0)
			continue;
		elseif (! ctype_alnum ( $lo ))
			continue;
		else
			$result .= $lo;
	}
	
	return $result;
}
function getmicrotime() {
	list ( $usec, $sec ) = explode ( " ", microtime () );
	return (( float ) $usec + ( float ) $sec);
}

function uc2html($str) {
	$ret = '';
	for($i = 0; $i < strlen ( $str ) / 2; $i ++) {
		$charcode = ord ( $str [$i * 2] ) + 256 * ord ( $str [$i * 2 + 1] );
		// $ret .= '&#'.$charcode; 
		$ret .= u2utf8 ( $charcode );
	
	}
	return $ret;
}
// ����u2utf8Ϊ   


function u2utf8($c) {
	$str = "";
	if ($c < 0x80) {
		$str .= chr ( $c );
	} else if ($c < 0x800) {
		$str .= chr ( 0xC0 | $c >> 6 );
		$str .= chr ( 0x80 | $c & 0x3F );
	} else if ($c < 0x10000) {
		$str .= chr ( 0xE0 | $c >> 12 );
		$str .= chr ( 0x80 | $c >> 6 & 0x3F );
		$str .= chr ( 0x80 | $c & 0x3F );
	} else if ($c < 0x200000) {
		$str .= chr ( 0xF0 | $c >> 18 );
		$str .= chr ( 0x80 | $c >> 12 & 0x3F );
		$str .= chr ( 0x80 | $c >> 6 & 0x3F );
		$str .= chr ( 0x80 | $c & 0x3F );
	}
	return $str;
}

function show_time() {
	global $time_start, $time_end;
	
	$time = $time_end - $time_start;
	echo "Parsing done in $time seconds<hr size=1><br>";
}

function fatal($msg = '') {
	echo '[错误提示]';
	if (strlen ( $msg ) > 0)
		echo ": $msg";
	echo "<br>\n读取脚本终止<br>\n";
	if ($f_opened)
		@fclose ( $fh );
	exit ();
}
;

function get($exc, $data) {
	switch ($data ['type']) {
		//   string   
		case 0 :
			$ind = $data ['data'];
			if ($exc->sst [unicode] [$ind]) {
				return uc2html ( $exc->sst ['data'] [$ind] ); //
			} else
				return $exc->sst ['data'] [$ind];
			//   integer   
		case 1 :
			return ( integer ) $data ['data'];
		//   float   
		case 2 :
			return ( float ) $data ['data'];
		case 3 :
			return gmdate ( "m-d-Y", $exc->xls2tstamp ( $data [data] ) );
		default :
			return '';
	}
}

function getTableData($ws, $exc) {
	
	global $excel_file, $db_table;
	global $valid;
	//构造基本参数
	$setArray = $valid->set (); //set()是加载相应页面的函数
	$fieldHeader = $setArray ['fieldHeader'];
	$db_table = $setArray ['table'];
	
	if (! isset ( $_POST ['useheads'] ))
		$_POST ['useheads'] = "";
	
	$data = $ws ['cell'];
	
	echo <<<FORM
     <div>
	<form action="" method="POST" name="db_export" >
	<div style = "display:none">
	<table>
	<tr>
FORM;
	
	// Form fieldnames
	

	echo "</tr></table></div>";
	echo $fieldHeader;
	
	foreach ( $data as $i => $row ) { // Output data and prepare SQL instructions
		

		if ($i == 0 && $_POST ['useheaders'])
			continue;
		
		echo "<tr bgcolor=\"#ffffff\">";
		
		for($j = 0; $j <= $ws ['max_col']; $j ++) {
			
			$cell = get ( $exc, $row [$j] );
			echo "<td>$cell</td>";
		
		}
		
		echo "</tr>";
		$i ++;
	}
	if (empty ( $db_table ))
		$db_table = "Table1";
	
	echo <<<FORM2
   
	
	</table></div><br/>
	<table>
	<tr>
	<input type="hidden" name="db_table" value="$db_table">
	<td><input type="submit" name="submit" value="更新"></td>
	</tr>
    
	<tr style="visibility:hidden"><td>如果表名存在,则删除:</td><td><input type="checkbox" name="db_drop" unchecked></td></tr>
	<tr style="visibility:hidden"><td colspan="2">
	<i>不打钩,表示不删除已有的数据库表.<br><font color="red">
	注意:如果你已经定义了数据库表的字段名,那么重定义字段后,插入的数据会出错!</td></tr>
	<tr><td><input type="hidden" name="excel_file" value="$excel_file"></tr>
	<tr><td><input type="hidden" name="useheaders" value="$_POST ['useheaders']"></tr>
	<tr>
	<td><input type="hidden" name="step" value="2"></td>
	</tr>
	</table>
	</form>
	</table>
	</div>
FORM2;

}

?>