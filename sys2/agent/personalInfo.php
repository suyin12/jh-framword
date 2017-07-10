<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/1/27 - 15:44
 */

#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";

$title = "参保人详细信息";
$today = timeStyle("date");
#参保人数组
$fID = filterParam("fID",0);
$aU = new agentUser();
$aUserArr = $aU->agentUserBasic("*", "`fID`='$fID'");
$aUserArr = $aU->agentUserRecreate();
foreach ($aUserArr[$fID] as $k => $v) {
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

#历史修改信息
$hisRet=$aU->agentUserHistoryBasic("fID,lastModifyBy,lastModifyTime,modifyRemarks","fID='$fID'");

#配置变量
$smarty->assign(array("wxUserArr"=>$wxUserArr,"sysUserArr"=>$sysUserArr,"hisRet"=>$hisRet));
//模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agent/personalInfo.tpl");