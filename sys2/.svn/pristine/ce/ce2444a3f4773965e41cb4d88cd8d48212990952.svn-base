<?php
/*
*     2010-2-21   
*          <<< 工资结算前,验证员工信息的完整性.包括: 
*             致命错误 : 1. 员工的工资账号无法匹配  2.未生成互助会名单,社保名单,商保名单
*             警告性错误:1.社保未购买 
*             致命性错误,程序终止无法进入下一步操作..警告性错误可以进入下一步
*          >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#通用函数库
require_once '../common.function.php';
#页面标题
$title = "验证员工信息完整性";
#



?>