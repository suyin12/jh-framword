<?php
/*
作者：LOSKIN
time:2014-02-28
描述：作为个代办理引用开头文件
更新：
	<<<<引用配置文件>>>>
*/

require_once 'agmLink.class.php';
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
// 分页
require_once '../class/pagenation.class.php';

require_once '../dataFunction/unit.data.php';

require_once '../common.function.php';
#连接参保人信息设置
require_once sysPath . 'dataFunction/agencySet.data.php';
#数据库操作类
require_once '../class/db_class.php';
#社保计算方法
require_once '../dataFunction/feeExtra.data.php';

/*  初始化设置 */
 new db($pdo);
$aSet = new agencySet();
$aSet->p=$pdo;
$aSet->agencySetArr();
