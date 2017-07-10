<?php

/*
 * 2010-1-18
  <<<< 员工离/入职 变动信息 >>>>
 *       encode this file to 'GBK', you will find new World..^_^
 *      ������,������лΰ��Ĳ����ʫ��,,,
 *      Ȼ����,���ǲ��ǳ���������,,���ǲ����Ѿ���Ҫ��#��,ѹ��Ͳ�֪�4���������,
 *      ��Ҫ��,������...��jϵshi35dong@gmail.com.��ͻ������������֢..
 *      4��..����һ��ֻ�м���Ĳ����...
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once '../dataFunction/unit.data.php';
#链接通用函数库
require_once sysPath . 'common.function.php';
#页面标题
$title = "员工变动概况";
#初始化页面
$model = array("date" => "按日期", "month" => "按月份");
$hospitalization = array("0" => "不参加", "1" => "综合", "2" => "住院", "4" => "合作");
$hand = array("1" => "右手", "2" => "左手");
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1");
$j_unitManager = json_encode($unitManager);

#构造 SQL, 入/离职,修改社保统一显示在一起(其实,社保的最后修改时间,可以判断员工的离入职情况)
$sql = "select distinct(a.uID),a.name,a.domicile,a.unitID,b.unitName,a.type,a.soInsModifyDate,a.status,a.soInsurance,a.housingFund,a.comInsurance,a.helpCost, a.mountGuardDay,a.radix,a.pension,a.hospitalization,a.employmentInjury,a.unemployment,a.housing,a.PDIns,a.hand from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID  ";
#获取某时间段
$m = $_GET ['m'];
switch ($m) {
    case "date" :
        $beginTime = $_GET ['bT'];
        $endTime = $_GET ['eT'];
        if ($_GET ['spBT'] && $_GET ['spET']) {
            $spTime = date("Y-m", strtotime($endTime));
            $spBT = $_GET ['spBT'];
            $spET = $_GET ['spET'];
        } else {
            $spTime = date("Y-m", strtotime($endTime));
            $spBT = $spTime . "-15";
            $spET = $spTime . "-". insuranceInTurn("soIns");
        }        
        $spExcVal = array(":beginTime" => $spBT, ":endTime" => $spET);
        $excVar = array(":beginTime" => $beginTime, ":endTime" => $endTime);
        break;
    case "month" :
        $endTime = $_GET ['mon'];
        $beginTime = date("Y-m-d", strtotime("$endTime -1 Month +1 Day"));
        if ($_GET ['spBT'] && $_GET ['spET']) {
            $spTime = date("Y-m", strtotime($endTime));
            $spBT = $_GET ['spBT'];
            $spET = $_GET ['spET'];
        } else {
            $spTime = date("Y-m", strtotime($endTime));
            $spBT = $spTime . "-15";
            $spET = $spTime . "-". insuranceInTurn("soIns");
        }
    
        $spExcVal = array(":beginTime" => $spBT, ":endTime" => $spET);
        $excVar = array(":beginTime" => $beginTime, ":endTime" => $endTime);
        break;
}
#生成单位ID
if ($_GET ['mID']) {
    $mID = $_GET ['mID'];
    foreach ($unitManager as $uValue) {
        if ($uValue ['mID'] == $mID) {
            foreach ($uValue ['unit'] as $uV) {
                $sqlV .= "'" . $uV ['unitID'] . "',";
            }
        }
    }
    $sqlV = rtrim($sqlV, ",");
    if ($_GET ['unitID']) {
        $unitID = $_GET ['unitID'];
        $sqlUnit .= " and a.unitID like '$unitID' ";
    } else
        $sqlUnit .= " and a.unitID in(" . $sqlV . ")";
} else {
    if (!$_GET ['wCS'])
        $mID = $_SESSION ['exp_user'] ['mID'];
}
//遍历客户经理,单位数组
foreach ($unitManager as $um_v) {
    foreach ($um_v as $um_v_k => $um_v_v) {
        if ($um_v ['mID'] == $mID) {
            //构造get后,单位数组
            $um [0] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName'], "unit" => $um_v ['unit']);
        } else {
            //构造get后,单位数组,除get外其余的客户经理
            $um_m[$um_v['mID']] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName']);
        }
    }
}
//构造get后,单位数组

if ($um) {
    $um = array_merge($um, $um_m);
    $smarty->assign("unitManager", $um);
} else {
    $smarty->assign("unitManager", $unitManager);
}

if ($excVar) {
	//入职SQL
	//		$sql1 = " a.mountGuardDay between :beginTime and :endTime and a.status not like '0'";
	$sql1 .= " select uID from a_soInsList where soInsModifyDate between  :beginTime and :endTime and soInsurance in ('1','2') ";
	//离职SQL
	$sql2 = " select uID from a_dimission where dimissionDate between :beginTime and :endTime";
	//社保修改SQL
	$sql3 = " select uID from a_soInsList  where soInsModifyDate between :beginTime and :endTime and soInsurance like '2' ";
	//15-19号社保新增人员
	$sql4 = " select uID from a_soInsList where soInsModifyDate between  :beginTime and :endTime and soInsurance  in ('1','2') ";
	//停保人员名单(因为停保人数大于离职人数..)
	$sql5 = " select uID from a_soInsList where soInsModifyDate between  :beginTime and :endTime and soInsurance like '0'";
	//封存公积金名单(因为封存人数大于离职人数..)
	$sql6 = " select uID from a_HFList where HFModifyDate between  :beginTime and :endTime and housingFund like '0'";
	
    $sql1 = $sql . "  left join (" . $sql1 . ") c on a.uID=c.uID  where  c.uID is not null   and a.status not like '0'  and a.mountGuardDay between :beginTime and :endTime " . $sqlUnit . " order by a.unitID";
    $sql2 = $sql . "  left join (" . $sql2 . ") c on a.uID=c.uID  where  c.uID is not null   and a.status like '0' " . $sqlUnit . " order by a.unitID";
    $sql3 = $sql . "  left join (" . $sql3 . ") c on a.uID=c.uID  where  c.uID is not null   and a.status not like '0' " . $sqlUnit . " order by a.unitID";
    $sql4 = $sql . "  left join (" . $sql4 . ") c on a.uID=c.uID  where  c.uID is not null   and a.status not like '0' and a.mountGuardDay between :beginTime and :endTime " . $sqlUnit . " order by a.unitID";
    $sql5 = $sql . "  left join (" . $sql5 . ") c on a.uID=c.uID  where  c.uID is not null    " . $sqlUnit . " order by a.unitID";
    $sql6 = $sql . "  left join (" . $sql6 . ") c on a.uID=c.uID  where  c.uID is not null    " . $sqlUnit . " order by a.unitID";
    //合成 入职,离职,修改 数组
    $mountArray = SQL($pdo, $sql1, $excVar);
    $dimissionArray = SQL($pdo, $sql2, $excVar);
    $modifyArray = SQL($pdo, $sql3, $excVar);
    $spSoArray = SQL($pdo, $sql4, $spExcVal);
    $stopSoInsArray = SQL($pdo, $sql5, $excVar);
    $stopHFArray = SQL($pdo, $sql6, $excVar);
    foreach ($mountArray as $mK => $mV) {
        foreach ($mV as $k => $v) {
            switch ($k) {
                case "soInsurance" :
                    if (!$v)
                        $v = "0"; //空值默认为不购买
                    switch ($v) {
                        case "0" :
                            //在职但未购买社保
                            $so ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                        case "1" :
                            //在职并购买社保	
                            $so ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                        case "2" :
                            //在职并更改社保	
                            $so ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                    }
                    break;
                case "housingFund":
                    if (!$v)
                        $v = "0"; //空值默认为不购买
                    switch ($v) {
                        case "0" :
                            //在职但未购买公积金
                            $HF ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                        case "1" :
                            //在职并购买公积金	
                            $HF ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                        case "2" :
                            //在职并更改公积金	
                            $HF ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                    }
                    break;
                case "comInsurance" :

                    if (!$v)
                        $v = "0"; //空值默认为不购买
                    switch ($v) {
                        case "0" :
                            //在职但未购买商保
                            $com ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                        case "1" :
                            //在职并购买商保
                            $com ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                    }
                    break;
                case "helpCost" :

                    if (!$v)
                        $v = "0"; //空值默认为不购买
                    switch ($v) {
                        case "0" :
                            //在职但未参加互助会
                            $help ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                        case "1" :
                            //在职单位参加互助会
                            $help ['mount'] [$v] [] = $mountArray [$mK];
                            break;
                    }
                    break;
            }
        }
    }
    //echo "<pre>";
    //print_r($com);
    // $so = @array_unique($so);
    // $HF = @array_unique($HF);
    // $com = @array_unique($com);
    // $help = @array_unique($help);

    //把相应数组,编码成JSON
    $totalArray = array("so" => $so, "HF"=>$HF,"com" => $com, "help" => $help, "mountArray" => $mountArray, "dimissionArray" => $dimissionArray, "modifyArray" => $modifyArray, "spSoArray" => $spSoArray, "stopSoInsArray" => $stopSoInsArray, "stopHFArray" => $stopHFArray);
    foreach ($totalArray as $totalK => $totalArr) {
        switch ($totalK) {
            case "so" :
            case "HF":
            case "com" :
            case "help" :
                $js_totalArray ["js_" . $totalK] = json_encode($totalArr ['mount'] ['1']);
                break;
            case "spSoArray" :
                break;
            default :
                $js_totalArray ["js_" . $totalK] = json_encode($totalArr);
                break;
        }
    }
}
#加载模板变量
$smarty->assign("j_unitManager", $j_unitManager);
$smarty->assign("model", $model);
$smarty->assign("hospitalization", $hospitalization);
$smarty->assign("hand", $hand);
$smarty->assign("s_unitID", $unitID);
$smarty->assign("s_mID", $mID);
$smarty->assign("spTime", $spTime);
$smarty->assign("spBT", $spBT);
$smarty->assign("spET", $spET);
$smarty->assign("s_model", $m);
#加载概况数组
$smarty->assign($totalArray);
$smarty->assign($js_totalArray);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("workerInfo/wChangeSurvey.tpl");
?>