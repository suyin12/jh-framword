<?php
//配置文件 数据库和pdo smarty初始化等
require_once '../../setting.php';
//连接数据库操作类
require_once '../../class/db_class.php';
#连接公用函数库
require_once '../../common.function.php';
/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
#验证唯一性
$re=false;
if($validateId=="pID"){
	$validateValue=pIDVildator($validateValue);
}
if(!empty($validateValue)){
	new db($pdo);
	$tableName="d_agent_personalInfo";
	$where="where ".$validateId."="."'".$validateValue."'";
	#取得结果为false或数组
	$re=db::select($tableName,"id",$where);
}

if(!$re){		// validate??
	$arrayToJs[1] = true;			// RETURN TRUE
	echo json_encode($arrayToJs);			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
}

?>