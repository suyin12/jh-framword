<?php
/*
*     2010-5-13
*          <<<自己手写的eixt(); 作为变量调节器,一般就用来判断模板变量为空的情况,不为空的时候不返回
*                当设置参数$output=noNull时,则表示为值不为空时候的exit>>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

function smarty_modifier_exit($string, $output = '') {
	if ($output == "noNull") {
		if (!empty ( $string ))
			return exit ($string);
	} else {
		if (! isset ( $string ) || $string === '')
			return exit ( $output );
	}
}
?>