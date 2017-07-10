<?php

	

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
  return   uc2html($exc->sst['data'][$ind]);//����Ǳ��봦�?�������Ҫ�����������������������   
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
	<form action="" method="POST" name="db_export" onsubmit="return checkData()">
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
	
	echo '<div style=""><table border="0" cellspacing="1" cellpadding="2" bgcolor="#666666" width="3500"> 
		<thead>
		<tr bgcolor="#CAE8EA" style="text-align:center;">
		<th ><strong>档案编号</strong></th>
		<th ><strong>用工形式</strong></th>
		<th ><strong>在职状态</strong></th>
		<th ><strong>单位名称</strong></th>
		<th ><strong>部门名称</strong></th>
		<th ><strong>岗位</strong></th>
		<th ><strong>员工姓名</strong></th>
		<th ><strong>身份证编号</strong></th>
		<th ><strong>性别</strong></th>
		<th ><strong>民族</strong></th>
		<th ><strong>政治面貌</strong></th>
		<th ><strong>婚姻状况</strong></th>
		<th ><strong>籍贯</strong></th>
		<th ><strong>户籍类型</strong></th>
		<th ><strong>户口所在地</strong></th>
		<th ><strong>身份证地址</strong></th>
		<th ><strong>固定电话</strong></th>
		<th ><strong>移动电话</strong></th>
		<th ><strong>联系人</strong></th>
		<th ><strong>与联系人关系</strong></th>
		<th ><strong>联系人电话</strong></th>
		<th ><strong>文化程度</strong></th>
		<th ><strong>毕业学校</strong></th>
		<th ><strong>专业</strong></th>
		<th ><strong>社保电脑编号</strong></th>
		<th ><strong>社保投保年月</strong></th>
		<th ><strong>首次发放工资</strong></th>
		<th ><strong>发放工资开户银行</strong></th>
		<th ><strong>发放工资银行账号</strong></th>
		<th ><strong>入职日期</strong></th>
		<th ><strong>离职日期</strong></th>			
		<th ><strong>合同初始日期</strong></th>
		<th ><strong>合同终止日期</strong></th>
		<th ><strong>续签合同开始日期</strong></th>
		<th ><strong>续签合同终止日期</strong></th>
		<th ><strong>续签合同编号</strong></th>
		<th ><strong>备注</strong></th>
		</tr>
		</thead>';
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
	<table align="center" width="420">
	<tr>
	<input type="hidden" name="db_table" value="workerInfo">
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
				$SQL[$i] .= addslashes ( get ( $exc, $row[$j] ) );
				$SQL[$i] .= "\"";
				
				$SQL[$i] .= ",";
				
							
			}
	   
				
		}
		$SQL[$i] .="sessionID=$_SESSION[UserID],";
		$SQL[$i] = rtrim($SQL[$i], ',');
		
		$i++;
		
	}
	 
	
	return $SQL;	
			
} 

?>