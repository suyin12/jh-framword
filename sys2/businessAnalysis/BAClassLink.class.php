<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/22
 * Time: 9:06
 */
require_once '../setting.php';
#链接通用函数类
require_once sysPath . 'common.function.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接消息类
require_once sysPath . 'dataFunction/message.data.php';
require_once sysPath . 'msgManage/msgAction.sql.php';
#链接分页类
require_once sysPath . 'class/pagenation.class.php';
#链接微信相关
require_once sysPath . 'dataFunction/weixin/weixinUser.data.php';
#系统管理人员类
require_once sysPath . 'dataFunction/user.data.php';
#
require_once sysPath .'/businessAnalysis/BASet.data.php';


#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';

#连接欠款/挂账核算类
require_once sysPath . 'dataFunction/money.data.php';
