<?php
/*
*     2011-1-17
*          <<<添加中文字符自动换行函数
*          >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
//切割中文字串
function smarty_modifier_wordwrapGBK($string, $length = 80, $etc = '\n', $space = false, $code = 'UTF-8') {
	if ($length == 0)
		return '';
	if ($code == 'UTF-8') {
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
	} else {
		$pa = "/[\x01-\x7f]|[\xa1-\xff][\xa1-\xff]/";
	}
	preg_match_all ( $pa, $string, $t_string );
	$newStr = null;
	foreach ( $t_string [0] as $key => $val ) {
		if (($key + 1) % $length == 0) {
			$newStr .= $etc;
		} else {
			if ($val != " " && $space)
				$newStr .= $val;
			elseif (! $space)
				$newStr .= $val;
		}
	}
	return $newStr;
}

?>