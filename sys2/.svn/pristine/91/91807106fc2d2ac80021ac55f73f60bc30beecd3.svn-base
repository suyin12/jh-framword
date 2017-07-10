<?php
/*
2010-1-4

encode this file to 'GBK', you will find new land..^_^
������,������лΰ��Ĳ����ʫ��,,,
Ȼ����,���ǲ��ǳ���������,,���ǲ����Ѿ���Ҫ��#��,ѹ��Ͳ�֪�4���������,
��Ҫ��,������...��jϵshi35dong@gmail.com.��ͻ������������֢..
4��..����һ��ֻ�м���Ĳ����...


这个是用来写一些常用的系统函数..
*/

function pIDVildator($str) {
	//身份证正则表达式(15位) 
	$isIDCard1 = "/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/";
	//身份证正则表达式(18位) 
	$isIDCard2 = "/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/";
	
	if (preg_match ( $isIDCard1, $str ) || preg_match ( $isIDCard2, $str )) {
		return true;
	} else {
		return false;
	}

}
?>