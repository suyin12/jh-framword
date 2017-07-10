<?php
/**
 *   <<<     临时人员操作        >>>
 *
 * Created by Great sToNe.
 *
 * Date: 13-5-15
 * Time: 下午2:40
 * EMAIL: shi35dong@gmail.com
 *
 */

# 页面访问权限
require_once '../auth.php';
# 连接模板文件
require_once sysPath . 'templateConfig.php';
# 配置文件 数据库和pdo smarty初始化等
require_once sysPath . 'dataFunction/unit.data.php';
#连接公共函数库
require_once sysPath . 'common.function.php';
#链接招聘模块各类库的关联文件
require_once sysPath . 'recruitManage/requireClassFile.php';
#连接员工信息设置类
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#连接临时数据操作类
require_once sysPath . "dataFunction/tempAction.data.php";

#标题
$title="临时处理数据";

#获取临时处理数据
$temp = new tempAction();
$temp->tempBasic(" ID,whichID,value");
$tempJsonArr = $temp->tempExtraArr();
#临时数据配置
$smarty->assign("tempJsonArr", $tempJsonArr);
# 模板配置
$smarty->assign(array(
    "title" => $title,
    "css" => httpPath . "css/main.css",
    "httpPath" => httpPath
));
$smarty->display("tempManage/tempAction.tpl");