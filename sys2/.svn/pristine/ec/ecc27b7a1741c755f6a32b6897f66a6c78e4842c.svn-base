<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2015/10/14 - 10:37
 *
 *  生成个税申报表
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接费用核算类
require_once sysPath . 'dataFunction/salaryFee.data.php';



//$unitID = $_GET['unitID'];
$unitID ="2202.044";
$salaryDate = $_GET['d'];
#获取相应工资月份(salaryDate)的费用月份(salaryDate,rewardDate)
$salaryFeeData= new salaryFee();
$salaryFeeData->pdo=$pdo;
$salaryFeeData->unitID=$unitID;
$salaryFeeData->monthType="salaryDate";
$salaryFeeData->month=$rewardDate;
$ret =$salaryFeeData->allRet();

echo "<pre>";
print_r($ret);

#按照各单位信息获取相关参数

#按要求查询各单位号码



?>
