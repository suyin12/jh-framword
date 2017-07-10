<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/2/17 - 14:21
 */

#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";

$title = "参保人详细信息";
$today = timeStyle("date");
#参保人数组
$fID = filterParam("fID",0);
$lastModifyTime = filterParam("lastModifyTime",0);
$aU = new agentUser();
$aUserArr = $aU->agentUserHistoryBasic("*", "`fID`='$fID' and `lastModifyTime`='$lastModifyTime'");
$aUserArr = $aU->agentUserRecreate();
foreach ($aUserArr[0] as $k => $v) {
    switch ($k) {
        case "hospitalization" :
        case 'marriage':
        case 'proTitle':
        case 'proLevel':
            $k = "s_" . $k;
            break;
        case "HFRadix":
        case "uHFPer":
        case "pHFPer":
            if (empty($v)) {
                unset($v);
            }
            break;
        case "userID":
            $wxUserID = $v;
            break;
        case "lastModifyBy":
            $sysUserID = $v;
            break;
    }
    $smarty->assign("{$k}", $v);
}
#
$wxU = new weixinUser();
$wxUserArr= $wxU->wxUserBasic("uid,truename,mobile","uid='$wxUserID'");
#
$sysU = new user();
$sysUserArr = $sysU->userBasic("mID,mName","mID='$sysUserID'");


#配置变量
$smarty->assign(array("wxUserArr"=>$wxUserArr,"sysUserArr"=>$sysUserArr));
//模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agent/personalHistoryInfo.tpl");