<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/1/21 - 16:44
 *
 *   代理相关的链接类
 */
require_once '../setting.php';
#链接通用函数类
require_once sysPath . 'common.function.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#连接参保人信息设置
require_once sysPath . 'agent/agentSet.data.php';
#链接参保人信息表
require_once sysPath . 'dataFunction/agent/agentUser.data.php';
#链接订单信息
require_once sysPath . 'dataFunction/agent/agentOrder.data.php';
#链接参保人操作类
require_once sysPath . 'agent/agentAction.sql.php';
#链接系统管理员操作类
require_once sysPath . 'agent/managerAgentAction.sql.php';
#链接算法类
require_once sysPath . 'dataFunction/agent/agentFeeCounter.data.php';
#链接消息类
require_once sysPath . 'dataFunction/message.data.php';
require_once sysPath . 'msgManage/msgAction.sql.php';
#链接流水账类
require_once sysPath . 'dataFunction/agent/agentBill.data.php';
#链接保险公积金缴交记录
require_once sysPath . 'dataFunction/agent/agentInsuranceRecords.data.php';
#链接分页类
require_once sysPath . 'class/pagenation.class.php';
#链接微信相关
require_once sysPath . 'dataFunction/weixin/weixinUser.data.php';
#系统管理人员类
require_once sysPath . 'dataFunction/user.data.php';
#社保缴交清单
require_once sysPath . 'dataFunction/agent/soInsList.data.php';
#公积金缴交清单
require_once sysPath . 'dataFunction/agent/HFList.data.php';



